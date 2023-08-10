<?php
require_once(__DIR__ . "/../../controller/QuestionController.php");
require __DIR__ . "/../componentes/header.php";
?>

<!-- MAIN CONTENT-->
<main class="main-content col-md-10 px-md-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 class="content-title">Listagem das questões</h1>

        <!-- MENUZINHO DE OPÇÕES-->
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
            </div>
        </div>
    </div>


    <?php
    $questions = $dados['lista'];
    foreach ($questions as $question) :
    ?>
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
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
                        </h5>
                        <a href="../controller/QuestionController.php?action=edit&id=<?= $question->getId(); ?>">Alterar</a>
                        <a href="../controller/QuestionController.php?action=delete&id=<?= $question->getId(); ?>">Deletar</a>
                    </div>
                </div>
            </div>
        </div>



    <?php endforeach; ?>

</main>

<?php require __DIR__ . "/../componentes/footer.php" ?>