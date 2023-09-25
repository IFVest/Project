<?php

require_once(__DIR__ . "/../model/Lesson.php");
require_once(__DIR__ . "/../dao/LessonDAO.php");
require_once(__DIR__ . "/../dao/ModuleDAO.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../service/LessonService.php");


class LessonController extends Controller{

    private LessonDAO $lessonDao;
    private ModuleDAO $moduleDao;
    private LessonService $lessonService;

    public function __construct()
    {
        $this->lessonDao = new LessonDAO();
        $this->moduleDao = new ModuleDAO();
        $this->lessonService = new LessonService();
        $this->setActionDefault("list");
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

    protected function create($dados = [], $errorMsgs = "")
    {
        $this->loadView("lesson/create_lesson.php", $dados, $errorMsgs);
    }

    protected function save()
    {

        $dados["id"] = isset($_POST["lesson_id"]) ? $_POST["lesson_id"] : NULL;
        $lesson_title = isset($_POST["lesson_title"]) ? $_POST["lesson_title"] : NULL;
        $lesson_url = isset($_POST["lesson_url"]) ? $_POST["lesson_url"] : NULL;
        $moduleId = isset($_POST["lesson_modules"]) ? $_POST["lesson_modules"] : NULL;
        $lesson_description = $_POST['lesson_description'] ?? NULL;
        
        $lesson = new Lesson();
        $lesson->setId($dados["id"]);
        $lesson->setTitle($lesson_title);
        $lesson->setDescription($lesson_description);
        $lesson->setUrl($lesson_url);
        $lesson->setModule($moduleId);
        
        $errors = $this->lessonService->validateData($lesson);

        if (empty($errors)) {
            try{
                if ($dados["id"] == NULL) {
                    $this->lessonDao->insert($lesson);
                } else {
                    $this->lessonDao->update($lesson);
                }

                $this->list();
                exit;
            }
            catch (PDOException $e) {
                array_push($errors, "Erro ao salvar aula no banco de dados");
            }
        }


        $dados["lesson"] = $lesson;
        $errorMsgs = implode("<br>", $errors);
        $this->create($dados, $errorMsgs);
    }

    public function list()
    {
        $dados["lista"] = $this->lessonDao->list();
        $i = 0;
        foreach($dados["lista"] as $lesson):
            $lessonModule = $this->moduleDao->findById($lesson->getModule());
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

    protected function findByLessonId($id) {
        return $this->lessonService->findByLessonId($id);
    }

    protected function findLessonsByModuleId() {
        $moduleId = $_GET["moduleId"];
        echo $this->lessonService->findLessonsByModuleId($moduleId);
    }
}

$les = new LessonController();
?>