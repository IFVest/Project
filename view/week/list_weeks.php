<?php require __DIR__ . "/../componentes/header.php" ?>

<link rel="stylesheet" href="<?= BASE_URL ?>/view/week/list_week.css">

<!-- MAIN CONTENT-->
<main class="main-content col-md-10 px-md-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 class="content-title">Listar semanas</h1>

        <!-- MENUZINHO DE OPÇÕES-->
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
            </div>
        </div>
    </div>

    <div class="">
        <?php foreach ($dados["lista"] as $week) : ?>
            <div class="week">

                <div class="row">
                    <div class="col-md-9">
                        <!-- Titulo da semana -->
                        <h5><?= $week->getMarker() ?></h5>

                    </div>

                    <?php if ($isAdmin || $isTeacher):?>
                        <div class="col-md-3">
                        <a class="btn btn-secondary" href="WeekController.php?action=edit&id=<?php echo $week->getId(); ?>">
                            Alterar
                        </a>
                        <a class="btn btn-secondary" href="WeekController.php?action=delete&id=<?php echo $week->getId(); ?>">
                            Deletar
                        </a>
                    </div>
                    <?php endif;?>
                    
                </div>
                <hr>
            </div>

            <?php if (!empty($week->getLessons())) :?>
                <div class="row">
                <?php foreach ($week->getLessons() as $lesson) : ?>
                    <div class="lesson col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                
                                <iframe id="<?php echo $lesson->getId(); ?>" src="<?php echo $lesson->getUrl(); ?>"></iframe>
                                
                                <div class="lesson-title">
                                    <label for="lesson-<?php echo $lesson->getId(); ?>"><?php echo $lesson->getTitle(); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
    </div>
</main>

<?php require __DIR__ . "/../componentes/footer.php" ?>