<?php

require_once(__DIR__ . "/../model/StudyWeek.php");
require_once(__DIR__ . "/../connection/Connection.php");
require_once(__DIR__ . "/../service/LessonService.php");
require_once(__DIR__ . "/LessonDAO.php");

class WeekDAO
{
    private LessonService $lessonService;
    private LessonDAO $lessonDao;

    public function __construct(){
        $this->lessonService = new LessonService();
        $this->lessonDao = new LessonDAO();
    }

    public function mapWeeks($result) {
        $weeks = array();
        foreach($result as $req):
            $week = new StudyWeek();
            $week->setId($req["id"]);
            $week->setMarker($req["marker"]);

            // Procurar aulas
            $lessons = $this->lessonDao->findByWeekId($week->getId());
            $week->setLessons($lessons);

            array_push($weeks, $week);
        endforeach;

        return $weeks;
    }

    public function list(){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM StudyWeek";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapWeeks($result);
    }

    public function insert(StudyWeek $week) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO StudyWeek (marker) VALUES (?)";
        
        $stm = $conn->prepare($sql);
        $stm->execute([$week->getMarker()]);

        # Inserindo o id da semana que acabou de ser criada nas aulas
        $currentWeekId = $conn->lastInsertId();
        foreach($week->getLessons() as $lesson):
            $lesson->setStudyWeek($currentWeekId);
            $this->lessonService->updateLessonStudyWeek($lesson);
        endforeach;
    }

<<<<<<< HEAD
=======
    public function update(StudyWeek $week) {
        $conn = Connection::getConn();

        $sql = "UPDATE StudyWeek SET marker = ? WHERE id = ?";
        
        $weekId = $week->getId();
        $stm = $conn->prepare($sql);
        $stm->execute([$week->getMarker(), $weekId]);

        // Alterando o id da semana nas aulas
        foreach ($week->getLessons() as $lesson) :
            $lesson->setStudyWeek($weekId);
            $this->lessonService->updateLessonStudyWeek($lesson);
        endforeach;

    }

>>>>>>> 8456543e7376c94c24e1e6bc88c40e1047742b76
    public function delete(StudyWeek $week) {
        $conn = Connection::getConn();

        $sql = "DELETE FROM StudyWeek WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$week->getId()]);
    }

    public function findById($weekId) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM StudyWeek WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$weekId]);
        $result = $stm->fetchAll();

        $weeks = $this->mapWeeks($result);
        return $weeks[0];
    }
}