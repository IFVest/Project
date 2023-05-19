<?php

require_once(__DIR__ . "/../model/Lesson.php");

class LessonService {

    public function validarDados(Lesson $lesson) {
        $errors = array();

        if (! $lesson->getTitle()) {
            array_push($errors, "O campo TÍTULO é obrigatório");
        }
        if (! $lesson->getUrl()) {
            array_push($errors, "O campo URL é obrigatório");
        }

        return $errors;
    }
}
?>