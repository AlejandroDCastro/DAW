<?php
    session_start();

    $pag_anterior = $_SERVER['HTTP_REFERER'];
    $host = $_SERVER['HTTP_HOST']; 
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $url = "http://$host$uri";

    $nombre = $_POST['nombre'];
    $tituloAlbum = $_POST['titulo'];
    $texto = $_POST['texto'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $numero = $_POST['num'];
    $cp = $_POST['cp'];
    $localidad = $_POST['localidad'];
    $provincia = $_POST['provincia'];
    $pais = $_POST['country'];
    $color = $_POST['color'];
    $copias = $_POST['copias'];
    $resolucion = $_POST['resolucion'];
    $idAlbum = $_POST['album'];
    $fecha = $_POST['fecha'];

    if ($nombre != ""  &&  $tituloAlbum != ""  &&  $texto != ""  &&  $email != ""  &&  $direccion != ""  &&  $numero != ""  &&  $cp != ""  &&  $localidad != ""  &&  $provincia != ""  &&  $pais != ""  &&  $idAlbum != "0"  &&  $fecha != "0000-00-00") {
        $camposRellenos = true;
    } else {
        $camposRellenos = false;
    }

    if (isset($_SESSION["logueado"])  &&  ($pag_anterior == ("$url/solicitud.php")  ||  $pag_anterior == ("$url/solicitud.php?error=1")  ||  $pag_anterior == ("$url/solicitud.php?error=2"))  &&  $camposRellenos) {

        $titulo = "Confirmar solicitud - Pictures & Images";
        $estilo = $_SESSION["estilo"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");
?>

        <main>
            <section>
                <h1>Confirmación de solicitud</h1>
                <section class="printCentro">
                    <?php

                        require("conexionBD.php");

                        // Obtenemos la cantidad de fotos que tiene el álbum
                        $sentencia = "SELECT f.IdFoto FROM fotos f JOIN albumes a ON f.Album=a.IdAlbum WHERE a.IdAlbum=?";
                        $mysqli = $conexion->prepare($sentencia);
                        $mysqli->bind_param('i', $idAlbum);
                        if (!$mysqli->execute()) {
                            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
                            echo '</p>'; 
                            exit;
                        }
                        $resultado = $mysqli->get_result();
                        $numero_fotos_ = $resultado->num_rows;


                        // Determinamos el precio de la solicitud
                        $numero_paginas_ = ceil($numero_fotos_/3);
                        $precio_pagina_;
                        $precio_;

                        if ($numero_paginas_ >= 5  &&  $numero_paginas_ <= 11) {
                            $precio_pagina_ = 0.08;
                        } elseif ($numero_paginas_ > 11) {
                            $precio_pagina_ = 0.07;
                        } else {
                            $precio_pagina_ = 0.10;
                        }
                        $precio_ = $precio_pagina_*$numero_paginas_;

                        if (isset($_POST["impresion"])  &&  $_POST["impresion"] == "1") {
                            $precio_ += 0.05*$numero_fotos_;
                            $impresion = true;
                        } else {
                            $impresion = false;
                        }

                        if ($resolucion == "450"  ||  $resolucion == "600"  ||  $resolucion == "750"  ||  $resolucion == "900") {
                            $precio_ += 0.02*$numero_fotos_;
                        }
                        $precio_ *= $copias;


                        // Obtenemos los demás campos del formularios
                        $fregistro = date("Y-m-d H:i:s");

                        $piso = $_POST['piso'];
                        $puerta = $_POST['puerta'];
                        $direccion .= ", Nº $numero,  ";
                        if ($_POST['piso'] != "") {
                            $direccion .= "Piso $piso, ";
                        }
                        if ($_POST['puerta'] != "") {
                            $direccion .= "Piso $puerta, ";
                        }
                        $direccion .= "CP $cp, $localidad, $provincia, $pais";


                        // Insertamos la solicitud en la base de datos
                     /*   $sentencia = "INSERT INTO solicitudes (`Album`, `Nombre`, `Titulo`, `Descripcion`, `Email`, `Direccion`, `Color`, `Copias`, `Resolucion`, `Fecha`, `IColor`, `FRegistro`, `Coste`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $mysqli = $conexion->prepare($sentencia);
                        $mysqli->bind_param('issssssiisisd', $idAlbum, $nombre, $tituloAlbum, $texto, $email, $direccion, $color, $copias, $resolucion, $fecha, $impresion, $fregistro, $precio);
                        if ($mysqli->execute()) {
                            echo "<h2>Se registrado correctamente la solicitud de tu álbum.</h2>";
                        } else {
                            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
                            echo '</p>'; 
                            exit;
                        }*/

         /*               $sentencia = "INSERT INTO solicitudes (`Album`, `Nombre`, `Titulo`, `Descripcion`, `Email`, `Direccion`, `Color`, `Copias`, `Resolucion`, `Fecha`, `IColor`, `FRegistro`, `Coste`) VALUES ($idAlbum, $nombre, $tituloAlbum, $texto, $email, $direccion, $color, $copias, $resolucion, $fecha, $impresion, $fregistro, $precio)";
                        if(!$conexion->query($sentencia)) {
                            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
                            echo '</p>'; 
                            exit;
                        } else {
                            echo "<h2>Se registrado correctamente la solicitud de tu álbum.</h2>";
                        }
*/

                        echo '<h3>Coste total del álbum: ', $precio_, '€</h3>';
                        echo '<ul>';
                        echo '<li><b>Nombre</b>: ', $nombre, '</li>';
                        echo '<li><b>Título del álbum</b>: ', $tituloAlbum, '</li>';
                        echo '<li><b>Texto adicional</b>: ', $texto, '</li>';
                        echo '<li><b>Correo electrónico</b>: ', $email, '</li>';
                        echo '<li><b>Dirección</b>: ', $direccion, '</li>';
                        echo '<li><b>Color de portada</b>: ', $color, '</li>';
                        echo '<li><b>Número de copias</b>: ', $copias, '</li>';
                        echo '<li><b>Resolución</b>: ', $resolucion, ' dpi</li>';
                        echo '<li><b>Fecha aproximada de recepción</b>: ', $fecha, '</li>';
                        if ($impresion) {
                            echo '<li><b>Impresión a color</b>: Si</li>';
                        } else {
                            echo '<li><b>Impresión a color</b>: No</li>';
                        }
                        echo '</ul>';

                        $resultado->close();
                        $conexion->close();

                    ?>

                    <a href="perfil.php">Aceptar</a>
                </section>
            </section>
        </main>

<?php
        require_once("footer.php");

    } else { 
		if ($pag_anterior != ("$url/solicitud.php")  &&  $pag_anterior != ("$url/solicitud.php?error=1")  &&  $pag_anterior != ("$url/solicitud.php?error=2")) {
            $extra = 'solicitud.php?error=1'; 
        } else {
            $extra = 'solicitud.php?error=2';
        }
        if (!isset($_SESSION["logueado"])) {
            $extra = 'index.php?error=2';
        }
        header("Location: http://$host$uri/$extra");
    }
?>