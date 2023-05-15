<?php

require_once(__DIR__ . "/../model/Question.php");
require_once(__DIR__ . "/../dao/AlternativeDAO.php");
require_once(__DIR__ . "/../service/AlternativeService.php");
require_once(__DIR__ . "/../connection/Connection.php");

class QuestionDAO{
    
    private AlternativeService $alternativeService;
    private AlternativeDAO $alternativeDao;

    function __construct(){
        $this->alternativeService = new AlternativeService();
        $this->alternativeDao = new AlternativeDAO();
    }

    private function mapQuestions($sql){
        $questions = array();

        foreach($sql as $quest){
            $question = new Question();
            $question->setId($quest['id']);
            $question->setText($quest['text']);
            $question->setmodule($quest['idModule']);

            $alternatives = $this->alternativeDao->findByQuestion($question);
            $question->setAlternatives($alternatives);

            array_push($questions, $question);
        }

        return $questions;
    }

    public function findById(int $id){
        $conn = Connection::getConn();
        $sql = "SELECT * FROM Question q WHERE q.id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $questions = $this->mapQuestions($result);

        return $questions[0];
    }

    public function list(){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Question";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapQuestions($result);
    }

    public function insert(Question $question, Array $alternatives){
        $conn = Connection::getConn();

        $sql = "INSERT INTO Question (text, idModule) VALUES (:text,:module)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('text', $question->getText());
        $stm->bindValue('module', $question->getModule()->getId());

        $stm->execute();
        //Pegando o último ID inserido, no caso a questão no situação. 

        $question->setId($conn->lastInsertId());
        $this->alternativeService->insertArray($alternatives); 
    }

    public function update(Question $question, Array $alternatives){
        $conn = Connection::getConn();

        $sql = "UPDATE Question SET text = :text, idModule = :module WHERE id = :id";

        $stm = $conn->prepare($sql);

        $stm->bindValue('text', $question->getText());
        $stm->bindValue('module', $question->getModule()->getId());
        $stm->bindValue('id', $question->getId());
        $stm->execute();

        $this->alternativeService->updateArray($alternatives, $question);
    }

    public function delete(Question $question){
        $conn = Connection::getConn();
        $sql = "DELETE FROM Question WHERE id = ?";
        $stm = $conn->prepare($sql);

        $this->alternativeDao->deleteByQuestion($question);

        $stm->execute([$question->getId()]);
    }
}

?>