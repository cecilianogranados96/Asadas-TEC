-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-04-2019 a las 10:39:40
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `acueductos`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`acueductos`@`%` PROCEDURE `Get_Asada` (IN `ASADA` INT)  NO SQL
SELECT * from asada where id_asada = ASADA$$

CREATE DEFINER=`acueductos`@`%` PROCEDURE `Get_Distritos` ()  NO SQL
SELECT CONCAT(loc_provincia.nombre,' -> ', loc_canton.nombre ,' -> ',loc_distrito.nombre) as ubicacion, loc_distrito.id_distrito as codigo FROM loc_canton,loc_distrito,loc_provincia WHERE loc_canton.id_provincia = loc_provincia.id_provincia and loc_distrito.id_canton = loc_canton.id_canton ORDER by loc_provincia.nombre, loc_canton.nombre, loc_distrito.nombre DESC$$

CREATE DEFINER=`acueductos`@`%` PROCEDURE `Get_Estado_Solicitud` ()  NO SQL
SELECT * FROM estado_solicitud$$

CREATE DEFINER=`acueductos`@`%` PROCEDURE `Get_Formulario_ID_Asada` (IN `Asada` INT)  NO SQL
SELECT CONCAT(persona.nombre,' ',persona.primerApellido,' ',persona.segundoApellido) as nombre_completo,persona.cedula,DATEDIFF(NOW(),formulario.fecha) as dias_transcurridos,formulario.fecha, formulario.id_tramite,formulario.respuesta,formulario.id_formulario, tramite.nombre,tramite.formulario,formulario.id_estado_solicitud as id_estado, estado_solicitud.nombre as estado from formulario,tramite,estado_solicitud ,usuario,persona
where formulario.id_tramite = tramite.id_tramite and formulario.id_estado_solicitud = estado_solicitud.id_estado_solicitud and formulario.id_usuario = usuario.id_usuario and persona.id_persona = usuario.id_persona and tramite.id_asada = Asada ORDER by formulario.id_estado_solicitud ASC$$

CREATE DEFINER=`acueductos`@`%` PROCEDURE `Get_Formulario_ID_Asada_ID_Estado` (IN `Asada` INT, IN `Estado` INT)  NO SQL
SELECT CONCAT(persona.nombre,' ',persona.primerApellido,' ',persona.segundoApellido) as nombre_completo,persona.cedula,formulario.fecha,DATEDIFF(NOW(),formulario.fecha) as dias_transcurridos, formulario.id_tramite,formulario.respuesta,formulario.id_formulario, tramite.nombre,tramite.formulario,formulario.id_estado_solicitud as id_estado, estado_solicitud.nombre as estado from formulario,tramite,estado_solicitud ,usuario,persona
where formulario.id_tramite = tramite.id_tramite and formulario.id_estado_solicitud = estado_solicitud.id_estado_solicitud and formulario.id_usuario = usuario.id_usuario and persona.id_persona = usuario.id_persona and tramite.id_asada = Asada and formulario.id_estado_solicitud = Estado ORDER by formulario.id_estado_solicitud ASC$$

CREATE DEFINER=`acueductos`@`%` PROCEDURE `Get_Formulario_ID_Formulario` (IN `Formulario` INT(11))  READS SQL DATA
    SQL SECURITY INVOKER
SELECT formulario.fecha, formulario.id_tramite,formulario.respuesta, tramite.nombre,tramite.formulario,formulario.id_estado_solicitud as id_estado, estado_solicitud.nombre as estado from formulario,tramite,estado_solicitud where formulario.id_tramite = tramite.id_tramite and formulario.id_estado_solicitud = estado_solicitud.id_estado_solicitud and formulario.id_formulario = Formulario ORDER by formulario.id_estado_solicitud DESC$$

CREATE DEFINER=`acueductos`@`%` PROCEDURE `Get_Formulario_Usuario` (IN `usuario1` INT)  NO SQL
SELECT formulario.fecha,tramite.nombre as tramite, estado_solicitud.nombre as estado_solicitud, formulario.id_formulario, formulario.id_estado_solicitud FROM `formulario`,tramite,estado_solicitud WHERE formulario.id_tramite = tramite.id_tramite and estado_solicitud.id_estado_solicitud = formulario.id_estado_solicitud and formulario.id_usuario = usuario1 ORDER by formulario.fecha,formulario.id_estado_solicitud ASC$$

CREATE DEFINER=`acueductos`@`%` PROCEDURE `Get_nombre_ID_Usuario` (IN `id_usuario` INT)  NO SQL
SELECT CONCAT(persona.nombre,' ', persona.primerApellido, ' ',persona.segundoApellido) as nombre, persona.direccion FROM usuario,persona WHERE usuario.id_persona = persona.id_persona and usuario.id_usuario = id_usuario$$

