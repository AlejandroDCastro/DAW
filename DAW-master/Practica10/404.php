<!DOCTYPE html>
<html lang="es">
<head>
    <title>Error 404 | myAlbum</title>
    <?php
    include("eleccionEstilo.php");
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
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
            <h2>Página no encontrada</h2>
        </div>
        <a href="index.php">Volver a inicio</a>
    </div>
</div>
</body>
</html>