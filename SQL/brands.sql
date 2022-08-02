/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - brands
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`brands` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `brands`;

/*Table structure for table `brand` */

DROP TABLE IF EXISTS `brand`;

CREATE TABLE `brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

/*Data for the table `brand` */

insert  into `brand`(`id`,`name`,`country`) values 
(1,'Apple','USA'),
(2,'Samsung','Korea'),
(3,'Xiaomi','China'),
(4,'LG','Korea'),
(5,'Huawei','China'),
(6,'Nokia','Finland'),
(7,'Sharp','Japan'),
(8,'OPPO','China'),
(9,'Motorola','USA'),
(10,'Lenovo','China'),
(11,'ZTE','China'),
(12,'Meizu','China'),
(13,'Sony','Japan'),
(15,'Google','USA'),
(16,'ASUS','Taiwan'),
(17,'BenQ-Siemens','Germany/Taiwan'),
(18,'OnePlus','China'),
(19,'Panasonic','Japan');

/*Table structure for table `model` */

DROP TABLE IF EXISTS `model`;

CREATE TABLE `model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `brand_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brands_models_FK` (`brand_id`),
  CONSTRAINT `brands_models_FK` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

/*Data for the table `model` */

insert  into `model`(`id`,`name`,`brand_id`) values 
(1,'iPhone 4',1),
(2,'iPhone 5',1),
(3,'Galaxy S3',2),
(4,'Galaxy Note',2),
(5,'Mi 9 Lite',3),
(6,'Mi 9',3),
(7,'Redmi 3S',3),
(8,'iPad 3',1),
(9,'Watch',1),
(10,'Nose shaver',3),
(11,'V300',9),
(12,'RAZR V3',9),
(13,'2310',6),
(14,'5130',6),
(15,'3310',6),
(16,'BLADE X1 5G',11),
(18,'iPod',1),
(19,'AVID 579',11),
(21,'WING 5G',4),
(24,'K97 5G',4),
(27,'p30 pro',5),
(28,'aquos r2',7),
(29,'Find X5 Pro',8),
(30,'moto g51 5G',10),
(31,'9 Pro',18),
(32,'Pixel 1',15),
(33,'Pixel 2',15),
(38,'TU110',19),
(41,'Zenphone 8',16),
(42,'17 Pro',12),
(44,'EF91',17),
(45,'Xperia 5',13);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
