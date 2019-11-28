<?php
    session_start();

    if (isset($_SESSION["logueado"])) {

        $titulo = "Detalle - Pictures & Images";
        $estilo = $_SESSION["estilo"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");

        //Obtenemos el id que nos pasan por parametro
        $id = $_GET['id'];

        // Abrimos una conexion con el servidor de MySQL
        include("conexionBD.php");

        // Escribimos las sentencia SQL
        $sentencia = "SELECT f.Fichero, f.Alternativo, f.Titulo, f.Descripcion, f.Fecha, p.NomPais, a.Titulo AS TAlbum, u.NomUsuario
        FROM fotos f JOIN pais p ON p.IdPais=f.Pais
        JOIN album a ON a.IdAlbum=f.Album
        JOIN usuario u ON u.IdUsuario=a.Usuario
        WHERE f.IdFoto = ?";

        // Preparamos la plantilla para enviarla a la BD
        $mysqli = $conexion->prepare($sentencia);

        // Le pasamos un parametro
        $mysqli->bind_param('i', $id);
        

        // Obtenemos los resultados
        $fila = $resultado->fetch_assoc();
        $fecha = $fila->format("d/m/Y");
        echo "<main>
            <section>
                <h1>Detalle de foto</h1>
                <section class='printCentro'>";

        echo "
        <img width='400' src='Images/$fila->Fichero' alt='$fila->Alternativo'>
        <h2>$fila->Titulo</h2>
        <p>Fecha: $fecha</p>
        <p>País: $fila->NomPais</p>
        <p>Pertenece al album: $fila->TAlbum</p>
        <p>Usuario: $fila->NomUsuario</p>";

        echo "</section></section></main>";


        /*if($id%2==0)
        {
            echo 
            "<main>
                <section>

                    <h1>Detalle de foto</h1>
                    <section class='printCentro'>
                        <img width='400' src='Images/arbol.jpg' alt='Arbol'>
                        <h2>Los arboles no dan Wi-Fi</h2>
                        <p>Fecha: 15-01-2018 20:55</p>
                        <p>País: Espa&ntilde;a</p>
                        <p>Pertenece al album: Raíces</p>
                        <p>Usuario: Ninfa</p>
                    </section>
                </section>
            </main>";
        }

        else
        {
            echo 
            "<main>
                <section>

                    <h1>Detalle de foto</h1>
                    <section class='printCentro'>
                        <img width='400' src='Images/estudiante.jpg' alt='Estudiante'>
                        <h2>A estudiar que ya es hora</h2>
                        <p>Fecha: 30-02-2019 20:55</p>
                        <p>País: Andorra</p>
                        <p>Pertenece al album: Currantes</p>
                        <p>Usuario: Antonieta</p>
                    </section>
                </section>
            </main>";
        }*/
    
        require_once("footer.php");

    } else {

        $host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		$extra = 'index.php?fallo=2'; 
        header("Location: http://$host$uri/$extra");

    }
?>