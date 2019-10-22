<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Álbum solicitado | myAlbum</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print"/>
    <link rel="alternate stylesheet" type="text/css" href="css/altoContraste.css" title="Alto contraste">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
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
            $nombre = $_POST['nombre'];
            $titulo = $_POST['titulo'];
            $extra = $_POST['texto_extra'];
            $color = $_POST['impresion'];
            $copias = $_POST['copias'];
            $resolucion = $_POST['resolucion'];

            $numero_paginas = 8;
            $numero_fotos = 15;


            $precio_fotos = 0;
            $precio_paginas = 0;
            $precio_total = 0;

            if($color == 'bn'){
                $precio_fotos = 0;
            }
            else{
                $precio_fotos = $numero_fotos * 0.05;
            }

            if($resolucion>300){
                $precio_fotos = $precio_fotos + ($numero_fotos * 0.02);
            }

            if($numero_paginas<5){
                $precio_paginas = $numero_paginas * 0.10;
            }
            if(5<$numero_paginas && $numero_paginas>10){
                $precio_paginas = $numero_paginas * 0.08;
            }
            if($numero_paginas>10){
                $precio_paginas = $numero_paginas * 0.07;
            }

            $precio_total = $precio_fotos + $precio_paginas;
            $precio_total = $precio_total * $copias;

            echo "<p style='color:white;'>Nombre: ".$nombre."</p>";
            echo "<p style='color:white;'>Título: ".$titulo."</p>";
            echo "<p style='color:white;'>Texto adicional: ".$extra."</p>";
            echo "<p style='color:white;'>Número de copias: ".$copias."</p>";
            echo "<p style='color:white;'>Precio total: ".$precio_total."</p>";

            if($color == 'bn'){
                echo "<p style='color:white;'>Color: Blanco y negro</p>";
            }else{
                echo "<p style='color:white;'>Color: En color</p>";
            }
        ?>

    </section>
</div>

</body>
</html>