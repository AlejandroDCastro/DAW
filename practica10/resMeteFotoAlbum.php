<?php
    session_start();

    $pag_anterior = $_SERVER['HTTP_REFERER'];
    $host = $_SERVER['HTTP_HOST']; 
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $url = "http://$host$uri";

    $tituloFoto = $_POST['titulo'];
    $descripcion = $_POST['desc'];
    $fecha = $_POST['fecha'];
    if ($fecha == "") {
        $fecha = null;
    }
    $pais = $_POST['pais'];
    if ($pais == "") {
        $pais = null;
    }
    $foto = $_POST['foto'];
    $alt = $_POST['alt'];
    $album = $_POST['album'];

    // Comprobamos si faltan datos
    if ($tituloFoto != ""  &&  $descripcion != ""  &&  $foto != ""  &&  $alt != ""  &&  $album != "0") {
        $camposRellenos = true;
    }

    if (isset($_SESSION["logueado"])  &&  ($pag_anterior == ("$url/meteFotoAlbum.php")  ||  $pag_anterior == ("$url/meteFotoAlbum.php?fallo=1")  ||  $pag_anterior == ("$url/meteFotoAlbum.php?fallo=2"))  &&  $camposRellenos) {

        $titulo = "Subir Foto - Pictures & Images";
        $estilo = $_SESSION["estilo"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");
?>

        <main>
            <section>
                <h1>Subir Foto</h1>
                <section class="printCentro">
                    <h2>Foto Subida</h2>
                    
                    <?php

                        require("conexionBD.php");
                        $sentencia = "INSERT INTO fotos (`Titulo`, `Descripcion`, `Fecha`, `Pais`, `Album`, `Fichero`, `Alternativo`, `FRegistro`)
                                        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
                        $mysqli = $conexion->prepare($sentencia);
                        $mysqli->bind_param('ss', $tituloFoto, $descripcion);
                        if (!$mysqli->execute()) {
                            echo '<p>Error al actualizar el estilo en la BD' .$conexion->error. '</p>';
                            exit;
                        }

                        echo "<h3>Has creado un álbum: $tituloFoto</h3>";
                        echo "<h4>Introduce tu primera fotografía en este álbum. Pulsa <a href='meteFotoAlbum.php'>aquí</a></h4>";


                    ?>

                    <a href="perfil.php" style="margin-top: 60px;">Aceptar</a>

                </section>
            </section>
        </main>

<?php
        require_once("footer.php");

    } else {
        if ($pag_anterior != ("$url/meteFotoAlbum.php")  &&  $pag_anterior != ("$url/meteFotoAlbum.php?fallo=1")  &&  $pag_anterior != ("$url/meteFotoAlbum.php?fallo=2")) {
            $extra = 'meteFotoAlbum.php?fallo=1'; 
        } else {
            $extra = 'meteFotoAlbum.php?fallo=2';
        }
        if (!isset($_SESSION["logueado"])) {
            $extra = 'index.php?fallo=2';
        }
        header("Location: http://$host$uri/$extra");
    }
?>