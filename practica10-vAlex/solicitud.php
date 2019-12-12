<?php
    session_start();

    if (isset($_SESSION["logueado"])) {

        $titulo = "Solicitar Álbum - Pictures & Images";
        $estilo = $_SESSION["estilo"];
        $usu = $_SESSION["logueado"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");

        include("conexionBD.php");

?>

        <main>
            <section id="solicitud">
                <h1>Solicitud de impresión de álbum</h1>
                <p>Solicita ahora mismo tus álbumes en físico para poder disfrutar de tus fotografías e imágenes al máximo. Consulta las tarifas de cada página y fotografía en la información disponible en la siguiente tabla.</p>
                <div>
                    <section>
                        <h2>Tarifas</h2>
                        <table>
                            <tr>
                                <th>Concepto</th>
                                <th>Tarifa</th>
                            </tr>
                            <tr>
                                <td>&lt; 5 páginas</td>
                                <td>0.10 € por pág.</td>
                            </tr>
                            <tr>
                                <td>5 &lt;= páginas &lt;= 11</td>
                                <td>0.08 € por pág.</td>
                            </tr>
                            <tr>
                                <td>> 11 páginas</td>
                                <td>0.07 € por pág.</td>
                            </tr>
                            <tr>
                                <td>Blanco y negro</td>
                                <td>0 €</td>
                            </tr>
                            <tr>
                                <td>Color</td>
                                <td>0.05 € por foto</td>
                            </tr>
                            <tr>
                                <td>Resolución > 300 dpi</td>
                                <td>0.02 € por foto</td>
                            </tr>
                        </table>
                        <?php
                            require_once("crearTabla.php");
                        ?>
                    </section>
                    <section>
                        <h2>Formulario de solicitud</h2>
                        <p>Rellena el siguiente formulario aportando todos los detalles para confeccionar tu álbum. (*) Indica un campo obligatorio.</p>
                        <form id="formulario" method="POST" action="resSolicitud.php">
                        
                            <?php

                            if (isset($_GET['error'])) {
                                if ($_GET['error'] == 1) {
                                    echo "<p style='color:red; text-align:center; padding-bottom: 30px;'><b>Debes solicitar un álbum previamente</b></p>";
                                } elseif ($_GET['error'] == 2) {
                                    echo "<p style='color:red; text-align:center; padding-bottom: 30px;'><b>Rellena todos los campos obligatorios</b></p>";
                                }
                            }

                            ?>

                            <div>
                                <label for="nombre">Nombre(*):</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre" maxlength="200" autofocus class="formulario">
                            </div>
                            <div>
                                <label for="titulo">Título del álbum(*):</label>
                                <input type="text" id="titulo" name="titulo" placeholder="Escribe su título" maxlength="200" class="formulario">
                            </div>
                            <div>
                                <label for="texto">Texto adicional(*):</label>
                                <textarea id="texto" name="texto" placeholder="Dedicatoria, descrición de su contenido, etc." maxlength="4000" class="formulario"></textarea>
                            </div>
                            <div>
                                <label for="email">Correo electrónico(*):</label>
                                <input type="email" name="email" id="email" placeholder="Escribe tu email" maxlength="200" class="formulario">
                            </div>
                            <div>
                                <label for="direccion">Dirección(*):</label>
                                <input type="text" id="direccion" name="direccion" placeholder="Calle(*)" class="formulario">
                                <input type="number" id="num" name="num" placeholder="Número(*)" min="1" class="formulario">
                                <input type="text" id="piso" name="piso" placeholder="Piso" class="formulario">
                                <input type="text" id="puerta" name="puerta" placeholder="Puerta" class="formulario">
                                <input type="text" id="cp" name="cp" placeholder="CP(*)" class="formulario">
                                <input type="text" id="localidad" name="localidad" placeholder="Localidad(*)" class="formulario">
                                <input type="text" id="provincia" name="provincia" placeholder="Provincia(*)" class="formulario">
                                <input list="countries" id="country" name="country" placeholder="País(*)" class="formulario">
                                <datalist id="countries">
                                    <?php
                                        require("paises.php");
                                    ?>
                                </datalist>
                            </div>
                            <div>
                                <label for="telefono">Teléfono(*):</label>
                                <input type="tel" id="telefono" name="telefono" placeholder="### ## ## ##" class="formulario">
                            </div>
                            <div>
                                <label for="color">Color de portada(*):</label>
                                <input type="color" id="color" name="color" value="#000000" >
                            </div>
                            <div>
                                <label for="copias">Número de copias(*):</label>
                                <input type="number" id="copias" name="copias" value="1" min="1" class="formulario">
                            </div>
                            <div>
                                <label for="resolucion">Resolución de impresión(*):</label>
                                <select id="resolucion" name="resolucion">
                                    <option value="150">150 dpi</option>
                                    <option value="300">300 dpi</option>
                                    <option value="450">450 dpi</option>
                                    <option value="600">600 dpi</option>
                                    <option value="750">750 dpi</option>
                                    <option value="900">900 dpi</option>
                                </select>
                            </div>
                            <div>
                                <label for="album">Álbum de PI(*):</label>
                                <select id="album" name="album">
                                    <option value=""></option>
                                    
                                    <?php

                                        $sentencia = "SELECT a.IdAlbum, a.Titulo FROM albumes a
                                            JOIN usuarios u ON a.Usuario=u.IdUsuario
                                            WHERE u.NomUsuario='$usu'";
                                        
                                        // Realizamos la consulta SQL a la BD
                                        if (!($resultado = $conexion->query($sentencia))) {
                                            echo '<p>Error al obtener lista de Albumes de la BD: ' .$conexion->error. '</p>';
                                            exit;
                                        }

                                        if ($resultado->num_rows > 0) {
                                            while ($fila = $resultado->fetch_object()) {
                                                echo "<option value='$fila->IdAlbum'>$fila->Titulo</option>";
                                            }
                                        }

                                    ?>

                                </select>

                                <?php  

                                        if ($resultado->num_rows == 0) {
                                            echo "<p style='color: blue;'>Todavía no tienes nigún álbum. <a href='crearAlbum.php'>Crea</a> uno justo ahora.</p>";
                                        }

                                        $resultado->close();
                                        $conexion->close();
                                        
                                ?>
                            </div>
                            <div>
                                <label for="fecha">Fecha aproximada de recepción(*):</label>
                                <input id="fecha" name="fecha" type="date" class="formulario">
                            </div>
                            <div>
                                <label for="impresion"> Impresión a color:</label>
                                <input type="checkbox" id="impresion" name="impresion" value="1">
                            </div>
                            <div>
                                <input type="submit" value="Enviar">
                            </div>
                        </form>
                    </section>
                </div>
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