<?php

require_once(__DIR__ . "/../dao/ExamDAO.php");
require_once(__DIR__ . "/Controller.php");

class StudyPlanController extends Controller{

    private ExamDAO $examDao;

    public function __construct(){
        $this->examDao = new ExamDAO();
        $this->setActionDefault("listByExam");
        $this->handleAction();
    }

    protected function listByExam(){
        $examId = $_GET['idExam'];
        $exam = $this->examDao->findById($examId);
        $dados['studyPlans'] = $exam->getStudyPlans();

        $this->loadView("studyPlan/viewStudyPlan.php", $dados);

    }
}

$st = new StudyPlanController();