CREATE DEFINER=`acueductos`@`%` PROCEDURE `Get_Tramite` (IN `Asada` INT)  NO SQL
SELECT * from tramite WHERE tramite.id_asada = Asada ORDER by tramite.id_tramite DESC$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asada`
--

CREATE TABLE `asada` (
  `id_asada` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cedulaJuridica` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaFundacion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mision` text COLLATE utf8_unicode_ci,
  `vision` text COLLATE utf8_unicode_ci,
  `historia` text COLLATE utf8_unicode_ci,
  `direccion` text COLLATE utf8_unicode_ci,
  `logo` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `horario` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redes` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_distrito` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `asada`
--

INSERT INTO `asada` (`id_asada`, `nombre`, `cedulaJuridica`, `fechaFundacion`, `mision`, `vision`, `historia`, `direccion`, `logo`, `horario`, `redes`, `email`, `telefono`, `id_distrito`, `estado`) VALUES
(0, 'General', '', '0000-00-00', '', '', '', '', '', '', '', '', '', 10601, 0),
(1, 'San José de la Montaña', '3-002-162112', '19/07/1980', 'Ser líder y ejemplo a nivel nacional en la prestación de un servicio público que implica salud y desarrollo.', 'Brindar el servicio de agua potable en cantidad, continuidad y calidad a cada uno de nuestros usuarios con eficiencia y eficacia maximizando los recursos y logrando la satisfacción grupal e individual en la que cada decisión tomada se ampare en la honradez y espíritu de servicio.', 'La población cansada de tener un acueducto desordenado anárquico en donde hasta los funcionarios de esa institución se prestaban para poner dos o más conexiones en cada casa y en donde muchos compraban bombas para succionar el líquido, lo cual conllevaba a que en la gran mayoría de los hogares no llegara agua ni en la noche. Se hicieron varios levantamientos de protesta, pero el más importante fue el 7 de agosto de 1998 en donde se cerraron todas las vías de comunicación y el pueblo en general se lanzó a la calle y no dejaron entrar ni salir carros de la comunidad. Ante esta situación se hicieron presentes el Ejecutivo Municipal José Ernesto Ocampo y el diputado “Papo Soto” lo mismo que la prensa escrita y televisiva y entre reuniones y amagos de violencia se logró que la Municipalidad de Alajuela entregara el acueducto a una Asociación Comunal, llamada ASADA de San Rafael la cual empezó a fungir a partir del 9 de agosto de 1998. En el periodo transcurrido el acueducto ha mejorado sustancialmente el servicio de agua a la comunidad.', 'San José de la Montaña, barba de Heredia ', 'uploads/logos_asadas/ge1znq.jpg', 'Lunes a viernes de 8AM a 5:30PM', 'https://www.facebook.com/AsadaSjm', 'info@asada.com', '2222-2223', 10101, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_solicitud`
--

