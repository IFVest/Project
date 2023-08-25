<?php
require(__DIR__ . "/../componentes/header.php");
require_once(__DIR__ . "/../../util/config.php");
require_once(__DIR__ . "/../../model/Subjects.php");
?>
<script src="<?= BASE_URL ?>/js/filtering.js" type="module"></script>

<!-- MAIN CONTENT-->
<main class="main-content col-md-10 px-md-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <script src="<?= BASE_URL ?>/js/lessonFilterByModule.js" type="module"></script>

        <!-- MENUZINHO DE OPÇÕES-->
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
            </div>
        </div>
    </div>

    <!-- <h5 class="content-subtitle">Espaço para criação de novas aulas!</h5> -->

    <form method="POST" action="<?= BASE_URL ?>/controller/LessonController.php?action=save">
        <label>Titulo:</label>
        <input type="text" class="lesson_title" name="lesson_title" value="<?php echo isset($dados["lesson"]) ? $dados["lesson"]->getTitle() : '' ?>">
        <br>
        <label>Url:</label>
        <input type="text" class="lesson_url" name="lesson_url" value="<?php echo isset($dados["lesson"]) ? $dados["lesson"]->getUrl() : ''; ?>">
        <br>
        <label>Matéria:</label>
        <select name="subjects">
            <?php foreach (Subjects::cases() as $subject) : ?>
                <option class="subject" value="<?php echo $subject->name; ?>"><?php echo $subject->name ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <label>Módulos:</label>
        <div class="modules" class="modules">
        </div>

        <input type="text" hidden name="lesson_user">
        <input type="text" hidden name="lesson_id" value="<?php echo isset($dados["id"]) ? $dados["id"] : NULL; ?>">
        <br>
        <button type="submit" class="buttonSave">Gravar</button>
    </form>

    <div class="col-6">
        <?php require_once(__DIR__ . "/../include/msg.php"); ?>
    </div>

</main>

<?php require __DIR__ . "/../componentes/footer.php" ?>