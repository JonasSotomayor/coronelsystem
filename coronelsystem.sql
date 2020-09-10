-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-03-2020 a las 15:28:29
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

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
(2, 'Natalia Raquel Rivas de Sotomayor', '6019251', 'Avd. Hector Roque Duarte nro 1362', '0972339979', 'natyraquelrivasgarcete@gmail.com', 'Paraguaya', '1996-11-23', 'SOLTERO', 'Contadora', 'Coronel Oviedo', 'ACTIVO', 'usernull.png');

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
  `estado` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `socio`
--

INSERT INTO `socio` (`idsocio`, `nrosocio`, `idrazonsocial`, `tiposocio`, `usuario`, `password`, `idsesioncomision`, `tipopago`, `estado`) VALUES
(1, 1, 1, 2, 'jonas', '12345', 1, 'ANUAL', 'ACTIVO');

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
(1, 2, 'Natalia Raquel Rivas de Sotomayor', '6019251', 1, 1, '2019-12-11', 'MENSUAL', 'ACTIVO');

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
  `imagenUsuario` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
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
  MODIFY `idrazonsocial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sesioncomision`
--
ALTER TABLE `sesioncomision`
  MODIFY `idsesioncomision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `socio`
--
ALTER TABLE `socio`
  MODIFY `idsocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `solicitantesocio`
--
ALTER TABLE `solicitantesocio`
  MODIFY `idsolicitantesocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tiposocio`
--
ALTER TABLE `tiposocio`
  MODIFY `idtiposocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
