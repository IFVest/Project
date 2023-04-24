<?php
require_once(__DIR__ . "/../../util/config.php");
require_once(__DIR__ . "/../../controller/QuestionController.php");
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
    <h1> <?php if ($dados['id'] == 0) echo "Inserir";
            else echo "Alterar"; ?> questão</h1>

    <form method="POST" action="<?= BASE_URL ?>/controller/QuestionController.php?action=save">
        <label for="question_text">Enunciado: </label>
        <input type="text" name="question_text" value="<?php echo ($dados["question"] ? $dados["question"]->getText() : '');?>">
        <br>
        <select name="question_module">
            <?php
            // TODO Colocar os módulos no select
            $moduleController = new ModuleController();
            $modules = $moduleController->list();
            foreach($modules as $module):?>
                <option value="<?php echo $module->getId()?>" 
                <?php echo ($dados["question"] && $module == $dados["module"]->getModule() ? "selected" : '');?>>
                    <?php echo $module->getName();?>
                </option>
            <?php endforeach;?>
        </select>

        <input type="hidden" name="question_id" value="<?php echo $dados['id']; ?>">
        <button type="submit">Gravar</button>
    </form>
</body>

</html>