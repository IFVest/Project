<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/StudyWeek.php");
require_once(__DIR__ . "/../dao/WeekDAO.php");
require_once(__DIR__ . "/../service/LessonService.php");
require_once(__DIR__ . "/../service/WeekService.php");

class WeekController extends Controller
{
    private WeekDAO $weekDao;
    private LessonService $lessonService;
    private WeekService $weekService;

    public function __construct()
    {
        $this->weekDao = new WeekDAO();
        $this->lessonService = new LessonService();
        $this->weekService = new WeekService();
        $this->setActionDefault("list");
        $this->handleAction();
    }

    protected function create($dados = [], $errorMsgs = "")
    {
        $this->loadView("week/create_week.php", $dados, $errorMsgs);
    }

    protected function list()
    {
        $dados["lista"] = $this->weekDao->list();
        $this->loadView("week/list_weeks.php", $dados);
    }

    protected function save()
    {
        $dados["id"] = isset($_POST["week_id"]) ? $_POST["week_id"] : NULL;
        $marker = isset($_POST["week_marker"]) ? $_POST["week_marker"] : NULL;
        $week_lessons = isset($_POST["week_lessons"]) ? $_POST["week_lessons"] : NULL;

        $week = new StudyWeek();
        $week->setId($dados["id"]);
        $week->setMarker($marker);
        
        # Pegando as aulas escolhidas pelo seu id
        if (!empty($week_lessons)) {
            $lessons = [];
            foreach ($week_lessons as $lessonId) :
                $lesson = $this->lessonService->findByLessonId($lessonId);
                array_push($lessons, $lesson);
            endforeach;

            $week->setLessons($lessons);
        }
        
        $errors = $this->weekService->validateData($week);
        if (empty($errors)) {
            try {
                if ($dados["id"] == NULL) {
                    $this->weekDao->insert($week);
                } else {
                    // Comparar semana antiga com nova para saber se uma aula foi retirada dela
                    $oldWeekLessons = $this->lessonService->findLessonsByWeekId($dados["id"]);
                    echo "<script>console.log('aaaa')</script>";
                    $isInList = false;
                    foreach ($oldWeekLessons as $oldLesson) {
                        foreach($week->getLessons() as $newLesson) {
                            if ($oldLesson->getId() == $newLesson->getId()) {
                                $isInList = true;
                            }
                        }
                        
                        if (!$isInList) {
                            $oldLesson->setStudyWeek(null);
                            $this->lessonService->updateLessonStudyWeek($oldLesson);
                        }
                    }

                    $this->weekDao->update($week);
                }

                $this->list();
                exit;
            } catch (PDOException $e) {
                $errors = "Erro ao salvar semana no banco de dados";
            }
        }
        
        $dados["week"] = $week;
        $errorMsgs = implode("<br>", $errors);
        $this->create($dados, $errorMsgs);
    }

    protected function findById(){
        if (isset($_GET["id"])){
            $weekId = $_GET["id"];
            $week = $this->weekDao->findById($weekId);
            return $week;
        }
    }

    protected function edit(){
        $week = $this->findById();

        if ($week) {
            $dados["id"] = $week->getId();
            $dados["week"] = $week;

            $this->loadView("week/create_week.php", $dados);
        } 
        else {
            $this->list();
        }

    }

    protected function delete() {
        $week = $this->findById();

        if ($week) {
            $this->weekDao->delete($week);
        }

        $this->list();
    }
}

$wk = new WeekController();