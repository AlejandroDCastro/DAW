<!DOCTYPE html>
<html lang="es">
<head>

    <title>Resultados búsqueda | myAlbum</title>
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
include('headerSinLogear.php');
?>

<div id="background-resBuscar" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <h2 class="white text_shadow">Resultados de la búsqueda</h2>
        <br><br>

        <?php
        $nombre = $_GET['nombre_buscar'];
        $desde = $_GET['desde'];
        $hasta = $_GET['hasta'];
        $pais = $_GET['pais'];

        echo "<p style='color:white;'>Nombre: " . $nombre . "</p>";
        echo "<p style='color:white;'>Desde: " . $desde . "</p>";
        echo "<p style='color:white;'>Hasta: " . $hasta . "</p>";
        echo "<p style='color:white;'>País: " . $pais . "</p>";

        ?>
    </section>
</div>

<section class="col-11 margin_auto">
    <br><br>
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