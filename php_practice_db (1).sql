-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 16, 2022 at 12:26 PM
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
(26, 'aaaaaa', 'bbbbb', 'v@gmail', '8b64d2451b7a8f3fd17390f88ea35917', 1, '2022-02-28', '2022-03-10'),
(27, 'rahul', 'chaudhry', 'r@gmail', '439ed537979d8e831561964dbbbd7413', 1, '2022-03-02', '2022-03-10'),
(28, 'dog', 'cat', 'd@gamil', '06d80eb0c50b49a509b49f2424e8c805', 2, '2022-03-01', NULL);

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
(8, 35, 'Media/Category/2022-02-26_13-18-03_download (2).jpeg', 2, 1, 2, 1, 1),
(9, 35, 'Media/Category/2022-02-26_13-28-09_download (1).jpeg', 1, 2, 1, 1, 2),
(10, 35, 'Media/Category/2022-02-26_13-28-29_download (4).jpeg', 2, 2, 2, 1, 2),
(11, 35, 'Media/Category/2022-02-26_13-33-50_download (2).jpeg', 2, 2, 2, 2, 2),
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
(6, 2, 36),
(7, 2, 53),
(8, 2, 35),
(53, 39, 46),
(57, 39, 107),
(60, 41, 35),
(61, 41, 46),
(63, 2, 37);

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
  `updatedAt` date DEFAULT NULL,
  `salesmanId` int(11) DEFAULT -1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`id`, `firstName`, `lastName`, `email`, `mobile`, `createdAt`, `updatedAt`, `salesmanId`) VALUES
