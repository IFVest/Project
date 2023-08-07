<?php
  require_once(__DIR__ . "/../../util/config.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="<?=BASE_URL?>/view/user/signup.css" />
    <title>Signup</title>
  </head>
  <body>
    <form method="POST" action="<?= BASE_URL ?>/controller/UserController.php?action=save">
      <div class="container">
        <div class="card">
          <h1>Cadastrar</h1>
          <form>

          <div id="msgError"></div>
          <div id="msgSuccess"></div>

          <div class="label-float">
            <input type="text" id="nome" name="name" placeholder=" " required />
            <label id="labelNome" for="nome">Nome</label>
          </div>

          <div class="label-float">
            <input type="email" id="email" name="email" placeholder=" " required />
            <label id="labelEmail" for="usuario">E-mail</label>
          </div>

          <div class="label-float">
            <input type="password" id="senha" name="pass" placeholder=" " required />
            <label id="labelSenha" for="senha">Senha</label>
            <i id="verSenha" class="fa fa-eye" aria-hidden="true"></i>
          </div>

          <div class="label-float">
            <input type="password" id="confirmSenha" name="passConfirm" placeholder=" " required />
            <label id="labelConfirmSenha" for="confirmSenha"
              >Confirmar Senha</label
            >
            <i id="verConfirmSenha" class="fa fa-eye" aria-hidden="true"></i>
          </div>

          <div class="justify-center">
            <button>Cadastrar</button>
          </div>

          <input type="hidden">
        </div>
      </div>
    </form>
    
    <p>
      Site oficial
      <a href="https://ifpr.edu.br/foz-do-iguacu/" class="site">
        Clique aqui
      </a>
    </p>
   

    <script src="./signup.js"></script>
  </body>
</html>