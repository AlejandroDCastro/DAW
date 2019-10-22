<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro usuario | myAlbum</title>
    <?php
    include('head.php');
    ?>
</head>
<body>
<?php
include('headerSinLogear.php');
?>

<div id="background-registro" class="background_parallax">
    <?php
    if (isset($_GET['error'])) {

        if ($_GET['error'] == 'user') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El usuario no tiene un formato válido</h1>";
        }
        if ($_GET['error'] == 'pass') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El password no tiene un formato válido</h1>";
        }
        if ($_GET['error'] == 'pass_repeat') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El password no es igual</h1>";
        }
        if ($_GET['error'] == 'email') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El email no tiene un formato válido</h1>";
        }
        if ($_GET['error'] == 'ciudad') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>La ciudad no tiene un formato válido</h1>";
        }
        if ($_GET['error'] == 'sexo') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El sexo no tiene un formato válido</h1>";
        }
        if ($_GET['error'] == 'estilo') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El estilo no tiene un formato válido</h1>";
        }
        if ($_GET['error'] == 'pais') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El pais no existe en la BD</h1>";
        }
    }
    ?>
    <section class="col-4 margin_auto padding20">
        <h2 class="text_shadow" style="color:red;">

        </h2>
        <h2 class="white text_shadow">Registro de usuario</h2>
        <form enctype="multipart/form-data" action="resRegistro.php" method="post">

            <label class="label_blanco text_shadow" for="usuario">Nombre de usuario</label>
            <input type="text" name="usuario" placeholder="Usuario1" required>
            <br><br>


            <div class="row">
                <div style="float:left;padding: 0 4% 0 0%;" class="col-6">
                    <label>
                        <label class="label_blanco text_shadow">Contraseña</label>
                        <input type="password" name="password" placeholder="Introduce tu pass"
                               style="width: 100%"></label>
                </div>
                <div style="float:left;" class="col-6 top_none">
                    <br id="br_none">
                    <label>
                        <label style="float:left;" class="label_blanco text_shadow">Repetir contraseña</label>
                        <input type="password" name="password_repeat" placeholder="Vuelve a introducirla"
                               style="width: 100%"></label>
                </div>
            </div>
            <br>
            <label class="label_blanco text_shadow" for="email">Correo electrónico</label>
            <input type="email" name="email" placeholder="usuario1@myalbum.com" required>
            <br><br>
            <div class="row">
                <div style="float:left; padding: 0 4% 0 0%;margin-bottom: 1em" class="col-6">
                    <label class="label_blanco text_shadow">Género</label>
                    <div class="select">
                        <select name="gender">
                            <option value="hombre">Hombre</option>
                            <option value="mujer">Mujer</option>
                            <option value="otro">Otro</option>
                        </select></div>
                </div>
                <div style="float:left;" class="col-6">
                    <label class="label_blanco text_shadow" for="FNacimiento">Fecha nacimiento</label>
                    <input type="date" name="FNacimiento" required>
                </div>
            </div>

            <label class="label_blanco text_shadow">Estilo</label>
            <div class="select">
                <select name="estilos">
                    <?php
                    require("rellenarEstilos.php");

                    ?>
                </select>
            </div>
            <br><br>
            <div style="margin-bottom: 1em" class="row">
                <div style="float:left; padding: 0 4% 0 0%;" class="col-6">
                    <label>
                        <label class="label_blanco text_shadow">Ciudad</label>
                        <input type="text" required name="ciudad" placeholder="Alicante" style="width: 100%"></label>
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
            <br id="br_none">
            <label id="add-computer-button" for="fileupload" class="upload_file_btn">Sube tu foto
            </label>
            <input id="fileupload" required type="file" multiple="multiple" name="input_foto" accept="image/jpeg"
                   style="visibility: hidden">
            <button type="submit" style="cursor:pointer;">Registrarse</button>
        </form>
    </section>
</div>
</body>
</html>