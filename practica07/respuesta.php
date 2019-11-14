<?php

    // Incluímos el head con el doctype
    require_once("head.php");

    // Incluímos la etiqueta <body> junto al header
    require_once("header.php");
?>

<main>
    <section>
        <h1>Confirmación de solicitud</h1>
        <section class="printCentro">
            <h2>Se registrado correctamente la solicitud de tu álbum.</h2>
            <h3>Coste total del álbum: 8.50 €</h3>
            <ul>
                <li><b>Nombre</b>: Alexander Caster</li>
                <li><b>Título del álbum</b>: Mi loco viaje a Madagascar</li>
                <li><b>Correo electrónico</b>: alexandercaster@outlook.es</li>
                <li><b>Dirección</b>: C/ Virgen del Rosario Nº4 03350 Novelda, Alicante, España</li>
                <li><b>Álbum</b>: Álbum 1</li>
            </ul>

            <a href="perfil.html">Aceptar</a>
        </section>
    </section>
</main>

<?php
    require_once("footer.php");
?>