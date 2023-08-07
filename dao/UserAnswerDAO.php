<?php

use function PHPSTORM_META\type;

require_once(__DIR__ . "/../model/UserAnswer.php");
require_once(__DIR__ . "/../dao/QuestionDAO.php");
require_once(__DIR__ . "/../connection/Connection.php");
error_reporting(1);

class UserAnswerDAO{
    private QuestionDAO $questionDAO;

    function __construct(){
        $this->questionDAO = new QuestionDAO();
    }

    private function mapUserAnwers($sql){
        $userAnwers = array();

        foreach($sql as $usaw){
            $userAnwer = new UserAnswer();
            $userAnwer->setId($usaw['id']);
            $userAnwer->setChosenAnswer($usaw['chosenAnswer']);
            $userAnwer->setUserRightAnswer($usaw['userRightAnswer']);

            $userAnwer->setExamModule(intval($usaw['idExamModule']));
            
            $question = $this->questionDAO->findById($usaw['idQuestion']);
            $userAnwer->setQuestion($question);

            array_push($userAnwers, $userAnwer);
        }

        return $userAnwers;
    }

    public function findById(int $id){
        $conn = Connection::getConn();
        $sql = "SELECT * FROM UserAnswer ua WHERE ua.id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $userAnwers = $this->mapUserAnwers($result);

        return $userAnwers[0];
    }

    public function findByExamModule(ExamModule $examModule){
        $conn = Connection::getConn();
        $sql = "SELECT * FROM UserAnswer ua WHERE ua.idExamModule = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$examModule->getId()]);
        $result = $stm->fetchAll();
        $userAnwers = $this->mapUserAnwers($result);

        return $userAnwers;
    }

    public function list(){
        $conn = Connection::getConn();
        $sql = "SELECT * FROM UserAnswer";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapUserAnwers($result);
    }

    public function insert(UserAnswer $userAnswer){
        $conn = Connection::getConn();
        
        echo $userAnswer->getExamModule()->getId().' ';
        echo $userAnswer->getQuestion()->getId().' ';
        echo 'ca: '. $userAnswer->getChosenAnswer().' ';
        echo 'ra: '. $userAnswer->getUserRightAnswer().' ';

        $sql = "INSERT INTO UserAnswer (idExamModule, idQuestion, userRightAnswer, chosenAnswer) VALUES 
            (:idExamModule, :idQuestion, :userRightAnswer, :chosenAnswer)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('idExamModule', $userAnswer->getExamModule()->getId());
        $stm->bindValue('idQuestion', $userAnswer->getQuestion()->getId());
        $stm->bindValue('userRightAnswer', $userAnswer->getUserRightAnswer());
        $stm->bindValue('chosenAnswer', $userAnswer->getChosenAnswer());
        
        $stm->execute();
        $userAnswer->setId($conn->lastInsertId());
    }

    public function update(UserAnswer $userAnswer){
        $conn = Connection::getConn();

        $sql = "UPDATE UserAnswer SET idExamModule = :idExamModule, idQuestion = :idQuestion, chosenAnswer=:chosenAnswer,
            userRightAnswer = :userRightAnswer WHERE id = :id";

        $stm = $conn->prepare($sql);

        $idExamModule = (gettype($userAnswer->getExamModule())!='integer')? $userAnswer->getExamModule()->getId() : $userAnswer->getExamModule();

        $stm->bindValue('idExamModule', $idExamModule) ;
        $stm->bindValue('idQuestion', $userAnswer->getQuestion()->getId());
        $stm->bindValue('chosenAnswer', $userAnswer->getChosenAnswer());
        $stm->bindValue('userRightAnswer', $userAnswer->getUserRightAnswer());
        $stm->bindValue('id', $userAnswer->getId());
        $stm->execute();
    }

    public function delete(UserAnswer $userAnwer){
        $conn = Connection::getConn();
        $sql = "DELETE FROM UserAnswer WHERE id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$userAnwer->getId()]);
    }
}

?>