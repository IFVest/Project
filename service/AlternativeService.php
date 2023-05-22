<?php
require_once(__DIR__ . "/../dao/AlternativeDAO.php");
require_once(__DIR__ . "/../model/Alternative.php");


class AlternativeService{
    private AlternativeDAO $alternativeDAO;
    
    function __construct(){
        $this->alternativeDAO = new AlternativeDAO();
    }

    function insertArray(Array $alternatives){
        foreach($alternatives as $alt):
            $this->alternativeDAO->insert($alt);
        endforeach;
    } 

    function updateAlternativesQuestion(Question $question){
        $alternativesByQuestion = $this->alternativeDAO->findByQuestion($question);
        $newAlternatives = $question->getAlternatives();
        for($i = 0; $i<=4; $i++){
            $alternativesByQuestion[$i]->setText($newAlternatives[$i]->getText());
            $alternativesByQuestion[$i]->setIsCorrect($newAlternatives[$i]->getIsCorrect());

            $this->alternativeDAO->update($alternativesByQuestion[$i]);
        }
    }
} 