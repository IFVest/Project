<?php
require_once(__DIR__ . "/../../model/Subjects.php");
include(__DIR__ . "/../componentes/sideBar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?= BASE_URL ?>/js/weekFilterByModule.js" type="module"></script>
    <script src="<?= BASE_URL ?>/js/weekLessons.js"></script>
    <title>Document</title>
</head>

<body>
    <h1><?php if (!isset($dados["id"]) || $dados["id"] == NULL) echo "Criar";
        else echo "Alterar"; ?> semana</h1>

    <form method="POST" action="<?= BASE_URL ?>/controller/WeekController.php?action=save">
        Título: <input type="text" name="week_marker" value="<?php echo isset($dados["week"]) ? $dados["week"]->getMarker() : ''; ?>">
        <button type="submit">Gravar</button>
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
            <?php if (isset($dados["week"]) && !empty($dados["week"]->getLessons())) {
                foreach ($dados["week"]->getLessons() as $lesson) : ?>
                    <div class="lesson-card">
                        <iframe src="<?php echo $lesson->getUrl(); ?>" width="250" height="200"></iframe>
                        <div class="card-body">
                            <button type="button" onclick="removeVideo(this)">Remover</button>
                            <input hidden name="week_lessons[]" value="<?php echo $lesson->getId(); ?>">
                        </div>
                    </div>
            <?php endforeach;
            } ?>
        </div>
        <button type="submit">Gravar</button>

        <input type="hidden" name="week_id" value="<?php echo isset($dados["id"]) ? $dados["id"] : NULL ?>">
    </form>
    <br>
    <div class="col-6">
        <?php require_once(__DIR__ . "/../include/msg.php"); ?>
    </div>

</body>

</html>