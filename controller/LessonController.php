<?php

require_once(__DIR__ . "/../model/Lesson.php");
require_once(__DIR__ . "/../dao/LessonDAO.php");
require_once(__DIR__ . "/Controller.php");

class LessonController extends Controller{

    private LessonDAO $lessonDao;

    public function __construct()
    {
        $this->lessonDao = new LessonDAO();
        $this->handleAction();
    }

    private function findById()
    {
        if (isset($_GET["id"]))
        {
            $lessonId = $_GET["id"];
            $lesson = $this->lessonDao->findById($lessonId);
            return $lesson;
        }
    }

    protected function save()
    {

        $dados["id"] = isset($_POST["lesson_id"]) ? $_POST["lesson_id"] : NULL;
        $lesson_title = isset($_POST["lesson_title"]) ? $_POST["lesson_title"] : NULL;
        $lesson_url = isset($_POST["lesson_url"]) ? $_POST["lesson_url"] : NULL;
        $moduleId = isset($_POST["lesson_module"]) ? $_POST["lesson_module"] : NULL;

        
        $lesson = new Lesson();
        $lesson->setId($dados["id"]);
        $lesson->setTitle($lesson_title);
        $lesson->setUrl($lesson_url);
        $lesson->setModule($moduleId);

         
        if ($dados["id"] == NULL)
        {
            echo "<script>console.log('".$lesson->getId()."')</script>";
            echo "<script>console.log('" . $lesson->getTitle() . "')</script>";
            echo "<script>console.log('" . $lesson->getUrl() . "')</script>";       
            $this->lessonDao->insert($lesson);
            echo "<script>console.log('".$lesson->getId()."')</script>";
            echo "<script>console.log('" . $lesson->getTitle() . "')</script>";
            echo "<script>console.log('" . $lesson->getUrl() . "')</script>";       
        }
        else
        {
            $this->lessonDao->update($lesson);
        }

        $this->loadView("lesson/list_lessons.php", []);
    }

    public function list()
    {
        return $this->lessonDao->list();
    }

    protected function edit()
    {
        $lesson = $this->findById();

        if ($lesson)
        {
            $dados["id"] = $lesson->getId();
            $dados["lesson"] = $lesson;

            $this->loadView("lesson/create_lesson.php", $dados);
        }
        else
        {
            echo "Aula não encontrada";
        }
    }

    protected function delete()
    {
        $lesson = $this->findById();

        if ($lesson)
        {
            $this->lessonDao->delete($lesson);

            $this->loadView("lesson/list_lessons.php", []);
        }
        else
        {
            echo "Aula não encontrada";
        }
    }
}

$les = new LessonController();
?>