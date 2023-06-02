<?php

require_once(__DIR__ . "/../model/StudyWeek.php");
require_once(__DIR__ . "/../connection/Connection.php");
require_once(__DIR__ . "/../service/LessonService.php");

class WeekDAO
{
    private LessonService $lessonService;
    public function __construct(){
        $this->lessonService = new LessonService();
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
}