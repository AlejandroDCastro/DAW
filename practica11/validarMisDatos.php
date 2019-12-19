<?php
//Inicializamos la base de datos
require("conexionBD.php");
//Expresiones regulares
$regNombre = "/^[a-zA-Z][a-zA-Z0-9]{2,14}$/";
$regPass = "/(?=\w*[0-9])(?=\w*[A-Z])(?=\w*[a-z])[a-zA-Z0-9-_]{6,15}$/";
$regCiudad = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
//Booleano que comprueba que todo este bien.
$hazRegistro = TRUE;
//String que va concatenando errores.
$extra = "";

//Comprobamos que el nombre tenag el formato correcto.
if(!preg_match($regNombre, $usuario))
{
	if($extra == "")
	{
		$extra = 'misDatos.php?error3=nombre';
	}
	else
	{
		$extra = $extra . '&&error3=nombre';
	}
	/*
	$host = $_SERVER['HTTP_HOST']; 
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
	$extra = 'misDatos.php?error=nombre'; 
	header("Location: http://$host$uri/$extra");
	*/
	$hazRegistro = FALSE;
}

//Ha intentado introducir una contraseña nueva.
if($pass != "" || $pass2 != "")
{
	//Las contraseñas no coinciden.
	if($pass!=$pass2)
	{
		if($extra == "")
		{
			$extra = 'misDatos.php?error5=noCoinciden';
		}
		else
		{
			$extra = $extra . '&&error5=noCoinciden';
		}
		/*
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		$extra = 'misDatos.php?error=noCoinciden'; 
		header("Location: http://$host$uri/$extra");
		*/
		$hazRegistro = FALSE;
	}
	else
	{
		//Comprobamos que el password tiene el formato correcto.
		if(!preg_match($regPass, $pass) || !preg_match($regPass, $pass2))
		{
			if($extra == "")
			{
				$extra = 'misDatos.php?error4=password';
			}
			else
			{
				$extra = $extra . '&&error4=password';
			}
		    /*
			$host = $_SERVER['HTTP_HOST']; 
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
			$extra = 'misDatos.php?error=password'; 
			header("Location: http://$host$uri/$extra");
			*/
			$hazRegistro = FALSE;
		}
		//Ciframos la contraseña.
		else
		{
			$passCifrada = password_hash($pass, PASSWORD_DEFAULT);
		}

	}
}

//Saneamos el correo el email.
$mail = filter_var($mail, FILTER_SANITIZE_EMAIL);

//Comprobamos que el email tenga el formato correcto con un filter.
if(!filter_var($mail,FILTER_VALIDATE_EMAIL))
{
    if($extra == "")
	{
		$extra = 'misDatos.php?error6=email';
	}
	else
	{
		$extra = $extra . '&&error6=email';
	}
	/*
	$host = $_SERVER['HTTP_HOST']; 
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
	$extra = 'misDatos.php?error=email'; 
	header("Location: http://$host$uri/$extra");
	*/
	$hazRegistro = FALSE;
}

//Comprobamos que nos pasen un sexo válido.
if($sex == "Hombre")
{
		$sexId = 0;
}
else
{
	if($sex == "Mujer")
	{
		$sexId = 1;
	}
	else
	{
      	if($extra == "")
		{
			$extra = 'misDatos.php?error7=sexo';
		}
		else
		{
			$extra = $extra . '&&error7=sexo';
		}
		/*
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		$extra = 'misDatos.php?error=sexo'; 
		header("Location: http://$host$uri/$extra");
		*/
		$hazRegistro = FALSE;
	}
}

//Comprobamos que la fecha sea válida

$valores = explode('/', $fecha);

//Ponemos la fecha en formato anyo,mes,dia para la BD.
$fecha = $valores[2]."-".$valores[1]."-".$valores[0];

$now = time();
if(!(count($valores) == 3 && (is_numeric($valores[0])
&& is_numeric($valores[1]) && is_numeric($valores[2]))
&& checkdate($valores[1], $valores[0], $valores[2])
&& strtotime($fecha) <= $now))
{
    if($extra == "")
	{
		$extra = 'misDatos.php?error8=fecha';
	}
	else
	{
		$extra = $extra . '&&error8=fecha';
	}
	/*
	$host = $_SERVER['HTTP_HOST']; 
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
	$extra = 'misDatos.php?error=fecha'; 
	header("Location: http://$host$uri/$extra");
	*/
	$hazRegistro = FALSE;
}


