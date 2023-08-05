-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2023 at 08:15 AM
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
-- Database: `dbprog`
--

-- --------------------------------------------------------

--
-- Table structure for table `combos`
--

CREATE TABLE `combos` (
  `comboID` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `mainCode` int(11) NOT NULL,
  `sideCode` int(11) NOT NULL,
  `drinkCode` int(11) NOT NULL,
  `comboPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `combos`
--

INSERT INTO `combos` (`comboID`, `name`, `mainCode`, `sideCode`, `drinkCode`, `comboPrice`) VALUES
(1, 'Chicken Mash Tea', 3, 5, 7, 387),
(2, 'Steak Veg Beer Combo', 1, 6, 8, 909);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `foodCode` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `category` enum('M','S','D') NOT NULL,
  `price` double NOT NULL,
  `imageID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`foodCode`, `name`, `category`, `price`, `imageID`) VALUES
(1, 'Steak', 'M', 900, 1),
(2, 'Salmon', 'M', 850, 2),
(3, 'Chicken', 'M', 300, 3),
(4, 'Baked Potato', 'S', 80, 4),
(5, 'Mashed Potato', 'S', 75, 5),
(6, 'Steamed Vegetables', 'S', 50, 6),
(7, 'Ice Tea', 'D', 55, 7),
(8, 'Root Beer', 'D', 60, 8),
(9, 'Water', 'D', 20, 9);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imageID` int(11) NOT NULL,
  `originalName` varchar(60) NOT NULL,
  `mime_type` varchar(40) NOT NULL,
  `image_data` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imageID`, `originalName`, `mime_type`, `image_data`) VALUES
(1, 'm1.png', 'image/png', 'assets/image1.png'),
(2, 'm2.png', 'image/png', 'assets/image2.png'),
(3, 'm3.png', 'image/png', 'assets/image3.png'),
(4, 's1.png', 'image/png', 'assets/image4.png'),
(5, 's2.png', 'image/png', 'assets/image5.png'),
(6, 's3.png', 'image/png', 'assets/image6.png'),
(7, 'd1.png', 'image/png', 'assets/image7.png'),
(8, 'd2.png', 'image/png', 'assets/image8.png'),
(9, 'd3.png', 'image/png', 'assets/image9.png');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `receiptID` int(11) NOT NULL,
  `mainCode` int(11) DEFAULT NULL,
  `sideCode` int(11) DEFAULT NULL,
  `drinkCode` int(11) DEFAULT NULL,
  `m1` int(11) DEFAULT NULL,
  `s1` int(11) DEFAULT NULL,
  `d1` int(11) DEFAULT NULL,
  `originalPrice` double NOT NULL,
  `comboID` int(11) DEFAULT NULL,
  `discountPrice` double DEFAULT NULL,
  `totalPrice` double NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`receiptID`, `mainCode`, `sideCode`, `drinkCode`, `m1`, `s1`, `d1`, `originalPrice`, `comboID`, `discountPrice`, `totalPrice`, `date`, `name`) VALUES
(1, 1, 4, 7, 1, 1, 1, 1035, NULL, NULL, 1035, '2023-08-03 08:30:32', 'cj'),
(2, 3, 3, 3, 1, 1, 1, 300, NULL, NULL, 430, '2023-08-04 19:12:26', 'matthew'),
(3, 3, 5, 7, 1, 1, 1, 300, NULL, NULL, 430, '2023-08-04 19:12:26', 'samuel'),
(4, 3, 5, 7, 1, 1, 1, 300, NULL, NULL, 430, '2023-08-04 19:12:26', 'samuel'),
(5, 3, 5, 7, 1, 1, 1, 300, NULL, NULL, 430, '2023-08-04 19:12:26', 'samuel'),
(6, 3, 5, 7, 1, 1, 1, 300, NULL, NULL, 430, '2023-08-04 19:12:26', 'samuel'),
(7, 3, 5, 7, 2, 2, 3, 915, 1, 86, 55, '2023-08-05 04:20:43', 'Jesus'),
(8, 3, 5, 7, 2, 2, 3, 915, 1, 86, 55, '2023-08-05 04:20:43', 'Jesus'),
(9, 3, 5, 7, 2, 2, 3, 915, 1, 86, 55, '2023-08-05 04:45:13', 'roororo'),
(10, 3, 5, 7, 2, 2, 3, 915, 1, 86, 829, '2023-08-05 04:53:26', 'rawr'),
(11, NULL, NULL, NULL, NULL, NULL, NULL, 300, NULL, NULL, 300, '2023-08-05 04:53:26', 'testforone'),
(12, NULL, NULL, NULL, NULL, NULL, NULL, 850, NULL, NULL, 850, '2023-08-05 05:02:53', 'testing'),
(13, NULL, NULL, NULL, NULL, NULL, NULL, 80, NULL, NULL, 80, '2023-08-05 05:02:53', 'plswork'),
(14, NULL, NULL, NULL, NULL, NULL, NULL, 50, NULL, NULL, 50, '2023-08-05 05:02:53', 'cea'),
(15, 3, 5, 7, 1, 1, 1, 430, 1, 43, 387, '2023-08-05 05:02:53', 'dasd'),
(16, NULL, NULL, NULL, NULL, NULL, NULL, 300, NULL, NULL, 300, '2023-08-05 05:02:53', 'mmam'),
(17, NULL, NULL, NULL, NULL, NULL, NULL, 850, NULL, NULL, 850, '2023-08-05 05:02:53', 'salmo'),
(18, 0, 0, 0, 3, 3, 4, 1345, 1, 129, 1216, '2023-08-05 13:48:30', 'kendrick'),
(19, 3, 5, 7, 3, 3, 5, 1400, 1, 129, 1271, '2023-08-05 13:48:30', 'CLIFF'),
(20, 0, 5, 7, 0, 3, 4, 445, NULL, NULL, 445, '2023-08-05 13:48:30', 'ewankonalang'),
(21, NULL, 5, 7, NULL, 6, 4, 670, NULL, NULL, 670, '2023-08-05 13:48:30', 'sixty');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `user` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `name`, `user`, `pass`) VALUES
(1, 'Ceejay Pascasio', 'ceejay', 'pascasio');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `combos`
--
ALTER TABLE `combos`
  ADD PRIMARY KEY (`comboID`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`foodCode`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageID`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`receiptID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `combos`
--
ALTER TABLE `combos`
  MODIFY `comboID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `foodCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `receiptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
