<?php
require_once(__DIR__ . "/../model/Module.php");
require_once(__DIR__ . "/../connection/Connection.php");

class AlternativeDAO{

    private function mapAlternatives($sql)
    {
        $alternatives = array();

        foreach($sql as $alt){
            $alternative = new Module();
            $alternative->setId($mod['id']);
            $alternative->setText($mod['text']);
            $alternative->setQuestion($mod['question']);

            array_push($alternatives, $alternative);
        }

        return $alternatives;
    }

    public function findById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Question q WHERE q.id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $alternatives = $this->mapAlternatives($result);

        return $alternatives[0];
    }

    public function findByQuestion(int $id)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Question q WHERE q.idQuestion = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $alternatives = $this->mapAlternatives($result);

        return $alternatives;
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

        $sql = "INSERT INTO Question (text, isCorrect, idQuestion) VALUES (:text,:isCorrect,:question)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('text', $alternative->getText());
        $stm->bindValue('isCorrect', $alternative->getIsCorrect());
        $stm->bindValue('question', $alternative->getQuestion()->getId());

        $stm->execute();
    }

    public function update(Alternative $alternative)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE Question SET text = :text, isCorrect = :isCorrect, idQuestion = :question WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("text", $alternative->getText());
        $stm->bindValue("isCorrect", $alternative->getIsCorrect());
        $stm->bindValue("question", $alternative->getQuestion()->getId());
        $stm->bindValue("id", $alternative->getId());
        $stm->execute();
    }

    public function delete(Alternative $alternative){
        $conn = Connection::getConn();

        $sql = "DELETE FROM Question WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$alternative->getId()]);
    }
}

?>