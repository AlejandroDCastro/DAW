<?php
    $titulo = "Confirmar solicitud - Pictures & Images";

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
            <?php
                $nombre = $_POST["nombre"];
                $titulo = $_POST["titulo"];
                $texto = $_POST["texto"];
                $email = $_POST["email"];
                $copias = $_POST["copias"];
                $resolucion = $_POST["resolucion"];

                $numero_paginas_ = 8;
                $numero_fotos_ = 15;
                $precio_pagina_;
                $precio_;

                if ($numero_paginas_ >= 5  &&  $numero_paginas_ <= 11) {
                    $precio_pagina_ = 0.08;
                } elseif ($numero_paginas_ > 11) {
                    $precio_pagina_ = 0.07;
                } else {
                    $precio_pagina_ = 0.10;
                }
                $precio_ = $precio_pagina_*$numero_paginas_;

                // isset determina si la variable esta definida o es null
                if (isset($_POST["impresion"])  &&  $_POST["impresion"] == "1") {
                    $precio_ += 0.05*$numero_fotos_;
                }

                if ($resolucion == "450"  ||  $resolucion == "600"  ||  $resolucion == "750"  ||  $resolucion == "900") {
                    $precio_ += 0.02*$numero_fotos_;
                }

                $precio_ *= $copias;

                echo '<h3>Coste total del álbum: ', $precio_, '€</h3>';
                echo '<ul>';
                echo '<li><b>Nombre</b>: ', $nombre, '</li>';
                echo '<li><b>Correo electrónico</b>: ', $email, '</li>';
                echo '<li><b>Título del álbum</b>: ', $titulo, '</li>';
                echo '<li><b>Texto adicional</b>: ', $texto, '</li>';
                echo '<li><b>Resolución</b>: ', $resolucion, ' dpi</li>';
                echo '<li><b>Número de copias</b>: ', $copias, '</li>';
                echo '</ul>';

            ?>
           <!-- <ul>
                <li><b>Nombre</b>: Alexander Caster</li>
                <li><b>Título del álbum</b>: Mi loco viaje a Madagascar</li>
                <li><b>Correo electrónico</b>: alexandercaster@outlook.es</li>
                <li><b>Dirección</b>: C/ Virgen del Rosario Nº4 03350 Novelda, Alicante, España</li>
                <li><b>Álbum</b>: Álbum 1</li>
            </ul>-->

            <a href="perfil.php">Aceptar</a>
        </section>
    </section>
</main>

<?php
    require_once("footer.php");
?>