<?php 
require (__DIR__. "/../componentes/header.php");
require_once(__DIR__ . "/../../util/config.php");
require_once(__DIR__ . "/../../model/Subjects.php");
?>

<!-- MAIN CONTENT-->
<main class="main-content col-md-10 px-md-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 class="content-title" style="color: #58b352">Simulado</h1>

        <!-- MENUZINHO DE OPÇÕES-->
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
            </div>
        </div>
    </div>

    <div class="form card col-8 m-3 p-3">
        <form method="POST" action="<?= BASE_URL ?>/controller/ExamController.php?action=save" class='d-flex flex-column'>
            <div class="type-exam d-flex justify-content-evenly">
                <div class="personalized m-2">
                    <label for="personalized">Personalizado</label>
                    <input type="radio" name="exam_type" class="exam_type" id="personalized" value="personalized">
                </div>
                <div class="default m-2">
                    <label for="default">Padrão IFPR</label>
                    <input type="radio" name="exam_type" class="exam_type" id="default" value="default">
                </div>
            </div>
            <div class="component allFilters" style="display: none; flex-direction: column">
                <div class="filters col-12 d-flex flex-column"></div>
                <button type="button" class='new-filter-button btn btn-secondary'>Adicionar componente</button>
            </div>



            <button type="submit" class='btn btn-primary create-exam-btn'>
                <span class='text-create'>Criar</span> 
                <img class='loading' style="display: none; height: 45px; width: 45px;" src="<?= BASE_URL ?>/images/Spinner-1s-200px(1).gif">
            </button>
            <input type='hidden' value='<?= $_SESSION['userId']; ?>' name='user_id' id='user_id'>
            <input type='hidden' value='0' name='filters_count' class='filters_count' id='filters_count'>
        </form>
        <div class="error-div">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>
    </div>

</main>

<script src="<?= BASE_URL ?>/js/examFilterByModule.js" type="module"></script>
<script type="module" src="../view/exam/script.js">
</script>

<?php require __DIR__ . "/../componentes/footer.php" ?>