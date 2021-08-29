-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 29, 2021 at 01:18 PM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vtsgirls`
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
(0, 'a'),
(2, 'Yoga'),
(3, 'Fat burning');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id_city` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `country` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id_city`, `name`, `country`) VALUES
(1, 'Subotica', 'Serbia'),
(2, 'Belgrade', 'Serbia'),
(3, 'Budapest', 'Hungary'),
(4, 'London', 'UK');

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
(1, 'Forearms', '15 min', 'https://www.youtube.com/embed/hpdz0Woc7k4', 8, 'Forarms muscle', 53, 2, 1),
(11, 'fat burning', '30 min', 'https://www.youtube.com/watch?v=gC_L9qAHVJ8&ab_channel=BodyProject', 25, 'fat burning', 1, 3, 1),
(12, 'af', '11 min', 'https://www.youtube.com/watch?v=gC_L9qAHVJ8&ab_channel=BodyProject', 25, 'a', 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `guest` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `registered user` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `registered user-trainer` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `admin` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(10) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `rating_sum` int(10) DEFAULT '0',
  `rating_count` int(5) NOT NULL DEFAULT '0',
  `avatar` varchar(20) NOT NULL,
  `active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `firstname`, `lastname`, `rating_sum`, `rating_count`, `avatar`, `active`) VALUES
(8, 'Angelov', 'Dimitry', 23, 7, '983.png', 1),
(24, 'm', 'm', 8, 2, 'team-1.jpg', 0),
(25, 'm', 'm', 0, 0, 'team-1.jpg', 0);

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
  `active` smallint(1) NOT NULL DEFAULT '0',
  `code_password` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_password_expires` datetime DEFAULT NULL,
  `biography` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `firstname`, `lastname`, `phone`, `password`, `user_type`, `code`, `registration_expires`, `active`, `code_password`, `new_password_expires`, `biography`) VALUES
(1, 'maja@maja.com', 'maja@maja.com', 'test', 'test', '0123e', '$2y$10$UOvBWlgK3Ui87XPjzKHTSerxvGbv0Er42TzSxZ.6U2boztDC8p7Qy', 1, 'QmmfrxzCxyarwzOgurvvhEbvyfdbFrlcbliMayqw', '2021-07-16 22:22:37', 1, NULL, NULL, '0'),
(2, 'maja@maja1.com', 'maja@maja1.com', 'test', 'test', '0123456', '$2y$10$UOvBWlgK3Ui87XPjzKHTSerxvGbv0Er42TzSxZ.6U2boztDC8p7Qy', 2, 'YtbfwiXxgylbCnjhktYwbzgmSubnrcWxxqyoDsys', '2021-07-26 16:10:19', 1, NULL, NULL, ''),
(8, 'maja@maja2.com', 'maja@maja2.com', 'Maja', 'Antunovic', '0123456', '$2y$10$UOvBWlgK3Ui87XPjzKHTSerxvGbv0Er42TzSxZ.6U2boztDC8p7Qy', 3, 'KooyxkliYuinxjniZqlgmtfsYvgwmgueZdsqpjjr', '2021-07-26 21:15:30', 1, NULL, NULL, 'Test bio'),
(23, 'ostroskipatricija1@gmail.com', 'ostroskipatricija1@gmail.com', 'Patri', 'Ostro', '0123456789', '$2y$10$Pi13t7I4b8/OrvYzPbQUhu1B2Nj.ZfshZz4X2I.9T/0htD7MIDnTK', 2, '', '0000-00-00 00:00:00', 1, NULL, NULL, ''),
(24, 'm@gmail.com', 'm@gmail.com', 'm', 'm', '1230456', '$2y$10$LjovejeeYDvJwLB4QYTRTeNwfpkCAK0PAZkW8cB/WK8Tqyu8Ihww.', 3, 'DpfphyiwEjiaigkoInlobclxNucweounCgtobntr', '2021-08-30 12:48:37', 0, NULL, NULL, 'a'),
(25, 'majaantunovic8@gmail.com', 'majaantunovic8@gmail.com', 'm', 'm', '0123456', '$2y$10$0P1PIKDlFsQq5Ew7ZVPUU.URxZfelEP1g8O7FgUMhTDnc1LkBeoC.', 3, '', '0000-00-00 00:00:00', 1, NULL, NULL, 'a'),
(26, 'majaantunovic8@gmail.com', 'majaantunovic8@gmail.com', 'a', 'a', '987654321', '$2y$10$ocDIw3EM07.rQByC5whWP.Y9TkwSx5k2/DTCQa/mDcpiWzcxZsi/O', 2, '', '0000-00-00 00:00:00', 1, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `id_city` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `education` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `college` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `id_city`, `first_name`, `last_name`, `email`, `education`, `college`) VALUES
(1, 1, 'Name', 'Lastname', 'user@mail.com', 'college', 'VTS'),
(2, 3, 'podatak', 'podatak', 'nesto@mail.com', 'high-school', ''),
(6, 4, 'proba', 'proba2', 'proba@email.com', 'college', 'VTS');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
