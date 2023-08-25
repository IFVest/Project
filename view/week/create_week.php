<?php 
require (__DIR__. "/../componentes/header.php");
require_once(__DIR__ . "/../../model/Subjects.php");
?>
    <script src="<?= BASE_URL ?>/js/weekFilterByModule.js" type="module"></script>
    <script src="<?= BASE_URL ?>/js/weekLessons.js"></script>
    
    <!-- MAIN CONTENT-->
    <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
        <h1><?php if (!isset($dados["id"]) || $dados["id"] == NULL) echo "Criar";
        else echo "Alterar"; ?> semana</h1>
            
            <!-- MENUZINHO DE OPÇÕES-->
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
                </div>
            </div>
        </div>

        <!-- <h5 class="content-subtitle">Espaço para a criação de questões!</h5> -->
        
       
        <form method="POST" action="<?= BASE_URL ?>/controller/WeekController.php?action=save">
        Título: <input type="text" name="week_marker" value="<?php echo isset($dados["week"]) ? $dados["week"]->getMarker() : ''; ?>">
        <br>
        Matéria:
        <select name="subjects">
            <?php foreach (Subjects::cases() as $subject) : ?>
                <option class="subject" value="<?php echo $subject->name; ?>"><?php echo $subject->name ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        Módulos:
        <div class="modules"></div>
        <br>
        Aulas:
        <div class="lessons"></div>
        <br>
        Aulas selecionadas:
        <div class="selected-lessons">
            <?php if (isset($dados["week"]) && !empty($dados["week"]->getLessons())) {
                foreach ($dados["week"]->getLessons() as $lesson) : ?>
                    <div class="lesson-card">
                        <iframe src="<?php echo $lesson->getUrl(); ?>" width="250" height="200"></iframe>
                        <div class="card-body">
                            <button type="button" onclick="removeVideo(this)">Remover</button>
                            <input hidden name="week_lessons[]" value="<?php echo $lesson->getId(); ?>">
                        </div>
                    </div>
            <?php endforeach;
            } ?>
        </div>
        <button type="submit">Gravar</button>

        <input type="hidden" name="week_id" value="<?php echo isset($dados["id"]) ? $dados["id"] : NULL ?>">
    </form>
    <br>
    <div class="col-6">
        <?php require_once(__DIR__ . "/../include/msg.php"); ?>
    </div>

    </main>

    <?php require __DIR__. "/../componentes/footer.php"?>       