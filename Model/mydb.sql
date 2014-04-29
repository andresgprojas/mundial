-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-04-2014 a las 05:51:17
-- Versión del servidor: 5.5.29
-- Versión de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `mydb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `NickName`
--

CREATE TABLE `NickName` (
  `Nick` varchar(15) NOT NULL,
  `ID` int(12) NOT NULL,
  `PWD` varchar(45) NOT NULL,
  `Pago` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Nick`),
  UNIQUE KEY `Nick_UNIQUE` (`Nick`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `NickName`
--

INSERT INTO `NickName` (`Nick`, `ID`, `PWD`, `Pago`) VALUES
('Alan', 1234, '50c80ec97a2d2bb48ae43ea687cb3f12', 1),
('aperez', 1026262467, '231badb19b93e44f47da1bd64a8147f2', 1),
('Aprojas', 99999999, '8408b825acae02f418a7522b27dbe34c', 1),
('gperez', 2147483647, '1e05c05243553ea07e7e03a1f17d9fef', 1),
('pinky', 80876510, '3c2d02846e5a80e529ffcaa9284521c2', 1),
('prueba', 123, 'ksjdhladksjhaldkjhas', 1),
('prueba3', 98707, '7987uhuy98', 1),
('rueba2', 9809809, 'weuhiuwqey9712793878qwue', 1);
