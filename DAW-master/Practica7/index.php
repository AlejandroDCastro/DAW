<!DOCTYPE html>
<html lang="es">
<head>

    <title>Inicio | myAlbum</title>
    <?php
    session_start();
    if (isset($_SESSION['sesion'])) {


        if ($_SESSION['sesion']['Estilo'] == "style") {
            include('head.php');
        } else if ($_SESSION['sesion']['Estilo'] == "Alto contraste") {
            include('headAltoContraste.php');
        }
    } else {
        include('head.php');
    }

    ?>
</head>
<body>
<?php
if (isset($_SESSION['sesion'])) {
    include('header.php');
} else {
    include('headerSinLogear.php');
}

?>

<?php

if (isset($_GET["error"]) == true) {
    echo "<h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>Error en el login</h1>";
}

?>
<?php


if (!isset($_SESSION['sesion'])) {
    include('loginIndex.php');
} else {
    include('noLogin.php');
}

?>

<section class="col-11 margin_auto">

    <h2 class="white">Últimas fotos</h2>

    <div class="imageGrid">

        <a href="foto.php?foto=1">
            <div class="foto" style="background-image: url('img/i1.jpeg');">
                <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                    <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum
                        hac lacus magna in lobortis maecenas
                    </div>
                </div>
            </div>
        </a>

        <a href="foto.php?foto=2">
            <div class="foto" style="background-image: url('img/i2.jpeg');">
                <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                    <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum
                        hac lacus magna in lobortis maecenas
                    </div>
                </div>
            </div>
        </a>

        <a href="foto.php?foto=1">
            <div class="foto" style="background-image: url('img/i3.jpeg');">
                <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                    <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum
                        hac lacus magna in lobortis maecenas
                    </div>
                </div>
            </div>
        </a>

        <a href="foto.php?foto=2">
            <div class="foto" style="background-image: url('img/i4.jpeg');">
                <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                    <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum
                        hac lacus magna in lobortis maecenas
                    </div>
                </div>
            </div>
        </a>

        <a href="foto.php?foto=1">
            <div class="foto" style="background-image: url('img/i5.jpeg');">
                <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                    <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum
                        hac lacus magna in lobortis maecenas
                    </div>
                </div>
            </div>
        </a>

        <a href="foto.php?foto=2">
            <div class="foto" style="background-image: url('img/i6.jpeg');">
                <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                    <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum
                        hac lacus magna in lobortis maecenas
                    </div>
                </div>
            </div>
        </a>

    </div>
</section>
<footer class="footer"></footer>

</body>
</html>