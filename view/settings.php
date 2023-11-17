<?php include(__DIR__ . "./componentes/sideBar.php"); ?>

<link rel="stylesheet" href="./css/settings.css">



    <!-- <h2>Configurações</h2> -->

            <div id="main-content" class="col">
                        <div class="row">
            <div class="col-md-12 col-lg-2  mb-4 ">
                <div class="card">
                    <div class="card-body">
                        <a href="../controller/LessonController.php?action=create">Criar aula</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="container container-fluid d-flex flex-wrap col-3">
            <div class="row">
                <div class="col-2 mb-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <a href="../controller/LessonController.php">Listar aula</a>
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
                        <a href="../controller/QuestionController.php?action=create">Criar Questão</a>
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
                            <a href="../controller/QuestionController.php">Listar Questão</a>
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
                        <a href="../controller/ModuleController.php?action=create">Criar Modulo</a>
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
                            <a href="../controller/ModuleController.php">Listar Modulo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-2 mb-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <a href="../controller/WeekController.php?action=create">Criar Semana</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="container container-fluid d-flex flex-wrap col-3">
            <div class="row">
                <div class="col-2 mb-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <a href="../controller/WeekController.php">Listar Semana</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
</body>

</html>