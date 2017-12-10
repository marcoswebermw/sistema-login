<?php

// Initializing a session.
session_start();

include_once('connection.php');


$tried_get_in = filter_input(INPUT_POST, btnLogin, FILTER_SANITIZE_STRING);

if ( $tried_get_in ) {
  $user = filter_input(INPUT_POST, user, FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, passwd, FILTER_SANITIZE_STRING);

  if ( ( !empty( $user ) ) AND ( !empty( $password ) ) ) {
    // Search user on database.
    $find_user = "SELECT id, name, user, email, passwd FROM users WHERE user='$user' LIMIT 1";
    $user_found = mysqli_query( $conn, $find_user );

    if ( $user_found ) {
      $user_from_bd = mysqli_fetch_assoc( $user_found );

      if ( password_verify( $password, $user_from_bd['passwd'] ) ) {
        $_SESSION['id'] = $user_from_bd['id'];
        $_SESSION['name'] = $user_from_bd['name'];
        $_SESSION['user'] = $user_from_bd['user'];
        $_SESSION['email'] = $user_from_bd['email'];

        header('Location: index.php');
      } else {
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Usuário ou senha incorretos</div>';
        header('Location: login.php');
      }

    }

  } else {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Preencha todos os campos</div>';
    header('Location: login.php');
  }


} else {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Página não encontrada</div>';
  header('Location: login.php');
}
