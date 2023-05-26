-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2020 a las 23:01:16
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jornadaextendida`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `id_situacion` int(11) DEFAULT NULL,
  `id_inscripcion` int(11) DEFAULT NULL,
  `id_clase` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `id_situacion`, `id_inscripcion`, `id_clase`) VALUES
(1, 1, 5, 1),
(2, 2, 4, 1),
(3, 3, 2, 1),
(4, 1, 3, 1),
(5, 2, 5, 2),
(6, 2, 4, 2),
(7, 2, 2, 2),
(8, 1, 3, 2),
(9, 2, 6, 3),
(10, 2, 5, 3),
(11, 1, 4, 3),
(12, 3, 2, 3),
(13, 2, 3, 3),
(14, 4, 7, 4),
(15, 3, 8, 4),
(16, 1, 7, 5),
(17, 3, 8, 6),
(18, 3, 6, 7),
(19, 2, 9, 7),
(20, 4, 5, 7),
(21, 2, 4, 7),
(22, 3, 2, 7),
(23, 2, 3, 7),
(24, 1, 6, 8),
(25, 1, 5, 8),
(26, 2, 3, 8),
(27, 3, 7, 10),
(28, 3, 8, 10),
(29, 2, 6, 11),
(30, 2, 9, 11),
(31, 1, 5, 11),
(32, 2, 4, 11),
(33, 2, 2, 11),
(34, 2, 3, 11),
(35, 2, 6, 12),
(36, 3, 9, 12),
(37, 2, 5, 12),
(38, 2, 3, 12),
(39, 2, 6, 9),
(40, 3, 9, 9),
(41, 2, 5, 9),
(42, 3, 4, 9),
(43, 2, 2, 9),
(44, 3, 3, 9),
(45, 2, 4, 13),
(46, 1, 2, 13),
(47, 1, 6, 14),
(48, 4, 10, 14),
(49, 2, 9, 14),
(50, 3, 5, 14),
(51, 2, 4, 14),
(52, 2, 2, 14),
(53, 2, 3, 14),
(54, 1, 6, 15),
(55, 2, 10, 15),
(56, 3, 9, 15),
(57, 4, 5, 15),
(58, 2, 4, 15),
(59, 2, 2, 15),
(60, 2, 3, 15),
(61, 1, 7, 16),
(62, 1, 8, 16),
(63, 3, 6, 19),
(64, 2, 10, 19),
(65, 3, 9, 19),
(66, 2, 5, 19),
(67, 3, 4, 19),
(68, 2, 2, 19),
(69, 3, 3, 19),
(70, 3, 6, 20),
(71, 3, 10, 20),
(72, 3, 9, 20),
(73, 4, 5, 20),
(74, 4, 4, 20),
(75, 4, 2, 20),
(76, 1, 3, 20),
(77, 2, 7, 22),
(78, 1, 8, 22),
(79, 3, 11, 23),
(80, 4, 12, 23),
(81, 4, 11, 24),
(82, 2, 12, 24),
(83, 3, 12, 25),
(84, 1, 13, 26),
(85, 2, 11, 26),
(86, 2, 6, 27),
(87, 2, 10, 27),
(88, 1, 9, 27),
(89, 2, 5, 27),
(90, 2, 3, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriacentro`
--

CREATE TABLE `categoriacentro` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoriacentro`
--

INSERT INTO `categoriacentro` (`id_categoria`, `nombre`) VALUES
(2, 'Artes'),
(1, 'Deporte'),
(3, 'Tercer Eje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centrointeres`
--

