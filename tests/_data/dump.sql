# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19-0ubuntu0.14.04.1)
# Database: homestead
# Generation Time: 2014-12-30 14:56:48 +0000
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
	(1,'Users','{\"users\":1}','2014-12-30 14:52:23','2014-12-30 14:52:23'),
	(2,'Admins','{\"admin\":1,\"users\":1}','2014-12-30 14:52:23','2014-12-30 14:52:23');

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
	(1,'quod','1970-12-05',3,'4690.16',2,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(2,'molestias','2008-06-20',4,'1.76',2,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(3,'dolorem','1976-07-12',1,'4.15',2,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(4,'dolorem','1998-11-30',2,'87044292.94',1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(5,'sunt','1979-08-14',1,'30.31',2,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(6,'nam','1989-09-01',2,'379090810.73',1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(7,'impedit','2013-11-10',2,'64207.53',1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(8,'non','2014-09-17',4,'4.76',1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(9,'reprehenderit','1995-08-21',4,'1.86',1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(10,'adipisci','1999-08-21',1,'24879.95',1,'2014-12-30 14:52:24','2014-12-30 14:52:24');

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
	('2014_12_29_134211_create_invoices_table',1);

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
	(1,'Low','2014-12-30 14:52:23','2014-12-30 14:52:23'),
	(2,'Medium','2014-12-30 14:52:23','2014-12-30 14:52:23'),
	(3,'High','2014-12-30 14:52:23','2014-12-30 14:52:23'),
	(4,'Urgent','2014-12-30 14:52:23','2014-12-30 14:52:23'),
	(5,'Critical','2014-12-30 14:52:23','2014-12-30 14:52:23');

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
	(1,'Sample Project','Test project',1,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(2,'Sample Project','Test project',1,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(3,'Sample Project','Test project',1,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(4,'Sample Project','Test project',1,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(5,'Sample Project','Test project',1,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(6,'Sample Project','Test project',2,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(7,'Sample Project','Test project',2,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(8,'Sample Project','Test project',2,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(9,'Sample Project','Test project',2,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(10,'Sample Project','Test project',2,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24');

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
	(1,'Open','2014-12-30 14:52:23','2014-12-30 14:52:23'),
	(2,'In Progress','2014-12-30 14:52:23','2014-12-30 14:52:23'),
	(3,'On Hold','2014-12-30 14:52:23','2014-12-30 14:52:23'),
	(4,'Closed','2014-12-30 14:52:23','2014-12-30 14:52:23');

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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;

INSERT INTO `tickets` (`id`, `title`, `description`, `priority_id`, `status_id`, `owner_id`, `created_at`, `updated_at`)
VALUES
	(1,'Et aut voluptatem nulla quod eius suscipit.','Ratione velit eum illum nihil.',1,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(2,'Eligendi rerum nihil adipisci.','Enim optio eligendi perspiciatis et porro nam.',1,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(3,'Vel odio sint beatae a dolore dolorem.','Est sit quas hic.',1,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(4,'Voluptatem praesentium in et dolorem eveniet est voluptas.','Nulla ex iste quibusdam est consequatur mollitia.',1,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(5,'Facere eveniet molestiae numquam earum quis.','Labore rerum dolorem dicta et amet.',1,1,1,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(6,'Ut fugit non dolore expedita ut harum amet.','Molestiae officia aut ab blanditiis ex nobis quam.',1,1,2,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(7,'Soluta aliquam sit nobis itaque.','Atque asperiores quae et reiciendis sed doloribus debitis.',1,1,2,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(8,'Id sunt temporibus amet aliquam.','Quibusdam ut hic nemo sed voluptatum enim.',1,1,2,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(9,'Quos earum rerum repellat autem reiciendis.','Id vero eos et corporis consectetur quae et.',1,1,2,'2014-12-30 14:52:24','2014-12-30 14:52:24'),
	(10,'Eveniet cupiditate nisi reiciendis velit vitae.','Nulla accusantium ex maiores amet excepturi iste non.',1,1,2,'2014-12-30 14:52:24','2014-12-30 14:52:24');

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
	(1,'admin@admin.com','admin','$2y$10$RQO40TB9OKtcWBFU8yinuelD9jN/TZfH3zhHSPDQjk37OJevO5eG6',NULL,1,NULL,NULL,'2014-12-30 14:52:49','$2y$10$/8QKHhSG.KAtf15xirX4Gep2dX9byy/7RnhmKv24wwby33azwvl8W',NULL,NULL,NULL,'2014-12-30 14:52:23','2014-12-30 14:52:49'),
	(2,'user@user.com','user','$2y$10$e5hTEFfAewuZo3RNkeZFe.A9HC5Rjj17tLOhLmIsNs9sPtqDPsnSy',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-12-30 14:52:23','2014-12-30 14:52:23');

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
