-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2023 a las 18:30:01
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_mgnetworks`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

CREATE TABLE `categoria_producto` (
  `ID_Categoria` int(10) NOT NULL,
  `Nombre_Categoria` varchar(50) NOT NULL,
  `Descripcion_Categoria` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`ID_Categoria`, `Nombre_Categoria`, `Descripcion_Categoria`) VALUES
(1, 'Computadoras', 'Componentes para pc'),
(2, 'Accesorios de camaras de seguridad', 'accesorios para seguridad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID_Cliente` int(10) NOT NULL,
  `Nombre_Cliente` varchar(30) NOT NULL,
  `Apellido_Cliente` varchar(30) DEFAULT NULL,
  `Dni_Cliente` varchar(10) NOT NULL,
  `Telefono_Cliente` varchar(10) DEFAULT NULL,
  `Sexo_Cliente` char(1) DEFAULT NULL,
  `Correo_Cliente` varchar(50) DEFAULT NULL,
  `Contraseña_Cliente` varchar(75) DEFAULT NULL,
  `Direccion_Cliente` varchar(200) DEFAULT NULL,
  `Departamento_Cliente` varchar(20) DEFAULT NULL,
  `Provincia_Cliente` varchar(20) DEFAULT NULL,
  `Distrito_Cliente` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID_Cliente`, `Nombre_Cliente`, `Apellido_Cliente`, `Dni_Cliente`, `Telefono_Cliente`, `Sexo_Cliente`, `Correo_Cliente`, `Contraseña_Cliente`, `Direccion_Cliente`, `Departamento_Cliente`, `Provincia_Cliente`, `Distrito_Cliente`) VALUES
(1, 'Jesus', 'Miranda', '82716152', '996427005', '1', 'jm@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'Av Surco', 'Lima', 'Lima', 'Surco'),
(2, 'Harry', 'Styles', '82167162', '9162718456', '1', 'harrys@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'Av. Sunflowers', 'Lima', 'Lima', 'La Molina'),
(3, 'Darley', 'Pillaca', '83616312', '987645201', '1', 'darley@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'Dp@gmail.com', 'Lima', 'Lima', 'Huaycan'),
(4, 'Bianca', 'Cuba', '9352716', '994567005', '2', 'bj@gmail.com', '9f2b69296b69933a12d3cfe71182c77b9cc50edb46e4ded9b944ce04f779307b', 'Av Cielo', 'Lima', 'Lima', 'Santa Anita'),
(5, 'Chris', 'Martin', '73617263', '995637218', '1', 'chris@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Av.cold', 'Lima', 'Lima', 'Ate'),
(6, 'Liam', 'Payne', '92162735', '982167223', '1', 'lp@gmail.com', '6e1f18a430c96cbc5ff5ba61e404b6667fe4e2f44315339aa24e8d20898cfbdb', 'Av. Molina', 'Lima', 'Lima', 'Chorrillos'),
(7, 'Taylor', 'Swift', '82617261', '982165772', '2', 'ts@gmail.com', 'cb34fef498a344b20acfcabfd639aa984bb56ad0aa3e3920b187cfee47a1407b', 'Av. Lover', 'Lima', 'Lima', 'San Isidro'),
(8, 'Selena', 'Gomez', '3426178', '923416458', '2', 'sg@gmail.com', 'cbd12393f72eeef484a76dc83883144b94b1a69a5c6bc1a0a1296cb6780c7dbc', 'Los Molinos', 'Lima', 'Lima', 'Ventanilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `ID_Compra` int(11) NOT NULL,
  `ID_Usuario` int(11) DEFAULT NULL,
  `Fecha_Compra` datetime DEFAULT NULL,
  `IGV_Compra` decimal(18,2) DEFAULT NULL,
  `Estado_Compra` varchar(10) DEFAULT NULL,
  `Total_Compra` decimal(18,2) DEFAULT NULL,
  `SubTotal_Compra` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `ID_DetalleCompra` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `ID_Proveedor` int(11) NOT NULL,
  `ID_Compra` int(11) NOT NULL,
  `CantidadProducto_DetalleCompra` int(11) DEFAULT NULL,
  `ImporteCompra_DetalleCompra` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `ID_DetalleVenta` int(10) NOT NULL,
  `ID_Venta` int(10) NOT NULL,
  `ID_Producto` int(10) NOT NULL,
  `Cantidad_DetalleVenta` int(11) NOT NULL,
  `Precio_DetalleVenta` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_Producto` int(10) NOT NULL,
  `ID_Categoria` int(11) NOT NULL,
  `Codigo_Producto` varchar(50) NOT NULL,
  `Nombre_Producto` varchar(60) NOT NULL,
  `Stock_Producto` int(11) NOT NULL,
  `Precio_Producto` decimal(10,2) DEFAULT NULL,
  `Marca_Producto` varchar(50) DEFAULT NULL,
  `Imagen_Producto` varchar(100) DEFAULT NULL,
  `Estado_Producto` varchar(10) DEFAULT NULL,
  `Descripcion_Producto` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_Producto`, `ID_Categoria`, `Codigo_Producto`, `Nombre_Producto`, `Stock_Producto`, `Precio_Producto`, `Marca_Producto`, `Imagen_Producto`, `Estado_Producto`, `Descripcion_Producto`) VALUES
(1, 1, '31425535', 'Laptop', 20, '3500.00', 'lenovo', '1684317545_8a5d5724573a4fed839b.jpg', '1', 'KDFNV JFNV FD'),
(2, 1, '234567', 'compu', 24, '2000.00', 'HP', '1684321355_cdcd283a8b9458649dc8.jpg', '2', 'bdfbdf'),
(7, 1, '627327474', 'camput', 24, '1500.00', 'lenovo', '1684338939_54912d5b03e44607c80e.jpg', '1', 'camaras de seg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `ID_Proveedor` int(11) NOT NULL,
  `Ruc_Proveedor` varchar(11) NOT NULL,
  `RazonSocial_Proveedor` varchar(50) NOT NULL,
  `Telefono_Proveedor` varchar(10) NOT NULL,
  `Correo_Proveedor` varchar(50) DEFAULT NULL,
  `Direccion_Proveedor` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`ID_Proveedor`, `Ruc_Proveedor`, `RazonSocial_Proveedor`, `Telefono_Proveedor`, `Correo_Proveedor`, `Direccion_Proveedor`) VALUES
(1, '2635485956', 'Caminos S.A.C', '998635274', 'cam@gmail.com', 'Av ,los frutales 620 - Lima'),
(2, '2536475', 'Delfines', '274527412', 'delf@gmail.com', 'av mediterraneo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `ID_Rol` int(11) NOT NULL,
  `Nombre_Rol` varchar(30) NOT NULL,
  `Descripcion_Rol` varchar(150) DEFAULT NULL,
  `Estado_Rol` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ID_Rol`, `Nombre_Rol`, `Descripcion_Rol`, `Estado_Rol`) VALUES
