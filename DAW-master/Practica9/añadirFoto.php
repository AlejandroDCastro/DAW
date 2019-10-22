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
?>
<div id="background-añadirFoto" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <h2 class="white text_shadow">Añadir foto a álbum</h2>
        <form action="resSubidaFoto.php" method="post">
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
                        <select name="paises">
                            <?php
                                require("rellenarPaises.php");
                            ?>
                        </select></div>
                </div>
            </div>
            <br>
            <label class="label_blanco text_shadow" for="textoAlternativo">Texto alternativo</label>
            <input type="text" name="textoAlternativo" placeholder="" required>
            <br>
            <br>
            <label class="label_blanco text_shadow" for="album">Album</label>
            <div class="select">
                <select name="album">
                    <?php
                    require("rellenarAlbumes.php");
                    ?>
                </select></div>
            <br>
            <label id="add-computer-button" for="fileupload" class="upload_file_btn">Sube tu foto
            </label>
            <input id="fileupload" required type="file" multiple="multiple" name="input_foto" accept="image/jpeg"
                   style="visibility: hidden">
            <button type="submit" style="cursor:pointer;">Añadir foto</button>
        </form>
    </section>
</div>
</body>
</html>