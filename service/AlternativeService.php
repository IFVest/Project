<?php
require_once(__DIR__ . "/../dao/AlternativeDAO.php");
require_once(__DIR__ . "/../model/Alternative.php");


class AlternativeService{
    private AlternativeDAO $alternativeDAO;
    
    function __construct(){
        $this->alternativeDAO = new AlternativeDAO();
    }

    function insertArray(Array $alternatives, Question $question){
        foreach($alternatives as $alt):
            $alternative = new Alternative();
            $alternative->setText($alt['text']);
            $alternative->setIsCorrect($alt['isCorrect']);
            $alternative->setQuestion($question);

            $alternativeDAO->insert($alternative);
        endforeach;
    } 

    function updateArray(Array $alternatives, int $idQuestion){
        $alternativesByQuestion = $this->getByQuestion($idQuestion);
        for($i = 0; $i<=4; $i++){
            $alternativesByQuestion[$i]->setText($alternatives[$i]['text']);
            $alternativesByQuestion[$i]->setIsCorrect($alternatives[$i]['isCorrect']);

            $alternativeDAO->update($alternativesByQuestion[$i]);
        }
    }

    function getByQuestion(int $id){
        return $alternativeDAO->getByQuestion($id);
    }

    function deleteByQuestion(int $id){
        $alternatives = $this->getByQuestion($id);
        foreach($alternatives as $alternative):
            $alternativeDAO->delete($alternative->getId());
        endforeach;
    }
} 