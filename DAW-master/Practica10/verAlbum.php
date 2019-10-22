<!DOCTYPE html>
<html lang="es">
<head>

    <title>Inicio | myAlbum</title>
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

<div id="background-verAlbum" class="background_parallax">
    <section class="col-4 margin_auto ">
        <br>

        <?php

        setlocale(LC_TIME, "spanish");
        require("conexionBD.php");
        $id_album = mysqli_real_escape_string($conexion, $_GET['album']);


        $sql = "SELECT * FROM fotos WHERE Album=$id_album";

        $resultados = $conexion->query($sql);

        

        $sql2 = "SELECT min(Fecha) as minFecha, max(Fecha) as maxFecha FROM fotos WHERE Album=$id_album";
        $resultados_fecha = $conexion->query($sql2);

        $row_fechas = $resultados_fecha->fetch_assoc();

        $sql3 = "SELECT * FROM albumes WHERE IdAlbum=$id_album";
        $resultados_album = $conexion->query($sql3);
        $fila_album = $resultados_album->fetch_assoc();


        $sql4 = "SELECT distinct Pais FROM fotos WHERE Album=$id_album";
        $resultados_paises = $conexion->query($sql4);


        $array_paises = array();

        while ($row_paises = $resultados_paises->fetch_assoc()) {
            $id_pais = mysqli_real_escape_string($conexion, $row_paises['Pais']);

            $sql5 = "SELECT nomPais FROM paises WHERE IdPais=$id_pais";
            $resultados_nombres_paises = $conexion->query($sql5);

            $res_paises_fetch = $resultados_nombres_paises->fetch_assoc();

            array_push($array_paises, $res_paises_fetch['nomPais']);
        }



        $nombre_album = $fila_album['Titulo'];
        $descrip_album = $fila_album['Descripcion'];
        $min_fecha = $row_fechas['minFecha'];
        $max_fecha = $row_fechas['maxFecha'];


        $fecha_remp_min = str_replace("/", "-", $min_fecha);
        $fecha_format_min = date("d-m-Y", strtotime($fecha_remp_min));

        $fecha_remp_max = str_replace("/", "-", $max_fecha);
        $fecha_format_max = date("d-m-Y", strtotime($fecha_remp_max));

        echo "<h2 class=\"white\">$nombre_album</h2>";
        echo "<div class=\"fecha_album\"><strong>$fecha_format_min</strong> | <strong>$fecha_format_max</strong></div>";
        echo "<p style='text-align: center' class='white'>$descrip_album</p>";

        echo "<div class=\"info_paises\">";

        foreach ($array_paises as $pais) {
            echo "$pais";
            if ($pais !== end($array_paises)) {
                echo ", ";
            }
        }

        echo "</div>";
        if(isset($resultados)){
            echo "<p class='white'>No hay fotos</p>";
        }
        ?>

        
        <br>
    </section>
</div>
<section class="col-11 margin_auto">
    <br>

    <div class="container col-11 margin_auto">
        <?php

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