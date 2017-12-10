<?php

session_start();

// if ( empty( $_SESSION['id'] ) ) {
//   header('Location: index.php');
// }

  // Credencials.
  $servername = "mariadb";
  $username = "usuario";
  $password = "senha";
  $dbname = "bd_mariadb";

  // Connection.
  $conn = new mysqli($servername, $username, $password, $dbname);
