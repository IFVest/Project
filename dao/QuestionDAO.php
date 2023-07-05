<?php

require_once(__DIR__ . "/../model/Question.php");
require_once(__DIR__ . "/../connection/Connection.php");

class ModuleDAO{

    private function mapQuestions($sql)
    {
        $questions = array();

        foreach($sql as $quest){
            $question = new Question();
            $question->setId($quest['id']);
            $question->setText($quest['text']);
            $question->setModule($quest['module']);

            array_push($questions, $question);
        }

        return $questions;
    }

    public function findById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Question q WHERE q.id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $questions = $this->mapQuestions($result);

        return $questions[0];
    }

    public function list()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Question";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapQuestions($result);
    }

    public function insert(Question $question)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO Question (text, module) VALUES (:text,:module)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('text', $question->getText());
        $stm->bindValue('module', $question->getModule());

        $stm->execute();
    }

    public function update(Question $question)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE Question SET text = :text, module = :module, subject = :sub WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue('text', $question->getText());
        $stm->bindValue('module', $question->getModule());
        $stm->bindValue("id", $question->getId());
        $stm->execute();
    }

    public function delete(Question $question)
    {
        $conn = Connection::getConn();

        $sql = "DELETE FROM Question WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$question->getId()]);
    }
}

?>