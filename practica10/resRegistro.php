<?php
	session_start();

	$titulo = "Registro correcto";
	$estilo = "css/style.css";

	require_once("head.php");
	
	require_once("header.php");

	//Recogemos todos los campos del registro menos la foto
	$usuario = $_POST['usuario'];
	$pass = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	$mail = $_POST['mail'];

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

	//En el caso de que haya un error, nos guardamos los datos para que no tenga que volver a introducirlos.
	$_SESSION['usu'] = $usuario;
	$_SESSION['pass'] = $pass;
	$_SESSION['pass2'] = $pass2;
	$_SESSION['mail'] = $mail;
	$_SESSION['sex'] = $sex;
	$_SESSION['fecha'] = $fecha;
	$_SESSION['pais'] = $pais;
	$_SESSION['estilo'] = $estilo;
	$_SESSION['ciudad'] = $ciudad;

	if($usuario != ""  &&  $pass != ""  &&  $pass2 != "" && $mail != "" && $sex != "" && $fecha != "")
	{
			require("validarDatos.php");

			if($hazRegistro == TRUE)
			{
				//Sacamos la fecha en la que se ha realizado el registro.
			$fechaReg = date("Y-m-d H:i:s");
			// Si hemos llegado hasta este punto, creamos el nuevo usuario.
			$sentenciaRegistro = "INSERT INTO usuarios (NomUsuario,Clave,Email,Sexo,FNacimiento,Ciudad,Pais,FRegistro,Estilo) VALUES  ('$usuario', '$passCifrada', '$mail', '$sexId', '$fecha', '$ciudad', '$paisId', '$fechaReg', '$estiloId')";

			$conexion->query($sentenciaRegistro);
			//Borramos las variables de la sesion donde guardabamos los datos  de registro.
			$_SESSION = array();
			session_destroy();
			//Iniciamos sesion con el usuario nuevo.
			session_start();
			$sacaId = "SELECT * FROM usuarios WHERE BINARY NomUsuario = '$usuario'";
			$elId = $conexion->query($sacaId);
			$fila = $elId->fetch_object();
			$_SESSION['logueado'] = $usuario;
			$_SESSION['id'] = $fila->IdUsuario;
			$_SESSION["estilo"] = $estilosesion;			
			

			echo "<main><section><h1>Registro correcto</h1>
					<section class='printCentro'><h2>Registro realizado con éxito, tus datos son:</h2><ul>
					<li><b>Nombre:</b> $usuario</li>
					<li><b>Contraseña:</b> ";
					for ($i=0; $i<strlen($pass); $i++) {
						echo "*";
					}
					echo "</li>";

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
        	
        	$elId->close();
        	$conexion->close();
        	
			}
			else
			{
				$host = $_SERVER['HTTP_HOST']; 
				$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
			 	header("Location: http://$host$uri/$extra"); 
				$conexion->close();
				exit;
			}
	}
	else
	{
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
	 	$extra = 'registro.php?error=norellenados'; 
	 	header("Location: http://$host$uri/$extra"); 
		exit;
	}
?>