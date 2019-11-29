<?php
    session_start();

    if (isset($_SESSION["logueado"])) {

        $titulo = "Mis Álbumes - Pictures & Images";
        $estilo = $_SESSION["estilo"];
        $usu = $_SESSION["logueado"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");
?>

        <main>
            <section>
                <h1>Mis Álbumes</h1>
                <section class="printCentro" id="misAlbumes">
                    
                    <?php

                        include("conexionBD.php");
                        $sentencia = "SELECT a.Titulo, a.Descripcion
                            FROM albumes a JOIN usuarios u ON u.IdUsuario=a.Usuario
                            WHERE u.NomUsuario='$usu'";
                        if (!($resultado = $conexion->query($sentencia))) {
                            echo '<p>Error al obtener lista de Albumes de la BD: ' .$conexion->error. '</p>';
                            exit;
                        }
                        if ($resultado->num_rows) {
                            while ($fila = $resultado->fetch_object()) {
                                echo "<p style='font-size: 1.5em;'><a href=''>$fila->Titulo</a> - $fila->Descripcion</p>";
                            }
                        } else {
                            echo "<p>No tienes ningún álbum todavía. <a href='crearAlbum.php'>Crea</a> uno nuevo justo ahora.</p>";
                        }

                        // Cerramos conexiones
                        $resultado->close();
                        $conexion->close();

                    ?>

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