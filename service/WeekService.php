<?php
    require_once(__DIR__ . "/../model/StudyWeek.php");

    class WeekService {
        public function validateData(StudyWeek $week) {
            $errors = array();

            if ($week->getMarker() == '') {
                array_push($errors, "O campo TÍTULO é obrigatório.");
            }

            return $errors;
        }
    }
?>