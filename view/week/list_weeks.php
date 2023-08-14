<?php
    require(__DIR__ . "/../componentes/header.php");
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
    <h1>Listar semanas</h1>
    <?php foreach ($dados["lista"] as $week) : ?>
        <div class="week">
            <?php echo $week->getMarker(); ?>
            <a href="WeekController.php?action=edit&id=<?php echo $week->getId();?>">
                <button>Alterar</button>
            </a>
            <a href="WeekController.php?action=delete&id=<?php echo $week->getId();?>">
                <button>Deletar</button>
            </a>
        </div>
        <div class="week-lessons">
            <?php if (!empty($week->getLessons())) {
                foreach ($week->getLessons() as $lesson) : ?>
                    <div class="lesson">
                        <label for="lesson-<?php echo $lesson->getId(); ?>"><?php echo $lesson->getTitle(); ?></label>
                        <iframe id="<?php echo $lesson->getId(); ?>" src="<?php echo $lesson->getUrl(); ?>"></iframe>
                    </div>
            <?php endforeach; }?>
        </div>
    <?php endforeach; ?>
</body>

</html>