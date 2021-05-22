-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-01-2021 a las 22:40:49
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `coronelsystem`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `categoria` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `deporte` int(11) NOT NULL,
  `estado` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `categoria`, `deporte`, `estado`) VALUES
(1, '2012-2013', 1, 'ACTIVO'),
(2, '2011-2012', 1, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiondirectiva`
--

CREATE TABLE `comisiondirectiva` (
  `idcomisiondirectiva` int(11) NOT NULL,
  `presidente` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `vicepresidente` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `secretario` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `tesorero` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `miembros` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `periodo` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estado` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comisiondirectiva`
--

INSERT INTO `comisiondirectiva` (`idcomisiondirectiva`, `presidente`, `vicepresidente`, `secretario`, `tesorero`, `miembros`, `periodo`, `estado`) VALUES
(2, 'Ing. Claudio Javier González', 'Dr. Francisco Ruben Frutos Figueredo', 'Ing. Santiago Raul Vazquez', 'Lic. Carlos Rubén González Benitez', 'Vice Presidente 2: Sr Aristides Fernandez\r\nProSecretaria: Ing. Elena Galeano\r\n-Abg. Martin Giret\r\n-Dr. Carlos Cano\r\n-Sr. Cesar Vera\r\n-Abg. Raúl Portillo\r\n-Ing. Hugo Espínola\r\n-Sr. Alcides Andres Frutos\r\n-Dr. Santiago Franco\r\n-Abg. Juan Onieva\r\n-Abg. Gerardo Martínez\r\n-Jonas Sotomayor', '2019-2020', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `idcontrato` int(11) NOT NULL,
  `nroContrato` int(11) NOT NULL,
  `fechaContrato` date NOT NULL,
  `idrazonsocial` int(11) NOT NULL,
  `idsocio` int(11) NOT NULL,
  `idtiposocio` int(11) NOT NULL,
  `idasamblea` int(11) NOT NULL,
  `estado` varchar(80) NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`idcontrato`, `nroContrato`, `fechaContrato`, `idrazonsocial`, `idsocio`, `idtiposocio`, `idasamblea`, `estado`) VALUES
(1, 1, '2000-01-01', 1, 1, 2, 1, 'ACTIVO'),
(2, 2, '2020-04-21', 2, 2, 1, 1, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deporte`
--

CREATE TABLE `deporte` (
  `iddeporte` int(11) NOT NULL,
  `deporte` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `costoMensual` int(11) NOT NULL,
  `mesinicio` int(11) NOT NULL,
  `duracion` int(11) NOT NULL,
  `estado` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `deporte`
--

INSERT INTO `deporte` (`iddeporte`, `deporte`, `costoMensual`, `mesinicio`, `duracion`, `estado`) VALUES
(1, 'Escuela de Futbol', 100000, 12, 5, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE `familia` (
  `idrazonsocial` int(11) NOT NULL,
  `cifamiliar` varchar(120) NOT NULL,
  `razonsocial` varchar(250) NOT NULL,
  `parentesco` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`idrazonsocial`, `cifamiliar`, `razonsocial`, `parentesco`) VALUES
(1, '1169070', 'BALDOVINA VERA DE SOTOMAYOR', 'PADRE/MADRE'),
(1, '826404', 'EUTAQUIO JUSTO SOTOMAYOR ', 'PADRE/MADRE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble`
--

CREATE TABLE `inmueble` (
  `idinmueble` int(11) NOT NULL,
  `determinacion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` text COLLATE utf8_spanish_ci NOT NULL,
  `cuentacatastral` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `costomensual` int(11) NOT NULL,
  `costosemestral` int(11) NOT NULL,
  `costoanual` int(11) NOT NULL,
  `estado` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inmueble`
--

INSERT INTO `inmueble` (`idinmueble`, `determinacion`, `ubicacion`, `cuentacatastral`, `costomensual`, `costosemestral`, `costoanual`, `estado`) VALUES
(1, 'SALON COMERCIAL 1', 'calle Enrique Scavenius c/ Dr. Juan Manuel Cano Melgarejo', '21-0181-02', 1500000, 18000000, 9000000, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `codigoPermiso` int(11) NOT NULL,
  `descripcionPermiso` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `ServicioTipo` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `estadoPermiso` varchar(255) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`codigoPermiso`, `descripcionPermiso`, `ServicioTipo`, `estadoPermiso`) VALUES
(1, 'Home', '1', 'ACTIVO'),
(2, 'Administrador', '1', 'ACTIVO'),
(3, 'Secretaria', '1', 'ACTIVO'),
(4, 'Caja', '1', 'ACTIVO'),
(5, 'AdministradorDeportivo', '1', 'ACTIVO'),
(6, 'SecretarioDeportivo', '1', 'ACTIVO'),
(7, 'TesoreroDeportivo', '1', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razonsocial`
--

CREATE TABLE `razonsocial` (
  `idrazonsocial` int(11) NOT NULL,
  `razonsocial` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `ci` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `celular` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `correo` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `nacionalidad` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `fechanacimiento` date NOT NULL,
  `estadocivil` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `profesion` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `ciudad` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `estado` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `imagenRazonSocial` varchar(255) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `razonsocial`
--

INSERT INTO `razonsocial` (`idrazonsocial`, `razonsocial`, `ci`, `direccion`, `celular`, `correo`, `nacionalidad`, `fechanacimiento`, `estadocivil`, `profesion`, `ciudad`, `estado`, `imagenRazonSocial`) VALUES
(1, 'Jonas Elias Sotomayor Vera', '4859536-5', 'Avd. Hector Roque Duarte Nro. 1362', '0971430714', 'jonaselias77@gmail.com', 'Paraguaya', '1996-03-07', 'SOLTERO', 'Informatico', 'Coronel Oviedo', 'ACTIVO', 'usernull.png'),
(2, 'Natalia Raquel Rivas de Sotomayor', '6019251', 'Avd. Hector Roque Duarte nro 1362', '0972339979', 'natyraquelrivasgarcete@gmail.com', 'Paraguaya', '1996-11-23', 'SOLTERO', 'Contadora', 'Coronel Oviedo', 'ACTIVO', 'usernull.png'),
(3, 'Rodolfo Zenon Dure', '2845214', 'avad. dasfasdfadsfadsfadf', '0972545421', 'rodoldura@gadsas.com', 'Paraguaya', '1992-09-28', 'SOLTERO', 'Analista de Sistema', 'Coronel Oviedo', 'ACTIVO', '1584540228.jpg'),
(4, 'Zachery', '47240615', '995-1249 Mi Ctra.', '(01) 8227 4122', 'dictum.placerat.augue@fames.net', 'Algeria', '2020-03-20', 'Casado', 'Adobe', 'Torgnon', 'ACTIVO', 'usernull.png'),
(5, 'Reed', '14568940', '489-6251 Blandit Ctra.', '(08) 7068 7141', 'Proin.sed@liberoProinmi.org', 'Colombia', '2020-12-04', 'Casado', 'Lycos', 'Tulita', 'ACTIVO', 'usernull.png'),
(6, 'Dolan', '13635567', 'Apdo.:277-123 Tincidunt, C.', '(01) 6869 3971', 'Donec.tempus.lorem@dui.com', 'Romania', '2020-04-23', 'Casado', 'Apple Systems', 'Eisden', 'ACTIVO', 'usernull.png'),
(7, 'Patrick', '10479514', '4978 Iaculis C.', '(02) 9837 8617', 'ante.dictum@tincidunt.com', 'Vanuatu', '2021-03-18', 'Soltero', 'Lycos', 'Ollolai', 'ACTIVO', 'usernull.png'),
(8, 'Drake', '38013137', 'Apartado núm.: 194, 1995 Quis Av.', '(01) 9275 8905', 'facilisis@hendreritid.net', 'Slovenia', '2020-10-23', 'Soltero', 'Yahoo', 'Meerdonk', 'ACTIVO', 'usernull.png'),
(9, 'Chaney', '28208967', 'Apdo.:527-5317 Quam. ', '(08) 0860 0745', 'quam.Curabitur@adipiscing.edu', 'Cameroon', '2021-01-12', 'Soltero', 'Yahoo', 'Gbongan', 'ACTIVO', 'usernull.png'),
(10, 'Davis', '44815557', '519-1765 Sit Avda.', '(07) 7980 1985', 'feugiat@Aliquamvulputateullamcorper.edu', 'Aruba', '2020-12-05', 'Soltero', 'Google', 'Charters Towers', 'ACTIVO', 'usernull.png'),
(11, 'Marsden', '35155172', '3343 Dolor C.', '(06) 2091 9790', 'est.ac.mattis@telluseu.com', 'Senegal', '2021-02-11', 'Soltero', 'Lavasoft', 'Challand-Saint-Victor', 'ACTIVO', 'usernull.png'),
(12, 'Todd', '45073550', '604-9640 Morbi Ctra.', '(09) 5894 6869', 'leo@volutpatnunc.ca', 'Azerbaijan', '2021-02-11', 'Casado', 'Google', 'Tarrasa', 'ACTIVO', 'usernull.png'),
(13, 'Beau', '19582143', '6447 Non Ctra.', '(09) 4877 4418', 'Curabitur@tortorNunccommodo.co.uk', 'United States Minor Outlying Islands', '2019-05-14', 'Casado', 'Yahoo', 'Dessel', 'ACTIVO', 'usernull.png'),
(14, 'Jeremy', '41892391', 'Apdo.:707-7711 Rutrum C.', '(09) 7232 3563', 'pede.nonummy@Cras.edu', 'Thailand', '2019-08-06', 'Casado', 'Lycos', 'Caxias do Sul', 'ACTIVO', 'usernull.png'),
(15, 'Buckminster', '38027649', 'Apdo.:769-9906 Malesuada Calle', '(04) 4865 2590', 'vitae.diam@esttemporbibendum.net', 'Costa Rica', '2019-11-12', 'Soltero', 'Cakewalk', 'Eckville', 'ACTIVO', 'usernull.png'),
(16, 'Justin', '28408579', 'Apdo.:208-3766 Ornare Avenida', '(05) 4229 3072', 'Nulla.interdum@eudoloregestas.com', 'Tajikistan', '2020-01-22', 'Casado', 'Finale', 'San Giorgio Albanese', 'ACTIVO', 'usernull.png'),
(17, 'Christopher', '33912428', 'Apartado núm.: 877, 685 Accumsan Avda.', '(07) 4864 3795', 'ac@arcuVestibulum.edu', 'Cyprus', '2020-06-08', 'Soltero', 'Cakewalk', 'Monacilioni', 'ACTIVO', 'usernull.png'),
(18, 'Jeremy', '9225403', 'Apartado núm.: 529, 9240 Lectus C/', '(01) 0574 8675', 'aliquet@VivamusnisiMauris.ca', 'Saint Pierre and Miquelon', '2021-03-13', 'Soltero', 'Finale', 'Tulita', 'ACTIVO', 'usernull.png'),
(19, 'Reed', '36430129', 'Apdo.:510-9135 Magna. Carretera', '(06) 0210 2903', 'sapien@feugiat.edu', 'Curaçao', '2020-08-22', 'Casado', 'Yahoo', 'Sellano', 'ACTIVO', 'usernull.png'),
(20, 'Valentine', '48792137', 'Apdo.:663-9836 Tincidunt, Calle', '(04) 9399 0549', 'mattis.ornare.lectus@luctusCurabitur.org', 'Afghanistan', '2019-09-13', 'Casado', 'Chami', 'Lerwick', 'ACTIVO', 'usernull.png'),
(21, 'Bernard', '40566078', '536-4753 Morbi Av.', '(05) 1804 3655', 'magna@erat.ca', 'Haiti', '2019-11-21', 'Casado', 'Yahoo', 'Milano', 'ACTIVO', 'usernull.png'),
(22, 'Hayden', '10970807', 'Apartado núm.: 286, 8736 Vulputate C.', '(04) 0545 1376', 'cubilia.Curae@iaculisquispede.com', 'Liberia', '2020-01-21', 'Soltero', 'Finale', 'Blankenberge', 'ACTIVO', 'usernull.png'),
(23, 'Elton', '38181309', '2259 Amet C.', '(04) 5038 9516', 'ornare.elit.elit@feugiatLoremipsum.ca', 'Antigua and Barbuda', '2019-04-27', 'Casado', 'Cakewalk', 'Montignies-Saint-Christophe', 'ACTIVO', 'usernull.png'),
(24, 'Ethan', '42729317', 'Apartado núm.: 860, 5665 A, Avenida', '(04) 9351 9952', 'Curabitur@necante.edu', 'Austria', '2020-05-17', 'Soltero', 'Altavista', 'Dole', 'ACTIVO', 'usernull.png'),
(25, 'Leonard', '37928720', 'Apartado núm.: 854, 445 Arcu Avda.', '(04) 6080 2635', 'auctor@vitaedolor.co.uk', 'Croatia', '2020-02-16', 'Casado', 'Finale', 'Iowa City', 'ACTIVO', 'usernull.png'),
(26, 'Tarik', '8431882', '3291 Lorem C.', '(09) 6988 4781', 'fermentum.risus@nonnisi.co.uk', 'Cocos (Keeling) Islands', '2021-03-27', 'Casado', 'Apple Systems', 'Lower Hutt', 'ACTIVO', 'usernull.png'),
(27, 'Lester', '41645360', 'Apartado núm.: 185, 9792 Bibendum Ctra.', '(08) 3530 4389', 'malesuada@Pellentesquehabitantmorbi.org', 'Angola', '2020-11-26', 'Casado', 'Lycos', 'Siracusa', 'ACTIVO', 'usernull.png'),
(28, 'Talon', '37779627', '127-6445 Elementum, C/', '(07) 6014 3371', 'semper.et@maurissagittisplacerat.ca', 'Cook Islands', '2020-02-21', 'Soltero', 'Altavista', 'Lacombe County', 'ACTIVO', 'usernull.png'),
(29, 'Valentine', '16481512', '3000 Odio, Avenida', '(04) 6051 8662', 'mollis.dui@orciUtsemper.co.uk', 'United Arab Emirates', '2019-12-10', 'Soltero', 'Lavasoft', 'Kamoke', 'ACTIVO', 'usernull.png'),
(30, 'Chase', '7196343', 'Apdo.:753-4792 Ipsum ', '(02) 6196 0064', 'arcu@Sednecmetus.com', 'Bouvet Island', '2019-10-20', 'Soltero', 'Cakewalk', 'Kalken', 'ACTIVO', 'usernull.png'),
(31, 'Leroy', '21248445', 'Apdo.:422-8567 Tristique Ctra.', '(05) 4103 6390', 'at.fringilla.purus@Crasdolordolor.ca', 'Philippines', '2020-10-25', 'Casado', 'Adobe', 'Rockford', 'ACTIVO', 'usernull.png'),
(32, 'Vance', '41829543', '846-8400 Massa. Carretera', '(08) 2802 7518', 'augue.Sed@vulputate.edu', 'Thailand', '2019-09-22', 'Casado', 'Apple Systems', 'Lockerbie', 'ACTIVO', 'usernull.png'),
(33, 'Wang', '29588103', 'Apdo.:274-5241 In Av.', '(07) 2245 0211', 'torquent.per@felis.ca', 'Nicaragua', '2020-04-04', 'Casado', 'Finale', 'Gulfport', 'ACTIVO', 'usernull.png'),
(34, 'Finn', '13094047', '605-1010 Vivamus Av.', '(03) 5788 0240', 'primis.in.faucibus@semNulla.net', 'Japan', '2019-05-19', 'Casado', 'Borland', 'Brighton', 'ACTIVO', 'usernull.png'),
(35, 'Cedric', '12059615', '9579 Et Ctra.', '(06) 7568 1976', 'turpis.egestas.Aliquam@pedeCrasvulputate.edu', 'Australia', '2020-11-28', 'Soltero', 'Google', 'Essex', 'ACTIVO', 'usernull.png'),
(36, 'Geoffrey', '15600843', 'Apdo.:249-4734 Consequat, ', '(02) 8741 2431', 'arcu.Morbi@est.com', 'Norfolk Island', '2021-03-20', 'Soltero', 'Yahoo', 'Gonnosnò', 'ACTIVO', 'usernull.png'),
(37, 'Macaulay', '47983414', 'Apartado núm.: 280, 1102 Vel Avenida', '(07) 5453 7529', 'ipsum@Aliquamgravidamauris.net', 'Zambia', '2019-05-12', 'Soltero', 'Lavasoft', 'Völklingen', 'ACTIVO', 'usernull.png'),
(38, 'Jamal', '50243973', '335-9602 Placerat Avda.', '(08) 0054 9247', 'Cum.sociis.natoque@Aliquam.ca', 'Turkmenistan', '2021-01-25', 'Soltero', 'Cakewalk', 'Shchyolkovo', 'ACTIVO', 'usernull.png'),
(39, 'Keith', '36282410', '294-9257 Sagittis. Avda.', '(06) 8194 2677', 'consectetuer.adipiscing@vitae.ca', 'Bolivia', '2019-11-19', 'Soltero', 'Adobe', 'Heerenveen', 'ACTIVO', 'usernull.png'),
(40, 'Aristotle', '28859699', 'Apartado núm.: 273, 2285 Diam Carretera', '(08) 1254 5351', 'tincidunt.nunc@amet.co.uk', 'Maldives', '2020-05-24', 'Soltero', 'Chami', 'Runcorn', 'ACTIVO', 'usernull.png'),
(41, 'Ferris', '21721777', '231-7740 Morbi C.', '(03) 1224 5269', 'et@etnetuset.com', 'Guyana', '2021-02-04', 'Soltero', 'Finale', 'Davoli', 'ACTIVO', 'usernull.png'),
(42, 'Herman', '20215259', 'Apdo.:390-3696 Fermentum Avda.', '(05) 1461 5865', 'malesuada@vel.com', 'Trinidad and Tobago', '2019-06-15', 'Casado', 'Apple Systems', 'Levallois-Perret', 'ACTIVO', 'usernull.png'),
(43, 'Emery', '31282570', '5282 Scelerisque Carretera', '(03) 3753 4102', 'neque.venenatis@malesuada.edu', 'Croatia', '2019-08-01', 'Soltero', 'Altavista', 'Meerhout', 'ACTIVO', 'usernull.png'),
(44, 'Valentine', '15812262', '4062 Mollis. Av.', '(06) 3679 8503', 'euismod.enim.Etiam@Nam.ca', 'French Southern Territories', '2019-09-22', 'Casado', 'Sibelius', 'Flin Flon', 'ACTIVO', 'usernull.png'),
(45, 'Tad', '28726787', '175-8130 Vivamus C.', '(09) 3975 3046', 'non@Nullam.com', 'Macao', '2019-11-16', 'Casado', 'Google', 'Oyace', 'ACTIVO', 'usernull.png'),
(46, 'Knox', '38728947', 'Apartado núm.: 509, 7879 Velit Calle', '(09) 3492 9203', 'Proin@etultrices.com', 'Portugal', '2019-12-08', 'Casado', 'Yahoo', 'Stalhille', 'ACTIVO', 'usernull.png'),
(47, 'Geoffrey', '16260659', 'Apartado núm.: 150, 5828 Etiam Ctra.', '(07) 8973 3724', 'Lorem@euismodmauriseu.org', 'Micronesia', '2020-08-23', 'Soltero', 'Google', 'Molina', 'ACTIVO', 'usernull.png'),
(48, 'Harding', '27522755', '9341 Amet Avda.', '(04) 2610 1944', 'Quisque.libero.lacus@maurisMorbinon.edu', 'Armenia', '2019-07-13', 'Soltero', 'Adobe', 'Vliermaalroot', 'ACTIVO', 'usernull.png'),
(49, 'Bruce', '42866722', 'Apdo.:241-123 Nullam Ctra.', '(02) 4039 5751', 'sapien.Nunc.pulvinar@velvulputate.net', 'Cambodia', '2019-11-15', 'Soltero', 'Lavasoft', 'Trollhättan', 'ACTIVO', 'usernull.png'),
(50, 'Xanthus', '35783180', '9847 Eu Avda.', '(03) 3797 6924', 'Quisque@vulputatemaurissagittis.net', 'Romania', '2021-02-02', 'Soltero', 'Apple Systems', 'Mansfield-et-Pontefract', 'ACTIVO', 'usernull.png'),
(51, 'Jared', '20869221', 'Apdo.:662-823 Fermentum Ctra.', '(08) 2811 3147', 'est.mollis.non@tellus.net', 'Malawi', '2020-07-21', 'Casado', 'Microsoft', 'Aurillac', 'ACTIVO', 'usernull.png'),
(52, 'Travis', '49616482', 'Apdo.:402-9570 Diam Avda.', '(09) 5680 9906', 'ut.aliquam.iaculis@Vestibulumaccumsan.ca', 'Uzbekistan', '2020-09-17', 'Casado', 'Microsoft', 'Valcourt', 'ACTIVO', 'usernull.png'),
(53, 'Aristotle', '34857800', '4694 Sed ', '(04) 0724 5065', 'est.mauris@sed.net', 'Falkland Islands', '2019-08-19', 'Casado', 'Lavasoft', 'Aserrí', 'ACTIVO', 'usernull.png'),
(54, 'Kibo', '24294025', '6277 Dignissim C.', '(05) 4004 8449', 'nec.diam@laciniamattisInteger.edu', 'Lithuania', '2019-07-13', 'Soltero', 'Apple Systems', 'Flint', 'ACTIVO', 'usernull.png'),
(55, 'Cairo', '26109761', 'Apartado núm.: 707, 2933 Pede. Carretera', '(01) 1705 6952', 'libero@nonjusto.com', 'Mongolia', '2021-01-08', 'Casado', 'Sibelius', 'Sellia Marina', 'ACTIVO', 'usernull.png'),
(56, 'Drake', '21686340', '2449 A, C.', '(07) 3120 1525', 'Vestibulum.ante.ipsum@mattis.edu', 'Morocco', '2020-03-16', 'Soltero', 'Chami', 'Jefferson City', 'ACTIVO', 'usernull.png'),
(57, 'Jerry', '43111845', '6519 Vehicula C/', '(03) 0372 2586', 'erat.neque@non.org', 'Moldova', '2020-03-04', 'Soltero', 'Sibelius', 'Attock', 'ACTIVO', 'usernull.png'),
(58, 'Oleg', '24699059', '964-9330 Tincidunt, C.', '(04) 8080 9844', 'orci.quis@Duis.com', 'Latvia', '2021-02-16', 'Casado', 'Altavista', 'Little Rock', 'ACTIVO', 'usernull.png'),
(59, 'Tobias', '5658960', '242-5262 Eu C/', '(05) 5807 7039', 'ultrices.posuere@mauriseu.org', 'Seychelles', '2019-07-26', 'Soltero', 'Apple Systems', 'San Juan de la Costa', 'ACTIVO', 'usernull.png'),
(60, 'Wesley', '36398980', '3351 Nascetur Ctra.', '(02) 8081 4276', 'amet.ultricies@egetlacus.org', 'Burundi', '2020-12-06', 'Soltero', 'Macromedia', 'Laces/Latsch', 'ACTIVO', 'usernull.png'),
(61, 'Tiger', '26068803', '8422 Lorem Avda.', '(09) 2260 1235', 'ullamcorper.viverra@Quisque.edu', 'Uganda', '2019-07-06', 'Casado', 'Cakewalk', 'Rocky View', 'ACTIVO', 'usernull.png'),
(62, 'Perry', '21613945', 'Apdo.:527-3218 Mauris. Av.', '(09) 6271 3624', 'torquent@rhoncusDonec.ca', 'Ethiopia', '2020-01-10', 'Soltero', 'Altavista', 'Boignee', 'ACTIVO', 'usernull.png'),
(63, 'Gavin', '33558253', 'Apdo.:694-8989 Dis C.', '(07) 2208 5203', 'placerat.velit@maurisipsumporta.com', 'Russian Federation', '2020-03-23', 'Soltero', 'Sibelius', 'Cali', 'ACTIVO', 'usernull.png'),
(64, 'Yoshio', '20266133', 'Apartado núm.: 453, 9241 Magna C/', '(05) 8449 8255', 'dictum.eleifend.nunc@tincidunt.com', 'Botswana', '2020-10-25', 'Casado', 'Altavista', 'Lauw', 'ACTIVO', 'usernull.png'),
(65, 'Mohammad', '8400847', 'Apdo.:984-5884 Nulla. ', '(03) 8128 8723', 'iaculis.lacus.pede@aliquamerosturpis.net', 'Vanuatu', '2020-08-16', 'Casado', 'Adobe', 'Frutillar', 'ACTIVO', 'usernull.png'),
(66, 'Bevis', '20908643', 'Apartado núm.: 890, 8908 Mauris. Carretera', '(08) 8011 9551', 'rhoncus@mattissemper.edu', 'Uruguay', '2020-09-16', 'Casado', 'Altavista', 'Kavaratti', 'ACTIVO', 'usernull.png'),
(67, 'Boris', '24306160', 'Apartado núm.: 507, 464 Justo C.', '(04) 3117 6943', 'eu.tellus.eu@blanditcongueIn.ca', 'Eritrea', '2019-07-17', 'Casado', 'Sibelius', 'Ghotki', 'ACTIVO', 'usernull.png'),
(68, 'Ross', '41874365', 'Apartado núm.: 787, 6622 Ultricies Avenida', '(09) 9278 1315', 'nunc@apurusDuis.com', 'Slovenia', '2019-12-24', 'Casado', 'Google', 'Newcastle', 'ACTIVO', 'usernull.png'),
(69, 'Robert', '9233646', 'Apdo.:849-1895 Natoque C/', '(05) 7548 5442', 'Sed.pharetra.felis@sodalesatvelit.co.uk', 'British Indian Ocean Territory', '2020-04-17', 'Soltero', 'Google', 'Leighton Buzzard', 'ACTIVO', 'usernull.png'),
(70, 'Dean', '17138053', 'Apartado núm.: 386, 4491 Ante. Calle', '(07) 5995 4413', 'lorem.vitae.odio@malesuada.com', 'Peru', '2019-09-16', 'Casado', 'Yahoo', 'Indianapolis', 'ACTIVO', 'usernull.png'),
(71, 'Keaton', '6632865', 'Apdo.:631-1360 Aenean Ctra.', '(09) 7527 5830', 'sem.Pellentesque@arcuet.net', 'Palestine, State of', '2019-07-22', 'Soltero', 'Lavasoft', 'Linkebeek', 'ACTIVO', 'usernull.png'),
(72, 'Rajah', '22923549', '8398 Enim. Avenida', '(05) 5788 6799', 'Duis.elementum@egestasadui.edu', 'Japan', '2019-06-22', 'Soltero', 'Macromedia', 'Conchalí', 'ACTIVO', 'usernull.png'),
(73, 'Oren', '42096352', 'Apartado núm.: 695, 1793 Eu C.', '(05) 3178 6730', 'odio.Etiam@eratnonummyultricies.org', 'Lesotho', '2020-01-03', 'Casado', 'Lycos', 'Porretta Terme', 'ACTIVO', 'usernull.png'),
(74, 'Philip', '13241419', 'Apartado núm.: 356, 2964 Ultrices Ctra.', '(09) 0287 2391', 'lacus.pede@vitae.net', 'Madagascar', '2019-12-09', 'Casado', 'Microsoft', 'Trois-Rivi?res', 'ACTIVO', 'usernull.png'),
(75, 'Barclay', '18306264', '500-2731 Libero Avenida', '(09) 6640 7599', 'semper.dui@enim.org', 'Mayotte', '2020-05-22', 'Casado', 'Apple Systems', 'Mersin', 'ACTIVO', 'usernull.png'),
(76, 'Buckminster', '35100740', 'Apartado núm.: 349, 8718 Nec, C.', '(08) 6799 9122', 'velit.in.aliquet@enim.edu', 'Tajikistan', '2019-07-19', 'Soltero', 'Cakewalk', 'Nampa', 'ACTIVO', 'usernull.png'),
(77, 'Hiram', '30660125', 'Apartado núm.: 753, 484 Et Calle', '(06) 3032 0222', 'ultrices@velsapien.edu', 'Jersey', '2019-12-22', 'Soltero', 'Lycos', 'Montacuto', 'ACTIVO', 'usernull.png'),
(78, 'Adrian', '6392559', 'Apartado núm.: 969, 114 Scelerisque Calle', '(03) 4500 2974', 'odio.Aliquam@Vestibulumante.ca', 'Taiwan', '2020-03-31', 'Soltero', 'Sibelius', 'Ahmedabad', 'ACTIVO', 'usernull.png'),
(79, 'Neville', '31058422', 'Apartado núm.: 218, 9371 Faucibus ', '(07) 6521 7396', 'eros.Proin@dictumeuplacerat.com', 'Nepal', '2019-07-18', 'Soltero', 'Borland', 'Acuña', 'ACTIVO', 'usernull.png'),
(80, 'Emmanuel', '42491004', '430-2547 Quisque Avenida', '(05) 6142 8479', 'Proin@nonleoVivamus.org', 'Uruguay', '2021-03-23', 'Casado', 'Borland', 'Obaix', 'ACTIVO', 'usernull.png'),
(81, 'Burton', '41501602', 'Apartado núm.: 628, 788 Orci. C.', '(01) 8011 9705', 'rhoncus@sitamet.com', 'Sri Lanka', '2021-02-28', 'Soltero', 'Borland', 'Yekaterinburg', 'ACTIVO', 'usernull.png'),
(82, 'Leonard', '18611245', '113-4419 Eget ', '(02) 5974 5655', 'aliquam.enim.nec@acipsum.net', 'China', '2020-04-17', 'Casado', 'Yahoo', 'Nakusp', 'ACTIVO', 'usernull.png'),
(83, 'Knox', '13604836', '661-7855 Ut Av.', '(07) 9912 5295', 'in.lobortis@Suspendisse.edu', 'Bermuda', '2020-07-17', 'Casado', 'Chami', 'Buner', 'ACTIVO', 'usernull.png'),
(84, 'Sebastian', '36556119', 'Apartado núm.: 757, 2154 Elit. Carretera', '(09) 0612 7183', 'dictum.augue@magnaet.ca', 'Sudan', '2020-12-03', 'Soltero', 'Altavista', 'Bromley', 'ACTIVO', 'usernull.png'),
(85, 'Quentin', '28266801', 'Apartado núm.: 434, 6807 Nunc Ctra.', '(04) 1863 1707', 'laoreet.lectus.quis@sociisnatoquepenatibus.com', 'Grenada', '2020-05-03', 'Casado', 'Cakewalk', 'Barrhead', 'ACTIVO', 'usernull.png'),
(86, 'Richard', '43348990', 'Apdo.:256-1584 Mauris Calle', '(09) 1486 4051', 'faucibus.lectus@magnis.edu', 'American Samoa', '2019-05-07', 'Casado', 'Chami', 'Villar Pellice', 'ACTIVO', 'usernull.png'),
(87, 'Cade', '40486649', 'Apdo.:755-7598 Dolor Ctra.', '(07) 2809 7341', 'Nam.porttitor@tortorIntegeraliquam.net', 'Guernsey', '2020-01-10', 'Casado', 'Finale', 'Barmouth', 'ACTIVO', 'usernull.png'),
(88, 'Victor', '35934231', 'Apdo.:359-2336 Lorem, C.', '(08) 2407 5213', 'nulla.ante.iaculis@Integervulputate.ca', 'Slovakia', '2020-08-21', 'Soltero', 'Lycos', 'Hard', 'ACTIVO', 'usernull.png'),
(89, 'Vincent', '28898234', 'Apartado núm.: 836, 8286 Id, Avda.', '(02) 2475 7624', 'purus.Duis.elementum@dolorvitaedolor.ca', 'Afghanistan', '2021-01-05', 'Soltero', 'Lavasoft', 'Lolol', 'ACTIVO', 'usernull.png'),
(90, 'Stewart', '29123680', '3038 Montes, Avenida', '(07) 5483 1666', 'eu.metus@rhoncusNullam.net', 'Vanuatu', '2019-07-14', 'Soltero', 'Yahoo', 'Tramutola', 'ACTIVO', 'usernull.png'),
(91, 'Talon', '45720877', 'Apdo.:782-7214 Magna. Avenida', '(02) 7839 9831', 'euismod.mauris@ultrices.ca', 'Ireland', '2020-02-27', 'Casado', 'Lycos', 'Waardamme', 'ACTIVO', 'usernull.png'),
(92, 'Rajah', '6316301', 'Apartado núm.: 883, 4822 Neque Calle', '(07) 9196 3992', 'Proin@ametconsectetuer.com', 'Swaziland', '2020-05-16', 'Casado', 'Finale', 'Bruderheim', 'ACTIVO', 'usernull.png'),
(93, 'Addison', '31541775', '650 Vitae C/', '(02) 8267 7770', 'Quisque.fringilla.euismod@euismodestarcu.net', 'United States Minor Outlying Islands', '2019-09-18', 'Soltero', 'Apple Systems', 'Likino-Dulyovo', 'ACTIVO', 'usernull.png'),
(94, 'Luke', '6418438', '5568 Nunc Carretera', '(07) 5583 0499', 'sit.amet@quamvel.net', 'Mayotte', '2021-01-08', 'Soltero', 'Adobe', 'Sachs Harbour', 'ACTIVO', 'usernull.png'),
(95, 'Phelan', '41986065', '143-826 Posuere Ctra.', '(09) 1215 1399', 'ornare.lectus@antelectus.ca', 'Nicaragua', '2020-03-21', 'Soltero', 'Altavista', 'Sibret', 'ACTIVO', 'usernull.png'),
(96, 'Malik', '31040824', 'Apartado núm.: 187, 2243 Magna C.', '(01) 4931 9066', 'tincidunt@adipiscing.edu', 'Sudan', '2020-03-04', 'Casado', 'Google', 'Acquasparta', 'ACTIVO', 'usernull.png'),
(97, 'Abraham', '41912258', 'Apartado núm.: 435, 8542 Dui Carretera', '(09) 1737 6747', 'Morbi@Sed.com', 'Peru', '2021-01-18', 'Soltero', 'Borland', 'Campobasso', 'ACTIVO', 'usernull.png'),
(98, 'Zachary', '36057304', '8015 Eu Avenida', '(02) 0572 4963', 'vitae.sodales@vitae.com', 'Algeria', '2020-10-03', 'Soltero', 'Finale', 'Balvano', 'ACTIVO', 'usernull.png'),
(99, 'Charles', '31968970', 'Apdo.:446-4412 Erat. C/', '(07) 9201 0988', 'Aliquam.auctor@euismodindolor.ca', 'Bolivia', '2020-10-08', 'Casado', 'Borland', 'Bankura', 'ACTIVO', 'usernull.png'),
(100, 'Colin', '5882766', '762-5441 Varius. Ctra.', '(07) 1381 6520', 'Sed.eu.eros@nequeNullam.edu', 'Kyrgyzstan', '2019-12-07', 'Soltero', 'Finale', 'Khuzdar', 'ACTIVO', 'usernull.png'),
(101, 'Jared', '15207615', '200-6474 Velit. Av.', '(08) 6305 8066', 'sodales@amet.ca', 'Viet Nam', '2020-10-19', 'Soltero', 'Sibelius', 'Hamme', 'ACTIVO', 'usernull.png'),
(102, 'Akeem', '41395289', 'Apartado núm.: 190, 8891 Suspendisse ', '(07) 5211 1547', 'lobortis.mauris.Suspendisse@Crasconvallisconvallis.net', 'Côte D\'Ivoire (Ivory Coast)', '2020-04-07', 'Soltero', 'Yahoo', 'Lestizza', 'ACTIVO', 'usernull.png'),
(103, 'Jack', '21927503', 'Apartado núm.: 708, 403 Posuere Av.', '(07) 1660 0699', 'Praesent.interdum@variusNamporttitor.com', 'Sudan', '2019-10-21', 'Soltero', 'Lycos', 'Sangli', 'ACTIVO', 'usernull.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesioncomision`
--

CREATE TABLE `sesioncomision` (
  `idsesioncomision` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `participantes` text COLLATE utf8_spanish_ci NOT NULL,
  `idcomisiondirectiva` int(11) NOT NULL,
  `periodo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fotoacta` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sesioncomision`
--

INSERT INTO `sesioncomision` (`idsesioncomision`, `fecha`, `participantes`, `idcomisiondirectiva`, `periodo`, `fotoacta`, `estado`) VALUES
(1, '2019-12-09', 'Ing. Claudio Javier González Dr. Francisco Ruben Frutos Figueredo Ing. Santiago Raul Vazquez Lic. Carlos Rubén González Benitez Vice Presidente 2: Sr Aristides Fernandez\r\nProSecretaria: Ing. Elena Galeano\r\n-Abg. Martin Giret\r\n-Dr. Carlos Cano\r\n-Sr. Cesar Vera\r\n-Abg. Raúl Portillo\r\n-Ing. Hugo Espínola\r\n-Sr. Alcides Andres Frutos\r\n-Dr. Santiago Franco\r\n-Abg. Juan Onieva\r\n-Abg. Gerardo Martínez\r\n-Jonas Sotomayor', 2, '2019-2020', '1576026427.jpg', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socio`
--

CREATE TABLE `socio` (
  `idsocio` int(11) NOT NULL,
  `nrosocio` int(11) NOT NULL,
  `idrazonsocial` int(11) NOT NULL,
  `tiposocio` int(11) NOT NULL,
  `usuario` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `idsesioncomision` int(11) NOT NULL,
  `tipopago` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `estado` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `imagenCi` varchar(240) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'idcard.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `socio`
--

INSERT INTO `socio` (`idsocio`, `nrosocio`, `idrazonsocial`, `tiposocio`, `usuario`, `password`, `idsesioncomision`, `tipopago`, `estado`, `imagenCi`) VALUES
(1, 1, 1, 2, 'jonas', '12345', 1, 'ANUAL', 'ACTIVO', 'idcard.jpg'),
(2, 2, 2, 1, '6019251', '6019251', 1, 'MENSUAL', 'ACTIVO', '1587483348.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitantesocio`
--

CREATE TABLE `solicitantesocio` (
  `idsolicitantesocio` int(11) NOT NULL,
  `idrazonsocial` int(11) NOT NULL,
  `razonsocial` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ci` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `idtiposocio` int(11) NOT NULL,
  `proponente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipopago` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `solicitantesocio`
--

INSERT INTO `solicitantesocio` (`idsolicitantesocio`, `idrazonsocial`, `razonsocial`, `ci`, `idtiposocio`, `proponente`, `fecha`, `tipopago`, `estado`) VALUES
(1, 2, 'Natalia Raquel Rivas de Sotomayor', '6019251', 1, 1, '2019-12-11', 'MENSUAL', 'CONFIRMADO'),
(2, 8, 'Drake', '38013137', 1, 1, '2020-04-20', 'SEMESTRAL', 'RECHAZADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposocio`
--

CREATE TABLE `tiposocio` (
  `idtiposocio` int(11) NOT NULL,
  `tiposocio` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `beneficios` text COLLATE utf8_spanish_ci NOT NULL,
  `costomensual` int(11) NOT NULL,
  `costosemestral` int(11) NOT NULL,
  `costoanual` int(11) NOT NULL,
  `estado` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tiposocio`
--

INSERT INTO `tiposocio` (`idtiposocio`, `tiposocio`, `beneficios`, `costomensual`, `costosemestral`, `costoanual`, `estado`) VALUES
(1, 'ACTIVO', 'Descuentos y promociones exclusivas para socios del Club.\r\nUsufructo de las instalaciones sociales.\r\nEstacionamiento gratis en club', 80000, 480000, 800000, 'ACTIVO'),
(2, 'PREMIUM', 'Voz y voto en las Asambleas.\r\nUsufructo de las instalaciones sociales.\r\nDescuentos y promociones exclusivas para socios del Club.\r\n\r\nhola', 140000, 840000, 1500000, 'ACTIVO'),
(3, 'FAMILIAR', 'Descuentos y promociones exclusivas para socios del Club. \r\nEstacionamiento gratis en club\r\nUsufructo de las instalaciones sociales.', 100000, 600000, 1000000, 'ACTIVO'),
(4, 'JUVENIL', 'Descuentos y promociones exclusivas para socios del Club. \r\nEstacionamiento gratis en club', 60000, 350000, 600000, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `idrazonsocial` int(11) NOT NULL,
  `razonsocial` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `ci` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `usuario` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `cargo` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estado` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `imagenUsuario` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT 'usernull.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `idrazonsocial`, `razonsocial`, `ci`, `usuario`, `password`, `cargo`, `estado`, `imagenUsuario`) VALUES
(1, 0, 'Jonas Elias Sotomayor Vera', '4859536-5', 'admin', '12345', 'ADMINISTRADOR', 'ACTIVO', 'usernull.png'),
(2, 0, 'Jonas Elias Sotomayor Vera', '4859536-5', 'SECRE', '12345', 'SECRETARIA', 'ACTIVO', 'usernull.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_permisos`
--

CREATE TABLE `usuarios_permisos` (
  `codigoPermiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios_permisos`
--

INSERT INTO `usuarios_permisos` (`codigoPermiso`, `idusuario`) VALUES
(1, 0),
(2, 0),
(1, 0),
(2, 0),
(1, 0),
(2, 0),
(1, 0),
(2, 0),
(1, 0),
(2, 0),
(1, 0),
(2, 0),
(1, 0),
(3, 0),
(1, 0),
(3, 0),
(1, 0),
(2, 0),
(1, 0),
(2, 0),
(1, 1),
(2, 1),
(1, 2),
(3, 2),
(1, 0),
(2, 0),
(1, 0),
(2, 0),
(1, 0),
(2, 0),
(1, 0),
(2, 0),
(1, 0),
(2, 0),
(1, 0),
(2, 0),
(1, 0),
(3, 0),
(1, 0),
(3, 0),
(1, 0),
(2, 0),
(1, 0),
(2, 0),
(1, 1),
(2, 1),
(1, 2),
(3, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `comisiondirectiva`
--
ALTER TABLE `comisiondirectiva`
  ADD PRIMARY KEY (`idcomisiondirectiva`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`idcontrato`);

--
-- Indices de la tabla `deporte`
--
ALTER TABLE `deporte`
  ADD PRIMARY KEY (`iddeporte`);

--
-- Indices de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  ADD PRIMARY KEY (`idinmueble`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`codigoPermiso`);

--
-- Indices de la tabla `razonsocial`
--
ALTER TABLE `razonsocial`
  ADD PRIMARY KEY (`idrazonsocial`);

--
-- Indices de la tabla `sesioncomision`
--
ALTER TABLE `sesioncomision`
  ADD PRIMARY KEY (`idsesioncomision`);

--
-- Indices de la tabla `socio`
--
ALTER TABLE `socio`
  ADD PRIMARY KEY (`idsocio`);

--
-- Indices de la tabla `solicitantesocio`
--
ALTER TABLE `solicitantesocio`
  ADD PRIMARY KEY (`idsolicitantesocio`);

--
-- Indices de la tabla `tiposocio`
--
ALTER TABLE `tiposocio`
  ADD PRIMARY KEY (`idtiposocio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comisiondirectiva`
--
ALTER TABLE `comisiondirectiva`
  MODIFY `idcomisiondirectiva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `idcontrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `deporte`
--
ALTER TABLE `deporte`
  MODIFY `iddeporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  MODIFY `idinmueble` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `codigoPermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `razonsocial`
--
ALTER TABLE `razonsocial`
  MODIFY `idrazonsocial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT de la tabla `sesioncomision`
--
ALTER TABLE `sesioncomision`
  MODIFY `idsesioncomision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `socio`
--
ALTER TABLE `socio`
  MODIFY `idsocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitantesocio`
--
ALTER TABLE `solicitantesocio`
  MODIFY `idsolicitantesocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
