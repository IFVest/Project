<?php

require_once(__DIR__ . "/../connection/Connection.php");
require_once(__DIR__ . "/../model/Lesson.php");

class LessonDAO{

    private function mapLessons($sql)
    {
        $lessons = array();

        foreach($sql as $les)
        {
            $lesson = new Lesson();
            $lesson->setId($les["id"]);
            $lesson->setTitle($les["title"]);
            $lesson->setUrl($les["videoURL"]);
            $lesson->setModule($les["idModule"]);

            array_push($lessons, $lesson);
        }

        return $lessons;
    }

    public function findById(int $lessonId)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Lesson WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$lessonId]);
        $result = $stm->fetchAll();

        $lessons = $this->mapLessons($result);

        return $lessons[0];
    }

    public function insert(Lesson $lesson)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO Lesson (title, videoURL, idModule) VALUES (:t, :u, :m)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('t', $lesson->getTitle());
        $stm->bindValue('u', $lesson->getUrl());
        $stm->bindValue('m', $lesson->getModule());
        $stm->execute();
    }

    public function list()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Lesson";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapLessons($result);
    }

    public function update(Lesson $lesson)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE Lesson SET title = ?, videoURL = ?, idModule = ? WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$lesson->getTitle(), $lesson->getUrl(), 
                        $lesson->getModule(), $lesson->getId()]);
    }

    public function delete(Lesson $lesson)
    {
        $conn = Connection::getConn();

        $sql = "DELETE FROM Lesson WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$lesson->getId()]);
    }

    public function findByModuleId($moduleId)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Lesson WHERE idModule = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$moduleId]);
        $result = $stm->fetchAll();

        return $this->mapLessons($result);
    }

    public function findByWeekId($weekId) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Lesson WHERE idStudyWeek = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$weekId]);
        $result = $stm->fetchAll();

        return $this->mapLessons($result);
    }

    public function updateLessonStudyWeek(Lesson $lesson) {
        $conn = Connection::getConn();

        $sql = "UPDATE Lesson SET idStudyWeek = ? WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$lesson->getStudyWeek(), $lesson->getId()]);
    }
}
?>