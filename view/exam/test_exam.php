<?php
    include(__DIR__ . "/../componentes/header.php");
    require_once(__DIR__ . "/../../util/config.php");
    require_once(__DIR__ . "/../../controller/ExamController.php");
    require_once(__DIR__.'/examTestCreator.php')
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
    <main class="main-content col-md-10 px-md-5">
        <div class="error-div">
            <?php require_once(__DIR__ . "/../include/msg.php");?>
        </div>
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
</body>
</html>