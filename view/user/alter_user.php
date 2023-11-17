<?php require __DIR__ . "/../componentes/header.php" ?>

<link rel="stylesheet" href="<?= BASE_URL ?>/view/user/alter_user.css">

<!-- MAIN CONTENT-->
<main class="main-content col-md-10 px-md-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 class="content-title" style="color: #58b352">Alterar Usuário</h1>

        <!-- MENUZINHO DE OPÇÕES-->
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
            </div>
        </div>
    </div>

    <?php if (isset($dados["user"])) : ?>
        <?php $isActive = $dados["user"]->getActive();
        $userRole = $dados["user"]->getRole();
        ?>

        <form method="POST" action="<?= BASE_URL ?>/controller/UserController.php?action=edit">
            <div id="user_img" style="display:inline-block">
                <?php
                if (!$isActive) {
                    echo "<i class=\"bi bi-person-fill-lock\"></i>";
                } else {
                    echo "<i class=\"bi bi-person-fill\"></i>";
                }
                ?>
            </div>
            <div class="user_name">
                <?php echo $dados["user"]->getCompleteName(); ?>
            </div>

            <label id="role">Função</label>
            <select name="user_role" id="role">
                <?php foreach (UserRoles::cases() as $role) : ?>
                    <option value="<?= $role->name ?>" <?php echo ($userRole == $role->name) ? "selected" : "" ?>>
                        <?= $role->name ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br>

            <label id="active">Está ativo?</label>
            <select name="user_active" id="active">
                <option value="<?= _TRUE_ ?>" <?php echo ($isActive) ? "selected" : "" ?>>Ativo</option>
                <option value="<?= _FALSE_ ?>" <?php echo (!$isActive) ? "selected" : "" ?>>Inativo</option>
            </select>

            <br>

            <button class="buttonSave" type="submit">Gravar</button>
            <input type="text" name="user_id" hidden value="<?php echo $dados["user"]->getId(); ?>">
        </form>

    <?php endif; ?>

</main>

<?php require __DIR__ . "/../componentes/footer.php" ?>