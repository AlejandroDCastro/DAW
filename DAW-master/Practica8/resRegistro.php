<!DOCTYPE html>
<html lang="es">
<head>
    <title>Respuesta de registro | myAlbum</title>


    <?php
    include("eleccionEstilo.php");
    ?>
</head>
<body>
<?php
include('header.php');
?>

<div id="background-resRegistro" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <br><br>
        <h2 class="white text_shadow">Registro completado</h2>
        <br><br>

        <?php
        $usuario = $_POST['usuario'];
        $pass = $_POST['password'];
        $pass_repeat = $_POST['password_repeat'];
        $email = $_POST['email'];
        $ciudad = $_POST['ciudad'];
        $pais = $_POST['pais'];
        $sexo = $_POST['gender'];
        $estilo = $_POST['estilo'];
        $fechaN = $_POST['FNacimiento'];


        if ($pass !== $pass_repeat) {
            header('Location: registro.php?error=true');
        }

        /*
        echo "<p style='color:white;'>Usuario: " . $usuario . "</p>";
        echo "<p style='color:white;'>Password: " . $pass . "</p>";
        echo "<p style='color:white;'>Email: " . $email . "</p>";
        echo "<p style='color:white;'>Ciudad: " . $ciudad . "</p>";
        echo "<p style='color:white;'>Pais: " . $pais . "</p>";
        echo "<p style='color:white;'>Sexo: " . $sexo . "</p>";
        echo "<p style='color:white;'>Estilo: " . $estilo . "</p>";
        echo "<p style='color:white;'>Fecha: " . $fechaN . "</p>";*/


        ?>
    </section>
</div>

</body>
</html>