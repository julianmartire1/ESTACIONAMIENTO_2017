-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2017 a las 23:53:54
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `estacionamiento`
--
CREATE DATABASE IF NOT EXISTS `estacionamiento` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `estacionamiento`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autos`
--

CREATE TABLE `autos` (
  `patente` varchar(20) NOT NULL,
  `color` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `fechaInicial` varchar(50) NOT NULL,
  `esta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`patente`, `color`, `marca`, `fechaInicial`, `esta`) VALUES
('123', 'rojo', 'fiat', '2017-06-18 17:01:19', 1),
('888', 'rojo', 'fiat', '2017-06-18 17:10:59', 1),
('444', 'asd', 'asd', '2017-06-18 17:45:53', 1),
('444', 'asd', 'asd', '2017-06-18 23:26:29', 1),
('999', 'verde', 'ford', '2017-06-18 23:27:38', 1),
('8888', 'rojo', 'fiat', '2017-06-18 23:45:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `legajo` int(11) NOT NULL,
  `turno` varchar(50) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`nombre`, `apellido`, `legajo`, `turno`, `categoria`, `usuario`, `pw`, `estado`) VALUES
('julian', 'martire', 40917134, 'tarde', 'admin', 'julianmartire1', 'jm123', 'activo'),
('pepe', 'pepe', 456, 'maniana', 'empleado', 'pepe1', 'pepe1', 'eliminado'),
('pepe2', 'pepe2', 888, 'noche', 'empleado', 'pepe2', 'pepe2', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estacionamiento`
--

CREATE TABLE `estacionamiento` (
  `auto` varchar(50) NOT NULL,
  `condicion` varchar(50) NOT NULL,
  `reservado` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cochera` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estacionamiento`
--

INSERT INTO `estacionamiento` (`auto`, `condicion`, `reservado`, `cantidad`, `cochera`) VALUES
('nadie', 'nadie', 'especial', 0, '1A'),
('nadie', 'nadie', 'especial', 0, '1B'),
('nadie', 'nadie', 'especial', 0, '1C'),
('nadie', 'nadie', 'normal', 0, '1D'),
('nadie', 'nadie', 'normal', 0, '1E'),
('nadie', 'nadie', 'normal', 0, '1F'),
('999', 'ocupado', 'normal', 1, '2A'),
('nadie', 'nadie', 'normal', 0, '2B'),
('nadie', 'nadie', 'normal', 0, '2C'),
('nadie', 'nadie', 'normal', 0, '2D'),
('nadie', 'nadie', 'normal', 0, '2E'),
('nadie', 'nadie', 'normal', 0, '2F'),
('nadie', 'nadie', 'normal', 0, '3A'),
('nadie', 'nadie', 'normal', 0, '3B'),
('nadie', 'nadie', 'normal', 0, '3C'),
('nadie', 'nadie', 'normal', 0, '3D'),
('8888', 'ocupado', 'normal', 1, '3E'),
('444', 'ocupado', 'normal', 1, '3F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrolog`
--

CREATE TABLE `registrolog` (
  `empleado` varchar(50) NOT NULL,
  `dia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registrolog`
--

INSERT INTO `registrolog` (`empleado`, `dia`) VALUES
('pepe1', '12-06-2017 22:44'),
('pepe1', '12-06-2017 22:50'),
('pepe1', '17-06-2017 17:24'),
('pepe1', '17-06-2017 17:25'),
('pepe1', '17-06-2017 17:25'),
('pepe1', '17-06-2017 17:25');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
