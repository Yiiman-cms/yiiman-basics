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

 Date: 29/05/2021 12:20:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for module_rbac_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `module_rbac_auth_assignment`;
CREATE TABLE `module_rbac_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`) USING BTREE,
  KEY `idx-auth_assignment-user_id` (`user_id`) USING BTREE,
  CONSTRAINT `module_rbac_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `module_rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for module_rbac_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `module_rbac_auth_item`;
CREATE TABLE `module_rbac_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `module_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_fa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE,
  KEY `rule_name` (`rule_name`) USING BTREE,
  KEY `idx-auth_item-type` (`type`) USING BTREE,
  CONSTRAINT `module_rbac_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `module_rbac_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for module_rbac_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `module_rbac_auth_item_child`;
CREATE TABLE `module_rbac_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`parent`,`child`) USING BTREE,
  KEY `child` (`child`) USING BTREE,
  CONSTRAINT `module_rbac_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `module_rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `module_rbac_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `module_rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for module_rbac_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `module_rbac_auth_rule`;
CREATE TABLE `module_rbac_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for module_rbac_pages
-- ----------------------------
DROP TABLE IF EXISTS `module_rbac_pages`;
CREATE TABLE `module_rbac_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `register_time` datetime NOT NULL,
  `status_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for module_rbac_role
-- ----------------------------
DROP TABLE IF EXISTS `module_rbac_role`;
CREATE TABLE `module_rbac_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL,
  `RegisterTime` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;
