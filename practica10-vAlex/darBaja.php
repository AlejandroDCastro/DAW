<?php
    session_start();

    if (isset($_SESSION["logueado"])) {

        $titulo = "Darse de Baja - Pictures & Images";
        $estilo = $_SESSION["estilo"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");
?>

        <main>
            <section>
                <h1>Darse de Baja</h1>
                <section class="printCentro">
                    <h2>Resumen de tu información en P&I</h2>
                    
                    <?php

                        $idUsu = $_SESSION['id'];
                        $numFotos = 0;

                        require("conexionBD.php");

                        $sentencia = "SELECT a.Titulo, COUNT(f.IdFoto) AS FAlbum FROM albumes a JOIN usuarios u ON u.IdUsuario=a.Usuario LEFT JOIN fotos f ON f.Album=a.IdAlbum WHERE u.IdUsuario=? GROUP BY a.Titulo";
                        $mysqli = $conexion->prepare($sentencia);
                        $mysqli->bind_param('i', $idUsu);
                        if (!$mysqli->execute()) {
                            echo '<p>Error al actualizar el estilo en la BD' .$conexion->error. '</p>';
                            exit;
                        }
                        $resultado = $mysqli->get_result();

                        // Mostramos los álbumes con su cantidad de fotos
                        echo "<h3>Tus álbumes:</h3>";
                        if ($resultado->num_rows) {
                            while ($fila = $resultado->fetch_object()) {
                                echo "<p><b>$fila->Titulo</b>: $fila->FAlbum fotos</p>";
                                $numFotos += $fila->FAlbum;
                            }
                        }

                        // Y la cantidad de fotos del usuario
                        echo "<h3 style='margin-top: 35px;'>Tus fotos:</h3>";
                        echo "<p>Nº de fotos: $numFotos</p>";


                        $resultado->close();
                        $conexion->close();

                    ?>

                </section>
                <section class="printCentro">
                    <h2>Confirmación para eleminar tu cuenta</h2>
                        <form id="formulario" action="eliminarUsuario.php" method="POST">

                            <?php

                                if (isset($_GET['error'])) {
                                    if ($_GET['error'] == 1) {
                                        echo "<h3 style='color:red; text-align:center; padding-top:15px;'>Primero debes confirmar tu contraseña.</h3>";
                                    } elseif ($_GET['error'] == 2) {
                                        echo "<h3 style='color:red; text-align:center; padding-top:15px;'>Contraseña incorrecta. Inténtalo otra vez.</h3>";
                                    }
                                }

                            ?>

                            <div>
                                <label for="pass">Confirmar contraseña:</label>
                                <input type="password" id="pass" name="pass" placeholder="Introduce tu contraseña" required class="formulario">
                            </div>
                            <div>
                                <input type="submit" value="Borrar Cuenta">
                            </div>
                        </form>

                </section>
            </section>
        </main>

<?php
        require_once("footer.php");

    } else {
        $host = $_SERVER['HTTP_HOST']; 
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'index.php?fallo=2';
        header("Location: http://$host$uri/$extra");
    }
?>