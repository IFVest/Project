<?php
require_once(__DIR__ . "/../componentes/header.php");
require_once(__DIR__ . "/../../model/Subjects.php");
?>

<link rel="stylesheet" href="<?= BASE_URL ?>/view/lesson/list_lesson.css">

<!-- MAIN CONTENT-->
<main class="main-content col-md-10 px-md-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 class="content-title">Aulas <?php echo isset($dados["moduleName"]) ? "de " . $dados["moduleName"] : "" ?></h1>

        <!-- MENUZINHO DE OPÇÕES -->
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-9 selected_video">
            <input id="selected_video_id" type="text" hidden value="<?php echo isset($dados) ? $dados["lista"][0]->getId() : "" ?>">
            <input id="lesson_module_id" type="text" hidden value="<?php echo isset($dados) ? $dados["lista"][0]->getModule() : "" ?>">

            <h2 class="selected_video_title" <?= ($isAdmin || $isTeacher) ? " style=\"display: inline-block \" " : "" ?>>
                <?php echo isset($dados) ? $dados["lista"][0]->getTitle() : "" ?>
                <br>
                <iframe width="500px" height="300px" src="<?php echo isset($dados) ? $dados["lista"][0]->getUrl() : "" ?>" frameborder="0"></iframe>
            </h2>

            <!-- deletar alterar e icone -->
            <h2>
            <?php if ($isAdmin || $isTeacher) : ?>

                    <a class="btn btn-secondary" href="<?= BASE_URL ?>/controller/LessonController.php?action=edit&id=<?= $dados["lista"][0]->getId() ?>">
                        Alterar
                    </a>

                    <a class="btn btn-secondary" href="<?= BASE_URL ?>/controller/LessonController.php?action=delete&id=<?= $dados["lista"][0]->getId() ?>">
                        Deletar
                    </a>

                <?php endif; ?>
                <?php if (isset($dados) && $dados["lista"][0]->getPdfPath() != null) : ?>
                    <a target="blank" href="<?php echo $dados["lista"][0]->getPdfPath() ?>">
                        <i class="bi bi-download"></i>
                    </a>
                <?php endif; ?>
            </h2>
        </div>

        <?php if (isset($dados["lista"]) and count($dados["lista"]) > 1) : ?>
            <div class="col-md-3 lessonsDiv">

                <h5 class="lessons_title">Aulas</h5>

                <?php $lessonsCount = count($dados["lista"]); ?>
                <?php for ($i = 1; $i < $lessonsCount; $i++) : ?>
                    <div class="card_lesson card lesson mb-4" style="padding: 15px;" aria-expanded="false" value="<?= $dados["lista"][$i]->getId() ?>">
                        <?php echo $dados["lista"][$i]->getTitle() ?>
                        <div class="card-content"></div>
                    </div>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

    </div>
    <input type="text" hidden id="isStudent" value="<?= ($isTeacher == null && $isAdmin == null) ? true : false ?>"></input>
    <script src="<?= BASE_URL ?>/view/lesson/lesson_videos.js"></script>
</main>


<?php require __DIR__ . "/../componentes/footer.php" ?>