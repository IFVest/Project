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
    <form method="POST" action="<?= BASE_URL ?>/controller/ExamController.php?action=makeReport">
        <?php

        $exam = $dados['prova'];
        $examModules = $exam->getExamModules();
        $questionCount = 1;
        foreach($examModules as $exMod):?>
            <div class="<?= $exMod->getId(); ?>">
                <?php foreach($exMod->getUserAnswers() as $userAnswer):?>
                        <span><?= $questionCount.') '.$userAnswer->getQuestion()->getText(); ?></span>
                        <br>
                        <?php foreach($userAnswer->getQuestion()->getAlternatives() as $alt): ?>
                            <input type="radio" name="<?= $userAnswer->getId();?>" value="<?= $alt->getId();?>" <?= ($userAnswer->getChosenAnswer() == $alt->getId())? 'checked' : '' ?>>
                            <span> <?= $alt->getText();?></span>
                            <br>
                        <?php endforeach; ?>
                        <br><br>
                        <?php $questionCount += 1; ?>
                <?php
                endforeach;?>
            </div>
        <?php endforeach; ?>
        <input type="hidden" name="id" value="<?= $exam->getId()?>">

        <button type="submit">FINALIZAR</button>
    </form>
    <script src="<?= BASE_URL ?>/view/exam/answerExamScript.js"></script>
</body>
</html>