<?php

	// Iniciar una nueva sesión o reanudar la existente...
	session_start();

	
	//Creamos cuatro usuarios.
	$usuarios = [
		'Mateo' => 'hola',
		'Marcos' => 'adios',
		'Lucas' => '1234',
		'Juan' => 'chato3'
	];

	$estilo = 'css/style.css';
	$host = $_SERVER['HTTP_HOST'];							// devuelve el nombre del servidor
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 	// devuelve la parte del directorio indicado en la ruta del fichero
	$extra = 'index.php?fallo=1';							// nueva página a redireccionar

	//---------------ACCESO POR COOKIE---------------------
	if(isset($_COOKIE['recordar']))
	{
		//Convertimos el string a array.
        $datos = $_COOKIE['recordar'];
        $datosArray = json_decode($datos,true);
        $datos = array($datosArray[0],$datosArray[1],getdate());
		$datosString = json_encode($datos);
		setcookie('recordar', $datosString, time() + 90*24*60*60, '/', null, false, true);
        $nombre = $datosArray[0];
        $pass = $datosArray[1];
		if($usuarios[$nombre] != ''  &&  $usuarios[$nombre] == $pass)
		{
			// Guardamos el estilo seleccionado anteriormente en función del usuario
			if ($nombre == 'Marcos') {
				$estilo = 'css/letraGrande.css';
			} elseif ($nombre == 'Lucas') {
				$estilo = 'css/altoContraste.css';
			} elseif ($nombre == 'Juan') {
				$estilo = 'css/combinado.css';
			}
			$extra = 'index.php';
			$_SESSION['logueado'] = $nombre;
			$_SESSION['estilo'] = $estilo;
		}
	}

	//---------------ACCESO POR FORMULARIO------------------
	else
	{
		//Recogemos el nombre y el password que nos envia el usuario.
		$nombre = $_POST['nombre'];
		$pass = $_POST['pass'];
		
		//Comprobamos que el nombre y contraseña introducidos coincida con algun usuario creado.
		if($usuarios[$nombre] != ''  &&  $usuarios[$nombre] == $pass)
		{
			//El usuario quiere se le recuerde.
			if(isset($_POST['recuerdame']))
			{
				//Si no existia la cookie, la creamos.
				if(!isset($_COOKIE['recordar']))
				{
					//Creamos un array con los datos del usuario y lo pasamos a string.
					$datos = array($nombre,$pass,getdate());
					$datosString = json_encode($datos);
					setcookie('recordar', $datosString, time() + 90*24*60*60, '/', null, false, true);

				}
				else
				{

					setcookie('recordar', $_COOKIE['recordar'], time() + 90*24*60*60, '/', null, false, true);
				}
			}
			else
			{
				//Si no se ha marcado recordar, la cookie no se almacena.
				if(isset($_COOKIE['recordar']))
				{
					setcookie('recordar','',time() - 42000);
				}
			}

			if ($nombre == 'Marcos') {
				$estilo = 'css/letraGrande.css';
			} elseif ($nombre == 'Lucas') {
				$estilo = 'css/altoContraste.css';
			} elseif ($nombre == 'Juan') {
				$estilo = 'css/combinado.css';
			}
			

			$extra = 'perfil.php';
			$_SESSION['logueado'] = $nombre;
			$_SESSION['estilo'] = $estilo;
		}
	}
	header("Location: http://$host$uri/$extra");

?>