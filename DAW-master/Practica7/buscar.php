<!DOCTYPE html>
<html lang="es">
<head>

    <title>Búsqueda avanzada | myAlbum</title>
    <?php
    session_start();
    if (isset($_SESSION['sesion'])) {


        if ($_SESSION['sesion']['Estilo'] == "style") {
            include('head.php');
        } else if ($_SESSION['sesion']['Estilo'] == "Alto contraste") {
            include('headAltoContraste.php');
        }
    } else {
        include('head.php');
    }

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

            <label class="label_blanco text_shadow">Nombre de usuario</label>
            <input type="text" name="nombre_buscar" placeholder="Introduce tu usuario" required>
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
            <select name="pais">
                <option value="pais1">País 1</option>
                <option value="pais2">País 2</option>
                <option value="pais3">País 3</option>
                <option value="pais4">País 4</option>
            </select>
            <br><br>

            <button type="submit" style="cursor:pointer">Buscar</button>


        </form>
    </section>
</div>
</body>
</html>