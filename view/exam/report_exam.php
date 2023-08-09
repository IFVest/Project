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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"
</head>
<body class="row">
    <div>
        <h1 class="m-4 mt-6">Relatório da Prova</h1>
    </div>
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>