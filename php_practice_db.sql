-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 07, 2022 at 04:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_practice_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createdAt` date DEFAULT NULL,
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`id`, `firstName`, `lastName`, `email`, `password`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'rahul', 'chaudhryyy', 'rahul@gmail.com', '1234', 1, '2022-02-02', '2022-03-03'),
(16, 'sssss', 'hhhhhhhxx', 'jjjjjjjjjj', '4444444', 1, '2022-03-18', '2022-03-03'),
(18, 'aaaaaaa', 'ddddd', 'DDDDDDDD', 'BBBBB', 1, '2022-03-18', '2022-03-03'),
(19, 'hhhhh', 'llllllllll', 'qqqqqqqqq', 'llll', 1, '2022-03-08', NULL),
(20, 'hhhhh', 'llllllllll', 'qqqqqqqqq', 'llll', 1, '2022-03-08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `wholePath` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`id`, `parentId`, `name`, `wholePath`, `status`, `createdAt`, `updatedAt`) VALUES
(35, NULL, 'Bedrooms', '35', 1, '2022-02-03', '2022-02-11'),
(36, NULL, 'Livingroom', '36', 1, '2022-02-03', NULL),
(37, NULL, 'Kitchen', '37', 1, '2022-02-05', '2022-03-07'),
(46, 35, 'Bed', '35 > 46', 1, '2022-02-04', NULL),
(47, 46, 'Canopy_bed', '35 > 46 > 47', 1, '2022-02-05', '2022-02-17'),
(48, 46, 'Panel_bed', '35 > 46 > 48', 1, '2022-02-05', '2022-02-24'),
(49, 46, 'Sleigh_bedx', '35 > 46 > 49', 2, '2022-02-05', '2022-02-27'),
(50, 36, 'Sofaxx', '36 > 50', 1, '2022-02-05', '2022-02-17'),
(52, 36, 'Chair', '36 > 52', 1, '2022-02-01', NULL),
(53, 37, 'Tables', '37 > 53', 1, '2022-02-05', '2022-02-25'),
(61, 36, 'tv', '36 > 61', 1, '2022-02-04', NULL),
(62, 61, 'LED', '36 > 61 > 62', 1, '2022-02-08', '2022-02-18'),
(94, 62, 'flatPannel', '36 > 61 > 62 > 94', 1, '2022-02-02', NULL),
(102, 61, 'LCD', '36 > 61 > 102', 1, '2022-02-12', NULL),
(107, 102, 'Curvature', '36 > 61 > 102 > 107', 1, '2022-02-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Category_Media`
--

