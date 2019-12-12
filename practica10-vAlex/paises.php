<?php

    $sentencia = "SELECT * FROM paises";
                            
    if(!($resultado = $conexion->query($sentencia))) {
    	echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
        echo '</p>'; 
        exit;
    }

   	while($filas = $resultado->fetch_object())
    {
        echo "<option value='$filas->NomPais'></option>";
    }
?>