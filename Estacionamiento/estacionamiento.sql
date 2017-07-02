-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-07-2017 a las 00:26:20
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
  `fechaSalida` varchar(50) NOT NULL,
  `pago` int(11) NOT NULL,
  `esta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`patente`, `color`, `marca`, `fechaInicial`, `fechaSalida`, `pago`, `esta`) VALUES
('123', 'rojo', 'fiat', '2017-06-24 14:42:17', '', 0, 0),
('222', 'rojo', 'fiat', '2017-06-24 14:44:13', '', 0, 0),
('444', 'rojo', 'fiat', '2017-06-24 16:03:48', '', 0, 0),
('555', 'rojo', 'fiat', '2017-06-24 16:08:43', '', 0, 0),
('222', 'rojo', 'fiat', '2017-06-24 16:20:28', '', 0, 1),
('222', 'rojo', 'fiat', '2017-06-24 16:21:39', '', 0, 1),
('222', 'rojo', 'fiat', '2017-06-24 16:22:45', '', 0, 1),
('77777', 'rojo', 'fiat', '2017-06-24 16:25:53', '', 0, 1),
('AAA123', 'rojo', 'fiat', '2017-07-02 18:20:55', '2017-07-02 18:21:10', 10, 0),
('fff123', 'rojo', 'fiat', '2017-07-02 18:32:35', '2017-07-02 18:32:50', 10, 0),
('mmm', 'rojo', 'fiat', '2017-07-02 18:34:42', '2017-07-02 18:35:00', 10, 0),
('ooo', 'rojo', 'fiat', '2017-07-02 18:37:22', '2017-07-02 18:37:28', 10, 0);

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
('nadie', 'nadie', 'normal', 0, '2A'),
('nadie', 'nadie', 'normal', 0, '2B'),
('nadie', 'nadie', 'normal', 0, '2C'),
('nadie', 'nadie', 'normal', 0, '2D'),
('nadie', 'nadie', 'normal', 0, '2E'),
('nadie', 'nadie', 'normal', 0, '2F'),
('nadie', 'nadie', 'normal', 0, '3A'),
('nadie', 'nadie', 'normal', 4, '3B'),
('77777', 'ocupado', 'normal', 1, '3C'),
('222', 'ocupado', 'normal', 1, '3D'),
('222', 'ocupado', 'normal', 1, '3E'),
('222', 'ocupado', 'normal', 5, '3F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE `operaciones` (
  `empleado` varchar(50) NOT NULL,
  `operacion` int(11) NOT NULL,
  `auto` varchar(20) NOT NULL,
  `cochera` varchar(10) NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`empleado`, `operacion`, `auto`, `cochera`, `fecha`, `cantidad`) VALUES
('pepe2', 1, '123', '3F', '2017-06-24 14:42:17', 1),
('pepe2', 2, '123', '', '2017-06-24 14:42:24', 1),
('pepe2', 1, '222', '3F', '2017-06-24 14:44:13', 1),
('pepe2', 2, '222', '', '2017-06-24 14:49:39', 1),
('', 1, '444', '3F', '2017-06-24 16:03:48', 1),
('pepe2', 1, '555', '3F', '2017-06-24 16:08:43', 1),
('pepe2', 2, '555', '', '2017-06-24 16:08:59', 1),
('', 1, '222', '3F', '2017-06-24 16:20:28', 1),
('', 1, '222', '3E', '2017-06-24 16:21:39', 1),
('', 1, '222', '3D', '2017-06-24 16:22:45', 1),
('', 1, '77777', '3C', '2017-06-24 16:25:53', 1),
('', 1, 'AAA123', '3B', '2017-07-02 18:20:55', 1),
('', 2, 'AAA123', '', '2017-07-02 18:21:10', 1),
('', 1, 'fff123', '3B', '2017-07-02 18:32:35', 1),
('', 2, 'fff123', '', '2017-07-02 18:32:50', 1),
('', 1, 'mmm', '3B', '2017-07-02 18:34:42', 1),
('', 2, 'mmm', '', '2017-07-02 18:35:00', 1),
('', 1, 'ooo', '3B', '2017-07-02 18:37:22', 1),
('', 2, 'ooo', '', '2017-07-02 18:37:28', 1);

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
('pepe1', '17-06-2017 17:25'),
('pepe2', '23-06-2017 22:30'),
('pepe2', '23-06-2017 22:30'),
('pepe2', '23-06-2017 22:31'),
('pepe2', '23-06-2017 22:31'),
('pepe2', '24-06-2017 17:58'),
('pepe2', '24-06-2017 18:42'),
('pepe2', '24-06-2017 18:50'),
('pepe2', '24-06-2017 19:09'),
('pepe2', '24-06-2017 19:22'),
('pepe2', '24-06-2017 19:22'),
('pepe2', '24-06-2017 19:23'),
('pepe2', '24-06-2017 19:29'),
('pepe2', '24-06-2017 19:30'),
('pepe2', '24-06-2017 19:30'),
('pepe2', '24-06-2017 19:31'),
('pepe2', '24-06-2017 19:33'),
('pepe2', '24-06-2017 19:33'),
('pepe2', '24-06-2017 19:36'),
('pepe2', '24-06-2017 19:36'),
('pepe2', '24-06-2017 19:37'),
('pepe2', '24-06-2017 19:42'),
('pepe2', '24-06-2017 19:44'),
('pepe2', '24-06-2017 19:44'),
('pepe2', '24-06-2017 19:55'),
('pepe2', '24-06-2017 19:56'),
('pepe2', '24-06-2017 21:06'),
('pepe2', '24-06-2017 21:08'),
('pepe2', '24-06-2017 21:11'),
('pepe2', '24-06-2017 21:11'),
('pepe2', '25-06-2017 20:16');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
