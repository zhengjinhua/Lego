# ************************************************************
# Sequel Pro SQL dump
# Version 4500
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 10.1.9-MariaDB)
# Database: account
# Generation Time: 2016-05-13 15:53:49 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table uniqueid
# ------------------------------------------------------------

DROP TABLE IF EXISTS `uniqueid`;

CREATE TABLE `uniqueid` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `flag` (`flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `uniqueid` WRITE;
/*!40000 ALTER TABLE `uniqueid` DISABLE KEYS */;

INSERT INTO `uniqueid` (`id`, `flag`)
VALUES
	(28,1);

/*!40000 ALTER TABLE `uniqueid` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_0
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_0`;

CREATE TABLE `user_0` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机',
  `origin` char(20) NOT NULL DEFAULT '' COMMENT '来源',
  `ext_int_1` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_2` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_3` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_1` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_2` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_char_1` char(32) NOT NULL DEFAULT '',
  `ext_char_2` char(32) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `user_0` WRITE;
/*!40000 ALTER TABLE `user_0` DISABLE KEYS */;

INSERT INTO `user_0` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(24,'a','$2y$10$y.hIhKiThQPsSJz5b2rPQeN7mABwj7BNEqV4dKyKKdo3CYeAanAy.','eb6c8bbe','','','','',0,0,0,0,0,'','','','',0,2130706433,2130706433,'2016-04-21 23:19:33','2016-04-29 02:45:37');

/*!40000 ALTER TABLE `user_0` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_1
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_1`;

CREATE TABLE `user_1` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机',
  `origin` char(20) NOT NULL DEFAULT '' COMMENT '来源',
  `ext_int_1` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_2` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_3` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_1` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_2` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_char_1` char(32) NOT NULL DEFAULT '',
  `ext_char_2` char(32) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `user_1` WRITE;
/*!40000 ALTER TABLE `user_1` DISABLE KEYS */;

INSERT INTO `user_1` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(25,'b','$2y$10$ArBASEDitnc2b1ipjkIZv.zE5Vepe/peSdMrTTZGLs7CAAV2Zl83G','cbd4066b','','','','',0,0,0,0,0,'','','','',0,2130706433,0,'2016-04-21 23:19:47','2016-04-21 23:19:47');

/*!40000 ALTER TABLE `user_1` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_2
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_2`;

CREATE TABLE `user_2` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机',
  `origin` char(20) NOT NULL DEFAULT '' COMMENT '来源',
  `ext_int_1` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_2` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_3` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_1` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_2` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_char_1` char(32) NOT NULL DEFAULT '',
  `ext_char_2` char(32) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `user_2` WRITE;
/*!40000 ALTER TABLE `user_2` DISABLE KEYS */;

INSERT INTO `user_2` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(26,'c','$2y$10$3bx4I9jXzPIVSCtbB9mqyODhMBcad12HGOcGdT/LrfqEpHcI3I29C','37c8bad3','','','','',0,0,0,0,0,'','','','',0,2130706433,2130706433,'2016-04-21 23:19:57','2016-05-13 23:46:02');

/*!40000 ALTER TABLE `user_2` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_3
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_3`;

CREATE TABLE `user_3` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机',
  `origin` char(20) NOT NULL DEFAULT '' COMMENT '来源',
  `ext_int_1` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_2` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_3` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_1` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_2` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_char_1` char(32) NOT NULL DEFAULT '',
  `ext_char_2` char(32) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `user_3` WRITE;
/*!40000 ALTER TABLE `user_3` DISABLE KEYS */;

INSERT INTO `user_3` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(27,'d','$2y$10$GdP57hEQaDPGXvMoekEV3e.NoSizyExfm.abZ0zH3SCUVD.Xl/0Qa','050822c2','','','','',0,0,0,0,0,'','','','',0,2130706433,0,'2016-04-21 23:20:06','2016-04-21 23:20:06');

/*!40000 ALTER TABLE `user_3` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_4
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_4`;

CREATE TABLE `user_4` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机',
  `origin` char(20) NOT NULL DEFAULT '' COMMENT '来源',
  `ext_int_1` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_2` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_3` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_1` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_2` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_char_1` char(32) NOT NULL DEFAULT '',
  `ext_char_2` char(32) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `user_4` WRITE;
/*!40000 ALTER TABLE `user_4` DISABLE KEYS */;

INSERT INTO `user_4` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(28,'李四','$2y$10$qzh1qd.5GRagGnrzp.ekCeLC/.poCocscEzKaxz7OxP3HmYE0tPjS','640d75f5','','','','',0,0,0,0,0,'','','','',0,2130706433,2130706433,'2016-04-21 23:22:08','2016-04-21 23:43:02');

/*!40000 ALTER TABLE `user_4` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_5
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_5`;

CREATE TABLE `user_5` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机',
  `origin` char(20) NOT NULL DEFAULT '' COMMENT '来源',
  `ext_int_1` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_2` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_3` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_1` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_2` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_char_1` char(32) NOT NULL DEFAULT '',
  `ext_char_2` char(32) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table user_6
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_6`;

CREATE TABLE `user_6` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机',
  `origin` char(20) NOT NULL DEFAULT '' COMMENT '来源',
  `ext_int_1` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_2` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_3` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_1` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_2` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_char_1` char(32) NOT NULL DEFAULT '',
  `ext_char_2` char(32) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table user_7
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_7`;

CREATE TABLE `user_7` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机',
  `origin` char(20) NOT NULL DEFAULT '' COMMENT '来源',
  `ext_int_1` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_2` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_int_3` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_1` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_bigint_2` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ext_char_1` char(32) NOT NULL DEFAULT '',
  `ext_char_2` char(32) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table user_index_email
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_index_email`;

CREATE TABLE `user_index_email` (
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '账号ID',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
/*!50100 PARTITION BY KEY (email)
PARTITIONS 10 */;



# Dump of table user_index_mobile
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_index_mobile`;

CREATE TABLE `user_index_mobile` (
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '账号ID',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
/*!50100 PARTITION BY KEY (mobile)
PARTITIONS 10 */;



# Dump of table user_index_qq
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_index_qq`;

CREATE TABLE `user_index_qq` (
  `openid` char(32) NOT NULL DEFAULT '' COMMENT 'QQ OPENID',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '账号ID',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `openid` (`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
/*!50100 PARTITION BY KEY (openid)
PARTITIONS 10 */;



# Dump of table user_index_username
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_index_username`;

CREATE TABLE `user_index_username` (
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '账号ID',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
/*!50100 PARTITION BY KEY (username)
PARTITIONS 10 */;

LOCK TABLES `user_index_username` WRITE;
/*!40000 ALTER TABLE `user_index_username` DISABLE KEYS */;

INSERT INTO `user_index_username` (`username`, `user_id`, `createtime`)
VALUES
	('a',24,'2016-04-23 16:01:42'),
	('b',25,'2016-04-23 16:01:42'),
	('c',26,'2016-04-23 16:01:42'),
	('李四',28,'2016-04-23 16:01:42'),
	('d',27,'2016-04-23 16:01:42');

/*!40000 ALTER TABLE `user_index_username` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_index_weibo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_index_weibo`;

CREATE TABLE `user_index_weibo` (
  `openid` char(32) NOT NULL DEFAULT '' COMMENT 'WEIBO OPENID',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '账号ID',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `openid` (`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
/*!50100 PARTITION BY KEY (openid)
PARTITIONS 10 */;



# Dump of table user_index_weixin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_index_weixin`;

CREATE TABLE `user_index_weixin` (
  `openid` char(32) NOT NULL DEFAULT '' COMMENT 'WEIXIN OPENID',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '账号ID',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `openid` (`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
/*!50100 PARTITION BY KEY (openid)
PARTITIONS 10 */;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
