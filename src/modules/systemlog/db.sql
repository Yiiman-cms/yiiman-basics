/*
 Navicat Premium Data Transfer

 Source Server         : loca
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : medicard

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 06/06/2021 01:30:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for module_systemlog
-- ----------------------------
DROP TABLE IF EXISTS `module_systemlog`;
CREATE TABLE `module_systemlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) DEFAULT NULL COMMENT 'سطح',
  `category` varchar(255) DEFAULT NULL COMMENT 'دسته',
  `log_time` datetime DEFAULT NULL COMMENT 'زمان ثبت',
  `prefix` longtext DEFAULT NULL COMMENT 'پیشوند',
  `message` longtext CHARACTER SET utf8 DEFAULT NULL COMMENT 'پیام',
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL COMMENT 'آی پی',
  `uid` int(11) DEFAULT NULL COMMENT 'کاربر',
  `session_id` varchar(255) DEFAULT NULL COMMENT 'شناسه ی نشست',
  `app_name` varchar(50) DEFAULT NULL COMMENT 'نام برنامه',
  `session_details` varchar(2000) DEFAULT NULL COMMENT 'اطلاعات سشن',
  `last_error` longtext DEFAULT NULL COMMENT 'آخرین خطای رخ داده',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_log_level` (`level`) USING BTREE,
  KEY `idx_log_category` (`category`) USING BTREE,
  KEY `uid` (`uid`),
  CONSTRAINT `module_systemlog_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `module_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `module_systemlog_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `module_user_admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;
