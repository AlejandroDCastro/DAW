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
                <h1>Configuración</h1>
                <section class="printCentro">
                    <h2>Elige un estilo</h2>
                    

                    <a href="">Estilo estándar</a>
                    <a href="">Letra grande</a>
                    <a href="">Alto contraste</a>
                    <a href="">Alto contraste y letra grande</a>
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