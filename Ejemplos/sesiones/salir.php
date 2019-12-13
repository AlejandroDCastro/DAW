<?php
session_start();
// Destruye los datos de la sesión, realmente la sesión no se destruye, pero es suficiente para salir de la parte privada
session_destroy();

$host = $_SERVER['HTTP_HOST']; 
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
$pagina = "index.php";

header("Location: http://$host$uri/$pagina");
?>