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
        <br><br>

        <?php
        	include("conexionBD.php");
            $tmp_name = $_FILES["input_foto"]["tmp_name"];
            $name_img = basename($_FILES["input_foto"]["name"]);
            $fichero_subido = $name_img . ".jpg";
            move_uploaded_file($tmp_name, "img/$fichero_subido");


        	$fecha = date("Y-m-d", strtotime($_POST['fecha']));
	        $titulo = mysqli_escape_string($conexion,$_POST['titulo']);
	        $descripcion = mysqli_escape_string($conexion,$_POST['descripcion']);
	        $fecha = mysqli_escape_string($conexion,$fecha);
	        $pais = mysqli_escape_string($conexion,$_POST['paises']);
	        $album = mysqli_escape_string($conexion,$_POST['album']);
	        $textoAlternativo = mysqli_escape_string($conexion,$_POST['textoAlternativo']);
	        $fregistro = date('H:i:s');

	        echo "<p class='white'>Titulo: " . $titulo . "</p>";
            echo "<p class='white'>Descripcion: " . $descripcion . "</p>";
            echo "<p class='white'>Fecha: " . $fecha . "</p>";
            echo "<p class='white'>Pais: " . $pais . "</p>";
            echo "<p class='white'>Album: " . $album . "</p>";
            echo "<p class='white'>Texto Alternativo: " . $textoAlternativo . "</p>";
            echo "<p class='white'>Fecha: " . $fecha . "</p>";
            echo "<p class='white'>Fecha Registro: " . $fregistro . "</p>";


	        $sql = "INSERT INTO fotos(IdFoto,Titulo,Descripcion,Fecha,Pais,Album,Fichero,Alternativo,FRegistro) VALUES('NULL','$titulo','$descripcion','$fecha','$pais','$album','i1.jpeg','$textoAlternativo','$fregistro')";

	        if($conexion->query($sql)){
	        	echo "<h2 class='white text_shadow'> Introducida con éxito</h3>";
	        }



        


        ?>
    </section>
</div>

</body>
</html>