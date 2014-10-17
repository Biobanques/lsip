-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: SIP
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1-log

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
-- Dumping data for table `Patient`
--

LOCK TABLES `Patient` WRITE;
/*!40000 ALTER TABLE `Patient` DISABLE KEYS */;
INSERT INTO `Patient` VALUES (1000885,'Dale','Dale','Kareem','2005-11-30 00:00:00',2,'M','0'),(1001134,'Vaughn','Vaughn','Justin','1998-12-30 00:00:00',2,'M','0'),(1005340,'Huber','Huber','Grady','1950-07-31 00:00:00',1,'F','0'),(1019003,'Conrad','Conrad','Baker','1938-09-01 00:00:00',1,'F','0'),(1024344,'Baxter','Baxter','Lionel','2012-04-25 00:00:00',1,'F','0'),(1025778,'Pena','Pena','Vernon','1979-02-05 00:00:00',1,'M','0'),(1029118,'Knox','Knox','Samson','1959-01-05 00:00:00',2,'M','0'),(1043809,'Dodson','Dodson','Hayes','2010-01-12 00:00:00',1,'M','0'),(1044442,'Burt','Burt','Jacob','1934-08-28 00:00:00',1,'F','0'),(1044782,'Clements','Clements','Graiden','2012-09-22 00:00:00',2,'M','0'),(1048234,'Chase','Chase','Ryder','1937-09-06 00:00:00',1,'M','0'),(1049971,'Perkins','Perkins','Stewart','1984-12-21 00:00:00',1,'F','0'),(1069126,'Ramos','Ramos','Galvin','1969-03-21 00:00:00',1,'F','0'),(1076958,'Phelps','Phelps','Kirk','1969-02-24 00:00:00',1,'F','0'),(1091768,'Clements','Clements','Graiden','2012-09-22 00:00:00',2,'M','0'),(1099057,'Dickson','Dicksonmarried','Drew','1946-11-01 00:00:00',2,'F','0'),(1108188,'Rios','Rios','Jeremy','1953-09-21 00:00:00',2,'M','0'),(1108962,'Noel','Noelmarried','Tiger','1997-09-18 00:00:00',2,'F','0'),(1113522,'Gonzales','Gonzales','Ian','1968-04-21 00:00:00',2,'M','0'),(1163079,'Hayden','Hayden','Calvin','1996-08-17 00:00:00',1,'M','0'),(1168985,'Mitchell','Mitchell','Eagan','1928-11-23 00:00:00',1,'F','0'),(1181832,'Wagner','Wagner','Mannix','1996-10-28 00:00:00',2,'M','0'),(1196882,'Davidson','Davidson','Evan','1968-08-16 00:00:00',2,'M','0'),(1198302,'Skinner','Skinner','Warren','1955-10-08 00:00:00',2,'M','0'),(1199841,'Morrison','Morrison','Alfonso','1996-10-28 00:00:00',1,'M','0'),(1212421,'Macias','Macias','Rudyard','1962-09-21 00:00:00',1,'F','0'),(1218724,'Vega','Vega','Lucius','1985-01-30 00:00:00',1,'M','0'),(1223183,'Valentine','Valentine','Clinton','1983-12-27 00:00:00',1,'F','0'),(1234548,'Ayala','Ayala','Colby','1989-09-30 00:00:00',2,'M','0'),(1236733,'Whitley','Whitley','Grady','1969-01-28 00:00:00',2,'M','0'),(1245033,'Hubbard','Hubbard','Graham','1974-01-14 00:00:00',2,'M','0'),(1266171,'Copeland','Copeland','Cody','1961-11-13 00:00:00',1,'M','0'),(1267305,'Wheeler','Wheeler','Otto','1939-04-20 00:00:00',1,'M','0'),(1275286,'Wheeler','Wheeler','Elmo','1972-04-07 00:00:00',1,'F','0'),(1276602,'Harrington','Harringtonmarried','Allen','1985-04-15 00:00:00',2,'F','0'),(1281176,'Douglas','Douglas','Edan','1934-06-13 00:00:00',1,'F','0'),(1283277,'Jenkins','Jenkinsmarried','Wayne','1977-01-21 00:00:00',2,'F','0'),(1295683,'Horn','Horn','Harper','1986-11-13 00:00:00',1,'F','0'),(1305071,'Scott','Scott','Graiden','1960-09-03 00:00:00',1,'M','0'),(1306846,'Huber','Huber','Grady','1950-07-31 00:00:00',2,'F','0'),(1322005,'Harrington','Harringtonmarried','Allene','1985-04-20 00:00:00',1,'F','0'),(1334354,'Porter','Porter','Jackson','1940-01-20 00:00:00',2,'M','0'),(1339493,'Chandler','Chandler','Howard','1978-07-13 00:00:00',2,'M','0'),(1351618,'Frazier','Frazier','Marvin','1949-09-23 00:00:00',2,'M','0'),(1372499,'Mcguire','Mcguire','Stone','1940-06-23 00:00:00',1,'M','0'),(1373999,'Cote','Cote','Paki','1969-11-08 00:00:00',1,'F','0'),(1381406,'Wilkerson','Wilkerson','Mufutau','1997-08-21 00:00:00',2,'M','0'),(1382292,'Moody','Moodymarried','Edan','1930-06-25 00:00:00',2,'F','0'),(1393859,'Ray','Raymarried','Stone','1975-11-15 00:00:00',2,'F','0'),(1399200,'Bowers','Bowers','Barrett','1999-02-27 00:00:00',2,'M','0'),(1401228,'Conway','Conway','Gregory','2002-10-24 00:00:00',1,'F','0'),(1412134,'Gilbert','Gilbert','Fritz','1935-05-10 00:00:00',2,'M','0'),(1413059,'Harrell','Harrellmarried','Finn','1967-06-02 00:00:00',2,'F','0'),(1421486,'Spence','Spence','Brandon','1946-10-16 00:00:00',1,'M','0'),(1423544,'Maldonado','Maldonado','Blake','1970-06-01 00:00:00',1,'M','0'),(1425562,'Mcintyre','Mcintyre','Sylvester','1950-03-10 00:00:00',1,'M','0'),(1441150,'Aguirre','Aguirre','Garrison','1956-03-31 00:00:00',2,'M','0'),(1455944,'Harrington','Harrington','Allen','1985-04-15 00:00:00',1,'M','0'),(1459596,'Carpenter','Carpenter','Felix','1971-05-03 00:00:00',2,'M','0'),(1462345,'Crosby','Crosbymarried','Nasim','1938-04-22 00:00:00',2,'F','0'),(1492485,'Rush','Rush','Kadeem','1977-08-24 00:00:00',2,'M','0'),(1492671,'Vang','Vang','Joshua','1978-09-15 00:00:00',1,'M','0'),(1497547,'Valencia','Valencia','Norman','1989-01-15 00:00:00',1,'F','0'),(1501890,'Harrington','Harringtonmarried','Allen','1985-04-15 00:00:00',2,'F','0'),(1503451,'Marsh','Marsh','Lamar','1936-09-19 00:00:00',1,'F','0'),(1506687,'Huber','Hubermarried','Grady','1950-07-31 00:00:00',2,'F','0'),(1510966,'Garner','Garner','Baxter','2006-04-13 00:00:00',1,'M','0'),(1517114,'Boyle','Boyle','James','1971-04-05 00:00:00',1,'F','0'),(1521719,'Huber','Hubermarried','Grady','1950-07-31 00:00:00',2,'F','0'),(1540983,'Mcgowan','Mcgowan','Derek','1932-05-24 00:00:00',1,'M','0'),(1545189,'Pitts','Pittsmarried','Oren','1973-08-02 00:00:00',2,'F','0'),(1550785,'Watkins','Watkins','Ciaran','2000-04-25 00:00:00',1,'F','0'),(1564307,'Burgess','Burgess','Mark','1970-05-04 00:00:00',1,'M','0'),(1574308,'Burton','Burton','Brandon','1976-09-18 00:00:00',1,'M','0'),(1587049,'Hawkins','Hawkinsmarried','Prescott','1945-06-10 00:00:00',2,'F','0'),(1607672,'Scott','Scott','Graiden','1960-09-03 00:00:00',1,'M','0'),(1609233,'Huber','Hubermarried','Grady','1950-07-31 00:00:00',2,'F','0'),(1615650,'Aguirre','Aguirre','Garrison','1956-03-31 00:00:00',1,'M','0'),(1616785,'Mcfadden','Mcfadden','Finn','1989-02-07 00:00:00',1,'M','0'),(1633835,'Riddle','Riddle','Theodore','1932-02-27 00:00:00',2,'M','0'),(1636712,'Peterson','Peterson','Herrod','1996-08-01 00:00:00',1,'F','0'),(1658879,'Shaffer','Shaffer','Fulton','1978-08-06 00:00:00',2,'M','0'),(1663126,'Larsen','Larsen','Hedley','1960-02-18 00:00:00',1,'F','0'),(1667038,'Howard','Howard','Nigel','2005-10-04 00:00:00',1,'M','0'),(1670595,'Delgado','Delgado','Chancellor','1978-03-12 00:00:00',1,'F','0'),(1671439,'Mckay','Mckay','Yuli','1995-02-14 00:00:00',2,'M','0'),(1704764,'Johnston','Johnston','Kermit','1975-12-11 00:00:00',1,'M','0'),(1707114,'Allison','Allison','Isaac','1934-10-26 00:00:00',1,'M','0'),(1707574,'Turner','Turnermarried','Orlando','1941-12-14 00:00:00',2,'F','0'),(1708742,'Key','Key','Herrod','2011-09-25 00:00:00',1,'M','0'),(1730633,'Valentine','Valentine','Clinton','1983-12-27 00:00:00',1,'F','0'),(1744901,'Cabrera','Cabrera','Alan','1932-08-01 00:00:00',1,'F','0'),(1746140,'Drake','Drake','Chester','1929-09-16 00:00:00',2,'M','0'),(1766490,'Dejesus','Dejesus','Rashad','1944-07-11 00:00:00',1,'F','0'),(1777137,'Turner','Turnermarried','Orlando','1941-12-14 00:00:00',2,'F','0'),(1780605,'Patton','Patton','Lamar','1974-05-05 00:00:00',1,'M','0'),(1792784,'Harrington','Harrington','Allen','1985-04-05 00:00:00',1,'F','0'),(1795437,'Caldwell','Caldwell','Ishmael','1965-04-09 00:00:00',2,'M','0'),(1825086,'Soto','Soto','Clayton','1952-09-20 00:00:00',1,'F','0'),(1831901,'Cabrera','Cabrera','Colorado','2008-10-09 00:00:00',1,'F','0'),(1840910,'Carpenter','Carpenter','Felix','1971-05-03 00:00:00',2,'M','0'),(1843671,'Horn','Horn','Beau','1931-10-21 00:00:00',1,'M','0'),(1855766,'Clements','Clements','John','2012-09-21 00:00:00',1,'M','0'),(1890409,'Berg','Bergmarried','Jason','1993-07-23 00:00:00',2,'F','0'),(1892172,'Ayala','Ayala','Colby','1989-09-30 00:00:00',1,'M','0'),(1894219,'Estes','Estes','Josiah','2005-03-20 00:00:00',2,'M','0'),(1900548,'Morgan','Morganmarried','Ashton','1943-09-05 00:00:00',2,'F','0'),(1909122,'Summers','Summers','Dustin','1988-10-16 00:00:00',1,'F','0'),(1912903,'Mooney','Mooneymarried','Leo','1952-06-05 00:00:00',2,'F','0'),(1923669,'Chandler','Chandler','Howard','1978-07-13 00:00:00',2,'M','0'),(1924555,'Leonard','Leonardmarried','Myles','1961-11-29 00:00:00',2,'F','0'),(1948631,'Frank','Frankmarried','Solomon','1972-10-12 00:00:00',2,'F','0'),(1950138,'Cummings','Cummingsmarried','Tanner','1954-01-09 00:00:00',2,'F','0'),(1966675,'Knox','Knox','Cade','1949-08-23 00:00:00',1,'F','0'),(1969675,'David','Davidmarried','Price','1995-04-11 00:00:00',2,'F','0'),(1983050,'Blackburn','Blackburn','Deacon','1953-08-02 00:00:00',1,'M','0'),(1984176,'Lindsay','Lindsay','Ryan','2005-04-28 00:00:00',2,'M','0');
/*!40000 ALTER TABLE `Patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `Rapprochement`
--

-- LOCK TABLES `Rapprochement` WRITE;
-- /*!40000 ALTER TABLE `Rapprochement` DISABLE KEYS */;
-- INSERT INTO `Rapprochement` VALUES (1,1306846,1005340,'2'),(2,1506687,1005340,'1'),(3,1521719,1005340,'1'),(4,1609233,1005340,'0'),(8,1091768,1044782,'0'),(9,1855766,1044782,'2'),(11,1855766,1091768,'2'),(12,1730633,1223183,'0'),(13,1892172,1234548,'1'),(14,1501890,1276602,'0'),(15,1792784,1276602,'2'),(16,1322005,1276602,'2'),(17,1455944,1276602,'0'),(21,1607672,1305071,'0'),(22,1506687,1306846,'0'),(23,1521719,1306846,'0'),(24,1609233,1306846,'0'),(25,1501890,1322005,'2'),(26,1792784,1322005,'0'),(28,1923669,1339493,'0'),(29,1615650,1441150,'2'),(30,1792784,1455944,'0'),(31,1501890,1455944,'1'),(33,1840910,1459596,'0'),(34,1792784,1501890,'2'),(35,1521719,1506687,'0'),(36,1609233,1506687,'0'),(38,1609233,1521719,'0'),(39,1777137,1707574,'0');
-- /*!40000 ALTER TABLE `Rapprochement` ENABLE KEYS */;
-- UNLOCK TABLES;

--
-- Dumping data for table `Sources`
--

-- LOCK TABLES `Sources` WRITE;
-- /*!40000 ALTER TABLE `Sources` DISABLE KEYS */;
-- INSERT INTO `Sources` VALUES (1,'bb_cerveau',NULL,6,4),(2,'bb_adn',NULL,7,5);
-- /*!40000 ALTER TABLE `Sources` ENABLE KEYS */;
-- UNLOCK TABLES;
-- 
-- --
-- -- Dumping data for table `users`
-- --
-- 
-- LOCK TABLES `users` WRITE;
-- /*!40000 ALTER TABLE `users` DISABLE KEYS */;
-- INSERT INTO `users` VALUES (2,'PENICAUD','Matthieu','1','matth','guizmo'),(3,'MALSERVET','Nicolas','1','nmalservet','bbadmin'),(4,'webapp','cerveau','2','cbsd_cer','cerWA'),(5,'webapp','adn','2','cbsd_adn','adnWA'),(6,'admin','cerveau','3','admin_cer','cerAdm'),(7,'admin','adn','3','admin_adn','adnAdm');
-- /*!40000 ALTER TABLE `users` ENABLE KEYS */;
-- UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-15 17:25:40
