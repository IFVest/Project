<?php
require_once(__DIR__ . "/../../util/config.php");
require_once(__DIR__ . "/../../model/ModuleSubject.php");
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
            else echo "Alterar"; ?> módulo</h1>

    <form method="POST" action="<?= BASE_URL ?>/controller/ModuleController.php?action=save">
        Nome:<input type="text" name="module_name" value="<?php echo ($dados["module"] ? $dados["module"]->getName() : '');?>">
        <br>
        Descricao: <input type="text" name="module_desc" value="<?php echo ($dados["module"] ? $dados["module"]->getDescription() : ''); ?>">
        <br>
        <select name="module_subject">
            <?php $i = 1; foreach($modSubject->subjects as $subject):?>
                <option value="<?php echo $i;?>" 
                <?php echo ($dados["module"] && $subject == $dados["module"]->getSubject() ? "selected" : '');?>>
                    <?php echo $subject;?>
                </option>
                <?php $i++;?>
            <?php endforeach;?>
        </select>

        <input type="hidden" name="module_id" value="<?php echo $dados['id']; ?>">

        <button type="submit">Gravar</button>
    </form>


</body>

</html>