<?php

require_once(__DIR__ . "/../model/Question.php");

class QuestionService {

    public function validateData(Question $question) {
        $errors = array();

        if (!$question->getText()) {
            array_push($errors, "O campo ENUNCIADO é obrigatório");
        }

        $alternatives = $question->getAlternatives();
        $correctIsSelected = False;
        for($i=0; $i<=4; $i++){
            if($alternatives[$i]->getIsCorrect()){
                $correctIsSelected = True;
            }

            if($alternatives[$i]->getText()==''){
                array_push($errors, "O campo ALTERNATIVA ".($i+1)." é obrigatório");
            }
        }

        if(! $correctIsSelected){
            array_push($errors, "O campo QUESTÃO CORRETA é obrigatório");
        }


        return $errors;
    }
}
?>