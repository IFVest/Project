<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/StudyWeek.php");
require_once(__DIR__ . "/../dao/WeekDAO.php");

class WeekController extends Controller
{
    private WeekDAO $weekDao;

    public function __construct()
    {
        $weekDao = new WeekDAO();
        $this->handleAction();
    }

    protected function save()
    {
        
    }
}

$wk = new WeekController();