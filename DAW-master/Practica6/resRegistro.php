<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta de registro | myAlbum</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print"/>
    <link rel="alternate stylesheet" type="text/css" href="css/altoContraste.css" title="Alto contraste">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
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

        if($pass !== $pass_repeat){
            header('Location: registro.php?error=true');
        }
        echo "<p style='color:white;'>Usuario: ".$usuario."</p>";
        echo "<p style='color:white;'>Password: ".$pass."</p>";
        echo "<p style='color:white;'>Email: ".$email."</p>";

        ?>
    </section>
</div>

</body>
</html>