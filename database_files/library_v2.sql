-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2022 at 02:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `user_id` varchar(36) NOT NULL,
  `ISBN` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`user_id`, `ISBN`) VALUES
('1', '1234523876954'),
('f87d0f9d-2287-4821-96cd-e84caf8e7e53', '1234523876954');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ISBN` varchar(13) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_img` varchar(255) NOT NULL DEFAULT 'no_cover.png',
  `author` varchar(255) DEFAULT NULL,
  `publication` varchar(255) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `language` varchar(50) NOT NULL DEFAULT '(EN) English',
  `price` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `total_qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `available_qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `access_level` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN`, `title`, `description`, `cover_img`, `author`, `publication`, `publication_date`, `language`, `price`, `total_qty`, `available_qty`, `access_level`, `created_at`, `updated_at`) VALUES
('1234523876954', 'Harry Potter and the Goblet of Fire', '3rd Book in the Harry Potter Series\r\nWhen Harry gets chosen as the fourth participant in the inter-school Triwizard Tournament, he is unwittingly pulled into a dark conspiracy that slowly unveils its dangerous agenda.', '1234523876954.jpg', 'J.K. Rowling', 'London Penguin', '2017-04-11', '(CN) Chinese', '25.50', 3, 3, 3, '2022-07-31 13:23:00', '2022-08-14 09:41:26'),
('7987654321012', 'Fantastic Beasts And Where to Find Them', 'A book set in the Universe of Harry Potter Fantastic Beasts', '7987654321012.jpg', 'J.K. Rowling', 'London', '2022-02-07', '(EN) English', '50.90', 2, 2, 1, '2022-07-31 13:06:29', '2022-08-12 07:26:09'),
('9781368036986', 'Artemis Fowl Book 1', 'Now an original movie on Disney+, here is the book that started it all, the international bestseller about a teenage criminal mastermind and his siege against dangerous, tech-savvy fairies.\r\nNew York Times best-selling author, Eoin Colfer and series, Artemis Fowl!\r\nTwelve-year-old criminal mastermind Artemis Fowl has discovered a world below ground of armed and dangerous--and extremely high-tech--fairies.\r\nHe kidnaps one of them, Holly Short, and holds her for ransom in an effort to restore his family\'s fortune.\r\nBut he may have underestimated the fairies\' powers. Is he about to trigger a cross-species war?', '9781368036986.jpg', 'Eoin Colfer', 'Disney-Hyperion; Reprint edition (October 2, 2018)', '2018-10-02', '(EN) English', '35.70', 1, 1, 1, '2022-08-06 09:52:25', '2022-08-14 09:41:04'),
('9781536204957', 'The Last Map Maker', 'A book about the Last Map Maker', '9781536204957.jpg', 'Christina Soontornvat', 'London', '2022-07-01', '(EN) English', '100.00', 0, 0, 2, '2022-07-31 13:12:15', '2022-07-31 13:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `borrowhistory`
--

CREATE TABLE `borrowhistory` (
  `user_id` varchar(36) NOT NULL,
  `material_no` bigint(20) UNSIGNED NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `borrowed_at` datetime NOT NULL DEFAULT current_timestamp(),
  `due_at` date NOT NULL,
  `returned_at` datetime DEFAULT NULL,
  `late_fees` decimal(10,2) UNSIGNED DEFAULT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 - borrowed\r\n2 - returned\r\n3 - missing',
  `created_by` varchar(36) NOT NULL COMMENT 'admin account that processed this transaction'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrowhistory`
--

