-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2021 a las 01:44:14
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecommerce`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_productos_carrito` (IN `param_correo` VARCHAR(255), IN `param_codigo` VARCHAR(255), IN `param_cantidad` INT)  BEGIN
    
    set @s = CONCAT("update carrito set cantidad = '", param_cantidad ,"' where correo = '" , param_correo, "' and codigo = '" , param_codigo, "' ");
    
    prepare stmt from @s;
    execute stmt;
    deallocate prepare stmt;
    
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_agregar_producto_carrito` (`param_correo` VARCHAR(250), `param_codigo` VARCHAR(250), `param_nombre_producto` VARCHAR(250), `param_cantidad` INT(11))  BEGIN
insert into carrito(correo, codigo, nombre_producto, cantidad) VALUES(param_correo, param_codigo, param_nombre_producto, param_cantidad);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_borrar_productos_carrito` (IN `param_correo` VARCHAR(255), IN `param_codigo` VARCHAR(255))  BEGIN
    
    set @s = CONCAT("delete from carrito where correo = '", param_correo ,"' and codigo = '" , param_codigo, "'");
    
    prepare stmt from @s;
    execute stmt;
    deallocate prepare stmt;
    
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_contar_productos` ()  BEGIN
    
    set @s = CONCAT("select count(*) from productos");
    
    prepare stmt from @s;
    execute stmt;
    deallocate prepare stmt;
    
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_iniciar_sesion` (IN `param_correo` VARCHAR(255), IN `param_contra` VARCHAR(255))  BEGIN
    
    set @s = CONCAT("select count(*) from usuarios where correo = '", param_correo ,"' and contraseña = '" , param_contra, "'");
    
    prepare stmt from @s;
    execute stmt;
    deallocate prepare stmt;
    
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro` (`param_nombre` VARCHAR(250), `param_correo` VARCHAR(250), `param_contra` VARCHAR(250))  BEGIN
insert into usuarios(nombre,correo,contraseña) VALUES(param_nombre, param_correo, param_contra);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_traer_especifico_producto` (`param_codigo` VARCHAR(250))  BEGIN

set @s = CONCAT("select * from productos where codigo = '", param_codigo ,"'");
    
    prepare stmt from @s;
    execute stmt;
    deallocate prepare stmt;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_traer_productos` ()  BEGIN
    
    set @s = CONCAT("select * from productos");
    
    prepare stmt from @s;
    execute stmt;
    deallocate prepare stmt;
    
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_verificar_carrito` (IN `param_correo` VARCHAR(250), IN `param_codigo` VARCHAR(250), IN `param_nombre_pro` VARCHAR(250), IN `param_cantidad` INT)  BEGIN
IF (SELECT * FROM carrito WHERE correo = param_correo and codigo = param_codigo) THEN
BEGIN
    UPDATE carrito SET cantidad = param_cantidad WHERE correo = param_correo and codigo = param_codigo;
    END;
    ELSE 
    BEGIN
    insert into carrito(correo,codigo,nombre_producto, cantidad) VALUES(param_correo, param_codigo, param_nombre_pro, param_cantidad);
    END;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `correo`, `codigo`, `nombre_producto`, `cantidad`) VALUES
(129, 'testuser@gmail.com', 'BK02', 'Big King', 1),
(130, 'testuser@gmail.com', 'BK03', 'Whopper', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(8) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `imagen` text NOT NULL,
  `precio` double(10,2) NOT NULL,
  `alt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `codigo`, `imagen`, `precio`, `alt`) VALUES
(1, 'Bacon King', 'BK01', 'img/bacon-king.png', 8.95, 'Bacon King'),
(2, 'Big King', 'BK02', 'img/big-king.png', 5.95, 'Big King'),
(3, 'Whopper', 'BK03', 'img/whopper.png', 7.95, 'Whopper'),
(4, 'Guacamole Crunch King', 'BK04', 'img/guacamole-crunch-king.png', 7.50, 'Guacamole Crunch King'),
(5, 'Stacker King', 'BK05', 'img/stacker-king.png', 6.50, 'Stacker King'),
(6, 'Whopper con queso', 'BK06', 'img/whopper-con-queso.png', 7.25, 'Whopper con queso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `contraseña` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contraseña`) VALUES
(1, 'Edgardo Vaca', 'edgardovac2298@gmail.com', 'teXB5LK3JWG6g'),
(2, 'Testuser', 'testuser@gmail.com', 'teXB5LK3JWG6g'),
(3, 'Juan Perez', 'juanperez1@gmail.com', 'juuPSDTvQO02.'),
(4, 'Milany Vaca', 'milany28@outlook.es', 'miqnk0iv11jAI'),
(5, 'Alana Cardona', 'alanacardona15@gmail.com', 'ali/.Hbn9UdpA'),
(6, 'Juan Yeyo', 'juanyeyo@gmail.com', 'juke1rD5h93Sc'),
(7, 'xdxd', 'xd@gmail.com', 'xdz9ZNO52JcyM'),
(8, 'holis', 'holis@gmail.com', 'ho0Zq6OGcwmBI'),
(9, 'luis', 'luis@gmail.com', 'luHslbSlVJkYY'),
(10, 'Juanito', 'juanito123@gmail.com', 'judjdF0djuKxQ'),
(11, 'Eduardo Perez', 'eduardoperez@gmail.com', 'edlis.t.r7NGk'),
(12, 'juanyeyin', 'juanyeyin@gmail.com', 'juMGf0mCJhnvc'),
(13, 'hola vaca', 'holavaca@gmail.com', 'ho5k4bFekvP72'),
(14, 'juanvaca', 'juanvaca@gmail.com', 'juuPSDTvQO02.'),
(15, 'mil vaca', 'milvaca@gmail.com', 'milvaca'),
(18, 'Jaison Cueco', 'jaisoncueco@gmail.com', 'jaJmW0qWE754M'),
(19, 'allex fonseca', 'alexfonseca@gmail.com', 'alrmmC9f9hDbc'),
(20, 'yeyoyemil@gmail.com', 'yeyoyemil@gmail.com', 'ye.LPkp9rZbgs'),
(21, 'Fulvia Lopez', 'fulvialopez1@gmail.com', 'fuAXOAD2W7sFA'),
(22, 'ventitas', 'ventitas@gmail.com', 've8P4zhJyyRao'),
(23, 'mil@gmail.com', 'mil@gmail.com', 'miTF5KM/1uCw2'),
(24, 'mil@gmail.com', 'mil@gmail.com', 'miTF5KM/1uCw2'),
(25, 'xd', 'xd1@gmail.com', 'xdEh/fI2l4kRw'),
(26, 'xd2@gmail.com', 'xd2@gmail.com', 'xdO7BD3pwQoWc'),
(27, 'xd3', 'xd3@gmail.com', 'xd6En4X4Tk0qk'),
(28, 'jai', 'jai@gmail.com', 'jai123'),
(29, 'Alana Cardona mi bebbe favorita', 'alanacb@gmail.com', 'alqKvBVotpsig'),
(30, 'axd1', 'axd1@gmail.com', 'axlRvgYxDGQ7s'),
(31, 'Profe', 'profe@gmail.com', 'proovpMGgCAy.'),
(32, 'cuenta1', 'cuenta1@gmail.com', 'cuaXIAeUDSDC2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
