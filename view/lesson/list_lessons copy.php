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
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/view/lesson/list_lesson.css">
</head>

<body>
    <h1 class="title">Listar Aulas</h1>

    <div class="teste" style="position: relative; float:left;">

    </div>


    <div class="lessonListing" >
        <div class="video" style="display:inline-block"></div>
        <div class="list" style="display:inline-block">
            
        </div>
    </div>


    <script src="<?= BASE_URL ?>/js/lessonListFiltering.js" type="module"></script>
</body>

</html>