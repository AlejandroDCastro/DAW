<?php
session_start();
if (isset($_SESSION['sesion'])) {
    session_destroy();
}

header('Location: index.php');

?>