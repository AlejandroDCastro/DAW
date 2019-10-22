<?php 
	session_start();
	include('conexionBD.php');
	


	$estilo = mysqli_real_escape_string($conexion, $_POST['estilos']);

	$usuario = mysqli_real_escape_string($conexion, $_SESSION['sesion']['usuario']);

	$sql = "UPDATE usuarios SET Estilo ='$estilo' where NomUsuario='$usuario'";

	if($conexion->query($sql)){
		$_SESSION['sesion']['Estilo'] = $_POST['estilos'];
		header('Location: menu.php');
	}
	
?>