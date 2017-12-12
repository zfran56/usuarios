/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : base

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-02-04 20:23:43
*/

SET FOREIGN_KEY_CHECKS=0;
create database usadmin;
  use usadmin;
-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `apellido` varchar(200) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nivel` int(2) DEFAULT NULL,
  `estado` int(2) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('juanbza', 'Juan Ernesto', 'Bonilla', '06391280033e09ef60ef6ee34944cb48', '1', '1', '2016-02-05 03:20:44');
INSERT INTO `usuarios` VALUES ('lrivas', 'Luis Humberto', 'Rivas', 'c6533171534ecbc58fb0c7a8de7af505', '0', '1', '2011-04-12 14:17:38');
INSERT INTO `usuarios` VALUES ('webtool', 'Administrador del Nuevo', 'Sistema', '6034931cc11d4cd2bebf1d7d9c5af667', '1', '1', '2015-10-16 02:55:01');
