-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-12-2024 a las 02:30:38
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
-- Base de datos: `getgeek_tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `fecha_actualizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `imagen`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Indumentaria', 'BOXERS, BUFANDAS, BUZOS, CAMISETA, CAMPERAS, CORBATAS, COSPLAY, CAPAS, KIMONOS, DELANTALES, DISFRAZ, GUANTES, GORRAS / GORROS, MEDIAS, POLLERAS, REMERAS, SHORT DE BAÑO, SWEATERS, ETC.', 'img/productos/categorias/cat_indumentaria.png', '2024-06-23', '2024-06-23'),
(2, 'Manga', 'mangas, libros, cuadernos', 'img/productos/categorias/cat_mangas.png', '2024-06-23', '2024-06-23'),
(3, 'Figuras', 'Figuras Coleccionables, Figuras de Acciòn, Funkos, Figuras Llaveros, Muñecos Articulados,', 'img/productos/categorias/figuras_cat.webp', '2024-06-23', '2024-06-23'),
(4, 'Heroes', 'Super Heroes, Dioses, Semi-Dioses, Tony Stark, Todo ese tipo de figuras, posters, motivos relacionados a heroes', 'img/productos/categorias/heroes_cat.jpg', '2024-07-01', '2024-07-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `importe` float(8,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `franquicias`
--

CREATE TABLE `franquicias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `franquicias`
--

INSERT INTO `franquicias` (`id`, `nombre`) VALUES
(1, 'Dragon Ball'),
(2, 'My Hero Academy'),
(3, 'Jojo s Bizarre Adventure');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `producto_id`, `url`) VALUES
(1, 1, 'img/productos/generales/173474462467661a309abd2.webp'),
(2, 1, 'img/productos/BANDAI/A17-2.webp'),
(3, 1, 'img/productos/BANDAI/A17-3.webp'),
(4, 2, 'img/productos/banpresto/chichi-milk-db-1.webp'),
(5, 2, 'img/productos/banpresto/chichi-milk-db-2.webp'),
(6, 2, 'img/productos/banpresto/chichi-milk-db-3.webp'),
(7, 3, 'img/productos/banpresto/wcf-combo.webp'),
(8, 3, 'img/productos/banpresto/wcf-combo-gogeta-1.webp'),
(9, 3, 'img/productos/banpresto/wcf-combo-hildegarn-2.webp'),
(10, 3, 'img/productos/banpresto/wcf-combo-saiyaman-3.webp'),
(11, 3, 'img/productos/banpresto/wcf-combo-vegeta-mono-4.webp'),
(12, 3, 'img/productos/banpresto/wcf-combo-cooler-5.webp'),
(13, 3, 'img/productos/banpresto/wcf-combo-metal-cooler-6.webp'),
(14, 4, 'img/productos/banpresto/wcf-combo-gogeta-1.webp'),
(15, 5, 'img/productos/banpresto/wcf-combo-hildegarn-2.webp'),
(16, 6, 'img/productos/banpresto/wcf-combo-saiyaman-3.webp'),
(17, 7, 'img/productos/banpresto/wcf-combo-vegeta-mono-4.webp'),
(18, 8, 'img/productos/banpresto/wcf-combo-cooler-5.webp'),
(19, 9, 'img/productos/banpresto/wcf-combo-metal-cooler-6.webp'),
(20, 10, 'img/productos/banpresto/1-goku-4.0.webp'),
(21, 10, 'img/productos/banpresto/1-goku-4.1.webp'),
(22, 10, 'img/productos/banpresto/1-goku-4.2.webp'),
(23, 10, 'img/productos/banpresto/1-goku-vegeta.webp'),
(24, 11, 'img/productos/banpresto/1-vegeta-4.webp'),
(25, 11, 'img/productos/banpresto/1-goku-vegeta.webp'),
(26, 12, 'img/productos/banpresto/1-goku-vegeta.webp'),
(27, 12, 'img/productos/banpresto/1-vegeta-4.webp'),
(28, 12, 'img/productos/banpresto/1-goku-4.0.webp'),
(29, 12, 'img/productos/banpresto/1-goku-4.1.webp'),
(30, 12, 'img/productos/banpresto/1-goku-4.2.webp'),
(31, 13, 'img/productos/tsume/bakugo-1.webp'),
(32, 13, 'img/productos/tsume/bakugo-2.webp'),
(33, 13, 'img/productos/tsume/bakugo-3.webp'),
(34, 14, 'img/productos/tsume/midoriya-1.webp'),
(35, 14, 'img/productos/tsume/midoriya-2.webp'),
(36, 14, 'img/productos/tsume/midoriya-3.webp'),
(37, 15, 'img/productos/good-smile/giorno-1.webp'),
(38, 15, 'img/productos/good-smile/giorno-2.webp'),
(39, 15, 'img/productos/good-smile/giorno-3.webp'),
(40, 16, 'img/productos/otros/jojo_remera_1.webp'),
(41, 16, 'img/productos/otros/jojo_remera_2.webp'),
(42, 16, 'img/productos/otros/jojo_remera_3.webp'),
(43, 17, 'img/productos/otros/kimono_allmight_1.jpg'),
(44, 17, 'img/productos/otros/kimono_allmight_2.jpg'),
(45, 19, 'img/productos/ivrea/dbm_1.webp'),
(46, 20, 'img/productos/ivrea/dbm_2.webp'),
(47, 21, 'img/productos/ivrea/dbm_3.webp'),
(48, 22, 'img/productos/ivrea/dbm_4.webp'),
(49, 23, 'img/productos/ivrea/dbm_5.webp'),
(50, 24, 'img/productos/ivrea/dbm_6.webp'),
(51, 25, 'img/productos/ivrea/dbm_7.webp'),
(52, 26, 'img/productos/ivrea/dbm_8.webp'),
(53, 27, 'img/productos/ivrea/dbm_9.webp'),
(54, 28, 'img/productos/ivrea/dbm_10.webp'),
(55, 29, 'img/productos/ivrea/dbm_11.webp'),
(56, 30, 'img/productos/ivrea/dbm_12.webp'),
(59, 33, 'img/productos/generales/173474462467661a309abd2.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_x_compras`
--

CREATE TABLE `items_x_compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `compra_id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`) VALUES
(1, 'Bandai'),
(2, 'Banpresto'),
(3, 'Tsume'),
(4, 'Good Smile Company'),
(5, 'Ivrea'),
(6, 'Otros'),
(9, 'Maradona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `personaje` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `fechaLanzamiento` date DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `novedad` tinyint(1) DEFAULT NULL,
  `franquicia_id` int(10) UNSIGNED NOT NULL,
  `marca_id` int(10) UNSIGNED NOT NULL,
  `bajada` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `personaje`, `precio`, `fechaLanzamiento`, `descripcion`, `novedad`, `franquicia_id`, `marca_id`, `bajada`) VALUES
(1, 'Androide 17', 84000.00, '2022-08-01', 'The Android Battle – Androide 17 – Dragon Ball', 0, 1, 1, '¡Lleva a casa al poderoso Androide 17! Revive las épicas batallas de la batalla de los androides con este increíble coleccionable. Detalles preciosos y materiales de alta calidad hacen de esta figura una pieza imprescindible para cualquier fan de Dragon Ball. ¡No te pierdas la oportunidad de agregar a Androide 17 a tu colección!'),
(2, 'Milk (Chichi)', 60000.00, '2020-01-12', 'Dragon Ball Collection Vol 3 – Milk (Chichi)', 0, 1, 2, 'Increíble figura de Milk (Chichi) de Dragon Ball. Esta figura de Banpresto es una pieza de colección que no te puede faltar. Dentro de la caja viene la figura con su respectiva base soporte. Altura del producto: 16cm aproximadamente'),
(3, 'Combo Dragon Ball - WCF – Treasure Rally Vol 4', 120000.00, '2024-03-22', 'Exclusivo combo WCF – Treasure Rally Vol 4 de Dragon Ball Z / Super de la mano de Banpresto.', 1, 1, 2, 'Desde el súper popular universo de Dragon Ball, nos traen este elenco de estrellas como parte de la colección de personajes históricos de Dragon Ball Z. Este conjunto de 6 incluye Gogeta, Hildegarn, Saiyaman, Vegeta Mono, Cooler y Metal Cooler.'),
(4, 'Gogeta Super Saiyan - WCF', 18000.00, '2020-12-21', '\"WCF – Treasure Rally Vol 4 – Gogeta Super Saiyan – Dragon Ball', 0, 1, 2, 'Gogeta es un personaje de Dragon Ball, una fusión entre Goku y Vegeta. Esta figura de Gogeta Super Saiyan es parte de la \"World Collectable Figure\" y tiene un tamaño de altura de 8cm.'),
(5, 'Hildegarn - WCF', 18000.00, '2020-12-21', 'WCF – Treasure Rally Vol 4 – Hildegarn – Dragon Ball', 0, 1, 2, 'Crea tus propias batallas de Dragon Ball, con el villano Hildegarn!. Es una pieza imprescindible para cualquier fan de la franquicia y parte del \"World Collectable Figure Vol 4\". Esta figura tiene una altura de 8cm.'),
(6, 'Gran Saiyaman - WCF', 18000.00, '2020-12-21', 'WCF – Treasure Rally Vol 4 – Gran Saiyaman – Dragon Ball', 0, 1, 2, '¡Lleva a casa al poderoso Gran Saiyaman! Revive las épicas batallas de la saga de Majin Boo con este increíble coleccionable. Detalles preciosos y materiales de alta calidad hacen de esta figura una pieza imprescindible para cualquier fan de Dragon Ball. Altura del producto: 8cm aproximadamente'),
(7, 'Vegeta Mono - WCF', 18000.00, '2020-12-21', 'WCF – Treasure Rally Vol 4 – Vegeta Mono – Dragon Ball', 0, 1, 2, '¡El Gran Vegeta Mono puede ser tuyo! No te pierdas esta figura, una de las 6 que forman parte del \"World Collectable Figure\". Detalles preciosos y materiales de alta calidad hacen de esta figura una pieza imprescindible para cualquier fan de Dragon Ball. Altura del producto: 8cm aproximadamente'),
(8, 'Cooler - WCF', 18000.00, '2020-12-21', 'WCF – Treasure Rally Vol 4 – Cooler – Dragon Ball', 0, 1, 2, 'Cooler es un personaje icónico de la franquicia Dragon Ball, conocido por ser el hermano mayor de Freezer. Esta figura coleccionable de Cooler, de 8 cm de altura, captura su imponente presencia y detalle, perfecta para los fanáticos de Dragon Ball y coleccionistas.'),
(9, 'Metal Cooler - WCF', 18000.00, '2020-12-21', 'WCF – Treasure Rally Vol 4 – Metal Cooler – Dragon Ball', 0, 1, 2, 'Metal Cooler es la forma avanzada y mecanizada de Cooler. Después de ser derrotado, Cooler es reconstruido como un cyborg por el Big Gete Star, ganando una armadura metálica y mayor fuerza. Esta figura de 8 cm de altura de Metal Cooler destaca su aspecto robótico y feroz, haciendo justicia a su transformación implacable y poderosa.'),
(10, 'Goku Super Saiyan 4 - Tag Fighters', 78478.00, '2024-02-13', 'Tag Fighter – Goku Super Saiyan 4 – Dragon Ball', 0, 1, 2, 'Goku Super Saiyajin 4 es una de las transformaciones más emblemáticas y poderosas de Goku en la serie Dragon Ball GT. Con su característico cabello rojo y su cola de mono, Dentro de la caja viene la figura con su respectiva base soporte. Altura del producto: 16cm aproximadamente'),
(11, 'Vegeta Super Saiyan 4 - Tag Fighters', 78478.00, '2024-02-13', 'Tag Fighter – Vegeta Super Saiyan 4 – Dragon Ball', 1, 1, 2, 'Vegeta Super Saiyajin 4 es la forma más poderosa de Vegeta en Dragon Ball GT, destacada por su impresionante combinación de fuerza y estrategia. Con su cabello oscuro y ojos feroces, junto con la icónica cola de mono, Dentro de la caja viene la figura con su respectiva base soporte. Altura del producto: 16cm aproximadamente.'),
(12, 'Combo Dragon Ball - Goku y Vegeta Super Saiyan 4', 130000.00, '2024-02-13', 'Tag Fighter – Goku y Vegeta Super Saiyan 4 – Dragon Ball', 0, 1, 2, 'Increíble combo de Goku y Vegeta Super Saiyan 4 de Dragon Ball GT. Dentro de cada caja viene la figura con su respectiva base soporte. Altura de cada producto por separado: 16cm aproximadamente'),
(13, 'Katsuki Bakugo - Xtra', 169999.99, '2024-04-17', 'Xtra – Katsuki Bakugo – My Hero Academy', 1, 2, 3, 'Llega Bakugo de la Marca Tsume! Esta figura de 14cm de altura captura a Katsuki Bakugo en una pose dinámica, lista para la acción. Viene en una caja con ventana abierta y una base espectacular, perfecta para los fanáticos de My Hero Academy y coleccionistas que buscan calidad y detalle en sus figuras.'),
(14, 'Izuku Midoriya - Xtra', 169999.99, '2024-04-17', 'Xtra – Izuku Midoriya – My Hero Academy', 1, 2, 3, 'Llega Midoriya de la Marca Tsume! Esta figura de 14cm de altura captura a Izuku Midoriya en una pose dinámica, lista para la acción. Viene con cabeza intercambiable!, en una caja con ventana abierta y una base espectacular, perfecta para los fanáticos de My Hero Academy, infaltable en tu colección.'),
(15, 'Giorno Giovanna - Jojos Bizarre Adventure', 161000.00, '2024-05-25', 'Medicos Entertainment Chozokado – Giorno Giovanna Good Smile Jojos Bizarre Adventure', 1, 3, 4, 'Giorno Giovanna es el protagonista de la quinta parte de Jojo\'s Bizarre Adventure, Golden Wind. Esta figura de Medicos Entertainment captura a Giorno en una pose dinámica y detallada, con su Stand Gold Experience. Viene con una base soporte y una caja con ventana abierta, perfecta para los fanáticos de Jojo\'s Bizarre Adventure.'),
(16, 'Musculosa Jojo\'s Bizarre Adventure', 29800.00, '2023-10-02', 'Musculosa modelo jojo\'s bizarre adventure', 0, 3, 6, 'Musculosa modelo jojo\'s bizarre adventure, color violeta con rombos, talle unico, unisex'),
(17, 'Kimono All Might - My Hero Academia', 32000.00, '2024-04-01', 'Haori - Kimono All Might Plus Ultra - My Hero Academia', 1, 2, 6, 'Kimono, con motivo del gran ¡All Might! senti el Plus Ultra corriendo por tus venas con este kimono hermoso, talle unico y unisex. ¡NOVEDAD!'),
(19, 'Manga - Dragon Ball 1', 5400.00, '1986-02-26', 'Reediciones de los mangas originalesd e Dragon Ball, colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!', 0, 1, 5, 'El manga original se publicó entre 1984 y 1995 en la revista Weekly Shonen Jump. En los inicios era imposible predecir lo que Dragon Ball significó para la cultura popular de Japón y de prácticamente todo el mundo. Colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!'),
(20, 'Manga - Dragon Ball 2', 5400.00, '1986-03-26', 'Reediciones de los mangas originalesd e Dragon Ball, colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!', 0, 1, 5, 'El manga original se publicó entre 1984 y 1995 en la revista Weekly Shonen Jump. En los inicios era imposible predecir lo que Dragon Ball significó para la cultura popular de Japón y de prácticamente todo el mundo. Colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!'),
(21, 'Manga - Dragon Ball 3', 5400.00, '1986-04-26', 'Reediciones de los mangas originalesd e Dragon Ball, colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!', 0, 1, 5, 'El manga original se publicó entre 1984 y 1995 en la revista Weekly Shonen Jump. En los inicios era imposible predecir lo que Dragon Ball significó para la cultura popular de Japón y de prácticamente todo el mundo. Colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!'),
(22, 'Manga - Dragon Ball 4', 5400.00, '1986-05-26', 'Reediciones de los mangas originalesd e Dragon Ball, colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!', 0, 1, 5, 'El manga original se publicó entre 1984 y 1995 en la revista Weekly Shonen Jump. En los inicios era imposible predecir lo que Dragon Ball significó para la cultura popular de Japón y de prácticamente todo el mundo. Colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!'),
(23, 'Manga - Dragon Ball 5', 5400.00, '1986-06-26', 'Reediciones de los mangas originalesd e Dragon Ball, colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!', 0, 1, 5, 'El manga original se publicó entre 1984 y 1995 en la revista Weekly Shonen Jump. En los inicios era imposible predecir lo que Dragon Ball significó para la cultura popular de Japón y de prácticamente todo el mundo. Colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!'),
(24, 'Manga - Dragon Ball 6', 5400.00, '1986-07-26', 'Reediciones de los mangas originalesd e Dragon Ball, colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!', 0, 1, 5, 'El manga original se publicó entre 1984 y 1995 en la revista Weekly Shonen Jump. En los inicios era imposible predecir lo que Dragon Ball significó para la cultura popular de Japón y de prácticamente todo el mundo. Colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!'),
(25, 'Manga - Dragon Ball 7', 5400.00, '1986-08-26', 'Reediciones de los mangas originalesd e Dragon Ball, colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!', 0, 1, 5, 'El manga original se publicó entre 1984 y 1995 en la revista Weekly Shonen Jump. En los inicios era imposible predecir lo que Dragon Ball significó para la cultura popular de Japón y de prácticamente todo el mundo. Colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!'),
(26, 'Manga - Dragon Ball 8', 5400.00, '1986-09-26', 'Reediciones de los mangas originalesd e Dragon Ball, colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!', 0, 1, 5, 'El manga original se publicó entre 1984 y 1995 en la revista Weekly Shonen Jump. En los inicios era imposible predecir lo que Dragon Ball significó para la cultura popular de Japón y de prácticamente todo el mundo. Colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!'),
(27, 'Manga - Dragon Ball 9', 5400.00, '1986-10-26', 'Reediciones de los mangas originalesd e Dragon Ball, colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!', 0, 1, 5, 'El manga original se publicó entre 1984 y 1995 en la revista Weekly Shonen Jump. En los inicios era imposible predecir lo que Dragon Ball significó para la cultura popular de Japón y de prácticamente todo el mundo. Colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!'),
(28, 'Manga - Dragon Ball 10', 5400.00, '1986-11-26', 'Reediciones de los mangas originalesd e Dragon Ball, colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!', 0, 1, 5, 'El manga original se publicó entre 1984 y 1995 en la revista Weekly Shonen Jump. En los inicios era imposible predecir lo que Dragon Ball significó para la cultura popular de Japón y de prácticamente todo el mundo. Colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!'),
(29, 'Manga - Dragon Ball 11', 5400.00, '1986-12-26', 'Reediciones de los mangas originalesd e Dragon Ball, colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!', 0, 1, 5, 'El manga original se publicó entre 1984 y 1995 en la revista Weekly Shonen Jump. En los inicios era imposible predecir lo que Dragon Ball significó para la cultura popular de Japón y de prácticamente todo el mundo. Colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!'),
(30, 'Manga - Dragon Ball 12', 5400.00, '1987-01-26', 'Reediciones de los mangas originalesd e Dragon Ball, colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!', 0, 1, 5, 'El manga original se publicó entre 1984 y 1995 en la revista Weekly Shonen Jump. En los inicios era imposible predecir lo que Dragon Ball significó para la cultura popular de Japón y de prácticamente todo el mundo. Colecciona todos los mangas y no te pierdas ninguno, solo en Get Geek!'),
(33, 'Androide 17 -TEST TEST TEST', 84000.00, '2022-08-01', 'The Android Battle – Androide 17 – Dragon Ball', 0, 1, 1, '¡Lleva a casa al poderoso Androide 17! Revive las épicas batallas de la batalla de los androides con este increíble coleccionable. Detalles preciosos y materiales de alta calidad hacen de esta figura una pieza imprescindible para cualquier fan de Dragon Ball. ¡No te pierdas la oportunidad de agregar a Androide 17 a tu colección!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_categorias`
--

CREATE TABLE `productos_categorias` (
  `producto_id` int(10) UNSIGNED NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_categorias`
--

INSERT INTO `productos_categorias` (`producto_id`, `categoria_id`) VALUES
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(4, 4),
(5, 3),
(6, 3),
(6, 4),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(10, 4),
(11, 3),
(11, 4),
(12, 3),
(12, 4),
(13, 3),
(14, 3),
(14, 4),
(15, 3),
(16, 1),
(17, 1),
(17, 4),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonios`
--

CREATE TABLE `testimonios` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `testimonio` text DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `profesion` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `testimonios`
--

INSERT INTO `testimonios` (`id`, `usuario_id`, `testimonio`, `edad`, `profesion`, `ciudad`, `imagen`) VALUES
(1, 1, 'Compré aquí y la verdad la experiencia es increíble, excelente calidad de las figuras.', 25, 'Analista de sistemas', 'Buenos Aires', 'img/testimonios/juan.jpg'),
(3, 2, 'Los productos son geniales y el envío fue rápido. ¡Volveré a comprar aquí!', 30, 'Estudiante de enfermería', 'Cordoba', 'img/testimonios/maria.jpg'),
(4, 3, '¡Muy recomendable! Un amigo me los hizo conocer y la verdad que no me arrepiento de haber comprado.', 32, 'Abogado', 'Salta', 'img/testimonios/pedro.jpg'),
(5, 4, 'Los productos son geniales y el envío fue rápido. ¡Volveré a comprar aquí!', 28, 'Geek por naturaleza', 'Mendoza', 'img/testimonios/josefina.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('superadmin','admin','usuario') NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `nombre_completo`, `email`, `password`, `rol`) VALUES
(1, 'juanignacio', 'Juan Ignacio', 'juan_ignacio@gmail.com', '$2y$10$wm12smhJ5E3iwy3Mg37PP.hzoyu6sls3bKqA/tYRlkY5j9z/AAFn6', 'usuario'),
(2, 'marialaura', 'María Laura', 'maria_laura@gmail.com', '$2y$10$wm12smhJ5E3iwy3Mg37PP.hzoyu6sls3bKqA/tYRlkY5j9z/AAFn6', 'usuario'),
(3, 'pedro', 'Pedro', 'pedro@davinci.edu.ar', '$2y$10$wm12smhJ5E3iwy3Mg37PP.hzoyu6sls3bKqA/tYRlkY5j9z/AAFn6', 'usuario'),
(4, 'josefina', 'Josefina', 'josefina@davinci.edu.ar', '$2y$10$wm12smhJ5E3iwy3Mg37PP.hzoyu6sls3bKqA/tYRlkY5j9z/AAFn6', 'usuario'),
(5, 'nicolas', 'Nicolás Regina', 'nicolas.regina@davinci.edu.ar', '$2y$10$wm12smhJ5E3iwy3Mg37PP.hzoyu6sls3bKqA/tYRlkY5j9z/AAFn6', 'admin'),
(6, 'jorge', 'Jorge Perez', 'jorge.perez@davinci.edu.ar', '$2y$10$wm12smhJ5E3iwy3Mg37PP.hzoyu6sls3bKqA/tYRlkY5j9z/AAFn6', 'superadmin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `franquicias`
--
ALTER TABLE `franquicias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `items_x_compras`
--
ALTER TABLE `items_x_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compra_id` (`compra_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `franquicia_id` (`franquicia_id`),
  ADD KEY `marca_id` (`marca_id`);

--
-- Indices de la tabla `productos_categorias`
--
ALTER TABLE `productos_categorias`
  ADD PRIMARY KEY (`producto_id`,`categoria_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

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
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `franquicias`
--
ALTER TABLE `franquicias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `items_x_compras`
--
ALTER TABLE `items_x_compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `items_x_compras`
--
ALTER TABLE `items_x_compras`
  ADD CONSTRAINT `items_x_compras_ibfk_1` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`),
  ADD CONSTRAINT `items_x_compras_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`franquicia_id`) REFERENCES `franquicias` (`id`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`);

--
-- Filtros para la tabla `productos_categorias`
--
ALTER TABLE `productos_categorias`
  ADD CONSTRAINT `productos_categorias_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `productos_categorias_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `testimonios`
--
ALTER TABLE `testimonios`
  ADD CONSTRAINT `testimonios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
