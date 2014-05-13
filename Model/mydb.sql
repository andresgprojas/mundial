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
INSERT INTO `nickname` VALUES ('789456123', '321654987', '25f9e794323b453885f5181f1b624d0b', '0');
INSERT INTO `nickname` VALUES ('aksjd', '1236523', '881ee25d99a9efc05a518f9e175adf21', '0');
INSERT INTO `nickname` VALUES ('aksjddd', '12365234', '78c9426a9903fa09b749a06e982a2b08', '0');
INSERT INTO `nickname` VALUES ('AlanBrito', '80238729', 'c893bad68927b457dbed39460e6afd62', '1');
INSERT INTO `nickname` VALUES ('aperez', '1026262467', '2801d271c539286ca17a54c81aec9e18', '1');
INSERT INTO `nickname` VALUES ('pinky', '80876510', 'ea1ab5add73193e96f000b7d8c2cd659', '1');
INSERT INTO `nickname` VALUES ('prueba', '123', 'c893bad68927b457dbed39460e6afd62', '1');
INSERT INTO `nickname` VALUES ('vivi', '1144046610', '231badb19b93e44f47da1bd64a8147f2', '1');

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
INSERT INTO `partidos` VALUES ('1', '', 'BRA', 'CRO', '2014-06-12', '17:00:00', '0');
INSERT INTO `partidos` VALUES ('2', '', 'MEX', 'CMR', '2014-06-13', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('3', '', 'ESP', 'NED', '2014-06-13', '16:00:00', '1');
INSERT INTO `partidos` VALUES ('4', '', 'CHI', 'AUS', '2014-06-13', '18:00:00', '1');
INSERT INTO `partidos` VALUES ('5', '', 'COL', 'GRE', '2014-06-14', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('6', '', 'CIV', 'JPN', '2014-06-14', '22:00:00', '1');
INSERT INTO `partidos` VALUES ('7', '', 'URU', 'CRC', '2014-06-14', '16:00:00', '1');
INSERT INTO `partidos` VALUES ('8', '', 'ENG', 'ITA', '2014-06-14', '18:00:00', '1');
INSERT INTO `partidos` VALUES ('9', '', 'SUI', 'ECU', '2014-06-15', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('10', '', 'FRA', 'HON', '2014-06-15', '16:00:00', '1');
INSERT INTO `partidos` VALUES ('11', '', 'ARG', 'BIH', '2014-06-15', '19:00:00', '1');
INSERT INTO `partidos` VALUES ('12', '', 'IRN', 'NGA', '2014-06-16', '16:00:00', '1');
INSERT INTO `partidos` VALUES ('13', '', 'GER', 'POR', '2014-06-16', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('14', '', 'GHA', 'USA', '2014-06-16', '19:00:00', '1');
INSERT INTO `partidos` VALUES ('15', '', 'BEL', 'ALG', '2014-06-17', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('16', '', 'RUS', 'KOR', '2014-06-17', '18:00:00', '1');
INSERT INTO `partidos` VALUES ('17', '', 'BRA', 'MEX', '2014-06-17', '16:00:00', '1');
INSERT INTO `partidos` VALUES ('18', '', 'CMR', 'CRO', '2014-06-18', '18:00:00', '1');
INSERT INTO `partidos` VALUES ('19', '', 'ESP', 'CHI', '2014-06-18', '16:00:00', '1');
INSERT INTO `partidos` VALUES ('20', '', 'AUS', 'NED', '2014-06-18', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('21', '', 'COL', 'CIV', '2014-06-19', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('22', '', 'JPN', 'GRE', '2014-06-19', '19:00:00', '1');
INSERT INTO `partidos` VALUES ('23', '', 'URU', 'ENG', '2014-06-19', '16:00:00', '1');
INSERT INTO `partidos` VALUES ('24', '', 'ITA', 'CRC', '2014-06-20', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('25', '', 'SUI', 'FRA', '2014-06-20', '16:00:00', '1');
INSERT INTO `partidos` VALUES ('26', '', 'HON', 'ECU', '2014-06-20', '19:00:00', '1');
INSERT INTO `partidos` VALUES ('27', '', 'ARG', 'IRN', '2014-06-21', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('28', '', 'NGA', 'BIH', '2014-06-21', '18:00:00', '1');
INSERT INTO `partidos` VALUES ('29', '', 'GER', 'GHA', '2014-06-21', '16:00:00', '1');
INSERT INTO `partidos` VALUES ('30', '', 'USA', 'POR', '2014-06-22', '18:00:00', '1');
INSERT INTO `partidos` VALUES ('31', '', 'BEL', 'RUS', '2014-06-22', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('32', '', 'KOR', 'ALG', '2014-06-22', '16:00:00', '1');
INSERT INTO `partidos` VALUES ('33', '', 'CMR', 'BRA', '2014-06-23', '17:00:00', '1');
INSERT INTO `partidos` VALUES ('34', '', 'CRO', 'MEX', '2014-06-23', '17:00:00', '1');
INSERT INTO `partidos` VALUES ('35', '', 'AUS', 'ESP', '2014-06-23', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('36', '', 'NED', 'CHI', '2014-06-23', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('37', '', 'JPN', 'COL', '2014-06-24', '16:00:00', '1');
INSERT INTO `partidos` VALUES ('38', '', 'GRE', 'CIV', '2014-06-24', '17:00:00', '1');
INSERT INTO `partidos` VALUES ('39', '', 'ITA', 'URU', '2014-06-24', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('40', '', 'CRC', 'ENG', '2014-06-24', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('41', '', 'HON', 'SUI', '2014-06-25', '16:00:00', '1');
INSERT INTO `partidos` VALUES ('42', '', 'ECU', 'FRA', '2014-06-25', '17:00:00', '1');
INSERT INTO `partidos` VALUES ('43', '', 'NGA', 'ARG', '2014-06-25', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('44', '', 'BIH', 'IRN', '2014-06-25', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('45', '', 'USA', 'GER', '2014-06-26', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('46', '', 'POR', 'GHA', '2014-06-26', '13:00:00', '1');
INSERT INTO `partidos` VALUES ('47', '', 'KOR', 'BEL', '2014-06-26', '17:00:00', '1');
INSERT INTO `partidos` VALUES ('48', '', 'ALG', 'RUS', '2014-06-26', '17:00:00', '1');

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
INSERT INTO `pronosticos` VALUES ('AlanBrito', '1', '1', '4');
INSERT INTO `pronosticos` VALUES ('AlanBrito', '1', '2', '0');
INSERT INTO `pronosticos` VALUES ('AlanBrito', '1', '5', '2');
INSERT INTO `pronosticos` VALUES ('AlanBrito', '1', '6', '0');
INSERT INTO `pronosticos` VALUES ('AlanBrito', '2', '1', '4');
INSERT INTO `pronosticos` VALUES ('AlanBrito', '2', '2', '0');
INSERT INTO `pronosticos` VALUES ('AlanBrito', '2', '5', '0');
INSERT INTO `pronosticos` VALUES ('AlanBrito', '2', '6', '0');
INSERT INTO `pronosticos` VALUES ('AlanBrito', '3', '1', '6');
INSERT INTO `pronosticos` VALUES ('AlanBrito', '3', '2', '1');
INSERT INTO `pronosticos` VALUES ('AlanBrito', '3', '5', '1');
INSERT INTO `pronosticos` VALUES ('AlanBrito', '3', '6', '1');
INSERT INTO `pronosticos` VALUES ('aperez', '1', '1', '0');
INSERT INTO `pronosticos` VALUES ('aperez', '1', '2', '1');
INSERT INTO `pronosticos` VALUES ('aperez', '1', '5', '1');
INSERT INTO `pronosticos` VALUES ('aperez', '1', '6', '0');
INSERT INTO `pronosticos` VALUES ('aperez', '2', '1', '2');
INSERT INTO `pronosticos` VALUES ('aperez', '2', '2', '2');
INSERT INTO `pronosticos` VALUES ('aperez', '2', '5', '1');
INSERT INTO `pronosticos` VALUES ('aperez', '2', '6', '2');
INSERT INTO `pronosticos` VALUES ('aperez', '3', '1', '4');
INSERT INTO `pronosticos` VALUES ('aperez', '3', '2', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '3', '5', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '3', '6', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '5', '1', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '5', '2', '3');
INSERT INTO `pronosticos` VALUES ('aperez', '5', '5', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '5', '6', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '21', '1', '3');
INSERT INTO `pronosticos` VALUES ('aperez', '21', '2', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '21', '5', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '21', '6', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '23', '1', '1');
INSERT INTO `pronosticos` VALUES ('aperez', '23', '2', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '23', '5', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '23', '6', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '24', '1', '2');
INSERT INTO `pronosticos` VALUES ('aperez', '24', '2', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '24', '5', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '24', '6', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '31', '1', '3');
INSERT INTO `pronosticos` VALUES ('aperez', '31', '2', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '31', '5', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '31', '6', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '39', '1', '2');
INSERT INTO `pronosticos` VALUES ('aperez', '39', '2', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '39', '5', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '39', '6', '-');
INSERT INTO `pronosticos` VALUES ('aperez', '46', '1', '4');
INSERT INTO `pronosticos` VALUES ('aperez', '46', '2', '1');
INSERT INTO `pronosticos` VALUES ('aperez', '46', '5', '2');
INSERT INTO `pronosticos` VALUES ('aperez', '46', '6', '0');
INSERT INTO `pronosticos` VALUES ('pinky', '1', '1', '2');
INSERT INTO `pronosticos` VALUES ('pinky', '1', '2', '0');
INSERT INTO `pronosticos` VALUES ('pinky', '1', '5', '2');
INSERT INTO `pronosticos` VALUES ('pinky', '1', '6', '1');
INSERT INTO `pronosticos` VALUES ('vivi', '5', '1', '6');
INSERT INTO `pronosticos` VALUES ('vivi', '5', '2', '1');
INSERT INTO `pronosticos` VALUES ('vivi', '5', '5', '1');
INSERT INTO `pronosticos` VALUES ('vivi', '5', '6', '2');
INSERT INTO `pronosticos` VALUES ('vivi', '8', '1', '-');
INSERT INTO `pronosticos` VALUES ('vivi', '8', '2', '-');
INSERT INTO `pronosticos` VALUES ('vivi', '8', '5', '-');
INSERT INTO `pronosticos` VALUES ('vivi', '8', '6', '-');

-- ----------------------------
-- Table structure for `puntos`
-- ----------------------------
DROP TABLE IF EXISTS `puntos`;
CREATE TABLE `puntos` (
  `CodPron` int(11) NOT NULL,
  `NomPron` varchar(45) DEFAULT NULL,
  `ReglaPron` varchar(250) DEFAULT NULL,
  `Puntos` int(11) NOT NULL,
  `Valores` varchar(45) NOT NULL,
  PRIMARY KEY (`CodPron`),
  UNIQUE KEY `CodPron_UNIQUE` (`CodPron`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of puntos
-- ----------------------------
INSERT INTO `puntos` VALUES ('1', 'Tarjetas Amarillas', 'Acertar al total de las tarjetas amarillas', '2', '0,1,2,3,4,5,6,8,9');
INSERT INTO `puntos` VALUES ('2', 'Tarjetas Rojas', 'Acertar al total de las tarjetas Rojas', '2', '0,1,2,3,4,5,6');
INSERT INTO `puntos` VALUES ('5', 'Marcador $eq1', 'Acertar al marcador de $eq1', '4', '0,1,2,3,4,5,6,7,8,9,10');
INSERT INTO `puntos` VALUES ('6', 'Marcador $eq2', 'Acertar al marcador de $eq2', '4', '0,1,2,3,4,5,6,7,8,9,10');

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
INSERT INTO `resultados` VALUES ('1', '1', '0');
INSERT INTO `resultados` VALUES ('1', '2', '3');
INSERT INTO `resultados` VALUES ('1', '5', '1');
INSERT INTO `resultados` VALUES ('1', '6', '0');
