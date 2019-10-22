<?php
require("conexionBD.php");

$sql = "SELECT * from ESTILOS";
$resultados = $conexion->query($sql);

if ($conexion->errno) {
    echo "Problemas al establecer conexion";
}

while ($fila = $resultados->fetch_assoc()) {
    //Al hacer el POST enviamos el value ya que al insertar en la BBDD especificaremos el Id del pais y no el nombre
    echo "<option value=" . "'" . $fila['IdEstilo'] . "'>" . $fila['Nombre'] . "</option>";

}

$conexion->close();
?>