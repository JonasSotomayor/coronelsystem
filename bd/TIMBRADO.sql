-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         8.0.22 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para trentina1875
CREATE DATABASE IF NOT EXISTS `trentina1875` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `trentina1875`;

-- Volcando estructura para tabla trentina1875.facturas
CREATE TABLE IF NOT EXISTS `facturas` (
  `codigoFacturas` int NOT NULL AUTO_INCREMENT,
  `nroFacturas` int DEFAULT NULL,
  `codigoTimbrado` int NOT NULL,
  `codigoVentas` int NOT NULL,
  `fechaFacturas` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fechacreación` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estadoFacturas` tinyint DEFAULT NULL,
  PRIMARY KEY (`codigoFacturas`),
  KEY `fk_Facturas_Timbrado1_idx` (`codigoTimbrado`),
  KEY `fk_Facturas_Ventas1_idx` (`codigoVentas`),
  CONSTRAINT `fk_Facturas_Timbrado1` FOREIGN KEY (`codigoTimbrado`) REFERENCES `timbrado` (`codigoTimbrado`),
  CONSTRAINT `fk_Facturas_Ventas1` FOREIGN KEY (`codigoVentas`) REFERENCES `ventas` (`codigoVentas`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
