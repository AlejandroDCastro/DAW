<?php
    session_start();

    if(!isset($_SESSION["logueado"])) {
    
        $titulo = "Registro - Pictures & Images";
        $estilo = "css/style.css";
        
        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");
?>

        <!-- CONTENIDO: Título contenido, Formulario -->
        <main>
            <section>
                <h1>Registro de Usuario</h1>

                <!--Comprueba si le ha llegado un mensaje de error de parte del servidor-->
                <?php

                    //Preparamos los errores que nos pueden llegar desde la validación.
                        if (isset($_GET['error']) && $_GET['error'] == 'norellenados') {
                            echo "<h3 style='color:red; text-align:center;'>Hay campos sin rellenar</h3>";
                        } 
                        if (isset($_GET['error1']) && $_GET['error1'] == 'nombre'){
                        	echo "<h3 style='color:red; text-align:center;'>Formato nombre inválido</h3>";
                        } 
                        if (isset($_GET['error2']) && $_GET['error2'] == 'password'){
                        	echo "<h3 style='color:red; text-align:center;'>Formato contraseña inválido</h3>";
                        } 
                        if (isset($_GET['error3']) && $_GET['error3'] == 'noCoinciden') {
                            echo "<h3 style='color:red; text-align:center;'>Las contraseñas no coinciden</h3>";
                        } 
                        if (isset($_GET['error4']) && $_GET['error4'] == 'email'){
                        	echo "<h3 style='color:red; text-align:center;'>Formato email inválido</h3>";
                        }
                        if (isset($_GET['error5']) && $_GET['error5'] == 'sexo'){
                        	echo "<h3 style='color:red; text-align:center;'>Sexo inválido</h3>";
                        } 
                        if (isset($_GET['error6']) && $_GET['error6'] == 'fecha'){
                        	echo "<h3 style='color:red; text-align:center;'>Fecha de nacimiento inválida</h3>";
                        }
                        if (isset($_GET['error7']) && $_GET['error7'] == 'pais'){
                        	echo "<h3 style='color:red; text-align:center;'>Pais no existente</h3>";
                        }
                        if (isset($_GET['error8']) && $_GET['error8'] == 'estilo'){
                        	echo "<h3 style='color:red; text-align:center;'>Ese estilo de página no existe</h3>";
                        }
                        if(isset($_GET['error9']) && $_GET['error9'] == 'ciudad')
                        {
                            echo "<h3 style='color:red; text-align:center;'>La ciudad solo puede tener letras y espacios en blanco</h3>";
                        }
                        if(isset($_GET['error10']) && $_GET['error10'] == 'foto')
                        {
                            echo "<h3 style='color:red; text-align:center;'>Formato de foto inválido.</h3>";
                        }
                    
                ?>

                <form enctype="multipart/form-data" action="resRegistro.php" id="formulario" method="POST">
					<?php
					//Si el usuario se ha equivocado en algo, conservamos sus datos para que no tenga que volver a ponerlos.
					if(isset($_SESSION["usu"]))
					{
						$usu = $_SESSION["usu"];
						$pass = $_SESSION['pass'];
						$pass2 = $_SESSION['pass2'];
						$mail = $_SESSION['mail'];
						$sex = $_SESSION['sex'];
						$fecha = $_SESSION['fecha'];
						$pais = $_SESSION['pais'];
						$estilo = $_SESSION['estilo'];
						$ciudad = $_SESSION['ciudad'];
						echo
						"<div>
					    	<label for='usu'>Nombre de usuario(*):</label>
					        <input type='text' name='usuario' id='usu' placeholder='Introduce un nombre. (3-15 caracteres)' class='formulario' value='$usu'>
					   	</div>
					   	<div>
	                        <label for='pwd'>Contraseña(*):</label>
	                        <input type='password'  name='pass' id='pwd' placeholder='Al menos una mayúscula, una minúscula y un número. (6-15 caracteres)' class='formulario' value='$pass'>
	                    </div>
	                    <div>
	                        <label for='pwd2'>Repetir contraseña(*):</label>
	                        <input type='password'  name='pass2' id='pwd2' placeholder='Vuelve a introducir la contraseña' class='formulario' value='$pass2'>
	                    </div>
	                    <div>
	                        <label for='mail'>Dirección de email(*):</label>
	                        <input type='text'  name='mail' id='mail' placeholder='Introduce tu email' class='formulario' value='$mail'>
	                    </div>
	                    ";
	                    if($sex == "Hombre")
	                    {
	                    	echo 
	                    	"<div>
	                        	<label>Sexo(*):</label>
		                        <input type='radio' name='sex' value='Hombre' id='hombre' checked> <label for='hombre'>Hombre</label><br>
		                        <input type='radio' name='sex' value='Mujer' id='mujer'> <label for='mujer'>Mujer</label>
		                    </div>";
	                    }
	                    else
	                    {
	                    	if($sex == "Mujer")
		                    {
		                    	echo 
		                    	"<div>
		                        	<label>Sexo(*):</label>
			                        <input type='radio' name='sex' value='Hombre' id='hombre'> <label for='hombre'>Hombre</label><br>
			                        <input type='radio' name='sex' value='Mujer' id='mujer' checked> <label for='mujer'>Mujer</label>
			                    </div>";
		                    }
		                    else
		                    {
		                    	echo 
		                    	"<div>
		                        	<label>Sexo(*):</label>
			                        <input type='radio' name='sex' value='Hombre' id='hombre'> <label for='hombre'>Hombre</label><br>
			                        <input type='radio' name='sex' value='Mujer' id='mujer'> <label for='mujer'>Mujer</label>
			                    </div>";
		                    }
	                    }
	                    echo 
	                    "<div>
                        <label for='date'>Fecha de nacimiento(*):</label>
                        <input type='text'  name='fecha' id='date' value='$fecha' class='formulario' placeholder='dd/mm/yyyy'>
                    </div>
                    <div>
                        <label for='country'>País:</label>
                        <input list='countries'  name='pais' id='country' value='$pais' placeholder='Introduce tu país' class='formulario'>
                        <datalist id='countries'>
                        ";
                                require('conexionBD.php');

                                require_once('paises.php');
                                
                                $resultado->close();
                                $conexion->close();
                    echo "
                        </datalist>
                    </div>
                    <div>
                        <label for='estilo'>Estilo de página:</label>
                        <input list='sty'  name='estilo' id='estilo' value='$estilo' placeholder='¿Qué estilo deseas que tenga la página?' class='formulario'>
                        <datalist id='sty'>
                        ";
                            
                                require('conexionBD.php');

                                require_once('estilos.php');
                                
                                $resultado->close();
                                $conexion->close();
                           
                        echo "
                        </datalist>
                    </div>
                    <div>
                        <label for='city'>Ciudad:</label>
                        <input type='text' name='ciudad' id='city' value='$ciudad' placeholder='Introduce tu ciudad' class='formulario'>
                    </div>
                    <div>
                        <label for='photo'>Foto:</label>
                        <input type='file' name='file' id='photo' accept='image/jpeg'>
                    </div>
                    <div>
                        <input type='submit' value='Enviar'>
                    </div>
	                    ";
					   	$_SESSION = array();
					   	session_destroy();
					}

					else
					{
					echo
					'<div>
				    	<label for="usu">Nombre de usuario(*):</label>
				        <input type="text" name="usuario" id="usu" placeholder="Introduce un nombre" class="formulario">
				   	</div>
					
                    <div>
                        <label for="pwd">Contraseña(*):</label>
                        <input type="password"  name="pass" id="pwd" placeholder="Introduce una contraseña" class="formulario">
                    </div>
                    
                    <div>
                        <label for="pwd2">Repetir contraseña(*):</label>
                        <input type="password"  name="pass2" id="pwd2" placeholder ="Vuelve a introducir la contraseña" class="formulario">
                    </div>
                    <div>
                        <label for="mail">Dirección de email(*):</label>
                        <input type="text"  name="mail" id="mail" placeholder="Introduce tu email" class="formulario">
                    </div>
                    <div>
                        <label>Sexo(*):</label>
                        <input type="radio" name="sex" value="Hombre" id="hombre"> <label for="hombre">Hombre</label><br>
                        <input type="radio" name="sex" value="Mujer" id="mujer"> <label for="mujer">Mujer</label>
                    </div>
                    <div>
                        <label for="date">Fecha de nacimiento(*):</label>
                        <input type="text"  name="fecha" id="date" class="formulario" placeholder="dd/mm/yyyy">
                    </div>
                    <div>
                        <label for="country">País:</label>
                        <input list="countries"  name="pais" id="country" placeholder="Introduce tu país" class="formulario">
                        <datalist id="countries">
                        ';
                            
                                require("conexionBD.php");

                                require_once("paises.php");
                                
                                $resultado->close();
                                $conexion->close();
                    echo '     
                        </datalist>
                    </div>
                    <div>
                        <label for="estilo">Estilo de página:</label>
                        <input list="sty"  name="estilo" id="estilo" placeholder="¿Qué estilo deseas que tenga la página?" class="formulario">
                        <datalist id="sty">
                        ';
                                require("conexionBD.php");

                                require_once("estilos.php");
                                
                                $resultado->close();
                                $conexion->close();
                        echo '
                        </datalist>
                    </div>
                    <div>
                        <label for="city">Ciudad:</label>
                        <input type="text" name="ciudad" id="city" placeholder="Introduce tu ciudad" class="formulario">
                    </div>
                    <div>
                        <label for="photo">Foto:</label>
                        <input type="file" name="file" id="photo" accept="image/jpeg">
                    </div>
                    <div>
                        <input type="submit" value="Enviar">
                    </div>
                    ';
                	}
                    ?>
                </form>
            </section>
        </main>

<?php
        require_once("footer.php");

    } else {

        $host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		$extra = 'perfil.php?error=1'; 
        header("Location: http://$host$uri/$extra");
    }
?>