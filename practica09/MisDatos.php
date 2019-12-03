<?php
    session_start();

    if (isset($_SESSION["logueado"])) {

        $titulo = "Mis datos - Pictures & Images";
        $estilo = $_SESSION["estilo"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");
?>
    <!-- CONTENIDO: Título contenido, Formulario -->
    <main>
        <section>
            <h1>Mis datos</h1>
                    

                    <?php

                    include("conexionBD.php");
                    $nombre = $_GET['nombre'];
                    $sentencia = "SELECT NomUsuario,Clave,Sexo,Email,Ciudad,FNacimiento,NomPais FROM usuarios LEFT JOIN paises ON IdPais = Pais WHERE NomUsuario = ?";

                    $stmt = $conexion->prepare($sentencia);
                    $stmt->bind_param('s', $nombre);
                    if(!$stmt->execute()) {
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
                        echo '</p>'; 
                        exit;
                    }

                    $resultado = $stmt->get_result();
                    if($resultado->num_rows) 
                    {
                        $fila = $resultado->fetch_object();
                        echo
                        "
                        <form action='resRegistro.php' id='formulario' method='POST'>
                            <div>
                                <label for='usu'>Nombre</label>
                                <input type='text' name='usuario' id='usu' value='$fila->NomUsuario' placeholder='Cambiar nombre' class='formulario'>
                            </div>
                            <div>
                                <label for='pwd'>Contraseña</label>
                                <input type='password'  name='pass' id='pwd' value='$fila->Clave' placeholder='Cambiar contraseña' class='formulario'>
                            </div>
                            <div>
                                <label for='pwd2'>Repetir contraseña</label>
                                <input type='password'  name='pass2' id='pwd2' value='$fila->Clave' placeholder='Repite la nueva contraseña' class='formulario'>
                            </div>
                            <div>
                                <label for='mail'>Email</label>
                                <input type='text'  name='mail' id='mail' value='$fila->Email' placeholder='Cambiar email' class='formulario'>
                            </div>
                            <div>
                            <label>Sexo</label>";
                            if($fila->Sexo == 0)
                            {
                                echo "<input type='radio' name='sex' value='hombre' id='hombre'checked> <label for='hombre'>Hombre</label><br>
                                <input type='radio' name='sex' value='mujer' id='mujer'> <label for='mujer'>Mujer</label>";
                            }
                            else
                            {
                                echo "<input type='radio' name='sex' value='hombre' id='hombre'> <label for='hombre'>Hombre</label><br>
                                <input type='radio' name='sex' value='mujer' id='mujer' checked> <label for='mujer'>Mujer</label>";
                            }
                            echo 
                            "
                            </div>
                            <div>
                                <label for='date'>Fecha de nacimiento</label>
                                <input type='text' name='fecha' id='date' value='$fila->FNacimiento' class='formulario' placeholder='dd/mm/yyyy'>
                            </div>
                            <div>
                                <label for='country'>País</label>
                                <input list='countries'  name='pais' id='country' placeholder='Cambiar país' value='$fila->NomPais' class='formulario'>
                                <datalist id='countries'>";
                                        require_once('paises.php');
                            echo 
                                "</datalist>
                            </div>
                            <div>
                                <label for='city'>Ciudad</label>
                                <input type='text' name='ciudad' id='city' value='$fila->Ciudad' placeholder='Cambiar ciudad' class='formulario'>
                            </div>
                            <div>
                                <label for='photo'>Foto</label>
                                <input type='file' id='photo' accept='image/*'>
                            </div>
                            <div>
                                <input type='submit' value='Enviar'>
                            </div>
                        </form>
                    ";
                    } 
                    else
                    {
                        echo "Este usuario no existe";
                    }

                    $resultado->close();
                    $conexion->close(); 
                    ?>
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