-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2020 a las 10:42:49
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nomina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepts`
--

CREATE TABLE `concepts` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `percent` decimal(2,2) NOT NULL,
  `enterprise_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `concepts`
--

INSERT INTO `concepts` (`id`, `name`, `type`, `percent`, `enterprise_id`) VALUES
(1, 'Prima por hijos', 1, '0.50', 4),
(2, 'IVSS', 0, '-0.23', 18),
(3, 'prima por primo', 1, '0.60', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `enterprise_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `department`
--

INSERT INTO `department` (`id`, `name`, `enterprise_id`) VALUES
(1, 'informatica', 4),
(2, 'Obreros', 4),
(3, 'Administracion', 18),
(4, 'Obrero', 18),
(5, 'departamento 8', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `birthdate` date NOT NULL,
  `hiredate` date NOT NULL,
  `department_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `name`, `dni`, `birthdate`, `hiredate`, `department_id`, `job_id`) VALUES
(9, 'Jhoseph Guerrero', '1546', '2020-07-14', '2020-07-06', 1, 6),
(10, 'Jhoseph asdasd', '626', '2020-07-14', '2020-07-08', 1, 6),
(11, 'devsktop asdasd', '3', '2020-07-15', '2020-07-07', 3, 7),
(12, 'ozuna Gonzalo', '456465', '2020-07-17', '2020-07-09', 5, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enterprise`
--

CREATE TABLE `enterprise` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `rif` varchar(45) NOT NULL,
  `dir` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `risk` decimal(2,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `enterprise`
--

INSERT INTO `enterprise` (`id`, `name`, `rif`, `dir`, `phone`, `risk`) VALUES
(4, 'devsktop', 'V-26773668', 'La C2', '041464136513', '0.09'),
(18, 'pulpo', 'V-456', 'La C2', '456456', '0.10'),
(20, 'ozuna', 'V-456456', 'La C2', '5656', '0.10'),
(22, 'sd', 'V-5463', 'La C2', '546456', '0.09'),
(25, 'fgdfgdffg', 'V-65456456456456', 'La C2', '456456456', '0.09'),
(27, 'ozunakk', 'V-1111111', 'fghfgh', '11111', '0.11'),
(37, 'activo', 'V-0456', '65654', '645454', '0.10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `weekhours` int(10) UNSIGNED NOT NULL,
  `price_hour` decimal(10,2) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `job`
--

INSERT INTO `job` (`id`, `name`, `weekhours`, `price_hour`, `department_id`) VALUES
(5, 'Limpieza', 45, '50000.00', 2),
(6, 'ozuna', 45, '60000.00', 1),
(7, 'Adminis', 45, '50.00', 3),
(8, 'cargo axctivo', 30, '10000.00', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `question` varchar(45) NOT NULL,
  `answer` varchar(45) NOT NULL,
  `admin` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `question`, `answer`, `admin`) VALUES
(1, 'admin', 'admin123', 'Carrera de urbe', 'informatica', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `concepts`
--
ALTER TABLE `concepts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_concepts_enterprise1_idx` (`enterprise_id`);

--
-- Indices de la tabla `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_department_enterprise_idx` (`enterprise_id`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `fk_employees_department1_idx` (`department_id`),
  ADD KEY `fk_employees_job1_idx` (`job_id`);

--
-- Indices de la tabla `enterprise`
--
ALTER TABLE `enterprise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enterprise_id_UNIQUE` (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `rif_UNIQUE` (`rif`);

--
-- Indices de la tabla `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_job_department1_idx` (`department_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `concepts`
--
ALTER TABLE `concepts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `enterprise`
--
ALTER TABLE `enterprise`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `concepts`
--
ALTER TABLE `concepts`
  ADD CONSTRAINT `fk_concepts_enterprise1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprise` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `fk_department_enterprise` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprise` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_employees_department1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employees_job1` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `fk_job_department1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
