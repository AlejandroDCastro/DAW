<?php
    $titulo = "Busqueda";
    // Incluímos el head con el doctype
    require_once("head.php");

    // Incluímos la etiqueta <body> junto al header
    require_once("headersinreg.php");
?>
    <!-- CONTENIDO: Título contenido, Formulario -->
    <main>
        <section>
            <h1>Búsqueda de Foto</h1>
            <div class="printCentro">
                <form action="resultado.php" id="formulario" method="POST">
                    <div>
                        <label for="title">Título:</label>
                        <input type="text" name="titulo" id="title" placeholder="Introduce el título" class="formulario">
                    </div>

                    <div>
                        <label for="date">Fecha:</label>
                        <input type="date" name="fecha" id="date" class="formulario">
                    </div>

                    <div>
                        <label for="country">País:</label>
                        <input list="countries" name="pais" id="country" placeholder="Introduce tu país" class="formulario">
                        <datalist id="countries">
                            <?php
                                require_once("paises.php");
                            ?>
                        </datalist>
                    </div>
                    <div>
                        <label for="author">Autor:</label>
                        <input type="text" name="autor" id="author" placeholder="Introduce el autor" class="formulario">
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