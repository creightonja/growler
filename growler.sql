-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost:8080
-- Generation Time: Sep 02, 2015 at 10:35 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `growler`
--
CREATE DATABASE IF NOT EXISTS `growler` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `growler`;

-- --------------------------------------------------------

--
-- Table structure for table `beers`
--

CREATE TABLE IF NOT EXISTS `beers` (
  `id` bigint(20) unsigned NOT NULL,
  `beer_name` varchar(255) DEFAULT NULL,
  `style` varchar(255) DEFAULT NULL,
  `abv` decimal(4,2) DEFAULT NULL,
  `ibu` int(11) DEFAULT NULL,
  `container` varchar(255) DEFAULT NULL,
  `brewery` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beers`
--

INSERT INTO `beers` (`id`, `beer_name`, `style`, `abv`, `ibu`, `container`, `brewery`, `image`) VALUES
(1, 'Bud Light', 'blah', '4.45', 40, 'bottle', 'Budweiser', NULL),
(2, 'Big Beer', 'IPA', '4.55', 40, 'bottle', 'Big Beer Brewery', NULL),
(3, 'Little Beer', 'IPA', '4.22', 30, 'bottle', 'Little beer brewery', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `beers_stores`
--

CREATE TABLE IF NOT EXISTS `beers_stores` (
  `id` bigint(20) unsigned NOT NULL,
  `beer_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint(20) NOT NULL,
  `beer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `review` text,
  `review_date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `beer_id`, `user_id`, `review`, `review_date`) VALUES
(1, 1, 1, 'Tastes Good', NULL),
(2, 1, 1, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 1, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(20) unsigned NOT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `category`, `region`, `address`) VALUES
(1, 'Bennigans', 'Bar', 'Northeast', '123 Bad beer lane.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `preferred_style` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `preferred_style`, `region`) VALUES
(1, 'John', 'girly beers', 'NE'),
(2, 'Bryan', 'IPA', 'Northeast'),
(3, 'Jason', 'IPA', 'NE'),
(4, 'Admin', 'IPA', 'NE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beers`
--
ALTER TABLE `beers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `beers_stores`
--
ALTER TABLE `beers_stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beers`
--
ALTER TABLE `beers`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `beers_stores`
--
ALTER TABLE `beers_stores`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
