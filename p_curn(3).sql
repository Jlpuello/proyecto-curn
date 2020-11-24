-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-11-2020 a las 03:34:45
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `p_curn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnoProyecti`
--

CREATE TABLE `alumnoProyecti` (
  `codigoA` int(11) NOT NULL,
  `cod_proyecto` varchar(100) NOT NULL,
  `cod_alumno` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnoProyecti`
--

INSERT INTO `alumnoProyecti` (`codigoA`, `cod_proyecto`, `cod_alumno`) VALUES
(1, '2', '4534'),
(2, '2', '1234'),
(3, '3', '131001'),
(4, '3', '12345'),
(5, '3', '7777');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `cod_estudiante` varchar(50) NOT NULL,
  `cedula` varchar(50) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `carrera` varchar(100) NOT NULL,
  `semestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`cod_estudiante`, `cedula`, `nombres`, `apellidos`, `edad`, `sexo`, `correo`, `telefono`, `carrera`, `semestre`) VALUES
('1234', '12', 'javier ', 'coneo', 23, 'Masculino', 'javi@hotmail.com', '123', 'ingenieria de sistema', 1),
('12345', '123456', 'eduardo', 'gonzales gonzales', 24, 'Masculino', 'edu@gmail.com', '123', 'desarrollo de software', 1),
('131001', '1255632', 'Jorge Leonardo', 'cadena', 28, 'Masculino', 'martin@hotmail.com', '31023456', 'ingenieria de sistema', 1),
('4534', '4654', 'josema', 'manjarrez', 30, 'Masculino', 'as@gmail.com', '868', 'diseño', 4),
('7777', '105148', 'mariana', 'correa', 19, 'Femenino', 'mari@gmail.com', '4545', 'ingenieria de sistema', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `cod_docente` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  `area` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`cod_docente`, `nombre`, `apellido`, `correo`, `titulo`, `area`) VALUES
('321', 'Ledis ', 'gonzales gonzales', 'ledigo@gmail.com', 'arquitectura software', 'ingenieria de sistema'),
('5265464', 'Alexander', 'Castellon Arenas', 'castellon@hotmail.com', 'redes', 'ingenieria de sistema'),
('654', 'cesar', 'gomez gomez', 'cezargo@gmail.com', 'Bases de datos', 'ingenieria de sistema'),
('987', 'Yeneris', 'gamarra', 'yene@hotmail.com', 'desarrollo', 'ingenieria de sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `cod_proyecto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `lineaInvestigacion` varchar(100) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaActualizacion` date DEFAULT NULL,
  `fechaEntrega` date NOT NULL,
  `campus` varchar(100) NOT NULL,
  `estadoProyecto` varchar(100) NOT NULL,
  `cod_docente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`cod_proyecto`, `nombre`, `lineaInvestigacion`, `fechaInicio`, `fechaActualizacion`, `fechaEntrega`, `campus`, `estadoProyecto`, `cod_docente`) VALUES
(2, 'ing de software 5', 'desarrollo', '2020-11-18', NULL, '2020-11-18', 'cartagena', 'Rechazado', '5265464'),
(3, 'crud con php', 'base de datos', '2020-11-17', NULL, '2020-11-27', 'barranquilla', 'En Espera', '5265464');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roldocente`
--

CREATE TABLE `roldocente` (
  `id` int(11) NOT NULL,
  `cod_profesor` varchar(100) NOT NULL,
  `cod_proyecto` varchar(100) NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roldocente`
--

INSERT INTO `roldocente` (`id`, `cod_profesor`, `cod_proyecto`, `rol`) VALUES
(5, '321', '2', 'Cootutor'),
(6, '654', '2', 'revisor'),
(7, '987', '3', 'Cootutor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnoProyecti`
--
ALTER TABLE `alumnoProyecti`
  ADD PRIMARY KEY (`codigoA`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`cod_estudiante`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`cod_docente`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`cod_proyecto`),
  ADD KEY `unionDocente` (`cod_docente`);

--
-- Indices de la tabla `roldocente`
--
ALTER TABLE `roldocente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnoProyecti`
--
ALTER TABLE `alumnoProyecti`
  MODIFY `codigoA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `cod_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roldocente`
--
ALTER TABLE `roldocente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `unionDocente` FOREIGN KEY (`cod_docente`) REFERENCES `docentes` (`cod_docente`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
