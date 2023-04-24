<?php

require_once(__DIR__ . "/../dao/QuestionDao.php");
require_once(__DIR__ . "/../model/Question.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/ModuleController.php");

class QuestionController extends Controller
{

    private QuestionDAO $questionDao;

    public function __construct()
    {
        $this->questionDao = new QuestionDAO();
        $this->handleAction();
    }

    private function findById()
    {
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];
            return $this->questionDao->findById($id);
        }
    }

    public function list()
    {
        return $this->questionDao->list();
    }

    protected function save()
    {
        $dados["id"] = isset($_POST['question_id']) ? $_POST['question_id'] : NULL;
        $question_text = isset($_POST['question_text']) ? $_POST['question_text'] : NULL;
        $question_module = isset($_POST['question_module']) ? $_POST['question_module'] : NULL;

        $question = new Question();
        $question->setId($dados['id']);
        $question->setText($module_text);
        
        $moduleController = new ModuleController();
        $question_module = $moduleController->getById($question_module);
        $question->setModule($question_module);

        if ($dados["id"] == NULL)
        {
            $this->questionDao->insert($question);
        }
        else
        {
            $this->questionDao->update($question);
        }
        
        $this->loadView("question/create_question.php", $dados);
    }

    protected function edit()
    {
        $question = $this->findById();

        if($question)
        {
            $dados["id"] = $question->getId();
            $dados["question"] = $question;
            $this->loadView("question/create_question.php", $dados);
        }
        else
        {
            $this->loadView("question/list_question.php", [], "Questão não encontrada");
        }
    }

    protected function delete()
    {
        $question = $this->findById();

        if($question)
        {
            $this->questionDao->delete($question);
            $this->loadView("question/list_question.php", []);
        }
        else
        {
            $this->loadView("question/list_question.php", [], "Questão não encontrada");
        }
    }
}
