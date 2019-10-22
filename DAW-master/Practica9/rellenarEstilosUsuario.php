<?php
    require("conexionBD.php");

    $sql = "SELECT * from ESTILOS";
    $resultados = $conexion->query($sql);
    $usuario = mysqli_real_escape_string($conexion, $_SESSION['sesion']['usuario']);

    $sql2 = "SELECT * from usuarios where NomUsuario='$usuario'";
    $resultadoUsuario = $conexion->query($sql2);
    $resultados2 = mysqli_fetch_assoc($resultadoUsuario);
    if ($conexion->errno) {
        echo "Problemas al establecer conexion";
    }

    while ($fila = $resultados->fetch_assoc()) {
        //Al hacer el POST enviamos el value ya que al insertar en la BBDD especificaremos el Id del pais y no el nombre
        if($resultados2['Estilo']==$fila['IdEstilo']){
            echo "<option value=" . "'" . $fila['IdEstilo'] . "' selected>" . $fila['Nombre'] . "</option>";

        }else{
            echo "<option value=" . "'" . $fila['IdEstilo'] . "'>" . $fila['Nombre'] . "</option>";

        }

    }

    $conexion->close();
?>