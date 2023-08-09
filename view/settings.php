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

            <div class="col-md-12 col-lg-2  mb-4">
                <div class="card">
                    <div class="card-body">
                    <a href="../controller/LessonController.php">Listar aula</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-2  mb-4">
            <div class="card">
                    <div class="card-body">
                    <a href="../controller/QuestionController.php?action=create">Criar Questão</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-2  mb-4">
            <div class="card">
                    <div class="card-body">
                    <a href="../controller/QuestionController.php">Listar Questão</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-2  mb-4">
            <div class="card">
                    <div class="card-body">
                    <a href="../controller/ModuleController.php?action=create">Criar Modulo</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-2  mb-4">
            <div class="card">
                    <div class="card-body">
                    <a href="../controller/ModuleController.php">Listar Modulo</a>
                    </div>
                </div>
            </div>


        </div>
            </div>
    
    
        </div>
        <!-- /.layout -->
    
    </div> <!-- ./container-fluid -->
    

</body>

</html>