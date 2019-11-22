<?php
    session_start();

    // Borra todas las variables de sesión 
    $_SESSION = array(); 
    
    // Borra la cookie que almacena la sesión 
    if(isset($_COOKIE[session_name()])) { 
        setcookie(session_name(), '', time() - 42000, '/'); 
    }
    
    setcookie('recordar','',time() - 42000,'/');
    
    // Finalmente, destruye la sesión, no destruye ninguna de las variables globales asociadas con la sesión
    session_destroy();

    $host = $_SERVER["HTTP_HOST"];
    $uri = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
    $extra = "index.php";

    header("Location: http://$host$uri/$extra");
?>