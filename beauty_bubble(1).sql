-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2015 at 09:12 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `beauty_bubble`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `facial_treatments` varchar(255) DEFAULT NULL,
  `eye_treatments` varchar(255) DEFAULT NULL,
  `body_treatments` varchar(255) DEFAULT NULL,
  `spray_tanning` varchar(255) DEFAULT NULL,
  `nail_treatments` varchar(255) DEFAULT NULL,
  `waxing_treatments` varchar(255) DEFAULT NULL,
  `electrolysis` varchar(255) DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `facial_treatments`, `eye_treatments`, `body_treatments`, `spray_tanning`, `nail_treatments`, `waxing_treatments`, `electrolysis`, `date_time`, `status`) VALUES
(167, 7, 'Facial - 60 minutes for $50', NULL, NULL, NULL, NULL, NULL, '15 minutes (minimum appointment) for $25', '2015-05-14 22:30:00', NULL),
(169, 4, NULL, 'Eyebrow Tint for $10', 'Full Body Massage - 60 minutes for $80', NULL, NULL, NULL, NULL, '2015-05-19 21:00:00', NULL),
(171, 4, NULL, 'Eyelash Tint for $15, Eyebrow Tint and Lash Tint for $20', 'Back, Neck and Shoulder - 30 minutes for $40', NULL, NULL, NULL, NULL, '2015-05-10 01:00:00', NULL),
(172, 4, NULL, 'Eyebrow Tint and Lash Tint for $20', NULL, 'Half Body for $20', NULL, NULL, NULL, '2015-05-21 00:00:00', NULL),
(173, 4, NULL, NULL, 'Back, Neck and Shoulder - 30 minutes for $40', NULL, 'Mini Manicure - 30 minutes for $30', NULL, NULL, '2015-05-19 21:00:00', NULL),
(174, 4, NULL, NULL, NULL, 'Full Body for $30', 'Mini Manicure - 30 minutes for $30', NULL, NULL, '2015-05-20 21:00:00', NULL),
(175, 2, NULL, 'Eyebrow Tint and Lash Tint for $20', 'Full Body Massage - 60 minutes for $80', NULL, NULL, NULL, NULL, '2015-05-20 21:00:00', NULL),
(176, 4, NULL, NULL, NULL, 'Full Body for $30', 'Deluxe Manicure - 60 minutes for $45', 'Forearm wax for $20', NULL, '2015-05-19 21:00:00', NULL),
(177, 4, NULL, 'Eyebrow Tint and Lash Tint for $20', 'Full Body Massage - 60 minutes for $80', 'Full Body for $30', NULL, NULL, NULL, '2015-05-20 03:00:00', NULL),
(180, 4, NULL, NULL, NULL, 'Full Body for $30', 'File and Polish for $15', NULL, NULL, '2015-05-19 21:00:00', NULL),
(182, 4, NULL, 'Eyebrow Tint for $10, Eyebrow Tint and Lash Tint for $20', 'Full Body Massage - 60 minutes for $80', NULL, 'Deluxe Manicure - 60 minutes for $45', NULL, NULL, '2015-05-20 21:00:00', NULL),
(183, 4, 'Facial - 60 minutes for $50', 'Eyebrow Tint for $10', NULL, NULL, NULL, NULL, '15 minutes (minimum appointment) for $25', '2015-05-27 21:00:00', NULL),
(184, 4, NULL, NULL, NULL, NULL, 'Mini Manicure - 30 minutes for $30', '1/2 Leg wax for $20', '15 minutes (minimum appointment) for $25', '2015-05-19 21:00:00', NULL),
(186, 6, 'Facial - 60 minutes for $50', NULL, NULL, NULL, NULL, NULL, NULL, '2015-05-19 16:00:00', NULL),
(187, 2, NULL, NULL, NULL, NULL, 'File and Polish for $15', NULL, NULL, '2015-05-25 21:00:00', NULL),
(189, 60, NULL, NULL, NULL, 'Full Body for $30', 'Mini Manicure - 30 minutes for $30', NULL, NULL, '2015-05-20 12:45:00', NULL),
(190, 61, 'Facial - 60 minutes for $50', NULL, NULL, NULL, NULL, 'Underarm wax for $15', NULL, '2015-05-31 12:00:00', NULL),
(191, 62, NULL, NULL, 'Full Body Massage - 60 minutes for $80', NULL, NULL, NULL, NULL, '2016-03-02 20:00:00', NULL),
(192, 1, NULL, NULL, NULL, NULL, NULL, NULL, '30 minutes for $40', '2015-06-05 21:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `ph_number` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `ph_number`, `mobile_number`, `is_admin`, `is_verified`) VALUES
(1, 'Ray', 'Perkins', 'raymond@perkins.org.nz', NULL, '123', NULL, 0, 0),
(2, 'Chelsea', 'Perkins', 'chelseaperkins6@gmail.com', NULL, 'hdhfg', 'dhgdh', 0, 0),
(3, 'Ashley', 'Tait', 'asht80@gmail.com', NULL, '036880233', '0274284135', 0, 0),
(4, 'Chelsea', 'Perkins', 'chelsea.atkinson@gmail.com', NULL, '4567756765', '6456757567', 0, 0),
(5, 'Shae', 'Atkinson', 'babegal_13@gmail.com', NULL, '024567567867', NULL, 0, 0),
(6, 'Fiona', 'Atkinson', 'm.f.atkinson@xtra.co.nz', NULL, '035465665', '0256787867', 0, 0),
(7, 'Chelsea', 'Perkins', 'babegal_13@hotmail.com', NULL, '4867898', NULL, 0, 0),
(8, 'Chelsea', 'Perkins', 'lopsey@gmail.com', NULL, '756758678', '467568785', 0, 0),
(59, 'Chelsea', 'Perkins', 'chelseaperkins6@gmail.com', '8bb6118f8fd6935ad0876a3be34a717d32708ffd', '0', '0', 1, 1),
(60, 'Emily', 'Cottam', 'emz@hotmail.com', NULL, '021465675', NULL, 0, 0),
(61, 'Kate', 'Windsor', 'k-windsor@hotmail.com', NULL, NULL, NULL, 0, 0),
(62, 'Ra', 'Per', 'ra.per@email.com', NULL, '1231', NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=193;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
