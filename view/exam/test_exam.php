<?php
require_once(__DIR__ . "/../../controller/ExamController.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulado</title>
</head>
<body>
    <h1>Simulado</h1>
    <?php 
    $examModules = $dados['prova']->getExamModules();

    foreach($examModules as $exMod):
        foreach($exMod->getUserAnswers() as $userAnswer):
            echo $userAnswer->getQuestion()->getText();
            echo "<br>";
            foreach($userAnswer->getQuestion()->getAlternatives() as $alt){
                echo '<input type="radio" name="'.$userAnswer->getQuestion()->getId().'" value="'.$alt->getId().'">';
                echo $alt->getText();
                echo '<br>';
            }
            echo '<br><br>';
        endforeach;
    endforeach;
    ?>
</body>
</html>