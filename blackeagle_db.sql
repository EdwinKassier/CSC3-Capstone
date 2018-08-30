-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2018 at 11:16 PM
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
(1, 'Fourth', 'Tester', 'fourth@blackeagleadmin.co.za', 'fourth@test.com', '$2y$10$hsicaqpj419dsg7wd7s3wuJXtr9WMF8kA6LlOFgx4EZtLM8cnZfwi', '0123456789');

-- --------------------------------------------------------

--
-- Table structure for table `pins`
--

CREATE TABLE `pins` (
  `pin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `latitude` int(11) NOT NULL,
  `longitude` int(11) NOT NULL,
  `role` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  `removed` tinyint(4) NOT NULL DEFAULT '0',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_surname`, `user_password`, `user_role`, `user_email`, `user_mobile_number`, `verified`, `approved`, `removed`, `token`) VALUES
(3, 'Second', 'Test', '$2y$10$hsicaqpj419dsg7wd7s3wuksoJ7VW17s1n.hnmg0gCfqvF1ZZHU3O', 1, 'second@test.com', '0123456789', 1, 0, 0, ''),
(4, 'Third', 'Test', '$2y$10$hsicaqpj419dsg7wd7s3wuY1gTcsW56Kun0BDirNszH.lo6syWyo2', 1, 'third@test.com', '0123456789', 1, 0, 0, ''),
(11, 'Fourth', 'Test', '$2y$10$hsicaqpj419dsg7wd7s3wuJXtr9WMF8kA6LlOFgx4EZtLM8cnZfwi', 0, 'fourth@test.com', '0123456789', 1, 0, 0, ''),
(15, 'Charl', 'Ritter', '$2y$10$hsicaqpj419dsg7wd7s3wuM.eqKG8Np5YxA5u.9j1kMufs3oiVynK', 1, 'charl@test.com', '0827269552', 1, 0, 0, '');

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pins`
--
ALTER TABLE `pins`
  MODIFY `pin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
