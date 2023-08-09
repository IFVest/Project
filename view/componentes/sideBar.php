<?php
include_once(__DIR__ . "/../../util/config.php");

if(session_status() != PHP_SESSION_ACTIVE)
    session_start();
    echo "<script>console.log('".$_SESSION["userId"]."')</script>";

if (! isset($_SESSION["userId"])) {
    header("location: ". SIGNIN_PAGE);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/view/componentes/sideBar.css">
    <title>home</title>
</head>

<body>

    <div class="container-fluid">

        <div class="row layout">

            <div id="side-content">

                <section class="p-4 my-container" style="position: absolute; z-index: 1;">
                    
                    <button class="btn my-4" id="menu-btn">
                        <i class="bi bi-chevron-compact-right"></i>
                    </button>

                </section>

                <nav class="navbar navbar-expand d-flex flex-column align-item-start" id="sidebar">
                    <a href="<?= BASE_URL ?>/view/sobre.php" class="navbar-brand text-light mt-5">
                        <div class="display-5 font-weight-bold">IFVest</div>
                    </a>
                    <ul class="navbar-nav d-flex flex-column mt-5 w-100">

                        <li class="nav-item w-100">
                            <a href="<?= BASE_URL ?>/view/ingresso.php" class="nav-link text-light pl-4">Ingresso</a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="<?= BASE_URL ?>/view/cronograma.php" class="nav-link text-light pl-4">Cronograma</a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="<?= BASE_URL ?>/view/simulados.php" class="nav-link text-light pl-4">Simulados</a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="<?= BASE_URL ?>/view/materias.php" class="nav-link text-light pl-4">Matérias</a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="<?= BASE_URL ?>/view/historico.php" class="nav-link text-light pl-4">Histórico</a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="<?= BASE_URL ?>/view/settings.php" class="nav-link text-light pl-4">Configurações</a>
                        </li>
                    </ul>
                </nav>

            </div>











        <script src=" https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/cjs/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


        <script>
            var menu_btn = document.querySelector("#menu-btn");
            var side_content = document.querySelector("#side-content");
            var main_content = document.querySelector("#main_content");

            var sidebar = document.querySelector("#sidebar");
            var container = document.querySelector(".my-container");

            menu_btn.addEventListener("click", () => {
                sidebar.classList.toggle("active-nav");
                container.classList.toggle("active-cont");

                side_content.classList.toggle("col-3");

            });

        </script>