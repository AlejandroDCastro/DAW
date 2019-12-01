<?php
    session_start();

    if (isset($_SESSION["logueado"])) {

        $titulo = "Mis Fotos - Pictures & Images";
        $estilo = $_SESSION["estilo"];
        $usu = $_SESSION["logueado"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");
?>

        <main>
            <section>
                <h1>Mis Fotos</h1>
                <section class="seccionfoto" id="misFotos">
                    
                    <?php

                        include("conexionBD.php");
                        $sentencia = "SELECT f.IdFoto, f.Titulo, f.Fichero, f.Alternativo, a.IdAlbum, a.Titulo AS TAlbum
                        FROM fotos f JOIN albumes a ON a.IdAlbum=f.Album
                        JOIN usuarios u ON u.IdUsuario=a.Usuario
                        WHERE u.NomUsuario='$usu'";
                        if (!($resultado = $conexion->query($sentencia))) {
                            echo '<p>Error al obtener lista de Fotos de la BD: ' .$conexion->error. '</p>';
                            exit;
                        }
                        if ($resultado->num_rows) {
                            while ($fila = $resultado->fetch_object()) {
                                echo "<article>
                                    <a href='detalle.php?id=$fila->IdFoto'>
                                        <img width='400' src='$fila->Fichero' alt='$fila->Alternativo'>
                                    </a>
                                    <h3><a href='detalle.php?id=$fila->IdFoto'>$fila->Titulo</a></h3>
                                    <p>Álbum: <a href='verAlbum.php?id=$fila->IdAlbum'>$fila->TAlbum</a></p>
                                </article>";
                            }
                        } else {
                            echo "<p>No tienes ninguna foto todavía.</p>";
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