<!DOCTYPE html>
<html lang="es">
<head>
    <title>Crear álbum | myAlbum</title>
    <?php
    include("eleccionEstilo.php");
    ?>
</head>
<body>
<?php
include('header.php');
?>

<div id="background-crearAlbum" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <h2 class="white text_shadow">Crear álbum</h2>
        <form action="resCrearAlbum.php" method="post">
            <label class="label_blanco text_shadow" for="usuario">Título</label>
            <input type="text" placeholder="Puesta de sol" required name="titulo">
            <br><br>
            <label class="label_blanco text_shadow" for="usuario">Descripción</label>
            <textarea rows="4" cols="80" name="descripcion" placeholder="Escribe tu informacion extra"></textarea>
            <br><br>
            <br id="br_none">
            <button type="submit" style="cursor:pointer;">Crear álbum</button>
        </form>
    </section>
</div>
</body>
</html>