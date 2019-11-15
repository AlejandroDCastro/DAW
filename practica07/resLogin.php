<?php
	//Recogemos el nombre y el password que nos envia el usuario.
	$nombre = $_POST['nombre'];
	$pass = $_POST['pass'];

	//Creamos cuatro usuarios.
	$usuarios = array("Mateo","Marcos","Lucas","Juan");
	$passwords = array("hola","adios","1234","chato3");
	//Comprobamos que el nombre y contraseña introducidos coincida con algun usuario creado.

	for($var = 0;$var < 4;$var++)
	{
		if($usuarios[$var] == $nombre && $passwords[$var] == $pass)
		{			
			$host = $_SERVER['HTTP_HOST']; 
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
			$extra = 'perfil.php'; 
			header("Location: http://$host$uri/$extra"); 
			exit;
		}
	}

	$host = $_SERVER['HTTP_HOST']; 
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
 	$extra = 'index.php'; 
 	header("Location: http://$host$uri/$extra?fallo"); 
	exit;

?>