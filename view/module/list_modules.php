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
    <h1>Listar Módulos</h1>

    <?php foreach (Subjects::cases() as $subject) : ?>
        <button class="subject" style="width: 64em; height: 4em"> <?php echo $subject->name; ?> </button>
        <div class="modules" id="<?php echo $subject->name; ?>"></div>
        <br>
    <?php endforeach; ?>
    <a href="ModuleController.php?action=create">
        <button>Criar módulo</button>
    </a>
    <script src="<?= BASE_URL ?>/js/listingFiltering.js"></script>

</body>

</html>