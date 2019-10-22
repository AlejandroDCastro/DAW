<!DOCTYPE html>
<html lang="es">
<head>

    <title>Álbum solicitado | myAlbum</title>
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
            require('conexionBD.php');
            $nombre = $_POST['nombre'];
            $album = $_POST['album'];
            $extra = $_POST['texto_extra'];
            $color = $_POST['impresion'];
            $copias = $_POST['copias'];
            $resolucion = $_POST['resolucion'];
            $direccion = $_POST['direccion'];
            $email = $_POST['email'];

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
            $albumMostrar = $nombreAlbum->fetch_assoc();

            echo "<p class='white'>Nombre: " . $nombre . "</p>";
            echo "<p class='white'>Título: " . $albumMostrar['Titulo'] . "</p>";
            echo "<p class='white'>Texto adicional: " . $extra . "</p>";
            echo "<p class='white'>Número de copias: " . $copias . "</p>";
            echo "<p class='white'>Direccion: " . $direccion . "</p>";
            echo "<p class='white'>Precio total: " . $precio_total . "</p>";

            if ($color == 'bn') {
                echo "<p style='color:white;'>Color: Blanco y negro</p>";
                $Icolor = '0';
            } else {
                echo "<p style='color:white;'>Color: En color</p>";
                $Icolor = '1';
            }

            $albumSolicitud = $albumMostrar['IdAlbum'];
            $fecha = date('Y-m-d H:i:s');
            $fregistro = date('H:i:s');

            //Insercion en solicitudes
            //IdSolicitud Album   Nombre  Titulo  Descripcion Email   Direccion   Color   Copias  Resolucion  Fecha   IColor  FRegistro   Coste
            $album = mysqli_real_escape_string($conexion, $albumSolicitud);
            $nombre = mysqli_real_escape_string($conexion, $nombre);
            $album = mysqli_real_escape_string($conexion, $album);
            $extra = mysqli_real_escape_string($conexion, $extra);
            $email = mysqli_real_escape_string($conexion, $email);
            $direccion = mysqli_real_escape_string($conexion, $direccion);
            $color = mysqli_real_escape_string($conexion, $color);
            $copias = mysqli_real_escape_string($conexion, $copias);
            $resolucion = mysqli_real_escape_string($conexion, $resolucion);
            $fecha = mysqli_real_escape_string($conexion, $fecha);
            $icolor = mysqli_real_escape_string($conexion, $Icolor);
            $fregistro = mysqli_real_escape_string($conexion, $fregistro);
            $precio_total = mysqli_real_escape_string($conexion, $precio_total);



            $sql = "INSERT INTO solicitudes(IdSolicitud,Album,Nombre,Titulo,Descripcion,Email,Direccion,Color,Copias,Resolucion,Fecha,IColor,FRegistro,Coste) VALUES('NULL','$album','$nombre','$album','$extra','$email','$direccion','$color','$copias','$resolucion','$fecha','$icolor','$fregistro','$precio_total')";

                /*$stmt = $conexion->prepare($peticion);
                $stmt->execute(array(':IdSolicitud'=> null,':Album'=>$albumSolicitud,':Nombre'=>$nombre,':Titulo'=>$album,':Descripcion'=>$extra,':Email'=>$email,':Direccion'=>$direccion,':Color'=>$color,':Copias'=>$copias,':Resolucion'=>$resolucion,':Fecha'=>$fecha,'IColor'=>$Icolor,'FRegistro'=>$fregistro,':Coste'=>$precio_total));*/

            if ($conexion->query($sql) === TRUE) {
                echo "<h3 class='white text_shadow'>Peticion recogida en el servidor</h3>";
            }else{
                echo "<h3 class='white text_shadow'>Algo salió mal en al insertar</h3>";

            }

            
            
        ?>
    </section>
</div>

</body>
</html>