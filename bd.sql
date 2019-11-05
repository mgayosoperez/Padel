-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.3.11-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para mvcbee
CREATE DATABASE IF NOT EXISTS `mvcbee` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mvcbee`;

-- Volcando estructura para tabla mvcbee.directories
CREATE TABLE IF NOT EXISTS `directories` (
  `name` varchar(255) NOT NULL,
  `pater` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mvcbee.directories: ~0 rows (aproximadamente)
DELETE FROM `directories`;
/*!40000 ALTER TABLE `directories` DISABLE KEYS */;
/*!40000 ALTER TABLE `directories` ENABLE KEYS */;

-- Volcando estructura para tabla mvcbee.users
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(255) NOT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(12) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mvcbee.users: ~6 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`username`, `passwd`, `name`, `email`, `phone`) VALUES
	('mesmos', 'mesmos', 'mesmos', 'mesmos', 242224234),
	('pepito', 'pepito', 'pepito', 'pepito', 600297385),
	('pepopepo', 'pepopepo', 'pepopepo', 'juannivan@hotmail.com', 600297385);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;


grant all privileges on mvcbee.* to mvcbeeuser@localhost identified by "mvcbeepass";
