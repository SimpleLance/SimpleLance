-- MySQL dump 10.13  Distrib 5.6.19, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: homestead
-- ------------------------------------------------------
-- Server version	5.6.19-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_statuses`
--

DROP TABLE IF EXISTS `invoice_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_statuses`
--

LOCK TABLES `invoice_statuses` WRITE;
/*!40000 ALTER TABLE `invoice_statuses` DISABLE KEYS */;
INSERT INTO `invoice_statuses` VALUES (1,'Open','2015-09-22 02:47:51','2015-09-22 02:47:51'),(2,'Overdue','2015-09-22 02:47:51','2015-09-22 02:47:51'),(3,'Draft','2015-09-22 02:47:51','2015-09-22 02:47:51'),(4,'Paid','2015-09-22 02:47:51','2015-09-22 02:47:51'),(5,'Cancelled','2015-09-22 02:47:51','2015-09-22 02:47:51');
/*!40000 ALTER TABLE `invoice_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `due` date NOT NULL,
  `status_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (1,'1987-02-27',1,39.11,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(2,'1981-06-18',3,2.03,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(3,'1981-08-19',3,0.56,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(4,'1972-07-11',2,4.12,2,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(5,'1974-09-22',4,99999999.99,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(6,'1983-06-04',1,0.58,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(7,'1983-05-11',3,46.38,2,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(8,'1999-06-03',3,99999999.99,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(9,'2001-05-29',2,6212296.29,2,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(10,'1999-01-21',1,6027.13,1,'2015-09-22 02:47:51','2015-09-22 02:47:51');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2014_12_22_012146_create_projects_table',1),('2014_12_22_130417_create_tickets_table',1),('2014_12_23_020214_create_priorities_table',1),('2014_12_24_203904_create_statuses_table',1),('2014_12_29_134211_create_invoices_table',1),('2014_12_31_082924_create_ticket_replies_table',1),('2015_01_12_141846_add_fields_to_users_table',1),('2015_01_14_053439_migration_sentinel_add_username',1),('2015_02_03_055302_create_invoice_statuses_table',1),('2015_02_03_072806_create_invoice_items_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `priorities`
--

DROP TABLE IF EXISTS `priorities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `priorities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `priorities`
--

LOCK TABLES `priorities` WRITE;
/*!40000 ALTER TABLE `priorities` DISABLE KEYS */;
INSERT INTO `priorities` VALUES (1,'Low','2015-09-22 02:47:51','2015-09-22 02:47:51'),(2,'Medium','2015-09-22 02:47:51','2015-09-22 02:47:51'),(3,'High','2015-09-22 02:47:51','2015-09-22 02:47:51'),(4,'Urgent','2015-09-22 02:47:51','2015-09-22 02:47:51'),(5,'Critical','2015-09-22 02:47:51','2015-09-22 02:47:51');
/*!40000 ALTER TABLE `priorities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Sample Project','Test project',1,1,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(2,'Sample Project','Test project',1,1,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(3,'Sample Project','Test project',1,1,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(4,'Sample Project','Test project',1,1,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(5,'Sample Project','Test project',1,1,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(6,'Sample Project','Test project',2,1,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(7,'Sample Project','Test project',2,1,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(8,'Sample Project','Test project',2,1,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(9,'Sample Project','Test project',2,1,1,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(10,'Sample Project','Test project',2,1,1,'2015-09-22 02:47:51','2015-09-22 02:47:51');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` VALUES (1,'Open','2015-09-22 02:47:51','2015-09-22 02:47:51'),(2,'In Progress','2015-09-22 02:47:51','2015-09-22 02:47:51'),(3,'On Hold','2015-09-22 02:47:51','2015-09-22 02:47:51'),(4,'Closed','2015-09-22 02:47:51','2015-09-22 02:47:51');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_replies`
--

DROP TABLE IF EXISTS `ticket_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_replies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_replies`
--

LOCK TABLES `ticket_replies` WRITE;
/*!40000 ALTER TABLE `ticket_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,'Provident iusto ea qui ipsum repellat autem dolorem.','Et voluptates repellat repellendus ut perspiciatis aut.',1,1,1,0,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(2,'Facilis ratione dolores doloremque voluptas.','Doloribus repellat sit labore architecto qui perferendis qui.',1,1,1,0,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(3,'Itaque dolores rerum vitae aut saepe rem.','Est voluptatem sit voluptatem quibusdam sunt.',1,1,1,0,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(4,'Hic eaque rerum et dicta minus.','Omnis veniam eos ex sapiente rerum.',1,1,1,0,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(5,'Occaecati iusto ut ea excepturi nam.','Necessitatibus aliquam dolores similique.',1,1,1,0,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(6,'Ea quia perspiciatis ut doloremque.','Harum autem facilis qui consequatur ratione porro dignissimos.',1,1,2,0,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(7,'Molestiae soluta sit ullam culpa explicabo vero.','Maiores ut ullam rem qui.',1,1,2,0,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(8,'Labore voluptatem odio dolor perspiciatis.','Pariatur sunt optio labore explicabo recusandae.',1,1,2,0,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(9,'Facere neque pariatur natus sunt.','Dignissimos voluptatem nisi debitis ut.',1,1,2,0,'2015-09-22 02:47:51','2015-09-22 02:47:51'),(10,'Dolore aliquid laudantium dolores voluptatem harum nobis.','Provident ullam velit est harum.',1,1,2,0,'2015-09-22 02:47:51','2015-09-22 02:47:51');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `country` text COLLATE utf8_unicode_ci NOT NULL,
  `post_code` text COLLATE utf8_unicode_ci NOT NULL,
  `state` text COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `address2` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'','admin@admin.com','$2y$10$CWeWC3riehyXj3FoZ36csOINu7k4elhGx54J9rjOmVQO49BDv5w6y','','','','','','','',1,NULL,'2015-09-22 02:47:50','2015-09-22 02:47:50','admin'),(2,'','user@user.com','$2y$10$zVsEXVgwvOqWblRqA7gHGeIpbHouNTDqk17bzHYKkxSd6euyziium','','','','','','','',0,NULL,'2015-09-22 02:47:50','2015-09-22 02:47:50','user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-22  2:48:33
