-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 05:21 PM
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
-- Database: `buffet`
--

-- --------------------------------------------------------

--
-- Table structure for table `bil`
--

CREATE TABLE `bil` (
  `bi_id` int(100) NOT NULL,
  `prod_id` int(100) NOT NULL,
  `ta_id` int(100) NOT NULL,
  `bi_qty` int(255) NOT NULL,
  `bi_am` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `imported`
--

CREATE TABLE `imported` (
  `im_id` int(100) NOT NULL,
  `im_img` varchar(255) NOT NULL,
  `im_name` varchar(255) NOT NULL,
  `im_qty` varchar(255) NOT NULL,
  `im_sprice` decimal(12,2) NOT NULL,
  `im_date` date NOT NULL,
  `im_time` time NOT NULL,
  `prod_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mony`
--

CREATE TABLE `mony` (
  `mony_id` int(100) NOT NULL,
  `mony_qty` varchar(255) NOT NULL,
  `mony_name` decimal(12,2) NOT NULL,
  `mony_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `or_id` int(100) NOT NULL,
  `prod_id` int(100) NOT NULL,
  `or_qty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(100) NOT NULL,
  `prod_img` varchar(255) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_price` decimal(12,2) NOT NULL,
  `prod_sprice` decimal(12,2) NOT NULL,
  `prod_qty` varchar(255) NOT NULL,
  `prod_remak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_img`, `prod_name`, `prod_price`, `prod_sprice`, `prod_qty`, `prod_remak`) VALUES
(1, '628bb103950cbbe5a.png', 'ເບຍລາວ', 15000.00, 12000.00, '2', ''),
(3, '515448.jpg', 'ບຸບເຟ້ຜູ້ໃຫຍ່', 178000.00, 150000.00, '6', '');

-- --------------------------------------------------------

--
-- Table structure for table `table`
--

CREATE TABLE `table` (
  `ta_id` int(100) NOT NULL,
  `ta_name` varchar(255) NOT NULL,
  `ta_status` varchar(100) NOT NULL,
  `ta_remak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `table`
--

INSERT INTO `table` (`ta_id`, `ta_name`, `ta_status`, `ta_remak`) VALUES
(1, 'A01', 'Loose', ''),
(2, 'A02', 'Loose', ''),
(4, 'A03', 'Loose', ''),
(5, 'A04', 'Loose', ''),
(6, 'A05', 'Loose', ''),
(7, 'A06', 'Loose', ''),
(8, 'A07', 'Loose', ''),
(9, 'A08', 'Loose', '');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `ty_id` int(100) NOT NULL,
  `ty_name` varchar(255) NOT NULL,
  `ty_price` decimal(12,2) NOT NULL,
  `ty_remak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`ty_id`, `ty_name`, `ty_price`, `ty_remak`) VALUES
(2, 'ຜູ້ໃຫຍ່', 178000.00, ''),
(4, 'ເດັກນ້ອຍ', 48000.00, ''),
(6, 'ໂປຣປີໃຫມ່ ຜູ້ໃຫຍ່', 159000.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `us_id` int(100) NOT NULL,
  `us_img` varchar(255) NOT NULL,
  `us_name` varchar(255) NOT NULL,
  `us_tel` varchar(255) NOT NULL,
  `us_salary` decimal(12,2) NOT NULL,
  `us_username` varchar(255) NOT NULL,
  `us_password` varchar(255) NOT NULL,
  `us_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`us_id`, `us_img`, `us_name`, `us_tel`, `us_salary`, `us_username`, `us_password`, `us_status`) VALUES
(4, 'portrait-handsome-cartoon-businessman-character-man-blue-background-use-laptop-presentation-3d-render-illustration_839035-118734.jpg', 'Mona LL', '205511544', 1525588.00, 'mona', '202cb962ac59075b964b07152d234b70', 'admin'),
(5, 'download.jpg', 'Nata Bll', '20551555', 140000.00, 'nata', '202cb962ac59075b964b07152d234b70', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bil`
--
ALTER TABLE `bil`
  ADD PRIMARY KEY (`bi_id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `ta_id` (`ta_id`);

--
-- Indexes for table `imported`
--
ALTER TABLE `imported`
  ADD PRIMARY KEY (`im_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `mony`
--
ALTER TABLE `mony`
  ADD PRIMARY KEY (`mony_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`or_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `table`
--
ALTER TABLE `table`
  ADD PRIMARY KEY (`ta_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ty_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bil`
--
ALTER TABLE `bil`
  MODIFY `bi_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `imported`
--
ALTER TABLE `imported`
  MODIFY `im_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mony`
--
ALTER TABLE `mony`
  MODIFY `mony_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `or_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `table`
--
ALTER TABLE `table`
  MODIFY `ta_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `ty_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `us_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bil`
--
ALTER TABLE `bil`
  ADD CONSTRAINT `bil_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`),
  ADD CONSTRAINT `bil_ibfk_2` FOREIGN KEY (`ta_id`) REFERENCES `table` (`ta_id`);

--
-- Constraints for table `imported`
--
ALTER TABLE `imported`
  ADD CONSTRAINT `imported_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
