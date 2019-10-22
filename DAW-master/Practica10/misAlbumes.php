<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mis álbumes | myAlbum</title>
    <?php
    include("eleccionEstilo.php");
    ?>
</head>
<body>
<?php
include('header.php');
?>
<h2 class="white">Mis álbumes</h2>
<main class="main">
    <?php
    require("conexionBD.php");
    $id_user = mysqli_real_escape_string($conexion, $_SESSION['sesion']['IdUsuario']);
    $sql = "SELECT * FROM ALBUMES WHERE Usuario='$id_user'";
    $rest_albumes = $conexion->query($sql);
    $flag = 1;
    $par = 1;
    while ($fila = $rest_albumes->fetch_assoc()) {

        $id_album = mysqli_real_escape_string($conexion, $fila['IdAlbum']);
        $titulo_album = $fila['Titulo'];
        $descrip_album = $fila['Descripcion'];

        $sql_count = "SELECT count(*) FROM FOTOS WHERE Album='$id_album'";
        $fotos_count = $conexion->query($sql_count);
        $fotos_count_fetch = $fotos_count->fetch_assoc();

        if ($par % 2 != 0) {
            if($fotos_count_fetch['count(*)']==0) {
                echo "<section class=\"info1\">
                <a class='info-link' href='verAlbum.php?album=$id_album'> <h2>$titulo_album</h2></a>
                <p>$descrip_album</p><p>El álbum está vacio. <a class=\"link\" style='text-shadow: none;' href='añadirFoto.php'>Añade alguna foto</a></p></section>";
            }else {
                echo "<section class=\"info1\">
                <a class='info-link' href='verAlbum.php?album=$id_album'> <h2>$titulo_album</h2></a>
                <p>$descrip_album</p></section>";
            }
        }


        $sql = "SELECT Fichero FROM FOTOS WHERE Album='$id_album' limit 3";
        $rest_fotos_albumes = $conexion->query($sql);
        while ($row = mysqli_fetch_assoc($rest_fotos_albumes)) {
            $id_fichero = $row['Fichero'];
            $type_figure = "figure" . $flag;

            if($fotos_count_fetch['count(*)']==1){
                echo "<figure style='grid-column: span 4;' class=\"figure $type_figure\">
                <img class=\"figure-img\" src=\"img/$id_fichero\" alt=\"a kitten\"></figure>";
            }else{
                echo "<figure class=\"figure $type_figure\">
                <img class=\"figure-img\" src=\"img/$id_fichero\" alt=\"a kitten\"></figure>";
            }
            if ($flag == 6) {
                $flag = 0;
            }
            $flag++;
        }

        if ($par % 2 == 0) {
            if($fotos_count_fetch['count(*)']==0) {
                echo "<section class=\"info2\">
                <a class='info-link' href='verAlbum.php?album=$id_album'> <h2>$titulo_album</h2></a>
                <p>$descrip_album</p><p>El álbum está vacio. <a class=\"link\" style='text-shadow: none;' href='añadirFoto.php'>Añade alguna foto</a></p></section>";
            }else {
                echo "<section class=\"info2\">
                <a class='info-link' href='verAlbum.php?album=$id_album'> <h2>$titulo_album</h2></a>
                <p>$descrip_album</p></section>";
            }
        }
        $par++;
    }
    ?></main>
<footer class="footer"></footer>
</body>
</html>