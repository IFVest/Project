<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hahahah</h1>
    <?php foreach($dados["lista"] as $week):?>
        <div class="week">
            <?php echo $week->getMarker();?>
            <button>Alterar</button>
            <button>Deletar</button>
        </div>
        <div class="week-lessons">
            <?php foreach($week->getLessons() as $lesson): ?>
                <div class="lesson"></div>
            <?php endforeach;?>
        </div>
    <?php endforeach;?>
</body>
</html>