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

        //Convertimos la id de String a entero
        $id = (int) $id;

        
        

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