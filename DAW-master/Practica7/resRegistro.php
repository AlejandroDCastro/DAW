<!DOCTYPE html>
<html lang="es">
<head>

    <title>Respuesta de registro | myAlbum</title>
    <?php
    session_start();
    if (!isset($_SESSION['sesion'])) {
        header('Location:' . 'index.php');
    } else {


        if ($_SESSION['sesion']['Estilo'] == "style") {
            include('head.php');
        } else if ($_SESSION['sesion']['Estilo'] == "Alto contraste") {
            include('headAltoContraste.php');
        }
    }
    ?>
</head>
<body>
<?php
include('header.php');
?>

<div id="background-resRegistro" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <br><br>
        <h2 class="white text_shadow">Registro completado</h2>
        <br><br>

        <?php
        $usuario = $_POST['usuario'];
        $pass = $_POST['password'];
        $pass_repeat = $_POST['password_repeat'];
        $email = $_POST['email'];

        if ($pass !== $pass_repeat) {
            header('Location: registro.php?error=true');
        }
        echo "<p style='color:white;'>Usuario: " . $usuario . "</p>";
        echo "<p style='color:white;'>Password: " . $pass . "</p>";
        echo "<p style='color:white;'>Email: " . $email . "</p>";

        ?>
    </section>
</div>

</body>
</html>