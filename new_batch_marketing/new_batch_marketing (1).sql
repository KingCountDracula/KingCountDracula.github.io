-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2016 at 11:54 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `new_batch_marketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE IF NOT EXISTS `agent` (
  `agent_id` int(6) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(15) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `contact_num` bigint(15) NOT NULL,
  `area` int(6) NOT NULL,
  PRIMARY KEY (`agent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`agent_id`, `lastname`, `firstname`, `contact_num`, `area`) VALUES
(3, 'Anter', 'Christine Joy', 97394937534, 1),
(6, 'Antoque', 'Jerra Mae', 9374797342, 2),
(7, 'Cagulada', 'Cyril Owen', 93493479543, 3),
(8, 'Lauron', 'Charles', 98384649923, 4),
(9, 'Abuyot', 'Louise', 929389793352, 5);

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `area` int(6) NOT NULL,
  `barangay` varchar(15) NOT NULL,
  `town` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `area`, `barangay`, `town`) VALUES
(1, 2, 'Abugon', 'Sibonga'),
(2, 1, 'Poblacion', 'Sibonga'),
(3, 1, 'Gahad', 'Sibonga'),
(4, 1, 'Pandan', 'Sibonga'),
(5, 1, 'Kapuso-an', 'Sibonga'),
(6, 1, 'Taloot', 'Sibonga'),
(7, 2, 'Kabukugan', 'Sibonga'),
(8, 2, 'Sabang', 'Sibonga'),
(9, 2, 'Candaguit', 'Sibonga'),
(10, 2, 'Mangyan', 'Sibonga'),
(11, 3, 'Suba', 'Sibonga'),
(12, 3, 'Bahay', 'Sibonga'),
(13, 3, 'Bagacay', 'Sibonga'),
(14, 3, 'Dumlog', 'Sibonga'),
(15, 3, 'Simala', 'Sibonga'),
(16, 3, 'Lindogon', 'Sibonga'),
(17, 4, 'Guiwanon', 'Argao'),
(18, 4, 'Taloot', 'Argao'),
(19, 4, 'Bulasa', 'Argao'),
(20, 4, 'Binlod', 'Argao'),
(21, 5, 'Poblacion', 'Argao'),
(22, 5, 'Langtad', 'Argao'),
(23, 5, 'Bogo', 'Argao'),
(24, 5, 'Talaga', 'Argao');

-- --------------------------------------------------------

--
-- Table structure for table `credit_list`
--

