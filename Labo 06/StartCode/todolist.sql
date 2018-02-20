-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2014 at 12:24 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

DROP TABLE IF EXISTS `todos`;
CREATE TABLE `todos` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `what` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` enum('high','normal','low') COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `user_id`, `what`, `priority`, `added_on`) VALUES
(2, 1, 'A normal priority task', 'normal', '2012-12-03 13:56:08'),
(5, 2, 'A high priority Task', 'high', '2014-10-15 12:19:30'),
(12, 0, 'Pile of Poo Test: 💩', 'high', '2014-10-15 12:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'joris', '$2y$10$/FPq.CjbqsI5ShQTMP33SevKq4CuIPm1fI8gIhZY/Knm5TiVm1vnm'),
(2, 'kevin', '$2y$10$EbUrgw9iguKDLGZRiWYIK.bZbubV1AVmFMIsM.bOW/ioscH7Desle');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
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
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;