<?php
require_once(__DIR__ . "/../../controller/QuestionController.php");
require __DIR__ . "/../componentes/header.php";
?>

<!-- MAIN CONTENT-->
<main class="main-content col-md-10 px-md-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 class="content-title">Listagem das questões</h1>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/view/question/list_question.css">
    <title>Listar Questões</title>
</head>

<body>
    <div class="container-fluid d-flex flex-wrap row">
        <?php
        $questions = $dados['lista'];
        //print_r($questions);
        
        foreach ($questions as $question) :?>
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
                            <a href="../controller/QuestionController.php?action=edit&id=<?= $question->getId(); ?>">Alterar</a>
                            <a href="../controller/QuestionController.php?action=delete&id=<?= $question->getId(); ?>">Deletar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        
    </div>

    <?php require __DIR__ . "/../componentes/footer.php" ?>
</main>

