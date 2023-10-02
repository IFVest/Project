<?php

require_once(__DIR__ . "/../connection/Connection.php");
require_once(__DIR__ . "/../model/StudyPlan.php");
require_once(__DIR__ . "/../dao/ExamDAO.php");

class StudyPlanDAO{

    private function mapStudyPlan($sql){
        $studyPlans = array();

        foreach($sql as $sp){
          $studyPlan = new StudyPlan();
          $studyPlan->setId($sp["id"]);
          $studyPlan->setUser($sp["user"]);
          $studyPlan->setExam($sp["exam"]);

          array_push($studyPlans, $studyPlan);
        }

        return $studyPlans;
    }

    public function findById(int $studyPlanId){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM StudyPlan WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$studyPlanId]);
        $result = $stm->fetchAll();

        $studyPlans = $this->mapStudyPlan($result);

        return $studyPlans[0];
    }

    public function insert(StudyPlan $studyPlan)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO StudyPlan (idUser, idExam) VALUES (:u, :e)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('u', $studyPlan->getUser());
        $stm->bindValue('e', $studyPlan->getExam());

        $stm->execute();
    }

    public function list()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM StudyPlan";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapStudyPlan($result);
    }

    public function delete(Lesson $lesson){
        $conn = Connection::getConn();

        $sql = "DELETE FROM Lesson WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$lesson->getId()]);
    }
}
?>