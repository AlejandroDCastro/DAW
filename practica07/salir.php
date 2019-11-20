<?php
    session_start();

    // Destruye toda la información asociada con la sesión actual. No destruye ninguna de las variables globales asociadas con la sesión
    session_destroy();

    $host = $_SERVER["HTTP_HOST"];
    $uri = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
    $extra = "index.php";

    header("Location: http://$host$uri/$extra");
?>