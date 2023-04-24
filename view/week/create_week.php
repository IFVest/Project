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

        Matéria: <br>
        <?php foreach(Subjects::cases() as $subject):?>
            <input type="radio" name="subject" class="subject" value="<?php echo $subject->name;?>">
            <?php echo $subject->name; ?>
        <?php endforeach;?>

        <div class="modules">

        </div>
    </form>
</body>

<script>
    let subjectRadio = document.querySelector('.subject')
    let divModules = document.querySelector('.modules')
    subjectRadio.addEventListener('change', filterBySubject)

    function filterBySubject(event){
        let xml = new XMLHttpRequest()
        xml.open()
        let modules = []
    }


</script>
</html>