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

                    //Preparamos los errores que nos pueden llegar desde la validación.
                        if (isset($_GET['error']) && $_GET['error'] == 'contramala') {
                            echo "<h3 style='color:red; text-align:center;'>Contraseña actual introducida errónea</h3>";
                        } 
                        if (isset($_GET['error']) && $_GET['error'] == 'norellenados') {
                            echo "<h3 style='color:red; text-align:center;'>Hay campos sin rellenar</h3>";
                        } 
                        if (isset($_GET['error3']) && $_GET['error3'] == 'nombre'){
                            echo "<h3 style='color:red; text-align:center;'>Formato nombre inválido</h3>";
                        } 
                        if (isset($_GET['error4']) && $_GET['error4'] == 'password'){
                            echo "<h3 style='color:red; text-align:center;'>Formato contraseña inválida</h3>";
                        } 
                        if (isset($_GET['error5']) && $_GET['error5'] == 'noCoinciden') {
                            echo "<h3 style='color:red; text-align:center;'>Las contraseñas no coinciden</h3>";
                        } 
                        if (isset($_GET['error6']) && $_GET['error6'] == 'email'){
                            echo "<h3 style='color:red; text-align:center;'>Formato email inválido</h3>";
                        }
                        if (isset($_GET['error7']) && $_GET['error7'] == 'sexo'){
                            echo "<h3 style='color:red; text-align:center;'>Sexo inválido</h3>";
                        } 
                        if (isset($_GET['error8']) && $_GET['error8'] == 'fecha'){
                            echo "<h3 style='color:red; text-align:center;'>Fecha de nacimiento inválida</h3>";
                        }
                        if (isset($_GET['error9']) && $_GET['error9'] == 'pais'){
                            echo "<h3 style='color:red; text-align:center;'>Pais no existente</h3>";
                        }
                        if (isset($_GET['error10']) && $_GET['error10'] == 'estilo'){
                            echo "<h3 style='color:red; text-align:center;'>Ese estilo de página no existe</h3>";
                        }
                        if (isset($_GET['error11']) && $_GET['error11'] == 'ciudad'){
                            echo "<h3 style='color:red; text-align:center;'>La ciudad solo puede tener letras y espacios en blanco</h3>";
                        }
                        if (isset($_GET['error12']) && $_GET['error12'] == 'foto'){
                            echo "<h3 style='color:red; text-align:center;'>La ciudad solo puede tener letras y espacios en blanco</h3>";
                        }

                    include("conexionBD.php");
                    $id = $_SESSION['id'];
                    $sentencia = "SELECT NomUsuario,Clave,Sexo,Email,Ciudad,FNacimiento,Foto,NomPais,Nombre FROM usuarios LEFT JOIN paises ON IdPais = Pais LEFT JOIN estilos ON Estilo = IdEstilo WHERE IdUsuario = ?";

                    $stmt = $conexion->prepare($sentencia);
                    $stmt->bind_param('i', $id);
                    if(!$stmt->execute()) {
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
                        echo '</p>'; 
                        exit;
                    }

                    $resultado = $stmt->get_result();
                    if($resultado->num_rows) 
                    {
                        $fila = $resultado->fetch_object();

                        //Cambiamos fecha de nacimiento de YYYY/MM/DD a DD/MM/YYYY
                        $fechaAntigua = $fila->FNacimiento;
                        $valoresAntiguos = explode('-', $fechaAntigua);

                        $fechaNueva = $valoresAntiguos[2]."/".$valoresAntiguos[1]."/".$valoresAntiguos[0];

                        $resultado->close();
                        $conexion->close();

                        echo
                        "
                        <form enctype='multipart/form-data' action='resMisDatos.php' id='formulario' method='POST'>
                            <div>
                                <label for='usu'>Nombre</label>
                                <input type='text' name='usuario' id='usu' value='$fila->NomUsuario' placeholder='Cambiar nombre. (3-15 caracteres)' class='formulario'>
                            </div>
                            <div>
                                <label for='pwd'>¿Quieres cambiar la contraseña?</label>
                                <input type='password'  name='pass' id='pwd'  placeholder='Debe tener al menos una mayúscula, una minúscula y un número. (6-15 caracteres)' class='formulario'>
                            </div>
                            <div>
                                <label for='pwd2'>Repetir contraseña</label>
                                <input type='password'  name='pass2' id='pwd2' placeholder='Repite la nueva contraseña' class='formulario'>
                            </div>
                            <div>
                                <label for='mail'>Email</label>
                                <input type='text'  name='mail' id='mail' value='$fila->Email' placeholder='Cambiar email' class='formulario'>
                            </div>
                            <div>
                            <label>Sexo</label>";
                            if($fila->Sexo == 0)
                            {
                                echo "<input type='radio' name='sex' value='Hombre' id='hombre'checked> <label for='hombre'>Hombre</label><br>
                                <input type='radio' name='sex' value='Mujer' id='mujer'> <label for='mujer'>Mujer</label>";
                            }
                            else
                            {
                                echo "<input type='radio' name='sex' value='Hombre' id='hombre'> <label for='hombre'>Hombre</label><br>
                                <input type='radio' name='sex' value='Mujer' id='mujer' checked> <label for='mujer'>Mujer</label>";
                            }
                            echo 
                            "
                            </div>
                            <div>
                                <label for='date'>Fecha de nacimiento</label>
                                <input type='text' name='fecha' id='date' value='$fechaNueva' class='formulario' placeholder='dd/mm/yyyy'>
                            </div>
                            <div>
                                <label for='country'>País</label>
                                <input list='countries'  name='pais' id='country' placeholder='Cambiar país' value='$fila->NomPais' class='formulario'>
                                <datalist id='countries'>";
                                        require('conexionBD.php');

                                        require('paises.php');
                                        $resultado->close();
                                        $conexion->close();
                            echo 
                                "</datalist>
                            </div>
                            <div>
                                <label for='estilo'>Estilo de página:</label>
                                <input list='sty'  name='estilo' id='estilo' value='$fila->Nombre' placeholder='Estilo' class='formulario'>
                                <datalist id='sty'>
                                ";
                                        require('conexionBD.php');

                                        require('estilos.php');
                                        
                                        $resultado->close();
                                        $conexion->close();
                                echo "
                                </datalist>
                            </div>
                            <div>
                                <label for='city'>Ciudad</label>
                                <input type='text' name='ciudad' id='city'
                                placeholder='Cambiar ciudad' value='$fila->Ciudad' class='formulario'>
                            </div>
                            ";
                            if($fila->Foto != "")
                            {
                                $laFotoPerfil = 'Images/Perfiles/' . $fila->NomUsuario . '.jpg';
                                echo "
                                <a style='margin-left: 20px;' href='$laFotoPerfil'>
                                <img width='400' src='$laFotoPerfil' alt='$fila->NomUsuario'>
                                </a><br>
                            <div>
                                <label for='photo'>Insertar nueva foto</label><br>
                                <input type='file' name='file' id='photo' accept='image/jpeg'>
                            </div>
                            ";
                            }
                            else
                            {
                               echo "
                            <div>
                                <label for='photo'>No tienes foto de perfil. ¿Quieres insertar una foto?</label><br>
                                <input type='file' name='file' id='photo' accept='image/jpeg'>
                            </div>"; 
                            }

                            echo "
                            <div>
                                <label style='text-align:center;' for='pwdActual'>Introduce tu contraseña actual</label>
                                <input type='password'  name='passActual' id='pwdActual' placeholder='Contraseña actual' class='formulario'>
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