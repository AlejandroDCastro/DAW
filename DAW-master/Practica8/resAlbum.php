<!DOCTYPE html>
<html lang="es">
<head>

    <title>Álbum solicitado | myAlbum</title>
    <?php
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
        require('conexionBD.php');
        $nombre = $_POST['nombre'];
        $album = $_POST['album'];
        $extra = $_POST['texto_extra'];
        $color = $_POST['impresion'];
        $copias = $_POST['copias'];
        $resolucion = $_POST['resolucion'];

        $numero_paginas = 8;
        $numero_fotos = 15;


        $precio_fotos = 0;
        $precio_paginas = 0;
        $precio_total = 0;

        if ($color == 'bn') {
            $precio_fotos = 0;
        } else {
            $precio_fotos = $numero_fotos * 0.05;
        }

        if ($resolucion > 300) {
            $precio_fotos = $precio_fotos + ($numero_fotos * 0.02);
        }

        if ($numero_paginas < 5) {
            $precio_paginas = $numero_paginas * 0.10;
        }
        if (5 < $numero_paginas && $numero_paginas < 10) {
            $precio_paginas = $numero_paginas * 0.08;
        }
        if ($numero_paginas > 10) {
            $precio_paginas = $numero_paginas * 0.07;
        }

        $precio_total = $precio_fotos + $precio_paginas;
        $precio_total = $precio_total * $copias;

        $IdAlbum = mysqli_real_escape_string($conexion, $album);

        $sql = 'SELECT * from ALBUMES where IdAlbum="'.$IdAlbum.'"';
        $nombreAlbum = $conexion->query($sql);
        $titulo = $nombreAlbum->fetch_assoc();

        echo "<p class='white'>Nombre: " . $nombre . "</p>";
        echo "<p class='white'>Título: " . $titulo['Titulo'] . "</p>";
        echo "<p class='white'>Texto adicional: " . $extra . "</p>";
        echo "<p class='white'>Número de copias: " . $copias . "</p>";
        echo "<p class='white'>Precio total: " . $precio_total . "</p>";

        if ($color == 'bn') {
            echo "<p style='color:white;'>Color: Blanco y negro</p>";
        } else {
            echo "<p style='color:white;'>Color: En color</p>";
        }
        ?>
    </section>
</div>

</body>
</html>