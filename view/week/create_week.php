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
            <?php foreach(Subjects::cases() as $subject):?>
                <option class="subject" value="<?php echo $subject->name; ?>"><?php echo $subject->name ?></option>
            <?php endforeach;?>
        </select>
        <div class="modules">

        </div>
    </form>
</body>

<script>
    
    let subjectRadio = document.querySelectorAll('.subject')
    
    subjectRadio.forEach(subject => 
        subject.addEventListener('click', filterBySubject)
    )
    let divModules = document.querySelector('.modules')

    function filterBySubject(event){
        let subject
        subjectRadio.forEach(subject => 
            subject.checked ? subject = subject.value : ''
        )

        let xml = new XMLHttpRequest()
        xml.open("GET", "../../controller/ModuleController.php?action=findBySubject&subject=${subject}", true)
        xml.onload = function() {
            if (xml.status >= 200 && xml.status < 400) {
                var modules = this.responseText
                console.log(this.responseText)
            }
        }
        xml.send()
    }


</script>
</html>