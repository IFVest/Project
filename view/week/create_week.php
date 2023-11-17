<?php
require(__DIR__ . "/../componentes/header.php");
require_once(__DIR__ . "/../../model/Subjects.php");
?>
<script src="<?= BASE_URL ?>/js/weekFilterByModule.js" type="module"></script>
<script src="<?= BASE_URL ?>/js/weekLessons.js"></script>

<link rel="stylesheet" href="<?= BASE_URL ?>/view/week/create_week.css">

<!-- MAIN CONTENT-->
<main class="main-content col-md-10 px-md-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 style="color: #58b352"><?php if (!isset($dados["id"]) || $dados["id"] == NULL) echo "Criar";
            else echo "Alterar"; ?> semana</h1>

        <!-- MENUZINHO DE OPÇÕES-->
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
            </div>
        </div>
    </div>

    <form method="POST" action="<?= BASE_URL ?>/controller/WeekController.php?action=save">
        Título: <input type="text" name="week_marker" value="<?php echo isset($dados["week"]) ? $dados["week"]->getMarker() : ''; ?>">
        <br>
        Matéria:
        <select name="subjects">
            <?php foreach (Subjects::cases() as $subject) : ?>
                <option class="subject" value="<?php echo $subject->name; ?>"><?php echo $subject->name ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        Módulos:
        <div class="modules"></div>
        <br>
        
        Aulas:
        <div class="lessons"></div>
        
        <br>
        Aulas selecionadas:
        <div class="selected-lessons">
        <div class="row">
            <?php if (isset($dados["week"]) && !empty($dados["week"]->getLessons())) {
                
                foreach ($dados["week"]->getLessons() as $lesson) : ?>
                    <div class="lesson-card col-md-4 mb-4">
                        <iframe src="<?php echo $lesson->getUrl(); ?>"></iframe>
                        <div class="card-body">
                            <button type="button" onclick="removeVideo(this)">Remover</button>
                            <input hidden name="week_lessons[]" value="<?php echo $lesson->getId(); ?>">
                        </div>
                    </div>
            <?php endforeach;
            } ?>
            </div>
        </div>
        <button class="buttonSave" type="submit">Gravar</button>

        <input type="hidden" name="week_id" value="<?php echo isset($dados["id"]) ? $dados["id"] : NULL ?>">
    </form>
    <br>
    <div class="col-6">
        <?php require_once(__DIR__ . "/../include/msg.php"); ?>
    </div>

</main>

<?php require __DIR__ . "/../componentes/footer.php" ?>