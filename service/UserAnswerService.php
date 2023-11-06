<?php

require_once(__DIR__ . "/../model/UserAnswer.php");
require_once(__DIR__ . "/../dao/UserAnswerDAO.php");
require_once(__DIR__ . '/../util/config.php');

class UserAnswerService {
    private UserAnswerDAO $userAnswerDao; 

    function __construct(){
        $this->userAnswerDao = new UserAnswerDAO();
    }

    function insertArray(Array $userAnswers, ExamModule $examModule){
        foreach($userAnswers as $userAnswer):
            $userAnswer->setExamModule($examModule);
            $this->userAnswerDao->insert($userAnswer);
        endforeach;
    }

    public function parseQuestionsToUserAnswers(mixed $questionsByModule){
        $userAnswers = [];
        foreach ($questionsByModule as $question){
            $userAnswer = new UserAnswer();
            $userAnswer->setChosenAnswer(null);
            $userAnswer->setUserRightAnswer(_FALSE_);
            $userAnswer->setQuestion($question);
            array_push($userAnswers, $userAnswer);
        }

        return $userAnswers;
    }
}
?>