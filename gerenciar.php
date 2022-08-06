<?php
include('verifica_login.php');
// session_start();
include('header_novo.php');
include('Header_CSS_JS.php');
$usuario = $_SESSION['usuario'];
include('conexao.php');
$data = date("d/m/Y");
?>

<title>Gerenciar</title>

<ul class="nav nav-tabs justify-content-center lighten-4 py-4">
  <li class="nav-item">
    <a class="nav-link active" href="mesa.php">Gerenciar Mesa</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active " href="catalogo.php">Gerenciar Catalogo</a>
  </li>
</ul>