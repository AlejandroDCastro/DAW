<?php
if (isset($_COOKIE['sesion'])) {
    header('Location:' . 'index.php');
}
?>


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
    <section class="col-4 margin_auto padding20">
        <h2 class="text_shadow" style="color:red;">
            <?php
            if (isset($_GET['error'])) {
                echo "Error en el registro";
            }
            ?>
        </h2>
        <h2 class="white text_shadow">Registro de usuario</h2>
        <form action="resRegistro.php" method="post">

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


            <label class="label_blanco text_shadow" for="pass">Correo electrónico</label>
            <input type="email" name="email" placeholder="usuario1@myalbum.com" required>
            <br><br>

            <div class="row">
                <div style="float:left; padding: 0 4% 0 0%;" class="col-6">
                    <label>
                        <label class="label_blanco text_shadow">Ciudad</label>
                        <input type="text" placeholder="Alicante" style="width: 100%"></label>
                </div>
                <div style="float:left;" class="col-6">
                    <br id="br_none">
                    <label class="label_blanco text_shadow">País</label>
                    <select>
                        <option value="pais1">País 1</option>
                        <option value="pais2">País 2</option>
                        <option value="pais3">País 3</option>
                        <option value="pais4">País 4</option>
                    </select>
                </div>
            </div>
            <br id="br_none">
            <button type="submit" style="cursor:pointer;">Registrarse</button>


        </form>
    </section>
</div>
</body>
</html>