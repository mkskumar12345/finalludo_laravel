-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2023 at 08:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lodo`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `challanges_result`
--

CREATE TABLE `challanges_result` (
  `id` int(11) NOT NULL,
  `challange_id` int(11) DEFAULT NULL,
  `creator_action` varchar(255) DEFAULT NULL,
  `creator_image` varchar(255) DEFAULT NULL,
  `acceptor_action` varchar(255) DEFAULT NULL,
  `acceptor_image` varchar(255) DEFAULT NULL,
  `creator_time` varchar(255) DEFAULT NULL,
  `acceptor_time` varchar(255) DEFAULT NULL,
  `cencal_acceptor` tinyint(1) DEFAULT NULL,
  `cencal_creator` tinyint(1) DEFAULT NULL,
  `cencal_acceptor_reason` text DEFAULT NULL,
  `cencal_creator_reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `challanges_result`
--

INSERT INTO `challanges_result` (`id`, `challange_id`, `creator_action`, `creator_image`, `acceptor_action`, `acceptor_image`, `creator_time`, `acceptor_time`, `cencal_acceptor`, `cencal_creator`, `cencal_acceptor_reason`, `cencal_creator_reason`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 14:46:57', '2023-08-02 14:46:57'),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 14:51:56', '2023-08-02 14:51:56'),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 14:54:18', '2023-08-02 14:54:18'),
(4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:03:33', '2023-08-02 15:03:33'),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:04:52', '2023-08-02 15:04:52'),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:05:30', '2023-08-02 15:05:30'),
(7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:06:58', '2023-08-02 15:06:58'),
(8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:07:52', '2023-08-02 15:07:52'),
(9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:10:48', '2023-08-02 15:10:48'),
(10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:20:07', '2023-08-02 15:20:07'),
(11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:20:40', '2023-08-02 15:20:40'),
(12, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:21:28', '2023-08-02 15:21:28'),
(13, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:22:20', '2023-08-02 15:22:20'),
(14, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:23:42', '2023-08-02 15:23:42'),
(15, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:25:06', '2023-08-02 15:25:06'),
(16, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:26:49', '2023-08-02 15:26:49'),
(17, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:27:59', '2023-08-02 15:27:59'),
(18, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:29:50', '2023-08-02 15:29:50'),
(19, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:30:36', '2023-08-02 15:30:36'),
(20, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 15:38:32', '2023-08-02 15:38:32'),
(21, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 16:03:59', '2023-08-02 16:03:59'),
(22, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-02 16:14:44', '2023-08-02 16:14:44'),
(23, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-03 06:57:20', '2023-08-03 06:57:20'),
(24, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-04 11:19:58', '2023-08-04 11:19:58'),
(25, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 00:43:47', '2023-08-12 00:43:47'),
(26, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 11:20:01', '2023-08-12 11:20:01'),
(27, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 11:27:57', '2023-08-12 11:27:57'),
(28, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 11:34:58', '2023-08-12 11:34:58'),
(29, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 11:35:16', '2023-08-12 11:35:16'),
(30, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 12:36:06', '2023-08-12 12:36:06'),
(31, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 12:36:19', '2023-08-12 12:36:19'),
(32, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 12:36:28', '2023-08-12 12:36:28'),
(33, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 12:36:33', '2023-08-12 12:36:33'),
(34, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 12:37:27', '2023-08-12 12:37:27'),
(35, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 12:37:39', '2023-08-12 12:37:39'),
(36, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 12:38:13', '2023-08-12 12:38:13'),
(37, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 12:38:18', '2023-08-12 12:38:18'),
(38, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 12:38:36', '2023-08-12 12:38:36'),
(39, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 12:38:40', '2023-08-12 12:38:40'),
(40, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 12:52:17', '2023-08-12 12:52:17'),
(41, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 12:52:27', '2023-08-12 12:52:27'),
(42, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 12:53:52', '2023-08-12 12:53:52'),
(43, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 13:42:33', '2023-08-12 13:42:33'),
(44, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 13:42:43', '2023-08-12 13:42:43'),
(45, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 13:43:00', '2023-08-12 13:43:00'),
(46, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 13:43:20', '2023-08-12 13:43:20'),
(47, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 13:45:08', '2023-08-12 13:45:08'),
(48, 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 13:50:13', '2023-08-12 13:50:13'),
(49, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 14:02:01', '2023-08-12 14:02:01'),
(50, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 14:02:10', '2023-08-12 14:02:10'),
(51, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 14:35:59', '2023-08-12 14:35:59'),
(52, 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 14:36:43', '2023-08-12 14:36:43'),
(53, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 14:37:51', '2023-08-12 14:37:51'),
(54, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-12 14:39:09', '2023-08-12 14:39:09'),
(55, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-18 11:33:45', '2023-08-18 11:33:45'),
(56, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-18 11:37:39', '2023-08-18 11:37:39'),
(57, 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-18 12:23:09', '2023-08-18 12:23:09'),
(58, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-18 12:32:39', '2023-08-18 12:32:39'),
(59, 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-18 12:34:50', '2023-08-18 12:34:50'),
(60, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-18 12:35:22', '2023-08-18 12:35:22'),
(61, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-18 12:36:47', '2023-08-18 12:36:47'),
(62, 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-18 12:54:28', '2023-08-18 12:54:28'),
(63, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-18 12:55:19', '2023-08-18 12:55:19'),
(64, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-18 12:56:07', '2023-08-18 12:56:07'),
(65, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-18 12:56:40', '2023-08-18 12:56:40'),
(66, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-20 20:25:33', '2023-08-20 20:25:33'),
(67, 63, 'looser', '', 'winner', 'Capture.PNG', '2023-08-21 16:40:18', '2023-08-21 16:16:55', NULL, NULL, NULL, NULL, '2023-08-21 10:46:55', '2023-08-21 11:10:18'),
(68, 74, 'looser', '', 'winner', 'Capture.PNG', '2023-08-21 16:44:14', '2023-08-21 16:43:06', NULL, NULL, NULL, NULL, '2023-08-21 11:11:53', '2023-08-21 11:14:14'),
(69, 75, 'winner', 'Capture.PNG', 'looser', '', '2023-08-21 16:57:26', '2023-08-21 16:57:50', NULL, NULL, NULL, NULL, '2023-08-21 11:26:02', '2023-08-21 11:27:50'),
(70, 76, 'looser', '', 'winner', 'WhatsApp Image 2023-08-21 at 12.40.14 PM.jpeg', '2023-08-21 17:35:15', '2023-08-21 17:53:22', NULL, NULL, NULL, NULL, '2023-08-21 11:28:13', '2023-08-21 12:23:22'),
(71, 77, 'winner', 'WhatsApp Image 2023-08-21 at 12.40.14 PM.jpeg', 'looser', '', '2023-08-21 17:55:12', '2023-08-21 17:59:39', NULL, NULL, NULL, NULL, '2023-08-21 12:24:05', '2023-08-21 12:29:39'),
(72, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-22 17:07:10', '2023-08-22 17:07:10'),
(73, 79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-22 17:09:06', '2023-08-22 17:09:06'),
(74, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-22 17:42:25', '2023-08-22 17:42:25'),
(75, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-22 18:43:56', '2023-08-22 18:43:56'),
(76, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-22 18:46:58', '2023-08-22 18:46:58'),
(77, 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-22 19:02:13', '2023-08-22 19:02:13'),
(78, 84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-23 17:25:45', '2023-08-23 17:25:45'),
(79, 85, 'looser', '', 'winner', 'WhatsApp Image 2023-08-21 at 12.40.14 PM.jpeg', '2023-08-24 01:39:35', '2023-08-24 01:36:23', NULL, NULL, NULL, NULL, '2023-08-23 17:29:02', '2023-08-23 20:09:35'),
(80, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-23 19:15:19', '2023-08-23 19:15:19'),
(81, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-23 19:17:14', '2023-08-23 19:17:14'),
(82, 88, 'winner', 'WhatsApp Image 2023-08-21 at 12.40.14 PM.jpeg', 'looser', '', '2023-08-24 01:42:11', '2023-08-24 01:43:26', NULL, NULL, NULL, NULL, '2023-08-23 20:10:50', '2023-08-23 20:13:26'),
(83, 89, 'looser', '', 'winner', 'WhatsApp Image 2023-08-21 at 12.40.14 PM.jpeg', '2023-08-24 01:45:56', '2023-08-24 01:45:49', NULL, NULL, NULL, NULL, '2023-08-23 20:14:08', '2023-08-23 20:15:56'),
(84, 90, 'looser', '', 'winner', 'WhatsApp Image 2023-08-21 at 12.40.14 PM.jpeg', '2023-08-24 01:49:20', '2023-08-24 01:49:13', NULL, NULL, NULL, NULL, '2023-08-23 20:18:28', '2023-08-23 20:19:20'),
(85, 91, 'looser', '', 'winner', 'Capture.PNG', '2023-08-24 01:54:49', '2023-08-24 01:54:31', NULL, NULL, NULL, NULL, '2023-08-23 20:23:45', '2023-08-23 20:24:49'),
(86, 92, 'winner', 'Capture111.PNG', 'looser', '', '2023-08-24 01:57:41', '2023-08-24 01:57:49', NULL, NULL, NULL, NULL, '2023-08-23 20:26:36', '2023-08-23 20:27:49'),
(87, 93, 'winner', 'WhatsApp Image 2023-08-21 at 12.40.14 PM.jpeg', 'looser', '', '2023-08-24 02:00:28', '2023-08-24 02:00:34', NULL, NULL, NULL, NULL, '2023-08-23 20:29:29', '2023-08-23 20:30:34'),
(88, 94, 'winner', 'dmitry-chernyshov-mP7aPSUm7aE-unsplash.jpg', 'looser', '', '2023-08-24 02:03:54', '2023-08-24 02:04:09', NULL, NULL, NULL, NULL, '2023-08-23 20:33:08', '2023-08-23 20:34:09'),
(89, 95, 'winner', 'WhatsApp Image 2023-08-21 at 12.40.14 PM.jpeg', 'looser', '', '2023-08-24 02:07:36', '2023-08-24 02:08:16', NULL, NULL, NULL, NULL, '2023-08-23 20:36:54', '2023-08-23 20:38:16'),
(90, 96, 'winner', 'WhatsApp Image 2023-08-21 at 12.40.14 PM.jpeg', 'winner', 'WhatsApp Image 2023-08-21 at 12.40.14 PM.jpeg', '2023-08-24 02:09:20', '2023-08-24 02:09:32', NULL, NULL, NULL, NULL, '2023-08-23 20:38:49', '2023-08-23 20:39:32'),
(91, 97, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-08-23 21:13:34', '2023-08-23 21:17:15'),
(92, 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-23 21:29:31', '2023-08-23 21:29:31'),
(93, 99, 'looser', '', 'winner', 'photo-1552728089-57bdde30beb3.jfif', '2023-08-24 10:30:11', '2023-08-24 10:29:01', 1, NULL, 'Don\'t want to Play', NULL, '2023-08-23 21:32:50', '2023-08-24 05:00:11'),
(94, 100, 'winner', 'julius-drost-C8wlYF8ubBo-unsplash.jpg', 'looser', '', '2023-08-24 10:36:10', '2023-08-24 10:31:33', NULL, NULL, NULL, NULL, '2023-08-24 05:00:54', '2023-08-24 05:06:10'),
(95, 101, 'looser', '', 'looser', '', '2023-08-24 10:41:15', '2023-08-24 10:41:33', NULL, NULL, NULL, NULL, '2023-08-24 05:08:52', '2023-08-24 05:11:33'),
(96, 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-24 05:26:04', '2023-08-24 05:26:04'),
(97, 103, 'winner', 'WhatsApp Image 2023-08-21 at 12.40.14 PM.jpeg', 'looser', '', '2023-08-24 11:22:29', '2023-08-24 11:22:48', NULL, NULL, NULL, NULL, '2023-08-24 05:51:48', '2023-08-24 05:52:48'),
(98, 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-24 06:09:01', '2023-08-24 06:09:01'),
(99, 105, 'winner', 'julius-drost-C8wlYF8ubBo-unsplash.jpg', 'looser', '', '2023-08-25 00:25:05', '2023-08-26 23:09:58', NULL, NULL, NULL, NULL, '2023-08-24 18:21:24', '2023-08-26 17:39:58'),
(100, 106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-24 18:43:55', '2023-08-24 18:43:55'),
(101, 107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 18:21:39', '2023-08-26 18:21:39'),
(102, 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 18:21:52', '2023-08-26 18:21:52'),
(103, 109, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 18:22:28', '2023-08-26 18:22:28'),
(104, 110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 18:23:12', '2023-08-26 18:23:12'),
(105, 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 18:27:00', '2023-08-26 18:27:00'),
(106, 112, 'looser', '', 'winner', 'Quick coming soon.jpeg', '2023-08-26 23:58:52', '2023-08-26 23:58:41', NULL, NULL, NULL, NULL, '2023-08-26 18:27:49', '2023-08-26 18:28:52'),
(107, 113, 'looser', '', 'winner', 'Quick coming soon.jpeg', '2023-08-27 09:15:09', '2023-08-27 09:15:27', NULL, NULL, NULL, NULL, '2023-08-26 18:33:25', '2023-08-27 03:45:27'),
(108, 114, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 19:33:04', '2023-08-26 19:33:04'),
(109, 115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 19:38:27', '2023-08-26 19:38:27'),
(110, 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 19:39:58', '2023-08-26 19:39:58'),
(111, 117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:12:05', '2023-08-26 20:12:05'),
(112, 118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:12:23', '2023-08-26 20:12:23'),
(113, 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:13:02', '2023-08-26 20:13:02'),
(114, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:14:08', '2023-08-26 20:14:08'),
(115, 121, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:16:08', '2023-08-26 20:16:08'),
(116, 122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:17:32', '2023-08-26 20:17:32'),
(117, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:19:20', '2023-08-26 20:19:20'),
(118, 124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:23:23', '2023-08-26 20:23:23'),
(119, 125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:24:35', '2023-08-26 20:24:35'),
(120, 126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:25:19', '2023-08-26 20:25:19'),
(121, 127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:27:14', '2023-08-26 20:27:14'),
(122, 128, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:27:50', '2023-08-26 20:27:50'),
(123, 129, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:28:54', '2023-08-26 20:28:54'),
(124, 130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:30:33', '2023-08-26 20:30:33'),
(125, 131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:32:31', '2023-08-26 20:32:31'),
(126, 132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:39:07', '2023-08-26 20:39:07'),
(127, 133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:39:53', '2023-08-26 20:39:53'),
(128, 134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:41:17', '2023-08-26 20:41:17'),
(129, 135, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:44:47', '2023-08-26 20:44:47'),
(130, 136, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:49:08', '2023-08-26 20:49:08'),
(131, 137, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:50:09', '2023-08-26 20:50:09'),
(132, 138, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:51:36', '2023-08-26 20:51:36'),
(133, 139, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-26 20:53:28', '2023-08-26 20:53:28'),
(134, 140, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 03:43:09', '2023-08-27 03:43:09'),
(135, 141, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 03:43:44', '2023-08-27 03:43:44'),
(136, 142, 'looser', '', 'winner', 'quick.jpeg', '2023-08-27 09:15:44', '2023-08-27 09:16:02', NULL, NULL, NULL, NULL, '2023-08-27 03:44:50', '2023-08-27 03:46:02'),
(137, 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 03:49:55', '2023-08-27 03:49:55'),
(138, 144, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 03:56:16', '2023-08-27 03:56:16'),
(139, 145, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 03:57:21', '2023-08-27 03:57:21'),
(140, 146, 'looser', '', 'winner', 'Quick coming soon.jpeg', '2023-08-27 10:36:50', '2023-08-27 10:36:42', NULL, NULL, NULL, NULL, '2023-08-27 04:01:27', '2023-08-27 05:06:50'),
(141, 147, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:10:05', '2023-08-27 04:10:05'),
(142, 148, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:10:37', '2023-08-27 04:10:37'),
(143, 149, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:11:06', '2023-08-27 04:11:06'),
(144, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:12:00', '2023-08-27 04:12:00'),
(145, 151, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:12:27', '2023-08-27 04:12:27'),
(146, 152, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:12:51', '2023-08-27 04:12:51'),
(147, 153, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:13:57', '2023-08-27 04:13:57'),
(148, 154, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:16:34', '2023-08-27 04:16:34'),
(149, 155, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:17:05', '2023-08-27 04:17:05'),
(150, 156, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:26:17', '2023-08-27 04:26:17'),
(151, 157, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:26:40', '2023-08-27 04:26:40'),
(152, 158, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:27:07', '2023-08-27 04:27:07'),
(153, 159, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:27:22', '2023-08-27 04:27:22'),
(154, 160, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:27:31', '2023-08-27 04:27:31'),
(155, 161, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:31:44', '2023-08-27 04:31:44'),
(156, 162, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:38:56', '2023-08-27 04:38:56'),
(157, 163, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:39:26', '2023-08-27 04:39:26'),
(158, 164, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:39:37', '2023-08-27 04:39:37'),
(159, 165, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:40:33', '2023-08-27 04:40:33'),
(160, 166, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:40:57', '2023-08-27 04:40:57'),
(161, 167, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:51:07', '2023-08-27 04:51:07'),
(162, 168, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:51:17', '2023-08-27 04:51:17'),
(163, 169, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 04:59:59', '2023-08-27 04:59:59'),
(164, 170, 'looser', '', 'winner', 'julius-drost-C8wlYF8ubBo-unsplash.png', '2023-08-27 17:08:14', '2023-08-27 17:08:35', NULL, NULL, NULL, NULL, '2023-08-27 05:00:13', '2023-08-27 11:38:35'),
(165, 171, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 05:07:20', '2023-08-27 05:07:20'),
(166, 172, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 'Opponent Abusing', 'Other', '2023-08-27 05:07:29', '2023-08-27 05:09:13'),
(167, 173, 'looser', '', 'winner', 'Quick coming soon.jpeg', '2023-08-27 17:08:02', '2023-08-27 17:07:35', NULL, NULL, NULL, NULL, '2023-08-27 05:09:32', '2023-08-27 11:38:02'),
(168, 174, 'looser', '', 'winner', 'Quick coming soon.jpeg', '2023-08-27 15:01:23', '2023-08-27 15:01:43', NULL, NULL, NULL, NULL, '2023-08-27 07:32:20', '2023-08-27 09:31:43'),
(169, 175, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 07:36:26', '2023-08-27 07:36:26'),
(170, 176, 'looser', '', 'winner', 'Quick coming soon.jpeg', '2023-08-27 17:07:17', '2023-08-27 17:06:55', NULL, NULL, NULL, NULL, '2023-08-27 09:33:16', '2023-08-27 11:37:17'),
(171, 177, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-27 09:34:41', '2023-08-27 09:34:41'),
(172, 178, 'looser', '', 'winner', 'Quick coming soon.jpeg', '2023-08-27 17:19:52', '2023-08-27 17:19:35', NULL, NULL, NULL, NULL, '2023-08-27 11:47:41', '2023-08-27 11:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `challange_type`
--

CREATE TABLE `challange_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(244) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `challange_type`
--

INSERT INTO `challange_type` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Full Classic', 'classic', 'full-classic', '2023-08-02 18:11:34', '2023-08-02 18:11:34'),
(3, 'ludo-ulta', 'ludo-ulta', NULL, '2023-08-26 18:10:47', '2023-08-26 18:10:47'),
(4, 'ludo-no-goti-cut', 'ludo-no-goti-cut', NULL, '2023-08-26 18:10:47', '2023-08-26 18:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `deposit_transactions`
--

CREATE TABLE `deposit_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_user_paid` tinyint(1) NOT NULL DEFAULT 0,
  `order_id` int(11) DEFAULT NULL,
  `payment_url` varchar(255) DEFAULT NULL,
  `upi_id_hash` varchar(255) DEFAULT NULL,
  `upi_txn_id` varchar(244) DEFAULT NULL,
  `status` varchar(244) NOT NULL,
  `deposit_status` varchar(244) DEFAULT NULL,
  `client_txn_id` varchar(244) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposit_transactions`
--

INSERT INTO `deposit_transactions` (`id`, `user_id`, `is_user_paid`, `order_id`, `payment_url`, `upi_id_hash`, `upi_txn_id`, `status`, `deposit_status`, `client_txn_id`, `created_at`, `updated_at`) VALUES
(1, 15, 1, 58796132, 'https://merchant.upigateway.com/gateway/pay/28e54845d8f1bfb39710a465a2d3fcce', '25ad55392064e61cd20964190438a5af429a1205d0de94e184b7c630cfcf2ffd', '58796132', '1', 'success', '548268', '2023-08-20 12:32:51', '2023-08-20 13:28:33'),
(2, 15, 0, 58799521, 'https://merchant.upigateway.com/gateway/pay/be13c236df2cd3fcee2d6b633861877f', '25ad55392064e61cd20964190438a5af429a1205d0de94e184b7c630cfcf2ffd', NULL, '1', NULL, NULL, '2023-08-20 13:28:50', '2023-08-20 13:28:50'),
(3, 15, 1, 58800010, 'https://merchant.upigateway.com/gateway/pay/c5fc99ffc786dfd807c7b3ab92bb309a', '25ad55392064e61cd20964190438a5af429a1205d0de94e184b7c630cfcf2ffd', '58800010', '1', 'success', '313390', '2023-08-20 13:32:50', '2023-08-20 19:09:43'),
(4, 15, 1, 58800988, 'https://merchant.upigateway.com/gateway/pay/b286683b7e3d1f517a181cfebf09949a', '25ad55392064e61cd20964190438a5af429a1205d0de94e184b7c630cfcf2ffd', '58800988', '1', 'success', '611247', '2023-08-20 19:10:08', '2023-08-20 19:11:02'),
(5, 15, 1, 58827712, 'https://merchant.upigateway.com/gateway/pay/8ddded6995e65242d9bab01ab90bfdea', '25ad55392064e61cd20964190438a5af429a1205d0de94e184b7c630cfcf2ffd', '58827712', '1', 'success', '752990', '2023-08-21 05:01:06', '2023-08-21 05:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `device_token`
--

CREATE TABLE `device_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_challenge`
--

CREATE TABLE `game_challenge` (
  `id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `winning_amount` float NOT NULL DEFAULT 0,
  `screenshort` varchar(255) DEFAULT NULL,
  `challenge_accepted_by` int(11) DEFAULT NULL,
  `challenge_created_by` int(11) DEFAULT NULL,
  `requested` tinyint(1) NOT NULL DEFAULT 0,
  `amount` float NOT NULL DEFAULT 0,
  `challenge_name` varchar(255) DEFAULT NULL,
  `challenge_type` int(11) DEFAULT NULL,
  `room_code` varchar(255) DEFAULT NULL,
  `who_win` varchar(255) DEFAULT NULL,
  `who_cancel` varchar(255) DEFAULT NULL,
  `reson` varchar(255) DEFAULT NULL,
  `slug` varchar(244) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_challenge`
--

INSERT INTO `game_challenge` (`id`, `status`, `winning_amount`, `screenshort`, `challenge_accepted_by`, `challenge_created_by`, `requested`, `amount`, `challenge_name`, `challenge_type`, `room_code`, `who_win`, `who_cancel`, `reson`, `slug`, `created_at`, `updated_at`) VALUES
(26, 'challange_created', 700, NULL, NULL, 11, 0, 400, 'Guest User', 1, '1111', NULL, NULL, NULL, 'YboxYmcmpYcUUz90jAdTEXNPPSa737544fg222', '2023-08-03 06:57:20', '2023-08-20 19:14:16'),
(35, 'challange_created', 357.2, NULL, NULL, 11, 0, 188, 'Omi Yadav', 1, '1111', NULL, NULL, NULL, 'YboxYmcmpYcUUz90jAdTEXNPPSa737544fg', '2023-08-12 11:35:16', '2023-08-21 11:06:13'),
(63, 'complete', 100, NULL, 15, 19, 0, 55, 'Omi Yadav', 1, '1111', '15', NULL, NULL, 'YboxYmcmpYcUUz90jAdTEXNPPSa737ww', '2023-08-12 11:35:16', '2023-08-21 11:10:19'),
(73, 'challange_created', 190, NULL, NULL, 1, 0, 100, 'Radhika', 1, '1111', NULL, NULL, NULL, 'YboxYmcmpYcUUz90jAdTEXNPPSa737', '2023-08-20 20:25:33', '2023-08-22 18:46:15'),
(74, 'complete', 190, NULL, 19, 15, 0, 100, 'Omi007', 1, '1111', '19', NULL, NULL, 'rCsDrwGXkBA00Zk0zfzvu1nWl5w20Q', '2023-08-21 11:11:53', '2023-08-21 11:14:14'),
(75, 'complete', 380, NULL, 19, 15, 0, 200, 'Omi007', 1, '1111', '15', NULL, NULL, 'Ggd5IyNhS46UdDF82iVMCZnUxeSSqY', '2023-08-21 11:26:02', '2023-08-21 11:27:50'),
(76, 'complete', 380, NULL, 19, 15, 0, 200, 'Omi007', 1, '1111', '19', NULL, NULL, 'yZUS2hLbdlrVZvQiyELWAOYHwOqU62', '2023-08-21 11:28:13', '2023-08-21 12:23:23'),
(77, 'complete', 570, NULL, 19, 15, 0, 300, 'Omi007', 1, '1111', '15', NULL, NULL, 'mWvuqaI5YLqxOuVbYgvcgeTZt5vxjW', '2023-08-21 12:24:05', '2023-08-21 12:29:39'),
(85, 'complete', 195, NULL, 18, 15, 0, 100, 'Omi007', 1, '1111', '18', NULL, NULL, 'Bq1b14czv18qIlEbUaNfiXQb843PzJ', '2023-08-23 17:29:02', '2023-08-23 20:09:35'),
(88, 'complete', 197, NULL, 18, 15, 0, 100, 'Omi007', 1, '1111', '15', NULL, NULL, 'ZiXzhQjSCzBLBs5yXfsXk45FHakjSJ', '2023-08-23 20:10:50', '2023-08-23 20:13:26'),
(89, 'complete', 197, NULL, 18, 15, 0, 100, 'Omi007', 1, '1111', '18', NULL, NULL, '9wXWg4tT0Q9Wt3EIG2zrobCiUUBrc6', '2023-08-23 20:14:08', '2023-08-23 20:15:56'),
(90, 'complete', 197, NULL, 18, 15, 0, 100, 'Omi007', 1, '1111', '18', NULL, NULL, 'xZ5qJboh3alcNT8ayODsFMBF3aOJ2q', '2023-08-23 20:18:28', '2023-08-23 20:19:20'),
(91, 'complete', 197, NULL, 18, 15, 0, 100, 'Omi007', 1, '1111', '18', NULL, NULL, 'lzFBKyhVNJfdaz0yAh0InQNe8yQx0b', '2023-08-23 20:23:45', '2023-08-23 20:24:49'),
(92, 'complete', 197, NULL, 15, 18, 0, 100, 'Omi Yadav', 1, '1111', '18', NULL, NULL, 'IQoNv4fA2nJ9E6fXUSBXfXLuIsiOQK', '2023-08-23 20:26:36', '2023-08-23 20:27:49'),
(93, 'complete', 197, NULL, 15, 18, 0, 100, 'Omi Yadav', 1, '1111', '18', NULL, NULL, 'hmvUGrFcDEHrdkfCm0fLIyysjtbeZj', '2023-08-23 20:29:29', '2023-08-23 20:30:34'),
(94, 'complete', 394, NULL, 15, 18, 0, 200, 'Omi Yadav', 1, '1111', '18', NULL, NULL, 'qN0icFhgduUlgZilLanv3mPsl5DTfx', '2023-08-23 20:33:08', '2023-08-23 20:34:05'),
(95, 'complete', 197, NULL, 15, 18, 0, 100, 'Omi Yadav', 1, '1111', '18', NULL, NULL, 'MGLalmyudkVfhyCBGDtHGY2bZ0A8ar', '2023-08-23 20:36:54', '2023-08-23 20:38:16'),
(96, 'complete', 1970, NULL, 18, 15, 0, 1000, 'Omi007', 1, '1111', '18', NULL, NULL, 'T9H66zs1QyCOAVz76xzbZ4PWtb8bo2', '2023-08-23 20:38:49', '2023-08-23 20:43:49'),
(97, 'cancel', 197, NULL, 15, 18, 0, 100, 'Omi Yadav', 1, '1111', NULL, NULL, NULL, 'By1YczmzGn0UyZqFzUyzHR7WgFMi09', '2023-08-23 21:13:34', '2023-08-23 21:19:21'),
(98, 'challange_created', 197, NULL, NULL, 2, 0, 100, 'Omi hfe', 1, '111', NULL, NULL, NULL, NULL, '2023-08-23 21:29:31', '2023-08-27 11:44:10'),
(99, 'complete', 1970, NULL, 15, 18, 0, 1000, 'Omi Yadav', 1, '1111', '15', NULL, NULL, 'q6br0tWdAlRwY92ppO4TQLLV8PO08r', '2023-08-23 21:32:50', '2023-08-24 05:00:12'),
(100, 'complete', 1402.64, NULL, 18, 15, 0, 712, 'Omi007', 1, '1111', '15', NULL, NULL, 'Mj30CTkLelrbwm45J9fapslVOaA0pn', '2023-08-24 05:00:54', '2023-08-24 05:06:11'),
(101, 'complete', 197, NULL, 15, 18, 0, 100, 'Omi Yadav', 1, '1111', '18', NULL, NULL, 'd4jmKwO4h2gwrlv1UcOY7mVCiELycS', '2023-08-24 05:08:52', '2023-08-24 05:12:40'),
(103, 'complete', 197, NULL, 18, 15, 0, 100, 'Omi007', 1, '1111', '15', NULL, NULL, 'VucJhgBbAdhw7QjsRIL53PORj9zIpI', '2023-08-24 05:51:48', '2023-08-24 05:52:48'),
(105, 'complete', 197, NULL, 18, 15, 0, 100, 'Omi007', 1, '1111', '15', NULL, NULL, 'UacQjkTXcHTCHrias7mvL9t2rZWcs3', '2023-08-24 18:21:24', '2023-08-26 17:40:00'),
(112, 'complete', 1970, NULL, 15, 18, 0, 1000, 'Omi Yadav', 1, '1111', '15', NULL, NULL, '4UoKaFt4eoWjyVHQcp9B3x3ulFVco3', '2023-08-26 18:27:49', '2023-08-26 18:28:52'),
(113, 'complete', 197, NULL, 15, 18, 0, 100, 'Omi Yadav', 1, '1111', '15', NULL, NULL, 'kCpeiUONs08RTwSuDMPeNQnewM85VG', '2023-08-26 18:33:25', '2023-08-27 03:45:28'),
(142, 'complete', 197, NULL, 18, 15, 0, 100, 'Omi007', 1, '1111', '18', NULL, NULL, 'SBMOWIKDr0j2X70nh8IFKI9s879vGk', '2023-08-27 03:44:50', '2023-08-27 03:46:02'),
(146, 'complete', 1970, NULL, 18, 15, 0, 1000, 'Omi007', 1, '1111', '18', NULL, NULL, 'T2ugb4vRf6cB4y8iqvsqxGe2QPguY0', '2023-08-27 04:01:27', '2023-08-27 05:06:51'),
(170, 'complete', 197, NULL, 18, 15, 0, 100, 'Omi007', 1, '1111', '18', NULL, NULL, 'A5r91WjodcbKUX5GP3Bo5ytSpST3IT', '2023-08-27 05:00:13', '2023-08-27 11:38:36'),
(172, 'cancel', 1970, NULL, 18, 15, 0, 1000, 'Omi007', 1, '1111', NULL, NULL, NULL, 'Ra0b7aUMGyEoDGwNMSXSaMRp6NsVxc', '2023-08-27 05:07:29', '2023-08-27 05:09:13'),
(173, 'complete', 197, NULL, 18, 15, 0, 100, 'Omi007', 1, '1111', '18', NULL, NULL, 'QFTn45d8n8QIRqNqy5ZWAJzqo1TX3i', '2023-08-27 05:09:32', '2023-08-27 11:38:02'),
(174, 'complete', 197, NULL, 15, 18, 0, 100, 'Omi Yadav', 1, '1111', '15', NULL, NULL, '1P0Y0kzxgZGPFLrJYXUwxZuvY5BB78', '2023-08-27 07:32:20', '2023-08-27 09:31:43'),
(176, 'complete', 1970, NULL, 15, 18, 0, 1000, 'Omi Yadav', 1, '1111', '15', NULL, NULL, 'aJe0bbquNbcYMSYxeITe5Uljqwsj05', '2023-08-27 09:33:16', '2023-08-27 11:37:18'),
(178, 'complete', 1970, NULL, 18, 15, 0, 1000, 'Omi007', 1, '05819462', '18', NULL, NULL, 'MiNl16PWsfInkdMjawHOeX1IhT7WvF', '2023-08-27 11:47:41', '2023-08-27 11:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int(11) NOT NULL,
  `challange_id` int(11) DEFAULT NULL,
  `challange_amount` float NOT NULL DEFAULT 0,
  `income` float NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `challange_id`, `challange_amount`, `income`, `created_at`, `updated_at`) VALUES
(1, 63, 55, 5.5, '2023-08-21 11:10:19', '2023-08-21 11:10:19'),
(2, 74, 100, 10, '2023-08-21 11:14:14', '2023-08-21 11:14:14'),
(3, 75, 200, 20, '2023-08-21 11:27:50', '2023-08-21 11:27:50'),
(4, 76, 200, 20, '2023-08-21 12:23:22', '2023-08-21 12:23:22'),
(5, 77, 300, 30, '2023-08-21 12:29:39', '2023-08-21 12:29:39'),
(6, 85, 100, 3, '2023-08-23 20:09:35', '2023-08-23 20:09:35'),
(8, 88, 100, 3, '2023-08-23 20:13:26', '2023-08-23 20:13:26'),
(9, 89, 100, 3, '2023-08-23 20:15:56', '2023-08-23 20:15:56'),
(10, 90, 100, 3, '2023-08-23 20:19:20', '2023-08-23 20:19:20'),
(11, 91, 100, 3, '2023-08-23 20:24:49', '2023-08-23 20:24:49'),
(12, 92, 100, 3, '2023-08-23 20:27:49', '2023-08-23 20:27:49'),
(13, 93, 100, 3, '2023-08-23 20:30:34', '2023-08-23 20:30:34'),
(14, 94, 200, 6, '2023-08-23 20:34:05', '2023-08-23 20:34:05'),
(15, 94, 200, 6, '2023-08-23 20:34:06', '2023-08-23 20:34:06'),
(16, 94, 200, 6, '2023-08-23 20:34:08', '2023-08-23 20:34:08'),
(17, 94, 200, 6, '2023-08-23 20:34:09', '2023-08-23 20:34:09'),
(18, 94, 200, 6, '2023-08-23 20:34:09', '2023-08-23 20:34:09'),
(19, 95, 100, 3, '2023-08-23 20:38:16', '2023-08-23 20:38:16'),
(20, 99, 1000, 30, '2023-08-24 05:00:12', '2023-08-24 05:00:12'),
(21, 100, 712, 21.36, '2023-08-24 05:06:10', '2023-08-24 05:06:10'),
(22, 103, 100, 3, '2023-08-24 05:52:48', '2023-08-24 05:52:48'),
(23, 105, 100, 3, '2023-08-26 17:39:58', '2023-08-26 17:39:58'),
(24, 112, 1000, 30, '2023-08-26 18:28:52', '2023-08-26 18:28:52'),
(25, 113, 100, 3, '2023-08-27 03:45:28', '2023-08-27 03:45:28'),
(26, 142, 100, 3, '2023-08-27 03:46:02', '2023-08-27 03:46:02'),
(27, 146, 1000, 30, '2023-08-27 05:06:50', '2023-08-27 05:06:50'),
(28, 174, 100, 3, '2023-08-27 09:31:43', '2023-08-27 09:31:43'),
(29, 176, 1000, 30, '2023-08-27 11:37:17', '2023-08-27 11:37:17'),
(30, 173, 100, 3, '2023-08-27 11:38:02', '2023-08-27 11:38:02'),
(31, 170, 100, 3, '2023-08-27 11:38:35', '2023-08-27 11:38:35'),
(32, 178, 1000, 30, '2023-08-27 11:49:52', '2023-08-27 11:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `action` varchar(255) DEFAULT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `description`, `action`, `amount`, `created_at`, `updated_at`) VALUES
(1, 18, '1000 is credited by admin', 'cr', 1000, '2023-08-24 05:59:22', '2023-08-24 05:59:22'),
(2, 18, '100 is credited by admin', 'cr', 100, '2023-08-24 06:04:54', '2023-08-24 06:04:54'),
(3, 20, '100 is credited by admin', 'cr', 100, '2023-08-24 06:08:44', '2023-08-24 06:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0371c9e58577841b4d91c2b6cc9be272334a1efeb4bee0807567b22ffec78576b53fe0582e6fd00b', 1, 1, 'API Token', '[]', 0, '2023-05-06 13:27:55', '2023-05-06 13:27:55', '2024-05-06 18:57:55'),
('158d453e9037e0110dfa13e865a22569699c69cd2a8dd2fdb03f03ba52c08be1416909a0bd5cb178', 1, 1, 'API Token', '[]', 0, '2023-05-06 13:29:03', '2023-05-06 13:29:03', '2024-05-06 18:59:03'),
('18621c8d95868d8811e26f047ff22b94d829fdf59ecaf31d08c995191927839ddc817fb75d5fc9c6', 1, 1, 'API Token', '[]', 0, '2023-05-06 13:28:51', '2023-05-06 13:28:51', '2024-05-06 18:58:51'),
('1fd5484a5bd5fcb1e7b0d0408a809620dfd79308f443125d550879303eb4574cdf749d6a12b84e01', 1, 1, 'API Token', '[]', 0, '2023-05-06 13:24:11', '2023-05-06 13:24:11', '2024-05-06 18:54:11'),
('254f4ac1807d29e5f10ff3822897a6882a1a5bc7ba95a819b8216624276d5e4896695491aee4a1ce', 2, 1, 'API Token', '[]', 0, '2023-05-06 14:20:56', '2023-05-06 14:20:56', '2024-05-06 19:50:56'),
('401c344532786f671ce0e255b695b6a92df882c7631b320c4d31cccf3a8421cbb575ae021de620a9', 1, 1, 'API Token', '[]', 0, '2023-05-06 13:31:57', '2023-05-06 13:31:57', '2024-05-06 19:01:57'),
('64df422a726e99a962309fba9233e59ba7cd9ac68d900e1c4a5304a2684ca9240c69ed7efb65a28c', 5, 3, 'API Token', '[]', 0, '2023-07-08 01:03:11', '2023-07-08 01:03:11', '2024-07-08 06:33:11'),
('b91a9231dcdb017d9e46d2d1a94467ccfe119f6441b4b370e7b9450cbaa1c63a6af3bf8d249b85c5', 5, 3, 'API Token', '[]', 0, '2023-07-07 10:59:43', '2023-07-07 10:59:43', '2024-07-07 16:29:43'),
('c4690fb8e034a4f64e99f4b08b6b2d782995d26daaa1b2c399a1f7ebf9314112f8cdcadc4f740f14', 5, 3, 'API Token', '[]', 0, '2023-07-23 04:11:52', '2023-07-23 04:11:52', '2024-07-23 09:41:52'),
('cde93f498e7658db311f547b335ec71de6d014035b60c396903a23c09154d8cd16905c730691a68d', 5, 3, 'API Token', '[]', 0, '2023-07-23 04:12:44', '2023-07-23 04:12:44', '2024-07-23 09:42:44'),
('d3f1dd7af591cf4c505a9c16d09857e7293451645f3fb062ab61e97f60e854f3a3c595cee5efaf5f', 1, 1, 'API Token', '[]', 0, '2023-05-06 13:16:17', '2023-05-06 13:16:17', '2024-05-06 18:46:17'),
('d8d09dc36ab4cf44e4c12bf579d441eafc4d22ad1ee5dfb9d7faf5c95a2d575b355425e67dbf3190', 1, 3, 'API Token', '[]', 0, '2023-06-01 05:21:16', '2023-06-01 05:21:16', '2024-06-01 10:51:16'),
('eb67647ad88799989cb8233c0d71493c30c715459cd311e0ac1cc99e6b1dfac06f807392d5b81e84', 1, 1, 'API Token', '[]', 0, '2023-05-06 13:30:09', '2023-05-06 13:30:09', '2024-05-06 19:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Chivs Tiffine Personal Access Client', '1sft1WxCpKlJSChWQQPZqtMWQti8siFAHG7Us0k0', NULL, 'http://localhost', 1, 0, 0, '2023-05-06 13:16:14', '2023-05-06 13:16:14'),
(2, NULL, 'Chivs Tiffine Password Grant Client', 'MZb14hFpAz2BZKXR7gvn2WWq4Ixp20XZNOId1thh', 'users', 'http://localhost', 0, 1, 0, '2023-05-06 13:16:14', '2023-05-06 13:16:14'),
(3, NULL, 'Laravel Personal Access Client', 'o6C1uG3dZzT2SO5TAAACz4OB8wFm4GbebrSjf1rp', NULL, 'http://localhost', 1, 0, 0, '2023-06-01 05:21:05', '2023-06-01 05:21:05'),
(4, NULL, 'Laravel Password Grant Client', '8aQsNvBbwtwNm7LzBpNicYH6Slu1YYSkBo6U0Fmn', 'users', 'http://localhost', 0, 1, 0, '2023-06-01 05:21:06', '2023-06-01 05:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-05-06 13:16:14', '2023-05-06 13:16:14'),
(2, 3, '2023-06-01 05:21:05', '2023-06-01 05:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@omi1.com', '$2y$10$W/W7hG4LmEP2egZ2NbtyIOBVzMU/oGPzGzJq0cALbe2PVAqDJ5A6q', '2023-08-30 04:21:53');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'permission_create', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(2, 'permission_edit', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(3, 'permission_show', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(4, 'permission_delete', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(5, 'permission_access', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(6, 'role_create', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(7, 'role_edit', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(8, 'role_show', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(9, 'role_delete', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(10, 'role_access', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(11, 'user_management_access', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(12, 'user_create', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(13, 'user_edit', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(14, 'user_show', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(15, 'user_delete', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(16, 'user_access', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `referal_users`
--

CREATE TABLE `referal_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `refer_by` int(11) DEFAULT NULL,
  `amount` float(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referal_users`
--

INSERT INTO `referal_users` (`id`, `user_id`, `refer_by`, `amount`, `created_at`, `updated_at`) VALUES
(1, 17, 15, 60.00, '2023-08-15 04:12:06', '2023-08-15 04:12:06'),
(2, 18, 15, 82.00, '2023-08-15 04:13:50', '2023-08-27 11:49:52'),
(3, 19, 15, 0.00, '2023-08-17 12:40:08', '2023-08-17 12:40:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL),
(2, 'User', '2019-09-10 08:30:26', '2019-09-10 08:30:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(15, 15),
(15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_title', 'Star Luod Players', '2023-07-28 01:49:18', '2023-08-30 06:00:44'),
(2, 'site_address', 'Star ludo', '2023-07-28 01:49:18', '2023-08-30 06:00:44'),
(3, 'contact', '9929502092', '2023-07-28 01:49:18', '2023-08-30 06:00:44'),
(4, 'email', 'starludoplayers@gmail.com', '2023-07-28 01:49:19', '2023-08-30 06:00:44'),
(6, 'max_bid_amount', '1000', '2023-07-28 01:49:19', '2023-07-28 01:49:19'),
(7, 'min_withdrawl_amount', '100', '2023-07-28 01:49:19', '2023-07-28 01:49:19'),
(8, 'max_withdrawal_amount', '1000', '2023-07-28 01:49:19', '2023-07-28 01:49:19'),
(10, 'max_deposit_amount', '1000', '2023-07-28 01:49:19', '2023-07-28 01:49:19'),
(11, 'service_fee', '3', '2023-07-28 01:49:19', '2023-07-28 01:49:19'),
(12, 'send_otp', 'yes', '2023-07-28 01:49:19', '2023-07-28 01:49:19'),
(13, 'upi_name', '100', '2023-07-28 01:49:19', '2023-08-30 06:00:44'),
(14, 'upi_id', NULL, '2023-07-28 01:49:19', '2023-08-30 06:00:44'),
(15, 'account_holder_name', NULL, '2023-07-28 01:49:20', '2023-08-30 06:00:44'),
(16, 'account_number', NULL, '2023-07-28 01:49:20', '2023-08-30 06:00:44'),
(17, 'ifsc_code', NULL, '2023-07-28 01:49:20', '2023-08-30 06:00:44'),
(18, 'is_live', '0', '2023-07-28 01:49:20', '2023-07-28 01:49:20'),
(19, 'app_link', 'http://www.starludoplayers.com', '2023-07-28 01:49:20', '2023-08-30 06:00:44'),
(20, 'app_link_playstore', 'http://www.starludoplayers.com', '2023-07-28 01:49:20', '2023-08-30 06:00:44'),
(21, 'website_title', 'Star ludo Players', '2023-07-28 01:49:20', '2023-08-30 06:00:44'),
(22, 'meta_title', 'Star ludo Players', '2023-07-28 01:49:20', '2023-08-30 06:00:44'),
(23, 'meta_desc', 'Star ludo Players', '2023-07-28 01:49:20', '2023-08-30 06:00:44'),
(24, 'video_link', 'http://www.starludoplayers.com', '2023-07-28 01:49:20', '2023-08-30 06:00:44'),
(25, 'how_to_play_content', '<p>Star ludo Players</p>', '2023-07-28 01:49:20', '2023-08-30 06:00:44'),
(26, 'facebook', NULL, '2023-07-28 01:49:20', '2023-07-28 01:49:20'),
(27, 'twitter', NULL, '2023-07-28 01:49:20', '2023-07-28 01:49:20'),
(28, 'instagram', NULL, '2023-07-28 01:49:20', '2023-07-28 01:49:20'),
(29, 'linked-in', NULL, '2023-07-28 01:49:20', '2023-07-28 01:49:20'),
(30, 'logo', '169285417664e6e7a00801bUntitled-1-(2).png', '2023-07-28 01:49:21', '2023-08-24 05:16:16'),
(31, 'favicon', '169285417664e6e7a01ddb1Untitled-1-(2).png', '2023-07-28 01:49:21', '2023-08-24 05:16:16'),
(32, 'min_bid_amount', '50', '2023-08-18 18:05:52', '2023-08-27 11:05:57'),
(33, 'min_deposit_amount', '1', '2023-08-20 16:48:12', '2023-08-20 16:48:12'),
(34, 'refer_amount', '2', '2023-08-22 18:55:30', '2023-08-27 11:05:41');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `title` varchar(244) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `transactions_id` varchar(255) DEFAULT NULL,
  `screen_shot` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `withdrawal_upi_id` varchar(244) DEFAULT NULL,
  `withdrawal_method` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `payment_gatway` varchar(255) DEFAULT NULL,
  `transaction_type` varchar(255) DEFAULT NULL,
  `addition_status` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `title`, `user_id`, `amount`, `transactions_id`, `screen_shot`, `status`, `withdrawal_upi_id`, `withdrawal_method`, `description`, `payment_gatway`, `transaction_type`, `addition_status`, `number`, `isAdmin`, `created_at`, `updated_at`) VALUES
(1, 'withdrawal_money', 'Withdrawal Money', 18, 100, '32841619688', NULL, 'pending', 'Paytm@12345', 'upi', NULL, NULL, 'withdrawal_money', 'reject', NULL, 0, '2023-08-24 05:33:47', '2023-08-24 05:37:53'),
(2, 'withdrawal_money', 'Withdrawal Money', 18, 100, '75931092998', NULL, 'pending', '123456', 'upi', NULL, NULL, 'withdrawal_money', 'reject', NULL, 0, '2023-08-24 05:39:51', '2023-08-24 05:40:34'),
(3, 'withdrawal_money', 'Withdrawal Money', 18, 100, '78359681291', NULL, 'pending', '100', 'upi', NULL, NULL, 'withdrawal_money', 'reject', NULL, 0, '2023-08-24 05:41:55', '2023-08-24 05:42:02'),
(4, 'withdrawal_money', 'Withdrawal Money', 18, 100, '48518846716', NULL, 'pending', '100', 'upi', NULL, NULL, 'withdrawal_money', 'reject', NULL, 0, '2023-08-24 05:42:53', '2023-08-24 05:46:23'),
(5, 'credit', 'Withdrawal decline refund', 18, 100, '38988300852', NULL, 'success', NULL, NULL, NULL, NULL, 'withdraw_refund', 'success', NULL, 0, '2023-08-24 05:46:23', '2023-08-24 05:46:23'),
(6, 'withdrawal_money', 'Withdrawal Money', 18, 100, '46436886968', NULL, 'pending', '100', 'upi', NULL, NULL, 'withdrawal_money', 'approve', NULL, 0, '2023-08-24 05:50:11', '2023-08-24 05:50:21'),
(7, NULL, 'Win A challange', 15, 197, '89790423825', NULL, 'success', NULL, NULL, NULL, NULL, 'win_battle', 'approve', NULL, 0, '2023-08-24 05:52:48', '2023-08-24 05:52:48'),
(9, NULL, 'Cash added using UPI', 18, 100, '6893361212', NULL, 'success', NULL, NULL, NULL, NULL, 'add_money', 'approve', NULL, 1, '2023-08-24 06:04:54', '2023-08-24 06:04:54'),
(10, NULL, 'Cash added using UPI', 20, 100, '23109071438', NULL, 'success', NULL, NULL, NULL, NULL, 'add_money', 'approve', NULL, 1, '2023-08-24 06:08:44', '2023-08-24 06:08:44'),
(11, NULL, 'Win A challange', 15, 197, '71339266675', NULL, 'success', NULL, NULL, NULL, NULL, 'win_battle', 'approve', NULL, 0, '2023-08-26 17:39:59', '2023-08-26 17:39:59'),
(12, NULL, 'Win A challange', 15, 1970, '19352657751', NULL, 'success', NULL, NULL, NULL, NULL, 'win_battle', 'approve', NULL, 0, '2023-08-26 18:28:52', '2023-08-26 18:28:52'),
(13, NULL, 'Win A challange', 15, 197, '42708787975', NULL, 'success', NULL, NULL, NULL, NULL, 'win_battle', 'approve', NULL, 0, '2023-08-27 03:45:28', '2023-08-27 03:45:28'),
(14, NULL, 'Win A challange', 18, 197, '37073667875', NULL, 'success', NULL, NULL, NULL, NULL, 'win_battle', 'approve', NULL, 0, '2023-08-27 03:46:02', '2023-08-27 03:46:02'),
(15, NULL, 'Earn by refer', 15, 2, '64717932747', NULL, 'success', NULL, NULL, NULL, NULL, 'earn_refer', 'approve', NULL, 0, '2023-08-27 03:46:02', '2023-08-27 03:46:02'),
(16, NULL, 'Win A challange', 18, 1970, '98520680988', NULL, 'success', NULL, NULL, NULL, NULL, 'win_battle', 'approve', NULL, 0, '2023-08-27 05:06:50', '2023-08-27 05:06:50'),
(17, NULL, 'Earn by refer', 15, 20, '31161725606', NULL, 'success', NULL, NULL, NULL, NULL, 'earn_refer', 'approve', NULL, 0, '2023-08-27 05:06:51', '2023-08-27 05:06:51'),
(18, NULL, 'Challange cancel refund', 18, 1000, '53549568884', NULL, 'success', NULL, NULL, NULL, NULL, 'cancel_refund', 'approve', NULL, 0, '2023-08-27 05:09:13', '2023-08-27 05:09:13'),
(19, NULL, 'Challange cancel refund', 15, 1000, '99694734626', NULL, 'success', NULL, NULL, NULL, NULL, 'cancel_refund', 'approve', NULL, 0, '2023-08-27 05:09:13', '2023-08-27 05:09:13'),
(20, NULL, 'Win A challange', 15, 197, '81308327336', NULL, 'success', NULL, NULL, NULL, NULL, 'win_battle', 'approve', NULL, 0, '2023-08-27 09:31:43', '2023-08-27 09:31:43'),
(21, NULL, 'Win A challange', 15, 1970, '39276709155', NULL, 'success', NULL, NULL, NULL, NULL, 'win_battle', 'approve', NULL, 0, '2023-08-27 11:37:18', '2023-08-27 11:37:18'),
(22, NULL, 'Win A challange', 18, 197, '46737293587', NULL, 'success', NULL, NULL, NULL, NULL, 'win_battle', 'approve', NULL, 0, '2023-08-27 11:38:02', '2023-08-27 11:38:02'),
(23, NULL, 'Earn by refer', 15, 2, '73592774075', NULL, 'success', NULL, NULL, NULL, NULL, 'earn_refer', 'approve', NULL, 0, '2023-08-27 11:38:02', '2023-08-27 11:38:02'),
(24, NULL, 'Win A challange', 18, 197, '548882675', NULL, 'success', NULL, NULL, NULL, NULL, 'win_battle', 'approve', NULL, 0, '2023-08-27 11:38:35', '2023-08-27 11:38:35'),
(25, NULL, 'Earn by refer', 15, 2, '40406224568', NULL, 'success', NULL, NULL, NULL, NULL, 'earn_refer', 'approve', NULL, 0, '2023-08-27 11:38:36', '2023-08-27 11:38:36'),
(26, NULL, 'Win A challange', 18, 1970, '91280866423', NULL, 'success', NULL, NULL, NULL, NULL, 'win_battle', 'approve', NULL, 0, '2023-08-27 11:49:52', '2023-08-27 11:49:52'),
(27, NULL, 'Earn by refer', 15, 20, '56981913737', NULL, 'success', NULL, NULL, NULL, NULL, 'earn_refer', 'approve', NULL, 0, '2023-08-27 11:49:52', '2023-08-27 11:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `wallet` float(8,2) NOT NULL DEFAULT 0.00,
  `is_play` tinyint(1) NOT NULL DEFAULT 0,
  `refer_amount` float(8,2) NOT NULL DEFAULT 0.00,
  `deposit_amount` float(8,2) NOT NULL DEFAULT 0.00,
  `otp` varchar(34) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `fcm_token` text DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `refer_code` varchar(244) DEFAULT NULL,
  `refer_by` varchar(34) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `wallet`, `is_play`, `refer_amount`, `deposit_amount`, `otp`, `email_verified_at`, `password`, `profile_image`, `fcm_token`, `remember_token`, `status`, `refer_code`, `refer_by`, `is_admin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', '9876543210', 1000.00, 0, 0.00, 0.00, NULL, NULL, '$2a$12$k9gKRlo9iAoQPxk9dfGQRuJtd.1FagQ2xGSSBgGGt8KGbcG/y7NGq', '', NULL, NULL, '1', NULL, NULL, 0, '2019-09-10 08:30:26', '2023-07-23 04:05:40', NULL),
(2, 'Tapan Ghosh', 'tapang786@gmail.com', '7790980197', 644.00, 0, 0.00, 0.00, NULL, NULL, NULL, NULL, '', NULL, '1', NULL, NULL, 0, '2023-05-06 13:54:28', '2023-07-23 04:05:40', NULL),
(3, 'Tapan Ghosh', 'tapang786@gmail.com', '7790980191', 0.00, 0, 0.00, 0.00, NULL, NULL, NULL, NULL, '', NULL, '0', NULL, NULL, 0, '2023-05-06 14:06:04', '2023-05-06 14:06:04', NULL),
(4, 'omi', 'admin@omi.com', NULL, 2580.00, 0, 0.00, 0.00, NULL, NULL, '$2y$10$Y/SIgQMJj1Ch8FMChUGTMeVhFzdUKMSlVrqWo1t.74ekDyVRQkLea', NULL, NULL, NULL, '0', NULL, NULL, 0, '2023-06-01 05:33:12', '2023-07-22 17:53:01', NULL),
(5, 'Omi Yadav', 'admin@omi.comq', NULL, 300.00, 0, 50.00, 0.00, NULL, NULL, '$2y$10$4JtxMs9BiFcJfxL/waqeoeFwFksOHszrIIkC8Jzqpt8nrVRYAqSTK', NULL, NULL, NULL, '0', NULL, NULL, 0, '2023-07-07 10:59:09', '2023-07-23 04:14:39', NULL),
(6, 'omi', 'admin@omi.comqq', NULL, 0.00, 0, 0.00, 0.00, NULL, NULL, '$2y$10$2ZMMfqHtRAuMtfpIIeNGue7o5kPYkkiBrhFbA0iuu19rrX9uF9Eum', NULL, NULL, NULL, '0', 'Dz1Op62', NULL, 0, '2023-07-22 18:43:16', '2023-07-22 18:43:16', NULL),
(7, 'omi', 'admin@omi.comqqw', NULL, 0.00, 0, 400.00, 0.00, NULL, NULL, '$2y$10$.PJPAQOhfujVNCXmWQH3K.zI/a5aixlidBBGDdHsKSwrpPrloCXCW', NULL, NULL, NULL, '0', '6W1V0SL', NULL, 0, '2023-07-22 18:43:48', '2023-07-22 19:07:56', NULL),
(8, 'omi', 'admin@omi.comqqwww', NULL, 0.00, 0, 0.00, 0.00, NULL, NULL, '$2y$10$H9pJb9ZSJPEAwKzqLlZS5.q0Frz6hF5UJAKolbOxFIhn874KLkA66', NULL, NULL, NULL, '0', 'Q642KS1', NULL, 0, '2023-07-22 19:05:47', '2023-07-22 19:05:47', NULL),
(9, 'omi', 'admin@omi.comqqwwwww', NULL, 0.00, 0, 0.00, 0.00, NULL, NULL, '$2y$10$nBFzXctqZ9W41Lu9Jjxtx.hCr803rXWJOGhGd4BazWG5IfIx7uC0a', NULL, NULL, NULL, '0', '2LHB9EQ', NULL, 0, '2023-07-22 19:06:23', '2023-07-22 19:06:23', NULL),
(10, 'omi', 'admin@omi.wdwd', NULL, 0.00, 0, 200.00, 0.00, NULL, NULL, '$2y$10$eiasLSJk41fU2xsVaH0Z8.ojv9f8WNcQeqN9MPMBHUKaC5teuJP6e', NULL, NULL, NULL, '0', 'RIKO23U', NULL, 0, '2023-07-22 19:07:18', '2023-07-22 19:07:18', NULL),
(11, 'omi', 'admin@omi.wdwdd', '1111111111', 0.00, 0, 200.00, 0.00, '3690', NULL, '$2y$10$KzU12eW6ffOLWaYgXayx2.h4BwLrVGO00SiFZ5tPqZOFg.ySbD69C', NULL, NULL, NULL, '0', 'ZK5I29M', NULL, 0, '2023-07-22 19:07:56', '2023-08-05 14:18:24', NULL),
(12, NULL, NULL, '1234567897', 0.00, 0, 0.00, 0.00, '4738', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 0, '2023-07-28 10:27:51', '2023-07-28 10:27:51', NULL),
(13, NULL, NULL, '4335554443', 0.00, 0, 0.00, 0.00, '5823', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 0, '2023-07-28 10:32:17', '2023-07-28 10:34:13', NULL),
(14, NULL, NULL, '4444444444', 0.00, 0, 0.00, 0.00, '6975', NULL, NULL, NULL, NULL, NULL, '0', 'AFJQG1', 'AFJQG9', 0, '2023-07-28 10:35:23', '2023-07-28 10:38:37', NULL),
(15, 'Omi007', 'admin@admin.com', '7340252552', 6278.00, 1, 0.00, 0.00, '1234', NULL, '$2y$10$uwZGKH89KW1oPCde7GjGCu1s6MZurkR3pjv0s8g.CoA3TvBEzGF.q', 'assets/users/15/169285319764e6e3cda369bUntitled-1-(2).png', NULL, NULL, 'approve', 'AFJQG9', 'AFJQG1', 1, '2023-07-28 10:38:46', '2023-08-30 05:27:58', NULL),
(18, 'Omi Yadav', NULL, '7340252555', 2443.00, 1, 0.00, 0.00, '1234', NULL, NULL, 'assets/users/18/169290237664e7a3e827f7bjulius-drost-C8wlYF8ubBo-unsplash.png', NULL, NULL, '0', '449R6Y', NULL, 0, '2023-08-15 04:13:50', '2023-08-27 11:49:52', NULL),
(19, 'Yash', NULL, '7340252554', 770.00, 1, 0.00, 0.00, '1234', NULL, NULL, NULL, NULL, NULL, 'approve', 'H74VRZ', NULL, 0, '2023-08-17 12:40:08', '2023-08-23 21:30:11', NULL),
(20, 'Radhika', NULL, '9090123452', 100.00, 1, 0.00, 0.00, '1234', NULL, NULL, 'assets/users/20/169286039164e6ffe7242cdclassic-logo.jpg', NULL, NULL, NULL, 'RBDJMM', NULL, 0, '2023-08-24 06:07:03', '2023-08-24 06:59:51', NULL),
(21, 'vvvn', NULL, '6666666666', 0.00, 1, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FG205J', NULL, 0, '2023-08-29 17:20:01', '2023-08-29 17:20:01', NULL),
(22, 'Radhika007', NULL, '9191919191', 0.00, 1, 0.00, 0.00, NULL, NULL, '$2y$10$YnoIsObXoUbA7KHQGS529OgakLjeEgpj/umHuM0kj2bjYB4c7Nlki', NULL, NULL, NULL, NULL, 'LAOHLF', NULL, 0, '2023-08-29 17:40:43', '2023-08-29 17:40:43', NULL),
(23, 'Omi Yadavv', 'omjiyadav734025@yopmail.com', '9292929292', 0.00, 1, 0.00, 0.00, NULL, NULL, '$2y$10$uwZGKH89KW1oPCde7GjGCu1s6MZurkR3pjv0s8g.CoA3TvBEzGF.q', 'assets/users/23/169336631264eeb828d4697no-goti-cut-coming-soon.jpg', NULL, 'n1kbcit2h7yLoaoT1OslP3QH7o3cLGBstsxZFD6WT3OQHrVLeadHj9k7fuYJ', 'approve', 'NI8VT8', NULL, 1, '2023-08-29 17:58:39', '2023-08-30 05:47:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_permisssions`
--

CREATE TABLE `user_permisssions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `permission` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_permisssions`
--

INSERT INTO `user_permisssions` (`id`, `user_id`, `permission`, `created_at`, `updated_at`) VALUES
(13, 23, 'challanges', '2023-08-30 05:47:33', '2023-08-30 05:47:33'),
(14, 23, 'pages', '2023-08-30 05:47:33', '2023-08-30 05:47:33'),
(15, 15, 'dashboard', '2023-08-30 05:56:55', '2023-08-30 05:56:55'),
(16, 15, 'challanges', '2023-08-30 05:56:55', '2023-08-30 05:56:55'),
(17, 15, 'pages', '2023-08-30 05:56:55', '2023-08-30 05:56:55'),
(18, 15, 'withdrwal_request', '2023-08-30 05:56:55', '2023-08-30 05:56:55'),
(19, 15, 'fund_request', '2023-08-30 05:56:55', '2023-08-30 05:56:55'),
(20, 15, 'users', '2023-08-30 05:56:55', '2023-08-30 05:56:55'),
(21, 15, 'settings', '2023-08-30 05:56:55', '2023-08-30 05:56:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `challanges_result`
--
ALTER TABLE `challanges_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challange_type`
--
ALTER TABLE `challange_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit_transactions`
--
ALTER TABLE `deposit_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_token`
--
ALTER TABLE `device_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_challenge`
--
ALTER TABLE `game_challenge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `role_id_fk_6744` (`role_id`),
  ADD KEY `permission_id_fk_6744` (`permission_id`);

--
-- Indexes for table `referal_users`
--
ALTER TABLE `referal_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `user_id_fk_6753` (`user_id`),
  ADD KEY `role_id_fk_6753` (`role_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permisssions`
--
ALTER TABLE `user_permisssions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `challanges_result`
--
ALTER TABLE `challanges_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `challange_type`
--
ALTER TABLE `challange_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deposit_transactions`
--
ALTER TABLE `deposit_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `device_token`
--
ALTER TABLE `device_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_challenge`
--
ALTER TABLE `game_challenge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `referal_users`
--
ALTER TABLE `referal_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_permisssions`
--
ALTER TABLE `user_permisssions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_id_fk_6744` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_id_fk_6744` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
