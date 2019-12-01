<?php
    session_start();

    if (isset($_SESSION["logueado"])) {

        $titulo = "Datos Usuario - Pictures & Images";
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
                    $sentencia = "SELECT NomUsuario,Clave,Sexo,Email,FNacimiento,NomPais,Ciudad FROM usuarios LEFT JOIN paises ON IdPais = Pais WHERE NomUsuario = ?";

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
                                <label for='usu'>Tu nombre de usuario es: $fila->NomUsuario</label>
                                <input type='text' name='usuario' id='usu' placeholder='Cambiar nombre' class='formulario'>
                            </div>
                            <div>
                                <label for='pwd'>Tu contraseña actual es: $fila->Clave</label>
                                <input type='password'  name='pass' id='pwd' placeholder='Cambiar contraseña' class='formulario'>
                            </div>
                            <div>
                                <label for='pwd2'>Repetir nueva contraseña:</label>
                                <input type='password'  name='pass2' id='pwd2' placeholder='Repite la nueva contraseña' class='formulario'>
                            </div>
                            <div>
                                <label for='mail'>Tu dirección de email es: $fila->Email</label>
                                <input type='text'  name='mail' id='mail' placeholder='Cambiar email' class='formulario'>
                            </div>
                            <div>
                            ";
                            if($fila->Sexo == 0)
                            {
                                echo "<label>Tu sexo es: Hombre</label>";
                            }
                            else
                            {
                                echo "<label>Tu sexo es: Mujer</label>";
                            }
                                echo "<input type='radio' name='sex' value='hombre' id='hombre'> <label for='hombre'>Hombre</label><br>
                                <input type='radio' name='sex' value='mujer' id='mujer'> <label for='mujer'>Mujer</label>
                            </div>
                            <div>
                                <label for='date'>Tu fecha de nacimiento es: $fila->FNacimiento</label>
                                <input type='text' name='fecha' id='date' class='formulario' placeholder='dd/mm/yyyy'>
                            </div>
                            <div>
                                <label for='country'>Tu país es: $fila->NomPais</label>
                                <input list='countries'  name='pais' id='country' placeholder='Cambiar país' class='formulario'>
                                <datalist id='countries'>
                                    <?php
                                        include('paises.php');
                                    ?>
                                </datalist>
                            </div>
                            <div>
                                <label for='city'>Tu ciudad es: $fila->Ciudad</label>
                                <input type='text' name='ciudad' id='city' placeholder='Cambiar ciudad' class='formulario'>
                            </div>
                            <div>
                                <label for='photo'>Foto:</label>
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