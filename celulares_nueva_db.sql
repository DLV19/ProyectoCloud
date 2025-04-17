-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2025 a las 22:18:22
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
-- Base de datos: `celulares_nueva_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `celulares`
--

CREATE TABLE `celulares` (
  `id` int(11) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `procesador` varchar(100) DEFAULT NULL,
  `almacenamiento` varchar(50) DEFAULT NULL,
  `densidad_de_pixeles` varchar(50) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `celulares`
--

INSERT INTO `celulares` (`id`, `marca`, `modelo`, `procesador`, `almacenamiento`, `densidad_de_pixeles`, `imagen`) VALUES
(4, 'Google', 'Pixel 9 Pro', 'Google Tensor G4', ' 256 GB', '460 ppi', 'celulares/Pixel_9_Pro/Google pixel 9 pro.jpg'),
(5, 'Apple', 'Iphone 16 Pro Max', 'Apple A18 Pro', '512gb', '498 ppi', 'celulares/Iphone_16_Pro_Max/Iphone 16 pro max.jpg'),
(6, 'Motorola', 'Razr 50 Ultra', 'Snapdragon 8s Gen 3', '512gb', '498 ppi', 'celulares/Razr_50_Ultra/Motorola razar50.avif'),
(7, 'One plus', 'One plus 13', 'Snapdragon 8s Gen 3', '512gb', '460 ppi', 'celulares/One_plus_13/One plus 13 pro.jpg'),
(10, 'Samsung', 'Galaxy s25 Ultra', 'Snapdragon 8s Gen 3', '512gb', '498 ppi', 'celulares/Galaxy_s25_Ultra/Galaxy s25 Ultra.jpg'),
(11, 'Huawei', 'pura 70 ULTRA', 'HiSilicon Kirin 9010', '512gb', '560 ppi', 'celulares/pura_70_ULTRA/Huawei pura 70 ultra.jpg'),
(13, 'Honor', 'Honor 200 Pro', 'Snapdragon 8s Gen 3', '512gb', '398 ppi', 'celulares/Honor_200_Pro/Honor 200 pro.png'),
(14, 'Samsung', 'Galaxy Z Flip6', 'Snapdragon 8s Gen 3', 'Snapdragon 8 Gen 3 for Galaxy', '398 ppi', 'celulares/Galaxy_Z_Flip6/samsung z flip.webp'),
(15, 'Xiaomi', 'Redmi Note 13 Pro', 'MediaTek Dimensity 7200 Ultra', '512gb', '460 ppi', 'celulares/Redmi_Note_13_Pro/Redmi note 13.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
(1, 'root@example.com', '123456'),
(2, 'dany@example.com', '123456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `celulares`
--
ALTER TABLE `celulares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `celulares`
--
ALTER TABLE `celulares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
