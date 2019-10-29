SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `adminid` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `adminname` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `roleid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `rolename` varchar(30) NOT NULL DEFAULT '',
  `realname` varchar(30) NOT NULL DEFAULT '',
  `nickname` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(30) NOT NULL DEFAULT '',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0',
  `loginip` varchar(15) NOT NULL DEFAULT '',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `addpeople` varchar(30) NOT NULL DEFAULT '',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article`(
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `desc` varchar(250) NOT NULL DEFAULT '',
  `type` tinyint(3) unsigned NOT NULL,
  `img` varchar(150) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `c_time`  timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP ,
  `sort` mediumint(10) UNSIGNED NOT NULL DEFAULT 0,
  `isbanner` tinyint(3) UNSIGNED NOT NULL DEFAULT 2,
  PRIMARY KEY (`id`),
  KEY `index_title` (`title`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `background`;
CREATE TABLE IF NOT EXISTS `background` (
  `id` int(1) unsigned NOT NULL DEFAULT '1',
  `head_back_img` varchar(255) NOT NULL,
  `main_back_img` varchar(255) NOT NULL,
  `is_head` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_main` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `c_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `sort` int(5) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `c_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
