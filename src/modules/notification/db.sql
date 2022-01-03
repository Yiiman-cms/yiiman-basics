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

 Date: 03/06/2021 12:50:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for module_notification_messages
-- ----------------------------
DROP TABLE IF EXISTS `module_notification_messages`;
CREATE TABLE `module_notification_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT 'دریافت کننده',
  `message` varchar(1000) NOT NULL COMMENT 'متن پیام',
  `target_module` varchar(300) NOT NULL COMMENT 'کلاس ماژول مربوط به مسیج',
  `module_id` int(11) DEFAULT NULL COMMENT 'آي دی کلاس ماژول مربوطه',
  `notif_channel` varchar(300) NOT NULL COMMENT 'کانال مسیج(روش ارسال)',
  `created_at` datetime NOT NULL COMMENT 'تاریخ ثبت',
  `created_by` int(11) NOT NULL COMMENT 'فرستنده',
  `details_json` longtext NOT NULL COMMENT 'اطلاعات مسیج برای کلاس کانال',
  `status` tinyint(1) NOT NULL COMMENT 'وضعیت ارسال',
  `sent_at` datetime DEFAULT NULL COMMENT 'تاریخ ارسال',
  `send_error` varchar(700) DEFAULT NULL COMMENT 'خطای بوجود امده حین ارسال',
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `module_notification_messages_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `module_user_admin` (`id`),
  CONSTRAINT `module_notification_messages_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `module_user` (`id`),
  CONSTRAINT `module_notification_messages_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `module_user_admin` (`id`),
  CONSTRAINT `module_notification_messages_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `module_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for module_notification_users_settings
-- ----------------------------
DROP TABLE IF EXISTS `module_notification_users_settings`;
CREATE TABLE `module_notification_users_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `options` longtext NOT NULL,
  `language` int(11) DEFAULT NULL,
  `language_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `module_notification_users_settings_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `module_user_admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `module_notification_users_settings_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `module_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
