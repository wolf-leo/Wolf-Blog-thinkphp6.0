CREATE TABLE IF NOT EXISTS `article`(
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `desc` varchar(250) NOT NULL DEFAULT '',
  `type` tinyint(3) unsigned NOT NULL,
  `img` varchar(150) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `c_time`  timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`),
  KEY `index_title` (`title`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `background` (
  `id` int(1) unsigned NOT NULL DEFAULT '1',
  `head_back_img` varchar(255) NOT NULL,
  `main_back_img` varchar(255) NOT NULL,
  `is_head` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_main` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `c_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `sort` int(5) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `c_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
