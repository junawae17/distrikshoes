-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 03, 2018 at 12:49 AM
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
  `address` varchar(255) NOT NULL,
  `city_id` int(5) NOT NULL,
  `province_id` int(3) NOT NULL,
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
  `sub_category` int(5) NOT NULL,
  `information` text NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category__`
--

INSERT INTO `category__` (`category_id`, `category_name`, `sub_category`, `information`, `is_active`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
(1, 'Pakaian', 0, '<p>Tentang Pakaian</p>', 1, '2018-06-09 20:08:52', 1, '2018-06-09 20:08:52', 1),
(2, 'Elektronik', 0, '<p>Tentang Elektronik</p>', 1, '2018-06-09 20:09:24', 1, '2018-06-09 20:09:24', 1),
(3, 'Olah Raga', 0, '<p>Tengtang Olah raga</p>', 1, '2018-06-09 20:09:47', 1, '2018-06-09 20:09:47', 1),
(4, 'Gadget', 0, '<p>Tentang Gadget</p>', 1, '2018-06-09 20:23:55', 1, '2018-06-09 20:23:55', 1),
(5, 'Alat Rumah Tangga', 0, '<p>Alat Rumah Tangga<br></p>', 1, '2018-06-09 20:24:39', 1, '2018-06-09 20:24:39', 1),
(6, 'Perlengkapan Bayi', 0, '<p>Perlengkapan Bayi<br></p>', 1, '2018-06-09 20:26:08', 1, '2018-06-09 20:26:08', 1),
(7, 'Kecantikan', 0, '<p>Kecantikan</p>', 1, '2018-06-09 20:26:55', 1, '2018-06-09 20:26:55', 1),
(8, 'Hadiah & Souvenir', 0, '<p>Hadiah & Souvenir<br></p>', 1, '2018-06-09 20:28:14', 1, '2018-06-09 20:28:14', 1),
(9, 'Peralatan Sekolah', 0, '<p>Peralatan Sekolah<br></p>', 1, '2018-06-09 20:29:37', 1, '2018-06-09 20:29:37', 1),
(10, 'Komputer & Laptop', 0, '<p>  Komputer & Laptop<br></p>', 1, '2018-06-09 20:30:50', 1, '2018-06-10 16:45:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emailConfig__`
--

