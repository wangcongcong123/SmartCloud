-- MySQL dump 10.13  Distrib 5.7.11, for osx10.9 (x86_64)
--
-- Host: localhost    Database: smartcloud
-- ------------------------------------------------------
-- Server version	5.7.11

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
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `contact_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `face` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `channel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `friend_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`contact_id`),
  KEY `contact_user_account_foreign` (`user_account`),
  KEY `contact_friend_account_foreign` (`friend_account`),
  CONSTRAINT `contact_friend_account_foreign` FOREIGN KEY (`friend_account`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contact_user_account_foreign` FOREIGN KEY (`user_account`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (2,'admin',NULL,NULL,'3999044639603300192','admin','2017-05-15 13:21:40','2017-05-16 02:35:30'),(3,'123@qq.com',NULL,NULL,'4181915684252378507','123@qq.com','2017-05-16 05:01:48','2017-05-16 05:01:48'),(5,'1234@qq.com',NULL,NULL,'4181915684252378507','1234@qq.com','2017-05-17 13:25:05','2017-05-17 13:25:05'),(8,'admin',NULL,NULL,'','123@qq.com','2017-05-17 14:24:02','2017-05-17 14:24:02'),(9,'123@qq.com',NULL,NULL,'','admin','2017-05-17 14:24:02','2017-05-17 14:24:02');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactprocess`
--

DROP TABLE IF EXISTS `contactprocess`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactprocess` (
  `process_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receiver` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`process_id`),
  KEY `contactprocess_sender_foreign` (`sender`),
  KEY `contactprocess_receiver_foreign` (`receiver`),
  CONSTRAINT `contactprocess_receiver_foreign` FOREIGN KEY (`receiver`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contactprocess_sender_foreign` FOREIGN KEY (`sender`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactprocess`
--

LOCK TABLES `contactprocess` WRITE;
/*!40000 ALTER TABLE `contactprocess` DISABLE KEYS */;
INSERT INTO `contactprocess` VALUES (1,'123@qq.com','admin','2017-05-16 05:03:18','2017-05-16 05:03:18');
/*!40000 ALTER TABLE `contactprocess` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `file_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filepath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `filetype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filesize` int(11) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`file_id`),
  UNIQUE KEY `files_parent_id_filename_unique` (`parent_id`,`filename`),
  KEY `files_user_account_foreign` (`user_account`),
  CONSTRAINT `files_user_account_foreign` FOREIGN KEY (`user_account`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=293 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (285,'1234@qq.com','gain','folder','','folder',0,284,'ison','2017-05-09 10:42:42','2017-05-09 10:42:42'),(287,'admin','7.jpeg','./uploads/admin/ison/7.jpeg','','image/jpeg',356317,0,'ison','2017-05-15 15:09:30','2017-05-15 15:09:30'),(288,'admin','hahaha','folder','','folder',0,0,'ison','2017-05-15 15:10:24','2017-05-15 15:10:24'),(289,'admin','q3.jpg','./uploads/admin/ison/q3.jpg','','application/octet-stream',27719,288,'ison','2017-05-16 02:32:01','2017-05-16 03:14:10'),(290,'123@qq.com','api.png','./uploads/123@qq.com/ison/api.png','','image/png',16114,0,'ison','2017-05-18 08:10:40','2017-05-18 08:10:40'),(292,'admin','b5.jpg','./uploads/admin/ison/b5.jpg','','image/jpeg',312042,0,'ison','2017-05-19 08:12:08','2017-05-19 08:12:08');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
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
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2017_04_04_034316_storage',2),('2017_04_04_042950_create_storage_table',3),('2017_04_04_055359_create_files_table',4),('2017_04_22_144553_create_pass_resets_table',5),('2017_04_27_122450_create_sharelist_table',6),('2017_04_27_123200_create_sharelist_table',7),('2017_04_27_123246_create_sharelist_table',8),('2017_04_27_130620_create_sharelist_table',9),('2017_05_14_220349_create_contact_table',10),('2017_05_14_220407_create_contactprocess_table',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pass_resets`
--

DROP TABLE IF EXISTS `pass_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pass_resets` (
  `reset_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`reset_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pass_resets`
--

LOCK TABLES `pass_resets` WRITE;
/*!40000 ALTER TABLE `pass_resets` DISABLE KEYS */;
INSERT INTO `pass_resets` VALUES (1,'1243324336@qq.com','8d47b38e8da5d8fbd85d27d82c696781','2017-05-09 05:15:47','2017-05-09 05:15:47');
/*!40000 ALTER TABLE `pass_resets` ENABLE KEYS */;
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('1222@qq.com','22121','2017-04-22 13:25:27');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sharelist`
--

DROP TABLE IF EXISTS `sharelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sharelist` (
  `share_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `share_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valid_time` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `share_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qrcode_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`share_id`),
  KEY `sharelist_user_account_foreign` (`user_account`),
  KEY `sharelist_file_id_foreign` (`file_id`),
  CONSTRAINT `sharelist_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`file_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sharelist_user_account_foreign` FOREIGN KEY (`user_account`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sharelist`
--

LOCK TABLES `sharelist` WRITE;
/*!40000 ALTER TABLE `sharelist` DISABLE KEYS */;
/*!40000 ALTER TABLE `sharelist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storage`
--

DROP TABLE IF EXISTS `storage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `storage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `total_volum` double NOT NULL,
  `used_volum` double NOT NULL,
  `user_account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `storage_user_account_unique` (`user_account`),
  CONSTRAINT `storage_user_account_foreign` FOREIGN KEY (`user_account`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storage`
--

LOCK TABLES `storage` WRITE;
/*!40000 ALTER TABLE `storage` DISABLE KEYS */;
INSERT INTO `storage` VALUES (1,100,0.67,'admin','2017-04-03 20:39:32','2017-05-19 16:37:36'),(5,100,0,'111@qq.com','2017-04-05 00:44:40','2017-04-05 00:48:15'),(6,100,0.36,'123@qq.com','2017-04-06 06:45:19','2017-05-19 08:07:53'),(11,100,0,'1234@163.com','2017-04-06 22:07:31','2017-04-08 05:51:30'),(12,100,0.11,'1243324336@qq.com','2017-04-22 21:49:26','2017-05-09 10:36:24'),(13,100,0.97,'1234@qq.com','2017-05-09 10:38:45','2017-05-17 14:51:56');
/*!40000 ALTER TABLE `storage` ENABLE KEYS */;
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
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','123',NULL,'2017-03-27 02:57:45','2017-03-27 02:57:45'),(3,'cong','123@qq.com','123',NULL,'2017-03-27 07:11:57','2017-03-27 07:11:57'),(4,'cc','111@qq.com','wang12345',NULL,'2017-03-27 17:55:35','2017-03-27 17:55:35'),(5,'haha','12345@qq.com','a38363163',NULL,'2017-03-30 23:12:18','2017-03-30 23:12:18'),(7,'cccc','1234@163.com','1234',NULL,'2017-04-06 22:05:45','2017-04-06 22:05:45'),(8,'congcongwang','1234@qq.com','a38363163',NULL,'2017-04-07 22:16:49','2017-04-07 22:16:49'),(9,'abc','admin3','202cb962ac59075b964b07152d234b70',NULL,'2017-04-22 11:18:27','2017-04-27 11:18:30'),(13,'congaing','1243324336@qq.com','123',NULL,'2017-04-22 04:48:45','2017-04-22 23:29:19'),(14,'admincong','18810925338@163.com','a38363163',NULL,'2017-04-22 23:36:38','2017-04-22 23:36:38');
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

-- Dump completed on 2017-05-20 10:41:28
