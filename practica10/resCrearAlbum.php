<?php
    session_start();

    $pag_anterior = $_SERVER['HTTP_REFERER'];
    $host = $_SERVER['HTTP_HOST']; 
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $url = "http://$host$uri";

    $tituloAlbum = $_POST['titulo'];
    $descripcion = $_POST['desc'];

    if (isset($_SESSION["logueado"])  &&  ($pag_anterior == ("$url/crearAlbum.php")  ||  $pag_anterior == ("$url/crearAlbum.php?fallo=1")  ||  $pag_anterior == ("$url/crearAlbum.php?fallo=2"))  &&  ($tituloAlbum != ""  &&  $descripcion != "")) {

        $titulo = "Crear Álbum - Pictures & Images";
        $estilo = $_SESSION["estilo"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");
?>

        <main>
            <section>
                <h1>Crear Álbum</h1>
                <section class="printCentro">
                    
                    <?php

                        $usuario = $_SESSION['id'];

                        require("conexionBD.php");
                        $sentencia = "INSERT INTO albumes (`Titulo`, `Descripcion`, `Usuario`)
                                        VALUES (?, ?, $usuario)";
                        $mysqli = $conexion->prepare($sentencia);
                        $mysqli->bind_param('ss', $tituloAlbum, $descripcion);
                        if (!$mysqli->execute()) {
                            echo '<p>Error al actualizar el estilo en la BD' .$conexion->error. '</p>';
                            exit;
                        }

                        echo "<h2>Has creado un álbum:</h2>";
                        echo "<p><b>Título</b>: $tituloAlbum</p>";
                        echo "<p><b>Descripción</b>: $descripcion</p>";
                        echo "<h4 style='margin-top: 15px;'>Introduce tu primera fotografía en este álbum. Pulsa <a href='meteFotoAlbum.php'>aquí</a></h4>";

                        $conexion->close();

                    ?>

                    <a href="perfil.php" style="margin-top: 60px;">Aceptar</a>

                </section>
            </section>
        </main>

<?php
        require_once("footer.php");

    } else {
        if ($pag_anterior != ("$url/crearAlbum.php")  &&  $pag_anterior != ("$url/crearAlbum.php?fallo=1")  &&  $pag_anterior != ("$url/crearAlbum.php?fallo=2")) {
            $extra = 'crearAlbum.php?fallo=1'; 
        } else {
            $extra = 'crearAlbum.php?fallo=2';
        }
        if (!isset($_SESSION["logueado"])) {
            $extra = 'index.php?fallo=2';
        }
        header("Location: http://$host$uri/$extra");
    }
?>