<?php
    session_start();

    if (isset($_SESSION["logueado"])) {

        $titulo = "Detalle Foto - Pictures & Images";
        $estilo = $_SESSION["estilo"];

        // Incluímos el head con el doctype
        require_once("head.php");

        // Incluímos la etiqueta <body> junto al header
        require_once("header.php");

        //Obtenemos el id que nos pasan por parametro
        $id = $_GET['id'];

        // Abrimos una conexion con el servidor de MySQL
        require("conexionBD.php");

        // Escribimos las sentencia SQL
        $sentencia = "SELECT f.Fichero, f.Alternativo, f.Titulo, f.Descripcion, f.Fecha, p.NomPais, a.IdAlbum, a.Titulo AS TAlbum, u.NomUsuario, u.IdUsuario
            FROM fotos f LEFT JOIN paises p ON p.IdPais=f.Pais
            JOIN albumes a ON a.IdAlbum=f.Album
            JOIN usuarios u ON u.IdUsuario=a.Usuario
            WHERE f.IdFoto = ?";

        // Preparamos la plantilla para enviarla a la BD
        $mysqli = $conexion->prepare($sentencia);

        // Le pasamos un parametro
        $mysqli->bind_param('i', $id);

        // Ejecutamos la sentencia
        if (!$mysqli->execute()) {
            echo '<p>Error al obtener la foto de la BD' .$conexion->connect_error. '</p>';
            exit;
        }

        // Obtenemos los resultados
        $resultado = $mysqli->get_result();
        if ($resultado->num_rows) {
            $fila = $resultado->fetch_object();
            echo "<main id='detalleFoto'>
                <section>
                    <h1>Detalle de foto</h1>
                    <section class='printCentro'>";
            
            echo "
            <img width='400' src='$fila->Fichero' alt='$fila->Alternativo'>
            <h2>$fila->Titulo</h2>
            <p><b>Descripción</b>: $fila->Descripcion</p>";
            if (isset($fila->Fecha)  &&  $fila->Fecha != "0000-00-00") {
                $fecha = explode("-", $fila->Fecha);
                echo "<p><b>Fecha</b>: $fecha[2]-$fecha[1]-$fecha[0]</p>";
            } else {
                echo "<p><b>Fecha</b>: No consta</p>";
            }
            if (isset($fila->NomPais)) {
                echo "<p><b>País</b>: $fila->NomPais</p>";
            } else {
                echo "<p><b>País</b>: No consta</p>";
            }
            echo "
            <p><b>Álbum</b>: <a href='verAlbumPrivada.php?id=$fila->IdAlbum'>$fila->TAlbum</a></p>
            <p><b>Usuario</b>: <a href='perfilUsuario.php?id=$fila->IdUsuario'>$fila->NomUsuario</a></p>";

            echo "</section></section></main>";
        } else {
            echo "<p style='margin: 145px auto;'>Esta foto no existe en la Base de Datos.</p>";
        }

        $resultado->close();
        $conexion->close();
        
        require_once("footer.php");

    } else {

        $host = $_SERVER['HTTP_HOST']; 
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); 
		$extra = 'index.php?fallo=2'; 
        header("Location: http://$host$uri/$extra");

    }
?>