<?php
require_once(__DIR__ . '/../util/config.php');
require_once(__DIR__ . "/../dao/QuestionDAO.php");
require_once(__DIR__ . "/../service/QuestionService.php");
require_once(__DIR__ . "/../model/Question.php");
require_once(__DIR__ . "/../model/Alternative.php");
require_once(__DIR__ . "/../dao/AlternativeDAO.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/ModuleDAO.php");

class QuestionController extends Controller{

    private QuestionDAO $questionDao;
    private ModuleDAO $moduleDao;
    private AlternativeDAO $alternativeDao;
    private QuestionService $questionService;

    function __construct(){
        $this->questionDao = new QuestionDAO();
        $this->moduleDao = new ModuleDAO();
        $this->alternativeDao = new AlternativeDao();
        $this->questionService = new QuestionService();
        $this->setActionDefault("list");
        $this->handleAction();
    }

    private function findById(){
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            return $this->questionDao->findById($id);
        }
    }

    public function list(){
        $dados['lista'] = $this->questionDao->list();
        $this->loadView("question/list_questions.php", $dados);
    }

    public function create($dados = [], $errorMsgs = ""){
        $dados['id'] = NULL;
        $dados['modules'] = $this->moduleDao->list();
        $this->loadView("question/create_question.php", $dados, $errorMsgs);
    }

    protected function save(){

        // Pegando valores do formulário
        $dados["id"] = isset($_POST['question_id']) ? $_POST['question_id'] : NULL;
        $question_text = isset($_POST['question_text']) ? $_POST['question_text'] : NULL;
        $question_module = isset($_POST['question_module']) ? $_POST['question_module'] : NULL;
        // Adicionando no objeto questão
        $question = new Question();
        $question->setId($dados['id']);
        $question->setText($question_text);

        // Pegando o modulo do banco
        $question_module = $this->moduleDao->findById($question_module);
        $question->setModule($question_module);

        // Colocando as alternativas da questão em um array para enviar para a controller da alternativa
        $alternatives = [];
        for($i = 1; $i<=5; $i++){
            $text = isset($_POST['alternative'.$i]) ? $_POST['alternative'.$i] : NULL;
            $isCorrect = (isset($_POST['correctAlternative']) && $_POST['correctAlternative'] == $i)? _TRUE_ : _FALSE_;

            $alternative = new Alternative();
            $alternative->setText($text);
            $alternative->setIsCorrect($isCorrect);
            $alternative->setQuestion($question);
            array_push($alternatives, $alternative);
        }
        $question->setAlternatives($alternatives);
        $errors = $this->questionService->validateData($question);
        if (empty($errors)) {
            // Inteação com a DAO
            try{
                if($dados['id'] == NULL){
                    $this->questionDao->insert($question);
                }else{
                    $this->questionDao->update($question);
                }
                $this->list();
                exit;
            } catch (PDOException $e) {
                $errors = "Erro ao salvar a questão no banco de dados";
            }
            
        }
        
        $dados["question"] = $question;
        $errorMsgs = implode("<br>", $errors);
        $this->create($dados, $errorMsgs);
    }

    // Cria o objeto para ser enviado à tela de editar, para que estejam obtidos os dados
    protected function edit(){
        $question = $this->findById();

        if($question){
            $dados["id"] = $question->getId();
            $dados["question"] = $question;
            $dados['modules'] = $this->moduleDao->list();
            $this->loadView("question/create_question.php", $dados);
        }else{
            $this->loadView("question/list_question.php", [], "Questão não encontrada");
        }
    }

    protected function delete(){
        $question = $this->findById();

        if($question){
            $this->questionDao->delete($question);
            $this->list();
        }else{
            $this->list();
        }
    }
}

$questionController = new QuestionController();
