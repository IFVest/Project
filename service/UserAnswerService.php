<?php

require_once(__DIR__ . "/../model/UserAnswer.php");
require_once(__DIR__ . "/../dao/UserAnswerDAO.php");

class UserAnswerService {
    private UserAnswerDAO $userAnswerDao; 

    function __construct(){
        $this->userAnswerDao = new UserAnswerDAO();
    }
    // TODO Rever semântica -> definir função ao QuestionService?
    public function handleRandomQuestions(Module $module, int $numberQuestions) {
        $userAnswers = [];
        $questionsByModule = $module->getQuestions();
        if(count($questionsByModule) < $numberQuestions){
            $numberQuestions = count($questionsByModule);
        }
        for($j = 0; $j<$numberQuestions; $j++){
            $questPos = rand(1, count($questionsByModule)) - 1;
            $question = $questionsByModule[$questPos];

            if($this->notRepeat($userAnswers, $question)){
                $userAnswer = new UserAnswer();
                $userAnswer->setChosenAnswer(null);
                $userAnswer->setUserRightAnswer(false);
                $userAnswer->setQuestion($question);
                array_push($userAnswers, $userAnswer);
            }else{
                $j--;
            }
        }

        return $userAnswers;
    }

    private function notRepeat($userAnswers, $newQuestion){
        $result = true;
        foreach($userAnswers as $userAnswer){
            if($userAnswer->getQuestion() == $newQuestion){
                $result = false;
            }
        }
        return $result;
    }

    function insertArray(Array $userAnswers){
        foreach($userAnswers as $userAnswer):
            $this->userAnswerDao->insert($userAnswer);
        endforeach;
    }
}
?>