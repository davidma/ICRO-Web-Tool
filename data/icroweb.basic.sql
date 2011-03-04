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
-- Table structure for table `cave_docs`
--

DROP TABLE IF EXISTS `cave_docs`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cave_docs` (
  `cave_id` int(11) NOT NULL default '0',
  `doc_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`cave_id`,`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `cave_docs`
--

LOCK TABLES `cave_docs` WRITE;
/*!40000 ALTER TABLE `cave_docs` DISABLE KEYS */;
/*!40000 ALTER TABLE `cave_docs` ENABLE KEYS */;
UNLOCK TABLES;

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
  `description` text,
  `enabled` tinyint(1) default '0',
  PRIMARY KEY  (`cave_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2484 DEFAULT CHARSET=latin1;
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
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `documents` (
  `doc_id` int(11) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `size` int(11) NOT NULL,
  `content` mediumblob NOT NULL,
  PRIMARY KEY  (`doc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
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
-- Table structure for table `rescue_log`
--

DROP TABLE IF EXISTS `rescue_log`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `rescue_log` (
  `rescue_log_id` int(11) NOT NULL auto_increment,
  `rescue_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY  (`rescue_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `rescue_log`
--

LOCK TABLES `rescue_log` WRITE;
/*!40000 ALTER TABLE `rescue_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `rescue_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rescues`
--

DROP TABLE IF EXISTS `rescues`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `rescues` (
  `rescue_id` int(11) NOT NULL auto_increment,
  `cave_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `date` datetime default NULL,
  `status` int(3) default NULL,
  `comments` longtext,
  `type` int(3) default NULL,
  PRIMARY KEY  (`rescue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `rescues`
--

LOCK TABLES `rescues` WRITE;
/*!40000 ALTER TABLE `rescues` DISABLE KEYS */;
/*!40000 ALTER TABLE `rescues` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Site Administrator'),(2,'Warden'),(3,'Core Team Member'),(4,'General Member'),(5,'Training Officer'),(6,'Equipment Officer'),(7,'First Aid Officer'),(8,'Callout Officer'),(9,'Public Relations Officer'),(10,'Reserve Warden'),(101,'Advanced Rigging'),(102,'Stretcher'),(103,'1/2 Day Media Training'),(104,'Shoring/Rockbreaking'),(105,'Medic'),(106,'Doctor'),(107,'Command Physician'),(108,'First Aid'),(109,'Basic Rigging'),(110,'Drug Administrator'),(111,'Communications'),(112,'Incident Management'),(113,'SSF Rigging'),(114,'CIC'),(115,'Full Day Media Training');
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
-- Table structure for table `system_log`
--

DROP TABLE IF EXISTS `system_log`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `system_log` (
  `log_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY  (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `system_log`
--

LOCK TABLES `system_log` WRITE;
/*!40000 ALTER TABLE `system_log` DISABLE KEYS */;
INSERT INTO `system_log` VALUES (213,2,'2011-03-04 18:37:03','User admin logged in');
/*!40000 ALTER TABLE `system_log` ENABLE KEYS */;
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
INSERT INTO `user_status` VALUES (2,0,0,0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'System','Administrator','','1234','','','','','No Town','No County','','no-reply@icro.ie','admin','d033e22ae348aeb5660fc2140aec35850c4da997',NULL,'2011-03-04 18:37:14',1,NULL,NULL,'');
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

-- Dump completed on 2011-03-04 18:37:35
