-- MySQL dump 10.11
--
-- Host: localhost    Database: icroweb
-- ------------------------------------------------------
-- Server version	5.0.77

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
-- Table structure for table `caves`
--

DROP TABLE IF EXISTS `caves`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `caves` (
  `cave_id` int(11) NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `county` varchar(20) default NULL,
  `lat` double default NULL,
  `lng` double default NULL,
  `description` varchar(500) default NULL,
  PRIMARY KEY  (`cave_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `caves`
--

LOCK TABLES `caves` WRITE;
/*!40000 ALTER TABLE `caves` DISABLE KEYS */;
/*!40000 ALTER TABLE `caves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `counties`
--

DROP TABLE IF EXISTS `counties`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `counties` (
  `name` varchar(30) default NULL,
  `region_id` int(11) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `counties`
--

LOCK TABLES `counties` WRITE;
/*!40000 ALTER TABLE `counties` DISABLE KEYS */;
INSERT INTO `counties` VALUES ('Antrim',1),('Armagh',1),('Carlow',3),('Cavan',1),('Clare',2),('Cork',2),('Derry',1),('Donegal',1),('Down',1),('Dublin',3),('Fermanagh',1),('Galway',2),('Kerry',2),('Kildare',3),('Kilkenny',3),('Laois',3),('Leitrim',1),('Limerick',2),('Longford',3),('Louth',3),('Mayo',2),('Meath',3),('Monaghan',1),('Offaly',3),('Roscommon',2),('Sligo',1),('Tipperary',2),('Tyrone',1),('Waterford',3),('Westmeath',3),('Wexford',3),('Wicklow',3);
/*!40000 ALTER TABLE `counties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `regions` (
  `region_id` int(11) NOT NULL,
  `region` varchar(20) default NULL,
  PRIMARY KEY  (`region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `regions`
--

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` VALUES (0,'No Region Defined'),(1,'Northern Region'),(2,'South-Western Region'),(3,'Eastern Region');
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL auto_increment,
  `role` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Site Administrator'),(2,'Warden'),(3,'Core Team Member'),(4,'General Member'),(5,'Training Officer'),(6,'Equipment Officer'),(7,'First Aid Officer'),(8,'Callout Officer'),(9,'Public Relations Officer'),(10,'Reserve Warden'),(12,'Advanced Rigging'),(13,'Stretcher'),(14,'1/2 Day Media Training'),(15,'Shoring/Rockbreaking'),(16,'Medic'),(17,'Doctor'),(18,'Command Physician'),(19,'First Aid'),(20,'Basic Rigging'),(21,'Drug Administrator'),(22,'Communications'),(23,'Incident Management'),(24,'SSF Rigging'),(25,'CIC'),(26,'Full Day Media Training');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `status` (
  `status_id` tinyint(4) NOT NULL default '0',
  `status` varchar(20) default NULL,
  PRIMARY KEY  (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (0,'Available'),(1,'Not Available'),(2,'Standby requested'),(3,'On Standby'),(4,'Callout requested'),(5,'Called Out'),(6,'On Route'),(7,'OnSite - Undeployed'),(8,'OnSite - Overground'),(9,'OnSite - Underground');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL default '0',
  `role_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (2,1);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `user_status` (
  `user_id` int(11) NOT NULL default '0',
  `status_id` tinyint(4) default '0',
  `rescue_id` int(11) NOT NULL default '0',
  `team_id` int(11) NOT NULL default '0',
  `eta` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `user_status`
--

LOCK TABLES `user_status` WRITE;
/*!40000 ALTER TABLE `user_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `home_phone` varchar(20) default NULL,
  `mobile_phone` varchar(20) default NULL,
  `work_phone` varchar(20) default NULL,
  `other_phone` varchar(20) default NULL,
  `address_line1` varchar(45) default NULL,
  `address_line2` varchar(45) default NULL,
  `town` varchar(45) default NULL,
  `county` varchar(45) default NULL,
  `postcode` varchar(10) default NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `regdate` datetime default NULL,
  `last_login` datetime default NULL,
  `active` int(2) default NULL,
  `lat` float default NULL,
  `lng` float default NULL,
  `ffs_num` varchar(15) default NULL,
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `K_USERNAME` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','admin','d033e22ae348aeb5660fc2140aec35850c4da997',NULL,'2011-02-18 18:54:08',1,NULL,NULL,NULL);
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

-- Dump completed on 2011-02-18 23:56:11
