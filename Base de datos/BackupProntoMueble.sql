-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-02-2021 a las 19:22:56
-- Versión del servidor: 10.4.14-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u925028044_prontomueble`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `Temp_ID` bigint(20) UNSIGNED NOT NULL,
  `Temp_Precio` decimal(11,2) NOT NULL,
  `Temp_Cant` int(11) NOT NULL,
  `Temp_TransID` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Prod_ID` bigint(11) UNSIGNED DEFAULT NULL,
  `Per_ID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_temp`
--

INSERT INTO `detalle_temp` (`Temp_ID`, `Temp_Precio`, `Temp_Cant`, `Temp_TransID`, `Prod_ID`, `Per_ID`) VALUES
(206, '800000.00', 4, '717m1gej9h92gvlc5f7sgq3nj1', 1, 1),
(207, '85000.00', 5, '4d1rlc8sdl0d3mffdjb7b7sbi6', 5, 2),
(208, '1500000.00', 1, '6b4d0cf30b4aaca0951736600207afb2', 8, 7),
(209, '60000.00', 8, '46ee6c5de27f864724b568324ce02d16', 3, 2),
(210, '1500000.00', 4, '6a2018a3b0b00890104c89c00ae6da8d', 8, 2),
(211, '800000.00', 2, 'a92cd3d6a3cdc7db7da1b19a23fb0c70', 4, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_ped`
--

CREATE TABLE `det_ped` (
  `Det_ID` bigint(20) UNSIGNED NOT NULL,
  `Det_Precio` decimal(11,2) NOT NULL,
  `Det_Cant` int(11) NOT NULL,
  `Ped_ID` bigint(20) UNSIGNED DEFAULT NULL,
  `Prod_ID` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `det_ped`
--

INSERT INTO `det_ped` (`Det_ID`, `Det_Precio`, `Det_Cant`, `Ped_ID`, `Prod_ID`) VALUES
(23, '800000.00', 4, 1, 1),
(24, '85000.00', 5, 2, 5),
(25, '1500000.00', 1, 3, 8),
(26, '60000.00', 8, 4, 3),
(27, '1500000.00', 4, 5, 8),
(28, '800000.00', 2, 6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `Cat_ID` bigint(20) UNSIGNED NOT NULL,
  `Prov_ID` bigint(20) UNSIGNED NOT NULL,
  `Env_Cant` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `envio`
--

INSERT INTO `envio` (`Cat_ID`, `Prov_ID`, `Env_Cant`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `estadisiticascliente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `estadisiticascliente` (
`COUNT(*)` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `estadisticasempleados`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `estadisticasempleados` (
`COUNT(*)` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `Img_ID` bigint(20) UNSIGNED NOT NULL,
  `Img_Nom` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Prod_ID` bigint(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`Img_ID`, `Img_Nom`, `Prod_ID`) VALUES
(2, 'pro_ca8dd428c9fe3e0a0a22c1dc3fa56997.jpg', 1),
(3, 'pro_d0244bfb73b9cd1596bbab53eac809ac.jpg', 2),
(4, 'pro_dc188eedd75c224fde814b465d1fd433.jpg', 3),
(5, 'pro_eccaabf5db2c404e3adf767fd9d13ab8.jpg', 4),
(6, 'pro_78ff570ac2c44573c6bb88ed2c239a81.jpg', 5),
(7, 'pro_30d78d256d93348fb9ff22e27b087c1e.jpg', 6),
(8, 'pro_394821dc664f218c0062f463ceb9c1ea.jpg', 7),
(9, 'pro_492ad1565d7f4ef4216b5a99c3656e07.jpg', 8),
(10, 'pro_554a445654b1c5bea3a69d762b3d7df9.jpg', 9),
(11, 'pro_90f1dfb41911104c463141b4e9913864.jpg', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `Mod_ID` bigint(20) UNSIGNED NOT NULL,
  `Mod_Nom` varchar(50) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `Mod_Desc` text COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `Mod_Status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`Mod_ID`, `Mod_Nom`, `Mod_Desc`, `Mod_Status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del sistema', 1),
(3, 'Clientes', 'Clientes de tienda', 1),
(4, 'Productos', 'Todos los productos', 1),
(5, 'Pedidos', 'Pedidos', 1),
(6, 'Caterogías', 'Caterogías Productos', 1),
(7, 'Proveedores', 'Acceso al suministro de la tienda', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `Ped_ID` bigint(20) UNSIGNED NOT NULL,
  `Ped_RefCobro` varchar(255) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `Ped_IDPayPal` varchar(255) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `Ped_DatPayPal` text COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `Ped_FechPed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Ped_CostEnv` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Ped_Total` decimal(11,2) NOT NULL,
  `Ped_Dest` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `Ped_Status` varchar(100) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `Per_ID` bigint(20) UNSIGNED DEFAULT NULL,
  `Pag_ID` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`Ped_ID`, `Ped_RefCobro`, `Ped_IDPayPal`, `Ped_DatPayPal`, `Ped_FechPed`, `Ped_CostEnv`, `Ped_Total`, `Ped_Dest`, `Ped_Status`, `Per_ID`, `Pag_ID`) VALUES
(1, NULL, '0LJ96853777245136', '{\"create_time\":\"2021-02-22T16:26:05Z\",\"update_time\":\"2021-02-22T16:26:22Z\",\"id\":\"7MN01100UD520392N\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-xxx8y5094701@personal.example.com\",\"payer_id\":\"AQNZ5DABCVSBS\",\"address\":{\"country_code\":\"GT\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de articulos en ProntoMueble por $3215000\",\"reference_id\":\"default\",\"amount\":{\"value\":\"900.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-bh9dt5074492@business.example.com\",\"merchant_id\":\"M5WMXUPCET2CU\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Guatemala City\",\"admin_area_1\":\"Guatemala City\",\"postal_code\":\"01001\",\"country_code\":\"GT\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"0LJ96853777245136\",\"final_capture\":true,\"create_time\":\"2021-02-22T16:26:22Z\",\"update_time\":\"2021-02-22T16:26:22Z\",\"amount\":{\"value\":\"900.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/0LJ96853777245136\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/0LJ96853777245136/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/7MN01100UD520392N\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/7MN01100UD520392N\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}', '2021-02-22 16:26:25', '15000.00', '3215000.00', 'Calle 177 sur, Bogota', 'Aprobado', 1, 1),
(2, NULL, '96L12035SD215943F', '{\"create_time\":\"2021-02-22T16:28:57Z\",\"update_time\":\"2021-02-22T16:29:10Z\",\"id\":\"00690999T76885102\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-xxx8y5094701@personal.example.com\",\"payer_id\":\"AQNZ5DABCVSBS\",\"address\":{\"country_code\":\"GT\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de articulos en ProntoMueble por $440000\",\"reference_id\":\"default\",\"amount\":{\"value\":\"123.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-bh9dt5074492@business.example.com\",\"merchant_id\":\"M5WMXUPCET2CU\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Guatemala City\",\"admin_area_1\":\"Guatemala City\",\"postal_code\":\"01001\",\"country_code\":\"GT\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"96L12035SD215943F\",\"final_capture\":true,\"create_time\":\"2021-02-22T16:29:10Z\",\"update_time\":\"2021-02-22T16:29:10Z\",\"amount\":{\"value\":\"123.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/96L12035SD215943F\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/96L12035SD215943F/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/00690999T76885102\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/00690999T76885102\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}', '2021-02-22 16:29:12', '15000.00', '440000.00', 'asad, ads', 'Aprobado', 2, 1),
(3, NULL, '7HX28008WS1498314', '{\"create_time\":\"2021-02-22T18:44:50Z\",\"update_time\":\"2021-02-22T18:45:07Z\",\"id\":\"6FR15060AM8300616\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-xxx8y5094701@personal.example.com\",\"payer_id\":\"AQNZ5DABCVSBS\",\"address\":{\"country_code\":\"GT\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de articulos en ProntoMueble por $1515000\",\"reference_id\":\"default\",\"amount\":{\"value\":\"424.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-bh9dt5074492@business.example.com\",\"merchant_id\":\"M5WMXUPCET2CU\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Guatemala City\",\"admin_area_1\":\"Guatemala City\",\"postal_code\":\"01001\",\"country_code\":\"GT\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"7HX28008WS1498314\",\"final_capture\":true,\"create_time\":\"2021-02-22T18:45:07Z\",\"update_time\":\"2021-02-22T18:45:07Z\",\"amount\":{\"value\":\"424.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/7HX28008WS1498314\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/7HX28008WS1498314/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/6FR15060AM8300616\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/6FR15060AM8300616\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}', '2021-02-22 18:45:08', '15000.00', '1515000.00', 'asda, ads', 'Aprobado', 7, 1),
(4, NULL, NULL, NULL, '2021-02-22 18:53:11', '15000.00', '495000.00', 'asda, as', 'Pendiente', 2, 4),
(5, NULL, '1XH296909T473303H', '{\"create_time\":\"2021-02-23T16:47:41Z\",\"update_time\":\"2021-02-23T16:47:59Z\",\"id\":\"88K54510G1746363F\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-xxx8y5094701@personal.example.com\",\"payer_id\":\"AQNZ5DABCVSBS\",\"address\":{\"country_code\":\"GT\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de articulos en ProntoMueble por $6015000\",\"reference_id\":\"default\",\"amount\":{\"value\":\"1684.00\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-bh9dt5074492@business.example.com\",\"merchant_id\":\"M5WMXUPCET2CU\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Guatemala City\",\"admin_area_1\":\"Guatemala City\",\"postal_code\":\"01001\",\"country_code\":\"GT\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"1XH296909T473303H\",\"final_capture\":true,\"create_time\":\"2021-02-23T16:47:59Z\",\"update_time\":\"2021-02-23T16:47:59Z\",\"amount\":{\"value\":\"1684.00\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/1XH296909T473303H\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/1XH296909T473303H/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/88K54510G1746363F\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/88K54510G1746363F\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}', '2021-02-23 16:48:00', '15000.00', '6015000.00', 'asd, asd', 'Aprobado', 2, 1),
(6, NULL, NULL, NULL, '2021-02-25 05:29:45', '15000.00', '1615000.00', 'calle novengas #42, Narnia', 'Pendiente', 9, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `Perm_ID` bigint(20) UNSIGNED NOT NULL,
  `Perm_Vista` int(11) DEFAULT NULL,
  `Perm_Crear` int(11) DEFAULT NULL,
  `Perm_Act` int(11) DEFAULT NULL,
  `Perm_Elim` int(11) DEFAULT NULL,
  `Rol_ID` bigint(10) UNSIGNED DEFAULT NULL,
  `Mod_ID` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`Perm_ID`, `Perm_Vista`, `Perm_Crear`, `Perm_Act`, `Perm_Elim`, `Rol_ID`, `Mod_ID`) VALUES
(626, 0, 0, 0, 0, 7, 1),
(627, 0, 0, 0, 0, 7, 2),
(628, 0, 0, 0, 0, 7, 3),
(629, 0, 0, 0, 0, 7, 4),
(630, 1, 0, 0, 0, 7, 5),
(631, 0, 0, 0, 0, 7, 6),
(644, 1, 0, 0, 0, 3, 1),
(645, 1, 0, 0, 0, 3, 2),
(646, 1, 1, 1, 0, 3, 3),
(647, 1, 1, 1, 0, 3, 4),
(648, 1, 0, 0, 0, 3, 5),
(649, 1, 1, 1, 0, 3, 6),
(650, 1, 1, 1, 1, 2, 1),
(651, 1, 1, 1, 1, 2, 2),
(652, 1, 1, 1, 1, 2, 3),
(653, 1, 1, 1, 1, 2, 4),
(654, 1, 1, 1, 1, 2, 5),
(655, 1, 1, 1, 1, 2, 6),
(656, 1, 1, 1, 0, 6, 1),
(657, 1, 1, 1, 0, 6, 2),
(658, 1, 1, 1, 0, 6, 3),
(659, 1, 1, 1, 0, 6, 4),
(660, 1, 1, 1, 0, 6, 5),
(661, 1, 1, 1, 0, 6, 6),
(662, 1, 1, 1, 1, 1, 1),
(663, 1, 1, 1, 1, 1, 2),
(664, 1, 1, 1, 1, 1, 3),
(665, 1, 1, 1, 1, 1, 4),
(666, 1, 1, 1, 1, 1, 5),
(667, 1, 1, 1, 1, 1, 6),
(668, 1, 1, 1, 1, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `Per_ID` bigint(20) UNSIGNED NOT NULL,
  `Per_Doc` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Per_Nom` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Per_Ape` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Per_Tel` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Per_Email` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Per_Passw` varchar(75) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Per_Toke` varchar(100) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `Per_FecReg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Per_Status` int(11) DEFAULT 1,
  `Rol_ID` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`Per_ID`, `Per_Doc`, `Per_Nom`, `Per_Ape`, `Per_Tel`, `Per_Email`, `Per_Passw`, `Per_Toke`, `Per_FecReg`, `Per_Status`, `Rol_ID`) VALUES
(1, '123', 'Administrador', 'ProntoMueble', '123456', 'admin@prontomueble.store', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '4b5f4a454d193d9101ce-74fab30ac2522c847164-2341fa375322d7cc6243-25f18add55acd88b9aa6', '2021-02-21 18:57:21', 1, 1),
(2, '5454545', 'Brian', 'Cañon Rojas', '5645433', 'canonbrian123@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, '2021-02-25 21:09:00', 1, 7),
(3, '5454657897', 'A', 'A', '87797797', 'ehagenesl_h843g@hexud.com', '2762a5f2da2aa0d99e54b58d69560e41ef845ddba1caebecfba409b51210d0b9', NULL, '2021-02-22 17:28:54', 1, 7),
(4, '444545', 'Claudia', 'Hernandez', '55454', 'ccc@info.com', '94173e898c27e7287b1144979554108a0da52d12da51c96ba57962a301ceab36', NULL, '2021-02-22 17:30:14', 1, 7),
(7, '48744684', 'A', 'A', '897', 'bscanonr@correo.udistrital.edu.co', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, '2021-02-22 18:46:25', 1, 7),
(8, '1007654924', 'Nathalia', 'Alarcón', '3155517798', 'nataliaar250@gmail.com', '23e55c81ee66331c0a300241231d4a9e94b37303a907a84511c857ab9d1eb596', NULL, '2021-02-22 19:53:29', 1, 7),
(9, '20122292321', 'Pepito', 'Carmelo', '3123456789', 'pyhibawi-8995@yopmail.com', '0db8532634ddee740294e4eb362d6ac4dba5c885a1ef96fffb6e30ea315f57b0', NULL, '2021-02-25 05:24:05', 1, 7),
(10, '4564654', 'Prueba', 'Prueba', '56465465', 'datimi9673@bulkbye.com', 'fbd4ebfd1c79951d2d1d17261662d7386288940bd1fdb4b520059d7533931ba4', NULL, '2021-02-25 13:16:41', 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `Prod_ID` bigint(20) UNSIGNED NOT NULL,
  `Prod_Cod` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Prod_Nom` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Prod_Desc` text COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `Prod_Precio` decimal(11,2) NOT NULL,
  `Prod_Stock` int(11) NOT NULL,
  `Prod_FecLleg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Prod_Ruta` varchar(255) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `Prod_Status` int(11) NOT NULL DEFAULT 1,
  `Prod_Dim` varchar(80) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Prod_Color` varchar(80) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Cat_ID` bigint(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Prod_ID`, `Prod_Cod`, `Prod_Nom`, `Prod_Desc`, `Prod_Precio`, `Prod_Stock`, `Prod_FecLleg`, `Prod_Ruta`, `Prod_Status`, `Prod_Dim`, `Prod_Color`, `Cat_ID`) VALUES
(1, '5412123', 'Silla gamer rosada', '<p>La mejor silla para jugar y tu trabajo</p>', '800000.00', 30, '2021-02-22 16:15:46', 'silla-gamer-rosada', 1, '30x60', 'Rosado', 2),
(2, '8845422132312', 'Mesedora en madera', '<p>Mesedora para tu descanso</p>', '150000.00', 40, '2021-02-25 21:38:10', 'mesedora-en-madera', 1, '150x30', 'Madera', 2),
(3, '431321', 'Mesedora costeña', '<p>Ideal para tu descanso en la costa</p>', '60000.00', 30, '2021-02-22 16:21:00', 'mesedora-costena', 1, '50x30', 'Rojo', 2),
(4, '23161', 'Cama queen', '<p>Cama para descansar</p>', '800000.00', 30, '2021-02-22 16:22:20', 'cama-queen', 1, '50x40', 'Nego', 1),
(5, '65455', 'Cama', '<p>Cama para la reina</p>', '85000.00', 20, '2021-02-22 16:24:00', 'cama', 1, '30x60', 'Negro', 1),
(6, '65255', 'Sala en L', '<p>Sala en L</p>', '250000.00', 30, '2021-02-22 16:32:15', 'sala-en-l', 1, '30x50', 'Negro', 6),
(7, '55565', 'Biblioteca simple', '<p>Biblioteca simple&nbsp;</p>', '300000.00', 30, '2021-02-22 16:48:15', 'biblioteca-simple', 1, '20x60', 'Madera', 8),
(8, '564561', 'Combo sala gamer Tuff xr250', '<p>Sala gamer</p>', '1500000.00', 5, '2021-02-22 16:52:25', 'combo-sala-gamer-tuff-xr250', 1, '150x60', 'Varios', 4),
(9, '454599', 'Escritorio pc simple', '<p>Escritorio</p>', '150000.00', 0, '2021-02-22 16:54:27', 'escritorio-pc-simple', 1, '30x60', 'Gris', 7),
(10, '545468', 'Sofa', '<p>Sofa</p>', '7897213.00', 0, '2021-02-22 16:56:18', 'sofa', 1, '30x60', 'Negro', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prod_cat`
--

CREATE TABLE `prod_cat` (
  `Cat_ID` bigint(10) UNSIGNED NOT NULL,
  `Cat_Nom` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Cat_Des` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `Cat_Port` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Cat_FecCre` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Cat_Ruta` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Cat_Status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `prod_cat`
--

INSERT INTO `prod_cat` (`Cat_ID`, `Cat_Nom`, `Cat_Des`, `Cat_Port`, `Cat_FecCre`, `Cat_Ruta`, `Cat_Status`) VALUES
(1, 'Camas', 'Lo mejor para dormir', 'img_78ff570ac2c44573c6bb88ed2c239a81.jpg', '2021-02-22 16:07:31', 'camas', 1),
(2, 'Sillas', 'Lo mejor para tu comodidad', 'img_941b0662c31b463b6d72e095455096fc.jpg', '2021-02-22 16:02:26', 'sillas', 1),
(3, 'Sofas', 'Hechos a tu medida', 'img_3bd4b5a06b022e4b448656cf53ae4d99.jpg', '2021-02-22 16:03:44', 'sofas', 1),
(4, 'Salas gamer', 'Si quieres jugar cómodamente esto es para ti', 'img_e8d8c48c433a6a3c0bb2273063a2e011.jpg', '2021-02-22 16:38:37', 'salas-gamer', 1),
(6, 'Salas', 'Lo mejor para tu día a día', 'img_d161b98c1e55206b0b49243b56a24b98.jpg', '2021-02-22 16:38:52', 'salas', 1),
(7, 'Escritorios', 'Lo mejor para tu trabajo', 'img_8ce4ecb6dee60b18f51c4d2300ac8b24.jpg', '2021-02-22 16:11:02', 'escritorios', 1),
(8, 'Bibliotecas', 'Bibliotecas modernas', 'img_3aaa45071d1066678e3010a256932f94.jpg', '2021-02-22 16:45:58', 'bibliotecas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `Prov_ID` bigint(20) UNSIGNED NOT NULL,
  `Prov_Nom` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Prov_Dir` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `Prov_Fijo` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Prov_Cel` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Prov_Status` int(11) DEFAULT 1,
  `Prov_Contacto` varchar(90) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Prov_Email` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`Prov_ID`, `Prov_Nom`, `Prov_Dir`, `Prov_Fijo`, `Prov_Cel`, `Prov_Status`, `Prov_Contacto`, `Prov_Email`) VALUES
(1, 'Muebeles el castor', 'Calle 105B', '13536', '16363', 1, 'Jose', 'elcastor@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reembolsos`
--

CREATE TABLE `reembolsos` (
  `Rem_ID` bigint(20) NOT NULL,
  `Rem_TransID` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `Rem_Data` text CHARACTER SET utf8mb4 NOT NULL,
  `Rem_Obs` text CHARACTER SET utf8mb4 NOT NULL,
  `Rem_Status` varchar(150) CHARACTER SET utf8mb4 NOT NULL,
  `Ped_ID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Rol_ID` bigint(20) UNSIGNED NOT NULL,
  `Rol_Nom` varchar(50) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `Rol_Desc` text COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `Rol_Status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`Rol_ID`, `Rol_Nom`, `Rol_Desc`, `Rol_Status`) VALUES
(1, 'Administrador', 'Acceso a todo el sistema', 1),
(2, 'Supervisores', 'Supervisor de tienda', 1),
(3, 'Vendedor', 'Este rol da acceso a un 80% del sistema', 1),
(6, 'Administrativos', 'Modulo de administración', 1),
(7, 'Cliente', 'Clientes tienda', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `Pag_ID` bigint(20) UNSIGNED NOT NULL,
  `Pag_Nom` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `Pag_Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`Pag_ID`, `Pag_Nom`, `Pag_Status`) VALUES
(1, 'PayPal', 1),
(2, 'Efectivo', 1),
(3, 'Tarjeta', 1),
(4, 'Cheque', 1),
(5, 'Despósito Bancario', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `ventas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `ventas` (
`COUNT(*)` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `ventaspendientes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `ventaspendientes` (
`COUNT(*)` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `estadisiticascliente`
--
DROP TABLE IF EXISTS `estadisiticascliente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u925028044_brian`@`127.0.0.1` SQL SECURITY DEFINER VIEW `estadisiticascliente`  AS  select count(0) AS `COUNT(*)` from `persona` where `persona`.`Rol_ID` = 7 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `estadisticasempleados`
--
DROP TABLE IF EXISTS `estadisticasempleados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u925028044_brian`@`127.0.0.1` SQL SECURITY DEFINER VIEW `estadisticasempleados`  AS  select count(0) AS `COUNT(*)` from `persona` where `persona`.`Rol_ID` <> 7 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `ventas`
--
DROP TABLE IF EXISTS `ventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u925028044_brian`@`127.0.0.1` SQL SECURITY DEFINER VIEW `ventas`  AS  select count(0) AS `COUNT(*)` from `pedido` where `pedido`.`Ped_Status` = 'Completado' or `pedido`.`Ped_Status` <> 'Pendiente' ;

-- --------------------------------------------------------

--
-- Estructura para la vista `ventaspendientes`
--
DROP TABLE IF EXISTS `ventaspendientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u925028044_brian`@`127.0.0.1` SQL SECURITY DEFINER VIEW `ventaspendientes`  AS  select count(0) AS `COUNT(*)` from `pedido` where `pedido`.`Ped_Status` = 'Pendiente' ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`Temp_ID`),
  ADD KEY `detalle_temp_ibfk_1` (`Prod_ID`);

--
-- Indices de la tabla `det_ped`
--
ALTER TABLE `det_ped`
  ADD PRIMARY KEY (`Det_ID`),
  ADD KEY `det_ped_ibfk_1` (`Ped_ID`),
  ADD KEY `det_ped_ibfk_2` (`Prod_ID`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
  ADD KEY `envio_ibfk_1` (`Cat_ID`),
  ADD KEY `envio_ibfk_2` (`Prov_ID`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`Img_ID`),
  ADD KEY `imagen_ibfk_1` (`Prod_ID`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`Mod_ID`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`Ped_ID`),
  ADD KEY `pedido_ibfk_1` (`Per_ID`),
  ADD KEY `pedido_ibfk_2` (`Pag_ID`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`Perm_ID`),
  ADD KEY `permisos_ibfk_1` (`Rol_ID`),
  ADD KEY `permisos_ibfk_2` (`Mod_ID`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`Per_ID`),
  ADD UNIQUE KEY `Per_Email` (`Per_Email`),
  ADD UNIQUE KEY `Per_Doc` (`Per_Doc`),
  ADD KEY `persona_ibfk_1` (`Rol_ID`),
  ADD KEY `Per_Tel` (`Per_Tel`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Prod_ID`),
  ADD KEY `producto_ibfk_1` (`Cat_ID`);

--
-- Indices de la tabla `prod_cat`
--
ALTER TABLE `prod_cat`
  ADD PRIMARY KEY (`Cat_ID`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`Prov_ID`);

--
-- Indices de la tabla `reembolsos`
--
ALTER TABLE `reembolsos`
  ADD PRIMARY KEY (`Rem_ID`),
  ADD KEY `Ped_ID` (`Ped_ID`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Rol_ID`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`Pag_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `Temp_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT de la tabla `det_ped`
--
ALTER TABLE `det_ped`
  MODIFY `Det_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `Img_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `Mod_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `Ped_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `Perm_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=669;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `Per_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Prod_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `prod_cat`
--
ALTER TABLE `prod_cat`
  MODIFY `Cat_ID` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `Prov_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reembolsos`
--
ALTER TABLE `reembolsos`
  MODIFY `Rem_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `Rol_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `Pag_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`Prod_ID`) REFERENCES `producto` (`Prod_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `det_ped`
--
ALTER TABLE `det_ped`
  ADD CONSTRAINT `det_ped_ibfk_1` FOREIGN KEY (`Ped_ID`) REFERENCES `pedido` (`Ped_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `det_ped_ibfk_2` FOREIGN KEY (`Prod_ID`) REFERENCES `producto` (`Prod_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `envio`
--
ALTER TABLE `envio`
  ADD CONSTRAINT `envio_ibfk_1` FOREIGN KEY (`Cat_ID`) REFERENCES `prod_cat` (`Cat_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `envio_ibfk_2` FOREIGN KEY (`Prov_ID`) REFERENCES `proveedor` (`Prov_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`Prod_ID`) REFERENCES `producto` (`Prod_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`Per_ID`) REFERENCES `persona` (`Per_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`Pag_ID`) REFERENCES `tipo_pago` (`Pag_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`Rol_ID`) REFERENCES `rol` (`Rol_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`Mod_ID`) REFERENCES `modulo` (`Mod_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`Rol_ID`) REFERENCES `rol` (`Rol_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`Cat_ID`) REFERENCES `prod_cat` (`Cat_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reembolsos`
--
ALTER TABLE `reembolsos`
  ADD CONSTRAINT `reembolsos_ibfk_1` FOREIGN KEY (`Ped_ID`) REFERENCES `pedido` (`Ped_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
