<?php

require_once(__DIR__ . "/../model/Lesson.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/LessonDAO.php");

class LessonController extends Controller{

    private LessonDAO $lessonDao;

    public function __construct()
    {
        $this->lessonDao = new LessonDAO();
        $this->handleAction();
    }

    public function save()
    {
        $dados["id"] = isset($_POST["lesson_id"]) ? $_POST["lesson_id"] : NULL;
        $lesson_title = isset($_POST["lesson_title"]) ? $_POST["lesson_title"] : NULL;
        $lesson_desc = isset($_POST["lesson_desc"]) ? $_POST["lesson_desc"] : NULL;
        $lesson_url = isset($_POST["lesson_url"]) ? $_POST["lesson_url"] : NULL;
        $moduleId = isset($_POST["lesson_module"]) ? $_POST["lesson_module"] : NULL;

        $lesson = new Lesson();
        $lesson->setTitle($lesson_title);
        $lesson->setDescription($lesson_desc);
        $lesson->setUrl($lesson_url);

        if ($dados["id"] == NULL)
        {
            //$this->lessonDao->insert();
        }

        $this->loadView("lesson/create_lesson.php", []);
    }
}
?>