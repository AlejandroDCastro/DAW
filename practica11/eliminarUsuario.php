<?php
    session_start();

    $pag_anterior = $_SERVER['HTTP_REFERER'];
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $url = "http://$host$uri";

    $pass = $_POST['pass'];

    if ($pag_anterior == ("$url/darBaja.php")  ||  $pag_anterior == ("$url/darBaja.php?error=1")  ||  $pag_anterior == ("$url/darBaja.php?error=2")  ||  $pag_anterior == ("$url/darBaja.php?error=1#formulario")  ||  $pag_anterior == ("$url/darBaja.php?error=2#formulario")) {
        $origenCorrecto = true;
    } else {
        $origenCorrecto = false;
    }

    //Comprobamos que la pass introducida y la de la base de datos coinciden.
    require("conexionBD.php");

    $idUsu = $_SESSION['id'];
    $hasheada = "";
    $sentenciaPass = "SELECT Clave FROM usuarios WHERE IdUsuario=?";
    $mysqli = $conexion->prepare($sentenciaPass);
    $mysqli->bind_param('i', $idUsu);
    if (!$mysqli->execute()) {
        echo '<p>Error al buscar el password en la BD' .$conexion->error. '</p>';
        exit;
    }
    $passBD = $mysqli->get_result();
    if ($passBD->num_rows) {
        $hasheada = $passBD->fetch_object();
    }

    $passBD->close();
    $conexion->close();


    if (isset($_SESSION["logueado"])  &&  $origenCorrecto  &&  password_verify($pass, $hasheada->Clave)) {

        $titulo = "Dar de baja - Pictures & Images";
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

                        $idUsu = $_SESSION['id'];

                        require("conexionBD.php");

                        // Guardamos los albumes que tiene el usuario
                        $sentencia = "SELECT IdAlbum FROM albumes WHERE Usuario=?";
                        $mysqli = $conexion->prepare($sentencia);
                        $mysqli->bind_param('i', $idUsu);
                        if (!$mysqli->execute()) {
                            echo '<p>Error al actualizar el estilo en la BD' .$conexion->error. '</p>';
                            exit;
                        }
                        $albumes = $mysqli->get_result();
                        if ($albumes->num_rows) {
                            while ($fila = $albumes->fetch_object()) {

                                // Borramos las FOTOS incluidas en cada album
                                $sql = "DELETE FROM fotos WHERE Album=$fila->IdAlbum";
                                $conexion->query($sql);

                                // Borramos las SOLICITUDES asociadas a cada album
                                $sql = "DELETE FROM solicitudes WHERE Album=$fila->IdAlbum";
                                $conexion->query($sql);

                            }
                        }

                        // Borramos los datos de la tabla ALBUMES
                        $sentencia = "DELETE FROM albumes WHERE Usuario=?";
                        $mysqli = $conexion->prepare($sentencia);
                        $mysqli->bind_param('i', $idUsu);
                        if (!$mysqli->execute()) {
                            echo '<p>Error al actualizar el estilo en la BD' .$conexion->error. '</p>';
                            exit;
                        }

                        // Borramos los datos de la tabla USUARIOS
                        $sentencia = "DELETE FROM usuarios WHERE IdUsuario=?";
                        $mysqli = $conexion->prepare($sentencia);
                        $mysqli->bind_param('i', $idUsu);
                        if (!$mysqli->execute()) {
                            echo '<p>Error al actualizar el estilo en la BD' .$conexion->error. '</p>';
                            exit;
                        }

                        $albumes->close();
                        $conexion->close();

                    ?>

                    <h2>Has eliminado tu cuenta de PI con éxito</h2>
                    <h3>Nos ha encantado tenerte con nosotros. ¡Esperamos volver a verte!</h3>
                    <a href="salir.php" style="margin-top: 60px;">Salir</a>

                </section>
            </section>
        </main>

<?php
        require_once("footer.php");

    } else {
        if (!$origenCorrecto) {
            $extra = 'darBaja.php?error=1#formulario'; 
        } else {
            $extra = 'darBaja.php?error=2#formulario';
        }
        if (!isset($_SESSION["logueado"])) {
            $extra = 'index.php?fallo=2';
        }
        header("Location: http://$host$uri/$extra");
    }
?>