INSERT INTO `borrowhistory` (`user_id`, `material_no`, `ISBN`, `borrowed_at`, `due_at`, `returned_at`, `late_fees`, `status`, `created_by`) VALUES
('1', 5, '1234523876954', '2022-08-05 19:39:03', '2022-07-12', '2022-08-05 13:03:10', '1.50', 2, '1'),
('1', 6, '1234523876954', '2022-08-05 19:41:15', '2022-07-12', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 1, '1234523876954', '2022-08-05 19:42:31', '2022-07-12', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 1, '1234523876954', '2022-08-05 20:41:49', '2022-08-19', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 5, '1234523876954', '2022-08-05 20:44:15', '2022-08-19', '2022-08-05 13:03:10', '1.50', 2, '1'),
('1', 6, '1234523876954', '2022-08-05 20:47:24', '2022-08-19', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 1, '1234523876954', '2022-08-05 20:51:46', '2022-08-19', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 5, '1234523876954', '2022-08-05 20:54:23', '2022-08-19', '2022-08-05 13:03:10', '1.50', 2, '1'),
('1', 6, '1234523876954', '2022-08-05 20:56:43', '2022-08-19', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 1, '1234523876954', '2022-08-05 21:03:56', '2022-08-19', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 6, '1234523876954', '2022-08-05 21:04:28', '2022-08-19', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 5, '1234523876954', '2022-08-06 12:13:30', '2022-08-20', '2022-08-05 13:03:10', '1.50', 2, '1'),
('1', 7, '7987654321012', '2022-08-09 19:39:57', '2022-08-23', '2022-08-09 11:43:29', NULL, 2, '1'),
('1', 8, '7987654321012', '2022-08-09 19:42:40', '2022-08-23', '2022-08-09 11:43:34', NULL, 2, '1'),
('1', 8, '7987654321012', '2022-08-09 19:43:43', '2022-08-23', '2022-08-09 11:46:49', NULL, 2, '1'),
('1', 7, '7987654321012', '2022-08-09 19:45:14', '2022-08-23', '2022-08-09 11:46:54', NULL, 2, '1'),
('1', 6, '1234523876954', '2022-08-09 19:46:01', '2022-08-23', '2022-08-09 11:46:45', NULL, 2, '1'),
('1', 1, '1234523876954', '2022-08-09 19:47:06', '2022-08-23', '2022-08-09 11:51:20', NULL, 2, '1'),
('1', 5, '1234523876954', '2022-08-09 19:50:20', '2022-08-23', '2022-08-09 11:51:08', '1.50', 2, '1'),
('f87d0f9d-2287-4821-96cd-e84caf8e7e53', 6, '1234523876954', '2022-08-11 13:55:19', '2022-08-25', '2022-08-11 05:55:24', NULL, 2, 'f87d0f9d-2287-4821-96cd-e84caf8e7e53'),
('f87d0f9d-2287-4821-96cd-e84caf8e7e53', 9, '9781368036986', '2022-08-12 14:33:24', '2022-08-26', '2022-08-14 09:41:04', '0.00', 2, '1'),
('f87d0f9d-2287-4821-96cd-e84caf8e7e53', 1, '1234523876954', '2022-08-12 14:34:26', '2022-08-26', '2022-08-14 09:41:26', '0.00', 2, '1'),
('f87d0f9d-2287-4821-96cd-e84caf8e7e53', 7, '7987654321012', '2022-08-12 15:25:48', '2022-08-19', '2022-08-12 07:26:09', NULL, 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `privilege` int(10) UNSIGNED NOT NULL,
  `no_of_borrows` int(10) UNSIGNED NOT NULL COMMENT 'number of books that can be borrowed per person',
  `borrow_duration` int(10) UNSIGNED NOT NULL COMMENT 'days for borrow due',
  `late_fees_base` decimal(10,2) UNSIGNED NOT NULL COMMENT 'penalty for missing dues',
  `late_fees_increment` decimal(10,2) UNSIGNED NOT NULL COMMENT 'additional penalty increments by day',
  `point_limit` int(10) UNSIGNED NOT NULL DEFAULT 1000 COMMENT 'Limit on Weekly Point Gain',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`privilege`, `no_of_borrows`, `borrow_duration`, `late_fees_base`, `late_fees_increment`, `point_limit`, `created_at`, `updated_at`) VALUES
