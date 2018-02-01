-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: alpadia
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.17.10.1

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
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (5,'Bon','Scott','bonscott@acdc.com','2018-02-01 20:33:12','2018-02-01 20:33:12'),(6,'Jim','Morrison','jimmorrison@thedoors.com','2018-02-01 20:33:42','2018-02-01 20:33:42'),(7,'Jimmy','Page','jimmypage@ledzeppelin.com','2018-02-01 20:34:09','2018-02-01 20:34:09'),(8,'Axl','Rose','axlrose@gunsnroses.com','2018-02-01 20:34:52','2018-02-01 20:34:52');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members_videogames`
--

DROP TABLE IF EXISTS `members_videogames`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members_videogames` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `videogame_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_members_idx` (`member_id`),
  KEY `fk_videogames_idx` (`videogame_id`),
  CONSTRAINT `fk_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_videogames` FOREIGN KEY (`videogame_id`) REFERENCES `videogames` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members_videogames`
--

LOCK TABLES `members_videogames` WRITE;
/*!40000 ALTER TABLE `members_videogames` DISABLE KEYS */;
INSERT INTO `members_videogames` VALUES (1,5,1),(2,5,2),(3,5,3),(4,5,4);
/*!40000 ALTER TABLE `members_videogames` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videogames`
--

DROP TABLE IF EXISTS `videogames`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videogames` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `company` enum('Nintendo','SEGA','Sony','Microsoft') NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videogames`
--

LOCK TABLES `videogames` WRITE;
/*!40000 ALTER TABLE `videogames` DISABLE KEYS */;
INSERT INTO `videogames` VALUES (1,'Sonic the Hedgehog','SEGA','2018-02-01 19:12:51','2018-02-01 19:12:51'),(2,'Sonic the Hedgehog 2','SEGA','2018-02-01 19:13:34','2018-02-01 19:13:34'),(3,'Sonic the Hedgehog 3','SEGA','2018-02-01 19:14:25','2018-02-01 19:14:25'),(4,'Gran Turismo','Sony','2018-02-01 19:16:35','2018-02-01 19:16:35'),(5,'Gran Turismo 2','Sony','2018-02-01 19:16:38','2018-02-01 19:16:38'),(6,'Splatoon','Nintendo','2018-02-01 19:16:51','2018-02-01 19:16:51'),(7,'Splatoon 2','Nintendo','2018-02-01 19:16:55','2018-02-01 19:16:55'),(8,'LEGO Marvel Superheroes','Nintendo','2018-02-01 19:17:07','2018-02-01 19:17:07'),(9,'LEGO Marvel Superheroes 2','Nintendo','2018-02-01 19:17:10','2018-02-01 19:17:10'),(10,'DOOM','Microsoft','2018-02-01 19:17:18','2018-02-01 19:17:18'),(11,'Binary Domain','SEGA','2018-02-01 19:17:28','2018-02-01 19:17:28'),(12,'Bayonetta','SEGA','2018-02-01 19:17:41','2018-02-01 19:17:41'),(13,'Bayonetta 2','SEGA','2018-02-01 19:17:46','2018-02-01 19:17:46'),(14,'Super Mario Bros','Nintendo','2018-02-01 19:18:19','2018-02-01 19:18:19'),(15,'Super Mario Land','Nintendo','2018-02-01 19:18:22','2018-02-01 19:18:22'),(16,'Super Mario Galaxy','Nintendo','2018-02-01 19:18:27','2018-02-01 19:18:27'),(17,'Super Mario Odyssey','Nintendo','2018-02-01 19:18:32','2018-02-01 19:18:32'),(18,'Rocket League','Microsoft','2018-02-01 19:18:43','2018-02-01 19:18:43'),(19,'Wind Jammers','Nintendo','2018-02-01 19:18:50','2018-02-01 19:18:50'),(20,'Super Street Fighter','Nintendo','2018-02-01 20:58:44','2018-02-01 21:07:56');
/*!40000 ALTER TABLE `videogames` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-01 21:19:16
