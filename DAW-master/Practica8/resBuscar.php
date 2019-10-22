<!DOCTYPE html>
<html lang="es">
<head>

    <title>Resultados búsqueda | myAlbum</title>
    <?php
    include("eleccionEstilo.php");
    ?>
</head>
<body>
<?php
include('headerSinLogear.php');
?>

<div id="background-resBuscar" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <h2 class="white text_shadow">Resultados de la búsqueda</h2>
        <br>

        <?php
        require("conexionBD.php");
        
        $titulo = mysqli_real_escape_string($conexion, $_GET['titulo']);
        $desde = mysqli_real_escape_string($conexion, $_GET['desde']);
        $hasta = mysqli_real_escape_string($conexion, $_GET['hasta']);
        $pais = mysqli_real_escape_string($conexion, $_GET['pais']);

        /*
        echo "<p style='color:white;'>Nombre: " . $titulo . "</p>";
        echo "<p style='color:white;'>Desde: " . $desde . "</p>";
        echo "<p style='color:white;'>Hasta: " . $hasta . "</p>";
        echo "<p style='color:white;'>País: " . $pais . "</p>";
*/
        ?>
    </section>
</div>

<section class="col-11 margin_auto">
    <br><br>
    <div class="container col-11 margin_auto">

        <?php
        $sql = "SELECT * FROM FOTOS WHERE Titulo LIKE '%$titulo%' AND Fecha BETWEEN '$desde' AND '$hasta' AND Pais = '$pais'";

        $resultados = $conexion->query($sql);

        if (mysqli_num_rows($resultados) == 0) {
            echo "<p class='white text_shadow'>No se encontró ninguna foto con ese filtro</p>";
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