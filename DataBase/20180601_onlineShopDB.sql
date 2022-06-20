-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 01, 2018 at 03:11 PM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineShopDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `addressMembers__`
--

CREATE TABLE IF NOT EXISTS `addressMembers__` (
  `address_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `address_name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(30) NOT NULL,
  `postal_code` int(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category__`
--

CREATE TABLE IF NOT EXISTS `category__` (
  `category_id` int(4) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `information` text NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imagesProduct__`
--

CREATE TABLE IF NOT EXISTS `imagesProduct__` (
  `image_id` int(11) NOT NULL,
  `name_file` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members__`
--

CREATE TABLE IF NOT EXISTS `members__` (
  `member_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `join_date` datetime NOT NULL,
  `photo` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `gender` int(1) NOT NULL,
  `birthday` date NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menus__`
--

CREATE TABLE IF NOT EXISTS `menus__` (
  `id_menu` int(5) NOT NULL,
  `nama_menu` varchar(30) NOT NULL,
  `page` varchar(50) NOT NULL,
  `sub_menu` int(5) NOT NULL,
  `icon_menu` varchar(50) NOT NULL,
  `link_menu` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL,
  `posisi_menu` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus__`
--

INSERT INTO `menus__` (`id_menu`, `nama_menu`, `page`, `sub_menu`, `icon_menu`, `link_menu`, `is_active`, `posisi_menu`) VALUES
(1, 'Beranda', 'beranda', 0, 'menu-icon fa fa-home faa-tada', 'Admin/Beranda', 1, 1),
(2, 'Mater Toko', 'masterToko', 0, 'menu-icon fa fa-list faa-tada', '#', 1, 2),
(3, 'Data Pembayaran', 'payment', 2, 'menu-icon fa fa-dollar faa-tada', 'Admin/Payment', 1, 1),
(4, 'Kategori', 'category', 2, 'menu-icon fa fa-sitemap faa-tada', 'Admin/Category', 1, 2),
(5, 'Produk', 'product', 2, 'menu-icon fa fa-gift faa-tada', 'Admin/Product', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `payment__`
--

CREATE TABLE IF NOT EXISTS `payment__` (
  `payment_id` int(3) NOT NULL,
  `payment_name` varchar(50) NOT NULL,
  `payment_account_name` varchar(50) NOT NULL,
  `payment_number` varchar(50) NOT NULL,
  `payment_logo` varchar(50) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment__`
--

INSERT INTO `payment__` (`payment_id`, `payment_name`, `payment_account_name`, `payment_number`, `payment_logo`, `is_active`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
(1, 'MANDIRI', 'khozin', '09989987987', 'mandiri.jpg', 1, '2018-06-01 09:54:26', 1, '2018-06-01 18:07:20', 1),
(2, 'BCA', 'Khozin', '878787989787', 'bca.png', 0, '2018-06-01 10:53:48', 1, '2018-06-01 21:33:37', 2),
(3, 'BRI', 'Khozin', '65765767', 'BRI.jpg', 0, '2018-06-01 15:09:05', 1, '2018-06-01 18:07:23', 1),
(6, 'BNI', 'Khozin', '989787676', 'Logo-BNI.jpg', 1, '2018-06-01 18:03:53', 1, '2018-06-01 18:03:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product__`
--

CREATE TABLE IF NOT EXISTS `product__` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `information` text NOT NULL,
  `price` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `categori_id` int(4) NOT NULL,
  `stock` int(5) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `system__`
--

CREATE TABLE IF NOT EXISTS `system__` (
  `id_app` int(1) NOT NULL,
  `name_app` varchar(75) NOT NULL,
  `deskripsi_app` text NOT NULL,
  `logo_app` varchar(255) NOT NULL,
  `bg_login` varchar(255) DEFAULT NULL,
  `title_app` varchar(75) NOT NULL,
  `favicon_app` varchar(255) NOT NULL,
  `timezone_app` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system__`
--

INSERT INTO `system__` (`id_app`, `name_app`, `deskripsi_app`, `logo_app`, `bg_login`, `title_app`, `favicon_app`, `timezone_app`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
(1, 'Online Shop', 'Situs Belanja Online Belanja Mudah Hidup Senang', 'small_ciptasoft.png', 'login-bg.jpg', 'Online Shop', 'small_ciptasoft.png', 'Asia/Jakarta', '2017-03-19 00:00:00', 1, '2017-07-17 22:52:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users__`
--

CREATE TABLE IF NOT EXISTS `users__` (
  `user_id` int(3) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users__`
--

INSERT INTO `users__` (`user_id`, `fullname`, `username`, `password`, `photo`, `is_active`) VALUES
(1, 'Root', '098473719e010be4cf048073d1d02b27', '8f6fbac447353367dbca478cdd026b81', '', 1),
(2, 'Verenca', '90d71f5ea7555a73e1b679cfc67add89', '8917cff378242c5222ba26342c64c260', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addressMembers__`
--
ALTER TABLE `addressMembers__`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `category__`
--
ALTER TABLE `category__`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `imagesProduct__`
--
ALTER TABLE `imagesProduct__`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `members__`
--
ALTER TABLE `members__`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `menus__`
--
ALTER TABLE `menus__`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `payment__`
--
ALTER TABLE `payment__`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product__`
--
ALTER TABLE `product__`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `system__`
--
ALTER TABLE `system__`
  ADD PRIMARY KEY (`id_app`),
  ADD KEY `create_by` (`created_by`),
  ADD KEY `modified_by` (`modified_by`);

--
-- Indexes for table `users__`
--
ALTER TABLE `users__`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addressMembers__`
--
ALTER TABLE `addressMembers__`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category__`
--
ALTER TABLE `category__`
  MODIFY `category_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `imagesProduct__`
--
ALTER TABLE `imagesProduct__`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `members__`
--
ALTER TABLE `members__`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus__`
--
ALTER TABLE `menus__`
  MODIFY `id_menu` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `payment__`
--
ALTER TABLE `payment__`
  MODIFY `payment_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `product__`
--
ALTER TABLE `product__`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system__`
--
ALTER TABLE `system__`
  MODIFY `id_app` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users__`
--
ALTER TABLE `users__`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
