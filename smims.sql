-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2019 at 01:42 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smims`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `c_id` int(11) NOT NULL,
  `u_id` int(10) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `gst_no` varchar(250) NOT NULL,
  `contact_person` varchar(250) NOT NULL,
  `phone_no` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`c_id`, `u_id`, `company_name`, `address`, `gst_no`, `contact_person`, `phone_no`, `email`, `type`, `create_date`, `modify_date`) VALUES
(1, 2, 'Jindal Aluminium', 'Delhi', '29AAACJ4324M1ZD', 'Mr Vaibhav', '9875852511', 'vaibhav@jindalaluminium.com', 'S', '2019-03-26 06:21:48', '0000-00-00 00:00:00'),
(2, 2, 'Nilkanth Aluminium', 'Metoda', '07AAACJ4324M1ZJ', 'Mr Deep', '7858348266', 'deep@nilkanthal.com', 'S', '2019-03-26 06:23:02', '0000-00-00 00:00:00'),
(3, 2, 'Jay CNC', 'Metoda', '43ADACJ4324M1XC', 'Mr Jay', '9752836455', 'jay@jaycnc.in', 'C', '2019-03-26 06:25:26', '2019-03-26 06:25:49'),
(4, 2, 'Deep Forge', 'Rajkot', '63ADACJ4324M1DF', 'deep', '8142896645', 'deep@deepforge.in', 'C', '2019-03-26 08:37:44', '2019-03-26 08:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `confirm_prod`
--

CREATE TABLE `confirm_prod` (
  `cp_id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `production_id` int(10) NOT NULL,
  `total_raw` int(10) NOT NULL,
  `output` int(10) NOT NULL,
  `status` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `confirm_prod`
--

