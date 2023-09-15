
<?php require __DIR__. "/../componentes/header.php"?>

    <!-- MAIN CONTENT-->
    <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
            <h1 class="content-title">Histórico de Simulados</h1>
            
            <!-- MENUZINHO DE OPÇÕES-->
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">exportar</button>
                </div>
            </div>
        </div>

        <div class="component d-flex flex-column">

            <div class="exams component d-flex flex-wrap row">
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
                    if ($totalQuestions != 0):

                        $calc = $totalCorrectQuestions/$totalQuestions;

                        $report = round($calc*100, 2);
                    ?>
                    <div class="component col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Prova <?= $exam->getId(); ?></h5>
                                <p class="card-text"><?=($exam->getFinished())? ($report > 70)? 'Mandou Bem!' : 'Não desanime, continue estudando!' : 'Prova em andamento'; ?> </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Total de questões: <?= $totalQuestions; ?></li>
                                <li class="list-group-item">Total de acertos: <?= ($exam->getFinished())?$totalCorrectQuestions : 'Termine a prova'; ?></li>
                                <li class="list-group-item">Desempenho: <?= ($exam->getFinished())? $report.'%' : 'Termine a prova' ?></li>
                            </ul>
                            <div class="card-body">
                                <a href="<?= BASE_URL ?>/controller/ExamController.php?action=view&id=<?= $exam->getId() ?>" class="btn btn-primary w-100">Vizualizar prova</a>
                                <a <?= ($exam->getFinished()? '' : 'disabled')?> href="<?= ($exam->getFinished()? BASE_URL.'/controller/ExamController.php?action=report&id='.$exam->getId() : '#')?>" class="btn btn-<?= ($exam->getFinished()? 'success' : 'secondary')?> mt-1 w-100">
                                    <?= ($exam->getFinished()? 'Vizualizar Relatório' : 'Relatório após fim da prova')?>
                                </a>

                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        
    </main>

    <?php require __DIR__. "/../componentes/footer.php"?>       