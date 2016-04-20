# ************************************************************
# Sequel Pro SQL dump
# Version 4500
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 10.1.9-MariaDB)
# Database: passport
# Generation Time: 2016-04-15 06:54:40 +0000
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
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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
	(20,'m','$2y$10$Lo1MxeAWjXXj3c/zriHBruvqT2m8.1z8NY1Y6HGVou2Qugbkbfgye','edd852d6','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:15:52','2016-04-15 14:15:52');

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
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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
	(21,'n','$2y$10$N3jsmqFr1DMHsjyoV/Odd.Ep4.w9AZWXIg1AUFZrctTP3uoPi/GIC','a4aa6413','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:15:58','2016-04-15 14:15:58');

/*!40000 ALTER TABLE `account_1` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_10
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_10`;

CREATE TABLE `account_10` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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



# Dump of table account_11
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_11`;

CREATE TABLE `account_11` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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

LOCK TABLES `account_11` WRITE;
/*!40000 ALTER TABLE `account_11` DISABLE KEYS */;

INSERT INTO `account_11` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(11,'d','$2y$10$OZitIS8OpJNC8t4rxdeejOXmH5HsU1aLYvsI1pxn5FxPqmBGaKOHG','72528f9f','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:14:10','2016-04-15 14:14:10');

/*!40000 ALTER TABLE `account_11` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_12
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_12`;

CREATE TABLE `account_12` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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

LOCK TABLES `account_12` WRITE;
/*!40000 ALTER TABLE `account_12` DISABLE KEYS */;

INSERT INTO `account_12` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(12,'e','$2y$10$cENPx4Oi/1mU0cbmrtwRi.VdTO2/eUIVND4p3yh1qpjlHTAmQQJ7y','cea3b48d','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:14:20','2016-04-15 14:14:20');

/*!40000 ALTER TABLE `account_12` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_13
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_13`;

CREATE TABLE `account_13` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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

LOCK TABLES `account_13` WRITE;
/*!40000 ALTER TABLE `account_13` DISABLE KEYS */;

INSERT INTO `account_13` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(13,'f','$2y$10$9HHNW6O/jn7kEgfi5D4qPuNmjzh9qegis44CtCQAyApPX4jB.nDEW','36711f62','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:14:29','2016-04-15 14:14:29');

/*!40000 ALTER TABLE `account_13` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_14
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_14`;

CREATE TABLE `account_14` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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

LOCK TABLES `account_14` WRITE;
/*!40000 ALTER TABLE `account_14` DISABLE KEYS */;

INSERT INTO `account_14` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(14,'g','$2y$10$HMZAx8xUUTYGKg0F13tr3utjRQh066gL.LLrV0xX4O584NsDW9oS.','248da700','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:14:39','2016-04-15 14:14:39');

/*!40000 ALTER TABLE `account_14` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_15
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_15`;

CREATE TABLE `account_15` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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

LOCK TABLES `account_15` WRITE;
/*!40000 ALTER TABLE `account_15` DISABLE KEYS */;

INSERT INTO `account_15` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(15,'h','$2y$10$K7hsBq9i7W9lHMZnXW8yB..LZC0SmbtbpXPzGFVPAbM4ewgVYorgm','fa190814','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:14:48','2016-04-15 14:14:48');

/*!40000 ALTER TABLE `account_15` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_16
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_16`;

CREATE TABLE `account_16` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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

LOCK TABLES `account_16` WRITE;
/*!40000 ALTER TABLE `account_16` DISABLE KEYS */;

INSERT INTO `account_16` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(16,'i','$2y$10$eBXDwL.fI0YrJhtyRkkb3Oa2CiiGdiKTiTOlD1zvto/wOZ6Dzz66m','e3f3f0aa','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:15:10','2016-04-15 14:15:10');

/*!40000 ALTER TABLE `account_16` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_17
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_17`;

CREATE TABLE `account_17` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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

LOCK TABLES `account_17` WRITE;
/*!40000 ALTER TABLE `account_17` DISABLE KEYS */;

