<?php

    // Iniciar una nueva sesión o reanudar la existente....
	session_start();

    //La primera vez que entra a la pagina y se esta recordando, va directamente a acceso.
    if(isset($_COOKIE['recordar']) && !isset($_SESSION["logueado"]))
    {
        $host = $_SERVER['HTTP_HOST'];                         
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');    
        $extra = 'acceso.php';
        header("Location: http://$host$uri/$extra");   
    }

    else
    {

        $titulo = "Inicio - Pictures & Images";
        if (isset($_SESSION["logueado"])) {
            $estilo = $_SESSION["estilo"];
        } else {
            $estilo = "css/style.css";
        }

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");
?>

<main>
    <section>
        <h1>Inicio</h1>
        
        <?php

        //Si existe la cookie de usuario, permitimos que acceda a la parte privada directamente.
            if(isset($_COOKIE['recordar']))
            {
                //Convertimos el string a array.
                $datos = $_COOKIE['recordar'];
                $datosArray = json_decode($datos,true);
                $dia = $datosArray[2]['mday'];
                $mes = $datosArray[2]['mon'];
                $anyo = $datosArray[2]['year'];
                $minutos = $datosArray[2]['minutes'];
                $horas = $datosArray[2]['hours'];

                echo"<p style = text-align:center;>Hola <b>$datosArray[0]</b>, 
                su última visita fue el <b>$dia/$mes/$anyo</b> 
                a las <b>$horas:$minutos</b></p>";

            }

            if(!isset($_SESSION["logueado"])) {

        ?>
        
        <!-- Formulario para acceder como usuario registrado -->
        <section id="formini">
            <h2>Inicia Sesión</h2>

            <!--Miramos si en la url nos ha llegado un fallo y se lo mostramos al usuario-->
            <?php 

                if(isset($_GET["fallo"])) {
                    if ($_GET["fallo"] == 1) {
                        echo "<h3 style='color:red; text-align:center;'>Usuario o contraseña incorrectos</h3>";
                    } elseif ($_GET["fallo"] == 2) {
                        echo "<h3 style='color:red; text-align:center;'>Acceso denegado. Login necesario.</h3>";
                    }
                }

            ?>

            <form action="acceso.php" method="POST">
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre" id="nombre" placeholder="Introduce tu nombre">

                <label for="pass">Contraseña: </label>
                <input type="password" name="pass" id="pass" placeholder="Introduce tu contraseña">
                
                <label for="recuerdame">Recuerdame:</label>
                <input type="checkbox" name="recuerdame" id="recuerdame" value="si">
                
                <input type="submit" value="Entrar">
            </form>
            <p>¿Aún no te has registrado? <a href="registro.php">Regístrate</a></p>
        </section>

        <?php

            }

        // Abrimos una conexion con el servidor de MySQL
        include("conexionBD.php");

        $sentencia = "SELECT f.IdFoto, f.Fichero, f.Titulo, f.FRegistro, f.Alternativo, p.NomPais FROM fotos f LEFT JOIN paises p ON f.Pais=p.IdPais ORDER BY f.FRegistro DESC limit 5";
        
        if(!($resultado = $conexion->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
            echo '</p>'; 
            exit;
        }


        echo
        "<!-- Carga las últimas 5 fotos -->
        <section>
            <h2 style='padding-bottom:30px;'>Últimas Fotos</h2>
            <div class='seccionfoto'>";
            while($fila = $resultado->fetch_object()) {
                echo "<article>
                    <a href='detalle.php?id=$fila->IdFoto'>
                        <img width='400' src='$fila->Fichero' alt='$fila->Alternativo'>
                    </a>
                    <h3><a href='detalle.php?id=$fila->IdFoto'>$fila->Titulo</a></h3>
                    <p><b>Fecha</b>: $fila->FRegistro</p>";
                    //Si no tiene pais, no mostramos ese campo.
                    if(!($fila->NomPais == ""))
                    {
                        echo "<p><b>País</b>: $fila->NomPais</p>";
                    } else {
                        echo "<p><b>País</b>: No consta</p>";
                    }
                echo 
                "</article>";
            }
        echo
            "</div>
        </section>";

        
        // Mostramos las fotos favoritas
        echo "
        <section>
        <h2>Foto Favorita</h2>
        <div class='seccionfoto'>";

        // Guardamos el contenido del fichero de fotos favoritas en un array
        if (!($fichero = file("ficheros/fotosFav.txt"))  ||  count($fichero) == 0) {
            echo "<h3>Todavía no hay ninguna foto favorita</h3>";
        } else {

            // Sacamos un numero aleatorio para determinar una foto favorita
            $indexFotoFav = mt_rand(0, count($fichero)-1);
            $datosFotoFav = explode("-", $fichero[$indexFotoFav]);
            $idFoto = intval($datosFotoFav[0]);

            // Obtenemos toda la información necesaria de la base de datos
            $sentencia = "SELECT f.*, a.Titulo AS TAlbum, u.NomUsuario FROM fotos f, albumes a, usuarios u WHERE f.Album=a.IdAlbum AND u.IdUsuario=a.Usuario AND f.IdFoto=$idFoto";
            if(!($resultado = $conexion->query($sentencia))) {
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
                echo '</p>'; 
                exit;
            }
            $fila = $resultado->fetch_object();

            // Mostramos la información en la página web
            echo "<article>
                    <a style='display:flex;' href='detalle.php?id=$fila->IdFoto'>
                        <img style='margin:auto;' width='400' src='$fila->Fichero' alt='$fila->Alternativo'>
                    </a>
                    <h3 style='padding:10px;'><a href='detalle.php?id=$fila->IdFoto'>$fila->Titulo</a></h3>
                    <p><b>Descripción</b>: $fila->Descripcion</p>";
                    if ($fila->Fecha == "0000-00-00") {
                        echo "<p><b>Fecha</b>: No consta</p>";
                    } else {
                        echo "<p><b>Fecha</b>: $fila->Fecha</p>";
                    }
                    echo "<p><b>Fecha de registro</b>: $fila->FRegistro</p>";

                    //Si no tiene pais, no mostramos ese campo.
                    $sentencia = "SELECT p.NomPais FROM fotos f, paises p WHERE f.Pais=p.IdPais AND f.IdFoto=$idFoto";
                    if(!($resultado = $conexion->query($sentencia))) {
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
                        echo '</p>'; 
                        exit;
                    }
                    $pais = $resultado->fetch_object();
                    if ($resultado->num_rows) {
                        echo "<p><b>País</b>: $pais->NomPais</p>";
                    } else {
                        echo "<p><b>País</b>: No consta</p>";
                    }
            echo "<p><b>Álbum</b>: $fila->TAlbum</p>
                <p><b>Usuario</b>: $fila->NomUsuario</p>
                <p><b>Crítico de Fotografía</b>: $datosFotoFav[1]</p>
                <p><b>Comentario</b>: $datosFotoFav[2]</p>";
            echo 
            "</article>";
        }

        echo "</div></section>";




        // Mostramos los consejos fotográficos
        echo "
        <section>
        <h2>Consejo Fotográfico</h2>";

        // Obtenemos el contenido del archivo JSON
        $contenidoConsejos = file_get_contents("ficheros/consejos.json");

        // Convertimos el contenido JSON en un array PHP
        $consejos = json_decode($contenidoConsejos, true);
        $indexConsejo = mt_rand(0, count($consejos)-1);
        $consejo = $consejos[$indexConsejo];
        $categoria = $consejo["Categoria"];
        $dificultad = $consejo["Dificultad"];
        $comentario = $consejo["Consejo"];

        // Lo mostramos en la página web
        echo "<p><b>Categoría</b>: $categoria</p>";
        echo "<p><b>Dificultad</b>: $dificultad</p>";
        echo "<p><b>Consejo</b>: $comentario</p>";

        echo "</section>";
        
        $resultado->close();
        $conexion->close();
        ?>
    </section>
</main>
<?php
    require_once("footer.php");
}
?>