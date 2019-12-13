<?php
session_start();

if(isset($_SESSION["logueado"]) && $_SESSION["logueado"] == "OK") {
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>Parte privada</h1>
<p><a href="index.php">Parte pública</a></p>
<p><a href="salir.php">Salir</a></p>
</body>
</html>
<?php
}
else {
	$host = $_SERVER['HTTP_HOST']; 
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
	$pagina = "index.php?error=2";
	header("Location: http://$host$uri/$pagina"); 
}
?>