CREATE TABLE IF NOT EXISTS `#__ccmarketplace_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(100),
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__ccmarketplace_labels` (
  `id`              INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`            VARCHAR(255) DEFAULT NULL,
  `ordering`      	INTEGER DEFAULT '0',
  `published`       TINYINT(1) DEFAULT 0,
  PRIMARY KEY  (`id`),
  KEY `marketplace_labels_name` (`name`),
  KEY `marketplace_labels_ordering` (`ordering`)
) DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__ccmarketplace_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `show_image` tinyint(1) DEFAULT '0',
  `use_firstname` 	tinyint(1) DEFAULT '2',
  `use_lastname`  	tinyint(1) DEFAULT '2',
  `use_company`  	tinyint(1) DEFAULT '2',
  `use_street`  	tinyint(1) DEFAULT '2',
  `use_zip`  		tinyint(1) DEFAULT '2',
  `use_city`  		tinyint(1) DEFAULT '2',
  `use_state`  		tinyint(1) DEFAULT '2',
  `use_country`  	tinyint(1) DEFAULT '2',
  `use_phone`  		tinyint(1) DEFAULT '2',
  `use_mobile`  	tinyint(1) DEFAULT '2',
  `use_email`  		tinyint(1) DEFAULT '2',
  `use_web`  		tinyint(1) DEFAULT '2',
  `use_condition`  	tinyint(1) DEFAULT '2',
  `use_price`  		tinyint(1) DEFAULT '2',  
  PRIMARY KEY (`id`),
  KEY `marketplace_categories_parent_id` (`parent_id`),
  KEY `marketplace_categories_ordering` (`ordering`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__ccmarketplace_entries` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`category_id` int(10) unsigned DEFAULT '0',
	`label_id` int(10) unsigned DEFAULT NULL,
	`user_id` int(10) unsigned DEFAULT NULL,
	`firstname` varchar(255) DEFAULT NULL,
	`lastname` varchar(255) DEFAULT NULL,
	`company` varchar(255) DEFAULT NULL,
	`street` varchar(255) DEFAULT NULL,
	`zip` varchar(50) DEFAULT NULL,
	`city` varchar(255) DEFAULT NULL,
	`state` varchar(255) DEFAULT NULL,
	`country` varchar(255) DEFAULT NULL,
	`phone` varchar(255) DEFAULT NULL,
	`mobile` varchar(255) DEFAULT NULL,
	`email` varchar(255) DEFAULT NULL,
	`web` varchar(255) DEFAULT NULL,
	`headline` varchar(255) NOT NULL DEFAULT '',
	`alias` varchar(255) DEFAULT '',
	`text` text,
	`condition` varchar(255) DEFAULT NULL,
	`price` varchar(255) DEFAULT NULL,
	`date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	`date_lastmodified` timestamp NULL DEFAULT NULL,
	`flag_commercial`   tinyint(1) DEFAULT 0,
	`flag_featured`     tinyint(1) DEFAULT 0,
	`flag_top`          tinyint(1) DEFAULT 0,
	`published` 		tinyint(1) DEFAULT 1,
	`expired` 			tinyint(1) DEFAULT 0,
	`image1` varchar(255) DEFAULT '',
	`image2` varchar(255) DEFAULT '',
	`image3` varchar(255) DEFAULT '',
	`image4` varchar(255) DEFAULT '',
	`image5` varchar(255) DEFAULT '',
	`image6` varchar(255) DEFAULT '',
	`image7` varchar(255) DEFAULT '',
	`image8` varchar(255) DEFAULT '',
	`image9` varchar(255) DEFAULT '',
	`image10` varchar(255) DEFAULT '',
	`video1` varchar(255) DEFAULT '',
	`video2` varchar(255) DEFAULT '',
	`video3` varchar(255) DEFAULT '',
	PRIMARY KEY (`id`),
	KEY `marketplace_entries_category_id` (`category_id`),
	KEY `marketplace_entries_user_id` (`user_id`),
	KEY `marketplace_entries_label_id` (`label_id`),
	KEY `marketplace_entries_flag_commercial` (`flag_commercial`),
	KEY `marketplace_entries_flag_featured` (`flag_featured`),
	KEY `marketplace_entries_flag_top` (`flag_top`)		
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__ccmarketplace_users` (
  	`id` int(11) NOT NULL,
  	`username` varchar(150) DEFAULT '',
  	`status` tinyint(1) NOT NULL DEFAULT '0',
  	`ads` int(11) NOT NULL DEFAULT '0',
  	`moderator` tinyint(1) NOT NULL DEFAULT '0',
  	`blocked` tinyint(1) NOT NULL DEFAULT '0',
	`firstname` varchar(255) DEFAULT NULL,
	`lastname` varchar(255) DEFAULT NULL,
	`company` varchar(255) DEFAULT NULL,
	`street` varchar(255) DEFAULT NULL,
	`zipcode` varchar(50) DEFAULT NULL,
	`city` varchar(255) DEFAULT NULL,
	`state` varchar(255) DEFAULT NULL,
	`country` varchar(255) DEFAULT NULL,
	`phone` varchar(255) DEFAULT NULL,
	`mobile` varchar(255) DEFAULT NULL,
	`email` varchar(255) DEFAULT NULL,
	`website` varchar(255) DEFAULT NULL,  
  PRIMARY KEY (`id`),
  KEY `idx_moderator` (`moderator`)
) DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `#__ccmarketplace_ws_channels` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `serverurl` varchar(250) NOT NULL,
  `ad_joomla` tinyint(3) NOT NULL,
  `webserver_user` varchar(250) NOT NULL,
  `webserver_password` varchar(250) NOT NULL,
  `shop_user` varchar(250) NOT NULL,
  `shop_password` varchar(250) NOT NULL,
  `pdfurl` varchar(250) NOT NULL,
  `organisation` varchar(250) NOT NULL,
  `area` int(250) NOT NULL,
  `published` tinyint(3) NOT NULL,
  `type_of_trade` varchar(50) NOT NULL,
  `adstype` tinyint(3) NOT NULL,
  `groupFilterIds` varchar(250) NOT NULL,
  `cynet` tinyint(3) NOT NULL,
  `show_mail_address` tinyint(3) NOT NULL,
  `show_photo` tinyint(3) NOT NULL,
  `show_city` tinyint(3) NOT NULL,
  `show_area` tinyint(3) NOT NULL,
  `show_code` tinyint(3) NOT NULL,
  `interface` tinyint(3) NOT NULL,
  `d_member_profile` tinyint(3) NOT NULL,
  `show_org` tinyint(3) NOT NULL,
  `show_ms` tinyint(3) NOT NULL,
  `show_name` tinyint(3) NOT NULL,
  `show_customfield` tinyint(3) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `#__ccmarketplace_ws_grpfiltrs` (
  `id` int(10) NOT NULL auto_increment,
  `gid` int(10) NOT NULL,
  `gname` varchar(250) NOT NULL,
  `webchannelid` varchar(150) NOT NULL,
  `login_page_name` varchar(250) NOT NULL,
  `published` tinyint(3) NOT NULL,
  `site_remarks` varchar(250) NOT NULL,
  `site_url` varchar(150) NOT NULL,
  `site_mail` varchar(150) NOT NULL,
  `site_adress` varchar(250) NOT NULL,
  `site_admin` varchar(150) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;