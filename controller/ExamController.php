<?php
require_once(__DIR__ . '/../model/Exam.php');
require_once(__DIR__ . '/../model/Subjects.php');
require_once(__DIR__ . '/../dao/UserDAO.php');
require_once(__DIR__ . '/../dao/ExamDAO.php');
require_once(__DIR__ . '/../service/ExamModuleService.php');
require_once(__DIR__ . "/Controller.php");

class ExamController extends Controller{
    private ExamModuleService $examModuleService;
    private ExamDAO $examDao;
    private UserDAO $userDao;
    
    function __construct(){
        $this->examModuleService = new ExamModuleService();
        $this->examDao = new ExamDAO();
        $this->userDao = new UserDAO();
        $this->handleAction();
    }
    
    private function findById(){
        if (isset($_GET['id'])){
            $id = $_GET['id'];
        }
    }
    
    public function list($exam){
        $dados['prova'] = $exam;
        $this->loadView("exam/test_exam.php", $dados);
    }
        
    
    public function create($dados = [], $errorMsgs = ""){
        $this->loadView("exam/create_exam.php", $dados, $errorMsgs);
    }

    protected function save(){
        // Pegando valores do formulário
        $exam_type = isset($_POST['exam_type']) ? $_POST['exam_type'] : 'defalut';
        $filters_count = isset($_POST['filters_count']) ? intval($_POST['filters_count']) : 0;
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : NULL;

        // Cria os parâmetros para consulta de questões
        $exam_subjects_module_num = [];
        if($exam_type == 'default'){
            // Se for Default, colocar as 7 matérias - ALL
            //TODO muito lento (??)
            foreach(Subjects::cases() as $subject):
                $exam_subjects_module_num[$subject->name] = [
                    'Module' => 'ALL',
                    'NumberQuestions'=> 9,
                ];
            endforeach;
        }else{
            // Senão, pega os subjects filtrados, o módulo que selecionou para este e o número de questões escolhidas, 
            // ficando no padrão $var["Matemática"]["Modules"] = "0"->id ["Matemática"]["NumberQuestions"] = 8
            // Para pegas os valores depois, as Subjects que não foram colocadas não estarão na prova
            for($i = 0; $i<$filters_count; $i++){
                if(isset($_POST['subjects' + $i])){
                    $sub = $_POST['subjects' + $i];
                    $exam_subjects_module_num[$sub]['Module'] = isset($_POST['exam_modules'+ $i]) ? $_POST['exam_modules'+ $i] : 'ALL';
                    $exam_subjects_module_num[$sub]['NumberQuestions'] = isset($_POST['module_quest_num'+ $i]) ? $_POST['module_quest_num'+ $i] : 9;
                }
            }
        }
        // Pega as questões, separadas por matérias -> ExamModule
        $exam_modules = $this->examModuleService->handleRandomExamModules($exam_subjects_module_num);
        
        // Find User
        $user = $this->userDao->findById($user_id);

        // Create Exam
        $exam = new Exam();
        $exam->setUser($user);
        $exam->setExamModules($exam_modules);

        $errors = [];
        try{
            $this->examDao->insert($exam);
            $this->list($exam);
            exit;
        } catch (PDOException $e) {
            array_push($errors, "Erro ao salvar a questão no banco de dados");
        }
        $errorMsgs = implode("<br>", $errors);
        $this->list($exam, $errorMsgs);
    }
}

$examController = new ExamController();
