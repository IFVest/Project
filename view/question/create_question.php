<?php
require(__DIR__ . "/../componentes/header.php");
require_once(__DIR__ . "/../../util/config.php");
?>
<link rel="stylesheet" href="<?= BASE_URL ?>/view/question/create_question.css">

<!-- MAIN CONTENT-->
<main class="main-content col-md-10 px-md-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 style="color: #58b352"> <?php if (!isset($dados['id']) || $dados['id'] == NULL) echo "Inserir";
                else echo "Alterar"; ?> questão</h1>

        <!-- MENUZINHO DE OPÇÕES-->
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
            </div>
        </div>
    </div>

    <form method="POST" action="<?= BASE_URL ?>/controller/QuestionController.php?action=save">
        <select name="question_module" required>
            <?php
            foreach ($dados['modules'] as $module) : ?>
                <option value="<?php echo $module->getId() ?>" <?php echo (isset($dados["question"]) && $module->getId() == $dados["question"]->getModule() ? "selected" : ''); ?>>
                    <?php echo $module->getName(); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <br /><br />

        <label for="question_text">Enunciado: </label>
        <textarea rows="5" cols="25" maxlength="500" name="question_text" value="<?php echo (isset($dados["question"]) ? $dados["question"]->getText() : ''); ?>" required></textarea>
        <br>


        <!-- Create alternatives while create the question -->
        <?php for ($i = 1; $i <= 5; $i++) {
            echo '<label for="alternative' . $i . '">Alternativa' . $i . ' </label>';
            echo '<input type="text" name="alternative' . $i . '" value="' .
                (isset($dados['question']) && $dados['question']->getAlternatives() ? $dados['question']->getAlternatives()[$i - 1]->getText() : '')
                . '" required> ';
            echo '<input required type="radio" class="correct" name="correctAlternative" value=' . $i . ' ' .
                (isset($dados['question']) && $dados['question']->getAlternatives()[$i - 1]->getIsCorrect() ? 'checked' : '')
                . '>';
            echo '<br>';
        }
        ?>

        <input type="hidden" name="question_id" value="<?php echo $dados['id']; ?>">

        <button class="buttonSave" type="submit">Gravar</button>
    </form>

    <div class="error-div">
        <?php require_once(__DIR__ . "/../include/msg.php"); ?>
    </div>

</main>

<?php require __DIR__ . "/../componentes/footer.php" ?>