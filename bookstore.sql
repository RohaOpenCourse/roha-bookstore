-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2019 at 01:53 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

DROP TABLE IF EXISTS `activations`;
CREATE TABLE IF NOT EXISTS `activations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `activation_code` int(11) NOT NULL,
  `activation_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `ISBN` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `publish_country` varchar(255) NOT NULL,
  `publish_date` date NOT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  `cover_photo` varchar(255) DEFAULT NULL,
  `long_description` text,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ISBN` (`ISBN`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `cat_id`, `ISBN`, `title`, `author`, `publisher`, `publish_country`, `publish_date`, `file_path`, `cover_photo`, `long_description`, `created_at`, `updated_at`) VALUES
(2, 64, 214232, 'php and mysql web development', 'Wobetu S', 'Birhanina Selam', 'ETHIOPIA', '2019-04-25', 'uploads/STM-LECTURE NOTES_0_2.pdf', 'uploads/oop php.JPG', 'PHP and MySQL web development, programmer to programmer', '2019-04-11 15:17:49', '2019-04-11 15:17:49'),
(4, 64, 324124, 'Software Design and Architecture', 'Univeristy of Alberta', 'Univesity  of Alberta', 'CANADA', '2019-04-18', 'uploads/Software Architecture.pdf', 'uploads/software archi.PNG', 'Software development and modeling. Software Design and Architectures. Design patterns in Java etc', '2019-04-11 15:20:51', '2019-04-11 15:20:51'),
(5, 65, 45646, 'Electro Mechanics', 'Abebe Temtim', 'ASTER NEGA', 'ETHIOPIA', '2019-04-24', 'uploads/Muluken Shiferaw - Curriculum Vitae.pdf', 'uploads/Object Oriented Methodologies.JPG', 'Here is description of these book', '2019-04-11 15:21:57', '2019-04-11 15:21:57'),
(7, 66, 324124, 'Haddis Alemayehu, FIkir Eske Mekabir', 'Haddis Alemayehu', 'Birhanina Selam', 'ETHIOPIA', '2019-04-12', 'uploads/Lab Exercise.pdf', 'uploads/googlelogo_color_272x92dp.png', 'Haddis Alemayehu Fikir Eske Mekabir Ethiopian poetry.', '2019-04-11 15:25:08', '2019-04-11 15:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

DROP TABLE IF EXISTS `book_categories`;
CREATE TABLE IF NOT EXISTS `book_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` text,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`id`, `cat_name`, `cat_description`, `created_at`, `updated_at`) VALUES
(62, 'History', 'List of History books', '2019-03-31 12:42:47', '2019-03-31 12:42:47'),
(64, 'Computer Science', 'Shelf of computer science books', '2019-03-31 12:46:29', '2019-03-31 12:46:29'),
(65, 'Mechanical Engineering ', 'Mechanical Engineering list of books', '2019-03-31 12:46:51', '2019-03-31 12:46:51'),
(66, 'Arts and Literature', 'List of arts and literature', '2019-03-31 12:47:12', '2019-03-31 12:47:12'),
(67, 'Electrical Engineering ', 'Electrical Engineering books', '2019-03-31 13:41:36', '2019-03-31 13:41:36'),
(68, 'Infortion Tech', 'description', '2019-03-31 13:59:02', '2019-03-31 13:59:02'),
(69, 'New Category', '', '2019-04-11 23:12:38', '2019-04-11 23:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
CREATE TABLE IF NOT EXISTS `prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `effective` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `book_id`, `price`, `effective`, `created_at`, `updated_at`) VALUES
(4, 5, 0, 1, '2019-04-11 15:35:53', '2019-04-11 15:35:53'),
(5, 4, 50, 0, '2019-04-11 15:43:00', '2019-04-11 15:43:00'),
(6, 4, 0, 0, '2019-04-11 15:43:27', '2019-04-11 15:43:27'),
(7, 4, 25, 0, '2019-04-11 15:47:01', '2019-04-11 15:47:01'),
(8, 4, 0, 0, '2019-04-11 15:47:08', '2019-04-11 15:47:08'),
(9, 4, 56, 1, '2019-04-11 15:47:33', '2019-04-11 15:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
CREATE TABLE IF NOT EXISTS `purchase_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `book_price` double NOT NULL,
  `payment_copy` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `user_id`, `book_id`, `book_price`, `payment_copy`, `status`, `created_at`, `updated_at`) VALUES
(2, 5676, 4, 56, 'payments/Object Oriented Methodologies.JPG', 2, '2019-04-11 18:02:11', '2019-04-11 18:02:11'),
(3, 5676, 4, 56, 'payments/Object Oriented Methodologies.JPG', 1, '2019-04-11 18:04:33', '2019-04-11 18:04:33'),
(4, 5676, 4, 56, 'payments/Object Oriented Methodologies.JPG', 2, '2019-04-11 18:05:14', '2019-04-11 18:05:14'),
(5, 3456, 4, 56, 'payments/software archi.PNG', 1, '2019-04-11 18:07:30', '2019-04-11 18:07:30'),
(6, 5676, 4, 56, 'payments/oop php.JPG', 1, '2019-04-11 23:18:18', '2019-04-11 23:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `role_name`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'Administrator', '2019-01-01 20:46:06', '2019-01-01 20:46:06'),
(3, 'customer', 'Customer', '2019-01-01 20:46:06', '2019-01-01 20:46:06'),
(4, 'officer', 'Record Officer', '2019-01-01 20:46:48', '2019-01-01 20:46:48'),
(5, 'manager', 'Manager', '2019-01-01 20:46:48', '2019-01-01 20:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
CREATE TABLE IF NOT EXISTS `role_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(4, 4121, 2, '2019-01-01 21:43:01', '2019-01-01 21:43:01'),
(25, 5656, 3, '2019-01-12 10:12:03', '2019-01-12 10:12:03'),
(26, 5656, 4, '2019-01-13 08:09:31', '2019-01-13 08:09:31'),
(33, 25623, 5, '2019-01-13 22:21:58', '2019-01-13 22:21:58'),
(38, 6752, 2, '2019-01-21 12:11:08', '2019-01-21 12:11:08'),
(40, 342, 2, '2019-03-12 11:19:03', '2019-03-12 11:19:03'),
(44, 2312, 2, '2019-03-27 19:56:38', '2019-03-27 19:56:38'),
(45, 3456, 3, '2019-03-27 20:02:54', '2019-03-27 20:02:54'),
(46, 21412412, 2, '2019-03-30 13:55:01', '2019-03-30 13:55:01'),
(47, 456363, 2, '2019-03-30 13:59:30', '2019-03-30 13:59:30'),
(48, 7890, 2, '2019-03-30 14:03:54', '2019-03-30 14:03:54'),
(50, 3242, 2, '2019-03-30 14:05:20', '2019-03-30 14:05:20'),
(51, 8765, 2, '2019-03-30 14:06:05', '2019-03-30 14:06:05'),
(52, 898, 2, '2019-03-30 14:26:08', '2019-03-30 14:26:08'),
(53, 64745, 3, '2019-03-30 15:02:11', '2019-03-30 15:02:11'),
(54, 5676, 4, '2019-03-31 12:21:07', '2019-03-31 12:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `sales_transactions`
--

DROP TABLE IF EXISTS `sales_transactions`;
CREATE TABLE IF NOT EXISTS `sales_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `mobile`, `city`, `state`, `profile_pic`) VALUES
(342, '242', '68595f6479e11e3d5818c3fadbbf3977', 'ddsfsd', 'sdfsd', 'myemail@gmail.com', '3254235', 'xcbxc', 'Amhara', NULL),
(898, '', 'd41d8cd98f00b204e9800998ecf8427e', 'ALEMU', 'GEBEYAW', '', '', '', '', 'images/img_avatar599.png'),
(2312, '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '', '', NULL),
(3242, '', 'd41d8cd98f00b204e9800998ecf8427e', 'John ', 'Yosseph', '', '', '', '', 'images/PlaceholderBook.png'),
(3456, 'ASTER', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'ASTER ', 'NEGA', 'myemail@gmail.com', '3254235', 'Debremarkos', 'Amhara', NULL),
(4121, 'wobie123', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'WOBETU', 'SHIFERAW', 'example@gmail.com', '724725', 'Debremarkos', 'AMHARA', ''),
(5656, 'user4545', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'ASTER', 'AWOKE', 'asterawoke@gmail.com', '27467223', 'Addis Ababa', 'Addis Ababa', NULL),
(5676, 'Officer2', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'Yohannes', 'Girma', 'myemail@gmail.com', '83758375', 'BAHIRDAR', 'Amhara', 'images/img_avatar599.png'),
(6752, 'USER99', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'GETAHUN', 'ALEBACHEW', 'myemail@gmail.com', '5463254625', 'Addis Ababa', 'Addis Ababa', NULL),
(7890, '', 'd41d8cd98f00b204e9800998ecf8427e', 'MASTE', '', '', '', '', '', NULL),
(8765, '', 'd41d8cd98f00b204e9800998ecf8427e', 'Yonathan', 'Alemu', '', '', '', '', 'images/img_avatar3.png'),
(25623, 'USER5544', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'AHMEDIN', 'MOHAMMED', 'myexample@example.com', '748347', 'Bahirdar', 'AMHARA', NULL),
(64745, 'Wobetu', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'Wobetu', 'Shiferaw', 'myemail@gmail.com', '464646', 'Debremarkos', 'Amhara', 'images/IMG_20170602_025022.jpg'),
(456363, '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '', '', NULL),
(21412412, 'wsf', '5941f46c6079199a03b2e6a80501bf59', 'dsf', '', '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_locations`
--

DROP TABLE IF EXISTS `user_locations`;
CREATE TABLE IF NOT EXISTS `user_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `loc_country` varchar(255) NOT NULL,
  `loc_region` varchar(255) NOT NULL,
  `loc_zone` varchar(255) NOT NULL,
  `loc_city` varchar(255) NOT NULL,
  `loc_subcity` varchar(255) NOT NULL,
  `loc_kebele` varchar(255) DEFAULT NULL,
  `loc_house_no` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_locations`
--

INSERT INTO `user_locations` (`id`, `user_id`, `loc_country`, `loc_region`, `loc_zone`, `loc_city`, `loc_subcity`, `loc_kebele`, `loc_house_no`, `created_at`, `updated_at`) VALUES
(49, 25623, 'ETHIOPIA', 'TIGRAY', 'NORTH TIGRAY', 'ADWA', 'ADWA', 'ADWA', '354635', '2019-03-27 17:49:35', '2019-03-27 17:49:35'),
(50, 25623, 'ETHIOPIA', 'TIGRAY', 'NORTH TIGRAY', 'ADWA', 'ADWA', 'ADWA', '354635', '2019-03-27 17:50:29', '2019-03-27 17:50:29'),
(62, 6752, 'Ethiopia', 'OROMIA', 'ADAMA', 'ADAMA', 'ADAMA', '09', '24352', '2019-03-30 13:01:39', '2019-03-30 13:01:39'),
(63, 342, '', '', '', '', '', '', '', '2019-03-30 13:12:01', '2019-03-30 13:12:01'),
(64, 64745, 'Ethiopia', 'AMHARA', 'E/Gojjam', 'DM', 'DM ', '05', '544646', '2019-03-30 15:02:46', '2019-03-30 15:02:46'),
(65, 8765, 'reter', '', '', '', '', '', '', '2019-03-31 14:00:09', '2019-03-31 14:00:09'),
(66, 5676, '', '', '', '', '', '', '', '2019-03-31 19:13:24', '2019-03-31 19:13:24'),
(67, 5656, 'Ethiopia', 'AMHARA', 'E/Gojjam', 'Debremarkos', 'ADAMA', '02', '25462', '2019-04-11 23:10:15', '2019-04-11 23:10:15');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activations`
--
ALTER TABLE `activations`
  ADD CONSTRAINT `activations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `book_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_orders_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_users_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales_transactions`
--
ALTER TABLE `sales_transactions`
  ADD CONSTRAINT `sales_transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_transactions_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Constraints for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD CONSTRAINT `user_locations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
