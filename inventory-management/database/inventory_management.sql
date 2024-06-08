-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 08:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `img`) VALUES
(1, 'Dell', 'public/assets/img/qczpb78sl1s5g64qauyz0c.png'),
(2, 'Lenovo', 'public/assets/img/ml8cayh9u2a58wbdhfqbvh.png');

-- --------------------------------------------------------

--
-- Table structure for table `category_details`
--

CREATE TABLE `category_details` (
  `id` int(11) NOT NULL,
  `create_date` varchar(50) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `modify_date` varchar(50) NOT NULL,
  `modify_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category_details`
--

INSERT INTO `category_details` (`id`, `create_date`, `create_by`, `modify_date`, `modify_by`) VALUES
(1, '2024-06-09 01:52:43am', 'Admin', '', ''),
(2, '2024-06-09 01:52:55am', 'Admin', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `purchase_price` int(50) NOT NULL,
  `Battery` int(50) NOT NULL,
  `Charger` int(50) NOT NULL,
  `Disk` int(50) NOT NULL,
  `Ram` int(50) NOT NULL,
  `Screen` int(50) NOT NULL,
  `Keyboard` int(50) NOT NULL,
  `Total_cost` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `img`, `purchase_price`, `Battery`, `Charger`, `Disk`, `Ram`, `Screen`, `Keyboard`, `Total_cost`) VALUES
(1, 1, 'Dell Latitude E7480', 'Dell Latitude E7480 ,14.1 Display Touch Screen , Intel i7-7th Generation , 16GB RAM , SSD 512GB', 'public/assets/img/mziw2avpo7rltg9v0bo4u.jpg', 10000, 500, 200, 1000, 700, 1000, 300, 13700),
(2, 1, 'Dell Latitude E5570', 'Dell Latitude E5570 ,15.6 Display , Intel i7-6th Generation , 16GB RAM , SSD 512GB', 'public/assets/img/zfxunwqnq80rlydc68420a.jpg', 8000, 500, 200, 1000, 500, 1500, 0, 11700),
(3, 2, 'Lenovo Thinkpad X1 carbon 5th gen', 'Lenovo Thinkpad X1 carbon 5th gen ,14.1 Display , Intel i7-7th Generation , 16GB RAM , SSD 512GB', 'public/assets/img/uknj7cu3coq2crf9vz34my.png', 13000, 0, 0, 2000, 0, 1500, 800, 17300),
(4, 2, 'Lenovo Thinkpad T470s', 'Lenovo Thinkpad T470s ,14.1 Display , Intel i7-7th Generation , 16GB RAM , SSD 512GB', 'public/assets/img/8yvby22hpxwe0yrmhwr4m5.jpg', 10000, 200, 500, 0, 700, 0, 600, 12000);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `create_date` varchar(50) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `modify_date` varchar(50) NOT NULL,
  `modify_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `create_date`, `create_by`, `modify_date`, `modify_by`) VALUES
(1, '2024-06-09 01:55:15am', 'Admin', '', ''),
(2, '2024-06-09 02:19:31am', 'Admin', '', ''),
(3, '2024-06-09 02:21:09am', 'Admin', '', ''),
(4, '2024-06-09 02:22:07am', 'Admin', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Moderator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `name`, `role`, `img`, `email`) VALUES
(1, 'admin', 'admin', 'Admin', 'Admin', 'public/assets/img/1grsceh4up4hgign3yzffp.png', 'admin@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `action_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id`, `user_id`, `action`, `action_date`) VALUES
(1, '1', 'Add New Category Dell', '2024-06-09 01:52:43am'),
(2, '1', 'Add New Category Lenovo', '2024-06-09 01:52:55am'),
(3, '1', 'Add Dell Latitude E7480 in category Dell', '2024-06-09 01:55:15am'),
(4, '1', 'Add Dell Latitude E5570 in category Dell', '2024-06-09 02:19:31am'),
(5, '1', 'Add Lenovo Thinkpad X1 carbon 5th gen in category Lenovo', '2024-06-09 02:21:09am'),
(6, '1', 'Add Lenovo Thinkpad T470s in category Lenovo', '2024-06-09 02:22:07am');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_details`
--
ALTER TABLE `category_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_details`
--
ALTER TABLE `category_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
