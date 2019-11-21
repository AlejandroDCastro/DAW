<?php
     $titulo = "Resultado";
    // Incluímos el head con el doctype
    require_once("head.php");

    // Incluímos la etiqueta <body> junto al header
    require_once("headersinreg.php");
?>
    <main>
        <section>
            <h1>Resultado de búsqueda</h1>

            <?php

                //Mostramos lo que el usuario a introducido con el formulario de busqueda
                $titulo = $_POST['titulo'];
                $fecha = $_POST['fecha'];
                $pais = $_POST['pais'];
                $autor = $_POST['autor'];

                echo "<h2 style='text-align:center'>Filtrado por:</h2><br>";

                //Si ha rellenado un campo en busqueda, lo mostramos aqui.

                if($titulo != "")
                {
                   echo "<p style='text-align:center; font-size: 20px'><b>Título:</b> $titulo</p>";
                }
                if($fecha != "")
                {
                   echo "<p style='text-align:center; font-size: 20px'><b>Fecha:</b> $fecha</p>";
                }
                if($pais != "")
                {
                   echo "<p style='text-align:center; font-size: 20px'><b>País:</b> $pais</p>";
                }
                if($autor != "")
                {
                   echo "<p style='text-align:center; font-size: 20px'><b>Autor:</b> $autor</p>";
                }
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

            <!-- Carga las últimas 5 fotos -->
            <section>
                <h2>Fotos</h2>
                <div class="seccionfoto">
                    <article>
                    <a href="detalle.php?id=1">
                        <img width="400" src="Images/arbol.jpg" alt="Arbol">
                    </a>
                    <h3><a href="detalle.php?id=1">Porque los árboles no dan Wi-Fi</a></h3>
                    <p>Fecha: 15-01-2018 20:55</p>
                    <p>Autor: Kevin Serna García</p>
                    <p>País: España</p>
                </article>
                <article>
                    <a href="detalle.php?id=2">
                        <img width="400" src="Images/gallina.jpg" alt="Gallina">
                    </a>
                    <h3><a href="detalle.php?id=2">Gallinas que no sufren</a></h3>
                    <p>Fecha: 01-05-2019 15:34</p>
                    <p>Autor: Miguel Hernández</p>
                    <p>País: Suiza</p>
                </article>
                <article>
                    <a href="detalle.php?id=3">
                        <img width="400" src="Images/burro.jpg" alt="Burro">
                    </a>
                    <h3><a href="detalle.php?id=3">Cuando veo a mi crush</a></h3>
                    <p>Fecha: 27-02-2017 23:00</p>
                    <p>Autor: José Manuel García Baeza</p>
                    <p>País: Argentina</p>
                </article>
                <article>
                    <a href="detalle.php?id=4">
                        <img width="400" src="Images/estudiante.jpg" alt="Estudiante">
                    </a>
                    <h3><a href="detalle.php?id=4">A estudiar que ya es hora</a></h3>
                    <p>Fecha: 02-08-2017 10:30</p>
                    <p>Autor: Pedro Sánchez</p>
                    <p>País: Andorra</p>
                </article>
                <article>
                    <a href="detalle.php?id=5">
                        <img width="400" src="Images/synth.jpg" alt="Synth">
                    </a>
                    <h3><a href="detalle.php?id=5">Ilusión infinita</a></h3>
                    <p>Fecha: 20-12-2016 00:55</p>
                    <p>Autor: Albert Rivera</p>
                    <p>País: Chile</p>
                </article>
                </div>
            </section>
        </section>
    </main>
<?php
    require_once("footer.php");
?>