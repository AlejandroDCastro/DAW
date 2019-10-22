<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear álbum | myAlbum</title>
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

<div id="background-crearAlbum" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <h2 class="white text_shadow">Crear álbum</h2>
        <form action="resCrearAlbum.php" method="post">

            <label class="label_blanco text_shadow" for="usuario">Título</label>
            <input type="text" placeholder="Puesta de sol" required name="titulo">
            <br><br>

            <label class="label_blanco text_shadow" for="usuario">Descripción</label>
            <textarea rows="4" cols="80" name="descripcion">Escribe tu información extra</textarea>
            <br><br>

            <br id="br_none">
            <button type="submit" style="cursor:pointer;">Crear</button>


        </form>
    </section>
</div>
</body>
</html>