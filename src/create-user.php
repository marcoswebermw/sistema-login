<?php
// Iniciando Sessão.
session_start();
// Output buffer.
ob_start();

$btnCreateUser = filter_input(INPUT_POST, 'btnCreateUser', FILTER_SANITIZE_STRING);

if ($btnCreateUser) {
  include_once('connection.php');

  $data_from_form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  $errors = false;

  $data_without_tags = array_map('strip_tags', $data_from_form);
  $data_without_trim = array_map('trim', $data_without_tags);
  $data = $data_without_trim;

  if (in_array('', $data)) {
    $errors = true;
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Preencha todos os campos</div>';
  } elseif( (strlen($data['passwd']) < 6)) {
    $errors = true;
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Senha tem que ter pelo menos <strong>6</strong> caracteres</div>';
  } elseif( stristr($data['passwd'], "'") ) {
    $errors = true;
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Proibido usar o caracter <strong>\'</strong> na senha </div>';
  } else {
    $find_user = "SELECT id FROM users WHERE user='".$data['user']."'";
    $user_found = mysqli_query($conn, $find_user);

    if( ($user_found) AND ($user_found->num_rows != 0) ){
      $errors = true;
      $_SESSION['msg'] = $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Esse <strong>usuário</strong> já foi cadastrado</div>';
    }

    $find_email = "SELECT id FROM users WHERE email='".$data['email']."'";
    $email_found = mysqli_query($conn, $find_email);

    if( ($email_found) AND ($email_found->num_rows != 0) ){
      $errors = true;
      $_SESSION['msg'] = $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Esse <strong>email</strong> já foi cadastrado</div>';
    }

  }

  if(!$errors){
    $data['passwd'] = password_hash($data['passwd'], PASSWORD_DEFAULT);

    $insert_user = "INSERT INTO users (name, email, user, passwd) VALUES
    ('".$data['name']."', '".$data['email']."', '".$data['user']."', '".$data['passwd']."' )";

    $user_was_insert = mysqli_query( $conn, $insert_user);

    if (mysqli_insert_id($conn)) {
      $_SESSION['msg-create-user'] = '<div class="alert alert-success" role="alert">Usuário cadastrado com sucesso!</div>';
      header('Location: login.php');
    } else {
      $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro no cadastro do usuário</div>';
    }

  }

}

?>

<!DOCTYPE html>
  <html lang="pt-br">

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/login/login.css">

      <title>Cadastro de usuário</title>
    </head>

    <body>

<div class="container">

      <br>

      <form class="form-signin" method="POST" action="">


            <?php
            if ( isset( $_SESSION['msg'] ) ) {
              echo $_SESSION['msg'].'<br>';
              unset($_SESSION['msg']);
            }
            ?>


          <h2 class="form-signin-heading">Cadastro de usuário</h2>
          <label for="name" class="sr-only">Nome</label>
          <input type="text" id="name" name="name" placeholder="Digite seu nome completo" value='Jon Snow' required autofocus class="form-control">
          <br>

          <label for="email" class="sr-only">Email</label>
          <input type="email" id="email" name="email" placeholder="Digite seu email" value='jonsnow@winterfell.com' required class="form-control">
          <br>

          <label for="user" class="sr-only">Usuário</label>
          <input type="text" id="user" name="user" placeholder="Digite seu usuário" value='jonsnow' required class="form-control">
          <br>

          <label for="passwd" class="sr-only">Senha</label>
          <input type="password" id="passwd" name="passwd" placeholder="Digite sua senha" value='123456' required class="form-control">
          <br>
          <input type="submit" name="btnCreateUser" value="Cadastrar" class="btn btn-lg btn-success btn-block">

          <br>
          <p>Faça o login clicando <a href="login.php">aqui</a></p>
      </form>

</div> <!-- /container -->


    </body>

  </html>
