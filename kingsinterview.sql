-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 26, 2024 at 01:07 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kingsinterview`
--

-- --------------------------------------------------------

--
-- Table structure for table `kcl_login`
--

CREATE TABLE `kcl_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `lastlogin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kcl_login`
--

INSERT INTO `kcl_login` (`id`, `username`, `password`, `userid`, `lastlogin`) VALUES
(1, 'rajas', '$2y$10$5fm.HexvEG2C6IhFFX1iXeG7kAkuz.rWMNjlCLBZPKiYxqQUghs5e', 1, '1724634071'),
(2, 'testfirstname', '$2y$10$5fm.HexvEG2C6IhFFX1iXeG7kAkuz.rWMNjlCLBZPKiYxqQUghs5e', 3, '1724633890');

-- --------------------------------------------------------

--
-- Table structure for table `kcl_stringtask`
--

CREATE TABLE `kcl_stringtask` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `string_input` varchar(255) NOT NULL,
  `string_length` int(11) NOT NULL,
  `created_on` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kcl_stringtask`
--

INSERT INTO `kcl_stringtask` (`id`, `userid`, `string_input`, `string_length`, `created_on`) VALUES
(1, 1, 'asdasdasdaasdasds', 17, '1724634076'),
(3, 3, 'asdasd', 6, '1724633893');

-- --------------------------------------------------------

--
-- Table structure for table `kcl_user`
--

CREATE TABLE `kcl_user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kcl_user`
--

INSERT INTO `kcl_user` (`id`, `firstname`, `lastname`) VALUES
(1, 'Rajas', 'Gadgil'),
(3, 'Testfirstname', 'Testlastname');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kcl_login`
--
ALTER TABLE `kcl_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kcl_stringtask`
--
ALTER TABLE `kcl_stringtask`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kcl_user`
--
ALTER TABLE `kcl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kcl_login`
--
ALTER TABLE `kcl_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kcl_stringtask`
--
ALTER TABLE `kcl_stringtask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kcl_user`
--
ALTER TABLE `kcl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
