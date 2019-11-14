<?php

    // Incluímos el head con el doctype
    require_once("head.php");

    // Incluímos la etiqueta <body> junto al header
    require_once("header.php");
?>
<main>
    <section>
        <h1>Inicio</h1>
        
        <!-- Formulario para acceder como usuario registrado -->
        <section id="formini">
            <h2>Inicia Sesión</h2>
            <form action="indexconreg.html" method="POST">
                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" placeholder="Introduce tu nombre">

                <label for="pass">Contraseña: </label>
                <input type="password" id="pass" placeholder="Introduce tu contraseña">

                <input type="submit" value="Entrar">
            </form>
            <p>¿Aún no te has registrado? <a href="registro.html">Regístrate</a></p>
        </section>

        <!-- Carga las últimas 5 fotos -->
        <section>
            <h2>Últimas Fotos</h2>
            <div class="seccionfoto">
                <article>
                    <a href="detalle.html">
                        <img width="400" src="Images/arbol.jpg" alt="Arbol">
                    </a>
                    <h3><a href="detalle.html">Porque los árboles no dan Wi-Fi</a></h3>
                    <p>Fecha: 15-01-2018 20:55</p>
                    <p>Autor: Kevin Serna García</p>
                    <p>País: España</p>
                </article>
                <article>
                    <a href="detalle.html">
                        <img width="400" src="Images/gallina.jpg" alt="Gallina">
                    </a>
                    <h3><a href="detalle.html">Gallinas que no sufren</a></h3>
                    <p>Fecha: 01-05-2019 15:34</p>
                    <p>Autor: Miguel Hernández</p>
                    <p>País: Suiza</p>
                </article>
                <article>
                    <a href="detalle.html">
                        <img width="400" src="Images/burro.jpg" alt="Burro">
                    </a>
                    <h3><a href="detalle.html">Cuando veo a mi crush</a></h3>
                    <p>Fecha: 27-02-2017 23:00</p>
                    <p>Autor: José Manuel García Baeza</p>
                    <p>País: Argentina</p>
                </article>
                <article>
                    <a href="detalle.html">
                        <img width="400" src="Images/estudiante.jpg" alt="Estudiante">
                    </a>
                    <h3><a href="detalle.html">A estudiar que ya es hora</a></h3>
                    <p>Fecha: 02-08-2017 10:30</p>
                    <p>Autor: Pedro Sánchez</p>
                    <p>País: Andorra</p>
                </article>
                <article>
                    <a href="detalle.html">
                        <img width="400" src="Images/synth.jpg" alt="Synth">
                    </a>
                    <h3><a href="detalle.html">Ilusión infinita</a></h3>
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