(2, 'rahul', 'bob', 'rahul@gmail', 794564, '2022-02-01', '2022-03-08', 4),
(5, 'Jerry', 'will', 'jerry@gmail', 888888, '2022-02-03', '2022-03-08', 4),
(25, 'cathycc', 'nome', 'cathy@gmail', 55555, '2022-02-04', '2022-03-10', -1),
(27, 'Vishal', 'Bindzz', 'my@gmail', 57068104, '2022-02-03', '2022-03-03', 3),
(49, 'lousy', 'wills', 'lousy@gmail', 456123, '2022-02-15', NULL, 3),
(63, 'steave', 'smith', 'steave@gmail', 456892, '2022-02-20', '2022-03-08', -1),
(64, 'hathe', 'bbbb', 'hate@jjjj', 444444, '2022-02-10', '2022-03-08', 4),
(70, 'ddddd', 'fffff', 'wwww', 444444, '2022-02-03', '2022-03-08', -1),
(71, 'neha', 'bind', 'neha@gmail', 98989898, '2022-03-07', NULL, -1),
(72, 'neha', 'bind', 'neha@gmail', 98989898, '2022-03-07', NULL, -1),
(73, 'neha', 'bind', 'neha@gmail', 98989898, '2022-03-07', '2022-03-15', -1),
(74, 'neha', 'bind', 'neha@gmail', 98989898, '2022-03-07', NULL, -1),
(75, 'NEEETA', 'BIND', 'NEETA@GMAIL', 123456, '2022-03-03', NULL, -1),
(76, 'NEEETA', 'BIND', 'NEETA@GMAIL', 123456, '2022-03-03', NULL, -1);

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
  `same` tinyint(4) DEFAULT 2,
  `billing` tinyint(4) DEFAULT 2,
  `shipping` tinyint(4) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Customer_Address`
--

INSERT INTO `Customer_Address` (`aId`, `customerId`, `address`, `pincode`, `city`, `state`, `country`, `same`, `billing`, `shipping`) VALUES
(14, 25, 'churchcc', 1124, 'kkkkkkk', 'mmmm', 'USA', 1, 1, 2),
(16, 27, 'housezz', 370205, 'GANDHIDHAM', 'crossing', 'Indiax', 1, 1, 1),
(40, 63, 'house no 11', 45876, 'dddd', 'hhhh', 'Australia', 1, 1, 1),
(42, 70, '55555', 6666, 'ddddd', 'wwwwwww', 'qqqqqqvvv', 2, 1, 2),
(43, 70, 'house no 7894', 123456, 'gandhidham', 'Kerala', 'India', 2, 2, 1),
(48, 76, 'NO 456', 456123, 'INDRASEN', 'UTTARPRADESH', 'INDIA', 2, 1, 2),
(49, 76, 'NO 123', 123456, 'AHMEDABAD', 'GUJARAT', 'INDIA', 2, 2, 1);

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
(1, 'AAAA', 'BBB', 'VVVV', 1, '2022-02-24', '2022-03-10'),
(2, 'name2', 'code2', 'DDDD', 1, '2022-02-10', '2022-03-01'),
(3, 'WWWW', 'ZZZZ', 'DDDD', 1, '2022-02-10', '2022-03-01'),
(4, 'name4', 'code4', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(5, 'hhh', 'llllllll', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(6, 'name6', 'code6', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(7, 'name7', 'code7', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(8, 'name8', 'code8', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(9, 'name9', 'code9', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(10, 'name10', 'code10', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(11, 'name11', 'code11', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
(12, 'name12', 'code12', 'nnnnnn', 2, '2022-03-24', '2022-03-11'),
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
(98, 'name98', 'code98', 'nnnnnn', 2, '2022-03-24', '2022-03-11');

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
  `updatedAt` date DEFAULT NULL,
  `sku` varchar(255) NOT NULL DEFAULT 'abcdefgh'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`id`, `name`, `price`, `quantity`, `status`, `createdAt`, `updatedAt`, `sku`) VALUES
(2, 'phones', 20000, 54, 1, '2022-02-02', '2022-03-16', 'abcdefgh'),
(12, 'watchxx', 1000.55, 88, 2, '2022-02-03', '2022-02-27', 'abcdefgh'),
(35, 'shoes', 1000, 1, 1, '2022-02-14', NULL, 'abcdefgh'),
(37, 'Flowers', 5000, 2, 1, '2022-02-09', '2022-02-27', 'abcdefgh'),
(38, 'laptop', 50000, 1, 1, '2022-02-10', NULL, 'abcdefgh'),
(39, 'Table', 5000, 1, 1, '2022-03-01', '2022-03-08', 'abcdefgh'),
(41, 'bedSheet', 500, 1, 1, '2022-03-01', NULL, 'abcdefgh');

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
(1, 2, 'Media/Product/image1.jpg', 2, 2, 2, 1, 1),
(2, 2, 'Media/Product/image2.jpg', 1, 2, 2, 1, 1),
(3, 2, 'Media/Product/image3.jpg', 2, 2, 2, 2, 1),
(4, 2, 'Media/Product/image4.jpg', 2, 1, 2, 1, 1),
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
  `updatedAt` date DEFAULT NULL,
  `percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Salesman`
--

INSERT INTO `Salesman` (`id`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdAt`, `updatedAt`, `percentage`) VALUES
(2, 'AAABB', 'EEE', 'PP', 456123, 1, '2022-02-05', '2022-03-01', 10),
(3, 'MMMM', 'CCCCC', 'UUUNN', 791256, 1, '2022-03-03', '2022-03-09', 25),
(4, 'Rama', 'Sharma', 'ram@gmail.com', 985647, 1, '2022-02-28', NULL, 30),
(5, 'john', 'mourino', 'john@outlook', 789456, 1, '2022-03-01', NULL, 10);

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
(19, 20000, 14000, 6666, 4, 2, 2),
(20, 1001, 700, 888, 4, 2, 12),
(21, 1000, 700, 7777, 4, 2, 35),
(22, 5000, 3500, 2222, 4, 2, 37),
(23, 50000, 35000, 444, 4, 2, 38),
(24, 5000, 3500, 66666, 4, 2, 39),
(25, 20000, 14000, 999, 4, 5, 2),
(26, 1001, 700, 888, 4, 5, 12),
(27, 1000, 700, 2222, 4, 5, 35),
(28, 5000, 3500, 9999, 4, 5, 37),
(29, 50000, 35000, 444, 4, 5, 38),
(30, 5000, 3500, 3333, 4, 5, 39),
(31, 500, 350, NULL, 4, 2, 41),
(32, 20000, 20000, 21205, 4, 64, 2),
(33, 1001, 1001, 1023, 4, 64, 12),
(34, 1000, 1000, 1089, 4, 64, 35),
(35, 5000, 5000, 5056, 4, 64, 37),
(36, 50000, 50000, 50000, 4, 64, 38),
(37, 5000, 5000, 555, 4, 64, 39),
(38, 500, 500, 456, 4, 64, 41);

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
-- Indexes for table `Salesman_Customer_Price`
--
ALTER TABLE `Salesman_Customer_Price`
  ADD PRIMARY KEY (`entityId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `Config`
--
ALTER TABLE `Config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `Customer_Address`
--
ALTER TABLE `Customer_Address`
  MODIFY `aId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `Page`
--
ALTER TABLE `Page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `Product_Media`
--
ALTER TABLE `Product_Media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Salesman`
--
ALTER TABLE `Salesman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Salesman_Customer_Price`
--
ALTER TABLE `Salesman_Customer_Price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
