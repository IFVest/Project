<?php
    error_reporting(E_ERROR);
    include(__DIR__ . "/../componentes/sideBar.php");
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
    <div class="component p-5 d-flex flex-column align-items-center justify-content-center">
        <h1 class='my-2'>Criar Simulado Personalizado</h1>
        <div class="form card col-8 m-3">
            <form method="POST" action="<?= BASE_URL ?>/controller/ExamController.php?action=save" class='d-flex flex-column'>
                <div class="type-exam d-flex justify-content-evenly">
                    <div class="personalized m-2">
                        <label for="personalized">Personalizado</label>
                        <input type="radio" name="exam_type" class="exam_type" id="personalized" value="personalized">
                    </div>
                    <div class="default m-2">
                        <label for="personalized">Padrão IFPR</label>
                        <input type="radio" name="exam_type" class="exam_type" id="default" value="default">
                    </div>
                </div>
                
                <div class="filters" style="display: none; border: 1px solid black;">
                    <div class="container-personalized1" style="display: none; border: 1px solid black;">
                        <select name="subjects1" class='subjects'>
                            <?php foreach (Subjects::cases() as $subject) : ?>
                                <option class="subject1" value="<?php echo $subject->name; ?>"><?php echo $subject->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="modules">
                        </div>
                    </div>
                    <button class='new-filter-button'>Adicionar componente</button>
                </div>
                
    
                <button type="submit" class='btn btn-primary'>Criar</button>
                <input type='hidden' value='0' name='filters_count'>
                <input type='hidden' value='<?= $_SESSION['userId'];?>' name='user_id'>
            </form>
            <div class="error-div">
                <?php require_once(__DIR__ . "/../include/msg.php");?>
            </div>
        </div>
    </div>
    <script type="module" src="../view/exam/script.js">
    </script>

</body>

</html>