<?php
    session_start();

    $pag_anterior = $_SERVER['HTTP_REFERER'];
    $host = $_SERVER['HTTP_HOST']; 
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $url = "http://$host$uri";

    // Cogemos los datos enviados por POST
    $tituloFoto = $_POST['titulo'];
    $descripcion = $_POST['desc'];
    $fecha = $_POST['fecha'];
    if ($fecha == "0000-00-00") {
        $fecha = null;
    }
    $pais = $_POST['pais'];
    if ($pais == ""  ||  $pais == "0") {
        $pais = null;
    }
    $foto = $_POST['foto'];
    $alt = $_POST['alt'];
    $album = $_POST['album'];

    // Comprobamos si faltan datos
    if ($tituloFoto != ""  &&  $descripcion != ""  &&  $foto != ""  &&  $alt != ""  &&  $album != "0") {
        $camposRellenos = true;
    }

    if (isset($_SESSION["logueado"])  &&  ($pag_anterior == ("$url/meteFotoAlbum.php")  ||  $pag_anterior == ("$url/meteFotoAlbum.php?fallo=1")  ||  $pag_anterior == ("$url/meteFotoAlbum.php?fallo=2")  ||  $pag_anterior == ("$url/meteFotoAlbum.php?album=$album"))  &&  $camposRellenos) {

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
                    
                    <?php

                        $fregistro = date("Y-m-d H:i:s");
                        $fichero = "Images/Fotos/$foto";

                        require("conexionBD.php");

                        // Averiguamos el id del pais escogido
                        if ($pais != null) {
                            $sentencia = "SELECT * FROM paises WHERE NomPais='$pais'";
                            $resultado = $conexion->query($sentencia);
                            $fila = $resultado->fetch_object();
                            $idPais = $fila->IdPais;
                        } else {
                            $idPais = null;
                        }

                        // Averiguamos el nombre del álbum escogido
                        $sentencia = "SELECT Titulo FROM albumes WHERE IdAlbum='$album'";
                        $resultado = $conexion->query($sentencia);
                        $fila = $resultado->fetch_object();
                        $nomAlbum = $fila->Titulo;

                        // Realizamos la inserción de la foto en la BD
                        $sentencia = "INSERT INTO fotos (`Titulo`, `Descripcion`, `Fecha`, `Pais`, `Album`, `Fichero`, `Alternativo`, `FRegistro`)
                        VALUES ('$tituloFoto', '$descripcion', '$fecha', '$idPais', '$album', '$fichero', '$alt', '$fregistro')";
                        if($conexion->query($sentencia)) {
                            echo "<h2>Has subido una foto:</h2>";
                        }

                        echo "<p>Título: $tituloFoto</p>";
                        echo "<p>Descripción: $descripcion</p>";
                        if ($fecha != null) {
                            echo "<p>Fecha: $fecha</p>";
                        } else {
                            echo "<p>Fecha: No consta</p>";
                        }
                        if ($pais != null) {
                            echo "<p>País: $pais</p>";
                        } else {
                            echo "<p>País: No consta</p>";
                        }
                        echo "<p>Álbum: $nomAlbum</p>";
                        echo "<p>Texto Alternativo: $alt</p>";
                        echo "<p>Fecha Registro: $fregistro</p>";

                        $resultado->close();
                        $conexion->close();
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