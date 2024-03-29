<?php 
require __DIR__ . "/componentes/header.php";
require __DIR__ . "/../util/config.php";
?>

<!-- MAIN CONTENT-->
<main id="configuracoes" class="main-content col-md-10 px-md-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 class="content-title" style="color: #58b352">Configurações</h1>

        <!-- MENUZINHO DE OPÇÕES-->
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <!-- <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button> -->
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="../controller/LessonController.php?action=create">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #58b352">
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
                        <h5 class="card-title" style="color: #58b352">
                            <i class="bi bi-collection-play-fill"></i>
                            Listar Aula
                        </h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="../controller/ModuleController.php?action=create">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #58b352">
                        <i class="bi bi-folder-fill"></i>
                            Criar Modulo
                        </h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="../controller/ModuleController.php">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #58b352">
                        <i class="bi bi-folder-fill"></i>
                            Listar Modulo
                        </h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="../controller/QuestionController.php?action=create">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #58b352">
                        <i class="bi bi-pen-fill"></i>
                            Criar Questão
                        </h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="../controller/QuestionController.php">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #58b352">
                        <i class="bi bi-pen-fill"></i>
                            Listar Questões
                        </h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="../controller/WeekController.php?action=create">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #58b352">
                        <i class="bi bi-pen-fill"></i>
                            Criar Semana
                        </h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="../controller/WeekController.php">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #58b352">
                        <i class="bi bi-pen-fill"></i>
                            Listar Semanas
                        </h5>
                    </div>
                </a>
            </div>
        </div>

    </div>
    <!-- /.ROW -->

</main>

<?php require __DIR__ . "/componentes/footer.php" ?>