CREATE TABLE `centrointeres` (
  `id_centro` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `cupos` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `centrointeres`
--

INSERT INTO `centrointeres` (`id_centro`, `nombre`, `cupos`, `hora_inicio`, `hora_final`, `id_categoria`, `estado`) VALUES
(1, 'Baloncesto', 155, '09:30:00', '15:00:00', 1, 'activo'),
(2, 'Futbol', 155, '12:00:00', '15:00:00', 1, 'activo'),
(3, 'Artistica', 150, '09:30:00', '15:00:00', 2, 'activo'),
(4, 'Danzas', 150, '09:30:00', '15:00:00', 2, 'activo'),
(5, 'Logica Matematica', 130, '09:30:00', '15:00:00', 3, 'activo'),
(6, 'Ingles', 150, '09:30:00', '15:00:00', 3, 'activo '),
(7, 'Teatro', 100, '09:00:00', '12:00:00', 2, 'activo'),
(12, 'Natación', 150, '09:30:00', '15:00:00', 1, 'activo'),
(13, 'Skate', 150, '09:30:00', '15:00:00', 1, 'activo'),
(14, 'Quimica', 100, '09:30:00', '03:00:00', 3, 'activo'),
(16, 'Esgrima', 100, '09:30:00', '03:00:00', 1, 'activo'),
(17, 'Boxeo', 100, '09:00:00', '03:00:00', 1, 'activo'),
(18, 'Escalada', 100, '09:30:00', '03:00:00', 1, 'activo'),
(60, 'Micro futbol', 150, '09:00:00', '14:00:00', 1, 'activo'),
(81, 'Futbol Sala', 150, '09:00:00', '03:00:00', 1, 'activo'),
(83, 'Audiovisuales', 150, '09:00:00', '15:00:00', 2, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `id_clase` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `id_plan` int(11) DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id_clase`, `fecha`, `descripcion`, `id_plan`, `estado`) VALUES
(1, '2020-11-30', 'Bocetos', 3, 'inactivo'),
(2, '2020-11-30', 'Sumas y Restas', 5, 'inactivo'),
(3, '2020-11-30', 'Boceto', 3, 'inactivo'),
(4, '2020-11-30', 'coreografia', 12, 'inactivo'),
(5, '2020-11-30', 'Nadar', 15, 'inactivo'),
(6, '2020-11-30', 'patinar', 10, 'inactivo'),
(7, '2020-12-01', 'Artes', 3, 'inactivo'),
(8, '2020-12-01', 'Balon', 8, 'inactivo'),
(9, '2020-12-02', ' s s', 3, 'inactivo'),
(10, '2020-12-02', 'presente', 14, 'inactivo'),
(11, '2020-12-02', 'Sumas pero asperas', 5, 'inactivo'),
(12, '2020-12-02', 'Balon 3', 8, 'inactivo'),
(13, '2020-12-02', 'daada', 1, 'inactivo'),
(14, '2020-12-02', 'que todos lo chupen', 3, 'inactivo'),
(15, '2020-12-02', 'que se abran todos', 3, 'inactivo'),
(16, '2020-12-02', 'mero choque', 12, 'inactivo'),
(17, '2020-12-02', 'ss', 3, 'activo'),
(18, '2020-12-02', 'bhb', 3, 'activo'),
(19, '2020-12-02', 'nana', 3, 'inactivo'),
(20, '2020-12-03', 'Dibujo animado', 3, 'inactivo'),
(21, '2020-12-03', 'Coreografia 1', 12, 'activo'),
(22, '2020-12-03', 'haha', 12, 'inactivo'),
(23, '2020-12-04', 'coreografia', 49, 'inactivo'),
(24, '2020-12-04', 'Sumas', 51, 'inactivo'),
(25, '2020-12-04', 'Nadar', 47, 'inactivo'),
(26, '2020-12-04', 'Parada', 45, 'inactivo'),
(27, '2020-12-04', 'Balón', 8, 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `numero_curso` varchar(5) NOT NULL,
  `id_grado` int(11) DEFAULT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id_curso`, `numero_curso`, `id_grado`, `estado`) VALUES
(1, '101', 1, 'activo'),
(2, '102', 1, 'activo'),
(3, '201', 2, 'activo'),
(4, '202', 2, 'activo'),
(5, '301', 3, 'activo'),
(6, '302', 3, 'activo'),
(10, '103', 1, 'activo'),
(12, '104', 1, 'activo'),
(13, '105', 1, 'activo'),
(14, '106', 1, 'activo'),
(15, '107', 1, 'activo'),
(16, '108', 1, 'activo'),
(17, '203', 2, 'activo'),
(18, '204', 2, 'activo'),
(19, '205', 2, 'activo'),
(20, '206', 2, 'activo'),
(21, '207', 2, 'activo'),
(22, '208', 2, 'activo'),
(23, '303', 3, 'activo'),
(24, '304', 3, 'activo'),
(25, '305', 3, 'activo'),
(26, '306', 3, 'activo'),
(27, '307', 3, 'activo'),
(28, '308', 3, 'activo'),
(29, '401', 4, 'activo'),
(30, '402', 4, 'activo'),
(31, '403', 4, 'activo'),
(32, '404', 4, 'activo'),
(33, '405', 4, 'activo'),
(46, '109', 1, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleprofesor`
--

CREATE TABLE `detalleprofesor` (
  `id_detalle` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleprofesor`
--

INSERT INTO `detalleprofesor` (`id_detalle`, `id_curso`, `id_persona`) VALUES
(1, 3, 87),
(2, 1, 87),
(3, 2, 87),
(4, 1, 88),
(5, 2, 88),
(6, 3, 88),
(7, 1, 89),
(8, 2, 89),
(9, 4, 89),
(10, 6, 90),
(11, 16, 90),
(12, 15, 90),
(13, 4, 91),
(14, 19, 91),
(15, 21, 91),
(16, 19, 92),
(17, 16, 92),
(18, 28, 92),
(19, 24, 94),
(20, 19, 94),
(21, 21, 94),
(22, 18, 95),
(23, 21, 95),
(24, 15, 95);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre`) VALUES
(1, 'activo'),
(2, 'inactivo'),
(3, 'reportado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gradocurso`
--

CREATE TABLE `gradocurso` (
  `id_grado` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `jornada` varchar(30) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gradocurso`
--

INSERT INTO `gradocurso` (`id_grado`, `nombre`, `jornada`, `estado`) VALUES
(1, 'Primero', 'Mañana', 'activo'),
(2, 'Segundo', 'Mañana', 'activo'),
(3, 'Tercero', 'Mañana', 'activo'),
(4, 'Cuarto', 'Mañana', 'activo'),
(5, 'Quinto', 'Mañana', 'activo'),
(6, 'Sexto', 'Tarde', 'activo'),
(7, 'Septimo', 'Tarde', 'activo'),
(8, 'Octavo', 'Tarde', 'activo'),
(9, 'Noveno', 'Tarde', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcionpersona`
--

CREATE TABLE `inscripcionpersona` (
  `id_inscripcion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `anualidad` year(4) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `id_plan` int(11) DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inscripcionpersona`
--

INSERT INTO `inscripcionpersona` (`id_inscripcion`, `fecha`, `anualidad`, `id_persona`, `id_plan`, `estado`) VALUES
(2, '2020-11-30', 2020, 7, 1, 'activo'),
(3, '2020-11-30', 2020, 6, 8, 'activo'),
(4, '2020-11-30', 2020, 5, 1, 'activo'),
(5, '2020-11-30', 2020, 8, 8, 'activo'),
(6, '2020-11-30', 2020, 13, 8, 'activo'),
(7, '2020-11-30', 2020, 2, 15, 'activo'),
(8, '2020-11-30', 2020, 75, 10, 'activo'),
(9, '2020-12-01', 2020, 10, 8, 'activo'),
(10, '2020-12-02', 2020, 77, 8, 'activo'),
(11, '2020-12-04', 2020, 96, 45, 'activo'),
(12, '2020-12-04', 2020, 97, 47, 'activo'),
(13, '2020-12-04', 2020, 98, 45, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `documento` int(11) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `eps` varchar(30) NOT NULL,
  `rh` varchar(4) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_centro` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `nombre`, `apellido`, `documento`, `telefono`, `fecha_nacimiento`, `eps`, `rh`, `id_usuario`, `id_curso`, `id_centro`, `id_estado`) VALUES
(1, 'Daniel ', 'Camacho', 1001095566, '3045484259', '2002-12-05', 'Salud Total', 'O+', 1, 1, NULL, 1),
(2, 'Eduardo ', 'Camacho', 1005525039, '3132276345', '2002-06-03', 'Compensar', 'A+', 2, 2, NULL, 1),
(4, 'Andres', 'Gomez', 52342810, '3103166119', '1973-03-25', 'Salud Total', 'A+', 4, NULL, 1, 1),
(5, 'Dayana', 'Molano', 1009572886, '3123782903', '2003-09-30', 'Compensar', 'A+', 5, 1, NULL, 1),
(6, 'Antonella', 'Suarez', 1001926993, '3123459028', '2005-04-15', 'Sanitas', 'A-', 6, 1, NULL, 1),
(7, 'Camilo', 'Sanchez', 2147483647, '3120963289', '2005-12-24', 'Compensar', 'O+', 7, 1, NULL, 1),
(8, 'Gabriel', 'Escamilla', 1014266290, '3201862930', '2004-02-22', 'Salud Total', 'A+', 8, 1, NULL, 1),
(10, 'Dayana ', 'Chaguala', 1009253288, '3212112636', '2001-12-16', 'Compensar', 'O+', 10, 1, NULL, 1),
(11, 'Damian', 'Sua', 1009265382, '3127420730', '2008-06-09', 'Salud Total', 'A+', 11, 1, NULL, 3),
(12, 'Martha', 'Zarate', 52349209, '3131229373', '2004-08-25', 'Compensar', 'A+', 12, 1, NULL, 1),
(13, 'Sergio', 'Beltran', 1000982237, '3219020775', '2007-08-09', 'Nueva EPS', 'O+', 13, 1, NULL, 1),
(34, 'daniel', 'camacho', 1001098725, '3028724424', '2020-08-06', 'Nueva EPS', 'O+', 39, NULL, 1, 2),
(53, 'daniel', 'camacho', 1009255521, '3128892522', '2020-10-06', 'salud total', 'O+', 81, NULL, 1, 1),
(75, 'daniel', 'camacho', 198765322, '636827299', '2020-11-12', 'salud total', 'O+', 138, 2, NULL, 1),
(76, 'daniel ', 'otra vez xd', 286276726, '827287', '2007-10-01', 'salud total', 'O+', 139, 2, NULL, 1),
(77, 'Laura', 'Casalles', 1661417289, '3299172901', '2005-11-17', 'salud total', 'O-', 140, 1, NULL, 1),
(78, 'abshayv', 'udkads', 19287632, '27625', '1995-11-23', 'salud total', 'O-', 141, 2, NULL, 1),
(79, 'skate', 'shskjdsk', 18363, '28762763', '2020-11-05', 'salud total', 'O-', 142, 2, NULL, 1),
(80, 'akshghag', 'jgahsgha', 98767891, '1098728', '2020-11-27', 'salud total', 'O-', 143, 1, NULL, 1),
(81, 'daniel', 'camack', 61176, '18728728', '2020-11-04', 'salud', 'O+', 144, 1, NULL, 1),
(84, 'Daniel Eduardo', 'Camacho', 1983762, '82762789', '2020-11-26', 'salud total', 'O-', 147, 3, NULL, 1),
(85, 'daniel', 'camash', 32762378, '83267632', '2020-12-01', 'salud total', 'O-', 148, 3, NULL, 1),
(87, 'Alfredo ', 'Camargo', 1009662727, '3127265382', '1992-10-15', 'salud total', 'O+', 149, NULL, 1, 1),
(88, 'Johari ', 'Cortes', 1009277282, '3131425628', '1992-10-29', 'salud total', 'A+', 151, NULL, 13, 2),
(89, 'Daniel', 'Eduardo', 1010282282, '3132292928', '2003-01-05', 'Salud Total', 'O+', 152, NULL, 5, 1),
(90, 'Eduardo', 'Zarate', 1873763872, '28627612', '2000-11-30', 'Salud Total', 'AB+', 153, NULL, 12, 2),
(91, 'Alejandro', 'Camacho', 1014269789, '3103106757', '2020-12-01', 'de la vida', 'AB+', 154, NULL, 4, 1),
(92, 'Eduardo', 'Samchez', 52449665, '310316119', '2020-12-02', 'Salud Total', 'O-', 155, NULL, 17, 1),
(94, 'Andrez ', 'Sanchez', 416171929, '28718272', '2007-11-28', 'salud total', 'A+', 158, NULL, 83, 1),
(95, 'Daniel ', 'Sanchez', 1002778229, '3129272622', '1984-01-18', 'salud total', 'O+', 160, NULL, 83, 1),
(96, 'Daniel ', 'Sanchez', 100292682, '312027283', '2007-02-22', 'Salud Total', 'A+', 162, 46, NULL, 1),
(97, 'Daniel ', 'Zarate', 82682781, '1276276', '2020-12-24', 'Salud Total', 'O+', 163, 46, NULL, 1),
(98, 'Eduardo ', 'Camacho', 102289202, '137873220', '2020-12-23', 'Salud Total', 'O+', 164, 46, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plancurso`
--

CREATE TABLE `plancurso` (
  `id_plan` int(11) NOT NULL,
  `dia` varchar(10) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `id_centro` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `plancurso`
--

INSERT INTO `plancurso` (`id_plan`, `dia`, `hora_inicio`, `hora_final`, `id_centro`, `id_curso`) VALUES
(1, 'Lunes', '09:30:00', '12:00:00', 1, 1),
(2, 'Miercoles', '09:30:00', '12:00:00', 1, 1),
(3, 'Martes', '09:30:00', '12:00:00', 3, 1),
(4, 'Jueves', '09:30:00', '12:00:00', 3, 1),
(5, 'Viernes', '09:30:00', '12:00:00', 5, 1),
(8, 'Lunes', '09:00:00', '12:00:00', 2, 1),
(9, 'Miercoles', '09:00:00', '12:00:00', 2, 1),
(10, 'Lunes', '09:30:00', '12:00:00', 13, 2),
(11, 'Miercoles', '09:30:00', '12:00:00', 13, 2),
(12, 'Martes', '09:30:00', '12:00:00', 4, 2),
(13, 'Jueves', '09:30:00', '12:00:00', 4, 2),
(14, 'Viernes', '09:30:00', '12:00:00', 6, 2),
(15, 'Lunes', '09:30:00', '12:00:00', 12, 2),
(16, 'Miercoles', '09:30:00', '12:00:00', 12, 2),
(17, 'Viernes', '09:30:00', '12:00:00', 17, 3),
(18, 'Miercoles', '09:30:00', '15:00:00', 17, 3),
(19, 'Viernes', '09:30:00', '12:00:00', 16, 3),
(20, 'Miercoles', '09:30:00', '12:00:00', 16, 3),
(21, 'Lunes', '09:30:00', '12:00:00', 14, 3),
(22, 'Martes', '09:30:00', '12:00:00', 7, 3),
(23, 'Jueves', '09:30:00', '12:00:00', 7, 3),
(24, 'Lunes', '00:00:00', '00:00:00', 60, 40),
(25, 'Jueves', '00:00:00', '00:00:00', 18, 40),
(26, 'Jueves', '00:00:00', '00:00:00', 60, 40),
(27, 'Lunes', '00:00:00', '00:00:00', 18, 40),
(28, 'Martes', '00:00:00', '00:00:00', 7, 40),
(29, 'Viernes', '00:00:00', '00:00:00', 7, 40),
(30, 'Miercoles', '00:00:00', '00:00:00', 14, 40),
(31, 'Lunes', '00:00:00', '00:00:00', 1, 41),
(32, 'Miercoles', '00:00:00', '00:00:00', 1, 41),
(33, 'Lunes', '00:00:00', '00:00:00', 2, 41),
(34, 'Miercoles', '00:00:00', '00:00:00', 2, 41),
(35, 'Martes', '00:00:00', '00:00:00', 3, 41),
(36, 'Jueves', '00:00:00', '00:00:00', 3, 41),
(37, 'Viernes', '00:00:00', '00:00:00', 6, 41),
(38, 'Lunes', '00:00:00', '00:00:00', 60, 42),
(39, 'Miercoles', '00:00:00', '00:00:00', 60, 42),
(40, 'Miercoles', '00:00:00', '00:00:00', 60, 43),
(41, 'Lunes', '00:00:00', '00:00:00', 17, 44),
(42, 'Miercoles', '00:00:00', '00:00:00', 17, 44),
(45, 'Lunes', '00:00:00', '00:00:00', 16, 46),
(46, 'Miercoles', '00:00:00', '00:00:00', 16, 46),
(47, 'Lunes', '00:00:00', '00:00:00', 12, 46),
(48, 'Miercoles', '00:00:00', '00:00:00', 12, 46),
(49, 'Martes', '00:00:00', '00:00:00', 4, 46),
(50, 'Jueves', '00:00:00', '00:00:00', 4, 46),
(51, 'Viernes', '00:00:00', '00:00:00', 5, 46);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolusuario`
--

CREATE TABLE `rolusuario` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rolusuario`
--

INSERT INTO `rolusuario` (`id_rol`, `nombre`) VALUES
(2, 'Alumno'),
(1, 'Coordinador'),
(3, 'Profesor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `situacion`
--

CREATE TABLE `situacion` (
  `id_situacion` int(11) NOT NULL,
  `situacion` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `situacion`
--

INSERT INTO `situacion` (`id_situacion`, `situacion`) VALUES
(1, 'Asistió'),
(2, 'No asistió'),
(3, 'Excusa'),
(4, 'Retraso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariopersona`
--

CREATE TABLE `usuariopersona` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuariopersona`
--

INSERT INTO `usuariopersona` (`id_usuario`, `email`, `clave`, `estado`, `id_rol`) VALUES
(1, 'ejemplo1@email.com', '123456789', 'activo', 1),
(2, 'ejemplo2@email.com', '123456789', 'activo', 2),
(3, 'ejemplo80@email.com', '', 'activo', 3),
(4, 'ejemplo4@email.com', '123456789', 'activo', 2),
(5, 'ejemplo5@email.com', '123456789', 'activo', 2),
(6, 'ejemplo6@email.com', '123456789', 'activo', 2),
(7, 'ejemplo7@email.com', '123456789', 'activo', 2),
(8, 'ejemplo8@email.com', '123456789', 'activo', 2),
(9, 'ejemplo9@email.com', '123456789', 'activo', 3),
(10, 'ejemplo10@email.com', '123456789', 'activo', 2),
(11, 'ejemplo11@email.com', '123456789', 'activo', 2),
(12, 'ejemplo12@email.com', '123456789', 'activo', 2),
(13, 'ejemplo13@email.com', '123456789', 'activo', 2),
(14, '', '', 'activo', 3),
(26, 'eduacy@gmail.com', '', 'activo', 3),
(27, 'dewabx8a@misena.edu.co', '', 'activo', 3),
(29, 'dewabx8a@misena.edu.c', '', 'activo', 3),
(30, 'decamdasg@misena.cei.co', '', 'activo', 3),
(32, 'decamdasg@missna.cei.co', '', 'activo', 3),
(33, 'usuario10@misena.edu.co', '', 'activo', 3),
(34, 'daniel@migmail.com', '', 'activo', 3),
(35, 'decamachoq05@misena.edu.co', '', 'activo', 3),
(38, 'deajsgas@gamilc.om', '', 'activo', 3),
(39, 'danielgamil@hahsu', '', 'inactivo', 3),
(53, 'ajax@gmailu.om', '', 'activo', 3),
(55, 'ajax1', '', 'activo', 3),
(56, 'danzasakac@gmail.com', '', 'activo', 3),
(57, 'ajax112@gmailco.om', '', 'activo', 3),
(61, 'ajax@gmailc.com', '', 'activo', 3),
(64, 'danielszs@hotmail.com', '', 'activo', 3),
(65, 'ada@naa.co', '', 'activo', 3),
(68, 'dajaxcinco@gmail.com', '', 'activo', 3),
(71, 'johari@msiena.ceia', '1001552722', 'activo', 2),
(72, 'daniel_', '', 'activo', 3),
(73, 'daniel@gmail.com', '', 'activo', 3),
(77, 'decamcaho@hotmail.com', '', 'activo', 3),
(78, 'santiagoro@gmal.com', '1001098556', 'activo', 2),
(80, 'elbertejada@gmail.com', '55345829', 'activo', 2),
(81, 'elbercastillo@gmail.com', '1019266221', 'activo', 2),
(82, 'danielbalonces@hotmail.com', '', 'activo', 3),
(84, 'danieltuyu@hotmail.com', '', 'activo', 3),
(85, 'debaloncesto@gmail.com', '', 'activo', 3),
(87, 'gafarsgsjai@gmail.com', '', 'activo', 3),
(88, 'dashga@gmail.cpom', '', 'activo', 3),
(89, 'asigarcursos@gmail.com', '', 'activo', 3),
(91, 'asigacursos@gmail.com', '', 'activo', 3),
(92, 'asignarcursos101@gmail.com', '', 'activo', 3),
(93, 'daniel@gmail.com.co', '', 'activo', 3),
(94, 'decamacho6@gmail.com', '', 'activo', 3),
(96, 'daniel06@misena.co', '', 'activo', 3),
(100, 'daniel@kaio.com', '', 'activo', 3),
(105, 'daniel@maji.com', '', 'activo', 3),
(107, 'elfennac@gamil.com', '', 'activo', 3),
(109, 'elfennacs@gamil.com', '', 'activo', 3),
(110, 'superoprofesor@gamil.com', '', 'activo', 3),
(111, 'tabletasamumg208@gamil.com', '', 'activo', 3),
(112, 'daniel.camacho@gmail.com', '', 'activo', 3),
(114, 'danieluicamacho@gmail.com', '', 'activo', 3),
(115, 'salud.total@gmail.com', '', 'activo', 3),
(136, 'bambambam@gmail.com', '100293562', 'activo', 2),
(138, 'danielmamaa@gamil.com', '198765322', 'activo', 2),
(139, 'agsgas@gmail.com', '286276726', 'activo', 2),
(140, 'laurammms@gmail.com', '1661417289', 'activo', 2),
(141, 'htsdvhjbs@kjasgyas.com', '19287632', 'activo', 2),
(142, 'skate@gamo.com', '0018363', 'activo', 2),
(143, 'ghj@gmacil.ocm', '098767891', 'activo', 2),
(144, 'nabsas@hagsam.com', '61176', 'activo', 2),
(145, 'danielcakska@gmail.com', '572167617', 'activo', 2),
(146, 'madnsjs@gamil.com', '1002827', 'activo', 2),
(147, 'gsgsgs@gamilc.om', '1983762', 'activo', 2),
(148, 'nabsassas@hagsam.com', '32762378', 'activo', 2),
(149, 'AlfredoCamargoNZ@gmail.com', '', 'activo', 3),
(151, 'AlfredoCamargo1992@gmail.com', '', 'activo', 3),
(152, 'jacortes@gmail.com', '', 'activo', 3),
(153, 'daniel1001082@gmail.com', '', 'activo', 3),
(154, 'eduardozarate100187@gmail.com', '', 'activo', 3),
(155, 'sexygirl@rehotmail.com', '', 'activo', 3),
(156, 'edaurdocmacho2010@gmail.com', '', 'activo', 3),
(158, 'andrechez@gmail.com', '', 'activo', 3),
(160, 'andrechez3@gmail.com', '', 'activo', 3),
(161, 'danielsanchez2002@gmail.com', '', 'activo', 3),
(162, 'danielsanchez20027@gmail.com', '100292682', 'activo', 2),
(163, 'daniel1029262@gmail.com', '82682781', 'activo', 2),
(164, 'eduardocamahshs@gmail.com', '102289202', 'activo', 2);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vwinfpro`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vwinfpro` (
`nombre` varchar(30)
,`apellido` varchar(30)
,`documento` int(11)
,`telefono` varchar(10)
,`centro_interes` varchar(30)
,`edad` int(5)
,`email` varchar(30)
,`rol` varchar(15)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vwinfpro`
--
DROP TABLE IF EXISTS `vwinfpro`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwinfpro`  AS  select `p`.`nombre` AS `nombre`,`p`.`apellido` AS `apellido`,`p`.`documento` AS `documento`,`p`.`telefono` AS `telefono`,`c`.`nombre` AS `centro_interes`,year(curdate()) - year(`p`.`fecha_nacimiento`) AS `edad`,`up`.`email` AS `email`,`ru`.`nombre` AS `rol` from (((`persona` `p` join `usuariopersona` `up` on(`p`.`id_usuario` = `up`.`id_usuario`)) join `rolusuario` `ru` on(`ru`.`id_rol` = `up`.`id_rol`)) join `centrointeres` `c` on(`c`.`id_centro` = `p`.`id_centro`)) where `ru`.`nombre` = 'Profesor' ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `asistencinscrip` (`id_inscripcion`),
  ADD KEY `asistenciasitu` (`id_situacion`),
  ADD KEY `asistenciaclase` (`id_clase`);

--
-- Indices de la tabla `categoriacentro`
--
ALTER TABLE `categoriacentro`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `centrointeres`
--
ALTER TABLE `centrointeres`
  ADD PRIMARY KEY (`id_centro`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`id_clase`),
  ADD KEY `planclase` (`id_plan`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD UNIQUE KEY `numero_curso` (`numero_curso`),
  ADD KEY `id_grado` (`id_grado`);

--
-- Indices de la tabla `detalleprofesor`
--
ALTER TABLE `detalleprofesor`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `detalleprofesor` (`id_persona`),
  ADD KEY `detallecurso` (`id_curso`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `gradocurso`
--
ALTER TABLE `gradocurso`
  ADD PRIMARY KEY (`id_grado`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `inscripcionpersona`
--
ALTER TABLE `inscripcionpersona`
  ADD PRIMARY KEY (`id_inscripcion`),
  ADD KEY `inscripersona` (`id_persona`),
  ADD KEY `inscriplan` (`id_plan`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`),
  ADD UNIQUE KEY `documento` (`documento`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_centro` (`id_centro`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `fk_id_usuario` (`id_usuario`);

--
-- Indices de la tabla `plancurso`
--
ALTER TABLE `plancurso`
  ADD PRIMARY KEY (`id_plan`),
  ADD KEY `id_centro` (`id_centro`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `rolusuario`
--
ALTER TABLE `rolusuario`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `situacion`
--
ALTER TABLE `situacion`
  ADD PRIMARY KEY (`id_situacion`);

--
-- Indices de la tabla `usuariopersona`
--
ALTER TABLE `usuariopersona`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `categoriacentro`
--
ALTER TABLE `categoriacentro`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `centrointeres`
--
ALTER TABLE `centrointeres`
  MODIFY `id_centro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `id_clase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `detalleprofesor`
--
ALTER TABLE `detalleprofesor`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `gradocurso`
--
ALTER TABLE `gradocurso`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `inscripcionpersona`
--
ALTER TABLE `inscripcionpersona`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de la tabla `plancurso`
--
ALTER TABLE `plancurso`
  MODIFY `id_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `rolusuario`
--
ALTER TABLE `rolusuario`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `situacion`
--
ALTER TABLE `situacion`
  MODIFY `id_situacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuariopersona`
--
ALTER TABLE `usuariopersona`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistenciaclase` FOREIGN KEY (`id_clase`) REFERENCES `clase` (`id_clase`),
  ADD CONSTRAINT `asistenciasitu` FOREIGN KEY (`id_situacion`) REFERENCES `situacion` (`id_situacion`),
  ADD CONSTRAINT `asistencinscrip` FOREIGN KEY (`id_inscripcion`) REFERENCES `inscripcionpersona` (`id_inscripcion`);

--
-- Filtros para la tabla `centrointeres`
--
ALTER TABLE `centrointeres`
  ADD CONSTRAINT `centrointeres_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoriacentro` (`id_categoria`);

--
-- Filtros para la tabla `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `planclase` FOREIGN KEY (`id_plan`) REFERENCES `plancurso` (`id_plan`);

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `gradocurso` (`id_grado`);

--
-- Filtros para la tabla `detalleprofesor`
--
ALTER TABLE `detalleprofesor`
  ADD CONSTRAINT `detallecurso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `detalleprofesor` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `inscripcionpersona`
--
ALTER TABLE `inscripcionpersona`
  ADD CONSTRAINT `inscripersona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`),
  ADD CONSTRAINT `inscriplan` FOREIGN KEY (`id_plan`) REFERENCES `plancurso` (`id_plan`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuariopersona` (`id_usuario`),
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `persona_ibfk_2` FOREIGN KEY (`id_centro`) REFERENCES `centrointeres` (`id_centro`),
  ADD CONSTRAINT `persona_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `plancurso`
--
ALTER TABLE `plancurso`
  ADD CONSTRAINT `plancurso_ibfk_1` FOREIGN KEY (`id_centro`) REFERENCES `centrointeres` (`id_centro`),
  ADD CONSTRAINT `plancurso_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Filtros para la tabla `usuariopersona`
--
ALTER TABLE `usuariopersona`
  ADD CONSTRAINT `usuariopersona_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rolusuario` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
