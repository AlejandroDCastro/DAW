<?php
    session_start();

    if (isset($_SESSION["logueado"])) {

        $titulo = "Perfil - Pictures & Images";
        $estilo = $_SESSION["estilo"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");
?>

        <main>
            <section>
                <h1>Perfil de usuario</h1>
                <section class="printCentro">
                    
                    <?php

                        $nombre = $_SESSION["logueado"];
                        echo "<h2>¡Bienvenido $nombre!</h2>";

                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == 1) {
                                echo "<h3 style='color:red; text-align:center;'>Ya estás registrado como usuario de PI</h3>";
                            } elseif ($_GET["error"] == 2) {
                                echo "<h3 style='color:red; text-align:center;'>Selecciona la opción adecuada en tu menú</h3>";
                            }
                        }


                        echo
                        "<a href='misDatos.php?nombre=$nombre'>Mis datos</a>
                        <a href='darBaja.php'>Darme de baja</a>
                        <a href='misAlbumes.php'>Mis álbumes</a>
                        <a href='misFotos.php'>Mis Fotos</a>
                        <a href='crearAlbum.php'>Crear álbum</a>
                        <a href='meteFotoAlbum.php'>Subir foto a álbum</a>
                        <a href='solicitud.php'>Solicitar álbum</a>
                        <a href='configurar.php'>Configuración</a>
                        <a href='salir.php'>Salir</a>";
                    

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