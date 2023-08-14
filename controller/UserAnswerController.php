<?php
require_once(__DIR__ . '/../util/config.php');
require_once(__DIR__ . "/../dao/ExamDAO.php");
require_once(__DIR__ . "/../dao/UserAnswerDAO.php");
require_once(__DIR__ . "/Controller.php");

class UserAnswerController extends Controller{

    private UserAnswerDAO $userAnswerDao;

    function __construct(){
        $this->userAnswerDao = new UserAnswerDAO();
        $this->handleAction();
    }

    private function findById(){
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            return $this->userAnswerDao->findById($id);
        }
    }

    protected function changeChosenAnswer(){
        $userAnswerId = $_POST['userAnswerId'] ?? 0;
        $alternativeId = $_POST['alternativeId'] ?? 0;
        $userAnswer = $this->userAnswerDao->findById($userAnswerId);
        $examDao = new ExamDAO();
        $exam = $examDao->findByUserAnswer($userAnswer->getId());
        if(!$exam->getFinished()){
            $userAnswer->setChosenAnswer($alternativeId);
            $this->userAnswerDao->update($userAnswer);
        }
    }

}

$userAnswerController = new UserAnswerController();
