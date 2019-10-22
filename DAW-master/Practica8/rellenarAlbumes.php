<?php

include("conexionBD.php");
//session_start();
$IdUsuario = mysqli_real_escape_string($conexion, $_SESSION['sesion']['IdUsuario']);

//TODO aun no se si hay que insertar usuarios por eso no se que poner en el where
$sql = "SELECT * from ALBUMES where Usuario='$IdUsuario'";
$resultados = $conexion->query($sql);

if ($conexion->errno) {
    echo "Problemas al establecer conexion";
}

while ($fila = $resultados->fetch_assoc()) {
    //Al hacer el POST enviamos el value ya que al insertar en la BBDD especificaremos el Id del pais y no el nombre
    echo "<option value=" . "'" . $fila['IdAlbum'] . "'>" . $fila['Titulo'] . "</option>";

}
