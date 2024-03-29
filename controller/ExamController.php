<?php
require_once(__DIR__ . '/../model/Exam.php');
require_once(__DIR__ . '/../model/Subjects.php');
require_once(__DIR__ . '/../dao/UserDAO.php');
require_once(__DIR__ . '/../dao/ExamDAO.php');
require_once(__DIR__ . '/../service/ExamModuleService.php');
require_once(__DIR__ . '/../service/ExamService.php');
require_once(__DIR__ . '/../service/StudyPlanService.php');
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__.'./../util/config.php');
error_reporting(1);


class ExamController extends Controller{
    private ExamModuleService $examModuleService;
    private ExamDAO $examDao;
    private UserDAO $userDao;
    private ExamService $examService;

    function __construct(){
        $this->examModuleService = new ExamModuleService();
        $this->examDao = new ExamDAO();
        $this->userDao = new UserDAO();
        $this->examService = new ExamService();
        $this->handleAction();
    }
    
    private function findById(){
        if (isset($_GET['id'])){
            $id = $_GET['id'];
        }
    }
    
    public function list($exam, $errorMsgs){
        header('Location: '.BASE_URL.'/controller/ExamController.php?action=view&id='.$exam->getId());
    }

    protected function report($exam=null){
        $exam_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $exam = ($exam != null)? $exam : $this->examDao->findById($exam_id);

        $dados['prova'] = $exam;
        $this->loadView('exam/report_exam.php', $dados);
    }

    public function view($exam=null){
        $exam_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $exam = ($exam != null)? $exam : $this->examDao->findById($exam_id);

        $dados['prova'] = $exam;
        $this->loadView('exam/test_exam.php', $dados);
    }

    protected function listAll(){
        session_start();
        $exams = $this->examDao->findByUser($_SESSION['userId']);
        $dados['provas'] = $exams;
        $this->loadView('exam/historic.php', $dados);
    }
    
    public function create($dados = [], $errorMsgs = ""){
        $this->loadView("exam/create_exam.php", $dados, $errorMsgs);
    }

    protected function save(){
        // Pegando valores do formulário
        $errors = [];
        $exam_type = $_POST['exam_type'] ?? 'default';
        $user_id = $_POST['user_id'] ?? NULL;

        // Cria os parâmetros para consulta de questões
        $exam_subjects_module_num = [];
        if($exam_type == 'default'){
            // Se for Default, colocar as 7 matérias - ALL
            foreach(Subjects::cases() as $subject):
                $exam_subjects_module_num[$subject->name] = [
                    'Module' => 'ALL',
                    'NumberQuestions'=> 9,
                ];
            endforeach;
        }else{
            /* Senão, pega os subjects filtrados, o módulo que selecionou para este e o número de questões escolhidas, 
            ficando no padrão $var["Matemática"]["Modules"] = "0"->id ["Matemática"]["NumberQuestions"] = 8
            Para pegas os valores depois, as Subjects que não foram colocadas não estarão na prova*/
            $filters_count = isset($_POST['filters_count']) ? intval($_POST['filters_count']) : 0;
            for($i = 1; $i<($filters_count+1); $i++){
                if(isset($_POST['subject'.$i])){
                    $sub = $_POST['subject'.$i];
                    $exam_subjects_module_num[$sub]['Module'] = $_POST['exam_module' . $i] ?? 'ALL';
                    $exam_subjects_module_num[$sub]['NumberQuestions'] = $_POST['num_questions' . $i] ?? 9;
                }
            }
        }

        // Pega as questões, separadas por matérias -> ExamModule
        $exam_modules = $this->examModuleService->handleRandomExamModules($exam_subjects_module_num);

        // Find User
        $user = $this->userDao->findById($user_id);

        $totalQuestions = 0;
        foreach($exam_modules as $exMod){
            $totalQuestions += count($exMod->getUserAnswers());
        }

        // Create Exam
        $exam = new Exam();
        $exam->setUser($user);
        $exam->setExamModules($exam_modules);
        $exam->setFinished(_FALSE_);
        $exam->setTotalQuestions($totalQuestions);

        try{
            $this->examDao->insert($exam);
            $this->list($exam, $errors);
            exit;
        } catch (PDOException $e) {
            array_push($errors, "Erro ao salvar a questão no banco de dados");
        }
        $errorMsgs = implode("<br>", $errors);
        $this->list($exam, $errorMsgs);
    }

    protected function makeReport(){
        $studyPlanService = new StudyPlanService();
        $examModuleDao = new ExamModuleDAO();

        $exam_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $exam = $this->examDao->findById($exam_id);
        $this->examService->makeReport($exam);
        $exam->setFinished(_TRUE_);
        
        $totalCorrects = 0;
        foreach($examModuleDao->findByExam($exam) as $exMod){
            $totalCorrects += $exMod->getCorrectQuestions();
        }
        
        $exam->setTotalQuestionsCorrect($totalCorrects);
        
        $calc = $totalCorrects/$exam->getTotalQuestions();
        $report = round($calc*100, 2);
        $exam->setPercentageCorrect($report);
        
        $this->examDao->update($exam);
        
        $studyPlans = $studyPlanService->createStudyPlans($exam);

        $exam->setStudyPlans($studyPlans);
        header('Location: '.BASE_URL.'/controller/ExamController.php?action=report&id='.$exam->getId());
    }

}

$examController = new ExamController();
