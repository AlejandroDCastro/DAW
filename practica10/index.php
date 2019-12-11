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
            <h2>Últimas Fotos</h2>
            <div class='seccionfoto'>";
            while($fila = $resultado->fetch_object()) {
                echo "<article>
                    <a href='detalle.php?id=$fila->IdFoto'>
                        <img width='400' src='$fila->Fichero' alt='$fila->Alternativo'>
                    </a>
                    <h3><a href='detalle.php?id=$fila->IdFoto'>$fila->Titulo</a></h3>
                    <p>Fecha: $fila->FRegistro</p>";
                    //Si no tiene pais, no mostramos ese campo.
                    if(!($fila->NomPais == ""))
                    {
                        echo "<p>País: $fila->NomPais</p>";
                    } else {
                        echo "<p>País: No consta</p>";
                    }
                echo 
                "</article>";
            }
        echo
            "</div>
        </section>";

        $resultado->close();
        $conexion->close();
        ?>
    </section>
</main>
<?php
    require_once("footer.php");
}
?>