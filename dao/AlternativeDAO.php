<?php
require_once(__DIR__ . "/../model/Alternative.php");
require_once(__DIR__ . "/../dao/QuestionDAO.php");
require_once(__DIR__ . "/../connection/Connection.php");

class AlternativeDAO{

    private function mapAlternatives($sql){
        $alternatives = array();
        foreach($sql as $alt){
            $alternative = new Alternative();
            $alternative->setId($alt['id']);
            $alternative->setText($alt['text']);
            $alternative->setIsCorrect($alt['isCorrect']);
            $alternative->setQuestion($alt['idQuestion']);

            array_push($alternatives, $alternative);
        }

        return $alternatives;
    }

    function deleteByQuestion(Question $question){
        $conn = Connection::getConn();

        $sql = "DELETE FROM Alternative WHERE idQuestion = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$question->getId()]);
    }

    public function findById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Alternative q WHERE q.id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $alternatives = $this->mapAlternatives($result);

        return $alternatives[0];
    }

    public function findByQuestion(Question $question){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Alternative a WHERE a.idQuestion = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$question->getId()]);
        $result = $stm->fetchAll();

        return $this->mapAlternatives($result);
    }

    public function list()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Question";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapAlternatives($result);
    }

    public function insert(Alternative $alternative)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO Alternative (text, isCorrect, idQuestion) VALUES (:text, :isCorrect, :question)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('text', $alternative->getText());
        $stm->bindValue('isCorrect', $alternative->getIsCorrect());
        $stm->bindValue('question', $alternative->getQuestion()->getId());

        $stm->execute();
    }

    public function update(Alternative $alternative)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE Alternative SET text = :text, isCorrect = :isCorrect, idQuestion = :question WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("text", $alternative->getText());
        $stm->bindValue("isCorrect", $alternative->getIsCorrect());
        $stm->bindValue("question", $alternative->getQuestion());
        $stm->bindValue("id", $alternative->getId());
        $stm->execute();
    }

    public function delete(Alternative $alternative){
        $conn = Connection::getConn();

        $sql = "DELETE FROM Alternative WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$alternative->getId()]);
    }
}

?>