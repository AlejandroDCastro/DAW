<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados búsqueda | myAlbum</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print"/>
    <link rel="alternate stylesheet" type="text/css" href="css/altoContraste.css" title="Alto contraste">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
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

        echo "<p style='color:white;'>Nombre: ".$nombre."</p>";
        echo "<p style='color:white;'>Desde: ".$desde."</p>";
        echo "<p style='color:white;'>Hasta: ".$hasta."</p>";
        echo "<p style='color:white;'>País: ".$pais."</p>";

        ?>
    </section>
</div>

<section class="col-11 margin_auto">
    <br><br>
    <div class="imageGrid">
        <div class="foto" style="background-image: url('img/i1.jpeg');">
            <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum hac
                    lacus magna in lobortis maecenas
                </div>
            </div>
        </div>

        <div class="foto" style="background-image: url('img/i2.jpeg');">
            <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum hac
                    lacus magna in lobortis maecenas
                </div>
            </div>
        </div>

        <div class="foto" style="background-image: url('img/i3.jpeg');">
            <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum hac
                    lacus magna in lobortis maecenas
                </div>
            </div>
        </div>

        <div class="foto" style="background-image: url('img/i4.jpeg');">
            <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum hac
                    lacus magna in lobortis maecenas
                </div>
            </div>
        </div>

        <div class="foto" style="background-image: url('img/i5.jpeg');">
            <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum hac
                    lacus magna in lobortis maecenas
                </div>
            </div>
        </div>

        <div class="foto" style="background-image: url('img/i6.jpeg');">
            <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum hac
                    lacus magna in lobortis maecenas
                </div>
            </div>
        </div>

    </div>
</section>
<footer class="footer"></footer>

</body>
</html>