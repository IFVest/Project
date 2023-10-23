
<?php require __DIR__. "/../componentes/header.php"?>


    <!-- MAIN CONTENT-->
    <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <link rel="stylesheet" href="<?= BASE_URL ?>/view/question/list_question.css">
            
            <h1 class="content-title">Listagem das questões</h1>
            
            <!-- MENUZINHO DE OPÇÕES-->
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">exportar</button>
                </div>
            </div>
        </div>

        <div class="container-fluid d-flex flex-wrap row">
        <?php
        $questions = $dados['lista'];
        //print_r($questions);
        
        foreach ($questions as $question) :?>
        <div class="container container-fluid d-flex flex-wrap col-12">
            <div class="row">
                <div class="col-2 mb-4">
                    <div class="card" style="width: 65rem;"> 
                        <div class="card-body">
                            <h5 class="card-title"><?= $question->getText() ?></h5>
                            <?php foreach ($question->getAlternatives() as $alt) : ?>
                                <p class="card-text" style="margin-bottom: 0px;">
                                    <?= $alt->getText() ?>
                                    <?php
                                    if ($alt->getIsCorrect())
                                    echo " <i class=\"bi bi-check-circle-fill\"></i>";
                                    ?>
                                </p>
                            <?php endforeach; ?>
                            <br/>
                            <button type="button" class="btn btn-light"><a href="../controller/QuestionController.php?action=edit&id=<?= $question->getId(); ?>">Alterar</a></button>
                            <button type="button" class="btn btn-light"><a href="../controller/QuestionController.php?action=delete&id=<?= $question->getId(); ?>">Deletar</a></button>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        
    </div>

        
    </main>

    <?php require __DIR__. "/../componentes/footer.php"?>       