<?php
include_once(__DIR__ . "/../../util/config.php");

if(session_status() != PHP_SESSION_ACTIVE)
    session_start();
    echo "<script>console.log('".$_SESSION["userId"]."')</script>";

if (! isset($_SESSION["userId"])) {
    header("location: ". SIGNIN_PAGE);
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Maria Eduarda">
    <title></title>

    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom styles for this template -->
    <link href="<?= BASE_URL ?>/view/css/style.css" rel="stylesheet">



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;900&family=Roboto+Slab:wght@100;300;400;500;600&family=Roboto:wght@300;400;500;700;800&display=swap" rel="stylesheet">



</head>
<body class="ifvest">

    <!-- HEADER -->
    <header class="navbar sticky-top flex-md-nowrap p-0 d-flex justify-content-start">

        <!-- LOGO -->
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">ifvest</a>

        <a id="sidebar-button" class="d-none d-md-block" ><span><i class="bi bi-water"></i></span></a>

        <!-- RESPONSIVO - SOMENTE APARECE EM DISPOSITIVOS MENORES (d-md-none)    -->
        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 responsive-button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false">
                    <span><i class="bi bi-water"></i></span>
                </button>
            </li>
        </ul>

    </header>

    <!-- CONTEUDO PRINCIPAL -->
    <div class="container-fluid">
        
        <div class="row">

            <!-- SIDE BAR-->
            <div class="sidebar border-right col-md-2 p-0">
                <div class="offcanvas-md offcanvas-end" tabindex="-1" id="sidebarMenu">
                    <div class="offcanvas-header d-md-none d-flex align-items-end">
                        <button type="button" class="btn-close align-self-end" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        
                        <h6 class="label">
                            <span>Campus</span>
                        </h6>

                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>/view/sobre.php">
                                    <span></i>Sobre</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>/view/ingresso.php">
                                    <span></i>Ingresso</span>
                                </a>
                            </li>
                        </ul>

                        <h6 class="label">
                            <span>Estudos</span>
                        </h6>
                        
                        <ul class="nav flex-column mb-auto">
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>/controller/WeekController.php">
                                    <span></i>Cronograma</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>/controller/ExamController.php?action=create">
                                    <span></i>Simulados</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>/controller/LessonController.php">
                                    <span></i>Materias</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>/controller/ExamController.php?action=listAll">
                                    <span></i>Historico</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= BASE_URL ?>/view/configuracoes.php">
                                    <span></i>Configurações</span>
                                </a>
                            </li>
                            
                        </ul>

                        <!-- LINHA SEPARADORA -->
                        <hr class="my-3">

                        <ul class="nav flex-column mb-auto">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="#">
                                    Sair
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
