<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../util/config.php");

class ExamTestCreator
{
    static public function mapTest($exam, $examModules){
          $alternatives = ['a', 'b', 'c', 'd', 'e'];
          $questionCount = 1;
          $alternativeCounter = 0;

          foreach($examModules as $exMod){
              echo '<div class="<?= $exMod->getId(); ?> m-5">';
              foreach($exMod->getUserAnswers() as $userAnswer){
                    $colorCircle = 'white';
                    if($exam->getFinished()){
                        $colorCircle = ($userAnswer->getUserRightAnswer())? 'green' : 'red';
                    }
                    echo '<div class="question container justify-content-center align-items-center d-flex flex-column bg-dark rounded mt-5 p-5" style="--bs-bg-opacity: .16;">';
                    echo '
                    <div class="p-3 mb-4 col-12 align-items-center d-flex">
                        <div class="d-flex align-items-center justify-content-center m-2 col-1" style="height: 34px; width: 34px; border: 3px solid '.$colorCircle.'; border-radius: 50%;">
                            <span>'.$questionCount.'</span>
                        </div>
                        <span class="col-11">'.$userAnswer->getQuestion()->getText().'</span>
                    </div>';
                    echo '<div class="col-12 d-flex flex-column align-items-center justify-center">';
                    foreach($userAnswer->getQuestion()->getAlternatives() as $alt){
                              echo ' <input '; 
                              echo ($exam->getFinished() && !$alt->getIsCorrect())? 'disabled' : ""; 
                              echo ' type="radio" class="btn-check" name="'.$userAnswer->getId().'" value="'.$alt->getId().'" id="'.$alt->getId().'"';
                              echo ($userAnswer->getChosenAnswer() == $alt->getId())? 'checked' : "";
                              echo ' >';
                              echo '<label class="btn d-flex col-10 flex-direction-line ';
                              echo ($exam->getFinished() && $alt->getIsCorrect())? 'btn-success' : "";
                              echo ($exam->getFinished() && !$alt->getIsCorrect() && $userAnswer->getChosenAnswer() == $alt->getId())? 'btn-danger' : '';
                              echo ' "for="'.$alt->getId().'">
                                        '.$alternatives[$alternativeCounter].')  '. $alt->getText().'
                              </label>';
                              $alternativeCounter++;
                    }
                    $questionCount += 1;
                    echo '</div> </div>';
                    $alternativeCounter = 0;
              }
              echo '</div>';
          }

    }
}

