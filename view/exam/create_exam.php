
<?php 
require (__DIR__. "/../componentes/header.php");
require_once(__DIR__ . "/../../util/config.php");
require_once(__DIR__ . "/../../model/Subjects.php");
?>

    <!-- MAIN CONTENT-->
    <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
            <h1 class="content-title">Criar Simulado</h1>
            
            <!-- MENUZINHO DE OPÇÕES-->
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">exportar</button>
                </div>
            </div>
        </div>

        <form method="POST" action="<?= BASE_URL ?>/controller/ExamController.php?action=save" class='d-flex flex-column'>
                    <div class="type-exam d-flex justify-content-evenly">
                        <div class="personalized m-2">
                            <label for="personalized">Personalizado</label>
                            <input type="radio" name="exam_type" class="exam_type" id="personalized" value="personalized">
                        </div>
                        <div class="default m-2">
                            <label for="personalized">Padrão IFPR</label>
                            <input type="radio" name="exam_type" class="exam_type" id="default" value="default">
                        </div>
                    </div>
                    
                    <div class="filters" style="display: none; border: 1px solid black;">
                        <div class="modules">
                            
                        </div>
                        <button class='new-filter-button'>Adicionar componente</button>
                    </div>
                    
        
                    <button type="submit" class='btn btn-primary'>Criar</button>
                    <input type='hidden' value='0' name='filters_count'>
                    <input type='hidden' value='<?= $_SESSION['userId'];?>' name='user_id'>
                </form>
                <div class="error-div">
                    <?php require_once(__DIR__ . "/../include/msg.php");?>
                </div>
            </div>

            <script type="module" src="../view/exam/script.js">
    </script>

        
    </main>

    <?php require __DIR__. "/../componentes/footer.php"?>       