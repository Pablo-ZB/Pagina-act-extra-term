-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2024 a las 20:44:19
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `act_extraescolares`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `ID_Actividad` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Tipo` text NOT NULL,
  `Horario1` varchar(100) DEFAULT NULL,
  `Horario2` varchar(100) DEFAULT NULL,
  `Sedes` varchar(20) NOT NULL,
  `Inscritos` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`ID_Actividad`, `Nombre`, `Tipo`, `Horario1`, `Horario2`, `Sedes`, `Inscritos`) VALUES
(1, 'Futbol', 'Deportiva', 'Lun, Mie, Vie 08:00', 'Mar, Jue, Vie 17:10', 'Unipoli, CONADE', 3),
(2, 'Basquetbol', 'Deportiva', 'Lun, Mar, Mie 09:10', 'Mar, Mie, Jue 17:20', 'Unipoli, CONADE', 1),
(3, 'Danza', 'Cultural', 'Lun, Mar, Mie, Jue 09:20', 'Mar, Mie, Jue 17:20', 'Unipoli', 1),
(4, 'Rondalla', 'Cultural', 'Mar, Jue 17:20', 'Mar, Vie 14:10', 'Unipoli', 0),
(5, 'Defensa Personal', 'Deportiva', 'Mar, Jue, Vie 10:30', 'Lun, Mie, Vie 17:00', 'Unipoli', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `Matricula` int(15) NOT NULL,
  `Nombre` text NOT NULL,
  `Apellido_Paterno` text DEFAULT NULL,
  `Apellido_Materno` text DEFAULT NULL,
  `Carrera` text NOT NULL,
  `Grupo` varchar(2) NOT NULL,
  `Actividad` tinytext DEFAULT NULL,
  `Correo_Electronico` varchar(100) DEFAULT NULL,
  `Horario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`Matricula`, `Nombre`, `Apellido_Paterno`, `Apellido_Materno`, `Carrera`, `Grupo`, `Actividad`, `Correo_Electronico`, `Horario`) VALUES
(2103150173, 'Juan Pablo', 'Zuñiga', 'Bustillos', 'Ingeniería en Software', '1a', 'Futbol', 'zuniga.juan.irt@unipolidgo.edu.mx', 'Lun, Mie, Vie 08:00'),
(2103150451, 'Jose', 'Soto', 'Ramirez', 'Ingeniería Civíl', '4b', 'Basquetbol', 'JoseSoto@gmal.com', 'Mar, Mie, Jue 17:20'),
(2103150693, 'María', 'Hernandez', 'Gutierrez', 'Licenciatura en Administración y Gestión Empresarial', '4a', 'Danza', 'Maria@gmail.com', 'Lun, Mar, Mie, Jue 09:20'),
(2103150693, 'René', 'Soto', 'Gutierrez', 'Ingeniería en Tecnología Ambiental', '1a', 'Futbol', 'JoseSoto@gmal.com', 'Lun, Mie, Vie 08:00'),
(2103150134, 'María', 'Hernandez', 'Ramirez', 'Ingeniería Civíl', '1a', 'Futbol', 'Manuel@gmail.com', 'Mar, Jue, Vie 17:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructores`
--

CREATE TABLE `instructores` (
  `ID_Instructor` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `Apellido_Paterno` text DEFAULT NULL,
  `Apellido_Materno` text DEFAULT NULL,
  `Disciplina` varchar(15) NOT NULL,
  `Perfil` text NOT NULL,
  `Nombre_usuario` varchar(40) DEFAULT NULL,
  `Contrasena` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instructores`
--

INSERT INTO `instructores` (`ID_Instructor`, `Nombre`, `Apellido_Paterno`, `Apellido_Materno`, `Disciplina`, `Perfil`, `Nombre_usuario`, `Contrasena`) VALUES
(1, 'Pablo', 'Admin', 'Admin', '', 'Administrador', 'Pablo_Admin', '$2y$10$0kXlfBkYYjYhny3BfZeENe6ohaWwViYsYj0K/r3cwXOZW9Cy5pR8K'),
(2, 'Omar', 'Rivera', 'Garcia', 'Futbol', 'Instructor', 'Omar_Rivera', '$2y$10$FOWBjf2soyV8fJDgo0lm2e0d.qASvA5MurO/cx3OlAaL74lcBIOsm');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`ID_Actividad`);

--
-- Indices de la tabla `instructores`
--
ALTER TABLE `instructores`
  ADD PRIMARY KEY (`ID_Instructor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `ID_Actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `instructores`
--
ALTER TABLE `instructores`
  MODIFY `ID_Instructor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
