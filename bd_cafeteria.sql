-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-11-2022 a las 23:47:05
-- Versión del servidor: 5.7.36
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_cafeteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categotia`
--

DROP TABLE IF EXISTS `tbl_categotia`;
CREATE TABLE IF NOT EXISTS `tbl_categotia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_categotia`
--

INSERT INTO `tbl_categotia` (`id`, `nombre`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'bebidas', '2022-11-24 17:23:54', '2022-11-24 17:23:54'),
(2, 'comida', '2022-11-24 17:24:01', '2022-11-24 17:24:01'),
(3, 'dulces', '2022-11-24 17:24:06', '2022-11-24 17:24:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

DROP TABLE IF EXISTS `tbl_productos`;
CREATE TABLE IF NOT EXISTS `tbl_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `precio` int(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `estado` smallint(6) DEFAULT '1',
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`id`, `nombre`, `referencia`, `precio`, `peso`, `categoria`, `stock`, `estado`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'empanadas', '12323', 1500, 1, 2, 46, 1, '2022-11-24 17:24:29', '2022-11-24 17:28:44'),
(2, 'arepas', '23424', 2000, 1, 2, 26, 1, '2022-11-24 17:24:49', '2022-11-24 17:34:08'),
(3, 'perros', '34535', 4000, 1, 2, 14, 1, '2022-11-24 17:25:10', '2022-11-24 17:25:10'),
(4, 'coca cola', '4343564', 1500, 1, 1, 88, 1, '2022-11-24 17:25:28', '2022-11-24 17:28:51'),
(5, 'agua', '3453', 500, 1, 1, 178, 1, '2022-11-24 17:25:48', '2022-11-24 17:28:38'),
(6, 'gallestas', '54646', 800, 1, 3, 134, 1, '2022-11-24 17:26:13', '2022-11-24 17:29:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ventas`
--

DROP TABLE IF EXISTS `tbl_ventas`;
CREATE TABLE IF NOT EXISTS `tbl_ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `estado` smallint(6) DEFAULT '1',
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_ventas`
--

INSERT INTO `tbl_ventas` (`id`, `idProducto`, `nombre`, `precio`, `stock`, `categoria`, `estado`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(6, 2, 'arepas', 8000, 4, 2, 1, '2022-11-24 17:34:08', '2022-11-24 17:34:08');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
