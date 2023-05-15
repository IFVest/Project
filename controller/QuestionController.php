<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);
require_once(__DIR__ . "/../dao/QuestionDAO.php");
require_once(__DIR__ . "/../model/Question.php");
require_once(__DIR__ . "/../service/AlternativeService.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/ModuleController.php");


class QuestionController extends Controller{

    private QuestionDAO $questionDao;
    private Question $question;
    private ModuleController $moduleController;
    private AlternativeService $alternativeService;

    public function __construct(){
        $this->questionDao = new QuestionDAO();
        $this->question = new Question();
        $this->moduleController = new ModuleController();
        $this->handleAction();
    }

    private function findById(){
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            return $this->questionDao->findById($id);
        }
    }

    public function list(){
        return $this->questionDao->list();
    }

    protected function save(){
        // Pegando valores do formulário
        $dados["id"] = isset($_POST['question_id']) ? $_POST['question_id'] : NULL;
        $question_text = isset($_POST['question_text']) ? $_POST['question_text'] : NULL;
        $question_module = isset($_POST['question_module']) ? $_POST['question_module'] : NULL;

        // Adicionando no objeto questão
        $this->question->setId($dados['id']);
        $this->question->setText($module_text);

        // Pegando o modulo do banco
        $question_module = $this->moduleController->findById($question_module);
        $this->question->setModule($question_module);

        // Colocando as alternativas da questão em um array para enviar para a controller da alternativa
        $alternatives = [];
        for($i = 1; $i<=5; $i++){
            $text = isset($_POST['alternative{$i}']) ? $_POST['alternative{$i}'] : NULL;
            $isCorrect = false;
            if(isset($_POST['correctAlternative']) && $_POST['correctAlternative'] == $i){
                $isCorrect = true;
            }
            $alternative['text'] = $text;
            $alternative['isCorrect'] = $isCorrect;

            array_push($alternatives, $alternative);
        }

        // Inteação com a DAO
        if($dados['id'] == NULL){
            $this->questionDao->insert($question, $alternatives);
        }else{
            $this->questionDao->update($question, $alternatives);
        }

        $this->loadView("question/create_question.php", $dados);
    }

    // Cria o objeto para ser enviado à tela de editar, para que estejam obtidos os dados
    protected function edit(){
        $question = $this->findById();

        if($question){
            $dados["id"] = $question->getId();
            $dados["question"] = $question;

            $alternatives = $this->alternativeService->getByQuestion($question);
            for($i = 0; $i<=4; $i++){
                $dados["alterative"+($i++)] = $alternatives[$i];
            }
            
            $this->loadView("question/create_question.php", $dados);
        }else{
            $this->loadView("question/list_question.php", [], "Questão não encontrada");
        }
    }

    protected function delete(){
        $question = $this->findById();

        if($question){
            $this->questionDao->delete($question);
            $this->loadView("question/list_question.php", []);
        }else{
            $this->loadView("question/list_question.php", [], "Questão não encontrada");
        }
    }
}
