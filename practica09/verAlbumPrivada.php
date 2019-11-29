<?php

    session_start();

    if (isset($_SESSION["logueado"])) {

        $titulo = "Ver Álbum - Pictures & Images";
        $estilo = $_SESSION["estilo"];
        $usu = $_SESSION["logueado"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");

?>

        <main>
            <section>
                <h1>Ver Álbum</h1>
                <section class="printCentro">
                    
                    <?php

                        $id_album = $_GET['id'];
                        //Comprobamos que existe un id en la url.
                        if($id_album == "")
                        {
                                $host = $_SERVER['HTTP_HOST']; 
                                $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
                                $extra = 'index.php?fallo=2'; 
                                header("Location: http://$host$uri/$extra");
                        }

                        include("conexionBD.php");

                        // Titulo y Descripcion del álbum
                        $sentencia = "SELECT * FROM albumes WHERE IdAlbum=$id_album";
                        $resultado = $conexion->query($sentencia);
                        $fila = $resultado->fetch_object();
                        echo "<p style='text-align:center;'><u>Titulo</u>: $fila->Titulo</p>";
                        echo "<p style='text-align:center;'><u>Descripción</u>: $fila->Descripcion</p>";

                        // Paises de álbum
                        $sentencia = "SELECT DISTINCT p.NomPais fROM paises p
                                    JOIN fotos f ON f.Pais=p.IdPais
                                    JOIN albumes a ON a.IdAlbum=f.Album
                                    WHERE a.IdAlbum=$id_album AND f.Pais IS NOT NULL";
                        $resultado = $conexion->query($sentencia);
                        echo "<p style='text-align:center; padding: 0;'><u>Países</u>: - ";
                        while ($fila = $resultado->fetch_object()) {
                            echo "$fila->NomPais - ";
                        }
                        echo "</p>";
                        
                        // Fechas del álbum
                        $sentencia = "SELECT min(Fecha) as minFecha, max(Fecha) as maxFecha FROM fotos WHERE Album=$id_album";
                        $resultado = $conexion->query($sentencia);
                        $fila = $resultado->fetch_object();
                        echo "<p style='text-align:center;'><u>Desde</u>: $fila->minFecha <u>Hasta</u>: $fila->maxFecha</p>";

                        // Fotos del álbum
                        $sentencia = "SELECT f.IdFoto, f.Titulo, f.Fichero, f.Alternativo, a.IdAlbum
                        FROM fotos f JOIN albumes a ON a.IdAlbum=f.Album
                        JOIN usuarios u ON u.IdUsuario=a.Usuario
                        WHERE a.IdAlbum=$id_album";
                        $resultado = $conexion->query($sentencia);
                        echo "<div class='seccionfoto' style='padding-top: 30px'>";
                        while ($fila = $resultado->fetch_object()) {
                            echo "<article>
                                    <a href='detalle.php?id=$fila->IdFoto'>
                                        <img width='400' src='$fila->Fichero' alt='$fila->Alternativo'>
                                    </a>
                                    <h3><a href='detalle.php?id=$fila->IdFoto'>$fila->Titulo</a></h3>
                                </article>";
                        }

                        echo "<div>";


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