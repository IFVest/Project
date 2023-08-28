<?php
    require_once(__DIR__ . "/../componentes/header.php");
    require_once(__DIR__ . "/../../util/config.php");
    require_once(__DIR__ . "/../../model/User.php");
    require_once(__DIR__ . "/../../model/UserRoles.php");

?>
<main class="main-content col-md-10 px-md-5">
    <h1>Usuários</h1>
    <input type="text" name="user_name">

    <div class="col-2">
        <?php require_once(__DIR__ . "/../include/msg.php");?>
    </div>

    <?php if (isset($dados)):?>
        <div class="container container-fluid d-flex flex-wrap col-3">
        <?php foreach ($dados["lista"] as $user): ?>
            <form method="POST" action="<?= BASE_URL ?>/controller/UserController.php?action=edit&id=<?=$user->getId();?>">
                <div class="row">
                    <div class="col-2 mb-4">
                        <div class="card" style="width: 28rem;"> 
                            <div class="card-body">
                                <i class="bi bi-person-fill"></i>
                                <div class="name" style="display:inline; padding-left:15px">
                                    <?php echo $user->getCompleteName();?>
                                </div>
                                <div class="role" style="display:inline; padding-left:15px">
                                    <select name="user_role">
                                        <?php foreach(UserRoles::cases() as $role): ?>
                                            <option <?php echo ($role->name == $user->getRole()) ? "selected" : "" ?> value="<?= $role->name ?>">
                                                <?= $role->name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="role" style="display:inline; padding-left:15px">
                                    <select name="user_active">
                                        <option value="1" <?= $user->getActive() == "1" ? "selected" : "" ?> >Ativo</option>
                                        <option value="0" <?= $user->getActive() == "0" ? "selected" : "" ?> >Inativo</option>
                                    </select>
                                </div>

                                <input name="user_id" value="<?= $user->getId(); ?>" hidden>

                                <button class="btn btn-primary w-100" type="submit" style="display:inline; right:0">Alterar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php endforeach; ?>
        </div>
        
    <?php endif; ?>
</main>
