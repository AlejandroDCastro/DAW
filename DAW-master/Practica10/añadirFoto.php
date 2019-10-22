<?php
if (isset($_COOKIE['sesion'])) {
    header('Location:' . 'index.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Añadir foto a álbum | myAlbum</title>
    <?php
    include("eleccionEstilo.php");
    ?>
</head>
<body>
<?php
include('headerSinLogear.php');
include('conexionBD.php');

$IdUsuario = mysqli_real_escape_string($conexion, $_SESSION['sesion']['IdUsuario']);

$sql_count = "SELECT count(*) FROM albumes WHERE Usuario='$IdUsuario'";
$albumes_count = $conexion->query($sql_count);
$albumes_count_fetch = $albumes_count->fetch_assoc();

?>
<div id="background-añadirFoto" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <h2 class="white text_shadow">Añadir foto a álbum</h2>
        <?php

        if($albumes_count_fetch['count(*)'] == 0){
            echo "        <p style='text-align: center' class=\"white text_shadow\">No tienes albumes. <a class='link' href='crearAlbum.php'>Añade alguno</a></p>";
        }else {

            echo '<form action="resSubidaFoto.php" method="post" enctype="multipart/form-data">
            <label class="label_blanco text_shadow" for="titulo">Título de la foto</label>
            <input type="text" name="titulo" placeholder="Vacaciones en Ibiza" required>
            <br><br>
            <label class="label_blanco text_shadow" for="descripcion">Descripción</label>
            <textarea rows="4" cols="80" name="descripcion" placeholder="Escribe tu informacion extra"></textarea>
            <br><br>
            <div class="row">
                <div style="float:left; padding: 0 4% 0 0%;" class="col-6">
                    <label>
                        <label class="label_blanco text_shadow" for="fecha">Fecha</label>
                        <input type="date" name="fecha" required>
                </div>
                <div style="float:left;" class="col-6">
                    <br id="br_none">
                    <label class="label_blanco text_shadow">País</label>
                    <div class="select">
                        <select name="paises">';

            require("rellenarPaises.php");

            echo '            </select></div>
                </div>
            </div>
            <br>
            <label class="label_blanco text_shadow" for="textoAlternativo">Texto alternativo</label>
            <input type="text" name="textoAlternativo" placeholder="" required>
            <br>
            <br>
            <label class="label_blanco text_shadow" for="album">Album</label>
            <div class="select">
                <select name="album">';

            require("rellenarAlbumes.php");

            echo '</select></div>
            <br>
            <label id="add-computer-button" for="fileupload" class="upload_file_btn">Sube tu foto
            </label>
            <input id="fileupload" type="file" name="input_foto" accept="image/jpeg"
                   style="visibility: hidden">
            <button type="submit" style="cursor:pointer;">Añadir foto</button>
        </form>';
        }
            ?>
    </section>
</div>
</body>
</html>