/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.21-MariaDB : Database - kafeterija
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kafeterija` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `kafeterija`;

/*Table structure for table `kafa` */

DROP TABLE IF EXISTS `kafa`;

CREATE TABLE `kafa` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(40) DEFAULT 'NULL',
  `tezina` int(40) DEFAULT NULL,
  `ukus` varchar(40) DEFAULT 'NULL',
  `opis` varchar(40) DEFAULT 'NULL',
  `marka_id` bigint(20) DEFAULT NULL,
  `slika` text DEFAULT 'NULL',
  PRIMARY KEY (`id`),
  KEY `marka_id` (`marka_id`),
  CONSTRAINT `kafa_ibfk_1` FOREIGN KEY (`marka_id`) REFERENCES `marka` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `kafa` */

insert  into `kafa`(`id`,`naziv`,`tezina`,`ukus`,`opis`,`marka_id`,`slika`) values (1,'Kafa GRAND Aroma',100,'obican','najfinija kafa sa tradicijom',6,'\'./img/GRAND.jpg\''),(2,'Kafa DONCAFE Green',180,'zeleni caj','kafa sa ukusom zelenog caja',5,'\'./img/DONCAFE.jpg\''),(3,'Kafa BARCAFEE Preminum',100,'obican','Premimu kafa vrhunskog kvaliteta',1,'\'./img/BARCAFEE.jpg\''),(4,'Kafa BONITO tamno przena',100,'pojacan','tamno przena kafa',2,'\'./img/BONITO.jpg\'');

/*Table structure for table `marka` */

DROP TABLE IF EXISTS `marka`;

CREATE TABLE `marka` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `marka` */

insert  into `marka`(`id`,`naziv`) values (1,'Premium'),(2,'Bonito'),(3,'C'),(4,'Dobro Jutro'),(5,'DONCAFE'),(6,'GRAND');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
