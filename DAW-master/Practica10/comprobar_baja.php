<!DOCTYPE html>
<html lang="es">
<head>

    <title>Comprobación de baja | myAlbum</title>
    <?php

    include("eleccionEstilo.php");
    ?>
</head>
<body>
<?php
include('headerSinLogear.php');
require("conexionBD.php");

?>


<div id="background-comprobarBaja" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <br><br>
        <h2 class="white text_shadow">Comprobación de baja</h2>
        <form action="eliminar_usuario.php" method="post">
            <label class="label_blanco text_shadow" for="usuario">Confirma tu password</label>
            <input type="password" name="pass" placeholder="Introduce tu password" required value>
            <button type="submit" style="cursor:pointer;">Confimar baja</button>
        </form>
    </section>
</div><br><br>



<footer class="footer"></footer>

</body>
</html>