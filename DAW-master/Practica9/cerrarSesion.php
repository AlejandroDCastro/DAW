<?php
session_start();
if (isset($_SESSION['sesion'])) {
    session_destroy();
}
setcookie("recuerdame", " ", time() - 360);

header('Location: index.php');

?>