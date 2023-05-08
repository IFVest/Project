<?php

require_once(__DIR__ . "/../model/Lesson.php");
require_once(__DIR__ . "/../dao/LessonDAO.php");
require_once(__DIR__ . "/../dao/ModuleDAO.php");
require_once(__DIR__ . "/Controller.php");

class LessonController extends Controller{

    private LessonDAO $lessonDao;
    private ModuleDAO $moduleDao;

    public function __construct()
    {
        $this->lessonDao = new LessonDAO();
        $this->moduleDao = new ModuleDAO();
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

    protected function create()
    {
        $this->loadView("lesson/create_lesson.php", []);
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
            $this->lessonDao->insert($lesson);       
        }
        else
        {
            $this->lessonDao->update($lesson);
        }

        $this->list();
    }

    public function list()
    {
        $dados["lista"] = $this->lessonDao->list();
        $i = 0;
        foreach($dados["lista"] as $lesson):
            $lessonModule = $this->findModuleById($lesson->getModule());
            $moduleName = $lessonModule->getName();
            $dados["lista"][$i]->setModuleName($moduleName);
            $i++;
        endforeach;

        $this->loadView("lesson/list_lessons.php", $dados);
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
            $this->list();
        }
    }

    protected function delete()
    {
        $lesson = $this->findById();

        if ($lesson)
        {
            $this->lessonDao->delete($lesson);
        }
        
        $this->list();
    }

    public function findModulesBySubject()
    {
        $subject = $_GET["subject"];
        $modules = $this->moduleDao->findBySubject($subject);
        $modulesJSON = json_encode($modules);
        echo $modulesJSON;
    }

    public function findModuleById($id) 
    {
        return $this->moduleDao->findById($id);
    }

    public function test()
    {
        return 'test';
    }

}

$les = new LessonController();
?>