<?php
    session_start();
    
    $titulo = "Resultado - Pictures & Images";
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
            <h1>Resultado de búsqueda</h1>

            <?php

                //Mostramos lo que el usuario a introducido con el formulario de busqueda
                $titulo = $_POST['titulo'];
                $date = $_POST['date'];
                $pais = $_POST['pais'];
                //$autor = $_POST['autor'];

                echo "<h2 style='text-align:center'>Filtrado por:</h2><br>";

                //Si ha rellenado un campo en busqueda, lo mostramos aqui.

                if($titulo != "")
                {
                   echo "<p style='text-align:center; font-size: 20px'><b>Título:</b> $titulo</p>";
                }
                if($date != "")
                {
                   echo "<p style='text-align:center; font-size: 20px'><b>Fecha:</b> $date</p>";
                }
                if($pais != "")
                {
                   echo "<p style='text-align:center; font-size: 20px'><b>País:</b> $pais</p>";
                }
                /*
                if($autor != "")
                {
                   echo "<p style='text-align:center; font-size: 20px'><b>Autor:</b> $autor</p>";
                }
                */
            ?>

            <div id="ordenacion">
                <label>Ordenar por:</label>
                <select>
                    <option value="def" selected>Defecto</option>
                    <option value="t-a">Título: Ascendente</option>
                    <option value="t-d">Título: Descendente</option>
                    <option value="f-a">Fecha: Ascendente</option>
                    <option value="f-d">Fecha: Descendente</option>
                    <option value="a-a">Autor: Ascendente</option>
                    <option value="a-d">Autor: Descendente</option>
                    <option value="p-a">País: Ascendente</option>
                    <option value="p-d">País: Descendente</option>
                </select>
            </div>
            
            <?php
            /*
            //-----------------USUARIO NO FILTRA LA BÚSQUEDA--------------------
            if($titulo == "" && $inicio == "" && $fin == "" && $pais == "")
            {
                include("conexionBD.php");

                    $sentencia = "SELECT f.IdFoto, f.Fichero, f.Titulo, f.FRegistro, f.Alternativo, p.NomPais FROM fotos f LEFT JOIN paises p ON f.Pais=p.IdPais ORDER BY f.FRegistro DESC";
                    
                    if(!($resultado = $conexion->query($sentencia))) {
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
                        echo '</p>'; 
                        exit;
                    }
                    echo 
                    "<section>
                        <h2>Fotos</h2>
                        <div class='seccionfoto'>";

                        while($fila = $resultado->fetch_object()) {
                             echo "<article>
                                <a href='detalle.php?id=$fila->IdFoto'>
                                    <img width='400' src='$fila->Fichero' alt='$fila->Alternativo'>
                                </a>
                                <h3><a href='detalle.php?id=1'>$fila->Titulo</a></h3>
                                <p>Fecha: $fila->FRegistro</p>";
                                //Si no tiene pais, no mostramos ese campo.
                                if(!($fila->NomPais == ""))
                                {
                                    echo "<p>País: $fila->NomPais</p>";
                                }
                            echo 
                            "</article>";
                        }
                    
                    echo
                        "</div>
                    </section>";

                    $resultado->close();

                    $conexion->close(); 
            }
            */


            include("conexionBD.php");

                    //Lo pasamos a un formato que reconozca mysqli.
                    $titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
                    $date = mysqli_real_escape_string($conexion, $_POST['date']);
                    $pais = mysqli_real_escape_string($conexion, $_POST['pais']);

                    if($titulo != "" && $date == "" && $pais == "")
                    {
                       $sentencia = "SELECT f.IdFoto, f.Fichero, f.Titulo, f.Fecha, f.Alternativo, p.NomPais FROM fotos f LEFT JOIN paises p ON f.Pais=p.IdPais WHERE f.Titulo LIKE '%$titulo%' ORDER BY f.Fecha DESC"; 
                    }
                    else
                    {
                        if($titulo == "" && $date != "" && $pais == "")
                        {
                            $sentencia = "SELECT f.IdFoto, f.Fichero, f.Titulo, f.Fecha, f.Alternativo, p.NomPais FROM fotos f LEFT JOIN paises p ON f.Pais=p.IdPais WHERE f.Fecha = '$date' ORDER BY f.Fecha DESC";
                        }
                        else
                        {
                            if($titulo == "" && $date == "" && $pais != "")
                            {
                                $sentencia = "SELECT f.IdFoto, f.Fichero, f.Titulo, f.Fecha, f.Alternativo, p.NomPais FROM fotos f LEFT JOIN paises p ON f.Pais=p.IdPais WHERE p.NomPais = '$pais' ORDER BY f.Fecha DESC";
                            }
                            else
                            {
                                if($titulo != "" && $date != "" && $pais == "")
                                {
                                    $sentencia = "SELECT f.IdFoto, f.Fichero, f.Titulo, f.Fecha, f.Alternativo, p.NomPais FROM fotos f LEFT JOIN paises p ON f.Pais=p.IdPais WHERE f.Titulo LIKE '%$titulo%' AND f.Fecha = $date ORDER BY f.Fecha DESC";
                                }
                                else
                                {
                                    if($titulo == "" && $date != "" && $pais != "")
                                    {
                                        $sentencia = "SELECT f.IdFoto, f.Fichero, f.Titulo, f.Fecha, f.Alternativo, p.NomPais FROM fotos f LEFT JOIN paises p ON f.Pais=p.IdPais WHERE f.Fecha = $date AND p.NomPais = '$pais' ORDER BY f.Fecha DESC";
                                    }
                                    else
                                    {
                                        if($titulo != "" && $date == "" && $pais != "")
                                        {
                                            $sentencia = "SELECT f.IdFoto, f.Fichero, f.Titulo, f.Fecha, f.Alternativo, p.NomPais FROM fotos f LEFT JOIN paises p ON f.Pais=p.IdPais WHERE f.Titulo LIKE '%$titulo%' AND p.NomPais = '$pais' ORDER BY f.Fecha DESC";
                                        }
                                        else
                                        {
                                            if($titulo != "" && $date != "" && $pais != "")
                                            {
                                                $sentencia = "SELECT f.IdFoto, f.Fichero, f.Titulo, f.Fecha, f.Alternativo, p.NomPais FROM fotos f LEFT JOIN paises p ON f.Pais=p.IdPais WHERE f.Titulo LIKE '%$titulo%' AND f.Fecha = $date AND p.NomPais = '$pais' ORDER BY f.Fecha DESC";
                                            }
                                            else
                                            {
                                                echo "<p style= 'text-align:center; font-size: 20px;'><b>No se encontró ninguna foto con ese filtro</b></p>";

                                                $conexion->close();
                                                exit;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    
                    if(!($resultado = $conexion->query($sentencia))) {
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $conexion->connect_error; 
                        echo '</p>'; 
                        exit;
                    }

                    //Si no se ha encontrado ninguna coincidencia en la base de datos con la busqueda.
                    if (mysqli_num_rows($resultado) == 0) {
                        echo "<p style= 'text-align:center; font-size: 20px;'><b>No se encontró ninguna foto con ese filtro</b></p>";

                        $resultado->close();

                        $conexion->close(); 
                    }

                    else
                    {
                        echo 
                        "<section>
                            <h2>Fotos</h2>
                            <div class='seccionfoto'>";

                            while($fila = $resultado->fetch_object()) {
                                 echo "<article>
                                    <a href='detalle.php?id=$fila->IdFoto'>
                                        <img width='400' src='$fila->Fichero' alt='$fila->Alternativo'>
                                    </a>
                                    <h3><a href='detalle.php?id=IdFoto'>$fila->Titulo</a></h3>
                                    <p>Fecha: $fila->Fecha</p>";
                                    //Si no tiene pais, no mostramos ese campo.
                                    if(!($fila->NomPais == ""))
                                    {
                                        echo "<p>País: $fila->NomPais</p>";
                                    }
                                echo 
                                "</article>";
                            }
                        
                        echo
                            "</div>
                        </section>";
                        $resultado->close();

                        $conexion->close(); 
                    }

            ?>
        </section>
    </main>
<?php
    require_once("footer.php");
?>