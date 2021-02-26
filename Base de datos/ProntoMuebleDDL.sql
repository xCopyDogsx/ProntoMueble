/*
 #####                                  ######  ######  #       
#     #  ####  #####  # #####  #####    #     # #     # #       
#       #    # #    # # #    #   #      #     # #     # #       
 #####  #      #    # # #    #   #      #     # #     # #       
      # #      #####  # #####    #      #     # #     # #       
#     # #    # #   #  # #        #      #     # #     # #       
 #####   ####  #    # # #        #      ######  ######  ####### 
*/

/*-----------DDL de las tablas ---------------*/

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `Temp_ID` bigint(20) UNSIGNED NOT NULL,
  `Temp_Precio` decimal(11,2) NOT NULL,
  `Temp_Cant` int(11) NOT NULL,
  `Temp_TransID` varchar(255) NOT NULL,
  `Prod_ID` bigint(11) UNSIGNED NOT NULL,
  `Per_ID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Estructura de tabla para la tabla `det_ped`
--

CREATE TABLE `det_ped` (
  `Det_ID` bigint(20) UNSIGNED NOT NULL,
  `Det_Precio` decimal(11,2) NOT NULL,
  `Det_Cant` int(11) NOT NULL,
  `Ped_ID` bigint(20) UNSIGNED NOT NULL,
  `Prod_ID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `Cat_ID` bigint(20) UNSIGNED NOT NULL,
  `Prov_ID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `Img_ID` bigint(20) UNSIGNED NOT NULL,
  `Img_Nom` varchar(100) NOT NULL,
  `Prod_ID` bigint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `Mod_ID` bigint(20) UNSIGNED NOT NULL,
  `Mod_Nom` varchar(50) NOT NULL,
  `Mod_Desc` text NOT NULL,
  `Mod_Status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `Ped_ID` bigint(20) UNSIGNED NOT NULL,
  `Ped_RefCobro` varchar(255) DEFAULT NULL,
  `Ped_IDPayPal` varchar(255) DEFAULT NULL,
  `Ped_DatPayPal` text DEFAULT NULL,
  `Ped_FechPed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Ped_CostEnv` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Ped_Total` decimal(11,2) NOT NULL,
  `Ped_Dest` text NOT NULL,
  `Ped_Status` varchar(100) DEFAULT NULL,
  `Per_ID` bigint(20) UNSIGNED DEFAULT NULL,
  `Pag_ID` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

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
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `Per_ID` bigint(20) UNSIGNED NOT NULL,
  `Per_Doc` varchar(15) NOT NULL,
  `Per_Nom` varchar(50) NOT NULL,
  `Per_Ape` varchar(50) NOT NULL,
  `Per_Tel` varchar(30) NOT NULL,
  `Per_Email` varchar(100) NOT NULL,
  `Per_Passw` varchar(75) NOT NULL,
  `Per_Toke` varchar(100) DEFAULT NULL,
  `Per_FecNac` date DEFAULT NULL,
  `Per_FecReg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Per_Status` int(11) DEFAULT 1,
  `Rol_ID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `Prod_ID` bigint(20) UNSIGNED NOT NULL,
  `Prod_Cod` varchar(30) NOT NULL,
  `Prod_Nom` varchar(255) NOT NULL,
  `Prod_Desc` text DEFAULT NULL,
  `Prod_Precio` decimal(11,2) NOT NULL,
  `Prod_Stock` int(11) NOT NULL,
  `Prod_FecLleg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Prod_Ruta` varchar(255) DEFAULT NULL,
  `Prod_Status` int(11) NOT NULL DEFAULT 1,
  `Prod_Dim` varchar(80) NOT NULL,
  `Prod_Color` varchar(80) NOT NULL,
  `Cat_ID` bigint(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
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

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Rol_ID` bigint(20) UNSIGNED NOT NULL,
  `Rol_Nom` varchar(50) NOT NULL,
  `Rol_Desc` text  NOT NULL,
  `Rol_Status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `Pag_ID` bigint(20) UNSIGNED NOT NULL,
  `Pag_Nom` varchar(100) NOT NULL,
  `Pag_Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;


/*---------------Indices para las tablas----------------*/
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
  MODIFY `Temp_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `det_ped`
--
ALTER TABLE `det_ped`
  MODIFY `Det_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `Img_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `Mod_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `Ped_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `Perm_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `Per_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Prod_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prod_cat`
--
ALTER TABLE `prod_cat`
  MODIFY `Cat_ID` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `Prov_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `Rol_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `Pag_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

/*------------Relaciones y llaves foraneas-----------------------*/

--
-- Relaciones para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`Prod_ID`) REFERENCES `producto` (`Prod_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Relaciones para la tabla `det_ped`
--
ALTER TABLE `det_ped`
  ADD CONSTRAINT `det_ped_ibfk_1` FOREIGN KEY (`Ped_ID`) REFERENCES `pedido` (`Ped_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `det_ped_ibfk_2` FOREIGN KEY (`Prod_ID`) REFERENCES `producto` (`Prod_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Relaciones para la tabla `envio`
--
ALTER TABLE `envio`
  ADD CONSTRAINT `envio_ibfk_1` FOREIGN KEY (`Cat_ID`) REFERENCES `prod_cat` (`Cat_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `envio_ibfk_2` FOREIGN KEY (`Prov_ID`) REFERENCES `proveedor` (`Prov_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Relaciones para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`Prod_ID`) REFERENCES `producto` (`Prod_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Relaciones para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`Per_ID`) REFERENCES `persona` (`Per_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`Pag_ID`) REFERENCES `tipo_pago` (`Pag_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Relaciones para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`Rol_ID`) REFERENCES `rol` (`Rol_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`Mod_ID`) REFERENCES `modulo` (`Mod_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Relaciones para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`Rol_ID`) REFERENCES `rol` (`Rol_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Relaciones para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`Cat_ID`) REFERENCES `prod_cat` (`Cat_ID`) ON DELETE CASCADE ON UPDATE CASCADE;



--
-- Filtros para la tabla `reembolsos`
--
ALTER TABLE `reembolsos`
  ADD CONSTRAINT `reembolsos_ibfk_1` FOREIGN KEY (`Ped_ID`) REFERENCES `pedido` (`Ped_ID`);
COMMIT;
 