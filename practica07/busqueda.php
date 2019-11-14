<?php

    // Incluímos el head con el doctype
    require_once("head.php");

    // Incluímos la etiqueta <body> junto al header
    require_once("header.php");
?>

<!-- CONTENIDO: Título contenido, Formulario -->
    <main>
        <section>
            <h1>Búsqueda de Foto</h1>
            <div class="printCentro">
                <form action="resultado.html" id="formulario" method="POST">
                    <div>
                        <label for="title">Título:</label>
                        <input type="text" id="title" placeholder="Introduce el título" class="formulario">
                    </div>

                    <div>
                        <label for="date">Fecha:</label>
                        <input type="date" id="date" class="formulario">
                    </div>

                    <div>
                        <label for="country">País:</label>
                        <input list="countries" id="country" placeholder="Introduce tu país" class="formulario">
                        <datalist id="countries">
                            <?php
                                require_once("paises.php");
                            ?>
                        </datalist>
                    </div>
                    <div>
                        <label for="author">Autor:</label>
                        <input type="text" id="author" placeholder="Introduce el autor" class="formulario">
                    </div>
                    <div>
                        <input type="submit" value="Buscar">
                    </div>
                </form>
            </div>
        </section>
    </main>

<?php
    require_once("footer.php");
?>