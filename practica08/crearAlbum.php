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
                <form id="formulario" method="POST" action="perfil.php">
                    <div>
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" placeholder="Introduce el título" class="formulario">
                    </div>
                    <div>
                        <label for="desc">Descripción:</label>
                        <input type="text" id="desc" placeholder="Introduce la descripción" class="formulario">
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