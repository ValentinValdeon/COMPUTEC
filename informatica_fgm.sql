-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2025 a las 18:42:27
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
-- Base de datos: `informatica_fgm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(5, 'Seguridad'),
(6, 'Telfono'),
(7, 'PC'),
(8, 'Wifi'),
(9, 'Electronica'),
(10, 'Sonido'),
(12, 'Periférico'),
(13, 'Antena'),
(14, 'Consolas'),
(15, 'Pantallas'),
(16, 'Camaras'),
(17, 'Teclados'),
(18, 'Gaming'),
(19, 'Auriculares'),
(20, 'Pasteleria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuento`
--

CREATE TABLE `descuento` (
  `id_descuento` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `descuento`
--

INSERT INTO `descuento` (`id_descuento`, `cantidad`) VALUES
(8, 5),
(7, 10),
(4, 15),
(5, 25),
(6, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `codigo` bigint(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_min` int(11) NOT NULL,
  `prop_1` varchar(25) DEFAULT NULL,
  `prop_2` varchar(25) DEFAULT NULL,
  `prop_3` varchar(25) DEFAULT NULL,
  `destacado` int(11) NOT NULL DEFAULT 0,
  `descripcion` varchar(300) NOT NULL,
  `imagen_1` varchar(255) DEFAULT NULL,
  `imagen_2` varchar(255) DEFAULT NULL,
  `imagen_3` varchar(255) DEFAULT NULL,
  `id_descuento` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `codigo`, `nombre`, `precio_compra`, `precio_venta`, `stock`, `stock_min`, `prop_1`, `prop_2`, `prop_3`, `destacado`, `descripcion`, `imagen_1`, `imagen_2`, `imagen_3`, `id_descuento`, `estado`) VALUES
(37, 1111111111, 'Mouse Logitech g502X', 80000, 160000, 15, 4, 'Inalámbrico ', '21k dpi', 'Negro', 1, 'Mouse de alta calidad, buen precio y buen agarre.', 'producto_37_img1_1758294873.jfif', 'producto_37_img2_1758294873.jfif', 'producto_37_img3_1758294873.jpg', 7, 1),
(38, 1222222222, 'Mouse Logitech g502X', 90000, 185000, 15, 5, 'Inalámbrico ', '26k dpi', 'Blanco', 1, 'Mouse logitech de buena calidad y buen precio.', 'producto_38_img1_1758295263.webp', 'producto_38_img2_1758295263.jpg', 'producto_38_img3_1758295263.png', NULL, 1),
(39, 211111111, 'Mouse Logitech Clasic Superlight', 50000, 110000, 5, 1, '12k dpi', 'Blanco/Negro', 'Cableado', 1, 'Mouse clasico de alta claidad y precio', 'producto_39_img1_1758333320.jfif', 'producto_39_img2_1758295381.jfif', 'producto_39_img3_1758333320.jfif', 6, 1),
(40, 31111111111, 'Antena TP-Link', 120000, 170000, 3, 5, '5mts de largo', '10km alcance', 'Parábola', 1, 'Antena tp-link de largo alcance con conexión de alta potencia', 'producto_40_img1_1758295533.jpg', 'producto_40_img2_1758295533.webp', 'producto_40_img3_1758295533.jpg', 5, 1),
(41, 4111111111, 'Camara de seguridad little', 80000, 144000, 50, 20, 'Full hd', 'Vision nocturna', 'Wifi', 1, 'Camaras de seguirdad para que ningun villerito te robe', 'producto_41_img1_1758295813.jfif', 'producto_41_img2_1758295813.jfif', 'producto_41_img3_1758295813.jfif', 7, 1),
(42, 3333049957, 'Camara de seguridad little pro max', 100000, 230000, 15, 3, '4k', '360 deg', 'Wifi', 1, 'Altas camaras de seguridad hermanoooooo', 'producto_42_img1_1758295920.jfif', 'producto_42_img2_1758295920.jfif', 'producto_42_img3_1758295920.jfif', 7, 1),
(43, 826737816371, 'Iphone 16 pro MAX', 400000, 700000, 10, 2, '1Tb de memoria', '16Gb RAM', '300MP', 1, 'celular apple casi ultimop', 'producto_43_img1_1758296027.jfif', 'producto_43_img2_1758296027.jfif', 'producto_43_img3_1758296027.jfif', 6, 1),
(44, 48721641284, 'Iphone 17', 500000, 1000000, 50, 15, '2Tb memoria', '32 Gb', 'Pantalla O-Led', 1, 'otro apple', 'producto_44_img1_1758333349.jfif', 'producto_44_img2_1758333349.jfif', 'producto_44_img3_1758296108.jfif', 6, 1),
(45, 8371893781, 'Samsun Galaxy s25 Ultra', 650000, 1200000, 30, 10, 'Camara Ful-hd', '5G compatible', '7.2 pulgadas', 1, 'la competencia del iphone boee', 'producto_45_img1_1758333381.jfif', 'producto_45_img2_1758333381.jfif', 'producto_45_img3_1758296196.jfif', 7, 1),
(46, 873182933, 'PS5', 1000000, 1600000, 5, 0, '+2 Joystick ', '+Memoria 1Tb', '120Fps', 1, 'Play Station 5 plus + 5mil juegos', 'producto_46_img1_1758296322.jfif', 'producto_46_img2_1758296322.jfif', 'producto_46_img3_1758296322.jfif', NULL, 1),
(47, 8162663281, 'Consola Arcade + 20mil Juegos', 30000, 54000, 55, 12, '+2 Joystick (ps4)', 'USB (con los juegos)', 'Conexión USB', 1, 'Consola con +20mil juegos retro/arcade', 'producto_47_img1_1758296440.jfif', 'producto_47_img2_1758296440.jfif', 'producto_47_img3_1758296440.jfif', 7, 1),
(48, 3489791874281, 'Auriculares Logitech', 45000, 80000, 10, 2, '230DbL', 'Celeste/Violeta/Blanco', 'Microfono integrado', 0, 'buenos auris de virgo momo', 'producto_48_img1_1758303016.jfif', 'producto_48_img2_1758303016.jfif', 'producto_48_img3_1758303016.jfif', NULL, 1),
(49, 894123614, 'Cascos logitech', 50000, 100000, 10, 1, '230plus', 'Blanco/Rosa/Negro', 'Wireless', 1, 'otros auris pero no de virgo', 'producto_49_img1_1758303101.jfif', 'producto_49_img2_1758303101.jfif', 'producto_49_img3_1758303101.jfif', 4, 1),
(50, 44848865454, 'Auris Xiaomi Node', 30000, 60000, 10, 4, 'Bluetooth', 'Carga +12h', 'Negro/Azul', 0, 'auriculares inhalambricos para celulares', 'producto_50_img1_1758303392.jfif', 'producto_50_img2_1758303392.jfif', 'producto_50_img3_1758303392.jfif', 7, 1),
(51, 213890141, 'Monitor Asus RogStrix', 340000, 680000, 10, 5, 'Curvo', '4k', '144Hz', 1, 'Pantalla de alta calidad', 'producto_51_img1_1758303466.jfif', 'producto_51_img2_1758303466.jfif', 'producto_51_img3_1758303466.jfif', 5, 1),
(52, 123468123, 'Monitor Asus TUF-Gaming', 400000, 730000, 10, 4, '4k-OLED', '165Hz', 'IPS', 1, 'otro monitor re picante', 'producto_52_img1_1758303527.jfif', 'producto_52_img2_1758303527.jfif', 'producto_52_img3_1758303527.jfif', 7, 1),
(53, 233124123, 'Notebook Mac Pro', 650000, 1200000, 40, 12, '64Gb', '19\"', 'Plateada', 1, 'buena pc de apple', 'producto_53_img1_1758303628.jfif', 'producto_53_img2_1758303628.jfif', 'producto_53_img3_1758303628.jfif', NULL, 1),
(54, 128371471, 'Parlante JBL (cuadrado)', 12000, 30000, 100, 14, '3 colores', '120Db', '4hs de bateria', 1, 'parlantito para la previa', 'producto_54_img1_1758303716.jfif', 'producto_54_img2_1758303716.jfif', 'producto_54_img3_1758303716.jfif', 7, 1),
(55, 123876498, 'Parlante JBL (cilindro)', 22000, 40000, 120, 30, '3 colores', 'Bluetooth', '+6hs de carga', 1, 'otro parlante mas grande', 'producto_55_img1_1758303801.jfif', 'producto_55_img2_1758303801.jfif', 'producto_55_img3_1758303801.jfif', 4, 1),
(56, 18467812, 'Teclado KMLs', 120000, 150000, 15, 2, 'Switch blue/red', '65%', 'Formato Ingles', 1, 'teclado personalizado mecanico', 'producto_56_img1_1758303900.jfif', 'producto_56_img2_1758303900.jfif', 'producto_56_img3_1758303900.jfif', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_categoria`
--

CREATE TABLE `producto_categoria` (
  `id_producto_categoria` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_categoria`
--

INSERT INTO `producto_categoria` (`id_producto_categoria`, `id_producto`, `id_categoria`) VALUES
(74, 37, 7),
(75, 37, 12),
(76, 37, 18),
(78, 38, 7),
(79, 38, 12),
(80, 38, 18),
(82, 39, 7),
(84, 39, 12),
(83, 39, 18),
(86, 40, 8),
(87, 40, 9),
(88, 40, 13),
(91, 41, 5),
(90, 41, 8),
(93, 41, 12),
(92, 41, 16),
(95, 42, 5),
(96, 42, 8),
(97, 42, 9),
(98, 42, 12),
(99, 42, 16),
(101, 43, 6),
(102, 43, 8),
(103, 43, 10),
(105, 44, 6),
(106, 44, 8),
(107, 44, 10),
(109, 45, 6),
(110, 45, 8),
(111, 45, 10),
(113, 46, 9),
(114, 46, 14),
(115, 46, 18),
(117, 47, 9),
(118, 47, 12),
(119, 47, 14),
(120, 47, 18),
(122, 48, 7),
(123, 48, 10),
(124, 48, 12),
(125, 48, 18),
(126, 48, 19),
(128, 49, 7),
(129, 49, 10),
(130, 49, 12),
(131, 49, 18),
(132, 49, 19),
(134, 50, 6),
(135, 50, 9),
(136, 50, 10),
(137, 50, 19),
(139, 51, 7),
(140, 51, 12),
(141, 51, 15),
(142, 51, 18),
(144, 52, 7),
(145, 52, 12),
(146, 52, 15),
(147, 52, 18),
(149, 53, 7),
(150, 53, 9),
(151, 53, 18),
(153, 54, 6),
(154, 54, 9),
(155, 54, 10),
(156, 54, 12),
(158, 55, 6),
(159, 55, 9),
(160, 55, 10),
(161, 55, 12),
(163, 56, 7),
(164, 56, 9),
(165, 56, 12),
(166, 56, 17),
(167, 56, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subs`
--

CREATE TABLE `subs` (
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `estado` tinyint(4) DEFAULT 1,
  `remember_token` varchar(64) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultimo_acceso` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `password_hash`, `nombre`, `email`, `estado`, `remember_token`, `created_at`, `ultimo_acceso`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador', 'admin@productmanager.com', 1, NULL, '2025-09-15 00:05:34', '2025-09-22 00:15:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `descuento`
--
ALTER TABLE `descuento`
  ADD PRIMARY KEY (`id_descuento`),
  ADD UNIQUE KEY `cantidad` (`cantidad`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `UNIQUE` (`codigo`);

--
-- Indices de la tabla `producto_categoria`
--
ALTER TABLE `producto_categoria`
  ADD PRIMARY KEY (`id_producto_categoria`),
  ADD UNIQUE KEY `uk_producto_categoria` (`id_producto`,`id_categoria`),
  ADD KEY `fk_categoria` (`id_categoria`);

--
-- Indices de la tabla `subs`
--
ALTER TABLE `subs`
  ADD UNIQUE KEY `id_subs` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `descuento`
--
ALTER TABLE `descuento`
  MODIFY `id_descuento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `producto_categoria`
--
ALTER TABLE `producto_categoria`
  MODIFY `id_producto_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_descuento` FOREIGN KEY (`id_descuento`) REFERENCES `descuento` (`id_descuento`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_categoria`
--
ALTER TABLE `producto_categoria`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
