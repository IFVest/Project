<?php

require_once(__DIR__ . "/../model/StudyPlan.php");
require_once(__DIR__ . "/../dao/StudyPlanDAO.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../service/StudyPlanService.php");


class StudyPlanController extends Controller{

    private StudyPlanDAO $studyPlanDao;
    private StudyPlanService $studyPlanService;

    public function __construct()
    {
        $this->studyPlanDao = new StudyPlanDAO();
        $this->studyPlanService = new StudyPlanService();
        $this->setActionDefault("list");
        $this->handleAction();
    }

    private function findById()
    {
        if (isset($_GET["id"]))
        {
            $studyPlanId = $_GET["id"];
            $studyPlan = $this->studyPlanDao->findById($studyPlanId);
            return $studyPlan;
        }
    }

    protected function create($dados = [], $errorMsgs = "")
    {
        $this->loadView("studyPlan/viewStudy.php", $dados, $errorMsgs);
    }

    protected function save(){
        
    }

    public function list(){
        $dados["lista"] = $this->studyPlanDao->list();
        $this->loadView("studyPlan/viewStudyPlan.php", $dados);
    }

    protected function delete($studyPlanId){
        $studyPlan = $this->findById($studyPlanId);

        if ($studyPlan){
          $this->studyPlanDao->delete($studyPlan);
        }
        
        $this->list();
    }

}

$sp = new StudyPlanController();
?>