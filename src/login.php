<?php

// Iniciando Sessão.
session_start();

?>

<!DOCTYPE html>
  <html lang="pt-br">

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/login/login.css">

      <title>Login</title>
    </head>

    <body>

<div class="container">

      <br>

      <form class="form-signin" method="POST" action="try-login.php">

            <?php
              if ( isset( $_SESSION['msg'] ) ) {
                echo $_SESSION['msg'].'<br>';
                unset($_SESSION['msg']);
              }

              if ( isset( $_SESSION['msg-create-user'] ) ) {
                echo $_SESSION['msg-create-user'].'<br>';
                unset($_SESSION['msg-create-user']);
              }

            ?>


          <h2 class="form-signin-heading">Formulário de Login</h2>
          <label for="user" class="sr-only">Usuário</label>
          <input type="text" id="user" name="user" placeholder="Digite seu nome de usuário" value='admin' required autofocus class="form-control">
          <br>
          <label for="passwd" class="sr-only">Senha</label>
          <input type="password" id="passwd" name="passwd" placeholder="Digite sua senha" value='123456' required class="form-control">
          <br>
          <input type="submit" name="btnLogin" value="Login" class="btn btn-lg btn-primary btn-block">

          <br><br>
          <p>Cria um nova conta <a href="create-user.php">aqui</a></p>
      </form>

</div> <!-- /container -->


    </body>

  </html>
