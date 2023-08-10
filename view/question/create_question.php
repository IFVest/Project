<?php 
require (__DIR__. "/../componentes/header.php");
require_once(__DIR__ . "/../../util/config.php");
?>

    <!-- MAIN CONTENT-->
    <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
        <h1> <?php if (! isset($dados['id']) || $dados['id'] == NULL) echo "Inserir";
            else echo "Alterar"; ?> questão</h1>
            
            <!-- MENUZINHO DE OPÇÕES-->
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-warning btn-rounded">compartilhar</button>
                </div>
            </div>
        </div>

        <h5 class="content-subtitle">Espaço para a criação de questões!</h5>
        
       
        <form method="POST" action="<?= BASE_URL ?>/controller/QuestionController.php?action=save">
        <select name="question_module" required>
            <?php
            foreach($dados['modules'] as $module):?>
                <option value="<?php echo $module->getId()?>" 
                <?php echo (isset($dados["question"]) && $module->getId() == $dados["question"]->getModule() ? "selected" : '');?>>
                    <?php echo $module->getName();?>
                </option>
            <?php endforeach;?>
        </select><br>

        <label for="question_text">Enunciado: </label>
        <input type="text" name="question_text" value="<?php echo (isset($dados["question"]) ? $dados["question"]->getText() : '');?>"required>
        <br>
        
        
        <!-- Create alternatives while create the question -->
        <?php for($i = 1; $i<=5; $i++){
            echo '<label for="alternative'.$i.'">Alternativa'.$i.' </label>';
            echo '<input type="text" name="alternative'.$i.'" value="'.
                (isset($dados['question']) && $dados['question']->getAlternatives() ? $dados['question']->getAlternatives()[$i-1]->getText() : '')
            .'" required> ';
            echo '<input required type="radio" name="correctAlternative" value='.$i.' '.
                (isset($dados['question']) && $dados['question']->getAlternatives()[$i-1]->getIsCorrect() ? 'checked' : '')
            .'>';
            echo '<br>';
            } 
        ?>  
        
        <input type="hidden" name="question_id" value="<?php echo $dados['id']; ?>">
        
        <button type="submit">Gravar</button>
    </form>

    <div class="error-div">
        <?php require_once(__DIR__ . "/../include/msg.php");?>
    </div>

    </main>

    <?php require __DIR__. "/../componentes/footer.php"?>       