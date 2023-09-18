
<?php require __DIR__. "/../componentes/header.php"?>

    <!-- MAIN CONTENT-->
    <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
            <h1 class="content-title">Listar semanas</h1>
            
            <!-- MENUZINHO DE OPÇÕES-->
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">exportar</button>
                </div>
            </div>
        </div>

        <!-- <h5 class="content-subtitle">subtítulo</h5>
        <p class="content-subtitle-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> -->

        <div class="col-md-6">
        <?php foreach ($dados["lista"] as $week) : ?>
        <div class="week">
            <!--  -->
            <div class="mb-md-3">
            <a class="btn btn-secondary" href="WeekController.php?action=edit&id=<?php echo $week->getId();?>">
                Alterar
            </a>
            <a class="btn btn-secondary" href="WeekController.php?action=delete&id=<?php echo $week->getId();?>">
                Deletar
            </a>
            </div>
        </div>
        <div class="">
            <?php if (!empty($week->getLessons())) {
                foreach ($week->getLessons() as $lesson) : ?>
                    <div class="lesson">
                        <label  for="lesson-<?php echo $lesson->getId(); ?>"><?php echo $lesson->getTitle(); ?></label>
                        <iframe id="<?php echo $lesson->getId(); ?>" src="<?php echo $lesson->getUrl(); ?>"></iframe>
                    </div>
            <?php endforeach; }?>
        </div>
    <?php endforeach; ?>
    </div>
    </main>

    <?php require __DIR__. "/../componentes/footer.php"?>       