CREATE TABLE `Category_Media` (
  `id` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `base` tinyint(4) NOT NULL DEFAULT 2,
  `thum` tinyint(4) NOT NULL DEFAULT 2,
  `small` tinyint(4) NOT NULL DEFAULT 2,
  `gallary` tinyint(4) NOT NULL DEFAULT 2,
  `status` tinyint(4) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Category_Media`
--

INSERT INTO `Category_Media` (`id`, `categoryId`, `image`, `base`, `thum`, `small`, `gallary`, `status`) VALUES
(8, 35, 'Media/Category/2022-02-26_13-18-03_download (2).jpeg', 2, 2, 2, 1, 1),
(9, 35, 'Media/Category/2022-02-26_13-28-09_download (1).jpeg', 1, 2, 2, 1, 2),
(10, 35, 'Media/Category/2022-02-26_13-28-29_download (4).jpeg', 2, 2, 2, 1, 2),
(11, 35, 'Media/Category/2022-02-26_13-33-50_download (2).jpeg', 2, 1, 1, 2, 1),
(12, 35, 'Media/Category/2022-02-26_14-26-05_image1.jpg', 2, 2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Category_Product`
--

CREATE TABLE `Category_Product` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Category_Product`
--

INSERT INTO `Category_Product` (`entityId`, `productId`, `categoryId`) VALUES
(1, 39, 35),
(2, 39, 36),
(5, 39, 37),
(6, 2, 36),
(7, 2, 53),
(8, 2, 35);

-- --------------------------------------------------------

--
-- Table structure for table `Config`
--

CREATE TABLE `Config` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `createdAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Config`
--

INSERT INTO `Config` (`id`, `name`, `code`, `value`, `status`, `createdAt`) VALUES
(1, 'aaaaxx', 'bbbb', 'ccccccc', 1, '2022-02-24'),
(3, 'bbbbbbb', 'mmmmmm', 'hhhhhhh', 2, '2022-02-10'),
(4, 'zzzzzz', 'dddddddddd', 'kkkkkkk', 1, '2022-02-16');

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `id` int(11) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `mobile` int(11) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`id`, `firstName`, `lastName`, `email`, `mobile`, `createdAt`, `updatedAt`) VALUES
(2, 'rahul', 'bob', 'rahul@gmail', 794564, '2022-02-01', '2022-02-01'),
(5, 'Jerry', 'will', 'jerry@gmail', 888888, '2022-02-03', '2022-02-03'),
(25, 'cathycc', 'nome', 'cathy@gmail', 55555, '2022-02-04', '2022-02-23'),
(27, 'Vishal', 'Bindzz', 'my@gmail', 57068104, '2022-02-03', '2022-03-03'),
(49, 'lousy', 'wills', 'lousy@gmail', 456123, '2022-02-15', NULL),
(50, 'lousy', 'wills', 'lousy@gmail', 456123, '2022-02-15', NULL),
(51, 'lousy', 'wills', 'lousy@gmail', 456123, '2022-02-15', NULL),
(52, 'lousy', 'wills', 'lousy@gmail', 456123, '2022-02-15', NULL),
(53, 'lousy', 'wills', 'lousy@gmail', 456123, '2022-02-15', NULL),
(54, 'lousy', 'wills', 'lousy@gmail', 456123, '2022-02-15', NULL),
(55, 'lousy', 'wills', 'lousy@gmail', 456123, '2022-02-15', NULL),
(56, 'lousy', 'wills', 'lousy@gmail', 456123, '2022-02-15', NULL),
(57, 'lousy', 'wills', 'lousy@gmail', 456123, '2022-02-15', NULL),
(58, 'lousy', 'wills', 'lousy@gmail', 456123, '2022-02-15', NULL),
(59, 'lousyxx', 'willxxx', 'lousy@gmail', 456123, '2022-02-15', '2022-02-23'),
(60, 'Vishal', 'Bind', 'vishal@gmail', 68104, '2022-02-03', NULL),
(61, 'Vishal', 'Bind', 'vishal@gmail', 68104, '2022-02-03', NULL),
(62, 'Vishal', 'Bind', 'vishal@gmail', 68104, '2022-02-03', NULL),
(63, 'steave', 'smith', 'steave@gmail', 456892, '2022-02-20', NULL),
(64, 'hathe', 'bbbb', 'hate@jjjj', 444444, '2022-02-10', NULL),
(65, 'hathe', 'bbbb', 'hate@jjjj', 444444, '2022-02-10', NULL),
(66, 'hathe', 'bbbb', 'hate@jjjj', 444444, '2022-02-10', NULL),
(67, 'ddddd', 'fffff', 'wwww', 444444, '2022-02-03', NULL),
(68, 'ddddd', 'fffff', 'wwww', 444444, '2022-02-03', NULL),
(70, 'ddddd', 'fffff', 'wwww', 444444, '2022-02-03', '2022-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `Customer_Address`
--

CREATE TABLE `Customer_Address` (
  `aId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `state` varchar(64) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `billing` tinyint(4) DEFAULT 0,
  `shipping` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Customer_Address`
--

INSERT INTO `Customer_Address` (`aId`, `customerId`, `address`, `pincode`, `city`, `state`, `country`, `billing`, `shipping`) VALUES
(14, 25, 'churchcc', 1124, 'kkkkkkk', 'mmmm', 'USA', 1, 0),
(16, 27, 'housezz', 370205, 'GANDHIDHAM', 'crossing', 'Indiax', 0, 1),
(38, 59, 'housexx', 456, 'xyz', 'def', 'abc', 1, 0),
(39, 62, 'house no - 42', 370205, 'GANDHIDHAM', 'gujarat', 'India', 1, 0),
(40, 63, 'house no 11', 45876, 'dddd', 'hhhh', 'Australia', 0, 1),
(42, 70, '55555', 6666, 'ddddd', 'wwwwwww', 'qqqqqqvvv', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Page`
--

CREATE TABLE `Page` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `createdAt` date NOT NULL,
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Page`
--

INSERT INTO `Page` (`id`, `name`, `code`, `content`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'AAAA', 'BBB', 'VVVV', 1, '2022-02-24', '2022-03-03'),
(3, 'WWWW', 'ZZZZ', 'DDDD', 1, '2022-02-10', '2022-03-01'),
(5, 'hhh', 'lllllll', 'nnnnnn', 2, '2022-03-24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `createdAt` date DEFAULT NULL,
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`id`, `name`, `price`, `quantity`, `status`, `createdAt`, `updatedAt`) VALUES
(2, 'phones', 20000, 54, 1, '2022-02-02', '2022-02-25'),
(12, 'watchxx', 1000.55, 88, 2, '2022-02-03', '2022-02-27'),
(35, 'shoes', 1000, 1, 1, '2022-02-14', NULL),
(37, 'Flowers', 5000, 2, 1, '2022-02-09', '2022-02-27'),
(38, 'laptop', 50000, 1, 1, '2022-02-10', NULL),
(39, 'Table', 5000, 1, 1, '2022-03-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Product_Media`
--

CREATE TABLE `Product_Media` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `base` tinyint(4) NOT NULL DEFAULT 2,
  `thum` tinyint(4) NOT NULL DEFAULT 2,
  `small` tinyint(4) NOT NULL DEFAULT 2,
  `gallary` tinyint(4) NOT NULL DEFAULT 2,
  `status` tinyint(4) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Product_Media`
--

INSERT INTO `Product_Media` (`id`, `productId`, `image`, `base`, `thum`, `small`, `gallary`, `status`) VALUES
(1, 2, 'Media/Product/image1.jpg', 2, 1, 2, 1, 1),
(2, 2, 'Media/Product/image2.jpg', 2, 2, 2, 1, 1),
(3, 2, 'Media/Product/image3.jpg', 2, 2, 2, 1, 1),
(4, 2, 'Media/Product/image4.jpg', 1, 2, 2, 1, 1),
(10, 2, 'Media/Product/2022-02-26_06-43-52_image5.jpg', 2, 2, 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Salesman`
--

CREATE TABLE `Salesman` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2,
  `createdAt` date NOT NULL,
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Salesman`
--

INSERT INTO `Salesman` (`id`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdAt`, `updatedAt`) VALUES
(2, 'AAABB', 'EEE', 'PP', 456123, 1, '2022-02-05', '2022-03-01'),
(3, 'MMMM', 'CCCCC', 'UUU', 791256, 1, '2022-03-03', '2022-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `Vendor`
--

CREATE TABLE `Vendor` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2,
  `createdAt` date NOT NULL,
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Vendor`
--

INSERT INTO `Vendor` (`id`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'bbbbbmmmm', 'vvvvvqq', 'nnnn', 44444, 2, '2022-02-09', '2022-03-01'),
(2, 'aaaaGGG', 'ddddd', 'kkkkkkk', 77777, 1, '2022-02-05', '2022-03-01'),
(3, 'wwwww', 'ppppp', 'kkkkk', 777777, 1, '2022-03-03', '2022-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `Vendor_Address`
--

CREATE TABLE `Vendor_Address` (
  `aId` int(11) NOT NULL,
  `vendorId` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Vendor_Address`
--

INSERT INTO `Vendor_Address` (`aId`, `vendorId`, `country`, `state`, `city`, `pincode`) VALUES
(1, 1, 'indiaBB', 'gujarat', 'ahmedabad', 55555),
(2, 2, 'canada', 'eeee', 'nnnnn', 888888),
(3, 3, '5555', 'kkkk', 'aaaaaa', 6666);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Categories_ibfk_1` (`parentId`);

--
-- Indexes for table `Category_Media`
--
ALTER TABLE `Category_Media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `Category_Product`
--
ALTER TABLE `Category_Product`
  ADD PRIMARY KEY (`entityId`);

--
-- Indexes for table `Config`
--
ALTER TABLE `Config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Customer_Address`
--
ALTER TABLE `Customer_Address`
  ADD PRIMARY KEY (`aId`),
  ADD KEY `fk_Address_customerId` (`customerId`);

--
-- Indexes for table `Page`
--
ALTER TABLE `Page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Product_Media`
--
ALTER TABLE `Product_Media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `Salesman`
--
ALTER TABLE `Salesman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Vendor`
--
ALTER TABLE `Vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Vendor_Address`
--
ALTER TABLE `Vendor_Address`
  ADD PRIMARY KEY (`aId`),
  ADD KEY `vendorId` (`vendorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `Category_Media`
--
ALTER TABLE `Category_Media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Category_Product`
--
ALTER TABLE `Category_Product`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Config`
--
ALTER TABLE `Config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `Customer_Address`
--
ALTER TABLE `Customer_Address`
  MODIFY `aId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `Page`
--
ALTER TABLE `Page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `Product_Media`
--
ALTER TABLE `Product_Media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Salesman`
--
ALTER TABLE `Salesman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Vendor`
--
ALTER TABLE `Vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Vendor_Address`
--
ALTER TABLE `Vendor_Address`
  MODIFY `aId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Category`
--
ALTER TABLE `Category`
  ADD CONSTRAINT `Category_ibfk_1` FOREIGN KEY (`parentId`) REFERENCES `Category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Category_Media`
--
ALTER TABLE `Category_Media`
  ADD CONSTRAINT `Category_Media_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `Category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Customer_Address`
--
ALTER TABLE `Customer_Address`
  ADD CONSTRAINT `fk_Address_customerId` FOREIGN KEY (`customerId`) REFERENCES `Customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Product_Media`
--
ALTER TABLE `Product_Media`
  ADD CONSTRAINT `Product_Media_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `Product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Vendor_Address`
--
ALTER TABLE `Vendor_Address`
  ADD CONSTRAINT `Vendor_Address_ibfk_1` FOREIGN KEY (`vendorId`) REFERENCES `Vendor` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
