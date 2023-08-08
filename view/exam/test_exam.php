<?php
    include(__DIR__ . "/../componentes/sideBar.php");
    require_once(__DIR__ . "/../../util/config.php");
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
    <div class="container cd-12 d-flex flex-column align-items-center justify-content-center">
        <h1 class="mt-3">Simulado</h1>
        <form method="POST" action="<?= BASE_URL ?>/controller/ExamController.php?action=makeReport">
            <?php
            $alternatives = ['a', 'b', 'c', 'd', 'e'];
            $exam = $dados['prova'];
            $examModules = $exam->getExamModules();
            $questionCount = 1;
            $alternativeCounter = 0;
            ?>
            <div class="<?= $exam->getId()?>">
            <?php foreach($examModules as $exMod):?>

                <div class="<?= $exMod->getId(); ?>">
                    <?php foreach($exMod->getUserAnswers() as $userAnswer):?>
                        <div class="question container justify-content-center align-items-center d-flex flex-column bg-dark rounded mt-3 p-5" style="--bs-bg-opacity: .16;">
                            <div class="p-3 mb-4 col-12 align-items-center d-flex">
                                <div class="d-flex align-items-center justify-content-center m-2 col-1" style="height: 34px; width: 34px; border: 3px solid white; border-radius: 50%">
                                    <span><?= $questionCount; ?></span>
                                </div>
                                <span class="col-11"><?= $userAnswer->getQuestion()->getText(); ?></span>
                            </div>
                            <div class="col-12 d-flex flex-column align-items-center justify-center">
                                <?php foreach($userAnswer->getQuestion()->getAlternatives() as $alt): ?>
                                    <input <?= ($exam->getFinished() && !$alt->getIsCorrect())? 'disabled' : '' ;?> autocomplete="off" type="radio" class="btn-check" name="<?= $userAnswer->getId();?>" value="<?= $alt->getId();?>"  id="<?= $alt->getId();?>" <?= ($userAnswer->getChosenAnswer() == $alt->getId())? 'checked' : '' ?> autocomplete="off">
                                    <label class="btn d-flex col-10 align-items-start
                                            <?= ($exam->getFinished() && $alt->getIsCorrect())? 'btn-success' : '' ;?>
                                            <?= ($exam->getFinished() && !$alt->getIsCorrect() && $userAnswer->getChosenAnswer()==$alt->getId())? 'btn-danger' : '' ;?> "
                                            for="<?= $alt->getId();?>">
                                        <?= $alternatives[$alternativeCounter].')  '. $alt->getText();?>
                                    </label>
                                    <?php $alternativeCounter++; ?>
                                <?php endforeach; $questionCount += 1; ?>
                            </div>
                        </div>
                    <?php
                    $alternativeCounter = 0;
                    endforeach;?>
                </div>
            <?php endforeach; ?>

            <input type="hidden" name="id" value="<?= $exam->getId()?>">

            <button class="btn btn-primary" type="submit" <?= ($exam->getFinished())? 'disabled' : '' ;?>>
                <?= ($exam->getFinished())? 'FINALIZADO' : 'FINALIZAR' ;?>
            </button>
            </div>
        </form>
    </div>
    <script src="<?= BASE_URL ?>/view/exam/answerExamScript.js"></script>
</body>
</html>