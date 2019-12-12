<?php
	session_start();

	$titulo = "Datos cambiados correcto";
	$estilo = "css/style.css";

	require_once("head.php");
	
	require_once("header.php");

	//Recogemos todos los campos del registro menos la foto
	$usuario = $_POST['usuario'];
	$pass = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	$mail = $_POST['mail'];
	$passConfirmar = $_POST['passActual'];

	if(isset($_POST['sex']))
	{
		$sex = $_POST['sex'];
	} else {
		$sex = "";
	}

	$fecha = $_POST['fecha'];
	$pais = $_POST['pais'];
	$estilo = $_POST['estilo'];

	$ciudad = $_POST['ciudad'];

	//Comprobamos que la pass introducida y la de la base de datos coinciden.
    require("conexionBD.php");

    $idUsu = $_SESSION['id'];
    $hasheada = "";
    $sentenciaPass = "SELECT Clave FROM usuarios WHERE IdUsuario=?";
    $mysqli = $conexion->prepare($sentenciaPass);
    $mysqli->bind_param('i', $idUsu);
    if (!$mysqli->execute()) {
        echo '<p>Error al buscar el password en la BD' .$conexion->error. '</p>';
        exit;
    }
    $passBD = $mysqli->get_result();
    if ($passBD->num_rows) {
        $hasheada = $passBD->fetch_object();
    }

    $passBD->close();
    $conexion->close();

    if($passConfirmar != "" && password_verify($passConfirmar, $hasheada->Clave))
    {
	    	//Comprobamos que los datos importantes estan rellenados.
			if($usuario != "" && $mail != "" && $sex != "" && $fecha != "")
			{
				require("validarMisDatos.php");

				if($hazRegistro == TRUE)
				{
				

					if($pass != "")
					{
						// Si hemos llegado hasta este punto, modificamos los datos del usuario.
		                $usuario = mysqli_real_escape_string($conexion,$usuario);
		                $passCifrada = mysqli_real_escape_string($conexion, $passCifrada);
		                $mail = mysqli_real_escape_string($conexion, $mail);
		                $ciudad = mysqli_real_escape_string($conexion, $ciudad);
		                $paisId = mysqli_real_escape_string($conexion, $paisId);
		                $sexId = mysqli_real_escape_string($conexion, $sexId);
		                $estilo = mysqli_real_escape_string($conexion, $estilo);
		                $fecha = mysqli_real_escape_string($conexion, $fecha);
						$sentenciaRegistro = "UPDATE usuarios 
						SET NomUsuario = '$usuario', Clave = '$passCifrada', Email = '$mail', Sexo = '$sexId', FNacimiento = '$fecha', Ciudad = '$ciudad', Pais = '$paisId', Estilo = '$estiloId'
						WHERE IdUsuario=?";
					}
					else
					{
						// Si hemos llegado hasta este punto, modificamos los datos del usuario.
		                $usuario = mysqli_real_escape_string($conexion,$usuario);
		                $mail = mysqli_real_escape_string($conexion, $mail);
		                $ciudad = mysqli_real_escape_string($conexion, $ciudad);
		                $paisId = mysqli_real_escape_string($conexion, $paisId);
		                $sexId = mysqli_real_escape_string($conexion, $sexId);
		                $estilo = mysqli_real_escape_string($conexion, $estilo);
		                $fecha = mysqli_real_escape_string($conexion, $fecha);
						$sentenciaRegistro = "UPDATE usuarios 
						SET NomUsuario = '$usuario', Email = '$mail', Sexo = '$sexId', FNacimiento = '$fecha', Ciudad = '$ciudad', Pais = '$paisId', Estilo = '$estiloId'
						WHERE IdUsuario=?";
					}

					$mysqli = $conexion->prepare($sentenciaRegistro);
				    $mysqli->bind_param('i', $idUsu);
				    if (!$mysqli->execute()) {
					    echo '<p>Error al buscar el id de usuario en la BD' .$conexion->connect_error. '</p>';
					    exit;
					}
				    $conexion->close();

					$_SESSION['logueado'] = $usuario;
					$_SESSION["estilo"] = $estilosesion;			
					

					echo "<main><section><h1>Datos cambiados correctamente</h1>
							<section class='printCentro'><h2>Registro realizado con éxito, tus datos son:</h2><ul>
							<li><b>Nombre:</b> $usuario</li>
							<li><b>Contraseña:</b> ";
							if($pass != "")
							{
								for ($i=0; $i<strlen($pass); $i++) {
								echo "*";
								}
								echo "</li>";
							}

					// Dependiendo de si ha rellenado los otros campos, aparecen tambien en pantalla.
					if($mail != "")
					{
						echo "<li><b>Email:</b> $mail</li>";
					}

					if($sex != "")
					{
						echo "<li><b>Sexo:</b> $sex</li>";
					}

					if($fecha != "")
					{
						echo "<li><b>Fecha:</b> $fecha</li>";
					}

					if($pais != "")
					{
						echo "<li><b>País:</b> $pais</li>";
					}

					if($ciudad != "")
					{
						echo "<li><b>Ciudad:</b> $ciudad</li>";
					}

					if($estilo != "")
					{
						echo "<li><b>Estilo:</b> $estilo</li>";
					}

					echo "</ul><a href='perfil.php'>Aceptar</a></section></section></main>";
		        	
				}
				else
				{
					$conexion->close();
					$host = $_SERVER['HTTP_HOST']; 
					$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
					header("Location: http://$host$uri/$extra");
					exit;
				}
				

			}
			else
			{
				$host = $_SERVER['HTTP_HOST']; 
				$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
			 	$extra = 'misDatos.php?error=norellenados'; 
			 	header("Location: http://$host$uri/$extra"); 
				exit;
			}
	}
		
    else
    {
    	$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		$extra = 'misDatos.php?error=contramala'; 
		header("Location: http://$host$uri/$extra"); 
		exit;
    }

?>