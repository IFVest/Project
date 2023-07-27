<?php
    error_reporting(E_ERROR);
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
    <h1>Criar Simulado Personalizado</h1>

    <form method="POST" action="<?= BASE_URL ?>/controller/ExamController.php?action=save">
        <label for="personalized">Personalizado</label>
        <input type="radio" name="exam_type" class="exam_type" id="personalized" value="personalized">

        <label for="personalized">Padrão IFPR</label>
        <input type="radio" name="exam_type" class="exam_type" id="default" value="default">
        
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
        

        <button type="submit">Gravar</button>
        <input type='hidden' value='0' name='filters_count'>
        <!-- <input type='hidden' value='<?php $_SESSION['user_id'] ?>' name='filters_count'> -->
        <input type='hidden' value='1' name='user_id'>
    </form>
    <div class="error-div">
        <?php require_once(__DIR__ . "/../include/msg.php");?>
    </div>

    <script type="module" src="../view/exam/script.js">
    </script>
</body>

</html>