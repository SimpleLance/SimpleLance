# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19-0ubuntu0.14.04.1)
# Database: homestead
# Generation Time: 2014-12-30 14:22:39 +0000
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
	(1,'Users','{\"users\":1}','2014-12-30 14:21:50','2014-12-30 14:21:50'),
	(2,'Admins','{\"admin\":1,\"users\":1}','2014-12-30 14:21:50','2014-12-30 14:21:50');

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
	(1,'aut','1986-02-19',1,'1.42',1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(2,'voluptates','1984-07-30',1,'4.98',1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(3,'cupiditate','1994-01-17',4,'23308.95',1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(4,'qui','1999-02-22',4,'1331548',1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(5,'consequatur','1982-04-04',2,'60359704.81',2,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(6,'dolor','2003-02-02',1,'9.16',2,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(7,'molestias','2010-11-16',2,'29095556.46',2,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(8,'quis','1989-11-27',1,'14797.41',2,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(9,'totam','1994-02-28',2,'574.87',1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(10,'officiis','1991-04-27',3,'685292.45',1,'2014-12-30 14:21:51','2014-12-30 14:21:51');

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
	(1,'Low','2014-12-30 14:21:50','2014-12-30 14:21:50'),
	(2,'Medium','2014-12-30 14:21:50','2014-12-30 14:21:50'),
	(3,'High','2014-12-30 14:21:50','2014-12-30 14:21:50'),
	(4,'Urgent','2014-12-30 14:21:50','2014-12-30 14:21:50'),
	(5,'Critical','2014-12-30 14:21:50','2014-12-30 14:21:50');

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
	(1,'Sample Project','Test project',1,1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(2,'Sample Project','Test project',1,1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(3,'Sample Project','Test project',1,1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(4,'Sample Project','Test project',1,1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(5,'Sample Project','Test project',1,1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(6,'Sample Project','Test project',2,1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(7,'Sample Project','Test project',2,1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(8,'Sample Project','Test project',2,1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(9,'Sample Project','Test project',2,1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(10,'Sample Project','Test project',2,1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51');

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
	(1,'Open','2014-12-30 14:21:50','2014-12-30 14:21:50'),
	(2,'In Progress','2014-12-30 14:21:50','2014-12-30 14:21:50'),
	(3,'On Hold','2014-12-30 14:21:50','2014-12-30 14:21:50'),
	(4,'Closed','2014-12-30 14:21:50','2014-12-30 14:21:50');

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



# Dump of table tickets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `priority_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;

INSERT INTO `tickets` (`id`, `title`, `description`, `priority_id`, `owner_id`, `created_at`, `updated_at`)
VALUES
	(1,'Voluptate esse architecto ut voluptas sapiente inventore.','Eos at est ut deleniti est quia.',1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(2,'Ipsa consectetur delectus ut excepturi.','Qui sunt eaque et culpa numquam ut vel.',1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(3,'Cupiditate temporibus facilis sint.','Et aut explicabo maiores rerum.',1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(4,'Aut enim necessitatibus reprehenderit ab dignissimos.','Ut iusto aliquid quia temporibus rem quae.',1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(5,'Qui et mollitia recusandae id molestias labore.','Vero praesentium aut fugit et dolorem.',1,1,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(6,'Sequi pariatur dicta dolorem et sit.','Nobis et temporibus et vitae et illo maiores.',1,2,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(7,'Eos distinctio ducimus nam voluptas aspernatur repudiandae.','Exercitationem officia laboriosam accusamus ut similique deleniti.',1,2,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(8,'Quisquam iure repellendus aut vitae.','Id reiciendis mollitia voluptatem voluptatum sed qui.',1,2,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(9,'Voluptatem ut in ducimus sit sit et.','Minima alias labore unde qui eveniet.',1,2,'2014-12-30 14:21:51','2014-12-30 14:21:51'),
	(10,'Quisquam aut in labore vel et repellendus.','Velit qui laborum architecto consequatur sed reprehenderit voluptatem.',1,2,'2014-12-30 14:21:51','2014-12-30 14:21:51');

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
	(1,'admin@admin.com','admin','$2y$10$5iynUaJzrKHNMGCgqrdVceKmTmfutngEzeUP8vw7l0BGYJbbwnpFG',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-12-30 14:21:50','2014-12-30 14:21:50'),
	(2,'user@user.com','user','$2y$10$061Ecy87b16RKfsqN0jLkuVrFF2xpKPZL1dMNlZNygWF9wTHydpDG',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-12-30 14:21:50','2014-12-30 14:21:50');

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
