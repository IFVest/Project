<?php
    require_once(__DIR__ . "/../componentes/header.php");
    require_once(__DIR__ . "/../../model/Subjects.php");
?>




<link rel="stylesheet" href="<?= BASE_URL ?>/view/lesson/list_lesson.css">

    <!-- MAIN CONTENT-->
    <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
            <h1 class="content-title">Listar Aulas</h1>
            
            <!-- MENUZINHO DE OPÇÕES-->
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
                </div>
            </div>
        </div>

        <div class="row">

        </div>
            <div class="col-md-9">
                
                <div class="video"></div>

            </div>

            <div class="col-md-3 lessonsDiv">

                <h5 class="lessons_title">Matérias</h5>
                
            </div>

        </div>

      
    </main>

    <script src="<?= BASE_URL ?>/js/lessonListFiltering.js" type="module"></script>


    <?php require __DIR__. "/../componentes/footer.php"?>       