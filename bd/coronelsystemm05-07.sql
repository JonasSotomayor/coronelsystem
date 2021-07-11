-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: coronelsystem
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alquiler`
--

DROP TABLE IF EXISTS `alquiler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alquiler` (
  `idalquiler` int NOT NULL AUTO_INCREMENT,
  `idsolicitudalquiler` int DEFAULT NULL,
  `idrazonsocial` int DEFAULT NULL,
  `razonsocial` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idinmueble` int DEFAULT NULL,
  `denominacion` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idsesioncomision` int DEFAULT NULL,
  `tipopago` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechainicio` datetime DEFAULT NULL,
  `costoAlquiler` int DEFAULT NULL,
  `plazoContrato` int DEFAULT NULL,
  `tiempoContrato` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagenCi` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_spanish_ci DEFAULT 'ACTIVO',
  PRIMARY KEY (`idalquiler`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alquiler`
--

LOCK TABLES `alquiler` WRITE;
/*!40000 ALTER TABLE `alquiler` DISABLE KEYS */;
INSERT INTO `alquiler` VALUES (1,1,1,'Jonas Elias Sotomayor Vera',1,'SALON COMERCIAL 1',3,'ANUAL','2010-03-01 00:00:00',9000000,10,'ANHO','1617485761.png','CANCELADO'),(2,2,2,'Natalia Raquel Rivas de Sotomayor',2,'SALON COMERCIAL 2',2,'ANUAL','2021-04-01 12:23:00',10000000,5,'MES','idcard.png','CANCELADO'),(3,3,1,'Jonas Elias Sotomayor Vera',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',4,'ANUAL','2021-12-07 10:59:00',5000000,1,'DIA','','ACTIVO'),(4,4,3,'Rodolfo Zenon Dure',2,'SALON COMERCIAL 2',4,'MENSUAL','2021-08-26 12:48:00',1000000,1,'ANHO','','ACTIVO'),(5,5,19,'Reed',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',3,'ANUAL','2021-12-02 11:48:00',5000000,1,'DIA','','ACTIVO'),(6,7,24,'Ethan',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',4,'ANUAL','2021-12-04 11:48:00',5000000,1,'DIA','','ACTIVO'),(7,6,23,'Elton',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',4,'ANUAL','2021-12-03 11:48:00',5000000,1,'DIA','','ACTIVO'),(8,10,25,'Leonard',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',4,'ANUAL','2021-12-20 15:07:00',5000000,1,'ANHO','','ACTIVO'),(9,8,18,'Jeremy',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',4,'ANUAL','2021-12-31 15:07:00',5000000,1,'ANHO','','ACTIVO'),(10,9,23,'Elton',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',4,'ANUAL','2021-12-25 15:07:00',5000000,1,'ANHO','1620242163.jpg','ACTIVO'),(11,11,13,'Beau',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',4,'ANUAL','2021-12-21 15:26:00',5000000,1,'ANHO','1620242803.jpg','ACTIVO'),(12,12,20,'Valentine',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',4,'ANUAL','2021-12-14 15:27:00',5000000,1,'ANHO','1620242863.jpg','ACTIVO'),(13,18,4,'Zachery',3,'SALON COMERCIAL 3',3,'MENSUAL','2021-07-07 10:41:00',900000,1,'MES','idcard.png','ACTIVO'),(14,17,69,'Robert',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',4,'MENSUAL','2021-06-24 11:48:00',450000,12,'MES','idcard.png','ACTIVO'),(15,13,66,'Bevis',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',4,'ANUAL','2021-05-21 12:21:00',5000000,1,'DIA','idcard.png','ACTIVO'),(16,14,109,'marcelo',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',4,'MENSUAL','2021-05-20 12:22:00',450000,1,'DIA','idcard.png','ACTIVO'),(17,15,47,'Geoffrey',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',4,'MENSUAL','2021-05-28 12:26:00',450000,1,'DIA','idcard.png','CANCELADO'),(18,16,45,'Tad',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO',4,'MENSUAL','2021-06-29 11:04:00',450000,4,'ANHO','idcard.png','ACTIVO');
/*!40000 ALTER TABLE `alquiler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aperturas_cierres`
--

DROP TABLE IF EXISTS `aperturas_cierres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aperturas_cierres` (
  `codigo_Apertura_Cierre` int NOT NULL AUTO_INCREMENT,
  `idusuario` int DEFAULT NULL,
  `id_caja` int DEFAULT NULL,
  `fechaApertura` datetime DEFAULT CURRENT_TIMESTAMP,
  `montoApertura` int DEFAULT NULL,
  `fechaCierre` datetime DEFAULT CURRENT_TIMESTAMP,
  `montoCierre` int DEFAULT NULL,
  `estadoApertura` varchar(45) DEFAULT 'ACTIVO',
  PRIMARY KEY (`codigo_Apertura_Cierre`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aperturas_cierres`
--

LOCK TABLES `aperturas_cierres` WRITE;
/*!40000 ALTER TABLE `aperturas_cierres` DISABLE KEYS */;
INSERT INTO `aperturas_cierres` VALUES (1,1,1,'2021-02-20 20:54:02',5000000,'2021-02-20 20:54:02',5000000,'CERRADO'),(2,1,1,'2021-02-20 20:55:25',500000,'2021-02-20 20:55:25',1400000,'CERRADO'),(3,1,1,'2021-02-23 10:43:13',500000,'2021-02-23 10:43:13',550000,'CERRADO'),(4,1,1,'2021-02-23 16:08:34',2334534,'2021-02-23 16:08:34',2334534,'CERRADO'),(5,1,1,'2021-02-23 16:09:33',3456456,'2021-02-23 16:09:33',3456456,'CERRADO'),(6,1,1,'2021-02-23 17:58:31',500000,'2021-02-23 17:58:31',550000,'CERRADO'),(7,1,1,'2021-02-23 18:14:12',500000,'2021-02-23 18:14:12',500000,'CERRADO'),(8,1,1,'2021-02-23 18:15:18',50000,'2021-02-23 18:15:18',100000,'CERRADO'),(9,1,1,'2021-03-08 11:32:14',500000,'2021-03-08 11:32:14',NULL,'ACTIVO'),(10,2,3,'2021-05-18 14:37:48',50000,'2021-05-18 14:37:48',NULL,'ACTIVO'),(11,3,3,'2021-05-18 15:00:51',50000,'2021-05-18 15:00:51',NULL,'ACTIVO'),(12,3333333,1,'2021-05-18 15:35:07',50000,'2021-05-18 15:35:07',NULL,'ACTIVO'),(13,333333333,3,'2021-05-18 15:46:32',50000,'2021-05-18 15:46:32',NULL,'ACTIVO');
/*!40000 ALTER TABLE `aperturas_cierres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arqueo_caja`
--

DROP TABLE IF EXISTS `arqueo_caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `arqueo_caja` (
  `codigo_Arqueo_Caja` int NOT NULL AUTO_INCREMENT,
  `codigo_Apertura_Cierre` int DEFAULT NULL,
  `totalcheque_Arqueo_Caja` int DEFAULT NULL,
  `totaltarjeta_Arqueo_Caja` int DEFAULT NULL,
  `totalefectivo_Arqueo_Caja` int DEFAULT NULL,
  `faltante_Arqueo_Caja` int DEFAULT NULL,
  `sobrante_Arqueo_Caja` int DEFAULT NULL,
  PRIMARY KEY (`codigo_Arqueo_Caja`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arqueo_caja`
--

LOCK TABLES `arqueo_caja` WRITE;
/*!40000 ALTER TABLE `arqueo_caja` DISABLE KEYS */;
INSERT INTO `arqueo_caja` VALUES (1,3,0,0,50000,0,0),(2,3,0,0,50000,0,0),(3,3,0,0,50000,0,0),(4,3,0,0,50000,0,0),(5,3,0,0,50000,0,0),(6,3,0,0,50000,0,0),(7,3,0,0,50000,0,0),(8,4,0,0,0,0,0),(9,5,0,0,0,0,0),(10,6,30000,0,20000,0,0),(11,7,0,0,0,0,0),(12,8,0,0,50000,0,0);
/*!40000 ALTER TABLE `arqueo_caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caja`
--

DROP TABLE IF EXISTS `caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caja` (
  `codigoCajas` int NOT NULL AUTO_INCREMENT,
  `nombreCajas` varchar(45) DEFAULT NULL,
  `tipocaja` varchar(45) DEFAULT NULL,
  `estadoCajas` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codigoCajas`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caja`
--

LOCK TABLES `caja` WRITE;
/*!40000 ALTER TABLE `caja` DISABLE KEYS */;
INSERT INTO `caja` VALUES (1,'VENTANILLA','1','1'),(2,'DOMICILIO','1','1'),(3,'EN CANCHA','1','1'),(4,'NATACION','1','1');
/*!40000 ALTER TABLE `caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `idcategoria` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `deporte` int NOT NULL,
  `estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'2012-2013',1,'ACTIVO'),(2,'2011-2012',1,'ACTIVO'),(3,'2014-2015',1,'ACTIVO'),(4,'2010-2011',1,'ACTIVO'),(5,'2009-2010',1,'ACTIVO'),(6,'15',2,'ACTIVO'),(7,'14',2,'ACTIVO'),(8,'13',2,'ACTIVO'),(9,'05-06',3,'ACTIVO'),(10,'07-08',3,'ACTIVO');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comisiondeporte`
--

DROP TABLE IF EXISTS `comisiondeporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comisiondeporte` (
  `idcomisionDeporte` int NOT NULL AUTO_INCREMENT,
  `periodo` varchar(90) COLLATE utf8_spanish_ci DEFAULT NULL,
  `iddeporte` int DEFAULT NULL,
  `deporte` varchar(85) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ESTADO` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idcomisionDeporte`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comisiondeporte`
--

LOCK TABLES `comisiondeporte` WRITE;
/*!40000 ALTER TABLE `comisiondeporte` DISABLE KEYS */;
INSERT INTO `comisiondeporte` VALUES (1,'2021-2022',1,'Escuela de Futbol','ACTIVO'),(2,'2021-2022',2,'BASQUET','ACTIVO'),(3,'2021-2022',3,'Escuela de Futbol 2da Temporada','ACTIVO');
/*!40000 ALTER TABLE `comisiondeporte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comisiondirectiva`
--

DROP TABLE IF EXISTS `comisiondirectiva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comisiondirectiva` (
  `idcomisiondirectiva` int NOT NULL AUTO_INCREMENT,
  `presidente` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `vicepresidente` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `secretario` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `tesorero` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `miembros` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `periodo` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estado` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`idcomisiondirectiva`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comisiondirectiva`
--

LOCK TABLES `comisiondirectiva` WRITE;
/*!40000 ALTER TABLE `comisiondirectiva` DISABLE KEYS */;
INSERT INTO `comisiondirectiva` VALUES (2,'Ing. Claudio Javier González','Dr. Francisco Ruben Frutos Figueredo','Ing. Santiago Raul Vazquez','Lic. Carlos Rubén González Benitez','Vice Presidente 2: Sr Aristides Fernandez\r\nProSecretaria: Ing. Elena Galeano\r\n-Abg. Martin Giret\r\n-Dr. Carlos Cano\r\n-Sr. Cesar Vera\r\n-Abg. Raúl Portillo\r\n-Ing. Hugo Espínola\r\n-Sr. Alcides Andres Frutos\r\n-Dr. Santiago Franco\r\n-Abg. Juan Onieva\r\n-Abg. Gerardo Martínez\r\n-Jonas Sotomayor','2019-2020','INACTIVO'),(3,'Ing. Claudio Javier González Solaeche','Sr Aristides Fernandez','Ing. Santiago Raul Vazquez','Lic. Carlos Rubén González Benitez','Vice Presidente 1: Dr. Francisco Ruben Frutos Figueredo\r\nProSecretaria: Ing. Elena Galeano\r\n\r\nMiembros: \r\n-Abg. Martin Giret\r\n-Dr. Carlos Cano\r\n-Sr. Cesar Vera\r\n-Abg. Raúl Portillo\r\n-Ing. Hugo Espínola\r\n-Sr. Alcides Andres Frutos\r\n-Dr. Santiago Franco\r\n-Abg. Juan Onieva\r\n-Abg. Gerardo Martínez','2021-2022','ACTIVO');
/*!40000 ALTER TABLE `comisiondirectiva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrato`
--

DROP TABLE IF EXISTS `contrato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contrato` (
  `idcontrato` int NOT NULL AUTO_INCREMENT,
  `nroContrato` int NOT NULL,
  `fechaContrato` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idrazonsocial` int NOT NULL,
  `idsocio` int NOT NULL,
  `idtiposocio` int NOT NULL,
  `idasamblea` int NOT NULL,
  `estado` varchar(80) NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`idcontrato`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrato`
--

LOCK TABLES `contrato` WRITE;
/*!40000 ALTER TABLE `contrato` DISABLE KEYS */;
INSERT INTO `contrato` VALUES (1,1,'2000-01-01 00:00:00',1,1,2,1,'ACTIVO'),(2,2,'2021-02-20 23:13:15',2,2,1,2,'ACTIVO'),(3,3,'2021-02-20 23:14:36',4,3,1,2,'ACTIVO'),(4,4,'2021-02-20 23:14:49',8,4,1,2,'ACTIVO'),(5,5,'2021-02-20 23:22:56',5,5,1,2,'ACTIVO'),(6,6,'2021-02-20 23:24:20',7,6,2,2,'ACTIVO'),(7,7,'2021-02-20 23:25:33',9,7,3,2,'ACTIVO'),(8,8,'2021-02-20 23:27:20',10,8,1,2,'MODIFICADO'),(9,9,'2021-02-20 23:32:19',13,9,2,2,'MODIFICADO'),(10,10,'2021-03-28 00:00:00',13,9,2,2,'CANCELADO'),(11,9,'2021-04-06 00:00:00',10,8,1,2,'CANCELADO');
/*!40000 ALTER TABLE `contrato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contratoalquiler`
--

DROP TABLE IF EXISTS `contratoalquiler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contratoalquiler` (
  `idcontratoAlquiler` int NOT NULL AUTO_INCREMENT,
  `nroContrato` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaContrato` datetime DEFAULT CURRENT_TIMESTAMP,
  `idrazonsocial` int DEFAULT NULL,
  `razonsocial` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idalquiler` int DEFAULT NULL,
  `denominacion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contratoScaneo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idasamblea` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idcontratoAlquiler`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contratoalquiler`
--

LOCK TABLES `contratoalquiler` WRITE;
/*!40000 ALTER TABLE `contratoalquiler` DISABLE KEYS */;
INSERT INTO `contratoalquiler` VALUES (5,'5','2021-04-03 15:59:54',2,'Natalia Raquel Rivas de Sotomayor',2,'SALON COMERCIAL 2','1617748990.pdf','2','MODIFICADO'),(6,'6','2021-04-03 17:36:00',1,'Jonas Elias Sotomayor Vera',1,'SALON COMERCIAL 1','1617651790.pdf','3','MODIFICADO'),(7,'7','2021-04-05 16:13:29',1,'Jonas Elias Sotomayor Vera',1,'SALON COMERCIAL 1','1617736296.pdf','3','CANCELADO'),(8,'6','2021-04-06 18:52:53',2,'Natalia Raquel Rivas de Sotomayor',2,'SALON COMERCIAL 2','1617749608.pdf','2','CANCELADO'),(9,'8','2021-04-12 11:04:38',1,'Jonas Elias Sotomayor Vera',3,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625233534.pdf','4','ACTIVO'),(10,'9','2021-05-05 11:50:07',3,'Rodolfo Zenon Dure',4,'SALON COMERCIAL 2','1625233559.pdf','4','ACTIVO'),(11,'10','2021-05-05 11:56:58',19,'Reed',5,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625233571.pdf','3','ACTIVO'),(12,'10','2021-05-05 14:54:20',24,'Ethan',6,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625233599.pdf','4','ACTIVO'),(13,'10','2021-05-05 15:04:29',23,'Elton',7,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625233639.pdf','4','ACTIVO'),(14,'10','2021-05-05 15:08:55',25,'Leonard',8,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625233657.pdf','4','ACTIVO'),(15,'10','2021-05-05 15:10:53',18,'Jeremy',9,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625234265.pdf','4','ACTIVO'),(16,'10','2021-05-05 15:16:02',23,'Elton',10,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625234247.pdf','4','ACTIVO'),(17,'10','2021-05-05 15:26:43',13,'Beau',11,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625234218.pdf','4','ACTIVO'),(18,'10','2021-05-05 15:27:42',20,'Valentine',12,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625234206.pdf','4','ACTIVO'),(19,'10','2021-07-02 09:41:56',4,'Zachery',13,'SALON COMERCIAL 3','1625234187.pdf','3','ACTIVO'),(20,'10','2021-07-02 09:42:10',69,'Robert',14,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625234134.pdf','4','ACTIVO'),(21,'10','2021-07-02 09:42:27',66,'Bevis',15,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625233831.pdf','4','ACTIVO'),(22,'10','2021-07-02 09:42:38',109,'marcelo',16,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625233816.pdf','4','ACTIVO'),(23,'10','2021-07-02 09:44:42',47,'Geoffrey',17,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625233744.pdf','4','MODIFICADO'),(24,'10','2021-07-02 09:45:07',45,'Tad',18,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625233612.pdf','4','ACTIVO'),(25,'11','2021-07-02 09:59:08',47,'Geoffrey',17,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625234371.pdf','4','CANCELADO'),(26,'12','2021-07-02 10:02:03',47,'Geoffrey',17,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','1625234561.pdf','4','CANCELADO');
/*!40000 ALTER TABLE `contratoalquiler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuentas_cobrar`
--

DROP TABLE IF EXISTS `cuentas_cobrar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cuentas_cobrar` (
  `id_cuenta_cobrar` int NOT NULL AUTO_INCREMENT,
  `idrazonsocial` int DEFAULT NULL,
  `tipocuenta` varchar(45) DEFAULT NULL,
  `contrato` varchar(45) DEFAULT NULL,
  `numerocuota` int DEFAULT NULL,
  `totalcuota` int DEFAULT NULL,
  `montoCobrar` int DEFAULT NULL,
  `fechaCobro` date DEFAULT NULL,
  `estado` varchar(4145) DEFAULT NULL,
  PRIMARY KEY (`id_cuenta_cobrar`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuentas_cobrar`
--

LOCK TABLES `cuentas_cobrar` WRITE;
/*!40000 ALTER TABLE `cuentas_cobrar` DISABLE KEYS */;
INSERT INTO `cuentas_cobrar` VALUES (2,2,'socio','2',1,600000,50000,'2021-02-15','COBRADO'),(3,2,'socio','2',2,600000,50000,'2021-03-15','COBRADO'),(4,2,'socio','2',3,600000,50000,'2021-04-15','COBRADO'),(5,2,'socio','2',4,600000,50000,'2021-05-15','COBRADO'),(6,2,'socio','2',5,600000,50000,'2021-06-15','PENDIENTE'),(7,2,'socio','2',6,600000,50000,'2021-07-15','COBRADO'),(8,2,'socio','2',7,600000,50000,'2021-08-15','PENDIENTE'),(9,2,'socio','2',8,600000,50000,'2021-09-15','PENDIENTE'),(10,2,'socio','2',9,600000,50000,'2021-10-15','PENDIENTE'),(11,2,'socio','2',10,600000,50000,'2021-11-15','PENDIENTE'),(12,2,'socio','2',11,600000,50000,'2021-12-15','PENDIENTE'),(13,2,'socio','2',12,600000,50000,'2022-01-15','PENDIENTE'),(14,4,'socio','3',1,600000,50000,'2021-02-15','COBRADO'),(15,4,'socio','3',2,600000,50000,'2021-03-15','COBRADO'),(16,4,'socio','3',3,600000,50000,'2021-04-15','COBRADO'),(17,4,'socio','3',4,600000,50000,'2021-05-15','COBRADO'),(18,4,'socio','3',5,600000,50000,'2021-06-15','PENDIENTE'),(19,4,'socio','3',6,600000,50000,'2021-07-15','PENDIENTE'),(20,4,'socio','3',7,600000,50000,'2021-08-15','PENDIENTE'),(21,4,'socio','3',8,600000,50000,'2021-09-15','PENDIENTE'),(22,4,'socio','3',9,600000,50000,'2021-10-15','PENDIENTE'),(23,4,'socio','3',10,600000,50000,'2021-11-15','PENDIENTE'),(24,4,'socio','3',11,600000,50000,'2021-12-15','PENDIENTE'),(25,4,'socio','3',12,600000,50000,'2022-01-15','PENDIENTE'),(26,8,'socio','4',1,100000,280000,'2021-02-15','COBRADO'),(27,8,'socio','4',2,100000,280000,'2021-08-15','PENDIENTE'),(28,5,'socio','5',1,600000,50000,'2021-02-15','PENDIENTE'),(29,5,'socio','5',2,600000,50000,'2021-03-15','COBRADO'),(30,5,'socio','5',3,600000,50000,'2021-04-15','COBRADO'),(31,5,'socio','5',4,600000,50000,'2021-05-15','COBRADO'),(32,5,'socio','5',5,600000,50000,'2021-06-15','PENDIENTE'),(33,5,'socio','5',6,600000,50000,'2021-07-15','PENDIENTE'),(34,5,'socio','5',7,600000,50000,'2021-08-15','PENDIENTE'),(35,5,'socio','5',8,600000,50000,'2021-09-15','PENDIENTE'),(36,5,'socio','5',9,600000,50000,'2021-10-15','PENDIENTE'),(37,5,'socio','5',10,600000,50000,'2021-11-15','PENDIENTE'),(38,5,'socio','5',11,600000,50000,'2021-12-15','PENDIENTE'),(39,5,'socio','5',12,600000,50000,'2022-01-15','PENDIENTE'),(40,7,'socio','6',0,1500000,1500000,'2021-02-20','PENDIENTE'),(41,9,'socio','7',1,200000,600000,'2021-02-15','COBRADO'),(42,9,'socio','7',2,200000,600000,'2021-08-15','PENDIENTE'),(43,10,'socio','8',1,600000,50000,'2021-02-15','COBRADO'),(44,10,'socio','8',2,600000,50000,'2021-03-15','CANCELADO'),(45,10,'socio','8',3,600000,50000,'2021-04-15','CANCELADO'),(46,10,'socio','8',4,600000,50000,'2021-05-15','CANCELADO'),(47,10,'socio','8',5,600000,50000,'2021-06-15','CANCELADO'),(48,10,'socio','8',6,600000,50000,'2021-07-15','CANCELADO'),(49,10,'socio','8',7,600000,50000,'2021-08-15','CANCELADO'),(50,10,'socio','8',8,600000,50000,'2021-09-15','CANCELADO'),(51,10,'socio','8',9,600000,50000,'2021-10-15','CANCELADO'),(52,10,'socio','8',10,600000,50000,'2021-11-15','CANCELADO'),(53,10,'socio','8',11,600000,50000,'2021-12-15','CANCELADO'),(54,10,'socio','8',12,600000,50000,'2022-01-15','CANCELADO'),(55,13,'socio','9',1,300000,800000,'2021-02-15','CANCELADO'),(56,13,'socio','9',2,300000,800000,'2021-08-15','CANCELADO'),(57,1,'Alquiler','1',0,9000000,9000000,'2021-03-07','CANCELADO'),(58,2,'Alquiler','5',0,10000000,10000000,'2021-04-02','CANCELADO'),(59,1,'Alquiler','8',0,5000000,2000000,'2021-04-11','PENDIENTE'),(60,19,'Alquiler','10',0,5000000,5000000,'2021-05-04','PENDIENTE'),(61,24,'Alquiler','10',0,5000000,5000000,'2021-05-04','PENDIENTE'),(62,23,'Alquiler','10',0,5000000,5000000,'2021-05-04','PENDIENTE'),(63,25,'Alquiler','10',0,5000000,5000000,'2021-05-04','PENDIENTE'),(64,18,'Alquiler','10',0,5000000,5000000,'2021-05-04','PENDIENTE'),(65,23,'Alquiler','10',0,5000000,5000000,'2021-05-04','PENDIENTE'),(66,13,'Alquiler','10',0,5000000,4000000,'2021-05-04','PENDIENTE'),(67,20,'Alquiler','10',0,5000000,5000000,'2021-05-04','PENDIENTE'),(86,5,'DEPORTISTA','1',5,100000,100000,'2021-05-15','COBRADO'),(87,4,'DEPORTISTA','3',5,100000,100000,'2021-05-15','COBRADO'),(88,4,'DEPORTISTA','3',6,100000,100000,'2021-06-15','PENDIENTE'),(89,4,'DEPORTISTA','3',7,100000,100000,'2021-07-15','PENDIENTE'),(90,4,'DEPORTISTA','3',8,100000,100000,'2021-08-15','PENDIENTE'),(91,4,'DEPORTISTA','3',9,100000,100000,'2021-09-15','PENDIENTE'),(92,4,'DEPORTISTA','3',10,100000,100000,'2021-10-15','PENDIENTE'),(93,4,'DEPORTISTA','3',11,100000,100000,'2021-11-15','PENDIENTE'),(94,4,'Alquiler','10',1,10800000,900000,'2021-07-15','PENDIENTE'),(95,4,'Alquiler','10',2,10800000,900000,'2021-08-15','PENDIENTE'),(96,4,'Alquiler','10',3,10800000,900000,'2021-09-15','PENDIENTE'),(97,4,'Alquiler','10',4,10800000,900000,'2021-10-15','PENDIENTE'),(98,4,'Alquiler','10',5,10800000,900000,'2021-11-15','PENDIENTE'),(99,4,'Alquiler','10',6,10800000,900000,'2021-12-15','PENDIENTE'),(100,4,'Alquiler','10',7,10800000,900000,'2022-01-15','PENDIENTE'),(101,4,'Alquiler','10',8,10800000,900000,'2022-02-15','PENDIENTE'),(102,4,'Alquiler','10',9,10800000,900000,'2022-03-15','PENDIENTE'),(103,4,'Alquiler','10',10,10800000,900000,'2022-04-15','PENDIENTE'),(104,4,'Alquiler','10',11,10800000,900000,'2022-05-15','PENDIENTE'),(105,4,'Alquiler','10',12,10800000,900000,'2022-06-15','PENDIENTE'),(106,69,'Alquiler','10',1,5400000,450000,'2021-07-15','PENDIENTE'),(107,69,'Alquiler','10',2,5400000,450000,'2021-08-15','PENDIENTE'),(108,69,'Alquiler','10',3,5400000,450000,'2021-09-15','PENDIENTE'),(109,69,'Alquiler','10',4,5400000,450000,'2021-10-15','PENDIENTE'),(110,69,'Alquiler','10',5,5400000,450000,'2021-11-15','PENDIENTE'),(111,69,'Alquiler','10',6,5400000,450000,'2021-12-15','PENDIENTE'),(112,69,'Alquiler','10',7,5400000,450000,'2022-01-15','PENDIENTE'),(113,69,'Alquiler','10',8,5400000,450000,'2022-02-15','PENDIENTE'),(114,69,'Alquiler','10',9,5400000,450000,'2022-03-15','PENDIENTE'),(115,69,'Alquiler','10',10,5400000,450000,'2022-04-15','PENDIENTE'),(116,69,'Alquiler','10',11,5400000,450000,'2022-05-15','PENDIENTE'),(117,69,'Alquiler','10',12,5400000,450000,'2022-06-15','PENDIENTE'),(118,66,'Alquiler','10',0,5000000,5000000,'2021-07-01','PENDIENTE'),(119,109,'Alquiler','10',1,5400000,450000,'2021-07-15','PENDIENTE'),(120,109,'Alquiler','10',2,5400000,450000,'2021-08-15','PENDIENTE'),(121,109,'Alquiler','10',3,5400000,450000,'2021-09-15','PENDIENTE'),(122,109,'Alquiler','10',4,5400000,450000,'2021-10-15','PENDIENTE'),(123,109,'Alquiler','10',5,5400000,450000,'2021-11-15','PENDIENTE'),(124,109,'Alquiler','10',6,5400000,450000,'2021-12-15','PENDIENTE'),(125,109,'Alquiler','10',7,5400000,450000,'2022-01-15','PENDIENTE'),(126,109,'Alquiler','10',8,5400000,450000,'2022-02-15','PENDIENTE'),(127,109,'Alquiler','10',9,5400000,450000,'2022-03-15','PENDIENTE'),(128,109,'Alquiler','10',10,5400000,450000,'2022-04-15','PENDIENTE'),(129,109,'Alquiler','10',11,5400000,450000,'2022-05-15','PENDIENTE'),(130,109,'Alquiler','10',12,5400000,450000,'2022-06-15','PENDIENTE'),(131,47,'Alquiler','10',1,5400000,450000,'2021-07-15','PENDIENTE'),(132,47,'Alquiler','10',2,5400000,450000,'2021-08-15','PENDIENTE'),(133,47,'Alquiler','10',3,5400000,450000,'2021-09-15','PENDIENTE'),(134,47,'Alquiler','10',4,5400000,450000,'2021-10-15','PENDIENTE'),(135,47,'Alquiler','10',5,5400000,450000,'2021-11-15','PENDIENTE'),(136,47,'Alquiler','10',6,5400000,450000,'2021-12-15','PENDIENTE'),(137,47,'Alquiler','10',7,5400000,450000,'2022-01-15','PENDIENTE'),(138,47,'Alquiler','10',8,5400000,450000,'2022-02-15','PENDIENTE'),(139,47,'Alquiler','10',9,5400000,450000,'2022-03-15','PENDIENTE'),(140,47,'Alquiler','10',10,5400000,450000,'2022-04-15','PENDIENTE'),(141,47,'Alquiler','10',11,5400000,450000,'2022-05-15','PENDIENTE'),(142,47,'Alquiler','10',12,5400000,450000,'2022-06-15','PENDIENTE'),(143,45,'Alquiler','10',1,5400000,450000,'2021-07-15','PENDIENTE'),(144,45,'Alquiler','10',2,5400000,450000,'2021-08-15','PENDIENTE'),(145,45,'Alquiler','10',3,5400000,450000,'2021-09-15','PENDIENTE'),(146,45,'Alquiler','10',4,5400000,450000,'2021-10-15','PENDIENTE'),(147,45,'Alquiler','10',5,5400000,450000,'2021-11-15','PENDIENTE'),(148,45,'Alquiler','10',6,5400000,450000,'2021-12-15','PENDIENTE'),(149,45,'Alquiler','10',7,5400000,450000,'2022-01-15','PENDIENTE'),(150,45,'Alquiler','10',8,5400000,450000,'2022-02-15','PENDIENTE'),(151,45,'Alquiler','10',9,5400000,450000,'2022-03-15','PENDIENTE'),(152,45,'Alquiler','10',10,5400000,450000,'2022-04-15','PENDIENTE'),(153,45,'Alquiler','10',11,5400000,450000,'2022-05-15','PENDIENTE'),(154,45,'Alquiler','10',12,5400000,450000,'2022-06-15','PENDIENTE');
/*!40000 ALTER TABLE `cuentas_cobrar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deporte`
--

DROP TABLE IF EXISTS `deporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deporte` (
  `iddeporte` int NOT NULL AUTO_INCREMENT,
  `deporte` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `costoMensual` int NOT NULL,
  `mesinicio` int NOT NULL,
  `duracion` int NOT NULL,
  `estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`iddeporte`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deporte`
--

LOCK TABLES `deporte` WRITE;
/*!40000 ALTER TABLE `deporte` DISABLE KEYS */;
INSERT INTO `deporte` VALUES (1,'Escuela de Futbol',100000,12,5,'ACTIVO'),(2,'BASQUET',100000,1,12,'ACTIVO'),(3,'Escuela de Futbol 2da Temporada',100000,5,6,'ACTIVO');
/*!40000 ALTER TABLE `deporte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deportista`
--

DROP TABLE IF EXISTS `deportista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deportista` (
  `iddeportista` int NOT NULL AUTO_INCREMENT,
  `idrazonsocial` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ci` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaIngreso` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(45) COLLATE utf8_spanish_ci DEFAULT 'ACTIVO',
  PRIMARY KEY (`iddeportista`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deportista`
--

LOCK TABLES `deportista` WRITE;
/*!40000 ALTER TABLE `deportista` DISABLE KEYS */;
INSERT INTO `deportista` VALUES (1,'5','14568940','Reed','2021-05-18 14:56:32','ACTIVO'),(2,'4','47240615','Zachery','2021-05-18 15:00:27','ACTIVO');
/*!40000 ALTER TABLE `deportista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_movimiento_caja`
--

DROP TABLE IF EXISTS `detalle_movimiento_caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_movimiento_caja` (
  `codigo_Movimiento_Caja` int DEFAULT NULL,
  `codigo_Tipo_Cobro` int DEFAULT NULL,
  `monto_detalle_Movimiento_Caja` int DEFAULT NULL,
  `nro_documento_cobro` varchar(155) DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_movimiento_caja`
--

LOCK TABLES `detalle_movimiento_caja` WRITE;
/*!40000 ALTER TABLE `detalle_movimiento_caja` DISABLE KEYS */;
INSERT INTO `detalle_movimiento_caja` VALUES (1,1,50000,'0','ACTIVO'),(2,3,30000,'45456465','ACTIVO'),(2,1,20000,'0','ACTIVO'),(3,1,50000,'0','ACTIVO'),(4,1,50000,'0','ACTIVO'),(5,3,50000,'0','ACTIVO'),(6,1,50000,'0','ACTIVO'),(7,3,50000,'0','ACTIVO'),(8,1,50000,'0','ACTIVO'),(9,1,50000,'0','ACTIVO'),(10,1,100000,'0','ACTIVO'),(11,1,100000,'0','ACTIVO'),(12,1,3500000,'0','ACTIVO'),(13,2,7000000,'0','ACTIVO');
/*!40000 ALTER TABLE `detalle_movimiento_caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallecobro`
--

DROP TABLE IF EXISTS `detallecobro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detallecobro` (
  `codigoFacturas` int DEFAULT NULL,
  `id_cuenta_cobrar` int DEFAULT NULL,
  `tipocuenta` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idrazonsocial` int DEFAULT NULL,
  `numerocuota` int DEFAULT NULL,
  `montoCobrar` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallecobro`
--

LOCK TABLES `detallecobro` WRITE;
/*!40000 ALTER TABLE `detallecobro` DISABLE KEYS */;
INSERT INTO `detallecobro` VALUES (5,40,'socio',7,0,1000000),(5,30,'socio',5,3,50000),(5,31,'socio',5,4,50000),(6,3,'socio',2,2,50000),(7,29,'socio',5,2,50000),(8,15,'socio',4,2,50000),(9,16,'socio',4,3,50000),(10,17,'socio',4,4,50000),(11,7,'socio',2,6,50000),(12,66,'Alquiler',13,0,1000000),(13,59,'Alquiler',1,0,3000000),(14,87,'DEPORTISTA',4,5,100000),(15,86,'DEPORTISTA',5,5,100000),(16,59,'Alquiler',1,0,2000000),(16,40,'socio',7,0,1500000),(17,65,'Alquiler',23,0,5000000),(17,59,'Alquiler',1,0,2000000);
/*!40000 ALTER TABLE `detallecobro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallecomisiondeporte`
--

DROP TABLE IF EXISTS `detallecomisiondeporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detallecomisiondeporte` (
  `idcomisiondeporte` int DEFAULT NULL,
  `cargo` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ci` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallecomisiondeporte`
--

LOCK TABLES `detallecomisiondeporte` WRITE;
/*!40000 ALTER TABLE `detallecomisiondeporte` DISABLE KEYS */;
INSERT INTO `detallecomisiondeporte` VALUES (1,'PRESIDENTE','Presidente Futbol','1111111','presidenteFutbol','12345'),(1,'SECRETARIO','Secretario Futbol','2222222','secretarioFutbol','12345'),(1,'TESORERO','Tesorero Futbol','3333333','tesoreroFutbol','12345'),(2,'PRESIDENTE','PresiBasquet','111444','PresiBasquet','12345'),(2,'SECRETARIO','SecreBasquet','2222222','SecreBasquet','12345'),(2,'TESORERO','tesoreroBasquet','3333222','tesoreroBasquet','12345'),(3,'PRESIDENTE','PresiFutbolSeg','111111','PresiFutbolSeg','12345'),(3,'SECRETARIO','SecreFutbolSeg','222222222','SecreFutbolSeg','12345'),(3,'TESORERO','tesoFutbolSeg','333333333','tesoFutbolSeg','12345');
/*!40000 ALTER TABLE `detallecomisiondeporte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalledeportista`
--

DROP TABLE IF EXISTS `detalledeportista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalledeportista` (
  `iddetalleDeportista` int NOT NULL AUTO_INCREMENT,
  `iddeportista` int DEFAULT NULL,
  `iddeporte` int DEFAULT NULL,
  `deporte` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idcategoria` int DEFAULT NULL,
  `categoria` varchar(145) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`iddetalleDeportista`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalledeportista`
--

LOCK TABLES `detalledeportista` WRITE;
/*!40000 ALTER TABLE `detalledeportista` DISABLE KEYS */;
INSERT INTO `detalledeportista` VALUES (1,1,1,'Escuela de Futbol',5,'2009-2010','ACTIVO'),(2,2,3,'Escuela de Futbol 2da Temporada',10,'07-08','ACTIVO');
/*!40000 ALTER TABLE `detalledeportista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facturas` (
  `codigoFacturas` int NOT NULL AUTO_INCREMENT,
  `nroFacturas` int DEFAULT NULL,
  `tipoFactura` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `codigoTimbrado` int NOT NULL,
  `codigoUsuario` int DEFAULT NULL,
  `idrazonsocial` int DEFAULT NULL,
  `razonsocial` varchar(120) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ci` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fechaFacturas` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fechacreación` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estadoFacturas` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`codigoFacturas`),
  KEY `fk_Facturas_Timbrado1_idx` (`codigoTimbrado`),
  CONSTRAINT `fk_Facturas_Timbrado1` FOREIGN KEY (`codigoTimbrado`) REFERENCES `timbrado` (`codigoTimbrado`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
INSERT INTO `facturas` VALUES (4,15,'FACTURA',2,1,1,'Jonas Elias Sotomayor Vera','4859536-5','2021-04-28 15:43:10','2021-04-28 15:43:10','COBRADO'),(5,2,'RECIBO',3,1,1,'Jonas Elias Sotomayor Vera','4859536-5','2021-04-28 15:45:54','2021-04-28 15:45:54','COBRADO'),(6,16,'FACTURA',2,1,2,'Natalia Raquel Rivas de Sotomayor','6019251','2021-05-05 13:44:03','2021-05-05 13:44:03','COBRADO'),(7,17,'FACTURA',2,1,5,'Reed','14568940','2021-05-05 13:45:16','2021-05-05 13:45:16','COBRADO'),(8,18,'FACTURA',2,1,4,'Zachery','47240615','2021-05-05 14:01:25','2021-05-05 14:01:25','COBRADO'),(9,19,'FACTURA',2,1,4,'Zachery','47240615','2021-05-05 14:02:39','2021-05-05 14:02:39','COBRADO'),(10,20,'FACTURA',2,1,4,'Zachery','47240615','2021-05-05 14:04:24','2021-05-05 14:04:24','COBRADO'),(11,21,'FACTURA',2,1,2,'Natalia Raquel Rivas de Sotomayor','6019251','2021-05-05 14:06:12','2021-05-05 14:06:12','COBRADO'),(12,22,'FACTURA',2,1,20,'Valentine','48792137','2021-05-05 19:35:26','2021-05-05 19:35:26','COBRADO'),(13,23,'FACTURA',2,1,1,'Jonas Elias Sotomayor Vera','4859536-5','2021-05-05 19:45:58','2021-05-05 19:45:58','COBRADO'),(14,24,'FACTURA',2,3,4,'Zachery','47240615','2021-05-18 20:00:48','2021-05-18 20:00:48','COBRADO'),(15,25,'FACTURA',2,1,5,'Reed','14568940','2021-05-20 14:55:31','2021-05-20 14:55:31','COBRADO'),(16,26,'FACTURA',2,1,3,'Rodolfo Zenon Dure','2845214','2021-06-23 14:29:45','2021-06-23 14:29:45','COBRADO'),(17,27,'FACTURA',2,1,8,'Drake','38013137','2021-06-23 14:36:44','2021-06-23 14:36:44','COBRADO');
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familia`
--

DROP TABLE IF EXISTS `familia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `familia` (
  `idrazonsocial` int NOT NULL,
  `cifamiliar` varchar(120) NOT NULL,
  `razonsocial` varchar(250) NOT NULL,
  `parentesco` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familia`
--

LOCK TABLES `familia` WRITE;
/*!40000 ALTER TABLE `familia` DISABLE KEYS */;
INSERT INTO `familia` VALUES (104,'48564','Josias','HERMANO/A'),(1,'1169070','BALDOVINA VERA DE SOTOMAYOR','PADRE/MADRE'),(1,'826404','EUTAQUIO JUSTO SOTOMAYOR ','PADRE/MADRE');
/*!40000 ALTER TABLE `familia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inmueble`
--

DROP TABLE IF EXISTS `inmueble`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inmueble` (
  `idinmueble` int NOT NULL AUTO_INCREMENT,
  `determinacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cuentacatastral` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `costomensual` int NOT NULL,
  `costosemestral` int NOT NULL,
  `costoanual` int NOT NULL,
  `estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`idinmueble`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inmueble`
--

LOCK TABLES `inmueble` WRITE;
/*!40000 ALTER TABLE `inmueble` DISABLE KEYS */;
INSERT INTO `inmueble` VALUES (1,'SALON COMERCIAL 1','calle Enrique Scavenius c/ Dr. Juan Manuel Cano Melgarejo','21-0181-02',1500000,18000000,9000000,'ACTIVO'),(2,'SALON COMERCIAL 2','2DA TIENDA A LADO DE LA MUNICIPALIDAD','21-0031-09',1000000,5500000,10000000,'ACTIVO'),(3,'SALON COMERCIAL 3','TERCERA TIENDA A LADO DE LA MUNICIPALIDAD, SOBRE TUYUTI','21-0031-09',900000,5000000,8000000,'ACTIVO'),(4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','EN EL PREVIO DEL CLUB CORONEL','545748454',450000,3000000,5000000,'ACTIVO');
/*!40000 ALTER TABLE `inmueble` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimiento_caja`
--

DROP TABLE IF EXISTS `movimiento_caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimiento_caja` (
  `codigo_Movimiento_Caja` int NOT NULL AUTO_INCREMENT,
  `codigo_Apertura_Cierre` int DEFAULT NULL,
  `codigo_Cuentas_Cobrar` int DEFAULT NULL,
  `fechaMovimiento` datetime DEFAULT CURRENT_TIMESTAMP,
  `montoMovimiento` int DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'ACTVO',
  PRIMARY KEY (`codigo_Movimiento_Caja`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimiento_caja`
--

LOCK TABLES `movimiento_caja` WRITE;
/*!40000 ALTER TABLE `movimiento_caja` DISABLE KEYS */;
INSERT INTO `movimiento_caja` VALUES (1,3,2,'2021-02-23 11:19:18',50000,'ACTIVO'),(2,6,14,'2021-02-23 17:59:50',50000,'ACTIVO'),(3,8,43,'2021-02-23 18:20:06',50000,'ACTIVO'),(4,9,3,'2021-05-05 09:44:03',50000,'ACTIVO'),(5,9,29,'2021-05-05 09:45:16',50000,'ACTIVO'),(6,9,15,'2021-05-05 10:01:25',50000,'ACTIVO'),(7,9,16,'2021-05-05 10:02:39',50000,'ACTIVO'),(8,9,17,'2021-05-05 10:04:24',50000,'ACTIVO'),(9,9,7,'2021-05-05 10:06:12',50000,'ACTIVO'),(10,13,87,'2021-05-18 16:00:48',100000,'ACTIVO'),(11,12,86,'2021-05-20 10:55:31',100000,'ACTIVO'),(12,9,0,'2021-06-23 10:29:45',3500000,'ACTIVO'),(13,9,0,'2021-06-23 10:36:44',7000000,'ACTIVO');
/*!40000 ALTER TABLE `movimiento_caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permisos` (
  `codigoPermiso` int NOT NULL AUTO_INCREMENT,
  `descripcionPermiso` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `ServicioTipo` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estadoPermiso` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`codigoPermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,'Home','1','ACTIVO'),(2,'Administrador','1','ACTIVO'),(3,'Secretaria','1','ACTIVO'),(4,'Caja','1','ACTIVO'),(5,'AdministradorDeportivo','1','ACTIVO'),(6,'SecretarioDeportivo','1','ACTIVO'),(7,'TesoreroDeportivo','1','ACTIVO');
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `razonsocial`
--

DROP TABLE IF EXISTS `razonsocial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `razonsocial` (
  `idrazonsocial` int NOT NULL AUTO_INCREMENT,
  `razonsocial` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `ci` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `celular` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `correo` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `nacionalidad` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fechanacimiento` date NOT NULL,
  `estadocivil` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `profesion` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `ciudad` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estado` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `imagenRazonSocial` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`idrazonsocial`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `razonsocial`
--

LOCK TABLES `razonsocial` WRITE;
/*!40000 ALTER TABLE `razonsocial` DISABLE KEYS */;
INSERT INTO `razonsocial` VALUES (1,'Jonas Elias Sotomayor Vera','4859536-5','Avd. Hector Roque Duarte Nro. 1362','0971430714','jonaselias77@gmail.com','paraguayo','1996-03-07','SOLTERO','Informatico','Coronel Oviedo','ACTIVO','usernull.png'),(2,'Natalia Raquel Rivas de Sotomayor','6019251','Avd. Hector Roque Duarte nro 1362','0972339979','natyraquelrivasgarcete@gmail.com','Paraguaya','1996-11-23','SOLTERO','Contadora','Coronel Oviedo','ACTIVO','usernull.png'),(3,'Rodolfo Zenon Dure','2845214','avad. dasfasdfadsfadsfadf','0972545421','rodoldura@gadsas.com','Paraguaya','1992-09-28','SOLTERO','Analista de Sistema','Coronel Oviedo','ACTIVO','1584540228.jpg'),(4,'Zachery','47240615','995-1249 Mi Ctra.','(01) 8227 4122','dictum.placerat.augue@fames.net','Algeria','2020-03-20','Casado','Adobe','Torgnon','ACTIVO','usernull.png'),(5,'Reed','14568940','489-6251 Blandit Ctra.','(08) 7068 7141','Proin.sed@liberoProinmi.org','Colombia','2020-12-04','Casado','Lycos','Tulita','ACTIVO','usernull.png'),(6,'Dolan','13635567','Apdo.:277-123 Tincidunt, C.','(01) 6869 3971','Donec.tempus.lorem@dui.com','Romania','2020-04-23','Casado','Apple Systems','Eisden','ACTIVO','usernull.png'),(7,'Patrick','10479514','4978 Iaculis C.','(02) 9837 8617','ante.dictum@tincidunt.com','Vanuatu','2021-03-18','Soltero','Lycos','Ollolai','ACTIVO','usernull.png'),(8,'Drake','38013137','Apartado núm.: 194, 1995 Quis Av.','(01) 9275 8905','facilisis@hendreritid.net','Slovenia','2020-10-23','Soltero','Yahoo','Meerdonk','ACTIVO','usernull.png'),(9,'Chaney','28208967','Apdo.:527-5317 Quam. ','(08) 0860 0745','quam.Curabitur@adipiscing.edu','Cameroon','2021-01-12','Soltero','Yahoo','Gbongan','ACTIVO','usernull.png'),(10,'Davis','44815557','519-1765 Sit Avda.','(07) 7980 1985','feugiat@Aliquamvulputateullamcorper.edu','Aruba','2020-12-05','Soltero','Google','Charters Towers','ACTIVO','usernull.png'),(11,'Marsden','35155172','3343 Dolor C.','(06) 2091 9790','est.ac.mattis@telluseu.com','Senegal','2021-02-11','Soltero','Lavasoft','Challand-Saint-Victor','ACTIVO','usernull.png'),(12,'Todd','45073550','604-9640 Morbi Ctra.','(09) 5894 6869','leo@volutpatnunc.ca','Azerbaijan','2021-02-11','Casado','Google','Tarrasa','ACTIVO','usernull.png'),(13,'Beau','19582143','6447 Non Ctra.','(09) 4877 4418','Curabitur@tortorNunccommodo.co.uk','United States Minor Outlying Islands','2019-05-14','Casado','Yahoo','Dessel','ACTIVO','usernull.png'),(14,'Jeremy','41892391','Apdo.:707-7711 Rutrum C.','(09) 7232 3563','pede.nonummy@Cras.edu','Thailand','2019-08-06','Casado','Lycos','Caxias do Sul','ACTIVO','usernull.png'),(15,'Buckminster','38027649','Apdo.:769-9906 Malesuada Calle','(04) 4865 2590','vitae.diam@esttemporbibendum.net','Costa Rica','2019-11-12','Soltero','Cakewalk','Eckville','ACTIVO','usernull.png'),(16,'Justin','28408579','Apdo.:208-3766 Ornare Avenida','(05) 4229 3072','Nulla.interdum@eudoloregestas.com','Tajikistan','2020-01-22','Casado','Finale','San Giorgio Albanese','ACTIVO','usernull.png'),(17,'Christopher','33912428','Apartado núm.: 877, 685 Accumsan Avda.','(07) 4864 3795','ac@arcuVestibulum.edu','Cyprus','2020-06-08','Soltero','Cakewalk','Monacilioni','ACTIVO','usernull.png'),(18,'Jeremy','9225403','Apartado núm.: 529, 9240 Lectus C/','(01) 0574 8675','aliquet@VivamusnisiMauris.ca','Saint Pierre and Miquelon','2021-03-13','Soltero','Finale','Tulita','ACTIVO','usernull.png'),(19,'Reed','36430129','Apdo.:510-9135 Magna. Carretera','(06) 0210 2903','sapien@feugiat.edu','Curaçao','2020-08-22','Casado','Yahoo','Sellano','ACTIVO','usernull.png'),(20,'Valentine','48792137','Apdo.:663-9836 Tincidunt, Calle','(04) 9399 0549','mattis.ornare.lectus@luctusCurabitur.org','Afghanistan','2019-09-13','Casado','Chami','Lerwick','ACTIVO','usernull.png'),(21,'Bernard','40566078','536-4753 Morbi Av.','(05) 1804 3655','magna@erat.ca','Haiti','2019-11-21','Casado','Yahoo','Milano','ACTIVO','usernull.png'),(22,'Hayden','10970807','Apartado núm.: 286, 8736 Vulputate C.','(04) 0545 1376','cubilia.Curae@iaculisquispede.com','Liberia','2020-01-21','Soltero','Finale','Blankenberge','ACTIVO','usernull.png'),(23,'Elton','38181309','2259 Amet C.','(04) 5038 9516','ornare.elit.elit@feugiatLoremipsum.ca','Antigua and Barbuda','2019-04-27','Casado','Cakewalk','Montignies-Saint-Christophe','ACTIVO','usernull.png'),(24,'Ethan','42729317','Apartado núm.: 860, 5665 A, Avenida','(04) 9351 9952','Curabitur@necante.edu','Austria','2020-05-17','Soltero','Altavista','Dole','ACTIVO','usernull.png'),(25,'Leonard','37928720','Apartado núm.: 854, 445 Arcu Avda.','(04) 6080 2635','auctor@vitaedolor.co.uk','Croatia','2020-02-16','Casado','Finale','Iowa City','ACTIVO','usernull.png'),(26,'Tarik','8431882','3291 Lorem C.','(09) 6988 4781','fermentum.risus@nonnisi.co.uk','Cocos (Keeling) Islands','2021-03-27','Casado','Apple Systems','Lower Hutt','ACTIVO','usernull.png'),(27,'Lester','41645360','Apartado núm.: 185, 9792 Bibendum Ctra.','(08) 3530 4389','malesuada@Pellentesquehabitantmorbi.org','Angola','2020-11-26','Casado','Lycos','Siracusa','ACTIVO','usernull.png'),(28,'Talon','37779627','127-6445 Elementum, C/','(07) 6014 3371','semper.et@maurissagittisplacerat.ca','Cook Islands','2020-02-21','Soltero','Altavista','Lacombe County','ACTIVO','usernull.png'),(29,'Valentine','16481512','3000 Odio, Avenida','(04) 6051 8662','mollis.dui@orciUtsemper.co.uk','United Arab Emirates','2019-12-10','Soltero','Lavasoft','Kamoke','ACTIVO','usernull.png'),(30,'Chase','7196343','Apdo.:753-4792 Ipsum ','(02) 6196 0064','arcu@Sednecmetus.com','Bouvet Island','2019-10-20','Soltero','Cakewalk','Kalken','ACTIVO','usernull.png'),(31,'Leroy','21248445','Apdo.:422-8567 Tristique Ctra.','(05) 4103 6390','at.fringilla.purus@Crasdolordolor.ca','Philippines','2020-10-25','Casado','Adobe','Rockford','ACTIVO','usernull.png'),(32,'Vance','41829543','846-8400 Massa. Carretera','(08) 2802 7518','augue.Sed@vulputate.edu','Thailand','2019-09-22','Casado','Apple Systems','Lockerbie','ACTIVO','usernull.png'),(33,'Wang','29588103','Apdo.:274-5241 In Av.','(07) 2245 0211','torquent.per@felis.ca','Nicaragua','2020-04-04','Casado','Finale','Gulfport','ACTIVO','usernull.png'),(34,'Finn','13094047','605-1010 Vivamus Av.','(03) 5788 0240','primis.in.faucibus@semNulla.net','Japan','2019-05-19','Casado','Borland','Brighton','ACTIVO','usernull.png'),(35,'Cedric','12059615','9579 Et Ctra.','(06) 7568 1976','turpis.egestas.Aliquam@pedeCrasvulputate.edu','Australia','2020-11-28','Soltero','Google','Essex','ACTIVO','usernull.png'),(36,'Geoffrey','15600843','Apdo.:249-4734 Consequat, ','(02) 8741 2431','arcu.Morbi@est.com','Norfolk Island','2021-03-20','Soltero','Yahoo','Gonnosnò','ACTIVO','usernull.png'),(37,'Macaulay','47983414','Apartado núm.: 280, 1102 Vel Avenida','(07) 5453 7529','ipsum@Aliquamgravidamauris.net','Zambia','2019-05-12','Soltero','Lavasoft','Völklingen','ACTIVO','usernull.png'),(38,'Jamal','50243973','335-9602 Placerat Avda.','(08) 0054 9247','Cum.sociis.natoque@Aliquam.ca','Turkmenistan','2021-01-25','Soltero','Cakewalk','Shchyolkovo','ACTIVO','usernull.png'),(39,'Keith','36282410','294-9257 Sagittis. Avda.','(06) 8194 2677','consectetuer.adipiscing@vitae.ca','Bolivia','2019-11-19','Soltero','Adobe','Heerenveen','ACTIVO','usernull.png'),(40,'Aristotle','28859699','Apartado núm.: 273, 2285 Diam Carretera','(08) 1254 5351','tincidunt.nunc@amet.co.uk','Maldives','2020-05-24','Soltero','Chami','Runcorn','ACTIVO','usernull.png'),(41,'Ferris','21721777','231-7740 Morbi C.','(03) 1224 5269','et@etnetuset.com','Guyana','2021-02-04','Soltero','Finale','Davoli','ACTIVO','usernull.png'),(42,'Herman','20215259','Apdo.:390-3696 Fermentum Avda.','(05) 1461 5865','malesuada@vel.com','Trinidad and Tobago','2019-06-15','Casado','Apple Systems','Levallois-Perret','ACTIVO','usernull.png'),(43,'Emery','31282570','5282 Scelerisque Carretera','(03) 3753 4102','neque.venenatis@malesuada.edu','Croatia','2019-08-01','Soltero','Altavista','Meerhout','ACTIVO','usernull.png'),(44,'Valentine','15812262','4062 Mollis. Av.','(06) 3679 8503','euismod.enim.Etiam@Nam.ca','French Southern Territories','2019-09-22','Casado','Sibelius','Flin Flon','ACTIVO','usernull.png'),(45,'Tad','28726787','175-8130 Vivamus C.','(09) 3975 3046','non@Nullam.com','Macao','2019-11-16','Casado','Google','Oyace','ACTIVO','usernull.png'),(46,'Knox','38728947','Apartado núm.: 509, 7879 Velit Calle','(09) 3492 9203','Proin@etultrices.com','Portugal','2019-12-08','Casado','Yahoo','Stalhille','ACTIVO','usernull.png'),(47,'Geoffrey','16260659','Apartado núm.: 150, 5828 Etiam Ctra.','(07) 8973 3724','Lorem@euismodmauriseu.org','Micronesia','2020-08-23','Soltero','Google','Molina','ACTIVO','usernull.png'),(48,'Harding','27522755','9341 Amet Avda.','(04) 2610 1944','Quisque.libero.lacus@maurisMorbinon.edu','Armenia','2019-07-13','Soltero','Adobe','Vliermaalroot','ACTIVO','usernull.png'),(49,'Bruce','42866722','Apdo.:241-123 Nullam Ctra.','(02) 4039 5751','sapien.Nunc.pulvinar@velvulputate.net','Cambodia','2019-11-15','Soltero','Lavasoft','Trollhättan','ACTIVO','usernull.png'),(50,'Xanthus','35783180','9847 Eu Avda.','(03) 3797 6924','Quisque@vulputatemaurissagittis.net','Romania','2021-02-02','Soltero','Apple Systems','Mansfield-et-Pontefract','ACTIVO','usernull.png'),(51,'Jared','20869221','Apdo.:662-823 Fermentum Ctra.','(08) 2811 3147','est.mollis.non@tellus.net','Malawi','2020-07-21','Casado','Microsoft','Aurillac','ACTIVO','usernull.png'),(52,'Travis','49616482','Apdo.:402-9570 Diam Avda.','(09) 5680 9906','ut.aliquam.iaculis@Vestibulumaccumsan.ca','Uzbekistan','2020-09-17','Casado','Microsoft','Valcourt','ACTIVO','usernull.png'),(53,'Aristotle','34857800','4694 Sed ','(04) 0724 5065','est.mauris@sed.net','Falkland Islands','2019-08-19','Casado','Lavasoft','Aserrí','ACTIVO','usernull.png'),(54,'Kibo','24294025','6277 Dignissim C.','(05) 4004 8449','nec.diam@laciniamattisInteger.edu','Lithuania','2019-07-13','Soltero','Apple Systems','Flint','ACTIVO','usernull.png'),(55,'Cairo','26109761','Apartado núm.: 707, 2933 Pede. Carretera','(01) 1705 6952','libero@nonjusto.com','Mongolia','2021-01-08','Casado','Sibelius','Sellia Marina','ACTIVO','usernull.png'),(56,'Drake','21686340','2449 A, C.','(07) 3120 1525','Vestibulum.ante.ipsum@mattis.edu','Morocco','2020-03-16','Soltero','Chami','Jefferson City','ACTIVO','usernull.png'),(57,'Jerry','43111845','6519 Vehicula C/','(03) 0372 2586','erat.neque@non.org','Moldova','2020-03-04','Soltero','Sibelius','Attock','ACTIVO','usernull.png'),(58,'Oleg','24699059','964-9330 Tincidunt, C.','(04) 8080 9844','orci.quis@Duis.com','Latvia','2021-02-16','Casado','Altavista','Little Rock','ACTIVO','usernull.png'),(59,'Tobias','5658960','242-5262 Eu C/','(05) 5807 7039','ultrices.posuere@mauriseu.org','Seychelles','2019-07-26','Soltero','Apple Systems','San Juan de la Costa','ACTIVO','usernull.png'),(60,'Wesley','36398980','3351 Nascetur Ctra.','(02) 8081 4276','amet.ultricies@egetlacus.org','Burundi','2020-12-06','Soltero','Macromedia','Laces/Latsch','ACTIVO','usernull.png'),(61,'Tiger','26068803','8422 Lorem Avda.','(09) 2260 1235','ullamcorper.viverra@Quisque.edu','Uganda','2019-07-06','Casado','Cakewalk','Rocky View','ACTIVO','usernull.png'),(62,'Perry','21613945','Apdo.:527-3218 Mauris. Av.','(09) 6271 3624','torquent@rhoncusDonec.ca','Ethiopia','2020-01-10','Soltero','Altavista','Boignee','ACTIVO','usernull.png'),(63,'Gavin','33558253','Apdo.:694-8989 Dis C.','(07) 2208 5203','placerat.velit@maurisipsumporta.com','Russian Federation','2020-03-23','Soltero','Sibelius','Cali','ACTIVO','usernull.png'),(64,'Yoshio','20266133','Apartado núm.: 453, 9241 Magna C/','(05) 8449 8255','dictum.eleifend.nunc@tincidunt.com','Botswana','2020-10-25','Casado','Altavista','Lauw','ACTIVO','usernull.png'),(65,'Mohammad','8400847','Apdo.:984-5884 Nulla. ','(03) 8128 8723','iaculis.lacus.pede@aliquamerosturpis.net','Vanuatu','2020-08-16','Casado','Adobe','Frutillar','ACTIVO','usernull.png'),(66,'Bevis','20908643','Apartado núm.: 890, 8908 Mauris. Carretera','(08) 8011 9551','rhoncus@mattissemper.edu','Uruguay','2020-09-16','Casado','Altavista','Kavaratti','ACTIVO','usernull.png'),(67,'Boris','24306160','Apartado núm.: 507, 464 Justo C.','(04) 3117 6943','eu.tellus.eu@blanditcongueIn.ca','Eritrea','2019-07-17','Casado','Sibelius','Ghotki','ACTIVO','usernull.png'),(68,'Ross','41874365','Apartado núm.: 787, 6622 Ultricies Avenida','(09) 9278 1315','nunc@apurusDuis.com','Slovenia','2019-12-24','Casado','Google','Newcastle','ACTIVO','usernull.png'),(69,'Robert','9233646','Apdo.:849-1895 Natoque C/','(05) 7548 5442','Sed.pharetra.felis@sodalesatvelit.co.uk','British Indian Ocean Territory','2020-04-17','Soltero','Google','Leighton Buzzard','ACTIVO','usernull.png'),(70,'Dean','17138053','Apartado núm.: 386, 4491 Ante. Calle','(07) 5995 4413','lorem.vitae.odio@malesuada.com','Peru','2019-09-16','Casado','Yahoo','Indianapolis','ACTIVO','usernull.png'),(71,'Keaton','6632865','Apdo.:631-1360 Aenean Ctra.','(09) 7527 5830','sem.Pellentesque@arcuet.net','Palestine, State of','2019-07-22','Soltero','Lavasoft','Linkebeek','ACTIVO','usernull.png'),(72,'Rajah','22923549','8398 Enim. Avenida','(05) 5788 6799','Duis.elementum@egestasadui.edu','Japan','2019-06-22','Soltero','Macromedia','Conchalí','ACTIVO','usernull.png'),(73,'Oren','42096352','Apartado núm.: 695, 1793 Eu C.','(05) 3178 6730','odio.Etiam@eratnonummyultricies.org','Lesotho','2020-01-03','Casado','Lycos','Porretta Terme','ACTIVO','usernull.png'),(74,'Philip','13241419','Apartado núm.: 356, 2964 Ultrices Ctra.','(09) 0287 2391','lacus.pede@vitae.net','Madagascar','2019-12-09','Casado','Microsoft','Trois-Rivi?res','ACTIVO','usernull.png'),(75,'Barclay','18306264','500-2731 Libero Avenida','(09) 6640 7599','semper.dui@enim.org','Mayotte','2020-05-22','Casado','Apple Systems','Mersin','ACTIVO','usernull.png'),(76,'Buckminster','35100740','Apartado núm.: 349, 8718 Nec, C.','(08) 6799 9122','velit.in.aliquet@enim.edu','Tajikistan','2019-07-19','Soltero','Cakewalk','Nampa','ACTIVO','usernull.png'),(77,'Hiram','30660125','Apartado núm.: 753, 484 Et Calle','(06) 3032 0222','ultrices@velsapien.edu','Jersey','2019-12-22','Soltero','Lycos','Montacuto','ACTIVO','usernull.png'),(78,'Adrian','6392559','Apartado núm.: 969, 114 Scelerisque Calle','(03) 4500 2974','odio.Aliquam@Vestibulumante.ca','Taiwan','2020-03-31','Soltero','Sibelius','Ahmedabad','ACTIVO','usernull.png'),(79,'Neville','31058422','Apartado núm.: 218, 9371 Faucibus ','(07) 6521 7396','eros.Proin@dictumeuplacerat.com','Nepal','2019-07-18','Soltero','Borland','Acuña','ACTIVO','usernull.png'),(80,'Emmanuel','42491004','430-2547 Quisque Avenida','(05) 6142 8479','Proin@nonleoVivamus.org','Uruguay','2021-03-23','Casado','Borland','Obaix','ACTIVO','usernull.png'),(81,'Burton','41501602','Apartado núm.: 628, 788 Orci. C.','(01) 8011 9705','rhoncus@sitamet.com','Sri Lanka','2021-02-28','Soltero','Borland','Yekaterinburg','ACTIVO','usernull.png'),(82,'Leonard','18611245','113-4419 Eget ','(02) 5974 5655','aliquam.enim.nec@acipsum.net','China','2020-04-17','Casado','Yahoo','Nakusp','ACTIVO','usernull.png'),(83,'Knox','13604836','661-7855 Ut Av.','(07) 9912 5295','in.lobortis@Suspendisse.edu','Bermuda','2020-07-17','Casado','Chami','Buner','ACTIVO','usernull.png'),(84,'Sebastian','36556119','Apartado núm.: 757, 2154 Elit. Carretera','(09) 0612 7183','dictum.augue@magnaet.ca','Sudan','2020-12-03','Soltero','Altavista','Bromley','ACTIVO','usernull.png'),(85,'Quentin','28266801','Apartado núm.: 434, 6807 Nunc Ctra.','(04) 1863 1707','laoreet.lectus.quis@sociisnatoquepenatibus.com','Grenada','2020-05-03','Casado','Cakewalk','Barrhead','ACTIVO','usernull.png'),(86,'Richard','43348990','Apdo.:256-1584 Mauris Calle','(09) 1486 4051','faucibus.lectus@magnis.edu','American Samoa','2019-05-07','Casado','Chami','Villar Pellice','ACTIVO','usernull.png'),(87,'Cade','40486649','Apdo.:755-7598 Dolor Ctra.','(07) 2809 7341','Nam.porttitor@tortorIntegeraliquam.net','Guernsey','2020-01-10','Casado','Finale','Barmouth','ACTIVO','usernull.png'),(88,'Victor','35934231','Apdo.:359-2336 Lorem, C.','(08) 2407 5213','nulla.ante.iaculis@Integervulputate.ca','Slovakia','2020-08-21','Soltero','Lycos','Hard','ACTIVO','usernull.png'),(89,'Vincent','28898234','Apartado núm.: 836, 8286 Id, Avda.','(02) 2475 7624','purus.Duis.elementum@dolorvitaedolor.ca','Afghanistan','2021-01-05','Soltero','Lavasoft','Lolol','ACTIVO','usernull.png'),(90,'Stewart','29123680','3038 Montes, Avenida','(07) 5483 1666','eu.metus@rhoncusNullam.net','Vanuatu','2019-07-14','Soltero','Yahoo','Tramutola','ACTIVO','usernull.png'),(91,'Talon','45720877','Apdo.:782-7214 Magna. Avenida','(02) 7839 9831','euismod.mauris@ultrices.ca','Ireland','2020-02-27','Casado','Lycos','Waardamme','ACTIVO','usernull.png'),(92,'Rajah','6316301','Apartado núm.: 883, 4822 Neque Calle','(07) 9196 3992','Proin@ametconsectetuer.com','Swaziland','2020-05-16','Casado','Finale','Bruderheim','ACTIVO','usernull.png'),(93,'Addison','31541775','650 Vitae C/','(02) 8267 7770','Quisque.fringilla.euismod@euismodestarcu.net','United States Minor Outlying Islands','2019-09-18','Soltero','Apple Systems','Likino-Dulyovo','ACTIVO','usernull.png'),(94,'Luke','6418438','5568 Nunc Carretera','(07) 5583 0499','sit.amet@quamvel.net','Mayotte','2021-01-08','Soltero','Adobe','Sachs Harbour','ACTIVO','usernull.png'),(95,'Phelan','41986065','143-826 Posuere Ctra.','(09) 1215 1399','ornare.lectus@antelectus.ca','Nicaragua','2020-03-21','Soltero','Altavista','Sibret','ACTIVO','usernull.png'),(96,'Malik','31040824','Apartado núm.: 187, 2243 Magna C.','(01) 4931 9066','tincidunt@adipiscing.edu','Sudan','2020-03-04','Casado','Google','Acquasparta','ACTIVO','usernull.png'),(97,'Abraham','41912258','Apartado núm.: 435, 8542 Dui Carretera','(09) 1737 6747','Morbi@Sed.com','Peru','2021-01-18','Soltero','Borland','Campobasso','ACTIVO','usernull.png'),(98,'Zachary','36057304','8015 Eu Avenida','(02) 0572 4963','vitae.sodales@vitae.com','Algeria','2020-10-03','Soltero','Finale','Balvano','ACTIVO','usernull.png'),(99,'Charles','31968970','Apdo.:446-4412 Erat. C/','(07) 9201 0988','Aliquam.auctor@euismodindolor.ca','Bolivia','2020-10-08','Casado','Borland','Bankura','ACTIVO','usernull.png'),(100,'Colin','5882766','762-5441 Varius. Ctra.','(07) 1381 6520','Sed.eu.eros@nequeNullam.edu','Kyrgyzstan','2019-12-07','Soltero','Finale','Khuzdar','ACTIVO','usernull.png'),(101,'Jared','15207615','200-6474 Velit. Av.','(08) 6305 8066','sodales@amet.ca','Viet Nam','2020-10-19','Soltero','Sibelius','Hamme','ACTIVO','usernull.png'),(102,'Akeem','41395289','Apartado núm.: 190, 8891 Suspendisse ','(07) 5211 1547','lobortis.mauris.Suspendisse@Crasconvallisconvallis.net','Côte D\'Ivoire (Ivory Coast)','2020-04-07','Soltero','Yahoo','Lestizza','ACTIVO','usernull.png'),(103,'Jack','21927503','Apartado núm.: 708, 403 Posuere Av.','(07) 1660 0699','Praesent.interdum@variusNamporttitor.com','Sudan','2019-10-21','Soltero','Lycos','Sangli','ACTIVO','usernull.png'),(104,'Josue Lartino','48541245','Azucena','0971430714','josuelartino@gmail.com','Paraguaya','1987-02-02','SOLTERO','estudiante','Coronel Oviedo','ACTIVO','usernull.png'),(106,'Jose Martin Peña','8541242','','','','Paraguayo','2010-05-05','SOLTERO','','Coronel Oviedo','ACTIVO','usernull.png'),(107,'asASDasd','234123413','KADSJDFKLJASFKLJSD','0971445484','ASSGADS@AGFGA.COM','paraguayo','1998-04-28','SOLTERO','estudiante','CORONEL OVIEDO','ACTIVO','usernull.png'),(108,'ASDFASDFASDF','8454545','HSDHFJASDHJKFHJASDFJ','0985451455','ASFASDF.COM','paraguayo','2021-05-19','SOLTERO','ESTUDIANTE','CORONEL OVIEDO','ACTIVO','usernull.png'),(109,'marcelo','8545144','knasfkldjasfasdj','02384934','aksjdfkasd','paraguayo','1987-05-05','SOLTERO','estudiante','coronel oviedo','ACTIVO','usernull.png');
/*!40000 ALTER TABLE `razonsocial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sesioncomision`
--

DROP TABLE IF EXISTS `sesioncomision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sesioncomision` (
  `idsesioncomision` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `participantes` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idcomisiondirectiva` int NOT NULL,
  `periodo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fotoacta` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`idsesioncomision`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sesioncomision`
--

LOCK TABLES `sesioncomision` WRITE;
/*!40000 ALTER TABLE `sesioncomision` DISABLE KEYS */;
INSERT INTO `sesioncomision` VALUES (1,'2019-12-09','Ing. Claudio Javier González Dr. Francisco Ruben Frutos Figueredo Ing. Santiago Raul Vazquez Lic. Carlos Rubén González Benitez Vice Presidente 2: Sr Aristides Fernandez\r\nProSecretaria: Ing. Elena Galeano\r\n-Abg. Martin Giret\r\n-Dr. Carlos Cano\r\n-Sr. Cesar Vera\r\n-Abg. Raúl Portillo\r\n-Ing. Hugo Espínola\r\n-Sr. Alcides Andres Frutos\r\n-Dr. Santiago Franco\r\n-Abg. Juan Onieva\r\n-Abg. Gerardo Martínez\r\n-Jonas Sotomayor',2,'2019-2020','1576026427.jpg','ACTIVO'),(2,'2021-02-01','Ing. Claudio Javier González Solaeche Sr Aristides Fernandez Ing. Santiago Raul Vazquez Lic. Carlos Rubén González Benitez Vice Presidente 1: Dr. Francisco Ruben Frutos Figueredo\r\nProSecretaria: Ing. Elena Galeano\r\n\r\nMiembros: \r\n-Abg. Martin Giret\r\n-Dr. Carlos Cano\r\n-Sr. Cesar Vera\r\n-Abg. Raúl Portillo\r\n-Ing. Hugo Espínola\r\n-Sr. Alcides Andres Frutos\r\n-Dr. Santiago Franco\r\n-Abg. Juan Onieva\r\n-Abg. Gerardo Martínez',3,'2021-2022','1613502153.jpg','ACTIVO'),(3,'2021-03-08','Ing. Claudio Javier González Solaeche Sr Aristides Fernandez Ing. Santiago Raul Vazquez Lic. Carlos Rubén González Benitez Vice Presidente 1: Dr. Francisco Ruben Frutos Figueredo\r\nProSecretaria: Ing. Elena Galeano\r\n\r\nMiembros: \r\n-Abg. Martin Giret\r\n-Dr. Carlos Cano\r\n-Sr. Cesar Vera\r\n-Abg. Raúl Portillo\r\n-Ing. Hugo Espínola\r\n-Sr. Alcides Andres Frutos\r\n-Dr. Santiago Franco\r\n-Abg. Juan Onieva\r\n-Abg. Gerardo Martínez',3,'2021-2022','','ACTIVO'),(4,'2021-04-12','Ing. Claudio Javier González Solaeche Sr Aristides Fernandez Ing. Santiago Raul Vazquez Lic. Carlos Rubén González Benitez Vice Presidente 1: Dr. Francisco Ruben Frutos Figueredo\r\nProSecretaria: Ing. Elena Galeano\r\n\r\nMiembros: \r\n-Abg. Martin Giret\r\n-Dr. Carlos Cano\r\n-Sr. Cesar Vera\r\n-Abg. Raúl Portillo\r\n-Ing. Hugo Espínola\r\n-Sr. Alcides Andres Frutos\r\n-Dr. Santiago Franco\r\n-Abg. Juan Onieva\r\n-Abg. Gerardo Martínez',3,'2021-2022','1618239812.png','ACTIVO');
/*!40000 ALTER TABLE `sesioncomision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socio`
--

DROP TABLE IF EXISTS `socio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `socio` (
  `idsocio` int NOT NULL AUTO_INCREMENT,
  `nrosocio` int NOT NULL,
  `idrazonsocial` int NOT NULL,
  `tiposocio` int NOT NULL,
  `usuario` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `idsesioncomision` int NOT NULL,
  `tipopago` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estado` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  `imagenCi` varchar(240) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT 'idcard.jpg',
  PRIMARY KEY (`idsocio`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socio`
--

LOCK TABLES `socio` WRITE;
/*!40000 ALTER TABLE `socio` DISABLE KEYS */;
INSERT INTO `socio` VALUES (1,1,1,2,'jonas','12345',1,'ANUAL','ACTIVO','idcard.png'),(2,2,2,1,'6019251','cco6019251',2,'MENSUAL','ACTIVO','idcard.png'),(3,3,4,1,'47240615','cco47240615',2,'MENSUAL','ACTIVO','idcard.png'),(4,4,8,1,'38013137','cco38013137',2,'SEMESTRAL','ACTIVO','idcard.png'),(5,5,5,1,'14568940','cco14568940',2,'MENSUAL','ACTIVO','idcard.png'),(6,6,7,2,'10479514','cco10479514',2,'ANUAL','ACTIVO','idcard.png'),(7,7,9,3,'28208967','cco28208967',2,'SEMESTRAL','ACTIVO','idcard.png'),(8,8,10,1,'44815557','cco44815557',2,'MENSUAL','CANCELADO','idcard.png'),(9,9,13,2,'19582143','cco19582143',2,'SEMESTRAL','CANCELADO','idcard.png');
/*!40000 ALTER TABLE `socio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitantesocio`
--

DROP TABLE IF EXISTS `solicitantesocio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solicitantesocio` (
  `idsolicitantesocio` int NOT NULL AUTO_INCREMENT,
  `idrazonsocial` int NOT NULL,
  `razonsocial` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ci` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `idtiposocio` int NOT NULL,
  `proponente` int NOT NULL,
  `fecha` date NOT NULL,
  `tipopago` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`idsolicitantesocio`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitantesocio`
--

LOCK TABLES `solicitantesocio` WRITE;
/*!40000 ALTER TABLE `solicitantesocio` DISABLE KEYS */;
INSERT INTO `solicitantesocio` VALUES (1,2,'Natalia Raquel Rivas de Sotomayor','6019251',1,1,'2019-12-11','MENSUAL','CONFIRMADO'),(2,8,'Drake','38013137',1,1,'2020-04-20','SEMESTRAL','CONFIRMADO'),(3,4,'Zachery','47240615',1,1,'2021-02-16','MENSUAL','CONFIRMADO'),(4,5,'Reed','14568940',1,1,'2021-02-21','MENSUAL','CONFIRMADO'),(5,7,'Patrick','10479514',2,1,'2021-02-21','ANUAL','CONFIRMADO'),(6,9,'Chaney','28208967',3,1,'2021-02-21','SEMESTRAL','CONFIRMADO'),(7,10,'Davis','44815557',1,3,'2021-02-21','MENSUAL','CONFIRMADO'),(8,13,'Beau','19582143',2,1,'2021-02-21','SEMESTRAL','CONFIRMADO'),(9,3,'Rodolfo Zenon Dure','2845214',1,1,'2021-02-23','MENSUAL','ACTIVO'),(10,65,'Mohammad','8400847',4,1,'2021-05-18','MENSUAL','ACTIVO'),(11,107,'','',3,1,'2021-05-18','MENSUAL','ACTIVO'),(12,108,'ASDFASDFASDF','8454545',1,1,'2021-05-18','MENSUAL','ACTIVO'),(13,43,'Emery','31282570',1,2,'2021-06-22','MENSUAL','ACTIVO'),(14,86,'Richard','43348990',1,4,'2021-06-22','MENSUAL','ACTIVO'),(15,5,'Reed','14568940',2,1,'2021-06-22','MENSUAL','ACTIVO');
/*!40000 ALTER TABLE `solicitantesocio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitudalquiler`
--

DROP TABLE IF EXISTS `solicitudalquiler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solicitudalquiler` (
  `idsolicitudalquiler` int NOT NULL AUTO_INCREMENT,
  `idrazonsocial` int DEFAULT NULL,
  `razonsocial` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ci` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idinmueble` int DEFAULT NULL,
  `denominacion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipopago` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `costoAlquiler` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechainicio` datetime DEFAULT NULL,
  `fechaSolicitud` datetime DEFAULT CURRENT_TIMESTAMP,
  `plazoContrato` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempoContrato` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idsolicitudalquiler`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitudalquiler`
--

LOCK TABLES `solicitudalquiler` WRITE;
/*!40000 ALTER TABLE `solicitudalquiler` DISABLE KEYS */;
INSERT INTO `solicitudalquiler` VALUES (1,1,'Jonas Elias Sotomayor Vera','4859536-5',1,'SALON COMERCIAL 1','ANUAL','9000000','2010-03-01 00:00:00','2021-02-22 10:30:36','10','ANHO','CONFIRMADO'),(2,2,'Natalia Raquel Rivas de Sotomayor','6019251',2,'SALON COMERCIAL 2','ANUAL','10000000','2021-04-01 11:23:00','2021-02-22 11:09:21','5','MES','CONFIRMADO'),(3,1,'Jonas Elias Sotomayor Vera','4859536-5',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','ANUAL','5000000','2021-12-07 10:59:00','2021-04-12 10:59:17','1','DIA','CONFIRMADO'),(4,3,'Rodolfo Zenon Dure','2845214',2,'SALON COMERCIAL 2','MENSUAL','1000000','2021-08-26 11:48:00','2021-05-05 11:48:57','1','ANHO','CONFIRMADO'),(5,19,'Reed','36430129',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','ANUAL','5000000','2021-12-02 11:48:00','2021-05-05 11:49:20','1','DIA','CONFIRMADO'),(6,23,'Elton','38181309',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','ANUAL','5000000','2021-12-03 11:48:00','2021-05-05 11:49:39','1','DIA','CONFIRMADO'),(7,24,'Ethan','42729317',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','ANUAL','5000000','2021-12-04 11:48:00','2021-05-05 11:49:51','1','DIA','CONFIRMADO'),(8,18,'Jeremy','9225403',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','ANUAL','5000000','2021-12-31 15:07:00','2021-05-05 15:07:55','1','ANHO','CONFIRMADO'),(9,23,'Elton','38181309',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','ANUAL','5000000','2021-12-25 15:07:00','2021-05-05 15:08:27','1','ANHO','CONFIRMADO'),(10,25,'Leonard','37928720',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','ANUAL','5000000','2021-12-20 15:07:00','2021-05-05 15:08:41','1','ANHO','CONFIRMADO'),(11,13,'Beau','19582143',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','ANUAL','5000000','2021-12-21 15:26:00','2021-05-05 15:26:21','1','ANHO','CONFIRMADO'),(12,20,'Valentine','48792137',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','ANUAL','5000000','2021-12-14 15:27:00','2021-05-05 15:27:29','1','ANHO','CONFIRMADO'),(13,66,'Bevis','20908643',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','ANUAL','5000000','2021-05-21 11:21:00','2021-05-18 11:21:27','1','DIA','CONFIRMADO'),(14,109,'marcelo','8545144',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','MENSUAL','450000','2021-05-20 11:22:00','2021-05-18 11:22:41','1','DIA','CONFIRMADO'),(15,47,'Geoffrey','16260659',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','MENSUAL','450000','2021-05-28 11:26:00','2021-05-18 11:26:59','1','DIA','CONFIRMADO'),(16,45,'Tad','28726787',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','MENSUAL','450000','2021-06-29 10:04:00','2021-06-22 10:06:09','4','ANHO','CONFIRMADO'),(17,69,'Robert','9233646',4,'POLIDEPORTIVO- QUINCHO - ESTACIONAMIENTO','MENSUAL','450000','2021-06-24 10:48:00','2021-06-22 10:48:22','12','MES','CONFIRMADO'),(18,4,'Zachery','47240615',3,'SALON COMERCIAL 3','MENSUAL','900000','2021-07-07 09:41:00','2021-07-02 09:41:17','1','MES','CONFIRMADO');
/*!40000 ALTER TABLE `solicitudalquiler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timbrado`
--

DROP TABLE IF EXISTS `timbrado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `timbrado` (
  `codigoTimbrado` int NOT NULL AUTO_INCREMENT,
  `nrotimbradovigente` int DEFAULT NULL,
  `vctoTimbrado` date DEFAULT NULL,
  `prefijoTimbrado` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nroactualTimbrado` int DEFAULT NULL,
  `nroinicialTimbrado` int DEFAULT NULL,
  `nrofinalTimbrado` int DEFAULT NULL,
  `tipoTimbrado` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estadoTimbrado` tinyint DEFAULT NULL,
  PRIMARY KEY (`codigoTimbrado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timbrado`
--

LOCK TABLES `timbrado` WRITE;
/*!40000 ALTER TABLE `timbrado` DISABLE KEYS */;
INSERT INTO `timbrado` VALUES (2,32432432,'2021-04-02','457454',28,1,150,'FACTURA',1),(3,324322,'2021-07-02','2423432',3,1,250,'RECIBO',1),(4,456546,'2021-07-05','',12,0,120,'FACTURA',1),(5,456546,'2021-07-05','',12,0,120,'FACTURA',1),(6,324234,'2021-07-06','',12,0,120,'FACTURA',1);
/*!40000 ALTER TABLE `timbrado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_cobro`
--

DROP TABLE IF EXISTS `tipo_cobro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_cobro` (
  `codigo_Tipo_Cobro` int NOT NULL AUTO_INCREMENT,
  `descripcion_Tipo_Cobro` varchar(45) DEFAULT NULL,
  `estado_Tipo_Cobro` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codigo_Tipo_Cobro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_cobro`
--

LOCK TABLES `tipo_cobro` WRITE;
/*!40000 ALTER TABLE `tipo_cobro` DISABLE KEYS */;
INSERT INTO `tipo_cobro` VALUES (1,'EFECTIVO','1'),(2,'TARJETA','1'),(3,'CHEQUE','1');
/*!40000 ALTER TABLE `tipo_cobro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiposocio`
--

DROP TABLE IF EXISTS `tiposocio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiposocio` (
  `idtiposocio` int NOT NULL,
  `tiposocio` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `beneficios` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `costomensual` int NOT NULL,
  `costosemestral` int NOT NULL,
  `costoanual` int NOT NULL,
  `estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`idtiposocio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiposocio`
--

LOCK TABLES `tiposocio` WRITE;
/*!40000 ALTER TABLE `tiposocio` DISABLE KEYS */;
INSERT INTO `tiposocio` VALUES (1,'ACTIVO','- Carnet Familiar (incluye a cónyuge e hijos menores de 18 años).\r\n- Derecho al Voto en Asambleas.\r\n- Goza del 50% de descuento para usufructo de instalaciones del Club para eventos.\r\n- Un acompañante anual.\r\n- Estacionamiento gratuito y preferencial.\r\n- Validez: un año.',50000,280000,500000,'ACTIVO'),(2,'DORADO','Carnet Familiar (incluye a cónyuge e hijos menores de 18 años).\r\nDerecho al Voto en Asambleas.\r\nGoza del 75% de descuento para usufructo de instalaciones del Club para eventos.\r\nUn acompañante por cada visita.\r\nEstacionamiento gratuito y preferencial\r\nValidez: dos años',150000,800000,1500000,'ACTIVO'),(3,'FAMILIAR','Descuentos y promociones exclusivas para socios del Club. \r\nEstacionamiento gratis en club\r\nUsufructo de las instalaciones sociales.',100000,600000,1000000,'ACTIVO'),(4,'JUVENIL','Individual (no invitados).\r\nNo tiene Derecho al Voto en Asambleas.\r\nNo goza de beneficios de descuentos, para usufructo de instalaciones del Club.\r\nDisfruta sólo la parte recreativa.\r\nEstacionamiento gratis.\r\nDuración anual desde 01-ENERO hasta 31-DICIEMBRE de cada año',20000,80000,150000,'ACTIVO');
/*!40000 ALTER TABLE `tiposocio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idusuario` int NOT NULL,
  `idrazonsocial` int NOT NULL,
  `razonsocial` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `ci` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `usuario` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `cargo` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `estado` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `imagenUsuario` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT 'usernull.png',
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,0,'Jonas Elias Sotomayor Vera','4859536-5','admin','12345','ADMINISTRADOR','ACTIVO','usernull.png'),(2,0,'Jonas Elias Sotomayor Vera','4859536-5','SECRE','12345','SECRETARIA','ACTIVO','usernull.png');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_permisos`
--

DROP TABLE IF EXISTS `usuarios_permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios_permisos` (
  `codigoPermiso` int NOT NULL,
  `idusuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_permisos`
--

LOCK TABLES `usuarios_permisos` WRITE;
/*!40000 ALTER TABLE `usuarios_permisos` DISABLE KEYS */;
INSERT INTO `usuarios_permisos` VALUES (1,0),(2,0),(1,0),(2,0),(1,0),(2,0),(1,0),(2,0),(1,0),(2,0),(1,0),(2,0),(1,0),(3,0),(1,0),(3,0),(1,0),(2,0),(1,0),(2,0),(1,1),(2,1),(1,2),(3,2),(1,0),(2,0),(1,0),(2,0),(1,0),(2,0),(1,0),(2,0),(1,0),(2,0),(1,0),(2,0),(1,0),(3,0),(1,0),(3,0),(1,0),(2,0),(1,0),(2,0),(1,1),(2,1),(1,2),(3,2);
/*!40000 ALTER TABLE `usuarios_permisos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-05 10:05:59
