<!DOCTYPE html>
<html lang="es">
<head>

    <title>Álbum creado | myAlbum</title>
    <?php
    session_start();
    if (!isset($_SESSION['sesion'])) {
        header('Location:' . 'index.php');
    } else {


        if ($_SESSION['sesion']['Estilo'] == "style") {
            include('head.php');
        } else if ($_SESSION['sesion']['Estilo'] == "Alto contraste") {
            include('headAltoContraste.php');
        }
    }
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

        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];


        echo "<p style='color:white;'>Título: " . $titulo . "</p>";
        echo "<p style='color:white;'>Descripcion: " . $descripcion . "</p>";


        ?>

    </section>
</div>

</body>
</html>