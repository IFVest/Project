<?php
    require_once(__DIR__ . "/../../util/config.php");
?> 


<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questão</title>
</head>

<body>
    <h1> <?php if ($dados['id'] == NULL) echo "Inserir";
            else echo "Alterar"; ?> questão</h1>

    <form method="POST" action="<?= BASE_URL ?>/controller/QuestionController.php?action=save">
        <select name="question_module" required>
            <?php
            foreach($dados['modules'] as $module):?>
                <option value="<?php echo $module->getId()?>" 
                <?php echo ($dados["question"] && $module == $dados["question"]->getModule() ? "selected" : '');?>>
                    <?php echo $module->getName();?>
                </option>
            <?php endforeach;?>
        </select><br>

        <label for="question_text">Enunciado: </label>
        <input type="text" name="question_text" value="<?php echo ($dados["question"] ? $dados["question"]->getText() : '');?>"required>
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
</body>

</html>