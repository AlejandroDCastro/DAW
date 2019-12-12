<?php
    session_start();

    if (isset($_SESSION["logueado"])) {

        $titulo = "Crear Álbum - Pictures & Images";
        $estilo = $_SESSION["estilo"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");
?>

        <!-- CONTENIDO: Título contenido, Formulario -->
        <main>
            <section>
                <h1>Crear Álbum</h1>
                <?php
                    if (isset($_GET['fallo'])) {
                        if ($_GET['fallo'] == 1) {
                            echo "<p style='color:red; text-align:center; padding-bottom: 30px;'>Debes de crear un álbum previamente</p>";
                        } elseif ($_GET['fallo'] == 2) {
                            echo "<p style='color:red; text-align:center; padding-bottom: 30px;'>Introduce un título y una descripción</p>";
                        }
                    }
                ?>
                <form id="formulario" method="POST" action="resCrearAlbum.php">
                    <div>
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Introduce el título" class="formulario">
                    </div>
                    <div>
                        <label for="desc">Descripción:</label>
                        <input type="text" id="desc" name="desc" placeholder="Introduce la descripción" class="formulario">
                    </div>
                    <div>
                        <input type="submit" value="Enviar">
                    </div>
                </form>
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