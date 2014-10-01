# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.6.19)
# Database: simplelance
# Generation Time: 2014-08-03 20:43:12 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table invoiceItems
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invoice_items`;

CREATE TABLE `invoice_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `item` varchar(100) NOT NULL DEFAULT '',
  `price` decimal(10,2) NOT NULL,
  `quantity` int(5) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table invoices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '',
  `date_paid` date DEFAULT NULL,
  `total` decimal(13,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table project_notes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `project_notes`;

CREATE TABLE `project_notes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `details` text,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table project_tasks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `project_tasks`;

CREATE TABLE `project_tasks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `created_on` datetime DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `created_on` datetime DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table ticket_priorities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ticket_priorities`;

CREATE TABLE `ticket_priorities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `priority` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `ticket_priorities` WRITE;
/*!40000 ALTER TABLE `ticket_priorities` DISABLE KEYS */;

INSERT INTO `ticket_priorities` (`id`, `priority`)
VALUES
	(1,'Low'),
	(2,'Medium'),
	(3,'High'),
	(4,'Urgent'),
	(5,'Critical');

/*!40000 ALTER TABLE `ticket_priorities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ticket_replies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ticket_replies`;

CREATE TABLE `ticket_replies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `replied_on` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table ticket_statuses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ticket_statuses`;

CREATE TABLE `ticket_statuses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `ticket_statuses` WRITE;
/*!40000 ALTER TABLE `ticket_statuses` DISABLE KEYS */;

INSERT INTO `ticket_statuses` (`id`, `status`)
VALUES
	(1,'Open'),
	(2,'On Hold'),
	(3,'In Progress'),
	(4,'Closed');

/*!40000 ALTER TABLE `ticket_statuses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tickets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `opened` datetime NOT NULL,
  `priority` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `owner` int(11) NOT NULL,
  `last_reply_user` int(11) NOT NULL,
  `last_reply_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `access_level` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address_1` varchar(100) NOT NULL DEFAULT '',
  `address_2` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL DEFAULT '',
  `state` varchar(100) DEFAULT NULL,
  `post_code` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) NOT NULL DEFAULT '',
  `phone` varchar(20) DEFAULT NULL,
  `generated_string` varchar(35) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `access_level`, `address_1`, `address_2`, `city`, `state`, `post_code`, `country`, `phone`, `generated_string`)
VALUES
	(1,'Admin','User','admin@simplelance.com','$2y$10$eQmpgslNp8VOFr2aIg/Q2OSJK91Tv4CqYvWorSh7.lh.aMEbIDryW','1','123 Any Street','','Any Town','','D16','Ireland','',NULL),
	(2,'Customer','User','customer@simplelance.com','$2y$10$SvUoTUfzGzkSSUFvToBG2.mmkS2TbfP9IzGLwsvPo6RsW7/BEGcpK','2','123 Any Street','','Any Town','','','Ireland','083 122 1562',NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
