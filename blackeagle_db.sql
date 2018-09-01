-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2018 at 03:34 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blackeagle_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_surname` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_mobile_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_surname`, `admin_username`, `admin_email`, `admin_password`, `admin_mobile_number`) VALUES
(1, 'Fourth', 'Tester', 'fourthtester@blackeagleadmin.co.za', 'fourth@test.com', '$2y$10$hsicaqpj419dsg7wd7s3wuJXtr9WMF8kA6LlOFgx4EZtLM8cnZfwi', '0123456789'),
(2, 'Charl', 'Ritter', 'charlritter@blackeagleadmin.co.za', 'charlritter@hotmail.com', '$2y$10$hsicaqpj419dsg7wd7s3wuM.eqKG8Np5YxA5u.9j1kMufs3oiVynK', '0827269552');

-- --------------------------------------------------------

--
-- Table structure for table `pins`
--

CREATE TABLE `pins` (
  `pin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pins`
--

INSERT INTO `pins` (`pin_id`, `user_id`, `latitude`, `longitude`, `role`, `name`) VALUES
(1, 4, '51.3000', '-0.120850', 0, NULL),
(2, 4, '52.3000', '-0.120850', 0, NULL),
(3, 4, '53.3000', '-0.120850', 0, NULL),
(4, 4, '54.3000', '-0.120850', 0, NULL),
(5, 4, '54.5000', '-0.120850', 0, NULL),
(6, 4, '54.5000', '-0.120850', 0, NULL),
(7, 4, '52.3000', '-0.120850', 1, 'England'),
(12, 4, '54.5000', '-0.120850', 1, 'England 2'),
(14, 4, '54.5000', '-0.120850', 1, 'England 3');

-- --------------------------------------------------------

--
-- Table structure for table `randsalt`
--

CREATE TABLE `randsalt` (
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$hsicaqpj419dsg7wd7s3w9'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `randsalt`
--

INSERT INTO `randsalt` (`randSalt`) VALUES
('$2y$10$hsicaqpj419dsg7wd7s3w9');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `report_name` varchar(255) NOT NULL,
  `report_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_surname` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` tinyint(4) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_mobile_number` varchar(255) NOT NULL,
  `user_organization_name` varchar(255) NOT NULL,
  `user_organization_number` varchar(255) NOT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  `removed` tinyint(4) NOT NULL DEFAULT '0',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_surname`, `user_password`, `user_role`, `user_email`, `user_mobile_number`, `user_organization_name`, `user_organization_number`, `verified`, `approved`, `removed`, `token`) VALUES
(4, 'Second', 'Test', '$2y$10$hsicaqpj419dsg7wd7s3wuksoJ7VW17s1n.hnmg0gCfqvF1ZZHU3O', 1, 'second@test.com', '0123456789', '', '', 1, 1, 0, ''),
(11, 'Fourth', 'Test', '$2y$10$hsicaqpj419dsg7wd7s3wuJXtr9WMF8kA6LlOFgx4EZtLM8cnZfwi', 0, 'fourth@test.com', '0123456789', '', '', 1, 1, 0, ''),
(15, 'Charl', 'Ritter', '$2y$10$hsicaqpj419dsg7wd7s3wuM.eqKG8Np5YxA5u.9j1kMufs3oiVynK', 1, 'charl@test.com', '0827269552', '', '', 1, 1, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `pins`
--
ALTER TABLE `pins`
  ADD PRIMARY KEY (`pin_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pins`
--
ALTER TABLE `pins`
  MODIFY `pin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
