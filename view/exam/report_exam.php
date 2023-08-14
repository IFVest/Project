<?php
include(__DIR__ . "/../componentes/header.php");
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
<div class="p-5 row">
    <h1 class="m-4 mt-6">Relatório da Prova</h1>
    <div class="container d-flex align-items-center flex-wrap justify-content-center col-12">
        <?php

        $exam = $dados['prova'];
        $examModules = $exam->getExamModules();
        foreach($examModules as $exMod): ?>
            <div class="card <?= $exMod->getId()?> col-3 m-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $exMod->getModule()->getName() ?></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Total de questões: <?= $exMod->getTotalQuestions() ?></li>
                    <li class="list-group-item">Número de questões corretas: <?= $exMod->getCorrectQuestions() ?></li>
                    <li class="list-group-item">Desempenho: <?= round(($exMod->getCorrectQuestions()/ $exMod->getTotalQuestions())*100, 2) ?> %</li>
                </ul>
                <div class="card-body">
                    <button type="button" class="<?= ($exMod->getIsProblem())? 'btn btn-danger' :  'btn  btn-success'?>">Ver módulo</button>
                    <button type="button" class="questnios-analizes-btn">Analisar questões</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>