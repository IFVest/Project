<?php
require_once(__DIR__ . "/../../model/Subjects.php");
require_once(__DIR__ . "/../../util/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>/view/css/list_modules.css">
    <title>Document</title>
</head>

<body>
    <div class="subjects">
        <div class="subjects-header">
            <h1>Listar Módulos</h1>
            <a class="create-module" href="ModuleController.php?action=create">
                <button>Criar módulo</button>
            </a>
        </div>
        <div class="subjects-body">
        <?php foreach (Subjects::cases() as $subject) : ?>
            <button class="subject" aria-expanded="false" style="width: 64em; height: 4em"> <?php echo $subject->name; ?> </button>
            <div class="modules" id="<?php echo $subject->name; ?>"></div>
            <br>
        <?php endforeach; ?>
        </div>
        
    </div>

    <script src="<?= BASE_URL ?>/js/listFiltering.js" type="module"></script>

</body>

</html>