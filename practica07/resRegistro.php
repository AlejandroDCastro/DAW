<?php

	$titulo = "Registro correcto";
    // Incluímos el head con el doctype
    require_once("head.php");

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
	$ciudad = $_POST['ciudad'];


	if($usuario != "" && $pass != "" && $pass2 != "")
	{
		if($pass == $pass2)
		{
			//Creamos la pagina con los datos introducidos por el usuario.
			echo "<main><section><h1>Registro correcto</h1>
					<section class='printCentro'><h2>Inserción realizada, tus datos son:</h2><ul>
					<li><b>Nombre:</b> $usuario</li>
					<li><b>Contraseña:</b> $pass</li>";
			//Dependiendo de si ha rellenado los otros campos, aparecen tambien en pantalla.
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

			echo "</ul><a href='indexconreg.php'>Aceptar</a></section></section></main>";
		}
		else
		{
			$host = $_SERVER['HTTP_HOST']; 
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		 	$extra = 'registro.php'; 
		 	header("Location: http://$host$uri/$extra?nocoinciden"); 
			exit;
		}
	}
	else
	{
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
	 	$extra = 'registro.php'; 
	 	header("Location: http://$host$uri/$extra?faltan"); 
		exit;
	}
?>