-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2024 a las 01:39:19
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
-- Base de datos: `disqueria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discograficas`
--

CREATE TABLE `discograficas` (
  `ID_Discografica` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `fundacion` date NOT NULL,
  `pais` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `discograficas`
--

INSERT INTO `discograficas` (`ID_Discografica`, `nombre`, `fundacion`, `pais`) VALUES
(1, 'Microfón', '1958-07-17', 'Argentina'),
(2, 'Ariola', '1958-04-02', 'Alemania'),
(3, 'Sony', '1929-09-09', 'Estados Unidos'),
(4, 'RCA', '1901-11-01', 'Estados Unidos'),
(5, 'Bohemian Groove', '2020-07-08', 'Argentina');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `discograficas`
--
ALTER TABLE `discograficas`
  ADD PRIMARY KEY (`ID_Discografica`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `discograficas`
--
ALTER TABLE `discograficas`
  MODIFY `ID_Discografica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
