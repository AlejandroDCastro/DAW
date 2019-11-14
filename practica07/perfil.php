<?php

    // Incluímos el head con el doctype
    require_once("head.php");

    // Incluímos la etiqueta <body> junto al header
    require_once("header.php");
?>

<main>
    <section>
        <h1>Perfil de usuario</h1>
        <section class="printCentro">
            <h2>Alexander Caster</h2>
            <a href="">Mis datos</a>
            <a href="">Darme de baja</a>
            <a href="">Mis álbumes</a>
            <a href="crearAlbum.php">Crear álbum</a>
            <a href="solicitud.html">Solicitar album</a>
            <a href="index.html">Salir</a>
        </section>
    </section>
</main>

<?php
    require_once("footer.php");
?>