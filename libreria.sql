-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2024 a las 20:45:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id_autor` int(11) NOT NULL,
  `nombre_autor` varchar(50) NOT NULL,
  `nacionalidad_autor` varchar(50) DEFAULT NULL,
  `archivo_foto` varchar(250) DEFAULT NULL,
  `biografia_autor` varchar(500) DEFAULT NULL,
  `cant_libros` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id_autor`, `nombre_autor`, `nacionalidad_autor`, `archivo_foto`, `biografia_autor`, `cant_libros`) VALUES
(1, 'Jorge Luis Borges', 'Argentina', 'images/67103a0711a412.33013270.jpeg', '', 0),
(3, 'Howard Phillips Lovecraft', 'Estados Unidos', 'images/6710377f61c4e2.77660395.jpg', '', 0),
(14, 'Franz Kafka', 'Austria', 'images/67103ad3173330.26583780.jpg', '', 0),
(16, 'Brandon Sanderson', 'Estados Unidos', 'images/67104172a74010.95503153.jpg', '', 0),
(17, 'Friedrich Nietzsche', 'Alemania', 'images/671041c2131945.28653841.jpg', '', 0),
(19, 'German Beder', 'Argentina', 'images/6710489dcd07d3.49008557.png', '', 0),
(21, 'PapaGiorgio', 'Española', NULL, NULL, 0),
(22, 'Osvaldo Soriano', 'Argentina', NULL, NULL, 0),
(23, 'Julio Cortázar', 'Argentina', NULL, NULL, 0),
(24, 'Osamu Dazai', 'japonés', NULL, 'Osamu Dazai, nacido bajo el nombre de Shūji Tsushima, fue un novelista japonés, considerado uno de los escritores del siglo XX más apreciados de Japón. Algunas de sus obras más populares, tales como El ocaso e Indigno de ser humano, también son consideradas como clásicos modernos en su país de origen. ​', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL,
  `libro_titulo` varchar(50) DEFAULT NULL,
  `id_autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `libro_titulo`, `id_autor`) VALUES
(2, 'el libro de arena', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `clave_usuario` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `clave_usuario`) VALUES
(1, 'webadmin', '$2y$10$CPcCv1OwZzb4J.81FH64x.0/yyCfm2meUfIJPB0nWIBp.y6gdWG.6');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id_autor`),
  ADD UNIQUE KEY `archivo_foto` (`archivo_foto`),
  ADD KEY `nombre_autor` (`nombre_autor`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`),
  ADD UNIQUE KEY `libro_id` (`id_libro`),
  ADD KEY `id_autor` (`id_autor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
