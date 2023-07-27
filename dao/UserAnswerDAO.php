<?php

require_once(__DIR__ . "/../model/UserAnswer.php");
require_once(__DIR__ . "/../dao/QuestionDAO.php");
require_once(__DIR__ . "/../connection/Connection.php");

class UserAnswerDAO{
    private QuestionDAO $questionDAO;

    function __construct(){
        $this->questionDAO = new QuestionDAO();
    }

    private function mapUserAnwers($sql){
        $userAnwers = array();

        foreach($sql as $usaw){
            $userAnwer = new UserAnwer();
            $userAnwer->setId($usaw['id']);
            $userAnwer->setChosenAnswer($usaw['chosenAnswer']);
            $userAnwer->setUserRightAnswer($usaw['userRightAnswer']);

            // $examModule = $this->examModuleDao->findById($usaw['idExamModule']);
            // $userAnwer->setExamModule($examModule);
            $userAnwer->setExamModule($usaw['idExamModule']);
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

    public function insert(UserAnswer $userAnwer){
        $conn = Connection::getConn();

        $sql = "INSERT INTO UserAnswer (idExamModule, idQuestion, chosenAnswer, userRightAnswer) VALUES 
            (:idExamModule, :idQuestion, :chosenAnswer, :userRightAnswer)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('idExamModule', $userAnwer->getExamModule()->getId());
        $stm->bindValue('idQuestion', $userAnwer->getQuestion()->getId());
        $stm->bindValue('chosenAnswer', $userAnwer->getChosenAnswer());
        $stm->bindValue('userRightAnswer', $userAnwer->getUserRightAnswer());

        $stm->execute();
        $userAnwer->setId($conn->lastInsertId());
    }

    public function update(UserAnswer $userAnwer){
        $conn = Connection::getConn();

        $sql = "UPDATE UserAnswer SET idExamModule = :idExamModule, idQuestion = :idQuestion, chosenAnswer=:chosenAnswer
            userRightAnswer = :userRightAnswer WHERE id = :id";

        $stm = $conn->prepare($sql);

        $stm->bindValue('idExamModule', $userAnwer->getExamModule()->getId());
        $stm->bindValue('idQuestion', $userAnwer->getQuestion()->getId());
        $stm->bindValue('chosenAnswer', $userAnwer->getChosenAnswer());
        $stm->bindValue('userRightAnswer', $userAnwer->getUserRightAnswer());
        $stm->bindValue('id', $userAnwer->getId());
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