<?php

require_once(__DIR__ . "/../dao/StudyPlanDAO.php");
require_once(__DIR__ . "/../dao/ExamDAO.php");
require_once(__DIR__ . "/../model/SuggestedModule.php");
require_once(__DIR__ . "/../dao/SuggestedModuleDAO.php");
require_once(__DIR__ . "/../model/StudyPlan.php");
require_once(__DIR__ . "/../model/Exam.php");
require_once(__DIR__ . "/../connection/Connection.php");


class StudyPlanService{
    private StudyPlanDAO $studyPlanDao;
    private SuggestedModuleDAO $suggestedModuleDao;

    function __construct(){
        $this->studyPlanDao = new StudyPlanDAO();
        $this->suggestedModuleDao = new SuggestedModuleDAO();
    }

    public function createStudyPlans(Exam $exam){
        $suggestedModules = [];
        foreach($exam->getExamModules() as $exMod){
            if($exMod->getIsProblem()){
                $suggestedModule = new SuggestedModule();
                $suggestedModule->setModule($exMod->getModule());
                array_push($suggestedModules, $suggestedModule);
            }
        };

        usort($suggestedModules, function($a, $b){
            return strcmp($a->getModule()->getDifficulty(), $b->getModule()->getDifficulty());
        });

        $weeks = array_chunk($suggestedModules, 5);
        $studyPlans = [];
        foreach($weeks as $week){
            $studyPlan = new StudyPlan();
            $studyPlan->setExam($exam);
            
            $text = $this->createMark($week);
            
            $studyPlan->setMarker('Semana Dificuldade '.$text);
            $studyPlan = $this->studyPlanDao->insert($studyPlan);
            
            $suggestedModules = [];
            foreach($week as $suggestedModule){
                echo $suggestedModule->getModule()->getId();
                $suggestedModule->setStudyPlan($studyPlan);
                $this->suggestedModuleDao->insert($suggestedModule);
                array_push($suggestedModules, $suggestedModule);
            }
            $studyPlan->setSuggestedModules($suggestedModules);
            array_push($studyPlans, $studyPlan);
        }

        return $studyPlans;
    }

    private function createMark($week){
        $firstDiff = $this->getDifficultyFromSug($week[0]);
        $lastDiff = $this->getDifficultyFromSug($week[count($week)-1]);
        return ($lastDiff > $firstDiff)? $firstDiff.'->'.$lastDiff : $firstDiff;
    }

    private function getDifficultyFromSug($suggestedModule){
        return intval($suggestedModule->getModule()->getDifficulty());
    }
} 