CREATE TABLE IF NOT EXISTS `credit_list` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `credit_transaction_id` varchar(15) NOT NULL,
  `product_code` varchar(15) NOT NULL,
  `quantity` int(6) NOT NULL,
  `amount` double(15,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `credit_transactions`
--

CREATE TABLE IF NOT EXISTS `credit_transactions` (
  `credit_transaction_id` varchar(15) NOT NULL,
  `customer_account_id` bigint(15) NOT NULL,
  `total` double(15,2) NOT NULL,
  `balance` double(15,2) NOT NULL DEFAULT '0.00',
  `credit_transaction_date` date NOT NULL,
  PRIMARY KEY (`credit_transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_account_id` int(6) NOT NULL AUTO_INCREMENT,
  `customer_lastName` varchar(15) NOT NULL,
  `customer_firstName` varchar(25) NOT NULL,
  `barangay` varchar(15) NOT NULL,
  `town` varchar(15) NOT NULL,
  `area` int(6) NOT NULL,
  `customer_contact_number` bigint(15) NOT NULL,
  `customer_status` varchar(10) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`customer_account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_account_id`, `customer_lastName`, `customer_firstName`, `barangay`, `town`, `area`, `customer_contact_number`, `customer_status`) VALUES
(1, 'Yamagutchi', 'John Michael', 'Abugon', 'Sibonga', 2, 8038048038403, 'active'),
(2, 'Arbuiz', 'Johnly', 'Abugon', 'Sibonga', 2, 9748758623483, 'active'),
(3, 'Bacacao', 'Cesaria', 'Bagacay', 'Sibonga', 3, 9322823741, 'active'),
(4, 'Alcedera', 'Celia', 'Bagacay', 'Sibonga', 3, 4869843, 'inactive'),
(5, 'Cagulada', 'Cyril Owen', 'Abugon', 'Sibonga', 2, 90384083048, 'active'),
(6, 'Malibiran', 'Danilo', 'Langtad', 'Argao', 5, 9979346535, 'active'),
(7, 'Redoble', 'Amorlina', 'Bagacay', 'Sibonga', 3, 9836486342, 'active'),
(9, 'Pabriga', 'Christian', 'Binlod', 'Argao', 4, 96236434521, 'active'),
(10, 'Tecson', 'Nena', 'Guiwanon', 'Argao', 4, 97926782241, 'active'),
(11, 'Undaloc', 'Brenda', 'Bogo', 'Argao', 5, 998738634422, 'active'),
(12, 'Dela Torre', 'Anecito', 'Lindogon', 'Sibonga', 3, 98278254539, 'active'),
(13, 'Miranda', 'Stephen', 'Taloot', 'Argao', 4, 98854634265, 'active'),
(14, 'Alferez', 'Valentin', 'Talaga', 'Argao', 5, 98679874253, 'active'),
(15, 'Rama', 'Cherryl', 'Abugon', 'Sibonga', 2, 98359864234, 'active'),
(16, 'Mendaros', 'Agnes', 'Candaguit', 'Sibonga', 2, 93874634225, 'active'),
(17, 'Garcel', 'Maricel', 'Bulasa', 'Argao', 4, 97937465342, 'active'),
(18, 'Bacaltos', 'Arcel', 'Bahay', 'Sibonga', 3, 98354639941, 'active'),
(19, 'Ponce', 'Ferdinand', 'Poblacion', 'Sibonga', 1, 987683463425, 'active'),
(20, 'Oacan', 'Maggie', 'Bahay', 'Sibonga', 3, 98374836341, 'active'),
(21, 'Espina', 'Emmanuel', 'Poblacion', 'Argao', 5, 98738646342, 'active'),
(22, 'Abrera', 'Jule', 'Poblacion', 'Sibonga', 1, 934794652425, 'active'),
(23, 'Apuda', 'Rey', 'Sabang', 'Sibonga', 2, 97937946352, 'active'),
(24, 'Cabardo', 'Joel', 'Kabukugan', 'Sibonga', 2, 99739754643, 'active'),
(25, 'Kintanar', 'Cristopher', 'Simala', 'Sibonga', 3, 983479767632, 'active'),
(26, 'Villardo', 'Allen', 'Poblacion', 'Argao', 5, 94957233452, 'active'),
(29, 'FLores', 'Leodegaria', 'Sabang', 'Sibonga', 2, 9763512842, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `customer_delivery`
--

CREATE TABLE IF NOT EXISTS `customer_delivery` (
  `customer_delivery_id` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `purchase_order_id` varchar(15) NOT NULL,
  `delivered_by` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`customer_delivery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_delivery`
--

INSERT INTO `customer_delivery` (`customer_delivery_id`, `date`, `purchase_order_id`, `delivered_by`, `status`) VALUES
('D0905024721C', '0000-00-00', 'O0904084656C', 'ADMIN', 'CLEARED'),
('D0906081716C', '2016-09-06', 'O0904082253C', 'ADMIN', 'CANCELLED'),
('D0907011243C', '2016-09-07', 'O0904082841C', 'ADMIN', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_delivery_details`
--

CREATE TABLE IF NOT EXISTS `customer_delivery_details` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `customer_delivery_id` varchar(15) NOT NULL,
  `product_code` varchar(15) NOT NULL,
  `quantity` bigint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `customer_delivery_details`
--

INSERT INTO `customer_delivery_details` (`id`, `customer_delivery_id`, `product_code`, `quantity`) VALUES
(43, 'D0905024721C', 'RY311L	', 12),
(44, 'D0905024721C', 'SP211L', 12),
(45, 'D0905024721C', 'CK1515L', 5),
(46, 'D0905024721C', 'CK12SKT', 12),
(47, 'D0905024721C', 'CK0111L', 12),
(48, 'D0905024721C', 'RY328OZ', 12),
(49, 'D0906074557C', 'RY311L	', 12),
(50, 'D0906074557C', 'SP211L', 12),
(51, 'D0906074557C', 'CK168OZ', 12),
(52, 'D0906074557C', 'CK14FML', 12),
(53, 'D0906074557C', 'CK13KSL', 12),
(54, 'D0906074557C', 'CK12SKT', 12),
(55, 'D0906074557C', 'CK0111L', 12),
(56, 'D0906075610C', 'SP211L', 12),
(57, 'D0906075610C', 'RY311L	', 12),
(58, 'D0906075610C', 'CK12SKT', 12),
(59, 'D0906075610C', 'CK0111L', 12),
(60, 'D0906081716C', 'RY311L	', 12),
(61, 'D0906081716C', 'SP211L', 12),
(62, 'D0906081716C', 'CK168OZ', 12),
(63, 'D0906081716C', 'CK14FML', 12),
(64, 'D0906081716C', 'CK13KSL', 12),
(65, 'D0906081716C', 'CK12SKT', 12),
(66, 'D0906081716C', 'CK0111L', 12),
(67, 'D0907011243C', 'SP211L', 12),
(68, 'D0907011243C', 'RY311L	', 12),
(69, 'D0907011243C', 'CK12SKT', 12),
(70, 'D0907011243C', 'CK0111L', 12);

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE IF NOT EXISTS `customer_order` (
  `purchase_order_id` varchar(15) NOT NULL,
  `customer_id` bigint(15) NOT NULL,
  `order_date` date NOT NULL,
  `case` bigint(15) NOT NULL,
  `amount` double(15,2) NOT NULL,
  `delivery_date` date NOT NULL,
  `processor` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'FD',
  PRIMARY KEY (`purchase_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`purchase_order_id`, `customer_id`, `order_date`, `case`, `amount`, `delivery_date`, `processor`, `status`) VALUES
('O0904082253C', 23, '2016-09-04', 84, 21120.00, '2016-09-06', 'ADMIN', 'CANCELLED'),
('O0904082841C', 25, '2016-09-04', 48, 12216.00, '2016-08-19', 'ADMIN', 'OFD'),
('O0904083133C', 11, '2016-09-04', 15, 3048.00, '2016-09-07', 'ADMIN', 'FD'),
('O0904083657C', 12, '2016-09-04', 21, 4724.00, '2016-09-07', 'ADMIN', 'FD'),
('O0904084656C', 21, '2016-09-04', 65, 16259.00, '2016-09-06', 'ADMIN', 'CLEARED'),
('O0904085238C', 14, '2016-09-04', 14, 3272.00, '2016-09-07', 'ADMIN', 'FD'),
('O0904090120C', 15, '2016-09-04', 9, 2718.00, '2016-09-07', 'ADMIN', 'FD');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order_list`
--

CREATE TABLE IF NOT EXISTS `customer_order_list` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `purchase_order_id` varchar(15) NOT NULL,
  `product_code` varchar(15) NOT NULL,
  `quantity` int(6) NOT NULL,
  `selling_price` double(6,2) NOT NULL,
  `amount` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `customer_order_list`
--

INSERT INTO `customer_order_list` (`id`, `purchase_order_id`, `product_code`, `quantity`, `selling_price`, `amount`) VALUES
(27, 'O0904082253C', 'RY311L	', 12, 309.00, 3708),
(28, 'O0904082253C', 'SP211L', 12, 300.00, 3600),
(29, 'O0904082253C', 'CK168OZ', 12, 179.00, 2148),
(30, 'O0904082253C', 'CK14FML', 12, 283.00, 3396),
(31, 'O0904082253C', 'CK13KSL', 12, 279.00, 3348),
(32, 'O0904082253C', 'CK12SKT', 12, 110.00, 1320),
(33, 'O0904082253C', 'CK0111L', 12, 300.00, 3600),
(34, 'O0904082841C', 'SP211L', 12, 300.00, 3600),
(35, 'O0904082841C', 'RY311L	', 12, 309.00, 3708),
(36, 'O0904082841C', 'CK12SKT', 12, 109.00, 1308),
(37, 'O0904082841C', 'CK0111L', 12, 300.00, 3600),
(38, 'O0904083133C', 'SP228OZ', 3, 189.00, 567),
(39, 'O0904083133C', 'SP211L', 3, 300.00, 900),
(40, 'O0904083133C', 'RY311L	', 3, 309.00, 927),
(41, 'O0904083133C', 'CK12SKT', 6, 109.00, 654),
(42, 'O0904083657C', 'SP228OZ', 3, 189.00, 567),
(43, 'O0904083657C', 'RY328OZ', 3, 189.00, 567),
(44, 'O0904083657C', 'CK12SKT', 5, 109.00, 545),
(45, 'O0904083657C', 'RY311L	', 5, 309.00, 1545),
(46, 'O0904083657C', 'SP211L', 5, 300.00, 1500),
(47, 'O0904084656C', 'RY311L	', 12, 309.00, 3708),
(48, 'O0904084656C', 'SP211L', 12, 300.00, 3600),
(49, 'O0904084656C', 'CK1515L', 5, 355.00, 1775),
(50, 'O0904084656C', 'CK12SKT', 12, 109.00, 1308),
(51, 'O0904084656C', 'CK0111L', 12, 300.00, 3600),
(52, 'O0904084656C', 'RY328OZ', 12, 189.00, 2268),
(53, 'O0904085238C', 'CK12SKT', 5, 109.00, 545),
(54, 'O0904085238C', 'SP211L', 3, 300.00, 900),
(55, 'O0904085238C', 'RY311L	', 3, 309.00, 927),
(56, 'O0904085238C', 'CK0111L', 3, 300.00, 900),
(57, 'O0904090120C', 'RY311L	', 2, 309.00, 618),
(58, 'O0904090120C', 'SP211L', 3, 300.00, 900),
(59, 'O0904090120C', 'CK0111L', 4, 300.00, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `delivery_id` varchar(15) NOT NULL,
  `delivery_date` date NOT NULL,
  `purchase_id` varchar(15) NOT NULL,
  PRIMARY KEY (`delivery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details`
--

CREATE TABLE IF NOT EXISTS `delivery_details` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `delivery_id` varchar(15) NOT NULL,
  `product_id` varchar(15) NOT NULL,
  `quantity_delivered` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_shortage`
--

CREATE TABLE IF NOT EXISTS `order_shortage` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `prod_code` varchar(15) NOT NULL,
  `quantity` int(6) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `order_shortage`
--

INSERT INTO `order_shortage` (`id`, `prod_code`, `quantity`, `date`) VALUES
(2, 'CK0111L', 12, '2016-09-04'),
(3, 'CK12SKT', 7, '2016-09-04'),
(4, 'CK0111L', 12, '2016-09-04'),
(5, 'CK12SKT', 12, '2016-09-04'),
(6, 'RY311L	', 2, '2016-09-04'),
(7, 'SP211L', 12, '2016-09-04'),
(8, 'CK12SKT', 6, '2016-09-04'),
(9, 'RY311L	', 3, '2016-09-04'),
(10, 'SP211L', 3, '2016-09-04'),
(11, 'SP211L', 5, '2016-09-04'),
(12, 'RY311L	', 5, '2016-09-04'),
(13, 'CK12SKT', 5, '2016-09-04'),
(14, 'CK0111L', 12, '2016-09-04'),
(15, 'CK12SKT', 12, '2016-09-04'),
(16, 'SP211L', 12, '2016-09-04'),
(17, 'RY311L	', 12, '2016-09-04'),
(18, 'CK0111L', 3, '2016-09-04'),
(19, 'RY311L	', 3, '2016-09-04'),
(20, 'SP211L', 3, '2016-09-04'),
(21, 'CK12SKT', 5, '2016-09-04'),
(22, 'CK0111L', 4, '2016-09-04'),
(23, 'SP211L', 3, '2016-09-04'),
(24, 'RY311L	', 2, '2016-09-04');

-- --------------------------------------------------------

--
-- Table structure for table `order_supplier`
--

CREATE TABLE IF NOT EXISTS `order_supplier` (
  `order_supplier_id` varchar(15) NOT NULL,
  `supplier_id` bigint(15) NOT NULL,
  `order_date` date NOT NULL,
  `processed_by` varchar(30) NOT NULL,
  `total_case` bigint(15) NOT NULL,
  PRIMARY KEY (`order_supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_supplier`
--

INSERT INTO `order_supplier` (`order_supplier_id`, `supplier_id`, `order_date`, `processed_by`, `total_case`) VALUES
('O0904081135S', 4, '2016-09-04', 'ADMIN', 152);

-- --------------------------------------------------------

--
-- Table structure for table `order_supplier_list`
--

CREATE TABLE IF NOT EXISTS `order_supplier_list` (
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  `order_supplier_id` varchar(15) NOT NULL,
  `product_code` varchar(15) NOT NULL,
  `quantity` bigint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `order_supplier_list`
--

INSERT INTO `order_supplier_list` (`id`, `order_supplier_id`, `product_code`, `quantity`) VALUES
(56, 'O0904081135S', 'SP2315L', 12),
(57, 'O0904081135S', 'SP228OZ', 12),
(58, 'O0904081135S', 'SP211L', 20),
(59, 'O0904081135S', 'RY3315L', 12),
(60, 'O0904081135S', 'RY328OZ', 12),
(61, 'O0904081135S', 'RY311L	', 12),
(62, 'O0904081135S', 'CK168OZ', 12),
(63, 'O0904081135S', 'CK1515L', 12),
(64, 'O0904081135S', 'CK14FML', 12),
(65, 'O0904081135S', 'CK13KSL', 12),
(66, 'O0904081135S', 'CK12SKT', 12),
(67, 'O0904081135S', 'CK0111L', 12);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `transaction_id` varchar(15) NOT NULL,
  `customer_order_id` varchar(15) NOT NULL,
  `customer_id` int(6) NOT NULL,
  `amount_payable` double(15,2) NOT NULL,
  `balance` double(15,2) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`transaction_id`, `customer_order_id`, `customer_id`, `amount_payable`, `balance`) VALUES
('CC0907051403CR', 'O0904082841C', 25, 12216.00, 3442.00);

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE IF NOT EXISTS `payment_details` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(15) NOT NULL,
  `OR` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `amount_paid` double(15,2) NOT NULL,
  `received_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `transaction_id`, `OR`, `date`, `amount_paid`, `received_by`) VALUES
(11, 'CC0907051403CR', 'G349-834OO', '2016-09-05', 5000.00, 'ADMIN'),
(12, 'CC0907051403CR', 'G349-834OO', '2016-09-07', 3216.00, 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_code` varchar(15) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_type` varchar(15) NOT NULL,
  `bottle_per_case` int(6) NOT NULL,
  `unit_price` double(6,2) NOT NULL,
  `selling_price` double(6,2) NOT NULL,
  PRIMARY KEY (`product_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_code`, `product_name`, `product_type`, `bottle_per_case`, `unit_price`, `selling_price`) VALUES
('CK0111L', 'Coke', 'Litro', 12, 263.00, 300.00),
('CK12SKT', 'Coke', 'Sakto', 24, 87.00, 109.00),
('CK13KSL', 'Coke', 'Kasalo', 12, 218.00, 279.00),
('CK14FML', 'Coke', 'Family', 12, 237.00, 283.00),
('CK1515L', 'Coke', '1.5L', 12, 270.00, 355.00),
('CK168OZ', 'Coke', '8OZ', 24, 112.00, 179.00),
('RY311L	', 'Royal', 'Litro', 12, 267.00, 309.00),
('RY328OZ', 'Royal', '8OZ', 24, 143.00, 189.00),
('RY3315L', 'Royal', '1.5L', 12, 343.00, 391.00),
('SP211L', 'Sprite', 'Litro', 12, 263.00, 300.00),
('SP228OZ', 'Sprite', '8OZ', 24, 143.00, 189.00),
('SP2315L', 'Sprite', '1.5L', 12, 313.00, 379.00);

-- --------------------------------------------------------

--
-- Table structure for table `purchase order`
--

CREATE TABLE IF NOT EXISTS `purchase order` (
  `purchase_order_number` varchar(15) NOT NULL,
  `account_id` bigint(15) NOT NULL,
  `total_amount` double(6,2) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` varchar(15) NOT NULL DEFAULT 'for delivery',
  PRIMARY KEY (`purchase_order_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `transaction_id` varchar(15) NOT NULL,
  `OR` varchar(15) NOT NULL,
  `order_id` varchar(15) NOT NULL,
  `customer_id` int(6) NOT NULL,
  `amount` double(15,2) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`transaction_id`, `OR`, `order_id`, `customer_id`, `amount`, `date`) VALUES
('CA0907113700SH', 'CLK97734500', 'O0904084656C', 21, 16259.00, '2016-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `stock_code` varchar(15) NOT NULL,
  `case` int(6) NOT NULL DEFAULT '0',
  `bottle` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`stock_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_code`, `case`, `bottle`) VALUES
('CK0111L', 36, 8),
('CK12SKT', 36, 3),
('CK13KSL', 19, 10),
('CK14FML', 36, 5),
('CK1515L', 34, 4),
('CK168OZ', 40, 10),
('RY311L	', 60, 11),
('RY328OZ', 59, 6),
('RY3315L', 26, 11),
('SP211L', 36, 3),
('SP228OZ', 26, 0),
('SP2315L', 36, 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_account_id` int(6) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(30) NOT NULL,
  `supplier_address` varchar(60) NOT NULL,
  `supplier_contact_number` bigint(15) NOT NULL,
  PRIMARY KEY (`supplier_account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_account_id`, `supplier_name`, `supplier_address`, `supplier_contact_number`) VALUES
(1, 'AB Marketing', 'Poblacion,  Carcar City, Cebu', 97634578223),
(2, 'Coca Cola Bottlers', 'Mandaue City, Cebu', 2539677),
(3, 'Dy Entriprises', 'Pardo, Cebu City', 997937453453),
(4, 'JEDCO', 'Ocana, Carcar City', 999547925456);

-- --------------------------------------------------------

--
-- Table structure for table `temporary_container`
--

CREATE TABLE IF NOT EXISTS `temporary_container` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(15) NOT NULL,
  `product_name` varchar(15) NOT NULL,
  `product_type` varchar(15) NOT NULL,
  `selling_price` double(6,2) NOT NULL,
  `total_selling_price` double(6,2) NOT NULL,
  `available_stock` int(6) NOT NULL,
  `case` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_customer_order`
--

CREATE TABLE IF NOT EXISTS `temporary_customer_order` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(15) NOT NULL,
  `product_name` varchar(15) NOT NULL,
  `product_type` varchar(15) NOT NULL,
  `selling_price` double(15,2) NOT NULL,
  `amount` double(15,2) NOT NULL,
  `case` bigint(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_order_shortage`
--

CREATE TABLE IF NOT EXISTS `temporary_order_shortage` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `prod_code` varchar(15) NOT NULL,
  `quantity` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_order_supplier`
--

CREATE TABLE IF NOT EXISTS `temporary_order_supplier` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(15) NOT NULL,
  `quantity` bigint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `temporary_order_supplier`
--

INSERT INTO `temporary_order_supplier` (`id`, `product_code`, `quantity`) VALUES
(1, 'CK13KSL', 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `password`, `user_type`) VALUES
(7, 'Rage', 'Cabellon', 'rage', 'rgcabellon', 'user'),
(8, 'Malou', 'Cabellon', 'mcCabellon', 'cabellonMalou', 'user'),
(9, 'Renato', 'Cabellon', 'mrCab', 'cabzRenato', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
