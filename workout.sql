-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2021 at 03:06 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workout`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(2, 'Yoga'),
(3, 'Fat burning');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `exercise_duration` varchar(10) NOT NULL,
  `video_link` varchar(100) NOT NULL,
  `owner` int(4) NOT NULL,
  `exercise_name` varchar(25) NOT NULL,
  `rating_sum` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `description`, `exercise_duration`, `video_link`, `owner`, `exercise_name`, `rating_sum`, `category`, `active`) VALUES
(1, 'Forearms', '15 min', 'https://www.youtube.com/embed/hpdz0Woc7k4', 8, 'Forarms muscle', 37, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(10) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `rating_sum` int(10) DEFAULT 0,
  `rating_count` int(5) NOT NULL DEFAULT 0,
  `avatar` varchar(20) NOT NULL,
  `active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `firstname`, `lastname`, `rating_sum`, `rating_count`, `avatar`, `active`) VALUES
(8, 'Angelov', 'Viktor', 5, 1, '983.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL,
  `code` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `registration_expires` datetime NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT 0,
  `code_password` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_password_expires` datetime DEFAULT NULL,
  `biography` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `firstname`, `lastname`, `phone`, `password`, `user_type`, `code`, `registration_expires`, `active`, `code_password`, `new_password_expires`, `biography`) VALUES
(1, 'maja@maja.com', 'maja@maja.com', 'test', 'test', '0123e', '$2y$10$Uf4FNw8jRNbVcd6dG2N55.H9IOVmgZuezEp/Fpbfoh.8SyfWykMwu', 1, 'QmmfrxzCxyarwzOgurvvhEbvyfdbFrlcbliMayqw', '2021-07-16 22:22:37', 1, 'OufrlzfKeztzwrOqrdcmjAczxxelLxwuvqfSvqvx', '2021-08-29 14:38:11', '0'),
(2, 'maja@maja1.com', 'maja@maja1.com', 'test', 'test', '0123456', '$2y$10$woVTLEjEYFse8KhZ9Dw/m..ygnDff2sU98tTY3k62ZTvTX0MMoOUS', 2, 'YtbfwiXxgylbCnjhktYwbzgmSubnrcWxxqyoDsys', '2021-07-26 16:10:19', 0, NULL, NULL, ''),
(8, 'maja@maja2.com', 'maja@maja2.com', 'test', 'test', '0123456', '$2y$10$mnVACVs7S0pNs7HffkCa0.xS7tpMegPn4Pifoi7N6I.VZfD4U/4nS', 3, 'KooyxkliYuinxjniZqlgmtfsYvgwmgueZdsqpjjr', '2021-07-26 21:15:30', 1, NULL, NULL, 'asdasdasdasdasdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `ut_id` int(11) NOT NULL,
  `user_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`ut_id`, `user_type`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Coach');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`ut_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
