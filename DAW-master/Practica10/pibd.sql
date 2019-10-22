-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2018 a las 19:05:44
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pibd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

CREATE TABLE `albumes` (
  `IdAlbum` int(100) NOT NULL,
  `Titulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` varchar(10000) COLLATE utf8_spanish_ci NOT NULL,
  `Usuario` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`IdAlbum`, `Titulo`, `Descripcion`, `Usuario`) VALUES
(1, 'Album de prueba', 'Lorem ipsum dolor sit amet consectetur adipiscing elit, sapien morbi vivamus a dis. Sapien hac ridiculus quisque turpis sollicitudin suspendisse tortor, senectus cum sociosqu tempus bibendum.', 1),
(2, 'Album2', 'Lorem ipsum dolor sit amet consectetur adipiscing elit, sapien morbi vivamus a dis. Sapien hac ridiculus quisque turpis sollicitudin suspendisse tortor, senectus cum sociosqu tempus bibendum.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilos`
--

CREATE TABLE `estilos` (
  `IdEstilo` int(100) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Fichero` varchar(300) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estilos`
--

INSERT INTO `estilos` (`IdEstilo`, `Nombre`, `Descripcion`, `Fichero`) VALUES
(1, 'Estilo responsive', 'Estilo por defecto de la web', 'head.php'),
(2, 'Estilo alto contraste', 'Estilo pra personas con problemas visuales', 'headAltoContraste.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `IdFoto` int(100) NOT NULL,
  `Titulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` varchar(10000) COLLATE utf8_spanish_ci NOT NULL,
  `Fecha` date NOT NULL,
  `Pais` int(100) DEFAULT NULL,
  `Album` int(100) NOT NULL,
  `Fichero` varchar(3000) COLLATE utf8_spanish_ci NOT NULL,
  `Alternativo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `FRegistro` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`IdFoto`, `Titulo`, `Descripcion`, `Fecha`, `Pais`, `Album`, `Fichero`, `Alternativo`, `FRegistro`) VALUES
(1, 'foto prueba', 'descripcion de prueba', '2018-11-07', 1, 1, 'i1.jpeg', 'alternativo de ejemplo', '16:00:00'),
(2, 'foto prueba 2', 'descripcion prueba 2', '2018-09-23', 2, 1, 'i2.jpeg', 'texto alternativo 2', '19:29:00'),
(3, 'foto prueba 3', 'descripcion prueba 3', '2018-11-23', 2, 1, 'i3.jpeg', 'texto alternativo 3', '19:29:00'),
(4, 'foto prueba 4', 'descripcion prueba 4', '2018-11-12', 1, 2, 'i4.jpeg', 'texto alternativo 4', '00:08:00'),
(5, 'foto prueba 5', 'descripcion prueba 5', '2018-11-12', 1, 2, 'i5.jpeg', 'texto alternativo 5', '00:08:00'),
(6, 'foto prueba 6', 'descripcion prueba 6', '2018-11-22', 2, 1, 'i6.jpeg', 'texto alternativo foto 6', '09:11:20'),
(7, 'foto prueba 7', 'descripcion prueba 7', '2018-11-22', 2, 2, 'i18.jpeg', 'texto alternativo foto 7', '09:11:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `IdPais` int(255) NOT NULL,
  `NomPais` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`IdPais`, `NomPais`) VALUES
(1, 'España'),
(2, 'Francia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `IdSolicitud` int(255) NOT NULL,
  `Album` int(255) NOT NULL,
  `Nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Titulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` varchar(4000) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `Color` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Copias` int(255) NOT NULL,
  `Resolucion` int(255) NOT NULL,
  `Fecha` date NOT NULL,
  `IColor` tinyint(1) NOT NULL,
  `FRegistro` time NOT NULL,
  `Coste` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(100) NOT NULL,
  `NomUsuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Clave` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Sexo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `FNacimiento` date NOT NULL,
  `Ciudad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Pais` int(100) NOT NULL,
  `Foto` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `FRegistro` time NOT NULL,
  `Estilo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `NomUsuario`, `Clave`, `Email`, `Sexo`, `FNacimiento`, `Ciudad`, `Pais`, `Foto`, `FRegistro`, `Estilo`) VALUES
(1, 'usuario1', 'usuario1', 'usuario1@gmail.com', 'hombre', '2018-11-01', 'Alicante', 1, 'usuario1.jpg', '12:07:00', 1),
(2, 'usuario2', 'usuario2', 'usuario2@gmail.com', 'hombre', '2018-11-02', 'Zaragoza', 2, 'usuario2.jpg', '12:07:00', 2),
(3, 'usuario3', 'usuario3', 'usuario3@gmail.com', 'otro', '1111-11-11', 'Alicante', 1, 'usuario3.jpg', '00:00:00', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`IdAlbum`),
  ADD KEY `Usuario_id` (`Usuario`);

--
-- Indices de la tabla `estilos`
--
ALTER TABLE `estilos`
  ADD PRIMARY KEY (`IdEstilo`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`IdFoto`),
  ADD KEY `Pais_id` (`Pais`),
  ADD KEY `Album_id` (`Album`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`IdPais`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`IdSolicitud`),
  ADD KEY `Album_id` (`Album`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `u_nomusuario` (`NomUsuario`),
  ADD KEY `Pais_id` (`Pais`),
  ADD KEY `Estilo_id` (`Estilo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albumes`
--
ALTER TABLE `albumes`
  MODIFY `IdAlbum` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estilos`
--
ALTER TABLE `estilos`
  MODIFY `IdEstilo` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `IdFoto` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `IdPais` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `IdSolicitud` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