INSERT INTO `confirm_prod` (`cp_id`, `u_id`, `production_id`, `total_raw`, `output`, `status`, `create_date`) VALUES
(1, 2, 1, 55, 46, '', '2019-04-02 07:46:52'),
(2, 2, 1, 55, 47, '', '2019-04-02 07:51:15'),
(3, 2, 2, 67, 58, '', '2019-04-02 08:08:23'),
(4, 2, 4, 1251, 1246, '', '2019-04-02 08:11:02'),
(5, 2, 5, 1100, 1089, '', '2019-04-02 08:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `hold_stock`
--

CREATE TABLE `hold_stock` (
  `hold_id` int(10) NOT NULL,
  `production_id` int(10) NOT NULL,
  `stock_details` text NOT NULL,
  `u_id` int(10) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hold_stock`
--

INSERT INTO `hold_stock` (`hold_id`, `production_id`, `stock_details`, `u_id`, `create_date`, `modify_date`) VALUES
(1, 1, '{\"stock_id\":[\"1\",\"3\"],\"quantity\":[\"44\",\"11\"]}', 2, '2019-04-02 07:12:54', '2019-04-02 07:12:54'),
(2, 3, '{\"stock_id\":[\"3\",\"4\"],\"quantity\":[\"11\",\"500\"]}', 2, '2019-04-02 07:14:15', '2019-04-02 07:14:15'),
(3, 2, '{\"stock_id\":[\"2\",\"4\"],\"quantity\":[\"55\",\"12\"]}', 2, '2019-04-02 07:14:21', '2019-04-02 07:14:21'),
(4, 4, '{\"stock_id\":[\"5\",\"6\"],\"quantity\":[\"510\",\"741\"]}', 2, '2019-04-02 08:10:04', '2019-04-02 08:10:04'),
(5, 3, '{\"stock_id\":[\"3\",\"4\"],\"quantity\":[\"11\",\"500\"]}', 2, '2019-04-02 08:10:06', '2019-04-02 08:10:06'),
(6, 5, '{\"stock_id\":[\"4\"],\"quantity\":[\"1100\"]}', 2, '2019-04-02 08:10:07', '2019-04-02 08:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(250) NOT NULL,
  `m_unit` varchar(250) NOT NULL,
  `u_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`m_id`, `m_name`, `m_unit`, `u_id`, `create_date`, `modify_date`) VALUES
(1, 'Aluminium Dross', 'kg', 2, '2019-03-26 06:18:18', '0000-00-00 00:00:00'),
(2, 'Aluminium Scrap', 'kg', 2, '2019-03-26 06:18:24', '0000-00-00 00:00:00'),
(3, 'Aluminium Cans', 'kg', 2, '2019-03-26 06:18:31', '0000-00-00 00:00:00'),
(4, 'Copper Wire', 'kg', 2, '2019-03-26 06:18:56', '0000-00-00 00:00:00'),
(5, 'Aluminium Wire', 'kg', 2, '2019-03-26 06:19:13', '0000-00-00 00:00:00'),
(6, 'Aluminium Dross Mix', 'kg', 2, '2019-03-26 09:17:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `material_usage`
--

CREATE TABLE `material_usage` (
  `usage_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `order_id` int(10) NOT NULL,
  `u_id` int(11) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `p_id` varchar(500) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_status` varchar(1) NOT NULL DEFAULT 'i',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`order_id`, `u_id`, `company_name`, `p_id`, `quantity`, `order_status`, `create_date`, `modify_date`) VALUES
(1, 2, '3', '3', 21, 'i', '2019-03-26 07:22:15', '2019-04-02 05:44:37'),
(2, 2, '3', '4', 34, 'f', '2019-03-26 07:45:35', '2019-03-26 08:41:08'),
(3, 2, '4', '1', 400, 'i', '2019-03-26 08:38:57', '2019-03-26 08:38:57'),
(4, 2, '3', '1', 11, 'i', '2019-04-02 08:03:33', '2019-04-02 08:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `production_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `production_name` varchar(250) DEFAULT NULL,
  `material` text,
  `m_used` int(11) DEFAULT NULL,
  `m_quantity` int(11) DEFAULT NULL,
  `total_material` int(25) DEFAULT NULL,
  `total_output` int(25) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'H',
  `production_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`production_id`, `product_id`, `u_id`, `production_name`, `material`, `m_used`, `m_quantity`, `total_material`, `total_output`, `status`, `production_date`, `modify_date`) VALUES
(1, 1, 2, 'sheet1', '{\"stock_id\":[\"1\",\"3\"],\"quantity\":[\"44\",\"11\"]}', NULL, NULL, NULL, NULL, 'U', '2019-04-02 07:11:13', '2019-04-02 07:12:54'),
(2, 3, 2, 'sheet 2', '{\"stock_id\":[\"2\",\"4\"],\"quantity\":[\"55\",\"12\"]}', NULL, NULL, NULL, NULL, 'U', '2019-04-02 07:13:30', '2019-04-02 07:14:21'),
(3, 3, 2, 'sheet 3', '{\"stock_id\":[\"3\",\"4\"],\"quantity\":[\"11\",\"500\"]}', NULL, NULL, NULL, NULL, 'H', '2019-04-02 07:13:59', '2019-04-02 08:10:16'),
(4, 1, 2, 'sheet 4', '{\"stock_id\":[\"5\",\"6\"],\"quantity\":[\"510\",\"741\"]}', NULL, NULL, NULL, NULL, 'U', '2019-04-02 08:09:34', '2019-04-02 08:10:04'),
(5, 3, 2, 'sheet 5', '{\"stock_id\":[\"4\"],\"quantity\":[\"1100\"]}', NULL, NULL, NULL, NULL, 'U', '2019-04-02 08:09:56', '2019-04-02 08:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(10) NOT NULL,
  `product_name` varchar(41) DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `unit_price` int(10) DEFAULT NULL,
  `u_id` int(10) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `product_name`, `unit`, `unit_price`, `u_id`, `active`, `create_date`, `modify_date`) VALUES
(1, 'alluminium balls', 'kg', 50, 2, 1, '2019-02-14 07:05:10', '0000-00-00 00:00:00'),
(3, 'copper billet', 'kg', 90, 2, 1, '2019-02-14 07:15:22', '0000-00-00 00:00:00'),
(4, 'iron billet', 'kg', 78, 2, 1, '2019-02-14 07:15:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(10) NOT NULL,
  `m_id` int(10) NOT NULL,
  `u_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT '0',
  `purchase_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `m_id`, `u_id`, `c_id`, `unit_price`, `quantity`, `delete_flag`, `purchase_date`, `modify_date`) VALUES
(1, 1, 2, 1, 80, 100, 0, '2019-03-26 06:26:24', '0000-00-00 00:00:00'),
(2, 1, 2, 2, 110, 800, 0, '2019-03-26 06:26:38', '0000-00-00 00:00:00'),
(3, 3, 2, 2, 70, 750, 0, '2019-03-26 06:26:59', '0000-00-00 00:00:00'),
(4, 4, 2, 2, 98, 1500, 0, '2019-03-26 06:27:13', '0000-00-00 00:00:00'),
(5, 5, 2, 1, 78, 1650, 0, '2019-03-26 06:27:46', '0000-00-00 00:00:00'),
(6, 6, 2, 1, 150, 2000, 0, '2019-03-26 09:18:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `ship_id` int(11) NOT NULL,
  `u_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `ship_status` text NOT NULL,
  `transport_no` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`ship_id`, `u_id`, `order_id`, `ship_status`, `transport_no`, `create_date`, `modify_date`) VALUES
(1, 2, 2, '', 'GJ-3-FQ-7120', '2019-04-02 08:45:21', '2019-04-02 08:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stock_modify_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `u_id`, `m_id`, `c_id`, `stock`, `create_date`, `stock_modify_date`) VALUES
(1, 2, 1, 1, 100, '2019-03-26 06:26:24', '0000-00-00 00:00:00'),
(2, 2, 1, 2, 800, '2019-03-26 06:26:38', '0000-00-00 00:00:00'),
(3, 2, 3, 2, 750, '2019-03-26 06:26:59', '0000-00-00 00:00:00'),
(4, 2, 4, 2, 1500, '2019-03-26 06:27:13', '0000-00-00 00:00:00'),
(5, 2, 5, 1, 1650, '2019-03-26 06:27:46', '0000-00-00 00:00:00'),
(6, 2, 6, 1, 2000, '2019-03-26 09:18:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_email` varchar(250) NOT NULL,
  `u_password` varchar(250) NOT NULL,
  `u_company_name` varchar(250) NOT NULL,
  `contact_person` varchar(250) NOT NULL,
  `phone_no` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_email`, `u_password`, `u_company_name`, `contact_person`, `phone_no`, `address`, `city`) VALUES
(1, 'karmavirj@gmail.com', '123456', 'karmavir', 'karmavir', '8141283971', 'rajkot', 'rajkot'),
(2, 'bhargav0049@gmail.com', '123456', 'bhargav', 'bhargav', '8141283971', 'rajkot', 'rajkot');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `confirm_prod`
--
ALTER TABLE `confirm_prod`
  ADD PRIMARY KEY (`cp_id`);

--
-- Indexes for table `hold_stock`
--
ALTER TABLE `hold_stock`
  ADD PRIMARY KEY (`hold_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `material_usage`
--
ALTER TABLE `material_usage`
  ADD PRIMARY KEY (`usage_id`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`production_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `m_id` (`m_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`ship_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `confirm_prod`
--
ALTER TABLE `confirm_prod`
  MODIFY `cp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hold_stock`
--
ALTER TABLE `hold_stock`
  MODIFY `hold_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `material_usage`
--
ALTER TABLE `material_usage`
  MODIFY `usage_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `production_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `ship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `material` (`m_id`),
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `purchase_ibfk_3` FOREIGN KEY (`c_id`) REFERENCES `company` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
