<?php
    session_start();

    $titulo = "Búsqueda - Pictures & Images";
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
                        <input type="date" name="date" id="date" class="formulario">
                    </div>

                    <div>
                        <label for="country">País:</label>
                        <input list="countries" name="pais" id="country" placeholder="Introduce tu país" class="formulario">
                        <datalist id="countries">
                            <?php
                                include("conexionBD.php");
                                require_once("paises.php");
                                $resultado->close();
                                $conexion->close();
                            ?>
                        </datalist>
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