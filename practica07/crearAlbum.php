<!DOCTYPE html> <!-- Especificación para indicar que la página está escrita en HTML5 -->
<html lang="es"> <!-- Idioma Español -->
<head>
    <meta charset="UTF-8">
    <meta name="generator" content="Visual Studio Code">
    <meta name="author" content="Alejandro Castro Valero">
    <meta name="author" content="Gabriel Martínez Antón">
    <meta name="keywords" content="HTML5, web, picture, image">
    <meta name="description" content="Página de registro de nuevo usuario para la web PI - Pictures & Images">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print"/>
    <link rel="alternate stylesheet" href="css/letraGrande.css" title="Letra Grande">
    <link rel="alternate stylesheet" href="css/altoContraste.css" title="Alto Contraste">
    <link rel="alternate stylesheet" href="css/combinado.css" title="Letra Grande y Alto Contraste">
    <link rel="shortcut icon" href="Images/logotipo2.png" type="image/png">
    <script src="js/script.js"></script>
    <title>PI - Registro</title>
</head>
<body>

    <!-- CABECERA: Logotipo, Título web y Barra de navegación -->
    <header id="cabecera">
        <figure>
            <a href="index.html">
                <img width="250" src="Images/logotipo.png" alt="Logotipo de PI">
                <img src="Images/logotipo2.png" alt="Logotipo de PI">
            </a>
        </figure>
        <div><a href="index.html">PI - Pictures & Images</a></div>
        <nav>
            <ul>
                <li><a href="index.html"><i class="icon-home"></i>Inicio</a></li>
                <li><a href="busqueda.html"><i class="icon-search"></i>Búsqueda</a></li>
                <li><a href="registro.html"><i class="icon-wpforms"></i>Registro</a></li>
            </ul>
        </nav>
        <p><a href="accesibilidad.html">Accesibilidad</a></p>
        <select>
            <option value="Estilo Base">Estilo Base</option>
            <option value="Letra Grande">Letra Grande</option>
            <option value="Alto Contraste">Alto Contraste</option>
            <option value="Letra Grande y Alto Contraste">Letra Grande y Alto Contraste</option>
        </select>
    </header>

    <!-- CONTENIDO: Título contenido, Formulario -->
    <main>
        <section>
            <h1>Registro de Usuario</h1>
            <form id="formulario" method="POST" action="perfil.php">
                <div>
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" placeholder="Introduce el título" class="formulario">
                </div>
                <div>
                    <label for="desc">Descripción:</label>
                    <input type="text" id="desc" placeholder="Introduce la descripción" class="formulario">
                </div>
                <div>
                    <input type="submit" value="Enviar">
                </div>
            </form>
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