CREATE TABLE IF NOT EXISTS `emailConfig__` (
  `email_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `protocol` varchar(10) NOT NULL,
  `smtp_host` varchar(100) NOT NULL,
  `smtp_port` int(7) NOT NULL,
  `smtp_timeout` int(5) NOT NULL,
  `smtp_user` varchar(150) NOT NULL,
  `smtp_pass` varchar(150) NOT NULL,
  `charset` varchar(33) NOT NULL,
  `mailtype` varchar(15) NOT NULL,
  `validation` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emailConfig__`
--

INSERT INTO `emailConfig__` (`email_id`, `name`, `protocol`, `smtp_host`, `smtp_port`, `smtp_timeout`, `smtp_user`, `smtp_pass`, `charset`, `mailtype`, `validation`) VALUES
(1, 'Resfun Shop', 'smtp', 'ssl://smtp.gmail.com', 465, 7, 'resfuninfo@gmail.com', '8c8883a4d3095060fc6c9c24bd8bab10', 'utf-8', 'html', 'TRUE');

-- --------------------------------------------------------

--
-- Table structure for table `emailTemplate__`
--

CREATE TABLE IF NOT EXISTS `emailTemplate__` (
  `email_id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_by` int(3) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(3) NOT NULL,
  `modified_date` datetime NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emailTemplate__`
--

INSERT INTO `emailTemplate__` (`email_id`, `name`, `subject`, `message`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_active`) VALUES
(1, 'lupa_password', 'Lupa Password', '<center style="width:100%;table-layout:fixed">\r\n				<div style="max-width:600px">\r\n					<table style="border-spacing:0;font-family:sans-serif;color:#333333;Margin:0 auto;width:100%;max-width:600px; border: 1px solid #BFBFBF; box-shadow: 3px 5px 3px #aaa;" align="center">\r\n						<tbody>\r\n							<tr>\r\n								<td style="background:#42b549"><br></td>\r\n							</tr>\r\n							<tr>\r\n								<td style="background-color:#ffffff;padding-top:10px;padding-bottom:10px;padding-right:20px;padding-left:20px;width:100%;text-align:left;color:#333333;font-size:14px">Hai {$name_user},<br><div><br></div><div><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;">Email ini merupakan email otomatis yang dikirim dari </span><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;">{$name_system} karena Anda mengajukan</span><br style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;"><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;">permohonan untuk membuat </span><span class="il" style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;">password</span><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;"> baru akun Anda.</span><div><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;"><br></span></div><div><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;">Untuk membuat </span><span class="il" style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;">password</span><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;"> baru, silakan </span><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;">klik tombol di bawah</span><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;"> dan ikuti petunjuk pada halaman yang akan tampil. <br></span></div>\r\n<br><div style="text-align: center;"><a href="{$url_verifikasi}" target="_blank" style="background-color: #4CAF50;\r\n    border: none;\r\n    color: white;\r\n    padding: 15px 32px;\r\n    text-align: center;\r\n    text-decoration: none;\r\n    display: inline-block;\r\n    font-size: 16px;\r\n    margin: 4px 2px;\r\n    cursor: pointer;" data-original-title="" title="">Ubah Password</a><br></div><br><div><div><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;">Jika tidak ada halaman </span><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8px;">yang tampil, lakukan copy dan paste link tersebut di atas ke kolom alamat pada browser Anda.</span></div></div><div><br></div><div>Salam.</div>{$name_system}<br><br><br></div></td>\r\n							</tr>\r\n							<tr>\r\n								<td style="background-color: rgb(255, 255, 255); padding: 10px 20px; width: 100%; text-align: center; color: rgb(51, 51, 51); font-size: 12px;">© 2018 {$name_system}<br></td>\r\n							</tr><tr>\r\n								<td style="background:#42b549"><br></td>\r\n							</tr>\r\n						</tbody>\r\n					</table>\r\n				</div>\r\n			</center>', 1, '2018-06-03 16:54:43', 1, '2018-06-20 16:06:34', 1),
(2, 'verifikasi_akun', 'Verifikasi Akun', '<center style="width:100%;table-layout:fixed;">\r\n    <div style="max-width:600px">\r\n        <table style="border-spacing:0;font-family:sans-serif;color:#333333;Margin:0 auto;width:100%;max-width:600px; border: 1px solid #BFBFBF; box-shadow: 3px 5px 3px #aaa;" align="center">\r\n            <tbody>\r\n                <tr>\r\n                    <td style="background:#42b549"><br></td>\r\n                </tr>\r\n                <tr>\r\n                    <td style="background-color:#ffffff;padding-top:10px;padding-bottom:10px;padding-right:20px;padding-left:20px;width:100%;text-align:left;color:#333333;font-size:14px">Hai {$name_user},<br><div><br></div><div>Terimakasih sudah mendaftar,<br></div>Di bawah ini merupakan tombol verifikasi, yang dapat anda gunakan untuk Verifikasi akun anda. Silakan klik pada tombol,<br><br><div style="text-align: center;"><a href="{$url_verifikasi}" target="_blank" style="background-color: #4CAF50;\r\n    border: none;\r\n    color: white;\r\n    padding: 15px 32px;\r\n    text-align: center;\r\n    text-decoration: none;\r\n    display: inline-block;\r\n    font-size: 16px;\r\n    margin: 4px 2px;\r\n    cursor: pointer;" data-original-title="" title="">Verifikasi Akun</a><br></div><br><div>Jika anda mengalami kesulitan mengklik tombol "Verifikasi Akun", salin dan \r\ntempelkan URL berikut ini ke browser web Anda : {$url_verifikasi}</div><div><br></div><div><br></div><div>Salam.</div>{$name_system}<br><br><br></td>\r\n                </tr>\r\n                <tr>\r\n                    <td style="background-color: rgb(255, 255, 255); padding: 10px 20px; width: 100%; text-align: center; color: rgb(51, 51, 51); font-size: 12px;">© 2018 {$name_system}<br></td>\r\n                </tr><tr>\r\n                    <td style="background:#42b549"><br></td>\r\n                </tr>\r\n            </tbody>\r\n        </table>\r\n    </div>\r\n</center>', 1, '2018-06-03 18:48:49', 1, '2018-06-20 16:29:20', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members__`
--

INSERT INTO `members__` (`member_id`, `fullname`, `username`, `password`, `email`, `join_date`, `photo`, `phone`, `gender`, `birthday`, `is_active`) VALUES
(1, 'Nur Khozin', '9ee6bfdb875db06575459c1775e6e7c9', '9ee6bfdb875db06575459c1775e6e7c9', 'nurkhozin95@gmail.com', '2018-06-06 21:42:54', '', '', 0, '0000-00-00', 1),
(2, 'Verenca', '5c07587a52cb796a4cb94d7e4bed887f', '5c07587a52cb796a4cb94d7e4bed887f', 'verencaazura@gmail.com', '2018-06-06 21:55:08', '', '', 0, '0000-00-00', 0),
(3, 'Achmad Newbie', '10ea8cefe987c0b94e6bc9513e9cadb4', '10ea8cefe987c0b94e6bc9513e9cadb4', 'achmadbah@gmail.com', '2018-06-07 11:04:07', '', '', 0, '0000-00-00', 0),
(4, 'Al Fatih Karih', '13eaec1fd5982289dd6c61295adbef6a', '8c8883a4d3095060fc6c9c24bd8bab10', '1741723012kh@gmail.com', '2018-06-20 16:09:11', '', '', 0, '0000-00-00', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus__`
--

INSERT INTO `menus__` (`id_menu`, `nama_menu`, `page`, `sub_menu`, `icon_menu`, `link_menu`, `is_active`, `posisi_menu`) VALUES
(1, 'Beranda', 'beranda', 0, 'menu-icon fa fa-home faa-tada', 'Admin/Beranda', 1, 1),
(2, 'Mater Toko', 'masterToko', 0, 'menu-icon fa fa-list faa-tada', '#', 1, 2),
(3, 'Data Pembayaran', 'payment', 2, 'menu-icon fa fa-dollar', 'Admin/Payment', 1, 1),
(4, 'Kategori', 'category', 2, 'menu-icon fa fa-sitemap', 'Admin/Category', 1, 2),
(5, 'Produk', 'product', 2, 'menu-icon fa fa-gift', 'Admin/Product', 1, 3),
(6, 'Konfigurasi', 'configuration', 0, 'menu-icon fa fa-wrench faa-wrench', '#', 1, 3),
(7, 'Mail Server', 'email', 6, 'menu-icon fa fa-envelope', 'Admin/Email', 1, 1),
(8, 'Konten Email', 'emailTemplate', 2, 'menu-icon fa fa-envelope', 'Admin/emailTemplate', 1, 4),
(9, 'Informasi Toko', 'shopInformation', 6, 'menu-icon fa fa-desktop', 'Admin/shopInformation', 1, 2);

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
(1, 'MANDIRI', 'khozin', '09989987987', 'mandiri.jpg', 1, '2018-06-01 09:54:26', 1, '2018-06-10 16:54:58', 1),
(2, 'BCA', 'Khozin', '878787989787', 'bca.png', 1, '2018-06-01 10:53:48', 1, '2018-06-10 16:54:49', 1),
(3, 'BRI', 'Khozin', '65765767', 'BRI.jpg', 1, '2018-06-01 15:09:05', 1, '2018-06-20 18:05:42', 1),
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
  `category_id` int(4) NOT NULL,
  `stock` int(5) NOT NULL,
  `images_product` text NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product__`
--

INSERT INTO `product__` (`product_id`, `product_name`, `information`, `price`, `weight`, `category_id`, `stock`, `images_product`, `is_active`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
(1, 'XIAOMI MIBAND 3 ( Chinese Version ) NON NFC', '<p><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">READY STOCK !! BARANG FRESHHH</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">XIAOMI MIBAND 3 ( Chinese Version ) NON NFC</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">*bedanya versi inter dengan chinese hanya tulis di Box dan User manual</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">untuk unit mibandnya bisa di setting ke Bahasa Inggris, Pairing dan konek tetap melalui Apliaksi MI FIT yang bisa di download di Playstore dan App store</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">Untuk ubah ke bahasa inggris mohon lihat dan tonton dulu video yang sudah sy sertakan yah (thanks utk owner video Youtube yg saya ambil utk referensi)</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">Langsung order gan :)</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">UTK GROSIR LANSGUNG WA 08999315005</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">Xiaomi Mi Band 3 Original Smart Bracelet (Warna Hitam)</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">GARANSI 2 BULAN ( tidak dikarenakan kesalahan pengguna, tidak boleh cacat fisik , dus masih kondisi bagus, karet tidak robek2)</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">Xiaomi Mi Band 3: Specs</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">Pedometer and sleep tracker</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">0.78in OLED touchscreen</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">24.7cm wristband, wearable length 155-216mm</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">Waterproof to 5ATM</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">heart-rate scanner</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">Bluetooth 4.2</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">110mAh battery (20-day life)</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">20g (11g band, 9g tracker)</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">compatible with Android 4.4+/iOS 9.0+</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">Review (sumber </span><a rel="nofollow noopener noreferrer" target="_blank" href="https://tkp.me/r?url=https://www.techadvisor.co.uk/review/activity-trackers/mi-band-3-3679574/)" style="-webkit-font-smoothing: antialiased; color: rgb(66, 181, 73); cursor: pointer; font-family: " open="" sans",="" tahoma,="" sans-serif;="" background-color:="" rgb(255,="" 255,="" 255);"="">https://www•techadvisor•co•uk/review/activity-t...</a><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">;</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">Xiaomi''s Mi Band 3 is a fitness band with the ability to track exercise (steps taken, distance moved, calories burned), sleep (deep, light and total sleep) and heart rate (automatic or manual), over the past day, week or month. You can track fitness data in the free Mi Fit app, and the Mi Band 3 can additionally hook into Google Fit.</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">One of its biggest draws - aside from the low price - is incredibly long battery life. Though your exact mileage will vary dependent on how many notifications you receive, the 110mAh battery inside (up from 70mAh in Mi Band 2) can easily last 20 days before needing a recharge. And when it does drain down, you can get it back up to 100 percent in just a little over an hour.</span><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><br style="-webkit-font-smoothing: antialiased; color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"=""><span style="color: rgb(96, 96, 96); font-family: " open="" sans",="" tahoma,="" sans-serif;"="">Navigation is intuitive, requiring simple swipes up, down, left and right to enter and browse menus. A single large button can be used to return you to the main screen or select an option, such as a manual heart-rate scan.</span><br></p>', 525000, 200, 2, 20, '20180703072926_p001.jpg,20180703072926_p002.jpg,20180703072926_p003.jpg,20180703072926_p004.jpg', 1, '2018-07-03 06:18:40', 1, '2018-07-03 07:45:14', 1);

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
  `address` text NOT NULL,
  `city_id` int(5) NOT NULL,
  `province_id` int(3) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `modified_date` datetime NOT NULL,
  `modified_by` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system__`
--

INSERT INTO `system__` (`id_app`, `name_app`, `deskripsi_app`, `logo_app`, `bg_login`, `title_app`, `favicon_app`, `timezone_app`, `address`, `city_id`, `province_id`, `created_date`, `created_by`, `modified_date`, `modified_by`) VALUES
(1, 'Online Shop', 'Situs Belanja Online Belanja Mudah Hidup Senang', '20180625115246_small_ciptasoft.png', '20180625115246_login-bg.jpg', 'Online Shop', '20180625114633_Cogn_mode.png', 'Asia/Jakarta', 'Jl. Sukarno Hatta Malang No.30', 256, 11, '2017-03-19 00:00:00', 1, '2018-06-25 11:52:46', 0);

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
-- Indexes for table `emailConfig__`
--
ALTER TABLE `emailConfig__`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `emailTemplate__`
--
ALTER TABLE `emailTemplate__`
  ADD PRIMARY KEY (`email_id`);

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
  MODIFY `category_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `emailConfig__`
--
ALTER TABLE `emailConfig__`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emailTemplate__`
--
ALTER TABLE `emailTemplate__`
  MODIFY `email_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `members__`
--
ALTER TABLE `members__`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menus__`
--
ALTER TABLE `menus__`
  MODIFY `id_menu` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `payment__`
--
ALTER TABLE `payment__`
  MODIFY `payment_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `product__`
--
ALTER TABLE `product__`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