//Comprobamos que el país sea válido.
if($pais != "")
{
	$sentenciaPaises = "SELECT IdPais FROM paises WHERE BINARY NomPais = ?";
	$mysqli = $conexion->prepare($sentenciaPaises);
	$mysqli->bind_param('s', $pais);
	if (!$mysqli->execute()) {
	            echo '<p>Error al buscar el pais en la BD' .$conexion->connect_error. '</p>';
        		$hazRegistro = FALSE;
	            exit;
	}
	$resultadoPaises = $mysqli->get_result();
	if($mysqli->affected_rows == 0)
	{
        if($extra == "")
		{
			$extra = 'misDatos.php?error9=pais';
		}
		else
		{
			$extra = $extra . '&&error9=pais';
		}
		/*
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		$extra = 'misDatos.php?error=pais'; 
		header("Location: http://$host$uri/$extra");
		*/
		$hazRegistro = FALSE;
	}
	else
	{
		//Sacamos el id del pais correspondiente
		$filaPaises = $resultadoPaises->fetch_object();
		$paisId = $filaPaises->IdPais;
	}

}
else
{
	$paisId = "";
}

//Comprobamos que el estilo sea válido.
if($estilo != "")
{
	$sentenciaEstilos = "SELECT * FROM estilos WHERE BINARY Nombre = ?";
	$mysqli = $conexion->prepare($sentenciaEstilos);
	$mysqli->bind_param('s', $estilo);
	if (!$mysqli->execute()) {
	            echo '<p>Error al buscar el estilo en la BD' .$conexion->connect_error. '</p>';
        		$hazRegistro = FALSE;
	            exit;
	}
	$resultadoEstilo = $mysqli->get_result();
	if($mysqli->affected_rows == 0)
	{
		if($extra == "")
		{
			$extra = 'misDatos.php?error10=estilo';
		}
		else
		{
			$extra = $extra . '&&error10=estilo';
		}
		/*
		$host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		$extra = 'misDatos.php?error=estilo'; 
		header("Location: http://$host$uri/$extra");
		*/
		$hazRegistro = FALSE;
	}
	else
	{
		//Sacamos el id del pais correspondiente
		$filaEstilo = $resultadoEstilo->fetch_object();
		$estiloId = $filaEstilo->IdEstilo;
		$estilosesion = $filaEstilo->Fichero;
	}
}
//Si no tiene ninguno, le asignamos el básico por defecto.
else
{
	$estiloId = 1;
	$estilosesion = 'css/style.css';
}

//Comprobamos que meta solo letras y espacios en blanco en la ciudad.
if($ciudad != "")
{
	if(!preg_match($regCiudad, $ciudad))
	{
		if($extra == "")
		{
			$extra = 'misDatos.php?error11=ciudad';
		}
		else
		{
			$extra = $extra . '&&error11=ciudad';
		}
		$hazRegistro = FALSE;
	}
}

//Comprobaciones de foto.
$nombreFoto = "";
$rutaImagen = "";
//Comprobamos que se haya rellenado el campo de foto.
if($_FILES['file']['size'] != 0)
{
	if ($_FILES["file"]["error"] > 0) {
	    if($extra == "")
			{
				$extra = 'registro.php?error12=foto';
			}
			else
				
			{
				$extra = $extra . '&&error12=foto';
			}
	    $hazRegistro = false;
	}
	else
	{
		$tmp_name = $_FILES["file"]["tmp_name"];
		$nombreFoto = $_FILES["file"]["name"];
		$fichero_subido = $usuario . ".jpg";
		//Ruta para previsualizar la imagen.
		$rutaImagen = "Images/Perfiles/$fichero_subido";
		//Si ya tenia una foto subida, la borra y luego inserta la nueva.
		if(file_exists($rutaImagen))
   		{
   			unlink($rutaImagen);
   		}
		move_uploaded_file($tmp_name, $rutaImagen);
	}
}

?>