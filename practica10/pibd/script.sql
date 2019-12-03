SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- Creamos la base de datos
drop database if exists `pibd`;
create database if not exists `pibd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
use `pibd`;


-- Creamos la tabla PAISES
drop table if exists `PAISES`;
create table `PAISES` (
    `IdPais` int not null auto_increment,
    `NomPais` text not null,
    constraint `PK_paises` primary key (`IdPais`)
) engine=MyISAM default charset=utf8 collate=utf8_general_ci;


-- Creamos la tabla ESTILOS
drop table if exists `ESTILOS`;
create table `ESTILOS` (
    `IdEstilo` int not null auto_increment,
    `Nombre` text not null,
    `Descripcion` text not null,
    `Fichero` text not null,
    constraint `PK_paises` primary key (`IdEstilo`)
) engine=MyISAM default charset=utf8 collate=utf8_general_ci;


-- Creamos la tabla USUARIOS
drop table if exists `USUARIOS`;
create table `USUARIOS` (
    `IdUsuario` int not null auto_increment,
    `NomUsuario` text(15) not null unique,
    `Clave` text(15) not null not null,
    `Email` text not null,
    `Sexo` smallint not null,
    `FNacimiento` date not null,
    `Ciudad` text not null,
    `Pais` int not null,
    `Foto` text not null,
    `FRegistro` datetime not null,
    `Estilo` int not null,
    constraint `PK_usuarios` primary key (`IdUsuario`),
    constraint `FK_Pais` foreign key (`Pais`) references `PAISES` (`IdPais`),
    constraint `FK_Estilos` foreign key (`Estilo`) references `ESTILOS` (`IdEstilo`)
) engine=MyISAM default charset=utf8 collate=utf8_general_ci;


-- Creamos la tabla ALBUMES
drop table if exists `ALBUMES`;
create table `ALBUMES` (
    `IdAlbum` int not null auto_increment,
    `Titulo` text not null,
    `Descripcion` text not null,
    `Usuario` int not null,
    constraint `PK_paises` primary key (`IdAlbum`),
    constraint `FK_Usuario` foreign key (`Usuario`) references `USUARIOS` (`IdUsuario`)
) engine=MyISAM default charset=utf8 collate=utf8_general_ci;


-- Creamos la tabla FOTOS
drop table if exists `FOTOS`;
create table `FOTOS` (
    `IdFoto` int not null auto_increment,
    `Titulo` text not null,
    `Descripcion` text not null,
    `Fecha` date,
    `Pais` int,
    `Album` int not null,
    `Fichero` text not null,
    `Alternativo` text not null,
    `FRegistro` datetime not null,
    constraint `PK_paises` primary key (`IdFoto`),
    constraint `FK_Pais2` foreign key (`Pais`) references `PAISES` (`IdPais`),
    constraint `FK_Album` foreign key (`Album`) references `ALBUMES` (`IdAlbum`)
) engine=MyISAM default charset=utf8 collate=utf8_general_ci;


-- Creamos la tabla FOTOS
drop table if exists `SOLICITUDES`;
create table `SOLICITUDES` (
    `IdSolicitud` int not null auto_increment,
    `Album` int not null,
    `Nombre` text(200) not null,
    `Titulo` text(200) not null,
    `Descripcion` text(4000) not null,
    `Email` text(200) not null,
    `Direccion` text not null,
    `Color` text not null,
    `Copias` int not null,
    `Resolucion` int not null,
    `Fecha` date not null,
    `IColor` boolean not null,
    `FRegistro` datetime not null,
    `Coste` real not null,
    constraint `PK_paises` primary key (`IdSolicitud`),
    constraint `FK_Album2` foreign key (`Album`) references `ALBUMES` (`IdAlbum`)
) engine=MyISAM default charset=utf8 collate=utf8_general_ci;



-- Insertamos datos en PAISES
insert into `PAISES` (`NomPais`) values ("Afganistán"),
("Albania"), ("Alemania"), ("Andorra"), ("Angola"), ("Antigua y Barbuda"),
("Arabia Saudita"), ("Argelia"), ("Argentina"), ("Armenia"), ("Australia"),
("Austria"), ("Azerbaiyán"), ("Bahamas"), ("Bangladés"), ("Barbados"),
("Baréin"), ("Bélgica"), ("Belice"), ("Benín"), ("Bielorrusia"),
("Birmania"), ("Bolivia"), ("Bosnia y Herzegovina"), ("Botsuana"), ("Brasil"),
("Brunéi"), ("Bulgaria"), ("Burkina Faso"), ("Burundi"), ("Bután"),
("Cabo Verde"), ("Camboya"), ("Camerún"), ("Canadá"), ("Catar"),
("Chad"), ("Chile"), ("China"), ("Chipre"), ("Ciudad del Vaticano"),
("Colombia"), ("Comoras"), ("Corea del Norte"), ("Corea del Sur"), ("Costa de Marfil"),
("Costa Rica"), ("Croacia"), ("Cuba"), ("Dinamarca"), ("Dominica"),
("Ecuador"), ("Egipto"), ("El Salvador"), ("Emiratos Árabes Unidos"), ("Eritrea"),
("Eslovaquia"), ("Eslovenia"), ("España"), ("Estados Unidos"), ("Estonia"),
("Etiopía"), ("Filipinas"), ("Finlandia"), ("Fiyi"), ("Francia"),
("Gabón"), ("Gambia"), ("Georgia"), ("Ghana"), ("Granada"),
("Grecia"), ("Guatemala"), ("Guyana"), ("Guinea"), ("Guinea ecuatorial"),
("Guinea-Bisáu"), ("Haití"), ("Honduras"), ("Hungría"), ("India"),
("Indonesia"), ("Irak"), ("Irán"), ("Irlanda"), ("Islandia"),
("Islas Marshall"), ("Islas Salomón"), ("Israel"), ("Italia"), ("Jamaica"),
("Japón"), ("Jordania"), ("Kazajistán"), ("Kenia"), ("Kirguistán"),
("Kiribati"), ("Kuwait"), ("Laos"), ("Lesoto"), ("Letonia"),
("Líbano"), ("Liberia"), ("Libia"), ("Liechtenstein"), ("Lituania"),
("Luxemburgo"), ("Macedonia del Norte"), ("Madagascar"), ("Malasia"), ("Malaui"),
("Maldivas"), ("Malí"), ("Malta"), ("Marruecos"), ("Mauricio"),
("Mauritania"), ("México"), ("Micronesia"), ("Moldavia"), ("Mónaco"),
("Mongolia"), ("Montenegro"), ("Mozambique"), ("Namibia"), ("Nauru"),
("Nepal"), ("Nicaragua"), ("Níger"), ("Nigeria"), ("Noruega"),
("Nueva Zelanda"), ("Omán"), ("Países Bajos"), ("Pakistán"), ("Palaos"),
("Panamá"), ("Papúa Nueva Guinea"), ("Paraguay"), ("Perú"), ("Polonia"),
("Portugal"), ("Reino Unido"), ("República Centroafricana"), ("República Checa"), ("República del Congo"),
("República Democrática del Congo"), ("República Dominicana"), ("República Sudafricana"), ("Ruanda"), ("Rumanía"),
("Rusia"), ("Samoa"), ("San Cristóbal y Nieves"), ("San Marino"), ("San Vicente y las Granadinas"),
("Santa Lucía"), ("Santo Tomé y Príncipe"), ("Senegal"), ("Serbia"), ("Seychelles"),
("Sierra Leona"), ("Singapur"), ("Siria"), ("Somalia"), ("Sri Lanka"),
("Suazilandia"), ("Sudán"), ("Sudán del Sur"), ("Suecia"), ("Suiza"),
("Surinam"), ("Tailandia"), ("Tanzania"), ("Tayikistán"), ("Timor Oriental"),
("Togo"), ("Tonga"), ("Trinidad y Tobago"), ("Túnez"), ("Turkmenistán"),
("Turquía"), ("Tuvalu"), ("Ucrania"), ("Uganda"), ("Uruguay"),
("Uzbekistán"), ("Vanuatu"), ("Venezuela"), ("Vietnam"), ("Yemen"),
("Yibuti"), ("Zambia"), ("Zimbabue");



-- Insertamos datos en ESTILOS
insert into `ESTILOS` (`Nombre`, `Descripcion`, `Fichero`) values
("Estilo Base", "Estilo estándar de la página web.", "css/style.css"),
("Letra Grande", "Incrementa el tamaño de las letras para mejorar la accesibilidad en ciertos grupos de personas.", "css/letraGrande.css"),
("Alto Contraste", "Utiliza colores con un mayor índice de contraste para mejorar la accesibilidad en ciertos grupos de personas, en concreto, el amarillo, el blanco, y el negro.", "css/altoContraste.css"),
("Letra Grande y Alto Contraste", "Utiliza un mayor tamaño de letra y colores con un mayor índice de contraste para mejorar la accesibilidad en ciertos grupos de personas", "css/combinado.css");


-- Insertamos datos en USUARIOS
insert into `USUARIOS` (`NomUsuario`, `Clave`, `Email`, `Sexo`, `FNacimiento`, `Ciudad`, `Pais`, `Foto`, `FRegistro`, `Estilo`) values
("Mateo", "hola", "mateo.31@outlook.es", 0, str_to_date("10/12/1996", "%d/%m/%Y"), "Cartagena", 35, "Images/Mateo.jpg", str_to_date("04/07/2009 20:00:38", "%d/%m/%Y %H:%i:%S"), 1),
("Marcos", "adios", "marquitos@outlook.com", 0, str_to_date("21/10/1990", "%d/%m/%Y"), "Moztalia", 103, "Images/Marcos.jpg", str_to_date("14/02/2016 10:45:02", "%d/%m/%Y %H:%i:%S"), 2),
("Sofía", "topota20", "sofiiii@gmail.com", 1, str_to_date("16/05/2001", "%d/%m/%Y"), "Cancatona", 67, "Images/sofia.jpg", str_to_date("01/04/2019 05:30:30", "%d/%m/%Y %H:%i:%S"), 3),
("Tamara", "Torrecillas", "tamarina@gmail.com", 1, str_to_date("25/12/1997", "%d/%m/%Y"), "Yuman", 110, "Images/tamara.jpg", str_to_date("09/03/2017 23:53:01", "%d/%m/%Y %H:%i:%S"), 4);


-- Insertamos datos en ALBUMES
insert into `ALBUMES` (`Titulo`, `Descripcion`, `Usuario`) values
("FDG", "Fotos para la asignatura de Fundamentos del Diseño Gráfico del grado de Ingeniería Multimedia.", 1),
("Viaje Londres", "Fotos sacadas en el viaje a Londres que nunca existió.", 3);


-- Insertamos datos en FOTOS
insert into `FOTOS` (`Titulo`, `Descripcion`, `Fecha`, `Pais`, `Album`, `Fichero`, `Alternativo`, `FRegistro`) values
("Porque los árboles no dan Wi-Fi", "Árbol sin hojas desnutrido para hacer entender la situación forestal.", str_to_date("14/01/2007", "%d/%m/%Y"), 44, 1, "Images/arbol.jpg", "Árbol sin hojas desnutrido", str_to_date("12/03/2018 22:53:01", "%d/%m/%Y %H:%i:%S")),
("Gallinas que no sufren", "Gallinas bien cuidadas no estresadas que ponen huevos sanos.", str_to_date("20/09/2015", "%d/%m/%Y"), 5, 2, "Images/gallina.jpg", "Gallina con pico muy sana", str_to_date("01/01/2019 13:50:20", "%d/%m/%Y %H:%i:%S")),
("Cuando veo a mi crush", "Normalmente se nos acelera el cora si vemos a nuestra crush pero yo normalmente hago el burro.", str_to_date("28/06/2004", "%d/%m/%Y"), 150, 1, "Images/burro.jpg", "Burro haciendo el burro", str_to_date("25/12/2019 20:53:01", "%d/%m/%Y %H:%i:%S"));
insert into `FOTOS` (`Titulo`, `Descripcion`, `Album`, `Fichero`, `Alternativo`, `FRegistro`) values
("A estudiar que ya es hora", "¿Alguien podría explicar porque estudiamos tanto y suspendemos aún así?", 2, "Images/estudiante.jpg", "Estudiante desmotivada", str_to_date("12/03/2018 22:53:01", "%d/%m/%Y %H:%i:%S")),
("Ilusión infinita", "Genjutsu usado por Alejandro Uchiha, igual de poderoso que el Kotoamatsukami de Shisui.", 1, "Images/synth.jpg", "Luna llena bajo mundo virtual", str_to_date("11/06/2017 18:15:00", "%d/%m/%Y %H:%i:%S"));


-- Insertamos datos para SOLICITUDES
insert into `SOLICITUDES` (`Album`, `Nombre`, `Titulo`, `Descripcion`, `Email`, `Direccion`, `Color`, `Copias`, `Resolucion`, `Fecha`, `IColor`, `FRegistro`, `Coste`) values
(1, "Mateo Gorgonzola Miagra", "Mis trabajos de FBD", "blablablablablabla Javier Esclapés blablabalbablablalblablalbalbal", "mateo.31@outlook.com", "C/Rey de España Nº13", "#f3f3f3", 3, 300, str_to_date("28/11/2019", "%d/%m/%Y"), true, str_to_date("12/03/2018 22:53:01", "%d/%m/%Y %H:%i:%S"), 13.5),
(2, "Tamara Torrecillas", "London Vibes", "blablablablablabla Londres es genial blablabalbablablalblablalbalbal", "tamarina@gmail.com", "C/Lorzas Nº3 Piso 2", "#000", 1, 750, str_to_date("05/01/2020", "%d/%m/%Y"), false, str_to_date("11/06/2019 18:15:00", "%d/%m/%Y %H:%i:%S"), 3.87);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;