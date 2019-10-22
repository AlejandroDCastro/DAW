<!DOCTYPE html>
<html lang="es">
<head>

    <title>Detalle foto | myAlbum</title>
    <?php

    include("eleccionEstilo.php");
    ?>
</head>
<body>
<?php
include('header.php');
require("conexionBD.php");
setlocale(LC_TIME, "spanish");



$sql_num = "SELECT count(*) FROM FOTOS";
$result_fotos = $conexion->query($sql_num);
$fila_fotos = $result_fotos->fetch_assoc();

$id_foto = mysqli_real_escape_string($conexion, $_GET['foto']);

if ((int)$fila_fotos['count(*)'] < (int)$_GET['foto']) {
    header('Location: 404.php');
} else {
    $sql = "SELECT * FROM FOTOS WHERE IdFoto = '$id_foto'";
    $resultados = $conexion->query($sql);

    while ($fila = $resultados->fetch_assoc()) {
        $titulo = $fila['Titulo'];

        $id_album = mysqli_real_escape_string($conexion, $fila['Album']);
        $album_row = $conexion->query("SELECT Titulo,Usuario FROM albumes WHERE IdAlbum = '$id_album'");
        $album_fetch = $album_row->fetch_assoc();

        $id_usuario = mysqli_real_escape_string($conexion, $album_fetch['Usuario']);
        $usuario_row = $conexion->query("SELECT NomUsuario FROM usuarios WHERE IdUsuario = '$id_usuario'");
        $usuario_fetch = $usuario_row->fetch_assoc();

        $descrip = $fila['Descripcion'];
        $fichero = $fila['Fichero'];
        $fecha = $fila['Fecha'];
        list($anyo, $mes, $dia) = explode('-', $fecha);

        $fecha_remp = str_replace("/", "-", $fecha);
        $fecha_format = date("d-m-Y", strtotime($fecha_remp));
        $mes_format = strftime("%B", strtotime($fecha_format));
        $mes_format = strtoupper($mes_format);

        $fecha_correcta = substr($mes_format, 0, 3);
        $url = "img/" . $fichero;
        echo "<div class=\"split-foto dcha-foto\" style=\"background-image:url('$url');\"></div>";
    }


    echo "
<section>
    <div class='split-foto izq-foto'>
        <div class='margin_info_foto'>
            <div class='row''>
                <h3 style=' float: left; width: 80%; margin-top: 7%'>$album_fetch[Titulo]</h3>
                <div style='float: left; width: 10%; margin-bottom: 2%'>
                    <span style='font-size: 2em;'>$dia</span><br>
                    <span>$fecha_correcta</span>
                </div>
                <br>
            </div>
            <h2 style='text-align: left; margin-top: 0; margin-bottom: 0'>$titulo</h2><br>
            <div style='text-align: left' class='fontSize'>$descrip
            </div>
            <br>
            <div><i style='margin-right: 2%;' class='fa fa-user fa-lg'></i><span>$usuario_fetch[NomUsuario]</span></div>
        </div>
    </div>";
}
?>


</section>
</body>
</html>