<?php require __DIR__. "/../componentes/header.php"?>

<link rel="stylesheet" href="<?= BASE_URL ?>/view/user/list_users.css">


    <!-- MAIN CONTENT-->
    <main class="main-content col-md-10 px-md-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            
            <h1 class="content-title" style="color: #58b352">Usuários Cadastrados</h1>
            
            <!-- MENUZINHO DE OPÇÕES-->
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                </div>
            </div>
        </div>

        <label for="user_name">Filtre por nome: </label>
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
                                <a href="<?php echo BASE_URL ?>/controller/UserController.php?action=alter&id=<?= $user->getId();?>">
                                <br/>
                                    <button class="btn btn-primary w-25 mt-3" style="display:inline; padding-left: 15px ">Alterar</button>
                                </a>

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

    <?php require __DIR__. "/../componentes/footer.php"?>       