CREATE TABLE `estado_solicitud` (
  `id_estado_solicitud` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `estado_solicitud`
--

INSERT INTO `estado_solicitud` (`id_estado_solicitud`, `nombre`) VALUES
(1, 'Pendiente'),
(2, 'Aceptada'),
(3, 'Rechazada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE `formulario` (
  `id_formulario` int(11) NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_tramite` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `respuesta` text COLLATE utf8_spanish_ci NOT NULL,
  `id_estado_solicitud` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `formulario`
--

INSERT INTO `formulario` (`id_formulario`, `fecha`, `id_tramite`, `id_usuario`, `respuesta`, `id_estado_solicitud`) VALUES
(1, '2019-02-15 19:15:28', 2, 4, '{\"1\":\"Ingrid Lopez Ramirez\",\"2\":\"401720430\",\"3\":\"costado sur de la plaza de deportes\",\"4\":\"xxxxxxxxxxxxx\",\"5\":\"xxxxxxxxxxxx\",\"6\":\"xxxxxxxxxxx\",\"7\":\"xxxxxxxxxxxxxxxx\",\"8\":\"15-02-19\"}', 3),
(2, '2019-02-15 20:39:50', 3, 4, '{\"1\":\"15-02-19\",\"2\":\"ingrid \",\"3\":\"san jose de la montaña \",\"4\":\"xxxx\",\"5\":\"xxxxxxxxxxxx\",\"6\":\"fuga en el medidor\"}', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `cantidad` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_inventario`, `id_usuario`, `codigo`, `cantidad`) VALUES
(1, 3, 3, '9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loc_canton`
--

CREATE TABLE `loc_canton` (
  `id_canton` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_provincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `loc_canton`
--

INSERT INTO `loc_canton` (`id_canton`, `nombre`, `id_provincia`) VALUES
(101, 'San José', 1),
(102, 'Escazú', 1),
(103, 'Desamparados', 1),
(104, 'Puriscal', 1),
(105, 'Tarrazú', 1),
(106, 'Aserrí', 1),
(107, 'Mora', 1),
(108, 'Goicoechea', 1),
(109, 'Santa Ana', 1),
(110, 'Alajuelita', 1),
(111, 'Vázquez de Coronado', 1),
(112, 'Acosta', 1),
(113, 'Tibás', 1),
(114, 'Moravia', 1),
(115, 'Montes de Oca', 1),
(116, 'Turrubares', 1),
(117, 'Dota', 1),
(118, 'Curridabat', 1),
(119, 'Pérez Zeledón', 1),
(120, 'León Cortés Castro', 1),
(201, 'Alajuela', 2),
(202, 'San Ramón', 2),
(203, 'Grecia', 2),
(204, 'San Mateo', 2),
(205, 'Atenas', 2),
(206, 'Naranjo', 2),
(207, 'Palmares', 2),
(208, 'Poás', 2),
(209, 'Orotina', 2),
(210, 'San Carlos', 2),
(211, 'Zarcero', 2),
(212, 'Valverde Vega', 2),
(213, 'Upala', 2),
(214, 'Los Chiles', 2),
(215, 'Guatuso', 2),
(301, 'Cartago', 3),
(302, 'Paraíso', 3),
(303, 'La Unión', 3),
(304, 'Jiménez', 3),
(305, 'Turrialba', 3),
(306, 'Alvarado', 3),
(307, 'Oreamuno', 3),
(308, 'El Guarco', 3),
(401, 'Heredia', 4),
(402, 'Barva', 4),
(403, 'Santo Domingo', 4),
(404, 'Santa Bárbara', 4),
(405, 'San Rafael', 4),
(406, 'San Isidro', 4),
(407, 'Belén', 4),
(408, 'Flores', 4),
(409, 'San Pablo', 4),
(410, 'Sarapiquí', 4),
(501, 'Liberia', 5),
(502, 'Nicoya', 5),
(503, 'Santa Cruz', 5),
(504, 'Bagaces', 5),
(505, 'Carrillo', 5),
(506, 'Cañas', 5),
(507, 'Abangares', 5),
(508, 'Tilarán', 5),
(509, 'Nandayure', 5),
(510, 'La Cruz', 5),
(511, 'Hojancha', 5),
(601, 'Puntarenas', 6),
(602, 'Esparza', 6),
(603, 'Buenos Aires', 6),
(604, 'Montes de Oro', 6),
(605, 'Osa', 6),
(606, 'Quepos', 6),
(607, 'Golfito', 6),
(608, 'Coto Brus', 6),
(609, 'Parrita', 6),
(610, 'Corredores', 6),
(611, 'Garabito', 6),
(701, 'Limón', 7),
(702, 'Pococí', 7),
(703, 'Siquirres', 7),
(704, 'Talamanca', 7),
(705, 'Matina', 7),
(706, 'Guácimo', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loc_distrito`
--

CREATE TABLE `loc_distrito` (
  `id_distrito` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_canton` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `loc_distrito`
--

INSERT INTO `loc_distrito` (`id_distrito`, `nombre`, `id_canton`) VALUES
(10101, 'Carmen', 101),
(10102, 'Merced', 101),
(10103, 'Hospital', 101),
(10104, 'Catedral', 101),
(10105, 'Zapote', 101),
(10106, 'San Francisco de Dos Ríos', 101),
(10107, 'Uruca', 101),
(10108, 'Mata Redonda', 101),
(10109, 'Pavas', 101),
(10110, 'Hatillo', 101),
(10111, 'San Sebastián', 101),
(10201, 'Escazú', 102),
(10202, 'San Antonio', 102),
(10203, 'San Rafael', 102),
(10301, 'Desamparados', 103),
(10302, 'San Miguel', 103),
(10303, 'San Juan de Dios', 103),
(10304, 'San Rafael Arriba', 103),
(10305, 'San Antonio', 103),
(10306, 'Frailes', 103),
(10307, 'Patarrá', 103),
(10308, 'San Cristóbal', 103),
(10309, 'Rosario', 103),
(10310, 'Damas', 103),
(10311, 'San Rafael Abajo', 103),
(10312, 'Gravilias', 103),
(10313, 'Los Guido', 103),
(10401, 'Santiago', 104),
(10402, 'Mercedes Sur', 104),
(10403, 'Barbacoas', 104),
(10404, 'Grifo Alto', 104),
(10405, 'San Rafael', 104),
(10406, 'Candelarita', 104),
(10407, 'Desamparaditos', 104),
(10408, 'San Antonio', 104),
(10409, 'Chires', 104),
(10501, 'San Marcos', 105),
(10502, 'San Lorenzo', 105),
(10503, 'San Carlos', 105),
(10601, 'Aserrí', 106),
(10602, 'Tarbaca', 106),
(10603, 'Vuelta de Jorco', 106),
(10604, 'San Gabriel', 106),
(10605, 'Legua', 106),
(10606, 'Monterrey', 106),
(10607, 'Salitrillos', 106),
(10701, 'Colón', 107),
(10702, 'Guayabo', 107),
(10703, 'Tabarcia', 107),
(10704, 'Piedras Negras', 107),
(10705, 'Picagres', 107),
(10706, 'Jaris', 107),
(10801, 'Guadalupe', 108),
(10802, 'San Francisco', 108),
(10803, 'Calle Blancos', 108),
(10804, 'Mata de Plátano', 108),
(10805, 'Ipís', 108),
(10806, 'Rancho Redondo', 108),
(10807, 'Purral', 108),
(10901, 'Santa Ana', 109),
(10902, 'Salitral', 109),
(10903, 'Pozos', 109),
(10904, 'Uruca', 109),
(10905, 'Piedades', 109),
(10906, 'Brasil', 109),
(11001, 'Alajuelita', 110),
(11002, 'San Josecito', 110),
(11003, 'San Antonio', 110),
(11004, 'Concepción', 110),
(11005, 'San Felipe', 110),
(11101, 'San Isidro', 111),
(11102, 'San Rafael', 111),
(11103, 'Dulce Nombre de Jesús', 111),
(11104, 'Patalillo', 111),
(11105, 'Cascajal', 111),
(11201, 'San Ignacio', 112),
(11202, 'Guaitil', 112),
(11203, 'Palmichal', 112),
(11204, 'Cangrejal', 112),
(11205, 'Sabanillas', 112),
(11301, 'San Juan', 113),
(11302, 'Cinco Esquinas', 113),
(11303, 'Anselmo Llorente', 113),
(11304, 'León XIII', 113),
(11305, 'Colima', 113),
(11401, 'San Vicente', 114),
(11402, 'San Jerónimo', 114),
(11403, 'La Trinidad', 114),
(11501, 'San Pedro', 115),
(11502, 'Sabanilla', 115),
(11503, 'Mercedes', 115),
(11504, 'San Rafael', 115),
(11601, 'San Pablo', 116),
(11602, 'San Pedro', 116),
(11603, 'San Juan de Mata', 116),
(11604, 'San Luis', 116),
(11605, 'Carara', 116),
(11701, 'Santa María', 117),
(11702, 'Jardín', 117),
(11703, 'Copey', 117),
(11801, 'Curridabat', 118),
(11802, 'Granadilla', 118),
(11803, 'Sánchez', 118),
(11804, 'Tirrases', 118),
(11901, 'San Isidro de El General', 119),
(11902, 'General', 119),
(11903, 'Daniel Flores', 119),
(11904, 'Rivas', 119),
(11905, 'San Pedro', 119),
(11906, 'Platanares', 119),
(11907, 'Pejibaye', 119),
(11908, 'Cajón', 119),
(11909, 'Barú', 119),
(11910, 'Río Nuevo', 119),
(11911, 'Páramo', 119),
(12001, 'San Pablo', 120),
(12002, 'San Andrés', 120),
(12003, 'Llano Bonito', 120),
(12004, 'San Isidro', 120),
(12005, 'Santa Cruz', 120),
(12006, 'San Antonio', 120),
(20101, 'Alajuela', 201),
(20102, 'San José', 201),
(20103, 'Carrizal', 201),
(20104, 'San Antonio', 201),
(20105, 'Guácima', 201),
(20106, 'San Isidro', 201),
(20107, 'Sabanilla', 201),
(20108, 'San Rafael', 201),
(20109, 'Río Segundo', 201),
(20110, 'Desamparados', 201),
(20111, 'Turrúcares', 201),
(20112, 'Tambor', 201),
(20113, 'Garita', 201),
(20114, 'Sarapiquí', 201),
(20201, 'San Ramón', 202),
(20202, 'Santiago', 202),
(20203, 'San Juan', 202),
(20204, 'Piedades Norte', 202),
(20205, 'Piedades Sur', 202),
(20206, 'San Rafael', 202),
(20207, 'San Isidro', 202),
(20208, 'Los Ángeles', 202),
(20209, 'Alfaro', 202),
(20210, 'Volio', 202),
(20211, 'Concepción', 202),
(20212, 'Zapotal', 202),
(20213, 'Peñas Blancas', 202),
(20301, 'Grecia', 203),
(20302, 'San Isidro', 203),
(20303, 'San José', 203),
(20304, 'San Roque', 203),
(20305, 'Tacares', 203),
(20306, 'Río Cuarto', 203),
(20307, 'Puente de Piedra', 203),
(20308, 'Bolívar', 203),
(20401, 'San Mateo', 204),
(20402, 'Desmonte', 204),
(20403, 'Jesús María', 204),
(20501, 'Atenas', 205),
(20502, 'Jesús', 205),
(20503, 'Mercedes', 205),
(20504, 'San Isidro', 205),
(20505, 'Concepción', 205),
(20506, 'San José', 205),
(20507, 'Santa Eulalia', 205),
(20508, 'Escobal', 205),
(20601, 'Naranjo', 206),
(20602, 'San Miguel', 206),
(20603, 'San José', 206),
(20604, 'Cirrí Sur', 206),
(20605, 'San Jerónimo', 206),
(20606, 'San Juan', 206),
(20607, 'El Rosario', 206),
(20608, 'Palmitos', 206),
(20701, 'Palmares', 207),
(20702, 'Zaragoza', 207),
(20703, 'Buenos Aires', 207),
(20704, 'Santiago', 207),
(20705, 'Candelaria', 207),
(20706, 'Esquipulas', 207),
(20707, 'La Granja', 207),
(20801, 'San Pedro', 208),
(20802, 'San Juan', 208),
(20803, 'San Rafael', 208),
(20804, 'Carrillos', 208),
(20805, 'Sabana Redonda', 208),
(20901, 'Orotina', 209),
(20902, 'El Mastate', 209),
(20903, 'Hacienda Vieja', 209),
(20904, 'Coyolar', 209),
(20905, 'La Ceiba', 209),
(21001, 'Quesada', 210),
(21002, 'Florencia', 210),
(21003, 'Buenavista', 210),
(21004, 'Aguas Zarcas', 210),
(21005, 'Venecia', 210),
(21006, 'Pital', 210),
(21007, 'La Fortuna', 210),
(21008, 'La Tigra', 210),
(21009, 'La Palmera', 210),
(21010, 'Venado', 210),
(21011, 'Cutris', 210),
(21012, 'Monterrey', 210),
(21013, 'Pocosol', 210),
(21101, 'Zarcero', 211),
(21102, 'Laguna', 211),
(21103, 'Tapesco', 211),
(21104, 'Guadalupe', 211),
(21105, 'Palmira', 211),
(21106, 'Zapote', 211),
(21107, 'Brisas', 211),
(21201, 'Sarchí Norte', 212),
(21202, 'Sarchí Sur', 212),
(21203, 'Toro Amarillo', 212),
(21204, 'San Pedro', 212),
(21205, 'Rodríguez', 212),
(21301, 'Upala', 213),
(21302, 'Aguas Claras', 213),
(21303, 'San José (Pizote)', 213),
(21304, 'Bijagua', 213),
(21305, 'Delicias', 213),
(21306, 'Dos Ríos', 213),
(21307, 'Yoliyllal', 213),
(21401, 'Los Chiles', 214),
(21402, 'Caño Negro', 214),
(21403, 'El Amparo', 214),
(21404, 'San Jorge', 214),
(21501, 'San Rafael', 215),
(21502, 'Buenavista', 215),
(21503, 'Cote', 215),
(21504, 'Katira', 215),
(30101, 'Oriental', 301),
(30102, 'Occidental', 301),
(30103, 'Carmen', 301),
(30104, 'San Nicolás', 301),
(30105, 'Aguacaliente (San Francisco)', 301),
(30106, 'Guadalupe (Arenilla)', 301),
(30107, 'Corralillo', 301),
(30108, 'Tierra Blanca', 301),
(30109, 'Dulce Nombre', 301),
(30110, 'Llano Grande', 301),
(30111, 'Quebradilla', 301),
(30201, 'Paraíso', 302),
(30202, 'Santiago', 302),
(30203, 'Orosi', 302),
(30204, 'Cachí', 302),
(30205, 'Llanos de Santa Lucía', 302),
(30301, 'Tres Ríos', 303),
(30302, 'San Diego', 303),
(30303, 'San Juan', 303),
(30304, 'San Rafael', 303),
(30305, 'Concepción', 303),
(30306, 'Dulce Nombre', 303),
(30307, 'San Ramón', 303),
(30308, 'Río Azul', 303),
(30401, 'Juan Viñas', 304),
(30402, 'Tucurrique', 304),
(30403, 'Pejibaye', 304),
(30501, 'Turrialba', 305),
(30502, 'La Suiza', 305),
(30503, 'Peralta', 305),
(30504, 'Santa Cruz', 305),
(30505, 'Santa Teresita', 305),
(30506, 'Pavones', 305),
(30507, 'Tuis', 305),
(30508, 'Tayutic', 305),
(30509, 'Santa Rosa', 305),
(30510, 'Tres Equis', 305),
(30511, 'La Isabel', 305),
(30512, 'Chirripó', 305),
(30601, 'Pacayas', 306),
(30602, 'Cervantes', 306),
(30603, 'Capellades', 306),
(30701, 'San Rafael', 307),
(30702, 'Cot', 307),
(30703, 'Potrero Cerrado', 307),
(30704, 'Cipreses', 307),
(30705, 'Santa Rosa', 307),
(30801, 'El Tejar', 308),
(30802, 'San Isidro', 308),
(30803, 'Tobosi', 308),
(30804, 'Patio de Agua', 308),
(40101, 'Heredia', 401),
(40102, 'Mercedes', 401),
(40103, 'San Francisco', 401),
(40104, 'Ulloa', 401),
(40105, 'Varablanca', 401),
(40201, 'Barva', 402),
(40202, 'San Pedro', 402),
(40203, 'San Pablo', 402),
(40204, 'San Roque', 402),
(40205, 'Santa Lucía', 402),
(40206, 'San José de la Montaña', 402),
(40301, 'Santo Domingo', 403),
(40302, 'San Vicente', 403),
(40303, 'San Miguel', 403),
(40304, 'Paracito', 403),
(40305, 'Santo Tomás', 403),
(40306, 'Santa Rosa', 403),
(40307, 'Tures', 403),
(40308, 'Para', 403),
(40401, 'Santa Bárbara', 404),
(40402, 'San Pedro', 404),
(40403, 'San Juan', 404),
(40404, 'Jesús', 404),
(40405, 'Santo Domingo', 404),
(40406, 'Puraba', 404),
(40501, 'San Rafael', 405),
(40502, 'San Josécito', 405),
(40503, 'Santiago', 405),
(40504, 'Los Ángeles', 405),
(40505, 'Concepción', 405),
(40601, 'San Isidro', 406),
(40602, 'San José', 406),
(40603, 'Concepción', 406),
(40604, 'San Francisco', 406),
(40701, 'San Antonio', 407),
(40702, 'La Ribera', 407),
(40703, 'La Asunción', 407),
(40801, 'San Joaquín de Flores', 408),
(40802, 'Barrantes', 408),
(40803, 'Llorente', 408),
(40901, 'San Pablo', 409),
(40902, 'Rincón de Sabanilla', 409),
(41001, 'Puerto Viejo', 410),
(41002, 'La Virgen', 410),
(41003, 'Horquetas', 410),
(41004, 'Llanuras del Gaspar', 410),
(41005, 'Cureña', 410),
(50101, 'Liberia', 501),
(50102, 'Cañas Dulces', 501),
(50103, 'Mayorga', 501),
(50104, 'Nacascolo', 501),
(50105, 'Curubande', 501),
(50201, 'Nicoya', 502),
(50202, 'Mansion', 502),
(50203, 'San Antonio', 502),
(50204, 'Quebrada Honda', 502),
(50205, 'Samara', 502),
(50206, 'Nosara', 502),
(50207, 'Belén de Nosarita', 502),
(50301, 'Santa Cruz', 503),
(50302, 'Bolson', 503),
(50303, 'Veintisiete de Abril', 503),
(50304, 'Tempate', 503),
(50305, 'Cartagena', 503),
(50306, 'Cuajiniquil', 503),
(50307, 'Diria', 503),
(50308, 'Cabo Velas', 503),
(50309, 'Tamarindo', 503),
(50401, 'Bagaces', 504),
(50402, 'Fortuna', 504),
(50403, 'Mogote', 504),
(50404, 'Río Naranjo', 504),
(50501, 'Filadelfia', 505),
(50502, 'Palmira', 505),
(50503, 'Sardinal', 505),
(50504, 'Belén', 505),
(50601, 'Cañas', 506),
(50602, 'Palmira', 506),
(50603, 'San Miguel', 506),
(50604, 'Bebedero', 506),
(50605, 'Porozal', 506),
(50701, 'Juntas', 507),
(50702, 'Sierra', 507),
(50703, 'San Juan', 507),
(50704, 'Colorado', 507),
(50801, 'Tilarán', 508),
(50802, 'Quebrada Grande', 508),
(50803, 'Tronadora', 508),
(50804, 'Santa Rosa', 508),
(50805, 'Líbano', 508),
(50806, 'Tierras Morenas', 508),
(50807, 'Arenal', 508),
(50901, 'Carmona', 509),
(50902, 'Santa Rita', 509),
(50903, 'Zapotal', 509),
(50904, 'San Pablo', 509),
(50905, 'Porvenir', 509),
(50906, 'Bejuco', 509),
(51001, 'La Cruz', 510),
(51002, 'Santa Cecilia', 510),
(51003, 'Garita', 510),
(51004, 'Santa Elena', 510),
(51101, 'Hojancha', 511),
(51102, 'Monte Romo', 511),
(51103, 'Puerto Carrillo', 511),
(51104, 'Huacas', 511),
(60101, 'Puntarenas', 601),
(60102, 'Pitahaya', 601),
(60103, 'Chomes', 601),
(60104, 'Lepanto', 601),
(60105, 'Paquera', 601),
(60106, 'Manzanillo', 601),
(60107, 'Guacimal', 601),
(60108, 'Barranca', 601),
(60109, 'Monte Verde', 601),
(60110, 'Isla del Coco', 601),
(60111, 'Cobano', 601),
(60112, 'Chacarita', 601),
(60113, 'Chira', 601),
(60114, 'Acapulco', 601),
(60115, 'El Roble', 601),
(60116, 'Arancibia', 601),
(60201, 'Espiritu Santo', 602),
(60202, 'San Juan Grande', 602),
(60203, 'Macacona', 602),
(60204, 'San Rafael', 602),
(60205, 'San Jerónimo', 602),
(60301, 'Buenos Aires', 603),
(60302, 'Volcan', 603),
(60303, 'Potrero Grande', 603),
(60304, 'Boruca', 603),
(60305, 'Pilas', 603),
(60306, 'Colinas', 603),
(60307, 'Changena', 603),
(60308, 'Briolley', 603),
(60309, 'Brunka', 603),
(60401, 'Miramar', 604),
(60402, 'La Unión', 604),
(60403, 'San Isidro', 604),
(60501, 'Puerto Cortes', 605),
(60502, 'Palmar', 605),
(60503, 'Sierpe', 605),
(60504, 'Bahia Ballena', 605),
(60505, 'Piedras Blancas', 605),
(60601, 'Quepos', 606),
(60602, 'Savegre', 606),
(60603, 'Naranjito', 606),
(60701, 'Golfito', 607),
(60702, 'Puerto Jiménez', 607),
(60703, 'Guaycara', 607),
(60704, 'Pavon', 607),
(60801, 'San Vito', 608),
(60802, 'Sabalito', 608),
(60803, 'Aguabuena', 608),
(60804, 'Limóncito', 608),
(60805, 'Pittier', 608),
(60901, 'Parrita', 609),
(61001, 'Corredor', 610),
(61002, 'La Cuesta', 610),
(61003, 'Canoas', 610),
(61004, 'Laurel', 610),
(61101, 'Jacó', 611),
(61102, 'Tarcoles', 611),
(70101, 'Limón', 701),
(70102, 'Valle La Estrella', 701),
(70103, 'Río Blanco', 701),
(70104, 'Matama', 701),
(70201, 'Guapiles', 702),
(70202, 'Jiménez', 702),
(70203, 'Rita', 702),
(70204, 'Roxana', 702),
(70205, 'Cariari', 702),
(70206, 'Colorado', 702),
(70301, 'Siquirres', 703),
(70302, 'Pacuarito', 703),
(70303, 'Florida', 703),
(70304, 'Germania', 703),
(70305, 'Cairo', 703),
(70306, 'Alegria', 703),
(70401, 'Bratsi', 704),
(70402, 'Sixaola', 704),
(70403, 'Cahuita', 704),
(70404, 'Telire', 704),
(70501, 'Matina', 705),
(70502, 'Battan', 705),
(70503, 'Carrandi', 705),
(70601, 'Guácimo', 706),
(70602, 'Mercedes', 706),
(70603, 'Pocora', 706),
(70604, 'Río Jiménez', 706),
(70605, 'Duacari', 706);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loc_pais`
--

CREATE TABLE `loc_pais` (
  `id_pais` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `loc_pais`
--

INSERT INTO `loc_pais` (`id_pais`, `nombre`) VALUES
(1, 'Costa Rica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loc_provincia`
--

CREATE TABLE `loc_provincia` (
  `id_provincia` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_pais` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `loc_provincia`
--

INSERT INTO `loc_provincia` (`id_provincia`, `nombre`, `id_pais`) VALUES
(1, 'San José', 1),
(2, 'Alajuela', 1),
(3, 'Cartago', 1),
(4, 'Heredia', 1),
(5, 'Guanacaste', 1),
(6, 'Puntarenas', 1),
(7, 'Limón', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id_noticia` int(11) NOT NULL,
  `titulo` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contenido` text COLLATE utf8_unicode_ci,
  `imagen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_asada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id_noticia`, `titulo`, `contenido`, `imagen`, `fecha`, `id_asada`) VALUES
(1, 'nuevo logo de la Asada ', ' usuarios de la Asada de San José  de la Montaña les comunicamos que este es nuestro nuevo logo  ', 'uploads/noticias/hybf4y.png', '2019-02-04 20:13:35', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_trabajo`
--

CREATE TABLE `ordenes_trabajo` (
  `id_orden` int(11) NOT NULL,
  `id_formulario` int(11) NOT NULL,
  `id_encargado` int(11) NOT NULL,
  `id_usuario_apertura` int(11) NOT NULL,
  `historial` text NOT NULL,
  `material` text NOT NULL,
  `estado` int(3) NOT NULL DEFAULT '1',
  `fecha_apertura` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_modificacion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ordenes_trabajo`
--

INSERT INTO `ordenes_trabajo` (`id_orden`, `id_formulario`, `id_encargado`, `id_usuario_apertura`, `historial`, `material`, `estado`, `fecha_apertura`, `ultima_modificacion`) VALUES
(1, 1, 3, 2, '', '', 3, '2019-02-15 19:18:41', '0000-00-00 00:00:00'),
(2, 2, 3, 2, '', '', 1, '2019-02-15 20:42:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `cedula` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `primerApellido` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `segundoApellido` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_distrito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `cedula`, `nombre`, `primerApellido`, `segundoApellido`, `direccion`, `telefono`, `email`, `id_distrito`) VALUES
(2, '1-1659-0468', 'MASTER', NULL, NULL, NULL, '', 'master@acueductos.org', 10601),
(3, '3002162112', 'Asociación administradora ', 'Acueducto', 'San José de la Montaña', '50 metros sur de la escuela', '222222', 'acueductosjm@gmail.com', 40206),
(4, '401320507', 'OSCAR', 'ESPINOZA', 'GONZALEZ', 'costado sur de la plaza de deportes', '', 'Oskitar22cr@gmail.com', 40206),
(5, '4-0172-0430', 'Ingrid', 'Lopez', 'Ramirez', 'costado sur de la plaza de deportes', '', 'ilopezra@ymail.com', 40206);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `id_asada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `id_asada`) VALUES
(1, 'llave de paso de 1/2', 1),
(2, 'hidrometro 1/2\"', 1),
(3, 'juego de accesorios de bronce de 1/2\"', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `id_puesto` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`id_puesto`, `nombre`) VALUES
(1, 'Presidente'),
(2, 'Vicepresidente'),
(3, 'Secretaría'),
(4, 'Tesorería'),
(5, 'Vocal 1'),
(6, 'Vocal 2'),
(7, 'Fiscal'),
(8, 'Vocal 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto_x_junta_directiva`
--

CREATE TABLE `puesto_x_junta_directiva` (
  `id_puesto_x_junta_directiva` int(11) NOT NULL,
  `id_puesto` int(11) NOT NULL,
  `id_asada` int(11) NOT NULL,
  `nombre` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `puesto_x_junta_directiva`
--

INSERT INTO `puesto_x_junta_directiva` (`id_puesto_x_junta_directiva`, `id_puesto`, `id_asada`, `nombre`) VALUES
(2, 2, 1, 'Aida Hernández  Alfaro'),
(3, 3, 1, 'Felicia Montero Campos'),
(4, 4, 1, 'Zulay Chavarria Díaz'),
(5, 5, 1, 'Alberto Villalobos Guevara'),
(6, 6, 1, 'Sebastian Cordero Villalobos'),
(7, 1, 1, 'Luis Solano Ramírez'),
(8, 7, 1, 'Felicia Montero Campos '),
(9, 8, 1, 'Guillermo Cubillos Sanchez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_campo`
--

CREATE TABLE `tipo_campo` (
  `id_tipo_campo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_campo`
--

INSERT INTO `tipo_campo` (`id_tipo_campo`, `nombre`) VALUES
(1, 'Usuario'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `nombre`) VALUES
(1, 'Usuario'),
(2, 'Administrador'),
(3, 'Master'),
(4, 'Fontanero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramite`
--

CREATE TABLE `tramite` (
  `id_tramite` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `requisitos` text COLLATE utf8_unicode_ci,
  `plantilla` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `formulario` text COLLATE utf8_unicode_ci NOT NULL,
  `id_asada` int(11) NOT NULL,
  `estado_tramite` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `tramite`
--

INSERT INTO `tramite` (`id_tramite`, `nombre`, `descripcion`, `requisitos`, `plantilla`, `formulario`, `id_asada`, `estado_tramite`) VALUES
(1, 'Formulario para solicitar disponibilidad hidríca  ', 'solicitud de disponibilidad hídrica ', 'indicados en le formulario', 'uploads/tramites/.', '[{\"nombre\":\"solicitud de disponibilidad hídrica \",\"tipo\":\"3\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]},{\"nombre\":\"solicitud de disponibilidad hídrica \",\"tipo\":\"3\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]}]', 1, 0),
(2, 'Formulario para solicitar disponibilidad hídrica ', 'solicitud de disponibilidad hídrica para tramitar: \r\npermisos de cosntrucción\r\nvisado de planos \r\nsegregación de finca\r\ntramites bancarios\r\notros\r\n', '1- solicitud llena y legible\r\n2- copia del plano catastrado o de la presentación ante catastro\r\n3- en caso de segrerar plano madre debe presentar croquis y copia de planos de los lotes que pretende segregar \r\n4- copia de la cédula del propietario o representante legal por ambos lados \r\n5- certificación literal original otorgada por el Registro de la Propiedad con menos de 30 días de emitida.  \r\n6- carta hecha por el interesado indicando el fin para el que requiere la disponibilidad hídrica, además, en caso de enviar un representante a realizar el trámite este debe presentar la debida autorización con copia de su cédula de identidad. ', 'uploads/tramites/.', '[{\"nombre\":\"Nombre completo \",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"nombre_completo\",\"opciones\":[\"\"]},{\"nombre\":\"Número de Cédula \",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]},{\"nombre\":\"Dirección exacta \",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"direccion\",\"opciones\":[\"\"]},{\"nombre\":\"Numero de plano o presentación ante catastro\",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]},{\"nombre\":\"Numero de finca o folio real \",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]},{\"nombre\":\"Teléfono de contacto  \",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]},{\"nombre\":\"correo electrónico  \",\"tipo\":\"1\",\"requerido\":\"2\",\"campo\":\"ninguno\",\"opciones\":[\"\"]},{\"nombre\":\"fecha de solicitud   \",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]}]', 1, 0),
(3, 'orden de trabajo ', 'en esta orden puede reportar o solicitar :\r\ndaños y revisión de daos \r\nrevisión por alto consumo\r\n', 'complete  los espacios  requeridos para atender su reporte.  \r\nel usuario debe estar presente durante la revisión ', 'uploads/tramites/ObZRJ0.(1)', '[{\"nombre\":\"fecha de reporte \",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]},{\"nombre\":\"Nombre del usuario \",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]},{\"nombre\":\"dirección exacta  \",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]},{\"nombre\":\"Número de paja \",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]},{\"nombre\":\"teléfono de contacto \",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]},{\"nombre\":\"Descripción del reporte \",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]}]', 1, 1),
(4, 'solicitud de disponibilidad hidrica', 'xxxx', 'xxxx', 'uploads/tramites/MTIcAn.docx', '[{\"nombre\":\"xxx\",\"tipo\":\"1\",\"requerido\":\"1\",\"campo\":\"ninguno\",\"opciones\":[\"\"]}]', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `usuario` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_usuario_id` int(11) NOT NULL DEFAULT '1',
  `id_asada` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_persona`, `usuario`, `contrasena`, `tipo_usuario_id`, `id_asada`) VALUES
(1, 2, 'master', '21232f297a57a5a743894a0e4a801fc3', 3, 0),
(2, 3, 'sjm', '21232f297a57a5a743894a0e4a801fc3', 2, 1),
(3, 4, 'fonta', '8b23de62e68aee3ba3bef24137791128', 4, 1),
(4, 5, 'ilg', '880ed78cfeb8524aa6a57eb82bd36af9', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asada`
--
ALTER TABLE `asada`
  ADD PRIMARY KEY (`id_asada`),
  ADD KEY `fk_asada_distrito` (`id_distrito`);

--
-- Indices de la tabla `estado_solicitud`
--
ALTER TABLE `estado_solicitud`
  ADD PRIMARY KEY (`id_estado_solicitud`);

--
-- Indices de la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`id_formulario`),
  ADD KEY `fk_formulario_estado` (`id_estado_solicitud`),
  ADD KEY `fk_formulario_tramite` (`id_tramite`),
  ADD KEY `fk_formulario_usuario` (`id_usuario`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `fk_inventario_producto` (`codigo`),
  ADD KEY `fk_inventario_usuario` (`id_usuario`);

--
-- Indices de la tabla `loc_canton`
--
ALTER TABLE `loc_canton`
  ADD PRIMARY KEY (`id_canton`),
  ADD KEY `fk_provincia` (`id_provincia`);

--
-- Indices de la tabla `loc_distrito`
--
ALTER TABLE `loc_distrito`
  ADD PRIMARY KEY (`id_distrito`),
  ADD KEY `fk_canton` (`id_canton`);

--
-- Indices de la tabla `loc_pais`
--
ALTER TABLE `loc_pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `loc_provincia`
--
ALTER TABLE `loc_provincia`
  ADD PRIMARY KEY (`id_provincia`),
  ADD KEY `fk_pais` (`id_pais`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id_noticia`),
  ADD KEY `fk_noticia_asada` (`id_asada`);

--
-- Indices de la tabla `ordenes_trabajo`
--
ALTER TABLE `ordenes_trabajo`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `fk_orden_encargado` (`id_encargado`),
  ADD KEY `fk_orden_apertura` (`id_usuario_apertura`),
  ADD KEY `fk_orden_formulario` (`id_formulario`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `fk_persona_distritro` (`id_distrito`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_producto_asada` (`id_asada`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`id_puesto`);

--
-- Indices de la tabla `puesto_x_junta_directiva`
--
ALTER TABLE `puesto_x_junta_directiva`
  ADD PRIMARY KEY (`id_puesto_x_junta_directiva`),
  ADD KEY `fk_puesto_puesto` (`id_puesto`),
  ADD KEY `fk_puesto_asada` (`id_asada`);

--
-- Indices de la tabla `tipo_campo`
--
ALTER TABLE `tipo_campo`
  ADD PRIMARY KEY (`id_tipo_campo`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `tramite`
--
ALTER TABLE `tramite`
  ADD PRIMARY KEY (`id_tramite`),
  ADD KEY `fk_tramite_asada` (`id_asada`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_persona` (`id_persona`),
  ADD KEY `fk_usuario_tipo_usuario` (`tipo_usuario_id`),
  ADD KEY `fk_usuario_asada` (`id_asada`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asada`
--
ALTER TABLE `asada`
  MODIFY `id_asada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado_solicitud`
--
ALTER TABLE `estado_solicitud`
  MODIFY `id_estado_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `formulario`
--
ALTER TABLE `formulario`
  MODIFY `id_formulario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `loc_distrito`
--
ALTER TABLE `loc_distrito`
  MODIFY `id_distrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70606;

--
-- AUTO_INCREMENT de la tabla `loc_pais`
--
ALTER TABLE `loc_pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `loc_provincia`
--
ALTER TABLE `loc_provincia`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ordenes_trabajo`
--
ALTER TABLE `ordenes_trabajo`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `id_puesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `puesto_x_junta_directiva`
--
ALTER TABLE `puesto_x_junta_directiva`
  MODIFY `id_puesto_x_junta_directiva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipo_campo`
--
ALTER TABLE `tipo_campo`
  MODIFY `id_tipo_campo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tramite`
--
ALTER TABLE `tramite`
  MODIFY `id_tramite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asada`
--
ALTER TABLE `asada`
  ADD CONSTRAINT `fk_asada_distrito` FOREIGN KEY (`id_distrito`) REFERENCES `loc_distrito` (`id_distrito`);

--
-- Filtros para la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD CONSTRAINT `fk_formulario_estado` FOREIGN KEY (`id_estado_solicitud`) REFERENCES `estado_solicitud` (`id_estado_solicitud`),
  ADD CONSTRAINT `fk_formulario_tramite` FOREIGN KEY (`id_tramite`) REFERENCES `tramite` (`id_tramite`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_formulario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_inventario_producto` FOREIGN KEY (`codigo`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `fk_inventario_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `loc_canton`
--
ALTER TABLE `loc_canton`
  ADD CONSTRAINT `fk_provincia` FOREIGN KEY (`id_provincia`) REFERENCES `loc_provincia` (`id_provincia`);

--
-- Filtros para la tabla `loc_distrito`
--
ALTER TABLE `loc_distrito`
  ADD CONSTRAINT `fk_canton` FOREIGN KEY (`id_canton`) REFERENCES `loc_canton` (`id_canton`);

--
-- Filtros para la tabla `loc_provincia`
--
ALTER TABLE `loc_provincia`
  ADD CONSTRAINT `fk_pais` FOREIGN KEY (`id_pais`) REFERENCES `loc_pais` (`id_pais`);

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `fk_noticia_asada` FOREIGN KEY (`id_asada`) REFERENCES `asada` (`id_asada`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenes_trabajo`
--
ALTER TABLE `ordenes_trabajo`
  ADD CONSTRAINT `fk_orden_apertura` FOREIGN KEY (`id_usuario_apertura`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_orden_encargado` FOREIGN KEY (`id_encargado`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_orden_formulario` FOREIGN KEY (`id_formulario`) REFERENCES `formulario` (`id_formulario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_persona_distritro` FOREIGN KEY (`id_distrito`) REFERENCES `loc_distrito` (`id_distrito`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_asada` FOREIGN KEY (`id_asada`) REFERENCES `asada` (`id_asada`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `puesto_x_junta_directiva`
--
ALTER TABLE `puesto_x_junta_directiva`
  ADD CONSTRAINT `fk_puesto_asada` FOREIGN KEY (`id_asada`) REFERENCES `asada` (`id_asada`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_puesto_puesto` FOREIGN KEY (`id_puesto`) REFERENCES `puesto` (`id_puesto`);

--
-- Filtros para la tabla `tramite`
--
ALTER TABLE `tramite`
  ADD CONSTRAINT `fk_tramite_asada` FOREIGN KEY (`id_asada`) REFERENCES `asada` (`id_asada`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_asada` FOREIGN KEY (`id_asada`) REFERENCES `asada` (`id_asada`),
  ADD CONSTRAINT `fk_usuario_tipo_usuario` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_usuario` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
