-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2018 a las 04:20:12
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_tutorias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `idAlumno` int(8) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT 'default.jpg',
  `idCarrera` int(8) DEFAULT NULL,
  `idUsuario` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`idAlumno`, `nombre`, `foto`, `idCarrera`, `idUsuario`) VALUES
(7, 'Galia Nahaliel Rodriguez Gonzalez', 'imagenes/2746281501364947_504302f166a122c77817fa74', 37, 45),
(8, 'Nuevo1', 'imagenes/776276bc0a2f3a5908c583076d9e10e3df968b.jp', 35, 46);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `idCarrera` int(8) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT 'default.jpg',
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`idCarrera`, `nombre`, `foto`, `descripcion`) VALUES
(1, '--', 'default.jpg', NULL),
(35, 'ITI', 'default.jpg', NULL),
(36, 'ISA', 'default.jpg', NULL),
(37, 'MECA', 'default.jpg', NULL),
(38, 'PYMES', 'default.jpg', NULL),
(39, 'MANO', 'default.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialsesion`
--

CREATE TABLE `historialsesion` (
  `idHistorialSesion` int(8) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notacion` text,
  `idSesion` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `idSesion` int(8) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipoSesion` varchar(50) DEFAULT NULL,
  `idAlumno` int(8) DEFAULT NULL,
  `idUsuario` int(8) DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'Activa'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(8) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `contrasena` varchar(50) DEFAULT NULL,
  `foto` varchar(100) DEFAULT 'imagenes/def.jpg',
  `tipoUsuario` int(1) DEFAULT NULL,
  `idCarrera` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `correo`, `contrasena`, `foto`, `tipoUsuario`, `idCarrera`) VALUES
(6, 'Dtutor', 'Dtutor@upv.edu.mx', 'Dtutor', 'imagenes/def.jpg', 1, 1),
(24, 'Galia Nahaliel Rodriguez Gonzalez', '1530405@upv.edu.mx', 'Galia123', 'imagenes/57440229136763_844965569188248_1827973398693675008_n.jpg', 0, NULL),
(32, 'Edwin Lopez', '1530405@upv.edu.mx', 'a', 'imagenes/def.jpg', 0, NULL),
(33, 'Edwin Lopez', 'edwin@asdas.xom', 'Edwin123', 'imagenes/def.jpg', 0, NULL),
(43, 'Galia Nahaliel Rodriguez Gonzalez', 'FGAlia@upv.edu.mx', 'FGAlia', 'imagenes/def.jpg', 0, NULL),
(44, 'Edwin Lopez', '15301405@upv.edu.mx', 'Asi es', 'imagenes/6398321501364947_504302f166a122c77817fa7451d7c8df.jpg', 2, 39),
(45, 'Edwin Lopez', '1530111405@upv.edu.mx', 'Edwin Lopez', 'imagenes/93292328796063_853100068195207_5006743913541664768_n.jpg', 2, 36),
(46, 'Issac', 'EdwinIssac@upv.edu.mx', 'Issac', 'imagenes/659028', 2, 35),
(47, 'Edwin Lopez', 'edwin_161298@hotmail.com', 'Edwin', 'imagenes/def.jpg', 0, NULL),
(48, 'Edwinn', 'Edwinn@upv.ed', 'Edwinnn', 'imagenes/def.jpg', 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`idAlumno`),
  ADD KEY `idCarrera` (`idCarrera`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`idCarrera`);

--
-- Indices de la tabla `historialsesion`
--
ALTER TABLE `historialsesion`
  ADD PRIMARY KEY (`idHistorialSesion`),
  ADD KEY `idSesion` (`idSesion`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`idSesion`),
  ADD KEY `idAlumno` (`idAlumno`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idCarrera` (`idCarrera`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `idAlumno` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `idCarrera` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `historialsesion`
--
ALTER TABLE `historialsesion`
  MODIFY `idHistorialSesion` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `idSesion` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`idCarrera`) REFERENCES `carreras` (`idCarrera`),
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `historialsesion`
--
ALTER TABLE `historialsesion`
  ADD CONSTRAINT `historialsesion_ibfk_1` FOREIGN KEY (`idSesion`) REFERENCES `sesiones` (`idSesion`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `alumnos` (`idAlumno`),
  ADD CONSTRAINT `sesiones_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idCarrera`) REFERENCES `carreras` (`idCarrera`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
