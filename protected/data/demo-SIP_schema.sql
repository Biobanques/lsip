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


-- DROP TABLE IF EXISTS `users`;
-- /*!40101 SET @saved_cs_client     = @@character_set_client */;
-- /*!40101 SET character_set_client = utf8 */;
 CREATE TABLE `users` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `nom` varchar(45) DEFAULT NULL,
   `prenom` varchar(45) DEFAULT NULL,
   `profil` varchar(45) NOT NULL,
   `login` varchar(45) NOT NULL,
   `password` varchar(45) NOT NULL,
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
--
-- Table structure for table `Sources`
--

-- DROP TABLE IF EXISTS `Sources`;
-- /*!40101 SET @saved_cs_client     = @@character_set_client */;
-- /*!40101 SET character_set_client = utf8 */;
 CREATE TABLE `Sources` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `name` varchar(45) NOT NULL,
   `passphrase` varchar(45) DEFAULT NULL,
   `admin` int(11) NOT NULL,
   `webapp` int(11) NOT NULL,
   PRIMARY KEY (`id`),
  KEY `fk_Sources_1_idx` (`admin`),
   KEY `fk_Sources_2_idx` (`webapp`),
   CONSTRAINT `fk_Sources_1` FOREIGN KEY (`admin`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
   CONSTRAINT `fk_Sources_2` FOREIGN KEY (`webapp`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
-- /*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Patient`
--
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `Patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Patient` (
  `id` int(10) NOT NULL,
  `birthName` varchar(100) NOT NULL,
  `useName` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `birthDate` datetime NOT NULL,
  `source` int(11) NOT NULL,
  `sex` varchar(45) NOT NULL,
  `sourceId` varchar(45) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_Patient_Sources1_idx` (`source`),
  CONSTRAINT `fk_Patient_Sources1` FOREIGN KEY (`source`) REFERENCES `Sources` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `Rapprochement`
--

DROP TABLE IF EXISTS `Rapprochement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rapprochement` (
  `idRapprochement` int(11) NOT NULL AUTO_INCREMENT,
  `idPat1` int(11) NOT NULL,
  `idPat2` int(11) NOT NULL,
  `validated` enum('0','1','2') NOT NULL DEFAULT '0',
  PRIMARY KEY (`idRapprochement`),
  KEY `fk_Rapprochement_Patient1_idx` (`idPat1`),
  KEY `fk_Rapprochement_Patient2_idx` (`idPat2`),
  CONSTRAINT `fk_Rapprochement_Patient1` FOREIGN KEY (`idPat1`) REFERENCES `Patient` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Rapprochement_Patient2` FOREIGN KEY (`idPat2`) REFERENCES `Patient` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


DELIMITER $$
CREATE PROCEDURE `detect_rapprochement2`(
IN id int
,IN birthName varchar(45)
, IN useName varchar (255)
, IN firstName varchar (255)
, IN birthDate datetime
, IN origine int
, IN sex varchar (255)
, IN sourceId varchar(45)

)
BEGIN
DROP temporary table  if exists tempPat;
DROP temporary table  if exists   tempPat2;
#5 criteres
create temporary table tempPat as 
select * from Patient p where(
p.birthName = birthName
AND p.useName = useName
AND p.firstName = firstName
AND YEAR(p.birthDate) = YEAR(birthdate) AND MONTH(p.birthDate) = MONTH(birthDate)
AND p.sex = sex
)
# 4 criteres
UNION
select * from Patient p where (
p.useName = useName
AND p.firstName = firstName
AND YEAR(p.birthDate) = YEAR(birthdate) AND MONTH(p.birthDate) = MONTH(birthDate)
AND p.sex = sex
)
UNION
select * from Patient p where (
p.birthName = birthName

AND p.firstName = firstName
AND YEAR(p.birthDate) = YEAR(birthdate) AND MONTH(p.birthDate) = MONTH(birthDate)
AND p.sex = sex
)
UNION
select * from Patient p where (
p.birthName = birthName
AND p.useName = useName
AND YEAR(p.birthDate) = YEAR(birthdate) AND MONTH(p.birthDate) = MONTH(birthDate)
AND p.sex = sex
)
UNION
select * from Patient p where (
p.birthName = birthName
AND p.useName = useName
AND p.firstName = firstName
AND p.sex = sex
)
UNION
select * from Patient p where (
p.birthName = birthName
AND p.useName = useName
AND p.firstName = firstName
AND YEAR(p.birthDate) = YEAR(birthdate) AND MONTH(p.birthDate) = MONTH(birthDate)
)
#3 criteres
UNION
select  * from Patient p where (
p.firstName = firstName
AND YEAR(p.birthDate) = YEAR(birthdate) AND MONTH(p.birthDate) = MONTH(birthDate)
AND p.sex = sex
)
UNION
select * from Patient p where (
p.useName = useName
AND YEAR(p.birthDate) = YEAR(birthdate) AND MONTH(p.birthDate) = MONTH(birthDate)
AND p.sex = sex
)
UNION
select * from Patient p where (
 p.useName = useName
AND p.firstName = firstName
AND p.sex = sex
)
UNION
select * from Patient p where (
 p.useName = useName
AND p.firstName = firstName
AND YEAR(p.birthDate) = YEAR(birthdate) AND MONTH(p.birthDate) = MONTH(birthDate)
)
UNION
select * from Patient p where (
p.birthName = birthName
AND YEAR(p.birthDate) = YEAR(birthdate) AND MONTH(p.birthDate) = MONTH(birthDate)
AND p.sex = sex
)
UNION
select * from Patient p where (
p.birthName = birthName
AND p.firstName = firstName
AND p.sex = sex
)
UNION
select * from Patient p where (
p.birthName = birthName
AND p.firstName = firstName
AND YEAR(p.birthDate) = YEAR(birthdate) AND MONTH(p.birthDate) = MONTH(birthDate)
)
#UNION
#select * from Patient p where (
#p.birthName = birthName
#AND p.useName = useName
#AND p.sex = sex
#)
UNION
select * from Patient p where (
p.birthName = birthName
AND p.useName = useName
AND YEAR(p.birthDate) = YEAR(birthdate) AND MONTH(p.birthDate) = MONTH(birthDate)
)
UNION
select * from Patient p where (
p.birthName = birthName
AND p.useName = useName
AND p.firstName = firstName
)
;
/*
select  id from Patient p where (p.source!=source AND
YEAR(p.birthDate) = YEAR(birthdate) AND MONTH(p.birthDate) = MONTH(birthDate)
);
*/

create temporary table   tempPat2 as
select tp.id from tempPat tp where tp.id not in (select idPat1 from Rapprochement where idPat2=id union select idPat2 from Rapprochement where idPat1 = id union select id from Patient p where p.id = id);

insert into Rapprochement (idPat1, idPat2) (select tp2.id,id from   tempPat2 tp2);
END$$
DELIMITER ;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
SET FOREIGN_KEY_CHECKS=1;
-- Dump completed on 2014-10-15 17:19:49
