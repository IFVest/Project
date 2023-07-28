<?php
require_once(__DIR__ . "/../../util/config.php");
require_once(__DIR__ . "/../../model/Subjects.php");

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
    <h1> <?php if (! isset($dados['id']) || $dados['id'] == NULL) echo "Inserir";
            else echo "Alterar"; ?> módulo</h1>

    <form method="POST" action="<?= BASE_URL ?>/controller/ModuleController.php?action=save">
        Nome:<input type="text" name="module_name" value="<?php echo (isset($dados["module"]) ? $dados["module"]->getName() : '');?>">
        <br>
        Descricao: <input type="text" name="module_desc" value="<?php echo (isset($dados["module"]) ? $dados["module"]->getDescription() : ''); ?>">
        <br>
        Matéria: <select name="module_subject">
            <?php $i = 1; foreach(Subjects::cases() as $subject):?>
                <option value="<?php echo $i;?>" 
                <?php echo (isset($dados["module"]) && $subject->name == $dados["module"]->getSubject() ? "selected" : '');?>>
                    <?php echo $subject->name;?>
                </option>
                <?php $i++;?>
            <?php endforeach;?>
        </select>
        <input type="hidden" name="module_id" value="<?php echo isset($dados["id"]) ? $dados["id"] : NULL;?>">

        <button type="submit">Gravar</button>
    </form>
    <br>
    <a href="ModuleController.php">
        <button>Ver módulos</button>
    </a>

    <div class="col-6">
        <?php require_once(__DIR__ . "/../include/msg.php");?>
    </div>
</body>

</html>