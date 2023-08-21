<?php
include(__DIR__ . "/../componentes/header.php");
require_once(__DIR__ . "/../../controller/ExamController.php");
require_once(__DIR__. '/../../model/Subjects.php');
require_once(__DIR__. '/examTestCreator.php');
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulado</title>
</head>
<body>
    <main class="main-content col-md-10 px-md-5">
        <div class="row p-4">  
            <h1 class="m-4 mt-6">Relatório da Prova</h1>
            <div class="container d-flex flex-wrap col-12">
                <div class="accordion col-7" id="accordionParent">
                    <?php
                    $exam = $dados['prova'];
                    $examModules = $exam->getExamModules();
                    foreach(Subjects::cases() as $subject):
                        $subject = $subject->name;
                        $subjectId = str_split($subject, 2)[0]
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $subjectId; ?>" aria-expanded="false" aria-controls="<?= $subjectId; ?>">
                                <?= $subject; ?>
                            </button>
                        </h2>
                        <div id="<?= $subjectId; ?>" class="accordion-collapse collapse show" data-bs-parent="#accordionParent">
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <?php
                                foreach($examModules as $exMod): 
                                    if($exMod->getModule()->getSubject() == $subject){?>
                                        <div class="card component <?= $exMod->getId()?> col-11 m-2 d-flex">
                                            <div class="card-body d-flex align-items-center justify-content-center">
                                                <div class="col-lg-3 col-sm-2 align-items-start">
                                                    <h5 class="card-title"><?= $exMod->getModule()->getName() ?></h5>
                                                </div>
                                                <li class="list-group-item col-2">Total de questões: <?= $exMod->getTotalQuestions() ?></li>
                                                <li class="list-group-item col-2">Número de questões corretas: <?= $exMod->getCorrectQuestions() ?></li>
                                                <li class="list-group-item col-2">Desempenho: <?= round(($exMod->getCorrectQuestions()/ $exMod->getTotalQuestions())*100, 2) ?> %</li>
                                                <div class="component d-flex col-3">
                                                    <button class="<?= ($exMod->getIsProblem())? 'btn btn-danger' :  'btn  btn-success'?> mx-1 col-6">Ver módulo</button>
                                                    <button class="questions-analizes-btn btn btn-secondary col-6" name='<?= $exMod->getId(); ?>'>Analisar questões</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="questions-view questions-view-<?= $exMod->getId(); ?> col-4" style="display: none; position: absolute; right: 1vw; top: 10px;">
                                            <?php
                                                ExamTestCreator::mapTest($exam, [$exMod]);
                                            ?>
                                        </div>
                                    <?php };
                                endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </main>
    <script >
        let questionsAnalizesBtns = document.querySelectorAll('.questions-analizes-btn')
        let questionsView = document.querySelectorAll('.questions-view')

        questionsAnalizesBtns.forEach(element=>{
            element.addEventListener('click', (event)=>{
                questionsView.forEach(elementDiv =>{
                    elementDiv.style.display = 'none'
                    console.log(('questions-view-' + event.target.name) == elementDiv.className.split(' ')[1])
                    if(('questions-view-' + event.target.name) == elementDiv.className.split(' ')[1]){
                        elementDiv.style.display = 'flex'
                        
                    }
                })  
            })
        })
    </script>
</body>
</html>

<!-- 
    <div class="card <?= $exMod->getId()?> col-11 my-3 d-flex">
        <div class="card-body d-flex align-items-center justify-content-center">
        <h5 class="card-title"><?= $exMod->getModule()->getName() ?></h5>
        <p class="card-text">
            <span class="list-group-item mx-2">Total de questões: <?= $exMod->getTotalQuestions() ?></span>
            <span class="list-group-item mx-2">Número de questões corretas: <?= $exMod->getCorrectQuestions() ?></span>
            <span class="list-group-item mx-2">Desempenho: <?= round(($exMod->getCorrectQuestions()/ $exMod->getTotalQuestions())*100, 2) ?> %</span>
            <button type="button" class="<?= ($exMod->getIsProblem())? 'btn btn-danger' :  'btn  btn-success'?>">Ver módulo</button>
            <button type="button" class="questnios-analizes-btn">Analisar questões</button>
        </p>
    </div -->