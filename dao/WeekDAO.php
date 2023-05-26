<?php

require_once(__DIR__ . "/../model/StudyWeek.php");
require_once(__DIR__ . "/../connection/Connection.php");

class WeekDAO
{
    public function insert(StudyWeek $week) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO StudyWeek (marker) VALUES (?)";
        
        $stm = $conn->prepare($sql);
        $stm->execute([$week->getMarker()]);
    }
}