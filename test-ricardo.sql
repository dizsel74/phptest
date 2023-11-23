-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2023 a las 02:21:01
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
-- Base de datos: `test-ricardo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item` varchar(255) DEFAULT NULL,
  `item_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `item`, `item_type`) VALUES
(1, 'Pen', 1),
(2, 'Printer', 2),
(3, 'Marker', 1),
(4, 'Scaner', 2),
(5, 'Clear Tape', 1),
(6, 'Standing Table', 2),
(7, 'Shredder', 2),
(8, 'Paper Clip', 1),
(9, 'A4 Sheet', 1),
(10, 'Notebook', 1),
(11, 'Chair', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requests`
--

CREATE TABLE `requests` (
  `req_id` int(11) NOT NULL,
  `requested_by` varchar(50) NOT NULL,
  `requested_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ordered_on` datetime NOT NULL,
  `items` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `requests`
--

INSERT INTO `requests` (`req_id`, `requested_by`, `requested_on`, `ordered_on`, `items`) VALUES
(36, 'Arturo', '2023-11-23 00:26:07', '0000-00-00 00:00:00', '{1,1}'),
(37, 'MArco', '2023-11-23 00:35:22', '0000-00-00 00:00:00', '{3,1}'),
(38, 'Pancho', '2023-11-23 00:52:49', '0000-00-00 00:00:00', '{3,1}');

--
-- Disparadores `requests`
--
DELIMITER $$
CREATE TRIGGER `update_summary_after_update` AFTER UPDATE ON `requests` FOR EACH ROW BEGIN
    -- Eliminar los registros antiguos de la tabla summary relacionados con el registro actualizado
    DELETE FROM summary WHERE req_id = OLD.req_id;

    -- Insertar los nuevos datos actualizados en la tabla summary
    INSERT INTO summary (req_id, requested_by, ordered_on, items)
    VALUES (NEW.req_id, NEW.requested_by, NEW.ordered_on, NEW.items);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `summary`
--

CREATE TABLE `summary` (
  `req_id` int(11) NOT NULL DEFAULT 0,
  `requested_by` varchar(50) NOT NULL,
  `ordered_on` datetime NOT NULL,
  `items` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `summary`
--

INSERT INTO `summary` (`req_id`, `requested_by`, `ordered_on`, `items`) VALUES
(36, 'Arturo', '2023-11-22 19:19:31', '{1,1}'),
(37, 'MArco', '2023-11-22 19:19:31', '{3,1}'),
(38, 'Pancho', '2023-11-22 19:19:31', '{3,1}');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_type` (`item_type`);

--
-- Indices de la tabla `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `Tipo_item_type` (`items`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `requests`
--
ALTER TABLE `requests`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
