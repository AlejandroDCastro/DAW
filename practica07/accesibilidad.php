<?php
    session_start();

    $titulo = "Accesibilidad - Pictures & Images";

    // Incluímos el head con el doctype
    require_once("head.php");

    // Incluímos la etiqueta <body> junto al header
    require_once("header.php");
?>
    <main>
        <section id="accesibilidad" class="printCentro">
            <h1>Accesibilidad</h1>
            <p><span>Pictures & Images</span> (PI) es un sitio web concienciado sobre el desarrollo de contenido accesible, con el objetivo de que nuestros usuarios puedan disfrutar de todo nuestro material y de otros usuarios, que ponemos a su disposición. Dentro de este espíritu se trabaja por tener un sitio web totalmente accesible siguiendo las pautas de accesibilidad al contenido en la web 1.0 del W3C, cumpliendo los criterios de conformidad de nivel AA, y sobretodo de nivel AAA.</p>
            <p>La página dispone de un etiquetado semántico sólido y coherente, que otorga un significado a cada objeto de la estuctura. Todas las imágenes tienen asociadas un texto alternativo asociado, junto al título y otros textos. Los colores usados permiten la visualización correcta de todos los elementos en el sitio web.</p>
            <p>Para mostrar los diferentes estilos accesibles de PI, es necesario ir a la sección de estilos definida para el navegador usado.</p>
        </section>
    </main>
<?php
    require_once("footer.php");
?>