<!DOCTYPE html>
<html lang="es">
<head>

    <title>Álbum creado | myAlbum</title>
    <?php
    if (!isset($_COOKIE['sesion'])) {
        header('Location:' . 'index.php');
    }
    include("eleccionEstilo.php");
    ?>
</head>
<body>
<?php
include('header.php');
?>

<div id="background-resAlbum" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <br><br>
        <h2 class="white text_shadow">Se ha registrado la solicitud</h2>
        <br><br>
        <?php
        include("conexionBD.php");
        $titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
        $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
        $usuario = mysqli_real_escape_string($conexion, $_SESSION['sesion']['IdUsuario']);

        echo "<p style='color:white;'>Título: " . $titulo . "</p>";
        echo "<p style='color:white;'>Descripcion: " . $descripcion . "</p>";
        echo "<p style='color:white;'>ID Usuario: " . $usuario . "</p>";


        

        $sql = "INSERT INTO ALBUMES(IdAlbum,Titulo,Descripcion,Usuario) VALUES ('NULL','$titulo','$descripcion','$usuario')";

        if ($conexion->query($sql) === TRUE) {
            echo "Introducido";
        }


        ?>

    </section>
</div>

</body>
</html>