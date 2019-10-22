<!DOCTYPE html>
<html lang="es">
<head>

    <title>Inicio | myAlbum</title>
    <?php
    session_start();

    include("recuerdame.php");

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
    <br>
    <h2 class="white">Últimas fotos</h2>
    <div class="container col-11 margin_auto">
        <?php
        require("conexionBD.php");

        $sql = "SELECT * FROM FOTOS ORDER BY FRegistro DESC limit 6";
        $resultados = $conexion->query($sql);

        if ($conexion->errno) {
            echo "Problemas al establecer conexion";
        }

        while ($fila = $resultados->fetch_assoc()) {
            $id = $fila['IdFoto'];
            $fichero = $fila['Fichero'];
            $titulo = $fila['Titulo'];
            $descripcion = $fila['Descripcion'];
            $paisBuscar = mysqli_real_escape_string($conexion, $fila['Pais']);
            $sqlPais = "SELECT * FROM PAISES WHERE IdPais = '$paisBuscar'";
            $pais = $conexion->query($sqlPais);
            $fecha = $fila['FRegistro'];
            $paisNom = $pais->fetch_assoc();
            $paisNom2 = $paisNom['NomPais'];

            echo "<a class='link_photo' href='foto.php?foto=$id'><div class='box_photo'><div class=\"foto\" style=\"background-image: url('img/$fichero');\"><div class=\"text_photo\"><h2>$titulo</h2><div class='info_foto'>$descripcion</div><br><div class='info_foto'>$paisNom2, $fecha</div></div></div></div></a>";
        }

        ?>

    </div>
</section>
<footer class="footer"></footer>

</body>
</html>