<?php
require_once(__DIR__ . "/../../model/Subjects.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Criar semana</h1>

    <form method="POST" action="">
        Título: <input type="text" name="week_marker">
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
    </form>
</body>

<script src="<?= BASE_URL ?>/js/filterByModule.js"></script>

</html>