<?php

	// Iniciar una nueva sesión o reanudar la existente...
	session_start();

	//Recogemos el nombre y el password que nos envia el usuario.
	$nombre = $_POST['nombre'];
	$pass = $_POST['pass'];

	//Creamos cuatro usuarios.
	$usuarios = [
		['usuario' => 'Mateo', 'password' => 'hola'],
		['usuario' => 'Marcos', 'password' => 'adios'],
		['usuario' => 'Lucas', 'password' => '1234'],
		['usuario' => 'Juan', 'password' => 'chato3']
	];

	$host = $_SERVER['HTTP_HOST'];							// devuelve el nombre del servidor
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 	// devuelve la parte del directorio indicado en la ruta del fichero
	$extra = 'index.php?fallo=1';							// nueva página a redireccionar

	//Comprobamos que el nombre y contraseña introducidos coincida con algun usuario creado.
	for($var = 0; $var<4; $var++)
	{
		if($usuarios[$var]['usuario'] == $nombre  &&  $usuarios[$var]['password'] == $pass)
		{
			$extra = 'perfil.php';
			$_SESSION['logueado'] = 'OK';
			break;
		}
	}
	header("Location: http://$host$uri/$extra");

?>