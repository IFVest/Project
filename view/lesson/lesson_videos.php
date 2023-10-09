<?php
    require_once(__DIR__ . "/../componentes/header.php");
    require_once(__DIR__ . "/../../model/Subjects.php");
?>




<link rel="stylesheet" href="<?= BASE_URL ?>/view/lesson/list_lesson.css">

    <!-- MAIN CONTENT-->
    <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
            <h1 class="content-title">Aulas <?php echo isset($dados["moduleName"]) ? "de " . $dados["moduleName"] : "" ?></h1>
            
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
                <iframe width="500px" src="<?php echo isset($dados) ? $dados["lista"][0]->getUrl() : "" ?>" frameborder="0"></iframe>
            </div>

            <?php if (isset($dados["lista"]) and count($dados["lista"]) > 1): ?>
                <div class="col-md-3 lessonsDiv">

                    <h5 class="lessons_title">Aulas</h5>
                    
                </div>
            <?php endif;?>

        </div>

      
    </main>


    <?php require __DIR__. "/../componentes/footer.php"?>       