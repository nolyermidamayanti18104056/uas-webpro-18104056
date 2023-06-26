/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.28-MariaDB : Database - cuaca
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cuaca` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `cuaca`;

/*Table structure for table `lokasi` */

CREATE TABLE `lokasi` (
  `kota` char(10) NOT NULL,
  `suhu` decimal(10,0) NOT NULL,
  `kelembaban` decimal(10,0) NOT NULL,
  `tekanan` decimal(10,0) NOT NULL,
  `kondisi` varchar(30) NOT NULL,
  PRIMARY KEY (`kota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `lokasi` */

insert  into `lokasi`(`kota`,`suhu`,`kelembaban`,`tekanan`,`kondisi`) values 
('Badung',30,90,7,'Hujan'),
('Bangli',29,95,6,'Cerah'),
('Buleleng',30,84,4,'Berawan'),
('Denpasar',33,90,7,'Cerah'),
('Gianyar',31,90,8,'Hujan Matahari'),
('Jembrana',25,85,10,'Berawan'),
('Karangasem',31,80,10,'Berawan'),
('Klungkung',30,90,8,'Hujan'),
('Tabanan',30,98,10,'Hujan Petir');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
