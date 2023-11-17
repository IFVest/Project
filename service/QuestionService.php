<?php

require_once(__DIR__ . "/../model/Question.php");
require_once(__DIR__ . "/../dao/QuestionDAO.php");


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

    public function findRandomly($questions_num, $subjectName=null, $module=null){
        $questionDao = new QuestionDAO();

        $questions_num = intval($questions_num);
        $totalQuestions = [];
        if($module){
            $totalQuestions = $questionDao->findByModule($module);
        }else if($subjectName){
            $totalQuestions = $questionDao->findBySubject($subjectName);
        }

        if(count($totalQuestions) == 1){
            return $totalQuestions;
        }else if($totalQuestions){
            $filter = ($questions_num >= $totalQuestions)? $totalQuestions : $questions_num;
            return array_map(function($i) use($totalQuestions){return $totalQuestions[$i];},array_rand($totalQuestions, $filter));
        }else{ return []; }

    }
}
?>