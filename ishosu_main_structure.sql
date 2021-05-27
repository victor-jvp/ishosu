/*
 Navicat Premium Data Transfer

 Source Server         : Localhost MySql
 Source Server Type    : MySQL
 Source Server Version : 50731
 Source Host           : localhost:3306
 Source Schema         : ishosu_main

 Target Server Type    : MySQL
 Target Server Version : 50731
 File Encoding         : 65001

 Date: 26/05/2021 20:06:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for banks
-- ----------------------------
DROP TABLE IF EXISTS `banks`;
CREATE TABLE `banks`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for estaciones
-- ----------------------------
DROP TABLE IF EXISTS `estaciones`;
CREATE TABLE `estaciones`  (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CODIGO` varchar(5) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `NOMBRE_USUARIO` varchar(105) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT NULL,
  `ACTIVO` bit(1) NULL DEFAULT b'1',
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for recibos_cab
-- ----------------------------
DROP TABLE IF EXISTS `recibos_cab`;
CREATE TABLE `recibos_cab`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_relacion` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `FECHA` datetime(0) NOT NULL,
  `TIPO_MONEDA` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TIPO_PAGO` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TIPO_DOC` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `NUMEDOCU` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `MONTO_DOC_VEF` double NULL DEFAULT NULL,
  `MONTO_DOC_USD` double NULL DEFAULT NULL,
  `MONTO_DOC_RET` double NULL DEFAULT NULL,
  `TASA_CAMB` double NULL DEFAULT NULL,
  `VUELTO` double NULL DEFAULT NULL,
  `SALDO_DOC` double NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `recibos_cab_id_relacion_foreign`(`id_relacion`) USING BTREE,
  INDEX `recibos_cab_created_by_foreign`(`created_by`) USING BTREE,
  INDEX `recibos_cab_updated_by_foreign`(`updated_by`) USING BTREE,
  CONSTRAINT `recibos_cab_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `recibos_cab_id_relacion_foreign` FOREIGN KEY (`id_relacion`) REFERENCES `relaciones` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `recibos_cab_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for recibos_det
-- ----------------------------
DROP TABLE IF EXISTS `recibos_det`;
CREATE TABLE `recibos_det`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_recibo` bigint(20) UNSIGNED NOT NULL,
  `CANTIDAD` int(11) NULL DEFAULT NULL,
  `DENOMINACION` double NULL DEFAULT NULL,
  `REFERENCIA` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `FECHA_PAGO` date NULL DEFAULT NULL,
  `bank_id_e` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `bank_id_r` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `MONTO` double NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `recibos_det_id_recibo_foreign`(`id_recibo`) USING BTREE,
  INDEX `recibos_det_bank_id_e_foreign`(`bank_id_e`) USING BTREE,
  INDEX `recibos_det_bank_id_r_foreign`(`bank_id_r`) USING BTREE,
  CONSTRAINT `recibos_det_bank_id_e_foreign` FOREIGN KEY (`bank_id_e`) REFERENCES `banks` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `recibos_det_bank_id_r_foreign` FOREIGN KEY (`bank_id_r`) REFERENCES `banks` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `recibos_det_id_recibo_foreign` FOREIGN KEY (`id_recibo`) REFERENCES `recibos_cab` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for relaciones
-- ----------------------------
DROP TABLE IF EXISTS `relaciones`;
CREATE TABLE `relaciones`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `FECHA` date NOT NULL,
  `TIPO_MONEDA` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `COMENTARIO` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `relaciones_created_by_foreign`(`created_by`) USING BTREE,
  INDEX `relaciones_updated_by_foreign`(`updated_by`) USING BTREE,
  CONSTRAINT `relaciones_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `relaciones_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tcpca
-- ----------------------------
DROP TABLE IF EXISTS `tcpca`;
CREATE TABLE `tcpca`  (
  `CODICLIE` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `CODIVIEJ` varchar(15) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NOMBCLIE` varchar(120) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CADECLIE` varchar(7) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `RAZOSOCI` varchar(120) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NOMBPROP` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NOMBENCA` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `RIF` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NIT` varchar(18) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CEDUPROP` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DIRECCION1` varchar(120) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DIRECCION2` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DIRECCION3` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DIRECCION4` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODICIUD` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIESTA` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIMUNI` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIPARR` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIURBA` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TELEFONO1` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TELEFONO2` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `FAX` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIPOST` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `GRUPCANA` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TIPOCLIE` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `REGION` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIRUTA` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIRUTA2` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIRUTA3` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIZONA` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CONFINAL` int(11) NULL DEFAULT 0,
  `DIAVISI` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `ESTRSOCI` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `FRECUEN` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `GRUPFREC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `SECUEN` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TIPOFACT` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TIPOPREC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DIASCRED` double(5, 0) NULL DEFAULT 0,
  `DIACOBR` varchar(5) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DIAPRES` varchar(5) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `HORADESP` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DIADESP` varchar(5) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NODESP` varchar(5) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `FAPECLIE` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `FAPECRED` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `NUMECHDV` double(4, 0) NULL DEFAULT 0,
  `FSUSCHEQ` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `NUMEATRA` double(4, 0) NULL DEFAULT 0,
  `FSUSCRED` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `SERVMERC` int(11) NULL DEFAULT 0,
  `IVENBRU1` double(18, 2) NULL DEFAULT 0.00,
  `IVENNET2` double(18, 2) NULL DEFAULT 0.00,
  `IVENBRU3` double(18, 2) NULL DEFAULT 0.00,
  `CODIALMA` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `COUTCLIE` double(12, 0) NULL DEFAULT 0,
  `NUMEFACA` double(5, 0) NULL DEFAULT 0,
  `NUMEFAC1` double(5, 0) NULL DEFAULT 0,
  `NUMEFAC2` double(5, 0) NULL DEFAULT 0,
  `NUMEFAC3` double(5, 0) NULL DEFAULT 0,
  `NUMEFAC4` double(5, 0) NULL DEFAULT 0,
  `NUMEFAC5` double(5, 0) NULL DEFAULT 0,
  `NUMEFAC6` double(5, 0) NULL DEFAULT 0,
  `NUMEFAC7` double(5, 0) NULL DEFAULT 0,
  `NUMEFAC8` double(5, 0) NULL DEFAULT 0,
  `NUMEFAC9` double(5, 0) NULL DEFAULT 0,
  `NUMEFAC10` double(5, 0) NULL DEFAULT 0,
  `NUMEFAC11` double(5, 0) NULL DEFAULT 0,
  `NUMEFAC12` double(5, 0) NULL DEFAULT 0,
  `NUMEFAC13` double(5, 0) NULL DEFAULT 0,
  `VENTMESA` double(12, 0) NULL DEFAULT 0,
  `VENTMES1` double(12, 0) NULL DEFAULT 0,
  `VENTMES2` double(12, 0) NULL DEFAULT 0,
  `VENTMES3` double(12, 0) NULL DEFAULT 0,
  `VENTMES4` double(12, 0) NULL DEFAULT 0,
  `VENTMES5` double(12, 0) NULL DEFAULT 0,
  `VENTMES6` double(12, 0) NULL DEFAULT 0,
  `VENTMES7` double(12, 0) NULL DEFAULT 0,
  `VENTMES8` double(12, 0) NULL DEFAULT 0,
  `VENTMES9` double(12, 0) NULL DEFAULT 0,
  `VENTMES10` double(12, 0) NULL DEFAULT 0,
  `VENTMES11` double(12, 0) NULL DEFAULT 0,
  `VENTMES12` double(12, 0) NULL DEFAULT 0,
  `VENTMES13` double(12, 0) NULL DEFAULT 0,
  `VENTCAJA` double(6, 0) NULL DEFAULT 0,
  `VENTCAJ1` double(6, 0) NULL DEFAULT 0,
  `VENTCAJ2` double(6, 0) NULL DEFAULT 0,
  `VENTCAJ3` double(6, 0) NULL DEFAULT 0,
  `VENTCAJ4` double(6, 0) NULL DEFAULT 0,
  `VENTCAJ5` double(6, 0) NULL DEFAULT 0,
  `VENTCAJ6` double(6, 0) NULL DEFAULT 0,
  `VENTCAJ7` double(6, 0) NULL DEFAULT 0,
  `VENTCAJ8` double(6, 0) NULL DEFAULT 0,
  `VENTCAJ9` double(6, 0) NULL DEFAULT 0,
  `VENTCAJ10` double(6, 0) NULL DEFAULT 0,
  `VENTCAJ11` double(6, 0) NULL DEFAULT 0,
  `VENTCAJ12` double(6, 0) NULL DEFAULT 0,
  `VENTCAJ13` double(6, 0) NULL DEFAULT 0,
  `NUMEACTI` double(4, 0) NULL DEFAULT 0,
  `SALDO` double(16, 2) NULL DEFAULT 0.00,
  `FULTICOMP` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `FCAMBCANA` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `FECHFREC` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `DESACTIV` int(11) NULL DEFAULT 0,
  `FECHDESA` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `FECHACTI` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `MAXVENCJ` double(12, 0) NULL DEFAULT 0,
  `MAXVENBS` double(16, 2) NULL DEFAULT 0.00,
  `MINVENCJ` double(12, 0) NULL DEFAULT 0,
  `MINVENBS` double(16, 2) NULL DEFAULT 0.00,
  `NUMELICE` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `FORMPAGO1` double(3, 0) NULL DEFAULT 0,
  `FORMPAGO2` double(3, 0) NULL DEFAULT 0,
  `DIASCRED2` double(5, 0) NULL DEFAULT 0,
  `DIASCRED3` double(5, 0) NULL DEFAULT 0,
  `LIMICRED2` double(16, 0) NULL DEFAULT 0,
  `LIMICRED3` double(16, 0) NULL DEFAULT 0,
  `TIPOPREC2` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TIPOPREC3` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EXCEIMPU` int(11) NULL DEFAULT 0,
  `BLOQCLIE` int(11) NULL DEFAULT 0,
  `CREDESPE` int(11) NULL DEFAULT 0,
  `PORRETCO` double(8, 2) NULL DEFAULT 0.00,
  `PORPERCI` double(8, 2) NULL DEFAULT 0.00,
  `COMENT` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL,
  `CCADENA` varchar(6) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CLIECONS` int(11) NULL DEFAULT 0,
  `CODIGCLI` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CLIEDIST` int(11) NULL DEFAULT 0,
  `SELEPREC` int(11) NULL DEFAULT 0,
  `TIEMPOE` double(6, 2) NULL DEFAULT 0.00,
  `TIPOFOND` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `MONTFOND` double(16, 2) NULL DEFAULT 0.00,
  `FECHUPAG` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `CLIECADE` int(11) NULL DEFAULT 0,
  `ASUMEDEV` int(11) NULL DEFAULT 0,
  `INCEPROM` int(11) NULL DEFAULT 0,
  `CLIEVEND` int(11) NULL DEFAULT 0,
  `CONCENAC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `ACTIVIDAD` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TRANSFER` int(11) NULL DEFAULT 0,
  `VENTORAC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `VENTORTR` int(11) NULL DEFAULT 0,
  `CONCENTR` int(11) NULL DEFAULT 0,
  `EMAIL1` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EMAIL2` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NICK` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CLAVE` varchar(15) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `SUBGCLIE` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `FECHAN` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `NACIONALIDAD` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `SEXO` double(1, 0) NULL DEFAULT 0,
  `EDOCIVIL` double(1, 0) NULL DEFAULT 0,
  `GRADOINSTRU` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `PROFESION` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `ANIBODA` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `TIPOVIVIENDA` double(1, 0) NULL DEFAULT 0,
  `PUNTOREFE` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `RESIDENCIA` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NUMEROAPTO` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIGOPOSTAL` varchar(4) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NHIJOS` double(2, 0) NULL DEFAULT 0,
  `CODIMENS` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `LATITUD` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `LONGITUD` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODICONT` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIBANC` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `BCP` int(11) NULL DEFAULT 0,
  `VERIRIF` int(11) NULL DEFAULT 0,
  `COMENT1` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `COMENT2` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `COMENT3` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `COMENT4` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `ENVIAPAGO` int(11) NULL DEFAULT 0,
  `ENVIAMAIL` text CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL,
  `CDOS` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CONTESPE` int(11) NULL DEFAULT 0,
  `CAJACOMP` int(11) NULL DEFAULT 0,
  `AFILIADO` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODISEGM` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DIADECAJA` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CLASS1` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CLASS2` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EMAIL` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `AGENTERET` int(11) NULL DEFAULT 0,
  `SADA` int(11) NULL DEFAULT 0,
  `CVACIO` int(11) NULL DEFAULT 0,
  `VENCLICE` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `BLOQGRUP` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODICARG` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DIRECCION5` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `PAGOELEC` int(11) NULL DEFAULT 0,
  `NUMEXT` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NUMINT` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TELEFSMS` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `MENSASMS` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `SERIAL` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CLAVMODU` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CLAVACTI` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `REGIMENF` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CTEXPORT` int(11) NULL DEFAULT 0,
  `DIRESCANC` varchar(254) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `RF` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NJ` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TIPOID` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIPAIS` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `PRINOM` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `PRIAPE` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `SEGNOM` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `SEGAPE` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DIGIVERIF` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  PRIMARY KEY (`CODICLIE`) USING BTREE,
  INDEX `TCPCA2`(`TIPOCLIE`) USING BTREE,
  INDEX `TCPCA3`(`CODIGCLI`) USING BTREE,
  INDEX `TCPCA4`(`CODIZONA`) USING BTREE,
  INDEX `TCPCA5`(`CODICIUD`) USING BTREE,
  INDEX `TCPCA6`(`CODIVIEJ`) USING BTREE,
  INDEX `TCPCA7`(`CODIGCLI`, `SUBGCLIE`, `TIPOCLIE`) USING BTREE,
  INDEX `TCPCA8`(`NOMBCLIE`) USING BTREE,
  CONSTRAINT `FK_TCPCA_RELATIONS_TCIUA` FOREIGN KEY (`CODICIUD`) REFERENCES `tciua` (`CODICIUD`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `FK_TCPCA_RELATIONS_TCLIA` FOREIGN KEY (`TIPOCLIE`) REFERENCES `tclia` (`TIPOCLIE`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `FK_TCPCA_RELATIONS_TCLIB` FOREIGN KEY (`CODIGCLI`) REFERENCES `tclib` (`CODIGCLI`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `FK_TCPCA_RELATIONS_TZONA` FOREIGN KEY (`CODIZONA`) REFERENCES `tzona` (`CODIZONA`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_spanish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tcpcz
-- ----------------------------
DROP TABLE IF EXISTS `tcpcz`;
CREATE TABLE `tcpcz`  (
  `TIPO` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `DESCDOCU` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `SIGNO` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NUMAUT` int(11) NULL DEFAULT 0,
  `LETRA` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NUMERO` double(10, 0) NULL DEFAULT 0,
  `TIPOCOMP` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `ULTIFECH` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `NUMECONT` double(10, 0) NULL DEFAULT 0,
  `TIPO2` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CONTROL` int(11) NULL DEFAULT 0,
  `CONCEPTO` int(11) NULL DEFAULT 0,
  `PERFECH` int(11) NULL DEFAULT 0,
  `CODCON` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NUMECOMP` double(5, 0) NULL DEFAULT 0,
  `NIVEL` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CONCENAC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `ACTIVIDAD` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TRANSFER` int(11) NULL DEFAULT 0,
  `VENTORAC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `VENTORTR` int(11) NULL DEFAULT 0,
  `CONCENTR` int(11) NULL DEFAULT 0,
  `CODIALMA` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `PULTICIER` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `DESDE` double(9, 0) NULL DEFAULT 0,
  `HASTA` double(9, 0) NULL DEFAULT 0,
  `RESOLUCION` varchar(15) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `FECHARESO` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `PREFIX` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  PRIMARY KEY (`TIPO`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_spanish_ci ROW_FORMAT = Dynamic;

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
  `FECHA` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `FECHVENC` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
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
  `FECHPEDI` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
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
  `FRESOLU` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
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

-- ----------------------------
-- Table structure for tfacnda
-- ----------------------------
DROP TABLE IF EXISTS `tfacnda`;
CREATE TABLE `tfacnda`  (
  `TIPODOCU` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `NUMEDOCU` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `CODICLIE` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIRUTA` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `FECHA` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `FECHVENC` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `TOTABRUT` double(16, 2) NULL DEFAULT 0.00,
  `IMPUBRUT` double(16, 2) NULL DEFAULT 0.00,
  `TOTADOCU` double(16, 2) NULL DEFAULT 0.00,
  `TOTACOST` double(16, 2) NULL DEFAULT 0.00,
  `IMPU1` double(14, 2) NULL DEFAULT 0.00,
  `NUMEPEDI` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NULA` int(11) NULL DEFAULT 0,
  `MOTIANUL` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NUMEGUIA` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NUMEFACT` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `BOLIREG` double(16, 2) NULL DEFAULT 0.00,
  `DOLARES` int(11) NULL DEFAULT 0,
  `NCDESDE` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NCHASTA` varchar(9) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TOTADEVO` double(16, 2) NULL DEFAULT 0.00,
  `DEVOTOTA` int(11) NULL DEFAULT 0,
  `CONCENAC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `ACTIVIDAD` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TRANSFER` int(11) NULL DEFAULT 0,
  `VENTORAC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `VENTORTR` int(11) NULL DEFAULT 0,
  `CONCENTR` int(11) NULL DEFAULT 0,
  `CODIALMA` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `LOGIN` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DESCUENTOG` double(16, 2) NULL DEFAULT 0.00,
  `PORCGLOB` double(6, 2) NULL DEFAULT 0.00,
  `CODIGLOB` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DESCUENTG2` double(16, 2) NULL DEFAULT 0.00,
  `PORCGLO2` double(6, 2) NULL DEFAULT 0.00,
  `CODIGLO2` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `LISAEA` double(16, 2) NULL DEFAULT 0.00,
  `LISAEA2` double(16, 2) NULL DEFAULT 0.00,
  `LISAEANO` int(11) NULL DEFAULT 0,
  `MONEDA` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CAMBDOL` double(18, 8) NULL DEFAULT 0.00000000,
  PRIMARY KEY (`TIPODOCU`, `NUMEDOCU`) USING BTREE,
  INDEX `TFACNDA2`(`CODICLIE`, `CODIRUTA`) USING BTREE,
  CONSTRAINT `FK_TFACNDA_RELATIONS_TCPCARUT` FOREIGN KEY (`CODICLIE`, `CODIRUTA`) REFERENCES `tcpcarut` (`CODICLIE`, `CODIRUTA`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_spanish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tipos_recibo
-- ----------------------------
DROP TABLE IF EXISTS `tipos_recibo`;
CREATE TABLE `tipos_recibo`  (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `DESCR` varchar(55) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT NULL,
  `ACTIVO` bit(1) NULL DEFAULT b'1',
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for truta
-- ----------------------------
DROP TABLE IF EXISTS `truta`;
CREATE TABLE `truta`  (
  `CODIRUTA` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `CODISUPE` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NOMBVEND` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CEDUVEND` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `DIREVEND` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `PRIORUTA` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `FIJOVEND` double(16, 2) NULL DEFAULT 0.00,
  `VARIVEND` double(16, 2) NULL DEFAULT 0.00,
  `SUPEVEN2` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TELEVEND` varchar(15) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `ALMAVEND` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TIPORUTA` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `GRUPCANA` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CAJADIA` double(13, 3) NULL DEFAULT 0.000,
  `UNIDDIA` double(11, 0) NULL DEFAULT 0,
  `BOLIDIA` double(16, 2) NULL DEFAULT 0.00,
  `DCAJADIA` double(13, 3) NULL DEFAULT 0.000,
  `DUNIDDIA` double(11, 0) NULL DEFAULT 0,
  `DBOLIDIA` double(16, 2) NULL DEFAULT 0.00,
  `CUOTMES` double(11, 0) NULL DEFAULT 0,
  `CUOT473` double(11, 0) NULL DEFAULT 0,
  `CUOT946` double(11, 0) NULL DEFAULT 0,
  `CUOTEFEC` double(6, 2) NULL DEFAULT 0.00,
  `CUOTACTI` double(6, 2) NULL DEFAULT 0.00,
  `CUOTPROD` double(6, 2) NULL DEFAULT 0.00,
  `CUOTRECH` double(6, 2) NULL DEFAULT 0.00,
  `CUOTVENC` double(6, 2) NULL DEFAULT 0.00,
  `CUOTROTO` double(6, 2) NULL DEFAULT 0.00,
  `CUOTVISI` double(6, 2) NULL DEFAULT 0.00,
  `CUOTDROP` double(7, 0) NULL DEFAULT 0,
  `ACTICLIE` double(3, 0) NULL DEFAULT 0,
  `CUOTCRED` double(6, 2) NULL DEFAULT 0.00,
  `CUOTCONT` double(6, 2) NULL DEFAULT 0.00,
  `DIASINVE` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CLASRUTA` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NUMEPEDI` double(9, 0) NULL DEFAULT 0,
  `LETRA` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `LETRAREC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NUMEREC` double(9, 0) NULL DEFAULT 0,
  `SERIAL` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CLAVACTI` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `AREAGEOG` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CONCENAC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `ACTIVIDAD` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TRANSFER` int(11) NULL DEFAULT 0,
  `VENTORAC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `VENTORTR` int(11) NULL DEFAULT 0,
  `CONCENTR` int(11) NULL DEFAULT 0,
  `NICK` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CLAVE` varchar(15) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EMAIL1` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `EMAIL2` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIVIEJ` varchar(3) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CODIALMA` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `FECHCONF` timestamp(0) NULL DEFAULT '0000-00-00 00:00:00',
  `DEPOCUST` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `LETRDEVO` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NUMEDEVO` double(9, 0) NULL DEFAULT 0,
  `CLAVACTI2` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `MAC` varchar(25) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TIPOEQ` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `RUTAMAES` int(11) NULL DEFAULT 0,
  `PIDEPREC` int(11) NULL DEFAULT 0,
  `NOCOBRAR` int(11) NULL DEFAULT 0,
  `EMAILVEN` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NCONTROL` double(9, 0) NULL DEFAULT 0,
  `COMXHORA` double(16, 2) NULL DEFAULT 0.00,
  `PXHORA` double(6, 2) NULL DEFAULT 0.00,
  PRIMARY KEY (`CODIRUTA`) USING BTREE,
  INDEX `TRUTA2`(`CODISUPE`) USING BTREE,
  CONSTRAINT `FK_TRUTA_RELATIONS_TSUPA` FOREIGN KEY (`CODISUPE`) REFERENCES `tsupa` (`CODISUPE`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_spanish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Table structure for tuser
-- ----------------------------
DROP TABLE IF EXISTS `tuser`;
CREATE TABLE `tuser`  (
  `LOGIN` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `NOMBRE` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `NIVEL` double(3, 0) NULL DEFAULT 0,
  `CLAVE` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `LOGINPRE` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `CAMBSEC` int(11) NULL DEFAULT 0,
  `NOCAMB` int(11) NULL DEFAULT 0,
  `NOACTIVO` int(11) NULL DEFAULT 0,
  `CONCENAC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `ACTIVIDAD` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `TRANSFER` int(11) NULL DEFAULT 0,
  `VENTORAC` varchar(1) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  `VENTORTR` int(11) NULL DEFAULT 0,
  `CONCENTR` int(11) NULL DEFAULT 0,
  `CODIALMA` varchar(2) CHARACTER SET latin1 COLLATE latin1_spanish_ci NULL DEFAULT ' ',
  PRIMARY KEY (`LOGIN`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(105) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
