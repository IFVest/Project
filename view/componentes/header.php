<?php
include_once(__DIR__ . "/../../util/config.php");
require_once(__DIR__ . "/../../model/UserRoles.php");
require_once(__DIR__ . "/../../service/AcessService.php");

$acessService = new AcessService();
$isAdmin = $acessService->hasRole(UserRoles::Administrador);
$isTeacher = $acessService->hasRole(UserRoles::Professor);
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Maria Eduarda">
    <title></title>
    <scale=1.0">

    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/view/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;900&family=Roboto+Slab:wght@100;300;400;500;600&family=Roboto:wght@300;400;500;700;800&display=swap" rel="stylesheet">

    <title>home</title>
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
                            <?php if ($isAdmin or $isTeacher): ?>
                                <h6 class="label">
                                    <span>Administração</span>
                                </h6>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?= BASE_URL ?>/view/configuracoes.php">
                                        <span>Configurações</span>
                                    </a>
                                </li>

                                <?php if ($isAdmin): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= BASE_URL ?>/controller/UserController.php?action=list">
                                            <span>Usuários</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
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
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
