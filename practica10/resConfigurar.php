<?php
    session_start();

    $pag_anterior = $_SERVER['HTTP_REFERER'];
    $host = $_SERVER['HTTP_HOST']; 
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $url = "http://$host$uri";

    if (isset($_SESSION["logueado"])  &&  ($pag_anterior == ("$url/configurar.php")  ||  $pag_anterior == ("$url/configurar.php?fallo=1"))) {

        $estilo_seleccionado = $_GET['id'];
        $usuario = $_SESSION["logueado"];

        require("conexionBD.php");

        // Comprabamos si el estilo existe
        $sentencia = "SELECT * FROM estilos";
        $resultado = $conexion->query($sentencia);
        if ($resultado->num_rows < $estilo_seleccionado  ||  $estilo_seleccionado <= 0) {
            $extra = 'configurar.php?fallo=2';
            header("Location: http://$host$uri/$extra");
        }
        while ($fila = $resultado->fetch_object()) {
            if ($fila->IdEstilo == $estilo_seleccionado) {
                $nom_estilo = $fila->Nombre;
                $fichero = $fila->Fichero;
                break;
            }
        }

        // Actualizamos con el estilo seleccionado
        $sentencia = "UPDATE usuarios SET Estilo=? WHERE NomUsuario='$usuario'";
        $mysqli = $conexion->prepare($sentencia);
        $mysqli->bind_param('i', $estilo_seleccionado);
        if (!$mysqli->execute()) {
            echo '<p>Error al actualizar el estilo en la BD' .$conexion->connect_error. '</p>';
            exit;
        }

        

        $titulo = "Configuración - Pictures & Images";
        $_SESSION["estilo"] = $fichero;
        $estilo = $fichero;

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");
?>

        <main>
            <section>
                <h1>Configuración</h1>
                <section class="printCentro">
                    <h2>Estilo Seleccionado</h2>
                    <h3>Has seleccionado el estilo: <?php echo "$nom_estilo" ?></h3>
                    <p>Si quieres volver a cambiar el estilo, pulsa <a href="configurar.php">aquí</a>.</p>
                    <a href="perfil.php" style="margin-top: 60px;">Aceptar</a>
                </section>
            </section>
        </main>

<?php
        $resultado->close();
        $conexion->close();
        
        require_once("footer.php");

    } else {

        if (!isset($_SESSION["logueado"])) {
            $extra = 'index.php?fallo=2'; 
        } else {
            $extra = 'configurar.php?fallo=1';
        }
        header("Location: http://$host$uri/$extra");
    }
?>