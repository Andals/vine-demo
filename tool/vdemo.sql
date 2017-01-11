-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `vdemo` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `vdemo`;

CREATE TABLE `demo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `id_gen` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `max_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `keyword` (`keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `id_gen` (`id`, `keyword`, `max_id`) VALUES
(1,	'demo',	1000);

-- 2017-01-11 07:20:45
