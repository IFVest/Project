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
    <form method="POST" action="<?= BASE_URL ?>/controller/ModuleController.php?action=save"></form>
    <?php 
    $examModules = $dados['prova']->getExamModules();
    $questionCount = 1;
    foreach($examModules as $exMod):
        foreach($exMod->getUserAnswers() as $userAnswer):?>
            <div class="<?= $exMod->getId(); ?>">
                <span><?= $questionCount.') '.$userAnswer->getQuestion()->getText(); ?></span>
                <br>
                <?php foreach($userAnswer->getQuestion()->getAlternatives() as $alt): ?>
                    <input type="radio" name="<?= $userAnswer->getId();?>" value="<?= $alt->getId();?>">
                    <span> <?= $alt->getText();?></span>
                    <br>
                <?php endforeach; ?>
                <br><br>
                <?php $questionCount += 1; ?>
            </div>
        <?php 
        endforeach;
    endforeach;
    ?>
    
</body>
</html>