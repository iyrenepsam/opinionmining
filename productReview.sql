-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 18, 2020 at 04:16 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `productReview`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(555) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`) VALUES
(1, 'Apple iPhone 11 Pro Max'),
(2, 'Apple iPhone 11 Pro'),
(3, 'Apple iPhone 11'),
(4, 'Samsung Note 20 Ultra'),
(5, 'Samsung Note 20'),
(6, 'Samsung Note 10'),
(7, 'OnePlus 8'),
(8, 'OnePlus 8 Pro');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` varchar(666) NOT NULL,
  `feature` varchar(66) NOT NULL,
  `ip` varchar(66) NOT NULL,
  `polarity` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `prod_id`, `user_id`, `review`, `feature`, `ip`, `polarity`, `active`, `dateTime`) VALUES
(3, 1, 1, '\r\nthis is a tesr mness\r\n                ', 'Overall', '127.0.0.1', 0, 0, '2020-08-17 12:32:24'),
(4, 8, 1, '\r\ndf\r\n                ', 'Performance', '127.0.0.1', 0, 0, '2020-08-17 12:32:24'),
(5, 1, 1, ' Good Phone', 'Overall', '127.0.0.1', 1, 0, '2020-08-17 12:32:24'),
(6, 1, 1, ' not so good as expected ', 'Overall', '127.0.0.1', -1, 0, '2020-08-17 12:32:24'),
(7, 1, 1, 'bad experience with that phone ', 'Overall', '127.0.0.1', -1, 0, '2020-08-17 12:32:45'),
(8, 7, 1, ' good', 'Camera', '127.0.0.1', 1, 0, '2020-08-17 13:52:56'),
(9, 7, 1, ' amazing', 'Build Quality', '192.168.31.100', 1, 0, '2020-08-17 14:50:48'),
(10, 7, 1, ' Amazing Quality of phone ', 'Camera', '192.168.31.100', 1, 0, '2020-08-17 14:51:16'),
(11, 7, 1, 'Poor quality of camera ', 'Camera', '127.0.0.1', -1, 0, '2020-08-17 14:53:05'),
(12, 1, 2, 'good phone ', 'Overall', '127.0.0.1', 1, 0, '2020-08-17 15:11:02'),
(13, 1, 2, ' bad phone', 'Overall', '127.0.0.1', -1, 0, '2020-08-17 15:11:18'),
(14, 7, 2, ' good phone ', 'Overall', '127.0.0.1', 1, 1, '2020-08-17 15:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(44) NOT NULL,
  `address` varchar(555) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `emailId` varchar(44) NOT NULL,
  `password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `mobile`, `emailId`, `password`) VALUES
(1, 'ANISH S NAIR', 'Vilayil Puthen Veedu', 9496873618, 'anish.vilayil.s@gmail.com', '12345@Anish'),
(2, 'ANISH S NAIR', 'Vilayil Puthen Veedu', 9496873618, 'anish@gmail.com', '12345@Anish');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
