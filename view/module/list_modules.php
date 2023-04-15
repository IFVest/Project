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
    <table>
        <thead>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Matéria</th>
            <th>Alterar</th>
            <th>Deletar</th>
        </thead>
        <tbody>
            <?php
            $modules = $mod->list();
            foreach ($modules as $module) :
            ?>
                <tr>
                    <td style="border: 1px solid black"><?php echo $module->getName(); ?></td>
                    <td style="border: 1px solid black"><?php echo $module->getDescription(); ?></td>
                    <td style="border: 1px solid black"><?php echo $module->getSubject(); ?></td>
                    <td style="border: 1px solid black">
                        <a href="../../controller/ModuleController.php?action=edit&id=<?php echo $module->getId(); ?>">Alterar</a>
                    </td>
                    <td style="border: 1px solid black">
                        <a href="../../controller/ModuleController.php?action=delete&id=<?php echo $module->getId(); ?>">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>