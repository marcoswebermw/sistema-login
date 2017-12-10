<?php

session_start();

if ( empty( $_SESSION['id'] ) ) {
  header('Location: forbidden-area.php');
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <title>Bem vindo!</title>
</head>

<body>


  <nav class="navbar nav-pills flex-column flex-sm-row navbar-dark bg-dark" role="navigation">
    <div id="nav-esquerda">
      <a class="navbar-brand flex-sm-fill text-sm-center" href="index.php">Início</a>
      <a class="navbar-brand flex-sm-fill text-sm-center" href="administration.php">Administrativo</a>
      <a class="navbar-brand flex-sm-fill text-sm-center" href="logout.php">Sair</a>
    </div>
    <div id="nav-direita">
      <span class="badge badge-dark" ><?= $_SESSION['name']; ?></span>
    </div>
  </nav>



  <header class="jumbotron">
    <h1>
      Área Administrativa
    </h1>
  </header>

  <div class="container-fluid">
  </div>

</body>
</html>
