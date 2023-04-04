-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2023 at 09:16 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-pranav-parmar`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 'i phone', 0, '', '2023-02-13 13:10:34', '2023-02-17 10:31:15'),
(4, 'nokia', 0, '', '2023-02-13 13:15:04', NULL),
(29, 'nokia', 0, 'good\r\n', '2023-03-13 12:21:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(8, 'pranav', '', '', '', 0, '', '2023-03-12 00:35:17', NULL),
(12, 'sandip', '', '', '', 0, '', '2023-03-12 17:11:08', NULL),
(13, 'sandip', 'parmar', 'pranav123@gmail.com', '', 98765, 'inactive', '2023-03-12 17:15:11', NULL),
(14, 'kelvin', 'patel', '', '', 546545646, '', '2023-03-12 17:29:13', NULL),
(15, 'kelvi', '', '', '', 987654, '', '2023-03-12 17:30:29', NULL),
(16, 'pranav', '', '', '', 0, '', '2023-03-13 09:42:00', NULL),
(17, 'pranav', '', '', '', 0, '', '2023-03-13 09:42:15', NULL),
(18, 'pranav', '', '', '', 0, '', '2023-03-13 09:43:41', NULL),
(19, 'pranav', 'parmar', '', '', 0, '', '2023-03-13 13:18:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`payment_method_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(3, '100.00', 0, '2023-02-13 13:41:50', '2023-02-17 00:00:00'),
(6, '1000.00', 0, '2023-03-13 13:26:29', NULL),
(7, '1000.00', 1, '2023-03-13 13:36:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `color` tinyint(4) NOT NULL,
  `material` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `sku`, `cost`, `price`, `quantity`, `description`, `status`, `color`, `material`, `created_at`, `updated_at`) VALUES
(17, '', '', '0.00', '0.00', 0, '', 1, 1, 1, '2023-02-13 15:41:24', NULL),
(21, 'nokia', '23', '0.00', '0.00', 1, '', 0, 0, 0, '2023-03-09 00:00:00', NULL),
(24, 'nokia', '', '0.00', '0.00', 0, '', 0, 0, 0, '2023-03-09 02:07:24', NULL),
(26, '', '', '0.00', '0.00', 0, '', 2, 1, 1, '2023-03-10 08:07:58', NULL),
(27, 'nokia', '23', '1100.00', '100.00', 0, '', 0, 0, 0, '2023-03-10 08:09:31', NULL),
(28, 'noki', '', '0.00', '0.00', 0, '', 1, 2, 0, '2023-03-10 08:10:00', NULL),
(29, 'iphone12', '53', '60000.00', '60000.00', 1, 'best phone', 1, 1, 1, '2023-03-11 12:01:56', NULL),
(31, 'oneplus11', '54', '0.00', '0.00', 0, '', 2, 1, 0, '2023-03-11 01:18:19', NULL),
(32, 'iphone10', '33', '41000.00', '0.00', 1, '', 0, 0, 0, '2023-03-11 01:49:25', NULL),
(33, 'oneplus', '', '0.00', '0.00', 0, '', 0, 0, 0, '2023-03-11 07:16:20', NULL),
(34, 'nokia', '', '0.00', '0.00', 1, '', 0, 0, 0, '2023-03-13 01:17:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesman_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `company` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesman_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(5, 'priyanka', '', '', '', 0, '', '', '2023-02-17 12:58:18', NULL),
(12, 'pranav', 'parmar', '', '', 987654, '', '', '2023-03-12 18:03:40', NULL),
(13, 'kelvin', '', '', '', 0, '', '', '2023-03-12 18:04:25', NULL),
(16, 'pranav', '', '', '', 0, '', '', '2023-03-12 18:10:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salesman_address`
--

CREATE TABLE `salesman_address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zip` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `shipping_method_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`shipping_method_id`, `name`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(2, '', '0.00', 1, '2023-02-13 13:36:08', '2023-02-17 10:36:14'),
(3, 'nokia', '0.00', 0, '2023-02-13 13:36:09', NULL),
(4, '', '0.00', 1, '2023-02-13 13:36:09', NULL),
(5, '', '0.00', 1, '2023-02-13 13:36:45', NULL),
(7, 'cod', '0.00', 0, '2023-03-13 11:40:35', NULL),
(8, 'cod', '100.00', 0, '2023-03-13 11:56:32', NULL),
(10, 'online', '0.00', 0, '2023-03-13 13:19:27', NULL),
(11, 'cod', '10.00', 0, '2023-03-13 13:22:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `company` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(5, 'pranav', 'parmar', 'pranav123@gmail.com', 'male', 987986560, 'active', 'cybercom', '2023-02-17 10:37:44', '2023-02-17 10:37:44'),
(6, 'sandip', 'parmar', 'sandip123@gmail.com', 'male', 12345678, 'active', 'weboccult', '2023-02-27 12:54:27', '2023-02-27 12:54:27'),
(7, 'harsh', 'patel', '', '', 123456734, '', '', '2023-02-27 13:31:14', '2023-02-27 13:31:14'),
(11, 'pranav', '', '', '', 987654, '', '', '2023-03-13 13:19:03', '2023-03-13 13:19:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesman_id`);

--
-- Indexes for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`shipping_method_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `salesman_address`
--
ALTER TABLE `salesman_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `shipping_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
