-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2015 a las 16:17:56
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `geoloc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `date` varchar(25) NOT NULL,
  `idrow` int(11) NOT NULL AUTO_INCREMENT,
  `namePC` varchar(25) NOT NULL,
  `nameFile` varchar(255) NOT NULL,
  `encode` varchar(25) NOT NULL,
  `numberRows` int(10) NOT NULL,
  `processingTime` varchar(25) NOT NULL,
  `error` varchar(255) NOT NULL,
  PRIMARY KEY (`idrow`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idrow` int(8) NOT NULL AUTO_INCREMENT,
  `user` varchar(128) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `creationDate` timestamp NOT NULL,
  PRIMARY KEY (`idrow`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `user_2` (`user`),
  UNIQUE KEY `idrow` (`idrow`),
  UNIQUE KEY `idrow_2` (`idrow`),
  UNIQUE KEY `idrow_3` (`idrow`,`user`,`pass`,`creationDate`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `name_2` (`name`),
  UNIQUE KEY `user_3` (`user`),
  UNIQUE KEY `idrow_4` (`idrow`,`user`,`pass`,`name`,`creationDate`),
  UNIQUE KEY `idrow_5` (`idrow`,`user`,`pass`,`name`,`creationDate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`idrow`, `user`, `pass`, `name`, `creationDate`) VALUES
(1, 'admin', 'admin', 'Admin', '2015-10-23 09:01:40');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
