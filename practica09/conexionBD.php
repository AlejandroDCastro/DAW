<?php

    $conexion = new mysqli("localhost", "root", "", "pibd");

    if (!$conexion) {
        echo '<p>Falló la conexión a MySQL' .$conexion->connect_errno. '</p>';
        exit;
    }

    $conexion->set_charset("utf8");

?>