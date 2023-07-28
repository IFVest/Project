<?php
include(__DIR__ . "/componentes/sideBar.php");
?>

<!doctype html>
<html>

<head>
    <title>Configurações</title>
    <link rel="stylesheet" href="./css/settings.css">
</head>

<body>
    <!-- <h2>Configurações</h2> -->
    <div class="container container-fluid d-flex flex-wrap col-6">
        <div class="row">
            <div class="col-2 mb-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <a href="./lesson/create_lesson.php">Criar aula</a>
                    </div>
                </div>
            </div>
        </div>
    

    <div class="container container-fluid d-flex flex-wrap col-3">
        <div class="row">
            <div class="col-2 mb-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <a href="./lesson/list_lessons.php">Listar aula</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container container-fluid d-flex flex-wrap col-3"> -->
        <div class="row">
            <div class="col-2 mb-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <a href="./question/create_question.php">Criar Questão</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->

    <div class="container container-fluid d-flex flex-wrap col-3">
        <div class="row">
            <div class="col-2 mb-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <a href="./question/list_questions.php">Listar Questão</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container container-fluid d-flex flex-wrap col-3"> -->
        <div class="row">
            <div class="col-2 mb-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <a href="./module/create_module.php">Criar Modulo</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->

    <div class="container container-fluid d-flex flex-wrap col-3">
        <div class="row">
            <div class="col-2 mb-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <a href="./module/list_modules.php">Listar Modulo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>