(1, 3, 14, '2.00', '1.00', 1100, '2022-08-09 19:25:37', '2022-08-09 11:27:00'),
(2, 3, 7, '2.00', '1.00', 1100, '2022-08-09 19:25:37', '2022-08-09 11:27:00'),
(3, 2, 7, '2.00', '1.00', 1100, '2022-08-09 19:25:37', '2022-08-09 11:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `material_no` bigint(20) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `call_no` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 - available 2 - borrowed 3 - missing',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_no`, `ISBN`, `call_no`, `status`, `created_at`, `updated_at`) VALUES
(1, '1234523876954', 'GHH 567 784', 1, '2022-08-01 00:00:00', '2022-08-14 09:41:26'),
(5, '1234523876954', 'GHH 567 786', 1, '2022-08-03 07:55:37', '2022-08-10 06:41:23'),
(6, '1234523876954', 'GHH 567 788', 1, '2022-08-03 07:56:15', '2022-08-11 05:55:24'),
(7, '7987654321012', 'GHH 567 780', 1, '2022-08-03 00:00:00', '2022-08-12 07:26:09'),
(8, '7987654321012', 'LCC 525 125', 1, '2022-08-06 04:10:04', '2022-08-09 11:46:49'),
(9, '9781368036986', 'LCC 525 223', 1, '2022-08-01 00:00:00', '2022-08-14 09:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `rewardhistory`
--

CREATE TABLE `rewardhistory` (
  `user_id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(511) NOT NULL,
  `points_required` int(10) UNSIGNED NOT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 - Unclaimed\r\n2 - Claimed\r\n3 - Canceled',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'on create',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rewardhistory`
--

INSERT INTO `rewardhistory` (`user_id`, `name`, `description`, `points_required`, `status`, `created_at`, `updated_at`) VALUES
('1', 'Book', 'A free book within the cost of RM 10.00', 1000, 1, '2022-08-08 09:15:31', '2022-08-14 09:07:36'),
('1', 'Book', 'A free book within the cost of RM 10.00', 1000, 1, '2022-08-11 13:56:21', '2022-08-14 09:07:36'),
('1', 'Book', 'A free book within the cost of RM 10.00', 100, 1, '2022-08-14 10:06:12', '2022-08-14 02:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(511) DEFAULT NULL,
  `reward_img` varchar(255) DEFAULT 'no_img_available.jpg',
  `points_required` int(11) NOT NULL DEFAULT 0,
  `available_qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`id`, `name`, `description`, `reward_img`, `points_required`, `available_qty`, `created_at`, `updated_at`) VALUES
(1, 'Book', 'A free book within the cost of RM 10.00', 'Artemis Fowl.jpg?1659781526', 100, 6, '2022-08-06 10:25:26', '2022-08-14 10:06:12'),
(3, 'Stationary', 'Some Desc', '1660286331_statio.jpg', 5000, 3, '2022-08-12 06:38:51', '2022-08-14 10:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `total_points` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `current_points` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `weekly_points` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Tracks Points Earned this week',
  `last_check_in` date NOT NULL DEFAULT current_timestamp(),
  `privilege` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1 - Admin\r\n2 - Privileged User\r\n3 - Basic User',
  `remember_token` varchar(100) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `total_points`, `current_points`, `weekly_points`, `last_check_in`, `privilege`, `remember_token`, `updated_at`, `created_at`) VALUES
('1', 'Simhk', 'simhk625@gmail.com', '$2y$10$cnZQIqXVmq.ILGQydqULhuujV29uPIEdAyMuRHDP/oGQaU8IIzLwG', 3150, 800, 1100, '2022-08-14', 1, 'xH3V3WJkF1IqM074n22adQibHtIzcJvloMLaxj0NVtQ7rmyk0NOHoYWqYPLL', '2022-08-14 10:06:12', '2022-07-25 03:40:05'),
('2', 'User', 'simhongkai625@hotmail.com', '$2y$10$HbtrJsGmCS.rTRCwoTY5eeMqatV/kt3BgAQh7kfZt752MrjXtNoJ6', 2000, 0, 1000, '2022-07-31', 3, NULL, '2022-07-31 13:28:55', '2022-07-31 13:28:55'),
('f87d0f9d-2287-4821-96cd-e84caf8e7e53', 'Simhk', 'simhk@gmail.com', '$2y$10$GjaqarDOTQZwN1CQzYNOaujDtPt1vjM8kVo0R9fPxahvGDnty7pWu', 550, 550, 1000, '2022-08-12', 2, NULL, '2022-08-14 09:41:26', '2022-08-10 06:33:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`privilege`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_no`),
  ADD UNIQUE KEY `call_no_unique` (`call_no`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `reset_weekly_points` ON SCHEDULE EVERY 7 DAY STARTS '2022-08-14 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE `users` SET `weekly_points`= 0 WHERE 1$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
