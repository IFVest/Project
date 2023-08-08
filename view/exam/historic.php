<?php
include(__DIR__ . "/../componentes/sideBar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Simulados</title>
</head>
<body>
    <div class="component d-flex flex-wrap" style="padding: 100px">
        <?php 
        $exams = $dados['provas'];
        foreach($exams as $exam):?>
            <?php
            $totalQuestions = 0;
            $totalCorrectQuestions = 0;
            foreach($exam->getExamModules() as $examMod){
                $totalQuestions += $examMod->getTotalQuestions();
                $totalCorrectQuestions += $examMod->getCorrectQuestions();
            }
            $report = round(($totalCorrectQuestions/$totalQuestions)*100, 2);
            ?>
            <div class="component mx-6 col-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Prova <?= $exam->getId(); ?></h5>
                        <p class="card-text"><?= ($report > 70)? 'Mandou Bem!' : 'Não desanime, continue estudando!'; ?> </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Total de questões: <?= $totalQuestions; ?></li>
                        <li class="list-group-item">Total de acertos: <?= $totalCorrectQuestions; ?></li>
                        <li class="list-group-item">Desempenho: <?= $report ?> %</li>
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
</body>
</html>