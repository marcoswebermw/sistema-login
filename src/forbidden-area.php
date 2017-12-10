<?php

session_start();

$_SESSION['msg'] = 'Área restrita.';
header('Location: login.php');
