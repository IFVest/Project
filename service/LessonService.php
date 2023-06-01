<?php

require_once(__DIR__ . "/../model/Lesson.php");
require_once(__DIR__ . "/../dao/LessonDAO.php");
require_once(__DIR__ . "/../dao/ModuleDAO.php");

class LessonService {
    private $moduleDao;
    private $lessonDao;

    public function __construct()
    {
        $this->moduleDao = new ModuleDAO();
        $this->lessonDao = new LessonDAO();
    }

    public function validarDados(Lesson $lesson) {
        $errors = array();
        
        if (! $lesson->getTitle()) {
            array_push($errors, "O campo TÍTULO é obrigatório");
        }
        if (! $lesson->getUrl()) {
            array_push($errors, "O campo URL é obrigatório");
        }
        if ($lesson->getModule() == null) {
            array_push($errors, "Módulo inválido");
        }
        else 
        {
            $lesson_module = $this->moduleDao->findById($lesson->getModule());
            if ($lesson_module == null) {
                array_push($errors, "Módulo inválido");
            }
        }
        return $errors;
    }

    public function findById($id) {
        return $this->lessonDao->findById($id);
    }
}
?>