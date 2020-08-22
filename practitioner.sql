-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Aug 22, 2020 at 02:40 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `practitioner`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id_profile` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `profile_photo` varchar(20) NOT NULL,
  `gallary_photos` text NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_profile`),
  KEY `location` (`location`),
  KEY `phone_number` (`phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id_profile`, `name`, `location`, `description`, `profile_photo`, `gallary_photos`, `phone_number`, `email`, `date_created`, `date_updated`) VALUES
(1, 'Anshul', 'Meerut', 'Music Producer', '', '', '8475089644', 'anshul@test.com', '2020-08-21 17:34:01', '2020-08-21 17:34:01'),
(2, 'Mayank Mittal', 'Meerut', 'abc', '', '', '9393939393', 'mayank@test.com', '2020-08-22 01:03:07', '2020-08-22 01:03:07'),
(3, 'Ankush Mittal', 'Meerut', 'abc', '', '', '9393939393', 'mayank@test.com', '2020-08-22 01:21:36', '2020-08-22 01:21:36'),
(4, 'Yash Mittal', 'Meerut', 'abc', '', '', '9393939393', 'mayank@test.com', '2020-08-22 01:21:53', '2020-08-22 01:21:53'),
(5, 'Sick Mittal', 'Meerut', 'abc', '', '', '9393939393', 'mayank@test.com', '2020-08-22 01:22:19', '2020-08-22 01:22:19'),
(7, '', '', '', '', '', '', '', '2020-08-22 04:32:29', '2020-08-22 04:32:29'),
(8, '', '', '', '', '', '', '', '2020-08-22 04:33:05', '2020-08-22 04:33:05'),
(9, '', '', '', '', '', '', '', '2020-08-22 04:36:15', '2020-08-22 04:36:15'),
(10, 'dwed wedwe', 'wedew', 'wedew', '', '', '323223332', 'ewdwe', '2020-08-22 04:37:32', '2020-08-22 04:37:32'),
(11, 'dwed wedwe', 'wedew', 'wedew', '', '', '323223332', 'ewdwe', '2020-08-22 04:38:13', '2020-08-22 04:38:13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
