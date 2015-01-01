# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19-0ubuntu0.14.04.1)
# Database: homestead
# Generation Time: 2015-01-01 19:38:59 +0000
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
	(1,'Users','{\"users\":1}','2015-01-01 19:38:42','2015-01-01 19:38:42'),
	(2,'Admins','{\"admin\":1,\"users\":1}','2015-01-01 19:38:42','2015-01-01 19:38:42');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table invoices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `due` date NOT NULL,
  `status_id` int(11) NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;

INSERT INTO `invoices` (`id`, `title`, `due`, `status_id`, `amount`, `owner_id`, `created_at`, `updated_at`)
VALUES
	(1,'iusto','1981-01-14',4,'2.07',2,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(2,'nihil','1979-08-12',3,'14497.96',2,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(3,'voluptas','2008-01-06',3,'6476.82',1,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(4,'facere','2009-03-02',1,'1127391.3',2,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(5,'rerum','2008-11-19',3,'7.55',1,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(6,'quam','2005-05-31',3,'1023.96',1,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(7,'et','2005-12-04',1,'1768.69',2,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(8,'et','1991-08-02',4,'43996.07',2,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(9,'aut','2008-01-12',1,'7458671.93',2,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(10,'beatae','1996-08-15',1,'116107.59',2,'2015-01-01 19:38:43','2015-01-01 19:38:43');

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
	('2014_12_31_082924_create_ticket_replies_table',1);

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
	(1,'Low','2015-01-01 19:38:42','2015-01-01 19:38:42'),
	(2,'Medium','2015-01-01 19:38:42','2015-01-01 19:38:42'),
	(3,'High','2015-01-01 19:38:42','2015-01-01 19:38:42'),
	(4,'Urgent','2015-01-01 19:38:42','2015-01-01 19:38:42'),
	(5,'Critical','2015-01-01 19:38:42','2015-01-01 19:38:42');

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
	(1,'Sample Project','Test project',1,1,1,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(2,'Sample Project','Test project',1,1,1,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(3,'Sample Project','Test project',1,1,1,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(4,'Sample Project','Test project',1,1,1,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(5,'Sample Project','Test project',1,1,1,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(6,'Sample Project','Test project',2,1,1,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(7,'Sample Project','Test project',2,1,1,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(8,'Sample Project','Test project',2,1,1,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(9,'Sample Project','Test project',2,1,1,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(10,'Sample Project','Test project',2,1,1,'2015-01-01 19:38:43','2015-01-01 19:38:43');

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
	(1,'Open','2015-01-01 19:38:42','2015-01-01 19:38:42'),
	(2,'In Progress','2015-01-01 19:38:42','2015-01-01 19:38:42'),
	(3,'On Hold','2015-01-01 19:38:42','2015-01-01 19:38:42'),
	(4,'Closed','2015-01-01 19:38:42','2015-01-01 19:38:42');

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
	(1,'Neque veritatis excepturi voluptatibus rerum aliquid debitis.','Cupiditate hic eius alias unde excepturi mollitia.',1,1,1,0,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(2,'Aliquam tempora quidem hic ipsam.','Dolorem deleniti fuga quis sit at magnam excepturi.',1,1,1,0,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(3,'Voluptatem provident quos sapiente veritatis voluptatem omnis repellat.','Tempore tempore iusto quae minus distinctio explicabo.',1,1,1,0,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(4,'Excepturi eaque harum deserunt id qui ullam.','Molestiae ut voluptatem voluptatum occaecati cum.',1,1,1,0,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(5,'Consequatur alias qui aut facilis quam excepturi est.','Eaque ipsum dolorum et qui eveniet veniam.',1,1,1,0,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(6,'Ut voluptatem nostrum doloribus rerum dolor sequi eos praesentium.','Praesentium corporis fugiat dicta ab.',1,1,2,0,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(7,'Dolores qui omnis et dicta dolor totam exercitationem.','Voluptas voluptatem sit quia ea.',1,1,2,0,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(8,'Velit ut provident et et ipsam expedita dolores.','Nesciunt corporis ut sit.',1,1,2,0,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(9,'Officia aliquam culpa sint eos veritatis.','Ab iure dolor laboriosam impedit veniam eos.',1,1,2,0,'2015-01-01 19:38:43','2015-01-01 19:38:43'),
	(10,'Porro eveniet enim iste.','Laudantium adipisci similique corrupti et.',1,1,2,0,'2015-01-01 19:38:43','2015-01-01 19:38:43');

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

INSERT INTO `users` (`id`, `email`, `username`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`)
VALUES
	(1,'admin@admin.com','admin','$2y$10$tis/j1elqoVZZr/4q9NifegrpbPmUCfntxMIn.ceNaUX86/LJVieq',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-01-01 19:38:42','2015-01-01 19:38:42'),
	(2,'user@user.com','user','$2y$10$DBbC3wI6ag7QDAuePUX1TOQ2O1LXhjzlW8CWeaHiAEgg23eNYGw1a',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-01-01 19:38:42','2015-01-01 19:38:42');

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
