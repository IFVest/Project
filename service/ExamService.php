<?php
require_once(__DIR__ . "/../util/config.php");
require_once(__DIR__ . "/../dao/UserAnswerDAO.php");
require_once(__DIR__ . "/../dao/ExamModuleDAO.php");

class ExamService{
    private UserAnswerDAO $userAnswerDao;
    private ExamModuleDAO $examModuleDao;
    private $MINNIMUM_PORCENTAGE = 0.6;

    function __construct(){
        $this->userAnswerDao = new UserAnswerDAO();
        $this->examModuleDao = new ExamModuleDAO();
    }

    public function makeReport($exam){
        foreach($exam->getExamModules() as $examModule){
            $correctsCounter = 0;
            foreach($examModule->getUserAnswers() as $userAnswer) {
                $correct = $this->ifCorrect($userAnswer->getChosenAnswer(), $userAnswer->getQuestion());
                if ($correct) {
                    $userAnswer->setUserRightAnswer(_TRUE_);
                    $correctsCounter += 1;
                } else {
                    $userAnswer->setUserRightAnswer(_FALSE_);
                }
                $this->userAnswerDao->update($userAnswer);
            }
            $examModule->setCorrectQuestions($correctsCounter);
            $isProblem = $this->handleIsProblem($examModule);
            $examModule->setIsProblem($isProblem);
            $this->examModuleDao->update($examModule);
        }

        $this->makeStudyPlan($exam);
    }

    private function ifCorrect($chosenAnswer, $question){
        foreach ($question->getAlternatives() as $alt){
            if($alt->getIsCorrect()){
                return $chosenAnswer == $alt->getId();
            }
        }
        return false;
    }

    private function handleIsProblem($examModule){
        $performance = $examModule->getCorrectQuestions() / $examModule->getTotalQuestions();
        if($performance < $this->MINNIMUM_PORCENTAGE){
            return _TRUE_;
        }
        return _FALSE_;
    }

    private function makeStudyPlan($exam){
        
    }
}