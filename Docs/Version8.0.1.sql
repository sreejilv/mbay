-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 10, 2022 at 02:53 PM
-- Server version: 10.3.34-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlm_8.04`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('4lpf9eouor57b8vj5tiablec7sr8bmfi', '::1', 1507386108, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373338363130363b),
('dk1gr7f71srh1o1h9por4pd8abau3ldc', '::1', 1507386442, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373338363434313b),
('dl6d9fco7b92spt7q1h80m47v4o1540n', '::1', 1500208538, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530303230383533383b696e665f757365725f706167655f6c6f61645f74696d657c693a313530303230383533383b6d6c6d5f6c6f676765645f6172727c613a363a7b733a363a226d6c6d5f6964223b733a313a2231223b733a31323a226d6c6d5f757365726e616d65223b733a353a2261646d696e223b733a31333a226d6c6d5f757365725f74797065223b733a353a2261646d696e223b733a31313a226d6c6d5f757365725f6964223b733a343a2231393030223b733a393a226d6c6d5f656d61696c223b733a31333a2261646d696e406c6561642e696e223b733a31323a2269735f6c6f676765645f696e223b623a313b7d6d6c6d5f6c6173745f61637469766974797c693a313530303230383533383b),
('eg82p6d4euqpr1tn2df3iqr3qdmnv4ke', '::1', 1507445277, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373434353236343b),
('f1vdp2smslubgctui6q2ag927faqb668', '::1', 1500204582, 0x696e665f757365725f706167655f6c6f61645f74696d657c693a313530303230343538323b),
('gpdtdv8nqsbkk87cpm78ls4s18kd3lps', '::1', 1507385515, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373338353430383b),
('h8npqknadv1n1p6ahh42betgfkbuhrvq', '::1', 1500216751, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530303231363735313b696e665f757365725f706167655f6c6f61645f74696d657c693a313530303231343031393b),
('jjhj7qcpaba9s5fskd2eqi2fba9cg9ju', '::1', 1507386632, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530373338363538313b),
('o8buddlvda9fqpc1a5s4gs7qnoh7msrv', '::1', 1500204576, 0x5f5f63695f6c6173745f726567656e65726174657c693a313530303230343537363b696e665f757365725f706167655f6c6f61645f74696d657c693a313530303230343537363b);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_activity`
--

CREATE TABLE `mlm_activity` (
  `id` int(11) NOT NULL,
  `mlm_user_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT 0,
  `activity` varchar(35) DEFAULT NULL,
  `ip_address` varchar(30) DEFAULT 'NA',
  `user_agent` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `data` mediumtext DEFAULT NULL,
  `location_details` mediumtext DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `region` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `location_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_activity`
--

INSERT INTO `mlm_activity` (`id`, `mlm_user_id`, `employee_id`, `activity`, `ip_address`, `user_agent`, `date`, `data`, `location_details`, `country`, `region`, `city`, `location_status`) VALUES
(1, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0', '2021-03-22 14:32:44', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(2, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0', '2021-03-22 15:03:05', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(3, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0', '2021-03-22 15:33:33', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(4, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0', '2021-03-22 16:03:52', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(5, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90', '2021-03-24 13:30:56', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(6, 1900, 0, 'user_logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90', '2021-03-25 12:12:11', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(7, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:87.0) Gecko/20100101 Firefox/87.0', '2021-03-29 11:07:01', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(8, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:87.0) Gecko/20100101 Firefox/87.0', '2021-03-29 17:27:05', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(9, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/5', '2021-03-30 16:27:16', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(10, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/5', '2021-03-30 17:12:21', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(11, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:87.0) Gecko/20100101 Firefox/87.0', '2021-03-31 11:52:35', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(12, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:87.0) Gecko/20100101 Firefox/87.0', '2021-03-31 12:22:43', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(13, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:87.0) Gecko/20100101 Firefox/87.0', '2021-03-31 13:23:41', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(14, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:87.0) Gecko/20100101 Firefox/87.0', '2021-03-31 13:53:41', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(15, 1900, 0, 'user_logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.11', '2021-04-10 13:12:39', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(16, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/5', '2021-04-15 14:34:14', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(17, 1900, 0, 'change_payment_status', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:87.0) Gecko/20100101 Firefox/87.0', '2021-04-16 13:36:26', 'a:4:{s:14:\"csrf_test_name\";s:32:\"20b72c644b3def17227f27361f09f69c\";s:12:\"payment_code\";s:4:\"epin\";s:6:\"status\";s:6:\"active\";s:4:\"code\";s:4:\"epin\";}', 'a:0:{}', '', '', '', 0),
(18, 1900, 0, 'img_added', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:87.0) Gecko/20100101 Firefox/87.0', '2021-04-17 09:55:44', 'a:2:{s:9:\"doc_title\";s:9:\"dfgdfgdfg\";s:7:\"add_img\";s:3:\"add\";}', 'a:0:{}', '', '', '', 0),
(19, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.12', '2021-04-21 10:22:45', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(20, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.12', '2021-04-21 10:53:11', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(21, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.12', '2021-04-21 11:23:56', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(22, 1900, 0, 'user_login', '192.168.1.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.15', '2021-08-30 10:25:58', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(23, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69', '2021-11-12 10:17:33', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(24, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69', '2021-11-12 10:57:48', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(25, 1900, 0, 'user_unlock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69', '2021-11-12 11:17:34', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(26, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69', '2021-11-12 11:47:53', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(27, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69', '2021-11-12 12:18:48', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(28, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69', '2021-11-12 12:49:47', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(29, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69', '2021-11-12 13:19:48', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(30, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/53', '2021-11-17 11:18:33', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(31, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71 Safari/53', '2021-11-23 15:47:10', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(32, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45', '2021-12-01 16:45:25', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(33, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45', '2021-12-01 16:45:29', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(34, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45', '2021-12-01 16:46:32', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(35, 1900, 0, 'user_logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45', '2021-12-01 16:53:06', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(36, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45', '2021-12-02 11:28:58', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(37, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45', '2021-12-08 11:48:25', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(38, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/53', '2021-12-09 11:12:47', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(39, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:94.0) Gecko/20100101 Firefox/94.0', '2021-12-09 14:35:31', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(40, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:94.0) Gecko/20100101 Firefox/94.0', '2021-12-09 15:05:33', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(41, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93', '2021-12-13 13:52:20', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(42, 1900, 0, 'user_logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93', '2021-12-13 14:14:43', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(43, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-17 16:28:12', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(44, 1900, 0, 'user_unlock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-17 17:14:31', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(45, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 10:10:46', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(46, 1900, 0, 'user_logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 10:23:43', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(47, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 10:23:51', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(48, 1900, 0, 'user_logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 10:23:54', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(49, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 10:25:16', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(50, 1902, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 10:25:28', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(51, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 10:25:28', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(52, 1902, 0, 'user_logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 10:26:47', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(53, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 11:57:25', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(54, 1900, 0, 'user_logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 12:15:45', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(55, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 14:06:30', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(56, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 14:37:28', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(57, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 15:07:27', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(58, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-21 10:28:29', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(59, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-21 11:14:45', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(60, 1900, 0, 'user_unlock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-21 11:15:48', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(61, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-13 11:23:44', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(62, 1900, 0, 'change_module_status', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-13 11:52:14', 'a:3:{s:14:\"csrf_test_name\";s:32:\"d06cfbedfcfc80fc7cc28d50eed869d2\";s:6:\"module\";s:9:\"live_chat\";s:6:\"status\";s:1:\"0\";}', 'a:0:{}', '', '', '', 0),
(63, 1900, 0, 'change_module_status', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-13 11:52:15', 'a:3:{s:14:\"csrf_test_name\";s:32:\"d06cfbedfcfc80fc7cc28d50eed869d2\";s:6:\"module\";s:9:\"live_chat\";s:6:\"status\";s:1:\"1\";}', 'a:0:{}', '', '', '', 0),
(64, 1900, 0, 'change_module_status', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-13 11:54:23', 'a:3:{s:14:\"csrf_test_name\";s:32:\"d06cfbedfcfc80fc7cc28d50eed869d2\";s:6:\"module\";s:9:\"live_chat\";s:6:\"status\";s:1:\"0\";}', 'a:0:{}', '', '', '', 0),
(65, 1900, 0, 'user_logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2022-01-13 12:09:24', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(66, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2022-01-13 12:09:34', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(67, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2022-01-13 13:07:36', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(68, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2022-01-13 13:58:52', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(69, 1900, 0, 'user_unlock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2022-01-13 13:59:54', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(70, 1902, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2022-01-13 14:28:52', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(71, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2022-01-13 14:28:52', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(72, 1902, 0, 'user_lock', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2022-01-13 14:59:36', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(73, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-13 15:06:38', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(74, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-13 16:04:05', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(75, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-13 16:05:35', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(76, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-13 16:55:28', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(77, 1900, 0, 'user_logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71', '2022-01-14 10:29:45', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(78, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71', '2022-01-14 10:30:06', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(79, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-14 11:43:01', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(80, 1902, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71', '2022-01-14 11:53:40', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(81, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71', '2022-01-14 11:53:40', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(82, 1902, 0, 'user_logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71', '2022-01-14 11:54:19', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(83, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-14 12:13:02', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(84, 1900, 0, 'user_unlock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-14 12:24:02', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(85, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-14 12:54:16', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(86, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-14 13:24:17', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(87, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-14 13:54:21', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(88, 1900, 0, 'user_unlock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:95.0) Gecko/20100101 Firefox/95.0', '2022-01-14 13:59:50', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(89, 1900, 0, 'user_logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71', '2022-01-15 12:02:19', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(90, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71', '2022-01-15 12:05:38', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(91, 1900, 0, 'user_logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71', '2022-01-15 12:06:41', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(92, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:96.0) Gecko/20100101 Firefox/96.0', '2022-01-15 14:11:28', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(93, 1902, 0, 'user_logout', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:96.0) Gecko/20100101 Firefox/96.0', '2022-02-09 10:31:17', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(94, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:96.0) Gecko/20100101 Firefox/96.0', '2022-02-09 11:32:56', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(95, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:97.0) Gecko/20100101 Firefox/97.0', '2022-02-21 09:26:31', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(96, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:97.0) Gecko/20100101 Firefox/97.0', '2022-02-28 17:28:00', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(97, 1902, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:97.0) Gecko/20100101 Firefox/97.0', '2022-02-28 17:30:40', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(98, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:97.0) Gecko/20100101 Firefox/97.0', '2022-02-28 17:30:40', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(99, 1902, 0, 'user_logout', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:97.0) Gecko/20100101 Firefox/97.0', '2022-02-28 17:31:06', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(100, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:97.0) Gecko/20100101 Firefox/97.0', '2022-02-28 17:31:11', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(101, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:97.0) Gecko/20100101 Firefox/97.0', '2022-02-28 18:01:31', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(102, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:97.0) Gecko/20100101 Firefox/97.0', '2022-03-01 13:56:57', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(103, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:98.0) Gecko/20100101 Firefox/98.0', '2022-04-04 10:19:03', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(104, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:99.0) Gecko/20100101 Firefox/99.0', '2022-05-05 14:42:55', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(105, 1900, 0, 'change_bonus_status', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:99.0) Gecko/20100101 Firefox/99.0', '2022-05-05 14:43:12', 'a:3:{s:14:\"csrf_test_name\";s:32:\"c45e0ca429b8a6f3e120dd2562e0f2b7\";s:5:\"bonus\";s:12:\"binary_bonus\";s:6:\"status\";s:1:\"1\";}', 'a:0:{}', '', '', '', 0),
(106, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:99.0) Gecko/20100101 Firefox/99.0', '2022-05-05 15:12:50', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(107, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:99.0) Gecko/20100101 Firefox/99.0', '2022-05-05 15:43:03', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(108, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:99.0) Gecko/20100101 Firefox/99.0', '2022-05-05 16:13:05', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(109, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:99.0) Gecko/20100101 Firefox/99.0', '2022-05-05 16:43:06', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(110, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0', '2022-07-07 09:31:09', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(111, 1900, 0, 'user_logout', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0', '2022-07-07 09:31:25', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(112, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0', '2022-07-07 09:31:44', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(113, 1900, 0, 'user_lock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0', '2022-07-07 11:22:05', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(114, 1900, 0, 'user_unlock', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0', '2022-07-07 11:25:35', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(115, 1900, 0, 'user_logout', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0', '2022-07-07 11:26:41', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(116, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0', '2022-07-07 11:27:35', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(117, 1900, 0, 'user_login', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0', '2022-07-18 14:32:10', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(118, 1900, 0, 'user_login', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/53', '2022-08-08 17:09:17', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(119, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/53', '2022-08-08 17:44:08', 'a:0:{}', 'a:0:{}', '', '', '', 0),
(120, 1900, 0, 'user_lock', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/53', '2022-08-08 18:39:37', 'a:0:{}', 'a:0:{}', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_affiliates`
--

CREATE TABLE `mlm_affiliates` (
  `id` int(20) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `sponser_id` int(12) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `country` int(10) DEFAULT NULL,
  `state` int(10) DEFAULT NULL,
  `zip_code` int(10) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `enroll_date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `currency` int(5) DEFAULT 1,
  `language` int(5) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_affiliate_activity`
--

CREATE TABLE `mlm_affiliate_activity` (
  `id` int(11) NOT NULL,
  `affiliate_id` int(11) DEFAULT NULL,
  `activity` varchar(30) DEFAULT NULL,
  `ip_address` varchar(30) DEFAULT 'NA',
  `user_agent` varchar(100) DEFAULT NULL,
  `text_color` varchar(20) DEFAULT 'orange',
  `icon` varchar(20) DEFAULT 'fa-fighter-jet',
  `date` datetime DEFAULT NULL,
  `data` mediumtext DEFAULT NULL,
  `location_details` mediumtext DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `region` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `location_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_affiliate_enquiry`
--

CREATE TABLE `mlm_affiliate_enquiry` (
  `id` int(11) NOT NULL,
  `enquiry_id` varchar(28) DEFAULT NULL,
  `affiliate_id` int(11) DEFAULT NULL,
  `user_id` int(20) DEFAULT NULL,
  `course` varchar(30) DEFAULT NULL,
  `sub_course` int(20) DEFAULT NULL,
  `wish_to_join` varchar(50) DEFAULT NULL,
  `native_lang` int(11) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `accommodation` int(11) DEFAULT NULL,
  `flight` int(11) DEFAULT NULL,
  `transport` int(11) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip` varchar(25) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `coupon_code` varchar(20) DEFAULT NULL,
  `coupon_amount` decimal(16,8) DEFAULT 0.00000000,
  `applied_coupon` decimal(16,8) DEFAULT 0.00000000,
  `enq_status` tinyint(1) DEFAULT 0,
  `enq_close_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_binary_bonus_history`
--

CREATE TABLE `mlm_binary_bonus_history` (
  `id` int(11) NOT NULL,
  `mlm_user_id` int(11) NOT NULL,
  `user_L` double DEFAULT NULL,
  `user_R` double DEFAULT NULL,
  `user_L_carry` double DEFAULT NULL,
  `user_R_carry` double DEFAULT NULL,
  `binary_pair` int(11) DEFAULT NULL,
  `capped_amount` double DEFAULT NULL,
  `dist_amount` double DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_binary_bonus_settings`
--

CREATE TABLE `mlm_binary_bonus_settings` (
  `id` int(20) NOT NULL,
  `bonus_type` varchar(20) NOT NULL DEFAULT 'fixed',
  `pair_amount` double NOT NULL,
  `pair_value` double NOT NULL,
  `pair_percentage` double NOT NULL,
  `cap_type` varchar(20) NOT NULL DEFAULT 'monthly',
  `cap_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_binary_bonus_settings`
--

INSERT INTO `mlm_binary_bonus_settings` (`id`, `bonus_type`, `pair_amount`, `pair_value`, `pair_percentage`, `cap_type`, `cap_amount`) VALUES
(1, 'fixed', 10, 1, 5, 'daily', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_blocktrail_payment`
--

CREATE TABLE `mlm_blocktrail_payment` (
  `id` int(11) NOT NULL,
  `pending_id` int(11) DEFAULT NULL,
  `email_id` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `data` mediumtext DEFAULT NULL,
  `response` mediumtext DEFAULT NULL,
  `status` int(11) DEFAULT 0 COMMENT 'Status=0(No response),1(response)',
  `timestamp` bigint(20) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_bonuses`
--

CREATE TABLE `mlm_bonuses` (
  `id` int(10) NOT NULL,
  `name` varchar(25) NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_bonuses`
--

INSERT INTO `mlm_bonuses` (`id`, `name`, `flag`, `status`) VALUES
(1, 'refferal_bonus', 1, 1),
(2, 'binary_bonus', 1, 1),
(3, 'unilevel_level', 1, 1),
(4, 'matrix_level', 1, 0),
(5, 'rank_bonus', 1, 1),
(6, 'matching_bonus', 1, 1),
(7, 'generation_bonus', 0, 1),
(8, 'stair_step_bonus', 0, 1),
(9, 'matrix_complete_bonus', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_brand`
--

CREATE TABLE `mlm_brand` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(25) NOT NULL,
  `image` varchar(50) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_brand`
--

INSERT INTO `mlm_brand` (`id`, `brand_name`, `image`, `date`) VALUES
(1, 'AOC', 'aoc.jpg', '2018-09-28 19:26:57'),
(2, 'BAJAJ', 'bajaj.jpg', '2018-09-28 19:33:03'),
(3, 'BLACKBERRY', 'blackberry.jpg', '2018-09-20 00:00:00'),
(4, 'CANON', 'canon.jpg', '2018-09-20 00:00:00'),
(5, 'COMPAS', 'compas.jpg', '2018-09-20 00:00:00'),
(6, 'DAIKIN', 'daikin.jpg', '2018-09-20 00:00:00'),
(7, 'DELL', 'dell.jpg', '2018-09-20 00:00:00'),
(8, 'SAMSUNG', 'samsung.jpg', '2018-09-28 19:29:17'),
(9, 'SONY', 'sony.jpg', '2018-09-20 00:00:00'),
(10, 'VOLTAS', 'voltas.jpg', '2018-09-28 19:23:51'),
(11, 'LG', 'lg.jpg', '2018-09-20 00:00:00'),
(12, 'LENOVO', 'lenovo.jpg', '2018-09-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_category`
--

CREATE TABLE `mlm_category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL DEFAULT 0,
  `nav_status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `special` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(50) NOT NULL DEFAULT 'cat-banner-1.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_category`
--

INSERT INTO `mlm_category` (`id`, `category`, `description`, `creation_date`, `updation_date`, `status`, `order`, `nav_status`, `featured`, `special`, `image`) VALUES
(1, 'Electronics', 'Electronics', '2018-09-05 10:07:50', '2018-09-05 15:37:50', 1, 1, 1, 0, 0, 'electronics.jpeg'),
(2, 'Men', 'Men', '2018-09-05 10:07:50', '2018-09-05 15:37:50', 1, 2, 0, 1, 0, 'men.jpg'),
(3, 'Women', 'Women', '2018-09-05 10:07:50', '2018-09-05 15:37:50', 1, 3, 1, 0, 0, 'women.jpg'),
(4, 'Kid', 'Kid', '2018-09-05 10:07:50', '2018-09-05 15:37:50', 1, 4, 0, 1, 0, 'kids.png'),
(5, 'Others', 'Others', '2018-09-05 10:07:50', '2018-09-05 15:37:50', 1, 5, 1, 0, 0, 'cat-banner-1.jpg'),
(6, 'Register', 'Register', '2018-09-05 10:07:50', '2018-09-05 15:37:50', 1, 6, 0, 1, 0, 'cat-banner-1.jpg'),
(7, 'Sports', 'Sports', '2018-09-05 10:07:50', '2018-09-05 15:37:50', 1, 0, 0, 0, 0, 'sports.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_coin_payment_response`
--

CREATE TABLE `mlm_coin_payment_response` (
  `id` int(11) NOT NULL,
  `response_data` mediumtext DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `response` varchar(200) DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_config`
--

CREATE TABLE `mlm_config` (
  `key` varchar(255) NOT NULL,
  `value` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_config`
--

INSERT INTO `mlm_config` (`key`, `value`) VALUES
('ADMIN_USER_ID', '1900'),
('ADMIN_USER_NAME', 'admin'),
('AFFILIATES_STATUS', '1'),
('AMOUNT_ROUND_VALUE', '2'),
('AUTOMATIC_USERNAME_STATUS', '1'),
('BACKUP_DELETION_PERIOD', '30'),
('BACKUP_STATUS', '1'),
('BACKUP_TYPE', 'zip'),
('BASIC_CART_STATUS', '1'),
('BASIC_FLAG', '0'),
('BINARY_PLAN', 'one_to_one'),
('BINARY_RUN', 'instant'),
('BLOCK_LOGIN', '0'),
('BLOCK_REGISTER', '0'),
('BULKSMS_PASSWORD', 'techffodils'),
('BULKSMS_USERNAME', 'techffodilsllp'),
('CAPTCHA_LOGIN', '10'),
('CAPTCHA_STATUS', '0'),
('CHECKOUT_SMS_CONTENT', 'Your Order Placed Successfully.'),
('CHECKOUT_SMS_PERMISSION', '0'),
('CMS_STATUS', '0'),
('COINPAYMENT_AUTHOR', 'Techffodils Technologies'),
('COINPAYMENT_MERCHANT', 'a452d596425cd1f186c8bc9aa2646e15'),
('Cover0', 'cover6.jpg'),
('Cover1', 'cover1.jpg'),
('Cover2', 'cover0_1574929624.jpeg'),
('Cover3', 'cover3.jpg'),
('Cover4', 'cover4.jpg'),
('Cover5', 'cover5.jpg'),
('CROWD_FUNDING_STATUS', '1'),
('DARK_MODE', '0'),
('DB_OPTIMIZE_STATUS', '0'),
('DEFAULT_CURRENCY_CODE', 'USD'),
('DEFAULT_CURRENCY_ICON', 'fa-dollar'),
('DEFAULT_CURRENCY_ID', '1'),
('DEFAULT_CURRENCY_NAME', 'Dollar'),
('DEFAULT_CURRENCY_VALUE', '1'),
('DEFAULT_SYMBOL_LEFT', '$'),
('DEFAULT_SYMBOL_RIGHT', ''),
('DEFAULT_VALUE1', '1'),
('DEFAULT_VALUE2', '1'),
('DEF_TICKET_TYPE', '1'),
('DELIVARY_CHARGE', '0'),
('DOCUMENTS_STATUS', '1'),
('DONATION_AMOUNT', '50'),
('DONATION_AMOUNT_SETTINGS', 'fixed'),
('DONATION_ORDER', 'fifo'),
('DONATION_PERCENTAGE', '150'),
('DONATION_PLAN_STATUS', '1'),
('Dp0', 'dp8.jpg'),
('Dp1', 'dp0_1574929290.jpeg'),
('Dp2', 'dp0_15749292901.jpeg'),
('Dp3', 'dp0_15749292902.jpeg'),
('Dp4', 'dp0_15749292903.jpeg'),
('Dp5', 'dp0_15749292904.jpeg'),
('Dp6', 'dp6.jpg'),
('Dp7', 'dp7.jpg'),
('EMAIL_EDIT', '1'),
('EMAIL_VERIFICATION_STATUS', '0'),
('EMPLOYEE_NAME_GENERATION_STATUS', '0'),
('EMPLOYEE_STATUS', '1'),
('ENTRI_FEE', '10'),
('EPIN_STATUS', '1'),
('EVENT_STATUS', '1'),
('EXCEL_MIGRATION_STATUS', '1'),
('FROM_MOBILE', '0'),
('FUND_TRANSFER_ADMIN_STATUS', '1'),
('FUND_TRANSFER_USER_STATUS', '1'),
('GENERATION_STATUS', '1'),
('GEO_LOCATION_STATUS', '0'),
('GIFT_AMOUNT', '50'),
('GIFT_AMOUNT_SETTINGS', 'fixed'),
('GIFT_STATUS', '1'),
('GOOGLE_CAPTCHA_KEY', '6LdOgjUUAAAAAMBypkm_-E69Z7fehRqQ5dH4UWW_'),
('GOOGLE_CAPTCHA_SECRET', '6LdOgjUUAAAAADeZaeCcIvEEULJ6qtG-UI6iMXWX'),
('GOOGLE_LANGUAGE_STATUS', '1'),
('GOOGLE_TRANSLATOR', '0'),
('GOOGLE_TRANSLATOR_STATUS', '1'),
('HELP_STATUS', '1'),
('IMAGE_RESIZE_STATUS', '1'),
('INTERNAL_MAIL_STATUS', '1'),
('INVESTMENT_CATEGORY', 'crypto'),
('INVESTMENT_STATUS', '1'),
('IP_BLACKLIST_STATUS', '1'),
('IP_WHITELIST_STATUS', '1'),
('KYC_STATUS', '1'),
('LANG_CODE', 'en'),
('LANG_FLAG', 'US.png'),
('LANG_ID', '1'),
('LANG_NAME', 'English'),
('LCP_STATUS', '1'),
('LIVE_CHAT_STATUS', '0'),
('LOGIN_REFERANCE', 'login_block'),
('MAIL_STATUS', '1'),
('MAINTANANCE_STATUS', '0'),
('MATCH_LEVEL', '4'),
('MATRIX_DEPTH', '3'),
('MATRIX_LEVEL_BONUS_TYPE', 'fixed'),
('MATRIX_WIDTH', '3'),
('MLM_PLAN', 'UNILEVEL'),
('MONOLINE_STATUS', '1'),
('MULTIPLE_WALLET_STATUS', '1'),
('MULTI_CURRENCY_STATUS', '1'),
('MULTI_LANG_STATUS', '1'),
('NEWS_STATUS', '1'),
('OC_STATUS', '0'),
('OPTIMIZE_LIMIT', '100'),
('OPTIONAL_MODULE', '0'),
('PAIR_BONUS', '5'),
('PARTY_PLAN_STATUS', '1'),
('PAYMENT_GATEWAY_STATUS', '1'),
('PAYOUT_METHOD', 'bank'),
('PRESET_DEMO_STATUS', '0'),
('PRIVACY_POLICY', 'Privacy Policy'),
('PRODUCT_STATUS', '1'),
('PROMOTION_STATUS', '1'),
('PURCHASE_TAX', '0'),
('QWERTY_STATUS', '1'),
('RANK_STATUS', '1'),
('RECCURING_STATUS', '1'),
('REFEAL_BONUS', '5'),
('REGISTER_FIELD_CONFIGURATION', 'inactive'),
('REGISTER_FORM_TYPE', 'multiple_step'),
('REGISTER_LEG', 'right'),
('REGISTER_LEG_STATUS', '1'),
('REGISTER_PACKAGE', '1'),
('REG_FROM_TREE_STATUS', '1'),
('REG_MODE', 'packages'),
('REG_SMS_CONTENT', 'Your Account Registered Successfully.'),
('REG_SMS_PERMISSION', '0'),
('REPLICATED_WEBSITE_STATUS', '1'),
('REPURCHASE_STATUS', '1'),
('RETURN_DAY_LIMIT', '15'),
('RETURN_STATUS', '1'),
('SESS_STATUS', '0'),
('SHIPPING_CHARGE', '0'),
('SMALL_DB', '1'),
('SMS_MODULES_STATUS', '1'),
('STAIR_STEP_PLAN_STATUS', '1'),
('STAIR_STEP_STATUS', '1'),
('SYSTEM_PATH', '/var/www/html/WC/8.04/'),
('SYSTEM_PLAN', 'UNILEVEL'),
('TABLE_PREFIX', 'mlm_'),
('TAX_STATUS', '1'),
('TERMS_AND_CONDITION', 'Terms And Condition'),
('TESTIMONIALS_STATUS', '1'),
('TESTINOMIALS_STATUS', '1'),
('TICKET_SYSTEM_STATUS', '1'),
('UNILEVEL_LEVEL_BONUS_TYPE', 'percentage'),
('UNILEVEL_LEVEL_DEPTH', '5'),
('UPLINE_UPDATE', '1'),
('UPLINE_UPDATE_VALUE', 'product_amount'),
('USERNAME_EDIT', '1'),
('USERNAME_PREFIX', 'lead'),
('USERNAME_SIZE', '8'),
('USERNAME_TYPE', 'static');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_configuration`
--

CREATE TABLE `mlm_configuration` (
  `id` int(30) NOT NULL,
  `wallet_a` double NOT NULL,
  `wallet_b` double NOT NULL,
  `payout_min` double NOT NULL,
  `payout_max` double NOT NULL,
  `payout_cut_off_balance` double NOT NULL,
  `payout_transation_charges` double NOT NULL,
  `automatic_payout_status` varchar(10) NOT NULL DEFAULT 'inactive',
  `tax` double NOT NULL,
  `tax_type` varchar(10) NOT NULL,
  `basic_menus` text NOT NULL,
  `basic_modules` text NOT NULL,
  `time_limit1` double NOT NULL,
  `time_limit2` double NOT NULL,
  `Sunday` tinyint(1) NOT NULL,
  `Monday` tinyint(1) NOT NULL,
  `Tuesday` tinyint(1) NOT NULL,
  `Wednesday` tinyint(1) NOT NULL,
  `Thursday` tinyint(1) NOT NULL,
  `Friday` tinyint(1) NOT NULL,
  `Saturday` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_configuration`
--

INSERT INTO `mlm_configuration` (`id`, `wallet_a`, `wallet_b`, `payout_min`, `payout_max`, `payout_cut_off_balance`, `payout_transation_charges`, `automatic_payout_status`, `tax`, `tax_type`, `basic_menus`, `basic_modules`, `time_limit1`, `time_limit2`, `Sunday`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`) VALUES
(1, 90, 10, 50, 500, 5, 10, 'inactive', 0, 'static', 'a:72:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:1:\"5\";i:5;s:2:\"11\";i:6;s:2:\"12\";i:7;s:2:\"13\";i:8;s:2:\"14\";i:9;s:2:\"15\";i:10;s:2:\"17\";i:11;s:2:\"18\";i:12;s:2:\"19\";i:13;s:2:\"20\";i:14;s:2:\"21\";i:15;s:2:\"22\";i:16;s:2:\"23\";i:17;s:2:\"24\";i:18;s:2:\"26\";i:19;s:2:\"27\";i:20;s:2:\"29\";i:21;s:2:\"30\";i:22;s:2:\"31\";i:23;s:2:\"32\";i:24;s:2:\"36\";i:25;s:2:\"37\";i:26;s:2:\"38\";i:27;s:2:\"39\";i:28;s:2:\"40\";i:29;s:2:\"42\";i:30;s:2:\"43\";i:31;s:2:\"45\";i:32;s:2:\"46\";i:33;s:2:\"59\";i:34;s:2:\"61\";i:35;s:2:\"64\";i:36;s:2:\"65\";i:37;s:2:\"66\";i:38;s:2:\"67\";i:39;s:2:\"68\";i:40;s:2:\"69\";i:41;s:2:\"70\";i:42;s:2:\"71\";i:43;s:2:\"73\";i:44;s:2:\"74\";i:45;s:2:\"79\";i:46;s:2:\"80\";i:47;s:2:\"81\";i:48;s:3:\"106\";i:49;s:3:\"107\";i:50;s:3:\"108\";i:51;s:3:\"109\";i:52;s:3:\"110\";i:53;s:3:\"112\";i:54;s:3:\"116\";i:55;s:3:\"144\";i:56;s:3:\"145\";i:57;s:3:\"146\";i:58;s:3:\"149\";i:59;s:3:\"150\";i:60;s:3:\"154\";i:61;s:3:\"155\";i:62;s:3:\"157\";i:63;s:3:\"158\";i:64;s:3:\"176\";i:65;s:3:\"178\";i:66;s:3:\"179\";i:67;s:3:\"180\";i:68;s:3:\"181\";i:69;s:3:\"183\";i:70;s:3:\"185\";i:71;s:3:\"186\";}', 'a:47:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:1:\"5\";i:5;s:1:\"7\";i:6;s:1:\"8\";i:7;s:1:\"9\";i:8;s:2:\"11\";i:9;s:2:\"12\";i:10;s:2:\"13\";i:11;s:2:\"14\";i:12;s:2:\"15\";i:13;s:2:\"16\";i:14;s:2:\"17\";i:15;s:2:\"18\";i:16;s:2:\"19\";i:17;s:2:\"20\";i:18;s:2:\"22\";i:19;s:2:\"23\";i:20;s:2:\"24\";i:21;s:2:\"25\";i:22;s:2:\"26\";i:23;s:2:\"27\";i:24;s:2:\"28\";i:25;s:2:\"29\";i:26;s:2:\"30\";i:27;s:2:\"31\";i:28;s:2:\"32\";i:29;s:2:\"33\";i:30;s:2:\"34\";i:31;s:2:\"36\";i:32;s:2:\"37\";i:33;s:2:\"38\";i:34;s:2:\"39\";i:35;s:2:\"40\";i:36;s:2:\"41\";i:37;s:2:\"42\";i:38;s:2:\"43\";i:39;s:2:\"44\";i:40;s:2:\"45\";i:41;s:2:\"46\";i:42;s:2:\"47\";i:43;s:2:\"48\";i:44;s:2:\"49\";i:45;s:2:\"51\";i:46;s:2:\"52\";}', 9, 17, 0, 1, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_countries`
--

CREATE TABLE `mlm_countries` (
  `id` smallint(5) NOT NULL,
  `country_name` varchar(128) NOT NULL,
  `iso_code` varchar(2) NOT NULL,
  `phone_code` int(11) DEFAULT 0,
  `iso_code_3` varchar(3) NOT NULL,
  `address_format` text NOT NULL,
  `postcode_required` tinyint(1) NOT NULL,
  `vat` int(11) NOT NULL DEFAULT 0,
  `reg_count` int(12) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_countries`
--

INSERT INTO `mlm_countries` (`id`, `country_name`, `iso_code`, `phone_code`, `iso_code_3`, `address_format`, `postcode_required`, `vat`, `reg_count`, `status`) VALUES
(1, 'Afghanistan', 'AF', 93, 'AFG', '', 0, 0, 0, 1),
(2, 'Albania', 'AL', 355, 'ALB', '', 0, 0, 1, 1),
(3, 'Algeria', 'DZ', 213, 'DZA', '', 0, 0, 0, 1),
(4, 'American Samoa', 'AS', 1684, 'ASM', '', 0, 0, 0, 1),
(5, 'Andorra', 'AD', 376, 'AND', '', 0, 0, 0, 1),
(6, 'Angola', 'AO', 244, 'AGO', '', 0, 0, 0, 1),
(7, 'Anguilla', 'AI', 1264, 'AIA', '', 0, 0, 0, 1),
(8, 'Antarctica', 'AQ', 0, 'ATA', '', 0, 0, 0, 1),
(9, 'Antigua and Barbuda', 'AG', 1268, 'ATG', '', 0, 0, 0, 1),
(10, 'Argentina', 'AR', 54, 'ARG', '', 0, 0, 0, 1),
(11, 'Armenia', 'AM', 374, 'ARM', '', 0, 0, 0, 1),
(12, 'Aruba', 'AW', 297, 'ABW', '', 0, 0, 0, 1),
(13, 'Australia', 'AU', 61, 'AUS', '', 0, 0, 0, 1),
(14, 'Austria', 'AT', 43, 'AUT', '', 0, 0, 0, 1),
(15, 'Azerbaijan', 'AZ', 994, 'AZE', '', 0, 0, 0, 1),
(16, 'Bahamas', 'BS', 1242, 'BHS', '', 0, 0, 0, 1),
(17, 'Bahrain', 'BH', 973, 'BHR', '', 0, 0, 0, 1),
(18, 'Bangladesh', 'BD', 880, 'BGD', '', 0, 0, 0, 1),
(19, 'Barbados', 'BB', 1246, 'BRB', '', 0, 0, 0, 1),
(20, 'Belarus', 'BY', 375, 'BLR', '', 0, 0, 0, 1),
(21, 'Belgium', 'BE', 32, 'BEL', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 0, 0, 0, 1),
(22, 'Belize', 'BZ', 501, 'BLZ', '', 0, 0, 0, 1),
(23, 'Benin', 'BJ', 229, 'BEN', '', 0, 0, 0, 1),
(24, 'Bermuda', 'BM', 1441, 'BMU', '', 0, 0, 0, 1),
(25, 'Bhutan', 'BT', 975, 'BTN', '', 0, 0, 0, 1),
(26, 'Bolivia', 'BO', 591, 'BOL', '', 0, 0, 0, 1),
(27, 'Bosnia and Herzegovina', 'BA', 387, 'BIH', '', 0, 0, 0, 1),
(28, 'Botswana', 'BW', 267, 'BWA', '', 0, 0, 0, 1),
(29, 'Bouvet Island', 'BV', 0, 'BVT', '', 0, 0, 0, 1),
(30, 'Brazil', 'BR', 55, 'BRA', '', 0, 0, 0, 1),
(31, 'British Indian Ocean Territory', 'IO', 246, 'IOT', '', 0, 0, 0, 1),
(32, 'Brunei Darussalam', 'BN', 673, 'BRN', '', 0, 0, 0, 1),
(33, 'Bulgaria', 'BG', 359, 'BGR', '', 0, 0, 0, 1),
(34, 'Burkina Faso', 'BF', 226, 'BFA', '', 0, 0, 0, 1),
(35, 'Burundi', 'BI', 257, 'BDI', '', 0, 0, 0, 1),
(36, 'Cambodia', 'KH', 855, 'KHM', '', 0, 0, 0, 1),
(37, 'Cameroon', 'CM', 237, 'CMR', '', 0, 0, 0, 1),
(38, 'Canada', 'CA', 1, 'CAN', '', 0, 0, 0, 1),
(39, 'Cape Verde', 'CV', 238, 'CPV', '', 0, 0, 0, 1),
(40, 'Cayman Islands', 'KY', 1345, 'CYM', '', 0, 0, 0, 1),
(41, 'Central African Republic', 'CF', 236, 'CAF', '', 0, 0, 0, 1),
(42, 'Chad', 'TD', 235, 'TCD', '', 0, 0, 0, 1),
(43, 'Chile', 'CL', 56, 'CHL', '', 0, 0, 0, 1),
(44, 'China', 'CN', 86, 'CHN', '', 0, 0, 0, 1),
(45, 'Christmas Island', 'CX', 61, 'CXR', '', 0, 0, 0, 1),
(46, 'Cocos (Keeling) Islands', 'CC', 672, 'CCK', '', 0, 0, 0, 1),
(47, 'Colombia', 'CO', 57, 'COL', '', 0, 0, 0, 1),
(48, 'Comoros', 'KM', 269, 'COM', '', 0, 0, 0, 1),
(49, 'Congo', 'CG', 242, 'COG', '', 0, 0, 0, 1),
(50, 'Cook Islands', 'CK', 682, 'COK', '', 0, 0, 0, 1),
(51, 'Costa Rica', 'CR', 506, 'CRI', '', 0, 0, 0, 1),
(52, 'Cote D\'Ivoire', 'CI', 225, 'CIV', '', 0, 0, 0, 1),
(53, 'Croatia', 'HR', 385, 'HRV', '', 0, 0, 0, 1),
(54, 'Cuba', 'CU', 53, 'CUB', '', 0, 0, 0, 1),
(55, 'Cyprus', 'CY', 357, 'CYP', '', 0, 0, 0, 1),
(56, 'Czech Republic', 'CZ', 420, 'CZE', '', 0, 0, 0, 1),
(57, 'Denmark', 'DK', 45, 'DNK', '', 0, 0, 0, 1),
(58, 'Djibouti', 'DJ', 253, 'DJI', '', 0, 0, 0, 1),
(59, 'Dominica', 'DM', 1767, 'DMA', '', 0, 0, 0, 1),
(60, 'Dominican Republic', 'DO', 1809, 'DOM', '', 0, 0, 0, 1),
(61, 'East Timor', 'TL', 0, 'TLS', '', 0, 0, 0, 1),
(62, 'Ecuador', 'EC', 593, 'ECU', '', 0, 0, 0, 1),
(63, 'Egypt', 'EG', 20, 'EGY', '', 0, 0, 0, 1),
(64, 'El Salvador', 'SV', 503, 'SLV', '', 0, 0, 0, 1),
(65, 'Equatorial Guinea', 'GQ', 240, 'GNQ', '', 0, 0, 0, 1),
(66, 'Eritrea', 'ER', 291, 'ERI', '', 0, 0, 0, 1),
(67, 'Estonia', 'EE', 372, 'EST', '', 0, 0, 0, 1),
(68, 'Ethiopia', 'ET', 251, 'ETH', '', 0, 0, 0, 1),
(69, 'Falkland Islands (Malvinas)', 'FK', 500, 'FLK', '', 0, 0, 0, 1),
(70, 'Faroe Islands', 'FO', 298, 'FRO', '', 0, 0, 0, 1),
(71, 'Fiji', 'FJ', 679, 'FJI', '', 0, 0, 0, 1),
(72, 'Finland', 'FI', 358, 'FIN', '', 0, 0, 0, 1),
(74, 'France, Metropolitan', 'FR', 33, 'FRA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 0, 0, 1),
(75, 'French Guiana', 'GF', 594, 'GUF', '', 0, 0, 0, 1),
(76, 'French Polynesia', 'PF', 689, 'PYF', '', 0, 0, 0, 1),
(77, 'French Southern Territories', 'TF', 0, 'ATF', '', 0, 0, 0, 1),
(78, 'Gabon', 'GA', 241, 'GAB', '', 0, 0, 0, 1),
(79, 'Gambia', 'GM', 220, 'GMB', '', 0, 0, 0, 1),
(80, 'Georgia', 'GE', 995, 'GEO', '', 0, 0, 0, 1),
(81, 'Germany', 'DE', 49, 'DEU', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 0, 0, 1),
(82, 'Ghana', 'GH', 233, 'GHA', '', 0, 0, 0, 1),
(83, 'Gibraltar', 'GI', 350, 'GIB', '', 0, 0, 0, 1),
(84, 'Greece', 'GR', 30, 'GRC', '', 0, 0, 0, 1),
(85, 'Greenland', 'GL', 299, 'GRL', '', 0, 0, 0, 1),
(86, 'Grenada', 'GD', 1473, 'GRD', '', 0, 0, 0, 1),
(87, 'Guadeloupe', 'GP', 590, 'GLP', '', 0, 0, 0, 1),
(88, 'Guam', 'GU', 1671, 'GUM', '', 0, 0, 0, 1),
(89, 'Guatemala', 'GT', 502, 'GTM', '', 0, 0, 0, 1),
(90, 'Guinea', 'GN', 224, 'GIN', '', 0, 0, 0, 1),
(91, 'Guinea-Bissau', 'GW', 245, 'GNB', '', 0, 0, 0, 1),
(92, 'Guyana', 'GY', 592, 'GUY', '', 0, 0, 0, 1),
(93, 'Haiti', 'HT', 509, 'HTI', '', 0, 0, 0, 1),
(94, 'Heard and Mc Donald Islands', 'HM', 0, 'HMD', '', 0, 0, 0, 1),
(95, 'Honduras', 'HN', 504, 'HND', '', 0, 0, 0, 1),
(96, 'Hong Kong', 'HK', 852, 'HKG', '', 0, 0, 0, 1),
(97, 'Hungary', 'HU', 36, 'HUN', '', 0, 0, 0, 1),
(98, 'Iceland', 'IS', 354, 'ISL', '', 0, 0, 0, 1),
(99, 'India', 'IN', 91, 'IND', '', 0, 0, 2, 1),
(100, 'Indonesia', 'ID', 62, 'IDN', '', 0, 0, 0, 1),
(101, 'Iran (Islamic Republic of)', 'IR', 98, 'IRN', '', 0, 0, 0, 1),
(102, 'Iraq', 'IQ', 964, 'IRQ', '', 0, 0, 0, 1),
(103, 'Ireland', 'IE', 353, 'IRL', '', 0, 0, 0, 1),
(104, 'Israel', 'IL', 972, 'ISR', '', 0, 0, 0, 1),
(105, 'Italy', 'IT', 39, 'ITA', '', 0, 0, 0, 1),
(106, 'Jamaica', 'JM', 1876, 'JAM', '', 0, 0, 0, 1),
(107, 'Japan', 'JP', 81, 'JPN', '', 0, 0, 0, 1),
(108, 'Jordan', 'JO', 962, 'JOR', '', 0, 0, 0, 1),
(109, 'Kazakhstan', 'KZ', 7, 'KAZ', '', 0, 0, 0, 1),
(110, 'Kenya', 'KE', 254, 'KEN', '', 0, 0, 0, 1),
(111, 'Kiribati', 'KI', 686, 'KIR', '', 0, 0, 0, 1),
(112, 'North Korea', 'KP', 850, 'PRK', '', 0, 0, 0, 1),
(113, 'South Korea', 'KR', 82, 'KOR', '', 0, 0, 0, 1),
(114, 'Kuwait', 'KW', 965, 'KWT', '', 0, 0, 0, 1),
(115, 'Kyrgyzstan', 'KG', 996, 'KGZ', '', 0, 0, 0, 1),
(116, 'Lao People\'s Democratic Republic', 'LA', 856, 'LAO', '', 0, 0, 0, 1),
(117, 'Latvia', 'LV', 371, 'LVA', '', 0, 0, 0, 1),
(118, 'Lebanon', 'LB', 961, 'LBN', '', 0, 0, 0, 1),
(119, 'Lesotho', 'LS', 266, 'LSO', '', 0, 0, 0, 1),
(120, 'Liberia', 'LR', 231, 'LBR', '', 0, 0, 0, 1),
(121, 'Libyan Arab Jamahiriya', 'LY', 218, 'LBY', '', 0, 0, 0, 1),
(122, 'Liechtenstein', 'LI', 423, 'LIE', '', 0, 0, 0, 1),
(123, 'Lithuania', 'LT', 370, 'LTU', '', 0, 0, 0, 1),
(124, 'Luxembourg', 'LU', 352, 'LUX', '', 0, 0, 0, 1),
(125, 'Macau', 'MO', 853, 'MAC', '', 0, 0, 0, 1),
(126, 'FYROM', 'MK', 389, 'MKD', '', 0, 0, 0, 1),
(127, 'Madagascar', 'MG', 261, 'MDG', '', 0, 0, 0, 1),
(128, 'Malawi', 'MW', 265, 'MWI', '', 0, 0, 0, 1),
(129, 'Malaysia', 'MY', 60, 'MYS', '', 0, 0, 0, 1),
(130, 'Maldives', 'MV', 960, 'MDV', '', 0, 0, 0, 1),
(131, 'Mali', 'ML', 223, 'MLI', '', 0, 0, 0, 1),
(132, 'Malta', 'MT', 356, 'MLT', '', 0, 0, 0, 1),
(133, 'Marshall Islands', 'MH', 692, 'MHL', '', 0, 0, 0, 1),
(134, 'Martinique', 'MQ', 596, 'MTQ', '', 0, 0, 0, 1),
(135, 'Mauritania', 'MR', 222, 'MRT', '', 0, 0, 0, 1),
(136, 'Mauritius', 'MU', 230, 'MUS', '', 0, 0, 0, 1),
(137, 'Mayotte', 'YT', 269, 'MYT', '', 0, 0, 0, 1),
(138, 'Mexico', 'MX', 52, 'MEX', '', 0, 0, 0, 1),
(139, 'Micronesia, Federated States of', 'FM', 691, 'FSM', '', 0, 0, 0, 1),
(140, 'Moldova, Republic of', 'MD', 373, 'MDA', '', 0, 0, 0, 1),
(141, 'Monaco', 'MC', 377, 'MCO', '', 0, 0, 0, 1),
(142, 'Mongolia', 'MN', 976, 'MNG', '', 0, 0, 0, 1),
(143, 'Montserrat', 'MS', 1664, 'MSR', '', 0, 0, 0, 1),
(144, 'Morocco', 'MA', 212, 'MAR', '', 0, 0, 0, 1),
(145, 'Mozambique', 'MZ', 258, 'MOZ', '', 0, 0, 0, 1),
(146, 'Myanmar', 'MM', 95, 'MMR', '', 0, 0, 0, 1),
(147, 'Namibia', 'NA', 264, 'NAM', '', 0, 0, 0, 1),
(148, 'Nauru', 'NR', 674, 'NRU', '', 0, 0, 0, 1),
(149, 'Nepal', 'NP', 977, 'NPL', '', 0, 0, 0, 1),
(150, 'Netherlands', 'NL', 31, 'NLD', '', 0, 0, 0, 1),
(151, 'Netherlands Antilles', 'AN', 599, 'ANT', '', 0, 0, 0, 1),
(152, 'New Caledonia', 'NC', 687, 'NCL', '', 0, 0, 0, 1),
(153, 'New Zealand', 'NZ', 64, 'NZL', '', 0, 0, 0, 1),
(154, 'Nicaragua', 'NI', 505, 'NIC', '', 0, 0, 0, 1),
(155, 'Niger', 'NE', 227, 'NER', '', 0, 0, 0, 1),
(156, 'Nigeria', 'NG', 234, 'NGA', '', 0, 0, 0, 1),
(157, 'Niue', 'NU', 683, 'NIU', '', 0, 0, 0, 1),
(158, 'Norfolk Island', 'NF', 672, 'NFK', '', 0, 0, 0, 1),
(159, 'Northern Mariana Islands', 'MP', 1670, 'MNP', '', 0, 0, 0, 1),
(160, 'Norway', 'NO', 47, 'NOR', '', 0, 0, 0, 1),
(161, 'Oman', 'OM', 968, 'OMN', '', 0, 0, 0, 1),
(162, 'Pakistan', 'PK', 92, 'PAK', '', 0, 0, 0, 1),
(163, 'Palau', 'PW', 680, 'PLW', '', 0, 0, 0, 1),
(164, 'Panama', 'PA', 507, 'PAN', '', 0, 0, 0, 1),
(165, 'Papua New Guinea', 'PG', 675, 'PNG', '', 0, 0, 0, 1),
(166, 'Paraguay', 'PY', 595, 'PRY', '', 0, 0, 0, 1),
(167, 'Peru', 'PE', 51, 'PER', '', 0, 0, 0, 1),
(168, 'Philippines', 'PH', 63, 'PHL', '', 0, 0, 0, 1),
(169, 'Pitcairn', 'PN', 0, 'PCN', '', 0, 0, 0, 1),
(170, 'Poland', 'PL', 48, 'POL', '', 0, 0, 0, 1),
(171, 'Portugal', 'PT', 351, 'PRT', '', 0, 0, 0, 1),
(172, 'Puerto Rico', 'PR', 1787, 'PRI', '', 0, 0, 0, 1),
(173, 'Qatar', 'QA', 974, 'QAT', '', 0, 0, 0, 1),
(174, 'Reunion', 'RE', 262, 'REU', '', 0, 0, 0, 1),
(175, 'Romania', 'RO', 40, 'ROM', '', 0, 0, 0, 1),
(176, 'Russian Federation', 'RU', 70, 'RUS', '', 0, 0, 0, 1),
(177, 'Rwanda', 'RW', 250, 'RWA', '', 0, 0, 0, 1),
(178, 'Saint Kitts and Nevis', 'KN', 1869, 'KNA', '', 0, 0, 0, 1),
(179, 'Saint Lucia', 'LC', 1758, 'LCA', '', 0, 0, 0, 1),
(180, 'Saint Vincent and the Grenadines', 'VC', 1784, 'VCT', '', 0, 0, 0, 1),
(181, 'Samoa', 'WS', 684, 'WSM', '', 0, 0, 0, 1),
(182, 'San Marino', 'SM', 378, 'SMR', '', 0, 0, 0, 1),
(183, 'Sao Tome and Principe', 'ST', 239, 'STP', '', 0, 0, 0, 1),
(184, 'Saudi Arabia', 'SA', 966, 'SAU', '', 0, 0, 0, 1),
(185, 'Senegal', 'SN', 221, 'SEN', '', 0, 0, 0, 1),
(186, 'Seychelles', 'SC', 248, 'SYC', '', 0, 0, 0, 1),
(187, 'Sierra Leone', 'SL', 232, 'SLE', '', 0, 0, 0, 1),
(188, 'Singapore', 'SG', 65, 'SGP', '', 0, 0, 0, 1),
(189, 'Slovak Republic', 'SK', 421, 'SVK', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city} {postcode}\r\n{zone}\r\n{country}', 0, 0, 0, 1),
(190, 'Slovenia', 'SI', 386, 'SVN', '', 0, 0, 0, 1),
(191, 'Solomon Islands', 'SB', 677, 'SLB', '', 0, 0, 0, 1),
(192, 'Somalia', 'SO', 252, 'SOM', '', 0, 0, 0, 1),
(193, 'South Africa', 'ZA', 27, 'ZAF', '', 0, 0, 0, 1),
(194, 'South Georgia &amp; South Sandwich Islands', 'GS', 0, 'SGS', '', 0, 0, 0, 1),
(195, 'Spain', 'ES', 34, 'ESP', '', 0, 0, 0, 1),
(196, 'Sri Lanka', 'LK', 94, 'LKA', '', 0, 0, 0, 1),
(197, 'St. Helena', 'SH', 290, 'SHN', '', 0, 0, 0, 1),
(198, 'St. Pierre and Miquelon', 'PM', 508, 'SPM', '', 0, 0, 0, 1),
(199, 'Sudan', 'SD', 249, 'SDN', '', 0, 0, 0, 1),
(200, 'Suriname', 'SR', 597, 'SUR', '', 0, 0, 0, 1),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 47, 'SJM', '', 0, 0, 0, 1),
(202, 'Swaziland', 'SZ', 268, 'SWZ', '', 0, 0, 0, 1),
(203, 'Sweden', 'SE', 46, 'SWE', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 0, 0, 1),
(204, 'Switzerland', 'CH', 41, 'CHE', '', 0, 0, 0, 1),
(205, 'Syrian Arab Republic', 'SY', 963, 'SYR', '', 0, 0, 0, 1),
(206, 'Taiwan', 'TW', 886, 'TWN', '', 0, 0, 0, 1),
(207, 'Tajikistan', 'TJ', 992, 'TJK', '', 0, 0, 0, 1),
(208, 'Tanzania, United Republic of', 'TZ', 255, 'TZA', '', 0, 0, 0, 1),
(209, 'Thailand', 'TH', 66, 'THA', '', 0, 0, 0, 1),
(210, 'Togo', 'TG', 228, 'TGO', '', 0, 0, 0, 1),
(211, 'Tokelau', 'TK', 690, 'TKL', '', 0, 0, 0, 1),
(212, 'Tonga', 'TO', 676, 'TON', '', 0, 0, 0, 1),
(213, 'Trinidad and Tobago', 'TT', 1868, 'TTO', '', 0, 0, 0, 1),
(214, 'Tunisia', 'TN', 216, 'TUN', '', 0, 0, 0, 1),
(215, 'Turkey', 'TR', 90, 'TUR', '', 0, 0, 0, 1),
(216, 'Turkmenistan', 'TM', 7370, 'TKM', '', 0, 0, 0, 1),
(217, 'Turks and Caicos Islands', 'TC', 1649, 'TCA', '', 0, 0, 0, 1),
(218, 'Tuvalu', 'TV', 688, 'TUV', '', 0, 0, 0, 1),
(219, 'Uganda', 'UG', 256, 'UGA', '', 0, 0, 0, 1),
(220, 'Ukraine', 'UA', 380, 'UKR', '', 0, 0, 0, 1),
(221, 'United Arab Emirates', 'AE', 971, 'ARE', '', 0, 0, 0, 1),
(222, 'United Kingdom', 'GB', 44, 'GBR', '', 1, 0, 0, 1),
(223, 'United States', 'US', 1, 'USA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city}, {zone} {postcode}\r\n{country}', 0, 0, 0, 1),
(224, 'United States Minor Outlying Islands', 'UM', 1, 'UMI', '', 0, 0, 0, 1),
(225, 'Uruguay', 'UY', 598, 'URY', '', 0, 0, 0, 1),
(226, 'Uzbekistan', 'UZ', 998, 'UZB', '', 0, 0, 0, 1),
(227, 'Vanuatu', 'VU', 678, 'VUT', '', 0, 0, 0, 1),
(228, 'Vatican City State (Holy See)', 'VA', 39, 'VAT', '', 0, 0, 0, 1),
(229, 'Venezuela', 'VE', 58, 'VEN', '', 0, 0, 0, 1),
(230, 'Viet Nam', 'VN', 84, 'VNM', '', 0, 0, 0, 1),
(231, 'Virgin Islands (British)', 'VG', 1284, 'VGB', '', 0, 0, 0, 1),
(232, 'Virgin Islands (U.S.)', 'VI', 1340, 'VIR', '', 0, 0, 0, 1),
(233, 'Wallis and Futuna Islands', 'WF', 681, 'WLF', '', 0, 0, 0, 1),
(234, 'Western Sahara', 'EH', 212, 'ESH', '', 0, 0, 0, 1),
(235, 'Yemen', 'YE', 967, 'YEM', '', 0, 0, 0, 1),
(237, 'Democratic Republic of Congo', 'CD', 242, 'COD', '', 0, 0, 0, 1),
(238, 'Zambia', 'ZM', 260, 'ZMB', '', 0, 0, 0, 1),
(239, 'Zimbabwe', 'ZW', 263, 'ZWE', '', 0, 0, 0, 1),
(242, 'Montenegro', 'ME', 0, 'MNE', '', 0, 0, 0, 1),
(243, 'Serbia', 'RS', 381, 'SRB', '', 0, 0, 0, 1),
(244, 'Aaland Islands', 'AX', 0, 'ALA', '', 0, 0, 0, 1),
(245, 'Bonaire, Sint Eustatius and Saba', 'BQ', 0, 'BES', '', 0, 0, 0, 1),
(246, 'Curacao', 'CW', 0, 'CUW', '', 0, 0, 0, 1),
(247, 'Palestinian Territory, Occupied', 'PS', 970, 'PSE', '', 0, 0, 0, 1),
(248, 'South Sudan', 'SS', 211, 'SSD', '', 0, 0, 0, 1),
(249, 'St. Barthelemy', 'BL', 0, 'BLM', '', 0, 0, 0, 1),
(250, 'St. Martin (French part)', 'MF', 0, 'MAF', '', 0, 0, 0, 1),
(251, 'Canary Islands', 'IC', 0, 'ICA', '', 0, 0, 0, 1),
(252, 'Ascension Island (British)', 'AC', 0, 'ASC', '', 0, 0, 0, 1),
(253, 'Kosovo, Republic of', 'XK', 0, 'UNK', '', 0, 0, 0, 1),
(254, 'Isle of Man', 'IM', 0, 'IMN', '', 0, 0, 0, 1),
(255, 'Tristan da Cunha', 'TA', 0, 'SHN', '', 0, 0, 0, 1),
(256, 'Guernsey', 'GG', 0, 'GGY', '', 0, 0, 0, 1),
(257, 'Jersey', 'JE', 0, 'JEY', '', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_cron_job`
--

CREATE TABLE `mlm_cron_job` (
  `id` int(30) NOT NULL,
  `cron_job` varchar(30) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `data` varchar(40) DEFAULT 'NA',
  `date` datetime DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `preferences` mediumtext DEFAULT NULL,
  `file_status` varchar(30) DEFAULT 'active',
  `done_by` varchar(30) DEFAULT 'Cron Job'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_cron_job`
--

INSERT INTO `mlm_cron_job` (`id`, `cron_job`, `ip`, `data`, `date`, `status`, `preferences`, `file_status`, `done_by`) VALUES
(1, 'cashe_clr', '127.0.0.1', 'NA', '2022-01-13 12:06:52', 'Success', NULL, 'active', 'Cron Job');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_curl_history`
--

CREATE TABLE `mlm_curl_history` (
  `id` int(11) NOT NULL,
  `from_email` varchar(20) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `url` varchar(10) DEFAULT NULL,
  `proccess_type` varchar(10) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_currencies`
--

CREATE TABLE `mlm_currencies` (
  `id` int(30) NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `currency_name` varchar(30) NOT NULL,
  `symbol_left` varchar(30) NOT NULL,
  `symbol_right` varchar(30) NOT NULL,
  `currency_ratio` decimal(16,8) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'active',
  `icon` varchar(30) NOT NULL,
  `conversion_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_currencies`
--

INSERT INTO `mlm_currencies` (`id`, `currency_code`, `currency_name`, `symbol_left`, `symbol_right`, `currency_ratio`, `status`, `icon`, `conversion_status`) VALUES
(1, 'USD', 'Dollar', '$', '', '1.00000000', '1', 'fa-dollar', 'yes'),
(2, 'EUR', 'Euro', '€', '', '0.85970000', '1', 'fa-eur', 'yes'),
(3, 'JPY', 'Yen', '¥', '', '108.98000000', '1', 'fa-jpy', 'yes'),
(4, 'GBP', 'Pound', '£', '', '0.75224000', '1', 'fa-gbp', 'yes'),
(5, 'INR', 'Rupee', '', '₹', '67.39000000', '1', 'fa-rupee', 'yes'),
(6, 'RUB', 'Ruble', '', 'RUB', '62.22800000', '1', 'fa-rouble', 'yes'),
(7, 'TRY', 'Turkish', '', '', '4.45480000', '1', 'fa-try', 'yes'),
(8, 'KRW', 'Won', '', '', '1079.30000000', '1', 'fa-krw', 'yes'),
(9, 'BTC', 'Bitcoin', '', '฿', '0.00013262', '1', 'fa-bitcoin', 'yes'),
(10, 'GH', 'Ghana Cedi', '¢', '', '4.62000000', '1', 'fa-cedi', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_currency_values`
--

CREATE TABLE `mlm_currency_values` (
  `id` int(20) NOT NULL,
  `code` varchar(20) NOT NULL,
  `value` float(16,8) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_db_optimize`
--

CREATE TABLE `mlm_db_optimize` (
  `id` int(12) NOT NULL,
  `table_name` varchar(25) NOT NULL,
  `date_fleld` varchar(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_db_optimize`
--

INSERT INTO `mlm_db_optimize` (`id`, `table_name`, `date_fleld`, `status`) VALUES
(1, 'activity', 'date', 1),
(2, 'affiliate_activity', 'date', 1),
(3, 'binary_bonus_history', 'date', 1),
(4, 'blocktrail_payment', 'date', 1),
(5, 'issues', 'date', 1),
(6, 'pending_registrations', 'date', 1),
(7, 'rank_history', 'update_date', 1),
(8, 'register_history', 'date', 1),
(9, 'pair_calculation', 'date', 1),
(10, 'cron_job', 'date', 1),
(11, 'curl_history', 'date', 1),
(12, 'coin_payment_response', 'date', 1),
(13, 'translated_files', 'date', 1),
(14, 'translator_history', 'date', 1),
(15, 'messages', 'date', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_demo_switcher`
--

CREATE TABLE `mlm_demo_switcher` (
  `id` int(10) NOT NULL,
  `plan` varchar(10) NOT NULL,
  `basic` varchar(50) NOT NULL,
  `advanced` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_demo_switcher`
--

INSERT INTO `mlm_demo_switcher` (`id`, `plan`, `basic`, `advanced`) VALUES
(1, 'binary', 'https://basic-binary.leadmlmsoftware.in/', 'https://binary.leadmlmsoftware.in/'),
(2, 'donation', 'https://basic-donation.leadmlmsoftware.in/', 'https://donation.leadmlmsoftware.in/'),
(3, 'generation', 'https://basic-generation.leadmlmsoftware.in/', 'https://generation.leadmlmsoftware.in/'),
(4, 'gift', 'https://basic-gift.leadmlmsoftware.in/', 'https://gift.leadmlmsoftware.in/'),
(5, 'investment', 'https://basic-investment.leadmlmsoftware.in/', 'https://investment.leadmlmsoftware.in/'),
(6, 'matrix', 'https://basic-matrix.leadmlmsoftware.in/', 'https://matrix.leadmlmsoftware.in/'),
(7, 'monoline', 'https://basic-monoline.leadmlmsoftware.in/', 'https://monoline.leadmlmsoftware.in/'),
(8, 'party', 'https://basic-party.leadmlmsoftware.in/', 'https://party.leadmlmsoftware.in/'),
(9, 'stairstep', 'https://basic-stairstep.leadmlmsoftware.in/', 'https://stairstep.leadmlmsoftware.in/'),
(10, 'unilevel', 'https://basic-unilevel.leadmlmsoftware.in/', 'https://unilevel.leadmlmsoftware.in/');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_documents`
--

CREATE TABLE `mlm_documents` (
  `id` int(20) NOT NULL,
  `mlm_user_id` int(20) NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `document` varchar(20) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `extension` varchar(20) DEFAULT NULL,
  `file_type` varchar(10) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `upload_data` mediumtext DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_documents`
--

INSERT INTO `mlm_documents` (`id`, `mlm_user_id`, `title`, `document`, `size`, `extension`, `file_type`, `date`, `upload_data`, `status`) VALUES
(1, 1900, 'dfgdfgdfg', 'img_1618633544.jpeg', '5.77', '.jpeg', 'img', '2021-04-17 09:55:44', 'a:14:{s:9:\"file_name\";s:19:\"img_1618633544.jpeg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:46:\"/var/www/html/WC/8.04/assets/images/documents/\";s:9:\"full_path\";s:65:\"/var/www/html/WC/8.04/assets/images/documents/img_1618633544.jpeg\";s:8:\"raw_name\";s:14:\"img_1618633544\";s:9:\"orig_name\";s:19:\"img_1618633544.jpeg\";s:11:\"client_name\";s:10:\"smile.jpeg\";s:8:\"file_ext\";s:5:\".jpeg\";s:9:\"file_size\";d:5.77;s:8:\"is_image\";b:1;s:11:\"image_width\";i:259;s:12:\"image_height\";i:194;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"259\" height=\"194\"\";}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_donations`
--

CREATE TABLE `mlm_donations` (
  `id` int(20) NOT NULL,
  `from_user` int(20) NOT NULL,
  `to_user` int(20) NOT NULL,
  `amount` decimal(16,8) NOT NULL,
  `reap_amount` decimal(16,8) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `reap_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_employee_details`
--

CREATE TABLE `mlm_employee_details` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `user_photo` varchar(50) DEFAULT 'no_user.jpg',
  `date_of_birth` date DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zipcode` varchar(20) DEFAULT NULL,
  `status` int(5) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_employee_login`
--

CREATE TABLE `mlm_employee_login` (
  `employee_id` int(11) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT 'employee',
  `password` text DEFAULT NULL,
  `modules` mediumtext DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `currency` int(5) DEFAULT 1,
  `language` int(5) DEFAULT 1,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_employee_login`
--

INSERT INTO `mlm_employee_login` (`employee_id`, `user_name`, `user_type`, `password`, `modules`, `status`, `currency`, `language`, `date`) VALUES
(1, 'employee', 'employee', '$2y$10$6GjEPxfngLA.jzbTLtn3O.5QsF2YfqIE0A.33h.FxEURKWTH6eUbW', 'a:25:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:2:\"14\";i:3;s:2:\"23\";i:4;s:2:\"22\";i:5;s:2:\"26\";i:6;s:2:\"43\";i:7;s:3:\"116\";i:8;s:3:\"107\";i:9;s:3:\"108\";i:10;s:2:\"38\";i:11;s:3:\"110\";i:12;s:3:\"117\";i:13;s:2:\"27\";i:14;s:2:\"45\";i:15;s:2:\"46\";i:16;s:2:\"17\";i:17;s:2:\"73\";i:18;s:2:\"74\";i:19;s:1:\"7\";i:20;s:1:\"4\";i:21;s:3:\"150\";i:22;s:3:\"151\";i:23;s:3:\"152\";i:24;s:3:\"106\";}', 1, 1, 1, '2021-11-17 11:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_events`
--

CREATE TABLE `mlm_events` (
  `id` int(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `desc` text NOT NULL,
  `event_type` varchar(20) NOT NULL,
  `start_date` varchar(30) DEFAULT NULL,
  `end_date` varchar(30) DEFAULT NULL,
  `added_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_genertion_settings`
--

CREATE TABLE `mlm_genertion_settings` (
  `id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL DEFAULT 1,
  `g1_value` int(11) NOT NULL DEFAULT 0,
  `g2_value` int(11) NOT NULL DEFAULT 0,
  `g3_value` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_genertion_settings`
--

INSERT INTO `mlm_genertion_settings` (`id`, `rank_id`, `g1_value`, `g2_value`, `g3_value`) VALUES
(1, 2, 1, 2, 3),
(2, 3, 4, 5, 6),
(3, 4, 7, 8, 9);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_gift_requests`
--

CREATE TABLE `mlm_gift_requests` (
  `id` int(20) NOT NULL,
  `mlm_user_id` int(20) NOT NULL,
  `gift_amount` float(16,8) NOT NULL,
  `date` datetime DEFAULT NULL,
  `paid_status` tinyint(1) DEFAULT 0,
  `paid_user` int(20) DEFAULT NULL,
  `paid_date` datetime DEFAULT NULL,
  `confirm_status` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_investment_category`
--

CREATE TABLE `mlm_investment_category` (
  `id` int(20) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `icon` varchar(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_investment_category`
--

INSERT INTO `mlm_investment_category` (`id`, `code`, `name`, `icon`, `status`) VALUES
(1, 'btc', 'Bitcoin', '', 1),
(2, 'ltc', 'Lite Coin', '', 1),
(3, 'hsc', 'Hash Coin', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_investment_history`
--

CREATE TABLE `mlm_investment_history` (
  `id` int(11) NOT NULL,
  `mlm_user_id` int(11) NOT NULL,
  `pay_amount` double NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_investment_user_balance`
--

CREATE TABLE `mlm_investment_user_balance` (
  `id` int(11) NOT NULL,
  `mlm_user_id` int(11) NOT NULL,
  `1_balance_amount` decimal(16,8) NOT NULL,
  `2_balance_amount` decimal(16,8) NOT NULL,
  `3_balance_amount` decimal(16,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_investment_user_balance`
--

INSERT INTO `mlm_investment_user_balance` (`id`, `mlm_user_id`, `1_balance_amount`, `2_balance_amount`, `3_balance_amount`) VALUES
(1, 1900, '0.00000000', '0.00000000', '0.00000000'),
(2, 1901, '0.00000000', '0.00000000', '0.00000000'),
(3, 1902, '0.00000000', '0.00000000', '0.00000000'),
(4, 1903, '0.00000000', '0.00000000', '0.00000000');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_inv_release_history`
--

CREATE TABLE `mlm_inv_release_history` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `cat_id` int(20) NOT NULL,
  `req_amount` float(16,8) NOT NULL,
  `req_date` datetime DEFAULT NULL,
  `confirm_date` datetime DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_ip_blacklist`
--

CREATE TABLE `mlm_ip_blacklist` (
  `id` int(20) NOT NULL,
  `blacklist_ip` varchar(30) NOT NULL,
  `reason` varchar(200) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_ip_whitelist`
--

CREATE TABLE `mlm_ip_whitelist` (
  `id` int(20) NOT NULL,
  `whitelist_ip` varchar(30) NOT NULL,
  `reason` varchar(200) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_issues`
--

CREATE TABLE `mlm_issues` (
  `id` int(11) NOT NULL,
  `mlm_user_id` int(11) NOT NULL,
  `employee_id` int(20) DEFAULT 0,
  `activity` varchar(100) NOT NULL,
  `ip_address` varchar(30) DEFAULT 'NA',
  `user_agent` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `data` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_issues`
--

INSERT INTO `mlm_issues` (`id`, `mlm_user_id`, `employee_id`, `activity`, `ip_address`, `user_agent`, `date`, `data`) VALUES
(1, 1900, 0, 'clean_up', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:86.0) Gecko/20100101 Firefox/86.0', '2021-03-22 14:05:14', 'a:0:{}'),
(2, 1901, 0, 'registration_error', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/5', '2021-03-31 16:39:28', 'a:7:{s:17:\"stair_step_status\";b:1;s:17:\"investment_status\";b:1;s:17:\"generation_status\";b:1;s:22:\"uni_level_bonus_status\";b:1;s:15:\"referral_status\";b:1;s:11:\"rank_status\";b:1;s:19:\"point_update_status\";b:0;}'),
(3, 1902, 0, 'registration_error', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 10:25:02', 'a:7:{s:17:\"stair_step_status\";b:1;s:17:\"investment_status\";b:1;s:17:\"generation_status\";b:1;s:22:\"uni_level_bonus_status\";b:1;s:15:\"referral_status\";b:1;s:11:\"rank_status\";b:1;s:19:\"point_update_status\";b:0;}'),
(4, 1903, 0, 'registration_error', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.11', '2021-12-18 11:02:38', 'a:7:{s:17:\"stair_step_status\";b:1;s:17:\"investment_status\";b:1;s:17:\"generation_status\";b:1;s:22:\"uni_level_bonus_status\";b:1;s:15:\"referral_status\";b:1;s:11:\"rank_status\";b:1;s:19:\"point_update_status\";b:0;}');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_kyc_details`
--

CREATE TABLE `mlm_kyc_details` (
  `id` int(11) NOT NULL,
  `bank_proof` varchar(30) DEFAULT NULL,
  `id_proof` varchar(30) DEFAULT NULL,
  `created_user_id` bigint(20) DEFAULT NULL,
  `to_user_id` int(11) NOT NULL,
  `id_proof_status` varchar(20) DEFAULT 'pending',
  `bank_proof_status` varchar(20) DEFAULT 'pending',
  `id_proof_cancel_reason` varchar(50) DEFAULT NULL,
  `bank_proof_cancel_reason` varchar(50) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_languages`
--

CREATE TABLE `mlm_languages` (
  `id` int(30) NOT NULL,
  `lang_code` varchar(30) NOT NULL,
  `lang_name` varchar(30) NOT NULL,
  `language_folder` varchar(20) DEFAULT NULL,
  `lang_eng_name` varchar(30) DEFAULT NULL,
  `lang_flag` varchar(30) NOT NULL,
  `terms_condition` mediumtext DEFAULT NULL,
  `privacy_policy` mediumtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_languages`
--

INSERT INTO `mlm_languages` (`id`, `lang_code`, `lang_name`, `language_folder`, `lang_eng_name`, `lang_flag`, `terms_condition`, `privacy_policy`, `status`) VALUES
(1, 'en', 'English', 'english', 'English', 'US.png', '<h3>A <strong>Terms and Conditions agreement</strong> is the agreement that includes the terms, the rules and the guidelines of acceptable behavior, plus other useful sections, to which users must agree in order to use or access your website and mobile app.a</h3>\r\n', '<p>A&nbsp;<strong>Privacy Policy agreement</strong>&nbsp;is the agreement where you specify if you collect personal data, what kind of personal data you collect from users and what you do with that data.</p>\r\n', 1),
(2, 'fr', 'français', 'french', 'French', 'FR.png', '<pre>\r\nUn accord sur les termes et conditions est l&#39;accord qui comprend les termes, les règles et les directives de comportement acceptable, ainsi que d&#39;autres sections utiles, que les utilisateurs doivent accepter pour utiliser ou accéder à votre site Web et à votre application mobile.</pre>\r\n\r\n<p> </p>\r\n', '<pre>\r\nUn accord de politique de confidentialité est l&#39;accord dans lequel vous spécifiez si vous collectez des données personnelles, quel type de données personnelles vous collectez auprès des utilisateurs et ce que vous faites avec ces données.</pre>\r\n', 1),
(3, 'ml', 'മലയാളം', 'malayalam', 'Malayalam', 'IN.png', '<h3>A&nbsp;<strong>Terms and Conditions agreement</strong>&nbsp;is the agreement that includes the terms, the rules and the guidelines of acceptable behavior, plus other useful sections, to which users must agree in order to use or access your website and mobile app.</h3>\r\n\r\n<p>&nbsp;</p>\r\n', '<p>A&nbsp;<strong>Privacy Policy agreement</strong>&nbsp;is the agreement where you specify if you collect personal data, what kind of personal data you collect from users and what you do with that data.</p>\r\n', 0),
(4, 'ja', '日本人', 'japanese', 'Japanese', 'JP.png', '<pre>\r\n利用規約とは、ウェブサイトやモバイルアプリを使用またはアクセスするためにユーザーが同意しなければならない条件、規則、許容される行動のガイドライン、およびその他の有用なセクションを含む契約です</pre>\r\n', '<pre>\r\nプライバシーポリシー契約は、個人データを収集するかどうか、ユーザーから収集する個人データの種類、およびそのデータを使用して何を行うかを指定する契約です。</pre>\r\n', 0),
(5, 'zh', '中文', 'chinese', 'Chinese', 'CN.png', '<pre>\r\n条款和条件协议是包括用户可接受的条款，规则和准则以及可接受的行为的协议，用户必须同意才能使用或访问您的网站和移动应用程序。</pre>\r\n', '<pre>\r\n隐私政策协议是您在其中指定是否收集个人数据，从用户那里收集哪种类型的个人数据以及如何处理这些数据的协议。</pre>\r\n', 0),
(6, 'es', 'Español', 'spanish', 'Spanish', 'ES.png', '<pre>\r\nUn acuerdo de términos y condiciones es el acuerdo que incluye los términos, las reglas y las pautas de comportamiento aceptable, además de otras secciones útiles, que los usuarios deben aceptar para usar o acceder a su sitio web y aplicación móvil.</pre>\r\n', '<pre>\r\nUn acuerdo de política de privacidad es el acuerdo en el que especifica si recopila datos personales, qué tipo de datos personales recopila de los usuarios y qué hace con esos datos.</pre>\r\n', 1),
(7, 'hi', 'हिंदी', 'hindi', 'Hindi', 'IN.png', '<h3>A&nbsp;<strong>Terms and Conditions agreement</strong>&nbsp;is the agreement that includes the terms, the rules and the guidelines of acceptable behavior, plus other useful sections, to which users must agree in order to use or access your website and mobile app.</h3>\r\n\r\n<p>&nbsp;</p>\r\n', '<p>A&nbsp;<strong>Privacy Policy agreement</strong>&nbsp;is the agreement where you specify if you collect personal data, what kind of personal data you collect from users and what you do with that data.</p>\r\n', 0),
(8, 'ar', 'عربى', 'arabic', 'Arabic', 'MR.png', '<pre>\r\nاتفاقية الشروط والأحكام هي الاتفاقية التي تتضمن الشروط والقواعد والإرشادات الخاصة بالسلوك المقبول ، بالإضافة إلى الأقسام المفيدة الأخرى التي يجب على المستخدمين الموافقة عليها من أجل استخدام موقع الويب وتطبيقات الهاتف المحمول أو الوصول إليها.</pre>\r\n', '<pre>\r\nاتفاقية سياسة الخصوصية هي الاتفاقية التي تحدد فيها ما إذا كنت تجمع البيانات الشخصية ونوع البيانات الشخصية التي تجمعها من المستخدمين وماذا تفعل بهذه البيانات.</pre>\r\n', 1),
(9, 'pt', 'Português', 'portuguese', 'Portuguese', 'PT.png', '<h3>A&nbsp;<strong>Terms and Conditions agreement</strong>&nbsp;is the agreement that includes the terms, the rules and the guidelines of acceptable behavior, plus other useful sections, to which users must agree in order to use or access your website and mobile app.</h3>\r\n\r\n<p>&nbsp;</p>\r\n', '<p>A&nbsp;<strong>Privacy Policy agreement</strong>&nbsp;is the agreement where you specify if you collect personal data, what kind of personal data you collect from users and what you do with that data.</p>\r\n', 1),
(10, 'bn', 'বাঙালি', 'bengali', 'Bengali', 'BE.png', '<h3>A&nbsp;<strong>Terms and Conditions agreement</strong>&nbsp;is the agreement that includes the terms, the rules and the guidelines of acceptable behavior, plus other useful sections, to which users must agree in order to use or access your website and mobile app.</h3>\r\n\r\n<p>&nbsp;</p>\r\n', '<p>A&nbsp;<strong>Privacy Policy agreement</strong>&nbsp;is the agreement where you specify if you collect personal data, what kind of personal data you collect from users and what you do with that data.</p>\r\n', 1),
(11, 'ru', 'русский', 'russian', 'Russian', 'RU.png', '<pre>\r\nСоглашение об условиях - это соглашение, которое включает в себя условия, правила и руководящие принципы приемлемого поведения, а также другие полезные разделы, с которыми пользователи должны согласиться для использования или доступа к вашему веб-сайту и мобильному приложению.</pre>\r\n', '<pre>\r\nСоглашение о конфиденциальности - это соглашение, в котором вы указываете, собираете ли вы личные данные, какие личные данные вы собираете у пользователей и что вы делаете с этими данными.</pre>\r\n', 1),
(12, 'de', 'Deutsche', 'german', 'German', 'DE.png', '<pre>\r\nEine Nutzungsbedingungen-Vereinbarung umfasst die Bedingungen, Regeln und Richtlinien für akzeptables Verhalten sowie weitere nützliche Abschnitte, denen Benutzer zustimmen müssen, um Ihre Website und Ihre mobile App nutzen oder darauf zugreifen zu können.</pre>\r\n', '<pre>\r\nEine Datenschutzvereinbarung ist die Vereinbarung, in der Sie angeben, ob Sie personenbezogene Daten erfassen, welche Art von personenbezogenen Daten Sie von Benutzern erfassen und was Sie mit diesen Daten tun.</pre>\r\n', 1),
(13, 'fil', 'Filipino', 'filipino', 'Filipino', 'PH.png', '<h3>A&nbsp;<strong>Terms and Conditions agreement</strong>&nbsp;is the agreement that includes the terms, the rules and the guidelines of acceptable behavior, plus other useful sections, to which users must agree in order to use or access your website and mobile app.</h3>\n\n<p>&nbsp;</p>\n', '<p>A&nbsp;<strong>Privacy Policy agreement</strong>&nbsp;is the agreement where you specify if you collect personal data, what kind of personal data you collect from users and what you do with that data.</p>\n', 1),
(14, 'it', 'italiano', 'italian', 'Italian', 'IT.png', '<pre>\r\nUn accordo su termini e condizioni è l&#39;accordo che include i termini, le regole e le linee guida di comportamento accettabile, oltre ad altre sezioni utili, a cui gli utenti devono concordare per utilizzare o accedere al sito Web e all&#39;app mobile.</pre>\r\n', '<pre>\r\nUn accordo sulla privacy è l&#39;accordo in cui si specifica se si raccolgono dati personali, che tipo di dati personali si raccolgono dagli utenti e cosa si fa con tali dati.</pre>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_language_conversion`
--

CREATE TABLE `mlm_language_conversion` (
  `id` int(20) NOT NULL,
  `mlm_user_id` int(20) NOT NULL,
  `field_name` varchar(50) NOT NULL,
  `in_english` varchar(300) NOT NULL,
  `date` datetime NOT NULL,
  `conv_stat` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'conversion_status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_leads`
--

CREATE TABLE `mlm_leads` (
  `id` int(20) NOT NULL,
  `lead_user` int(20) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` int(20) DEFAULT NULL,
  `country` int(20) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_login_attempts`
--

CREATE TABLE `mlm_login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT 0,
  `type` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_login_attempts`
--

INSERT INTO `mlm_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`, `type`) VALUES
(1, '::1', '2021-03-26 10:00:26', 1, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_ltm_translations`
--

CREATE TABLE `mlm_ltm_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `locale` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `key` text NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `translation` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_mail_content`
--

CREATE TABLE `mlm_mail_content` (
  `id` int(11) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `content` text DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `content_type` varchar(150) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_mail_content`
--

INSERT INTO `mlm_mail_content` (`id`, `subject`, `content`, `lang_id`, `content_type`, `status`) VALUES
(1, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\r\n\r\n<p>               Thank you for joining us. You have successfully registered as a member at {company_name}.d</p>\r\n', 1, 'register_mail', 1),
(2, 'Compte enregistré avec succès', '<p>Salutations<strong> {username},</strong></p>\r\n\r\n<p>               Merci de nous avoir rejoint. Vous avez enregistré avec succès en tant que membre à {company_name}.</p>\r\n', 2, 'register_mail', 1),
(3, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a member at {company_name}.</p>\n', 3, 'register_mail', 1),
(4, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a member at {company_name}.</p>\n', 4, 'register_mail', 1),
(5, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a member at {company_name}.</p>\r\n', 5, 'register_mail', 1),
(6, 'Order confirmation', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for the order you have maid. This is the confirmation that your order has been successfully received and is currently under process.<br />\n&nbsp;</p>\n', 1, 'order_mail', 1),
(7, 'Confirmation de commande', '<p>Bonjour<strong> {username},</strong><br>\r\n         Merci pour la commande que vous avez maid. Ceci est la confirmation que votre commande a bien été reçue et qu&#39;elle est en cours de traitement.</p>\r\n', 2, 'order_mail', 1),
(8, 'Order confirmation', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for the order you have maid. This is the confirmation that your order has been successfully received and is currently under process.<br />\n&nbsp;</p>\n', 3, 'order_mail', 1),
(9, 'Order confirmation', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for the order you have maid. This is the confirmation that your order has been successfully received and is currently under process.<br />\n&nbsp;</p>\n', 4, 'order_mail', 1),
(10, 'Order confirmation', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for the order you have maid. This is the confirmation that your order has been successfully received and is currently under process.<br />\n&nbsp;</p>\n', 5, 'order_mail', 1),
(11, 'Reset Your Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\n', 1, 'forgot_password', 1),
(12, 'Réinitialisez votre mot de passe', '<p>Bonjour<strong> {username},</strong><br>\r\n         Nous vous avons vu récemment demander un nouveau mot de passe. Nous sommes là pour vous aider. Cliquez simplement sur le bouton ci-dessous pour réinitialiser votre mot de passe.</p>\r\n', 2, 'forgot_password', 1),
(13, 'Reset Your Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\n', 3, 'forgot_password', 1),
(14, 'Reset Your Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\n', 4, 'forgot_password', 1),
(15, 'Reset Your Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\n', 5, 'forgot_password', 1),
(16, 'Transaction Password', '<p><strong>Hello {username},</strong><br>\r\n          This is your ‘One Time Password’ for the transaction. Please go ahead with the payment.</p>\r\n\r\n<p>TRANSACTION PASSWORD : {transaction_password}</p>\r\n', 1, 'transaction_password', 1),
(17, 'Mot de passe de transaction', '<p>Bonjour<strong> {username},</strong><br>\r\n          C’est votre ‘mot de passe unique’ pour la transaction. S&#39;il vous plaît aller de l&#39;avant avec le paiement.<br>\r\n<br>\r\nMOT DE PASSE DE TRANSACTION : {transaction_password} </p>\r\n', 2, 'transaction_password', 1),
(18, 'Transaction Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is your &lsquo;One Time Password&rsquo; for the transaction. Please go ahead with the payment.</p>\n\n<p>TRANSACTION PASSWORD : {transaction_password}&nbsp;</p>\n', 3, 'transaction_password', 1),
(19, 'Transaction Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is your &lsquo;One Time Password&rsquo; for the transaction. Please go ahead with the payment.</p>\n\n<p>TRANSACTION PASSWORD : {transaction_password}&nbsp;</p>\n', 4, 'transaction_password', 1),
(20, 'Transaction Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is your &lsquo;One Time Password&rsquo; for the transaction. Please go ahead with the payment.</p>\n\n<p>TRANSACTION PASSWORD : {transaction_password}&nbsp;</p>\n', 5, 'transaction_password', 1),
(21, 'Fund Debited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your request is successfully completed and your account has been debited <strong>(&nbsp;{amount} )</strong> according to the details below.</p>\n\n<p>&nbsp;</p>\n', 1, 'fund_debit', 1),
(22, 'Fund Debited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your request is successfully completed and your account has been debited <strong>(&nbsp;{amount} )</strong> according to the details below.</p>\n\n<p>&nbsp;</p>\n', 2, 'fund_debit', 1),
(23, 'Fund Debited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your request is successfully completed and your account has been debited <strong>(&nbsp;{amount} )</strong> according to the details below.</p>\n\n<p>&nbsp;</p>\n', 3, 'fund_debit', 1),
(24, 'Fund Debited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your request is successfully completed and your account has been debited <strong>(&nbsp;{amount} )</strong> according to the details below.</p>\n\n<p>&nbsp;</p>\n', 4, 'fund_debit', 1),
(25, 'Fund Debited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your request is successfully completed and your account has been debited <strong>(&nbsp;{amount} )</strong> according to the details below.</p>\n\n<p>&nbsp;</p>\n', 5, 'fund_debit', 1),
(26, 'Fund Credited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your account has been credited <strong>(&nbsp;{amount}&nbsp;)</strong> successfully according to the details below.</p>\n', 1, 'fund_credit', 1),
(27, 'Fund Credited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your account has been credited <strong>(&nbsp;{amount}&nbsp;)</strong> successfully according to the details below.</p>\n', 2, 'fund_credit', 1),
(28, 'Fund Credited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your account has been credited <strong>(&nbsp;{amount}&nbsp;)</strong> successfully according to the details below.</p>\n', 3, 'fund_credit', 1),
(29, 'Fund Credited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your account has been credited <strong>(&nbsp;{amount}&nbsp;)</strong> successfully according to the details below.</p>\n', 4, 'fund_credit', 1),
(30, 'Fund Credited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your account has been credited <strong>(&nbsp;{amount}&nbsp;)</strong> successfully according to the details below.</p>\n', 5, 'fund_credit', 1),
(31, 'Verify Your Email Address', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; To be able to send Emails from this address, you must verify your email address. Your <strong>Verification Code</strong>&nbsp;:{verification_code}</p>\n', 1, 'send_verification_code', 1),
(32, 'Verify Your Email Address', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; To be able to send Emails from this address, you must verify your email address. Your <strong>Verification Code</strong>&nbsp;:{verification_code}</p>\n', 2, 'send_verification_code', 1),
(33, 'Verify Your Email Address', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; To be able to send Emails from this address, you must verify your email address. Your <strong>Verification Code</strong>&nbsp;:{verification_code}</p>\n', 3, 'send_verification_code', 1),
(34, 'Verify Your Email Address', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; To be able to send Emails from this address, you must verify your email address. Your <strong>Verification Code</strong>&nbsp;:{verification_code}</p>\n', 4, 'send_verification_code', 1),
(35, 'Verify Your Email Address', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; To be able to send Emails from this address, you must verify your email address. Your <strong>Verification Code</strong>&nbsp;:{verification_code}</p>\n', 5, 'send_verification_code', 1),
(36, 'Pending Orders', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Your order is currently under process. It will complete only after the payment and the admin approval.</p>\n', 1, 'pending_order_mail', 1),
(37, 'Pending Orders', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Your order is currently under process. It will complete only after the payment and the admin approval.</p>\n', 2, 'pending_order_mail', 1),
(38, 'Pending Orders', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Your order is currently under process. It will complete only after the payment and the admin approval.</p>\n', 3, 'pending_order_mail', 1),
(39, 'Pending Orders', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Your order is currently under process. It will complete only after the payment and the admin approval.</p>\n', 4, 'pending_order_mail', 1),
(40, 'Pending Orders', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Your order is currently under process. It will complete only after the payment and the admin approval.</p>\n', 5, 'pending_order_mail', 1),
(41, 'Pending Registration', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; Your &lsquo;Member Registration&rsquo; is under process. It will complete only after the payment and the admin approval.</p>\n', 1, 'pending_register_mail', 1),
(42, 'Pending Registration', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; Your &lsquo;Member Registration&rsquo; is under process. It will complete only after the payment and the admin approval.</p>\n', 2, 'pending_register_mail', 1),
(43, 'Pending Registration', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; Your &lsquo;Member Registration&rsquo; is under process. It will complete only after the payment and the admin approval.</p>\n', 3, 'pending_register_mail', 1),
(44, 'Pending Registration', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; Your &lsquo;Member Registration&rsquo; is under process. It will complete only after the payment and the admin approval.</p>\n', 4, 'pending_register_mail', 1),
(45, 'Pending Registration', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; Your &lsquo;Member Registration&rsquo; is under process. It will complete only after the payment and the admin approval.</p>\n', 5, 'pending_register_mail', 1),
(46, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a member at {company_name}.</p>\n', 6, 'register_mail', 1),
(47, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a member at {company_name}.</p>\n', 7, 'register_mail', 1),
(48, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a member at {company_name}.</p>\n', 8, 'register_mail', 1),
(49, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a member at {company_name}.</p>\n', 9, 'register_mail', 1),
(50, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a member at {company_name}.</p>\n', 10, 'register_mail', 1),
(51, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a member at {company_name}.</p>\n', 11, 'register_mail', 1),
(52, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a member at {company_name}.</p>\n', 12, 'register_mail', 1),
(53, 'Order confirmation', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for the order you have maid. This is the confirmation that your order has been successfully received and is currently under process.<br />\n&nbsp;</p>\n', 6, 'order_mail', 1),
(54, 'Order confirmation', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for the order you have maid. This is the confirmation that your order has been successfully received and is currently under process.<br />\n&nbsp;</p>\n', 7, 'order_mail', 1),
(55, 'Order confirmation', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for the order you have maid. This is the confirmation that your order has been successfully received and is currently under process.<br />\n&nbsp;</p>\n', 8, 'order_mail', 1),
(56, 'Order confirmation', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for the order you have maid. This is the confirmation that your order has been successfully received and is currently under process.<br />\n&nbsp;</p>\n', 9, 'order_mail', 1),
(57, 'Order confirmation', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for the order you have maid. This is the confirmation that your order has been successfully received and is currently under process.<br />\n&nbsp;</p>\n', 10, 'order_mail', 1),
(58, 'Order confirmation', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for the order you have maid. This is the confirmation that your order has been successfully received and is currently under process.<br />\n&nbsp;</p>\n', 11, 'order_mail', 1),
(59, 'Order confirmation', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for the order you have maid. This is the confirmation that your order has been successfully received and is currently under process.<br />\n&nbsp;</p>\n', 12, 'order_mail', 1),
(60, 'Reset Your Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\n', 6, 'forgot_password', 1),
(61, 'Reset Your Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\n', 7, 'forgot_password', 1),
(62, 'Reset Your Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\n', 8, 'forgot_password', 1),
(63, 'Reset Your Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\n', 9, 'forgot_password', 1),
(64, 'Reset Your Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\n', 10, 'forgot_password', 1),
(65, 'Reset Your Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\n', 11, 'forgot_password', 1),
(66, 'Reset Your Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\n', 12, 'forgot_password', 1),
(67, 'Transaction Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is your &lsquo;One Time Password&rsquo; for the transaction. Please go ahead with the payment.</p>\n\n<p>TRANSACTION PASSWORD : {transaction_password}&nbsp;</p>\n', 6, 'transaction_password', 1),
(68, 'Transaction Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is your &lsquo;One Time Password&rsquo; for the transaction. Please go ahead with the payment.</p>\n\n<p>TRANSACTION PASSWORD : {transaction_password}&nbsp;</p>\n', 7, 'transaction_password', 1),
(69, 'Transaction Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is your &lsquo;One Time Password&rsquo; for the transaction. Please go ahead with the payment.</p>\n\n<p>TRANSACTION PASSWORD : {transaction_password}&nbsp;</p>\n', 8, 'transaction_password', 1),
(70, 'Transaction Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is your &lsquo;One Time Password&rsquo; for the transaction. Please go ahead with the payment.</p>\n\n<p>TRANSACTION PASSWORD : {transaction_password}&nbsp;</p>\n', 9, 'transaction_password', 1),
(71, 'Transaction Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is your &lsquo;One Time Password&rsquo; for the transaction. Please go ahead with the payment.</p>\n\n<p>TRANSACTION PASSWORD : {transaction_password}&nbsp;</p>\n', 10, 'transaction_password', 1),
(72, 'Transaction Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is your &lsquo;One Time Password&rsquo; for the transaction. Please go ahead with the payment.</p>\n\n<p>TRANSACTION PASSWORD : {transaction_password}&nbsp;</p>\n', 11, 'transaction_password', 1),
(73, 'Transaction Password', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This is your &lsquo;One Time Password&rsquo; for the transaction. Please go ahead with the payment.</p>\n\n<p>TRANSACTION PASSWORD : {transaction_password}&nbsp;</p>\n', 12, 'transaction_password', 1),
(74, 'Fund Debited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your request is successfully completed and your account has been debited <strong>(&nbsp;{amount} )</strong> according to the details below.</p>\n\n<p>&nbsp;</p>\n', 6, 'fund_debit', 1),
(75, 'Fund Debited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your request is successfully completed and your account has been debited <strong>(&nbsp;{amount} )</strong> according to the details below.</p>\n\n<p>&nbsp;</p>\n', 7, 'fund_debit', 1),
(76, 'Fund Debited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your request is successfully completed and your account has been debited <strong>(&nbsp;{amount} )</strong> according to the details below.</p>\n\n<p>&nbsp;</p>\n', 8, 'fund_debit', 1),
(77, 'Fund Debited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your request is successfully completed and your account has been debited <strong>(&nbsp;{amount} )</strong> according to the details below.</p>\n\n<p>&nbsp;</p>\n', 9, 'fund_debit', 1),
(78, 'Fund Debited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your request is successfully completed and your account has been debited <strong>(&nbsp;{amount} )</strong> according to the details below.</p>\n\n<p>&nbsp;</p>\n', 10, 'fund_debit', 1),
(79, 'Fund Debited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your request is successfully completed and your account has been debited <strong>(&nbsp;{amount} )</strong> according to the details below.</p>\n\n<p>&nbsp;</p>\n', 11, 'fund_debit', 1),
(80, 'Fund Debited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your request is successfully completed and your account has been debited <strong>(&nbsp;{amount} )</strong> according to the details below.</p>\n\n<p>&nbsp;</p>\n', 12, 'fund_debit', 1),
(81, 'Fund Credited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your account has been credited <strong>(&nbsp;{amount}&nbsp;)</strong> successfully according to the details below.</p>\n', 6, 'fund_credit', 1),
(82, 'Fund Credited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your account has been credited <strong>(&nbsp;{amount}&nbsp;)</strong> successfully according to the details below.</p>\n', 7, 'fund_credit', 1),
(83, 'Fund Credited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your account has been credited <strong>(&nbsp;{amount}&nbsp;)</strong> successfully according to the details below.</p>\n', 8, 'fund_credit', 1),
(84, 'Fund Credited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your account has been credited <strong>(&nbsp;{amount}&nbsp;)</strong> successfully according to the details below.</p>\n', 9, 'fund_credit', 1),
(85, 'Fund Credited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your account has been credited <strong>(&nbsp;{amount}&nbsp;)</strong> successfully according to the details below.</p>\n', 10, 'fund_credit', 1),
(86, 'Fund Credited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your account has been credited <strong>(&nbsp;{amount}&nbsp;)</strong> successfully according to the details below.</p>\n', 11, 'fund_credit', 1),
(87, 'Fund Credited', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Your account has been credited <strong>(&nbsp;{amount}&nbsp;)</strong> successfully according to the details below.</p>\n', 12, 'fund_credit', 1),
(88, 'Verify Your Email Address', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; To be able to send Emails from this address, you must verify your email address. Your <strong>Verification Code</strong>&nbsp;:{verification_code}</p>\n', 6, 'send_verification_code', 1),
(89, 'Verify Your Email Address', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; To be able to send Emails from this address, you must verify your email address. Your <strong>Verification Code</strong>&nbsp;:{verification_code}</p>\n', 7, 'send_verification_code', 1),
(90, 'Verify Your Email Address', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; To be able to send Emails from this address, you must verify your email address. Your <strong>Verification Code</strong>&nbsp;:{verification_code}</p>\n', 8, 'send_verification_code', 1),
(91, 'Verify Your Email Address', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; To be able to send Emails from this address, you must verify your email address. Your <strong>Verification Code</strong>&nbsp;:{verification_code}</p>\n', 9, 'send_verification_code', 1),
(92, 'Verify Your Email Address', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; To be able to send Emails from this address, you must verify your email address. Your <strong>Verification Code</strong>&nbsp;:{verification_code}</p>\n', 10, 'send_verification_code', 1),
(93, 'Verify Your Email Address', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; To be able to send Emails from this address, you must verify your email address. Your <strong>Verification Code</strong>&nbsp;:{verification_code}</p>\n', 11, 'send_verification_code', 1),
(94, 'Verify Your Email Address', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; To be able to send Emails from this address, you must verify your email address. Your <strong>Verification Code</strong>&nbsp;:{verification_code}</p>\n', 12, 'send_verification_code', 1),
(95, 'Pending Orders', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Your order is currently under process. It will complete only after the payment and the admin approval.</p>\n', 6, 'pending_order_mail', 1),
(96, 'Pending Orders', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Your order is currently under process. It will complete only after the payment and the admin approval.</p>\n', 7, 'pending_order_mail', 1),
(97, 'Pending Orders', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Your order is currently under process. It will complete only after the payment and the admin approval.</p>\n', 8, 'pending_order_mail', 1),
(98, 'Pending Orders', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Your order is currently under process. It will complete only after the payment and the admin approval.</p>\n', 9, 'pending_order_mail', 1),
(99, 'Pending Orders', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Your order is currently under process. It will complete only after the payment and the admin approval.</p>\n', 10, 'pending_order_mail', 1),
(100, 'Pending Orders', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Your order is currently under process. It will complete only after the payment and the admin approval.</p>\n', 11, 'pending_order_mail', 1),
(101, 'Pending Orders', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Your order is currently under process. It will complete only after the payment and the admin approval.</p>\n', 12, 'pending_order_mail', 1),
(102, 'Pending Registration', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; Your &lsquo;Member Registration&rsquo; is under process. It will complete only after the payment and the admin approval.</p>\n', 6, 'pending_register_mail', 1),
(103, 'Pending Registration', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; Your &lsquo;Member Registration&rsquo; is under process. It will complete only after the payment and the admin approval.</p>\n', 7, 'pending_register_mail', 1),
(104, 'Pending Registration', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; Your &lsquo;Member Registration&rsquo; is under process. It will complete only after the payment and the admin approval.</p>\n', 8, 'pending_register_mail', 1),
(105, 'Pending Registration', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; Your &lsquo;Member Registration&rsquo; is under process. It will complete only after the payment and the admin approval.</p>\n', 9, 'pending_register_mail', 1),
(106, 'Pending Registration', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; Your &lsquo;Member Registration&rsquo; is under process. It will complete only after the payment and the admin approval.</p>\n', 10, 'pending_register_mail', 1),
(107, 'Pending Registration', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; Your &lsquo;Member Registration&rsquo; is under process. It will complete only after the payment and the admin approval.</p>\n', 11, 'pending_register_mail', 1),
(108, 'Pending Registration', '<p><strong>Hello {username},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; Your &lsquo;Member Registration&rsquo; is under process. It will complete only after the payment and the admin approval.</p>\n', 12, 'pending_register_mail', 1),
(109, 'Lead Capture', '<p><strong>Hello {fullname}</strong><strong>,</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for your email. Your message is important &nbsp;to&nbsp;<strong>Me</strong>&nbsp;and&nbsp;<strong>I</strong>&nbsp;will respond as soon as possible.</p>\n', 1, 'lcp', 1),
(110, 'Lead Capture', '<p><strong>Hello {fullname}</strong><strong>,</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for your email. Your message is important &nbsp;to&nbsp;<strong>Me</strong>&nbsp;and&nbsp;<strong>I</strong>&nbsp;will respond as soon as possible.</p>\n', 2, 'lcp', 1),
(111, 'Lead Capture', '<p><strong>Hello {fullname}</strong><strong>,</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for your email. Your message is important &nbsp;to&nbsp;<strong>Me</strong>&nbsp;and&nbsp;<strong>I</strong>&nbsp;will respond as soon as possible.</p>\n', 3, 'lcp', 1),
(112, 'Lead Capture', '<p><strong>Hello {fullname}</strong><strong>,</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for your email. Your message is important &nbsp;to&nbsp;<strong>Me</strong>&nbsp;and&nbsp;<strong>I</strong>&nbsp;will respond as soon as possible.</p>\n', 4, 'lcp', 1),
(113, 'Lead Capture', '<p><strong>Hello {fullname}</strong><strong>,</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for your email. Your message is important &nbsp;to&nbsp;<strong>Me</strong>&nbsp;and&nbsp;<strong>I</strong>&nbsp;will respond as soon as possible.</p>\n', 5, 'lcp', 1),
(114, 'Lead Capture', '<p><strong>Hello {fullname}</strong><strong>,</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for your email. Your message is important &nbsp;to&nbsp;<strong>Me</strong>&nbsp;and&nbsp;<strong>I</strong>&nbsp;will respond as soon as possible.</p>\n', 6, 'lcp', 1),
(115, 'Lead Capture', '<p><strong>Hello {fullname}</strong><strong>,</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for your email. Your message is important &nbsp;to&nbsp;<strong>Me</strong>&nbsp;and&nbsp;<strong>I</strong>&nbsp;will respond as soon as possible.</p>\n', 7, 'lcp', 1),
(116, 'Lead Capture', '<p><strong>Hello {fullname}</strong><strong>,</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for your email. Your message is important &nbsp;to&nbsp;<strong>Me</strong>&nbsp;and&nbsp;<strong>I</strong>&nbsp;will respond as soon as possible.</p>\n', 8, 'lcp', 1),
(117, 'Lead Capture', '<p><strong>Hello {fullname}</strong><strong>,</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for your email. Your message is important &nbsp;to&nbsp;<strong>Me</strong>&nbsp;and&nbsp;<strong>I</strong>&nbsp;will respond as soon as possible.</p>\n', 9, 'lcp', 1),
(118, 'Lead Capture', '<p><strong>Hello {fullname}</strong><strong>,</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for your email. Your message is important &nbsp;to&nbsp;<strong>Me</strong>&nbsp;and&nbsp;<strong>I</strong>&nbsp;will respond as soon as possible.</p>\n', 10, 'lcp', 1),
(119, 'Lead Capture', '<p><strong>Hello {fullname}</strong><strong>,</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for your email. Your message is important &nbsp;to&nbsp;<strong>Me</strong>&nbsp;and&nbsp;<strong>I</strong>&nbsp;will respond as soon as possible.</p>\n', 11, 'lcp', 1),
(120, 'Lead Capture', '<p><strong>Hello {fullname}</strong><strong>,</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for your email. Your message is important &nbsp;to&nbsp;<strong>Me</strong>&nbsp;and&nbsp;<strong>I</strong>&nbsp;will respond as soon as possible.</p>\n', 12, 'lcp', 1),
(121, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a affiliate at {company_name}.</p>\n', 1, 'affiliate_mail', 1),
(122, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a affiliate at {company_name}.</p>\n', 2, 'affiliate_mail', 1),
(123, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a affiliate at {company_name}.</p>\n', 3, 'affiliate_mail', 1),
(124, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a affiliate at {company_name}.</p>\n', 4, 'affiliate_mail', 1),
(125, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a affiliate at {company_name}.</p>\n', 5, 'affiliate_mail', 1),
(126, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a affiliate at {company_name}.</p>\n', 6, 'affiliate_mail', 1),
(127, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a affiliate at {company_name}.</p>\n', 7, 'affiliate_mail', 1),
(128, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a affiliate at {company_name}.</p>\n', 8, 'affiliate_mail', 1),
(129, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a affiliate at {company_name}.</p>\n', 9, 'affiliate_mail', 1),
(130, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a affiliate at {company_name}.</p>\n', 10, 'affiliate_mail', 1),
(131, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a affiliate at {company_name}.</p>\n', 11, 'affiliate_mail', 1),
(132, 'Account Registered Successfully', '<p><strong>Greetings {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Thank you for joining us. You have successfully registered as a affiliate at {company_name}.</p>\n', 12, 'affiliate_mail', 1),
(133, 'Temporarily  down for maintenance', '<p><strong>Greetings {username}, </strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We are performing scheduled maintenance. We should be back online shortly.</p>\n', 1, 'maintanance_mail', 1),
(134, 'Temporarily  down for maintenance', '<p><strong>Greetings {username}, </strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We are performing scheduled maintenance. We should be back online shortly.</p>\n', 2, 'maintanance_mail', 1),
(135, 'Temporarily  down for maintenance', '<p><strong>Greetings {username}, </strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We are performing scheduled maintenance. We should be back online shortly.</p>\n', 3, 'maintanance_mail', 1),
(136, 'Temporarily  down for maintenance', '<p><strong>Greetings {username}, </strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We are performing scheduled maintenance. We should be back online shortly.</p>\n', 4, 'maintanance_mail', 1),
(137, 'Temporarily  down for maintenance', '<p><strong>Greetings {username}, </strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We are performing scheduled maintenance. We should be back online shortly.</p>\n', 5, 'maintanance_mail', 1),
(138, 'Temporarily  down for maintenance', '<p><strong>Greetings {username}, </strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We are performing scheduled maintenance. We should be back online shortly.</p>\n', 6, 'maintanance_mail', 1),
(139, 'Temporarily  down for maintenance', '<p><strong>Greetings {username}, </strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We are performing scheduled maintenance. We should be back online shortly.</p>\n', 7, 'maintanance_mail', 1),
(140, 'Temporarily  down for maintenance', '<p><strong>Greetings {username}, </strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We are performing scheduled maintenance. We should be back online shortly.</p>\n', 8, 'maintanance_mail', 1),
(141, 'Temporarily  down for maintenance', '<p><strong>Greetings {username}, </strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We are performing scheduled maintenance. We should be back online shortly.</p>\n', 9, 'maintanance_mail', 1),
(142, 'Temporarily  down for maintenance', '<p><strong>Greetings {username}, </strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We are performing scheduled maintenance. We should be back online shortly.</p>\n', 10, 'maintanance_mail', 1),
(143, 'Temporarily  down for maintenance', '<p><strong>Greetings {username}, </strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We are performing scheduled maintenance. We should be back online shortly.</p>\n', 11, 'maintanance_mail', 1),
(144, 'Temporarily  down for maintenance', '<p><strong>Greetings {username}, </strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We are performing scheduled maintenance. We should be back online shortly.</p>\n', 12, 'maintanance_mail', 1),
(145, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 1, 'employee_forgot_password', 1),
(146, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 2, 'employee_forgot_password', 1),
(147, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 3, 'employee_forgot_password', 1),
(148, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 4, 'employee_forgot_password', 1),
(149, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 5, 'employee_forgot_password', 1),
(150, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\n', 6, 'employee_forgot_password', 1),
(151, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 7, 'employee_forgot_password', 1),
(152, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 8, 'employee_forgot_password', 1),
(153, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 9, 'employee_forgot_password', 1),
(154, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 10, 'employee_forgot_password', 1),
(155, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 11, 'employee_forgot_password', 1),
(156, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 12, 'employee_forgot_password', 1),
(157, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 1, 'affiliate_forgot_password', 1),
(158, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 2, 'affiliate_forgot_password', 1),
(159, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 3, 'affiliate_forgot_password', 1),
(160, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 4, 'affiliate_forgot_password', 1),
(161, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 5, 'affiliate_forgot_password', 1),
(162, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 6, 'affiliate_forgot_password', 1),
(163, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 7, 'affiliate_forgot_password', 1),
(164, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 8, 'affiliate_forgot_password', 1),
(165, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 9, 'affiliate_forgot_password', 1),
(166, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 10, 'affiliate_forgot_password', 1),
(167, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 11, 'affiliate_forgot_password', 1),
(168, 'Reset Your Password', '<p><strong>Hello {username},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;We saw you recently requested a new password. We are here to help you. Simply click on the button below to reset your password.</p>\r\n', 12, 'affiliate_forgot_password', 1),
(169, 'Meeting Shedule', '<p><strong>Hello {fullname},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Your Enquiry is under process. Please Set Convenient Time for a meeting by clicking the below link.</p>\n', 1, 'meeting_shedule', 1),
(170, 'Meeting Shedule', '<p><strong>Hello {fullname},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Your Enquiry is under process. Please Set Convenient Time for a meeting by clicking the below link.</p>\n', 2, 'meeting_shedule', 1),
(171, 'Meeting Shedule', '<p><strong>Hello {fullname},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Your Enquiry is under process. Please Set Convenient Time for a meeting by clicking the below link.</p>\n', 3, 'meeting_shedule', 1),
(172, 'Meeting Shedule', '<p><strong>Hello {fullname},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Your Enquiry is under process. Please Set Convenient Time for a meeting by clicking the below link.</p>\n', 4, 'meeting_shedule', 1),
(173, 'Meeting Shedule', '<p><strong>Hello {fullname},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Your Enquiry is under process. Please Set Convenient Time for a meeting by clicking the below link.</p>\n', 5, 'meeting_shedule', 1),
(174, 'Meeting Shedule', '<p><strong>Hello {fullname},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Your Enquiry is under process. Please Set Convenient Time for a meeting by clicking the below link.</p>\n', 6, 'meeting_shedule', 1),
(175, 'Meeting Shedule', '<p><strong>Hello {fullname},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Your Enquiry is under process. Please Set Convenient Time for a meeting by clicking the below link.</p>\n', 7, 'meeting_shedule', 1),
(176, 'Meeting Shedule', '<p><strong>Hello {fullname},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Your Enquiry is under process. Please Set Convenient Time for a meeting by clicking the below link.</p>\n', 8, 'meeting_shedule', 1),
(177, 'Meeting Shedule', '<p><strong>Hello {fullname},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Your Enquiry is under process. Please Set Convenient Time for a meeting by clicking the below link.</p>\n', 9, 'meeting_shedule', 1),
(178, 'Meeting Shedule', '<p><strong>Hello {fullname},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Your Enquiry is under process. Please Set Convenient Time for a meeting by clicking the below link.</p>\n', 10, 'meeting_shedule', 1),
(179, 'Meeting Shedule', '<p><strong>Hello {fullname},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Your Enquiry is under process. Please Set Convenient Time for a meeting by clicking the below link.</p>\n', 11, 'meeting_shedule', 1),
(180, 'Meeting Shedule', '<p><strong>Hello {fullname},</strong><br />\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Your Enquiry is under process. Please Set Convenient Time for a meeting by clicking the below link.</p>\n', 12, 'meeting_shedule', 1),
(181, 'Schedule Confirmed', '<p><strong>Greetings {fullname},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;One of your enquiry<strong>({enquiry_id})</strong> successfully sheduled.</p>\r\n', 1, 'shedule_confirmation', 1);
INSERT INTO `mlm_mail_content` (`id`, `subject`, `content`, `lang_id`, `content_type`, `status`) VALUES
(182, 'Schedule Confirmed', '<p><strong>Greetings {fullname},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;One of your enquiry<strong>({enquiry_id})</strong> successfully sheduled.</p>\r\n', 2, 'shedule_confirmation', 1),
(183, 'Schedule Confirmed', '<p><strong>Greetings {fullname},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;One of your enquiry<strong>({enquiry_id})</strong> successfully sheduled.</p>\r\n', 3, 'shedule_confirmation', 1),
(184, 'Schedule Confirmed', '<p><strong>Greetings {fullname},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;One of your enquiry<strong>({enquiry_id})</strong> successfully sheduled.</p>\r\n', 4, 'shedule_confirmation', 1),
(185, 'Schedule Confirmed', '<p><strong>Greetings {fullname},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;One of your enquiry<strong>({enquiry_id})</strong> successfully sheduled.</p>\r\n', 5, 'shedule_confirmation', 1),
(186, 'Schedule Confirmed', '<p><strong>Greetings {fullname},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;One of your enquiry<strong>({enquiry_id})</strong> successfully sheduled.</p>\r\n', 6, 'shedule_confirmation', 1),
(187, 'Schedule Confirmed', '<p><strong>Greetings {fullname},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;One of your enquiry<strong>({enquiry_id})</strong> successfully sheduled.</p>\r\n', 7, 'shedule_confirmation', 1),
(188, 'Schedule Confirmed', '<p><strong>Greetings {fullname},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;One of your enquiry<strong>({enquiry_id})</strong> successfully sheduled.</p>\r\n', 8, 'shedule_confirmation', 1),
(189, 'Schedule Confirmed', '<p><strong>Greetings {fullname},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;One of your enquiry<strong>({enquiry_id})</strong> successfully sheduled.</p>\r\n', 9, 'shedule_confirmation', 1),
(190, 'Schedule Confirmed', '<p><strong>Greetings {fullname},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;One of your enquiry<strong>({enquiry_id})</strong> successfully sheduled.</p>\r\n', 10, 'shedule_confirmation', 1),
(191, 'Schedule Confirmed', '<p><strong>Greetings {fullname},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;One of your enquiry<strong>({enquiry_id})</strong> successfully sheduled.</p>\r\n', 11, 'shedule_confirmation', 1),
(192, 'Schedule Confirmed', '<p><strong>Greetings {fullname},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;One of your enquiry<strong>({enquiry_id})</strong> successfully sheduled.</p>\r\n', 12, 'shedule_confirmation', 1),
(193, 'New Order Placed', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Order Placed Successfully.</p>\r\n', 1, 'new_order_mail', 1),
(194, 'New Order Placed', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Order Placed Successfully.</p>\r\n', 2, 'new_order_mail', 1),
(195, 'New Order Placed', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Order Placed Successfully.</p>\r\n', 3, 'new_order_mail', 1),
(196, 'New Order Placed', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Order Placed Successfully.</p>\r\n', 4, 'new_order_mail', 1),
(197, 'New Order Placed', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Order Placed Successfully.</p>\r\n', 5, 'new_order_mail', 1),
(198, 'New Order Placed', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Order Placed Successfully.</p>\r\n', 6, 'new_order_mail', 1),
(199, 'New Order Placed', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Order Placed Successfully.</p>\r\n', 7, 'new_order_mail', 1),
(200, 'New Order Placed', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Order Placed Successfully.</p>\r\n', 8, 'new_order_mail', 1),
(201, 'New Order Placed', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Order Placed Successfully.</p>\r\n', 9, 'new_order_mail', 1),
(202, 'New Order Placed', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Order Placed Successfully.</p>\r\n', 10, 'new_order_mail', 1),
(203, 'New Order Placed', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Order Placed Successfully.</p>\r\n', 11, 'new_order_mail', 1),
(204, 'New Order Placed', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New Order Placed Successfully.</p>\r\n', 12, 'new_order_mail', 1),
(205, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\r\n', 1, 'new_register_mail', 1),
(206, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\r\n', 2, 'new_register_mail', 1),
(207, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\r\n', 3, 'new_register_mail', 1),
(208, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\r\n', 4, 'new_register_mail', 1),
(209, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\r\n', 5, 'new_register_mail', 1),
(210, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\r\n', 6, 'new_register_mail', 1),
(211, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\r\n', 7, 'new_register_mail', 1),
(212, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\r\n', 8, 'new_register_mail', 1),
(213, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\r\n', 9, 'new_register_mail', 1),
(214, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\r\n', 10, 'new_register_mail', 1),
(215, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\r\n', 11, 'new_register_mail', 1),
(216, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\n', 12, 'new_register_mail', 1),
(217, 'register_mail_subject -Filipino', 'register_mail_content -Filipino', 13, 'register_mail', 1),
(218, 'register_mail_subject -Italian', 'register_mail_content -Italian', 14, 'register_mail', 1),
(219, 'order_mail_subject -Filipino', 'order_mail_content -Filipino', 13, 'order_mail', 1),
(220, 'order_mail_subject -Italian', 'order_mail_content -Italian', 14, 'order_mail', 1),
(221, 'forgot_password_subject -Filipino', 'forgot_password_content -Filipino', 13, 'forgot_password', 1),
(222, 'forgot_password_subject -Italian', 'forgot_password_content -Italian', 14, 'forgot_password', 1),
(223, 'transaction_password_subject -Filipino', 'transaction_password_content -Filipino', 13, 'transaction_password', 1),
(224, 'transaction_password_subject -Italian', 'transaction_password_content -Italian', 14, 'transaction_password', 1),
(225, 'fund_debit_subject -Filipino', 'fund_debit_content -Filipino', 13, 'fund_debit', 1),
(226, 'fund_debit_subject -Italian', 'fund_debit_content -Italian', 14, 'fund_debit', 1),
(227, 'fund_credit_subject -Filipino', 'fund_credit_content -Filipino', 13, 'fund_credit', 1),
(228, 'fund_credit_subject -Italian', 'fund_credit_content -Italian', 14, 'fund_credit', 1),
(229, 'send_verification_code_subject -Filipino', 'send_verification_code_content -Filipino', 13, 'send_verification_code', 1),
(230, 'send_verification_code_subject -Italian', 'send_verification_code_content -Italian', 14, 'send_verification_code', 1),
(231, 'pending_order_mail_subject -Filipino', 'pending_order_mail_content -Filipino', 13, 'pending_order_mail', 1),
(232, 'pending_order_mail_subject -Italian', 'pending_order_mail_content -Italian', 14, 'pending_order_mail', 1),
(233, 'pending_register_mail_subject -Filipino', 'pending_register_mail_content -Filipino', 13, 'pending_register_mail', 1),
(234, 'pending_register_mail_subject -Italian', 'pending_register_mail_content -Italian', 14, 'pending_register_mail', 1),
(235, 'lcp_subject -Filipino', 'lcp_content -Filipino', 13, 'lcp', 1),
(236, 'lcp_subject -Italian', 'lcp_content -Italian', 14, 'lcp', 1),
(237, 'affiliate_mail_subject -Filipino', 'affiliate_mail_content -Filipino', 13, 'affiliate_mail', 1),
(238, 'affiliate_mail_subject -Italian', 'affiliate_mail_content -Italian', 14, 'affiliate_mail', 1),
(239, 'maintanance_mail_subject -Filipino', 'maintanance_mail_content -Filipino', 13, 'maintanance_mail', 1),
(240, 'maintanance_mail_subject -Italian', 'maintanance_mail_content -Italian', 14, 'maintanance_mail', 1),
(241, 'employee_forgot_password_subject -Filipino', 'employee_forgot_password_content -Filipino', 13, 'employee_forgot_password', 1),
(242, 'employee_forgot_password_subject -Italian', 'employee_forgot_password_content -Italian', 14, 'employee_forgot_password', 1),
(243, 'affiliate_forgot_password_subject -Filipino', 'affiliate_forgot_password_content -Filipino', 13, 'affiliate_forgot_password', 1),
(244, 'affiliate_forgot_password_subject -Italian', 'affiliate_forgot_password_content -Italian', 14, 'affiliate_forgot_password', 1),
(245, 'meeting_shedule_subject -Filipino', 'meeting_shedule_content -Filipino', 13, 'meeting_shedule', 1),
(246, 'meeting_shedule_subject -Italian', 'meeting_shedule_content -Italian', 14, 'meeting_shedule', 1),
(247, 'shedule_confirmation_subject -Filipino', 'shedule_confirmation_content -Filipino', 13, 'shedule_confirmation', 1),
(248, 'shedule_confirmation_subject -Italian', 'shedule_confirmation_content -Italian', 14, 'shedule_confirmation', 1),
(249, 'new_order_mail_subject -Filipino', 'new_order_mail_content -Filipino', 13, 'new_order_mail', 1),
(250, 'new_order_mail_subject -Italian', 'new_order_mail_content -Italian', 14, 'new_order_mail', 1),
(251, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\n', 13, 'new_register_mail', 1),
(252, 'New User Added', '<p><strong>Greetings {admin},</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; New User Registered Successfully.</p>\n', 14, 'new_register_mail', 1),
(253, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\r\n\r\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\r\n', 1, 'otp', 1),
(254, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\n\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\n', 2, 'otp', 1),
(255, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\n\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\n', 3, 'otp', 1),
(256, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\n\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\n', 4, 'otp', 1),
(257, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\n\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\n', 5, 'otp', 1),
(258, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\n\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\n', 6, 'otp', 1),
(259, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\n\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\n', 7, 'otp', 1),
(260, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\n\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\n', 8, 'otp', 1),
(261, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\n\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\n', 9, 'otp', 1),
(262, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\n\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\n', 10, 'otp', 1),
(263, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\n\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\n', 11, 'otp', 1),
(264, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\n\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\n', 12, 'otp', 1),
(265, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\n\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\n', 13, 'otp', 1),
(266, 'OTP For Transaction', '<p><strong>Hi {username},</strong></p>\n\n<p>               You need an OTP to access {operation} ,The OTP is {otp_code} .</p>\n', 14, 'otp', 1),
(267, 'TICKET CREATED', '<p><strong><tt>{username} has created a ticket {ticket_id}</tt></strong></p>\r\n', 1, 'ticket_mail', 1),
(268, 'ticket_mail_subject -français', 'ticket_mail_content -français', 2, 'ticket_mail', 1),
(269, 'ticket_mail_subject -മലയാളം', 'ticket_mail_content -മലയാളം', 3, 'ticket_mail', 1),
(270, 'ticket_mail_subject -日本人', 'ticket_mail_content -日本人', 4, 'ticket_mail', 1),
(271, 'ticket_mail_subject -中文', 'ticket_mail_content -中文', 5, 'ticket_mail', 1),
(272, 'ticket_mail_subject -Español', 'ticket_mail_content -Español', 6, 'ticket_mail', 1),
(273, 'ticket_mail_subject -हिंदी', 'ticket_mail_content -हिंदी', 7, 'ticket_mail', 1),
(274, 'ticket_mail_subject -عربى', 'ticket_mail_content -عربى', 8, 'ticket_mail', 1),
(275, 'ticket_mail_subject -Português', 'ticket_mail_content -Português', 9, 'ticket_mail', 1),
(276, 'ticket_mail_subject -বাঙালি', 'ticket_mail_content -বাঙালি', 10, 'ticket_mail', 1),
(277, 'ticket_mail_subject -русский', 'ticket_mail_content -русский', 11, 'ticket_mail', 1),
(278, 'ticket_mail_subject -Deutsche', 'ticket_mail_content -Deutsche', 12, 'ticket_mail', 1),
(279, 'ticket_mail_subject -Filipino', 'ticket_mail_content -Filipino', 13, 'ticket_mail', 1),
(280, 'ticket_mail_subject -italiano', 'ticket_mail_content -italiano', 14, 'ticket_mail', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_mail_settings`
--

CREATE TABLE `mlm_mail_settings` (
  `id` int(11) NOT NULL,
  `mail_engine` varchar(35) NOT NULL,
  `from_mail` varchar(50) NOT NULL,
  `host_name` varchar(30) DEFAULT NULL,
  `smtp_password` varchar(35) DEFAULT NULL,
  `smtp_username` varchar(35) DEFAULT NULL,
  `smtp_port` bigint(20) DEFAULT NULL,
  `from_email` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_mail_settings`
--

INSERT INTO `mlm_mail_settings` (`id`, `mail_engine`, `from_mail`, `host_name`, `smtp_password`, `smtp_username`, `smtp_port`, `from_email`) VALUES
(1, 'mail', '', '', '', '', 0, 'info@leadmlm.in');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_mail_system`
--

CREATE TABLE `mlm_mail_system` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `attachment_name` varchar(30) DEFAULT NULL,
  `catagories` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `read_status` varchar(20) NOT NULL,
  `stared` varchar(20) NOT NULL DEFAULT 'no',
  `spam` varchar(20) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_mail_system`
--

INSERT INTO `mlm_mail_system` (`id`, `user_id`, `from_id`, `subject`, `content`, `attachment_name`, `catagories`, `date`, `read_status`, `stared`, `spam`) VALUES
(1, 1902, 1900, 'asddaasda', 'ddasdadada', '', 'inbox', '2022-02-28 05:28:24', 'unread', 'no', 'no'),
(2, 1900, 1902, 'asddaasda', 'ddasdadada', '', 'inbox', '2022-02-28 05:28:24', 'unread', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_matching_bonus`
--

CREATE TABLE `mlm_matching_bonus` (
  `id` int(20) NOT NULL,
  `level` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `percentage` float(16,8) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_matching_bonus`
--

INSERT INTO `mlm_matching_bonus` (`id`, `level`, `name`, `percentage`, `status`) VALUES
(1, 1, 'perc_mb_1', 1.00000000, 1),
(2, 2, 'perc_mb_2', 2.00000000, 1),
(3, 3, 'perc_mb_3', 3.00000000, 1),
(4, 4, 'perc_mb_4', 4.00000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_matrix_level_bonus_settings`
--

CREATE TABLE `mlm_matrix_level_bonus_settings` (
  `id` int(20) NOT NULL,
  `level` int(10) NOT NULL,
  `fixed_name` varchar(10) NOT NULL,
  `perc_name` varchar(10) NOT NULL,
  `bonus_type` varchar(10) NOT NULL DEFAULT 'fixed',
  `fixed` double NOT NULL,
  `percentage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_matrix_level_bonus_settings`
--

INSERT INTO `mlm_matrix_level_bonus_settings` (`id`, `level`, `fixed_name`, `perc_name`, `bonus_type`, `fixed`, `percentage`) VALUES
(1, 1, 'fixed_1', 'perc_1', 'fixed', 1, 6),
(2, 2, 'fixed_2', 'perc_2', 'fixed', 2, 7),
(3, 3, 'fixed_3', 'perc_3', 'fixed', 3, 8),
(4, 4, 'fixed_4', 'perc_4', 'fixed', 4, 9),
(7, 5, 'fixed_5', 'perc_5', 'fixed', 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_menus`
--

CREATE TABLE `mlm_menus` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `link` varchar(100) NOT NULL DEFAULT '#',
  `original_link` varchar(60) NOT NULL COMMENT 'For Language',
  `permission` int(2) NOT NULL DEFAULT 3 COMMENT '1:admin,2:user,3:both,4:affiliate',
  `root_id` varchar(11) NOT NULL DEFAULT '#',
  `icon` varchar(30) NOT NULL,
  `admin_permission` tinyint(1) NOT NULL DEFAULT 1,
  `user_permission` tinyint(1) NOT NULL DEFAULT 1,
  `employee_permission` tinyint(1) DEFAULT 1,
  `affiliate_permission` tinyint(1) DEFAULT 1,
  `affiliate_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'FOR MENU MANAGEMENT',
  `order` int(11) NOT NULL DEFAULT 1,
  `target` varchar(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `lock` tinyint(1) NOT NULL DEFAULT 0,
  `basic_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_menus`
--

INSERT INTO `mlm_menus` (`id`, `name`, `link`, `original_link`, `permission`, `root_id`, `icon`, `admin_permission`, `user_permission`, `employee_permission`, `affiliate_permission`, `affiliate_status`, `order`, `target`, `status`, `lock`, `basic_status`) VALUES
(1, 'Dashboard', 'dashboard', 'home/index', 3, '#', 'fa-home', 1, 1, 1, 1, 0, 1, NULL, 1, 0, 1),
(2, 'Tree', '#', '#', 3, '#', 'fa-sitemap', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 1),
(3, 'Register', '../packages', 'register/packages', 3, '#', 'fa-user-plus', 1, 1, 1, 0, 0, 3, NULL, 1, 0, 1),
(4, 'Profile', 'profile-view', 'profile/index', 3, '#', 'fa-user', 1, 1, 1, 1, 1, 5, NULL, 1, 0, 1),
(5, 'Mail System', 'inbox', 'mail/inbox', 3, '#', 'fa-envelope', 1, 1, 1, 0, 0, 17, NULL, 1, 0, 1),
(6, 'Employee', '#', '#', 1, '#', 'fa fa-male', 1, 0, 1, 0, 0, 14, NULL, 1, 0, 0),
(8, 'E-Pin Management', 'e-pin-manage', 'epin/epin_management', 3, '145', 'fa fa-connectdevelop', 1, 1, 1, 0, 0, 4, NULL, 1, 0, 0),
(9, 'Module Status', 'module-view', 'modules/index', 1, '145', '', 1, 0, 1, 0, 0, 3, NULL, 1, 0, 1),
(11, 'Cart', '../shopping-cart', 'cart/index', 3, '185', 'fa-shopping-cart', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 1),
(12, 'Cart View', '../shopping-view', 'cart/view', 0, '11', '', 1, 1, 1, 0, 0, 21, NULL, 1, 0, 1),
(13, 'Cart Checkout', '../shopping-checkout', 'cart/checkout', 0, '11', '', 1, 1, 1, 0, 0, 22, NULL, 1, 0, 1),
(14, 'News', '#', '#', 3, '24', 'fa-file', 1, 1, 1, 1, 1, 1, NULL, 1, 0, 1),
(15, 'Excel Migration', 'migrate-data', 'migration/view_data', 0, '95', '', 1, 0, 1, 0, 0, 1, NULL, 1, 0, 1),
(16, 'Promotional Tools', 'promotion-view', 'promotion/index', 3, '24', '', 1, 1, 1, 0, 0, 4, NULL, 1, 0, 0),
(17, 'Documents', '#', '#', 3, '24', 'fa-files-o', 1, 1, 1, 1, 0, 2, NULL, 1, 0, 1),
(18, 'Fund Management', 'transfer-funds', 'wallet/fund_transfer', 3, '59', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 1),
(19, 'Settings', '#', '#', 1, '#', 'fa-cogs', 1, 0, 1, 0, 0, 10, NULL, 1, 0, 1),
(20, 'Member Management', '#', '#', 3, '#', 'fa-users', 1, 1, 1, 0, 0, 11, NULL, 1, 0, 1),
(21, 'Product Management', 'product-manage', 'product/product_management', 1, '145', '', 1, 0, 1, 0, 0, 1, NULL, 1, 0, 1),
(22, 'Mail Settings', '#', '#', 1, '145', '', 1, 0, 1, 0, 0, 8, NULL, 1, 0, 1),
(23, 'Report', '#', '#', 3, '#', 'fa-file-excel-o', 1, 1, 1, 0, 0, 13, NULL, 1, 0, 1),
(24, 'Other', '#', '#', 3, '#', 'fa-refresh', 1, 1, 1, 1, 0, 19, NULL, 1, 0, 1),
(26, 'Geneology', 'genealogy-view', 'tree/genealogy', 3, '2', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 1),
(27, 'Sponsor', 'sponsor-view', 'tree/sponsor', 3, '2', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 1),
(28, 'Tabular', 'tabular-view', 'tree/tabular_tree', 3, '2', '', 1, 1, 1, 0, 0, 4, NULL, 1, 0, 0),
(29, 'Single Step', '../register/single_step', 'register/single_step', 0, '3', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 1),
(30, 'Multiple Step', '../register/multiple_step', 'register/multiple_step', 0, '3', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 1),
(31, 'Advanced', '../register/advanced', 'register/advanced', 0, '3', '', 1, 1, 1, 0, 0, 3, NULL, 1, 0, 1),
(32, 'Plan Configuration', 'plan-settings', 'configuration/plan_settings', 1, '19', '', 1, 0, 1, 0, 0, 1, NULL, 1, 0, 1),
(33, 'Language & CurrencySettings', 'locale-settings', 'configuration/multiple_options', 1, '145', '', 1, 0, 1, 0, 0, 9, NULL, 1, 0, 0),
(35, 'Registration Field Settings', 'custom-field', 'configuration/set_register_fields', 1, '145', '', 1, 0, 1, 0, 0, 6, NULL, 1, 0, 0),
(36, 'Account Settings', 'account-settings', 'member/account_settings', 3, '20', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 1),
(37, 'Mail Configuration', 'mail-manage', 'site_management/mail_settings', 1, '19', '', 1, 1, 1, 0, 0, 3, NULL, 1, 0, 1),
(38, 'Join-Report', 'join-report', 'report/user_join', 3, '23', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 1),
(39, 'Commission-Report', 'commission-report', 'report/user_commission', 3, '23', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 1),
(40, 'System Reset', 'reset-system', 'reset/clean', 1, '24', '', 1, 0, 1, 0, 0, 8, NULL, 1, 0, 1),
(41, 'Backup', 'backup', 'backup/index', 1, '145', '', 1, 0, 1, 0, 0, 7, NULL, 1, 0, 1),
(42, 'Site Info', 'website-manage', 'site_management/site_configuration', 1, '19', '', 1, 0, 1, 0, 0, 2, NULL, 1, 0, 1),
(43, 'Mail Content', 'mail-template', 'site_management/mail_contents', 1, '22', '', 1, 0, 1, 0, 0, 1, NULL, 1, 0, 1),
(45, 'Add News', 'news-add', 'news/add', 1, '14', '', 1, 0, 1, 0, 0, 1, NULL, 1, 0, 1),
(46, 'View News', 'news-view', 'news/view', 3, '14', '', 1, 1, 1, 1, 1, 2, NULL, 1, 0, 1),
(48, 'Pend Registers', 'payment-enrolls', 'member/pending_registrations', 1, '20', '', 1, 0, 1, 0, 0, 9, NULL, 1, 0, 0),
(49, 'Pend Orders', 'payment-orders', 'member/pending_orders', 1, '20', '', 1, 0, 1, 0, 0, 10, NULL, 1, 0, 0),
(50, 'Enroll Employee', 'employee-enroll', 'employee/employee_register', 1, '6', '', 1, 0, 1, 0, 0, 1, NULL, 1, 0, 0),
(51, 'Employee Permission', 'employee-permission', 'employee/menu_permission', 1, '6', '', 1, 0, 1, 0, 0, 3, NULL, 1, 0, 0),
(53, 'View All Kyc Details', 'kyc-view', 'kyc/view_all_kyc_details', 1, '97', '', 1, 0, 1, 0, 0, 1, NULL, 1, 0, 0),
(55, 'Rank Settings', 'title-settings', 'rank/rank_setting', 1, '145', '', 1, 0, 1, 0, 0, 5, NULL, 1, 0, 0),
(59, 'Wallets', '#', '#', 3, '#', 'fa fa-usd', 1, 1, 1, 0, 0, 6, '', 1, 0, 1),
(61, 'A-Wallet', '#', '#', 3, '59', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 1),
(62, 'B-Wallet', '#', '#', 3, '59', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 0),
(64, 'Inbox', 'inbox', 'mail/inbox', 0, '5', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 1),
(65, 'Sent', 'sent', 'mail/sent', 0, '5', '', 1, 1, 1, 0, 0, 3, NULL, 1, 0, 1),
(66, 'Trash', 'trash', 'mail/trash', 0, '5', '', 1, 1, 1, 0, 0, 5, NULL, 1, 0, 1),
(67, 'Draft', 'draft', 'mail/draft', 0, '5', '', 1, 1, 1, 0, 0, 4, NULL, 1, 0, 1),
(68, 'Stared', 'stared', 'mail/stared', 0, '5', '', 1, 1, 1, 0, 0, 6, NULL, 1, 0, 1),
(69, 'Spam', 'spam', 'mail/spam', 0, '5', '', 1, 1, 1, 0, 0, 7, NULL, 1, 0, 1),
(70, 'Compose', 'compose', 'mail/compose', 0, '5', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 1),
(71, 'Wallet Info', 'wallet-one', 'wallet/user_wallet_one', 3, '59', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 1),
(72, 'Wallet Info', 'wallet-two', 'wallet/user_wallet_two', 3, '62', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 0),
(73, 'Document Upload', 'document-upload', 'document/upload', 1, '17', '', 1, 0, 1, 0, 0, 1, NULL, 1, 0, 1),
(74, 'View Documents', 'document-view', 'document/view', 3, '17', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 1),
(76, 'Generation', 'generation-plan', 'settings/generation_settings', 1, '19', '', 1, 0, 1, 0, 0, 4, NULL, 1, 0, 0),
(77, 'Investment', 'investment-plan', 'settings/investment_settings', 1, '19', '', 1, 0, 1, 0, 0, 6, NULL, 1, 0, 0),
(79, 'Payment Config', 'withdraw-settings', 'member/payment_settings', 2, '20', '', 0, 1, 0, 0, 0, 11, NULL, 1, 0, 1),
(80, 'Payout Request', 'withdraw-request', 'wallet/payout', 2, '59', '', 0, 1, 0, 0, 0, 3, NULL, 1, 0, 1),
(81, 'Payout Release', 'withdarw-confirm', 'wallet/payout_release', 1, '59', '', 1, 0, 1, 0, 0, 4, NULL, 1, 0, 1),
(82, 'Donation', '#', '#', 3, '#', 'fa-rocket', 1, 1, 1, 0, 0, 7, NULL, 1, 0, 0),
(83, 'Donate Amount', 'donation-plan', 'donation/index', 3, '82', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 0),
(84, 'Donation History', 'donation-history', 'donation/history', 3, '82', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 0),
(85, 'Donation Settings', 'donation-settings', 'donation/settings', 1, '82', '', 1, 0, 1, 0, 0, 3, NULL, 1, 0, 0),
(86, 'Party', '#', '#', 3, '#', 'fa-dot-circle-o ', 1, 1, 1, 0, 0, 8, NULL, 1, 0, 0),
(87, 'Create Party', 'party-plan', 'party/create_party', 3, '86', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 0),
(88, 'Party Management', 'party-manage', 'party/party_management', 3, '86', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 0),
(89, 'Party Invites', 'party-invite', 'party/party_invite', 3, '86', '', 1, 1, 1, 0, 0, 3, NULL, 1, 0, 0),
(90, 'Tax Setting', 'tax-manage', 'settings/tax_and_payment', 1, '19', '', 1, 0, 1, 0, 0, 7, NULL, 1, 0, 0),
(91, 'Gift Plan', '#', '#', 3, '#', 'fa fa-gift', 1, 1, 1, 0, 0, 9, NULL, 1, 0, 0),
(92, 'Menu Management', 'menu-manage', 'menu/menu_management', 1, '145', '', 1, 0, 1, 0, 0, 2, NULL, 1, 0, 1),
(93, 'Gift Sender', 'gift-plan', 'gift/gift_requests', 3, '91', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 0),
(95, 'Migration', 'migrate-view', 'migration/index', 1, '20', 'fa-puzzle-piece', 1, 0, 1, 0, 0, 7, NULL, 1, 0, 0),
(96, 'View Testimonial', 'testimonial-view', 'testimonial/view_testimonial', 1, '24', '', 1, 0, 1, 0, 0, 5, NULL, 1, 0, 0),
(97, 'kyc', 'user-kyc', 'kyc/add', 3, '20', 'fa-exchange', 1, 1, 1, 0, 0, 2, NULL, 0, 0, 0),
(98, 'Lead', 'leads', 'leads/index', 3, '24', '', 1, 1, 1, 0, 0, 7, NULL, 1, 0, 0),
(99, 'Investment History', 'investment-view', 'wallet/investment_history', 3, '113', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 0),
(100, 'Stair Step Settings', 'stair-step-plan', 'settings/stair_step_settings', 1, '19', '', 1, 0, 1, 0, 0, 5, NULL, 1, 0, 0),
(101, 'CMS Settings', '../../admin', 'home/admin', 1, '19', '', 0, 0, 0, 0, 0, 9, '_blank', 0, 0, 0),
(102, 'Root', 'root-view', 'tree/root', 3, '2', '', 1, 1, 1, 0, 0, 3, NULL, 1, 0, 0),
(103, 'Gift Settings', 'gift-settings', 'gift/settings', 1, '91', '', 1, 0, 1, 0, 0, 3, NULL, 1, 0, 0),
(104, 'Gift History', 'gift-history', 'gift/history', 3, '91', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 0),
(105, 'Testimonial', 'create-testimonial', 'testimonial/create_testimonial', 2, '24', '', 0, 1, 0, 0, 0, 6, NULL, 1, 0, 0),
(106, 'Events', '#', '', 3, '24', 'fa-calendar', 1, 1, 1, 1, 1, 3, NULL, 1, 0, 1),
(107, 'Event Management', 'event-manage', 'events/event_management', 1, '106', '', 1, 0, 1, 0, 0, 1, NULL, 1, 0, 1),
(108, 'Calendar', 'event-calendar', 'events/calendar', 3, '106', '', 1, 1, 1, 1, 1, 3, NULL, 1, 0, 1),
(109, 'Preview', 'register-preview', 'register/register_preview', 0, '3', '', 1, 1, 1, 0, 0, 4, NULL, 1, 0, 1),
(110, 'Sales-Report', 'sales-report', 'report/user_orders', 3, '23', '', 1, 1, 1, 0, 0, 3, NULL, 1, 0, 1),
(111, 'User-Balance', 'balance-report', 'report/user_balance', 1, '23', '', 1, 0, 1, 0, 0, 6, NULL, 1, 0, 1),
(112, 'Activity-History', 'activity-report', 'report/history_report', 3, '23', '', 1, 1, 1, 0, 0, 7, NULL, 1, 0, 1),
(113, 'Investment', '#', '', 3, '59', '', 1, 1, 1, 0, 0, 3, NULL, 1, 0, 0),
(114, 'Release Investment', 'release-investment', 'wallet/release_investment_amount', 3, '113', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 0),
(115, 'Multi Wallet Configuration', 'wallet-manage', 'settings/multiple_wallet', 1, '19', '', 1, 0, 1, 0, 0, 8, NULL, 1, 0, 0),
(116, 'Terms and Conditions', 'terms-condition', 'configuration/terms_and_condition', 1, '22', '', 1, 0, 1, 0, 0, 2, NULL, 1, 0, 1),
(117, 'employee-report', 'employee-report', 'report/employee_list', 1, '23', '', 1, 0, 1, 0, 0, 8, NULL, 1, 0, 0),
(118, 'cron-report', 'cron-report', 'report/cron_report', 1, '23', '', 1, 0, 1, 0, 0, 12, NULL, 1, 0, 0),
(119, 'Affiliates', '#', '', 3, '#', 'fa fa-forumbee', 1, 1, 1, 0, 0, 15, NULL, 1, 0, 0),
(120, 'Enroll Affiliates', '../enroll-affiliates', 'client/enroll_affiliates', 3, '119', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 0),
(121, 'Affiliate Tree', 'affiliate-view', 'tree/affiliate', 3, '2', '', 1, 1, 1, 0, 0, 5, NULL, 1, 0, 0),
(122, 'Affiliate Details', 'affiliate-details', 'affiliates/affiliates_users', 3, '119', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 0),
(123, 'View All Empployees', 'view-all-employee', 'employee/view_all_employee', 1, '6', '', 1, 0, 1, 0, 0, 2, NULL, 1, 0, 0),
(124, 'Employee Password Change', 'change-employee-password', 'employee/change_employee_password', 1, '6', '', 1, 0, 1, 0, 0, 4, NULL, 1, 0, 0),
(131, 'affiliates-activity-report', 'affiliates-activity-report', 'report/history_report_affiliates', 3, '23', '', 1, 1, 1, 0, 0, 11, NULL, 1, 0, 0),
(132, 'IP Whitelist', 'ip-whitelisting', 'settings/ip_whitelist', 1, '145', '', 1, 0, 1, 0, 0, 11, NULL, 1, 0, 1),
(133, 'employee-activity-report', 'employee-activity-report', 'report/employee_histroy', 1, '23', '', 1, 0, 1, 0, 0, 9, NULL, 1, 0, 0),
(134, 'affiliates-report', 'affiliates-report', 'report/affiliates_list', 3, '23', '', 1, 1, 1, 0, 0, 10, NULL, 1, 0, 0),
(143, 'Paypal Register', 'paypal-register', 'register/paypal_registration', 0, '3', '', 1, 1, 1, 1, 1, 5, NULL, 0, 0, 0),
(144, '', 'blocktrail-register', 'register/blocktrail_registration', 0, '3', '', 1, 1, 1, 1, 0, 7, NULL, 1, 0, 1),
(145, 'System Management', '#', '#', 1, '#', 'fa-briefcase', 1, 1, 1, 0, 0, 12, NULL, 1, 0, 1),
(146, '', 'blocktrail-checkout', 'cart/blocktrail_checkout', 0, '11', '', 1, 1, 1, 1, 0, 0, NULL, 1, 0, 1),
(147, 'Position Management', 'position-management', 'member/position_settings', 1, '20', '', 1, 0, 1, 0, 0, 8, NULL, 1, 0, 0),
(148, 'Change-affiliate-password', 'change-affiliate-password', 'affiliates/change_affiliate_password', 1, '119', '', 1, 0, 1, 0, 0, 3, NULL, 1, 0, 0),
(149, 'Pending Preview', 'pending-preview', 'register/pending_preview', 0, '3', '', 1, 1, 1, 1, 0, 6, NULL, 1, 0, 1),
(150, 'Dashboard', 'dashboard', 'home/index', 3, '1', '', 1, 1, 1, 1, 0, 1, NULL, 1, 0, 1),
(151, 'Dashboard', 'dashboard2', 'home/index2', 3, '1', '', 1, 1, 1, 0, 0, 2, NULL, 0, 0, 0),
(152, 'Dashboard', 'dashboard3', 'home/index3', 3, '1', '', 1, 1, 1, 0, 0, 3, NULL, 0, 0, 0),
(154, 'News Timeline', 'news-timeline', 'news/timeline', 3, '14', '', 1, 1, 1, 1, 1, 3, NULL, 1, 0, 1),
(155, 'Event-View', 'event-view', 'events/view_event', 3, '106', '', 1, 1, 1, 1, 1, 2, NULL, 1, 0, 1),
(156, '', 'sms-settings', 'settings/sms_settings', 1, '19', '', 1, 0, 1, 0, 0, 10, NULL, 1, 0, 0),
(157, '', 'grid-view', 'document/grid_view', 3, '17', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 1),
(158, '', 'mail/read', 'mail/read', 0, '5', '', 1, 1, 1, 1, 0, 5, NULL, 1, 0, 1),
(159, 'Help Request', 'help-gift-request', 'gift/help_requests', 0, '93', '', 1, 1, 1, 0, 0, 1, NULL, 0, 0, 0),
(160, 'Used Devices', 'used-devices', 'member/recently_used_devices', 3, '20', '', 1, 1, 1, 0, 0, 4, NULL, 1, 0, 0),
(163, 'Ticket System', '#', '#', 3, '#', 'fa fa-ticket', 1, 1, 1, 0, 0, 16, NULL, 1, 0, 0),
(164, 'Create Ticket', 'create-ticket', 'ticket_system/create_ticket', 2, '163', '', 0, 1, 0, 0, 0, 1, NULL, 1, 0, 0),
(165, 'View Ticket', 'view-ticket', 'ticket_system/view_my_tickets', 2, '163', '', 0, 1, 0, 0, 0, 3, NULL, 1, 0, 0),
(166, 'View FAQ', 'support-faq', 'ticket_system/view_faq', 2, '163', '', 0, 1, 0, 0, 0, 5, NULL, 1, 0, 0),
(167, 'Ticket Details', 'view-ticket-details', 'ticket_system/view_created_users_tickets', 0, '165', '', 0, 1, 0, 0, 0, 1, NULL, 0, 0, 0),
(168, '', 'support-center', 'ticket_system/index', 1, '163', '', 1, 0, 1, 0, 0, 2, NULL, 1, 0, 0),
(169, '', '#', '#', 1, '163', '', 1, 0, 1, 0, 0, 4, NULL, 1, 0, 0),
(170, '', 'support-manage-type', 'ticket_system/ticket_type_configuration', 1, '169', '', 1, 0, 1, 0, 0, 1, NULL, 1, 0, 0),
(171, '', 'support-manage-department', 'ticket_system/ticket_department_configuration', 1, '169', '', 1, 0, 1, 0, 0, 2, NULL, 1, 0, 0),
(172, '', 'support-manage-priority', 'ticket_system/ticket_priority_configuration', 1, '169', '', 1, 0, 1, 0, 0, 3, NULL, 1, 0, 0),
(173, '', 'support-faq', 'ticket_system/faq', 1, '163', '', 0, 0, 1, 0, 0, 6, NULL, 0, 0, 0),
(174, '', 'tickets', 'ticket_system/ticket_management', 1, '163', '', 1, 0, 1, 0, 0, 7, NULL, 1, 0, 0),
(175, 'ip-blacklist', 'ip-blacklist', 'settings/ip_blacklist', 1, '145', '', 1, 0, 1, 0, 0, 12, NULL, 1, 0, 1),
(176, '', 'manage-ticket', 'ticket_system/view_all_details', 0, '174', '', 1, 0, 1, 0, 0, 1, NULL, 1, 0, 1),
(177, 'rank-history', 'rank-history', 'report/rank_history_report', 1, '23', '', 1, 0, 1, 0, 0, 4, NULL, 1, 0, 0),
(178, 'Order History', 'order-history', 'member/order_history', 3, '20', '', 1, 1, 1, 0, 0, 5, NULL, 1, 0, 1),
(179, 'Category Manage', 'cat-manage', 'product/category_management', 1, '181', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 1),
(180, 'Sub Category Manage', 'sub-cat-manage', 'product/sub_category_management', 1, '181', '', 1, 1, 1, 0, 0, 3, NULL, 1, 0, 1),
(181, 'Product & Category', '#', '', 1, '145', '', 1, 0, 1, 0, 0, 1, NULL, 1, 0, 1),
(182, 'Product Return', 'product-return', 'member/product_return', 3, '20', '', 1, 1, 1, 0, 0, 6, NULL, 1, 0, 0),
(183, 'Invoice', 'order-invoice', 'member/invoice', 3, '178', '', 1, 1, 1, 0, 0, 1, NULL, 1, 0, 1),
(184, 'Translator', '../lang-translator', 'translator/translate', 3, '145', '', 1, 1, 1, 1, 0, 10, NULL, 1, 0, 0),
(185, 'Cart', '../shopping-cart', 'cart/index', 3, '#', 'fa-shopping-cart', 1, 1, 1, 0, 0, 4, NULL, 1, 0, 1),
(186, 'Cart', '../shop', 'shop/index', 3, '185', 'fa-shopping-cart', 1, 1, 1, 0, 0, 2, '1', 1, 0, 1),
(187, 'Shopping Cart', '../../shopping-site', '', 3, '185', 'fa-shopping-cart', 0, 0, 0, 0, 0, 3, '1', 0, 0, 0),
(188, 'Fund Management', 'transfer-wallet', 'wallet/transfer_points', 3, '62', '', 1, 1, 1, 0, 0, 2, NULL, 1, 0, 1),
(189, 'Payment Details', 'payment-details', 'member/payment_details', 1, '20', '', 1, 0, 1, 0, 0, 3, NULL, 1, 0, 1),
(190, 'Default Images', 'default-images', 'member/default_images', 1, '145', '', 1, 0, 1, 0, 0, 13, NULL, 1, 0, 1),
(191, 'binary-history-report', 'binary-history-report', 'report/binary_history_report', 3, '23', '', 1, 1, 1, 0, 0, 5, NULL, 1, 0, 0),
(192, 'Account Settings', 'user-login', 'member/user_login', 1, '20', '', 1, 0, 1, 0, 0, 5, NULL, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_messages`
--

CREATE TABLE `mlm_messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `guid` varchar(100) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `chat_referance` varchar(30) NOT NULL,
  `user1` int(20) DEFAULT NULL,
  `user2` int(20) DEFAULT NULL,
  `read_status1` tinyint(1) NOT NULL DEFAULT 0,
  `read_status2` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_migration_files`
--

CREATE TABLE `mlm_migration_files` (
  `id` int(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `file_name` varchar(30) NOT NULL,
  `file_type` varchar(20) DEFAULT NULL,
  `file_size` int(20) DEFAULT NULL,
  `total_rows` int(20) DEFAULT NULL,
  `register_rows` int(20) DEFAULT NULL,
  `failed_rows` int(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `upload_data` mediumtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_modules`
--

CREATE TABLE `mlm_modules` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `sort_order` int(10) NOT NULL,
  `icon` varchar(20) NOT NULL DEFAULT 'fa-star-half',
  `menus` varchar(40) NOT NULL,
  `menu_type` varchar(40) NOT NULL COMMENT '1:admin,2:user,3:both',
  `link` varchar(40) NOT NULL,
  `tab` varchar(20) NOT NULL,
  `tab_session` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `basic_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_modules`
--

INSERT INTO `mlm_modules` (`id`, `name`, `sort_order`, `icon`, `menus`, `menu_type`, `link`, `tab`, `tab_session`, `status`, `basic_status`) VALUES
(1, 'sms_modules', 23, 'fa-star-half', '156,', '1,', '156', '', '', 1, 0),
(2, 'replicated_website', 9, 'fa-star-half', '', '', '', '', '', 1, 0),
(3, 'multi_lang', 15, 'fa-star-half', '', '', '33', '', '', 1, 0),
(4, 'multi_currency', 16, 'fa-star-half', '', '', '33', '', '', 1, 0),
(5, 'epin', 19, 'fa-star-half', '8,', '3,', '8', '', '', 1, 0),
(7, 'backup', 22, 'fa-star-half', '41,', '1,', '41', '', '', 1, 1),
(8, 'rank', 19, 'fa-star-half', '55,', '1,', '55', '', '', 1, 0),
(9, 'email_verification', 40, 'fa-star-half', '', '', '', '', '', 1, 0),
(11, 'fund_transfer_admin', 30, 'fa-star-half', '18,', '1,', '18', '', '', 1, 1),
(12, 'fund_transfer_user', 30, 'fa-star-half', '18,', '2,', '', '', '', 1, 1),
(14, 'lcp', 10, 'fa-star-half', '98,', '3,', '98', '', '', 1, 0),
(15, 'google_translator', 26, 'fa-star-half', '', '', '184', '', '', 1, 0),
(16, 'captcha', 14, 'fa-star-half', '', '', '', '', '', 1, 0),
(17, 'tax', 18, 'fa-star-half', '90,', '1,', '90', '', '', 1, 0),
(18, 'maintanance', 40, 'fa-star-half', '', '', '132', '', '', 1, 0),
(19, 'register_leg', 40, 'fa-star-half', '', '', '', '', '', 1, 1),
(20, 'multiple_wallet', 11, 'fa-star-half', '115,72,62', '1,3,3', '115', '', '', 1, 0),
(22, 'news', 20, 'fa-star-half', '14,', '3,', '45', '', '', 1, 1),
(23, 'employee', 14, 'fa-star-half', '6,50,51,123,124,117,133,', '1,1,1,1,1,1,1,', '50', '', '', 1, 0),
(24, 'ticket_system', 13, 'fa-star-half', '163', '3', '7', '', '', 1, 0),
(25, 'product', 30, 'fa-star-half', '21,11,110,', '1,3,3', '21', '', '', 1, 1),
(26, 'internal_mail', 25, 'fa-star-half', '5,', '3,', '5', '', '', 1, 1),
(27, 'cms', 12, 'fa-star-half', '78,101', '1,1', '', '', '', 1, 0),
(28, 'help', 25, 'fa-star-half', '', '', '', '', '', 1, 1),
(29, 'generation', 5, 'fa-star-half', '76,', '1,', '76', '', '', 1, 0),
(30, 'investment', 3, 'fa-star-half', '77,113,', '1,3', '77', '', '', 1, 0),
(31, 'donation_plan', 2, 'fa-star-half', '82,83,84,85,', '3,3,3,1,', '83', '', '', 1, 0),
(32, 'party_plan', 1, 'fa-star-half', '86,87,88,89.', '3,3,3,3,', '87', '', '', 1, 0),
(33, 'crowd_funding', 7, 'fa-star-half', '', '', '', '', '', 1, 0),
(34, 'stair_step_plan', 6, 'fa-star-half', '100,', '1,', '100', '', '', 1, 0),
(36, 'gift', 4, 'fa-star-half', '91,93,103,104,', '3,3,1,3,', '', '', '', 1, 0),
(37, 'kyc', 17, 'fa-star-half', '52,53,', '3,1,', '52', '', '', 1, 0),
(38, 'excel_migration', 20, 'fa-star-half', '95,', '1,', '95', '', '', 1, 0),
(39, 'testimonials', 21, 'fa-star-half', '96,105,', '1,2,', '96', '', '', 1, 0),
(40, 'monoline', 8, 'fa-star-half', '', '', '', '', '', 1, 0),
(41, 'affiliates', 10, 'fa-star-half', '119,120,122,128,129,130,131,134,', '3,3,3,1,3,3,3,3', '120', '', '', 1, 0),
(42, 'oc', 14, 'fa-star-half', '187,', '3,', '', '', '', 1, 0),
(43, 'geo_location', 22, 'fa-star-half', '160,', '3,', '160', '', '', 1, 0),
(44, 'event', 20, 'fa-star-half', '106,', '3,', '107', '', '', 1, 1),
(45, 'documents', 20, 'fa-star-half', '17,', '3,', '73', '', '', 1, 1),
(46, 'ip_whitelist', 25, 'fa-star-half', '132,', '1,', '132', '', '', 1, 1),
(47, 'ip_blacklist', 25, 'fa-star-half', '175,', '1,', '175', '', '', 1, 1),
(48, 'repurchase', 0, 'fa-star-half', '11,110,49,178,179,180,', '3,3,1,3,3,3,', '11', '', '', 1, 1),
(49, 'promotion', 22, 'fa-star-half', '16,', '3,', '', '', '', 1, 0),
(51, 'return', 15, 'fa-star-half', '182,', '3,', '', '', '', 1, 0),
(52, 'image_resize', 10, 'fa-star-half', '', '', '', '', '', 1, 1),
(53, 'reg_from_tree', 5, 'fa-star-half', '', '', '', '', '', 1, 1),
(54, 'basic_cart', 10, 'fa-star-half', '179,180,', '1,1,', '0', '', '', 1, 0),
(55, 'db_optimize', 25, 'fa-star-half', '', '', '', '', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_news`
--

CREATE TABLE `mlm_news` (
  `id` int(20) NOT NULL,
  `mlm_user_id` int(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(30) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `day` varchar(5) DEFAULT NULL,
  `day_char` varchar(10) DEFAULT NULL,
  `color` varchar(20) DEFAULT 'white',
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_orders`
--

CREATE TABLE `mlm_orders` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `total_amount` decimal(16,8) NOT NULL,
  `delivery_charge` float(16,8) DEFAULT 0.00000000,
  `shipping_charge` float(16,8) DEFAULT 0.00000000,
  `tax` float(16,8) DEFAULT 0.00000000,
  `total_pv` decimal(16,8) NOT NULL,
  `product_count` int(20) NOT NULL DEFAULT 1,
  `payment_type` varchar(30) NOT NULL DEFAULT 'bank_transfer',
  `address` varchar(30) DEFAULT NULL,
  `country` int(10) DEFAULT NULL,
  `state` int(10) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `zip_code` int(10) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `confirm_date` datetime DEFAULT NULL,
  `order_type` varchar(20) DEFAULT 'checkout',
  `paypal_reference` varchar(50) DEFAULT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_orders`
--

INSERT INTO `mlm_orders` (`id`, `user_id`, `total_amount`, `delivery_charge`, `shipping_charge`, `tax`, `total_pv`, `product_count`, `payment_type`, `address`, `country`, `state`, `city`, `zip_code`, `order_date`, `confirm_date`, `order_type`, `paypal_reference`, `order_status`) VALUES
(1, 1901, '5.00000000', 0.00000000, 0.00000000, 0.00000000, '5.00000000', 1, 'free_registration', 'NA', 2, 35, 'NA', 0, '2021-03-31 16:39:28', '2021-03-31 16:39:28', 'register', NULL, 1),
(2, 1902, '15.00000000', 0.00000000, 0.00000000, 0.00000000, '15.00000000', 1, 'free_registration', 'NA', 99, 1428, 'NA', 0, '2021-12-18 10:25:01', '2021-12-18 10:25:01', 'register', NULL, 1),
(3, 1903, '10.00000000', 0.00000000, 0.00000000, 0.00000000, '10.00000000', 1, 'free_registration', 'NA', 99, 1428, 'NA', 0, '2021-12-18 11:02:37', '2021-12-18 11:02:37', 'register', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_order_products`
--

CREATE TABLE `mlm_order_products` (
  `id` int(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `party_id` int(20) DEFAULT 0,
  `product_id` int(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `amount` decimal(16,8) NOT NULL,
  `pv` decimal(16,8) DEFAULT NULL,
  `image` varchar(30) DEFAULT NULL,
  `recurring` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_order_products`
--

INSERT INTO `mlm_order_products` (`id`, `order_id`, `party_id`, `product_id`, `quantity`, `amount`, `pv`, `image`, `recurring`, `date`, `expiry_date`, `category_id`) VALUES
(1, 1, 0, 1, 1, '5.00000000', '5.00000000', 'pro_1532788520.jpeg', '', '2021-03-31 16:39:28', '2021-04-03 00:00:00', 1),
(2, 2, 0, 3, 1, '15.00000000', '15.00000000', 'pro_1532788354.jpeg', '', '2021-12-18 10:25:01', '2021-12-23 00:00:00', 1),
(3, 3, 0, 2, 1, '10.00000000', '10.00000000', 'pro_1532788372.jpeg', '', '2021-12-18 11:02:37', '2022-01-09 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_pair_calculation`
--

CREATE TABLE `mlm_pair_calculation` (
  `id` int(12) NOT NULL,
  `order_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `update_point` double NOT NULL DEFAULT 0,
  `date` datetime NOT NULL,
  `binary_data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_party`
--

CREATE TABLE `mlm_party` (
  `id` int(20) NOT NULL,
  `party_code` varchar(30) NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` varchar(20) DEFAULT NULL,
  `user_id` int(20) NOT NULL,
  `creating_user` int(20) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `address_type` varchar(10) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `country_id` int(10) DEFAULT 0,
  `state_id` int(10) DEFAULT 0,
  `city` varchar(20) DEFAULT NULL,
  `zip_code` int(20) DEFAULT NULL,
  `phone` int(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `confirmation` varchar(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_party_products`
--

CREATE TABLE `mlm_party_products` (
  `id` int(20) NOT NULL,
  `party_id` int(20) NOT NULL,
  `prod_id` int(20) NOT NULL,
  `amount` decimal(16,8) NOT NULL,
  `added_user` int(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_party_requests`
--

CREATE TABLE `mlm_party_requests` (
  `id` int(20) NOT NULL,
  `mlm_user_id` int(20) NOT NULL,
  `party_title` varchar(20) NOT NULL,
  `party_content` text NOT NULL,
  `party_image` varchar(30) DEFAULT NULL,
  `party_request_date` datetime DEFAULT NULL,
  `party_status` tinyint(1) DEFAULT 1,
  `party_confirm_date` datetime DEFAULT NULL,
  `party_reason` text DEFAULT NULL,
  `party_start_date` datetime DEFAULT NULL,
  `party_end_date` datetime DEFAULT NULL,
  `party_place` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_party_users`
--

CREATE TABLE `mlm_party_users` (
  `id` int(20) NOT NULL,
  `party_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `added_user` int(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_payment_config`
--

CREATE TABLE `mlm_payment_config` (
  `id` int(11) NOT NULL,
  `paypal_api_username` varchar(200) NOT NULL,
  `paypal_api_password` varchar(200) NOT NULL,
  `paypal_signater` varchar(300) NOT NULL,
  `paypal_production` tinyint(1) NOT NULL,
  `bank_name` varchar(30) NOT NULL,
  `bank_holder_name` varchar(100) NOT NULL,
  `bank_ac_number` varchar(100) NOT NULL,
  `bank_branch` varchar(100) NOT NULL,
  `bank_ifsc` varchar(10) NOT NULL,
  `blocktrail_api_key` varchar(100) DEFAULT NULL,
  `blocktrail_api_secret` varchar(100) DEFAULT NULL,
  `blocktrail_wallet_identifier` varchar(100) DEFAULT NULL,
  `blocktrail_wallet_pass` varchar(100) DEFAULT NULL,
  `blocktrail_production` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_payment_config`
--

INSERT INTO `mlm_payment_config` (`id`, `paypal_api_username`, `paypal_api_password`, `paypal_signater`, `paypal_production`, `bank_name`, `bank_holder_name`, `bank_ac_number`, `bank_branch`, `bank_ifsc`, `blocktrail_api_key`, `blocktrail_api_secret`, `blocktrail_wallet_identifier`, `blocktrail_wallet_pass`, `blocktrail_production`) VALUES
(1, 'leadmlm_api1.gmail.com', 'KGMXB93Y9SGJR58C', 'Asx3ry1bYYjLCbk-OSOPpBQoluudAbHyQyyl5FG0VIpTyENuYymyW.N0', 1, 'ICICI Bank', 'Techffodils Technologies', '78956756756756756', 'Kallayi', 'IC6786', 'fe79f58e513c9a7629b2f6ce44a2463714f2937f', '1e85007f6d85d73b68029d22594a366a75b40a80', 'leadmlmsoftware', 'TeChFfOdIlS@111', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_payment_methods`
--

CREATE TABLE `mlm_payment_methods` (
  `id` int(30) NOT NULL,
  `code` varchar(30) NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'active',
  `payout_status` varchar(10) NOT NULL DEFAULT 'inactive',
  `settings` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_payment_methods`
--

INSERT INTO `mlm_payment_methods` (`id`, `code`, `payment_method`, `status`, `payout_status`, `settings`) VALUES
(1, 'free_registration', 'Free Registration', 'active', 'inactive', 0),
(2, 'bank_transfer', 'Bank Transfer', 'active', 'active', 1),
(3, 'ewallet', 'Ewallet', 'active', 'inactive', 0),
(4, 'epin', 'Epin', 'active', 'inactive', 0),
(5, 'paypal', 'Paypal', 'active', 'active', 1),
(6, 'coinpayments', 'Coinpayments', 'inactive', 'active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_pending_registrations`
--

CREATE TABLE `mlm_pending_registrations` (
  `id` int(20) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `package_id` int(10) DEFAULT NULL,
  `reg_amount` float(16,8) DEFAULT NULL,
  `payment_method` varchar(30) DEFAULT NULL,
  `register_type` varchar(20) DEFAULT NULL,
  `mlm_plan` varchar(20) NOT NULL,
  `leg_type` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_details` text NOT NULL,
  `paypal_response` text DEFAULT NULL,
  `paypal_reference` varchar(200) DEFAULT 'NA',
  `payment_status` tinyint(1) DEFAULT 0,
  `register_status` tinyint(1) DEFAULT 0,
  `status` varchar(10) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_pin_numbers`
--

CREATE TABLE `mlm_pin_numbers` (
  `id` int(11) NOT NULL,
  `mlm_user_id` int(11) NOT NULL,
  `pin_number` varchar(40) NOT NULL,
  `allocate_amount` double NOT NULL,
  `balance_amount` double NOT NULL,
  `allocate_date` datetime DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `used_date` datetime DEFAULT NULL,
  `used_for` varchar(30) DEFAULT 'NA',
  `used_by` int(30) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_pin_request`
--

CREATE TABLE `mlm_pin_request` (
  `id` int(30) NOT NULL,
  `mlm_user_id` int(30) NOT NULL,
  `amount` double NOT NULL,
  `count` int(30) NOT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'requested'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_products`
--

CREATE TABLE `mlm_products` (
  `id` int(30) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `category` int(10) DEFAULT NULL,
  `sub_category` int(10) DEFAULT NULL,
  `product_amount` double NOT NULL,
  `product_pv` double DEFAULT NULL,
  `product_code` varchar(30) NOT NULL,
  `inv_cat` int(3) DEFAULT 1 COMMENT 'category(default) = 1',
  `investment_amount` float DEFAULT NULL,
  `expiry_date` int(20) DEFAULT NULL,
  `description` varchar(300) DEFAULT 'Product Description',
  `recurring_type` varchar(30) DEFAULT NULL,
  `product_type` varchar(30) DEFAULT 'register',
  `images` mediumtext DEFAULT NULL,
  `special` tinyint(1) NOT NULL DEFAULT 0,
  `quantity` double NOT NULL,
  `sales_count` int(20) DEFAULT 0,
  `date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_products`
--

INSERT INTO `mlm_products` (`id`, `product_name`, `category`, `sub_category`, `product_amount`, `product_pv`, `product_code`, `inv_cat`, `investment_amount`, `expiry_date`, `description`, `recurring_type`, `product_type`, `images`, `special`, `quantity`, `sales_count`, `date`, `status`) VALUES
(1, 'Platinum', 6, 0, 5, 5, 'Pro-567567', 1, 1, 3, 'is simply dummy text of the product. admin can manage these description in product management section.', '', 'register', 'a:1:{i:0;a:14:{s:9:\"file_name\";s:19:\"pro_1532788520.jpeg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:55:\"/var/www/html/WC/lead-Soft/site/assets/images/products/\";s:9:\"full_path\";s:74:\"/var/www/html/WC/lead-Soft/site/assets/images/products/pro_1532788520.jpeg\";s:8:\"raw_name\";s:14:\"pro_1532788520\";s:9:\"orig_name\";s:19:\"pro_1532788520.jpeg\";s:11:\"client_name\";s:15:\"images (2).jpeg\";s:8:\"file_ext\";s:5:\".jpeg\";s:9:\"file_size\";d:13.26;s:8:\"is_image\";b:1;s:11:\"image_width\";i:225;s:12:\"image_height\";i:225;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"225\" height=\"225\"\";}}', 0, 3499, 1, '0000-00-00 00:00:00', 1),
(2, 'Gold', 6, 0, 10, 10, 'Pro-123789', 1, 1, 22, 'is simply dummy text of the product. admin can manage these description in product management section.', '', 'register', 'a:1:{i:0;a:14:{s:9:\"file_name\";s:19:\"pro_1532788372.jpeg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:55:\"/var/www/html/WC/lead-Soft/site/assets/images/products/\";s:9:\"full_path\";s:74:\"/var/www/html/WC/lead-Soft/site/assets/images/products/pro_1532788372.jpeg\";s:8:\"raw_name\";s:14:\"pro_1532788372\";s:9:\"orig_name\";s:19:\"pro_1532788372.jpeg\";s:11:\"client_name\";s:15:\"images (1).jpeg\";s:8:\"file_ext\";s:5:\".jpeg\";s:9:\"file_size\";d:11.050000000000001;s:8:\"is_image\";b:1;s:11:\"image_width\";i:225;s:12:\"image_height\";i:225;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"225\" height=\"225\"\";}}', 0, 3499, 1, '0000-00-00 00:00:00', 1),
(3, 'Silver', 6, 0, 15, 15, 'Pro-234332', 1, 0, 5, 'is simply dummy text of the product. admin can manage these description in product management section.', '', 'register', 'a:1:{i:0;a:14:{s:9:\"file_name\";s:19:\"pro_1532788354.jpeg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:55:\"/var/www/html/WC/lead-Soft/site/assets/images/products/\";s:9:\"full_path\";s:74:\"/var/www/html/WC/lead-Soft/site/assets/images/products/pro_1532788354.jpeg\";s:8:\"raw_name\";s:14:\"pro_1532788354\";s:9:\"orig_name\";s:19:\"pro_1532788354.jpeg\";s:11:\"client_name\";s:6:\"6.jpeg\";s:8:\"file_ext\";s:5:\".jpeg\";s:9:\"file_size\";d:11.779999999999999;s:8:\"is_image\";b:1;s:11:\"image_width\";i:225;s:12:\"image_height\";i:225;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"225\" height=\"225\"\";}}', 0, 3499, 1, '0000-00-00 00:00:00', 1),
(4, 'Bronze', 6, 0, 20, 20, 'Pro-789777', 1, 0, 5, 'is simply dummy text of the product. admin can manage these description in product management section.', '', 'register', 'a:1:{i:0;a:14:{s:9:\"file_name\";s:19:\"pro_1532788199.jpeg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:55:\"/var/www/html/WC/lead-Soft/site/assets/images/products/\";s:9:\"full_path\";s:74:\"/var/www/html/WC/lead-Soft/site/assets/images/products/pro_1532788199.jpeg\";s:8:\"raw_name\";s:14:\"pro_1532788199\";s:9:\"orig_name\";s:19:\"pro_1532788199.jpeg\";s:11:\"client_name\";s:6:\"4.jpeg\";s:8:\"file_ext\";s:5:\".jpeg\";s:9:\"file_size\";d:10.24;s:8:\"is_image\";b:1;s:11:\"image_width\";i:225;s:12:\"image_height\";i:225;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"225\" height=\"225\"\";}}', 0, 3500, 0, '0000-00-00 00:00:00', 1),
(6, 'Shoe', 2, 4, 150, 150, 'Pro-111133', 1, 0, 1, 'is simply dummy text of the product. admin can manage these description in product management section.', '', 'repurchase', 'a:4:{i:0;a:2:{s:2:\"id\";i:0;s:9:\"file_name\";s:18:\"pro_1532786888.jpg\";}i:1;a:2:{s:2:\"id\";i:1;s:9:\"file_name\";s:18:\"pro_1532786918.jpg\";}i:2;a:2:{s:2:\"id\";i:2;s:9:\"file_name\";s:19:\"pro_15327869181.jpg\";}i:3;a:2:{s:2:\"id\";i:3;s:9:\"file_name\";s:19:\"pro_15327869182.jpg\";}}', 0, 3500, 0, '0000-00-00 00:00:00', 1),
(7, 'Jean', 2, 3, 100, 100, 'Pro-169264', 1, 15, 25, 'is simply dummy text of the product. admin can manage these description in product management section.', '', 'repurchase', 'a:0:{}', 0, 3500, 0, '2019-02-14 11:01:52', 1),
(8, 'Track Suite', 2, 3, 25, 25, 'Pro-567666', 1, 0, 5, 'is simply dummy text of the product. admin can manage these description in product management section.', '', 'repurchase', 'a:4:{i:0;a:2:{s:2:\"id\";i:0;s:9:\"file_name\";s:18:\"pro_1532787142.jpg\";}i:1;a:2:{s:2:\"id\";i:1;s:9:\"file_name\";s:19:\"pro_15327871421.jpg\";}i:2;a:14:{s:9:\"file_name\";s:18:\"pro_1532787162.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:74:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_1532787162.jpg\";s:8:\"raw_name\";s:14:\"pro_1532787162\";s:9:\"orig_name\";s:18:\"pro_1532787162.jpg\";s:11:\"client_name\";s:23:\"61btvBcJ3zL__UX385_.jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:7.64;s:8:\"is_image\";b:1;s:11:\"image_width\";i:385;s:12:\"image_height\";i:385;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"385\" height=\"385\"\";}i:3;a:14:{s:9:\"file_name\";s:19:\"pro_15327871621.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:75:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_15327871621.jpg\";s:8:\"raw_name\";s:15:\"pro_15327871621\";s:9:\"orig_name\";s:18:\"pro_1532787162.jpg\";s:11:\"client_name\";s:14:\"images (2).jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:4.45;s:8:\"is_image\";b:1;s:11:\"image_width\";i:225;s:12:\"image_height\";i:225;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"225\" height=\"225\"\";}}', 0, 3500, 0, '0000-00-00 00:00:00', 1),
(9, 'Hair Cream', 5, 0, 10, 24, 'Pro-856333', 1, 0, 5, 'is simply dummy text of the product. admin can manage these description in product management section.', '', 'repurchase', 'a:4:{i:0;a:14:{s:9:\"file_name\";s:18:\"pro_1532787625.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:74:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_1532787625.jpg\";s:8:\"raw_name\";s:14:\"pro_1532787625\";s:9:\"orig_name\";s:18:\"pro_1532787625.jpg\";s:11:\"client_name\";s:19:\"17572-240x300-1.jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:13.73;s:8:\"is_image\";b:1;s:11:\"image_width\";i:240;s:12:\"image_height\";i:300;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"240\" height=\"300\"\";}i:1;a:14:{s:9:\"file_name\";s:19:\"pro_15327876251.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:75:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_15327876251.jpg\";s:8:\"raw_name\";s:15:\"pro_15327876251\";s:9:\"orig_name\";s:18:\"pro_1532787625.jpg\";s:11:\"client_name\";s:14:\"images (4).jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:6.17;s:8:\"is_image\";b:1;s:11:\"image_width\";i:225;s:12:\"image_height\";i:225;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"225\" height=\"225\"\";}i:2;a:14:{s:9:\"file_name\";s:19:\"pro_15327876252.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:75:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_15327876252.jpg\";s:8:\"raw_name\";s:15:\"pro_15327876252\";s:9:\"orig_name\";s:18:\"pro_1532787625.jpg\";s:11:\"client_name\";s:14:\"images (3).jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:7.84;s:8:\"is_image\";b:1;s:11:\"image_width\";i:225;s:12:\"image_height\";i:225;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"225\" height=\"225\"\";}i:3;a:14:{s:9:\"file_name\";s:19:\"pro_15327876253.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:75:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_15327876253.jpg\";s:8:\"raw_name\";s:15:\"pro_15327876253\";s:9:\"orig_name\";s:18:\"pro_1532787625.jpg\";s:11:\"client_name\";s:14:\"images (5).jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:5.2;s:8:\"is_image\";b:1;s:11:\"image_width\";i:207;s:12:\"image_height\";i:243;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"207\" height=\"243\"\";}}', 0, 3500, 0, '0000-00-00 00:00:00', 1),
(10, 'Speakers', 1, 0, 25, 25, 'Pro-675542', 1, 0, 5, 'is simply dummy text of the product. admin can manage these description in product management section.', '', 'repurchase', 'a:4:{i:0;a:14:{s:9:\"file_name\";s:18:\"pro_1532787768.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:74:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_1532787768.jpg\";s:8:\"raw_name\";s:14:\"pro_1532787768\";s:9:\"orig_name\";s:18:\"pro_1532787768.jpg\";s:11:\"client_name\";s:48:\"bluetooth-speaker-with-mobile-holder-250x250.jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:8.12;s:8:\"is_image\";b:1;s:11:\"image_width\";i:250;s:12:\"image_height\";i:250;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"250\" height=\"250\"\";}i:1;a:14:{s:9:\"file_name\";s:19:\"pro_15327877681.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:75:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_15327877681.jpg\";s:8:\"raw_name\";s:15:\"pro_15327877681\";s:9:\"orig_name\";s:18:\"pro_1532787768.jpg\";s:11:\"client_name\";s:19:\"del5968-230x230.jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:6.72;s:8:\"is_image\";b:1;s:11:\"image_width\";i:230;s:12:\"image_height\";i:230;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"230\" height=\"230\"\";}i:2;a:14:{s:9:\"file_name\";s:19:\"pro_15327877682.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:75:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_15327877682.jpg\";s:8:\"raw_name\";s:15:\"pro_15327877682\";s:9:\"orig_name\";s:18:\"pro_1532787768.jpg\";s:11:\"client_name\";s:14:\"images (6).jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:5.9;s:8:\"is_image\";b:1;s:11:\"image_width\";i:225;s:12:\"image_height\";i:225;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"225\" height=\"225\"\";}i:3;a:14:{s:9:\"file_name\";s:19:\"pro_15327877683.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:75:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_15327877683.jpg\";s:8:\"raw_name\";s:15:\"pro_15327877683\";s:9:\"orig_name\";s:18:\"pro_1532787768.jpg\";s:11:\"client_name\";s:14:\"images (7).jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:4.47;s:8:\"is_image\";b:1;s:11:\"image_width\";i:225;s:12:\"image_height\";i:225;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"225\" height=\"225\"\";}}', 0, 3500, 0, '0000-00-00 00:00:00', 1),
(11, 'Service', 5, 0, 149, 149, 'Pro-543355', 1, 10, 5, 'is simply dummy text of the product. admin can manage these description in product management section.', 'yearly', 'repurchase', 'a:0:{}', 0, 3500, 0, '0000-00-00 00:00:00', 1),
(12, 'Smartphones', 1, 1, 250, 250, 'Pro-123445', 2, 10, 5, 'is simply dummy text of the product. admin can manage these description in product management section.', '', 'repurchase', 'a:5:{i:0;a:14:{s:9:\"file_name\";s:18:\"pro_1532788372.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:74:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_1532788372.jpg\";s:8:\"raw_name\";s:14:\"pro_1532788372\";s:9:\"orig_name\";s:18:\"pro_1532788372.jpg\";s:11:\"client_name\";s:46:\"536861_samsung-g925f-galaxy-s6-edge-32gb-1.jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:33.69;s:8:\"is_image\";b:1;s:11:\"image_width\";i:800;s:12:\"image_height\";i:485;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"800\" height=\"485\"\";}i:1;a:14:{s:9:\"file_name\";s:19:\"pro_15327883721.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:75:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_15327883721.jpg\";s:8:\"raw_name\";s:15:\"pro_15327883721\";s:9:\"orig_name\";s:18:\"pro_1532788372.jpg\";s:11:\"client_name\";s:16:\"Samsung-S8-6.jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:54.89;s:8:\"is_image\";b:1;s:11:\"image_width\";i:1280;s:12:\"image_height\";i:775;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:25:\"width=\"1280\" height=\"775\"\";}i:2;a:14:{s:9:\"file_name\";s:19:\"pro_15327883722.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:75:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_15327883722.jpg\";s:8:\"raw_name\";s:15:\"pro_15327883722\";s:9:\"orig_name\";s:18:\"pro_1532788372.jpg\";s:11:\"client_name\";s:33:\"galaxy_note_i-100012101-large.jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:44.19;s:8:\"is_image\";b:1;s:11:\"image_width\";i:580;s:12:\"image_height\";i:362;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"580\" height=\"362\"\";}i:3;a:14:{s:9:\"file_name\";s:19:\"pro_15327883723.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:75:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_15327883723.jpg\";s:8:\"raw_name\";s:15:\"pro_15327883723\";s:9:\"orig_name\";s:18:\"pro_1532788372.jpg\";s:11:\"client_name\";s:16:\"Samsung-S8-6.jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:54.89;s:8:\"is_image\";b:1;s:11:\"image_width\";i:1280;s:12:\"image_height\";i:775;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:25:\"width=\"1280\" height=\"775\"\";}i:4;a:14:{s:9:\"file_name\";s:18:\"pro_1532788373.jpg\";s:9:\"file_type\";s:10:\"image/jpeg\";s:9:\"file_path\";s:56:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/\";s:9:\"full_path\";s:74:\"C:/xampp/htdocs/WC/leadSoft/site/assets/images/products/pro_1532788373.jpg\";s:8:\"raw_name\";s:14:\"pro_1532788373\";s:9:\"orig_name\";s:18:\"pro_1532788373.jpg\";s:11:\"client_name\";s:16:\"download (3).jpg\";s:8:\"file_ext\";s:4:\".jpg\";s:9:\"file_size\";d:5.3;s:8:\"is_image\";b:1;s:11:\"image_width\";i:299;s:12:\"image_height\";i:168;s:10:\"image_type\";s:4:\"jpeg\";s:14:\"image_size_str\";s:24:\"width=\"299\" height=\"168\"\";}}', 0, 3500, 0, '2018-01-15 12:55:37', 1),
(13, 'Shirt', 2, 3, 100, 100, 'Pro-150169', 1, 0, 5, 'is simply dummy text of the product. admin can manage these description in product management section.', '', 'repurchase', 'a:0:{}', 0, 3500, 0, '2018-12-05 20:19:49', 1),
(14, 'Football Boot', 7, 0, 350, 350, 'Pro-456333', 1, 0, 5, 'is simply dummy text of the product. admin can manage these description in product management section.', NULL, 'repurchase', 'a:4:{i:0;a:2:{s:2:\"id\";i:0;s:9:\"file_name\";s:18:\"pro_1532787349.jpg\";}i:1;a:2:{s:2:\"id\";i:1;s:9:\"file_name\";s:19:\"pro_15327873491.jpg\";}i:2;a:2:{s:2:\"id\";i:2;s:9:\"file_name\";s:19:\"pro_15327873492.jpg\";}i:3;a:2:{s:2:\"id\";i:3;s:9:\"file_name\";s:18:\"pro_1532787365.jpg\";}}', 0, 3500, 0, '0000-00-00 00:00:00', 1),
(15, 'Dell', 1, 2, 300, 300, 'Pro-853273', 1, 0, 3, 'is simply dummy text of the product. admin can manage these description in product management section.', NULL, 'repurchase', 'a:0:{}', 0, 3500, 0, '2018-12-05 20:24:43', 1),
(16, 'Head Phone', 1, 7, 75, 75, 'Pro-678444', 1, 10, 5, 'is simply dummy text of the product. admin can manage these description in product management section.', NULL, 'repurchase', 'a:4:{i:0;a:2:{s:2:\"id\";i:0;s:9:\"file_name\";s:18:\"pro_1532659793.jpg\";}i:1;a:2:{s:2:\"id\";i:1;s:9:\"file_name\";s:18:\"pro_1532659833.jpg\";}i:2;a:2:{s:2:\"id\";i:2;s:9:\"file_name\";s:18:\"pro_1532659921.jpg\";}i:3;a:2:{s:2:\"id\";i:3;s:9:\"file_name\";s:19:\"pro_15326599211.jpg\";}}', 0, 3500, 0, '2018-02-19 19:06:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_rank`
--

CREATE TABLE `mlm_rank` (
  `id` int(11) NOT NULL,
  `rank_name` varchar(11) NOT NULL,
  `referal_count` int(30) NOT NULL,
  `total_sales` int(30) NOT NULL,
  `rank_bonus` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_rank`
--

INSERT INTO `mlm_rank` (`id`, `rank_name`, `referal_count`, `total_sales`, `rank_bonus`, `status`) VALUES
(1, 'UserTitle-1', 5, 10, 5, 1),
(2, 'UserTitle-2', 10, 20, 10, 1),
(3, 'UserTitle-3', 15, 30, 15, 1),
(4, 'UserTitle-4', 20, 40, 20, 1),
(5, 'UserTitle-5', 25, 50, 25, 1),
(6, 'UserTitle-6', 30, 60, 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_rank_history`
--

CREATE TABLE `mlm_rank_history` (
  `id` int(11) NOT NULL,
  `mlm_user_id` int(11) NOT NULL,
  `current_rank` int(11) NOT NULL,
  `new_rank` int(11) NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `from_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_referal_bonus_settings`
--

CREATE TABLE `mlm_referal_bonus_settings` (
  `id` int(20) NOT NULL,
  `bonus_type` varchar(20) NOT NULL DEFAULT 'fixed',
  `amount` double NOT NULL,
  `percentage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_referal_bonus_settings`
--

INSERT INTO `mlm_referal_bonus_settings` (`id`, `bonus_type`, `amount`, `percentage`) VALUES
(1, 'fixed', 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_register_fields`
--

CREATE TABLE `mlm_register_fields` (
  `id` int(30) NOT NULL,
  `field_name` varchar(30) NOT NULL,
  `field_name_en` varchar(30) DEFAULT NULL,
  `icon` varchar(20) NOT NULL DEFAULT 'fa-text-width',
  `html_max_length` int(20) NOT NULL,
  `required_status` int(10) NOT NULL DEFAULT 1,
  `unique_status` int(10) NOT NULL DEFAULT 0,
  `register_step` varchar(30) NOT NULL DEFAULT 'step-2',
  `order` int(30) DEFAULT NULL,
  `default_value` varchar(30) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'active',
  `editable_status` int(30) NOT NULL DEFAULT 1,
  `field_type` varchar(30) DEFAULT NULL,
  `radio_value1` varchar(30) NOT NULL DEFAULT 'NA',
  `radio_value2` varchar(30) NOT NULL DEFAULT 'NA',
  `select_option1` varchar(30) NOT NULL DEFAULT 'NA',
  `select_option2` varchar(30) NOT NULL DEFAULT 'NA',
  `select_option3` varchar(30) NOT NULL DEFAULT 'NA',
  `select_option4` varchar(30) NOT NULL DEFAULT 'NA',
  `data_types` varchar(30) DEFAULT NULL,
  `data_type_max_size` int(30) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_register_fields`
--

INSERT INTO `mlm_register_fields` (`id`, `field_name`, `field_name_en`, `icon`, `html_max_length`, `required_status`, `unique_status`, `register_step`, `order`, `default_value`, `status`, `editable_status`, `field_type`, `radio_value1`, `radio_value2`, `select_option1`, `select_option2`, `select_option3`, `select_option4`, `data_types`, `data_type_max_size`, `date`) VALUES
(1, 'sponser_name', 'Sponsor Name', 'fa-user-plus', 18, 1, 0, 'step-1', 1, '', 'active', 0, 'text', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(2, 'register_leg', 'Leg', 'fa-text-width', 0, 1, 0, 'step-1', 2, '', 'active', 0, 'select_box', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(3, 'agree', 'agree', 'fa-text-width', 0, 1, 0, 'step-2', 33, '', 'inactive', 0, 'checkbox', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(4, 'username', 'Username', 'fa-user', 10, 1, 1, 'step-2', 4, '', 'active', 0, 'text', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(5, 'email', 'E_Mail', 'fa-envelope', 0, 1, 1, 'step-2', 5, '', 'active', 0, 'text', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(6, 'password', 'Password', 'fa-lock', 0, 1, 0, 'step-2', 6, '', 'active', 0, 'password', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(7, 'confirm_password', 'Confirm Password', 'fa-lock', 0, 1, 0, 'step-2', 7, '', 'active', 0, 'password', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(8, 'first_name', 'First Name', 'fa-text-width', 15, 1, 0, 'step-2', 8, '', 'active', 0, 'text', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(9, 'last_name', 'Last Name', 'fa-text-width', 15, 0, 0, 'step-2', 9, '', 'active', 0, 'text', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(10, 'phone_number', 'Phone Number', 'fa-mobile-phone', 12, 1, 0, 'step-2', 16, '', 'active', 1, 'text', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(11, 'gender', 'Gender', 'fa-text-width', 0, 1, 0, 'step-2', 11, 'm', 'active', 1, 'radio', 'm', 'f', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(12, 'address', 'Address', 'fa-location-arrow', 0, 1, 0, 'step-2', 12, '', 'active', 1, 'text', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(13, 'country', 'Country', 'fa-text-width', 0, 1, 0, 'step-2', 13, '', 'active', 0, 'select_box', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'int', 30, '2017-10-25 00:00:00'),
(14, 'state', 'State', 'fa-text-width', 0, 0, 0, 'step-2', 14, '', 'active', 0, 'select_box', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'int', 30, '2017-10-25 00:00:00'),
(15, 'city', 'City', 'fa-globe', 20, 0, 0, 'step-2', 15, '', 'active', 1, 'text', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(16, 'zip_code', 'Zip Code', 'fa-skyatlas', 7, 0, 0, 'step-2', 16, '', 'active', 1, 'text', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'int', 30, '2017-10-25 00:00:00'),
(17, 'company_name', 'Company Name', 'fa-text-width', 0, 0, 0, 'step-3', 17, '', 'active', 1, 'text', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00'),
(18, 'company_address', 'Company Address', 'fa-text-width', 0, 0, 0, 'step-3', 18, '', 'active', 1, 'text', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'varchar', 30, '2017-10-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_register_history`
--

CREATE TABLE `mlm_register_history` (
  `id` int(30) NOT NULL,
  `mlm_user_id` int(30) NOT NULL,
  `register_type` varchar(30) DEFAULT NULL,
  `payment_type` varchar(30) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_details` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_register_history`
--

INSERT INTO `mlm_register_history` (`id`, `mlm_user_id`, `register_type`, `payment_type`, `date`, `user_details`) VALUES
(1, 1901, 'single_step', 'free_registration', '2021-03-31 16:39:28', 'a:28:{s:12:\"sponser_name\";s:5:\"admin\";s:8:\"username\";s:7:\"dgdfhfg\";s:8:\"password\";s:8:\"A@010101\";s:16:\"confirm_password\";s:8:\"A@010101\";s:5:\"email\";s:16:\"dgfh@ftrhyt.hjyg\";s:10:\"first_name\";s:7:\"dsgtfdh\";s:9:\"last_name\";s:11:\"rtyhtrfujyt\";s:7:\"country\";s:1:\"2\";s:5:\"state\";s:2:\"35\";s:14:\"privacy_policy\";s:2:\"on\";s:10:\"reg_amount\";i:15;s:5:\"agree\";s:2:\"on\";s:15:\"wallet_username\";s:0:\"\";s:20:\"transaction_password\";s:0:\"\";s:8:\"add_user\";s:17:\"free_registration\";s:15:\"date_of_joining\";s:19:\"2021-03-31 16:39:28\";s:13:\"register_type\";s:11:\"single_step\";s:14:\"payment_method\";s:17:\"free_registration\";s:12:\"order_amount\";i:5;s:17:\"total_amount_data\";a:5:{s:10:\"entree_fee\";s:2:\"10\";s:10:\"pro_amount\";s:1:\"5\";s:15:\"delivery_charge\";s:1:\"0\";s:15:\"shipping_charge\";s:1:\"0\";s:3:\"tax\";s:1:\"0\";}s:18:\"placement_username\";s:0:\"\";s:12:\"register_leg\";s:2:\"NA\";s:10:\"sponsor_id\";s:4:\"1900\";s:3:\"leg\";i:1;s:9:\"father_id\";s:4:\"1900\";s:13:\"del_data_type\";s:4:\"same\";s:11:\"new_user_id\";i:1901;s:10:\"package_id\";s:1:\"1\";}'),
(2, 1902, 'single_step', 'free_registration', '2021-12-18 10:25:01', 'a:29:{s:12:\"sponser_name\";s:5:\"admin\";s:8:\"username\";s:8:\"leaduser\";s:8:\"password\";s:8:\"123456@a\";s:16:\"confirm_password\";s:8:\"123456@a\";s:5:\"email\";s:18:\"usretest@gmail.com\";s:10:\"first_name\";s:7:\"siddeeq\";s:9:\"last_name\";s:2:\"kk\";s:7:\"country\";s:2:\"99\";s:5:\"state\";s:4:\"1428\";s:14:\"privacy_policy\";s:2:\"on\";s:10:\"reg_amount\";i:25;s:5:\"agree\";s:2:\"on\";s:15:\"wallet_username\";s:0:\"\";s:20:\"transaction_password\";s:0:\"\";s:4:\"epin\";a:1:{i:0;s:0:\"\";}s:8:\"add_user\";s:17:\"free_registration\";s:15:\"date_of_joining\";s:19:\"2021-12-18 10:25:01\";s:13:\"register_type\";s:11:\"single_step\";s:14:\"payment_method\";s:17:\"free_registration\";s:12:\"order_amount\";i:15;s:17:\"total_amount_data\";a:5:{s:10:\"entree_fee\";s:2:\"10\";s:10:\"pro_amount\";s:2:\"15\";s:15:\"delivery_charge\";s:1:\"0\";s:15:\"shipping_charge\";s:1:\"0\";s:3:\"tax\";s:1:\"0\";}s:18:\"placement_username\";s:0:\"\";s:12:\"register_leg\";s:2:\"NA\";s:10:\"sponsor_id\";s:4:\"1900\";s:3:\"leg\";i:1;s:9:\"father_id\";s:4:\"1901\";s:13:\"del_data_type\";s:4:\"same\";s:11:\"new_user_id\";i:1902;s:10:\"package_id\";s:1:\"3\";}'),
(3, 1903, 'single_step', 'free_registration', '2021-12-18 11:02:37', 'a:29:{s:12:\"sponser_name\";s:5:\"admin\";s:8:\"username\";s:8:\"testuser\";s:8:\"password\";s:8:\"123456@a\";s:16:\"confirm_password\";s:8:\"123456@a\";s:5:\"email\";s:20:\"usresatest@gmail.com\";s:10:\"first_name\";s:7:\"siddeeq\";s:9:\"last_name\";s:2:\"kk\";s:7:\"country\";s:2:\"99\";s:5:\"state\";s:4:\"1428\";s:14:\"privacy_policy\";s:2:\"on\";s:10:\"reg_amount\";i:20;s:5:\"agree\";s:2:\"on\";s:15:\"wallet_username\";s:0:\"\";s:20:\"transaction_password\";s:0:\"\";s:4:\"epin\";a:1:{i:0;s:0:\"\";}s:8:\"add_user\";s:17:\"free_registration\";s:15:\"date_of_joining\";s:19:\"2021-12-18 11:02:37\";s:13:\"register_type\";s:11:\"single_step\";s:14:\"payment_method\";s:17:\"free_registration\";s:12:\"order_amount\";i:10;s:17:\"total_amount_data\";a:5:{s:10:\"entree_fee\";s:2:\"10\";s:10:\"pro_amount\";s:2:\"10\";s:15:\"delivery_charge\";s:1:\"0\";s:15:\"shipping_charge\";s:1:\"0\";s:3:\"tax\";s:1:\"0\";}s:18:\"placement_username\";s:0:\"\";s:12:\"register_leg\";s:2:\"NA\";s:10:\"sponsor_id\";s:4:\"1900\";s:3:\"leg\";i:1;s:9:\"father_id\";s:4:\"1902\";s:13:\"del_data_type\";s:4:\"same\";s:11:\"new_user_id\";i:1903;s:10:\"package_id\";s:1:\"2\";}');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_reset_folders`
--

CREATE TABLE `mlm_reset_folders` (
  `id` int(20) NOT NULL,
  `folder_path` varchar(100) NOT NULL,
  `required_files` varchar(300) NOT NULL DEFAULT 'index.html,',
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_reset_folders`
--

INSERT INTO `mlm_reset_folders` (`id`, `folder_path`, `required_files`, `status`) VALUES
(1, 'application/backup', 'index.html,', 1),
(2, 'assets/images/attachements', 'index.html,', 1),
(3, 'assets/images/bank_details', 'index.html,', 1),
(4, 'assets/images/documents', 'index.html,aud.mp3,doc.pdf,image02.jpg,image03.jpg,image06.jpg,image07_th.jpg,image08.jpg,image12.jpg,img.jpg,img2.png,img3.jpg,no_aud.png,no_doc.jpg,no_img.jpg,no_vdo.jpg,vdo.mp4,', 1),
(5, 'assets/images/employees', 'index.html,no_user.jpg,', 1),
(6, 'assets/images/id_proof', 'index.html,', 1),
(7, 'assets/images/mail_system', 'index.html,', 1),
(8, 'assets/images/news', 'index.html,no_news.png,', 1),
(9, 'assets/images/party', 'index.html,party.png,', 1),
(10, 'assets/images/tickets', 'index.html,', 1),
(11, 'assets/images/users', 'index.html,active.png,inactive.png,no_cover.jpg,no_user.jpg,admin-cover.jpg,admin-logo.jpg,', 1),
(12, 'assets/excel/migration', 'index.html,binary.xlsx,other.xlsx,', 1),
(13, 'assets/images/kyc', 'index.html,kyc.jpeg,', 1),
(14, 'application/backup/optimize', 'index.html,', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_reset_password`
--

CREATE TABLE `mlm_reset_password` (
  `id` int(20) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_return`
--

CREATE TABLE `mlm_return` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `ord_pro_id` int(20) NOT NULL,
  `product_id` int(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_review`
--

CREATE TABLE `mlm_review` (
  `id` int(11) NOT NULL,
  `summery` varchar(100) NOT NULL,
  `description` tinytext NOT NULL,
  `date` datetime NOT NULL,
  `rating` float NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_review`
--

INSERT INTO `mlm_review` (`id`, `summery`, `description`, `date`, `rating`, `product_id`, `username`, `userid`) VALUES
(18, 'test summery', ' e.preventDefault();', '2018-10-14 17:27:07', 3, 10, 'admin', NULL),
(19, 'test summery', ' e.preventDefault();', '2018-10-14 17:27:28', 3, 10, NULL, NULL),
(20, 'dfsgds', 'fgdsfg', '2018-10-14 17:27:50', 3, 10, NULL, NULL),
(21, '------------------', '--------------------', '2018-10-14 18:30:34', 3, 11, 'admin', NULL),
(22, 'dfsgdsf', 'gddfsgdfg', '2018-10-14 18:30:56', 3, 11, NULL, NULL),
(23, 'dfsgdsf', 'gddfsgdfg', '2018-10-14 18:31:55', 3, 11, NULL, NULL),
(24, 'dfsgdsf', 'gddfsgdfg', '2018-10-14 18:31:55', 3, 11, NULL, NULL),
(25, 'dfsgdsf', 'gddfsgdfg', '2018-10-14 18:31:56', 3, 11, NULL, NULL),
(26, 'dfsgdsf', 'gddfsgdfg', '2018-10-14 18:31:56', 3, 11, NULL, NULL),
(27, 'sdafsadf', 'sadfsadfsad', '2018-10-14 18:32:28', 3, 7, NULL, NULL),
(28, 'sdafsadf', 'sadfsadfsad', '2018-10-14 18:33:12', 3, 7, NULL, NULL),
(29, 'sdafsadf', 'sadfsadfsad', '2018-10-14 18:33:13', 3, 7, NULL, NULL),
(30, 'sdafsadf', 'sadfsadfsad', '2018-10-14 18:33:13', 3, 7, NULL, NULL),
(31, 'sdafsadf', 'sadfsadfsad', '2018-10-14 18:33:14', 3, 7, NULL, NULL),
(32, 'fasd', 'fsadf', '2018-10-14 18:33:28', 3, 13, NULL, NULL),
(33, 'sadf', 'sadfsadf', '2018-10-14 18:33:39', 3, 13, NULL, NULL),
(34, 'gdsf', 'gdsfg', '2018-10-14 18:35:54', 3, 13, NULL, NULL),
(35, 'gdsf', 'gdsfg', '2018-10-14 18:39:53', 3, 13, NULL, NULL),
(36, 'test summery', 'rfdhdfhdfg', '2018-10-14 18:40:14', 3, 12, NULL, NULL),
(37, 'yreyer', 'yrreeeeeeeeeeeeeeeeeeee', '2018-10-14 18:40:41', 3, 12, NULL, NULL),
(38, 'yreyer', 'yrreeeeeeeeeeeeeeeeeeee', '2018-10-14 18:49:02', 3, 12, NULL, NULL),
(39, 'yreyer', 'yrreeeeeeeeeeeeeeeeeeee', '2018-10-14 18:49:03', 3, 12, NULL, NULL),
(40, 'yreyer', 'yrreeeeeeeeeeeeeeeeeeee', '2018-10-14 18:49:03', 3, 12, NULL, NULL),
(41, 'yreyer', 'yrreeeeeeeeeeeeeeeeeeee', '2018-10-14 18:49:03', 3, 12, NULL, NULL),
(42, 'yreyer', 'yrreeeeeeeeeeeeeeeeeeee', '2018-10-14 18:49:04', 3, 12, NULL, NULL),
(43, 'yreyer', 'yrreeeeeeeeeeeeeeeeeeee', '2018-10-14 18:49:04', 3, 12, NULL, NULL),
(44, 'yreyer', 'yrreeeeeeeeeeeeeeeeeeee', '2018-10-14 18:49:05', 3, 12, NULL, NULL),
(45, 'admin', 'admin', '2018-10-14 19:42:50', 3, 20, 'admin', NULL),
(46, 'asdfra', 'sdfsadf', '2018-10-15 11:03:48', 3, 20, 'admin', 1900),
(47, 'sadfsad', 'fasdf', '2018-10-15 11:03:57', 3, 20, 'admin', 1900),
(48, 'aSDAS', 'FDSAFSADF', '2018-10-15 11:05:48', 3, 14, 'admin', 1900);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_site_info`
--

CREATE TABLE `mlm_site_info` (
  `id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  `company_logo` varchar(50) NOT NULL,
  `company_fav_icon` varchar(50) NOT NULL,
  `company_address` text NOT NULL,
  `company_email` varchar(50) NOT NULL,
  `company_phone` mediumtext NOT NULL,
  `google_analytics` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_site_info`
--

INSERT INTO `mlm_site_info` (`id`, `company_name`, `admin_email`, `company_logo`, `company_fav_icon`, `company_address`, `company_email`, `company_phone`, `google_analytics`) VALUES
(1, 'Lead MLM', 'na', 'logo.png', 'fav.png', '<p><strong>Techffodils Technologies</strong><br>\r\nCalicut Business Centre, Kallai, Kozhikode<br>\r\n6730031</p>', 'support@leadmlm.in', '+91 9946345177', '(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m[removed].insertBefore(a,m) })(window,document,\'script\',\'https://www.google-analytics.com/analytics.js\',\'ga\');  ga(\'create\', \'UA-XXXXX-Y\', \'auto\'); ga(\'send\', \'pageview\');');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_stair_step_settings`
--

CREATE TABLE `mlm_stair_step_settings` (
  `id` int(11) NOT NULL,
  `stair_step` int(11) NOT NULL,
  `qualifying_legs` int(11) NOT NULL DEFAULT 0,
  `group_volume` int(11) NOT NULL DEFAULT 0,
  `percentage` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_stair_step_settings`
--

INSERT INTO `mlm_stair_step_settings` (`id`, `stair_step`, `qualifying_legs`, `group_volume`, `percentage`) VALUES
(1, 1, 7, 100, 3),
(2, 2, 2, 200, 4),
(3, 3, 3, 300, 5),
(4, 4, 4, 400, 6),
(5, 5, 5, 500, 7);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_states`
--

CREATE TABLE `mlm_states` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_name` varchar(500) DEFAULT NULL,
  `code` varchar(80) DEFAULT NULL,
  `reg_count` smallint(5) NOT NULL DEFAULT 0,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_states`
--

INSERT INTO `mlm_states` (`id`, `country_id`, `state_name`, `code`, `reg_count`, `status`) VALUES
(1, 1, 'Badakhshan', 'BDS', 0, 1),
(2, 1, 'Badghis', 'BDG', 0, 1),
(3, 1, 'Baghlan', 'BGL', 0, 1),
(4, 1, 'Balkh', 'BAL', 0, 1),
(5, 1, 'Bamian', 'BAM', 0, 1),
(6, 1, 'Farah', 'FRA', 0, 1),
(7, 1, 'Faryab', 'FYB', 0, 1),
(8, 1, 'Ghazni', 'GHA', 0, 1),
(9, 1, 'Ghowr', 'GHO', 0, 1),
(10, 1, 'Helmand', 'HEL', 0, 1),
(11, 1, 'Herat', 'HER', 0, 1),
(12, 1, 'Jowzjan', 'JOW', 0, 1),
(13, 1, 'Kabul', 'KAB', 0, 1),
(14, 1, 'Kandahar', 'KAN', 0, 1),
(15, 1, 'Kapisa', 'KAP', 0, 1),
(16, 1, 'Khost', 'KHO', 0, 1),
(17, 1, 'Konar', 'KNR', 0, 1),
(18, 1, 'Kondoz', 'KDZ', 0, 1),
(19, 1, 'Laghman', 'LAG', 0, 1),
(20, 1, 'Lowgar', 'LOW', 0, 1),
(21, 1, 'Nangrahar', 'NAN', 0, 1),
(22, 1, 'Nimruz', 'NIM', 0, 1),
(23, 1, 'Nurestan', 'NUR', 0, 1),
(24, 1, 'Oruzgan', 'ORU', 0, 1),
(25, 1, 'Paktia', 'PIA', 0, 1),
(26, 1, 'Paktika', 'PKA', 0, 1),
(27, 1, 'Parwan', 'PAR', 0, 1),
(28, 1, 'Samangan', 'SAM', 0, 1),
(29, 1, 'Sar-e Pol', 'SAR', 0, 1),
(30, 1, 'Takhar', 'TAK', 0, 1),
(31, 1, 'Wardak', 'WAR', 0, 1),
(32, 1, 'Zabol', 'ZAB', 0, 1),
(33, 2, 'Berat', 'BR', 0, 1),
(34, 2, 'Bulqize', 'BU', 0, 1),
(35, 2, 'Delvine', 'DL', 1, 1),
(36, 2, 'Devoll', 'DV', 0, 1),
(37, 2, 'Diber', 'DI', 0, 1),
(38, 2, 'Durres', 'DR', 0, 1),
(39, 2, 'Elbasan', 'EL', 0, 1),
(40, 2, 'Kolonje', 'ER', 0, 1),
(41, 2, 'Fier', 'FR', 0, 1),
(42, 2, 'Gjirokaster', 'GJ', 0, 1),
(43, 2, 'Gramsh', 'GR', 0, 1),
(44, 2, 'Has', 'HA', 0, 1),
(45, 2, 'Kavaje', 'KA', 0, 1),
(46, 2, 'Kurbin', 'KB', 0, 1),
(47, 2, 'Kucove', 'KC', 0, 1),
(48, 2, 'Korce', 'KO', 0, 1),
(49, 2, 'Kruje', 'KR', 0, 1),
(50, 2, 'Kukes', 'KU', 0, 1),
(51, 2, 'Librazhd', 'LB', 0, 1),
(52, 2, 'Lezhe', 'LE', 0, 1),
(53, 2, 'Lushnje', 'LU', 0, 1),
(54, 2, 'Malesi e Madhe', 'MM', 0, 1),
(55, 2, 'Mallakaster', 'MK', 0, 1),
(56, 2, 'Mat', 'MT', 0, 1),
(57, 2, 'Mirdite', 'MR', 0, 1),
(58, 2, 'Peqin', 'PQ', 0, 1),
(59, 2, 'Permet', 'PR', 0, 1),
(60, 2, 'Pogradec', 'PG', 0, 1),
(61, 2, 'Puke', 'PU', 0, 1),
(62, 2, 'Shkoder', 'SH', 0, 1),
(63, 2, 'Skrapar', 'SK', 0, 1),
(64, 2, 'Sarande', 'SR', 0, 1),
(65, 2, 'Tepelene', 'TE', 0, 1),
(66, 2, 'Tropoje', 'TP', 0, 1),
(67, 2, 'Tirane', 'TR', 0, 1),
(68, 2, 'Vlore', 'VL', 0, 1),
(69, 3, 'Adrar', 'ADR', 0, 1),
(70, 3, 'Ain Defla', 'ADE', 0, 1),
(71, 3, 'Ain Temouchent', 'ATE', 0, 1),
(72, 3, 'Alger', 'ALG', 0, 1),
(73, 3, 'Annaba', 'ANN', 0, 1),
(74, 3, 'Batna', 'BAT', 0, 1),
(75, 3, 'Bechar', 'BEC', 0, 1),
(76, 3, 'Bejaia', 'BEJ', 0, 1),
(77, 3, 'Biskra', 'BIS', 0, 1),
(78, 3, 'Blida', 'BLI', 0, 1),
(79, 3, 'Bordj Bou Arreridj', 'BBA', 0, 1),
(80, 3, 'Bouira', 'BOA', 0, 1),
(81, 3, 'Boumerdes', 'BMD', 0, 1),
(82, 3, 'Chlef', 'CHL', 0, 1),
(83, 3, 'Constantine', 'CON', 0, 1),
(84, 3, 'Djelfa', 'DJE', 0, 1),
(85, 3, 'El Bayadh', 'EBA', 0, 1),
(86, 3, 'El Oued', 'EOU', 0, 1),
(87, 3, 'El Tarf', 'ETA', 0, 1),
(88, 3, 'Ghardaia', 'GHA', 0, 1),
(89, 3, 'Guelma', 'GUE', 0, 1),
(90, 3, 'Illizi', 'ILL', 0, 1),
(91, 3, 'Jijel', 'JIJ', 0, 1),
(92, 3, 'Khenchela', 'KHE', 0, 1),
(93, 3, 'Laghouat', 'LAG', 0, 1),
(94, 3, 'Muaskar', 'MUA', 0, 1),
(95, 3, 'Medea', 'MED', 0, 1),
(96, 3, 'Mila', 'MIL', 0, 1),
(97, 3, 'Mostaganem', 'MOS', 0, 1),
(98, 3, 'M\'Sila', 'MSI', 0, 1),
(99, 3, 'Naama', 'NAA', 0, 1),
(100, 3, 'Oran', 'ORA', 0, 1),
(101, 3, 'Ouargla', 'OUA', 0, 1),
(102, 3, 'Oum el-Bouaghi', 'OEB', 0, 1),
(103, 3, 'Relizane', 'REL', 0, 1),
(104, 3, 'Saida', 'SAI', 0, 1),
(105, 3, 'Setif', 'SET', 0, 1),
(106, 3, 'Sidi Bel Abbes', 'SBA', 0, 1),
(107, 3, 'Skikda', 'SKI', 0, 1),
(108, 3, 'Souk Ahras', 'SAH', 0, 1),
(109, 3, 'Tamanghasset', 'TAM', 0, 1),
(110, 3, 'Tebessa', 'TEB', 0, 1),
(111, 3, 'Tiaret', 'TIA', 0, 1),
(112, 3, 'Tindouf', 'TIN', 0, 1),
(113, 3, 'Tipaza', 'TIP', 0, 1),
(114, 3, 'Tissemsilt', 'TIS', 0, 1),
(115, 3, 'Tizi Ouzou', 'TOU', 0, 1),
(116, 3, 'Tlemcen', 'TLE', 0, 1),
(117, 4, 'Eastern', 'E', 0, 1),
(118, 4, 'Manu\'a', 'M', 0, 1),
(119, 4, 'Rose Island', 'R', 0, 1),
(120, 4, 'Swains Island', 'S', 0, 1),
(121, 4, 'Western', 'W', 0, 1),
(122, 5, 'Andorra la Vella', 'ALV', 0, 1),
(123, 5, 'Canillo', 'CAN', 0, 1),
(124, 5, 'Encamp', 'ENC', 0, 1),
(125, 5, 'Escaldes-Engordany', 'ESE', 0, 1),
(126, 5, 'La Massana', 'LMA', 0, 1),
(127, 5, 'Ordino', 'ORD', 0, 1),
(128, 5, 'Sant Julia de Loria', 'SJL', 0, 1),
(129, 6, 'Bengo', 'BGO', 0, 1),
(130, 6, 'Benguela', 'BGU', 0, 1),
(131, 6, 'Bie', 'BIE', 0, 1),
(132, 6, 'Cabinda', 'CAB', 0, 1),
(133, 6, 'Cuando-Cubango', 'CCU', 0, 1),
(134, 6, 'Cuanza Norte', 'CNO', 0, 1),
(135, 6, 'Cuanza Sul', 'CUS', 0, 1),
(136, 6, 'Cunene', 'CNN', 0, 1),
(137, 6, 'Huambo', 'HUA', 0, 1),
(138, 6, 'Huila', 'HUI', 0, 1),
(139, 6, 'Luanda', 'LUA', 0, 1),
(140, 6, 'Lunda Norte', 'LNO', 0, 1),
(141, 6, 'Lunda Sul', 'LSU', 0, 1),
(142, 6, 'Malange', 'MAL', 0, 1),
(143, 6, 'Moxico', 'MOX', 0, 1),
(144, 6, 'Namibe', 'NAM', 0, 1),
(145, 6, 'Uige', 'UIG', 0, 1),
(146, 6, 'Zaire', 'ZAI', 0, 1),
(147, 9, 'Saint George', 'ASG', 0, 1),
(148, 9, 'Saint John', 'ASJ', 0, 1),
(149, 9, 'Saint Mary', 'ASM', 0, 1),
(150, 9, 'Saint Paul', 'ASL', 0, 1),
(151, 9, 'Saint Peter', 'ASR', 0, 1),
(152, 9, 'Saint Philip', 'ASH', 0, 1),
(153, 9, 'Barbuda', 'BAR', 0, 1),
(154, 9, 'Redonda', 'RED', 0, 1),
(155, 10, 'Antartida e Islas del Atlantico', 'AN', 0, 1),
(156, 10, 'Buenos Aires', 'BA', 0, 1),
(157, 10, 'Catamarca', 'CA', 0, 1),
(158, 10, 'Chaco', 'CH', 0, 1),
(159, 10, 'Chubut', 'CU', 0, 1),
(160, 10, 'Cordoba', 'CO', 0, 1),
(161, 10, 'Corrientes', 'CR', 0, 1),
(162, 10, 'Distrito Federal', 'DF', 0, 1),
(163, 10, 'Entre Rios', 'ER', 0, 1),
(164, 10, 'Formosa', 'FO', 0, 1),
(165, 10, 'Jujuy', 'JU', 0, 1),
(166, 10, 'La Pampa', 'LP', 0, 1),
(167, 10, 'La Rioja', 'LR', 0, 1),
(168, 10, 'Mendoza', 'ME', 0, 1),
(169, 10, 'Misiones', 'MI', 0, 1),
(170, 10, 'Neuquen', 'NE', 0, 1),
(171, 10, 'Rio Negro', 'RN', 0, 1),
(172, 10, 'Salta', 'SA', 0, 1),
(173, 10, 'San Juan', 'SJ', 0, 1),
(174, 10, 'San Luis', 'SL', 0, 1),
(175, 10, 'Santa Cruz', 'SC', 0, 1),
(176, 10, 'Santa Fe', 'SF', 0, 1),
(177, 10, 'Santiago del Estero', 'SD', 0, 1),
(178, 10, 'Tierra del Fuego', 'TF', 0, 1),
(179, 10, 'Tucuman', 'TU', 0, 1),
(180, 11, 'Aragatsotn', 'AGT', 0, 1),
(181, 11, 'Ararat', 'ARR', 0, 1),
(182, 11, 'Armavir', 'ARM', 0, 1),
(183, 11, 'Geghark\'unik\'', 'GEG', 0, 1),
(184, 11, 'Kotayk\'', 'KOT', 0, 1),
(185, 11, 'Lorri', 'LOR', 0, 1),
(186, 11, 'Shirak', 'SHI', 0, 1),
(187, 11, 'Syunik\'', 'SYU', 0, 1),
(188, 11, 'Tavush', 'TAV', 0, 1),
(189, 11, 'Vayots\' Dzor', 'VAY', 0, 1),
(190, 11, 'Yerevan', 'YER', 0, 1),
(191, 13, 'Australian Capital Territory', 'ACT', 0, 1),
(192, 13, 'New South Wales', 'NSW', 0, 1),
(193, 13, 'Northern Territory', 'NT', 0, 1),
(194, 13, 'Queensland', 'QLD', 0, 1),
(195, 13, 'South Australia', 'SA', 0, 1),
(196, 13, 'Tasmania', 'TAS', 0, 1),
(197, 13, 'Victoria', 'VIC', 0, 1),
(198, 13, 'Western Australia', 'WA', 0, 1),
(199, 14, 'Burgenland', 'BUR', 0, 1),
(200, 14, 'KÃ¤rnten', 'KAR', 0, 1),
(201, 14, 'NiederÃ¶sterreich', 'NOS', 0, 1),
(202, 14, 'OberÃ¶sterreich', 'OOS', 0, 1),
(203, 14, 'Salzburg', 'SAL', 0, 1),
(204, 14, 'Steiermark', 'STE', 0, 1),
(205, 14, 'Tirol', 'TIR', 0, 1),
(206, 14, 'Vorarlberg', 'VOR', 0, 1),
(207, 14, 'Wien', 'WIE', 0, 1),
(208, 15, 'Ali Bayramli', 'AB', 0, 1),
(209, 15, 'Abseron', 'ABS', 0, 1),
(210, 15, 'AgcabAdi', 'AGC', 0, 1),
(211, 15, 'Agdam', 'AGM', 0, 1),
(212, 15, 'Agdas', 'AGS', 0, 1),
(213, 15, 'Agstafa', 'AGA', 0, 1),
(214, 15, 'Agsu', 'AGU', 0, 1),
(215, 15, 'Astara', 'AST', 0, 1),
(216, 15, 'Baki', 'BA', 0, 1),
(217, 15, 'BabAk', 'BAB', 0, 1),
(218, 15, 'BalakAn', 'BAL', 0, 1),
(219, 15, 'BArdA', 'BAR', 0, 1),
(220, 15, 'Beylaqan', 'BEY', 0, 1),
(221, 15, 'Bilasuvar', 'BIL', 0, 1),
(222, 15, 'Cabrayil', 'CAB', 0, 1),
(223, 15, 'Calilabab', 'CAL', 0, 1),
(224, 15, 'Culfa', 'CUL', 0, 1),
(225, 15, 'Daskasan', 'DAS', 0, 1),
(226, 15, 'Davaci', 'DAV', 0, 1),
(227, 15, 'Fuzuli', 'FUZ', 0, 1),
(228, 15, 'Ganca', 'GA', 0, 1),
(229, 15, 'Gadabay', 'GAD', 0, 1),
(230, 15, 'Goranboy', 'GOR', 0, 1),
(231, 15, 'Goycay', 'GOY', 0, 1),
(232, 15, 'Haciqabul', 'HAC', 0, 1),
(233, 15, 'Imisli', 'IMI', 0, 1),
(234, 15, 'Ismayilli', 'ISM', 0, 1),
(235, 15, 'Kalbacar', 'KAL', 0, 1),
(236, 15, 'Kurdamir', 'KUR', 0, 1),
(237, 15, 'Lankaran', 'LA', 0, 1),
(238, 15, 'Lacin', 'LAC', 0, 1),
(239, 15, 'Lankaran', 'LAN', 0, 1),
(240, 15, 'Lerik', 'LER', 0, 1),
(241, 15, 'Masalli', 'MAS', 0, 1),
(242, 15, 'Mingacevir', 'MI', 0, 1),
(243, 15, 'Naftalan', 'NA', 0, 1),
(244, 15, 'Neftcala', 'NEF', 0, 1),
(245, 15, 'Oguz', 'OGU', 0, 1),
(246, 15, 'Ordubad', 'ORD', 0, 1),
(247, 15, 'Qabala', 'QAB', 0, 1),
(248, 15, 'Qax', 'QAX', 0, 1),
(249, 15, 'Qazax', 'QAZ', 0, 1),
(250, 15, 'Qobustan', 'QOB', 0, 1),
(251, 15, 'Quba', 'QBA', 0, 1),
(252, 15, 'Qubadli', 'QBI', 0, 1),
(253, 15, 'Qusar', 'QUS', 0, 1),
(254, 15, 'Saki', 'SA', 0, 1),
(255, 15, 'Saatli', 'SAT', 0, 1),
(256, 15, 'Sabirabad', 'SAB', 0, 1),
(257, 15, 'Sadarak', 'SAD', 0, 1),
(258, 15, 'Sahbuz', 'SAH', 0, 1),
(259, 15, 'Saki', 'SAK', 0, 1),
(260, 15, 'Salyan', 'SAL', 0, 1),
(261, 15, 'Sumqayit', 'SM', 0, 1),
(262, 15, 'Samaxi', 'SMI', 0, 1),
(263, 15, 'Samkir', 'SKR', 0, 1),
(264, 15, 'Samux', 'SMX', 0, 1),
(265, 15, 'Sarur', 'SAR', 0, 1),
(266, 15, 'Siyazan', 'SIY', 0, 1),
(267, 15, 'Susa', 'SS', 0, 1),
(268, 15, 'Susa', 'SUS', 0, 1),
(269, 15, 'Tartar', 'TAR', 0, 1),
(270, 15, 'Tovuz', 'TOV', 0, 1),
(271, 15, 'Ucar', 'UCA', 0, 1),
(272, 15, 'Xankandi', 'XA', 0, 1),
(273, 15, 'Xacmaz', 'XAC', 0, 1),
(274, 15, 'Xanlar', 'XAN', 0, 1),
(275, 15, 'Xizi', 'XIZ', 0, 1),
(276, 15, 'Xocali', 'XCI', 0, 1),
(277, 15, 'Xocavand', 'XVD', 0, 1),
(278, 15, 'Yardimli', 'YAR', 0, 1),
(279, 15, 'Yevlax', 'YEV', 0, 1),
(280, 15, 'Zangilan', 'ZAN', 0, 1),
(281, 15, 'Zaqatala', 'ZAQ', 0, 1),
(282, 15, 'Zardab', 'ZAR', 0, 1),
(283, 15, 'Naxcivan', 'NX', 0, 1),
(284, 16, 'Acklins', 'ACK', 0, 1),
(285, 16, 'Berry Islands', 'BER', 0, 1),
(286, 16, 'Bimini', 'BIM', 0, 1),
(287, 16, 'Black Point', 'BLK', 0, 1),
(288, 16, 'Cat Island', 'CAT', 0, 1),
(289, 16, 'Central Abaco', 'CAB', 0, 1),
(290, 16, 'Central Andros', 'CAN', 0, 1),
(291, 16, 'Central Eleuthera', 'CEL', 0, 1),
(292, 16, 'City of Freeport', 'FRE', 0, 1),
(293, 16, 'Crooked Island', 'CRO', 0, 1),
(294, 16, 'East Grand Bahama', 'EGB', 0, 1),
(295, 16, 'Exuma', 'EXU', 0, 1),
(296, 16, 'Grand Cay', 'GRD', 0, 1),
(297, 16, 'Harbour Island', 'HAR', 0, 1),
(298, 16, 'Hope Town', 'HOP', 0, 1),
(299, 16, 'Inagua', 'INA', 0, 1),
(300, 16, 'Long Island', 'LNG', 0, 1),
(301, 16, 'Mangrove Cay', 'MAN', 0, 1),
(302, 16, 'Mayaguana', 'MAY', 0, 1),
(303, 16, 'Moore\'s Island', 'MOO', 0, 1),
(304, 16, 'North Abaco', 'NAB', 0, 1),
(305, 16, 'North Andros', 'NAN', 0, 1),
(306, 16, 'North Eleuthera', 'NEL', 0, 1),
(307, 16, 'Ragged Island', 'RAG', 0, 1),
(308, 16, 'Rum Cay', 'RUM', 0, 1),
(309, 16, 'San Salvador', 'SAL', 0, 1),
(310, 16, 'South Abaco', 'SAB', 0, 1),
(311, 16, 'South Andros', 'SAN', 0, 1),
(312, 16, 'South Eleuthera', 'SEL', 0, 1),
(313, 16, 'Spanish Wells', 'SWE', 0, 1),
(314, 16, 'West Grand Bahama', 'WGB', 0, 1),
(315, 17, 'Capital', 'CAP', 0, 1),
(316, 17, 'Central', 'CEN', 0, 1),
(317, 17, 'Muharraq', 'MUH', 0, 1),
(318, 17, 'Northern', 'NOR', 0, 1),
(319, 17, 'Southern', 'SOU', 0, 1),
(320, 18, 'Barisal', 'BAR', 0, 1),
(321, 18, 'Chittagong', 'CHI', 0, 1),
(322, 18, 'Dhaka', 'DHA', 0, 1),
(323, 18, 'Khulna', 'KHU', 0, 1),
(324, 18, 'Rajshahi', 'RAJ', 0, 1),
(325, 18, 'Sylhet', 'SYL', 0, 1),
(326, 19, 'Christ Church', 'CC', 0, 1),
(327, 19, 'Saint Andrew', 'AND', 0, 1),
(328, 19, 'Saint George', 'GEO', 0, 1),
(329, 19, 'Saint James', 'JAM', 0, 1),
(330, 19, 'Saint John', 'JOH', 0, 1),
(331, 19, 'Saint Joseph', 'JOS', 0, 1),
(332, 19, 'Saint Lucy', 'LUC', 0, 1),
(333, 19, 'Saint Michael', 'MIC', 0, 1),
(334, 19, 'Saint Peter', 'PET', 0, 1),
(335, 19, 'Saint Philip', 'PHI', 0, 1),
(336, 19, 'Saint Thomas', 'THO', 0, 1),
(337, 20, 'Brestskaya (Brest)', 'BR', 0, 1),
(338, 20, 'Homyel\'skaya (Homyel\')', 'HO', 0, 1),
(339, 20, 'Horad Minsk', 'HM', 0, 1),
(340, 20, 'Hrodzyenskaya (Hrodna)', 'HR', 0, 1),
(341, 20, 'Mahilyowskaya (Mahilyow)', 'MA', 0, 1),
(342, 20, 'Minskaya', 'MI', 0, 1),
(343, 20, 'Vitsyebskaya (Vitsyebsk)', 'VI', 0, 1),
(344, 21, 'Antwerpen', 'VAN', 0, 1),
(345, 21, 'Brabant Wallon', 'WBR', 0, 1),
(346, 21, 'Hainaut', 'WHT', 0, 1),
(347, 21, 'LiÃ¨ge', 'WLG', 0, 1),
(348, 21, 'Limburg', 'VLI', 0, 1),
(349, 21, 'Luxembourg', 'WLX', 0, 1),
(350, 21, 'Namur', 'WNA', 0, 1),
(351, 21, 'Oost-Vlaanderen', 'VOV', 0, 1),
(352, 21, 'Vlaams Brabant', 'VBR', 0, 1),
(353, 21, 'West-Vlaanderen', 'VWV', 0, 1),
(354, 22, 'Belize', 'BZ', 0, 1),
(355, 22, 'Cayo', 'CY', 0, 1),
(356, 22, 'Corozal', 'CR', 0, 1),
(357, 22, 'Orange Walk', 'OW', 0, 1),
(358, 22, 'Stann Creek', 'SC', 0, 1),
(359, 22, 'Toledo', 'TO', 0, 1),
(360, 23, 'Alibori', 'AL', 0, 1),
(361, 23, 'Atakora', 'AK', 0, 1),
(362, 23, 'Atlantique', 'AQ', 0, 1),
(363, 23, 'Borgou', 'BO', 0, 1),
(364, 23, 'Collines', 'CO', 0, 1),
(365, 23, 'Donga', 'DO', 0, 1),
(366, 23, 'Kouffo', 'KO', 0, 1),
(367, 23, 'Littoral', 'LI', 0, 1),
(368, 23, 'Mono', 'MO', 0, 1),
(369, 23, 'Oueme', 'OU', 0, 1),
(370, 23, 'Plateau', 'PL', 0, 1),
(371, 23, 'Zou', 'ZO', 0, 1),
(372, 24, 'Devonshire', 'DS', 0, 1),
(373, 24, 'Hamilton City', 'HC', 0, 1),
(374, 24, 'Hamilton', 'HA', 0, 1),
(375, 24, 'Paget', 'PG', 0, 1),
(376, 24, 'Pembroke', 'PB', 0, 1),
(377, 24, 'Saint George City', 'GC', 0, 1),
(378, 24, 'Saint George\'s', 'SG', 0, 1),
(379, 24, 'Sandys', 'SA', 0, 1),
(380, 24, 'Smith\'s', 'SM', 0, 1),
(381, 24, 'Southampton', 'SH', 0, 1),
(382, 24, 'Warwick', 'WA', 0, 1),
(383, 25, 'Bumthang', 'BUM', 0, 1),
(384, 25, 'Chukha', 'CHU', 0, 1),
(385, 25, 'Dagana', 'DAG', 0, 1),
(386, 25, 'Gasa', 'GAS', 0, 1),
(387, 25, 'Haa', 'HAA', 0, 1),
(388, 25, 'Lhuntse', 'LHU', 0, 1),
(389, 25, 'Mongar', 'MON', 0, 1),
(390, 25, 'Paro', 'PAR', 0, 1),
(391, 25, 'Pemagatshel', 'PEM', 0, 1),
(392, 25, 'Punakha', 'PUN', 0, 1),
(393, 25, 'Samdrup Jongkhar', 'SJO', 0, 1),
(394, 25, 'Samtse', 'SAT', 0, 1),
(395, 25, 'Sarpang', 'SAR', 0, 1),
(396, 25, 'Thimphu', 'THI', 0, 1),
(397, 25, 'Trashigang', 'TRG', 0, 1),
(398, 25, 'Trashiyangste', 'TRY', 0, 1),
(399, 25, 'Trongsa', 'TRO', 0, 1),
(400, 25, 'Tsirang', 'TSI', 0, 1),
(401, 25, 'Wangdue Phodrang', 'WPH', 0, 1),
(402, 25, 'Zhemgang', 'ZHE', 0, 1),
(403, 26, 'Beni', 'BEN', 0, 1),
(404, 26, 'Chuquisaca', 'CHU', 0, 1),
(405, 26, 'Cochabamba', 'COC', 0, 1),
(406, 26, 'La Paz', 'LPZ', 0, 1),
(407, 26, 'Oruro', 'ORU', 0, 1),
(408, 26, 'Pando', 'PAN', 0, 1),
(409, 26, 'Potosi', 'POT', 0, 1),
(410, 26, 'Santa Cruz', 'SCZ', 0, 1),
(411, 26, 'Tarija', 'TAR', 0, 1),
(412, 27, 'Brcko district', 'BRO', 0, 1),
(413, 27, 'Unsko-Sanski Kanton', 'FUS', 0, 1),
(414, 27, 'Posavski Kanton', 'FPO', 0, 1),
(415, 27, 'Tuzlanski Kanton', 'FTU', 0, 1),
(416, 27, 'Zenicko-Dobojski Kanton', 'FZE', 0, 1),
(417, 27, 'Bosanskopodrinjski Kanton', 'FBP', 0, 1),
(418, 27, 'Srednjebosanski Kanton', 'FSB', 0, 1),
(419, 27, 'Hercegovacko-neretvanski Kanton', 'FHN', 0, 1),
(420, 27, 'Zapadnohercegovacka Zupanija', 'FZH', 0, 1),
(421, 27, 'Kanton Sarajevo', 'FSA', 0, 1),
(422, 27, 'Zapadnobosanska', 'FZA', 0, 1),
(423, 27, 'Banja Luka', 'SBL', 0, 1),
(424, 27, 'Doboj', 'SDO', 0, 1),
(425, 27, 'Bijeljina', 'SBI', 0, 1),
(426, 27, 'Vlasenica', 'SVL', 0, 1),
(427, 27, 'Sarajevo-Romanija or Sokolac', 'SSR', 0, 1),
(428, 27, 'Foca', 'SFO', 0, 1),
(429, 27, 'Trebinje', 'STR', 0, 1),
(430, 28, 'Central', 'CE', 0, 1),
(431, 28, 'Ghanzi', 'GH', 0, 1),
(432, 28, 'Kgalagadi', 'KD', 0, 1),
(433, 28, 'Kgatleng', 'KT', 0, 1),
(434, 28, 'Kweneng', 'KW', 0, 1),
(435, 28, 'Ngamiland', 'NG', 0, 1),
(436, 28, 'North East', 'NE', 0, 1),
(437, 28, 'North West', 'NW', 0, 1),
(438, 28, 'South East', 'SE', 0, 1),
(439, 28, 'Southern', 'SO', 0, 1),
(440, 30, 'Acre', 'AC', 0, 1),
(441, 30, 'Alagoas', 'AL', 0, 1),
(442, 30, 'AmapÃ¡', 'AP', 0, 1),
(443, 30, 'Amazonas', 'AM', 0, 1),
(444, 30, 'Bahia', 'BA', 0, 1),
(445, 30, 'CearÃ¡', 'CE', 0, 1),
(446, 30, 'Distrito Federal', 'DF', 0, 1),
(447, 30, 'EspÃ­rito Santo', 'ES', 0, 1),
(448, 30, 'GoiÃ¡s', 'GO', 0, 1),
(449, 30, 'MaranhÃ£o', 'MA', 0, 1),
(450, 30, 'Mato Grosso', 'MT', 0, 1),
(451, 30, 'Mato Grosso do Sul', 'MS', 0, 1),
(452, 30, 'Minas Gerais', 'MG', 0, 1),
(453, 30, 'ParÃ¡', 'PA', 0, 1),
(454, 30, 'ParaÃ­ba', 'PB', 0, 1),
(455, 30, 'ParanÃ¡', 'PR', 0, 1),
(456, 30, 'Pernambuco', 'PE', 0, 1),
(457, 30, 'PiauÃ­', 'PI', 0, 1),
(458, 30, 'Rio de Janeiro', 'RJ', 0, 1),
(459, 30, 'Rio Grande do Norte', 'RN', 0, 1),
(460, 30, 'Rio Grande do Sul', 'RS', 0, 1),
(461, 30, 'RondÃ´nia', 'RO', 0, 1),
(462, 30, 'Roraima', 'RR', 0, 1),
(463, 30, 'Santa Catarina', 'SC', 0, 1),
(464, 30, 'SÃ£o Paulo', 'SP', 0, 1),
(465, 30, 'Sergipe', 'SE', 0, 1),
(466, 30, 'Tocantins', 'TO', 0, 1),
(467, 31, 'Peros Banhos', 'PB', 0, 1),
(468, 31, 'Salomon Islands', 'SI', 0, 1),
(469, 31, 'Nelsons Island', 'NI', 0, 1),
(470, 31, 'Three Brothers', 'TB', 0, 1),
(471, 31, 'Eagle Islands', 'EA', 0, 1),
(472, 31, 'Danger Island', 'DI', 0, 1),
(473, 31, 'Egmont Islands', 'EG', 0, 1),
(474, 31, 'Diego Garcia', 'DG', 0, 1),
(475, 32, 'Belait', 'BEL', 0, 1),
(476, 32, 'Brunei and Muara', 'BRM', 0, 1),
(477, 32, 'Temburong', 'TEM', 0, 1),
(478, 32, 'Tutong', 'TUT', 0, 1),
(479, 33, 'Blagoevgrad', '', 0, 1),
(480, 33, 'Burgas', '', 0, 1),
(481, 33, 'Dobrich', '', 0, 1),
(482, 33, 'Gabrovo', '', 0, 1),
(483, 33, 'Haskovo', '', 0, 1),
(484, 33, 'Kardjali', '', 0, 1),
(485, 33, 'Kyustendil', '', 0, 1),
(486, 33, 'Lovech', '', 0, 1),
(487, 33, 'Montana', '', 0, 1),
(488, 33, 'Pazardjik', '', 0, 1),
(489, 33, 'Pernik', '', 0, 1),
(490, 33, 'Pleven', '', 0, 1),
(491, 33, 'Plovdiv', '', 0, 1),
(492, 33, 'Razgrad', '', 0, 1),
(493, 33, 'Shumen', '', 0, 1),
(494, 33, 'Silistra', '', 0, 1),
(495, 33, 'Sliven', '', 0, 1),
(496, 33, 'Smolyan', '', 0, 1),
(497, 33, 'Sofia', '', 0, 1),
(498, 33, 'Sofia - town', '', 0, 1),
(499, 33, 'Stara Zagora', '', 0, 1),
(500, 33, 'Targovishte', '', 0, 1),
(501, 33, 'Varna', '', 0, 1),
(502, 33, 'Veliko Tarnovo', '', 0, 1),
(503, 33, 'Vidin', '', 0, 1),
(504, 33, 'Vratza', '', 0, 1),
(505, 33, 'Yambol', '', 0, 1),
(506, 34, 'Bale', 'BAL', 0, 1),
(507, 34, 'Bam', 'BAM', 0, 1),
(508, 34, 'Banwa', 'BAN', 0, 1),
(509, 34, 'Bazega', 'BAZ', 0, 1),
(510, 34, 'Bougouriba', 'BOR', 0, 1),
(511, 34, 'Boulgou', 'BLG', 0, 1),
(512, 34, 'Boulkiemde', 'BOK', 0, 1),
(513, 34, 'Comoe', 'COM', 0, 1),
(514, 34, 'Ganzourgou', 'GAN', 0, 1),
(515, 34, 'Gnagna', 'GNA', 0, 1),
(516, 34, 'Gourma', 'GOU', 0, 1),
(517, 34, 'Houet', 'HOU', 0, 1),
(518, 34, 'Ioba', 'IOA', 0, 1),
(519, 34, 'Kadiogo', 'KAD', 0, 1),
(520, 34, 'Kenedougou', 'KEN', 0, 1),
(521, 34, 'Komondjari', 'KOD', 0, 1),
(522, 34, 'Kompienga', 'KOP', 0, 1),
(523, 34, 'Kossi', 'KOS', 0, 1),
(524, 34, 'Koulpelogo', 'KOL', 0, 1),
(525, 34, 'Kouritenga', 'KOT', 0, 1),
(526, 34, 'Kourweogo', 'KOW', 0, 1),
(527, 34, 'Leraba', 'LER', 0, 1),
(528, 34, 'Loroum', 'LOR', 0, 1),
(529, 34, 'Mouhoun', 'MOU', 0, 1),
(530, 34, 'Nahouri', 'NAH', 0, 1),
(531, 34, 'Namentenga', 'NAM', 0, 1),
(532, 34, 'Nayala', 'NAY', 0, 1),
(533, 34, 'Noumbiel', 'NOU', 0, 1),
(534, 34, 'Oubritenga', 'OUB', 0, 1),
(535, 34, 'Oudalan', 'OUD', 0, 1),
(536, 34, 'Passore', 'PAS', 0, 1),
(537, 34, 'Poni', 'PON', 0, 1),
(538, 34, 'Sanguie', 'SAG', 0, 1),
(539, 34, 'Sanmatenga', 'SAM', 0, 1),
(540, 34, 'Seno', 'SEN', 0, 1),
(541, 34, 'Sissili', 'SIS', 0, 1),
(542, 34, 'Soum', 'SOM', 0, 1),
(543, 34, 'Sourou', 'SOR', 0, 1),
(544, 34, 'Tapoa', 'TAP', 0, 1),
(545, 34, 'Tuy', 'TUY', 0, 1),
(546, 34, 'Yagha', 'YAG', 0, 1),
(547, 34, 'Yatenga', 'YAT', 0, 1),
(548, 34, 'Ziro', 'ZIR', 0, 1),
(549, 34, 'Zondoma', 'ZOD', 0, 1),
(550, 34, 'Zoundweogo', 'ZOW', 0, 1),
(551, 35, 'Bubanza', 'BB', 0, 1),
(552, 35, 'Bujumbura', 'BJ', 0, 1),
(553, 35, 'Bururi', 'BR', 0, 1),
(554, 35, 'Cankuzo', 'CA', 0, 1),
(555, 35, 'Cibitoke', 'CI', 0, 1),
(556, 35, 'Gitega', 'GI', 0, 1),
(557, 35, 'Karuzi', 'KR', 0, 1),
(558, 35, 'Kayanza', 'KY', 0, 1),
(559, 35, 'Kirundo', 'KI', 0, 1),
(560, 35, 'Makamba', 'MA', 0, 1),
(561, 35, 'Muramvya', 'MU', 0, 1),
(562, 35, 'Muyinga', 'MY', 0, 1),
(563, 35, 'Mwaro', 'MW', 0, 1),
(564, 35, 'Ngozi', 'NG', 0, 1),
(565, 35, 'Rutana', 'RT', 0, 1),
(566, 35, 'Ruyigi', 'RY', 0, 1),
(567, 36, 'Phnom Penh', 'PP', 0, 1),
(568, 36, 'Preah Seihanu (Kompong Som or Sihanoukville)', 'PS', 0, 1),
(569, 36, 'Pailin', 'PA', 0, 1),
(570, 36, 'Keb', 'KB', 0, 1),
(571, 36, 'Banteay Meanchey', 'BM', 0, 1),
(572, 36, 'Battambang', 'BA', 0, 1),
(573, 36, 'Kampong Cham', 'KM', 0, 1),
(574, 36, 'Kampong Chhnang', 'KN', 0, 1),
(575, 36, 'Kampong Speu', 'KU', 0, 1),
(576, 36, 'Kampong Som', 'KO', 0, 1),
(577, 36, 'Kampong Thom', 'KT', 0, 1),
(578, 36, 'Kampot', 'KP', 0, 1),
(579, 36, 'Kandal', 'KL', 0, 1),
(580, 36, 'Kaoh Kong', 'KK', 0, 1),
(581, 36, 'Kratie', 'KR', 0, 1),
(582, 36, 'Mondul Kiri', 'MK', 0, 1),
(583, 36, 'Oddar Meancheay', 'OM', 0, 1),
(584, 36, 'Pursat', 'PU', 0, 1),
(585, 36, 'Preah Vihear', 'PR', 0, 1),
(586, 36, 'Prey Veng', 'PG', 0, 1),
(587, 36, 'Ratanak Kiri', 'RK', 0, 1),
(588, 36, 'Siemreap', 'SI', 0, 1),
(589, 36, 'Stung Treng', 'ST', 0, 1),
(590, 36, 'Svay Rieng', 'SR', 0, 1),
(591, 36, 'Takeo', 'TK', 0, 1),
(592, 37, 'Adamawa (Adamaoua)', 'ADA', 0, 1),
(593, 37, 'Centre', 'CEN', 0, 1),
(594, 37, 'East (Est)', 'EST', 0, 1),
(595, 37, 'Extreme North (Extreme-Nord)', 'EXN', 0, 1),
(596, 37, 'Littoral', 'LIT', 0, 1),
(597, 37, 'North (Nord)', 'NOR', 0, 1),
(598, 37, 'Northwest (Nord-Ouest)', 'NOT', 0, 1),
(599, 37, 'West (Ouest)', 'OUE', 0, 1),
(600, 37, 'South (Sud)', 'SUD', 0, 1),
(601, 37, 'Southwest (Sud-Ouest).', 'SOU', 0, 1),
(602, 38, 'Alberta', 'AB', 0, 1),
(603, 38, 'British Columbia', 'BC', 0, 1),
(604, 38, 'Manitoba', 'MB', 0, 1),
(605, 38, 'New Brunswick', 'NB', 0, 1),
(606, 38, 'Newfoundland and Labrador', 'NL', 0, 1),
(607, 38, 'Northwest Territories', 'NT', 0, 1),
(608, 38, 'Nova Scotia', 'NS', 0, 1),
(609, 38, 'Nunavut', 'NU', 0, 1),
(610, 38, 'Ontario', 'ON', 0, 1),
(611, 38, 'Prince Edward Island', 'PE', 0, 1),
(612, 38, 'Qu&eacute;bec', 'QC', 0, 1),
(613, 38, 'Saskatchewan', 'SK', 0, 1),
(614, 38, 'Yukon Territory', 'YT', 0, 1),
(615, 39, 'Boa Vista', 'BV', 0, 1),
(616, 39, 'Brava', 'BR', 0, 1),
(617, 39, 'Calheta de Sao Miguel', 'CS', 0, 1),
(618, 39, 'Maio', 'MA', 0, 1),
(619, 39, 'Mosteiros', 'MO', 0, 1),
(620, 39, 'Paul', 'PA', 0, 1),
(621, 39, 'Porto Novo', 'PN', 0, 1),
(622, 39, 'Praia', 'PR', 0, 1),
(623, 39, 'Ribeira Grande', 'RG', 0, 1),
(624, 39, 'Sal', 'SL', 0, 1),
(625, 39, 'Santa Catarina', 'CA', 0, 1),
(626, 39, 'Santa Cruz', 'CR', 0, 1),
(627, 39, 'Sao Domingos', 'SD', 0, 1),
(628, 39, 'Sao Filipe', 'SF', 0, 1),
(629, 39, 'Sao Nicolau', 'SN', 0, 1),
(630, 39, 'Sao Vicente', 'SV', 0, 1),
(631, 39, 'Tarrafal', 'TA', 0, 1),
(632, 40, 'Creek', 'CR', 0, 1),
(633, 40, 'Eastern', 'EA', 0, 1),
(634, 40, 'Midland', 'ML', 0, 1),
(635, 40, 'South Town', 'ST', 0, 1),
(636, 40, 'Spot Bay', 'SP', 0, 1),
(637, 40, 'Stake Bay', 'SK', 0, 1),
(638, 40, 'West End', 'WD', 0, 1),
(639, 40, 'Western', 'WN', 0, 1),
(640, 41, 'Bamingui-Bangoran', 'BBA', 0, 1),
(641, 41, 'Basse-Kotto', 'BKO', 0, 1),
(642, 41, 'Haute-Kotto', 'HKO', 0, 1),
(643, 41, 'Haut-Mbomou', 'HMB', 0, 1),
(644, 41, 'Kemo', 'KEM', 0, 1),
(645, 41, 'Lobaye', 'LOB', 0, 1),
(646, 41, 'Mambere-KadeÃ”', 'MKD', 0, 1),
(647, 41, 'Mbomou', 'MBO', 0, 1),
(648, 41, 'Nana-Mambere', 'NMM', 0, 1),
(649, 41, 'Ombella-M\'Poko', 'OMP', 0, 1),
(650, 41, 'Ouaka', 'OUK', 0, 1),
(651, 41, 'Ouham', 'OUH', 0, 1),
(652, 41, 'Ouham-Pende', 'OPE', 0, 1),
(653, 41, 'Vakaga', 'VAK', 0, 1),
(654, 41, 'Nana-Grebizi', 'NGR', 0, 1),
(655, 41, 'Sangha-Mbaere', 'SMB', 0, 1),
(656, 41, 'Bangui', 'BAN', 0, 1),
(657, 42, 'Batha', 'BA', 0, 1),
(658, 42, 'Biltine', 'BI', 0, 1),
(659, 42, 'Borkou-Ennedi-Tibesti', 'BE', 0, 1),
(660, 42, 'Chari-Baguirmi', 'CB', 0, 1),
(661, 42, 'Guera', 'GU', 0, 1),
(662, 42, 'Kanem', 'KA', 0, 1),
(663, 42, 'Lac', 'LA', 0, 1),
(664, 42, 'Logone Occidental', 'LC', 0, 1),
(665, 42, 'Logone Oriental', 'LR', 0, 1),
(666, 42, 'Mayo-Kebbi', 'MK', 0, 1),
(667, 42, 'Moyen-Chari', 'MC', 0, 1),
(668, 42, 'Ouaddai', 'OU', 0, 1),
(669, 42, 'Salamat', 'SA', 0, 1),
(670, 42, 'Tandjile', 'TA', 0, 1),
(671, 43, 'Aisen del General Carlos Ibanez', 'AI', 0, 1),
(672, 43, 'Antofagasta', 'AN', 0, 1),
(673, 43, 'Araucania', 'AR', 0, 1),
(674, 43, 'Atacama', 'AT', 0, 1),
(675, 43, 'Bio-Bio', 'BI', 0, 1),
(676, 43, 'Coquimbo', 'CO', 0, 1),
(677, 43, 'Libertador General Bernardo O\'Higgins', 'LI', 0, 1),
(678, 43, 'Los Lagos', 'LL', 0, 1),
(679, 43, 'Magallanes y de la Antartica Chilena', 'MA', 0, 1),
(680, 43, 'Maule', 'ML', 0, 1),
(681, 43, 'Region Metropolitana', 'RM', 0, 1),
(682, 43, 'Tarapaca', 'TA', 0, 1),
(683, 43, 'Valparaiso', 'VS', 0, 1),
(684, 44, 'Anhui', 'AN', 0, 1),
(685, 44, 'Beijing', 'BE', 0, 1),
(686, 44, 'Chongqing', 'CH', 0, 1),
(687, 44, 'Fujian', 'FU', 0, 1),
(688, 44, 'Gansu', 'GA', 0, 1),
(689, 44, 'Guangdong', 'GU', 0, 1),
(690, 44, 'Guangxi', 'GX', 0, 1),
(691, 44, 'Guizhou', 'GZ', 0, 1),
(692, 44, 'Hainan', 'HA', 0, 1),
(693, 44, 'Hebei', 'HB', 0, 1),
(694, 44, 'Heilongjiang', 'HL', 0, 1),
(695, 44, 'Henan', 'HE', 0, 1),
(696, 44, 'Hong Kong', 'HK', 0, 1),
(697, 44, 'Hubei', 'HU', 0, 1),
(698, 44, 'Hunan', 'HN', 0, 1),
(699, 44, 'Inner Mongolia', 'IM', 0, 1),
(700, 44, 'Jiangsu', 'JI', 0, 1),
(701, 44, 'Jiangxi', 'JX', 0, 1),
(702, 44, 'Jilin', 'JL', 0, 1),
(703, 44, 'Liaoning', 'LI', 0, 1),
(704, 44, 'Macau', 'MA', 0, 1),
(705, 44, 'Ningxia', 'NI', 0, 1),
(706, 44, 'Shaanxi', 'SH', 0, 1),
(707, 44, 'Shandong', 'SA', 0, 1),
(708, 44, 'Shanghai', 'SG', 0, 1),
(709, 44, 'Shanxi', 'SX', 0, 1),
(710, 44, 'Sichuan', 'SI', 0, 1),
(711, 44, 'Tianjin', 'TI', 0, 1),
(712, 44, 'Xinjiang', 'XI', 0, 1),
(713, 44, 'Yunnan', 'YU', 0, 1),
(714, 44, 'Zhejiang', 'ZH', 0, 1),
(715, 46, 'Direction Island', 'D', 0, 1),
(716, 46, 'Home Island', 'H', 0, 1),
(717, 46, 'Horsburgh Island', 'O', 0, 1),
(718, 46, 'South Island', 'S', 0, 1),
(719, 46, 'West Island', 'W', 0, 1),
(720, 47, 'Amazonas', 'AMZ', 0, 1),
(721, 47, 'Antioquia', 'ANT', 0, 1),
(722, 47, 'Arauca', 'ARA', 0, 1),
(723, 47, 'Atlantico', 'ATL', 0, 1),
(724, 47, 'Bogota D.C.', 'BDC', 0, 1),
(725, 47, 'Bolivar', 'BOL', 0, 1),
(726, 47, 'Boyaca', 'BOY', 0, 1),
(727, 47, 'Caldas', 'CAL', 0, 1),
(728, 47, 'Caqueta', 'CAQ', 0, 1),
(729, 47, 'Casanare', 'CAS', 0, 1),
(730, 47, 'Cauca', 'CAU', 0, 1),
(731, 47, 'Cesar', 'CES', 0, 1),
(732, 47, 'Choco', 'CHO', 0, 1),
(733, 47, 'Cordoba', 'COR', 0, 1),
(734, 47, 'Cundinamarca', 'CAM', 0, 1),
(735, 47, 'Guainia', 'GNA', 0, 1),
(736, 47, 'Guajira', 'GJR', 0, 1),
(737, 47, 'Guaviare', 'GVR', 0, 1),
(738, 47, 'Huila', 'HUI', 0, 1),
(739, 47, 'Magdalena', 'MAG', 0, 1),
(740, 47, 'Meta', 'MET', 0, 1),
(741, 47, 'Narino', 'NAR', 0, 1),
(742, 47, 'Norte de Santander', 'NDS', 0, 1),
(743, 47, 'Putumayo', 'PUT', 0, 1),
(744, 47, 'Quindio', 'QUI', 0, 1),
(745, 47, 'Risaralda', 'RIS', 0, 1),
(746, 47, 'San Andres y Providencia', 'SAP', 0, 1),
(747, 47, 'Santander', 'SAN', 0, 1),
(748, 47, 'Sucre', 'SUC', 0, 1),
(749, 47, 'Tolima', 'TOL', 0, 1),
(750, 47, 'Valle del Cauca', 'VDC', 0, 1),
(751, 47, 'Vaupes', 'VAU', 0, 1),
(752, 47, 'Vichada', 'VIC', 0, 1),
(753, 48, 'Grande Comore', 'G', 0, 1),
(754, 48, 'Anjouan', 'A', 0, 1),
(755, 48, 'Moheli', 'M', 0, 1),
(756, 49, 'Bouenza', 'BO', 0, 1),
(757, 49, 'Brazzaville', 'BR', 0, 1),
(758, 49, 'Cuvette', 'CU', 0, 1),
(759, 49, 'Cuvette-Ouest', 'CO', 0, 1),
(760, 49, 'Kouilou', 'KO', 0, 1),
(761, 49, 'Lekoumou', 'LE', 0, 1),
(762, 49, 'Likouala', 'LI', 0, 1),
(763, 49, 'Niari', 'NI', 0, 1),
(764, 49, 'Plateaux', 'PL', 0, 1),
(765, 49, 'Pool', 'PO', 0, 1),
(766, 49, 'Sangha', 'SA', 0, 1),
(767, 50, 'Pukapuka', 'PU', 0, 1),
(768, 50, 'Rakahanga', 'RK', 0, 1),
(769, 50, 'Manihiki', 'MK', 0, 1),
(770, 50, 'Penrhyn', 'PE', 0, 1),
(771, 50, 'Nassau Island', 'NI', 0, 1),
(772, 50, 'Surwarrow', 'SU', 0, 1),
(773, 50, 'Palmerston', 'PA', 0, 1),
(774, 50, 'Aitutaki', 'AI', 0, 1),
(775, 50, 'Manuae', 'MA', 0, 1),
(776, 50, 'Takutea', 'TA', 0, 1),
(777, 50, 'Mitiaro', 'MT', 0, 1),
(778, 50, 'Atiu', 'AT', 0, 1),
(779, 50, 'Mauke', 'MU', 0, 1),
(780, 50, 'Rarotonga', 'RR', 0, 1),
(781, 50, 'Mangaia', 'MG', 0, 1),
(782, 51, 'Alajuela', 'AL', 0, 1),
(783, 51, 'Cartago', 'CA', 0, 1),
(784, 51, 'Guanacaste', 'GU', 0, 1),
(785, 51, 'Heredia', 'HE', 0, 1),
(786, 51, 'Limon', 'LI', 0, 1),
(787, 51, 'Puntarenas', 'PU', 0, 1),
(788, 51, 'San Jose', 'SJ', 0, 1),
(789, 52, 'Abengourou', 'ABE', 0, 1),
(790, 52, 'Abidjan', 'ABI', 0, 1),
(791, 52, 'Aboisso', 'ABO', 0, 1),
(792, 52, 'Adiake', 'ADI', 0, 1),
(793, 52, 'Adzope', 'ADZ', 0, 1),
(794, 52, 'Agboville', 'AGB', 0, 1),
(795, 52, 'Agnibilekrou', 'AGN', 0, 1),
(796, 52, 'Alepe', 'ALE', 0, 1),
(797, 52, 'Bocanda', 'BOC', 0, 1),
(798, 52, 'Bangolo', 'BAN', 0, 1),
(799, 52, 'Beoumi', 'BEO', 0, 1),
(800, 52, 'Biankouma', 'BIA', 0, 1),
(801, 52, 'Bondoukou', 'BDK', 0, 1),
(802, 52, 'Bongouanou', 'BGN', 0, 1),
(803, 52, 'Bouafle', 'BFL', 0, 1),
(804, 52, 'Bouake', 'BKE', 0, 1),
(805, 52, 'Bouna', 'BNA', 0, 1),
(806, 52, 'Boundiali', 'BDL', 0, 1),
(807, 52, 'Dabakala', 'DKL', 0, 1),
(808, 52, 'Dabou', 'DBU', 0, 1),
(809, 52, 'Daloa', 'DAL', 0, 1),
(810, 52, 'Danane', 'DAN', 0, 1),
(811, 52, 'Daoukro', 'DAO', 0, 1),
(812, 52, 'Dimbokro', 'DIM', 0, 1),
(813, 52, 'Divo', 'DIV', 0, 1),
(814, 52, 'Duekoue', 'DUE', 0, 1),
(815, 52, 'Ferkessedougou', 'FER', 0, 1),
(816, 52, 'Gagnoa', 'GAG', 0, 1),
(817, 52, 'Grand-Bassam', 'GBA', 0, 1),
(818, 52, 'Grand-Lahou', 'GLA', 0, 1),
(819, 52, 'Guiglo', 'GUI', 0, 1),
(820, 52, 'Issia', 'ISS', 0, 1),
(821, 52, 'Jacqueville', 'JAC', 0, 1),
(822, 52, 'Katiola', 'KAT', 0, 1),
(823, 52, 'Korhogo', 'KOR', 0, 1),
(824, 52, 'Lakota', 'LAK', 0, 1),
(825, 52, 'Man', 'MAN', 0, 1),
(826, 52, 'Mankono', 'MKN', 0, 1),
(827, 52, 'Mbahiakro', 'MBA', 0, 1),
(828, 52, 'Odienne', 'ODI', 0, 1),
(829, 52, 'Oume', 'OUM', 0, 1),
(830, 52, 'Sakassou', 'SAK', 0, 1),
(831, 52, 'San-Pedro', 'SPE', 0, 1),
(832, 52, 'Sassandra', 'SAS', 0, 1),
(833, 52, 'Seguela', 'SEG', 0, 1),
(834, 52, 'Sinfra', 'SIN', 0, 1),
(835, 52, 'Soubre', 'SOU', 0, 1),
(836, 52, 'Tabou', 'TAB', 0, 1),
(837, 52, 'Tanda', 'TAN', 0, 1),
(838, 52, 'Tiebissou', 'TIE', 0, 1),
(839, 52, 'Tingrela', 'TIN', 0, 1),
(840, 52, 'Tiassale', 'TIA', 0, 1),
(841, 52, 'Touba', 'TBA', 0, 1),
(842, 52, 'Toulepleu', 'TLP', 0, 1),
(843, 52, 'Toumodi', 'TMD', 0, 1),
(844, 52, 'Vavoua', 'VAV', 0, 1),
(845, 52, 'Yamoussoukro', 'YAM', 0, 1),
(846, 52, 'Zuenoula', 'ZUE', 0, 1),
(847, 53, 'Bjelovarsko-bilogorska', 'BB', 0, 1),
(848, 53, 'Grad Zagreb', 'GZ', 0, 1),
(849, 53, 'DubrovaÄko-neretvanska', 'DN', 0, 1),
(850, 53, 'Istarska', 'IS', 0, 1),
(851, 53, 'KarlovaÄka', 'KA', 0, 1),
(852, 53, 'KoprivniÄko-kriÅ¾evaÄka', 'KK', 0, 1),
(853, 53, 'Krapinsko-zagorska', 'KZ', 0, 1),
(854, 53, 'LiÄko-senjska', 'LS', 0, 1),
(855, 53, 'MeÄ‘imurska', 'ME', 0, 1),
(856, 53, 'OsjeÄko-baranjska', 'OB', 0, 1),
(857, 53, 'PoÅ¾eÅ¡ko-slavonska', 'PS', 0, 1),
(858, 53, 'Primorsko-goranska', 'PG', 0, 1),
(859, 53, 'Å ibensko-kninska', 'SK', 0, 1),
(860, 53, 'SisaÄko-moslavaÄka', 'SM', 0, 1),
(861, 53, 'Brodsko-posavska', 'BP', 0, 1),
(862, 53, 'Splitsko-dalmatinska', 'SD', 0, 1),
(863, 53, 'VaraÅ¾dinska', 'VA', 0, 1),
(864, 53, 'VirovitiÄko-podravska', 'VP', 0, 1),
(865, 53, 'Vukovarsko-srijemska', 'VS', 0, 1),
(866, 53, 'Zadarska', 'ZA', 0, 1),
(867, 53, 'ZagrebaÄka', 'ZG', 0, 1),
(868, 54, 'Camaguey', 'CA', 0, 1),
(869, 54, 'Ciego de Avila', 'CD', 0, 1),
(870, 54, 'Cienfuegos', 'CI', 0, 1),
(871, 54, 'Ciudad de La Habana', 'CH', 0, 1),
(872, 54, 'Granma', 'GR', 0, 1),
(873, 54, 'Guantanamo', 'GU', 0, 1),
(874, 54, 'Holguin', 'HO', 0, 1),
(875, 54, 'Isla de la Juventud', 'IJ', 0, 1),
(876, 54, 'La Habana', 'LH', 0, 1),
(877, 54, 'Las Tunas', 'LT', 0, 1),
(878, 54, 'Matanzas', 'MA', 0, 1),
(879, 54, 'Pinar del Rio', 'PR', 0, 1),
(880, 54, 'Sancti Spiritus', 'SS', 0, 1),
(881, 54, 'Santiago de Cuba', 'SC', 0, 1),
(882, 54, 'Villa Clara', 'VC', 0, 1),
(883, 55, 'Famagusta', 'F', 0, 1),
(884, 55, 'Kyrenia', 'K', 0, 1),
(885, 55, 'Larnaca', 'A', 0, 1),
(886, 55, 'Limassol', 'I', 0, 1),
(887, 55, 'Nicosia', 'N', 0, 1),
(888, 55, 'Paphos', 'P', 0, 1),
(889, 56, 'ÃšsteckÃ½', 'U', 0, 1),
(890, 56, 'JihoÄeskÃ½', 'C', 0, 1),
(891, 56, 'JihomoravskÃ½', 'B', 0, 1),
(892, 56, 'KarlovarskÃ½', 'K', 0, 1),
(893, 56, 'KrÃ¡lovehradeckÃ½', 'H', 0, 1),
(894, 56, 'LibereckÃ½', 'L', 0, 1),
(895, 56, 'MoravskoslezskÃ½', 'T', 0, 1),
(896, 56, 'OlomouckÃ½', 'M', 0, 1),
(897, 56, 'PardubickÃ½', 'E', 0, 1),
(898, 56, 'PlzeÅˆskÃ½', 'P', 0, 1),
(899, 56, 'Praha', 'A', 0, 1),
(900, 56, 'StÅ™edoÄeskÃ½', 'S', 0, 1),
(901, 56, 'VysoÄina', 'J', 0, 1),
(902, 56, 'ZlÃ­nskÃ½', 'Z', 0, 1),
(903, 57, 'Arhus', 'AR', 0, 1),
(904, 57, 'Bornholm', 'BH', 0, 1),
(905, 57, 'Copenhagen', 'CO', 0, 1),
(906, 57, 'Faroe Islands', 'FO', 0, 1),
(907, 57, 'Frederiksborg', 'FR', 0, 1),
(908, 57, 'Fyn', 'FY', 0, 1),
(909, 57, 'Kobenhavn', 'KO', 0, 1),
(910, 57, 'Nordjylland', 'NO', 0, 1),
(911, 57, 'Ribe', 'RI', 0, 1),
(912, 57, 'Ringkobing', 'RK', 0, 1),
(913, 57, 'Roskilde', 'RO', 0, 1),
(914, 57, 'Sonderjylland', 'SO', 0, 1),
(915, 57, 'Storstrom', 'ST', 0, 1),
(916, 57, 'Vejle', 'VK', 0, 1),
(917, 57, 'Vestj&aelig;lland', 'VJ', 0, 1),
(918, 57, 'Viborg', 'VB', 0, 1),
(919, 58, '\'Ali Sabih', 'S', 0, 1),
(920, 58, 'Dikhil', 'K', 0, 1),
(921, 58, 'Djibouti', 'J', 0, 1),
(922, 58, 'Obock', 'O', 0, 1),
(923, 58, 'Tadjoura', 'T', 0, 1),
(924, 59, 'Saint Andrew Parish', 'AND', 0, 1),
(925, 59, 'Saint David Parish', 'DAV', 0, 1),
(926, 59, 'Saint George Parish', 'GEO', 0, 1),
(927, 59, 'Saint John Parish', 'JOH', 0, 1),
(928, 59, 'Saint Joseph Parish', 'JOS', 0, 1),
(929, 59, 'Saint Luke Parish', 'LUK', 0, 1),
(930, 59, 'Saint Mark Parish', 'MAR', 0, 1),
(931, 59, 'Saint Patrick Parish', 'PAT', 0, 1),
(932, 59, 'Saint Paul Parish', 'PAU', 0, 1),
(933, 59, 'Saint Peter Parish', 'PET', 0, 1),
(934, 60, 'Distrito Nacional', 'DN', 0, 1),
(935, 60, 'Azua', 'AZ', 0, 1),
(936, 60, 'Baoruco', 'BC', 0, 1),
(937, 60, 'Barahona', 'BH', 0, 1),
(938, 60, 'Dajabon', 'DJ', 0, 1),
(939, 60, 'Duarte', 'DU', 0, 1),
(940, 60, 'Elias Pina', 'EL', 0, 1),
(941, 60, 'El Seybo', 'SY', 0, 1),
(942, 60, 'Espaillat', 'ET', 0, 1),
(943, 60, 'Hato Mayor', 'HM', 0, 1),
(944, 60, 'Independencia', 'IN', 0, 1),
(945, 60, 'La Altagracia', 'AL', 0, 1),
(946, 60, 'La Romana', 'RO', 0, 1),
(947, 60, 'La Vega', 'VE', 0, 1),
(948, 60, 'Maria Trinidad Sanchez', 'MT', 0, 1),
(949, 60, 'Monsenor Nouel', 'MN', 0, 1),
(950, 60, 'Monte Cristi', 'MC', 0, 1),
(951, 60, 'Monte Plata', 'MP', 0, 1),
(952, 60, 'Pedernales', 'PD', 0, 1),
(953, 60, 'Peravia (Bani)', 'PR', 0, 1),
(954, 60, 'Puerto Plata', 'PP', 0, 1),
(955, 60, 'Salcedo', 'SL', 0, 1),
(956, 60, 'Samana', 'SM', 0, 1),
(957, 60, 'Sanchez Ramirez', 'SH', 0, 1),
(958, 60, 'San Cristobal', 'SC', 0, 1),
(959, 60, 'San Jose de Ocoa', 'JO', 0, 1),
(960, 60, 'San Juan', 'SJ', 0, 1),
(961, 60, 'San Pedro de Macoris', 'PM', 0, 1),
(962, 60, 'Santiago', 'SA', 0, 1),
(963, 60, 'Santiago Rodriguez', 'ST', 0, 1),
(964, 60, 'Santo Domingo', 'SD', 0, 1),
(965, 60, 'Valverde', 'VA', 0, 1),
(966, 61, 'Aileu', 'AL', 0, 1),
(967, 61, 'Ainaro', 'AN', 0, 1),
(968, 61, 'Baucau', 'BA', 0, 1),
(969, 61, 'Bobonaro', 'BO', 0, 1),
(970, 61, 'Cova Lima', 'CO', 0, 1),
(971, 61, 'Dili', 'DI', 0, 1),
(972, 61, 'Ermera', 'ER', 0, 1),
(973, 61, 'Lautem', 'LA', 0, 1),
(974, 61, 'Liquica', 'LI', 0, 1),
(975, 61, 'Manatuto', 'MT', 0, 1),
(976, 61, 'Manufahi', 'MF', 0, 1),
(977, 61, 'Oecussi', 'OE', 0, 1),
(978, 61, 'Viqueque', 'VI', 0, 1),
(979, 62, 'Azuay', 'AZU', 0, 1),
(980, 62, 'Bolivar', 'BOL', 0, 1),
(981, 62, 'Ca&ntilde;ar', 'CAN', 0, 1),
(982, 62, 'Carchi', 'CAR', 0, 1),
(983, 62, 'Chimborazo', 'CHI', 0, 1),
(984, 62, 'Cotopaxi', 'COT', 0, 1),
(985, 62, 'El Oro', 'EOR', 0, 1),
(986, 62, 'Esmeraldas', 'ESM', 0, 1),
(987, 62, 'Gal&aacute;pagos', 'GPS', 0, 1),
(988, 62, 'Guayas', 'GUA', 0, 1),
(989, 62, 'Imbabura', 'IMB', 0, 1),
(990, 62, 'Loja', 'LOJ', 0, 1),
(991, 62, 'Los Rios', 'LRO', 0, 1),
(992, 62, 'Manab&iacute;', 'MAN', 0, 1),
(993, 62, 'Morona Santiago', 'MSA', 0, 1),
(994, 62, 'Napo', 'NAP', 0, 1),
(995, 62, 'Orellana', 'ORE', 0, 1),
(996, 62, 'Pastaza', 'PAS', 0, 1),
(997, 62, 'Pichincha', 'PIC', 0, 1),
(998, 62, 'Sucumb&iacute;os', 'SUC', 0, 1),
(999, 62, 'Tungurahua', 'TUN', 0, 1),
(1000, 62, 'Zamora Chinchipe', 'ZCH', 0, 1),
(1001, 63, 'Ad Daqahliyah', 'DHY', 0, 1),
(1002, 63, 'Al Bahr al Ahmar', 'BAM', 0, 1),
(1003, 63, 'Al Buhayrah', 'BHY', 0, 1),
(1004, 63, 'Al Fayyum', 'FYM', 0, 1),
(1005, 63, 'Al Gharbiyah', 'GBY', 0, 1),
(1006, 63, 'Al Iskandariyah', 'IDR', 0, 1),
(1007, 63, 'Al Isma\'iliyah', 'IML', 0, 1),
(1008, 63, 'Al Jizah', 'JZH', 0, 1),
(1009, 63, 'Al Minufiyah', 'MFY', 0, 1),
(1010, 63, 'Al Minya', 'MNY', 0, 1),
(1011, 63, 'Al Qahirah', 'QHR', 0, 1),
(1012, 63, 'Al Qalyubiyah', 'QLY', 0, 1),
(1013, 63, 'Al Wadi al Jadid', 'WJD', 0, 1),
(1014, 63, 'Ash Sharqiyah', 'SHQ', 0, 1),
(1015, 63, 'As Suways', 'SWY', 0, 1),
(1016, 63, 'Aswan', 'ASW', 0, 1),
(1017, 63, 'Asyut', 'ASY', 0, 1),
(1018, 63, 'Bani Suwayf', 'BSW', 0, 1),
(1019, 63, 'Bur Sa\'id', 'BSD', 0, 1),
(1020, 63, 'Dumyat', 'DMY', 0, 1),
(1021, 63, 'Janub Sina\'', 'JNS', 0, 1),
(1022, 63, 'Kafr ash Shaykh', 'KSH', 0, 1),
(1023, 63, 'Matruh', 'MAT', 0, 1),
(1024, 63, 'Qina', 'QIN', 0, 1),
(1025, 63, 'Shamal Sina\'', 'SHS', 0, 1),
(1026, 63, 'Suhaj', 'SUH', 0, 1),
(1027, 64, 'Ahuachapan', 'AH', 0, 1),
(1028, 64, 'Cabanas', 'CA', 0, 1),
(1029, 64, 'Chalatenango', 'CH', 0, 1),
(1030, 64, 'Cuscatlan', 'CU', 0, 1),
(1031, 64, 'La Libertad', 'LB', 0, 1),
(1032, 64, 'La Paz', 'PZ', 0, 1),
(1033, 64, 'La Union', 'UN', 0, 1),
(1034, 64, 'Morazan', 'MO', 0, 1),
(1035, 64, 'San Miguel', 'SM', 0, 1),
(1036, 64, 'San Salvador', 'SS', 0, 1),
(1037, 64, 'San Vicente', 'SV', 0, 1),
(1038, 64, 'Santa Ana', 'SA', 0, 1),
(1039, 64, 'Sonsonate', 'SO', 0, 1),
(1040, 64, 'Usulutan', 'US', 0, 1),
(1041, 65, 'Provincia Annobon', 'AN', 0, 1),
(1042, 65, 'Provincia Bioko Norte', 'BN', 0, 1),
(1043, 65, 'Provincia Bioko Sur', 'BS', 0, 1),
(1044, 65, 'Provincia Centro Sur', 'CS', 0, 1),
(1045, 65, 'Provincia Kie-Ntem', 'KN', 0, 1),
(1046, 65, 'Provincia Litoral', 'LI', 0, 1),
(1047, 65, 'Provincia Wele-Nzas', 'WN', 0, 1),
(1048, 66, 'Central (Maekel)', 'MA', 0, 1),
(1049, 66, 'Anseba (Keren)', 'KE', 0, 1),
(1050, 66, 'Southern Red Sea (Debub-Keih-Bahri)', 'DK', 0, 1),
(1051, 66, 'Northern Red Sea (Semien-Keih-Bahri)', 'SK', 0, 1),
(1052, 66, 'Southern (Debub)', 'DE', 0, 1),
(1053, 66, 'Gash-Barka (Barentu)', 'BR', 0, 1),
(1054, 67, 'Harjumaa (Tallinn)', 'HA', 0, 1),
(1055, 67, 'Hiiumaa (Kardla)', 'HI', 0, 1),
(1056, 67, 'Ida-Virumaa (Johvi)', 'IV', 0, 1),
(1057, 67, 'Jarvamaa (Paide)', 'JA', 0, 1),
(1058, 67, 'Jogevamaa (Jogeva)', 'JO', 0, 1),
(1059, 67, 'Laane-Virumaa (Rakvere)', 'LV', 0, 1),
(1060, 67, 'Laanemaa (Haapsalu)', 'LA', 0, 1),
(1061, 67, 'Parnumaa (Parnu)', 'PA', 0, 1),
(1062, 67, 'Polvamaa (Polva)', 'PO', 0, 1),
(1063, 67, 'Raplamaa (Rapla)', 'RA', 0, 1),
(1064, 67, 'Saaremaa (Kuessaare)', 'SA', 0, 1),
(1065, 67, 'Tartumaa (Tartu)', 'TA', 0, 1),
(1066, 67, 'Valgamaa (Valga)', 'VA', 0, 1),
(1067, 67, 'Viljandimaa (Viljandi)', 'VI', 0, 1),
(1068, 67, 'Vorumaa (Voru)', 'VO', 0, 1),
(1069, 68, 'Afar', 'AF', 0, 1),
(1070, 68, 'Amhara', 'AH', 0, 1),
(1071, 68, 'Benishangul-Gumaz', 'BG', 0, 1),
(1072, 68, 'Gambela', 'GB', 0, 1),
(1073, 68, 'Hariai', 'HR', 0, 1),
(1074, 68, 'Oromia', 'OR', 0, 1),
(1075, 68, 'Somali', 'SM', 0, 1),
(1076, 68, 'Southern Nations - Nationalities and Peoples Region', 'SN', 0, 1),
(1077, 68, 'Tigray', 'TG', 0, 1),
(1078, 68, 'Addis Ababa', 'AA', 0, 1),
(1079, 68, 'Dire Dawa', 'DD', 0, 1),
(1080, 71, 'Central Division', 'C', 0, 1),
(1081, 71, 'Northern Division', 'N', 0, 1),
(1082, 71, 'Eastern Division', 'E', 0, 1),
(1083, 71, 'Western Division', 'W', 0, 1),
(1084, 71, 'Rotuma', 'R', 0, 1),
(1085, 72, 'Ahvenanmaan lÃ¤Ã¤ni', 'AL', 0, 1),
(1086, 72, 'EtelÃ¤-Suomen lÃ¤Ã¤ni', 'ES', 0, 1),
(1087, 72, 'ItÃ¤-Suomen lÃ¤Ã¤ni', 'IS', 0, 1),
(1088, 72, 'LÃ¤nsi-Suomen lÃ¤Ã¤ni', 'LS', 0, 1),
(1089, 72, 'Lapin lÃ¤Ã¤ni', 'LA', 0, 1),
(1090, 72, 'Oulun lÃ¤Ã¤ni', 'OU', 0, 1),
(1091, 74, 'Ain', '01', 0, 1),
(1092, 74, 'Aisne', '02', 0, 1),
(1093, 74, 'Allier', '03', 0, 1),
(1094, 74, 'Alpes de Haute Provence', '04', 0, 1),
(1095, 74, 'Hautes-Alpes', '05', 0, 1),
(1096, 74, 'Alpes Maritimes', '06', 0, 1),
(1097, 74, 'Ard&egrave;che', '07', 0, 1),
(1098, 74, 'Ardennes', '08', 0, 1),
(1099, 74, 'Ari&egrave;ge', '09', 0, 1),
(1100, 74, 'Aube', '10', 0, 1),
(1101, 74, 'Aude', '11', 0, 1),
(1102, 74, 'Aveyron', '12', 0, 1),
(1103, 74, 'Bouches du Rh&ocirc;ne', '13', 0, 1),
(1104, 74, 'Calvados', '14', 0, 1),
(1105, 74, 'Cantal', '15', 0, 1),
(1106, 74, 'Charente', '16', 0, 1),
(1107, 74, 'Charente Maritime', '17', 0, 1),
(1108, 74, 'Cher', '18', 0, 1),
(1109, 74, 'Corr&egrave;ze', '19', 0, 1),
(1110, 74, 'Corse du Sud', '2A', 0, 1),
(1111, 74, 'Haute Corse', '2B', 0, 1),
(1112, 74, 'C&ocirc;te d&#039;or', '21', 0, 1),
(1113, 74, 'C&ocirc;tes d&#039;Armor', '22', 0, 1),
(1114, 74, 'Creuse', '23', 0, 1),
(1115, 74, 'Dordogne', '24', 0, 1),
(1116, 74, 'Doubs', '25', 0, 1),
(1117, 74, 'Dr&ocirc;me', '26', 0, 1),
(1118, 74, 'Eure', '27', 0, 1),
(1119, 74, 'Eure et Loir', '28', 0, 1),
(1120, 74, 'Finist&egrave;re', '29', 0, 1),
(1121, 74, 'Gard', '30', 0, 1),
(1122, 74, 'Haute Garonne', '31', 0, 1),
(1123, 74, 'Gers', '32', 0, 1),
(1124, 74, 'Gironde', '33', 0, 1),
(1125, 74, 'H&eacute;rault', '34', 0, 1),
(1126, 74, 'Ille et Vilaine', '35', 0, 1),
(1127, 74, 'Indre', '36', 0, 1),
(1128, 74, 'Indre et Loire', '37', 0, 1),
(1129, 74, 'Is&eacute;re', '38', 0, 1),
(1130, 74, 'Jura', '39', 0, 1),
(1131, 74, 'Landes', '40', 0, 1),
(1132, 74, 'Loir et Cher', '41', 0, 1),
(1133, 74, 'Loire', '42', 0, 1),
(1134, 74, 'Haute Loire', '43', 0, 1),
(1135, 74, 'Loire Atlantique', '44', 0, 1),
(1136, 74, 'Loiret', '45', 0, 1),
(1137, 74, 'Lot', '46', 0, 1),
(1138, 74, 'Lot et Garonne', '47', 0, 1),
(1139, 74, 'Loz&egrave;re', '48', 0, 1),
(1140, 74, 'Maine et Loire', '49', 0, 1),
(1141, 74, 'Manche', '50', 0, 1),
(1142, 74, 'Marne', '51', 0, 1),
(1143, 74, 'Haute Marne', '52', 0, 1),
(1144, 74, 'Mayenne', '53', 0, 1),
(1145, 74, 'Meurthe et Moselle', '54', 0, 1),
(1146, 74, 'Meuse', '55', 0, 1),
(1147, 74, 'Morbihan', '56', 0, 1),
(1148, 74, 'Moselle', '57', 0, 1),
(1149, 74, 'Ni&egrave;vre', '58', 0, 1),
(1150, 74, 'Nord', '59', 0, 1),
(1151, 74, 'Oise', '60', 0, 1),
(1152, 74, 'Orne', '61', 0, 1),
(1153, 74, 'Pas de Calais', '62', 0, 1),
(1154, 74, 'Puy de D&ocirc;me', '63', 0, 1),
(1155, 74, 'Pyr&eacute;n&eacute;es Atlantiques', '64', 0, 1),
(1156, 74, 'Hautes Pyr&eacute;n&eacute;es', '65', 0, 1),
(1157, 74, 'Pyr&eacute;n&eacute;es Orientales', '66', 0, 1),
(1158, 74, 'Bas Rhin', '67', 0, 1),
(1159, 74, 'Haut Rhin', '68', 0, 1),
(1160, 74, 'Rh&ocirc;ne', '69', 0, 1),
(1161, 74, 'Haute Sa&ocirc;ne', '70', 0, 1),
(1162, 74, 'Sa&ocirc;ne et Loire', '71', 0, 1),
(1163, 74, 'Sarthe', '72', 0, 1),
(1164, 74, 'Savoie', '73', 0, 1),
(1165, 74, 'Haute Savoie', '74', 0, 1),
(1166, 74, 'Paris', '75', 0, 1),
(1167, 74, 'Seine Maritime', '76', 0, 1),
(1168, 74, 'Seine et Marne', '77', 0, 1),
(1169, 74, 'Yvelines', '78', 0, 1),
(1170, 74, 'Deux S&egrave;vres', '79', 0, 1),
(1171, 74, 'Somme', '80', 0, 1),
(1172, 74, 'Tarn', '81', 0, 1),
(1173, 74, 'Tarn et Garonne', '82', 0, 1),
(1174, 74, 'Var', '83', 0, 1),
(1175, 74, 'Vaucluse', '84', 0, 1),
(1176, 74, 'Vend&eacute;e', '85', 0, 1),
(1177, 74, 'Vienne', '86', 0, 1),
(1178, 74, 'Haute Vienne', '87', 0, 1),
(1179, 74, 'Vosges', '88', 0, 1),
(1180, 74, 'Yonne', '89', 0, 1),
(1181, 74, 'Territoire de Belfort', '90', 0, 1),
(1182, 74, 'Essonne', '91', 0, 1),
(1183, 74, 'Hauts de Seine', '92', 0, 1),
(1184, 74, 'Seine St-Denis', '93', 0, 1),
(1185, 74, 'Val de Marne', '94', 0, 1),
(1186, 74, 'Val d\'Oise', '95', 0, 1),
(1187, 76, 'Archipel des Marquises', 'M', 0, 1),
(1188, 76, 'Archipel des Tuamotu', 'T', 0, 1),
(1189, 76, 'Archipel des Tubuai', 'I', 0, 1),
(1190, 76, 'Iles du Vent', 'V', 0, 1),
(1191, 76, 'Iles Sous-le-Vent', 'S', 0, 1),
(1192, 77, 'Iles Crozet', 'C', 0, 1),
(1193, 77, 'Iles Kerguelen', 'K', 0, 1),
(1194, 77, 'Ile Amsterdam', 'A', 0, 1),
(1195, 77, 'Ile Saint-Paul', 'P', 0, 1),
(1196, 77, 'Adelie Land', 'D', 0, 1),
(1197, 78, 'Estuaire', 'ES', 0, 1),
(1198, 78, 'Haut-Ogooue', 'HO', 0, 1),
(1199, 78, 'Moyen-Ogooue', 'MO', 0, 1),
(1200, 78, 'Ngounie', 'NG', 0, 1),
(1201, 78, 'Nyanga', 'NY', 0, 1),
(1202, 78, 'Ogooue-Ivindo', 'OI', 0, 1),
(1203, 78, 'Ogooue-Lolo', 'OL', 0, 1),
(1204, 78, 'Ogooue-Maritime', 'OM', 0, 1),
(1205, 78, 'Woleu-Ntem', 'WN', 0, 1),
(1206, 79, 'Banjul', 'BJ', 0, 1),
(1207, 79, 'Basse', 'BS', 0, 1),
(1208, 79, 'Brikama', 'BR', 0, 1),
(1209, 79, 'Janjangbure', 'JA', 0, 1),
(1210, 79, 'Kanifeng', 'KA', 0, 1),
(1211, 79, 'Kerewan', 'KE', 0, 1),
(1212, 79, 'Kuntaur', 'KU', 0, 1),
(1213, 79, 'Mansakonko', 'MA', 0, 1),
(1214, 79, 'Lower River', 'LR', 0, 1),
(1215, 79, 'Central River', 'CR', 0, 1),
(1216, 79, 'North Bank', 'NB', 0, 1),
(1217, 79, 'Upper River', 'UR', 0, 1),
(1218, 79, 'Western', 'WE', 0, 1),
(1219, 80, 'Abkhazia', 'AB', 0, 1),
(1220, 80, 'Ajaria', 'AJ', 0, 1),
(1221, 80, 'Tbilisi', 'TB', 0, 1),
(1222, 80, 'Guria', 'GU', 0, 1),
(1223, 80, 'Imereti', 'IM', 0, 1),
(1224, 80, 'Kakheti', 'KA', 0, 1),
(1225, 80, 'Kvemo Kartli', 'KK', 0, 1),
(1226, 80, 'Mtskheta-Mtianeti', 'MM', 0, 1),
(1227, 80, 'Racha Lechkhumi and Kvemo Svanet', 'RL', 0, 1),
(1228, 80, 'Samegrelo-Zemo Svaneti', 'SZ', 0, 1),
(1229, 80, 'Samtskhe-Javakheti', 'SJ', 0, 1),
(1230, 80, 'Shida Kartli', 'SK', 0, 1),
(1231, 81, 'Baden-WÃ¼rttemberg', 'BAW', 0, 1),
(1232, 81, 'Bayern', 'BAY', 0, 1),
(1233, 81, 'Berlin', 'BER', 0, 1),
(1234, 81, 'Brandenburg', 'BRG', 0, 1),
(1235, 81, 'Bremen', 'BRE', 0, 1),
(1236, 81, 'Hamburg', 'HAM', 0, 1),
(1237, 81, 'Hessen', 'HES', 0, 1),
(1238, 81, 'Mecklenburg-Vorpommern', 'MEC', 0, 1),
(1239, 81, 'Niedersachsen', 'NDS', 0, 1),
(1240, 81, 'Nordrhein-Westfalen', 'NRW', 0, 1),
(1241, 81, 'Rheinland-Pfalz', 'RHE', 0, 1),
(1242, 81, 'Saarland', 'SAR', 0, 1),
(1243, 81, 'Sachsen', 'SAS', 0, 1),
(1244, 81, 'Sachsen-Anhalt', 'SAC', 0, 1),
(1245, 81, 'Schleswig-Holstein', 'SCN', 0, 1),
(1246, 81, 'ThÃ¼ringen', 'THE', 0, 1),
(1247, 82, 'Ashanti Region', 'AS', 0, 1),
(1248, 82, 'Brong-Ahafo Region', 'BA', 0, 1),
(1249, 82, 'Central Region', 'CE', 0, 1),
(1250, 82, 'Eastern Region', 'EA', 0, 1),
(1251, 82, 'Greater Accra Region', 'GA', 0, 1),
(1252, 82, 'Northern Region', 'NO', 0, 1),
(1253, 82, 'Upper East Region', 'UE', 0, 1),
(1254, 82, 'Upper West Region', 'UW', 0, 1),
(1255, 82, 'Volta Region', 'VO', 0, 1),
(1256, 82, 'Western Region', 'WE', 0, 1),
(1257, 84, 'Attica', 'AT', 0, 1),
(1258, 84, 'Central Greece', 'CN', 0, 1),
(1259, 84, 'Central Macedonia', 'CM', 0, 1),
(1260, 84, 'Crete', 'CR', 0, 1),
(1261, 84, 'East Macedonia and Thrace', 'EM', 0, 1),
(1262, 84, 'Epirus', 'EP', 0, 1),
(1263, 84, 'Ionian Islands', 'II', 0, 1),
(1264, 84, 'North Aegean', 'NA', 0, 1),
(1265, 84, 'Peloponnesos', 'PP', 0, 1),
(1266, 84, 'South Aegean', 'SA', 0, 1),
(1267, 84, 'Thessaly', 'TH', 0, 1),
(1268, 84, 'West Greece', 'WG', 0, 1),
(1269, 84, 'West Macedonia', 'WM', 0, 1),
(1270, 85, 'Avannaa', 'A', 0, 1),
(1271, 85, 'Tunu', 'T', 0, 1),
(1272, 85, 'Kitaa', 'K', 0, 1),
(1273, 86, 'Saint Andrew', 'A', 0, 1),
(1274, 86, 'Saint David', 'D', 0, 1),
(1275, 86, 'Saint George', 'G', 0, 1),
(1276, 86, 'Saint John', 'J', 0, 1),
(1277, 86, 'Saint Mark', 'M', 0, 1),
(1278, 86, 'Saint Patrick', 'P', 0, 1),
(1279, 86, 'Carriacou', 'C', 0, 1),
(1280, 86, 'Petit Martinique', 'Q', 0, 1),
(1281, 89, 'Alta Verapaz', 'AV', 0, 1),
(1282, 89, 'Baja Verapaz', 'BV', 0, 1),
(1283, 89, 'Chimaltenango', 'CM', 0, 1),
(1284, 89, 'Chiquimula', 'CQ', 0, 1),
(1285, 89, 'El Peten', 'PE', 0, 1),
(1286, 89, 'El Progreso', 'PR', 0, 1),
(1287, 89, 'El Quiche', 'QC', 0, 1),
(1288, 89, 'Escuintla', 'ES', 0, 1),
(1289, 89, 'Guatemala', 'GU', 0, 1),
(1290, 89, 'Huehuetenango', 'HU', 0, 1),
(1291, 89, 'Izabal', 'IZ', 0, 1),
(1292, 89, 'Jalapa', 'JA', 0, 1),
(1293, 89, 'Jutiapa', 'JU', 0, 1),
(1294, 89, 'Quetzaltenango', 'QZ', 0, 1),
(1295, 89, 'Retalhuleu', 'RE', 0, 1),
(1296, 89, 'Sacatepequez', 'ST', 0, 1),
(1297, 89, 'San Marcos', 'SM', 0, 1),
(1298, 89, 'Santa Rosa', 'SR', 0, 1),
(1299, 89, 'Solola', 'SO', 0, 1),
(1300, 89, 'Suchitepequez', 'SU', 0, 1),
(1301, 89, 'Totonicapan', 'TO', 0, 1),
(1302, 89, 'Zacapa', 'ZA', 0, 1),
(1303, 90, 'Conakry', 'CNK', 0, 1),
(1304, 90, 'Beyla', 'BYL', 0, 1),
(1305, 90, 'Boffa', 'BFA', 0, 1),
(1306, 90, 'Boke', 'BOK', 0, 1),
(1307, 90, 'Coyah', 'COY', 0, 1),
(1308, 90, 'Dabola', 'DBL', 0, 1),
(1309, 90, 'Dalaba', 'DLB', 0, 1),
(1310, 90, 'Dinguiraye', 'DGR', 0, 1),
(1311, 90, 'Dubreka', 'DBR', 0, 1),
(1312, 90, 'Faranah', 'FRN', 0, 1),
(1313, 90, 'Forecariah', 'FRC', 0, 1),
(1314, 90, 'Fria', 'FRI', 0, 1),
(1315, 90, 'Gaoual', 'GAO', 0, 1),
(1316, 90, 'Gueckedou', 'GCD', 0, 1),
(1317, 90, 'Kankan', 'KNK', 0, 1),
(1318, 90, 'Kerouane', 'KRN', 0, 1),
(1319, 90, 'Kindia', 'KND', 0, 1),
(1320, 90, 'Kissidougou', 'KSD', 0, 1),
(1321, 90, 'Koubia', 'KBA', 0, 1),
(1322, 90, 'Koundara', 'KDA', 0, 1),
(1323, 90, 'Kouroussa', 'KRA', 0, 1),
(1324, 90, 'Labe', 'LAB', 0, 1),
(1325, 90, 'Lelouma', 'LLM', 0, 1),
(1326, 90, 'Lola', 'LOL', 0, 1),
(1327, 90, 'Macenta', 'MCT', 0, 1),
(1328, 90, 'Mali', 'MAL', 0, 1),
(1329, 90, 'Mamou', 'MAM', 0, 1),
(1330, 90, 'Mandiana', 'MAN', 0, 1),
(1331, 90, 'Nzerekore', 'NZR', 0, 1),
(1332, 90, 'Pita', 'PIT', 0, 1),
(1333, 90, 'Siguiri', 'SIG', 0, 1),
(1334, 90, 'Telimele', 'TLM', 0, 1),
(1335, 90, 'Tougue', 'TOG', 0, 1),
(1336, 90, 'Yomou', 'YOM', 0, 1),
(1337, 91, 'Bafata Region', 'BF', 0, 1),
(1338, 91, 'Biombo Region', 'BB', 0, 1),
(1339, 91, 'Bissau Region', 'BS', 0, 1),
(1340, 91, 'Bolama Region', 'BL', 0, 1),
(1341, 91, 'Cacheu Region', 'CA', 0, 1),
(1342, 91, 'Gabu Region', 'GA', 0, 1),
(1343, 91, 'Oio Region', 'OI', 0, 1),
(1344, 91, 'Quinara Region', 'QU', 0, 1),
(1345, 91, 'Tombali Region', 'TO', 0, 1),
(1346, 92, 'Barima-Waini', 'BW', 0, 1),
(1347, 92, 'Cuyuni-Mazaruni', 'CM', 0, 1),
(1348, 92, 'Demerara-Mahaica', 'DM', 0, 1),
(1349, 92, 'East Berbice-Corentyne', 'EC', 0, 1),
(1350, 92, 'Essequibo Islands-West Demerara', 'EW', 0, 1),
(1351, 92, 'Mahaica-Berbice', 'MB', 0, 1),
(1352, 92, 'Pomeroon-Supenaam', 'PM', 0, 1),
(1353, 92, 'Potaro-Siparuni', 'PI', 0, 1),
(1354, 92, 'Upper Demerara-Berbice', 'UD', 0, 1),
(1355, 92, 'Upper Takutu-Upper Essequibo', 'UT', 0, 1),
(1356, 93, 'Artibonite', 'AR', 0, 1),
(1357, 93, 'Centre', 'CE', 0, 1),
(1358, 93, 'Grand\'Anse', 'GA', 0, 1),
(1359, 93, 'Nord', 'ND', 0, 1),
(1360, 93, 'Nord-Est', 'NE', 0, 1),
(1361, 93, 'Nord-Ouest', 'NO', 0, 1),
(1362, 93, 'Ouest', 'OU', 0, 1),
(1363, 93, 'Sud', 'SD', 0, 1),
(1364, 93, 'Sud-Est', 'SE', 0, 1),
(1365, 94, 'Flat Island', 'F', 0, 1),
(1366, 94, 'McDonald Island', 'M', 0, 1),
(1367, 94, 'Shag Island', 'S', 0, 1),
(1368, 94, 'Heard Island', 'H', 0, 1),
(1369, 95, 'Atlantida', 'AT', 0, 1),
(1370, 95, 'Choluteca', 'CH', 0, 1),
(1371, 95, 'Colon', 'CL', 0, 1),
(1372, 95, 'Comayagua', 'CM', 0, 1),
(1373, 95, 'Copan', 'CP', 0, 1),
(1374, 95, 'Cortes', 'CR', 0, 1),
(1375, 95, 'El Paraiso', 'PA', 0, 1),
(1376, 95, 'Francisco Morazan', 'FM', 0, 1),
(1377, 95, 'Gracias a Dios', 'GD', 0, 1),
(1378, 95, 'Intibuca', 'IN', 0, 1),
(1379, 95, 'Islas de la Bahia (Bay Islands)', 'IB', 0, 1),
(1380, 95, 'La Paz', 'PZ', 0, 1),
(1381, 95, 'Lempira', 'LE', 0, 1),
(1382, 95, 'Ocotepeque', 'OC', 0, 1),
(1383, 95, 'Olancho', 'OL', 0, 1),
(1384, 95, 'Santa Barbara', 'SB', 0, 1),
(1385, 95, 'Valle', 'VA', 0, 1),
(1386, 95, 'Yoro', 'YO', 0, 1),
(1387, 96, 'Central and Western Hong Kong Island', 'HCW', 0, 1),
(1388, 96, 'Eastern Hong Kong Island', 'HEA', 0, 1),
(1389, 96, 'Southern Hong Kong Island', 'HSO', 0, 1),
(1390, 96, 'Wan Chai Hong Kong Island', 'HWC', 0, 1),
(1391, 96, 'Kowloon City Kowloon', 'KKC', 0, 1),
(1392, 96, 'Kwun Tong Kowloon', 'KKT', 0, 1),
(1393, 96, 'Sham Shui Po Kowloon', 'KSS', 0, 1),
(1394, 96, 'Wong Tai Sin Kowloon', 'KWT', 0, 1),
(1395, 96, 'Yau Tsim Mong Kowloon', 'KYT', 0, 1),
(1396, 96, 'Islands New Territories', 'NIS', 0, 1),
(1397, 96, 'Kwai Tsing New Territories', 'NKT', 0, 1),
(1398, 96, 'North New Territories', 'NNO', 0, 1),
(1399, 96, 'Sai Kung New Territories', 'NSK', 0, 1),
(1400, 96, 'Sha Tin New Territories', 'NST', 0, 1),
(1401, 96, 'Tai Po New Territories', 'NTP', 0, 1),
(1402, 96, 'Tsuen Wan New Territories', 'NTW', 0, 1),
(1403, 96, 'Tuen Mun New Territories', 'NTM', 0, 1),
(1404, 96, 'Yuen Long New Territories', 'NYL', 0, 1),
(1405, 98, 'Austurland', 'AL', 0, 1),
(1406, 98, 'Hofuoborgarsvaeoi', 'HF', 0, 1),
(1407, 98, 'Norourland eystra', 'NE', 0, 1),
(1408, 98, 'Norourland vestra', 'NV', 0, 1);
INSERT INTO `mlm_states` (`id`, `country_id`, `state_name`, `code`, `reg_count`, `status`) VALUES
(1409, 98, 'Suourland', 'SL', 0, 1),
(1410, 98, 'Suournes', 'SN', 0, 1),
(1411, 98, 'Vestfiroir', 'VF', 0, 1),
(1412, 98, 'Vesturland', 'VL', 0, 1),
(1413, 99, 'Andaman and Nicobar Islands', 'AN', 0, 1),
(1414, 99, 'Andhra Pradesh', 'AP', 0, 1),
(1415, 99, 'Arunachal Pradesh', 'AR', 0, 1),
(1416, 99, 'Assam', 'AS', 0, 1),
(1417, 99, 'Bihar', 'BI', 0, 1),
(1418, 99, 'Chandigarh', 'CH', 0, 1),
(1419, 99, 'Dadra and Nagar Haveli', 'DA', 0, 1),
(1420, 99, 'Daman and Diu', 'DM', 0, 1),
(1421, 99, 'Delhi', 'DE', 0, 1),
(1422, 99, 'Goa', 'GO', 0, 1),
(1423, 99, 'Gujarat', 'GU', 0, 1),
(1424, 99, 'Haryana', 'HA', 0, 1),
(1425, 99, 'Himachal Pradesh', 'HP', 0, 1),
(1426, 99, 'Jammu and Kashmir', 'JA', 0, 1),
(1427, 99, 'Karnataka', 'KA', 0, 1),
(1428, 99, 'Kerala', 'KE', 2, 1),
(1429, 99, 'Lakshadweep Islands', 'LI', 0, 1),
(1430, 99, 'Madhya Pradesh', 'MP', 0, 1),
(1431, 99, 'Maharashtra', 'MA', 0, 1),
(1432, 99, 'Manipur', 'MN', 0, 1),
(1433, 99, 'Meghalaya', 'ME', 0, 1),
(1434, 99, 'Mizoram', 'MI', 0, 1),
(1435, 99, 'Nagaland', 'NA', 0, 1),
(1436, 99, 'Orissa', 'OR', 0, 1),
(1437, 99, 'Puducherry', 'PO', 0, 1),
(1438, 99, 'Punjab', 'PU', 0, 1),
(1439, 99, 'Rajasthan', 'RA', 0, 1),
(1440, 99, 'Sikkim', 'SI', 0, 1),
(1441, 99, 'Tamil Nadu', 'TN', 0, 1),
(1442, 99, 'Tripura', 'TR', 0, 1),
(1443, 99, 'Uttar Pradesh', 'UP', 0, 1),
(1444, 99, 'West Bengal', 'WB', 0, 1),
(1445, 100, 'Aceh', 'AC', 0, 1),
(1446, 100, 'Bali', 'BA', 0, 1),
(1447, 100, 'Banten', 'BT', 0, 1),
(1448, 100, 'Bengkulu', 'BE', 0, 1),
(1449, 100, 'Kalimantan Utara', 'BD', 0, 1),
(1450, 100, 'Gorontalo', 'GO', 0, 1),
(1451, 100, 'Jakarta', 'JK', 0, 1),
(1452, 100, 'Jambi', 'JA', 0, 1),
(1453, 100, 'Jawa Barat', 'JB', 0, 1),
(1454, 100, 'Jawa Tengah', 'JT', 0, 1),
(1455, 100, 'Jawa Timur', 'JI', 0, 1),
(1456, 100, 'Kalimantan Barat', 'KB', 0, 1),
(1457, 100, 'Kalimantan Selatan', 'KS', 0, 1),
(1458, 100, 'Kalimantan Tengah', 'KT', 0, 1),
(1459, 100, 'Kalimantan Timur', 'KI', 0, 1),
(1460, 100, 'Kepulauan Bangka Belitung', 'BB', 0, 1),
(1461, 100, 'Lampung', 'LA', 0, 1),
(1462, 100, 'Maluku', 'MA', 0, 1),
(1463, 100, 'Maluku Utara', 'MU', 0, 1),
(1464, 100, 'Nusa Tenggara Barat', 'NB', 0, 1),
(1465, 100, 'Nusa Tenggara Timur', 'NT', 0, 1),
(1466, 100, 'Papua', 'PA', 0, 1),
(1467, 100, 'Riau', 'RI', 0, 1),
(1468, 100, 'Sulawesi Selatan', 'SN', 0, 1),
(1469, 100, 'Sulawesi Tengah', 'ST', 0, 1),
(1470, 100, 'Sulawesi Tenggara', 'SG', 0, 1),
(1471, 100, 'Sulawesi Utara', 'SA', 0, 1),
(1472, 100, 'Sumatera Barat', 'SB', 0, 1),
(1473, 100, 'Sumatera Selatan', 'SS', 0, 1),
(1474, 100, 'Sumatera Utara', 'SU', 0, 1),
(1475, 100, 'Yogyakarta', 'YO', 0, 1),
(1476, 101, 'Tehran', 'TEH', 0, 1),
(1477, 101, 'Qom', 'QOM', 0, 1),
(1478, 101, 'Markazi', 'MKZ', 0, 1),
(1479, 101, 'Qazvin', 'QAZ', 0, 1),
(1480, 101, 'Gilan', 'GIL', 0, 1),
(1481, 101, 'Ardabil', 'ARD', 0, 1),
(1482, 101, 'Zanjan', 'ZAN', 0, 1),
(1483, 101, 'East Azarbaijan', 'EAZ', 0, 1),
(1484, 101, 'West Azarbaijan', 'WEZ', 0, 1),
(1485, 101, 'Kurdistan', 'KRD', 0, 1),
(1486, 101, 'Hamadan', 'HMD', 0, 1),
(1487, 101, 'Kermanshah', 'KRM', 0, 1),
(1488, 101, 'Ilam', 'ILM', 0, 1),
(1489, 101, 'Lorestan', 'LRS', 0, 1),
(1490, 101, 'Khuzestan', 'KZT', 0, 1),
(1491, 101, 'Chahar Mahaal and Bakhtiari', 'CMB', 0, 1),
(1492, 101, 'Kohkiluyeh and Buyer Ahmad', 'KBA', 0, 1),
(1493, 101, 'Bushehr', 'BSH', 0, 1),
(1494, 101, 'Fars', 'FAR', 0, 1),
(1495, 101, 'Hormozgan', 'HRM', 0, 1),
(1496, 101, 'Sistan and Baluchistan', 'SBL', 0, 1),
(1497, 101, 'Kerman', 'KRB', 0, 1),
(1498, 101, 'Yazd', 'YZD', 0, 1),
(1499, 101, 'Esfahan', 'EFH', 0, 1),
(1500, 101, 'Semnan', 'SMN', 0, 1),
(1501, 101, 'Mazandaran', 'MZD', 0, 1),
(1502, 101, 'Golestan', 'GLS', 0, 1),
(1503, 101, 'North Khorasan', 'NKH', 0, 1),
(1504, 101, 'Razavi Khorasan', 'RKH', 0, 1),
(1505, 101, 'South Khorasan', 'SKH', 0, 1),
(1506, 102, 'Baghdad', 'BD', 0, 1),
(1507, 102, 'Salah ad Din', 'SD', 0, 1),
(1508, 102, 'Diyala', 'DY', 0, 1),
(1509, 102, 'Wasit', 'WS', 0, 1),
(1510, 102, 'Maysan', 'MY', 0, 1),
(1511, 102, 'Al Basrah', 'BA', 0, 1),
(1512, 102, 'Dhi Qar', 'DQ', 0, 1),
(1513, 102, 'Al Muthanna', 'MU', 0, 1),
(1514, 102, 'Al Qadisyah', 'QA', 0, 1),
(1515, 102, 'Babil', 'BB', 0, 1),
(1516, 102, 'Al Karbala', 'KB', 0, 1),
(1517, 102, 'An Najaf', 'NJ', 0, 1),
(1518, 102, 'Al Anbar', 'AB', 0, 1),
(1519, 102, 'Ninawa', 'NN', 0, 1),
(1520, 102, 'Dahuk', 'DH', 0, 1),
(1521, 102, 'Arbil', 'AL', 0, 1),
(1522, 102, 'At Ta\'mim', 'TM', 0, 1),
(1523, 102, 'As Sulaymaniyah', 'SL', 0, 1),
(1524, 103, 'Carlow', 'CA', 0, 1),
(1525, 103, 'Cavan', 'CV', 0, 1),
(1526, 103, 'Clare', 'CL', 0, 1),
(1527, 103, 'Cork', 'CO', 0, 1),
(1528, 103, 'Donegal', 'DO', 0, 1),
(1529, 103, 'Dublin', 'DU', 0, 1),
(1530, 103, 'Galway', 'GA', 0, 1),
(1531, 103, 'Kerry', 'KE', 0, 1),
(1532, 103, 'Kildare', 'KI', 0, 1),
(1533, 103, 'Kilkenny', 'KL', 0, 1),
(1534, 103, 'Laois', 'LA', 0, 1),
(1535, 103, 'Leitrim', 'LE', 0, 1),
(1536, 103, 'Limerick', 'LI', 0, 1),
(1537, 103, 'Longford', 'LO', 0, 1),
(1538, 103, 'Louth', 'LU', 0, 1),
(1539, 103, 'Mayo', 'MA', 0, 1),
(1540, 103, 'Meath', 'ME', 0, 1),
(1541, 103, 'Monaghan', 'MO', 0, 1),
(1542, 103, 'Offaly', 'OF', 0, 1),
(1543, 103, 'Roscommon', 'RO', 0, 1),
(1544, 103, 'Sligo', 'SL', 0, 1),
(1545, 103, 'Tipperary', 'TI', 0, 1),
(1546, 103, 'Waterford', 'WA', 0, 1),
(1547, 103, 'Westmeath', 'WE', 0, 1),
(1548, 103, 'Wexford', 'WX', 0, 1),
(1549, 103, 'Wicklow', 'WI', 0, 1),
(1550, 104, 'Be\'er Sheva', 'BS', 0, 1),
(1551, 104, 'Bika\'at Hayarden', 'BH', 0, 1),
(1552, 104, 'Eilat and Arava', 'EA', 0, 1),
(1553, 104, 'Galil', 'GA', 0, 1),
(1554, 104, 'Haifa', 'HA', 0, 1),
(1555, 104, 'Jehuda Mountains', 'JM', 0, 1),
(1556, 104, 'Jerusalem', 'JE', 0, 1),
(1557, 104, 'Negev', 'NE', 0, 1),
(1558, 104, 'Semaria', 'SE', 0, 1),
(1559, 104, 'Sharon', 'SH', 0, 1),
(1560, 104, 'Tel Aviv (Gosh Dan)', 'TA', 0, 1),
(1561, 105, 'Caltanissetta', 'CL', 0, 1),
(1562, 105, 'Agrigento', 'AG', 0, 1),
(1563, 105, 'Alessandria', 'AL', 0, 1),
(1564, 105, 'Ancona', 'AN', 0, 1),
(1565, 105, 'Aosta', 'AO', 0, 1),
(1566, 105, 'Arezzo', 'AR', 0, 1),
(1567, 105, 'Ascoli Piceno', 'AP', 0, 1),
(1568, 105, 'Asti', 'AT', 0, 1),
(1569, 105, 'Avellino', 'AV', 0, 1),
(1570, 105, 'Bari', 'BA', 0, 1),
(1571, 105, 'Belluno', 'BL', 0, 1),
(1572, 105, 'Benevento', 'BN', 0, 1),
(1573, 105, 'Bergamo', 'BG', 0, 1),
(1574, 105, 'Biella', 'BI', 0, 1),
(1575, 105, 'Bologna', 'BO', 0, 1),
(1576, 105, 'Bolzano', 'BZ', 0, 1),
(1577, 105, 'Brescia', 'BS', 0, 1),
(1578, 105, 'Brindisi', 'BR', 0, 1),
(1579, 105, 'Cagliari', 'CA', 0, 1),
(1580, 106, 'Clarendon Parish', 'CLA', 0, 1),
(1581, 106, 'Hanover Parish', 'HAN', 0, 1),
(1582, 106, 'Kingston Parish', 'KIN', 0, 1),
(1583, 106, 'Manchester Parish', 'MAN', 0, 1),
(1584, 106, 'Portland Parish', 'POR', 0, 1),
(1585, 106, 'Saint Andrew Parish', 'AND', 0, 1),
(1586, 106, 'Saint Ann Parish', 'ANN', 0, 1),
(1587, 106, 'Saint Catherine Parish', 'CAT', 0, 1),
(1588, 106, 'Saint Elizabeth Parish', 'ELI', 0, 1),
(1589, 106, 'Saint James Parish', 'JAM', 0, 1),
(1590, 106, 'Saint Mary Parish', 'MAR', 0, 1),
(1591, 106, 'Saint Thomas Parish', 'THO', 0, 1),
(1592, 106, 'Trelawny Parish', 'TRL', 0, 1),
(1593, 106, 'Westmoreland Parish', 'WML', 0, 1),
(1594, 107, 'Aichi', 'AI', 0, 1),
(1595, 107, 'Akita', 'AK', 0, 1),
(1596, 107, 'Aomori', 'AO', 0, 1),
(1597, 107, 'Chiba', 'CH', 0, 1),
(1598, 107, 'Ehime', 'EH', 0, 1),
(1599, 107, 'Fukui', 'FK', 0, 1),
(1600, 107, 'Fukuoka', 'FU', 0, 1),
(1601, 107, 'Fukushima', 'FS', 0, 1),
(1602, 107, 'Gifu', 'GI', 0, 1),
(1603, 107, 'Gumma', 'GU', 0, 1),
(1604, 107, 'Hiroshima', 'HI', 0, 1),
(1605, 107, 'Hokkaido', 'HO', 0, 1),
(1606, 107, 'Hyogo', 'HY', 0, 1),
(1607, 107, 'Ibaraki', 'IB', 0, 1),
(1608, 107, 'Ishikawa', 'IS', 0, 1),
(1609, 107, 'Iwate', 'IW', 0, 1),
(1610, 107, 'Kagawa', 'KA', 0, 1),
(1611, 107, 'Kagoshima', 'KG', 0, 1),
(1612, 107, 'Kanagawa', 'KN', 0, 1),
(1613, 107, 'Kochi', 'KO', 0, 1),
(1614, 107, 'Kumamoto', 'KU', 0, 1),
(1615, 107, 'Kyoto', 'KY', 0, 1),
(1616, 107, 'Mie', 'MI', 0, 1),
(1617, 107, 'Miyagi', 'MY', 0, 1),
(1618, 107, 'Miyazaki', 'MZ', 0, 1),
(1619, 107, 'Nagano', 'NA', 0, 1),
(1620, 107, 'Nagasaki', 'NG', 0, 1),
(1621, 107, 'Nara', 'NR', 0, 1),
(1622, 107, 'Niigata', 'NI', 0, 1),
(1623, 107, 'Oita', 'OI', 0, 1),
(1624, 107, 'Okayama', 'OK', 0, 1),
(1625, 107, 'Okinawa', 'ON', 0, 1),
(1626, 107, 'Osaka', 'OS', 0, 1),
(1627, 107, 'Saga', 'SA', 0, 1),
(1628, 107, 'Saitama', 'SI', 0, 1),
(1629, 107, 'Shiga', 'SH', 0, 1),
(1630, 107, 'Shimane', 'SM', 0, 1),
(1631, 107, 'Shizuoka', 'SZ', 0, 1),
(1632, 107, 'Tochigi', 'TO', 0, 1),
(1633, 107, 'Tokushima', 'TS', 0, 1),
(1634, 107, 'Tokyo', 'TK', 0, 1),
(1635, 107, 'Tottori', 'TT', 0, 1),
(1636, 107, 'Toyama', 'TY', 0, 1),
(1637, 107, 'Wakayama', 'WA', 0, 1),
(1638, 107, 'Yamagata', 'YA', 0, 1),
(1639, 107, 'Yamaguchi', 'YM', 0, 1),
(1640, 107, 'Yamanashi', 'YN', 0, 1),
(1641, 108, '\'Amman', 'AM', 0, 1),
(1642, 108, 'Ajlun', 'AJ', 0, 1),
(1643, 108, 'Al \'Aqabah', 'AA', 0, 1),
(1644, 108, 'Al Balqa\'', 'AB', 0, 1),
(1645, 108, 'Al Karak', 'AK', 0, 1),
(1646, 108, 'Al Mafraq', 'AL', 0, 1),
(1647, 108, 'At Tafilah', 'AT', 0, 1),
(1648, 108, 'Az Zarqa\'', 'AZ', 0, 1),
(1649, 108, 'Irbid', 'IR', 0, 1),
(1650, 108, 'Jarash', 'JA', 0, 1),
(1651, 108, 'Ma\'an', 'MA', 0, 1),
(1652, 108, 'Madaba', 'MD', 0, 1),
(1653, 109, 'Almaty', 'AL', 0, 1),
(1654, 109, 'Almaty City', 'AC', 0, 1),
(1655, 109, 'Aqmola', 'AM', 0, 1),
(1656, 109, 'Aqtobe', 'AQ', 0, 1),
(1657, 109, 'Astana City', 'AS', 0, 1),
(1658, 109, 'Atyrau', 'AT', 0, 1),
(1659, 109, 'Batys Qazaqstan', 'BA', 0, 1),
(1660, 109, 'Bayqongyr City', 'BY', 0, 1),
(1661, 109, 'Mangghystau', 'MA', 0, 1),
(1662, 109, 'Ongtustik Qazaqstan', 'ON', 0, 1),
(1663, 109, 'Pavlodar', 'PA', 0, 1),
(1664, 109, 'Qaraghandy', 'QA', 0, 1),
(1665, 109, 'Qostanay', 'QO', 0, 1),
(1666, 109, 'Qyzylorda', 'QY', 0, 1),
(1667, 109, 'Shyghys Qazaqstan', 'SH', 0, 1),
(1668, 109, 'Soltustik Qazaqstan', 'SO', 0, 1),
(1669, 109, 'Zhambyl', 'ZH', 0, 1),
(1670, 110, 'Central', 'CE', 0, 1),
(1671, 110, 'Coast', 'CO', 0, 1),
(1672, 110, 'Eastern', 'EA', 0, 1),
(1673, 110, 'Nairobi Area', 'NA', 0, 1),
(1674, 110, 'North Eastern', 'NE', 0, 1),
(1675, 110, 'Nyanza', 'NY', 0, 1),
(1676, 110, 'Rift Valley', 'RV', 0, 1),
(1677, 110, 'Western', 'WE', 0, 1),
(1678, 111, 'Abaiang', 'AG', 0, 1),
(1679, 111, 'Abemama', 'AM', 0, 1),
(1680, 111, 'Aranuka', 'AK', 0, 1),
(1681, 111, 'Arorae', 'AO', 0, 1),
(1682, 111, 'Banaba', 'BA', 0, 1),
(1683, 111, 'Beru', 'BE', 0, 1),
(1684, 111, 'Butaritari', 'bT', 0, 1),
(1685, 111, 'Kanton', 'KA', 0, 1),
(1686, 111, 'Kiritimati', 'KR', 0, 1),
(1687, 111, 'Kuria', 'KU', 0, 1),
(1688, 111, 'Maiana', 'MI', 0, 1),
(1689, 111, 'Makin', 'MN', 0, 1),
(1690, 111, 'Marakei', 'ME', 0, 1),
(1691, 111, 'Nikunau', 'NI', 0, 1),
(1692, 111, 'Nonouti', 'NO', 0, 1),
(1693, 111, 'Onotoa', 'ON', 0, 1),
(1694, 111, 'Tabiteuea', 'TT', 0, 1),
(1695, 111, 'Tabuaeran', 'TR', 0, 1),
(1696, 111, 'Tamana', 'TM', 0, 1),
(1697, 111, 'Tarawa', 'TW', 0, 1),
(1698, 111, 'Teraina', 'TE', 0, 1),
(1699, 112, 'Chagang-do', 'CHA', 0, 1),
(1700, 112, 'Hamgyong-bukto', 'HAB', 0, 1),
(1701, 112, 'Hamgyong-namdo', 'HAN', 0, 1),
(1702, 112, 'Hwanghae-bukto', 'HWB', 0, 1),
(1703, 112, 'Hwanghae-namdo', 'HWN', 0, 1),
(1704, 112, 'Kangwon-do', 'KAN', 0, 1),
(1705, 112, 'P\'yongan-bukto', 'PYB', 0, 1),
(1706, 112, 'P\'yongan-namdo', 'PYN', 0, 1),
(1707, 112, 'Ryanggang-do (Yanggang-do)', 'YAN', 0, 1),
(1708, 112, 'Rason Directly Governed City', 'NAJ', 0, 1),
(1709, 112, 'P\'yongyang Special City', 'PYO', 0, 1),
(1710, 113, 'Ch\'ungch\'ong-bukto', 'CO', 0, 1),
(1711, 113, 'Ch\'ungch\'ong-namdo', 'CH', 0, 1),
(1712, 113, 'Cheju-do', 'CD', 0, 1),
(1713, 113, 'Cholla-bukto', 'CB', 0, 1),
(1714, 113, 'Cholla-namdo', 'CN', 0, 1),
(1715, 113, 'Inch\'on-gwangyoksi', 'IG', 0, 1),
(1716, 113, 'Kangwon-do', 'KA', 0, 1),
(1717, 113, 'Kwangju-gwangyoksi', 'KG', 0, 1),
(1718, 113, 'Kyonggi-do', 'KD', 0, 1),
(1719, 113, 'Kyongsang-bukto', 'KB', 0, 1),
(1720, 113, 'Kyongsang-namdo', 'KN', 0, 1),
(1721, 113, 'Pusan-gwangyoksi', 'PG', 0, 1),
(1722, 113, 'Soul-t\'ukpyolsi', 'SO', 0, 1),
(1723, 113, 'Taegu-gwangyoksi', 'TA', 0, 1),
(1724, 113, 'Taejon-gwangyoksi', 'TG', 0, 1),
(1725, 114, 'Al \'Asimah', 'AL', 0, 1),
(1726, 114, 'Al Ahmadi', 'AA', 0, 1),
(1727, 114, 'Al Farwaniyah', 'AF', 0, 1),
(1728, 114, 'Al Jahra\'', 'AJ', 0, 1),
(1729, 114, 'Hawalli', 'HA', 0, 1),
(1730, 115, 'Bishkek', 'GB', 0, 1),
(1731, 115, 'Batken', 'B', 0, 1),
(1732, 115, 'Chu', 'C', 0, 1),
(1733, 115, 'Jalal-Abad', 'J', 0, 1),
(1734, 115, 'Naryn', 'N', 0, 1),
(1735, 115, 'Osh', 'O', 0, 1),
(1736, 115, 'Talas', 'T', 0, 1),
(1737, 115, 'Ysyk-Kol', 'Y', 0, 1),
(1738, 116, 'Vientiane', 'VT', 0, 1),
(1739, 116, 'Attapu', 'AT', 0, 1),
(1740, 116, 'Bokeo', 'BK', 0, 1),
(1741, 116, 'Bolikhamxai', 'BL', 0, 1),
(1742, 116, 'Champasak', 'CH', 0, 1),
(1743, 116, 'Houaphan', 'HO', 0, 1),
(1744, 116, 'Khammouan', 'KH', 0, 1),
(1745, 116, 'Louang Namtha', 'LM', 0, 1),
(1746, 116, 'Louangphabang', 'LP', 0, 1),
(1747, 116, 'Oudomxai', 'OU', 0, 1),
(1748, 116, 'Phongsali', 'PH', 0, 1),
(1749, 116, 'Salavan', 'SL', 0, 1),
(1750, 116, 'Savannakhet', 'SV', 0, 1),
(1751, 116, 'Vientiane', 'VI', 0, 1),
(1752, 116, 'Xaignabouli', 'XA', 0, 1),
(1753, 116, 'Xekong', 'XE', 0, 1),
(1754, 116, 'Xiangkhoang', 'XI', 0, 1),
(1755, 116, 'Xaisomboun', 'XN', 0, 1),
(1756, 119, 'Berea', 'BE', 0, 1),
(1757, 119, 'Butha-Buthe', 'BB', 0, 1),
(1758, 119, 'Leribe', 'LE', 0, 1),
(1759, 119, 'Mafeteng', 'MF', 0, 1),
(1760, 119, 'Maseru', 'MS', 0, 1),
(1761, 119, 'Mohale\'s Hoek', 'MH', 0, 1),
(1762, 119, 'Mokhotlong', 'MK', 0, 1),
(1763, 119, 'Qacha\'s Nek', 'QN', 0, 1),
(1764, 119, 'Quthing', 'QT', 0, 1),
(1765, 119, 'Thaba-Tseka', 'TT', 0, 1),
(1766, 120, 'Bomi', 'BI', 0, 1),
(1767, 120, 'Bong', 'BG', 0, 1),
(1768, 120, 'Grand Bassa', 'GB', 0, 1),
(1769, 120, 'Grand Cape Mount', 'CM', 0, 1),
(1770, 120, 'Grand Gedeh', 'GG', 0, 1),
(1771, 120, 'Grand Kru', 'GK', 0, 1),
(1772, 120, 'Lofa', 'LO', 0, 1),
(1773, 120, 'Margibi', 'MG', 0, 1),
(1774, 120, 'Maryland', 'ML', 0, 1),
(1775, 120, 'Montserrado', 'MS', 0, 1),
(1776, 120, 'Nimba', 'NB', 0, 1),
(1777, 120, 'River Cess', 'RC', 0, 1),
(1778, 120, 'Sinoe', 'SN', 0, 1),
(1779, 121, 'Ajdabiya', 'AJ', 0, 1),
(1780, 121, 'Al \'Aziziyah', 'AZ', 0, 1),
(1781, 121, 'Al Fatih', 'FA', 0, 1),
(1782, 121, 'Al Jabal al Akhdar', 'JA', 0, 1),
(1783, 121, 'Al Jufrah', 'JU', 0, 1),
(1784, 121, 'Al Khums', 'KH', 0, 1),
(1785, 121, 'Al Kufrah', 'KU', 0, 1),
(1786, 121, 'An Nuqat al Khams', 'NK', 0, 1),
(1787, 121, 'Ash Shati\'', 'AS', 0, 1),
(1788, 121, 'Awbari', 'AW', 0, 1),
(1789, 121, 'Az Zawiyah', 'ZA', 0, 1),
(1790, 121, 'Banghazi', 'BA', 0, 1),
(1791, 121, 'Darnah', 'DA', 0, 1),
(1792, 121, 'Ghadamis', 'GD', 0, 1),
(1793, 121, 'Gharyan', 'GY', 0, 1),
(1794, 121, 'Misratah', 'MI', 0, 1),
(1795, 121, 'Murzuq', 'MZ', 0, 1),
(1796, 121, 'Sabha', 'SB', 0, 1),
(1797, 121, 'Sawfajjin', 'SW', 0, 1),
(1798, 121, 'Surt', 'SU', 0, 1),
(1799, 121, 'Tarabulus (Tripoli)', 'TL', 0, 1),
(1800, 121, 'Tarhunah', 'TH', 0, 1),
(1801, 121, 'Tubruq', 'TU', 0, 1),
(1802, 121, 'Yafran', 'YA', 0, 1),
(1803, 121, 'Zlitan', 'ZL', 0, 1),
(1804, 122, 'Vaduz', 'V', 0, 1),
(1805, 122, 'Schaan', 'A', 0, 1),
(1806, 122, 'Balzers', 'B', 0, 1),
(1807, 122, 'Triesen', 'N', 0, 1),
(1808, 122, 'Eschen', 'E', 0, 1),
(1809, 122, 'Mauren', 'M', 0, 1),
(1810, 122, 'Triesenberg', 'T', 0, 1),
(1811, 122, 'Ruggell', 'R', 0, 1),
(1812, 122, 'Gamprin', 'G', 0, 1),
(1813, 122, 'Schellenberg', 'L', 0, 1),
(1814, 122, 'Planken', 'P', 0, 1),
(1815, 123, 'Alytus', 'AL', 0, 1),
(1816, 123, 'Kaunas', 'KA', 0, 1),
(1817, 123, 'Klaipeda', 'KL', 0, 1),
(1818, 123, 'Marijampole', 'MA', 0, 1),
(1819, 123, 'Panevezys', 'PA', 0, 1),
(1820, 123, 'Siauliai', 'SI', 0, 1),
(1821, 123, 'Taurage', 'TA', 0, 1),
(1822, 123, 'Telsiai', 'TE', 0, 1),
(1823, 123, 'Utena', 'UT', 0, 1),
(1824, 123, 'Vilnius', 'VI', 0, 1),
(1825, 124, 'Diekirch', 'DD', 0, 1),
(1826, 124, 'Clervaux', 'DC', 0, 1),
(1827, 124, 'Redange', 'DR', 0, 1),
(1828, 124, 'Vianden', 'DV', 0, 1),
(1829, 124, 'Wiltz', 'DW', 0, 1),
(1830, 124, 'Grevenmacher', 'GG', 0, 1),
(1831, 124, 'Echternach', 'GE', 0, 1),
(1832, 124, 'Remich', 'GR', 0, 1),
(1833, 124, 'Luxembourg', 'LL', 0, 1),
(1834, 124, 'Capellen', 'LC', 0, 1),
(1835, 124, 'Esch-sur-Alzette', 'LE', 0, 1),
(1836, 124, 'Mersch', 'LM', 0, 1),
(1837, 125, 'Our Lady Fatima Parish', 'OLF', 0, 1),
(1838, 125, 'St. Anthony Parish', 'ANT', 0, 1),
(1839, 125, 'St. Lazarus Parish', 'LAZ', 0, 1),
(1840, 125, 'Cathedral Parish', 'CAT', 0, 1),
(1841, 125, 'St. Lawrence Parish', 'LAW', 0, 1),
(1842, 127, 'Antananarivo', 'AN', 0, 1),
(1843, 127, 'Antsiranana', 'AS', 0, 1),
(1844, 127, 'Fianarantsoa', 'FN', 0, 1),
(1845, 127, 'Mahajanga', 'MJ', 0, 1),
(1846, 127, 'Toamasina', 'TM', 0, 1),
(1847, 127, 'Toliara', 'TL', 0, 1),
(1848, 128, 'Balaka', 'BLK', 0, 1),
(1849, 128, 'Blantyre', 'BLT', 0, 1),
(1850, 128, 'Chikwawa', 'CKW', 0, 1),
(1851, 128, 'Chiradzulu', 'CRD', 0, 1),
(1852, 128, 'Chitipa', 'CTP', 0, 1),
(1853, 128, 'Dedza', 'DDZ', 0, 1),
(1854, 128, 'Dowa', 'DWA', 0, 1),
(1855, 128, 'Karonga', 'KRG', 0, 1),
(1856, 128, 'Kasungu', 'KSG', 0, 1),
(1857, 128, 'Likoma', 'LKM', 0, 1),
(1858, 128, 'Lilongwe', 'LLG', 0, 1),
(1859, 128, 'Machinga', 'MCG', 0, 1),
(1860, 128, 'Mangochi', 'MGC', 0, 1),
(1861, 128, 'Mchinji', 'MCH', 0, 1),
(1862, 128, 'Mulanje', 'MLJ', 0, 1),
(1863, 128, 'Mwanza', 'MWZ', 0, 1),
(1864, 128, 'Mzimba', 'MZM', 0, 1),
(1865, 128, 'Ntcheu', 'NTU', 0, 1),
(1866, 128, 'Nkhata Bay', 'NKB', 0, 1),
(1867, 128, 'Nkhotakota', 'NKH', 0, 1),
(1868, 128, 'Nsanje', 'NSJ', 0, 1),
(1869, 128, 'Ntchisi', 'NTI', 0, 1),
(1870, 128, 'Phalombe', 'PHL', 0, 1),
(1871, 128, 'Rumphi', 'RMP', 0, 1),
(1872, 128, 'Salima', 'SLM', 0, 1),
(1873, 128, 'Thyolo', 'THY', 0, 1),
(1874, 128, 'Zomba', 'ZBA', 0, 1),
(1875, 129, 'Johor', 'MY-01', 0, 1),
(1876, 129, 'Kedah', 'MY-02', 0, 1),
(1877, 129, 'Kelantan', 'MY-03', 0, 1),
(1878, 129, 'Labuan', 'MY-15', 0, 1),
(1879, 129, 'Melaka', 'MY-04', 0, 1),
(1880, 129, 'Negeri Sembilan', 'MY-05', 0, 1),
(1881, 129, 'Pahang', 'MY-06', 0, 1),
(1882, 129, 'Perak', 'MY-08', 0, 1),
(1883, 129, 'Perlis', 'MY-09', 0, 1),
(1884, 129, 'Pulau Pinang', 'MY-07', 0, 1),
(1885, 129, 'Sabah', 'MY-12', 0, 1),
(1886, 129, 'Sarawak', 'MY-13', 0, 1),
(1887, 129, 'Selangor', 'MY-10', 0, 1),
(1888, 129, 'Terengganu', 'MY-11', 0, 1),
(1889, 129, 'Kuala Lumpur', 'MY-14', 0, 1),
(1890, 129, 'Putrajaya', 'MY-16', 0, 1),
(1891, 130, 'Thiladhunmathi Uthuru', 'THU', 0, 1),
(1892, 130, 'Thiladhunmathi Dhekunu', 'THD', 0, 1),
(1893, 130, 'Miladhunmadulu Uthuru', 'MLU', 0, 1),
(1894, 130, 'Miladhunmadulu Dhekunu', 'MLD', 0, 1),
(1895, 130, 'Maalhosmadulu Uthuru', 'MAU', 0, 1),
(1896, 130, 'Maalhosmadulu Dhekunu', 'MAD', 0, 1),
(1897, 130, 'Faadhippolhu', 'FAA', 0, 1),
(1898, 130, 'Male Atoll', 'MAA', 0, 1),
(1899, 130, 'Ari Atoll Uthuru', 'AAU', 0, 1),
(1900, 130, 'Ari Atoll Dheknu', 'AAD', 0, 1),
(1901, 130, 'Felidhe Atoll', 'FEA', 0, 1),
(1902, 130, 'Mulaku Atoll', 'MUA', 0, 1),
(1903, 130, 'Nilandhe Atoll Uthuru', 'NAU', 0, 1),
(1904, 130, 'Nilandhe Atoll Dhekunu', 'NAD', 0, 1),
(1905, 130, 'Kolhumadulu', 'KLH', 0, 1),
(1906, 130, 'Hadhdhunmathi', 'HDH', 0, 1),
(1907, 130, 'Huvadhu Atoll Uthuru', 'HAU', 0, 1),
(1908, 130, 'Huvadhu Atoll Dhekunu', 'HAD', 0, 1),
(1909, 130, 'Fua Mulaku', 'FMU', 0, 1),
(1910, 130, 'Addu', 'ADD', 0, 1),
(1911, 131, 'Gao', 'GA', 0, 1),
(1912, 131, 'Kayes', 'KY', 0, 1),
(1913, 131, 'Kidal', 'KD', 0, 1),
(1914, 131, 'Koulikoro', 'KL', 0, 1),
(1915, 131, 'Mopti', 'MP', 0, 1),
(1916, 131, 'Segou', 'SG', 0, 1),
(1917, 131, 'Sikasso', 'SK', 0, 1),
(1918, 131, 'Tombouctou', 'TB', 0, 1),
(1919, 131, 'Bamako Capital District', 'CD', 0, 1),
(1920, 132, 'Attard', 'ATT', 0, 1),
(1921, 132, 'Balzan', 'BAL', 0, 1),
(1922, 132, 'Birgu', 'BGU', 0, 1),
(1923, 132, 'Birkirkara', 'BKK', 0, 1),
(1924, 132, 'Birzebbuga', 'BRZ', 0, 1),
(1925, 132, 'Bormla', 'BOR', 0, 1),
(1926, 132, 'Dingli', 'DIN', 0, 1),
(1927, 132, 'Fgura', 'FGU', 0, 1),
(1928, 132, 'Floriana', 'FLO', 0, 1),
(1929, 132, 'Gudja', 'GDJ', 0, 1),
(1930, 132, 'Gzira', 'GZR', 0, 1),
(1931, 132, 'Gargur', 'GRG', 0, 1),
(1932, 132, 'Gaxaq', 'GXQ', 0, 1),
(1933, 132, 'Hamrun', 'HMR', 0, 1),
(1934, 132, 'Iklin', 'IKL', 0, 1),
(1935, 132, 'Isla', 'ISL', 0, 1),
(1936, 132, 'Kalkara', 'KLK', 0, 1),
(1937, 132, 'Kirkop', 'KRK', 0, 1),
(1938, 132, 'Lija', 'LIJ', 0, 1),
(1939, 132, 'Luqa', 'LUQ', 0, 1),
(1940, 132, 'Marsa', 'MRS', 0, 1),
(1941, 132, 'Marsaskala', 'MKL', 0, 1),
(1942, 132, 'Marsaxlokk', 'MXL', 0, 1),
(1943, 132, 'Mdina', 'MDN', 0, 1),
(1944, 132, 'Melliea', 'MEL', 0, 1),
(1945, 132, 'Mgarr', 'MGR', 0, 1),
(1946, 132, 'Mosta', 'MST', 0, 1),
(1947, 132, 'Mqabba', 'MQA', 0, 1),
(1948, 132, 'Msida', 'MSI', 0, 1),
(1949, 132, 'Mtarfa', 'MTF', 0, 1),
(1950, 132, 'Naxxar', 'NAX', 0, 1),
(1951, 132, 'Paola', 'PAO', 0, 1),
(1952, 132, 'Pembroke', 'PEM', 0, 1),
(1953, 132, 'Pieta', 'PIE', 0, 1),
(1954, 132, 'Qormi', 'QOR', 0, 1),
(1955, 132, 'Qrendi', 'QRE', 0, 1),
(1956, 132, 'Rabat', 'RAB', 0, 1),
(1957, 132, 'Safi', 'SAF', 0, 1),
(1958, 132, 'San Giljan', 'SGI', 0, 1),
(1959, 132, 'Santa Lucija', 'SLU', 0, 1),
(1960, 132, 'San Pawl il-Bahar', 'SPB', 0, 1),
(1961, 132, 'San Gwann', 'SGW', 0, 1),
(1962, 132, 'Santa Venera', 'SVE', 0, 1),
(1963, 132, 'Siggiewi', 'SIG', 0, 1),
(1964, 132, 'Sliema', 'SLM', 0, 1),
(1965, 132, 'Swieqi', 'SWQ', 0, 1),
(1966, 132, 'Ta Xbiex', 'TXB', 0, 1),
(1967, 132, 'Tarxien', 'TRX', 0, 1),
(1968, 132, 'Valletta', 'VLT', 0, 1),
(1969, 132, 'Xgajra', 'XGJ', 0, 1),
(1970, 132, 'Zabbar', 'ZBR', 0, 1),
(1971, 132, 'Zebbug', 'ZBG', 0, 1),
(1972, 132, 'Zejtun', 'ZJT', 0, 1),
(1973, 132, 'Zurrieq', 'ZRQ', 0, 1),
(1974, 132, 'Fontana', 'FNT', 0, 1),
(1975, 132, 'Ghajnsielem', 'GHJ', 0, 1),
(1976, 132, 'Gharb', 'GHR', 0, 1),
(1977, 132, 'Ghasri', 'GHS', 0, 1),
(1978, 132, 'Kercem', 'KRC', 0, 1),
(1979, 132, 'Munxar', 'MUN', 0, 1),
(1980, 132, 'Nadur', 'NAD', 0, 1),
(1981, 132, 'Qala', 'QAL', 0, 1),
(1982, 132, 'Victoria', 'VIC', 0, 1),
(1983, 132, 'San Lawrenz', 'SLA', 0, 1),
(1984, 132, 'Sannat', 'SNT', 0, 1),
(1985, 132, 'Xagra', 'ZAG', 0, 1),
(1986, 132, 'Xewkija', 'XEW', 0, 1),
(1987, 132, 'Zebbug', 'ZEB', 0, 1),
(1988, 133, 'Ailinginae', 'ALG', 0, 1),
(1989, 133, 'Ailinglaplap', 'ALL', 0, 1),
(1990, 133, 'Ailuk', 'ALK', 0, 1),
(1991, 133, 'Arno', 'ARN', 0, 1),
(1992, 133, 'Aur', 'AUR', 0, 1),
(1993, 133, 'Bikar', 'BKR', 0, 1),
(1994, 133, 'Bikini', 'BKN', 0, 1),
(1995, 133, 'Bokak', 'BKK', 0, 1),
(1996, 133, 'Ebon', 'EBN', 0, 1),
(1997, 133, 'Enewetak', 'ENT', 0, 1),
(1998, 133, 'Erikub', 'EKB', 0, 1),
(1999, 133, 'Jabat', 'JBT', 0, 1),
(2000, 133, 'Jaluit', 'JLT', 0, 1),
(2001, 133, 'Jemo', 'JEM', 0, 1),
(2002, 133, 'Kili', 'KIL', 0, 1),
(2003, 133, 'Kwajalein', 'KWJ', 0, 1),
(2004, 133, 'Lae', 'LAE', 0, 1),
(2005, 133, 'Lib', 'LIB', 0, 1),
(2006, 133, 'Likiep', 'LKP', 0, 1),
(2007, 133, 'Majuro', 'MJR', 0, 1),
(2008, 133, 'Maloelap', 'MLP', 0, 1),
(2009, 133, 'Mejit', 'MJT', 0, 1),
(2010, 133, 'Mili', 'MIL', 0, 1),
(2011, 133, 'Namorik', 'NMK', 0, 1),
(2012, 133, 'Namu', 'NAM', 0, 1),
(2013, 133, 'Rongelap', 'RGL', 0, 1),
(2014, 133, 'Rongrik', 'RGK', 0, 1),
(2015, 133, 'Toke', 'TOK', 0, 1),
(2016, 133, 'Ujae', 'UJA', 0, 1),
(2017, 133, 'Ujelang', 'UJL', 0, 1),
(2018, 133, 'Utirik', 'UTK', 0, 1),
(2019, 133, 'Wotho', 'WTH', 0, 1),
(2020, 133, 'Wotje', 'WTJ', 0, 1),
(2021, 135, 'Adrar', 'AD', 0, 1),
(2022, 135, 'Assaba', 'AS', 0, 1),
(2023, 135, 'Brakna', 'BR', 0, 1),
(2024, 135, 'Dakhlet Nouadhibou', 'DN', 0, 1),
(2025, 135, 'Gorgol', 'GO', 0, 1),
(2026, 135, 'Guidimaka', 'GM', 0, 1),
(2027, 135, 'Hodh Ech Chargui', 'HC', 0, 1),
(2028, 135, 'Hodh El Gharbi', 'HG', 0, 1),
(2029, 135, 'Inchiri', 'IN', 0, 1),
(2030, 135, 'Tagant', 'TA', 0, 1),
(2031, 135, 'Tiris Zemmour', 'TZ', 0, 1),
(2032, 135, 'Trarza', 'TR', 0, 1),
(2033, 135, 'Nouakchott', 'NO', 0, 1),
(2034, 136, 'Beau Bassin-Rose Hill', 'BR', 0, 1),
(2035, 136, 'Curepipe', 'CU', 0, 1),
(2036, 136, 'Port Louis', 'PU', 0, 1),
(2037, 136, 'Quatre Bornes', 'QB', 0, 1),
(2038, 136, 'Vacoas-Phoenix', 'VP', 0, 1),
(2039, 136, 'Agalega Islands', 'AG', 0, 1),
(2040, 136, 'Cargados Carajos Shoals (Saint Brandon Islands)', 'CC', 0, 1),
(2041, 136, 'Rodrigues', 'RO', 0, 1),
(2042, 136, 'Black River', 'BL', 0, 1),
(2043, 136, 'Flacq', 'FL', 0, 1),
(2044, 136, 'Grand Port', 'GP', 0, 1),
(2045, 136, 'Moka', 'MO', 0, 1),
(2046, 136, 'Pamplemousses', 'PA', 0, 1),
(2047, 136, 'Plaines Wilhems', 'PW', 0, 1),
(2048, 136, 'Port Louis', 'PL', 0, 1),
(2049, 136, 'Riviere du Rempart', 'RR', 0, 1),
(2050, 136, 'Savanne', 'SA', 0, 1),
(2051, 138, 'Baja California Norte', 'BN', 0, 1),
(2052, 138, 'Baja California Sur', 'BS', 0, 1),
(2053, 138, 'Campeche', 'CA', 0, 1),
(2054, 138, 'Chiapas', 'CI', 0, 1),
(2055, 138, 'Chihuahua', 'CH', 0, 1),
(2056, 138, 'Coahuila de Zaragoza', 'CZ', 0, 1),
(2057, 138, 'Colima', 'CL', 0, 1),
(2058, 138, 'Distrito Federal', 'DF', 0, 1),
(2059, 138, 'Durango', 'DU', 0, 1),
(2060, 138, 'Guanajuato', 'GA', 0, 1),
(2061, 138, 'Guerrero', 'GE', 0, 1),
(2062, 138, 'Hidalgo', 'HI', 0, 1),
(2063, 138, 'Jalisco', 'JA', 0, 1),
(2064, 138, 'Mexico', 'ME', 0, 1),
(2065, 138, 'Michoacan de Ocampo', 'MI', 0, 1),
(2066, 138, 'Morelos', 'MO', 0, 1),
(2067, 138, 'Nayarit', 'NA', 0, 1),
(2068, 138, 'Nuevo Leon', 'NL', 0, 1),
(2069, 138, 'Oaxaca', 'OA', 0, 1),
(2070, 138, 'Puebla', 'PU', 0, 1),
(2071, 138, 'Queretaro de Arteaga', 'QA', 0, 1),
(2072, 138, 'Quintana Roo', 'QR', 0, 1),
(2073, 138, 'San Luis Potosi', 'SA', 0, 1),
(2074, 138, 'Sinaloa', 'SI', 0, 1),
(2075, 138, 'Sonora', 'SO', 0, 1),
(2076, 138, 'Tabasco', 'TB', 0, 1),
(2077, 138, 'Tamaulipas', 'TM', 0, 1),
(2078, 138, 'Tlaxcala', 'TL', 0, 1),
(2079, 138, 'Veracruz-Llave', 'VE', 0, 1),
(2080, 138, 'Yucatan', 'YU', 0, 1),
(2081, 138, 'Zacatecas', 'ZA', 0, 1),
(2082, 139, 'Chuuk', 'C', 0, 1),
(2083, 139, 'Kosrae', 'K', 0, 1),
(2084, 139, 'Pohnpei', 'P', 0, 1),
(2085, 139, 'Yap', 'Y', 0, 1),
(2086, 140, 'Gagauzia', 'GA', 0, 1),
(2087, 140, 'Chisinau', 'CU', 0, 1),
(2088, 140, 'Balti', 'BA', 0, 1),
(2089, 140, 'Cahul', 'CA', 0, 1),
(2090, 140, 'Edinet', 'ED', 0, 1),
(2091, 140, 'Lapusna', 'LA', 0, 1),
(2092, 140, 'Orhei', 'OR', 0, 1),
(2093, 140, 'Soroca', 'SO', 0, 1),
(2094, 140, 'Tighina', 'TI', 0, 1),
(2095, 140, 'Ungheni', 'UN', 0, 1),
(2096, 140, 'Stâ€šnga Nistrului', 'SN', 0, 1),
(2097, 141, 'Fontvieille', 'FV', 0, 1),
(2098, 141, 'La Condamine', 'LC', 0, 1),
(2099, 141, 'Monaco-Ville', 'MV', 0, 1),
(2100, 141, 'Monte-Carlo', 'MC', 0, 1),
(2101, 142, 'Ulanbaatar', '1', 0, 1),
(2102, 142, 'Orhon', '035', 0, 1),
(2103, 142, 'Darhan uul', '037', 0, 1),
(2104, 142, 'Hentiy', '039', 0, 1),
(2105, 142, 'Hovsgol', '041', 0, 1),
(2106, 142, 'Hovd', '043', 0, 1),
(2107, 142, 'Uvs', '046', 0, 1),
(2108, 142, 'Tov', '047', 0, 1),
(2109, 142, 'Selenge', '049', 0, 1),
(2110, 142, 'Suhbaatar', '051', 0, 1),
(2111, 142, 'Omnogovi', '053', 0, 1),
(2112, 142, 'Ovorhangay', '055', 0, 1),
(2113, 142, 'Dzavhan', '057', 0, 1),
(2114, 142, 'DundgovL', '059', 0, 1),
(2115, 142, 'Dornod', '061', 0, 1),
(2116, 142, 'Dornogov', '063', 0, 1),
(2117, 142, 'Govi-Sumber', '064', 0, 1),
(2118, 142, 'Govi-Altay', '065', 0, 1),
(2119, 142, 'Bulgan', '067', 0, 1),
(2120, 142, 'Bayanhongor', '069', 0, 1),
(2121, 142, 'Bayan-Olgiy', '071', 0, 1),
(2122, 142, 'Arhangay', '073', 0, 1),
(2123, 143, 'Saint Anthony', 'A', 0, 1),
(2124, 143, 'Saint Georges', 'G', 0, 1),
(2125, 143, 'Saint Peter', 'P', 0, 1),
(2126, 144, 'Agadir', 'AGD', 0, 1),
(2127, 144, 'Al Hoceima', 'HOC', 0, 1),
(2128, 144, 'Azilal', 'AZI', 0, 1),
(2129, 144, 'Beni Mellal', 'BME', 0, 1),
(2130, 144, 'Ben Slimane', 'BSL', 0, 1),
(2131, 144, 'Boulemane', 'BLM', 0, 1),
(2132, 144, 'Casablanca', 'CBL', 0, 1),
(2133, 144, 'Chaouen', 'CHA', 0, 1),
(2134, 144, 'El Jadida', 'EJA', 0, 1),
(2135, 144, 'El Kelaa des Sraghna', 'EKS', 0, 1),
(2136, 144, 'Er Rachidia', 'ERA', 0, 1),
(2137, 144, 'Essaouira', 'ESS', 0, 1),
(2138, 144, 'Fes', 'FES', 0, 1),
(2139, 144, 'Figuig', 'FIG', 0, 1),
(2140, 144, 'Guelmim', 'GLM', 0, 1),
(2141, 144, 'Ifrane', 'IFR', 0, 1),
(2142, 144, 'Kenitra', 'KEN', 0, 1),
(2143, 144, 'Khemisset', 'KHM', 0, 1),
(2144, 144, 'Khenifra', 'KHN', 0, 1),
(2145, 144, 'Khouribga', 'KHO', 0, 1),
(2146, 144, 'Laayoune', 'LYN', 0, 1),
(2147, 144, 'Larache', 'LAR', 0, 1),
(2148, 144, 'Marrakech', 'MRK', 0, 1),
(2149, 144, 'Meknes', 'MKN', 0, 1),
(2150, 144, 'Nador', 'NAD', 0, 1),
(2151, 144, 'Ouarzazate', 'ORZ', 0, 1),
(2152, 144, 'Oujda', 'OUJ', 0, 1),
(2153, 144, 'Rabat-Sale', 'RSA', 0, 1),
(2154, 144, 'Safi', 'SAF', 0, 1),
(2155, 144, 'Settat', 'SET', 0, 1),
(2156, 144, 'Sidi Kacem', 'SKA', 0, 1),
(2157, 144, 'Tangier', 'TGR', 0, 1),
(2158, 144, 'Tan-Tan', 'TAN', 0, 1),
(2159, 144, 'Taounate', 'TAO', 0, 1),
(2160, 144, 'Taroudannt', 'TRD', 0, 1),
(2161, 144, 'Tata', 'TAT', 0, 1),
(2162, 144, 'Taza', 'TAZ', 0, 1),
(2163, 144, 'Tetouan', 'TET', 0, 1),
(2164, 144, 'Tiznit', 'TIZ', 0, 1),
(2165, 144, 'Ad Dakhla', 'ADK', 0, 1),
(2166, 144, 'Boujdour', 'BJD', 0, 1),
(2167, 144, 'Es Smara', 'ESM', 0, 1),
(2168, 145, 'Cabo Delgado', 'CD', 0, 1),
(2169, 145, 'Gaza', 'GZ', 0, 1),
(2170, 145, 'Inhambane', 'IN', 0, 1),
(2171, 145, 'Manica', 'MN', 0, 1),
(2172, 145, 'Maputo (city)', 'MC', 0, 1),
(2173, 145, 'Maputo', 'MP', 0, 1),
(2174, 145, 'Nampula', 'NA', 0, 1),
(2175, 145, 'Niassa', 'NI', 0, 1),
(2176, 145, 'Sofala', 'SO', 0, 1),
(2177, 145, 'Tete', 'TE', 0, 1),
(2178, 145, 'Zambezia', 'ZA', 0, 1),
(2179, 146, 'Ayeyarwady', 'AY', 0, 1),
(2180, 146, 'Bago', 'BG', 0, 1),
(2181, 146, 'Magway', 'MG', 0, 1),
(2182, 146, 'Mandalay', 'MD', 0, 1),
(2183, 146, 'Sagaing', 'SG', 0, 1),
(2184, 146, 'Tanintharyi', 'TN', 0, 1),
(2185, 146, 'Yangon', 'YG', 0, 1),
(2186, 146, 'Chin State', 'CH', 0, 1),
(2187, 146, 'Kachin State', 'KC', 0, 1),
(2188, 146, 'Kayah State', 'KH', 0, 1),
(2189, 146, 'Kayin State', 'KN', 0, 1),
(2190, 146, 'Mon State', 'MN', 0, 1),
(2191, 146, 'Rakhine State', 'RK', 0, 1),
(2192, 146, 'Shan State', 'SH', 0, 1),
(2193, 147, 'Caprivi', 'CA', 0, 1),
(2194, 147, 'Erongo', 'ER', 0, 1),
(2195, 147, 'Hardap', 'HA', 0, 1),
(2196, 147, 'Karas', 'KR', 0, 1),
(2197, 147, 'Kavango', 'KV', 0, 1),
(2198, 147, 'Khomas', 'KH', 0, 1),
(2199, 147, 'Kunene', 'KU', 0, 1),
(2200, 147, 'Ohangwena', 'OW', 0, 1),
(2201, 147, 'Omaheke', 'OK', 0, 1),
(2202, 147, 'Omusati', 'OT', 0, 1),
(2203, 147, 'Oshana', 'ON', 0, 1),
(2204, 147, 'Oshikoto', 'OO', 0, 1),
(2205, 147, 'Otjozondjupa', 'OJ', 0, 1),
(2206, 148, 'Aiwo', 'AO', 0, 1),
(2207, 148, 'Anabar', 'AA', 0, 1),
(2208, 148, 'Anetan', 'AT', 0, 1),
(2209, 148, 'Anibare', 'AI', 0, 1),
(2210, 148, 'Baiti', 'BA', 0, 1),
(2211, 148, 'Boe', 'BO', 0, 1),
(2212, 148, 'Buada', 'BU', 0, 1),
(2213, 148, 'Denigomodu', 'DE', 0, 1),
(2214, 148, 'Ewa', 'EW', 0, 1),
(2215, 148, 'Ijuw', 'IJ', 0, 1),
(2216, 148, 'Meneng', 'ME', 0, 1),
(2217, 148, 'Nibok', 'NI', 0, 1),
(2218, 148, 'Uaboe', 'UA', 0, 1),
(2219, 148, 'Yaren', 'YA', 0, 1),
(2220, 149, 'Bagmati', 'BA', 0, 1),
(2221, 149, 'Bheri', 'BH', 0, 1),
(2222, 149, 'Dhawalagiri', 'DH', 0, 1),
(2223, 149, 'Gandaki', 'GA', 0, 1),
(2224, 149, 'Janakpur', 'JA', 0, 1),
(2225, 149, 'Karnali', 'KA', 0, 1),
(2226, 149, 'Kosi', 'KO', 0, 1),
(2227, 149, 'Lumbini', 'LU', 0, 1),
(2228, 149, 'Mahakali', 'MA', 0, 1),
(2229, 149, 'Mechi', 'ME', 0, 1),
(2230, 149, 'Narayani', 'NA', 0, 1),
(2231, 149, 'Rapti', 'RA', 0, 1),
(2232, 149, 'Sagarmatha', 'SA', 0, 1),
(2233, 149, 'Seti', 'SE', 0, 1),
(2234, 150, 'Drenthe', 'DR', 0, 1),
(2235, 150, 'Flevoland', 'FL', 0, 1),
(2236, 150, 'Friesland', 'FR', 0, 1),
(2237, 150, 'Gelderland', 'GE', 0, 1),
(2238, 150, 'Groningen', 'GR', 0, 1),
(2239, 150, 'Limburg', 'LI', 0, 1),
(2240, 150, 'Noord-Brabant', 'NB', 0, 1),
(2241, 150, 'Noord-Holland', 'NH', 0, 1),
(2242, 150, 'Overijssel', 'OV', 0, 1),
(2243, 150, 'Utrecht', 'UT', 0, 1),
(2244, 150, 'Zeeland', 'ZE', 0, 1),
(2245, 150, 'Zuid-Holland', 'ZH', 0, 1),
(2246, 152, 'Iles Loyaute', 'L', 0, 1),
(2247, 152, 'Nord', 'N', 0, 1),
(2248, 152, 'Sud', 'S', 0, 1),
(2249, 153, 'Auckland', 'AUK', 0, 1),
(2250, 153, 'Bay of Plenty', 'BOP', 0, 1),
(2251, 153, 'Canterbury', 'CAN', 0, 1),
(2252, 153, 'Coromandel', 'COR', 0, 1),
(2253, 153, 'Gisborne', 'GIS', 0, 1),
(2254, 153, 'Fiordland', 'FIO', 0, 1),
(2255, 153, 'Hawke\'s Bay', 'HKB', 0, 1),
(2256, 153, 'Marlborough', 'MBH', 0, 1),
(2257, 153, 'Manawatu-Wanganui', 'MWT', 0, 1),
(2258, 153, 'Mt Cook-Mackenzie', 'MCM', 0, 1),
(2259, 153, 'Nelson', 'NSN', 0, 1),
(2260, 153, 'Northland', 'NTL', 0, 1),
(2261, 153, 'Otago', 'OTA', 0, 1),
(2262, 153, 'Southland', 'STL', 0, 1),
(2263, 153, 'Taranaki', 'TKI', 0, 1),
(2264, 153, 'Wellington', 'WGN', 0, 1),
(2265, 153, 'Waikato', 'WKO', 0, 1),
(2266, 153, 'Wairarapa', 'WAI', 0, 1),
(2267, 153, 'West Coast', 'WTC', 0, 1),
(2268, 154, 'Atlantico Norte', 'AN', 0, 1),
(2269, 154, 'Atlantico Sur', 'AS', 0, 1),
(2270, 154, 'Boaco', 'BO', 0, 1),
(2271, 154, 'Carazo', 'CA', 0, 1),
(2272, 154, 'Chinandega', 'CI', 0, 1),
(2273, 154, 'Chontales', 'CO', 0, 1),
(2274, 154, 'Esteli', 'ES', 0, 1),
(2275, 154, 'Granada', 'GR', 0, 1),
(2276, 154, 'Jinotega', 'JI', 0, 1),
(2277, 154, 'Leon', 'LE', 0, 1),
(2278, 154, 'Madriz', 'MD', 0, 1),
(2279, 154, 'Managua', 'MN', 0, 1),
(2280, 154, 'Masaya', 'MS', 0, 1),
(2281, 154, 'Matagalpa', 'MT', 0, 1),
(2282, 154, 'Nuevo Segovia', 'NS', 0, 1),
(2283, 154, 'Rio San Juan', 'RS', 0, 1),
(2284, 154, 'Rivas', 'RI', 0, 1),
(2285, 155, 'Agadez', 'AG', 0, 1),
(2286, 155, 'Diffa', 'DF', 0, 1),
(2287, 155, 'Dosso', 'DS', 0, 1),
(2288, 155, 'Maradi', 'MA', 0, 1),
(2289, 155, 'Niamey', 'NM', 0, 1),
(2290, 155, 'Tahoua', 'TH', 0, 1),
(2291, 155, 'Tillaberi', 'TL', 0, 1),
(2292, 155, 'Zinder', 'ZD', 0, 1),
(2293, 156, 'Abia', 'AB', 0, 1),
(2294, 156, 'Abuja Federal Capital Territory', 'CT', 0, 1),
(2295, 156, 'Adamawa', 'AD', 0, 1),
(2296, 156, 'Akwa Ibom', 'AK', 0, 1),
(2297, 156, 'Anambra', 'AN', 0, 1),
(2298, 156, 'Bauchi', 'BC', 0, 1),
(2299, 156, 'Bayelsa', 'BY', 0, 1),
(2300, 156, 'Benue', 'BN', 0, 1),
(2301, 156, 'Borno', 'BO', 0, 1),
(2302, 156, 'Cross River', 'CR', 0, 1),
(2303, 156, 'Delta', 'DE', 0, 1),
(2304, 156, 'Ebonyi', 'EB', 0, 1),
(2305, 156, 'Edo', 'ED', 0, 1),
(2306, 156, 'Ekiti', 'EK', 0, 1),
(2307, 156, 'Enugu', 'EN', 0, 1),
(2308, 156, 'Gombe', 'GO', 0, 1),
(2309, 156, 'Imo', 'IM', 0, 1),
(2310, 156, 'Jigawa', 'JI', 0, 1),
(2311, 156, 'Kaduna', 'KD', 0, 1),
(2312, 156, 'Kano', 'KN', 0, 1),
(2313, 156, 'Katsina', 'KT', 0, 1),
(2314, 156, 'Kebbi', 'KE', 0, 1),
(2315, 156, 'Kogi', 'KO', 0, 1),
(2316, 156, 'Kwara', 'KW', 0, 1),
(2317, 156, 'Lagos', 'LA', 0, 1),
(2318, 156, 'Nassarawa', 'NA', 0, 1),
(2319, 156, 'Niger', 'NI', 0, 1),
(2320, 156, 'Ogun', 'OG', 0, 1),
(2321, 156, 'Ondo', 'ONG', 0, 1),
(2322, 156, 'Osun', 'OS', 0, 1),
(2323, 156, 'Oyo', 'OY', 0, 1),
(2324, 156, 'Plateau', 'PL', 0, 1),
(2325, 156, 'Rivers', 'RI', 0, 1),
(2326, 156, 'Sokoto', 'SO', 0, 1),
(2327, 156, 'Taraba', 'TA', 0, 1),
(2328, 156, 'Yobe', 'YO', 0, 1),
(2329, 156, 'Zamfara', 'ZA', 0, 1),
(2330, 159, 'Northern Islands', 'N', 0, 1),
(2331, 159, 'Rota', 'R', 0, 1),
(2332, 159, 'Saipan', 'S', 0, 1),
(2333, 159, 'Tinian', 'T', 0, 1),
(2334, 160, 'Akershus', 'AK', 0, 1),
(2335, 160, 'Aust-Agder', 'AA', 0, 1),
(2336, 160, 'Buskerud', 'BU', 0, 1),
(2337, 160, 'Finnmark', 'FM', 0, 1),
(2338, 160, 'Hedmark', 'HM', 0, 1),
(2339, 160, 'Hordaland', 'HL', 0, 1),
(2340, 160, 'More og Romdal', 'MR', 0, 1),
(2341, 160, 'Nord-Trondelag', 'NT', 0, 1),
(2342, 160, 'Nordland', 'NL', 0, 1),
(2343, 160, 'Ostfold', 'OF', 0, 1),
(2344, 160, 'Oppland', 'OP', 0, 1),
(2345, 160, 'Oslo', 'OL', 0, 1),
(2346, 160, 'Rogaland', 'RL', 0, 1),
(2347, 160, 'Sor-Trondelag', 'ST', 0, 1),
(2348, 160, 'Sogn og Fjordane', 'SJ', 0, 1),
(2349, 160, 'Svalbard', 'SV', 0, 1),
(2350, 160, 'Telemark', 'TM', 0, 1),
(2351, 160, 'Troms', 'TR', 0, 1),
(2352, 160, 'Vest-Agder', 'VA', 0, 1),
(2353, 160, 'Vestfold', 'VF', 0, 1),
(2354, 161, 'Ad Dakhiliyah', 'DA', 0, 1),
(2355, 161, 'Al Batinah', 'BA', 0, 1),
(2356, 161, 'Al Wusta', 'WU', 0, 1),
(2357, 161, 'Ash Sharqiyah', 'SH', 0, 1),
(2358, 161, 'Az Zahirah', 'ZA', 0, 1),
(2359, 161, 'Masqat', 'MA', 0, 1),
(2360, 161, 'Musandam', 'MU', 0, 1),
(2361, 161, 'Zufar', 'ZU', 0, 1),
(2362, 162, 'Balochistan', 'B', 0, 1),
(2363, 162, 'Federally Administered Tribal Areas', 'T', 0, 1),
(2364, 162, 'Islamabad Capital Territory', 'I', 0, 1),
(2365, 162, 'North-West Frontier', 'N', 0, 1),
(2366, 162, 'Punjab', 'P', 0, 1),
(2367, 162, 'Sindh', 'S', 0, 1),
(2368, 163, 'Aimeliik', 'AM', 0, 1),
(2369, 163, 'Airai', 'AR', 0, 1),
(2370, 163, 'Angaur', 'AN', 0, 1),
(2371, 163, 'Hatohobei', 'HA', 0, 1),
(2372, 163, 'Kayangel', 'KA', 0, 1),
(2373, 163, 'Koror', 'KO', 0, 1),
(2374, 163, 'Melekeok', 'ME', 0, 1),
(2375, 163, 'Ngaraard', 'NA', 0, 1),
(2376, 163, 'Ngarchelong', 'NG', 0, 1),
(2377, 163, 'Ngardmau', 'ND', 0, 1),
(2378, 163, 'Ngatpang', 'NT', 0, 1),
(2379, 163, 'Ngchesar', 'NC', 0, 1),
(2380, 163, 'Ngeremlengui', 'NR', 0, 1),
(2381, 163, 'Ngiwal', 'NW', 0, 1),
(2382, 163, 'Peleliu', 'PE', 0, 1),
(2383, 163, 'Sonsorol', 'SO', 0, 1),
(2384, 164, 'Bocas del Toro', 'BT', 0, 1),
(2385, 164, 'Chiriqui', 'CH', 0, 1),
(2386, 164, 'Cocle', 'CC', 0, 1),
(2387, 164, 'Colon', 'CL', 0, 1),
(2388, 164, 'Darien', 'DA', 0, 1),
(2389, 164, 'Herrera', 'HE', 0, 1),
(2390, 164, 'Los Santos', 'LS', 0, 1),
(2391, 164, 'Panama', 'PA', 0, 1),
(2392, 164, 'San Blas', 'SB', 0, 1),
(2393, 164, 'Veraguas', 'VG', 0, 1),
(2394, 165, 'Bougainville', 'BV', 0, 1),
(2395, 165, 'Central', 'CE', 0, 1),
(2396, 165, 'Chimbu', 'CH', 0, 1),
(2397, 165, 'Eastern Highlands', 'EH', 0, 1),
(2398, 165, 'East New Britain', 'EB', 0, 1),
(2399, 165, 'East Sepik', 'ES', 0, 1),
(2400, 165, 'Enga', 'EN', 0, 1),
(2401, 165, 'Gulf', 'GU', 0, 1),
(2402, 165, 'Madang', 'MD', 0, 1),
(2403, 165, 'Manus', 'MN', 0, 1),
(2404, 165, 'Milne Bay', 'MB', 0, 1),
(2405, 165, 'Morobe', 'MR', 0, 1),
(2406, 165, 'National Capital', 'NC', 0, 1),
(2407, 165, 'New Ireland', 'NI', 0, 1),
(2408, 165, 'Northern', 'NO', 0, 1),
(2409, 165, 'Sandaun', 'SA', 0, 1),
(2410, 165, 'Southern Highlands', 'SH', 0, 1),
(2411, 165, 'Western', 'WE', 0, 1),
(2412, 165, 'Western Highlands', 'WH', 0, 1),
(2413, 165, 'West New Britain', 'WB', 0, 1),
(2414, 166, 'Alto Paraguay', 'AG', 0, 1),
(2415, 166, 'Alto Parana', 'AN', 0, 1),
(2416, 166, 'Amambay', 'AM', 0, 1),
(2417, 166, 'Asuncion', 'AS', 0, 1),
(2418, 166, 'Boqueron', 'BO', 0, 1),
(2419, 166, 'Caaguazu', 'CG', 0, 1),
(2420, 166, 'Caazapa', 'CZ', 0, 1),
(2421, 166, 'Canindeyu', 'CN', 0, 1),
(2422, 166, 'Central', 'CE', 0, 1),
(2423, 166, 'Concepcion', 'CC', 0, 1),
(2424, 166, 'Cordillera', 'CD', 0, 1),
(2425, 166, 'Guaira', 'GU', 0, 1),
(2426, 166, 'Itapua', 'IT', 0, 1),
(2427, 166, 'Misiones', 'MI', 0, 1),
(2428, 166, 'Neembucu', 'NE', 0, 1),
(2429, 166, 'Paraguari', 'PA', 0, 1),
(2430, 166, 'Presidente Hayes', 'PH', 0, 1),
(2431, 166, 'San Pedro', 'SP', 0, 1),
(2432, 167, 'Amazonas', 'AM', 0, 1),
(2433, 167, 'Ancash', 'AN', 0, 1),
(2434, 167, 'Apurimac', 'AP', 0, 1),
(2435, 167, 'Arequipa', 'AR', 0, 1),
(2436, 167, 'Ayacucho', 'AY', 0, 1),
(2437, 167, 'Cajamarca', 'CJ', 0, 1),
(2438, 167, 'Callao', 'CL', 0, 1),
(2439, 167, 'Cusco', 'CU', 0, 1),
(2440, 167, 'Huancavelica', 'HV', 0, 1),
(2441, 167, 'Huanuco', 'HO', 0, 1),
(2442, 167, 'Ica', 'IC', 0, 1),
(2443, 167, 'Junin', 'JU', 0, 1),
(2444, 167, 'La Libertad', 'LD', 0, 1),
(2445, 167, 'Lambayeque', 'LY', 0, 1),
(2446, 167, 'Lima', 'LI', 0, 1),
(2447, 167, 'Loreto', 'LO', 0, 1),
(2448, 167, 'Madre de Dios', 'MD', 0, 1),
(2449, 167, 'Moquegua', 'MO', 0, 1),
(2450, 167, 'Pasco', 'PA', 0, 1),
(2451, 167, 'Piura', 'PI', 0, 1),
(2452, 167, 'Puno', 'PU', 0, 1),
(2453, 167, 'San Martin', 'SM', 0, 1),
(2454, 167, 'Tacna', 'TA', 0, 1),
(2455, 167, 'Tumbes', 'TU', 0, 1),
(2456, 167, 'Ucayali', 'UC', 0, 1),
(2457, 168, 'Abra', 'ABR', 0, 1),
(2458, 168, 'Agusan del Norte', 'ANO', 0, 1),
(2459, 168, 'Agusan del Sur', 'ASU', 0, 1),
(2460, 168, 'Aklan', 'AKL', 0, 1),
(2461, 168, 'Albay', 'ALB', 0, 1),
(2462, 168, 'Antique', 'ANT', 0, 1),
(2463, 168, 'Apayao', 'APY', 0, 1),
(2464, 168, 'Aurora', 'AUR', 0, 1),
(2465, 168, 'Basilan', 'BAS', 0, 1),
(2466, 168, 'Bataan', 'BTA', 0, 1),
(2467, 168, 'Batanes', 'BTE', 0, 1),
(2468, 168, 'Batangas', 'BTG', 0, 1),
(2469, 168, 'Biliran', 'BLR', 0, 1),
(2470, 168, 'Benguet', 'BEN', 0, 1),
(2471, 168, 'Bohol', 'BOL', 0, 1),
(2472, 168, 'Bukidnon', 'BUK', 0, 1),
(2473, 168, 'Bulacan', 'BUL', 0, 1),
(2474, 168, 'Cagayan', 'CAG', 0, 1),
(2475, 168, 'Camarines Norte', 'CNO', 0, 1),
(2476, 168, 'Camarines Sur', 'CSU', 0, 1),
(2477, 168, 'Camiguin', 'CAM', 0, 1),
(2478, 168, 'Capiz', 'CAP', 0, 1),
(2479, 168, 'Catanduanes', 'CAT', 0, 1),
(2480, 168, 'Cavite', 'CAV', 0, 1),
(2481, 168, 'Cebu', 'CEB', 0, 1),
(2482, 168, 'Compostela', 'CMP', 0, 1),
(2483, 168, 'Davao del Norte', 'DNO', 0, 1),
(2484, 168, 'Davao del Sur', 'DSU', 0, 1),
(2485, 168, 'Davao Oriental', 'DOR', 0, 1),
(2486, 168, 'Eastern Samar', 'ESA', 0, 1),
(2487, 168, 'Guimaras', 'GUI', 0, 1),
(2488, 168, 'Ifugao', 'IFU', 0, 1),
(2489, 168, 'Ilocos Norte', 'INO', 0, 1),
(2490, 168, 'Ilocos Sur', 'ISU', 0, 1),
(2491, 168, 'Iloilo', 'ILO', 0, 1),
(2492, 168, 'Isabela', 'ISA', 0, 1),
(2493, 168, 'Kalinga', 'KAL', 0, 1),
(2494, 168, 'Laguna', 'LAG', 0, 1),
(2495, 168, 'Lanao del Norte', 'LNO', 0, 1),
(2496, 168, 'Lanao del Sur', 'LSU', 0, 1),
(2497, 168, 'La Union', 'UNI', 0, 1),
(2498, 168, 'Leyte', 'LEY', 0, 1),
(2499, 168, 'Maguindanao', 'MAG', 0, 1),
(2500, 168, 'Marinduque', 'MRN', 0, 1),
(2501, 168, 'Masbate', 'MSB', 0, 1),
(2502, 168, 'Mindoro Occidental', 'MIC', 0, 1),
(2503, 168, 'Mindoro Oriental', 'MIR', 0, 1),
(2504, 168, 'Misamis Occidental', 'MSC', 0, 1),
(2505, 168, 'Misamis Oriental', 'MOR', 0, 1),
(2506, 168, 'Mountain', 'MOP', 0, 1),
(2507, 168, 'Negros Occidental', 'NOC', 0, 1),
(2508, 168, 'Negros Oriental', 'NOR', 0, 1),
(2509, 168, 'North Cotabato', 'NCT', 0, 1),
(2510, 168, 'Northern Samar', 'NSM', 0, 1),
(2511, 168, 'Nueva Ecija', 'NEC', 0, 1),
(2512, 168, 'Nueva Vizcaya', 'NVZ', 0, 1),
(2513, 168, 'Palawan', 'PLW', 0, 1),
(2514, 168, 'Pampanga', 'PMP', 0, 1),
(2515, 168, 'Pangasinan', 'PNG', 0, 1),
(2516, 168, 'Quezon', 'QZN', 0, 1),
(2517, 168, 'Quirino', 'QRN', 0, 1),
(2518, 168, 'Rizal', 'RIZ', 0, 1),
(2519, 168, 'Romblon', 'ROM', 0, 1),
(2520, 168, 'Samar', 'SMR', 0, 1),
(2521, 168, 'Sarangani', 'SRG', 0, 1),
(2522, 168, 'Siquijor', 'SQJ', 0, 1),
(2523, 168, 'Sorsogon', 'SRS', 0, 1),
(2524, 168, 'South Cotabato', 'SCO', 0, 1),
(2525, 168, 'Southern Leyte', 'SLE', 0, 1),
(2526, 168, 'Sultan Kudarat', 'SKU', 0, 1),
(2527, 168, 'Sulu', 'SLU', 0, 1),
(2528, 168, 'Surigao del Norte', 'SNO', 0, 1),
(2529, 168, 'Surigao del Sur', 'SSU', 0, 1),
(2530, 168, 'Tarlac', 'TAR', 0, 1),
(2531, 168, 'Tawi-Tawi', 'TAW', 0, 1),
(2532, 168, 'Zambales', 'ZBL', 0, 1),
(2533, 168, 'Zamboanga del Norte', 'ZNO', 0, 1),
(2534, 168, 'Zamboanga del Sur', 'ZSU', 0, 1),
(2535, 168, 'Zamboanga Sibugay', 'ZSI', 0, 1),
(2536, 170, 'Dolnoslaskie', 'DO', 0, 1),
(2537, 170, 'Kujawsko-Pomorskie', 'KP', 0, 1),
(2538, 170, 'Lodzkie', 'LO', 0, 1),
(2539, 170, 'Lubelskie', 'LL', 0, 1),
(2540, 170, 'Lubuskie', 'LU', 0, 1),
(2541, 170, 'Malopolskie', 'ML', 0, 1),
(2542, 170, 'Mazowieckie', 'MZ', 0, 1),
(2543, 170, 'Opolskie', 'OP', 0, 1),
(2544, 170, 'Podkarpackie', 'PP', 0, 1),
(2545, 170, 'Podlaskie', 'PL', 0, 1),
(2546, 170, 'Pomorskie', 'PM', 0, 1),
(2547, 170, 'Slaskie', 'SL', 0, 1),
(2548, 170, 'Swietokrzyskie', 'SW', 0, 1),
(2549, 170, 'Warminsko-Mazurskie', 'WM', 0, 1),
(2550, 170, 'Wielkopolskie', 'WP', 0, 1),
(2551, 170, 'Zachodniopomorskie', 'ZA', 0, 1),
(2552, 198, 'Saint Pierre', 'P', 0, 1),
(2553, 198, 'Miquelon', 'M', 0, 1),
(2554, 171, 'A&ccedil;ores', 'AC', 0, 1),
(2555, 171, 'Aveiro', 'AV', 0, 1),
(2556, 171, 'Beja', 'BE', 0, 1),
(2557, 171, 'Braga', 'BR', 0, 1),
(2558, 171, 'Bragan&ccedil;a', 'BA', 0, 1),
(2559, 171, 'Castelo Branco', 'CB', 0, 1),
(2560, 171, 'Coimbra', 'CO', 0, 1),
(2561, 171, '&Eacute;vora', 'EV', 0, 1),
(2562, 171, 'Faro', 'FA', 0, 1),
(2563, 171, 'Guarda', 'GU', 0, 1),
(2564, 171, 'Leiria', 'LE', 0, 1),
(2565, 171, 'Lisboa', 'LI', 0, 1),
(2566, 171, 'Madeira', 'ME', 0, 1),
(2567, 171, 'Portalegre', 'PO', 0, 1),
(2568, 171, 'Porto', 'PR', 0, 1),
(2569, 171, 'Santar&eacute;m', 'SA', 0, 1),
(2570, 171, 'Set&uacute;bal', 'SE', 0, 1),
(2571, 171, 'Viana do Castelo', 'VC', 0, 1),
(2572, 171, 'Vila Real', 'VR', 0, 1),
(2573, 171, 'Viseu', 'VI', 0, 1),
(2574, 173, 'Ad Dawhah', 'DW', 0, 1),
(2575, 173, 'Al Ghuwayriyah', 'GW', 0, 1),
(2576, 173, 'Al Jumayliyah', 'JM', 0, 1),
(2577, 173, 'Al Khawr', 'KR', 0, 1),
(2578, 173, 'Al Wakrah', 'WK', 0, 1),
(2579, 173, 'Ar Rayyan', 'RN', 0, 1),
(2580, 173, 'Jarayan al Batinah', 'JB', 0, 1),
(2581, 173, 'Madinat ash Shamal', 'MS', 0, 1),
(2582, 173, 'Umm Sa\'id', 'UD', 0, 1),
(2583, 173, 'Umm Salal', 'UL', 0, 1),
(2584, 175, 'Alba', 'AB', 0, 1),
(2585, 175, 'Arad', 'AR', 0, 1),
(2586, 175, 'Arges', 'AG', 0, 1),
(2587, 175, 'Bacau', 'BC', 0, 1),
(2588, 175, 'Bihor', 'BH', 0, 1),
(2589, 175, 'Bistrita-Nasaud', 'BN', 0, 1),
(2590, 175, 'Botosani', 'BT', 0, 1),
(2591, 175, 'Brasov', 'BV', 0, 1),
(2592, 175, 'Braila', 'BR', 0, 1),
(2593, 175, 'Bucuresti', 'B', 0, 1),
(2594, 175, 'Buzau', 'BZ', 0, 1),
(2595, 175, 'Caras-Severin', 'CS', 0, 1),
(2596, 175, 'Calarasi', 'CL', 0, 1),
(2597, 175, 'Cluj', 'CJ', 0, 1),
(2598, 175, 'Constanta', 'CT', 0, 1),
(2599, 175, 'Covasna', 'CV', 0, 1),
(2600, 175, 'Dimbovita', 'DB', 0, 1),
(2601, 175, 'Dolj', 'DJ', 0, 1),
(2602, 175, 'Galati', 'GL', 0, 1),
(2603, 175, 'Giurgiu', 'GR', 0, 1),
(2604, 175, 'Gorj', 'GJ', 0, 1),
(2605, 175, 'Harghita', 'HR', 0, 1),
(2606, 175, 'Hunedoara', 'HD', 0, 1),
(2607, 175, 'Ialomita', 'IL', 0, 1),
(2608, 175, 'Iasi', 'IS', 0, 1),
(2609, 175, 'Ilfov', 'IF', 0, 1),
(2610, 175, 'Maramures', 'MM', 0, 1),
(2611, 175, 'Mehedinti', 'MH', 0, 1),
(2612, 175, 'Mures', 'MS', 0, 1),
(2613, 175, 'Neamt', 'NT', 0, 1),
(2614, 175, 'Olt', 'OT', 0, 1),
(2615, 175, 'Prahova', 'PH', 0, 1),
(2616, 175, 'Satu-Mare', 'SM', 0, 1),
(2617, 175, 'Salaj', 'SJ', 0, 1),
(2618, 175, 'Sibiu', 'SB', 0, 1),
(2619, 175, 'Suceava', 'SV', 0, 1),
(2620, 175, 'Teleorman', 'TR', 0, 1),
(2621, 175, 'Timis', 'TM', 0, 1),
(2622, 175, 'Tulcea', 'TL', 0, 1),
(2623, 175, 'Vaslui', 'VS', 0, 1),
(2624, 175, 'Valcea', 'VL', 0, 1),
(2625, 175, 'Vrancea', 'VN', 0, 1),
(2626, 176, 'Abakan', 'AB', 0, 1),
(2627, 176, 'Aginskoye', 'AG', 0, 1),
(2628, 176, 'Anadyr', 'AN', 0, 1),
(2629, 176, 'Arkahangelsk', 'AR', 0, 1),
(2630, 176, 'Astrakhan', 'AS', 0, 1),
(2631, 176, 'Barnaul', 'BA', 0, 1),
(2632, 176, 'Belgorod', 'BE', 0, 1),
(2633, 176, 'Birobidzhan', 'BI', 0, 1),
(2634, 176, 'Blagoveshchensk', 'BL', 0, 1),
(2635, 176, 'Bryansk', 'BR', 0, 1),
(2636, 176, 'Cheboksary', 'CH', 0, 1),
(2637, 176, 'Chelyabinsk', 'CL', 0, 1),
(2638, 176, 'Cherkessk', 'CR', 0, 1),
(2639, 176, 'Chita', 'CI', 0, 1),
(2640, 176, 'Dudinka', 'DU', 0, 1),
(2641, 176, 'Elista', 'EL', 0, 1),
(2642, 176, 'Gorno-Altaysk', 'GA', 0, 1),
(2643, 176, 'Groznyy', 'GR', 0, 1),
(2644, 176, 'Irkutsk', 'IR', 0, 1),
(2645, 176, 'Ivanovo', 'IV', 0, 1),
(2646, 176, 'Izhevsk', 'IZ', 0, 1),
(2647, 176, 'Kalinigrad', 'KA', 0, 1),
(2648, 176, 'Kaluga', 'KL', 0, 1),
(2649, 176, 'Kasnodar', 'KS', 0, 1),
(2650, 176, 'Kazan', 'KZ', 0, 1),
(2651, 176, 'Kemerovo', 'KE', 0, 1),
(2652, 176, 'Khabarovsk', 'KH', 0, 1),
(2653, 176, 'Khanty-Mansiysk', 'KM', 0, 1),
(2654, 176, 'Kostroma', 'KO', 0, 1),
(2655, 176, 'Krasnodar', 'KR', 0, 1),
(2656, 176, 'Krasnoyarsk', 'KN', 0, 1),
(2657, 176, 'Kudymkar', 'KU', 0, 1),
(2658, 176, 'Kurgan', 'KG', 0, 1),
(2659, 176, 'Kursk', 'KK', 0, 1),
(2660, 176, 'Kyzyl', 'KY', 0, 1),
(2661, 176, 'Lipetsk', 'LI', 0, 1),
(2662, 176, 'Magadan', 'MA', 0, 1),
(2663, 176, 'Makhachkala', 'MK', 0, 1),
(2664, 176, 'Maykop', 'MY', 0, 1),
(2665, 176, 'Moscow', 'MO', 0, 1),
(2666, 176, 'Murmansk', 'MU', 0, 1),
(2667, 176, 'Nalchik', 'NA', 0, 1),
(2668, 176, 'Naryan Mar', 'NR', 0, 1),
(2669, 176, 'Nazran', 'NZ', 0, 1),
(2670, 176, 'Nizhniy Novgorod', 'NI', 0, 1),
(2671, 176, 'Novgorod', 'NO', 0, 1),
(2672, 176, 'Novosibirsk', 'NV', 0, 1),
(2673, 176, 'Omsk', 'OM', 0, 1),
(2674, 176, 'Orel', 'OR', 0, 1),
(2675, 176, 'Orenburg', 'OE', 0, 1),
(2676, 176, 'Palana', 'PA', 0, 1),
(2677, 176, 'Penza', 'PE', 0, 1),
(2678, 176, 'Perm', 'PR', 0, 1),
(2679, 176, 'Petropavlovsk-Kamchatskiy', 'PK', 0, 1),
(2680, 176, 'Petrozavodsk', 'PT', 0, 1),
(2681, 176, 'Pskov', 'PS', 0, 1),
(2682, 176, 'Rostov-na-Donu', 'RO', 0, 1),
(2683, 176, 'Ryazan', 'RY', 0, 1),
(2684, 176, 'Salekhard', 'SL', 0, 1),
(2685, 176, 'Samara', 'SA', 0, 1),
(2686, 176, 'Saransk', 'SR', 0, 1),
(2687, 176, 'Saratov', 'SV', 0, 1),
(2688, 176, 'Smolensk', 'SM', 0, 1),
(2689, 176, 'St. Petersburg', 'SP', 0, 1),
(2690, 176, 'Stavropol', 'ST', 0, 1),
(2691, 176, 'Syktyvkar', 'SY', 0, 1),
(2692, 176, 'Tambov', 'TA', 0, 1),
(2693, 176, 'Tomsk', 'TO', 0, 1),
(2694, 176, 'Tula', 'TU', 0, 1),
(2695, 176, 'Tura', 'TR', 0, 1),
(2696, 176, 'Tver', 'TV', 0, 1),
(2697, 176, 'Tyumen', 'TY', 0, 1),
(2698, 176, 'Ufa', 'UF', 0, 1),
(2699, 176, 'Ul\'yanovsk', 'UL', 0, 1),
(2700, 176, 'Ulan-Ude', 'UU', 0, 1),
(2701, 176, 'Ust\'-Ordynskiy', 'US', 0, 1),
(2702, 176, 'Vladikavkaz', 'VL', 0, 1),
(2703, 176, 'Vladimir', 'VA', 0, 1),
(2704, 176, 'Vladivostok', 'VV', 0, 1),
(2705, 176, 'Volgograd', 'VG', 0, 1),
(2706, 176, 'Vologda', 'VD', 0, 1),
(2707, 176, 'Voronezh', 'VO', 0, 1),
(2708, 176, 'Vyatka', 'VY', 0, 1),
(2709, 176, 'Yakutsk', 'YA', 0, 1),
(2710, 176, 'Yaroslavl', 'YR', 0, 1),
(2711, 176, 'Yekaterinburg', 'YE', 0, 1),
(2712, 176, 'Yoshkar-Ola', 'YO', 0, 1),
(2713, 177, 'Butare', 'BU', 0, 1),
(2714, 177, 'Byumba', 'BY', 0, 1),
(2715, 177, 'Cyangugu', 'CY', 0, 1),
(2716, 177, 'Gikongoro', 'GK', 0, 1),
(2717, 177, 'Gisenyi', 'GS', 0, 1),
(2718, 177, 'Gitarama', 'GT', 0, 1),
(2719, 177, 'Kibungo', 'KG', 0, 1),
(2720, 177, 'Kibuye', 'KY', 0, 1),
(2721, 177, 'Kigali Rurale', 'KR', 0, 1),
(2722, 177, 'Kigali-ville', 'KV', 0, 1),
(2723, 177, 'Ruhengeri', 'RU', 0, 1),
(2724, 177, 'Umutara', 'UM', 0, 1),
(2725, 178, 'Christ Church Nichola Town', 'CCN', 0, 1),
(2726, 178, 'Saint Anne Sandy Point', 'SAS', 0, 1),
(2727, 178, 'Saint George Basseterre', 'SGB', 0, 1),
(2728, 178, 'Saint George Gingerland', 'SGG', 0, 1),
(2729, 178, 'Saint James Windward', 'SJW', 0, 1),
(2730, 178, 'Saint John Capesterre', 'SJC', 0, 1),
(2731, 178, 'Saint John Figtree', 'SJF', 0, 1),
(2732, 178, 'Saint Mary Cayon', 'SMC', 0, 1),
(2733, 178, 'Saint Paul Capesterre', 'CAP', 0, 1),
(2734, 178, 'Saint Paul Charlestown', 'CHA', 0, 1),
(2735, 178, 'Saint Peter Basseterre', 'SPB', 0, 1),
(2736, 178, 'Saint Thomas Lowland', 'STL', 0, 1),
(2737, 178, 'Saint Thomas Middle Island', 'STM', 0, 1),
(2738, 178, 'Trinity Palmetto Point', 'TPP', 0, 1),
(2739, 179, 'Anse-la-Raye', 'AR', 0, 1),
(2740, 179, 'Castries', 'CA', 0, 1),
(2741, 179, 'Choiseul', 'CH', 0, 1),
(2742, 179, 'Dauphin', 'DA', 0, 1),
(2743, 179, 'Dennery', 'DE', 0, 1),
(2744, 179, 'Gros-Islet', 'GI', 0, 1),
(2745, 179, 'Laborie', 'LA', 0, 1),
(2746, 179, 'Micoud', 'MI', 0, 1),
(2747, 179, 'Praslin', 'PR', 0, 1),
(2748, 179, 'Soufriere', 'SO', 0, 1),
(2749, 179, 'Vieux-Fort', 'VF', 0, 1),
(2750, 180, 'Charlotte', 'C', 0, 1),
(2751, 180, 'Grenadines', 'R', 0, 1),
(2752, 180, 'Saint Andrew', 'A', 0, 1),
(2753, 180, 'Saint David', 'D', 0, 1),
(2754, 180, 'Saint George', 'G', 0, 1),
(2755, 180, 'Saint Patrick', 'P', 0, 1),
(2756, 181, 'A\'ana', 'AN', 0, 1),
(2757, 181, 'Aiga-i-le-Tai', 'AI', 0, 1),
(2758, 181, 'Atua', 'AT', 0, 1),
(2759, 181, 'Fa\'asaleleaga', 'FA', 0, 1),
(2760, 181, 'Gaga\'emauga', 'GE', 0, 1),
(2761, 181, 'Gagaifomauga', 'GF', 0, 1),
(2762, 181, 'Palauli', 'PA', 0, 1),
(2763, 181, 'Satupa\'itea', 'SA', 0, 1),
(2764, 181, 'Tuamasaga', 'TU', 0, 1),
(2765, 181, 'Va\'a-o-Fonoti', 'VF', 0, 1),
(2766, 181, 'Vaisigano', 'VS', 0, 1),
(2767, 182, 'Acquaviva', 'AC', 0, 1),
(2768, 182, 'Borgo Maggiore', 'BM', 0, 1),
(2769, 182, 'Chiesanuova', 'CH', 0, 1),
(2770, 182, 'Domagnano', 'DO', 0, 1),
(2771, 182, 'Faetano', 'FA', 0, 1),
(2772, 182, 'Fiorentino', 'FI', 0, 1),
(2773, 182, 'Montegiardino', 'MO', 0, 1),
(2774, 182, 'Citta di San Marino', 'SM', 0, 1),
(2775, 182, 'Serravalle', 'SE', 0, 1),
(2776, 183, 'Sao Tome', 'S', 0, 1),
(2777, 183, 'Principe', 'P', 0, 1),
(2778, 184, 'Al Bahah', 'BH', 0, 1),
(2779, 184, 'Al Hudud ash Shamaliyah', 'HS', 0, 1),
(2780, 184, 'Al Jawf', 'JF', 0, 1),
(2781, 184, 'Al Madinah', 'MD', 0, 1),
(2782, 184, 'Al Qasim', 'QS', 0, 1),
(2783, 184, 'Ar Riyad', 'RD', 0, 1),
(2784, 184, 'Ash Sharqiyah (Eastern)', 'AQ', 0, 1),
(2785, 184, '\'Asir', 'AS', 0, 1);
INSERT INTO `mlm_states` (`id`, `country_id`, `state_name`, `code`, `reg_count`, `status`) VALUES
(2786, 184, 'Ha\'il', 'HL', 0, 1),
(2787, 184, 'Jizan', 'JZ', 0, 1),
(2788, 184, 'Makkah', 'ML', 0, 1),
(2789, 184, 'Najran', 'NR', 0, 1),
(2790, 184, 'Tabuk', 'TB', 0, 1),
(2791, 185, 'Dakar', 'DA', 0, 1),
(2792, 185, 'Diourbel', 'DI', 0, 1),
(2793, 185, 'Fatick', 'FA', 0, 1),
(2794, 185, 'Kaolack', 'KA', 0, 1),
(2795, 185, 'Kolda', 'KO', 0, 1),
(2796, 185, 'Louga', 'LO', 0, 1),
(2797, 185, 'Matam', 'MA', 0, 1),
(2798, 185, 'Saint-Louis', 'SL', 0, 1),
(2799, 185, 'Tambacounda', 'TA', 0, 1),
(2800, 185, 'Thies', 'TH', 0, 1),
(2801, 185, 'Ziguinchor', 'ZI', 0, 1),
(2802, 186, 'Anse aux Pins', 'AP', 0, 1),
(2803, 186, 'Anse Boileau', 'AB', 0, 1),
(2804, 186, 'Anse Etoile', 'AE', 0, 1),
(2805, 186, 'Anse Louis', 'AL', 0, 1),
(2806, 186, 'Anse Royale', 'AR', 0, 1),
(2807, 186, 'Baie Lazare', 'BL', 0, 1),
(2808, 186, 'Baie Sainte Anne', 'BS', 0, 1),
(2809, 186, 'Beau Vallon', 'BV', 0, 1),
(2810, 186, 'Bel Air', 'BA', 0, 1),
(2811, 186, 'Bel Ombre', 'BO', 0, 1),
(2812, 186, 'Cascade', 'CA', 0, 1),
(2813, 186, 'Glacis', 'GL', 0, 1),
(2814, 186, 'Grand\' Anse (on Mahe)', 'GM', 0, 1),
(2815, 186, 'Grand\' Anse (on Praslin)', 'GP', 0, 1),
(2816, 186, 'La Digue', 'DG', 0, 1),
(2817, 186, 'La Riviere Anglaise', 'RA', 0, 1),
(2818, 186, 'Mont Buxton', 'MB', 0, 1),
(2819, 186, 'Mont Fleuri', 'MF', 0, 1),
(2820, 186, 'Plaisance', 'PL', 0, 1),
(2821, 186, 'Pointe La Rue', 'PR', 0, 1),
(2822, 186, 'Port Glaud', 'PG', 0, 1),
(2823, 186, 'Saint Louis', 'SL', 0, 1),
(2824, 186, 'Takamaka', 'TA', 0, 1),
(2825, 187, 'Eastern', 'E', 0, 1),
(2826, 187, 'Northern', 'N', 0, 1),
(2827, 187, 'Southern', 'S', 0, 1),
(2828, 187, 'Western', 'W', 0, 1),
(2829, 189, 'BanskobystrickÃ½', 'BA', 0, 1),
(2830, 189, 'BratislavskÃ½', 'BR', 0, 1),
(2831, 189, 'KoÅ¡ickÃ½', 'KO', 0, 1),
(2832, 189, 'Nitriansky', 'NI', 0, 1),
(2833, 189, 'PreÅ¡ovskÃ½', 'PR', 0, 1),
(2834, 189, 'TrenÄiansky', 'TC', 0, 1),
(2835, 189, 'TrnavskÃ½', 'TV', 0, 1),
(2836, 189, 'Å½ilinskÃ½', 'ZI', 0, 1),
(2837, 191, 'Central', 'CE', 0, 1),
(2838, 191, 'Choiseul', 'CH', 0, 1),
(2839, 191, 'Guadalcanal', 'GC', 0, 1),
(2840, 191, 'Honiara', 'HO', 0, 1),
(2841, 191, 'Isabel', 'IS', 0, 1),
(2842, 191, 'Makira', 'MK', 0, 1),
(2843, 191, 'Malaita', 'ML', 0, 1),
(2844, 191, 'Rennell and Bellona', 'RB', 0, 1),
(2845, 191, 'Temotu', 'TM', 0, 1),
(2846, 191, 'Western', 'WE', 0, 1),
(2847, 192, 'Awdal', 'AW', 0, 1),
(2848, 192, 'Bakool', 'BK', 0, 1),
(2849, 192, 'Banaadir', 'BN', 0, 1),
(2850, 192, 'Bari', 'BR', 0, 1),
(2851, 192, 'Bay', 'BY', 0, 1),
(2852, 192, 'Galguduud', 'GA', 0, 1),
(2853, 192, 'Gedo', 'GE', 0, 1),
(2854, 192, 'Hiiraan', 'HI', 0, 1),
(2855, 192, 'Jubbada Dhexe', 'JD', 0, 1),
(2856, 192, 'Jubbada Hoose', 'JH', 0, 1),
(2857, 192, 'Mudug', 'MU', 0, 1),
(2858, 192, 'Nugaal', 'NU', 0, 1),
(2859, 192, 'Sanaag', 'SA', 0, 1),
(2860, 192, 'Shabeellaha Dhexe', 'SD', 0, 1),
(2861, 192, 'Shabeellaha Hoose', 'SH', 0, 1),
(2862, 192, 'Sool', 'SL', 0, 1),
(2863, 192, 'Togdheer', 'TO', 0, 1),
(2864, 192, 'Woqooyi Galbeed', 'WG', 0, 1),
(2865, 193, 'Eastern Cape', 'EC', 0, 1),
(2866, 193, 'Free State', 'FS', 0, 1),
(2867, 193, 'Gauteng', 'GT', 0, 1),
(2868, 193, 'KwaZulu-Natal', 'KN', 0, 1),
(2869, 193, 'Limpopo', 'LP', 0, 1),
(2870, 193, 'Mpumalanga', 'MP', 0, 1),
(2871, 193, 'North West', 'NW', 0, 1),
(2872, 193, 'Northern Cape', 'NC', 0, 1),
(2873, 193, 'Western Cape', 'WC', 0, 1),
(2874, 195, 'La Coru&ntilde;a', 'CA', 0, 1),
(2875, 195, '&Aacute;lava', 'AL', 0, 1),
(2876, 195, 'Albacete', 'AB', 0, 1),
(2877, 195, 'Alicante', 'AC', 0, 1),
(2878, 195, 'Almeria', 'AM', 0, 1),
(2879, 195, 'Asturias', 'AS', 0, 1),
(2880, 195, '&Aacute;vila', 'AV', 0, 1),
(2881, 195, 'Badajoz', 'BJ', 0, 1),
(2882, 195, 'Baleares', 'IB', 0, 1),
(2883, 195, 'Barcelona', 'BA', 0, 1),
(2884, 195, 'Burgos', 'BU', 0, 1),
(2885, 195, 'C&aacute;ceres', 'CC', 0, 1),
(2886, 195, 'C&aacute;diz', 'CZ', 0, 1),
(2887, 195, 'Cantabria', 'CT', 0, 1),
(2888, 195, 'Castell&oacute;n', 'CL', 0, 1),
(2889, 195, 'Ceuta', 'CE', 0, 1),
(2890, 195, 'Ciudad Real', 'CR', 0, 1),
(2891, 195, 'C&oacute;rdoba', 'CD', 0, 1),
(2892, 195, 'Cuenca', 'CU', 0, 1),
(2893, 195, 'Girona', 'GI', 0, 1),
(2894, 195, 'Granada', 'GD', 0, 1),
(2895, 195, 'Guadalajara', 'GJ', 0, 1),
(2896, 195, 'Guip&uacute;zcoa', 'GP', 0, 1),
(2897, 195, 'Huelva', 'HL', 0, 1),
(2898, 195, 'Huesca', 'HS', 0, 1),
(2899, 195, 'Ja&eacute;n', 'JN', 0, 1),
(2900, 195, 'La Rioja', 'RJ', 0, 1),
(2901, 195, 'Las Palmas', 'PM', 0, 1),
(2902, 195, 'Leon', 'LE', 0, 1),
(2903, 195, 'Lleida', 'LL', 0, 1),
(2904, 195, 'Lugo', 'LG', 0, 1),
(2905, 195, 'Madrid', 'MD', 0, 1),
(2906, 195, 'Malaga', 'MA', 0, 1),
(2907, 195, 'Melilla', 'ML', 0, 1),
(2908, 195, 'Murcia', 'MU', 0, 1),
(2909, 195, 'Navarra', 'NV', 0, 1),
(2910, 195, 'Ourense', 'OU', 0, 1),
(2911, 195, 'Palencia', 'PL', 0, 1),
(2912, 195, 'Pontevedra', 'PO', 0, 1),
(2913, 195, 'Salamanca', 'SL', 0, 1),
(2914, 195, 'Santa Cruz de Tenerife', 'SC', 0, 1),
(2915, 195, 'Segovia', 'SG', 0, 1),
(2916, 195, 'Sevilla', 'SV', 0, 1),
(2917, 195, 'Soria', 'SO', 0, 1),
(2918, 195, 'Tarragona', 'TA', 0, 1),
(2919, 195, 'Teruel', 'TE', 0, 1),
(2920, 195, 'Toledo', 'TO', 0, 1),
(2921, 195, 'Valencia', 'VC', 0, 1),
(2922, 195, 'Valladolid', 'VD', 0, 1),
(2923, 195, 'Vizcaya', 'VZ', 0, 1),
(2924, 195, 'Zamora', 'ZM', 0, 1),
(2925, 195, 'Zaragoza', 'ZR', 0, 1),
(2926, 196, 'Central', 'CE', 0, 1),
(2927, 196, 'Eastern', 'EA', 0, 1),
(2928, 196, 'North Central', 'NC', 0, 1),
(2929, 196, 'Northern', 'NO', 0, 1),
(2930, 196, 'North Western', 'NW', 0, 1),
(2931, 196, 'Sabaragamuwa', 'SA', 0, 1),
(2932, 196, 'Southern', 'SO', 0, 1),
(2933, 196, 'Uva', 'UV', 0, 1),
(2934, 196, 'Western', 'WE', 0, 1),
(2935, 197, 'Saint Helena', 'S', 0, 1),
(2936, 199, 'A\'ali an Nil', 'ANL', 0, 1),
(2937, 199, 'Al Bahr al Ahmar', 'BAM', 0, 1),
(2938, 199, 'Al Buhayrat', 'BRT', 0, 1),
(2939, 199, 'Al Jazirah', 'JZR', 0, 1),
(2940, 199, 'Al Khartum', 'KRT', 0, 1),
(2941, 199, 'Al Qadarif', 'QDR', 0, 1),
(2942, 199, 'Al Wahdah', 'WDH', 0, 1),
(2943, 199, 'An Nil al Abyad', 'ANB', 0, 1),
(2944, 199, 'An Nil al Azraq', 'ANZ', 0, 1),
(2945, 199, 'Ash Shamaliyah', 'ASH', 0, 1),
(2946, 199, 'Bahr al Jabal', 'BJA', 0, 1),
(2947, 199, 'Gharb al Istiwa\'iyah', 'GIS', 0, 1),
(2948, 199, 'Gharb Bahr al Ghazal', 'GBG', 0, 1),
(2949, 199, 'Gharb Darfur', 'GDA', 0, 1),
(2950, 199, 'Gharb Kurdufan', 'GKU', 0, 1),
(2951, 199, 'Janub Darfur', 'JDA', 0, 1),
(2952, 199, 'Janub Kurdufan', 'JKU', 0, 1),
(2953, 199, 'Junqali', 'JQL', 0, 1),
(2954, 199, 'Kassala', 'KSL', 0, 1),
(2955, 199, 'Nahr an Nil', 'NNL', 0, 1),
(2956, 199, 'Shamal Bahr al Ghazal', 'SBG', 0, 1),
(2957, 199, 'Shamal Darfur', 'SDA', 0, 1),
(2958, 199, 'Shamal Kurdufan', 'SKU', 0, 1),
(2959, 199, 'Sharq al Istiwa\'iyah', 'SIS', 0, 1),
(2960, 199, 'Sinnar', 'SNR', 0, 1),
(2961, 199, 'Warab', 'WRB', 0, 1),
(2962, 200, 'Brokopondo', 'BR', 0, 1),
(2963, 200, 'Commewijne', 'CM', 0, 1),
(2964, 200, 'Coronie', 'CR', 0, 1),
(2965, 200, 'Marowijne', 'MA', 0, 1),
(2966, 200, 'Nickerie', 'NI', 0, 1),
(2967, 200, 'Para', 'PA', 0, 1),
(2968, 200, 'Paramaribo', 'PM', 0, 1),
(2969, 200, 'Saramacca', 'SA', 0, 1),
(2970, 200, 'Sipaliwini', 'SI', 0, 1),
(2971, 200, 'Wanica', 'WA', 0, 1),
(2972, 202, 'Hhohho', 'H', 0, 1),
(2973, 202, 'Lubombo', 'L', 0, 1),
(2974, 202, 'Manzini', 'M', 0, 1),
(2975, 202, 'Shishelweni', 'S', 0, 1),
(2976, 203, 'Blekinge', 'K', 0, 1),
(2977, 203, 'Dalarna', 'W', 0, 1),
(2978, 203, 'GÃ¤vleborg', 'X', 0, 1),
(2979, 203, 'Gotland', 'I', 0, 1),
(2980, 203, 'Halland', 'N', 0, 1),
(2981, 203, 'JÃ¤mtland', 'Z', 0, 1),
(2982, 203, 'JÃ¶nkÃ¶ping', 'F', 0, 1),
(2983, 203, 'Kalmar', 'H', 0, 1),
(2984, 203, 'Kronoberg', 'G', 0, 1),
(2985, 203, 'Norrbotten', 'BD', 0, 1),
(2986, 203, 'Ã–rebro', 'T', 0, 1),
(2987, 203, 'Ã–stergÃ¶tland', 'E', 0, 1),
(2988, 203, 'Sk&aring;ne', 'M', 0, 1),
(2989, 203, 'SÃ¶dermanland', 'D', 0, 1),
(2990, 203, 'Stockholm', 'AB', 0, 1),
(2991, 203, 'Uppsala', 'C', 0, 1),
(2992, 203, 'VÃ¤rmland', 'S', 0, 1),
(2993, 203, 'VÃ¤sterbotten', 'AC', 0, 1),
(2994, 203, 'VÃ¤sternorrland', 'Y', 0, 1),
(2995, 203, 'VÃ¤stmanland', 'U', 0, 1),
(2996, 203, 'VÃ¤stra GÃ¶taland', 'O', 0, 1),
(2997, 204, 'Aargau', 'AG', 0, 1),
(2998, 204, 'Appenzell Ausserrhoden', 'AR', 0, 1),
(2999, 204, 'Appenzell Innerrhoden', 'AI', 0, 1),
(3000, 204, 'Basel-Stadt', 'BS', 0, 1),
(3001, 204, 'Basel-Landschaft', 'BL', 0, 1),
(3002, 204, 'Bern', 'BE', 0, 1),
(3003, 204, 'Fribourg', 'FR', 0, 1),
(3004, 204, 'Gen&egrave;ve', 'GE', 0, 1),
(3005, 204, 'Glarus', 'GL', 0, 1),
(3006, 204, 'GraubÃ¼nden', 'GR', 0, 1),
(3007, 204, 'Jura', 'JU', 0, 1),
(3008, 204, 'Luzern', 'LU', 0, 1),
(3009, 204, 'Neuch&acirc;tel', 'NE', 0, 1),
(3010, 204, 'Nidwald', 'NW', 0, 1),
(3011, 204, 'Obwald', 'OW', 0, 1),
(3012, 204, 'St. Gallen', 'SG', 0, 1),
(3013, 204, 'Schaffhausen', 'SH', 0, 1),
(3014, 204, 'Schwyz', 'SZ', 0, 1),
(3015, 204, 'Solothurn', 'SO', 0, 1),
(3016, 204, 'Thurgau', 'TG', 0, 1),
(3017, 204, 'Ticino', 'TI', 0, 1),
(3018, 204, 'Uri', 'UR', 0, 1),
(3019, 204, 'Valais', 'VS', 0, 1),
(3020, 204, 'Vaud', 'VD', 0, 1),
(3021, 204, 'Zug', 'ZG', 0, 1),
(3022, 204, 'ZÃ¼rich', 'ZH', 0, 1),
(3023, 205, 'Al Hasakah', 'HA', 0, 1),
(3024, 205, 'Al Ladhiqiyah', 'LA', 0, 1),
(3025, 205, 'Al Qunaytirah', 'QU', 0, 1),
(3026, 205, 'Ar Raqqah', 'RQ', 0, 1),
(3027, 205, 'As Suwayda', 'SU', 0, 1),
(3028, 205, 'Dara', 'DA', 0, 1),
(3029, 205, 'Dayr az Zawr', 'DZ', 0, 1),
(3030, 205, 'Dimashq', 'DI', 0, 1),
(3031, 205, 'Halab', 'HL', 0, 1),
(3032, 205, 'Hamah', 'HM', 0, 1),
(3033, 205, 'Hims', 'HI', 0, 1),
(3034, 205, 'Idlib', 'ID', 0, 1),
(3035, 205, 'Rif Dimashq', 'RD', 0, 1),
(3036, 205, 'Tartus', 'TA', 0, 1),
(3037, 206, 'Chang-hua', 'CH', 0, 1),
(3038, 206, 'Chia-i', 'CI', 0, 1),
(3039, 206, 'Hsin-chu', 'HS', 0, 1),
(3040, 206, 'Hua-lien', 'HL', 0, 1),
(3041, 206, 'I-lan', 'IL', 0, 1),
(3042, 206, 'Kao-hsiung county', 'KH', 0, 1),
(3043, 206, 'Kin-men', 'KM', 0, 1),
(3044, 206, 'Lien-chiang', 'LC', 0, 1),
(3045, 206, 'Miao-li', 'ML', 0, 1),
(3046, 206, 'Nan-t\'ou', 'NT', 0, 1),
(3047, 206, 'P\'eng-hu', 'PH', 0, 1),
(3048, 206, 'P\'ing-tung', 'PT', 0, 1),
(3049, 206, 'T\'ai-chung', 'TG', 0, 1),
(3050, 206, 'T\'ai-nan', 'TA', 0, 1),
(3051, 206, 'T\'ai-pei county', 'TP', 0, 1),
(3052, 206, 'T\'ai-tung', 'TT', 0, 1),
(3053, 206, 'T\'ao-yuan', 'TY', 0, 1),
(3054, 206, 'Yun-lin', 'YL', 0, 1),
(3055, 206, 'Chia-i city', 'CC', 0, 1),
(3056, 206, 'Chi-lung', 'CL', 0, 1),
(3057, 206, 'Hsin-chu', 'HC', 0, 1),
(3058, 206, 'T\'ai-chung', 'TH', 0, 1),
(3059, 206, 'T\'ai-nan', 'TN', 0, 1),
(3060, 206, 'Kao-hsiung city', 'KC', 0, 1),
(3061, 206, 'T\'ai-pei city', 'TC', 0, 1),
(3062, 207, 'Gorno-Badakhstan', 'GB', 0, 1),
(3063, 207, 'Khatlon', 'KT', 0, 1),
(3064, 207, 'Sughd', 'SU', 0, 1),
(3065, 208, 'Arusha', 'AR', 0, 1),
(3066, 208, 'Dar es Salaam', 'DS', 0, 1),
(3067, 208, 'Dodoma', 'DO', 0, 1),
(3068, 208, 'Iringa', 'IR', 0, 1),
(3069, 208, 'Kagera', 'KA', 0, 1),
(3070, 208, 'Kigoma', 'KI', 0, 1),
(3071, 208, 'Kilimanjaro', 'KJ', 0, 1),
(3072, 208, 'Lindi', 'LN', 0, 1),
(3073, 208, 'Manyara', 'MY', 0, 1),
(3074, 208, 'Mara', 'MR', 0, 1),
(3075, 208, 'Mbeya', 'MB', 0, 1),
(3076, 208, 'Morogoro', 'MO', 0, 1),
(3077, 208, 'Mtwara', 'MT', 0, 1),
(3078, 208, 'Mwanza', 'MW', 0, 1),
(3079, 208, 'Pemba North', 'PN', 0, 1),
(3080, 208, 'Pemba South', 'PS', 0, 1),
(3081, 208, 'Pwani', 'PW', 0, 1),
(3082, 208, 'Rukwa', 'RK', 0, 1),
(3083, 208, 'Ruvuma', 'RV', 0, 1),
(3084, 208, 'Shinyanga', 'SH', 0, 1),
(3085, 208, 'Singida', 'SI', 0, 1),
(3086, 208, 'Tabora', 'TB', 0, 1),
(3087, 208, 'Tanga', 'TN', 0, 1),
(3088, 208, 'Zanzibar Central/South', 'ZC', 0, 1),
(3089, 208, 'Zanzibar North', 'ZN', 0, 1),
(3090, 208, 'Zanzibar Urban/West', 'ZU', 0, 1),
(3091, 209, 'Amnat Charoen', 'Amnat Charoen', 0, 1),
(3092, 209, 'Ang Thong', 'Ang Thong', 0, 1),
(3093, 209, 'Ayutthaya', 'Ayutthaya', 0, 1),
(3094, 209, 'Bangkok', 'Bangkok', 0, 1),
(3095, 209, 'Buriram', 'Buriram', 0, 1),
(3096, 209, 'Chachoengsao', 'Chachoengsao', 0, 1),
(3097, 209, 'Chai Nat', 'Chai Nat', 0, 1),
(3098, 209, 'Chaiyaphum', 'Chaiyaphum', 0, 1),
(3099, 209, 'Chanthaburi', 'Chanthaburi', 0, 1),
(3100, 209, 'Chiang Mai', 'Chiang Mai', 0, 1),
(3101, 209, 'Chiang Rai', 'Chiang Rai', 0, 1),
(3102, 209, 'Chon Buri', 'Chon Buri', 0, 1),
(3103, 209, 'Chumphon', 'Chumphon', 0, 1),
(3104, 209, 'Kalasin', 'Kalasin', 0, 1),
(3105, 209, 'Kamphaeng Phet', 'Kamphaeng Phet', 0, 1),
(3106, 209, 'Kanchanaburi', 'Kanchanaburi', 0, 1),
(3107, 209, 'Khon Kaen', 'Khon Kaen', 0, 1),
(3108, 209, 'Krabi', 'Krabi', 0, 1),
(3109, 209, 'Lampang', 'Lampang', 0, 1),
(3110, 209, 'Lamphun', 'Lamphun', 0, 1),
(3111, 209, 'Loei', 'Loei', 0, 1),
(3112, 209, 'Lop Buri', 'Lop Buri', 0, 1),
(3113, 209, 'Mae Hong Son', 'Mae Hong Son', 0, 1),
(3114, 209, 'Maha Sarakham', 'Maha Sarakham', 0, 1),
(3115, 209, 'Mukdahan', 'Mukdahan', 0, 1),
(3116, 209, 'Nakhon Nayok', 'Nakhon Nayok', 0, 1),
(3117, 209, 'Nakhon Pathom', 'Nakhon Pathom', 0, 1),
(3118, 209, 'Nakhon Phanom', 'Nakhon Phanom', 0, 1),
(3119, 209, 'Nakhon Ratchasima', 'Nakhon Ratchasima', 0, 1),
(3120, 209, 'Nakhon Sawan', 'Nakhon Sawan', 0, 1),
(3121, 209, 'Nakhon Si Thammarat', 'Nakhon Si Thammarat', 0, 1),
(3122, 209, 'Nan', 'Nan', 0, 1),
(3123, 209, 'Narathiwat', 'Narathiwat', 0, 1),
(3124, 209, 'Nong Bua Lamphu', 'Nong Bua Lamphu', 0, 1),
(3125, 209, 'Nong Khai', 'Nong Khai', 0, 1),
(3126, 209, 'Nonthaburi', 'Nonthaburi', 0, 1),
(3127, 209, 'Pathum Thani', 'Pathum Thani', 0, 1),
(3128, 209, 'Pattani', 'Pattani', 0, 1),
(3129, 209, 'Phangnga', 'Phangnga', 0, 1),
(3130, 209, 'Phatthalung', 'Phatthalung', 0, 1),
(3131, 209, 'Phayao', 'Phayao', 0, 1),
(3132, 209, 'Phetchabun', 'Phetchabun', 0, 1),
(3133, 209, 'Phetchaburi', 'Phetchaburi', 0, 1),
(3134, 209, 'Phichit', 'Phichit', 0, 1),
(3135, 209, 'Phitsanulok', 'Phitsanulok', 0, 1),
(3136, 209, 'Phrae', 'Phrae', 0, 1),
(3137, 209, 'Phuket', 'Phuket', 0, 1),
(3138, 209, 'Prachin Buri', 'Prachin Buri', 0, 1),
(3139, 209, 'Prachuap Khiri Khan', 'Prachuap Khiri Khan', 0, 1),
(3140, 209, 'Ranong', 'Ranong', 0, 1),
(3141, 209, 'Ratchaburi', 'Ratchaburi', 0, 1),
(3142, 209, 'Rayong', 'Rayong', 0, 1),
(3143, 209, 'Roi Et', 'Roi Et', 0, 1),
(3144, 209, 'Sa Kaeo', 'Sa Kaeo', 0, 1),
(3145, 209, 'Sakon Nakhon', 'Sakon Nakhon', 0, 1),
(3146, 209, 'Samut Prakan', 'Samut Prakan', 0, 1),
(3147, 209, 'Samut Sakhon', 'Samut Sakhon', 0, 1),
(3148, 209, 'Samut Songkhram', 'Samut Songkhram', 0, 1),
(3149, 209, 'Sara Buri', 'Sara Buri', 0, 1),
(3150, 209, 'Satun', 'Satun', 0, 1),
(3151, 209, 'Sing Buri', 'Sing Buri', 0, 1),
(3152, 209, 'Sisaket', 'Sisaket', 0, 1),
(3153, 209, 'Songkhla', 'Songkhla', 0, 1),
(3154, 209, 'Sukhothai', 'Sukhothai', 0, 1),
(3155, 209, 'Suphan Buri', 'Suphan Buri', 0, 1),
(3156, 209, 'Surat Thani', 'Surat Thani', 0, 1),
(3157, 209, 'Surin', 'Surin', 0, 1),
(3158, 209, 'Tak', 'Tak', 0, 1),
(3159, 209, 'Trang', 'Trang', 0, 1),
(3160, 209, 'Trat', 'Trat', 0, 1),
(3161, 209, 'Ubon Ratchathani', 'Ubon Ratchathani', 0, 1),
(3162, 209, 'Udon Thani', 'Udon Thani', 0, 1),
(3163, 209, 'Uthai Thani', 'Uthai Thani', 0, 1),
(3164, 209, 'Uttaradit', 'Uttaradit', 0, 1),
(3165, 209, 'Yala', 'Yala', 0, 1),
(3166, 209, 'Yasothon', 'Yasothon', 0, 1),
(3167, 210, 'Kara', 'K', 0, 1),
(3168, 210, 'Plateaux', 'P', 0, 1),
(3169, 210, 'Savanes', 'S', 0, 1),
(3170, 210, 'Centrale', 'C', 0, 1),
(3171, 210, 'Maritime', 'M', 0, 1),
(3172, 211, 'Atafu', 'A', 0, 1),
(3173, 211, 'Fakaofo', 'F', 0, 1),
(3174, 211, 'Nukunonu', 'N', 0, 1),
(3175, 212, 'Ha\'apai', 'H', 0, 1),
(3176, 212, 'Tongatapu', 'T', 0, 1),
(3177, 212, 'Vava\'u', 'V', 0, 1),
(3178, 213, 'Couva/Tabaquite/Talparo', 'CT', 0, 1),
(3179, 213, 'Diego Martin', 'DM', 0, 1),
(3180, 213, 'Mayaro/Rio Claro', 'MR', 0, 1),
(3181, 213, 'Penal/Debe', 'PD', 0, 1),
(3182, 213, 'Princes Town', 'PT', 0, 1),
(3183, 213, 'Sangre Grande', 'SG', 0, 1),
(3184, 213, 'San Juan/Laventille', 'SL', 0, 1),
(3185, 213, 'Siparia', 'SI', 0, 1),
(3186, 213, 'Tunapuna/Piarco', 'TP', 0, 1),
(3187, 213, 'Port of Spain', 'PS', 0, 1),
(3188, 213, 'San Fernando', 'SF', 0, 1),
(3189, 213, 'Arima', 'AR', 0, 1),
(3190, 213, 'Point Fortin', 'PF', 0, 1),
(3191, 213, 'Chaguanas', 'CH', 0, 1),
(3192, 213, 'Tobago', 'TO', 0, 1),
(3193, 214, 'Ariana', 'AR', 0, 1),
(3194, 214, 'Beja', 'BJ', 0, 1),
(3195, 214, 'Ben Arous', 'BA', 0, 1),
(3196, 214, 'Bizerte', 'BI', 0, 1),
(3197, 214, 'Gabes', 'GB', 0, 1),
(3198, 214, 'Gafsa', 'GF', 0, 1),
(3199, 214, 'Jendouba', 'JE', 0, 1),
(3200, 214, 'Kairouan', 'KR', 0, 1),
(3201, 214, 'Kasserine', 'KS', 0, 1),
(3202, 214, 'Kebili', 'KB', 0, 1),
(3203, 214, 'Kef', 'KF', 0, 1),
(3204, 214, 'Mahdia', 'MH', 0, 1),
(3205, 214, 'Manouba', 'MN', 0, 1),
(3206, 214, 'Medenine', 'ME', 0, 1),
(3207, 214, 'Monastir', 'MO', 0, 1),
(3208, 214, 'Nabeul', 'NA', 0, 1),
(3209, 214, 'Sfax', 'SF', 0, 1),
(3210, 214, 'Sidi', 'SD', 0, 1),
(3211, 214, 'Siliana', 'SL', 0, 1),
(3212, 214, 'Sousse', 'SO', 0, 1),
(3213, 214, 'Tataouine', 'TA', 0, 1),
(3214, 214, 'Tozeur', 'TO', 0, 1),
(3215, 214, 'Tunis', 'TU', 0, 1),
(3216, 214, 'Zaghouan', 'ZA', 0, 1),
(3217, 215, 'Adana', 'ADA', 0, 1),
(3218, 215, 'AdÄ±yaman', 'ADI', 0, 1),
(3219, 215, 'Afyonkarahisar', 'AFY', 0, 1),
(3220, 215, 'AÄŸrÄ±', 'AGR', 0, 1),
(3221, 215, 'Aksaray', 'AKS', 0, 1),
(3222, 215, 'Amasya', 'AMA', 0, 1),
(3223, 215, 'Ankara', 'ANK', 0, 1),
(3224, 215, 'Antalya', 'ANT', 0, 1),
(3225, 215, 'Ardahan', 'ARD', 0, 1),
(3226, 215, 'Artvin', 'ART', 0, 1),
(3227, 215, 'AydÄ±n', 'AYI', 0, 1),
(3228, 215, 'BalÄ±kesir', 'BAL', 0, 1),
(3229, 215, 'BartÄ±n', 'BAR', 0, 1),
(3230, 215, 'Batman', 'BAT', 0, 1),
(3231, 215, 'Bayburt', 'BAY', 0, 1),
(3232, 215, 'Bilecik', 'BIL', 0, 1),
(3233, 215, 'BingÃ¶l', 'BIN', 0, 1),
(3234, 215, 'Bitlis', 'BIT', 0, 1),
(3235, 215, 'Bolu', 'BOL', 0, 1),
(3236, 215, 'Burdur', 'BRD', 0, 1),
(3237, 215, 'Bursa', 'BRS', 0, 1),
(3238, 215, 'Ã‡anakkale', 'CKL', 0, 1),
(3239, 215, 'Ã‡ankÄ±rÄ±', 'CKR', 0, 1),
(3240, 215, 'Ã‡orum', 'COR', 0, 1),
(3241, 215, 'Denizli', 'DEN', 0, 1),
(3242, 215, 'DiyarbakÄ±r', 'DIY', 0, 1),
(3243, 215, 'DÃ¼zce', 'DUZ', 0, 1),
(3244, 215, 'Edirne', 'EDI', 0, 1),
(3245, 215, 'ElazÄ±ÄŸ', 'ELA', 0, 1),
(3246, 215, 'Erzincan', 'EZC', 0, 1),
(3247, 215, 'Erzurum', 'EZR', 0, 1),
(3248, 215, 'EskiÅŸehir', 'ESK', 0, 1),
(3249, 215, 'Gaziantep', 'GAZ', 0, 1),
(3250, 215, 'Giresun', 'GIR', 0, 1),
(3251, 215, 'GÃ¼mÃ¼ÅŸhane', 'GMS', 0, 1),
(3252, 215, 'Hakkari', 'HKR', 0, 1),
(3253, 215, 'Hatay', 'HTY', 0, 1),
(3254, 215, 'IÄŸdÄ±r', 'IGD', 0, 1),
(3255, 215, 'Isparta', 'ISP', 0, 1),
(3256, 215, 'Ä°stanbul', 'IST', 0, 1),
(3257, 215, 'Ä°zmir', 'IZM', 0, 1),
(3258, 215, 'KahramanmaraÅŸ', 'KAH', 0, 1),
(3259, 215, 'KarabÃ¼k', 'KRB', 0, 1),
(3260, 215, 'Karaman', 'KRM', 0, 1),
(3261, 215, 'Kars', 'KRS', 0, 1),
(3262, 215, 'Kastamonu', 'KAS', 0, 1),
(3263, 215, 'Kayseri', 'KAY', 0, 1),
(3264, 215, 'Kilis', 'KLS', 0, 1),
(3265, 215, 'KÄ±rÄ±kkale', 'KRK', 0, 1),
(3266, 215, 'KÄ±rklareli', 'KLR', 0, 1),
(3267, 215, 'KÄ±rÅŸehir', 'KRH', 0, 1),
(3268, 215, 'Kocaeli', 'KOC', 0, 1),
(3269, 215, 'Konya', 'KON', 0, 1),
(3270, 215, 'KÃ¼tahya', 'KUT', 0, 1),
(3271, 215, 'Malatya', 'MAL', 0, 1),
(3272, 215, 'Manisa', 'MAN', 0, 1),
(3273, 215, 'Mardin', 'MAR', 0, 1),
(3274, 215, 'Mersin', 'MER', 0, 1),
(3275, 215, 'MuÄŸla', 'MUG', 0, 1),
(3276, 215, 'MuÅŸ', 'MUS', 0, 1),
(3277, 215, 'NevÅŸehir', 'NEV', 0, 1),
(3278, 215, 'NiÄŸde', 'NIG', 0, 1),
(3279, 215, 'Ordu', 'ORD', 0, 1),
(3280, 215, 'Osmaniye', 'OSM', 0, 1),
(3281, 215, 'Rize', 'RIZ', 0, 1),
(3282, 215, 'Sakarya', 'SAK', 0, 1),
(3283, 215, 'Samsun', 'SAM', 0, 1),
(3284, 215, 'ÅžanlÄ±urfa', 'SAN', 0, 1),
(3285, 215, 'Siirt', 'SII', 0, 1),
(3286, 215, 'Sinop', 'SIN', 0, 1),
(3287, 215, 'ÅžÄ±rnak', 'SIR', 0, 1),
(3288, 215, 'Sivas', 'SIV', 0, 1),
(3289, 215, 'TekirdaÄŸ', 'TEL', 0, 1),
(3290, 215, 'Tokat', 'TOK', 0, 1),
(3291, 215, 'Trabzon', 'TRA', 0, 1),
(3292, 215, 'Tunceli', 'TUN', 0, 1),
(3293, 215, 'UÅŸak', 'USK', 0, 1),
(3294, 215, 'Van', 'VAN', 0, 1),
(3295, 215, 'Yalova', 'YAL', 0, 1),
(3296, 215, 'Yozgat', 'YOZ', 0, 1),
(3297, 215, 'Zonguldak', 'ZON', 0, 1),
(3298, 216, 'Ahal Welayaty', 'A', 0, 1),
(3299, 216, 'Balkan Welayaty', 'B', 0, 1),
(3300, 216, 'Dashhowuz Welayaty', 'D', 0, 1),
(3301, 216, 'Lebap Welayaty', 'L', 0, 1),
(3302, 216, 'Mary Welayaty', 'M', 0, 1),
(3303, 217, 'Ambergris Cays', 'AC', 0, 1),
(3304, 217, 'Dellis Cay', 'DC', 0, 1),
(3305, 217, 'French Cay', 'FC', 0, 1),
(3306, 217, 'Little Water Cay', 'LW', 0, 1),
(3307, 217, 'Parrot Cay', 'RC', 0, 1),
(3308, 217, 'Pine Cay', 'PN', 0, 1),
(3309, 217, 'Salt Cay', 'SL', 0, 1),
(3310, 217, 'Grand Turk', 'GT', 0, 1),
(3311, 217, 'South Caicos', 'SC', 0, 1),
(3312, 217, 'East Caicos', 'EC', 0, 1),
(3313, 217, 'Middle Caicos', 'MC', 0, 1),
(3314, 217, 'North Caicos', 'NC', 0, 1),
(3315, 217, 'Providenciales', 'PR', 0, 1),
(3316, 217, 'West Caicos', 'WC', 0, 1),
(3317, 218, 'Nanumanga', 'NMG', 0, 1),
(3318, 218, 'Niulakita', 'NLK', 0, 1),
(3319, 218, 'Niutao', 'NTO', 0, 1),
(3320, 218, 'Funafuti', 'FUN', 0, 1),
(3321, 218, 'Nanumea', 'NME', 0, 1),
(3322, 218, 'Nui', 'NUI', 0, 1),
(3323, 218, 'Nukufetau', 'NFT', 0, 1),
(3324, 218, 'Nukulaelae', 'NLL', 0, 1),
(3325, 218, 'Vaitupu', 'VAI', 0, 1),
(3326, 219, 'Kalangala', 'KAL', 0, 1),
(3327, 219, 'Kampala', 'KMP', 0, 1),
(3328, 219, 'Kayunga', 'KAY', 0, 1),
(3329, 219, 'Kiboga', 'KIB', 0, 1),
(3330, 219, 'Luwero', 'LUW', 0, 1),
(3331, 219, 'Masaka', 'MAS', 0, 1),
(3332, 219, 'Mpigi', 'MPI', 0, 1),
(3333, 219, 'Mubende', 'MUB', 0, 1),
(3334, 219, 'Mukono', 'MUK', 0, 1),
(3335, 219, 'Nakasongola', 'NKS', 0, 1),
(3336, 219, 'Rakai', 'RAK', 0, 1),
(3337, 219, 'Sembabule', 'SEM', 0, 1),
(3338, 219, 'Wakiso', 'WAK', 0, 1),
(3339, 219, 'Bugiri', 'BUG', 0, 1),
(3340, 219, 'Busia', 'BUS', 0, 1),
(3341, 219, 'Iganga', 'IGA', 0, 1),
(3342, 219, 'Jinja', 'JIN', 0, 1),
(3343, 219, 'Kaberamaido', 'KAB', 0, 1),
(3344, 219, 'Kamuli', 'KML', 0, 1),
(3345, 219, 'Kapchorwa', 'KPC', 0, 1),
(3346, 219, 'Katakwi', 'KTK', 0, 1),
(3347, 219, 'Kumi', 'KUM', 0, 1),
(3348, 219, 'Mayuge', 'MAY', 0, 1),
(3349, 219, 'Mbale', 'MBA', 0, 1),
(3350, 219, 'Pallisa', 'PAL', 0, 1),
(3351, 219, 'Sironko', 'SIR', 0, 1),
(3352, 219, 'Soroti', 'SOR', 0, 1),
(3353, 219, 'Tororo', 'TOR', 0, 1),
(3354, 219, 'Adjumani', 'ADJ', 0, 1),
(3355, 219, 'Apac', 'APC', 0, 1),
(3356, 219, 'Arua', 'ARU', 0, 1),
(3357, 219, 'Gulu', 'GUL', 0, 1),
(3358, 219, 'Kitgum', 'KIT', 0, 1),
(3359, 219, 'Kotido', 'KOT', 0, 1),
(3360, 219, 'Lira', 'LIR', 0, 1),
(3361, 219, 'Moroto', 'MRT', 0, 1),
(3362, 219, 'Moyo', 'MOY', 0, 1),
(3363, 219, 'Nakapiripirit', 'NAK', 0, 1),
(3364, 219, 'Nebbi', 'NEB', 0, 1),
(3365, 219, 'Pader', 'PAD', 0, 1),
(3366, 219, 'Yumbe', 'YUM', 0, 1),
(3367, 219, 'Bundibugyo', 'BUN', 0, 1),
(3368, 219, 'Bushenyi', 'BSH', 0, 1),
(3369, 219, 'Hoima', 'HOI', 0, 1),
(3370, 219, 'Kabale', 'KBL', 0, 1),
(3371, 219, 'Kabarole', 'KAR', 0, 1),
(3372, 219, 'Kamwenge', 'KAM', 0, 1),
(3373, 219, 'Kanungu', 'KAN', 0, 1),
(3374, 219, 'Kasese', 'KAS', 0, 1),
(3375, 219, 'Kibaale', 'KBA', 0, 1),
(3376, 219, 'Kisoro', 'KIS', 0, 1),
(3377, 219, 'Kyenjojo', 'KYE', 0, 1),
(3378, 219, 'Masindi', 'MSN', 0, 1),
(3379, 219, 'Mbarara', 'MBR', 0, 1),
(3380, 219, 'Ntungamo', 'NTU', 0, 1),
(3381, 219, 'Rukungiri', 'RUK', 0, 1),
(3382, 220, 'Cherkas\'ka Oblast\'', '71', 0, 1),
(3383, 220, 'Chernihivs\'ka Oblast\'', '74', 0, 1),
(3384, 220, 'Chernivets\'ka Oblast\'', '77', 0, 1),
(3385, 220, 'Crimea', '43', 0, 1),
(3386, 220, 'Dnipropetrovs\'ka Oblast\'', '12', 0, 1),
(3387, 220, 'Donets\'ka Oblast\'', '14', 0, 1),
(3388, 220, 'Ivano-Frankivs\'ka Oblast\'', '26', 0, 1),
(3389, 220, 'Khersons\'ka Oblast\'', '65', 0, 1),
(3390, 220, 'Khmel\'nyts\'ka Oblast\'', '68', 0, 1),
(3391, 220, 'Kirovohrads\'ka Oblast\'', '35', 0, 1),
(3392, 220, 'Kyiv', '30', 0, 1),
(3393, 220, 'Kyivs\'ka Oblast\'', '32', 0, 1),
(3394, 220, 'Luhans\'ka Oblast\'', '09', 0, 1),
(3395, 220, 'L\'vivs\'ka Oblast\'', '46', 0, 1),
(3396, 220, 'Mykolayivs\'ka Oblast\'', '48', 0, 1),
(3397, 220, 'Odes\'ka Oblast\'', '51', 0, 1),
(3398, 220, 'Poltavs\'ka Oblast\'', '53', 0, 1),
(3399, 220, 'Rivnens\'ka Oblast\'', '56', 0, 1),
(3400, 220, 'Sevastopol\'', '40', 0, 1),
(3401, 220, 'Sums\'ka Oblast\'', '59', 0, 1),
(3402, 220, 'Ternopil\'s\'ka Oblast\'', '61', 0, 1),
(3403, 220, 'Vinnyts\'ka Oblast\'', '05', 0, 1),
(3404, 220, 'Volyns\'ka Oblast\'', '07', 0, 1),
(3405, 220, 'Zakarpats\'ka Oblast\'', '21', 0, 1),
(3406, 220, 'Zaporiz\'ka Oblast\'', '23', 0, 1),
(3407, 220, 'Zhytomyrs\'ka oblast\'', '18', 0, 1),
(3408, 221, 'Abu Dhabi', 'ADH', 0, 1),
(3409, 221, '\'Ajman', 'AJ', 0, 1),
(3410, 221, 'Al Fujayrah', 'FU', 0, 1),
(3411, 221, 'Ash Shariqah', 'SH', 0, 1),
(3412, 221, 'Dubai', 'DU', 0, 1),
(3413, 221, 'R\'as al Khaymah', 'RK', 0, 1),
(3414, 221, 'Umm al Qaywayn', 'UQ', 0, 1),
(3415, 222, 'Aberdeen', 'ABN', 0, 1),
(3416, 222, 'Aberdeenshire', 'ABNS', 0, 1),
(3417, 222, 'Anglesey', 'ANG', 0, 1),
(3418, 222, 'Angus', 'AGS', 0, 1),
(3419, 222, 'Argyll and Bute', 'ARY', 0, 1),
(3420, 222, 'Bedfordshire', 'BEDS', 0, 1),
(3421, 222, 'Berkshire', 'BERKS', 0, 1),
(3422, 222, 'Blaenau Gwent', 'BLA', 0, 1),
(3423, 222, 'Bridgend', 'BRI', 0, 1),
(3424, 222, 'Bristol', 'BSTL', 0, 1),
(3425, 222, 'Buckinghamshire', 'BUCKS', 0, 1),
(3426, 222, 'Caerphilly', 'CAE', 0, 1),
(3427, 222, 'Cambridgeshire', 'CAMBS', 0, 1),
(3428, 222, 'Cardiff', 'CDF', 0, 1),
(3429, 222, 'Carmarthenshire', 'CARM', 0, 1),
(3430, 222, 'Ceredigion', 'CDGN', 0, 1),
(3431, 222, 'Cheshire', 'CHES', 0, 1),
(3432, 222, 'Clackmannanshire', 'CLACK', 0, 1),
(3433, 222, 'Conwy', 'CON', 0, 1),
(3434, 222, 'Cornwall', 'CORN', 0, 1),
(3435, 222, 'Denbighshire', 'DNBG', 0, 1),
(3436, 222, 'Derbyshire', 'DERBY', 0, 1),
(3437, 222, 'Devon', 'DVN', 0, 1),
(3438, 222, 'Dorset', 'DOR', 0, 1),
(3439, 222, 'Dumfries and Galloway', 'DGL', 0, 1),
(3440, 222, 'Dundee', 'DUND', 0, 1),
(3441, 222, 'Durham', 'DHM', 0, 1),
(3442, 222, 'East Ayrshire', 'ARYE', 0, 1),
(3443, 222, 'East Dunbartonshire', 'DUNBE', 0, 1),
(3444, 222, 'East Lothian', 'LOTE', 0, 1),
(3445, 222, 'East Renfrewshire', 'RENE', 0, 1),
(3446, 222, 'East Riding of Yorkshire', 'ERYS', 0, 1),
(3447, 222, 'East Sussex', 'SXE', 0, 1),
(3448, 222, 'Edinburgh', 'EDIN', 0, 1),
(3449, 222, 'Essex', 'ESX', 0, 1),
(3450, 222, 'Falkirk', 'FALK', 0, 1),
(3451, 222, 'Fife', 'FFE', 0, 1),
(3452, 222, 'Flintshire', 'FLINT', 0, 1),
(3453, 222, 'Glasgow', 'GLAS', 0, 1),
(3454, 222, 'Gloucestershire', 'GLOS', 0, 1),
(3455, 222, 'Greater London', 'LDN', 0, 1),
(3456, 222, 'Greater Manchester', 'MCH', 0, 1),
(3457, 222, 'Gwynedd', 'GDD', 0, 1),
(3458, 222, 'Hampshire', 'HANTS', 0, 1),
(3459, 222, 'Herefordshire', 'HWR', 0, 1),
(3460, 222, 'Hertfordshire', 'HERTS', 0, 1),
(3461, 222, 'Highlands', 'HLD', 0, 1),
(3462, 222, 'Inverclyde', 'IVER', 0, 1),
(3463, 222, 'Isle of Wight', 'IOW', 0, 1),
(3464, 222, 'Kent', 'KNT', 0, 1),
(3465, 222, 'Lancashire', 'LANCS', 0, 1),
(3466, 222, 'Leicestershire', 'LEICS', 0, 1),
(3467, 222, 'Lincolnshire', 'LINCS', 0, 1),
(3468, 222, 'Merseyside', 'MSY', 0, 1),
(3469, 222, 'Merthyr Tydfil', 'MERT', 0, 1),
(3470, 222, 'Midlothian', 'MLOT', 0, 1),
(3471, 222, 'Monmouthshire', 'MMOUTH', 0, 1),
(3472, 222, 'Moray', 'MORAY', 0, 1),
(3473, 222, 'Neath Port Talbot', 'NPRTAL', 0, 1),
(3474, 222, 'Newport', 'NEWPT', 0, 1),
(3475, 222, 'Norfolk', 'NOR', 0, 1),
(3476, 222, 'North Ayrshire', 'ARYN', 0, 1),
(3477, 222, 'North Lanarkshire', 'LANN', 0, 1),
(3478, 222, 'North Yorkshire', 'YSN', 0, 1),
(3479, 222, 'Northamptonshire', 'NHM', 0, 1),
(3480, 222, 'Northumberland', 'NLD', 0, 1),
(3481, 222, 'Nottinghamshire', 'NOT', 0, 1),
(3482, 222, 'Orkney Islands', 'ORK', 0, 1),
(3483, 222, 'Oxfordshire', 'OFE', 0, 1),
(3484, 222, 'Pembrokeshire', 'PEM', 0, 1),
(3485, 222, 'Perth and Kinross', 'PERTH', 0, 1),
(3486, 222, 'Powys', 'PWS', 0, 1),
(3487, 222, 'Renfrewshire', 'REN', 0, 1),
(3488, 222, 'Rhondda Cynon Taff', 'RHON', 0, 1),
(3489, 222, 'Rutland', 'RUT', 0, 1),
(3490, 222, 'Scottish Borders', 'BOR', 0, 1),
(3491, 222, 'Shetland Islands', 'SHET', 0, 1),
(3492, 222, 'Shropshire', 'SPE', 0, 1),
(3493, 222, 'Somerset', 'SOM', 0, 1),
(3494, 222, 'South Ayrshire', 'ARYS', 0, 1),
(3495, 222, 'South Lanarkshire', 'LANS', 0, 1),
(3496, 222, 'South Yorkshire', 'YSS', 0, 1),
(3497, 222, 'Staffordshire', 'SFD', 0, 1),
(3498, 222, 'Stirling', 'STIR', 0, 1),
(3499, 222, 'Suffolk', 'SFK', 0, 1),
(3500, 222, 'Surrey', 'SRY', 0, 1),
(3501, 222, 'Swansea', 'SWAN', 0, 1),
(3502, 222, 'Torfaen', 'TORF', 0, 1),
(3503, 222, 'Tyne and Wear', 'TWR', 0, 1),
(3504, 222, 'Vale of Glamorgan', 'VGLAM', 0, 1),
(3505, 222, 'Warwickshire', 'WARKS', 0, 1),
(3506, 222, 'West Dunbartonshire', 'WDUN', 0, 1),
(3507, 222, 'West Lothian', 'WLOT', 0, 1),
(3508, 222, 'West Midlands', 'WMD', 0, 1),
(3509, 222, 'West Sussex', 'SXW', 0, 1),
(3510, 222, 'West Yorkshire', 'YSW', 0, 1),
(3511, 222, 'Western Isles', 'WIL', 0, 1),
(3512, 222, 'Wiltshire', 'WLT', 0, 1),
(3513, 222, 'Worcestershire', 'WORCS', 0, 1),
(3514, 222, 'Wrexham', 'WRX', 0, 1),
(3515, 223, 'Alabama', 'AL', 0, 1),
(3516, 223, 'Alaska', 'AK', 0, 1),
(3517, 223, 'American Samoa', 'AS', 0, 1),
(3518, 223, 'Arizona', 'AZ', 0, 1),
(3519, 223, 'Arkansas', 'AR', 0, 1),
(3520, 223, 'Armed Forces Africa', 'AF', 0, 1),
(3521, 223, 'Armed Forces Americas', 'AA', 0, 1),
(3522, 223, 'Armed Forces Canada', 'AC', 0, 1),
(3523, 223, 'Armed Forces Europe', 'AE', 0, 1),
(3524, 223, 'Armed Forces Middle East', 'AM', 0, 1),
(3525, 223, 'Armed Forces Pacific', 'AP', 0, 1),
(3526, 223, 'California', 'CA', 0, 1),
(3527, 223, 'Colorado', 'CO', 0, 1),
(3528, 223, 'Connecticut', 'CT', 0, 1),
(3529, 223, 'Delaware', 'DE', 0, 1),
(3530, 223, 'District of Columbia', 'DC', 0, 1),
(3531, 223, 'Federated States Of Micronesia', 'FM', 0, 1),
(3532, 223, 'Florida', 'FL', 0, 1),
(3533, 223, 'Georgia', 'GA', 0, 1),
(3534, 223, 'Guam', 'GU', 0, 1),
(3535, 223, 'Hawaii', 'HI', 0, 1),
(3536, 223, 'Idaho', 'ID', 0, 1),
(3537, 223, 'Illinois', 'IL', 0, 1),
(3538, 223, 'Indiana', 'IN', 0, 1),
(3539, 223, 'Iowa', 'IA', 0, 1),
(3540, 223, 'Kansas', 'KS', 0, 1),
(3541, 223, 'Kentucky', 'KY', 0, 1),
(3542, 223, 'Louisiana', 'LA', 0, 1),
(3543, 223, 'Maine', 'ME', 0, 1),
(3544, 223, 'Marshall Islands', 'MH', 0, 1),
(3545, 223, 'Maryland', 'MD', 0, 1),
(3546, 223, 'Massachusetts', 'MA', 0, 1),
(3547, 223, 'Michigan', 'MI', 0, 1),
(3548, 223, 'Minnesota', 'MN', 0, 1),
(3549, 223, 'Mississippi', 'MS', 0, 1),
(3550, 223, 'Missouri', 'MO', 0, 1),
(3551, 223, 'Montana', 'MT', 0, 1),
(3552, 223, 'Nebraska', 'NE', 0, 1),
(3553, 223, 'Nevada', 'NV', 0, 1),
(3554, 223, 'New Hampshire', 'NH', 0, 1),
(3555, 223, 'New Jersey', 'NJ', 0, 1),
(3556, 223, 'New Mexico', 'NM', 0, 1),
(3557, 223, 'New York', 'NY', 0, 1),
(3558, 223, 'North Carolina', 'NC', 0, 1),
(3559, 223, 'North Dakota', 'ND', 0, 1),
(3560, 223, 'Northern Mariana Islands', 'MP', 0, 1),
(3561, 223, 'Ohio', 'OH', 0, 1),
(3562, 223, 'Oklahoma', 'OK', 0, 1),
(3563, 223, 'Oregon', 'OR', 0, 1),
(3564, 223, 'Palau', 'PW', 0, 1),
(3565, 223, 'Pennsylvania', 'PA', 0, 1),
(3566, 223, 'Puerto Rico', 'PR', 0, 1),
(3567, 223, 'Rhode Island', 'RI', 0, 1),
(3568, 223, 'South Carolina', 'SC', 0, 1),
(3569, 223, 'South Dakota', 'SD', 0, 1),
(3570, 223, 'Tennessee', 'TN', 0, 1),
(3571, 223, 'Texas', 'TX', 0, 1),
(3572, 223, 'Utah', 'UT', 0, 1),
(3573, 223, 'Vermont', 'VT', 0, 1),
(3574, 223, 'Virgin Islands', 'VI', 0, 1),
(3575, 223, 'Virginia', 'VA', 0, 1),
(3576, 223, 'Washington', 'WA', 0, 1),
(3577, 223, 'West Virginia', 'WV', 0, 1),
(3578, 223, 'Wisconsin', 'WI', 0, 1),
(3579, 223, 'Wyoming', 'WY', 0, 1),
(3580, 224, 'Baker Island', 'BI', 0, 1),
(3581, 224, 'Howland Island', 'HI', 0, 1),
(3582, 224, 'Jarvis Island', 'JI', 0, 1),
(3583, 224, 'Johnston Atoll', 'JA', 0, 1),
(3584, 224, 'Kingman Reef', 'KR', 0, 1),
(3585, 224, 'Midway Atoll', 'MA', 0, 1),
(3586, 224, 'Navassa Island', 'NI', 0, 1),
(3587, 224, 'Palmyra Atoll', 'PA', 0, 1),
(3588, 224, 'Wake Island', 'WI', 0, 1),
(3589, 225, 'Artigas', 'AR', 0, 1),
(3590, 225, 'Canelones', 'CA', 0, 1),
(3591, 225, 'Cerro Largo', 'CL', 0, 1),
(3592, 225, 'Colonia', 'CO', 0, 1),
(3593, 225, 'Durazno', 'DU', 0, 1),
(3594, 225, 'Flores', 'FS', 0, 1),
(3595, 225, 'Florida', 'FA', 0, 1),
(3596, 225, 'Lavalleja', 'LA', 0, 1),
(3597, 225, 'Maldonado', 'MA', 0, 1),
(3598, 225, 'Montevideo', 'MO', 0, 1),
(3599, 225, 'Paysandu', 'PA', 0, 1),
(3600, 225, 'Rio Negro', 'RN', 0, 1),
(3601, 225, 'Rivera', 'RV', 0, 1),
(3602, 225, 'Rocha', 'RO', 0, 1),
(3603, 225, 'Salto', 'SL', 0, 1),
(3604, 225, 'San Jose', 'SJ', 0, 1),
(3605, 225, 'Soriano', 'SO', 0, 1),
(3606, 225, 'Tacuarembo', 'TA', 0, 1),
(3607, 225, 'Treinta y Tres', 'TT', 0, 1),
(3608, 226, 'Andijon', 'AN', 0, 1),
(3609, 226, 'Buxoro', 'BU', 0, 1),
(3610, 226, 'Farg\'ona', 'FA', 0, 1),
(3611, 226, 'Jizzax', 'JI', 0, 1),
(3612, 226, 'Namangan', 'NG', 0, 1),
(3613, 226, 'Navoiy', 'NW', 0, 1),
(3614, 226, 'Qashqadaryo', 'QA', 0, 1),
(3615, 226, 'Qoraqalpog\'iston Republikasi', 'QR', 0, 1),
(3616, 226, 'Samarqand', 'SA', 0, 1),
(3617, 226, 'Sirdaryo', 'SI', 0, 1),
(3618, 226, 'Surxondaryo', 'SU', 0, 1),
(3619, 226, 'Toshkent City', 'TK', 0, 1),
(3620, 226, 'Toshkent Region', 'TO', 0, 1),
(3621, 226, 'Xorazm', 'XO', 0, 1),
(3622, 227, 'Malampa', 'MA', 0, 1),
(3623, 227, 'Penama', 'PE', 0, 1),
(3624, 227, 'Sanma', 'SA', 0, 1),
(3625, 227, 'Shefa', 'SH', 0, 1),
(3626, 227, 'Tafea', 'TA', 0, 1),
(3627, 227, 'Torba', 'TO', 0, 1),
(3628, 229, 'Amazonas', 'AM', 0, 1),
(3629, 229, 'Anzoategui', 'AN', 0, 1),
(3630, 229, 'Apure', 'AP', 0, 1),
(3631, 229, 'Aragua', 'AR', 0, 1),
(3632, 229, 'Barinas', 'BA', 0, 1),
(3633, 229, 'Bolivar', 'BO', 0, 1),
(3634, 229, 'Carabobo', 'CA', 0, 1),
(3635, 229, 'Cojedes', 'CO', 0, 1),
(3636, 229, 'Delta Amacuro', 'DA', 0, 1),
(3637, 229, 'Dependencias Federales', 'DF', 0, 1),
(3638, 229, 'Distrito Federal', 'DI', 0, 1),
(3639, 229, 'Falcon', 'FA', 0, 1),
(3640, 229, 'Guarico', 'GU', 0, 1),
(3641, 229, 'Lara', 'LA', 0, 1),
(3642, 229, 'Merida', 'ME', 0, 1),
(3643, 229, 'Miranda', 'MI', 0, 1),
(3644, 229, 'Monagas', 'MO', 0, 1),
(3645, 229, 'Nueva Esparta', 'NE', 0, 1),
(3646, 229, 'Portuguesa', 'PO', 0, 1),
(3647, 229, 'Sucre', 'SU', 0, 1),
(3648, 229, 'Tachira', 'TA', 0, 1),
(3649, 229, 'Trujillo', 'TR', 0, 1),
(3650, 229, 'Vargas', 'VA', 0, 1),
(3651, 229, 'Yaracuy', 'YA', 0, 1),
(3652, 229, 'Zulia', 'ZU', 0, 1),
(3653, 230, 'An Giang', 'AG', 0, 1),
(3654, 230, 'Bac Giang', 'BG', 0, 1),
(3655, 230, 'Bac Kan', 'BK', 0, 1),
(3656, 230, 'Bac Lieu', 'BL', 0, 1),
(3657, 230, 'Bac Ninh', 'BC', 0, 1),
(3658, 230, 'Ba Ria-Vung Tau', 'BR', 0, 1),
(3659, 230, 'Ben Tre', 'BN', 0, 1),
(3660, 230, 'Binh Dinh', 'BH', 0, 1),
(3661, 230, 'Binh Duong', 'BU', 0, 1),
(3662, 230, 'Binh Phuoc', 'BP', 0, 1),
(3663, 230, 'Binh Thuan', 'BT', 0, 1),
(3664, 230, 'Ca Mau', 'CM', 0, 1),
(3665, 230, 'Can Tho', 'CT', 0, 1),
(3666, 230, 'Cao Bang', 'CB', 0, 1),
(3667, 230, 'Dak Lak', 'DL', 0, 1),
(3668, 230, 'Dak Nong', 'DG', 0, 1),
(3669, 230, 'Da Nang', 'DN', 0, 1),
(3670, 230, 'Dien Bien', 'DB', 0, 1),
(3671, 230, 'Dong Nai', 'DI', 0, 1),
(3672, 230, 'Dong Thap', 'DT', 0, 1),
(3673, 230, 'Gia Lai', 'GL', 0, 1),
(3674, 230, 'Ha Giang', 'HG', 0, 1),
(3675, 230, 'Hai Duong', 'HD', 0, 1),
(3676, 230, 'Hai Phong', 'HP', 0, 1),
(3677, 230, 'Ha Nam', 'HM', 0, 1),
(3678, 230, 'Ha Noi', 'HI', 0, 1),
(3679, 230, 'Ha Tay', 'HT', 0, 1),
(3680, 230, 'Ha Tinh', 'HH', 0, 1),
(3681, 230, 'Hoa Binh', 'HB', 0, 1),
(3682, 230, 'Ho Chi Minh City', 'HC', 0, 1),
(3683, 230, 'Hau Giang', 'HU', 0, 1),
(3684, 230, 'Hung Yen', 'HY', 0, 1),
(3685, 232, 'Saint Croix', 'C', 0, 1),
(3686, 232, 'Saint John', 'J', 0, 1),
(3687, 232, 'Saint Thomas', 'T', 0, 1),
(3688, 233, 'Alo', 'A', 0, 1),
(3689, 233, 'Sigave', 'S', 0, 1),
(3690, 233, 'Wallis', 'W', 0, 1),
(3691, 235, 'Abyan', 'AB', 0, 1),
(3692, 235, 'Adan', 'AD', 0, 1),
(3693, 235, 'Amran', 'AM', 0, 1),
(3694, 235, 'Al Bayda', 'BA', 0, 1),
(3695, 235, 'Ad Dali', 'DA', 0, 1),
(3696, 235, 'Dhamar', 'DH', 0, 1),
(3697, 235, 'Hadramawt', 'HD', 0, 1),
(3698, 235, 'Hajjah', 'HJ', 0, 1),
(3699, 235, 'Al Hudaydah', 'HU', 0, 1),
(3700, 235, 'Ibb', 'IB', 0, 1),
(3701, 235, 'Al Jawf', 'JA', 0, 1),
(3702, 235, 'Lahij', 'LA', 0, 1),
(3703, 235, 'Ma\'rib', 'MA', 0, 1),
(3704, 235, 'Al Mahrah', 'MR', 0, 1),
(3705, 235, 'Al Mahwit', 'MW', 0, 1),
(3706, 235, 'Sa\'dah', 'SD', 0, 1),
(3707, 235, 'San\'a', 'SN', 0, 1),
(3708, 235, 'Shabwah', 'SH', 0, 1),
(3709, 235, 'Ta\'izz', 'TA', 0, 1),
(3710, 237, 'Bas-Congo', 'BC', 0, 1),
(3711, 237, 'Bandundu', 'BN', 0, 1),
(3712, 237, 'Equateur', 'EQ', 0, 1),
(3713, 237, 'Katanga', 'KA', 0, 1),
(3714, 237, 'Kasai-Oriental', 'KE', 0, 1),
(3715, 237, 'Kinshasa', 'KN', 0, 1),
(3716, 237, 'Kasai-Occidental', 'KW', 0, 1),
(3717, 237, 'Maniema', 'MA', 0, 1),
(3718, 237, 'Nord-Kivu', 'NK', 0, 1),
(3719, 237, 'Orientale', 'OR', 0, 1),
(3720, 237, 'Sud-Kivu', 'SK', 0, 1),
(3721, 238, 'Central', 'CE', 0, 1),
(3722, 238, 'Copperbelt', 'CB', 0, 1),
(3723, 238, 'Eastern', 'EA', 0, 1),
(3724, 238, 'Luapula', 'LP', 0, 1),
(3725, 238, 'Lusaka', 'LK', 0, 1),
(3726, 238, 'Northern', 'NO', 0, 1),
(3727, 238, 'North-Western', 'NW', 0, 1),
(3728, 238, 'Southern', 'SO', 0, 1),
(3729, 238, 'Western', 'WE', 0, 1),
(3730, 239, 'Bulawayo', 'BU', 0, 1),
(3731, 239, 'Harare', 'HA', 0, 1),
(3732, 239, 'Manicaland', 'ML', 0, 1),
(3733, 239, 'Mashonaland Central', 'MC', 0, 1),
(3734, 239, 'Mashonaland East', 'ME', 0, 1),
(3735, 239, 'Mashonaland West', 'MW', 0, 1),
(3736, 239, 'Masvingo', 'MV', 0, 1),
(3737, 239, 'Matabeleland North', 'MN', 0, 1),
(3738, 239, 'Matabeleland South', 'MS', 0, 1),
(3739, 239, 'Midlands', 'MD', 0, 1),
(3740, 105, 'Campobasso', 'CB', 0, 1),
(3741, 105, 'Caserta', 'CE', 0, 1),
(3742, 105, 'Catania', 'CT', 0, 1),
(3743, 105, 'Catanzaro', 'CZ', 0, 1),
(3744, 105, 'Chieti', 'CH', 0, 1),
(3745, 105, 'Como', 'CO', 0, 1),
(3746, 105, 'Cosenza', 'CS', 0, 1),
(3747, 105, 'Cremona', 'CR', 0, 1),
(3748, 105, 'Crotone', 'KR', 0, 1),
(3749, 105, 'Cuneo', 'CN', 0, 1),
(3750, 105, 'Enna', 'EN', 0, 1),
(3751, 105, 'Ferrara', 'FE', 0, 1),
(3752, 105, 'Firenze', 'FI', 0, 1),
(3753, 105, 'Foggia', 'FG', 0, 1),
(3754, 105, 'Forli-Cesena', 'FC', 0, 1),
(3755, 105, 'Frosinone', 'FR', 0, 1),
(3756, 105, 'Genova', 'GE', 0, 1),
(3757, 105, 'Gorizia', 'GO', 0, 1),
(3758, 105, 'Grosseto', 'GR', 0, 1),
(3759, 105, 'Imperia', 'IM', 0, 1),
(3760, 105, 'Isernia', 'IS', 0, 1),
(3761, 105, 'L&#39;Aquila', 'AQ', 0, 1),
(3762, 105, 'La Spezia', 'SP', 0, 1),
(3763, 105, 'Latina', 'LT', 0, 1),
(3764, 105, 'Lecce', 'LE', 0, 1),
(3765, 105, 'Lecco', 'LC', 0, 1),
(3766, 105, 'Livorno', 'LI', 0, 1),
(3767, 105, 'Lodi', 'LO', 0, 1),
(3768, 105, 'Lucca', 'LU', 0, 1),
(3769, 105, 'Macerata', 'MC', 0, 1),
(3770, 105, 'Mantova', 'MN', 0, 1),
(3771, 105, 'Massa-Carrara', 'MS', 0, 1),
(3772, 105, 'Matera', 'MT', 0, 1),
(3773, 105, 'Messina', 'ME', 0, 1),
(3774, 105, 'Milano', 'MI', 0, 1),
(3775, 105, 'Modena', 'MO', 0, 1),
(3776, 105, 'Napoli', 'NA', 0, 1),
(3777, 105, 'Novara', 'NO', 0, 1),
(3778, 105, 'Nuoro', 'NU', 0, 1),
(3779, 105, 'Oristano', 'OR', 0, 1),
(3780, 105, 'Padova', 'PD', 0, 1),
(3781, 105, 'Palermo', 'PA', 0, 1),
(3782, 105, 'Parma', 'PR', 0, 1),
(3783, 105, 'Pavia', 'PV', 0, 1),
(3784, 105, 'Perugia', 'PG', 0, 1),
(3785, 105, 'Pesaro e Urbino', 'PU', 0, 1),
(3786, 105, 'Pescara', 'PE', 0, 1),
(3787, 105, 'Piacenza', 'PC', 0, 1),
(3788, 105, 'Pisa', 'PI', 0, 1),
(3789, 105, 'Pistoia', 'PT', 0, 1),
(3790, 105, 'Pordenone', 'PN', 0, 1),
(3791, 105, 'Potenza', 'PZ', 0, 1),
(3792, 105, 'Prato', 'PO', 0, 1),
(3793, 105, 'Ragusa', 'RG', 0, 1),
(3794, 105, 'Ravenna', 'RA', 0, 1),
(3795, 105, 'Reggio Calabria', 'RC', 0, 1),
(3796, 105, 'Reggio Emilia', 'RE', 0, 1),
(3797, 105, 'Rieti', 'RI', 0, 1),
(3798, 105, 'Rimini', 'RN', 0, 1),
(3799, 105, 'Roma', 'RM', 0, 1),
(3800, 105, 'Rovigo', 'RO', 0, 1),
(3801, 105, 'Salerno', 'SA', 0, 1),
(3802, 105, 'Sassari', 'SS', 0, 1),
(3803, 105, 'Savona', 'SV', 0, 1),
(3804, 105, 'Siena', 'SI', 0, 1),
(3805, 105, 'Siracusa', 'SR', 0, 1),
(3806, 105, 'Sondrio', 'SO', 0, 1),
(3807, 105, 'Taranto', 'TA', 0, 1),
(3808, 105, 'Teramo', 'TE', 0, 1),
(3809, 105, 'Terni', 'TR', 0, 1),
(3810, 105, 'Torino', 'TO', 0, 1),
(3811, 105, 'Trapani', 'TP', 0, 1),
(3812, 105, 'Trento', 'TN', 0, 1),
(3813, 105, 'Treviso', 'TV', 0, 1),
(3814, 105, 'Trieste', 'TS', 0, 1),
(3815, 105, 'Udine', 'UD', 0, 1),
(3816, 105, 'Varese', 'VA', 0, 1),
(3817, 105, 'Venezia', 'VE', 0, 1),
(3818, 105, 'Verbano-Cusio-Ossola', 'VB', 0, 1),
(3819, 105, 'Vercelli', 'VC', 0, 1),
(3820, 105, 'Verona', 'VR', 0, 1),
(3821, 105, 'Vibo Valentia', 'VV', 0, 1),
(3822, 105, 'Vicenza', 'VI', 0, 1),
(3823, 105, 'Viterbo', 'VT', 0, 1),
(3824, 222, 'County Antrim', 'ANT', 0, 1),
(3825, 222, 'County Armagh', 'ARM', 0, 1),
(3826, 222, 'County Down', 'DOW', 0, 1),
(3827, 222, 'County Fermanagh', 'FER', 0, 1),
(3828, 222, 'County Londonderry', 'LDY', 0, 1),
(3829, 222, 'County Tyrone', 'TYR', 0, 1),
(3830, 222, 'Cumbria', 'CMA', 0, 1),
(3831, 190, 'Pomurska', '1', 0, 1),
(3832, 190, 'Podravska', '2', 0, 1),
(3833, 190, 'KoroÅ¡ka', '3', 0, 1),
(3834, 190, 'Savinjska', '4', 0, 1),
(3835, 190, 'Zasavska', '5', 0, 1),
(3836, 190, 'Spodnjeposavska', '6', 0, 1),
(3837, 190, 'Jugovzhodna Slovenija', '7', 0, 1),
(3838, 190, 'Osrednjeslovenska', '8', 0, 1),
(3839, 190, 'Gorenjska', '9', 0, 1),
(3840, 190, 'Notranjsko-kraÅ¡ka', '10', 0, 1),
(3841, 190, 'GoriÅ¡ka', '11', 0, 1),
(3842, 190, 'Obalno-kraÅ¡ka', '12', 0, 1),
(3843, 33, 'Ruse', '', 0, 1),
(3844, 101, 'Alborz', 'ALB', 0, 1),
(3845, 21, 'Brussels-Capital Region', 'BRU', 0, 1),
(3846, 138, 'Aguascalientes', 'AG', 0, 1),
(3847, 242, 'Andrijevica', '01', 0, 1),
(3848, 242, 'Bar', '02', 0, 1),
(3849, 242, 'Berane', '03', 0, 1),
(3850, 242, 'Bijelo Polje', '04', 0, 1),
(3851, 242, 'Budva', '05', 0, 1),
(3852, 242, 'Cetinje', '06', 0, 1),
(3853, 242, 'Danilovgrad', '07', 0, 1),
(3854, 242, 'Herceg-Novi', '08', 0, 1),
(3855, 242, 'KolaÅ¡in', '09', 0, 1),
(3856, 242, 'Kotor', '10', 0, 1),
(3857, 242, 'Mojkovac', '11', 0, 1),
(3858, 242, 'NikÅ¡iÄ‡', '12', 0, 1),
(3859, 242, 'Plav', '13', 0, 1),
(3860, 242, 'Pljevlja', '14', 0, 1),
(3861, 242, 'PluÅ¾ine', '15', 0, 1),
(3862, 242, 'Podgorica', '16', 0, 1),
(3863, 242, 'RoÅ¾aje', '17', 0, 1),
(3864, 242, 'Å avnik', '18', 0, 1),
(3865, 242, 'Tivat', '19', 0, 1),
(3866, 242, 'Ulcinj', '20', 0, 1),
(3867, 242, 'Å½abljak', '21', 0, 1),
(3868, 243, 'Belgrade', '00', 0, 1),
(3869, 243, 'North BaÄka', '01', 0, 1),
(3870, 243, 'Central Banat', '02', 0, 1),
(3871, 243, 'North Banat', '03', 0, 1),
(3872, 243, 'South Banat', '04', 0, 1),
(3873, 243, 'West BaÄka', '05', 0, 1),
(3874, 243, 'South BaÄka', '06', 0, 1),
(3875, 243, 'Srem', '07', 0, 1),
(3876, 243, 'MaÄva', '08', 0, 1),
(3877, 243, 'Kolubara', '09', 0, 1),
(3878, 243, 'Podunavlje', '10', 0, 1),
(3879, 243, 'BraniÄevo', '11', 0, 1),
(3880, 243, 'Å umadija', '12', 0, 1),
(3881, 243, 'Pomoravlje', '13', 0, 1),
(3882, 243, 'Bor', '14', 0, 1),
(3883, 243, 'ZajeÄar', '15', 0, 1),
(3884, 243, 'Zlatibor', '16', 0, 1),
(3885, 243, 'Moravica', '17', 0, 1),
(3886, 243, 'RaÅ¡ka', '18', 0, 1),
(3887, 243, 'Rasina', '19', 0, 1),
(3888, 243, 'NiÅ¡ava', '20', 0, 1),
(3889, 243, 'Toplica', '21', 0, 1),
(3890, 243, 'Pirot', '22', 0, 1),
(3891, 243, 'Jablanica', '23', 0, 1),
(3892, 243, 'PÄinja', '24', 0, 1),
(3893, 245, 'Bonaire', 'BO', 0, 1),
(3894, 245, 'Saba', 'SA', 0, 1),
(3895, 245, 'Sint Eustatius', 'SE', 0, 1),
(3896, 248, 'Central Equatoria', 'EC', 0, 1),
(3897, 248, 'Eastern Equatoria', 'EE', 0, 1),
(3898, 248, 'Jonglei', 'JG', 0, 1),
(3899, 248, 'Lakes', 'LK', 0, 1),
(3900, 248, 'Northern Bahr el-Ghazal', 'BN', 0, 1),
(3901, 248, 'Unity', 'UY', 0, 1),
(3902, 248, 'Upper Nile', 'NU', 0, 1),
(3903, 248, 'Warrap', 'WR', 0, 1),
(3904, 248, 'Western Bahr el-Ghazal', 'BW', 0, 1),
(3905, 248, 'Western Equatoria', 'EW', 0, 1),
(3906, 117, 'AinaÅ¾i, SalacgrÄ«vas novads', '0661405', 0, 1),
(3907, 117, 'Aizkraukle, Aizkraukles novads', '0320201', 0, 1),
(3908, 117, 'Aizkraukles novads', '0320200', 0, 1),
(3909, 117, 'Aizpute, Aizputes novads', '0640605', 0, 1),
(3910, 117, 'Aizputes novads', '0640600', 0, 1),
(3911, 117, 'AknÄ«ste, AknÄ«stes novads', '0560805', 0, 1),
(3912, 117, 'AknÄ«stes novads', '0560800', 0, 1),
(3913, 117, 'Aloja, Alojas novads', '0661007', 0, 1),
(3914, 117, 'Alojas novads', '0661000', 0, 1),
(3915, 117, 'Alsungas novads', '0624200', 0, 1),
(3916, 117, 'AlÅ«ksne, AlÅ«ksnes novads', '0360201', 0, 1),
(3917, 117, 'AlÅ«ksnes novads', '0360200', 0, 1),
(3918, 117, 'Amatas novads', '0424701', 0, 1),
(3919, 117, 'Ape, Apes novads', '0360805', 0, 1),
(3920, 117, 'Apes novads', '0360800', 0, 1),
(3921, 117, 'Auce, Auces novads', '0460805', 0, 1),
(3922, 117, 'Auces novads', '0460800', 0, 1),
(3923, 117, 'Ä€daÅ¾u novads', '0804400', 0, 1),
(3924, 117, 'BabÄ«tes novads', '0804900', 0, 1),
(3925, 117, 'Baldone, Baldones novads', '0800605', 0, 1),
(3926, 117, 'Baldones novads', '0800600', 0, 1),
(3927, 117, 'BaloÅ¾i, Ä¶ekavas novads', '0800807', 0, 1),
(3928, 117, 'Baltinavas novads', '0384400', 0, 1),
(3929, 117, 'Balvi, Balvu novads', '0380201', 0, 1),
(3930, 117, 'Balvu novads', '0380200', 0, 1),
(3931, 117, 'Bauska, Bauskas novads', '0400201', 0, 1),
(3932, 117, 'Bauskas novads', '0400200', 0, 1),
(3933, 117, 'BeverÄ«nas novads', '0964700', 0, 1),
(3934, 117, 'BrocÄ“ni, BrocÄ“nu novads', '0840605', 0, 1),
(3935, 117, 'BrocÄ“nu novads', '0840601', 0, 1),
(3936, 117, 'Burtnieku novads', '0967101', 0, 1),
(3937, 117, 'Carnikavas novads', '0805200', 0, 1),
(3938, 117, 'Cesvaine, Cesvaines novads', '0700807', 0, 1),
(3939, 117, 'Cesvaines novads', '0700800', 0, 1),
(3940, 117, 'CÄ“sis, CÄ“su novads', '0420201', 0, 1),
(3941, 117, 'CÄ“su novads', '0420200', 0, 1),
(3942, 117, 'Ciblas novads', '0684901', 0, 1),
(3943, 117, 'Dagda, Dagdas novads', '0601009', 0, 1),
(3944, 117, 'Dagdas novads', '0601000', 0, 1),
(3945, 117, 'Daugavpils', '0050000', 0, 1),
(3946, 117, 'Daugavpils novads', '0440200', 0, 1),
(3947, 117, 'Dobele, Dobeles novads', '0460201', 0, 1),
(3948, 117, 'Dobeles novads', '0460200', 0, 1),
(3949, 117, 'Dundagas novads', '0885100', 0, 1),
(3950, 117, 'Durbe, Durbes novads', '0640807', 0, 1),
(3951, 117, 'Durbes novads', '0640801', 0, 1),
(3952, 117, 'Engures novads', '0905100', 0, 1),
(3953, 117, 'Ä’rgÄ¼u novads', '0705500', 0, 1),
(3954, 117, 'Garkalnes novads', '0806000', 0, 1),
(3955, 117, 'GrobiÅ†a, GrobiÅ†as novads', '0641009', 0, 1),
(3956, 117, 'GrobiÅ†as novads', '0641000', 0, 1),
(3957, 117, 'Gulbene, Gulbenes novads', '0500201', 0, 1),
(3958, 117, 'Gulbenes novads', '0500200', 0, 1),
(3959, 117, 'Iecavas novads', '0406400', 0, 1),
(3960, 117, 'IkÅ¡Ä·ile, IkÅ¡Ä·iles novads', '0740605', 0, 1),
(3961, 117, 'IkÅ¡Ä·iles novads', '0740600', 0, 1),
(3962, 117, 'IlÅ«kste, IlÅ«kstes novads', '0440807', 0, 1),
(3963, 117, 'IlÅ«kstes novads', '0440801', 0, 1),
(3964, 117, 'InÄukalna novads', '0801800', 0, 1),
(3965, 117, 'Jaunjelgava, Jaunjelgavas novads', '0321007', 0, 1),
(3966, 117, 'Jaunjelgavas novads', '0321000', 0, 1),
(3967, 117, 'Jaunpiebalgas novads', '0425700', 0, 1),
(3968, 117, 'Jaunpils novads', '0905700', 0, 1),
(3969, 117, 'Jelgava', '0090000', 0, 1),
(3970, 117, 'Jelgavas novads', '0540200', 0, 1),
(3971, 117, 'JÄ“kabpils', '0110000', 0, 1),
(3972, 117, 'JÄ“kabpils novads', '0560200', 0, 1),
(3973, 117, 'JÅ«rmala', '0130000', 0, 1),
(3974, 117, 'Kalnciems, Jelgavas novads', '0540211', 0, 1),
(3975, 117, 'Kandava, Kandavas novads', '0901211', 0, 1),
(3976, 117, 'Kandavas novads', '0901201', 0, 1),
(3977, 117, 'KÄrsava, KÄrsavas novads', '0681009', 0, 1),
(3978, 117, 'KÄrsavas novads', '0681000', 0, 1),
(3979, 117, 'KocÄ“nu novads ,bij. Valmieras)', '0960200', 0, 1),
(3980, 117, 'Kokneses novads', '0326100', 0, 1),
(3981, 117, 'KrÄslava, KrÄslavas novads', '0600201', 0, 1),
(3982, 117, 'KrÄslavas novads', '0600202', 0, 1),
(3983, 117, 'Krimuldas novads', '0806900', 0, 1),
(3984, 117, 'Krustpils novads', '0566900', 0, 1),
(3985, 117, 'KuldÄ«ga, KuldÄ«gas novads', '0620201', 0, 1),
(3986, 117, 'KuldÄ«gas novads', '0620200', 0, 1),
(3987, 117, 'Ä¶eguma novads', '0741001', 0, 1),
(3988, 117, 'Ä¶egums, Ä¶eguma novads', '0741009', 0, 1),
(3989, 117, 'Ä¶ekavas novads', '0800800', 0, 1),
(3990, 117, 'LielvÄrde, LielvÄrdes novads', '0741413', 0, 1),
(3991, 117, 'LielvÄrdes novads', '0741401', 0, 1),
(3992, 117, 'LiepÄja', '0170000', 0, 1),
(3993, 117, 'LimbaÅ¾i, LimbaÅ¾u novads', '0660201', 0, 1),
(3994, 117, 'LimbaÅ¾u novads', '0660200', 0, 1),
(3995, 117, 'LÄ«gatne, LÄ«gatnes novads', '0421211', 0, 1),
(3996, 117, 'LÄ«gatnes novads', '0421200', 0, 1),
(3997, 117, 'LÄ«vÄni, LÄ«vÄnu novads', '0761211', 0, 1),
(3998, 117, 'LÄ«vÄnu novads', '0761201', 0, 1),
(3999, 117, 'LubÄna, LubÄnas novads', '0701413', 0, 1),
(4000, 117, 'LubÄnas novads', '0701400', 0, 1),
(4001, 117, 'Ludza, Ludzas novads', '0680201', 0, 1),
(4002, 117, 'Ludzas novads', '0680200', 0, 1),
(4003, 117, 'Madona, Madonas novads', '0700201', 0, 1),
(4004, 117, 'Madonas novads', '0700200', 0, 1),
(4005, 117, 'Mazsalaca, Mazsalacas novads', '0961011', 0, 1),
(4006, 117, 'Mazsalacas novads', '0961000', 0, 1),
(4007, 117, 'MÄlpils novads', '0807400', 0, 1),
(4008, 117, 'MÄrupes novads', '0807600', 0, 1),
(4009, 117, 'MÄ“rsraga novads', '0887600', 0, 1),
(4010, 117, 'NaukÅ¡Ä“nu novads', '0967300', 0, 1),
(4011, 117, 'Neretas novads', '0327100', 0, 1),
(4012, 117, 'NÄ«cas novads', '0647900', 0, 1),
(4013, 117, 'Ogre, Ogres novads', '0740201', 0, 1),
(4014, 117, 'Ogres novads', '0740202', 0, 1),
(4015, 117, 'Olaine, Olaines novads', '0801009', 0, 1),
(4016, 117, 'Olaines novads', '0801000', 0, 1),
(4017, 117, 'Ozolnieku novads', '0546701', 0, 1),
(4018, 117, 'PÄrgaujas novads', '0427500', 0, 1),
(4019, 117, 'PÄvilosta, PÄvilostas novads', '0641413', 0, 1),
(4020, 117, 'PÄvilostas novads', '0641401', 0, 1),
(4021, 117, 'Piltene, Ventspils novads', '0980213', 0, 1),
(4022, 117, 'PÄ¼aviÅ†as, PÄ¼aviÅ†u novads', '0321413', 0, 1),
(4023, 117, 'PÄ¼aviÅ†u novads', '0321400', 0, 1),
(4024, 117, 'PreiÄ¼i, PreiÄ¼u novads', '0760201', 0, 1),
(4025, 117, 'PreiÄ¼u novads', '0760202', 0, 1),
(4026, 117, 'Priekule, Priekules novads', '0641615', 0, 1),
(4027, 117, 'Priekules novads', '0641600', 0, 1),
(4028, 117, 'PriekuÄ¼u novads', '0427300', 0, 1),
(4029, 117, 'Raunas novads', '0427700', 0, 1),
(4030, 117, 'RÄ“zekne', '0210000', 0, 1),
(4031, 117, 'RÄ“zeknes novads', '0780200', 0, 1),
(4032, 117, 'RiebiÅ†u novads', '0766300', 0, 1),
(4033, 117, 'RÄ«ga', '0010000', 0, 1),
(4034, 117, 'Rojas novads', '0888300', 0, 1),
(4035, 117, 'RopaÅ¾u novads', '0808400', 0, 1),
(4036, 117, 'Rucavas novads', '0648500', 0, 1),
(4037, 117, 'RugÄju novads', '0387500', 0, 1),
(4038, 117, 'RundÄles novads', '0407700', 0, 1),
(4039, 117, 'RÅ«jiena, RÅ«jienas novads', '0961615', 0, 1),
(4040, 117, 'RÅ«jienas novads', '0961600', 0, 1),
(4041, 117, 'Sabile, Talsu novads', '0880213', 0, 1),
(4042, 117, 'SalacgrÄ«va, SalacgrÄ«vas novads', '0661415', 0, 1),
(4043, 117, 'SalacgrÄ«vas novads', '0661400', 0, 1),
(4044, 117, 'Salas novads', '0568700', 0, 1),
(4045, 117, 'Salaspils novads', '0801200', 0, 1),
(4046, 117, 'Salaspils, Salaspils novads', '0801211', 0, 1),
(4047, 117, 'Saldus novads', '0840200', 0, 1),
(4048, 117, 'Saldus, Saldus novads', '0840201', 0, 1),
(4049, 117, 'Saulkrasti, Saulkrastu novads', '0801413', 0, 1),
(4050, 117, 'Saulkrastu novads', '0801400', 0, 1),
(4051, 117, 'Seda, StrenÄu novads', '0941813', 0, 1),
(4052, 117, 'SÄ“jas novads', '0809200', 0, 1),
(4053, 117, 'Sigulda, Siguldas novads', '0801615', 0, 1),
(4054, 117, 'Siguldas novads', '0801601', 0, 1),
(4055, 117, 'SkrÄ«veru novads', '0328200', 0, 1),
(4056, 117, 'Skrunda, Skrundas novads', '0621209', 0, 1),
(4057, 117, 'Skrundas novads', '0621200', 0, 1),
(4058, 117, 'Smiltene, Smiltenes novads', '0941615', 0, 1),
(4059, 117, 'Smiltenes novads', '0941600', 0, 1),
(4060, 117, 'Staicele, Alojas novads', '0661017', 0, 1),
(4061, 117, 'Stende, Talsu novads', '0880215', 0, 1),
(4062, 117, 'StopiÅ†u novads', '0809600', 0, 1),
(4063, 117, 'StrenÄi, StrenÄu novads', '0941817', 0, 1),
(4064, 117, 'StrenÄu novads', '0941800', 0, 1),
(4065, 117, 'Subate, IlÅ«kstes novads', '0440815', 0, 1),
(4066, 117, 'Talsi, Talsu novads', '0880201', 0, 1),
(4067, 117, 'Talsu novads', '0880200', 0, 1),
(4068, 117, 'TÄ“rvetes novads', '0468900', 0, 1),
(4069, 117, 'Tukuma novads', '0900200', 0, 1),
(4070, 117, 'Tukums, Tukuma novads', '0900201', 0, 1),
(4071, 117, 'VaiÅ†odes novads', '0649300', 0, 1);
INSERT INTO `mlm_states` (`id`, `country_id`, `state_name`, `code`, `reg_count`, `status`) VALUES
(4072, 117, 'ValdemÄrpils, Talsu novads', '0880217', 0, 1),
(4073, 117, 'Valka, Valkas novads', '0940201', 0, 1),
(4074, 117, 'Valkas novads', '0940200', 0, 1),
(4075, 117, 'Valmiera', '0250000', 0, 1),
(4076, 117, 'VangaÅ¾i, InÄukalna novads', '0801817', 0, 1),
(4077, 117, 'VarakÄ¼Äni, VarakÄ¼Änu novads', '0701817', 0, 1),
(4078, 117, 'VarakÄ¼Änu novads', '0701800', 0, 1),
(4079, 117, 'VÄrkavas novads', '0769101', 0, 1),
(4080, 117, 'Vecpiebalgas novads', '0429300', 0, 1),
(4081, 117, 'Vecumnieku novads', '0409500', 0, 1),
(4082, 117, 'Ventspils', '0270000', 0, 1),
(4083, 117, 'Ventspils novads', '0980200', 0, 1),
(4084, 117, 'ViesÄ«te, ViesÄ«tes novads', '0561815', 0, 1),
(4085, 117, 'ViesÄ«tes novads', '0561800', 0, 1),
(4086, 117, 'ViÄ¼aka, ViÄ¼akas novads', '0381615', 0, 1),
(4087, 117, 'ViÄ¼akas novads', '0381600', 0, 1),
(4088, 117, 'ViÄ¼Äni, ViÄ¼Änu novads', '0781817', 0, 1),
(4089, 117, 'ViÄ¼Änu novads', '0781800', 0, 1),
(4090, 117, 'Zilupe, Zilupes novads', '0681817', 0, 1),
(4091, 117, 'Zilupes novads', '0681801', 0, 1),
(4092, 43, 'Arica y Parinacota', 'AP', 0, 1),
(4093, 43, 'Los Rios', 'LR', 0, 1),
(4094, 220, 'Kharkivs\'ka Oblast\'', '63', 0, 1),
(4095, 118, 'Beirut', 'LB-BR', 0, 1),
(4096, 118, 'Bekaa', 'LB-BE', 0, 1),
(4097, 118, 'Mount Lebanon', 'LB-ML', 0, 1),
(4098, 118, 'Nabatieh', 'LB-NB', 0, 1),
(4099, 118, 'North', 'LB-NR', 0, 1),
(4100, 118, 'South', 'LB-ST', 0, 1),
(4101, 99, 'Telangana', 'TS', 0, 1),
(4102, 44, 'Qinghai', 'QH', 0, 1),
(4103, 100, 'Papua Barat', 'PB', 0, 1),
(4104, 100, 'Sulawesi Barat', 'SR', 0, 1),
(4105, 100, 'Kepulauan Riau', 'KR', 0, 1),
(4106, 105, 'Barletta-Andria-Trani', 'BT', 0, 1),
(4107, 105, 'Fermo', 'FM', 0, 1),
(4108, 105, 'Monza Brianza', 'MB', 0, 1),
(4109, 188, 'Central Region', 'CR', 0, 1),
(4110, 188, 'East Region', 'ER', 0, 1),
(4111, 188, 'North Region', 'NR', 0, 1),
(4112, 188, 'North-East Region', 'NER', 0, 1),
(4113, 188, 'West Region', 'WR', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_subcategory`
--

CREATE TABLE `mlm_subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category` varchar(50) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `updation_date` datetime DEFAULT NULL,
  `order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(50) NOT NULL DEFAULT 'cat-banner-2.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_subcategory`
--

INSERT INTO `mlm_subcategory` (`id`, `category_id`, `sub_category`, `creation_date`, `updation_date`, `order`, `status`, `image`) VALUES
(1, 1, 'Mobile', '2018-09-05 15:38:03', '2018-09-05 15:38:03', 1, 1, 'mobile.jpeg'),
(2, 1, 'Laptop', '2018-09-05 15:38:03', '2018-09-05 15:38:03', 2, 1, 'laptops.jpeg'),
(3, 2, 'Dress', '2018-09-05 15:38:03', '2018-09-05 15:38:03', 3, 1, 'men_dress.jpeg'),
(4, 2, 'Shoes', '2018-09-05 15:38:03', '2018-09-05 15:38:03', 4, 1, 'cat-banner-2.jpg'),
(5, 3, 'Dress', '2018-09-05 15:38:03', '2018-09-05 15:38:03', 5, 1, 'women_dress.jpeg'),
(6, 3, 'Shoes', '2018-09-05 15:38:03', '2018-09-05 15:38:03', 6, 1, 'cat-banner-2.jpg'),
(7, 1, 'Head set', '2018-09-05 15:38:03', '2018-09-05 15:38:03', 7, 1, 'cat-banner-2.jpg'),
(8, 1, 'Mobile', '2018-09-05 15:38:03', '2018-09-05 15:38:03', 8, 1, 'cat-banner-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_system_contents`
--

CREATE TABLE `mlm_system_contents` (
  `id` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_system_contents`
--

INSERT INTO `mlm_system_contents` (`id`, `type`, `status`) VALUES
(1, 'terms_condition', 1),
(2, 'privacy_policy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_system_mails`
--

CREATE TABLE `mlm_system_mails` (
  `id` int(20) NOT NULL,
  `type` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `basic_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_system_mails`
--

INSERT INTO `mlm_system_mails` (`id`, `type`, `status`, `basic_status`) VALUES
(1, 'register_mail', 1, 1),
(2, 'order_mail', 1, 1),
(3, 'forgot_password', 1, 1),
(4, 'transaction_password', 1, 1),
(5, 'fund_debit', 0, 0),
(6, 'fund_credit', 0, 0),
(7, 'send_verification_code', 0, 0),
(8, 'pending_order_mail', 0, 0),
(9, 'pending_register_mail', 0, 0),
(10, 'lcp', 0, 0),
(11, 'affiliate_mail', 0, 0),
(12, 'maintanance_mail', 0, 0),
(13, 'employee_forgot_password', 0, 0),
(14, 'affiliate_forgot_password', 0, 0),
(17, 'new_order_mail', 0, 0),
(18, 'new_register_mail', 0, 0),
(19, 'otp', 1, 1),
(20, 'ticket_mail', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_testimonial`
--

CREATE TABLE `mlm_testimonial` (
  `id` int(11) NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_theme_settings`
--

CREATE TABLE `mlm_theme_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `color_scheama` varchar(50) NOT NULL DEFAULT 'assets/css/themes/theme-style8.css',
  `layout` varchar(20) DEFAULT NULL,
  `header` varchar(20) NOT NULL DEFAULT 'header-fixed',
  `footer` varchar(20) NOT NULL DEFAULT 'footer-fixed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_theme_settings`
--

INSERT INTO `mlm_theme_settings` (`id`, `user_id`, `color_scheama`, `layout`, `header`, `footer`) VALUES
(1, 1900, 'assets/css/themes/theme-style3.css', NULL, 'header-fixed', 'footer-default'),
(2, 1901, 'assets/css/themes/theme-style8.css', NULL, 'header-fixed', 'footer-fixed'),
(3, 1902, 'assets/css/themes/theme-style8.css', NULL, 'header-fixed', 'footer-fixed'),
(4, 1903, 'assets/css/themes/theme-style8.css', NULL, 'header-fixed', 'footer-fixed');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_ticket`
--

CREATE TABLE `mlm_ticket` (
  `id` int(11) NOT NULL,
  `ticket_id` varchar(30) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `mail` varchar(150) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `assignee` int(11) DEFAULT NULL,
  `status_changed_by` int(20) DEFAULT NULL,
  `from_userid` int(11) DEFAULT NULL,
  `to_userid` int(11) DEFAULT NULL,
  `rating` tinyint(4) DEFAULT NULL,
  `attach_file` text DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT 12,
  `reply_status` int(2) NOT NULL DEFAULT 0,
  `user_reply_status` tinyint(4) NOT NULL DEFAULT 1,
  `admin_reply_status` tinyint(4) NOT NULL DEFAULT 0,
  `reopen_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_ticket_department`
--

CREATE TABLE `mlm_ticket_department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_ticket_department`
--

INSERT INTO `mlm_ticket_department` (`department_id`, `department_name`, `date`, `status`) VALUES
(1, 'Marketing', '2017-11-03 08:29:35', 1),
(2, 'Sales', '2017-11-03 08:27:31', 1),
(3, 'Maintenance', '2017-11-03 08:28:22', 1),
(4, 'Customer Service', '2017-11-03 08:28:33', 1),
(5, 'Dispatch Department', '2017-11-03 08:29:03', 1),
(6, 'Production Department', '2017-11-03 08:29:13', 1),
(7, 'Finance', '2017-11-03 08:29:20', 1),
(9, 'Research and Development', '2017-11-03 08:29:50', 1),
(10, 'Information Technology', '2017-11-03 08:30:01', 1),
(11, 'Extras', '2018-02-02 10:31:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_ticket_faq`
--

CREATE TABLE `mlm_ticket_faq` (
  `id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_ticket_faq`
--

INSERT INTO `mlm_ticket_faq` (`id`, `department_id`, `question`, `answer`, `date`, `status`) VALUES
(1, 4, 'Where is TEA there is a HOPE ?', 'For Hel you any where any time', '2017-11-08 14:23:53', 1),
(2, 3, 'Why Choose ?', 'For 24 x 7 support for', '2018-06-06 17:15:05', 1),
(3, 2, 'Sample Question1', 'Sample Answer1', '2018-02-02 15:07:52', 1),
(4, 3, 'Sample Question2', 'Sample Answer2', '2018-02-02 15:08:53', 1),
(5, 1, 'jjjjjjjjj', 'hhhhhhhh', '2018-02-02 21:10:47', 1),
(6, 3, 'saaada', 'asdaddada', '2018-02-02 21:27:18', 1),
(7, 3, 'dsfsfsfsfs', 'fdsffsfs', '2018-02-07 16:18:56', 1),
(8, 5, 'Wwqeqqe', 'qweeqeqeqeqe', '2018-02-07 17:03:28', 1),
(9, 4, 'How about the support time?', '24*7', '2018-02-07 17:04:52', 1),
(10, 7, 'My Wallet Transfer How To occur?', 'Earing Commission From Leg Details', '2018-02-07 17:30:10', 1),
(11, 4, 'sadasdadads', 'adasdsadsadsad', '2018-02-07 17:37:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_ticket_priority`
--

CREATE TABLE `mlm_ticket_priority` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_ticket_priority`
--

INSERT INTO `mlm_ticket_priority` (`id`, `name`, `status`, `date`) VALUES
(1, 'High', 1, '2017-11-04 07:54:43'),
(3, 'Medium', 1, '2017-11-04 09:52:14'),
(4, 'Normal', 1, '2017-11-04 07:56:50'),
(6, 'Low', 1, '2019-09-27 10:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_ticket_replies`
--

CREATE TABLE `mlm_ticket_replies` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `reply_attachement` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_ticket_type`
--

CREATE TABLE `mlm_ticket_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_ticket_type`
--

INSERT INTO `mlm_ticket_type` (`id`, `type_name`, `date`, `status`) VALUES
(1, 'New', '2020-11-28 08:09:39', NULL),
(2, 'Open', '2020-11-28 08:09:39', NULL),
(3, 'Closed', '2020-11-28 08:09:39', NULL),
(4, 'Processing', '2020-11-28 08:09:39', NULL),
(5, 'Reopen', '2020-11-28 08:09:39', NULL),
(6, 'Hold', '2020-11-28 08:09:39', NULL),
(7, 'Completed', '2020-11-28 08:09:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_track`
--

CREATE TABLE `mlm_track` (
  `key` varchar(200) NOT NULL,
  `value` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_track`
--

INSERT INTO `mlm_track` (`key`, `value`) VALUES
('IP', '202.164.150.14'),
('IP1', '202.83.43.142');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_translated_files`
--

CREATE TABLE `mlm_translated_files` (
  `id` int(20) NOT NULL,
  `path` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_translator_history`
--

CREATE TABLE `mlm_translator_history` (
  `id` int(20) NOT NULL,
  `source` varchar(30) NOT NULL,
  `target` varchar(30) NOT NULL,
  `input` text DEFAULT NULL,
  `output` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_traverse_father`
--

CREATE TABLE `mlm_traverse_father` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `position` varchar(5) NOT NULL DEFAULT 'NO' COMMENT 'default = NO,Binary( L,R), Unilevel(Count).'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_traverse_father`
--

INSERT INTO `mlm_traverse_father` (`id`, `user_id`, `path`, `level`, `position`) VALUES
(1, 1900, 0, 0, 'NO'),
(2, 1901, 1900, 1, 'NO'),
(3, 1902, 1901, 1, 'NO'),
(4, 1902, 1900, 2, 'NO'),
(5, 1903, 1902, 1, 'NO'),
(6, 1903, 1901, 2, 'NO'),
(7, 1903, 1900, 3, 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_traverse_sponsor`
--

CREATE TABLE `mlm_traverse_sponsor` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_traverse_sponsor`
--

INSERT INTO `mlm_traverse_sponsor` (`id`, `user_id`, `path`, `level`) VALUES
(1, 1900, 0, 0),
(2, 1901, 1900, 1),
(3, 1902, 1900, 1),
(4, 1903, 1900, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_unilevel_level_bonus_settings`
--

CREATE TABLE `mlm_unilevel_level_bonus_settings` (
  `id` int(20) NOT NULL,
  `level` int(10) NOT NULL,
  `fixed_name` varchar(15) NOT NULL,
  `perc_name` varchar(15) NOT NULL,
  `bonus_type` varchar(10) NOT NULL DEFAULT 'fixed',
  `fixed` double NOT NULL,
  `percentage` double NOT NULL,
  `signup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_unilevel_level_bonus_settings`
--

INSERT INTO `mlm_unilevel_level_bonus_settings` (`id`, `level`, `fixed_name`, `perc_name`, `bonus_type`, `fixed`, `percentage`, `signup`) VALUES
(1, 1, 'fixed_uni_1', 'perc_uni_1', 'percentage', 11, 66, 0),
(2, 2, 'fixed_uni_2', 'perc_uni_2', 'percentage', 22, 77, 0),
(3, 3, 'fixed_uni_3', 'perc_uni_3', 'percentage', 33, 88, 0),
(4, 4, 'fixed_uni_4', 'perc_uni_4', 'percentage', 44, 99, 0),
(7, 5, 'fixed_uni_5', 'perc_uni_5', 'percentage', 55, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_user`
--

CREATE TABLE `mlm_user` (
  `mlm_user_id` int(50) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` mediumtext NOT NULL,
  `banned` tinyint(4) DEFAULT 0,
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text DEFAULT NULL,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text DEFAULT NULL,
  `verification_code` text DEFAULT NULL,
  `ip_address` text DEFAULT NULL,
  `totp_secret` varchar(16) DEFAULT NULL,
  `default_leg` varchar(20) DEFAULT 'static',
  `reg_pack` int(20) DEFAULT NULL,
  `user_rank_id` int(11) NOT NULL DEFAULT 0 COMMENT 'default = 0',
  `tran_password` varchar(20) DEFAULT NULL,
  `user_type` varchar(50) NOT NULL,
  `position` varchar(10) NOT NULL,
  `father_id` int(11) NOT NULL DEFAULT 0,
  `sponsor_id` int(11) NOT NULL DEFAULT 0,
  `reg_fee` float(16,8) DEFAULT NULL,
  `user_L` int(11) NOT NULL DEFAULT 0,
  `user_R` int(11) NOT NULL DEFAULT 0,
  `user_L_carry` int(11) NOT NULL DEFAULT 0,
  `user_R_carry` int(11) NOT NULL DEFAULT 0,
  `user_status` varchar(30) NOT NULL DEFAULT 'active',
  `login_block` tinyint(4) NOT NULL DEFAULT 1,
  `registration_block` tinyint(4) NOT NULL DEFAULT 1,
  `point` float(16,8) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `language` tinyint(4) NOT NULL DEFAULT 1,
  `currency` tinyint(4) NOT NULL DEFAULT 1,
  `cron_status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_user`
--

INSERT INTO `mlm_user` (`mlm_user_id`, `customer_id`, `user_name`, `email`, `password`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `ip_address`, `totp_secret`, `default_leg`, `reg_pack`, `user_rank_id`, `tran_password`, `user_type`, `position`, `father_id`, `sponsor_id`, `reg_fee`, `user_L`, `user_R`, `user_L_carry`, `user_R_carry`, `user_status`, `login_block`, `registration_block`, `point`, `date`, `language`, `currency`, `cron_status`) VALUES
(1900, 1, 'admin', 'admin@leadmlm.in', '0a1d18a485f77dcee53ea81f1010276b67153b745219afc4eac4288045f5ca3d', 0, '2022-08-08 17:09:17', '2022-08-08 17:09:17', NULL, NULL, '2022-07-10 00:00:00', '3WBAfvEp9jotIcey', NULL, '::1', NULL, 'static', NULL, 1, '123456', 'admin', '', 0, 0, NULL, 0, 0, 0, 0, 'active', 1, 1, NULL, '2017-12-12 15:43:26', 1, 1, 0),
(1901, 0, 'dgdfhfg', 'dgfh@ftrhyt.hjyg', 'b68b026e9eca4e2e01825c4f597efdd9e9b62a3af63597acdd5bae6e4519a9c3', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'static', 1, 1, '123456', 'user', '1', 1900, 1900, 15.00000000, 0, 0, 0, 0, 'active', 1, 1, NULL, '2021-03-31 16:39:28', 1, 1, 0),
(1902, 0, 'leaduser', 'usretest@gmail.com', 'b1f6f019e7d3bde9b7899259293037d4d82f5eb7b17f831fcaaf9726102b0d67', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'static', 3, 0, '123456', 'user', '1', 1901, 1900, 25.00000000, 0, 0, 0, 0, 'active', 1, 1, NULL, '2021-12-18 10:25:01', 1, 1, 0),
(1903, 0, 'testuser', 'usresatest@gmail.com', 'b1f6f019e7d3bde9b7899259293037d4d82f5eb7b17f831fcaaf9726102b0d67', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'static', 2, 0, '123456', 'user', '1', 1902, 1900, 20.00000000, 0, 0, 0, 0, 'active', 1, 1, NULL, '2021-12-18 11:02:37', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_user_balance`
--

CREATE TABLE `mlm_user_balance` (
  `id` int(30) NOT NULL,
  `mlm_user_id` int(30) NOT NULL,
  `balance_amount` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `total_amount` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `released_amount` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `user_wallet_two` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `donation_send` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `donation_recieved` decimal(16,8) NOT NULL DEFAULT 0.00000000,
  `coupon_balance` decimal(16,8) NOT NULL DEFAULT 0.00000000
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_user_balance`
--

INSERT INTO `mlm_user_balance` (`id`, `mlm_user_id`, `balance_amount`, `total_amount`, `released_amount`, `user_wallet_two`, `donation_send`, `donation_recieved`, `coupon_balance`) VALUES
(1, 1900, '48.50280000', '48.50280000', '0.00000000', '5.38920000', '0.00000000', '0.00000000', '1000.00000000'),
(2, 1901, '15.84000000', '15.84000000', '0.00000000', '1.76000000', '0.00000000', '0.00000000', '5.00000000'),
(3, 1902, '5.94000000', '5.94000000', '0.00000000', '0.66000000', '0.00000000', '0.00000000', '15.00000000'),
(4, 1903, '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '0.00000000', '10.00000000');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_user_details`
--

CREATE TABLE `mlm_user_details` (
  `id` int(30) NOT NULL,
  `mlm_user_id` int(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) DEFAULT 'NA',
  `address_1` varchar(50) NOT NULL DEFAULT 'NA',
  `address_2` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT 'NA',
  `zip_code` varchar(10) DEFAULT NULL,
  `state_id` int(30) DEFAULT 0,
  `country_id` int(30) NOT NULL DEFAULT 0,
  `shipping_address` varchar(40) DEFAULT NULL,
  `shipping_city` varchar(20) DEFAULT NULL,
  `shipping_zipcode` int(10) DEFAULT NULL,
  `shipping_country` int(10) DEFAULT NULL,
  `shipping_state` int(10) DEFAULT NULL,
  `date_of_birth` varchar(20) DEFAULT NULL,
  `user_dp` varchar(30) NOT NULL DEFAULT 'no_user.jpg',
  `user_cover` varchar(30) NOT NULL DEFAULT 'cover3.jpg',
  `date_of_joining` datetime NOT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `phone_number` varchar(30) DEFAULT NULL,
  `company_name` varchar(30) DEFAULT NULL,
  `company_address` varchar(30) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twiter` varchar(100) DEFAULT NULL,
  `gplus` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_user_details`
--

INSERT INTO `mlm_user_details` (`id`, `mlm_user_id`, `first_name`, `last_name`, `address_1`, `address_2`, `city`, `zip_code`, `state_id`, `country_id`, `shipping_address`, `shipping_city`, `shipping_zipcode`, `shipping_country`, `shipping_state`, `date_of_birth`, `user_dp`, `user_cover`, `date_of_joining`, `gender`, `phone_number`, `company_name`, `company_address`, `facebook`, `twiter`, `gplus`, `instagram`) VALUES
(1, 1900, 'Admin', 'user', 'Calicut Business Center', NULL, 'Kozhikode', '673003', 1428, 99, 'fffffffff', 'Wayanad', 673631, 101, 1476, '02/04/1993', 'dp0_15749292903.jpeg', 'cover4.jpg', '2017-10-01 00:00:00', 'm', '9876543210', NULL, NULL, 'https://www.facebook.com/LeadMLMSoftwareOffcial/', 'https://twitter.com/LeadMLMsoftware', 'https://plus.google.com/114007620788163747255', 'https://in.linkedin.com/company/lead-mlm-software'),
(2, 1901, 'dsgtfdh', 'rtyhtrfujyt', 'NA', NULL, 'NA', NULL, 35, 2, NULL, NULL, NULL, 2, 35, NULL, 'no_user.jpg', 'cover3.jpg', '2021-03-31 16:39:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1902, 'siddeeq', 'kk', 'NA', NULL, 'NA', NULL, 1428, 99, NULL, NULL, NULL, 99, 1428, NULL, 'no_user.jpg', 'cover3.jpg', '2021-12-18 10:25:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1903, 'siddeeq', 'kk', 'NA', NULL, 'NA', NULL, 1428, 99, NULL, NULL, NULL, 99, 1428, NULL, 'no_user.jpg', 'cover3.jpg', '2021-12-18 11:02:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_user_files`
--

CREATE TABLE `mlm_user_files` (
  `id` int(20) NOT NULL,
  `mlm_user_id` int(20) NOT NULL,
  `file_name` varchar(40) NOT NULL,
  `file_type` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_user_kyc`
--

CREATE TABLE `mlm_user_kyc` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `file` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `reason` varchar(300) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_user_logins`
--

CREATE TABLE `mlm_user_logins` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `ip_address` varchar(30) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_user_logins`
--

INSERT INTO `mlm_user_logins` (`id`, `user_id`, `ip_address`, `date`) VALUES
(1, 1902, '::1', '2021-12-18 10:25:28'),
(2, 1902, '::1', '2022-01-13 14:28:52'),
(3, 1902, '::1', '2022-01-14 11:53:40'),
(4, 1902, '127.0.0.1', '2022-02-28 17:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_user_migration`
--

CREATE TABLE `mlm_user_migration` (
  `id` int(11) NOT NULL,
  `user_name` varchar(15) DEFAULT NULL,
  `join_username` varchar(15) DEFAULT NULL,
  `joinside` varchar(15) DEFAULT NULL,
  `left_child` varchar(15) DEFAULT NULL,
  `right_child` varchar(15) DEFAULT NULL,
  `sponsor` varchar(15) DEFAULT NULL,
  `email_address` varchar(35) DEFAULT NULL,
  `mobile_number` varchar(12) DEFAULT NULL,
  `name` varchar(15) DEFAULT NULL,
  `rank_desc` varchar(15) DEFAULT NULL,
  `country_name` varchar(15) DEFAULT NULL,
  `signup_date` datetime(6) DEFAULT NULL,
  `left_rp` int(15) DEFAULT NULL,
  `right_rp` int(15) DEFAULT NULL,
  `left_bp` int(15) DEFAULT NULL,
  `right_bp` int(15) DEFAULT NULL,
  `online_balance` int(15) DEFAULT NULL,
  `earning_balance` int(15) DEFAULT NULL,
  `bonus_balance` int(15) DEFAULT NULL,
  `saving_balance` int(15) DEFAULT NULL,
  `lc_4` int(15) DEFAULT NULL,
  `lc4_escrow` int(15) DEFAULT NULL,
  `lms` int(15) DEFAULT NULL,
  `lms_escrow` int(15) DEFAULT NULL,
  `level` int(15) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_user_payment_config`
--

CREATE TABLE `mlm_user_payment_config` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paypal_email` varchar(100) DEFAULT NULL,
  `bank_name` varchar(30) DEFAULT NULL,
  `bank_ac_holder_name` varchar(100) DEFAULT NULL,
  `bank_ac_number` varchar(50) DEFAULT NULL,
  `bank_branch` varchar(50) DEFAULT NULL,
  `bank_ifsc_code` varchar(50) DEFAULT NULL,
  `wallet_address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_user_payment_config`
--

INSERT INTO `mlm_user_payment_config` (`id`, `user_id`, `paypal_email`, `bank_name`, `bank_ac_holder_name`, `bank_ac_number`, `bank_branch`, `bank_ifsc_code`, `wallet_address`) VALUES
(1, 1900, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1901, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1902, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1903, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_wallet_details`
--

CREATE TABLE `mlm_wallet_details` (
  `id` int(30) NOT NULL,
  `mlm_user_id` int(30) NOT NULL,
  `from_user` int(30) DEFAULT NULL,
  `type` varchar(30) DEFAULT 'credit/debit',
  `transation_id` varchar(20) DEFAULT NULL,
  `original_amount` decimal(16,8) NOT NULL,
  `amount1` decimal(16,8) NOT NULL,
  `amount2` decimal(16,8) DEFAULT NULL,
  `transation_charges` double DEFAULT NULL,
  `tax_amount` decimal(16,8) DEFAULT NULL,
  `tax1` decimal(16,8) DEFAULT NULL,
  `tax2` decimal(16,8) DEFAULT NULL,
  `wallet_type` varchar(30) NOT NULL DEFAULT 'NA',
  `bonus_flag` int(10) DEFAULT 0,
  `done_by` varchar(20) DEFAULT NULL,
  `payout_status` varchar(10) NOT NULL DEFAULT 'pending',
  `data` mediumtext DEFAULT NULL,
  `payout_details` text DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mlm_wallet_details`
--

INSERT INTO `mlm_wallet_details` (`id`, `mlm_user_id`, `from_user`, `type`, `transation_id`, `original_amount`, `amount1`, `amount2`, `transation_charges`, `tax_amount`, `tax1`, `tax2`, `wallet_type`, `bonus_flag`, `done_by`, `payout_status`, `data`, `payout_details`, `date`) VALUES
(1, 1900, 1901, 'credit', 'TR-kmqgY', '10.00000000', '9.00000000', '1.00000000', 0, '0.00000000', '0.00000000', '0.00000000', 'referral_bonus', 1, 'code', 'pending', 's:0:\"\";', NULL, '2021-03-31 16:39:28'),
(2, 1900, 1901, 'credit', 'TR-29Hyg', '3.30000000', '2.97000000', '0.33000000', 0, '0.00000000', '0.00000000', '0.00000000', 'uni_level_bonus', 1, 'code', 'pending', 's:0:\"\";', NULL, '2021-03-31 16:39:28'),
(3, 1900, 1902, 'credit', 'TR-yin3x', '10.00000000', '9.00000000', '1.00000000', 0, '0.00000000', '0.00000000', '0.00000000', 'referral_bonus', 1, 'code', 'pending', 's:0:\"\";', NULL, '2021-12-18 10:25:02'),
(4, 1901, 1902, 'credit', 'TR-v9AIU', '9.90000000', '8.91000000', '0.99000000', 0, '0.00000000', '0.00000000', '0.00000000', 'uni_level_bonus', 1, 'code', 'pending', 's:0:\"\";', NULL, '2021-12-18 10:25:02'),
(5, 1900, 1901, 'credit', 'TR-pj2GK', '0.09900000', '0.08910000', '0.00990000', 0, '0.00000000', '0.00000000', '0.00000000', 'matching_bonus', 1, '1901', 'pending', 's:0:\"\";', NULL, '2021-12-18 10:25:02'),
(6, 1900, 1902, 'credit', 'TR-6BD4M', '11.55000000', '10.39500000', '1.15500000', 0, '0.00000000', '0.00000000', '0.00000000', 'uni_level_bonus', 1, 'code', 'pending', 's:0:\"\";', NULL, '2021-12-18 10:25:02'),
(7, 1900, 1903, 'credit', 'TR-z2eFs', '10.00000000', '9.00000000', '1.00000000', 0, '0.00000000', '0.00000000', '0.00000000', 'referral_bonus', 1, 'code', 'pending', 's:0:\"\";', NULL, '2021-12-18 11:02:38'),
(8, 1902, 1903, 'credit', 'TR-KO3mU', '6.60000000', '5.94000000', '0.66000000', 0, '0.00000000', '0.00000000', '0.00000000', 'uni_level_bonus', 1, 'code', 'pending', 's:0:\"\";', NULL, '2021-12-18 11:02:38'),
(9, 1900, 1902, 'credit', 'TR-EaRtd', '0.06600000', '0.05940000', '0.00660000', 0, '0.00000000', '0.00000000', '0.00000000', 'matching_bonus', 1, '1902', 'pending', 's:0:\"\";', NULL, '2021-12-18 11:02:38'),
(10, 1901, 1903, 'credit', 'TR-8aMBx', '7.70000000', '6.93000000', '0.77000000', 0, '0.00000000', '0.00000000', '0.00000000', 'uni_level_bonus', 1, 'code', 'pending', 's:0:\"\";', NULL, '2021-12-18 11:02:38'),
(11, 1900, 1901, 'credit', 'TR-sqrIj', '0.07700000', '0.06930000', '0.00770000', 0, '0.00000000', '0.00000000', '0.00000000', 'matching_bonus', 1, '1901', 'pending', 's:0:\"\";', NULL, '2021-12-18 11:02:38'),
(12, 1900, 1903, 'credit', 'TR-NxbDz', '8.80000000', '7.92000000', '0.88000000', 0, '0.00000000', '0.00000000', '0.00000000', 'uni_level_bonus', 1, 'code', 'pending', 's:0:\"\";', NULL, '2021-12-18 11:02:38');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_wallet_transfer`
--

CREATE TABLE `mlm_wallet_transfer` (
  `id` int(30) NOT NULL,
  `from_user` int(30) DEFAULT NULL,
  `to_user` int(30) DEFAULT NULL,
  `amount` decimal(16,8) NOT NULL,
  `transfer_type` varchar(30) DEFAULT NULL,
  `wallet_type` varchar(10) DEFAULT NULL,
  `reason` varchar(50) NOT NULL DEFAULT 'NA',
  `date` datetime DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`,`ip_address`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `mlm_activity`
--
ALTER TABLE `mlm_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_affiliates`
--
ALTER TABLE `mlm_affiliates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_affiliate_activity`
--
ALTER TABLE `mlm_affiliate_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_affiliate_enquiry`
--
ALTER TABLE `mlm_affiliate_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_binary_bonus_history`
--
ALTER TABLE `mlm_binary_bonus_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mlm_user_id` (`mlm_user_id`);

--
-- Indexes for table `mlm_binary_bonus_settings`
--
ALTER TABLE `mlm_binary_bonus_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_blocktrail_payment`
--
ALTER TABLE `mlm_blocktrail_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_bonuses`
--
ALTER TABLE `mlm_bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_brand`
--
ALTER TABLE `mlm_brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `mlm_category`
--
ALTER TABLE `mlm_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_coin_payment_response`
--
ALTER TABLE `mlm_coin_payment_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_config`
--
ALTER TABLE `mlm_config`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `mlm_configuration`
--
ALTER TABLE `mlm_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_countries`
--
ALTER TABLE `mlm_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_cron_job`
--
ALTER TABLE `mlm_cron_job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_curl_history`
--
ALTER TABLE `mlm_curl_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_currencies`
--
ALTER TABLE `mlm_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_currency_values`
--
ALTER TABLE `mlm_currency_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_db_optimize`
--
ALTER TABLE `mlm_db_optimize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_demo_switcher`
--
ALTER TABLE `mlm_demo_switcher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_documents`
--
ALTER TABLE `mlm_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_donations`
--
ALTER TABLE `mlm_donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_employee_details`
--
ALTER TABLE `mlm_employee_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_employee_login`
--
ALTER TABLE `mlm_employee_login`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `mlm_events`
--
ALTER TABLE `mlm_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_genertion_settings`
--
ALTER TABLE `mlm_genertion_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rank_id` (`rank_id`);

--
-- Indexes for table `mlm_gift_requests`
--
ALTER TABLE `mlm_gift_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_investment_category`
--
ALTER TABLE `mlm_investment_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_investment_history`
--
ALTER TABLE `mlm_investment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mlm_user_id` (`mlm_user_id`);

--
-- Indexes for table `mlm_investment_user_balance`
--
ALTER TABLE `mlm_investment_user_balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mlm_user_id` (`mlm_user_id`);

--
-- Indexes for table `mlm_inv_release_history`
--
ALTER TABLE `mlm_inv_release_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_ip_blacklist`
--
ALTER TABLE `mlm_ip_blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_ip_whitelist`
--
ALTER TABLE `mlm_ip_whitelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_issues`
--
ALTER TABLE `mlm_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_kyc_details`
--
ALTER TABLE `mlm_kyc_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_languages`
--
ALTER TABLE `mlm_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_language_conversion`
--
ALTER TABLE `mlm_language_conversion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_leads`
--
ALTER TABLE `mlm_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_login_attempts`
--
ALTER TABLE `mlm_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_ltm_translations`
--
ALTER TABLE `mlm_ltm_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_mail_content`
--
ALTER TABLE `mlm_mail_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_mail_settings`
--
ALTER TABLE `mlm_mail_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_mail_system`
--
ALTER TABLE `mlm_mail_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_matching_bonus`
--
ALTER TABLE `mlm_matching_bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_matrix_level_bonus_settings`
--
ALTER TABLE `mlm_matrix_level_bonus_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_menus`
--
ALTER TABLE `mlm_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_messages`
--
ALTER TABLE `mlm_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_migration_files`
--
ALTER TABLE `mlm_migration_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_modules`
--
ALTER TABLE `mlm_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_news`
--
ALTER TABLE `mlm_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_orders`
--
ALTER TABLE `mlm_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mlm_order_products`
--
ALTER TABLE `mlm_order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_pair_calculation`
--
ALTER TABLE `mlm_pair_calculation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_party`
--
ALTER TABLE `mlm_party`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_party_products`
--
ALTER TABLE `mlm_party_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_party_requests`
--
ALTER TABLE `mlm_party_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_party_users`
--
ALTER TABLE `mlm_party_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_payment_config`
--
ALTER TABLE `mlm_payment_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_payment_methods`
--
ALTER TABLE `mlm_payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_pending_registrations`
--
ALTER TABLE `mlm_pending_registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_pin_numbers`
--
ALTER TABLE `mlm_pin_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_pin_request`
--
ALTER TABLE `mlm_pin_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_products`
--
ALTER TABLE `mlm_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_rank`
--
ALTER TABLE `mlm_rank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_rank_history`
--
ALTER TABLE `mlm_rank_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_referal_bonus_settings`
--
ALTER TABLE `mlm_referal_bonus_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_register_fields`
--
ALTER TABLE `mlm_register_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_register_history`
--
ALTER TABLE `mlm_register_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_reset_folders`
--
ALTER TABLE `mlm_reset_folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_reset_password`
--
ALTER TABLE `mlm_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_return`
--
ALTER TABLE `mlm_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_review`
--
ALTER TABLE `mlm_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_site_info`
--
ALTER TABLE `mlm_site_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_stair_step_settings`
--
ALTER TABLE `mlm_stair_step_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_states`
--
ALTER TABLE `mlm_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_subcategory`
--
ALTER TABLE `mlm_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_system_contents`
--
ALTER TABLE `mlm_system_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_system_mails`
--
ALTER TABLE `mlm_system_mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_testimonial`
--
ALTER TABLE `mlm_testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_theme_settings`
--
ALTER TABLE `mlm_theme_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_ticket`
--
ALTER TABLE `mlm_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_ticket_department`
--
ALTER TABLE `mlm_ticket_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `mlm_ticket_faq`
--
ALTER TABLE `mlm_ticket_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_ticket_priority`
--
ALTER TABLE `mlm_ticket_priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_ticket_replies`
--
ALTER TABLE `mlm_ticket_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_ticket_type`
--
ALTER TABLE `mlm_ticket_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_track`
--
ALTER TABLE `mlm_track`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `mlm_translated_files`
--
ALTER TABLE `mlm_translated_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_translator_history`
--
ALTER TABLE `mlm_translator_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_traverse_father`
--
ALTER TABLE `mlm_traverse_father`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `path` (`path`);

--
-- Indexes for table `mlm_traverse_sponsor`
--
ALTER TABLE `mlm_traverse_sponsor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `path` (`path`);

--
-- Indexes for table `mlm_unilevel_level_bonus_settings`
--
ALTER TABLE `mlm_unilevel_level_bonus_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_user`
--
ALTER TABLE `mlm_user`
  ADD PRIMARY KEY (`mlm_user_id`);

--
-- Indexes for table `mlm_user_balance`
--
ALTER TABLE `mlm_user_balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mlm_user_id` (`mlm_user_id`);

--
-- Indexes for table `mlm_user_details`
--
ALTER TABLE `mlm_user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mlm_user_id` (`mlm_user_id`);

--
-- Indexes for table `mlm_user_files`
--
ALTER TABLE `mlm_user_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_user_kyc`
--
ALTER TABLE `mlm_user_kyc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_user_logins`
--
ALTER TABLE `mlm_user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_user_migration`
--
ALTER TABLE `mlm_user_migration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_user_payment_config`
--
ALTER TABLE `mlm_user_payment_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_wallet_details`
--
ALTER TABLE `mlm_wallet_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mlm_user_id` (`mlm_user_id`);

--
-- Indexes for table `mlm_wallet_transfer`
--
ALTER TABLE `mlm_wallet_transfer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mlm_activity`
--
ALTER TABLE `mlm_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `mlm_affiliates`
--
ALTER TABLE `mlm_affiliates`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_affiliate_activity`
--
ALTER TABLE `mlm_affiliate_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_affiliate_enquiry`
--
ALTER TABLE `mlm_affiliate_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_binary_bonus_history`
--
ALTER TABLE `mlm_binary_bonus_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_binary_bonus_settings`
--
ALTER TABLE `mlm_binary_bonus_settings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mlm_blocktrail_payment`
--
ALTER TABLE `mlm_blocktrail_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_bonuses`
--
ALTER TABLE `mlm_bonuses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mlm_brand`
--
ALTER TABLE `mlm_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mlm_category`
--
ALTER TABLE `mlm_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mlm_coin_payment_response`
--
ALTER TABLE `mlm_coin_payment_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_configuration`
--
ALTER TABLE `mlm_configuration`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mlm_countries`
--
ALTER TABLE `mlm_countries`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `mlm_cron_job`
--
ALTER TABLE `mlm_cron_job`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mlm_curl_history`
--
ALTER TABLE `mlm_curl_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_currencies`
--
ALTER TABLE `mlm_currencies`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mlm_currency_values`
--
ALTER TABLE `mlm_currency_values`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_db_optimize`
--
ALTER TABLE `mlm_db_optimize`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mlm_demo_switcher`
--
ALTER TABLE `mlm_demo_switcher`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mlm_documents`
--
ALTER TABLE `mlm_documents`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mlm_donations`
--
ALTER TABLE `mlm_donations`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_employee_details`
--
ALTER TABLE `mlm_employee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_employee_login`
--
ALTER TABLE `mlm_employee_login`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mlm_events`
--
ALTER TABLE `mlm_events`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_genertion_settings`
--
ALTER TABLE `mlm_genertion_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mlm_gift_requests`
--
ALTER TABLE `mlm_gift_requests`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_investment_category`
--
ALTER TABLE `mlm_investment_category`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mlm_investment_history`
--
ALTER TABLE `mlm_investment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_investment_user_balance`
--
ALTER TABLE `mlm_investment_user_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mlm_inv_release_history`
--
ALTER TABLE `mlm_inv_release_history`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_ip_blacklist`
--
ALTER TABLE `mlm_ip_blacklist`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_ip_whitelist`
--
ALTER TABLE `mlm_ip_whitelist`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_issues`
--
ALTER TABLE `mlm_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mlm_kyc_details`
--
ALTER TABLE `mlm_kyc_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_languages`
--
ALTER TABLE `mlm_languages`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mlm_language_conversion`
--
ALTER TABLE `mlm_language_conversion`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_leads`
--
ALTER TABLE `mlm_leads`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_login_attempts`
--
ALTER TABLE `mlm_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `mlm_ltm_translations`
--
ALTER TABLE `mlm_ltm_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_mail_content`
--
ALTER TABLE `mlm_mail_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `mlm_mail_settings`
--
ALTER TABLE `mlm_mail_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mlm_mail_system`
--
ALTER TABLE `mlm_mail_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mlm_matching_bonus`
--
ALTER TABLE `mlm_matching_bonus`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mlm_matrix_level_bonus_settings`
--
ALTER TABLE `mlm_matrix_level_bonus_settings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mlm_menus`
--
ALTER TABLE `mlm_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `mlm_messages`
--
ALTER TABLE `mlm_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_migration_files`
--
ALTER TABLE `mlm_migration_files`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_modules`
--
ALTER TABLE `mlm_modules`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `mlm_news`
--
ALTER TABLE `mlm_news`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_orders`
--
ALTER TABLE `mlm_orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mlm_order_products`
--
ALTER TABLE `mlm_order_products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mlm_pair_calculation`
--
ALTER TABLE `mlm_pair_calculation`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_party`
--
ALTER TABLE `mlm_party`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_party_products`
--
ALTER TABLE `mlm_party_products`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_party_requests`
--
ALTER TABLE `mlm_party_requests`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_party_users`
--
ALTER TABLE `mlm_party_users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_payment_config`
--
ALTER TABLE `mlm_payment_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mlm_payment_methods`
--
ALTER TABLE `mlm_payment_methods`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mlm_pending_registrations`
--
ALTER TABLE `mlm_pending_registrations`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_pin_numbers`
--
ALTER TABLE `mlm_pin_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_pin_request`
--
ALTER TABLE `mlm_pin_request`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_products`
--
ALTER TABLE `mlm_products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mlm_rank`
--
ALTER TABLE `mlm_rank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mlm_rank_history`
--
ALTER TABLE `mlm_rank_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_referal_bonus_settings`
--
ALTER TABLE `mlm_referal_bonus_settings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mlm_register_fields`
--
ALTER TABLE `mlm_register_fields`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `mlm_register_history`
--
ALTER TABLE `mlm_register_history`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mlm_reset_folders`
--
ALTER TABLE `mlm_reset_folders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mlm_reset_password`
--
ALTER TABLE `mlm_reset_password`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_return`
--
ALTER TABLE `mlm_return`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_review`
--
ALTER TABLE `mlm_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `mlm_stair_step_settings`
--
ALTER TABLE `mlm_stair_step_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mlm_states`
--
ALTER TABLE `mlm_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4114;

--
-- AUTO_INCREMENT for table `mlm_subcategory`
--
ALTER TABLE `mlm_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mlm_system_mails`
--
ALTER TABLE `mlm_system_mails`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mlm_testimonial`
--
ALTER TABLE `mlm_testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_theme_settings`
--
ALTER TABLE `mlm_theme_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mlm_ticket`
--
ALTER TABLE `mlm_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_ticket_department`
--
ALTER TABLE `mlm_ticket_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mlm_ticket_faq`
--
ALTER TABLE `mlm_ticket_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mlm_ticket_priority`
--
ALTER TABLE `mlm_ticket_priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mlm_ticket_replies`
--
ALTER TABLE `mlm_ticket_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_ticket_type`
--
ALTER TABLE `mlm_ticket_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mlm_translated_files`
--
ALTER TABLE `mlm_translated_files`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_translator_history`
--
ALTER TABLE `mlm_translator_history`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_traverse_father`
--
ALTER TABLE `mlm_traverse_father`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mlm_traverse_sponsor`
--
ALTER TABLE `mlm_traverse_sponsor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mlm_unilevel_level_bonus_settings`
--
ALTER TABLE `mlm_unilevel_level_bonus_settings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mlm_user`
--
ALTER TABLE `mlm_user`
  MODIFY `mlm_user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1904;

--
-- AUTO_INCREMENT for table `mlm_user_balance`
--
ALTER TABLE `mlm_user_balance`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mlm_user_details`
--
ALTER TABLE `mlm_user_details`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mlm_user_files`
--
ALTER TABLE `mlm_user_files`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_user_kyc`
--
ALTER TABLE `mlm_user_kyc`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_user_logins`
--
ALTER TABLE `mlm_user_logins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mlm_user_migration`
--
ALTER TABLE `mlm_user_migration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_user_payment_config`
--
ALTER TABLE `mlm_user_payment_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mlm_wallet_details`
--
ALTER TABLE `mlm_wallet_details`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mlm_wallet_transfer`
--
ALTER TABLE `mlm_wallet_transfer`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
