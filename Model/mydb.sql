/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : mydb

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2014-05-13 16:35:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `equipos`
-- ----------------------------
DROP TABLE IF EXISTS `equipos`;
CREATE TABLE `equipos` (
  `CodEq` varchar(3) NOT NULL,
  `NomEq` varchar(40) NOT NULL,
  `Grupo` varchar(1) NOT NULL,
  PRIMARY KEY (`CodEq`),
  UNIQUE KEY `CodEq_UNIQUE` (`CodEq`),
  UNIQUE KEY `NomEq_UNIQUE` (`NomEq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of equipos
-- ----------------------------
INSERT INTO `equipos` VALUES ('ALG', 'Algeria', 'H');
INSERT INTO `equipos` VALUES ('ARG', 'Argentina', 'F');
INSERT INTO `equipos` VALUES ('AUS', 'Australia', 'B');
INSERT INTO `equipos` VALUES ('BEL', 'Belgica', 'H');
INSERT INTO `equipos` VALUES ('BIH', 'Bosnia-Herzegovina', 'F');
INSERT INTO `equipos` VALUES ('BRA', 'Brasil', 'A');
INSERT INTO `equipos` VALUES ('CHI', 'Chile', 'B');
INSERT INTO `equipos` VALUES ('CIV', 'Costa de Marfil', 'C');
INSERT INTO `equipos` VALUES ('CMR', 'Camerun', 'A');
INSERT INTO `equipos` VALUES ('COL', 'Colombia', 'C');
INSERT INTO `equipos` VALUES ('CRC', 'Costa Rica', 'D');
INSERT INTO `equipos` VALUES ('CRO', 'Croacia', 'A');
INSERT INTO `equipos` VALUES ('ECU', 'Ecuador', 'E');
INSERT INTO `equipos` VALUES ('ENG', 'Inglaterra', 'D');
INSERT INTO `equipos` VALUES ('ESP', 'Espa?a', 'B');
INSERT INTO `equipos` VALUES ('FRA', 'Francia', 'E');
INSERT INTO `equipos` VALUES ('GER', 'Alemania', 'G');
INSERT INTO `equipos` VALUES ('GHA', 'Ghana', 'G');
INSERT INTO `equipos` VALUES ('GRE', 'Grecia', 'C');
INSERT INTO `equipos` VALUES ('HON', 'Honduras', 'E');
INSERT INTO `equipos` VALUES ('IRN', 'Iran', 'F');
INSERT INTO `equipos` VALUES ('ITA', 'Italia', 'D');
INSERT INTO `equipos` VALUES ('JPN', 'Japon', 'C');
INSERT INTO `equipos` VALUES ('KOR', 'Republica de Korea', 'H');
INSERT INTO `equipos` VALUES ('MEX', 'Mexico', 'A');
INSERT INTO `equipos` VALUES ('NED', 'Holanda', 'B');
INSERT INTO `equipos` VALUES ('NGA', 'Nigeria', 'F');
INSERT INTO `equipos` VALUES ('POR', 'Portugal', 'G');
INSERT INTO `equipos` VALUES ('RUS', 'Rusia', 'H');
INSERT INTO `equipos` VALUES ('SUI', 'Suiza', 'E');
INSERT INTO `equipos` VALUES ('URU', 'Uruguay', 'D');
INSERT INTO `equipos` VALUES ('USA', 'Estados Unidos', 'G');

-- ----------------------------
-- Table structure for `nickname`
-- ----------------------------
DROP TABLE IF EXISTS `nickname`;
CREATE TABLE `nickname` (
  `Nick` varchar(15) NOT NULL,
  `ID` int(12) NOT NULL,
  `PWD` varchar(45) NOT NULL,
  `Pago` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Nick`),
  UNIQUE KEY `Nick_UNIQUE` (`Nick`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of nickname
-- ----------------------------

-- ----------------------------
-- Table structure for `partidos`
-- ----------------------------
DROP TABLE IF EXISTS `partidos`;
CREATE TABLE `partidos` (
  `CodPartido` int(11) NOT NULL,
  `Partidoscol` varchar(45) DEFAULT NULL,
  `Equipos_CodEq1` varchar(3) NOT NULL,
  `Equipos_CodEq2` varchar(3) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `Abierto` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`CodPartido`),
  UNIQUE KEY `CodPartido_UNIQUE` (`CodPartido`),
  KEY `fk_Partidos_Equipos_idx` (`Equipos_CodEq1`),
  KEY `fk_Partidos_Equipos1_idx` (`Equipos_CodEq2`),
  CONSTRAINT `fk_Partidos_Equipos` FOREIGN KEY (`Equipos_CodEq1`) REFERENCES `equipos` (`CodEq`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Partidos_Equipos1` FOREIGN KEY (`Equipos_CodEq2`) REFERENCES `equipos` (`CodEq`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of partidos
-- ----------------------------
INSERT INTO `partidos` VALUES ('1', '', 'BRA', 'CRO', '2014-06-12','15:00:00', '1');
INSERT INTO `partidos` VALUES ('2', '', 'MEX', 'CMR', '2014-06-13','11:00:00', '1');
INSERT INTO `partidos` VALUES ('3', '', 'ESP', 'NED', '2014-06-13','14:00:00', '1');
INSERT INTO `partidos` VALUES ('4', '', 'CHI', 'AUS', '2014-06-13','16:00:00', '1');
INSERT INTO `partidos` VALUES ('5', '', 'COL', 'GRE', '2014-06-14','11:00:00', '1');
INSERT INTO `partidos` VALUES ('6', '', 'CIV', 'JPN', '2014-06-14','20:00:00', '1');
INSERT INTO `partidos` VALUES ('7', '', 'URU', 'CRC', '2014-06-14','14:00:00', '1');
INSERT INTO `partidos` VALUES ('8', '', 'ENG', 'ITA', '2014-06-14','16:00:00', '1');
INSERT INTO `partidos` VALUES ('9', '', 'SUI', 'ECU', '2014-06-15','11:00:00', '1');
INSERT INTO `partidos` VALUES ('10', '', 'FRA', 'HON', '2014-06-15','14:00:00', '1');
INSERT INTO `partidos` VALUES ('11', '', 'ARG', 'BIH', '2014-06-15','17:00:00', '1');
INSERT INTO `partidos` VALUES ('12', '', 'IRN', 'NGA', '2014-06-16','14:00:00', '1');
INSERT INTO `partidos` VALUES ('13', '', 'GER', 'POR', '2014-06-16','11:00:00', '1');
INSERT INTO `partidos` VALUES ('14', '', 'GHA', 'USA', '2014-06-16','17:00:00', '1');
INSERT INTO `partidos` VALUES ('15', '', 'BEL', 'ALG', '2014-06-17','11:00:00', '1');
INSERT INTO `partidos` VALUES ('16', '', 'RUS', 'KOR', '2014-06-17','16:00:00', '1');
INSERT INTO `partidos` VALUES ('17', '', 'BRA', 'MEX', '2014-06-17','14:00:00', '1');
INSERT INTO `partidos` VALUES ('18', '', 'CMR', 'CRO', '2014-06-18','16:00:00', '1');
INSERT INTO `partidos` VALUES ('19', '', 'ESP', 'CHI', '2014-06-18','14:00:00', '1');
INSERT INTO `partidos` VALUES ('20', '', 'AUS', 'NED', '2014-06-18','11:00:00', '1');
INSERT INTO `partidos` VALUES ('21', '', 'COL', 'CIV', '2014-06-19','11:00:00', '1');
INSERT INTO `partidos` VALUES ('22', '', 'JPN', 'GRE', '2014-06-19','17:00:00', '1');
INSERT INTO `partidos` VALUES ('23', '', 'URU', 'ENG', '2014-06-19','14:00:00', '1');
INSERT INTO `partidos` VALUES ('24', '', 'ITA', 'CRC', '2014-06-20','11:00:00', '1');
INSERT INTO `partidos` VALUES ('25', '', 'SUI', 'FRA', '2014-06-20','14:00:00', '1');
INSERT INTO `partidos` VALUES ('26', '', 'HON', 'ECU', '2014-06-20','17:00:00', '1');
INSERT INTO `partidos` VALUES ('27', '', 'ARG', 'IRN', '2014-06-21','11:00:00', '1');
INSERT INTO `partidos` VALUES ('28', '', 'NGA', 'BIH', '2014-06-21','16:00:00', '1');
INSERT INTO `partidos` VALUES ('29', '', 'GER', 'GHA', '2014-06-21','14:00:00', '1');
INSERT INTO `partidos` VALUES ('30', '', 'USA', 'POR', '2014-06-22','16:00:00', '1');
INSERT INTO `partidos` VALUES ('31', '', 'BEL', 'RUS', '2014-06-22','11:00:00', '1');
INSERT INTO `partidos` VALUES ('32', '', 'KOR', 'ALG', '2014-06-22','14:00:00', '1');
INSERT INTO `partidos` VALUES ('33', '', 'CMR', 'BRA', '2014-06-23','15:00:00', '1');
INSERT INTO `partidos` VALUES ('34', '', 'CRO', 'MEX', '2014-06-23','15:00:00', '1');
INSERT INTO `partidos` VALUES ('35', '', 'AUS', 'ESP', '2014-06-23','11:00:00', '1');
INSERT INTO `partidos` VALUES ('36', '', 'NED', 'CHI', '2014-06-23','11:00:00', '1');
INSERT INTO `partidos` VALUES ('37', '', 'JPN', 'COL', '2014-06-24','14:00:00', '1');
INSERT INTO `partidos` VALUES ('38', '', 'GRE', 'CIV', '2014-06-24','15:00:00', '1');
INSERT INTO `partidos` VALUES ('39', '', 'ITA', 'URU', '2014-06-24','11:00:00', '1');
INSERT INTO `partidos` VALUES ('40', '', 'CRC', 'ENG', '2014-06-24','11:00:00', '1');
INSERT INTO `partidos` VALUES ('41', '', 'HON', 'SUI', '2014-06-25','14:00:00', '1');
INSERT INTO `partidos` VALUES ('42', '', 'ECU', 'FRA', '2014-06-25','15:00:00', '1');
INSERT INTO `partidos` VALUES ('43', '', 'NGA', 'ARG', '2014-06-25','11:00:00', '1');
INSERT INTO `partidos` VALUES ('44', '', 'BIH', 'IRN', '2014-06-25','11:00:00', '1');
INSERT INTO `partidos` VALUES ('45', '', 'USA', 'GER', '2014-06-26','11:00:00', '1');
INSERT INTO `partidos` VALUES ('46', '', 'POR', 'GHA', '2014-06-26','11:00:00', '1');
INSERT INTO `partidos` VALUES ('47', '', 'KOR', 'BEL', '2014-06-26','15:00:00', '1');
INSERT INTO `partidos` VALUES ('48', '', 'ALG', 'RUS', '2014-06-26','15:00:00', '1');

-- ----------------------------
-- Table structure for `pronosticos`
-- ----------------------------
DROP TABLE IF EXISTS `pronosticos`;
CREATE TABLE `pronosticos` (
  `NickName_Nick` varchar(15) NOT NULL,
  `Partidos_CodPartido` int(11) NOT NULL,
  `Puntos_CodPron` int(11) NOT NULL,
  `Pronostico` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`NickName_Nick`,`Partidos_CodPartido`,`Puntos_CodPron`),
  KEY `fk_Pronosticos_NickName1_idx` (`NickName_Nick`),
  KEY `fk_Pronosticos_Partidos1_idx` (`Partidos_CodPartido`),
  KEY `fk_Pronosticos_Puntos1_idx` (`Puntos_CodPron`),
  CONSTRAINT `fk_Pronosticos_NickName1` FOREIGN KEY (`NickName_Nick`) REFERENCES `nickname` (`Nick`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pronosticos_Partidos1` FOREIGN KEY (`Partidos_CodPartido`) REFERENCES `partidos` (`CodPartido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pronosticos_Puntos1` FOREIGN KEY (`Puntos_CodPron`) REFERENCES `puntos` (`CodPron`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pronosticos
-- ----------------------------

-- ----------------------------
-- Table structure for `puntos`
-- ----------------------------
DROP TABLE IF EXISTS `puntos`;
CREATE TABLE `puntos` (
  `CodPron` int(11) NOT NULL,
  `NomPron` varchar(45) DEFAULT NULL,
  `ReglaPron` varchar(250) DEFAULT NULL,
  `Puntos` int(11) NOT NULL,
  `Valores` text(45) NOT NULL,
  PRIMARY KEY (`CodPron`),
  UNIQUE KEY `CodPron_UNIQUE` (`CodPron`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of puntos
-- ----------------------------
INSERT INTO `puntos` VALUES ('1', 'Marcador $eq1', 'Acertar al marcador de $eq1', '5', '0,1,2,3,4,5,6,7,8,9,10');
INSERT INTO `puntos` VALUES ('2', 'Marcador $eq2', 'Acertar al marcador de $eq2', '5', '0,1,2,3,4,5,6,7,8,9,10');
INSERT INTO `puntos` VALUES ('3', 'Tarjetas Amarillas', 'Acertar al total de las tarjetas amarillas', '3', '0-2,3-5,6-8,9-11,12-14');
INSERT INTO `puntos` VALUES ('4', 'Tarjetas Rojas', 'Acertar al total de las tarjetas Rojas', '3', '0,1,2,3,4,5');
INSERT INTO `puntos` VALUES ('5', 'Fueras de Lugar', 'Acertar al total de fueras de lugar', '2', '0-2,3-5,6-8,9-11,12-14');
INSERT INTO `puntos` VALUES ('6', 'Faltas', 'Acertar al total de faltas', '2', '0-2,3-5,6-8,9-11,12-14');
INSERT INTO `puntos` VALUES ('7', 'Tiros de Esquina', 'Acertar al total de tiros de esquina', '1', '0-2,3-5,6-8,9-11,12-14');
INSERT INTO `puntos` VALUES ('8', 'Remates al Arco', 'Acertar al total de remates al arco', '1', '0-5,6-10,11-15,16-20,21-25,26-30');

-- ----------------------------
-- Table structure for `resultados`
-- ----------------------------
DROP TABLE IF EXISTS `resultados`;
CREATE TABLE `resultados` (
  `Partidos_CodPartido` int(11) NOT NULL,
  `Puntos_CodPron` int(11) NOT NULL,
  `Resultado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Partidos_CodPartido`,`Puntos_CodPron`),
  KEY `fk_Pronosticos_Partidos1_idx` (`Partidos_CodPartido`),
  KEY `fk_Pronosticos_Puntos1_idx` (`Puntos_CodPron`),
  CONSTRAINT `fk_Pronosticos_Partidos10` FOREIGN KEY (`Partidos_CodPartido`) REFERENCES `partidos` (`CodPartido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pronosticos_Puntos10` FOREIGN KEY (`Puntos_CodPron`) REFERENCES `puntos` (`CodPron`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of resultados
-- ----------------------------
