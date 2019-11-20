<?php
    session_start();
    
    $titulo = "Registro";
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

            if(isset($_GET["faltan"])==true){
                 echo "<h3 style='color:red; text-align:center;'>Hay campos sin rellenar</h1>";
            }
            
            if(isset($_GET["nocoinciden"])==true){
                 echo "<h3 style='color:red; text-align:center;'>Las contraseñas no coinciden</h1>";
            }

            ?>

            <form action="resRegistro.php" id="formulario" method="POST">
                <div>
                    <label for="usu">Nombre de usuario(*):</label>
                    <input type="text" name="usuario" id="usu" placeholder="Introduce un nombre" class="formulario">
                </div>
                <div>
                    <label for="pwd">Contraseña(*):</label>
                    <input type="password"  name="pass" id="pwd" placeholder="Introduce una contraseña" class="formulario">
                </div>
                <div>
                    <label for="pwd2">Repetir contraseña(*):</label>
                    <input type="password"  name="pass2" id="pwd2" class="formulario">
                </div>
                <div>
                    <label for="mail">Dirección de email:</label>
                    <input type="text"  name="mail" id="mail" placeholder="Introduce tu email" class="formulario">
                </div>
                <div>
                    <label>Sexo:</label>
                    <input type="radio" name="sex" value="hombre" id="hombre"> <label for="hombre">Hombre</label><br>
                    <input type="radio" name="sex" value="mujer" id="mujer"> <label for="mujer">Mujer</label>
                </div>
                <div>
                    <label for="date">Fecha de nacimiento:</label>
                    <input type="text"  name="fecha" id="date" class="formulario" placeholder="dd/mm/yyyy">
                </div>
                <div>
                    <label for="country">País:</label>
                    <input list="countries"  name="pais" id="country" placeholder="Introduce tu país" class="formulario">
                    <datalist id="countries">
                       <?php
                          require_once("paises.php");
                        ?>
                    </datalist>
                </div>
                <div>
                    <label for="city">Ciudad:</label>
                    <input type="text"  name="ciudad" id="city" placeholder="Introduce tu ciudad" class="formulario">
                </div>
                <div>
                    <label for="photo">Foto:</label>
                    <input type="file" id="photo" accept="image/*">
                </div>
                <div>
                    <input type="submit" value="Enviar">
                </div>
            </form>
        </section>
    </main>
<?php
    require_once("footer.php");
?>