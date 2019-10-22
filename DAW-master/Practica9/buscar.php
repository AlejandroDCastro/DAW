<!DOCTYPE html>
<html lang="es">
<head>
    <title>Búsqueda avanzada | myAlbum</title>
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
<div id="background-buscar" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <h2 class="white text_shadow">Búsqueda avanzada</h2>
        <form action="resBuscar.php" method="get">
            <label class="label_blanco text_shadow">Titulo</label>
            <input type="text" name="titulo" placeholder="Vacaciones en Ibiza" required>
            <br><br>
            <div class="row">
                <div style="float:left;padding: 0 4% 0 0%;" class="col-6">
                    <label>
                        <label class="label_blanco text_shadow">Desde</label>
                        <input name="desde" type="date" style="width: 100%"></label>
                </div>
                <div style="float:left;" class="col-6">
                    <label>
                        <br id="br_none">
                        <label class="label_blanco text_shadow">Hasta</label>
                        <input name="hasta" type="date" style="width: 100%"></label>
                </div>
            </div>
            <br>
            <label class="label_blanco text_shadow">País</label>
            <div class="select">
                <select name="pais">
                    <option value="all">Todos los países</option>
                    <?php
                    require("rellenarPaises.php");
                    ?>
                </select></div>
            <br>
            <button type="submit" style="cursor:pointer">Buscar</button>
        </form>
    </section>
</div>
</body>
</html>