<?php
    include("conexionBD.php");

    $sentencia = "SELECT * FROM paises";
                            
    if(!($resultado = $conexion->query($sentencia))) {
    	echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
        echo '</p>'; 
        exit;
    }

   	while($fila = $resultado->fetch_object())
    {
        echo "<option value='$fila->NomPais'></option>";
    }
                            
    $resultado->close();

    $conexion->close(); 
?>