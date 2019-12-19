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
                <h1>Perfil de usuario</h1>
                <section class="seccionFoto">
                    
                    <?php

                        include("conexionBD.php");

                        $id_usu = $_GET['id'];
                        //Si el id recibido no es correcto, redireccionamos a la pagina de index devolviendo un error.
                        if($id_usu == "")
                        {
                            $host = $_SERVER['HTTP_HOST']; 
                            $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
                            $extra = 'index.php?fallo=2'; 
                            header("Location: http://$host$uri/$extra");
                        }

                        //Sacamos los datos del usuario.
                        $sentencia = "SELECT u.Foto, u.NomUsuario, u.FRegistro FROM usuarios u WHERE u.IdUsuario = ?";
                        //Sacamos todos los albumes del usuario.
                        $sentenciaAlbumes = "SELECT a.Titulo, a.IdAlbum FROM usuarios u JOIN albumes a ON u.IdUsuario = a.Usuario WHERE u.IdUsuario = '$id_usu'";
                        
                        //Vamos mostrando todos los datos del usuario.
                        $stmt = $conexion->prepare($sentencia);
                        $stmt->bind_param('i', $id_usu);
                        if(!$stmt->execute()) {
                            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
                            echo '</p>'; 
                            exit;
                        }

                        $resultado = $stmt->get_result();
                        if($resultado->num_rows) 
                        {
                            $fila = $resultado->fetch_object();
                            echo "<article>
                                <h2 style = 'text-align: center; font-size:30px; margin-bottom: 5px;'>$fila->NomUsuario</h2>";
                            if($fila->Foto != "")
                            {
                                $fotoPerfil = 'Images/Perfiles/' . $fila->NomUsuario . '.jpg';
                                echo "<a href='$fotoPerfil'>
                            <img  width='400' src='$fotoPerfil' alt='$fila->NomUsuario'>
                            </a>";
                            }
                            else
                            {
                                echo "<a href='Images/Perfiles/SinFoto.jpg'>
                            <img  width='400' src='Images/Perfiles/SinFoto.jpg' alt='$fila->NomUsuario'>
                            </a>";
                            }
                            
                            echo "<p style = 'text-align: center;  font-size:25px;'>Fecha de ingreso: $fila->FRegistro</p><br><br>";
                        } 
                        else
                        {
                            echo "Ese usuario no existe";
                        }

                        //Vas recorriendo los albumes y mostrandolos por pantalla.
                        if(!($resultadoAlbumes = $conexion->query($sentenciaAlbumes))) {
                            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
                            echo '</p>'; 
                            exit;
                        }

                        echo "<p style = 'text-align: center;  font-size:35px;'>Albumes</p><br>";
                        while($filaAlbumes = $resultadoAlbumes->fetch_object())
                        {
                            echo "<p style = 'text-align: center;  font-size:25px;'><a href='verAlbumPublica.php?id=$filaAlbumes->IdAlbum'>$filaAlbumes->Titulo</a></p>";
                        }
                        echo "</article>";

                        
                            
                        
                        //Cerramos la conexion.
                        $resultado->close();
                        $conexion->close();

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