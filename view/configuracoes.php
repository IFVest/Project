<?php require __DIR__ . "/componentes/header.php" ?>

<!-- MAIN CONTENT-->
<main id="configuracoes" class="main-content col-md-10 px-md-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 class="content-title">Configurações</h1>

        <!-- MENUZINHO DE OPÇÕES-->
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
            </div>
        </div>
    </div>

    <h5 class="content-subtitle">subtítulo</h5>
    <p class="content-subtitle-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>


    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="./lesson/create_lesson.php">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-collection-play-fill"></i>
                            Criar Aula
                        </h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="../controller/LessonController.php">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-collection-play-fill"></i>
                            Listar Aula
                        </h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="./module/create_module.php">
                    <div class="card-body">
                        <h5 class="card-title">
                        <i class="bi bi-folder-fill"></i>
                            Criar Modulo
                        </h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="./module/list_modules.php">
                    <div class="card-body">
                        <h5 class="card-title">
                        <i class="bi bi-folder-fill"></i>
                            Listar Modulo
                        </h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="./question/create_question.php">
                    <div class="card-body">
                        <h5 class="card-title">
                        <i class="bi bi-pen-fill"></i>
                            Criar Questão
                        </h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="./question/list_questions.php">
                    <div class="card-body">
                        <h5 class="card-title">
                        <i class="bi bi-pen-fill"></i>
                            Listar Questões
                        </h5>
                    </div>
                </a>
            </div>
        </div>

    </div>
    <!-- /.ROW -->

</main>

<?php require __DIR__ . "/componentes/footer.php" ?>