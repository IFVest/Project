
<?php 
require (__DIR__. "/../componentes/header.php");
require_once(__DIR__ . "/../../model/Subjects.php");
require_once(__DIR__ . "/../../util/config.php");

?>

    <!-- MAIN CONTENT-->
    <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
            <h1 class="content-title">Listagem de modulos</h1>
            
            <!-- MENUZINHO DE OPÇÕES-->
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
                </div>
            </div>
        </div>

        <h5 class="content-subtitle"></h5>


        <div class="subjects">
        <div class="subjects-header">
            <!-- <a class="create-module" href="/controller/ModuleController.php?action=create">
                <button>Criar módulo</button>
            </a> -->
        </div>
        <div class="subjects-body">
        <?php foreach (Subjects::cases() as $subject) : ?>
            <button class="subject" aria-expanded="false" style="width: 64em; height: 4em"> <?php echo $subject->name; ?> </button>
            <div class="modules" id="<?php echo $subject->name; ?>"></div>
            <br>
        <?php endforeach; ?>
        </div>
        
    </div>

    <script src="<?= BASE_URL ?>/js/listFiltering.js" type="module"></script>

    </main>

    <?php require __DIR__. "/../componentes/footer.php"?>       