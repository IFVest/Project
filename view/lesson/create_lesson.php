<?php
    require_once(__DIR__ . "/../../controller/ModuleController.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Criar aula</h1>

    <form method="POST" action="<?php BASE_URL ?>/controller/LessonController.php?action=save">
        Titulo:<input type="text" name="lesson_title">
        <br>
        Descrição:<input type="text" name="lesson_desc">
        <br>
        Url:<input type="text" name="lesson_url">
        <br>
        Módulo: <select name="lesson_module">
            <?php foreach($mod->list() as $module): ?>
                <option value="<?php echo $module->getId()?>">
                    <?php echo $module->getName(); ?>
                </option>
            <?php endforeach;?>
        </select>

        <input type="text" hidden name="lesson_user">
        <input type="text" hidden name="lesson_id" value="<?php echo $dados["id"];?>">
        <br>
        <button type="submit">Gravar</button>
    </form>
    
</body>
</html>