<!DOCTYPE html>
<html lang="es">
<head>
    <title>Mis álbumes | myAlbum</title>
    <?php
    session_start();
    if (!isset($_SESSION['sesion'])) {
        include('head.php');
    } else {
        if ($_SESSION['sesion']['Estilo'] == '1') {
            include('head.php');
        } else if ($_SESSION['sesion']['Estilo'] == '2') {
            include('headAltoContraste.php');
        }
    }
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
        if ($par % 2 != 0) {
            echo "<section class=\"info1\">
                <a class='info-link' href='verAlbum.php?album=$id_album'> <h2>$titulo_album</h2></a>
                <p>$descrip_album</p></section>";
        }
        $sql = "SELECT Fichero FROM FOTOS WHERE Album='$id_album' limit 3";
        $rest_fotos_albumes = $conexion->query($sql);
        while ($row = mysqli_fetch_assoc($rest_fotos_albumes)) {
            $id_fichero = $row['Fichero'];
            $type_figure = "figure" . $flag;
            echo "<figure class=\"figure $type_figure\">
                <img class=\"figure-img\" src=\"img/$id_fichero\" alt=\"a kitten\"></figure>";
            if ($flag == 6) {
                $flag = 0;
            }
            $flag++;
        }
        if ($par % 2 == 0) {
            echo "<section class=\"info2\">
                <a class='info-link' href='verAlbum.php?album=$id_album'> <h2>$titulo_album</h2></a>
                <p>$descrip_album</p></section>";
        }
        $par++;
    }
    ?></main>
<footer class="footer"></footer>
</body>
</html>