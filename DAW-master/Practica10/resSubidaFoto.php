<!DOCTYPE html>
<html lang="es">
<head>
    <title>Respuesta subida foto | myAlbum</title>


    <?php
    include("eleccionEstilo.php");
    ?>
</head>
<body>
<?php
include('header.php');
?>

<div id="background-resRegistro" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <br><br>
        <h2 class="white text_shadow">Subida de imagen</h2>


        <?php
        	include("conexionBD.php");

            $count_fotos = 0;
            $array_albumes_fetch = array();
            $IdUsuario = mysqli_real_escape_string($conexion, $_SESSION['sesion']['IdUsuario']);
            $usuario = mysqli_real_escape_string($conexion, $_SESSION['sesion']['usuario']);
            $sql = "SELECT IdAlbum from ALBUMES where Usuario='$IdUsuario'";
            $array_albumes = $conexion->query($sql);

            while ($fila = $array_albumes->fetch_assoc()) {
                array_push($array_albumes_fetch, $fila);
            }

            foreach ($array_albumes_fetch as $album) {
                $id_album = $album['IdAlbum'];
                $sql = "SELECT count(*) from fotos where Album='$id_album'";
                $num_fotos = $conexion->query($sql);
                $num_fotos_fetch = $num_fotos->fetch_assoc();

                $count_fotos += (int)$num_fotos_fetch['count(*)'];
            }



        	$tmp_name = $_FILES["input_foto"]["tmp_name"];
        	$name_img = basename($_FILES["input_foto"]["name"]);
        	$nueva_foto = $count_fotos+1;
            $fichero_subido = $usuario . "_foto". $nueva_foto . "_.jpg";
            move_uploaded_file($tmp_name, "img/$fichero_subido");

        	$fecha = date("Y-m-d", strtotime($_POST['fecha']));
	        $titulo = mysqli_escape_string($conexion,$_POST['titulo']);
	        $descripcion = mysqli_escape_string($conexion,$_POST['descripcion']);
	        $fecha = mysqli_escape_string($conexion,$fecha);
	        $pais = mysqli_escape_string($conexion,$_POST['paises']);
	        $album = mysqli_escape_string($conexion,$_POST['album']);
	        $textoAlternativo = mysqli_escape_string($conexion,$_POST['textoAlternativo']);
	        $fregistro = date('H:i:s');




	        $sql = "INSERT INTO fotos(IdFoto,Titulo,Descripcion,Fecha,Pais,Album,Fichero,Alternativo,FRegistro) VALUES('NULL','$titulo','$descripcion','$fecha','$pais','$album','i1.jpeg','$textoAlternativo','$fregistro')";

	        if($conexion->query($sql)){
	        	echo "<h2 class='white text_shadow'> Introducida con éxito</h3>";
	        }

        echo "<p class='white'>Titulo: " . $titulo . "</p>";
        echo "<p class='white'>Descripcion: " . $descripcion . "</p>";
        echo "<p class='white'>Fecha: " . $fecha . "</p>";
        echo "<p class='white'>Pais: " . $pais . "</p>";
        echo "<p class='white'>Album: " . $album . "</p>";
        echo "<p class='white'>Texto Alternativo: " . $textoAlternativo . "</p>";
        echo "<p class='white'>Fecha: " . $fecha . "</p>";
        echo "<p class='white'>Fecha Registro: " . $fregistro . "</p>";


        ?>
    </section>
</div>

</body>
</html>