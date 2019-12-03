<?php
    session_start();

    if (isset($_SESSION["logueado"])) {

        $titulo = "Configuración - Pictures & Images";
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
                    
                    <?php

                        if (isset($_GET['fallo'])) {
                            if ($_GET['fallo'] == 1) {
                                echo "<h3 style='color:red; text-align:center;'>Debes seleccionar antes un estilo:</h3>";
                            } elseif ($_GET['fallo'] == 2) {
                                echo "<h3 style='color:red; text-align:center;'>Elige un estilo existente:</h3>";
                            }
                        }

                        require("conexionBD.php");
                        $sentencia = "SELECT * FROM estilos";

                        if (!($resultado = $conexion->query($sentencia))) {
                            echo '<p>Error al obtener los Estilos de la BD' .$conexion->error. '</p>';
                            exit;
                        }

                        if ($resultado->num_rows > 0) {
                            while ($fila = $resultado->fetch_object()) {
                                echo "<a href='resConfigurar.php?id=$fila->IdEstilo'>$fila->Nombre</a>";
                            }
                        }

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