(1, 'Administrador', 'Encargado de administrar el dashboard', '1'),
(2, 'Vendedor', 'Encargado de almacenar los productos', '1'),
(3, 'Cajero', 'Encargado de atender el dinero', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int(11) NOT NULL,
  `ID_Rol` int(11) NOT NULL,
  `Nombre_Usuario` varchar(40) DEFAULT NULL,
  `DNI_Usuario` varchar(10) DEFAULT NULL,
  `Correo_Usuario` varchar(50) DEFAULT NULL,
  `Contraseña_Usuario` varchar(75) DEFAULT NULL,
  `Estado_Usuario` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `ID_Rol`, `Nombre_Usuario`, `DNI_Usuario`, `Correo_Usuario`, `Contraseña_Usuario`, `Estado_Usuario`) VALUES
(7, 1, 'Lli', '27348174', 'dos@gmail.com', '30b36fa9876e0e3777cac35045f1ed3a1e091413aaea56ba2eab45831ae1ccc2', '2'),
(8, 2, 'Bianca', '73526173', 'bianca@gmail.com', '43f22041e32e2761761172b666c7589238ed4240454f1d1ed55dea7861df0211', '1'),
(9, 1, 'Fabiola', '27351839', 'fb@gmail.com', '323ce715d571b82818e3548f5ce0e43bc79086137d7c0c0144a0480b06b955b7', '1'),
(10, 1, 'Paolo', '725162874', 'paolo@gmail.com', 'bf7d92f1d5ac3725e2e875ce5e551bac0fc9dc30d8c06f4739a1cb4b0622a41e', '1'),
(11, 1, 'Lass', '123454', 'la@gmail.com', '2c28d60e1cdbcaea57fb34a408156708cd5c727d459aef98e5af544542f15387', '1'),
(12, 1, 'Liliana', '234234334', 'df@gmail.com', 'fb8ba13c42ad6c626a15257382c09de111016ed56c03be73827922859d319962', '1'),
(13, 1, 'Alfredo', '8241637', 'alf@gmail.com', '2cf0455cf039612d3f295495335ea99b294e7d9e4b936d0bbcec68d955a6436a', '1'),
(14, 1, 'Katherin', '627152873', 'kath@gmail.com', '0e82bf4bc48bdeba5f2e8a5f7ad97d8fe98d247f6e21b70ccff66ee361d6e8e2', '1'),
(15, 1, 'Paola', '6278293', 'pao@gmail.com', '8c8593a1d0971e62665c22eb9cdc9b24768dea3fdb657c813dc70059728af519', '1'),
(16, 1, 'Shania', '28367491', 'sh@gmail.com', 'f97dec808c0d6d87101be7ed660c83622d20ae6fcab8d96d3554459ab79b6315', '1'),
(17, 2, 'OSCAR', '92516271', 'o@gmail.com', '610522897646769af89dd83e86c5b8ca9ad0bef85fc2545aa60f642f30eef3af', '1'),
(18, 1, 'Shanw', '83627162', 'sm@gmail.com', 'dcd51750cf45735d062c6a194741fb6c6018bb4ed3e361c42558ca6d22bab1ba', '1'),
(19, 1, 'Katy', '9281739', 'kg@gmail.com', 'eba87fe8808b02272c4bb161072243f3da7291c3224db7e0fc25f45275b46323', '1'),
(20, 1, 'Karla', '828585', 'kdh@gmail.com', 'fe17383a94afc770d4e41284d994c31c3ffb49bb0a5760f085854991b88c3a15', '1'),
(21, 1, 'Miguel', '826482', 'mg@gmail.com', '342a97ccb72ad946e76379c890fd865d8e6bd9546b88e7f05075201b5ba4aca4', '2'),
(22, 1, 'Carla', '8352718', 'cg@gmail.com', '$2y$10$9UUFwLPe4a9X7ioxbX6ADO54fTmyc/cziOXPVJ7VBDKTKANcKC8p2', '1'),
(23, 1, 'Mauricio', '73718374', 'mf@gmail.com', '$2y$10$JoetUbAzGpKtRBWBEcfYTOn/9RSw9O7HWZdGLm0CzI2LESoMUa5CC', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `ID_Venta` int(10) NOT NULL,
  `codigo_venta` varchar(5) NOT NULL,
  `ID_Cliente` int(10) NOT NULL,
  `Fecha_Venta` date NOT NULL,
  `Estado_Venta` varchar(10) NOT NULL,
  `Igv_Venta` decimal(4,2) NOT NULL,
  `Total_Venta` decimal(11,2) NOT NULL,
  `SubTotal_Venta` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD PRIMARY KEY (`ID_Categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID_Cliente`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`ID_Compra`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`ID_DetalleCompra`),
  ADD KEY `ID_Producto` (`ID_Producto`),
  ADD KEY `ID_Compra` (`ID_Compra`),
  ADD KEY `ID_Proveedor` (`ID_Proveedor`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`ID_DetalleVenta`),
  ADD KEY `ID_Producto` (`ID_Producto`),
  ADD KEY `ID_Venta` (`ID_Venta`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_Producto`),
  ADD KEY `ID_Categoria` (`ID_Categoria`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`ID_Proveedor`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ID_Rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD UNIQUE KEY `Correo_Usuario` (`Correo_Usuario`),
  ADD KEY `ID_Rol` (`ID_Rol`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`ID_Venta`),
  ADD KEY `ID_Cliente` (`ID_Cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  MODIFY `ID_Categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID_Cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `ID_Compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `ID_DetalleCompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `ID_DetalleVenta` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_Producto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `ID_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `ID_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `ID_Venta` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID_Producto`),
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`ID_Compra`) REFERENCES `compra` (`ID_Compra`),
  ADD CONSTRAINT `detalle_compra_ibfk_3` FOREIGN KEY (`ID_Proveedor`) REFERENCES `proveedor` (`ID_Proveedor`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID_Producto`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`ID_Venta`) REFERENCES `venta` (`ID_Venta`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`ID_Categoria`) REFERENCES `categoria_producto` (`ID_Categoria`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`ID_Rol`) REFERENCES `rol` (`ID_Rol`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`Id_Cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
