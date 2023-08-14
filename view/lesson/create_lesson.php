<?php
include(__DIR__ . "/../componentes/sideBar.php");
require_once(__DIR__ . "/../../util/config.php");
require_once(__DIR__ . "/../../model/Subjects.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="<?= BASE_URL ?>/js/lessonFilterByModule.js" type="module"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/view/lesson/create_lesson.css">

</head>

<body>
    <h1 class="title"> <?php if (! isset($dados["id"]) || $dados["id"] == NULL) echo "Criar";
            else echo "Alterar"; ?> aula </h1>
    <form method="POST" action="<?= BASE_URL ?>/controller/LessonController.php?action=save">
        <label>Titulo:</label>
        <input type="text"  class="lesson_title" name="lesson_title" value="<?php echo isset($dados["lesson"]) ? $dados["lesson"]->getTitle() : '' ?>">
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
        <button type="submit" class="buttonSave" >Gravar</button>
    </form>

    <div class="col-6">
        <?php require_once(__DIR__ . "/../include/msg.php"); ?>
    </div>
</body>

</html>