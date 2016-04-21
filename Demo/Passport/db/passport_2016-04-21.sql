# ************************************************************
# Sequel Pro SQL dump
# Version 4500
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 10.1.9-MariaDB)
# Database: passport
# Generation Time: 2016-04-21 15:24:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table account_0
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_0`;

CREATE TABLE `account_0` (
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
  `ext_char_1` char(20) NOT NULL DEFAULT '',
  `ext_char_2` char(20) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `account_0` WRITE;
/*!40000 ALTER TABLE `account_0` DISABLE KEYS */;

INSERT INTO `account_0` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(24,'a','$2y$10$y.hIhKiThQPsSJz5b2rPQeN7mABwj7BNEqV4dKyKKdo3CYeAanAy.','eb6c8bbe','','','','',0,0,0,0,0,'','','','',0,2130706433,0,'2016-04-21 23:19:33','2016-04-21 23:19:33');

/*!40000 ALTER TABLE `account_0` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_1
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_1`;

CREATE TABLE `account_1` (
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
  `ext_char_1` char(20) NOT NULL DEFAULT '',
  `ext_char_2` char(20) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `account_1` WRITE;
/*!40000 ALTER TABLE `account_1` DISABLE KEYS */;

INSERT INTO `account_1` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(25,'b','$2y$10$ArBASEDitnc2b1ipjkIZv.zE5Vepe/peSdMrTTZGLs7CAAV2Zl83G','cbd4066b','','','','',0,0,0,0,0,'','','','',0,2130706433,0,'2016-04-21 23:19:47','2016-04-21 23:19:47');

/*!40000 ALTER TABLE `account_1` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_2
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_2`;

CREATE TABLE `account_2` (
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
  `ext_char_1` char(20) NOT NULL DEFAULT '',
  `ext_char_2` char(20) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `account_2` WRITE;
/*!40000 ALTER TABLE `account_2` DISABLE KEYS */;

INSERT INTO `account_2` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(26,'c','$2y$10$3bx4I9jXzPIVSCtbB9mqyODhMBcad12HGOcGdT/LrfqEpHcI3I29C','37c8bad3','','','','',0,0,0,0,0,'','','','',0,2130706433,0,'2016-04-21 23:19:57','2016-04-21 23:19:57');

/*!40000 ALTER TABLE `account_2` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_3
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_3`;

CREATE TABLE `account_3` (
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
  `ext_char_1` char(20) NOT NULL DEFAULT '',
  `ext_char_2` char(20) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `account_3` WRITE;
/*!40000 ALTER TABLE `account_3` DISABLE KEYS */;

INSERT INTO `account_3` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(27,'d','$2y$10$GdP57hEQaDPGXvMoekEV3e.NoSizyExfm.abZ0zH3SCUVD.Xl/0Qa','050822c2','','','','',0,0,0,0,0,'','','','',0,2130706433,0,'2016-04-21 23:20:06','2016-04-21 23:20:06');

/*!40000 ALTER TABLE `account_3` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_4
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_4`;

CREATE TABLE `account_4` (
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
  `ext_char_1` char(20) NOT NULL DEFAULT '',
  `ext_char_2` char(20) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `account_4` WRITE;
/*!40000 ALTER TABLE `account_4` DISABLE KEYS */;

INSERT INTO `account_4` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(28,'李四','$2y$10$qzh1qd.5GRagGnrzp.ekCeLC/.poCocscEzKaxz7OxP3HmYE0tPjS','640d75f5','','','','',0,0,0,0,0,'','','','',0,2130706433,0,'2016-04-21 23:22:08','2016-04-21 23:22:08');

/*!40000 ALTER TABLE `account_4` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_5
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_5`;

CREATE TABLE `account_5` (
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
  `ext_char_1` char(20) NOT NULL DEFAULT '',
  `ext_char_2` char(20) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table account_6
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_6`;

CREATE TABLE `account_6` (
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
  `ext_char_1` char(20) NOT NULL DEFAULT '',
  `ext_char_2` char(20) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table account_7
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_7`;

CREATE TABLE `account_7` (
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
  `ext_char_1` char(20) NOT NULL DEFAULT '',
  `ext_char_2` char(20) NOT NULL DEFAULT '',
  `ext_char_3` varchar(64) NOT NULL DEFAULT '',
  `ext_char_4` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `regip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '注册IP',
  `lastip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '登陆IP',
  `ctreatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table account_username_index
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_username_index`;

CREATE TABLE `account_username_index` (
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `account_id` bigint(20) unsigned NOT NULL COMMENT '账号ID',
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
/*!50100 PARTITION BY KEY (username)
PARTITIONS 10 */;

LOCK TABLES `account_username_index` WRITE;
/*!40000 ALTER TABLE `account_username_index` DISABLE KEYS */;

INSERT INTO `account_username_index` (`username`, `account_id`)
VALUES
	('a',24),
	('b',25),
	('c',26),
	('李四',28),
	('d',27);

/*!40000 ALTER TABLE `account_username_index` ENABLE KEYS */;
UNLOCK TABLES;


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



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
