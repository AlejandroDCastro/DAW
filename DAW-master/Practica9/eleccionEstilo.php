<?php
session_start();

//include("recuerdame.php");

if (!isset($_SESSION['sesion'])) {
    include('head.php');
} else {


    if ($_SESSION['sesion']['Estilo'] == '1') {
        include('head.php');
    } else if ($_SESSION['sesion']['Estilo'] == '2') {
        include('headAltoContraste.php');
    }
}
?>