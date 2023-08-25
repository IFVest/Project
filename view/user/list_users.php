<?php
    require_once(__DIR__ . "/../componentes/header.php");
    require_once(__DIR__ . "/../../model/User.php");
    require_once(__DIR__ . "/../../model/UserRoles.php");

?>
<main class="main-content col-md-10 px-md-5">
    <h1>Usuários</h1>
    <input type="text" name="user_name">

    <?php if (isset($dados)):?>
        <div class="container container-fluid d-flex flex-wrap col-3">
        <?php foreach ($dados["lista"] as $user): ?>
                <div class="row">
                    <div class="col-2 mb-4">
                        <div class="card" style="width: 18rem;"> 
                            <div class="card-body">
                                <i class="bi bi-person-fill"></i>
                                <div class="name" style="display:inline; padding-left:15px">
                                    <?php echo $user->getCompleteName();?>
                                </div>
                                <div class="role" style="display:inline; padding-left:15px">
                                    <select>
                                        <?php foreach(UserRoles::cases() as $role): ?>
                                            <option <?php echo ($role->name == $user->getRole()) ? "selected" : "" ?>>
                                                <?= $role->name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <a href="#" class="btn btn-danger w-100" style="display:inline; right:0">Inativar</a>
                            </div>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
        </div>
        
    <?php endif; ?>
</main>
