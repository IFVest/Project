<?php 
require_once(__DIR__ . "/../componentes/header.php");
require_once(__DIR__ . "/../../model/UserRoles.php");
?>

<main class="main-content col-md-10 px-md-5">

    <h1>Alterar Usuário</h1>

    <?php if (isset($dados["user"])):?>
        <?php $isActive = $dados["user"]->getActive(); 
            $userRole = $dados["user"]->getRole();
        ?>

        <form method="POST" action="<?= BASE_URL ?>/controller/UserController.php?action=edit">
            <div id="user_img" style="display:inline-block">
                <?php 
                    if (!$isActive){
                        echo "<i class=\"bi bi-person-fill-lock\"></i>";
                    }
                    else{
                        echo "<i class=\"bi bi-person-fill\"></i>";
                    }
                ?>
            </div>
            <div class="user_name">
                <?php echo $dados["user"]->getCompleteName(); ?>
            </div>
        
            <label id="role">Função</label>
            <select name="user_role" id="role">
                <?php foreach(UserRoles::cases() as $role): ?>
                    <option value="<?= $role->name ?>"
                        <?php echo ($userRole == $role->name) ? "selected" : "" ?>> 
                        <?= $role->name ?> 
                    </option>
                <?php endforeach; ?>
            </select>
            
            <br>

            <label id="active">Está ativo?</label>
            <select name="user_active" id="active">
                <option value="<?= _TRUE_ ?>" <?php echo ($isActive) ? "selected" : "" ?> >Ativo</option>
                <option value="<?= _FALSE_ ?>" <?php echo (!$isActive) ? "selected" : "" ?> >Inativo</option>
            </select>
            
            <br>

            <button type="submit" >Gravar</button>
            <input type="text" name="user_id" hidden value="<?php echo $dados["user"]->getId(); ?>">
        </form>
        
    <?php endif;?>
</main>


