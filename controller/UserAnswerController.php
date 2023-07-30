<?php
require_once(__DIR__ . '/../util/config.php');
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
            return $this->moduleDao->findById($id);
        }
    }

    protected function changeChosenAnswer(){
        echo $_POST['userAnswerId'];
        $userAnswerId = isset($_POST['userAnswerId'])? $_POST['userAnswerId'] : 0;
        $alternativeId = isset($_POST['alternativeId'])? $_POST['alternativeId'] : 0;
        echo $userAnswerId;
        echo $alternativeId;
        $userAnswer = $this->userAnswerDao->findById($userAnswerId);
        $userAnswer->setChosenAnswer($alternativeId);
        $this->userAnswerDao->update($userAnswer);
    }

}

$userAnswerController = new UserAnswerController();
