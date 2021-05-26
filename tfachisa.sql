/*
 Navicat Premium Data Transfer

 Source Server         : distrishosu.ddns.net_DEFAULT
 Source Server Type    : MySQL
 Source Server Version : 50519
 Source Host           : distrishosu.ddns.net:3306
 Source Schema         : ventoradm001

 Target Server Type    : MySQL
 Target Server Version : 50519
 File Encoding         : 65001

 Date: 26/05/2021 00:36:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tfachisa
-- ----------------------------
DROP TABLE IF EXISTS `tfachisa`;
CREATE TABLE `tfachisa`  (
  `TIPODOCU` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `NUMEDOCU` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `LINENUME` varchar(6) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODICLIE` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIRUTA` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `FECHA` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `FECHVENC` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DESCUENTOG` double(16, 2) NULL DEFAULT 0.00,
  `TOTABRUT` double(16, 2) NULL DEFAULT 0.00,
  `IMPUBRUT` double(16, 2) NULL DEFAULT 0.00,
  `LISAEA` double(16, 2) NULL DEFAULT 0.00,
  `IMPU1` double(14, 2) NULL DEFAULT 0.00,
  `TOTADOCU` double(16, 2) NULL DEFAULT 0.00,
  `TOTACOST` double(16, 2) NOT NULL DEFAULT 0.00,
  `DCTOGME` double(10, 2) NULL DEFAULT 0.00,
  `TBRUTME` double(15, 2) NULL DEFAULT 0.00,
  `IMPUBME` double(15, 2) NULL DEFAULT 0.00,
  `TDOCUME` double(15, 2) NULL DEFAULT 0.00,
  `TCOSTME` double(15, 2) NULL DEFAULT 0.00,
  `NUMEPEDI` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `FECHPEDI` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `NULA` int(11) NULL DEFAULT 0,
  `MOTIANUL` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL,
  `NUMEGUIA` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NOTAENTR` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NUMEFACT` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TOTADEVO` double(16, 2) NULL DEFAULT 0.00,
  `TOTADEVB` double(16, 2) NULL DEFAULT 0.00,
  `IMPUDEVO` double(16, 2) NULL DEFAULT 0.00,
  `PORCGLOB` double(6, 2) NULL DEFAULT 0.00,
  `GRUPFACT` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `ESTADO` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DEVOTOTA` int(11) NULL DEFAULT 0,
  `TOTANOTA` double(16, 2) NULL DEFAULT 0.00,
  `IMPUNOTA` double(16, 2) NULL DEFAULT 0.00,
  `NCDESDE` varchar(15) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NCHASTA` varchar(15) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `LOGIN` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CANCCONT` int(11) NULL DEFAULT 0,
  `MONEDA` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DOLARES` int(11) NULL DEFAULT 0,
  `MENSAJE` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL,
  `CAMBDOL` double(18, 8) NULL DEFAULT 0.00000000,
  `CODIGLOB` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NUMEDOCU2` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `LISAEANO` int(11) NULL DEFAULT 0,
  `PRELOT` int(11) NULL DEFAULT 0,
  `LOGIN2` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `HORA` varchar(8) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `MONFONDO` double(16, 2) NULL DEFAULT 0.00,
  `DESCUENTG2` double(16, 2) NULL DEFAULT 0.00,
  `LISAEA2` double(16, 2) NULL DEFAULT 0.00,
  `PORCGLO2` double(6, 2) NULL DEFAULT 0.00,
  `CODIGLO2` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CONCENAC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `ACTIVIDAD` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TRANSFER` double(1, 0) NULL DEFAULT 0,
  `VENTORAC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `VENTORTR` int(11) NULL DEFAULT 0,
  `CONCENTR` int(11) NULL DEFAULT 0,
  `ORDENC` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CONTROLF` varchar(15) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `SERIALF` varchar(51) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIOPER` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NUMCORTE` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIALMA` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODICAJA` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `IEPSBRUT` double(16, 2) NULL DEFAULT 0.00,
  `ESTACION` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `BASEPERCI` double(16, 2) NULL DEFAULT 0.00,
  `IVAPERCI` double(16, 2) NULL DEFAULT 0.00,
  `TOTIMPLIC` double(16, 2) NULL DEFAULT 0.00,
  `CODICARG` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TOTACARG` double(16, 2) NULL DEFAULT 0.00,
  `IMPUCARG` double(16, 2) NULL DEFAULT 0.00,
  `NEFECTIVO` int(11) NULL DEFAULT 0,
  `IEPSDEVO` double(12, 2) NULL DEFAULT 0.00,
  `CC` int(11) NULL DEFAULT 0,
  `EXP1` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EXP2` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EXP3` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EXP4` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EXP5` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EXP6` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EXP7` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EXP8` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EXP9` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EXP10` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EXP11` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EXP12` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NRESOLU` varchar(15) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `FRESOLU` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DESDE` double(9, 0) NULL DEFAULT 0,
  `HASTA` double(9, 0) NULL DEFAULT 0,
  `CUFE` varchar(254) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DIAN_STATUS` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `PREFIX` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EMAIL_STATUS` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `UUID` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  PRIMARY KEY (`TIPODOCU`, `NUMEDOCU`) USING BTREE,
  INDEX `TFACHISA2`(`CODICLIE`, `CODIRUTA`) USING BTREE,
  INDEX `TFACHISA3`(`TIPODOCU`, `NUMEDOCU`, `LINENUME`) USING BTREE,
  INDEX `TFACHISA4`(`TIPODOCU`) USING BTREE,
  INDEX `TFACHISA6`(`CODICLIE`) USING BTREE,
  INDEX `TFACHISA7`(`LOGIN`) USING BTREE,
  INDEX `TFACHISA8`(`TRANSFER`) USING BTREE,
  INDEX `TFACHISA9`(`NUMEGUIA`) USING BTREE,
  INDEX `FK_TFACHISA_RELATIONS_TRUTA`(`CODIRUTA`) USING BTREE,
  CONSTRAINT `FK_TFACHISA_RELATIONS_TCPCA` FOREIGN KEY (`CODICLIE`) REFERENCES `tcpca` (`CODICLIE`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `FK_TFACHISA_RELATIONS_TCPCZ` FOREIGN KEY (`TIPODOCU`) REFERENCES `tcpcz` (`TIPO`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `FK_TFACHISA_RELATIONS_TRUTA` FOREIGN KEY (`CODIRUTA`) REFERENCES `truta` (`CODIRUTA`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_spanish_ci ROW_FORMAT = COMPACT;

SET FOREIGN_KEY_CHECKS = 1;
