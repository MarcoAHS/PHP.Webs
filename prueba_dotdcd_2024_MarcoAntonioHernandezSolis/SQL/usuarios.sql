-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2024 a las 04:18:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `usuarios`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addUser` (IN `nombre` VARCHAR(45), IN `telefono` VARCHAR(45), IN `correo` VARCHAR(50), IN `contra` VARCHAR(128), IN `fecha` DATE, IN `rfc_in` VARCHAR(40), IN `tipo` TINYINT)   INSERT into users (name, phone, email, password, born_date, RFC, user_type, active)
VALUES (nombre, telefono, correo, contra, fecha, rfc_in, tipo, 1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `auth` (IN `correo` VARCHAR(40))   SELECT name, email, user_type, password FROM users
WHERE users.email = correo
LIMIT 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarUser` (IN `eliminado` INT)   UPDATE users
SET active = 0
WHERE id = eliminado$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUsersJoinUserTypes` (IN `inicio` INT, IN `limite` INT, IN `busqueda` VARCHAR(50))   SELECT users.id as id, users.name as name, users.phone as phone,
users.email as email, usertypes.role as rol
FROM users
JOIN usertypes  
ON users.user_type = usertypes.id
WHERE users.active = 1 AND users.name like busqueda
LIMIT inicio, limite$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `totalRegistros` (IN `busqueda` VARCHAR(30))   SELECT Count(id) as Total 
FROM users
WHERE name LIKE busqueda$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `upUser` (IN `id_u` INT, IN `name_u` VARCHAR(40), IN `phone_u` VARCHAR(30), IN `email_u` VARCHAR(45), IN `password_u` VARCHAR(128), IN `date_u` DATE, IN `rfc_u` VARCHAR(50), IN `type` TINYINT)   UPDATE users
SET name = name_u,
phone = phone_u,
email = email_u,
password = password_u,
born_date = date_u,
RFC = rfc_u,
user_type = type
WHERE id = id_u$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `userInfo` (IN `idBuscar` INT)   SELECT * FROM users
WHERE id = idBuscar$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `born_date` date NOT NULL,
  `RFC` varchar(50) NOT NULL,
  `user_type` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `born_date`, `RFC`, `user_type`, `active`) VALUES
(8, 'Marco Antonio Hernandez Solis', '8113493064', 'hola@hola', '$2y$10$8Dhwvg6./QyZZfTGlV5jA.k40S2mtmz0lEIROLOuG1KxoDeMl.Jq6', '2024-06-05', 'HEsmaaaaaaaaaaaa', 1, 1),
(9, 'Rebeca', '923144141', 'adios@adios', '$2y$10$p.EItR.I0eUu.zqM0gweiO6QSpzx0381eASBgJ8LDtbwT0SK7i1hq', '2024-06-06', 'HEsmaaaaaaaaaaaa', 2, 1),
(10, 'Abel Hernandez', '814141141', 'no@no', '$2y$10$iQmVB0lBZzRSewTnWh4Qnuk8owJDI7hC3vYprgfaWh1vo.cneJsfC', '2024-06-07', 'hesadaaaaaa', 2, 1),
(11, 'Hernan', '2921444414', 'si@si', '$2y$10$j5LLYbglIyIs8FYlsjC8LeAcgbap9tG4I3LrB36UWj5hPKMEYcMXu', '2024-06-07', 'herarasdfafafsfa', 3, 1),
(12, 'Vini', '92412412351', 'real@real', '$2y$10$C1orWYl80tYkuzugaRIvOOvBFAnGpAFyYpImnxHxyxL8fJ1u0kwBS', '2024-05-31', 'veeeeeeeeeeeeeeeeeee', 2, 1),
(13, 'Fede', '2143513515', 'pajaro@pajaro', '$2y$10$DHRuVR8hSCOGuNLZgie41u4V0p3x5MdyrpU90REp61O5CQou34s.a', '2024-06-27', 'feeeeeeeeeeeeeeeeeeeeeee', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usertypes`
--

CREATE TABLE `usertypes` (
  `id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usertypes`
--

INSERT INTO `usertypes` (`id`, `role`) VALUES
(1, 'Administrador'),
(2, 'Empleado'),
(3, 'Ejecutivo de Ventas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_types` (`user_type`);

--
-- Indices de la tabla `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_types` FOREIGN KEY (`user_type`) REFERENCES `usertypes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
