<!DOCTYPE html>
<html lang="es">
<head>

    <title>Detalle foto | myAlbum</title>
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
<section>
    <div class="split-foto izq-foto">
        <div class="margin_info_foto">
            <div class="row">
                <h3 style=" float: left; width: 80%; margin-top: 7%">Álbum</h3>
                <div style="float: left; width: 10%; margin-bottom: 2%">
                    <span style="font-size: 2em;">23</span><br>
                    <span>ENE</span>
                </div>
                <br>
            </div>
            <h2 style="text-align: left; margin-top: 0; margin-bottom: 0">Titulo de la foto</h2><br>
            <div style="text-align: left" class="fontSize">Lorem ipsum dolor sit amet consectetur adipiscing elit, sed
                inceptos malesuada praesent primis. Eu pharetra lacinia sociosqu ac cum commodo laoreet ridiculus
                praesent, auctor fermentum enim platea quisque pulvinar ad tortor, nibh aliquet orci mauris fringilla
                nisl inceptos odio.
            </div>
            <br>
            <div><i style="margin-right: 2%;" class="fa fa-user fa-lg"></i><span>Usuario</span></div>
        </div>
    </div>

    <?php

    if (isset($_GET['foto']) && $_GET['foto'] == 1) {

        echo '<div class="split-foto dcha-foto"></div>';
    } else if (isset($_GET['foto']) && $_GET['foto'] == 2) {

        echo '<div class="split-foto dcha-foto2"></div>';

    }
    ?>

</section>
</body>
</html>