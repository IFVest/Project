<?php
    include(__DIR__ . "/../componentes/header.php");
    require_once(__DIR__ . "/../../util/config.php");
    require_once(__DIR__ . "/../../controller/ExamController.php");
    require_once(__DIR__.'/examTestCreator.php')
?>

    <!-- MAIN CONTENT-->
    <!-- <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
            <h1 class="content-title">Simulado</h1> -->
            
            <!-- MENUZINHO DE OPÇÕES-->
            <!-- <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">exportar</button>
                </div>
            </div>
        </div> -->

        <!-- <h5 class="content-subtitle">subtítulo</h5>
        <p class="content-subtitle-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> -->


    <main class="main-content col-md-10 px-md-5">
        <div class="container col-12 d-flex flex-column align-items-center justify-content-center">
            <h1 class="mt-3">Simulado</h1>
            <form method="POST" action="<?= BASE_URL ?>/controller/ExamController.php?action=makeReport">
                <?php
                $exam = $dados['prova'];
                $examModules = $exam->getExamModules();

                ExamTestCreator::mapTest($exam, $examModules);
                
                ?>
                

                <input type="hidden" name="id" value="<?= $exam->getId()?>">

                <button class="btn btn-primary" type="submit" <?= ($exam->getFinished())? 'disabled' : '' ;?>>
                    <?= ($exam->getFinished())? 'FINALIZADO' : 'FINALIZAR' ;?>
                </button>
                </div>
            </form>
        </div>
    </main>
    <script src="<?= BASE_URL ?>/view/exam/answerExamScript.js"></script>

        
    <?php require __DIR__. "/../componentes/footer.php"?>       