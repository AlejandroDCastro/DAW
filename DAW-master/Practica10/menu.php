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
    <?php
    require("conexionBD.php");
    $id = mysqli_real_escape_string($conexion, $_SESSION['sesion']['IdUsuario']);
    $sql = "SELECT Foto FROM USUARIOS WHERE IdUsuario='$id'";
    $resultados = $conexion->query($sql);
    $rest_fetch = $resultados->fetch_assoc();

    $url = 'url("img/' . $rest_fetch['Foto'] . '")';

    echo "<div style='background-image: $url;' class='split-menu izq-menu'>";


    ?>
    </div>
    <div id="background-menu" class="split-menu dcha-menu">
        <div style="float: right; margin-right: 2%" class="col-4">
            <form action="actualizarEstilo.php" method="POST">
                <label style="font-size: 0.8em" class="label_blanco text_shadow">Configura tu estilo</label>
                <div class="select sel_estilos">
                <select class="sel_estilos" name="estilos">
                <?php
                    require("rellenarEstilosUsuario.php")
                ?>
                </select>
                
            </div>
                <button id="update_estilo" type="submit" style="cursor:pointer;">Actualizar estilo</button>
            </form>
            
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
                <a class="link" href="misDatos.php">Mis datos</a><br>
                <a class="link" href="misAlbumes.php">Visualizar albumes</a><br>
                <a class="link" href="crearAlbum.php" href="">Crear nuevo álbum</a><br>
                <a class="link" href="solicitarAlbum.php">Solicitar álbum impreso</a><br>
                <a class="link" href="añadirFoto.php">Añadir foto a álbum</a><br>
                <form action="comprobar_baja.php">
                    <button id="delete_me" type="submit" style="cursor:pointer;">Darse de baja</button>
                </form>
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