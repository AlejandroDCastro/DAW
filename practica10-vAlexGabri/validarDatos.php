<?php
//Inicializamos la base de datos
require("conexionBD.php");
//Expresiones regulares
$regNombre = "/^[a-zA-Z][a-zA-Z0-9]{2,14}$/";
$regPass = "/(?=\w*[0-9])(?=\w*[A-Z])(?=\w*[a-z])[a-zA-Z0-9-_]{6,15}$/";
//Booleano que comprueba que todo este bien.
$hazRegistro = TRUE;
//Va recogiendo los errores si los encuentra.
$extra = "";

//Comprobamos que el nombre tenag el formato correcto.
if(!preg_match($regNombre, $usuario))
{
	if($extra == "")
	{
		$extra = 'registro.php?error1=nombre'; 
	}
	else
	{
		$extra = $extra . '&&error1=nombre';
	}

	$hazRegistro = FALSE;
}

//Comrpobamos que las contraseñas sean iguales.
if($pass != $pass2)
{
	if($extra == "")
	{
		$extra = 'registro.php?error3=noCoinciden'; 
	}
	else
	{
		$extra = $extra . '&&error3=noCoinciden';
	}
	
	$hazRegistro = FALSE;
}

//Comprobamos que el password tiene el formato correcto.
if(!preg_match($regPass, $pass) || !preg_match($regPass, $pass2))
{
    if($extra == "")
	{
		$extra = 'registro.php?error2=password'; 
	}
	else
	{
		$extra = $extra . '&&error2=password';
	}
	
	$hazRegistro = FALSE;
}
//Ciframos la contraseña.
else
{
	$passCifrada = password_hash($pass, PASSWORD_DEFAULT);
}

//Saneamos el correo el email.
$mail = filter_var($mail, FILTER_SANITIZE_EMAIL);

//Comprobamos que el email tenga el formato correcto con un filter.
if(!filter_var($mail,FILTER_VALIDATE_EMAIL))
{
	if($extra == "")
	{
		$extra = 'registro.php?error4=email'; 
	}
	else
	{
		$extra = $extra . '&&error4=email';
	}
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
			$extra = 'registro.php?error5=sexo'; 
		}
		else
		{
			$extra = $extra . '&&error5=sexo';
		}
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
		$extra = 'registro.php?error6=fecha'; 
	}
	else
	{
		$extra = $extra . '&&error6=fecha';
	}
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
			$extra = 'registro.php?error7=pais'; 
		}
		else
		{
			$extra = $extra . '&&error7=pais';
		}
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
			$extra = 'registro.php?error8=estilo'; 
		}
		else
		{
			$extra = $extra . '&&error8=estilo';
		}
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

?>