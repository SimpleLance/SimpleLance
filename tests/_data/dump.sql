# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19-0ubuntu0.14.04.1)
# Database: homestead
# Generation Time: 2015-02-03 10:59:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`)
VALUES
	(1,'Users','{\"users\":1}','2015-02-03 10:58:03','2015-02-03 10:58:03'),
	(2,'Admins','{\"admin\":1,\"users\":1}','2015-02-03 10:58:03','2015-02-03 10:58:03');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table invoice_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invoice_items`;

CREATE TABLE `invoice_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table invoice_statuses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invoice_statuses`;

CREATE TABLE `invoice_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `invoice_statuses` WRITE;
/*!40000 ALTER TABLE `invoice_statuses` DISABLE KEYS */;

INSERT INTO `invoice_statuses` (`id`, `title`, `created_at`, `updated_at`)
VALUES
	(1,'Open','2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(2,'Overdue','2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(3,'Draft','2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(4,'Paid','2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(5,'Cancelled','2015-02-03 10:58:04','2015-02-03 10:58:04');

/*!40000 ALTER TABLE `invoice_statuses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table invoices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `due` date NOT NULL,
  `status_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;

INSERT INTO `invoices` (`id`, `due`, `status_id`, `amount`, `owner_id`, `created_at`, `updated_at`)
VALUES
	(1,'1992-03-06',1,776.19,2,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(2,'1987-03-27',1,0.00,2,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(3,'2010-07-02',3,443.16,2,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(4,'1997-02-05',4,56.26,2,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(5,'1975-10-01',3,0.13,2,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(6,'2005-12-12',2,99999999.99,1,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(7,'1979-11-09',3,1937658.08,1,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(8,'2008-11-10',2,17556.22,2,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(9,'1978-11-08',4,5902102.40,1,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(10,'1991-09-28',2,73154532.06,2,'2015-02-03 10:58:04','2015-02-03 10:58:04');

/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2012_12_06_225921_migration_cartalyst_sentry_install_users',1),
	('2012_12_06_225929_migration_cartalyst_sentry_install_groups',1),
	('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot',1),
	('2012_12_06_225988_migration_cartalyst_sentry_install_throttle',1),
	('2014_12_22_012146_create_projects_table',1),
	('2014_12_22_130417_create_tickets_table',1),
	('2014_12_23_020214_create_priorities_table',1),
	('2014_12_24_203904_create_statuses_table',1),
	('2014_12_29_134211_create_invoices_table',1),
	('2014_12_31_082924_create_ticket_replies_table',1),
	('2015_01_12_141846_add_fields_to_users_table',1),
	('2015_02_03_055302_create_invoice_statuses_table',1),
	('2015_02_03_072806_create_invoice_items_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table priorities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `priorities`;

CREATE TABLE `priorities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `priorities` WRITE;
/*!40000 ALTER TABLE `priorities` DISABLE KEYS */;

INSERT INTO `priorities` (`id`, `title`, `created_at`, `updated_at`)
VALUES
	(1,'Low','2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(2,'Medium','2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(3,'High','2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(4,'Urgent','2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(5,'Critical','2015-02-03 10:58:04','2015-02-03 10:58:04');

/*!40000 ALTER TABLE `priorities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;

INSERT INTO `projects` (`id`, `title`, `description`, `owner_id`, `status_id`, `priority_id`, `created_at`, `updated_at`)
VALUES
	(1,'Sample Project','Test project',1,1,1,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(2,'Sample Project','Test project',1,1,1,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(3,'Sample Project','Test project',1,1,1,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(4,'Sample Project','Test project',1,1,1,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(5,'Sample Project','Test project',1,1,1,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(6,'Sample Project','Test project',2,1,1,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(7,'Sample Project','Test project',2,1,1,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(8,'Sample Project','Test project',2,1,1,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(9,'Sample Project','Test project',2,1,1,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(10,'Sample Project','Test project',2,1,1,'2015-02-03 10:58:04','2015-02-03 10:58:04');

/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table statuses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `statuses`;

CREATE TABLE `statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;

INSERT INTO `statuses` (`id`, `title`, `created_at`, `updated_at`)
VALUES
	(1,'Open','2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(2,'In Progress','2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(3,'On Hold','2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(4,'Closed','2015-02-03 10:58:04','2015-02-03 10:58:04');

/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table throttle
# ------------------------------------------------------------

DROP TABLE IF EXISTS `throttle`;

CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`)
VALUES
	(1,1,NULL,0,0,0,NULL,NULL,NULL);

/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ticket_replies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ticket_replies`;

CREATE TABLE `ticket_replies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table tickets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `priority_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `replies` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;

INSERT INTO `tickets` (`id`, `title`, `description`, `priority_id`, `status_id`, `owner_id`, `replies`, `created_at`, `updated_at`)
VALUES
	(1,'Rerum est est quis quaerat inventore.','Et doloremque non maxime consequuntur cum saepe atque.',1,1,1,0,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(2,'Facere sed at quidem.','Et laborum in fugiat hic delectus atque.',1,1,1,0,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(3,'Eos impedit sit adipisci perspiciatis.','Quos illo quo nostrum accusamus maiores ut.',1,1,1,0,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(4,'Quod aspernatur ab enim qui iure ut.','Deleniti veritatis ut rerum officia quo pariatur dolores.',1,1,1,0,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(5,'Natus unde dolorem ab quo.','Sint minima aut repellat rerum mollitia error.',1,1,1,0,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(6,'Error itaque voluptatum dolor numquam.','Enim ad quia fuga incidunt facilis saepe exercitationem.',1,1,2,0,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(7,'Quasi cumque rerum optio atque sit minus quaerat.','Soluta eos omnis minus id aut.',1,1,2,0,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(8,'Quasi voluptas qui rerum.','Est praesentium vel aliquid omnis eos.',1,1,2,0,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(9,'Amet velit enim omnis fugit voluptatem perferendis qui.','Qui adipisci aut dolorem voluptatem facilis sit.',1,1,2,0,'2015-02-03 10:58:04','2015-02-03 10:58:04'),
	(10,'Cum officia sed delectus unde quasi.','Labore deserunt consequatur voluptatem esse ut.',1,1,2,0,'2015-02-03 10:58:04','2015-02-03 10:58:04');

/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `country` text COLLATE utf8_unicode_ci NOT NULL,
  `post_code` text COLLATE utf8_unicode_ci NOT NULL,
  `state` text COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `address2` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `username`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `phone`, `country`, `post_code`, `state`, `city`, `address2`, `address`, `created_at`, `updated_at`)
VALUES
	(1,'admin@admin.com','admin','$2y$10$1cgBB7pu3c/cYc364c.Kxe7rqMR.8cqBCav348EZqnjCNOqHl9me.',NULL,1,NULL,NULL,'2015-02-03 10:58:31','$2y$10$pmR5u7xbHpRDdQaEi/.Fi.mxxD/w53z5YBJuj9ZWk59Uwo8NCS3uO',NULL,'Admin','User','+1 (432) 432-4324','USA','45524','NY','','Brooklyn','123 Any Street','2015-02-03 10:58:03','2015-02-03 10:58:31'),
	(2,'user@user.com','user','$2y$10$dicspSyDHxSL5yEwPJ3ZMOlbFqZfoIn4Xkyt6EipnjAj0bnbayFye',NULL,1,NULL,NULL,NULL,NULL,NULL,'Customer','User','+1 (432) 432-4324','USA','45524','NY','','Brooklyn','123 Any Street','2015-02-03 10:58:03','2015-02-03 10:58:03');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;

INSERT INTO `users_groups` (`user_id`, `group_id`)
VALUES
	(1,1),
	(1,2),
	(2,1);

/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
