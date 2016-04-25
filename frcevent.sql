-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2016 at 02:49 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `frcevent`
--
CREATE DATABASE IF NOT EXISTS `frcevent` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `frcevent`;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `max_slot` smallint(6) NOT NULL,
  `free_slot` smallint(6) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `location`, `date`, `time`, `max_slot`, `free_slot`, `name`) VALUES
(2, 'Family Resource Center', '2016-04-19', '19:00:00', 50, 50, 'Culture Night'),
(3, 'Family Resource Center', '2016-04-29', '18:00:00', 100, 84, 'Snack & Study @ the FRC');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

DROP TABLE IF EXISTS `participant`;
CREATE TABLE IF NOT EXISTS `participant` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_kid` tinyint(1) NOT NULL,
  `special_assist` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resident_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`id`, `first_name`, `last_name`, `is_kid`, `special_assist`, `resident_id`) VALUES
(2, 'TUAN DANH', 'NGUYEN', 0, 'So Fat', NULL),
(3, 'TUAN DANH', 'NGUYEN', 0, 'So Fat', NULL),
(4, 'David', 'Nguyen', 0, 'So Fat', NULL),
(12, 'jnjnsdkand', 'alalfjlke', 0, 'no', 20),
(14, 'Huyen', 'Nguyen', 0, 'No', 22),
(15, 'Ja', 'Doe', 0, 'No', 23),
(16, 'John', 'John', 1, 'N/A', 25),
(17, 'Jane', 'Jane', 0, 'Umbrella', 25);

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

DROP TABLE IF EXISTS `resident`;
CREATE TABLE IF NOT EXISTS `resident` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `building` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apt` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `CWID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`id`, `email`, `first_name`, `last_name`, `building`, `apt`, `phone`, `CWID`, `event_id`) VALUES
(11, 'ndtuanbk48@gmail.com', 'Test3', 'NGUYEN', '75 S Unive', '1', '4057623302', '11517648', 3),
(20, 'abc@gmail.com', 'huyen', 'aaa', '75 S Unive', '1', '40577777777', '11345667', 3),
(22, 'ndtuanbk48@gmail.com', 'Tuan', 'Nguyen', '75 S University Place', 'Apt 1', '4057623302', NULL, 3),
(23, 'aaa@gmail.com', 'Ja', 'Doe', '111N University Pl', '23', '4444444444', 'N/A', 3),
(25, 'aabb@gmail.com', 'aaa', 'bbb', '123N Uni', '45', '40513323611', 'N/A', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `roles`) VALUES
(1, 'admin', 'admin@okstate.edu', '$2y$13$nN5vHdlII1/s9FD61X.D1eqeSRJ3jvu4ZBBeR0P1SgPRupYdMfiSq', '["ROLE_ADMIN"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5103E4C68012C5B0` (`resident_id`);

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2DA17977F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_2DA17977E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `FK_5103E4C68012C5B0` FOREIGN KEY (`resident_id`) REFERENCES `resident` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
