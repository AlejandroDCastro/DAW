<?php
session_start();

$usuarios = [
	["usu" => "sergio", "con" => "1234"],
	["usu" => "pedro", "con" => "5678"],
	["usu" => "juan", "con" => "0000"]
];

$host = $_SERVER['HTTP_HOST']; 
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
$pagina = "index.php?error=1";

for($i = 0; $i < count($usuarios); $i++) {
	if($_POST["usuario"] == $usuarios[$i]["usu"] &&
		$_POST["contrasena"] == $usuarios[$i]["con"]) {
			$pagina = "privado.php";
			$_SESSION["logueado"] = "OK";
			break;
		}
}

header("Location: http://$host$uri/$pagina");
?>