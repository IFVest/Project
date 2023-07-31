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
    <link rel="stylesheet" href="<?=BASE_URL?>/view/user/signin.css" />
    <title>Singin</title>
  </head>
  <body>
    <form method="POST" action="<?= BASE_URL ?>/controller/UserController.php?action=login">
    <div class="main-login">

      <div class="left-card">
        <h1>Entre na plataforma preparatória para o IFPR</h1>
            <img src="../images/IFVESTpng.png" alt="ifvest"/>
      </div>

      <div class="right-card">
        <h1>Entrar</h1>


        <div class="label-float">
          <input type="email" id="email" name="email" onchange="onChangeEmail()" />
          <label id="userEmail" for="email">E-mail</label>
          <div class="error" id="email-required-error">E-mail é obrigatório</div>
          <div class="error" id="email-invalid-error">E-mail inválido</div>
        </div>

        <div class="label-float">
          <input type="password" id="senha" name="pass" onchange="onChangeSenha()"/>
          <label id="senhaLabel" for="senha">Senha</label>
          <i class="fa fa-eye" aria-hidden="true"></i>
          <div class="error" id="senha-required-error">Senha é obrigatória</div>
        </div>

        <div class="justify-center">
          <button type="button" id="login-button" disabled="true">Entrar</button>
        </div>

        <div class="justify-center">
          <a href="<?= BASE_URL ?>/view/user/signup.php">
            <button type="button" id="cadastro">Cadastre-se</button>
          </a>
        </div>

        </form>

        <div class="justify-center">
          <hr />
        </div>

        <p>
          Esqueceu sua senha?
          <a href="#">
            Recuperar senha
          </a>
          </p>
            <p>
              <a href="https://ifpr.edu.br/foz-do-iguacu/">
                Site oficial do IFPR
              </a>
            </p>
          </p>
        </p>
      </div>
    </div>

    <script src="singin.js"></script>
  </body>
</html>