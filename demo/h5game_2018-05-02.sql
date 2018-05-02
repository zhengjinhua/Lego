# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 115.159.40.167 (MySQL 5.7.17)
# Database: h5game
# Generation Time: 2018-05-02 12:18:57 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_user`;

CREATE TABLE `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL,
  `password` char(32) NOT NULL,
  `salt` char(8) NOT NULL DEFAULT '',
  `nickname` char(10) NOT NULL DEFAULT '' COMMENT '用户别名',
  `email` char(64) NOT NULL DEFAULT '',
  `lastip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `lasttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登入时间',
  `loginerrtimes` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '密码连续错误次数',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `createtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

LOCK TABLES `admin_user` WRITE;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;

INSERT INTO `admin_user` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `lastip`, `lasttime`, `loginerrtimes`, `status`, `createtime`, `updatetime`)
VALUES
	(3,'test','8fba7415658f01f596742e00650cbd1b','2c290577','','','127.0.0.1',1525263300,0,1,'2016-10-09 10:58:15','2018-05-02 20:15:00');

/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table auth_action
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_action`;

CREATE TABLE `auth_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(100) NOT NULL,
  `class` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `action` (`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `auth_action` WRITE;
/*!40000 ALTER TABLE `auth_action` DISABLE KEYS */;

INSERT INTO `auth_action` (`id`, `action`, `class`, `name`, `createtime`, `updatetime`)
VALUES
	(1,'\\Module\\Admin\\Controller\\User::index',0,'管理员-列表','2016-09-29 11:21:32','2018-01-04 17:13:33'),
	(2,'\\Module\\Admin\\Controller\\User::delete',0,'管理员-删除','2016-09-29 11:21:32','2018-01-04 17:13:34'),
	(3,'\\Module\\Admin\\Controller\\User::add',0,'管理员-添加','2016-09-29 11:21:32','2018-01-04 17:13:35'),
	(4,'\\Module\\Admin\\Controller\\User::update',0,'管理员-编辑','2016-09-29 11:21:32','2018-01-04 17:13:36'),
	(22,'\\Module\\Auth\\Controller\\Role::update',1,'权限-角色-编辑','2016-09-29 11:29:59','2017-11-17 10:40:25'),
	(23,'\\Module\\Auth\\Controller\\Role::delete',1,'权限-角色-删除','2016-09-29 11:29:59','2017-11-17 10:40:16'),
	(24,'\\Module\\Auth\\Controller\\Auth::user',1,'权限-用户授权','2016-09-29 11:29:59','2017-11-17 10:39:58'),
	(26,'\\Module\\Auth\\Controller\\Auth::userAuthX',1,'权限-用户授权','2016-09-29 11:29:59','2017-11-17 10:40:04'),
	(27,'\\Module\\Auth\\Controller\\Role::index',1,'权限-角色-列表','2016-09-29 11:40:22','2017-11-17 10:40:21'),
	(28,'\\Module\\Auth\\Controller\\Role::add',1,'权限-角色-添加','2016-09-29 11:40:22','2017-11-17 10:40:11'),
	(29,'\\Module\\Auth\\Controller\\Auth::action',1,'权限-角色授权','2016-09-29 11:44:16','2017-11-17 10:39:46'),
	(30,'\\Module\\Auth\\Controller\\Auth::actionAuthX',1,'权限-角色授权','2016-09-29 11:44:16','2017-11-17 10:39:53'),
	(31,'\\Module\\Auth\\Controller\\Action::initDbX',1,'权限-初始化','2016-09-29 11:47:27','2017-11-17 10:39:37'),
	(33,'\\Module\\Auth\\Controller\\UserLog::index',0,'管理员-日志','2017-10-30 18:42:20','2018-01-04 17:13:37'),
	(34,'\\Module\\Auth\\Controller\\Action::update',1,'权限-设置权限名','2018-01-04 17:31:04','2018-01-04 17:31:15');

/*!40000 ALTER TABLE `auth_action` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table auth_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_role`;

CREATE TABLE `auth_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL,
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `auth_role` WRITE;
/*!40000 ALTER TABLE `auth_role` DISABLE KEYS */;

INSERT INTO `auth_role` (`id`, `name`, `createtime`, `updatetime`)
VALUES
	(1,'超级管理员','2016-09-29 11:22:49','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `auth_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table auth_role_action
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_role_action`;

CREATE TABLE `auth_role_action` (
  `role_id` int(10) unsigned NOT NULL,
  `action_id` int(10) unsigned NOT NULL,
  `createtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `role_id_action_id` (`role_id`,`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `auth_role_action` WRITE;
/*!40000 ALTER TABLE `auth_role_action` DISABLE KEYS */;

INSERT INTO `auth_role_action` (`role_id`, `action_id`, `createtime`)
VALUES
	(1,1,'2016-09-29 11:25:20'),
	(1,2,'2016-09-29 11:25:20'),
	(1,3,'2016-09-29 11:25:20'),
	(1,4,'2016-09-29 11:25:20'),
	(1,11,'2016-09-29 11:25:20'),
	(1,12,'2016-09-29 11:25:20'),
	(1,13,'2016-09-29 11:25:20'),
	(1,14,'2016-09-29 11:25:20'),
	(1,15,'2016-09-29 11:25:20'),
	(1,18,'2016-09-29 11:25:20'),
	(1,22,'2016-09-29 11:30:43'),
	(1,23,'2016-09-29 11:30:40'),
	(1,24,'2016-09-29 11:32:02'),
	(1,26,'2016-09-29 11:30:42'),
	(1,27,'2016-09-29 11:40:43'),
	(1,28,'2016-09-29 11:40:40'),
	(1,29,'2016-09-29 11:46:02'),
	(1,30,'2016-09-29 11:46:03'),
	(1,31,'2016-09-29 11:48:34'),
	(1,33,'2018-01-04 17:13:55'),
	(1,34,'2018-01-04 17:31:18'),
	(1,35,'2016-10-12 18:04:24'),
	(1,36,'2016-10-12 18:04:22'),
	(1,37,'2016-10-12 18:04:13'),
	(1,38,'2016-10-12 18:04:24'),
	(1,39,'2016-10-13 10:32:26'),
	(1,40,'2016-10-13 10:32:27'),
	(1,45,'2016-11-25 15:55:17'),
	(1,46,'2016-11-25 15:55:11');

/*!40000 ALTER TABLE `auth_role_action` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table auth_user_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_user_log`;

CREATE TABLE `auth_user_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL DEFAULT '',
  `method` char(10) NOT NULL DEFAULT '',
  `pathinfo` varchar(50) NOT NULL DEFAULT '',
  `action` varchar(50) NOT NULL DEFAULT '',
  `param` varchar(200) NOT NULL DEFAULT '',
  `createtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `createtime_username` (`createtime`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户操作日志';

LOCK TABLES `auth_user_log` WRITE;
/*!40000 ALTER TABLE `auth_user_log` DISABLE KEYS */;

INSERT INTO `auth_user_log` (`id`, `user_id`, `username`, `method`, `pathinfo`, `action`, `param`, `createtime`)
VALUES
	(1,3,'test','GET','/account/index','\\Module\\Admin\\Controller\\User::index','','2017-02-28 14:47:07'),
	(31,3,'test','GET','/auth/role/index','\\Module\\Auth\\Controller\\Role::index','{\"name\":\"\"}','2017-11-17 10:02:26');

/*!40000 ALTER TABLE `auth_user_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table auth_user_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_user_role`;

CREATE TABLE `auth_user_role` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `createtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `user_id_role_id` (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `auth_user_role` WRITE;
/*!40000 ALTER TABLE `auth_user_role` DISABLE KEYS */;

INSERT INTO `auth_user_role` (`user_id`, `role_id`, `createtime`)
VALUES
	(3,1,'2017-02-28 14:46:43');

/*!40000 ALTER TABLE `auth_user_role` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
