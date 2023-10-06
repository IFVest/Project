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

    public function createStudyPlan(Exam $exam){
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

        $weeks = array_chunk($suggestedModule, 5);

        foreach($weeks as $week){
            $studyPlan = new StudyPlan();
            $studyPlan->setExam($exam->getId());
            
            $lastDiff = $this->getDifficultyFromSug($week[0]);
            $firstDiff = $this->getDifficultyFromSug($week[count($week)-1]);
            $text = ($lastDiff > $firstDiff)? $firstDiff.'->'.$lastDiff : $firstDiff;
            
            $studyPlan->setMarker('Semana Dificuldade '.$text);
            $this->studyPlanDao->insert($studyPlan);

            foreach($week as $suggestedModule){
                $suggestedModule->setStudyPlan($studyPlan->getId());
                $this->suggestedModuleDao->insert($suggestedModule);
            }
        }

        return $suggestedModules;
    }

    private function getDifficultyFromSug($suggestedModule){
        return $suggestedModule->getModule()->getDifficulty();
    }
} 