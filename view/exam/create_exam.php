<?php
    error_reporting(E_ERROR);
    include(__DIR__ . "/../componentes/header.php");
    require_once(__DIR__ . "/../../util/config.php");
    require_once(__DIR__ . "/../../model/Subjects.php");
?> 


<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Simulado</title>
</head>

<body>
    <main class="main-content col-md-10 px-md-5">
        <div class="component p-5 d-flex flex-column align-items-center justify-content-center">
            <h1 class='my-2'>Criar Simulado Personalizado</h1>
            <div class="form card col-12 m-3 p-3">
                <form method="POST" action="<?= BASE_URL ?>/controller/ExamController.php?action=save" class='d-flex flex-column col-8'>
                    <div class="type-exam d-flex justify-content-between">
                        <div class="personalized m-2">
                            <label for="personalized">Personalizado</label>
                            <input type="radio" name="exam_type" class="exam_type" id="personalized" value="personalized">
                        </div>
                        <div class="default m-2">
                            <label for="default">Padrão IFPR</label>
                            <input type="radio" name="exam_type" class="exam_type" id="default" value="default">
                        </div>
                    </div>
                    <div class="component allFilters" style="display: none; flex-direction: column">
                        <div class="filters col-12" style="flex-direction: column">
                            <div class="card params text-center col-11">
                                <select class='subject-select form-select card-header' name="subject1" id='subjects1'>
                                    <?php foreach (Subjects::cases() as $subject) : ?>
                                        <option class="subject-option" value="<?php echo $subject->name; ?>"><?php echo $subject->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="card-body">
                                    <label for='modules-filter-div1'>Módulos:</label>
                                    <div class="modules-filter-div1" id="modules-filter-div1"></div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class='new-filter-button btn btn-secondary'>Adicionar componente</button>
                    </div>
                              
                    
        
                    <button type="submit" class='btn btn-primary'>Criar</button>
                    <input type='hidden' value='<?= $_SESSION['userId'];?>' name='user_id'>
                </form>
                <div class="error-div">
                    <?php require_once(__DIR__ . "/../include/msg.php");?>
                </div>
            </div>
        </div>
    </main>
    <script src="<?= BASE_URL ?>/js/examFilterByModule.js" type="module"></script>
</body>

</html>