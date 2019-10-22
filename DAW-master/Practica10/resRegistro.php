<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro completado | myAlbum</title>


    <?php
    include("eleccionEstilo.php");
    ?>
</head>
<body>
<?php
include("comprobarDatosUsuario.php");


if ($datosCorrectos == true) {
    $sql = "INSERT INTO usuarios (NomUsuario, Clave, Email, Sexo, FNacimiento, Ciudad, Pais, Foto, Estilo)
VALUES ('$esc_usuario', '$esc_pass', '$esc_email', '$esc_sexo', '$esc_fechaN', '$esc_ciudad', '$esc_pais', '$fichero_subido', '$esc_estilo')";
}
?>


<div id="background-resRegistro" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <br><br>

        <?php
        if ($conexion->query($sql) === TRUE) {
            echo "        <h2 class=\"white text_shadow\">Registro completado</h2>";
            echo "        <h2 class=\"white text_shadow\">Tus datos son:</h2>";
            echo "<p style='color:white;'>Usuario: " . $usuario . "</p>";
            echo "<p style='color:white;'>Password: " . $pass . "</p>";
            echo "<p style='color:white;'>Email: " . $email . "</p>";
            echo "<p style='color:white;'>Ciudad: " . $ciudad . "</p>";
            echo "<p style='color:white;'>Pais: " . $pais . "</p>";
            echo "<p style='color:white;'>Sexo: " . $sexo . "</p>";
            echo "<p style='color:white;'>Estilo: " . $estilo . "</p>";
            echo "<p style='color:white;'>Fecha: " . $fechaN . "</p>";
            echo "<p style='color:white;'>Foto: " . $name_img . "</p>";
        } else {
            echo "        <h2 class=\"white text_shadow\">Ha habido un error en el registro</h2>";
        }


        ?>

        <br><br>

    </section>
</div>

</body>
</html>