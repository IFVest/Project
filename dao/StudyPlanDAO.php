<?php

require_once(__DIR__ . "/../connection/Connection.php");
require_once(__DIR__ . "/../model/StudyPlan.php");
require_once(__DIR__ . "/../dao/ExamDAO.php");
require_once(__DIR__ . "/../dao/SuggestedModuleDAO.php");

class StudyPlanDAO{

    private function mapStudyPlan($sql){
        $studyPlans = array();
        $suggestedModuleDao = new SuggestedModuleDAO();

        foreach($sql as $sp){
          $studyPlan = new StudyPlan();
          $studyPlan->setId($sp["id"]);
          $studyPlan->setMarker($sp["marker"]);
          $studyPlan->setExam($sp["exam"]);

          $suggestedModules = $suggestedModuleDao->findByStudyPlan($studyPlan);
          $studyPlan->setSuggestedModules($suggestedModules);

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

        $sql = "INSERT INTO StudyPlan (idExam, marker) VALUES (:e, :m)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('m', $studyPlan->getMarker());
        $stm->bindValue('e', $studyPlan->getExam());

        $stm->execute();
        $studyPlan->setId($conn->lastInsertId());
        return $studyPlan;
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

    public function delete(StudyPlan $studyPlan){
        $conn = Connection::getConn();

        $sql = "DELETE FROM StudyPlan WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$studyPlan->getId()]);
    }
}
?>