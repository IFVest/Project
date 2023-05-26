<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/StudyWeek.php");
require_once(__DIR__ . "/../dao/WeekDAO.php");

class WeekController extends Controller
{
    private WeekDAO $weekDao;

    public function __construct()
    {
        $this->weekDao = new WeekDAO();
        $this->handleAction();
    }

    protected function create($dados = [], $errorMsgs = "")
    {
        $this->loadView("week/create_week.php", $dados, $errorMsgs);
    }

    protected function save()
    {
        $dados["id"] = isset($_POST["week_id"]) ? $_POST["week_id"] : NULL;
        $marker = isset($_POST["week_marker"]) ? $_POST["week_marker"] : NULL;
        $lessons = isset($_POST["week_lessons"]) ? $_POST["week_lessons"] : NULL;
        
        $week = new StudyWeek();
        $week->setMarker($marker);

        if ($dados["id"] == NULL) {
            $this->weekDao->insert($week);
        }
        else {
            echo "<script>console.log('altera')</script>";

        }

    }
}

$wk = new WeekController();