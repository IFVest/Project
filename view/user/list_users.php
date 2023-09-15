<?php
    require_once(__DIR__ . "/../componentes/header.php");
    require_once(__DIR__ . "/../../util/config.php");
    require_once(__DIR__ . "/../../model/User.php");
    require_once(__DIR__ . "/../../model/UserRoles.php");

?>
<main class="main-content col-md-10 px-md-5">
    <h1>Usuários</h1>
    <input type="text" id="user_name">
    <input type="text" id="baseurl" value="<?php echo BASE_URL ?>" hidden>

    <div class="col-2">
        <?php require_once(__DIR__ . "/../include/msg.php");?>
    </div>

    <?php if (isset($dados)):?>
        <div class="container container-fluid d-flex flex-wrap col-3 users">
        <?php foreach ($dados["lista"] as $user): ?>
            <?php $isActive = $user->getActive();?>
                <div class="row">
                    <div class="col-2 mb-4">
                        <div class="card" style="width: 28rem;"> 
                            <div class="card-body">
                                <?php 
                                    if (!$isActive){
                                        echo "<i class=\"bi bi-person-fill-lock\"></i>";
                                    }
                                    else{
                                        echo "<i class=\"bi bi-person-fill\"></i>";
                                    }
                                ?>
                                <div class="name" style="display:inline; padding-left:15px">
                                    <?php echo $user->getCompleteName();?>
                                </div>
                                <div class="role" style="display:inline; padding-left:15px">
                                    <?php echo $user->getRole(); ?>
                                </div>
                                <div class="active" style="display:inline; padding-left:15px">
                                    <?php
                                        if ($isActive) {
                                            echo "Ativo";
                                        }
                                        else {
                                            echo "Inativo";
                                        }
                                    ?>
                                </div>

                                <button class="btn btn-primary w-25" type="submit" style="display:inline; padding-left: 15px ">Alterar</button>

                               <input name="user_id" value="<?= $user->getId(); ?>" hidden>

                            </div>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
        </div>
        
    <?php endif; ?>

    <script src="<?= BASE_URL ?>/view/user/userFiltering.js"></script>
</main>
