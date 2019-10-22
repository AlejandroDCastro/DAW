<?php

include('headerSinLogear.php');
require("conexionBD.php");
$datosCorrectos = true;

$exp_regular = "/^[A-Za-z0-9_-]{4,10}$/";
$exp_regular_pass = "/^[A-Za-z0-9_-]{6,13}$/";
$exp_regular_ciudad = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";

$fichero_subido = basename($_FILES['input_foto']['name']);


$usuario = $_POST['usuario'];
if (!preg_match($exp_regular, $usuario)) {
    header('Location: misDatos.php?error=user');
    $datosCorrectos = false;
}

if ($_FILES["input_foto"]["type"] != "image/jpeg") {
    header('Location: misDatos.php?error=img');
    $datosCorrectos = false;
}

$tmp_name = $_FILES["input_foto"]["tmp_name"];
$name_img = basename($_FILES["input_foto"]["name"]);
$fichero_subido = $usuario . ".jpg";
move_uploaded_file($tmp_name, "img/$fichero_subido");

$pass = $_POST['password'];
$pass_repeat = $_POST['password_repeat'];
if (!preg_match($exp_regular_pass, $pass) || !preg_match($exp_regular_pass, $pass_repeat)) {
    header('Location: registro.php?error=pass');
    $datosCorrectos = false;
}

$email = $_POST['email'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: registro.php?error=email');
    $datosCorrectos = false;
}
$ciudad = $_POST['ciudad'];
if (!preg_match($exp_regular_ciudad, $ciudad)) {
    header('Location: misDatos.php?error=ciudad');
    $datosCorrectos = false;
}

$pais = $_POST['paises'];
$array = array();

$flag = false;
$sql_paises = "SELECT IdPais FROM paises";
$paises = $conexion->query($sql_paises);
while ($fila = $paises->fetch_assoc()) {
    $array[] = $fila['IdPais'];
}
foreach ($array as $valor) {
    if ($valor == $pais) {
        $flag = true;
    }
}

if (!$flag) {
    header('Location: registro.php?error=pais');
    $datosCorrectos = false;
}

$sexo = $_POST['gender'];
if ($sexo != "hombre" && $sexo != "mujer" && $sexo != "otro") {
    header('Location: registro.php?error=sexo');
    $datosCorrectos = false;
}

$estilo = $_POST['estilos'];
if ($estilo != "1" && $estilo != "2") {
    header('Location: registro.php?error=estilo');
    $datosCorrectos = false;
}


$fechaN = $_POST['FNacimiento'];


$esc_usuario = mysqli_real_escape_string($conexion, $usuario);
$esc_pass = mysqli_real_escape_string($conexion, $pass);
$esc_email = mysqli_real_escape_string($conexion, $email);
$esc_ciudad = mysqli_real_escape_string($conexion, $ciudad);
$esc_pais = mysqli_real_escape_string($conexion, $pais);
$esc_sexo = mysqli_real_escape_string($conexion, $sexo);
$esc_estilo = mysqli_real_escape_string($conexion, $estilo);
$esc_fechaN = mysqli_real_escape_string($conexion, $fechaN);

if ($pass !== $pass_repeat) {
    header('Location: registro.php?error=pass_repeat');
    $datosCorrectos = false;
}

?>