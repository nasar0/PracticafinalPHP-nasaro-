-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-02-2025 a las 08:43:36
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `id_amigo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `amigos`
--

INSERT INTO `amigos` (`id_amigo`, `id_usuario`, `nombre`, `apellido`, `fecha_nacimiento`) VALUES
(1, 1, 'Luis', 'Martinez', '2000-09-03'),
(2, 1, 'Ana', 'García', '1992-11-22'),
(3, 2, 'Carlos', 'López', '1988-03-09'),
(4, 3, 'Sofía', 'Hernández', '1995-07-30'),
(5, 4, 'Diego', 'Torres', '1993-12-17'),
(6, 1, 'angel', 'Martinez', '2010-01-02'),
(20, 2, 'MAnue', 'Martinez', '2025-01-30'),
(21, 2, '1', 'Martinez', '2025-02-02'),
(22, 2, '2', '2', '2025-02-04'),
(23, 2, '3', '3', '2025-01-29'),
(24, 2, 'jaled', '4', '2025-01-27'),
(25, 0, '3', 'el kaboussi', '2025-02-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id_juego` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `plataforma` varchar(255) NOT NULL,
  `anio_lanzamiento` year(4) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id_juego`, `id_usuario`, `titulo`, `plataforma`, `anio_lanzamiento`, `foto`) VALUES
(1, 1, 'The Legend of Zelda: Breath of the Wild', 'Nintendo Switch', '2017', 'zelda.jpg'),
(2, 2, 'The Witcher 3: Wild Hunt', 'PC,PlayStation4,3,5 y Xbox', '2015', '.jpg'),
(3, 2, 'God of War', 'PlayStation 4', '2018', 'gow.jpg'),
(4, 3, 'Minecraft', 'PC', '2011', 'minecraft.jpg'),
(5, 4, 'Red Dead Redemption 2', 'Xbox One', '2018', 'rdr2.jpg'),
(6, 2, 'Grand Theft Auto V', 'PC,PlayStation4,3,5 y Xbox', '2013', 'gtaV.jpg'),
(7, 2, 'the last of us 2', 'PlayStation 5', '2018', 'bJ65Z2b1999PQFnlz2oRVFvM.avif');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `id_amigo` int(11) NOT NULL,
  `id_juego` int(11) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `devuelto` tinyint(1) NOT NULL DEFAULT 0,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `id_amigo`, `id_juego`, `fecha_prestamo`, `devuelto`, `id_usuario`) VALUES
(6, 3, 3, '2025-01-31', 0, 4),
(9, 3, 2, '2025-01-29', 0, 4),
(10, 3, 6, '2025-02-03', 0, 2),
(11, 20, 2, '2025-02-03', 0, 2),
(12, 20, 2, '2025-02-03', 0, 2),
(13, 3, 3, '2025-02-03', 0, 2),
(14, 24, 3, '2025-02-05', 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `contrasena` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contrasena`) VALUES
(0, 'ADMIN', 'ADMIN'),
(1, 'juan1234', 'password123'),
(2, 'maria_g', 'securepass456'),
(3, 'pablo98', 'mypassword789'),
(4, 'carla87', 'anotherpass321'),
(6, 'nasarop', ''),
(7, 'nasaro23', ''),
(8, 'nasaro22222', 'nasaro'),
(9, 'nasaro', 'nasar1'),
(10, 'nasaro', 'nasaro'),
(11, 'nasaro', 'nasaro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`id_amigo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id_juego`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `id_amigo` (`id_amigo`),
  ADD KEY `id_juego` (`id_juego`),
  ADD KEY `prestamos_ibfk_3` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amigos`
--
ALTER TABLE `amigos`
  MODIFY `id_amigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id_juego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `amigos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `juegos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`id_amigo`) REFERENCES `amigos` (`id_amigo`) ON DELETE CASCADE,
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON DELETE CASCADE,
  ADD CONSTRAINT `prestamos_ibfk_3` FOREIGN KEY (`ID_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
