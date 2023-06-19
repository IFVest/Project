<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/StudyWeek.php");
require_once(__DIR__ . "/../dao/WeekDAO.php");
require_once(__DIR__ . "/../service/LessonService.php");

class WeekController extends Controller
{
    private WeekDAO $weekDao;
    private LessonService $lessonService;

    public function __construct()
    {
        $this->weekDao = new WeekDAO();
        $this->lessonService = new LessonService();
        $this->handleAction();
    }

    protected function create($dados = [], $errorMsgs = "")
    {
        $this->loadView("week/create_week.php", $dados, $errorMsgs);
    }

    protected function list()
    {
        $this->loadView("week/list_weeks.php", []);
    }

    protected function save()
    {
        $dados["id"] = isset($_POST["week_id"]) ? $_POST["week_id"] : NULL;
        $marker = isset($_POST["week_marker"]) ? $_POST["week_marker"] : NULL;
        $week_lessons = isset($_POST["week_lessons"]) ? $_POST["week_lessons"] : NULL;

        $week = new StudyWeek();
        $week->setMarker($marker);
        
        # Pegando as aulas escolhidas pelo seu id
        $lessons = [];
        foreach ($week_lessons as $lessonId):
            $lesson = $this->lessonService->findByLessonId($lessonId);
            array_push($lessons, $lesson);
        endforeach;
        
        $week->setLessons($lessons);

        if ($dados["id"] == NULL) {
            $this->weekDao->insert($week);
        }
        else {
            echo "<script>console.log('altera')</script>";

        }

    }
}

$wk = new WeekController();