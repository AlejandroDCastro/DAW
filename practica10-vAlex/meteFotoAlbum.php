<?php
    session_start();

    if (isset($_SESSION["logueado"])) {

        $titulo = "Subir Foto - Pictures & Images";
        $estilo = $_SESSION["estilo"];
        $usu = $_SESSION["logueado"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");

        require("conexionBD.php");
?>

        <!-- CONTENIDO: Título contenido, Formulario -->
        <main>
            <section>
                <h1>Subir Foto</h1>
                <?php
                    if (isset($_GET['fallo'])) {
                        if ($_GET['fallo'] == 1) {
                            echo "<p style='color:red; text-align:center; padding-bottom: 30px;'>Debes subir una foto previamente</p>";
                        } elseif ($_GET['fallo'] == 2) {
                            echo "<p style='color:red; text-align:center; padding-bottom: 30px;'>Rellena todos los campos obligatorios</p>";
                        }
                    }
                ?>
                <form id="formulario" method="POST" action="resMeteFotoAlbum.php">
                    <div>
                        <label for="titulo">Título(*):</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Introduce el título" class="formulario">
                    </div>
                    <div>
                        <label for="desc">Descripción(*):</label>
                        <input type="text" id="desc" name="desc" placeholder="Introduce la descripción" class="formulario">
                    </div>
                    <div>
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" class="formulario">
                    </div>
                    <div>
                        <label for="pais">País:</label>
                        <input list="countries" name="pais" id="pais" placeholder="Introduce tu país" class="formulario">
                        <datalist id="countries">
                            <?php
                                require("paises.php");
                            ?>
                        </datalist>
                    </div>
                    <div>
                        <label for="foto">Foto(*):</label>
                        <input type="file" id="foto" name="foto" accept="image/*">
                    </div>
                    <div>
                        <label for="alt">Texto Alternativo(*):</label>
                        <input type="text" id="alt" name="alt" placeholder="Introduce un texto alternativo" class="formulario">
                    </div>
                    <div>
                        <label for="album">Álbum de PI(*):</label>
                        <select id="album" name="album">
                            <option value="0"></option>
                            
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
                                        if (isset($_GET['album'])  &&  $fila->IdAlbum == $_GET['album']) {
                                            echo "<option value='$fila->IdAlbum' selected>$fila->Titulo</option>";
                                        } else {
                                            echo "<option value='$fila->IdAlbum'>$fila->Titulo</option>";
                                        }
                                    }
                                }

                            ?>

                        </select>

                            <?php

                                if ($resultado->num_rows == 0) {
                                    echo "<p>Todavía no tienes nigún álbum. <a href='crearAlbum.php'>Crea</a> uno justo ahora.</p>";
                                }

                                $resultado->close();
                                $conexion->close();

                            ?>

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