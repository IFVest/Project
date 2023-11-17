<?php
error_reporting(0);
include(__DIR__ . "/../componentes/header.php");
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Simulados</title>
</head>

<!-- MAIN CONTENT-->

<main class="main-content col-md-10 px-md-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 class="content-title" style="color: #58b352">Histórico de Simulados</h1>
    </div>

    <div class="component d-flex flex-column">

        <div class="exams component d-flex flex-wrap row">
            <?php
            $exams = $dados['provas'];
            foreach($exams as $exam):?>
                <div class="component col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Prova <?= $exam->getId(); ?></h5>
                            <p class="card-text"><?=($exam->getFinished())? ($exam->getPercentageCorrect() > 70)? 'Mandou Bem!' : 'Não desanime, continue estudando!' : 'Prova em andamento'; ?> </p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Total de questões: <?= $exam->getTotalQuestions(); ?></li>
                            <li class="list-group-item">Total de acertos: <?= ($exam->getFinished())? $exam->getTotalQuestionsCorrect() : 'Termine a prova'; ?></li>
                            <li class="list-group-item">Desempenho: <?= ($exam->getFinished())? $exam->getPercentageCorrect().'%' : 'Termine a prova' ?></li>
                        </ul>
                        <div class="card-body">
                            <a href="<?= BASE_URL ?>/controller/ExamController.php?action=view&id=<?= $exam->getId() ?>" class="btn btn-primary w-100">Vizualizar prova</a>
                            <a <?= ($exam->getFinished()? '' : 'disabled')?> href="<?= ($exam->getFinished()? BASE_URL.'/controller/ExamController.php?action=report&id='.$exam->getId() : '#')?>" class="btn btn-<?= ($exam->getFinished()? 'success' : 'secondary')?> mt-1 w-100">
                                <?= ($exam->getFinished()? 'Vizualizar Relatório' : 'Relatório após fim da prova')?>
                            </a>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


</main>

<?php require __DIR__. "/../componentes/footer.php"?>       