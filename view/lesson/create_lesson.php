<?php
    require_once(__DIR__ . "/../../controller/ModuleController.php");
    require_once(__DIR__ . "/../../util/config.php");
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
    <h1> <?php if ($dados["id"] == 0) echo "Criar"; else echo "Alterar";?> aula </h1>

    <form method="POST" action="<?= BASE_URL ?>/controller/LessonController.php?action=save">
        Titulo:<input type="text" name="lesson_title" value="<?php echo ($dados["lesson"]) ? $dados["lesson"]->getTitle() : '' ?>">
        <br>
        Url:<input type="text" name="lesson_url" value="<?php echo ($dados["lesson"]) ? $dados["lesson"]->getUrl() : '';?>">
        <br>
        Módulo: <select name="lesson_module">
            <?php foreach($mod->list() as $module):?>
                <option value="<?php echo $module->getId(); ?>" <?php echo ($dados["lesson"] && $dados["lesson"]->getModule() == $module->getId() ? "selected" : ''); ?>>
                    <?php echo $module->getName(); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text" hidden name="lesson_user">
        <input type="text" hidden name="lesson_id" value="<?php echo $dados["id"];?>">
        <br>
        <button type="submit">Gravar</button>
    </form>
    
</body>
</html>