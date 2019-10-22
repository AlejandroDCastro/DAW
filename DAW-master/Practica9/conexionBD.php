<?php

$db_host = "localhost";
$db_nombre = "pibd";
$db_usuario = "root";
$db_clave = "";

$conexion = new mysqli($db_host, $db_usuario, $db_clave, $db_nombre);

if ($conexion->connect_errno) {
    echo "Fallo la conexion" . $conexion->connect_errno;
}

$conexion->set_charset("utf8");
?>