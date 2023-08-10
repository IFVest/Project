<?php
 require( __DIR__. "/../componentes/header.php");
require_once(__DIR__ . "/../../model/Subjects.php");
?>

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
            <div class="col-md-9">


                <!-- SERAO LISTADOS AS AULAS DE CADA MODULO -->
                <?php foreach (Subjects::cases() as $subject) : ?>
                    
                        <div class="modules row" id="<?php echo $subject->name; ?>"></div>
                        
                <?php endforeach; ?>

            </div>

            <div class="col-md-3">
            <?php foreach (Subjects::cases() as $subject) : ?>

                


                <div style="background-color: #cdd2c1; "> 
                    <button class="subject"> <?php echo $subject->name; ?> </button>
                    <!-- <div class="modules" id="<?php echo $subject->name; ?>"></div> -->
                    <br>
                </div>
            <?php endforeach; ?>
            </div>
        </div>

      
    </main>

    <script src="<?= BASE_URL ?>/js/lessonListFiltering.js" type="module"></script>


    <?php require __DIR__. "/../componentes/footer.php"?>       