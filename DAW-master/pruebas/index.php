<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pagina de prueba PHP</title>
</head>

<style type="text/css">
	.resaltar{
		border-bottom: 1px solid red;
		color:#000;
		font-weight: bold;
		font-size: 24px;
	}	

</style>

<body>
<h1 style="text-align: center;">Pagina de 2</h1>
<?php
	

// Ejemplo de prints y variables

	/*  
	$nombre = "Ruben";
	$edad = 21;

	print "El nombre de usuario es " . $nombre;
	print "<br>";
	print "El nombre de usuario es $nombre";
	*/

// Ejemplo de llamar funciones desde otros archivos

	/*
	echo "Este es el primer mensaje <br>";

	include ("proporcionaDatos.php");

	echo "Este es el segundo mensaje <br>";
	dameDatos();
	*/

// Ejemplo ámbito de variables

	/*
	$nombre ="Ruben";

	function dameNombre(){
		$nombre = "Maria";
	}

	dameNombre();
	echo $nombre; //Imprime Ruben porque la otra variable $nombre es solo en la funcion


	$edad = 18;

	function cambiarValor(){
		global $edad;
		$edad = 21;
	}

	cambiarValor();
	echo $edad;
	*/

//Variables estaticas

	/*
	function incrementarVariable(){
		static $contador = 0;

		$contador++;

		echo $contador . "<br>";
	}

	incrementarVariable();
	incrementarVariable();
	incrementarVariable();
	incrementarVariable();
	*/

// Strings

	/*
	echo '<p class="resaltar">Esto es un ejemplo de frase</p>';

	$variable1 = "Casa";
	$variable2 = "CASA";

	$resultado = strcmp($variable1,$variable2); //Devuelve 1 si no son iguales y 0 si son iguales

	if($resultado){
		echo "No coinciden";
	}else{
		echo "Coincide";
	}
	*/

// Constantes

	/*
	define ("AUTOR","Ruben");

	echo "El autor es: " . AUTOR . " y esta definida en la linea " . __LINE__;
	*/
	
// Funciones

	/*
	function suma($num1,$num2){
		$resultado = $num1 + $num2;

		return $resultado;
	}

	echo (suma(5,7));

	function fraseMayus($frase,$conversion=true){
		$frase = strtolower($frase);

		if($conversion==true){
			$resultado = ucwords($frase);
		}else{
			$resultado = strtoupper($frase);
		}

		return $resultado;
	}

	echo (fraseMayus("me gusta el Fornite lo juego todo el dia"));

	function parametro($valor){
		$valor++;
	}

	$valor = 1;
	parametro($valor);
	echo "Valor por parametro:$valor <br>";

	function referencia(&$valor){
		$valor++;
	}

	$valor = 1;
	referencia($valor);
	echo "Valor por referencia: $valor";
	*/

// Programación orientada a objetos (POO)

	/*
	include("vehiculos.php");

	$mazda = new Coche();
	$pegaso = new Camion();

	$mazda->arrancar();
	$mazda->setRuedas(10);
	*/

// Arrays

	/*
	$semana[] = "Lunes";
	$semana[] = "Martes";
	$semana[] = "Miercoles";

	$semana2[] = array("Lunes","Martes","Miercoles");

	$datos = array("Nombre"=>"Juan","Apellido"=>"Gomez"); //Clave - Valor
	echo $datos["Nombre"] . "<br>"; //Juan

	if(is_array($datos)){
		foreach ($datos as $clave => $valor) {
			echo "A $clave le corresponde $valor <br>";
		}
	}

	for ($i=0; $i < count($semana); $i++) { 
		echo "$semana[$i] <br>";
	}

	//Array bidimensional

	$alimentos = array("fruta"=>array("tropical"=>"kiwi","citrico"=>"naranja"));
	*/

// PHP y MySQL

	require("datos_conexion.php");

	//Conectar mediante procedimientos
	$conexion = mysqli_connect($db_host,$db_usuario,$db_contra,$db_nombre);

	//Entra si ha dado error al conectar con la BBDD
	if(mysqli_connect_errno()){
		echo "Fallo al conectar con la BBDD";
		exit();
	}

	mysqli_set_charset($conexion, "utf-8");
	$consulta = "SELECT * FROM USUARIO";
	
	//Hacemos la consulta
	$resultados = mysqli_query($conexion, $consulta);

	while($fila=mysqli_fetch_row($resultados)){
		for ($i=0; $i < count($fila); $i++) { 
			echo "$fila[$i] ";
		}
		echo "<br>";
	}
	
	

?>

</body>
</html>