INSERT INTO `account_17` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(17,'j','$2y$10$Og.4dGr7R0LRoB9UejHFQe3ai6ALwh.JZXGg929.IVbfblsB4SJYa','38a55e69','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:15:20','2016-04-15 14:15:20');

/*!40000 ALTER TABLE `account_17` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_18
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_18`;

CREATE TABLE `account_18` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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

LOCK TABLES `account_18` WRITE;
/*!40000 ALTER TABLE `account_18` DISABLE KEYS */;

INSERT INTO `account_18` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(18,'k','$2y$10$Luntg3rn.uI6XBSF7558c.qLtpdi8AMuKSVatLZpp9Cfw8PxdBqeO','3334db83','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:15:33','2016-04-15 14:15:33');

/*!40000 ALTER TABLE `account_18` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_19
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_19`;

CREATE TABLE `account_19` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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

LOCK TABLES `account_19` WRITE;
/*!40000 ALTER TABLE `account_19` DISABLE KEYS */;

INSERT INTO `account_19` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(19,'l','$2y$10$IF.Z.HAxX/z/iltsBE/w1unZ.6XbqCIooz4RBTbJGlvi/qpSxHnLi','ceafd914','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:15:41','2016-04-15 14:15:41');

/*!40000 ALTER TABLE `account_19` ENABLE KEYS */;
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
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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
	(22,'o','$2y$10$wl.20YoifuI9kCAy1KtXY.UntcVdLfdtmzvf63wX/87Equ6y9Kwje','9bf035c5','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:53:03','2016-04-15 14:53:03');

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
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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

LOCK TABLES `account_7` WRITE;
/*!40000 ALTER TABLE `account_7` DISABLE KEYS */;

INSERT INTO `account_7` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(7,'a','$2y$10$aK23mCOnMdjORvrhtY187eLtDrQjsTBey.d8QuAHHMqa8DKuuIgCC','434c57e8','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:03:38','2016-04-15 14:03:38');

/*!40000 ALTER TABLE `account_7` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_8
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_8`;

CREATE TABLE `account_8` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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

LOCK TABLES `account_8` WRITE;
/*!40000 ALTER TABLE `account_8` DISABLE KEYS */;

INSERT INTO `account_8` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(8,'b','$2y$10$LBKvV5vDBcbkneVo/LSUM.duXDtzhM7fICsmLVX8VrS7Utz55pJ.C','3c942eb0','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:03:52','2016-04-15 14:03:52');

/*!40000 ALTER TABLE `account_8` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table account_9
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_9`;

CREATE TABLE `account_9` (
  `id` bigint(20) unsigned NOT NULL,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(8) NOT NULL DEFAULT '' COMMENT '密钥',
  `nickname` char(20) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` char(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` char(16) NOT NULL DEFAULT '' COMMENT '手机',
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

LOCK TABLES `account_9` WRITE;
/*!40000 ALTER TABLE `account_9` DISABLE KEYS */;

INSERT INTO `account_9` (`id`, `username`, `password`, `salt`, `nickname`, `email`, `mobile`, `origin`, `ext_int_1`, `ext_int_2`, `ext_int_3`, `ext_bigint_1`, `ext_bigint_2`, `ext_char_1`, `ext_char_2`, `ext_char_3`, `ext_char_4`, `status`, `regip`, `lastip`, `ctreatetime`, `updatetime`)
VALUES
	(9,'c','$2y$10$DvIsGH8NROE8CNBigCfIOOROQeBrVHJhl5WgL3ZD5ZOPpMi0pgMAW','b4a8cde8','','','','',0,0,0,0,0,'','','','',0,0,0,'2016-04-15 14:04:02','2016-04-15 14:04:02');

/*!40000 ALTER TABLE `account_9` ENABLE KEYS */;
UNLOCK TABLES;


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
	('a',6),
	('e',12),
	('i',16),
	('m',20),
	('b',8),
	('f',13),
	('j',17),
	('n',21),
	('c',9),
	('g',14),
	('k',18),
	('o',22),
	('d',11),
	('h',15),
	('l',19);

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
	(22,1);

/*!40000 ALTER TABLE `uniqueid` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
