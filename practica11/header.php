<body>
    <header id="cabecera">
        <figure>
            <a href="index.php">
                <img width="250" src="Images/Fotos/logotipo.png" alt="Logotipo de PI">
                <img src="Images/Fotos/logotipo2.png" alt="Logotipo de PI">
            </a>
        </figure>
        <div><a href="index.php">PI - Pictures & Images</a></div>
        <nav>
            <ul>
                <li><a href="index.php"><i class="icon-home"></i>Inicio</a></li>
                <li><a href="busqueda.php"><i class="icon-search"></i>Búsqueda</a></li>

                <?php

                    if (isset($_SESSION["logueado"])) {
                        echo '<li><a href="perfil.php"><i class="icon-user"></i>Perfil</a></li>
                            <li><a href="salir.php"><i class="icon-logout"></i>Salir</a></li>';
                    } else {
                        echo '<li><a href="registro.php"><i class="icon-wpforms"></i>Registro</a></li>';
                    }

                ?>
                
            </ul>
        </nav>
        <p><a href="accesibilidad.php">Accesibilidad</a></p>
    </header>