
<?php 
require(__DIR__. "/../componentes/header.php");
require_once(__DIR__ . "/../../util/config.php");
require_once(__DIR__ . "/../../model/Subjects.php");

?>

    <!-- MAIN CONTENT-->
    <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
            <h1 class="content-title"> <?php if (! isset($dados['id']) || $dados['id'] == NULL) echo "Inserir";
            else echo "Alterar"; ?> módulo</h1>
            
            <!-- MENUZINHO DE OPÇÕES-->
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">exportar</button>
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary btn-rounded dropdown-toggle d-flex align-items-center gap-1">
                    <i class="bi bi-flower1"></i>
                    opção dropdown
                </button>
            </div>
        </div>

        <h5 class="content-subtitle">Espaço para criação de novos modulos!</h5>


        <form method="POST" action="<?= BASE_URL ?>/controller/ModuleController.php?action=save">
        Nome:<input type="text" name="module_name" value="<?php echo (isset($dados["module"]) ? $dados["module"]->getName() : '');?>">
        <br>
        Descricao: <input type="text" name="module_desc" value="<?php echo (isset($dados["module"]) ? $dados["module"]->getDescription() : ''); ?>">
        <br>
        Matéria: <select name="module_subject">
            <?php $i = 1; foreach(Subjects::cases() as $subject):?>
                <option value="<?php echo $i;?>" 
                <?php echo (isset($dados["module"]) && $subject->name == $dados["module"]->getSubject() ? "selected" : '');?>>
                    <?php echo $subject->name;?>
                </option>
                <?php $i++;?>
            <?php endforeach;?>
        </select>
        <input type="hidden" name="module_id" value="<?php echo isset($dados["id"]) ? $dados["id"] : NULL;?>">

        <button type="submit">Gravar</button>
    </form>

    <a href="../../controller/ModuleController.php">
        <button>Ver módulos</button>
    </a>

    <div class="col-2">
        <?php require_once(__DIR__ . "/../include/msg.php");?>
    </div>

    </main>

    <?php require __DIR__. "/../componentes/footer.php"?>       