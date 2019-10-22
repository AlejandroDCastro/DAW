<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú usuario | myAlbum</title>
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

<section>
    <div class="split-menu izq-menu">

    </div>
    <div id="background-menu" class="split-menu dcha-menu">
        <div class="margin_menu">
            <h2 style="text-align: left" class="white text_shadow">
                <?php
                    if(isset($_GET['usuario'])){
                        echo $_GET['usuario'];
                    }
                  ?>
                    
                </h2>

            <div style="line-height: 1.4em;">
                <a href="">Modificar datos</a><br>
                <a href="">Darse de baja</a><br>
                <a href="">Visualizar albumes</a><br>
                <a href="crearAlbum.php" href="">Crear nuevo album</a><br>
                <a href="solicitarAlbum.php">Solicitar album impreso</a>
            </div>
        </div>
    </div>
</section>
</body>
</html>