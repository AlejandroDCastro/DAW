<?php
    $titulo = "Detalle";
    // Incluímos el head con el doctype
    require_once("head.php");

    // Incluímos la etiqueta <body> junto al header
    require_once("headersinreg.php");

    //Obtenemos el id que nos pasan por parametro
    $id = $_GET['id'];
    //Convertimos la id de String a entero
    $id = (int) $id;

    //Dependiendo de si sale un numero par, la foto cambiara.
    if($id%2==0)
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
    }
 
    require_once("footer.php");
?>