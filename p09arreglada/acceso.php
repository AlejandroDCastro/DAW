<?php 

	// Iniciar una nueva sesión o reanudar la existente...
	session_start();

	// Sentencias para interactuar con la base de datos
	require("conexionBD.php");
	$sentencia = "SELECT u.NomUsuario, u.Clave, e.Fichero
		FROM usuarios u JOIN estilos e ON e.IdEstilo=u.Estilo
		WHERE u.NomUsuario = ?";
	$mysqli = $conexion->prepare($sentencia);


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
		
		// Enviamos parametro a la plantilla que tine la BD y ejecutamos
		$mysqli->bind_param('s', $nombre);
		if (!$mysqli->execute()) {
            echo '<p>Error al obtener usuario de la BD' .$conexion->error. '</p>';
            exit;
		}

		// Comprobamos el resultado
		$resultado = $mysqli->get_result();
		if ($resultado->num_rows) {
			$fila = $resultado->fetch_object();
			if($fila->Clave == $pass) {
				$extra = 'index.php';
				$_SESSION['logueado'] = $nombre;
				$_SESSION['estilo'] = $fila->Fichero;
			}
		}
	}

	//---------------ACCESO POR FORMULARIO------------------
	else
	{

		//Recogemos el nombre y el password que nos envia el usuario.
		$nombre = $_POST['nombre'];
		$pass = $_POST['pass'];


		// Enviamos parametro a la plantilla que tine la BD y ejecutamos
		$mysqli->bind_param('s', $nombre);
		if (!$mysqli->execute()) {
            echo '<p>Error al obtener el usuario de la BD' .$conexion->error. '</p>';
            exit;
		}

		// Comprobamos el resultado
		$resultado = $mysqli->get_result();
		if ($resultado->num_rows) {
			$fila = $resultado->fetch_object();
			if($fila->Clave == $pass) {
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

				$extra = 'perfil.php';
				$_SESSION['logueado'] = $nombre;
				$_SESSION['estilo'] = $fila->Fichero;
			}
		}
	}

	$resultado->close();
	$conexion->close();
	
	header("Location: http://$host$uri/$extra");

?>