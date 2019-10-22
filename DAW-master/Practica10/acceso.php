<?php
require("conexionBD.php");

$username = mysqli_real_escape_string($conexion, $_POST['usuario']);
$password = mysqli_real_escape_string($conexion, $_POST['password']);

$sql = "SELECT * FROM USUARIOS WHERE NomUsuario='$username' and Clave='$password'";
$resultados = $conexion->query($sql);

if ($resultados->num_rows > 0) {
    $datosUsu = $resultados->fetch_all(MYSQLI_ASSOC);


    $datos = array(
        "IdUsuario" => $datosUsu[0]['IdUsuario'],
        "usuario" => $datosUsu[0]['NomUsuario'],
        "pass" => $datosUsu[0]['Clave'],
        "tiempo" => getdate(),
        "Estilo" => $datosUsu[0]['Estilo'],
    );
    // Comprobamos si esta marcada la casilla de recuerdame para añadir la cookie

    if (isset($_POST['recuerdame'])) {
        setcookie("recuerdame", json_encode($datos), time() + 7776000);
    }

    session_start();
    $_SESSION['sesion'] = $datos;

    header('Location: menu.php');
} else {
    header('Location: index.php?error');

}
?>