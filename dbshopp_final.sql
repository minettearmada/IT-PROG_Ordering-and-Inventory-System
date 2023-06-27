-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2023 at 08:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbshopp`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `main` varchar(50) DEFAULT NULL,
  `side` varchar(50) DEFAULT NULL,
  `drink` varchar(50) DEFAULT NULL,
  `m1` int(11) NOT NULL,
  `s1` int(11) NOT NULL,
  `d1` int(11) NOT NULL,
  `final` double NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `name`, `main`, `side`, `drink`, `m1`, `s1`, `d1`, `final`, `date`) VALUES
(1, 'cj', 'STEAK', NULL, NULL, 1, 0, 0, 900, '2023-06-01 01:04:47'),
(2, 'Minette', 'CHICKEN', 'STEAMED VEGETABLES', 'WATER', 1, 1, 1, 370, '2023-06-27 04:52:43'),
(3, 'will', 'CHICKEN', 'STEAMED VEGETABLES', 'WATER', 1, 1, 1, 370, '2023-06-27 04:57:10'),
(4, 'will', 'SALMON', 'MASHED POTATO', 'ROOT BEER', 1, 1, 1, 985, '2023-06-27 05:00:02'),
(5, 'cj', 'CHICKEN', 'STEAMED VEGETABLES', 'WATER', 1, 1, 1, 370, '2023-06-27 05:04:36'),
(6, 'cj', 'CHICKEN', 'STEAMED VEGETABLES', 'WATER', 1, 1, 1, 370, '2023-06-27 05:06:47'),
(7, 'cj', 'CHICKEN', 'STEAMED VEGETABLES', 'WATER', 1, 1, 1, 370, '2023-06-27 05:06:47'),
(23, 'cea', 'SALMON', 'MASHED POTATO', 'ROOT BEER', 1, 1, 1, 985, '2023-06-27 05:27:33'),
(24, 'cea', 'SALMON', 'MASHED POTATO', 'ROOT BEER', 1, 1, 1, 985, '2023-06-27 05:45:19'),
(25, 'CEAW', 'SALMON', 'BAKED POTATO', 'WATER', 1, 1, 1, 950, '2023-06-27 14:16:32'),
(26, 'mina', 'STEAK', 'STEAMED VEGETABLES', 'WATER', 1, 1, 1, 970, '2023-06-27 14:22:20'),
(27, 'fjas', 'CHICKEN', 'MASHED POTATO', 'ROOT BEER', 1, 1, 1, 435, '2023-06-27 14:27:02'),
(28, 'fjas', 'CHICKEN', 'MASHED POTATO', 'ROOT BEER', 1, 1, 1, 435, '2023-06-27 14:39:54'),
(29, 'matthew', 'SALMON', 'BAKED POTATO', 'WATER', 1, 1, 1, 950, '2023-06-27 14:40:45');

-- --------------------------------------------------------

--
-- Table structure for table `practice`
--

CREATE TABLE `practice` (
  `ID` int(11) NOT NULL,
  `main` varchar(40) DEFAULT NULL,
  `side` varchar(40) DEFAULT NULL,
  `drink` varchar(40) DEFAULT NULL,
  `m1` int(11) DEFAULT NULL,
  `s1` int(11) DEFAULT NULL,
  `d1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `practice`
--

INSERT INTO `practice` (`ID`, `main`, `side`, `drink`, `m1`, `s1`, `d1`) VALUES
(1, 'CHICKEN', 'STEAMED VEGETABLES', 'WATER', 1, 1, 1),
(2, 'CHICKEN', 'STEAMED VEGETABLES', 'WATER', 1, 1, 1),
(3, 'STEAK', 'STEAMED VEGETABLES', 'WATER', 1, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `practice`
--
ALTER TABLE `practice`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `practice`
--
ALTER TABLE `practice`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
