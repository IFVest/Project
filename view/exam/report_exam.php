
<?php 
require (__DIR__. "/../componentes/header.php");
require_once(__DIR__ . "/../../controller/ExamController.php");

?>

    <!-- MAIN CONTENT-->
    <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
            <h1 class="content-title">Relatório da Prova</h1>
            
            <!-- MENUZINHO DE OPÇÕES-->
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">exportar</button>
                </div>
            </div>
        </div>

        <!-- <h5 class="content-subtitle">subtítulo</h5>
        <p class="content-subtitle-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> -->

        <?php

        $exam = $dados['prova'];
        $examModules = $exam->getExamModules();
        foreach($examModules as $exMod): ?>
            <div class="card <?= $exMod->getId()?>" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $exMod->getModule()->getName() ?></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Total de questões: <?= $exMod->getTotalQuestions() ?></li>
                    <li class="list-group-item">Número de questões corretas: <?= $exMod->getCorrectQuestions() ?></li>
                    <li class="list-group-item">Desempenho: <?= round(($exMod->getCorrectQuestions()/ $exMod->getTotalQuestions())*100, 2) ?> %</li>
                </ul>
                <div class="card-body">
                    <button type="button" class="<?= ($exMod->getIsProblem())? 'btn btn-danger' :  'btn btn-success'?>">Ver módulo</button>
                    <button type="button" class="questnios-analizes-btn">Analisar questões</button>
                </div>
            </div>
        <?php endforeach; ?>

        
    </main>

    <?php require __DIR__. "/../componentes/footer.php"?>       