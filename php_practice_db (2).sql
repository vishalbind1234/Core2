-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2022 at 03:07 PM
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
(26, 'aaaXXXXX', 'bbbbb', 'v@gmail', '8b64d2451b7a8f3fd17390f88ea35917', 1, '2022-02-28', '2022-04-02'),
(49, 'QQQQ', 'hhhhh', 'ppppp', 'ccccc', 1, NULL, NULL),
(50, 'QQQQ', 'hhhhh', 'ppppp', 'ccccc', 1, NULL, NULL),
(51, 'QQQQ', 'hhhhh', 'ppppp', 'ccccc', 1, NULL, NULL),
(52, 'QQQQ', 'hhhhh', 'ppppp', 'ccccc', 1, NULL, '2022-03-31'),
(53, 'QQQQ', 'hhhhh', 'ppppp', 'ccccc', 1, NULL, NULL),
(64, 'bindXXz', 'rahul', 'rahul@gmail', '1bbd886460827015e5d605ed44252251', 1, '2022-03-10', '2022-03-30'),
(65, 'QQQQ', 'jjjjjjjjjj', 'ccccccccc', 'xxxxxxxxxx', 1, NULL, '2022-03-31'),
(66, 'QQQQ', 'jjjjjjjjjj', 'ccccccccc', 'xxxxxxxxxx', 1, NULL, NULL),
(76, 'qqqqq', 'sssssss', 'zzzzzzzzz', 'ccccccccccccc', 1, NULL, '2022-03-31'),
(77, 'qqqqq', 'sssssss', 'XXXXXX', 'ccccccccccccc', 1, NULL, '2022-04-02'),
(78, 'qqqqq', 'sssssss', 'zzzzzzzzz', 'ccccccccccccc', 1, NULL, NULL),
(79, 'qqqqq', 'sssssss', 'zzzzzzzzz', 'ccccccccccccc', 1, NULL, NULL),
(80, 'qqqqq', 'sssssss', 'zzzzzzzzz', 'ccccccccccccc', 1, NULL, NULL),
(81, 'qqqqq', 'sssssss', 'zzzzzzzzz', 'ccccccccccccc', 1, NULL, NULL),
(82, 'qqqqq', 'sssssss', 'zzzzzzzzz', 'ccccccccccccc', 1, NULL, NULL),
(83, 'Vishal', 'Bind', 'bindvishal@gmail', '552e6a97297c53e592208cf97fbb3b60', 1, '2022-03-04', '2022-03-30'),
(84, 'sssssssss', 'ooooooo', 'pppppp', 'kkkkkkkkkkk', 1, NULL, NULL),
(85, 'sssssssss', 'ooooooo', 'pppppp', 'kkkkkkkkkkk', 1, NULL, NULL),
(88, 'sssssssss', 'ooooooo', 'pppppp', 'kkkkkkkkkkk', 1, NULL, NULL),
(89, 'sssssssss', 'ooooooo', 'pppppp', 'kkkkkkkkkkk', 1, NULL, NULL),
(90, 'sssssssss', 'ooooooo', 'pppppp', 'kkkkkkkkkkk', 1, NULL, NULL),
(91, 'sssssssss', 'ooooooo', 'pppppp', 'kkkkkkkkkkk', 1, NULL, NULL),
(92, 'sssssssss', 'ooooooo', 'pppppp', 'kkkkkkkkkkk', 1, NULL, NULL),
(93, 'sssssssss', 'ooooooo', 'pppppp', 'kkkkkkkkkkk', 1, NULL, NULL),
(94, 'sssssssss', 'ooooooo', 'pppppp', 'kkkkkkkkkkk', 1, NULL, NULL),
(95, 'sssssssss', 'ooooooo', 'pppppp', 'kkkkkkkkkkk', 1, NULL, NULL),
(96, 'sssssssss', 'ooooooo', 'pppppp', 'kkkkkkkkkkk', 1, NULL, NULL),
(97, 'sssssssss', 'ooooooo', 'pppppp', 'kkkkkkkkkkk', 1, NULL, NULL),
(98, 'sssssssss', 'ooooooo', 'pppppp', 'kkkkkkkkkkk', 1, NULL, '2022-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `Cart`
--

CREATE TABLE `Cart` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `shippingMethodId` int(11) NOT NULL DEFAULT 1,
  `shippingCharge` int(11) DEFAULT 0,
  `paymentMethodId` int(11) NOT NULL DEFAULT 1,
  `cartTotal` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `createdAt` date DEFAULT NULL,
  `updatedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Cart`
--

INSERT INTO `Cart` (`id`, `customerId`, `shippingMethodId`, `shippingCharge`, `paymentMethodId`, `cartTotal`, `discount`, `createdAt`, `updatedAt`) VALUES
(70, 25, 1, 50, 1, 53565.1, 99.5, NULL, NULL),
(71, 63, 1, 0, 1, 0, 0, NULL, NULL),
(72, 70, 1, 0, 1, 0, 0, NULL, NULL),
(73, 78, 2, 50, 1, 82871.6, 200, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Cart_Address`
--

CREATE TABLE `Cart_Address` (
  `addressId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL,
  `same` tinyint(4) NOT NULL DEFAULT 2,
  `addressType` varchar(255) NOT NULL DEFAULT 'billing',
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Cart_Address`
--

INSERT INTO `Cart_Address` (`addressId`, `cartId`, `country`, `state`, `city`, `address`, `pincode`, `same`, `addressType`, `firstName`, `lastName`, `mobile`, `email`) VALUES
(65, 70, 'USAX', 'mmmmmmX', 'kkkkkX', 'oooooRRRX', 1124, 2, 'shipping', 'cathycc', 'nome', 55555, 'cathy@gmail'),
(67, 70, 'USAX', 'mmmmmmX', 'kkkkkX', 'ooooPPPQQ', 1124, 1, 'billing', 'cathycc', 'nome', 55555, 'cathy@gmail');

-- --------------------------------------------------------

--
-- Table structure for table `Cart_Item`
--

CREATE TABLE `Cart_Item` (
  `id` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `taxPercentage` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `price` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `taxAmount` float NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `discountMode` varchar(255) NOT NULL DEFAULT 'fixed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Cart_Item`
--

INSERT INTO `Cart_Item` (`id`, `cartId`, `productId`, `productName`, `taxPercentage`, `price`, `quantity`, `taxAmount`, `discount`, `discountMode`) VALUES
(139, 73, 2, 'phones', '2.5000', 19995, 1, 500, 0, 'fixed'),
(140, 73, 12, 'watchxx', '3.6000', 996, 1, 36.0198, 0, 'fixed'),
(141, 73, 35, 'shoes', '2.8000', 995, 1, 28, 0, 'fixed'),
(144, 70, 35, 'shoes', '2.8000', 995, 1, 28, 0, 'fixed'),
(145, 70, 46, 'laptopXX', '5.0000', 49950, 1, 2500, 0, 'fixed'),
(146, 70, 44, 'Comb', '2.5000', 90, 1, 2.5, 0, 'fixed'),
(147, 73, 38, 'laptop', '9.4000', 49996, 1, 4700, 0, 'fixed'),
(148, 73, 39, 'Table', '12.6000', 4996, 1, 630, 0, 'fixed');

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
(35, NULL, 'BedroomsXXYY', '35', 1, '2022-02-03', '2022-04-04'),
(36, NULL, 'Livingroom', '36', 1, '2022-02-03', NULL),
(37, NULL, 'Kitchen', '37', 1, '2022-02-05', '2022-03-07'),
(46, 35, 'Beds', '35 > 46', 1, '2022-02-04', '2022-03-17'),
(47, 46, 'Canopy_bed', '35 > 46 > 47', 1, '2022-02-05', '2022-02-17'),
(48, 46, 'Panel_bed', '35 > 46 > 48', 1, '2022-02-05', '2022-02-24'),
(49, 46, 'Sleigh_bedx', '35 > 46 > 49', 2, '2022-02-05', '2022-02-27'),
(50, 36, 'Sofaxx', '36 > 50', 1, '2022-02-05', '2022-02-17'),
(52, 36, 'Chair', '36 > 52', 1, '2022-02-01', NULL),
(53, 37, 'Tablesxx', '37 > 53', 1, '2022-02-05', '2022-03-21'),
(61, 36, 'tv', '36 > 61', 1, '2022-02-04', NULL),
(62, 61, 'LED', '36 > 61 > 62', 1, '2022-02-08', '2022-02-18'),
(94, 62, 'flatPannel', '36 > 61 > 62 > 94', 1, '2022-02-02', NULL),
(102, 61, 'LCD', '36 > 61 > 102', 1, '2022-02-12', NULL),
(107, 102, 'Curvature', '36 > 61 > 102 > 107', 1, '2022-02-01', NULL),
(111, 52, 'LoveSeat', '36 > 52 > 111', 1, '2022-03-08', NULL);

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
(8, 35, '2022-02-26_13-18-03_download (2).jpeg', 1, 2, 2, 1, 1),
(9, 35, '2022-02-26_13-28-09_download (1).jpeg', 2, 2, 1, 1, 2),
(10, 35, '2022-02-26_13-28-29_download (4).jpeg', 2, 2, 2, 2, 2),
(11, 35, '2022-02-26_13-33-50_download (2).jpeg', 2, 2, 2, 2, 2),
(12, 35, '2022-02-26_14-26-05_image1.jpg', 2, 1, 2, 1, 1),
(15, 35, '2022-03-21_07-09-23_Screenshot from 2022-03-20 09-22-17.png', 2, 2, 2, 2, 2),
(16, 46, '2022-03-21_07-10-09_Screenshot from 2022-03-16 19-43-17.png', 1, 1, 1, 1, 1),
(18, 47, '2022-03-21_14-35-57_vidar-nordli-mathisen-2cNh00feVzw-unsplash.jpg', 1, 2, 2, 1, 2),
(19, 47, '2022-03-21_14-36-11_tom-crew-7HuTGlUfQSo-unsplash.jpg', 2, 2, 2, 1, 2),
(20, 47, '2022-03-21_14-36-23_stijn-swinnen-qwe8TLRnG8k-unsplash.jpg', 2, 1, 2, 1, 2),
(21, 47, '2022-03-21_14-36-44_senjuti-kundu-JfolIjRnveY-unsplash.jpg', 2, 2, 1, 2, 2),
(22, 48, '2022-03-21_14-37-29_aedrian-Tws17PwytpA-unsplash.jpg', 1, 2, 2, 2, 2),
(23, 48, '2022-03-21_14-37-46_andrew-karn--yZjegM0sUw-unsplash.jpg', 2, 1, 2, 2, 2),
(24, 49, '2022-03-21_14-38-21_cara-fuller-BeHRkALwXIw-unsplash.jpg', 2, 1, 2, 2, 2),
(25, 36, '2022-03-21_14-38-49_clay-banks-1Uj0HmqQFGk-unsplash.jpg', 2, 1, 2, 2, 2),
(26, 50, '2022-03-21_14-39-28_sangga-rima-roman-selia-nemGViUnshQ-unsplash.jpg', 2, 1, 2, 2, 2);

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
(6, 2, 36),
(8, 2, 35),
(53, 39, 46),
(57, 39, 107),
(60, 41, 35),
(61, 41, 46),
(63, 2, 37),
(65, 2, 62),
(66, 42, 37),
(67, 42, 61),
(68, 43, 61),
(69, 43, 62),
(70, 43, 94),
(71, 43, 102),
(72, 43, 107);

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
(1, 'aaaaxxXXXX', 'bbbb', 'ccccccc', 1, '2022-02-24'),
(3, 'xxxxx', 'mmmmmm', 'hhhhhhh', 2, '2022-02-10'),
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
  `updatedAt` date DEFAULT NULL,
  `salesmanId` int(11) DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`id`, `firstName`, `lastName`, `email`, `mobile`, `createdAt`, `updatedAt`, `salesmanId`) VALUES
(25, 'cathycc', 'nome', 'cathy@gmail', 55555, '2022-02-04', '2022-03-10', 2),
(63, 'steave', 'smith', 'steave@gmail', 456892, '2022-02-20', '2022-03-24', 2),
(70, 'ddddd', 'fffff', 'wwww', 444444, '2022-02-03', '2022-03-08', -1),
(77, 'NELSON', 'TORE', 'NEL@GMAIL', 123456, '2022-03-07', '2022-03-16', -1),
(78, 'SPIDERXX', 'MAN', 'SPI@GMAIL', 123456, '2022-03-09', '2022-04-01', 2),
(104, 'tttttttt', 'pppppppppp', 'llllllllllllllllll', 44444444, '2022-04-06', NULL, 2),
(109, 'yyyyyyyy', 'iiiiiiiii', 'oooooooo', 444, '2022-04-05', NULL, -1),
(110, 'XXXXXXX', 'iiiiiiiii', 'oooooooo', 444, '2022-04-05', '2022-04-02', -1),
(111, 'yyyyyyyy', 'iiiiiiiii', 'oooooooo', 444, '2022-04-05', NULL, 2),
(112, 'yyyyyyyy', 'iiiiiiiii', 'oooooooo', 444, '2022-04-05', NULL, 2),
(113, 'yyyyyyyy', 'iiiiiiiii', 'oooooooo', 444, '2022-04-05', NULL, 2),
(114, 'yyyyyyyy', 'iiiiiiiii', 'oooooooo', 444, '2022-04-05', NULL, -1),
(115, 'yyyyyyyy', 'iiiiiiiii', 'oooooooo', 444, '2022-04-05', NULL, -1),
(116, 'yyyyyyyy', 'iiiiiiiii', 'oooooooo', 444, '2022-04-05', NULL, -1),
(117, 'yyyyyyyy', 'iiiiiiiii', 'oooooooo', 444, '2022-04-05', NULL, -1),
(118, 'yyyyyyyy', 'iiiiiiiii', 'oooooooo', 444, '2022-04-05', NULL, -1),
(119, 'yyyyyyyy', 'iiiiiiiii', 'oooooooo', 444, '2022-04-05', NULL, -1),
(120, 'yyyyyyyy', 'iiiiiiiii', 'oooooooo', 444, '2022-04-05', NULL, -1),
(121, 'Vishal', 'Bind', 'neha@gmail', 91570, '2022-03-30', NULL, -1);

-- --------------------------------------------------------

--
-- Table structure for table `Customer_Address`
--

CREATE TABLE `Customer_Address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `address` text DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `state` varchar(64) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `same` tinyint(4) DEFAULT 2,
  `addressType` varchar(255) NOT NULL DEFAULT 'billing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Customer_Address`
--

INSERT INTO `Customer_Address` (`addressId`, `customerId`, `address`, `pincode`, `city`, `state`, `country`, `same`, `addressType`) VALUES
(245, 25, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(246, 63, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(247, 70, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(248, 77, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(249, 78, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(250, 104, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(251, 109, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(252, 110, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(253, 111, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(254, 112, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(255, 113, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(256, 114, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(257, 115, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(258, 116, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(259, 117, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(260, 118, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(261, 119, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(262, 120, NULL, NULL, NULL, NULL, NULL, 2, 'billing'),
(263, 121, NULL, NULL, NULL, NULL, NULL, 2, 'billing');

-- --------------------------------------------------------

--
-- Table structure for table `Order_Address`
--

CREATE TABLE `Order_Address` (
  `id` int(11) NOT NULL,
  `addressId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `addressType` varchar(255) NOT NULL,
  `same` int(11) DEFAULT NULL,
  `createdAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Order_Address`
--

INSERT INTO `Order_Address` (`id`, `addressId`, `orderId`, `firstName`, `lastName`, `email`, `mobile`, `city`, `state`, `country`, `pincode`, `address`, `addressType`, `same`, `createdAt`) VALUES
(33, 67, 35, 'cathycc', 'nome', 'cathy@gmail', 55555, 'kkkkkX', 'mmmmmmX', 'USAX', 1124, 'ooooPPPQQ', 'billing', 1, NULL),
(34, 65, 35, 'cathycc', 'nome', 'cathy@gmail', 55555, 'kkkkkX', 'mmmmmmX', 'USAX', 1124, 'oooooRRRX', 'shipping', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Order_Comment`
--

CREATE TABLE `Order_Comment` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `note` text NOT NULL,
  `createdAt` date NOT NULL,
  `status` text NOT NULL,
  `notifiedToCustomer` text NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Order_Item`
--

CREATE TABLE `Order_Item` (
  `id` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `cost` float NOT NULL DEFAULT 0,
  `price` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `createdAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Order_Item`
--

INSERT INTO `Order_Item` (`id`, `itemId`, `orderId`, `productId`, `name`, `sku`, `cost`, `price`, `discount`, `quantity`, `createdAt`) VALUES
(44, 144, 35, 35, 'shoes', 'abcdefgh', 995, 995, 0, 1, '2022-04-06'),
(45, 145, 35, 46, 'laptopXX', 'abcdefgh', 49950, 49950, 0, 1, '2022-04-06'),
(46, 146, 35, 44, 'Comb', 'abcdefgh', 90, 90, 0, 1, '2022-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `Order_Table`
--

CREATE TABLE `Order_Table` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `grandTotal` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `shippingMethodId` int(11) NOT NULL,
  `shippingAmount` float NOT NULL DEFAULT 0,
  `paymentMethodId` int(11) NOT NULL,
  `state` varchar(255) NOT NULL DEFAULT 'pending',
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `createdAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Order_Table`
--

INSERT INTO `Order_Table` (`id`, `customerId`, `firstName`, `lastName`, `email`, `mobile`, `grandTotal`, `discount`, `shippingMethodId`, `shippingAmount`, `paymentMethodId`, `state`, `status`, `createdAt`) VALUES
(35, 25, 'cathycc', 'nome', 'cathy@gmail', 55555, 53615.1, 99.5, 1, 0, 1, 'pending', 'pending', '2022-04-06');

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
(1, 'AAAAXX', 'BBB', 'VVVV', 1, '2022-02-24', '2022-04-04'),
(4, 'name4', 'code4', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(5, 'hhh', 'llllllll', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(6, 'name6', 'code6', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(7, 'name7', 'code7', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(8, 'name8', 'code8', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(9, 'name9', 'code9', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(10, 'name10', 'code10', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(11, 'name11', 'code11', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(13, 'name13', 'code13', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(14, 'name14', 'code14', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(15, 'name15', 'code15', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(16, 'name16', 'code16', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(17, 'name17', 'code17', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(18, 'name18', 'code18', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(19, 'name19', 'code19', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(20, 'name20', 'code20', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(21, 'name21', 'code21', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(22, 'name22', 'code22', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(23, 'name23', 'code23', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(24, 'name24', 'code24', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(25, 'name25', 'code25', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(26, 'name26', 'code26', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(27, 'name27', 'code27', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(28, 'name28', 'code28', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(29, 'name29', 'code29', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(30, 'name30', 'code30', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(31, 'name31', 'code31', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(32, 'name32', 'code32', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(33, 'name33', 'code33', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(34, 'name34', 'code34', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(35, 'name35', 'code35', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(36, 'name36', 'code36', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(37, 'name37', 'code37', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(38, 'name38', 'code38', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(39, 'name39', 'code39', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(40, 'name40', 'code40', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(41, 'name41', 'code41', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(42, 'name42', 'code42', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(43, 'name43', 'code43', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(44, 'name44', 'code44', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(45, 'name45', 'code45', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(46, 'name46', 'code46', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(47, 'name47', 'code47', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(48, 'name48', 'code48', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(49, 'name49', 'code49', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(50, 'name50', 'code50', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(51, 'name51', 'code51', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(52, 'name52', 'code52', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(53, 'name53', 'code53', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(54, 'name54', 'code54', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(55, 'name55', 'code55', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(56, 'name56', 'code56', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(57, 'name57', 'code57', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(58, 'name58', 'code58', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(59, 'name59', 'code59', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(60, 'name60', 'code60', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(61, 'name61', 'code61', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(62, 'name62', 'code62', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(63, 'name63', 'code63', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(64, 'name64', 'code64', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(65, 'name65', 'code65', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(66, 'name66', 'code66', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(67, 'name67', 'code67', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(68, 'name68', 'code68', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(69, 'name69', 'code69', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(70, 'name70', 'code70', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(71, 'name71', 'code71', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(72, 'name72', 'code72', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(73, 'name73', 'code73', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(74, 'name74', 'code74', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(75, 'name75', 'code75', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(76, 'name76', 'code76', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(77, 'name77', 'code77', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(78, 'name78', 'code78', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(79, 'name79', 'code79', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(80, 'name80', 'code80', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(81, 'name81', 'code81', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(82, 'name82', 'code82', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(83, 'name83', 'code83', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(84, 'name84', 'code84', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(85, 'name85', 'code85', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(86, 'name86', 'code86', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(87, 'name87', 'code87', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(88, 'name88', 'code88', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(89, 'name89', 'code89', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(90, 'name90', 'code90', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(91, 'name91', 'code91', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(92, 'name92', 'code92', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(93, 'name93', 'code93', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(94, 'name94', 'code94', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(95, 'name95', 'code95', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(96, 'name96', 'code96', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(97, 'name97', 'code97', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(98, 'name98', 'code98', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(99, 'EEEEE', 'LLLLLL', 'SSSSSSS', 1, '2022-03-08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Payment_Method`
--

CREATE TABLE `Payment_Method` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL DEFAULT 'safe_method',
  `status` int(11) NOT NULL DEFAULT 1,
  `createdAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Payment_Method`
--

INSERT INTO `Payment_Method` (`id`, `name`, `note`, `status`, `createdAt`) VALUES
(1, 'UPIXX', 'safe_method', 1, NULL),
(2, 'INTERNET_BANKING', 'safe_method', 1, NULL),
(3, 'DEBIT_CART', 'safe_method', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `discount` float NOT NULL DEFAULT 0,
  `discountMode` varchar(255) NOT NULL DEFAULT 'fixed',
  `taxPercentage` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `status` int(11) DEFAULT NULL,
  `createdAt` date DEFAULT NULL,
  `updatedAt` date DEFAULT NULL,
  `sku` varchar(255) NOT NULL DEFAULT 'abcdefgh'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`id`, `name`, `price`, `discount`, `discountMode`, `taxPercentage`, `quantity`, `status`, `createdAt`, `updatedAt`, `sku`) VALUES
(2, 'phones', 20000, 5, 'fixed', '2.5000', 1, 1, '2022-02-02', '2022-03-17', 'abcdefgh'),
(12, 'watchxx', 1000.55, 5, 'fixed', '3.6000', 1, 2, '2022-02-03', '2022-02-27', 'abcdefgh'),
(35, 'shoes', 1000, 5, 'fixed', '2.8000', 1, 1, '2022-02-14', '2022-03-21', 'abcdefgh'),
(37, 'Flowers', 5000, 5, 'fixed', '7.5000', 1, 1, '2022-02-09', '2022-02-27', 'abcdefgh'),
(38, 'laptop', 50000, 4, 'fixed', '9.4000', 1, 2, '2022-02-10', NULL, 'abcdefgh'),
(39, 'Table', 5000, 4, 'fixed', '12.6000', 1, 1, '2022-03-01', '2022-03-08', 'abcdefgh'),
(41, 'bedSheet', 500, 4, 'fixed', '15.3000', 1, 1, '2022-03-01', NULL, 'abcdefgh'),
(42, 'bottles', 100, 5, 'fixed', '7.9000', 1, 1, '2022-03-01', '2022-04-02', 'abcdefgh'),
(43, 'Book', 100, 5, 'fixed', '20.2200', 1, 1, '2022-03-08', '2022-04-02', 'abcdefgh'),
(44, 'Comb', 100, 10, 'fixed', '2.5000', 1, 1, '2022-03-31', NULL, 'abcdefgh'),
(46, 'laptopXX', 50000, 50, 'fixed', '5.0000', 1, 1, '2022-03-31', '2022-04-02', 'abcdefgh');

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
(1, 2, 'image1.jpg', 2, 2, 1, 1, 1),
(2, 2, 'image2.jpg', 2, 1, 2, 1, 1),
(3, 2, 'image3.jpg', 1, 2, 2, 2, 1),
(4, 2, 'image4.jpg', 2, 2, 2, 1, 1),
(10, 2, '2022-02-26_06-43-52_image5.jpg', 2, 2, 2, 2, 2),
(12, 2, '2022-03-21_06-54-04_Screenshot from 2022-03-09 14-45-33.png', 2, 2, 2, 1, 2),
(13, 12, '2022-03-21_14-46-09_aedrian-Tws17PwytpA-unsplash.jpg', 2, 1, 2, 1, 2),
(14, 12, '2022-03-21_14-56-04_cara-fuller-BeHRkALwXIw-unsplash.jpg', 1, 2, 2, 1, 2),
(15, 35, '2022-03-21_14-57-38_senjuti-kundu-GCI8dqi4uWM-unsplash.jpg', 2, 1, 2, 2, 2),
(17, 38, '2022-03-21_14-58-31_20358132-4cdb678668ab12f698cd66392274f895.png', 2, 1, 2, 2, 2),
(18, 39, '2022-03-21_14-58-51_vidar-nordli-mathisen-2cNh00feVzw-unsplash.jpg', 2, 1, 2, 2, 2),
(19, 41, '2022-03-21_14-59-25_phpearth-menu.png', 2, 1, 2, 2, 2),
(20, 42, '2022-03-21_14-59-44_clay-banks-1Uj0HmqQFGk-unsplash.jpg', 2, 1, 2, 2, 2),
(21, 43, '2022-03-21_15-00-05_aedrian-Tws17PwytpA-unsplash.jpg', 2, 1, 2, 2, 2);

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
  `updatedAt` date DEFAULT NULL,
  `percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Salesman`
--

INSERT INTO `Salesman` (`id`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdAt`, `updatedAt`, `percentage`) VALUES
(2, 'AAXXX', 'EEE', 'PP', 456123, 1, '2022-02-05', '2022-04-03', 10),
(3, 'MMMM', 'CCCCC', 'UUUNN', 791256, 1, '2022-03-03', '2022-03-17', 25),
(4, 'Rama', 'Sharma', 'ram@gmail.com', 985647, 1, '2022-02-28', NULL, 30),
(5, 'john', 'mourino', 'john@outlook', 789456, 1, '2022-03-01', NULL, 10),
(6, 'AAAAA', 'DDDDDDD', 'FFFFF', 555555, 1, '2022-03-06', NULL, 21);

-- --------------------------------------------------------

--
-- Table structure for table `Salesman_Customer_Price`
--

CREATE TABLE `Salesman_Customer_Price` (
  `entityId` int(11) NOT NULL,
  `productPrice` int(11) DEFAULT NULL,
  `salesmanPrice` int(11) DEFAULT NULL,
  `customerPrice` int(11) DEFAULT NULL,
  `salesmanId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Salesman_Customer_Price`
--

INSERT INTO `Salesman_Customer_Price` (`entityId`, `productPrice`, `salesmanPrice`, `customerPrice`, `salesmanId`, `customerId`, `productId`) VALUES
(60, 20000, 14000, 14555, 4, 2, 2),
(61, 1001, 700, 777, 4, 2, 12),
(62, 1000, 700, 777, 4, 2, 35),
(63, 5000, 3500, 3555, 4, 2, 37),
(64, 50000, 35000, 35555, 4, 2, 38),
(65, 5000, 3500, 3500, 4, 2, 39),
(66, 500, 350, 400, 4, 2, 41),
(67, 100, 70, 72, 4, 2, 42),
(68, 100, 70, 72, 4, 2, 43),
(69, 20000, 15000, 15555, 3, 27, 2),
(70, 1001, 750, 755, 3, 27, 12),
(71, 1000, 750, 755, 3, 27, 35),
(72, 5000, 3750, 3777, 3, 27, 37),
(73, 50000, 37500, 37777, 3, 27, 38),
(74, 5000, 3750, 4000, 3, 27, 39),
(75, 500, 375, 400, 3, 27, 41),
(76, 100, 75, 80, 3, 27, 42),
(77, 100, 75, 80, 3, 27, 43),
(78, 20000, 18000, 2000, 2, 63, 2),
(79, 1001, 900, 333, 2, 63, 12),
(80, 1000, 900, 4444, 2, 63, 35),
(81, 5000, 4500, 2222, 2, 63, 37),
(82, 50000, 45000, 99999, 2, 63, 38),
(83, 5000, 4500, NULL, 2, 63, 39),
(84, 500, 450, NULL, 2, 63, 41),
(85, 100, 90, NULL, 2, 63, 42),
(86, 100, 90, NULL, 2, 63, 43),
(87, 100, 90, 100, 2, 63, 44),
(88, 50000, 45000, 499999, 2, 63, 46);

-- --------------------------------------------------------

--
-- Table structure for table `Shipping_Method`
--

CREATE TABLE `Shipping_Method` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shippingAmount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Shipping_Method`
--

INSERT INTO `Shipping_Method` (`id`, `name`, `shippingAmount`) VALUES
(1, 'NORMAL_DELIVERY', 0),
(2, 'FAST_DELIVERY', 50),
(3, '1_DAY_DELIVERYX', 100);

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
(1, 'xxxxxx', 'vvvvvqq', 'nnnn', 44444, 2, '2022-02-09', '2022-03-19'),
(3, 'vishal_bindXX', 'ppppp', 'kkkkk', 777777, 1, '2022-03-03', '2022-04-03'),
(4, 'HHHHXX', 'MMMMM', 'NNNNNN', 4444444, 1, '2022-03-02', '2022-04-03'),
(6, 'Rahul', 'prajapati', 'rah@ffff', 44444, 1, '2022-03-31', NULL),
(7, 'raju', 'salso', 'raju@gmail', 88888, 1, '2022-04-21', NULL),
(8, 'vishalXX', 'bind', 'vishal@gmail.com', 98745632, 1, '2022-04-15', '2022-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `Vendor_Address`
--

CREATE TABLE `Vendor_Address` (
  `addressId` int(11) NOT NULL,
  `vendorId` int(11) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Vendor_Address`
--

INSERT INTO `Vendor_Address` (`addressId`, `vendorId`, `country`, `state`, `city`, `pincode`) VALUES
(1, 1, 'indiaBBxx', 'gujarat', 'ahmedabadXXX', 55555),
(3, 3, 'India_IndiaXX', 'kkkk', 'aaaaaa', 6666),
(4, 4, 'BBBBBB', 'QQQQQ', 'MXXXXXX', 555555),
(6, 6, 'ind_india', 'guj-Raj', 'abd-city', 55555),
(7, 7, 'ind', 'guj', 'gandhidham', 44444),
(8, 8, 'india', 'gujarat', 'gandhidhamXX', 122345);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `Cart_ibfk_2` (`paymentMethodId`),
  ADD KEY `shippingMethod` (`shippingMethodId`);

--
-- Indexes for table `Cart_Address`
--
ALTER TABLE `Cart_Address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `cartId` (`cartId`);

--
-- Indexes for table `Cart_Item`
--
ALTER TABLE `Cart_Item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cartId` (`cartId`),
  ADD KEY `productId` (`productId`);

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
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `fk_Address_customerId` (`customerId`);

--
-- Indexes for table `Order_Address`
--
ALTER TABLE `Order_Address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `Order_Comment`
--
ALTER TABLE `Order_Comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Order_Item`
--
ALTER TABLE `Order_Item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `Order_Table`
--
ALTER TABLE `Order_Table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `shippingMethodId` (`shippingMethodId`),
  ADD KEY `paymentMethodId` (`paymentMethodId`);

--
-- Indexes for table `Page`
--
ALTER TABLE `Page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Payment_Method`
--
ALTER TABLE `Payment_Method`
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
-- Indexes for table `Salesman_Customer_Price`
--
ALTER TABLE `Salesman_Customer_Price`
  ADD PRIMARY KEY (`entityId`);

--
-- Indexes for table `Shipping_Method`
--
ALTER TABLE `Shipping_Method`
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
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `vendorId` (`vendorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `Cart`
--
ALTER TABLE `Cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `Cart_Address`
--
ALTER TABLE `Cart_Address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `Cart_Item`
--
ALTER TABLE `Cart_Item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `Category_Media`
--
ALTER TABLE `Category_Media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `Category_Product`
--
ALTER TABLE `Category_Product`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `Config`
--
ALTER TABLE `Config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `Customer_Address`
--
ALTER TABLE `Customer_Address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `Order_Address`
--
ALTER TABLE `Order_Address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `Order_Comment`
--
ALTER TABLE `Order_Comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Order_Item`
--
ALTER TABLE `Order_Item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `Order_Table`
--
ALTER TABLE `Order_Table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `Page`
--
ALTER TABLE `Page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `Payment_Method`
--
ALTER TABLE `Payment_Method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `Product_Media`
--
ALTER TABLE `Product_Media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `Salesman`
--
ALTER TABLE `Salesman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Salesman_Customer_Price`
--
ALTER TABLE `Salesman_Customer_Price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `Shipping_Method`
--
ALTER TABLE `Shipping_Method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Vendor`
--
ALTER TABLE `Vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Vendor_Address`
--
ALTER TABLE `Vendor_Address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cart`
--
ALTER TABLE `Cart`
  ADD CONSTRAINT `Cart_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `Customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `Cart_ibfk_2` FOREIGN KEY (`paymentMethodId`) REFERENCES `Payment_Method` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Cart_ibfk_3` FOREIGN KEY (`shippingMethodId`) REFERENCES `Shipping_Method` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Cart_Address`
--
ALTER TABLE `Cart_Address`
  ADD CONSTRAINT `Cart_Address_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `Cart` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Cart_Item`
--
ALTER TABLE `Cart_Item`
  ADD CONSTRAINT `Cart_Item_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `Cart` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `Cart_Item_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `Product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
-- Constraints for table `Order_Address`
--
ALTER TABLE `Order_Address`
  ADD CONSTRAINT `Order_Address_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `Order_Table` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Order_Item`
--
ALTER TABLE `Order_Item`
  ADD CONSTRAINT `Order_Item_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `Order_Table` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `Order_Table`
--
ALTER TABLE `Order_Table`
  ADD CONSTRAINT `Order_Table_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `Customer` (`id`),
  ADD CONSTRAINT `Order_Table_ibfk_2` FOREIGN KEY (`shippingMethodId`) REFERENCES `Shipping_Method` (`id`),
  ADD CONSTRAINT `Order_Table_ibfk_3` FOREIGN KEY (`paymentMethodId`) REFERENCES `Payment_Method` (`id`);

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
