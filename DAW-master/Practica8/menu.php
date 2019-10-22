<!DOCTYPE html>
<html lang="es">
<head>

    <title>Menú usuario | myAlbum</title>
    <?php
    include("eleccionEstilo.php");
    ?>
</head>
<body>
<?php
include('header.php');
?>

<section>
    <div class="split-menu izq-menu">

    </div>
    <div id="background-menu" class="split-menu dcha-menu">
        <div style="float: right; margin-right: 2%" class="col-4">
            <label style="font-size: 0.8em" class="label_blanco text_shadow">Configura tu estilo</label>
            <div class="select sel_estilos">
                <select class="sel_estilos" name="estilos">
                    <?php
                    require("rellenarEstilos.php");

                    ?>
                </select>
            </div>
        </div>
        <div class="margin_menu">
            <h2 style="text-align: left" class="white text_shadow">
                <?php

                if (isset($_SESSION['sesion'])) {
                    echo $_SESSION['sesion']['usuario'];
                }
                ?>

            </h2>


            <div style="line-height: 1.4em;">
                <a class="link" href="misDatos.php">Modificar mis datos</a><br>
                <a class="link" href="">Darse de baja</a><br>
                <a class="link" href="misAlbumes.php">Visualizar albumes</a><br>
                <a class="link" href="crearAlbum.php" href="">Crear nuevo álbum</a><br>
                <a class="link" href="solicitarAlbum.php">Solicitar álbum impreso</a><br>
                <a class="link" href="añadirFoto.php">Añadir foto a álbum</a><br>
                <p class="white text_shadow" style="font-size: .7em;"> Última conexión:
                    <?php

                    if (isset($_SESSION['sesion'])) {

                        if (isset($_COOKIE['tiempo'])) {
                            $cookie = json_decode($_COOKIE['tiempo'], true);
                            echo $cookie['mday'] . " de " . $cookie['month'] . " de " . $cookie['year'] . " a las " . $cookie['hours'] . ":" . $cookie['minutes'];
                            $date = json_encode(getdate());
                            setcookie('tiempo', $date, time() + 86400 * 90);

                        } else {
                            echo "Nunca";
                            $date = json_encode(getdate());
                            setcookie('tiempo', $date, time() + 86400 * 90);

                        }


                    }
                    ?>
                </p>

            </div>
        </div>
</section>
</body>
</html>