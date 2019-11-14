<!DOCTYPE html> <!-- Especificación para indicar que la página está escrita en HTML5 -->
<html lang="es"> <!-- Idioma Español -->
<head>
    <meta charset="UTF-8">
    <meta name="generator" content="Sublime Text 3">
    <meta name="author" content="Alejandro Castro Valero">
    <meta name="author" content="Gabriel Martínez Antón">
    <meta name="keywords" content="HTML5, web, picture, image">
    <meta name="description" content="Página inicial para la web PI - Pictures & Images">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print"/>
    <link rel="alternate stylesheet" href="css/letraGrande.css" title="Letra Grande">
    <link rel="alternate stylesheet" href="css/altoContraste.css" title="Alto Contraste">
    <link rel="alternate stylesheet" href="css/combinado.css" title="Letra Grande y Alto Contraste">
    <link rel="shortcut icon" href="Images/logotipo2.png" type="image/png">
    <script src="js/script.js"></script>
    <title>PI - Pictures & Images</title>
</head>
<body>
    <header id="cabecera">
        <figure>
            <a href="indexconreg.php">
                <img width="250" src="Images/logotipo.png" alt="Logotipo de PI">
                <img src="Images/logotipo2.png" alt="Logotipo de PI">
            </a>
        </figure>
        <div><a href="index.php">PI - Pictures & Images</a></div>
        <nav>
            <ul>
                <li><a href="indexconreg.php"><i class="icon-home"></i>Inicio</a></li>
                <li><a href="busqueda.php"><i class="icon-search"></i>Búsqueda</a></li>
                <li><a href="perfil.php"><i class="icon-user"></i>Perfil</a></li>
                <li><a href="index.php"><i class="icon-logout"></i>Salir</a></li>
            </ul>
        </nav>
        <p><a href="accesibilidad.php">Accesibilidad</a></p>
        <select>
            <option value="Estilo Base">Estilo Base</option>
            <option value="Letra Grande">Letra Grande</option>
            <option value="Alto Contraste">Alto Contraste</option>
            <option value="Letra Grande y Alto Contraste">Letra Grande y Alto Contraste</option>
        </select>
    </header>
    <main>
        <section>
            <h1>Inicio</h1>

            <!-- Carga las últimas 5 fotos -->
            <section>
                <h2>Últimas Fotos</h2>
                <div class="seccionfoto">
                    <article>
                        <a href="detalle.php">
                            <img width="400" src="Images/arbol.jpg" alt="Arbol">
                        </a>
                        <h3><a href="detalle.php">Porque los árboles no dan Wi-Fi</a></h3>
                        <p>Fecha: 15-01-2018 20:55</p>
                        <p>Autor: Kevin Serna García</p>
                        <p>País: España</p>
                    </article>
                    <article>
                        <a href="detalle.php">
                            <img width="400" src="Images/gallina.jpg" alt="Gallina">
                        </a>
                        <h3><a href="detalle.php">Gallinas que no sufren</a></h3>
                        <p>Fecha: 01-05-2019 15:34</p>
                        <p>Autor: Miguel Hernández</p>
                        <p>País: Suiza</p>
                    </article>
                    <article>
                        <a href="detalle.php">
                            <img width="400" src="Images/burro.jpg" alt="Burro">
                        </a>
                        <h3><a href="detalle.php">Cuando veo a mi crush</a></h3>
                        <p>Fecha: 27-02-2017 23:00</p>
                        <p>Autor: José Manuel García Baeza</p>
                        <p>País: Argentina</p>
                    </article>
                    <article>
                        <a href="detalle.php">
                            <img width="400" src="Images/estudiante.jpg" alt="Estudiante">
                        </a>
                        <h3><a href="detalle.php">A estudiar que ya es hora</a></h3>
                        <p>Fecha: 02-08-2017 10:30</p>
                        <p>Autor: Pedro Sánchez</p>
                        <p>País: Andorra</p>
                    </article>
                    <article>
                        <a href="detalle.php">
                            <img width="400" src="Images/synth.jpg" alt="Synth">
                        </a>
                        <h3><a href="detalle.php">Ilusión infinita</a></h3>
                        <p>Fecha: 20-12-2016 00:55</p>
                        <p>Autor: Albert Rivera</p>
                        <p>País: Chile</p>
                    </article>
                </div>
            </section>
        </section>
    </main>
    <!-- PIE DE PÁGINA: Autores, Copyright, Enlace al comienzo de la página -->
    <footer>
        <p>Alejandro Castro Valero<br>Gabriel Martínez Antón</p>
        <p>© 2019 PI</p>
        <a href="#cabecera">Volver arriba</a>
    </footer>
</body>
</html>