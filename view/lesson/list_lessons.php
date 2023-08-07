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
        <?php foreach (Subjects::cases() as $subject) : ?>
                    <div class="modules" id="<?php echo $subject->name; ?>"></div>
                    <br>
            <?php endforeach; ?>
    </div>


    <div class="lessonListing" >
        <div class="video" style="display:inline-block"></div>
        <div class="list" style="display:inline-block">
            <?php foreach (Subjects::cases() as $subject) : ?>
                <div style="background-color: #cdd2c1; "> 
                    <button class="subject" style="width: 220px; height: 80px"> <?php echo $subject->name; ?> </button>
                    <!-- <div class="modules" id="<?php echo $subject->name; ?>"></div> -->
                    <br>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <script src="<?= BASE_URL ?>/js/lessonListFiltering.js" type="module"></script>
</body>

</html>