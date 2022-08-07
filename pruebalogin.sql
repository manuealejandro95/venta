-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-08-2022 a las 10:09:51
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE database IF NOT exists pruebalogin;
USE pruebalogin;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebalogin`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `RegistraPersonas` (`p_NOMBRE` VARCHAR(50), `p_APELLIDO` VARCHAR(50), `p_NUMEROIDENT` NUMERIC(20,0), `p_EMAIL` VARCHAR(50), `p_TIPOID` VARCHAR(3), `p_USER` VARCHAR(100), `p_PASSWD` VARCHAR(100))  BEGIN
	INSERT INTO Personas(Nombres,Apellidos,Numeroident,email,tipoidentificacion,Fechacreacion) 
	VALUES (p_NOMBRE,p_APELLIDO,p_NUMEROIDENT,p_EMAIL,p_TIPOID,NOW(3));

	INSERT INTO Usuarios(Identificador,Usuario,Pass,Fecha_creacion) 
	VALUES (p_NUMEROIDENT,p_USER,p_PASSWD,NOW(3));
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `identificador` int(11) NOT NULL,
  `Nombres` varchar(50) DEFAULT NULL,
  `Apellidos` varchar(50) DEFAULT NULL,
  `Numeroident` decimal(18,0) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tipoidentificacion` varchar(3) DEFAULT NULL,
  `Fechacreacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`identificador`, `Nombres`, `Apellidos`, `Numeroident`, `email`, `tipoidentificacion`, `Fechacreacion`) VALUES
(1, 'Administrador', 'Root', '123456', 'admin@prueba.com', 'CC', '2022-08-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Referencia` varchar(100) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Peso` int(11) NOT NULL,
  `Categoria` varchar(100) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Fechaingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `Nombre`, `Referencia`, `Precio`, `Peso`, `Categoria`, `Cantidad`, `Fechaingreso`) VALUES
(12345, 'Coca Cola', '125-coc', 2500, 125, 'Bebidas', 35, '2022-08-07'),
(1234567, 'Cafe', '1234', 1500, 12, 'Bebida', 10, '2022-08-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Identificador` decimal(18,0) NOT NULL,
  `Usuario` varchar(100) DEFAULT NULL,
  `Pass` varchar(100) DEFAULT NULL,
  `Fecha_creacion` date DEFAULT NULL,
  `Rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Identificador`, `Usuario`, `Pass`, `Fecha_creacion`, `Rol`) VALUES
('123456', '123456', 'e66055e8e308770492a44bf16e875127', '2022-08-07', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`identificador`),
  ADD UNIQUE KEY `Numeroident` (`Numeroident`,`email`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
