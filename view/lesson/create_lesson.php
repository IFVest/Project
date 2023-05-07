<?php
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
</head>

<body>
    <h1> <?php if ($dados["id"] == 0) echo "Criar";
            else echo "Alterar"; ?> aula </h1>

    <form method="POST" action="<?= BASE_URL ?>/controller/LessonController.php?action=save">
        Titulo:<input type="text" name="lesson_title" value="<?php echo ($dados["lesson"]) ? $dados["lesson"]->getTitle() : '' ?>">
        <br>
        Url:<input type="text" name="lesson_url" value="<?php echo ($dados["lesson"]) ? $dados["lesson"]->getUrl() : ''; ?>">
        <br>
        Matéria: <select name="subjects">
            <?php foreach (Subjects::cases() as $subject) : ?>
                <option class="subject" value="<?php echo $subject->name; ?>"><?php echo $subject->name ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        Módulos:
        <div class="modules">

        </div>

        <input type="text" hidden name="lesson_user">
        <input type="text" hidden name="lesson_id" value="<?php echo $dados["id"]; ?>">
        <br>
        <button type="submit">Gravar</button>
    </form>


</body>

<script>
    var subjects = document.querySelectorAll(".subject")
    var modulesDiv = document.querySelector(".modules")

    subjects.forEach(subject =>
        subject.addEventListener("click", filterBySubject)
    )

    function filterBySubject(event) {
        var modules
        subjects.forEach(subject =>
            subject.selected ? selectedSubject = subject.value : ''
        )
        var xhttp = new XMLHttpRequest()
        xhttp.open("GET", "LessonController.php?action=findModulesBySubject&subject=" + selectedSubject, true)
        xhttp.onload = function() {
            if (xhttp.status >= 200 && xhttp.status < 400) {
                modules = JSON.parse(this.responseText)
                console.log(modules)
            }
        }
        xhttp.send()

        setModules(modules)
    }

    function setModules(subjectModules) {
        var select = document.createElement("select")

        for(subject in subjectModules) {
            var option = document.createElement("option")
        }

        modulesDiv.appendChild(select)
    }
</script>

</html>