<?php

require_once(__DIR__ . "/../../controller/QuestionController.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Questões</title>
</head>

<body>
    <table>
        <thead>
            <th>Enunciado</th>
            <th>Alternativa 1</th>
            <th>Alternativa 2</th>
            <th>Alternativa 3</th>
            <th>Alternativa 4</th>
            <th>Alternativa 5</th>
            <th>Editar</th>
            <th>Deletar</th>
            </th>
        </thead>
        <tbody>
            <?php
            $questions = $dados['lista'];
            foreach ($questions as $question) :
            ?>
                <tr>
                    <td style="border: 1px solid black"><?php echo $question->getText(); ?></td>
                    <?php foreach ($question->getAlternatives() as $alternative):?>
                        <td style="border: 1px solid black"><?= $alternative->getText(); ?></td>
                    <?php endforeach; ?>
                    <td style="border: 1px solid black">
                        <a href="../controller/QuestionController.php?action=edit&id=<?php echo $question->getId(); ?>">Alterar</a>
                    </td>
                    <td style="border: 1px solid black">
                        <a href="../controller/QuestionController.php?action=delete&id=<?php echo $question->getId(); ?>">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>