<?php
require_once(__DIR__ . "/../../controller/LessonController.php");
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
    <h1>Listar Aulas</h1>

    <table>
        <th style="border: 1px solid black">Titulo</th>
        <th style="border: 1px solid black">Url</th>
        <th style="border: 1px solid black">Módulo</th>
        <th style="border: 1px solid black">Alterar</th>
        <th style="border: 1px solid black">Deletar</th>
        <?php foreach ($les->list() as $lesson) : ?>
            <tr>
                <td style="border: 1px solid black"><?php echo $lesson->getTitle(); ?></td>
                <td style="border: 1px solid black"><?php echo $lesson->getUrl(); ?></td>
                <td style="border: 1px solid black"><?php echo $mod->findByModuleId($lesson->getModule())->getName(); ?></td>
                <td style="border: 1px solid black">
                    <a href="../../controller/LessonController.php?action=edit&id=<?php echo $lesson->getId(); ?>">Alterar</a>
                </td>
                <td style="border: 1px solid black">
                    <a href="../../controller/LessonController.php?action=delete&id=<?php echo $lesson->getId(); ?>">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>