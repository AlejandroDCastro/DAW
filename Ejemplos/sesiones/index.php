<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>Parte pública</h1>
<?php
if(isset($_GET["error"]) && $_GET["error"] == 1)
	echo "<p>Hay un error en los datos introducidos</p>";
else if(isset($_GET["error"]) && $_GET["error"] == 2)
	echo "<p>Acceso no permitido</p>";

if(isset($_SESSION["logueado"]) && $_SESSION["logueado"] == "OK") {
	// Una forma de mezclar código HTML y PHP
?>
<p>No se muestra el formulario porque ya estás autenticado</p>
<?php
}
else {
	// Así mejor, no se cierra y abre el código PHP
	echo <<<hereDOC
<form action="control.php" method="post">
<p>Usuario: <input type="text" name="usuario" /></p>
<p>Contraseña: <input type="password" name="contrasena" /></p>
<p><input type="submit" /></p>
</form>
hereDOC;
}
?>
<p>Prueba a acceder a la <a href="privado.php">parte privada</a></p>
</body>
</html>