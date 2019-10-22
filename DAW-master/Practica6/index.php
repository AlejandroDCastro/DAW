<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | myAlbum</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print"/>
    <link rel="alternate stylesheet" type="text/css" href="css/altoContraste.css" title="Alto contraste">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
</head>
<body>
<?php 
    include('headerSinLogear.php');
?>

<?php 

    if(isset($_GET["error"])==true){
        echo "<h1 style='color:red; text-align:center;'>Error en el login</h1>";
    }

 ?>
<?php 
    include('loginIndex.php');
 ?>

<section class="col-11 margin_auto">

    <h2 class="white">Últimas fotos</h2>

    <div class="imageGrid">

        <a href="foto.php">
            <div class="foto" style="background-image: url('img/i1.jpeg');">
                <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                    <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum
                        hac lacus magna in lobortis maecenas
                    </div>
                </div>
            </div>
        </a>

        <a href="foto.php">
            <div class="foto" style="background-image: url('img/i2.jpeg');">
                <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                    <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum
                        hac lacus magna in lobortis maecenas
                    </div>
                </div>
            </div>
        </a>

        <a href="foto.php">
            <div class="foto" style="background-image: url('img/i3.jpeg');">
                <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                    <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum
                        hac lacus magna in lobortis maecenas
                    </div>
                </div>
            </div>
        </a>

        <a href="foto.php">
            <div class="foto" style="background-image: url('img/i4.jpeg');">
                <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                    <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum
                        hac lacus magna in lobortis maecenas
                    </div>
                </div>
            </div>
        </a>

        <a href="foto.php">
            <div class="foto" style="background-image: url('img/i5.jpeg');">
                <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                    <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum
                        hac lacus magna in lobortis maecenas
                    </div>
                </div>
            </div>
        </a>

        <a href="foto.php">
            <div class="foto" style="background-image: url('img/i6.jpeg');">
                <div class="titulo_foto"><h2>Lorem ipsum dolor sit amet consectetur</h2>
                    <div class="info_foto">Per metus laoreet velit hendrerit malesuada non sollicitudin, interdum rutrum
                        hac lacus magna in lobortis maecenas
                    </div>
                </div>
            </div>
        </a>

    </div>
</section>
<footer class="footer"></footer>

</body>
</html>