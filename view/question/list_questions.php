<?php

include(__DIR__ . "/../componentes/sideBar.php");
require_once(__DIR__ . "/../../controller/QuestionController.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/view/question/list_question.css">
    <title>Listar Questões</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <?php
    //require_once(__DIR__ . "/../../util/config.php"); 
    // include_once(BASE_URL . '/view/include/bootstrap_header.php');
    ?>
</head>

<body>
    
    <div class="container-fluid d-flex flex-wrap row">
        <?php
        $questions = $dados['lista'];
        //print_r($questions);
        
        foreach ($questions as $question) :
        ?>
            <div class="container container-fluid d-flex flex-wrap col-3">
                <div class="row">
                    <div class="col-2 mb-4">
                        <div class="card" style="width: 18rem;"> 
                            <div class="card-body">
                                <h5 class="card-title"><?= $question->getText() ?></h5>
                                <?php foreach ($question->getAlternatives() as $alt) : ?>
                                    <p class="card-text" style="margin-bottom: 0px;">
                                        <?= $alt->getText() ?>
                                        <?php
                                        if ($alt->getIsCorrect())
                                        echo " *";
                                        ?>
                                    </p>
                                <?php endforeach; ?>
                                <a href="../controller/QuestionController.php?action=edit&id=">Alterar</a>
                                <a href="../controller/QuestionController.php?action=delete&id=">Deletar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>


</body>

</html>