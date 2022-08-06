<?php
session_start();
include('conexao.php');

if(empty($_POST['usuario']) || empty($_POST['senha'])) {
	header('Location: index.php');
	exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select user, status from user where user = '{$usuario}' and senha = md5('{$senha}') ";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

$row_usuario = mysqli_fetch_assoc($result);
	
	@$status_user = $row_usuario['status'];

if($status_user == '0'){

	$_SESSION['nao_autenticado_user'] = true;
	header('Location: login.php');
	exit();

}else{

}

if($row == 1) {
	 $_SESSION['usuario'] = $usuario;
	header('Location: pedido.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: login.php');
	exit();
}

?>