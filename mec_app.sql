-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table mec_app.me_login_history
DROP TABLE IF EXISTS `me_login_history`;
CREATE TABLE IF NOT EXISTS `me_login_history` (
  `login_his_Id` bigint(40) NOT NULL AUTO_INCREMENT,
  `userLoginId` int(11) NOT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `userAuthToken` varchar(500) NOT NULL,
  `loginTime` datetime DEFAULT NULL,
  `logoutTime` datetime DEFAULT NULL,
  PRIMARY KEY (`login_his_Id`),
  KEY `userLoginId` (`userLoginId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table mec_app.me_login_history: 3 rows
DELETE FROM `me_login_history`;
/*!40000 ALTER TABLE `me_login_history` DISABLE KEYS */;
INSERT INTO `me_login_history` (`login_his_Id`, `userLoginId`, `ip`, `userAuthToken`, `loginTime`, `logoutTime`) VALUES
	(1, 1, '::1', 'MKnD8NhNDBaSNlS11Ca7mdkqP', '2019-01-06 06:53:55', NULL),
	(2, 2, '::1', 'BQdXwugLXz0XXohGr9tOLaIc9', '2019-01-06 06:54:35', NULL),
	(3, 1, '::1', 'zwUot3Gp8sl3WdFtPtpWmbvGV', '2019-01-06 06:58:58', '2019-01-07 00:29:04');
/*!40000 ALTER TABLE `me_login_history` ENABLE KEYS */;

-- Dumping structure for table mec_app.me_user
DROP TABLE IF EXISTS `me_user`;
CREATE TABLE IF NOT EXISTS `me_user` (
  `userLoginId` int(11) unsigned NOT NULL DEFAULT '0',
  `userName` varchar(25) NOT NULL,
  `userPassword` varchar(200) NOT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `userAuthToken` varchar(100) DEFAULT NULL,
  `userApiKey` varchar(100) DEFAULT NULL,
  `status` enum('1','0') DEFAULT '0',
  `role` enum('A','U','R','M') DEFAULT 'U',
  `createdOn` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`userLoginId`),
  UNIQUE KEY `userEmail2` (`userEmail`),
  KEY `userName` (`userName`),
  KEY `userEmail` (`userEmail`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table mec_app.me_user: 2 rows
DELETE FROM `me_user`;
/*!40000 ALTER TABLE `me_user` DISABLE KEYS */;
INSERT INTO `me_user` (`userLoginId`, `userName`, `userPassword`, `userEmail`, `userAuthToken`, `userApiKey`, `status`, `role`, `createdOn`) VALUES
	(1, 'ralph', '280d44ab1e9f79b5cce2dd4f58f5fe91f0fbacdac9f7447dffc318ceb79f2d02', 'ralph@mobilityecommerce.com', 'KWBgTwYbeXUzYrY', NULL, '1', 'A', '2018-10-30 16:08:13'),
	(2, 'ritika', '280d44ab1e9f79b5cce2dd4f58f5fe91f0fbacdac9f7447dffc318ceb79f2d02', 'ritika@mobilityecommerce.com', 'TClkBzFw4fiqPbl', NULL, '1', 'U', '2018-10-30 16:08:13');
/*!40000 ALTER TABLE `me_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
