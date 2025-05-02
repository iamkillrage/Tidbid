-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2025 at 06:22 AM
-- Server version: 8.0.41-32
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cohobete_tidbid_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$FnBSa2XPI5ZGPTSKGZ5Bzu8QBKxld3WpeFxuc66WatpWv64Gqyf2.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agora_chats`
--

CREATE TABLE `agora_chats` (
  `id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `reciver_id` bigint UNSIGNED NOT NULL,
  `chanel_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agora_messages`
--

CREATE TABLE `agora_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `channel_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reciver_id` bigint UNSIGNED DEFAULT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `side` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agora_messages`
--

INSERT INTO `agora_messages` (`id`, `channel_id`, `reciver_id`, `sender_id`, `message`, `side`, `message_date_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, 5, 'dff', 'left', '2025-04-02 02:05:09', '2025-04-02 12:35:09', '2025-04-02 12:35:09', NULL),
(2, NULL, NULL, 22, 'hello', 'right', '2025-04-08 12:48:08', '2025-04-08 23:18:08', '2025-04-08 23:18:08', NULL),
(3, NULL, NULL, 22, '😊', 'right', '2025-04-08 12:48:30', '2025-04-08 23:18:30', '2025-04-08 23:18:30', NULL),
(4, NULL, NULL, 1, '😂😎', 'right', '2025-04-18 07:24:13', '2025-04-18 17:54:13', '2025-04-18 17:54:13', NULL),
(5, NULL, NULL, 2, '😙😡', 'left', '2025-04-18 09:27:25', '2025-04-18 19:57:25', '2025-04-18 19:57:25', NULL),
(6, NULL, NULL, 2, '😇', 'left', '2025-04-18 09:27:38', '2025-04-18 19:57:38', '2025-04-18 19:57:38', NULL),
(7, NULL, NULL, 2, 'test', 'left', '2025-04-18 09:27:48', '2025-04-18 19:57:48', '2025-04-18 19:57:48', NULL),
(8, NULL, NULL, 26, '😆😢😡', 'right', '2025-04-18 11:43:25', '2025-04-18 22:13:25', '2025-04-18 22:13:25', NULL),
(9, NULL, NULL, 26, '😂', 'right', '2025-04-18 11:43:33', '2025-04-18 22:13:33', '2025-04-18 22:13:33', NULL),
(10, NULL, NULL, 28, '😭', 'left', '2025-04-29 12:09:51', '2025-04-29 22:39:51', '2025-04-29 22:39:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agores`
--

CREATE TABLE `agores` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('User','Influencer') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `infulencer_id` bigint UNSIGNED NOT NULL,
  `stream_id` bigint UNSIGNED NOT NULL,
  `bid_price` decimal(9,2) NOT NULL,
  `bid_date` date DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `user_id`, `infulencer_id`, `stream_id`, `bid_price`, `bid_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 1, 150.00, '2025-04-01', '1', '2025-04-02 00:16:28', '2025-04-02 00:16:28', NULL),
(2, 2, 1, 1, 180.00, '2025-04-01', '1', '2025-04-02 00:16:54', '2025-04-02 00:16:54', NULL),
(3, 2, 1, 2, 180.00, '2025-04-01', '1', '2025-04-02 00:28:54', '2025-04-02 00:28:54', NULL),
(4, 7, 8, 7, 160.00, '2025-04-02', '1', '2025-04-02 23:39:24', '2025-04-02 23:39:24', NULL),
(5, 21, 20, 13, 160.00, '2025-04-04', '1', '2025-04-04 21:21:21', '2025-04-04 21:21:21', NULL),
(6, 2, 1, 20, 56.00, '2025-04-25', '1', '2025-04-25 17:50:22', '2025-04-25 17:50:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `block_posts`
--

CREATE TABLE `block_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `block_posts`
--

INSERT INTO `block_posts` (`id`, `user_id`, `post_id`, `is_blocked`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 23, 1, 0, '2025-04-07 19:38:24', '2025-04-07 19:38:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chattoken`
--

CREATE TABLE `chattoken` (
  `id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `type` enum('User','Influencer') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `following_id` bigint UNSIGNED NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `following_id`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 'user', '2025-04-02 00:05:08', '2025-04-02 00:05:08', NULL),
(10, 5, 6, 'user', '2025-04-02 12:51:33', '2025-04-02 12:51:33', NULL),
(11, 7, 8, 'user', '2025-04-02 23:34:10', '2025-04-02 23:34:10', NULL),
(14, 10, 6, 'user', '2025-04-03 12:26:39', '2025-04-03 12:26:39', NULL),
(15, 11, 6, 'Influencer', '2025-04-03 12:50:24', '2025-04-03 12:50:24', NULL),
(16, 21, 20, 'user', '2025-04-04 21:23:24', '2025-04-04 21:23:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `influencer_id_verifications`
--

CREATE TABLE `influencer_id_verifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `verificationDate` date DEFAULT NULL,
  `verificationPlatform` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Inactive','Activate') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_verification` enum('Inactive','Activate') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `influencer_id_verifications`
--

INSERT INTO `influencer_id_verifications` (`id`, `user_id`, `verificationDate`, `verificationPlatform`, `otp`, `status`, `id_verification`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '2025-04-01', 'instagram', '25364', 'Activate', 'Activate', '2025-04-01 23:52:30', '2025-04-01 23:53:21', NULL),
(2, 4, '2025-04-01', 'instagram', '25364', 'Activate', 'Activate', '2025-04-02 00:48:29', '2025-04-02 00:49:08', NULL),
(3, 6, '2025-04-02', 'instagram', '25364', 'Activate', 'Activate', '2025-04-02 12:27:58', '2025-04-02 12:29:00', NULL),
(4, 8, '2025-04-02', 'instagram', '25364', 'Activate', 'Activate', '2025-04-02 23:30:55', '2025-04-02 23:31:46', NULL),
(5, 9, '2025-04-03', 'instagram', '25364', 'Inactive', 'Activate', '2025-04-03 12:11:03', '2025-04-03 12:14:36', NULL),
(6, 11, '2025-04-03', 'instagram', '25364', 'Activate', 'Activate', '2025-04-03 12:35:36', '2025-04-03 12:37:15', NULL),
(7, 12, '2025-04-04', 'instagram', '25364', 'Activate', 'Activate', '2025-04-04 20:33:05', '2025-04-04 20:34:34', NULL),
(8, 20, '2025-04-04', 'instagram', '25364', 'Activate', 'Activate', '2025-04-04 21:14:04', '2025-04-04 21:15:33', NULL),
(9, 22, '2025-04-07', 'instagram', '25364', 'Activate', 'Activate', '2025-04-07 06:28:02', '2025-04-07 06:29:11', NULL),
(10, 23, '2025-04-07', 'instagram', '25364', 'Activate', 'Activate', '2025-04-07 18:10:05', '2025-04-07 18:11:55', NULL),
(11, 24, '2025-04-07', 'instagram', '25364', 'Activate', 'Activate', '2025-04-07 23:31:19', '2025-04-07 23:32:04', NULL),
(12, 25, '2025-04-07', 'instagram', '25364', 'Activate', 'Activate', '2025-04-08 04:45:31', '2025-04-08 04:46:06', NULL),
(13, 26, '2025-04-18', 'instagram', '25364', 'Activate', 'Activate', '2025-04-18 21:44:20', '2025-04-18 21:48:08', NULL),
(14, 29, '2025-04-29', 'instagram', NULL, 'Inactive', 'Inactive', '2025-04-29 21:11:25', '2025-04-29 21:11:25', NULL),
(15, 30, '2025-04-29', 'instagram', '25364', 'Activate', 'Activate', '2025-04-29 21:20:46', '2025-04-29 22:33:30', NULL),
(16, 36, '2025-05-01', 'instagram', '25364', 'Activate', 'Activate', '2025-05-01 22:44:00', '2025-05-01 22:44:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `influencer_socials`
--

CREATE TABLE `influencer_socials` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `social_site_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `influencer_socials`
--

INSERT INTO `influencer_socials` (`id`, `user_id`, `social_site_link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 4, 'www.google.com', '2025-04-02 00:49:44', '2025-04-02 00:49:44', NULL),
(30, 5, 'https://chat.openai.com/', '2025-04-02 23:21:25', '2025-04-02 23:21:25', NULL),
(31, 8, 'www.google.com', '2025-04-02 23:32:33', '2025-04-02 23:32:33', NULL),
(40, 6, 'https://chatgpt.com/', '2025-04-03 00:35:38', '2025-04-03 00:35:38', NULL),
(41, 6, 'https://chat.openai.com/', '2025-04-03 00:35:38', '2025-04-03 00:35:38', NULL),
(43, 11, 'https://chatgpt.com/', '2025-04-03 12:44:47', '2025-04-03 12:44:47', NULL),
(46, 1, 'www.google.com', '2025-04-04 17:17:11', '2025-04-04 17:17:11', NULL),
(48, 12, 'chatgpt.com', '2025-04-04 20:41:10', '2025-04-04 20:41:10', NULL),
(49, 20, 'www.google.com', '2025-04-04 21:18:05', '2025-04-04 21:18:05', NULL),
(50, 22, 'https://meet.google.com/', '2025-04-08 23:15:20', '2025-04-08 23:15:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint UNSIGNED NOT NULL,
  `influencer_id` int NOT NULL,
  `post_id` int NOT NULL,
  `like/unlike` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `livestream_comments`
--

CREATE TABLE `livestream_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `stream_id` bigint UNSIGNED NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `livestream_comments`
--

INSERT INTO `livestream_comments` (`id`, `user_id`, `stream_id`, `comment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 2, 'hi', '2025-04-02 00:29:06', '2025-04-02 00:29:06', NULL),
(2, 1, 2, '😊', '2025-04-02 00:29:16', '2025-04-02 00:29:16', NULL),
(3, 1, 2, '❤️', '2025-04-02 00:29:17', '2025-04-02 00:29:17', NULL),
(4, 1, 2, '😊', '2025-04-02 00:29:18', '2025-04-02 00:29:18', NULL),
(5, 6, 4, '❤️', '2025-04-02 12:47:08', '2025-04-02 12:47:08', NULL),
(6, 7, 6, 'hi', '2025-04-02 23:34:17', '2025-04-02 23:34:17', NULL),
(7, 7, 6, '😊', '2025-04-02 23:34:24', '2025-04-02 23:34:24', NULL),
(8, 8, 6, '😊', '2025-04-02 23:34:27', '2025-04-02 23:34:27', NULL),
(9, 8, 6, 'hello', '2025-04-02 23:34:32', '2025-04-02 23:34:32', NULL),
(10, 8, 6, '❤️', '2025-04-02 23:34:36', '2025-04-02 23:34:36', NULL),
(11, 7, 6, '❤️', '2025-04-02 23:34:39', '2025-04-02 23:34:39', NULL),
(12, 8, 7, 'hi user', '2025-04-02 23:37:47', '2025-04-02 23:37:47', NULL),
(13, 7, 7, 'hi influencer', '2025-04-02 23:37:59', '2025-04-02 23:37:59', NULL),
(14, 8, 7, '❤️', '2025-04-02 23:38:02', '2025-04-02 23:38:02', NULL),
(15, 8, 7, '😊', '2025-04-02 23:38:03', '2025-04-02 23:38:03', NULL),
(16, 7, 7, '😊', '2025-04-02 23:38:07', '2025-04-02 23:38:07', NULL),
(17, 7, 7, '❤️', '2025-04-02 23:38:08', '2025-04-02 23:38:08', NULL),
(18, 7, 7, '👏', '2025-04-02 23:38:15', '2025-04-02 23:38:15', NULL),
(19, 8, 7, '👏', '2025-04-02 23:38:19', '2025-04-02 23:38:19', NULL),
(20, 8, 7, '😊', '2025-04-02 23:39:44', '2025-04-02 23:39:44', NULL),
(21, 7, 7, '😊', '2025-04-02 23:39:48', '2025-04-02 23:39:48', NULL),
(22, 6, 9, '👏', '2025-04-03 20:38:06', '2025-04-03 20:38:06', NULL),
(23, 21, 13, '❤️', '2025-04-04 21:19:37', '2025-04-04 21:19:37', NULL),
(24, 21, 13, '😊', '2025-04-04 21:19:42', '2025-04-04 21:19:42', NULL),
(25, 20, 13, '❤️', '2025-04-04 21:19:52', '2025-04-04 21:19:52', NULL),
(26, 20, 13, '😊', '2025-04-04 21:19:54', '2025-04-04 21:19:54', NULL),
(27, 21, 13, '👏', '2025-04-04 21:19:57', '2025-04-04 21:19:57', NULL),
(28, 20, 13, '👏', '2025-04-04 21:19:59', '2025-04-04 21:19:59', NULL),
(29, 21, 13, 'hello', '2025-04-04 21:21:06', '2025-04-04 21:21:06', NULL),
(30, 20, 13, 'hi', '2025-04-04 21:21:11', '2025-04-04 21:21:11', NULL),
(31, 22, 15, '👏', '2025-04-07 06:38:12', '2025-04-07 06:38:12', NULL),
(32, 22, 15, '👏', '2025-04-07 06:38:14', '2025-04-07 06:38:14', NULL),
(33, 22, 16, '👏', '2025-04-09 00:52:00', '2025-04-09 00:52:00', NULL),
(34, 22, 16, '😊', '2025-04-09 00:52:15', '2025-04-09 00:52:15', NULL),
(35, 22, 16, '😊', '2025-04-09 00:52:18', '2025-04-09 00:52:18', NULL),
(36, 22, 16, '❤️', '2025-04-09 00:52:20', '2025-04-09 00:52:20', NULL),
(37, 26, 17, '😊', '2025-04-18 22:15:49', '2025-04-18 22:15:49', NULL),
(38, 1, 17, '😊', '2025-04-18 23:46:34', '2025-04-18 23:46:34', NULL),
(39, 1, 18, '😊', '2025-04-21 19:23:56', '2025-04-21 19:23:56', NULL),
(40, 1, 18, '❤️', '2025-04-21 19:30:32', '2025-04-21 19:30:32', NULL),
(41, 1, 18, '❤️', '2025-04-21 19:30:32', '2025-04-21 19:30:32', NULL),
(42, 1, 18, '👏', '2025-04-21 19:30:40', '2025-04-21 19:30:40', NULL),
(43, 1, 18, '😇', '2025-04-21 19:33:20', '2025-04-21 19:33:20', NULL),
(44, 1, 18, '🤬', '2025-04-21 19:33:24', '2025-04-21 19:33:24', NULL),
(45, 2, 18, '😊', '2025-04-21 19:34:15', '2025-04-21 19:34:15', NULL),
(46, 2, 18, '😍', '2025-04-21 19:37:25', '2025-04-21 19:37:25', NULL),
(47, 2, 18, '😀', '2025-04-21 19:41:29', '2025-04-21 19:41:29', NULL),
(48, 1, 18, '❤️', '2025-04-21 20:43:42', '2025-04-21 20:43:42', NULL),
(49, 1, 18, '🤬', '2025-04-21 20:43:53', '2025-04-21 20:43:53', NULL),
(50, 1, 19, 'test', '2025-04-24 22:59:16', '2025-04-24 22:59:16', NULL),
(51, 2, 19, 'etrw', '2025-04-24 23:01:13', '2025-04-24 23:01:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_10_08_185747_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `influencer_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen_status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `influencer_id`, `title`, `message`, `seen_status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Follow Notification', 'vashu started following you', 1, '2025-04-02 00:05:08', '2025-04-08 21:31:25'),
(2, 2, 1, 'Live Now', 'aakash has Live Now', 0, '2025-04-02 00:15:37', '2025-04-02 00:15:37'),
(3, 2, 1, 'Bid Won', 'You have won the bid on this is demohhxsd', 0, '2025-04-02 00:17:01', '2025-04-02 00:17:01'),
(4, 1, 2, 'Bid Won', 'vashu has won the bid on this is demohhxsd', 1, '2025-04-02 00:17:01', '2025-04-08 21:31:25'),
(5, 2, 1, 'Bid Won', 'You have won the bid on this is demohhxsd', 0, '2025-04-02 00:18:06', '2025-04-02 00:18:06'),
(6, 1, 2, 'Bid Won', 'vashu has won the bid on this is demohhxsd', 1, '2025-04-02 00:18:06', '2025-04-08 21:31:25'),
(7, 2, 1, 'Bid Won', 'You have won the bid on this is demohhgc', 0, '2025-04-02 00:30:51', '2025-04-02 00:30:51'),
(8, 1, 2, 'Bid Won', 'vashu has won the bid on this is demohhgc', 1, '2025-04-02 00:30:51', '2025-04-08 21:31:25'),
(9, 6, 5, 'Follow Notification', 'James kotlin started following you', 1, '2025-04-02 12:35:43', '2025-04-02 22:07:45'),
(10, 6, 5, 'Follow Notification', 'James kotlin started following you', 1, '2025-04-02 12:35:47', '2025-04-02 22:07:45'),
(11, 6, 5, 'Follow Notification', 'James kotlin started following you', 1, '2025-04-02 12:35:51', '2025-04-02 22:07:45'),
(12, 6, 5, 'Follow Notification', 'James kotlin started following you', 1, '2025-04-02 12:35:54', '2025-04-02 22:07:45'),
(13, 6, 5, 'Follow Notification', 'James kotlin started following you', 1, '2025-04-02 12:35:59', '2025-04-02 22:07:45'),
(14, 6, 5, 'Follow Notification', 'James kotlin started following you', 1, '2025-04-02 12:36:04', '2025-04-02 22:07:45'),
(15, 6, 5, 'Follow Notification', 'James kotlin started following you', 1, '2025-04-02 12:36:50', '2025-04-02 22:07:45'),
(16, 6, 5, 'Follow Notification', 'James kotlin started following you', 1, '2025-04-02 12:37:06', '2025-04-02 22:07:45'),
(17, 5, 6, 'Post Shared', 'Sophia devenge has shared a post.', 1, '2025-04-02 12:41:01', '2025-04-02 21:55:35'),
(18, 5, 6, 'Live Now', 'Sophia deveng has Live Now', 1, '2025-04-02 12:46:25', '2025-04-02 21:55:35'),
(19, 5, 6, 'Subscribe Notification', 'You have Subscribed to Moosam dada ji', 1, '2025-04-02 12:48:51', '2025-04-02 21:55:35'),
(20, 6, 5, 'Follow Notification', 'James kotlin started following you', 1, '2025-04-02 12:51:33', '2025-04-02 22:07:45'),
(21, 8, 7, 'Follow Notification', 'ruhel started following you', 0, '2025-04-02 23:34:10', '2025-04-02 23:34:10'),
(22, 7, 8, 'Live Now', 'mark has Live Now', 0, '2025-04-02 23:36:50', '2025-04-02 23:36:50'),
(23, 7, 8, 'Bid Won', 'You have won the bid on my new bid', 0, '2025-04-02 23:39:56', '2025-04-02 23:39:56'),
(24, 8, 7, 'Bid Won', 'ruhel has won the bid on my new bid', 0, '2025-04-02 23:39:56', '2025-04-02 23:39:56'),
(25, 6, 10, 'Follow Notification', 'Names simon started following you', 1, '2025-04-03 12:26:31', '2025-04-03 16:56:29'),
(26, 6, 10, 'Follow Notification', 'Names simon started following you', 1, '2025-04-03 12:26:35', '2025-04-03 16:56:29'),
(27, 6, 10, 'Follow Notification', 'Names simon started following you', 1, '2025-04-03 12:26:39', '2025-04-03 16:56:29'),
(28, 6, 11, 'Follow Notification', 'Dophia singh started following you', 1, '2025-04-03 12:50:24', '2025-04-03 16:56:29'),
(29, 5, 6, 'Live Now', 'Sophiabbn has Live Now', 0, '2025-04-03 20:35:58', '2025-04-03 20:35:58'),
(30, 10, 6, 'Live Now', 'Sophiabbn has Live Now', 0, '2025-04-03 20:35:58', '2025-04-03 20:35:58'),
(31, 11, 6, 'Live Now', 'Sophiabbn has Live Now', 0, '2025-04-03 20:35:58', '2025-04-03 20:35:58'),
(32, 21, 20, 'Bid Won', 'You have won the bid on this is my first golive', 0, '2025-04-04 21:21:40', '2025-04-04 21:21:40'),
(33, 20, 21, 'Bid Won', 'martin has won the bid on this is my first golive', 0, '2025-04-04 21:21:40', '2025-04-04 21:21:40'),
(34, 20, 21, 'Follow Notification', 'martin started following you', 0, '2025-04-04 21:23:24', '2025-04-04 21:23:24'),
(35, 2, 1, 'Live Now', 'aakash has Live Now', 0, '2025-04-21 19:20:02', '2025-04-21 19:20:02'),
(36, 2, 1, 'Live Now', 'aakash has Live Now', 0, '2025-04-24 22:58:57', '2025-04-24 22:58:57'),
(37, 2, 1, 'Live Now', 'aakash has Live Now', 0, '2025-04-25 17:47:16', '2025-04-25 17:47:16'),
(38, 2, 1, 'Subscribe Notification', 'You have Subscribed to Honey singh', 0, '2025-04-25 17:50:34', '2025-04-25 17:50:34');

-- --------------------------------------------------------

--
-- Table structure for table `notifies`
--

CREATE TABLE `notifies` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `stream_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifies`
--

INSERT INTO `notifies` (`id`, `user_id`, `stream_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 5, 4, '2025-04-02 12:53:28', '2025-04-02 12:53:28', NULL),
(6, 2, 20, '2025-04-25 17:50:34', '2025-04-25 17:50:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `influencer_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('Inactive','Activate') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `influencer_id`, `title`, `location`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 'Testing', NULL, 'Hlo I am a test user', 'Inactive', '2025-04-02 12:41:01', '2025-04-02 12:41:01', NULL),
(2, 22, 'some', NULL, 'some', 'Inactive', '2025-04-09 00:58:07', '2025-04-09 00:58:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_book_marks`
--

CREATE TABLE `post_book_marks` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_book_marks`
--

INSERT INTO `post_book_marks` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 6, 1, '2025-04-03 17:02:44', '2025-04-03 17:02:44', NULL),
(6, 22, 2, '2025-04-09 00:59:14', '2025-04-09 00:59:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`id`, `user_id`, `post_id`, `comment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 1, 'fg', '2025-04-02 12:49:58', '2025-04-02 12:49:58', NULL),
(2, 11, 1, 'I am actor', '2025-04-03 12:51:04', '2025-04-03 12:51:04', NULL),
(3, 22, 2, 'testing', '2025-04-09 00:59:01', '2025-04-09 00:59:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `post_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Inactive','Activate') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_images`
--

INSERT INTO `post_images` (`id`, `post_id`, `post_img`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Influencer/images/postimage/WhatsApp Image 2025-02-28 at 17.39.17.jpeg', 'Inactive', '2025-04-02 12:41:01', '2025-04-02 12:41:01', NULL),
(2, 2, 'Influencer/images/postimage/Screenshot 2025-04-08 161324.png', 'Inactive', '2025-04-09 00:58:07', '2025-04-09 00:58:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 5, 1, '2025-04-02 12:49:51', '2025-04-02 12:49:51', NULL),
(3, 6, 1, '2025-04-02 22:01:21', '2025-04-02 22:01:21', NULL),
(9, 1, 1, '2025-04-03 23:19:19', '2025-04-03 23:19:19', NULL),
(10, 22, 2, '2025-04-09 00:58:41', '2025-04-09 00:58:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_reports`
--

CREATE TABLE `post_reports` (
  `id` bigint UNSIGNED NOT NULL,
  `type` enum('Stream','Post') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Stream',
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` int DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policies`
--

CREATE TABLE `privacy_policies` (
  `id` bigint UNSIGNED NOT NULL,
  `discription` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacy_policies`
--

INSERT INTO `privacy_policies` (`id`, `discription`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '<h3>Lorem Ipsum is simply dummy.</h3>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h3>Lorem Ipsum is simply dummy text of the printing and typesetting</h3>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,wsdwedsa</p>\r\n\r\n<p>updated data dfgrfgrgfhf</p>', '2024-03-14 05:39:05', '2025-03-29 00:50:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `private_videos`
--

CREATE TABLE `private_videos` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `stream_id` bigint UNSIGNED NOT NULL,
  `join_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refer_friends`
--

CREATE TABLE `refer_friends` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `referDate` date DEFAULT NULL,
  `referTime` time DEFAULT NULL,
  `referTo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `earnedReward` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reffered_infus`
--

CREATE TABLE `reffered_infus` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `refered_user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saved_banks`
--

CREATE TABLE `saved_banks` (
  `id` bigint UNSIGNED NOT NULL,
  `influencer_id` int NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `routing_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `btok_ids` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fingerprint` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `livemode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `used` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `all_stripe_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saved_banks`
--

INSERT INTO `saved_banks` (`id`, `influencer_id`, `country`, `bank_name`, `account_no`, `routing_no`, `btok_ids`, `bank_id`, `account_holder_name`, `account_holder_type`, `currency`, `fingerprint`, `last4`, `status`, `client_ip`, `created`, `livemode`, `type`, `used`, `all_stripe_data`, `created_at`, `updated_at`) VALUES
(5, 12, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"id\":\"btok_1RA7QwLL4SgpRhaWiBcE3IHz\",\"object\":\"token\",\"bank_account\":{\"id\":\"ba_1RA7QwLL4SgpRhaWyHFZqUUW\",\"object\":\"bank_account\",\"account_holder_name\":\"Test User\",\"account_holder_type\":\"individual\",\"account_type\":null,\"bank_name\":\"Trust bank\",\"country\":\"US\",\"currency\":\"usd\",\"fingerprint\":\"B8SUaWUQBLU8rhS8\",\"last4\":\"6789\",\"routing_number\":\"110000000\",\"status\":\"new\"},\"client_ip\":\"50.6.160.242\",\"created\":1743762310,\"livemode\":false,\"type\":\"bank_account\",\"used\":false}', '2025-04-04 20:55:10', '2025-04-04 20:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `save_cards`
--

CREATE TABLE `save_cards` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_default` enum('NO','YES') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'NO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `save_cards`
--

INSERT INTO `save_cards` (`id`, `user_id`, `customer_id`, `card_id`, `card_default`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'cus_S3BVTWHUO9zjIx', 'card_1R958tLL4SgpRhaWwMwRRzVY', 'YES', '2025-04-02 00:16:15', '2025-04-03 21:32:44', NULL),
(8, 7, 'cus_S3Y8SYYtL6WXTS', 'card_1R9R2ALL4SgpRhaWKpneWMhl', 'NO', '2025-04-02 23:38:47', '2025-04-02 23:38:47', NULL),
(12, 2, 'cus_S3tKUDcHZOrWvB', 'card_1R9lXWLL4SgpRhaWP7dK9nIR', 'NO', '2025-04-03 21:32:31', '2025-04-03 21:32:44', NULL),
(13, 2, 'cus_S3tLTPibL9C2KZ', 'card_1R9lYNLL4SgpRhaWFx4eLxtw', 'NO', '2025-04-03 21:33:24', '2025-04-03 21:33:24', NULL),
(14, 21, 'cus_S4GMuU3gXerSoD', 'card_1RA7pcLL4SgpRhaWOE3rXOMM', 'NO', '2025-04-04 21:20:41', '2025-04-04 21:20:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `send_gifts`
--

CREATE TABLE `send_gifts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `stream_id` int NOT NULL,
  `gift_amt` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `send_gifts`
--

INSERT INTO `send_gifts` (`id`, `user_id`, `stream_id`, `gift_amt`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 5.00, '2025-04-02 00:16:33', '2025-04-02 00:16:33', NULL),
(2, 2, 2, 25.00, '2025-04-02 00:29:12', '2025-04-02 00:29:12', NULL),
(3, 7, 7, 5.00, '2025-04-02 23:39:08', '2025-04-02 23:39:08', NULL),
(4, 21, 13, 25.00, '2025-04-04 21:20:55', '2025-04-04 21:20:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stream_management`
--

CREATE TABLE `stream_management` (
  `id` bigint UNSIGNED NOT NULL,
  `influencer_id` bigint UNSIGNED NOT NULL,
  `streamTitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `streamDate` date DEFAULT NULL,
  `streamTime` time DEFAULT NULL,
  `baseBidPrice` int DEFAULT NULL,
  `what_to_expect` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `term_and_conditions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Inactive','Activate') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_status` enum('Live_Streams','Upcoming_Streams','Past_Streams') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bid_end_status` int NOT NULL DEFAULT '2' COMMENT '2-bidStart,1-bidEnd',
  `streamDateTime` timestamp NULL DEFAULT NULL,
  `sid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recorded` tinyint DEFAULT '0',
  `fileList` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stream_management`
--

INSERT INTO `stream_management` (`id`, `influencer_id`, `streamTitle`, `streamDate`, `streamTime`, `baseBidPrice`, `what_to_expect`, `term_and_conditions`, `description`, `location`, `thumbnail_img`, `status`, `event_status`, `bid_end_status`, `streamDateTime`, `sid`, `recorded`, `fileList`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'this is demohhxsd', '2025-04-01', '19:15:37', 120, 'Private_Video_call', 'sdasd', 'sdadad', NULL, '1743515137_1699439669.png', 'Activate', 'Live_Streams', 1, '2025-04-02 00:15:37', '', 0, NULL, '2025-04-02 00:15:37', '2025-04-02 00:18:06', NULL),
(2, 1, 'this is demohhgc', '2025-04-01', '19:26:00', 120, 'Private_Video_call', 'xfds', 'gfddsfd', NULL, '1743515753_Figma design - image.png (1).png', 'Activate', 'Live_Streams', 1, '2025-04-02 00:26:00', '', 0, NULL, '2025-04-02 00:25:53', '2025-04-02 00:30:51', NULL),
(3, 6, 'Moosam dada ji', '2025-04-02', '07:47:00', 30, 'Private_Video_call', 'No rule', 'Dada', NULL, '1743560041_WhatsApp Image 2025-03-01 at 13.44.11.jpeg', 'Activate', 'Live_Streams', 1, '2025-04-02 12:47:00', '166a4797404b65acf5e7228cfa2f547c', 1, '[{\"uid\": \"0\", \"fileName\": \"166a4797404b65acf5e7228cfa2f547c_live_3_0.mp4\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1743593220061}, {\"uid\": \"0\", \"fileName\": \"166a4797404b65acf5e7228cfa2f547c_live_3.m3u8\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1743593220061}]', '2025-04-02 12:44:01', '2025-04-02 21:57:06', NULL),
(4, 6, 'Tauba Tauba song', '2025-04-02', '09:46:25', 1000, 'Private_Video_call', 'no', 'tfyh', NULL, '1743560185_WhatsApp Image 2025-02-28 at 19.13.29.jpeg', 'Activate', 'Live_Streams', 1, '2025-04-02 12:46:25', '4deddff82448542372f650ace2a523d8', 1, '[{\"uid\": \"0\", \"fileName\": \"4deddff82448542372f650ace2a523d8_live_4_0.mp4\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1743560196035}, {\"uid\": \"0\", \"fileName\": \"4deddff82448542372f650ace2a523d8_live_4.m3u8\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1743560196035}]', '2025-04-02 12:46:25', '2025-04-02 12:46:49', NULL),
(5, 6, 'Birthday', '2025-04-03', '20:57:00', 74, 'Private_Video_call', 'nO', 'no', NULL, '1743593290_1743502368008.png', 'Inactive', 'Upcoming_Streams', 2, '2025-04-04 01:57:00', NULL, 0, NULL, '2025-04-02 21:58:10', '2025-04-02 22:00:00', '2025-04-02 22:00:00'),
(6, 8, 'this is my first bid', '2025-04-02', '18:33:22', 120, 'Private_Video_call', 'term condition', 'description', NULL, '1743599002_Group 1000007494 (1).png', 'Activate', 'Live_Streams', 1, '2025-04-02 23:33:22', '2eccc7dfd44c04f8954b9281c26d3c26', 1, '[{\"uid\": \"0\", \"fileName\": \"2eccc7dfd44c04f8954b9281c26d3c26_live_6_0.mp4\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1743599012029}, {\"uid\": \"0\", \"fileName\": \"2eccc7dfd44c04f8954b9281c26d3c26_live_6.m3u8\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1743599012029}]', '2025-04-02 23:33:22', '2025-04-02 23:35:18', NULL),
(7, 8, 'my new bid', '2025-04-02', '18:36:50', 150, 'Private_Video_call', 'term condition', 'description', NULL, '1743599210_Group 1000005529.png', 'Activate', 'Live_Streams', 1, '2025-04-02 23:36:50', '', 0, NULL, '2025-04-02 23:36:50', '2025-04-02 23:39:56', NULL),
(8, 6, 'Mela', '2025-04-03', '01:16:00', 20, 'Private_Video_call', 'NO', 'Hlo i am a dancer', NULL, '1743665612_image_2025_03_25T13_04_03_425Z.png', 'Inactive', 'Live_Streams', 2, '2025-04-03 06:16:00', NULL, 0, NULL, '2025-04-03 18:03:32', '2025-04-03 18:03:32', NULL),
(9, 6, 'Dance', '2025-04-03', '15:35:58', 50, 'Private_Video_call', 'No rule just chill', 'Hlo', NULL, '1743674758_1743502333093.png', 'Activate', 'Live_Streams', 1, '2025-04-03 20:35:58', 'a774b397e6442eda004dceb9391aafb5', 1, '[{\"uid\": \"0\", \"fileName\": \"a774b397e6442eda004dceb9391aafb5_live_9_0.mp4\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1743674768386}, {\"uid\": \"0\", \"fileName\": \"a774b397e6442eda004dceb9391aafb5_live_9.m3u8\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1743674768386}]', '2025-04-03 20:35:58', '2025-04-03 20:37:51', NULL),
(10, 1, 'this is new event stream', '2025-04-12', '12:25:00', 120, 'Private_Video_call', 'term condition', 'description', NULL, '1743749768_Group 1000007494.png', 'Inactive', 'Upcoming_Streams', 2, '2025-04-12 17:25:00', NULL, 0, NULL, '2025-04-04 17:26:08', '2025-04-04 17:26:08', NULL),
(13, 20, 'this is my first golive', '2025-04-04', '16:18:48', 150, 'Private_Video_call', 'term condition', 'description', NULL, '1743763728_Rectangle 39963 (1).png', 'Activate', 'Live_Streams', 1, '2025-04-04 21:18:48', 'afad3120fe4d040dbfd1bbaea9614a88', 1, '[{\"uid\": \"0\", \"fileName\": \"afad3120fe4d040dbfd1bbaea9614a88_live_13_0.mp4\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1743763736924}, {\"uid\": \"0\", \"fileName\": \"afad3120fe4d040dbfd1bbaea9614a88_live_13.m3u8\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1743763736924}]', '2025-04-04 21:18:48', '2025-04-04 21:21:42', NULL),
(14, 20, 'this is my new stream', '2025-04-14', '16:22:00', 150, 'Private_Video_call', 'term condition', 'description', NULL, '1743763978_Group 1000006794 (3).png', 'Inactive', 'Upcoming_Streams', 2, '2025-04-14 21:22:00', NULL, 0, NULL, '2025-04-04 21:22:58', '2025-04-04 21:22:58', NULL),
(15, 22, 'dsadsa', '2025-04-07', '01:37:57', 22, 'Private_Video_call', 'wewqewq', 'wqewqeqw', NULL, '1743970077_dsasadsa.png', 'Activate', 'Live_Streams', 2, '2025-04-07 06:37:57', '40d8fd93e94b1ec7efc8a3a984daf4b3', 1, '[{\"uid\": \"0\", \"fileName\": \"40d8fd93e94b1ec7efc8a3a984daf4b3_live_15_0.mp4\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1743970087283}, {\"uid\": \"0\", \"fileName\": \"40d8fd93e94b1ec7efc8a3a984daf4b3_live_15.m3u8\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1743970087283}]', '2025-04-07 06:37:57', '2025-04-07 06:42:03', NULL),
(16, 22, 'testing live', '2025-04-08', '19:36:23', 1000, 'Private_Video_call', 'testing terms', 'testing description', NULL, '1744121183_Screenshot 2025-04-08 161324.png', 'Activate', 'Live_Streams', 1, '2025-04-09 00:36:23', 'f04411607b4ffff249a9538852e5776a', 1, '[{\"uid\": \"0\", \"fileName\": \"f04411607b4ffff249a9538852e5776a_live_16_0.mp4\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1744121196370}, {\"uid\": \"0\", \"fileName\": \"f04411607b4ffff249a9538852e5776a_live_16.m3u8\", \"trackType\": \"audio_and_video\", \"isPlayable\": true, \"mixedAllUser\": true, \"sliceStartTime\": 1744121196370}]', '2025-04-09 00:36:23', '2025-04-09 00:53:35', NULL),
(17, 26, 'QWRT54', '2025-04-18', '17:15:41', 84, 'Private_Video_call', 'RYT', 'RTTR', NULL, '1744976741_Awrd dummy imaeg.jpeg', 'Activate', 'Live_Streams', 2, '2025-04-18 22:15:41', '5fadb837cf4b7eb6be6c73a973493f59', 0, NULL, '2025-04-18 22:15:41', '2025-04-18 23:46:35', NULL),
(18, 1, 'test', '2025-04-21', '14:20:02', 12, 'Private_Video_call', 'test', 'teswt', NULL, '1745225402_zZleMUGauOzXTTmRWQqt1w6M98aqtMAhMGPohNaK.png', 'Activate', 'Live_Streams', 2, '2025-04-21 19:20:02', '2f19978d234ce226fdec709dd89562e5', 0, NULL, '2025-04-21 19:20:02', '2025-04-21 23:55:07', NULL),
(19, 1, 'test', '2025-04-24', '17:58:57', 12, 'Private_Video_call', 'retwret', 'eytrey', NULL, '1745497737_heart-icon-grey.png', 'Activate', 'Live_Streams', 2, '2025-04-24 22:58:57', '109ec36496475fefc54e3189a8f25a35', 0, NULL, '2025-04-24 22:58:57', '2025-04-24 22:59:04', NULL),
(20, 1, 'Honey singh', '2025-04-25', '12:47:16', 55, 'Private_Video_call', 'kgsfyhdb', 'rgrtg', NULL, '1745565436_th (24).jpeg', 'Activate', 'Live_Streams', 2, '2025-04-25 17:47:16', 'a6ad73bdc94cdb65e1dd25ad349ffa04', 0, NULL, '2025-04-25 17:47:16', '2025-04-25 17:47:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suggest_influencers`
--

CREATE TABLE `suggest_influencers` (
  `id` bigint UNSIGNED NOT NULL,
  `influencer_id` bigint UNSIGNED NOT NULL,
  `suggest_influencer_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `term_conditions`
--

CREATE TABLE `term_conditions` (
  `id` bigint UNSIGNED NOT NULL,
  `discription` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_conditions`
--

INSERT INTO `term_conditions` (`id`, `discription`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '<h3>Lorem Ipsum is simply dummy.</h3>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h3>Lorem Ipsum is simply dummy text of the printing and typesetting</h3>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,wsdwedd tghhyyrr raja&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '2024-03-14 05:37:51', '2025-02-17 17:56:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transections`
--

CREATE TABLE `transections` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `influencer_id` bigint UNSIGNED NOT NULL,
  `stream_id` bigint UNSIGNED NOT NULL,
  `date_time` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transections`
--

INSERT INTO `transections` (`id`, `user_id`, `influencer_id`, `stream_id`, `date_time`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 1, '2025-04-01 19:16:28', 150.00, '2025-04-02 00:16:28', '2025-04-02 00:16:28', NULL),
(2, 2, 1, 1, '2025-04-01 19:16:33', 5.00, '2025-04-02 00:16:33', '2025-04-02 00:16:33', NULL),
(3, 2, 1, 1, '2025-04-01 19:16:54', 180.00, '2025-04-02 00:16:54', '2025-04-02 00:16:54', NULL),
(4, 2, 1, 2, '2025-04-01 19:28:54', 180.00, '2025-04-02 00:28:54', '2025-04-02 00:28:54', NULL),
(5, 2, 1, 2, '2025-04-01 19:29:12', 25.00, '2025-04-02 00:29:12', '2025-04-02 00:29:12', NULL),
(6, 7, 8, 7, '2025-04-02 18:39:08', 5.00, '2025-04-02 23:39:08', '2025-04-02 23:39:08', NULL),
(7, 7, 8, 7, '2025-04-02 18:39:24', 160.00, '2025-04-02 23:39:24', '2025-04-02 23:39:24', NULL),
(8, 21, 20, 13, '2025-04-04 16:20:55', 25.00, '2025-04-04 21:20:55', '2025-04-04 21:20:55', NULL),
(9, 21, 20, 13, '2025-04-04 16:21:21', 160.00, '2025-04-04 21:21:21', '2025-04-04 21:21:21', NULL),
(10, 2, 1, 20, '2025-04-25 12:50:22', 56.00, '2025-04-25 17:50:22', '2025-04-25 17:50:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `profile_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` enum('Inactive','Activate') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Inactive',
  `role` enum('User','Influencer') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `verify_status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `referral_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `followers` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `followings` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agree` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `profile_status` enum('Pending','Complete') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `agora_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `userName`, `email`, `password`, `phone`, `dob`, `profile_img`, `bio`, `email_verified_at`, `status`, `role`, `verify_status`, `referral_code`, `remember_token`, `followers`, `followings`, `bid`, `agree`, `profile_status`, `agora_id`, `customer_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'aakash', 'Aakashk', 'aakash@yopmail.com', '$2y$12$wna6I/ZSI/Wz7I1Tw0TgLOCRTbvaMrEIFOj8puPweeg2fPS7FUx.W', '9944175784', '2024-06-04', '1743513920_1707988495.jpg', 'this is my profile', NULL, 'Inactive', 'Influencer', '0', 'mhQLG', NULL, NULL, NULL, '', '1', 'Complete', 'Aakash1', NULL, '2025-04-01 23:52:28', '2025-05-01 23:04:47', NULL),
(2, 'vashu', NULL, 'vashu@yopmail.com', '$2y$12$vEPLy2XdG4P2fN0rsfgDVeIdODPo2tA./iEb3QgKQ1aGhnYK/6TXO', '1458749857', '2024-09-10', '1743592809_Group 1000007036 (1).png', NULL, NULL, 'Activate', 'User', '0', 'HXwz9n', NULL, NULL, NULL, '', '0', 'Complete', 'user2', 'cus_S3BEyPtlpVCYfD', '2025-04-01 23:58:23', '2025-04-30 19:34:58', '2025-04-30 19:34:58'),
(3, 'Vashu dev', NULL, 'test21@yopmail.com', '$2y$12$ogWtMXZZDqhKEQ7Y3jwhP.JdJd/aVl3ZL24tmF0Lm9iy/MAz59t4S', '08826514', '2025-02-03', '1743516904_1743502256304.png', NULL, NULL, 'Activate', 'User', '0', 'd5DZaW', NULL, NULL, NULL, '', '0', 'Complete', 'user3', 'cus_S3Bv1y0rJFpvix', '2025-04-02 00:41:52', '2025-05-01 18:09:28', '2025-05-01 18:09:28'),
(4, 'ritin', 'ritin', 'ritin@yopmail.com', '$2y$12$e9qqwbzmz9ho7opl9iivGOGE7Ltw5YwD.75yTo/A7Dv1nP7QMBbaS', '9910632023', '2025-01-14', '1743517184_Figma design - image.png (1).png', 'saDXs', NULL, 'Activate', 'Influencer', '0', 'BSLhU', NULL, NULL, NULL, '', '1', 'Complete', 'ritin4', NULL, '2025-04-02 00:48:27', '2025-04-02 00:49:44', NULL),
(5, 'James charlien', NULL, 'James@yopmail.com', '$2y$12$W.Yb1v5HgBP0Uc9hd4XwNu7xy.Yr5J7kRys8qGAEio5mtOyqkw5/e', '1457578574', '2025-01-06', '1743597765_1743502419842.png', 'edf', NULL, 'Activate', 'User', '0', 'bFGpFY', NULL, NULL, NULL, '', '0', 'Complete', 'user5', 'cus_S3MsypXXNSRNu0', '2025-04-02 12:00:25', '2025-04-02 23:21:25', NULL),
(6, 'Sophiabbn', 'Sophia', 'Sophia@yopmail.com', '$2y$12$zZCZKtZDFBqiSkhMDgQxk.hGNrUeg2AmuUCf1JwIVWrcAnd8eAub6', '7878798798', '0202-04-01', '1743559202_WhatsApp Image 2025-03-01 at 13.50.19.jpeg', 'i am a new user', NULL, 'Activate', 'Influencer', '0', 'v4uU7', NULL, NULL, NULL, '', '1', 'Complete', 'Sophia6', NULL, '2025-04-02 12:27:55', '2025-04-03 16:28:39', NULL),
(7, 'ruhel', NULL, 'ruhel@yopmail.com', '$2y$12$IpaDRk7AY0.SgPms1fQaL.8ibBI518bp5GsgdFaENJrSi3V28uFXa', '9988441155', '2023-03-06', '1743598808_Group 1000006794 (3).png', NULL, NULL, 'Activate', 'User', '0', 'oh5SNc', NULL, NULL, NULL, '', '0', 'Complete', 'user7', 'cus_S3XyvN874UWgsR', '2025-04-02 23:29:01', '2025-04-02 23:30:14', NULL),
(8, 'mark', 'mark', 'mark@yopmail.com', '$2y$12$QjHPqaMCUe/QChbXfM3lC.Ozl3rcAJGz7F.yDZ/MUmmK9TiEuklhm', '9945215248', '2023-05-07', '1743598953_Group 1000006801.png', 'i am a new influencer', NULL, 'Activate', 'Influencer', '0', 'QQTVi', NULL, NULL, NULL, '', '1', 'Complete', 'mark8', NULL, '2025-04-02 23:30:52', '2025-04-02 23:32:33', NULL),
(9, NULL, 'kames', 'Kames@yopmail.com', '$2y$12$zQ1tzwLRLkoAuHuzoRWcz.YM9Hr2.93rJx8.VwIBUquNUJdcqK43u', NULL, NULL, NULL, NULL, NULL, 'Activate', 'Influencer', '0', 'Eze6R', NULL, NULL, NULL, '', '1', 'Pending', 'kames9', NULL, '2025-04-03 12:11:01', '2025-04-03 12:14:36', NULL),
(10, 'Names simon', NULL, 'Names@yopmail.com', '$2y$12$58Otin3.hAorqf8.X/.51OQzEAZFnleAU./AFUqTWaQqLNSAipGTC', '8826514989', '2026-03-05', '1743644804_WhatsApp Image 2025-03-01 at 13.44.11.jpeg', NULL, NULL, 'Activate', 'User', '0', 'PVvAXg', NULL, NULL, NULL, '', '0', 'Complete', 'user10', 'cus_S3kKlLXr71eMCw', '2025-04-03 12:15:16', '2025-04-30 19:35:07', '2025-04-30 19:35:07'),
(11, 'Dophia singh', 'Dophia', 'Dophia@yopmail.com', '$2y$12$TMSjo4zbC4j.t8/3CMdwteMJG.p6ayLMhzqqtJB6I6pzDKnBmnq9G', '8826514454', '2025-04-02', '1743646123_WhatsApp Image 2025-02-28 at 20.04.38.jpeg', 'Hlo i am sophia ansari', NULL, 'Activate', 'Influencer', '0', 'BEZji', NULL, NULL, NULL, '', '1', 'Complete', 'Dophia11', NULL, '2025-04-03 12:35:34', '2025-04-03 12:38:43', NULL),
(12, 'Dega jone', 'Dega', 'Dega@yopmail.com', '$2y$12$oF6Uru/bQJuNx7jrfsDBBe9bvx8Um6gmbJqmR/j16VrZNN2fyN872', '8899665577', '2025-02-03', '1743761443_wellwise log.png', 'wefe', NULL, 'Activate', 'Influencer', '0', 'wxPes', NULL, NULL, NULL, '', '1', 'Complete', 'Dega12', NULL, '2025-04-04 20:33:02', '2025-04-04 20:41:10', NULL),
(13, NULL, NULL, 'Mega@yopmail.com', '$2y$12$mhATFtLH1kuF5Q.1rVnXa.SFdlRJcAPWBAyvmIa.Z6DM7iiNhpqVa', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'User', '0', 'A6LSaB', NULL, NULL, NULL, '', '0', 'Pending', 'user13', 'cus_S4Fx0Y0am4Qioa', '2025-04-04 20:55:52', '2025-04-04 20:55:55', NULL),
(14, 'Mega singh', NULL, 'Mega@yopmail.com', '$2y$12$Kit.GIHKzncH4G7qWKcwHusiCVsPbT.Yg3OWDQFv3w5QBsn0oQFZi', '8899665577', '2025-04-01', '1743762439_quality_220xf734 (3).png', NULL, NULL, 'Activate', 'User', '0', 'QLjigI', NULL, NULL, NULL, '', '0', 'Complete', 'user14', 'cus_S4Fx40kQXyMZyZ', '2025-04-04 20:55:54', '2025-04-30 19:35:25', '2025-04-30 19:35:25'),
(15, NULL, NULL, 'saddam@gmail.com', '$2y$12$6uRI2UhOLlMiWicimRThwuBV/jo3Wn7EJ8XzEUnVZwBjgJgeO1Wfa', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'User', '0', 'mNljJW', NULL, NULL, NULL, '', '0', 'Pending', 'user15', 'cus_S4GChYRblJs2yP', '2025-04-04 21:10:33', '2025-04-04 21:10:36', NULL),
(16, NULL, NULL, 'saddam@gmail.com', '$2y$12$nN6aDcWufvfPYgBAhNTb/.qWRLna2C05x7BO/x7o.GirCbtqx7Ooa', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'User', '0', 'fCB2CJ', NULL, NULL, NULL, '', '0', 'Pending', 'user16', 'cus_S4GCn4bMxuzDe3', '2025-04-04 21:10:35', '2025-04-30 19:35:20', '2025-04-30 19:35:20'),
(17, NULL, NULL, 'saddam@gmail.com', '$2y$12$21Xt2/qfdxCHosbzVYYQeOn44CEYcesEKxppzAO9xk7iS8HIA1wEG', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'User', '0', 'G9qEmw', NULL, NULL, NULL, '', '0', 'Pending', 'user17', 'cus_S4GCmOgX3RtQOS', '2025-04-04 21:10:36', '2025-04-04 21:10:38', NULL),
(18, NULL, NULL, 'saddam@gmail.com', '$2y$12$2/Cgf8s8vMl57gys1qvd5.qucnB5JpHdfrdz/xQ6oiiZuks9IL8PG', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'User', '0', 'XvUpF7', NULL, NULL, NULL, '', '0', 'Pending', 'user18', 'cus_S4GCsId8eFVuY7', '2025-04-04 21:10:37', '2025-04-30 19:35:13', '2025-04-30 19:35:13'),
(19, NULL, NULL, 'saddam@gmail.com', '$2y$12$Z2XMwkAWG7s9LHUlAUKWN.0dapgKvJ5fnAyvGSxGI8h988qYear4.', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'User', '0', 'LenPwy', NULL, NULL, NULL, '', '0', 'Pending', 'user19', 'cus_S4GCRAIc3rHcHN', '2025-04-04 21:10:37', '2025-04-04 21:10:39', NULL),
(20, 'steve', 'steve', 'steve@yopmail.com', '$2y$12$kjEMqjOOf/v2r36QEjlTk.SF3IoAc3lrbBDmUfw9Kqscrn96mXjXG', '9945215248', '2023-12-04', '1743763685_Group 1000007496.png', 'hi i am steve', NULL, 'Activate', 'Influencer', '0', 'k9Hgc', NULL, NULL, NULL, '', '1', 'Complete', 'steve20', NULL, '2025-04-04 21:14:02', '2025-04-04 21:18:05', NULL),
(21, 'martin', NULL, 'martin@yopmail.com', '$2y$12$D7RhRpJUXzLesoeYvvaDU.wSeqb0H1YyoleUxwVgZ/AgHTI2O6n5.', '8844775599', '2020-02-11', '1743763631_Group 1000006794 (3).png', NULL, NULL, 'Activate', 'User', '0', '4VmN4N', NULL, NULL, NULL, '', '0', 'Complete', 'user21', 'cus_S4GHeo9Q8aCWt8', '2025-04-04 21:16:09', '2025-04-04 21:17:11', NULL),
(22, 'mono_space', 'sebsatianjoseph', 'josephabish@gmail.com', '$2y$12$Q6szG9TXJpFpTnuQvdvUjO36mh6h4Y/VkFUwWJxUsb3IMjsh72yPC', '1234567891', '2022-12-21', '1744116320_Screenshot 2025-02-23 143505.png', 'hello testing all', NULL, 'Activate', 'Influencer', '0', 'Y61Yt', NULL, NULL, NULL, '', '1', 'Complete', 'sebsatianjoseph22', NULL, '2025-04-07 06:27:58', '2025-04-08 23:15:20', NULL),
(23, NULL, 'Dhawan', 'Dhawan@yopmail.com', '$2y$12$M3kUHUpeFdczBonG3d8N.OFcmdcYvvCOsY.qCai5zykgTfXDM4zUG', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'Influencer', '0', 'jxGBl', NULL, NULL, NULL, '', '1', 'Pending', 'Dhawan23', NULL, '2025-04-07 18:10:01', '2025-05-01 23:04:14', NULL),
(24, NULL, 'Kian', 'Kian@yopmail.com', '$2y$12$AYsECyYV8M7CrZubsj9a..OusNHCZX6p8rTz67Q.lzK7ejlRmwLRC', NULL, NULL, NULL, NULL, NULL, 'Activate', 'Influencer', '0', 'nTZPp', NULL, NULL, NULL, '', '1', 'Pending', 'Kian24', NULL, '2025-04-07 23:31:15', '2025-04-07 23:31:48', NULL),
(25, NULL, 'James', 'James2@yopmail.com', '$2y$12$KQKGBybc0cFOer6.71T7k..RQrenQ0pIUTsYWDjLmVjNFCqQKmtL2', NULL, NULL, NULL, NULL, NULL, 'Activate', 'Influencer', '0', 'J2BuB', NULL, NULL, NULL, '', '1', 'Pending', 'James25', NULL, '2025-04-08 04:45:29', '2025-04-08 04:45:52', NULL),
(26, NULL, 'Travis', 'Travis@yopmail.com', '$2y$12$1aO4CDIAp1oFMeU9ff/obekOHgKeAXXr1qz9AKCPJwK3N3OpV.HUy', NULL, NULL, NULL, NULL, NULL, 'Activate', 'Influencer', '0', 'u9VGn', NULL, NULL, NULL, '', '1', 'Pending', 'Travis26', NULL, '2025-04-18 21:44:18', '2025-04-18 21:44:48', NULL),
(27, 'Omkar', NULL, 'omkar@yopmail.com', '$2y$12$tvcvkgCBczcDZwAk.obVYe1FWlEOje8t.8I7UJNS7LJBq5ZV4IUkO', '8798487894', '2025-04-01', '1745830190_kailesh kher.jpeg', NULL, NULL, 'Activate', 'User', '0', 'WGAk2I', NULL, NULL, NULL, '', '0', 'Complete', 'user27', 'cus_SDDodc361bySyh', '2025-04-28 19:18:40', '2025-04-28 19:19:50', NULL),
(28, 'Alia john', NULL, 'Alia@yopmail.com', '$2y$12$C1iou7oWGdY9iU/8RGF8Zud8Rnx2tbG3y5dTUyZPkpPp6/XN4bMFm', '6498797878', '2025-04-01', '1745906550_Consumer.jpeg', NULL, NULL, 'Activate', 'User', '0', 'j8trdm', NULL, NULL, NULL, '', '0', 'Complete', 'user28', 'cus_SDYLCYKTvKhGc6', '2025-04-29 16:31:30', '2025-04-29 16:32:30', NULL),
(29, NULL, 'salman', 'salmankhankhilji00@gmail.com', '$2y$12$AKiylrQxDds.AoJnHl84De2MKKNM3oSFtUJ2bQ5wijEtiup4D88Yu', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'Influencer', '0', 'Nf11g', NULL, NULL, NULL, '', '1', 'Pending', 'salman29', NULL, '2025-04-29 21:11:23', '2025-04-29 21:11:25', NULL),
(30, NULL, 'salman', 'salmankhankhilji00@gmail.com', '$2y$12$I3xzvAGL3FWpZOlvkXh1IunwYDhX2Lfb4ZiwrZF4uKQ85jzo46K..', NULL, NULL, NULL, NULL, NULL, 'Activate', 'Influencer', '0', 'g89gq', NULL, NULL, NULL, '', '1', 'Pending', 'salman30', NULL, '2025-04-29 21:20:44', '2025-04-29 21:26:28', NULL),
(31, NULL, NULL, 'salmanweb7374@gmail.com', '$2y$12$PjzEuMC7pEi8FHVSlW7QuOQkChJ2x2VoV9Eq3b4TIJjfUiPKvEM.G', NULL, NULL, NULL, NULL, NULL, 'Activate', 'User', '0', 'FW4AYl', NULL, NULL, NULL, '', '0', 'Pending', 'user31', 'cus_SDdAhq70A6lsqQ', '2025-04-29 21:30:57', '2025-04-29 21:32:29', NULL),
(32, NULL, NULL, 'iamkillrage@gmail.com', '$2y$12$5odXN.wKbRObcM/wFXjJHO2tNxcqKRvXqEI3HYazp8t.Hl7Pe0Cqe', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'User', '0', '7R7qhu', NULL, NULL, NULL, '', '0', 'Pending', 'user32', 'cus_SE3wFEVNt9iC2C', '2025-05-01 01:11:10', '2025-05-01 01:11:12', NULL),
(33, NULL, NULL, 'tidbidotp@gmail.com', '$2y$12$4r.MmxyRJgJQ5jvGBXeUH.QA8pkLh/BgOqErNK/HMRiGPqZNflvP.', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'User', '0', 'JVtAF1', NULL, NULL, NULL, '', '0', 'Pending', 'user33', 'cus_SE4DbCnmiI0ZUl', '2025-05-01 01:27:38', '2025-05-01 01:27:40', NULL),
(34, NULL, NULL, 'tidbidotp@gmail.com', '$2y$12$LWqbpWYY4z3t0yjvmEAdhuksF0/wwpHTagYMMJXCT86YX0SF8hRBm', NULL, NULL, NULL, NULL, NULL, 'Activate', 'User', '0', 'J33qH8', NULL, NULL, NULL, '', '0', 'Pending', 'user34', 'cus_SE4D4IwdI4bjLu', '2025-05-01 01:27:39', '2025-05-01 01:28:40', NULL),
(35, NULL, NULL, 'Ansh@yopmail.com', '$2y$12$8SDEFSYNFkkCtOsj.gGwYuWPoLRSjatTjrArwGk.ktOBU.DCa15L2', NULL, NULL, NULL, NULL, NULL, 'Activate', 'User', '0', 'cc71y3', NULL, NULL, NULL, '', '0', 'Pending', 'user35', 'cus_SENQXSIWw8Q2BX', '2025-05-01 21:18:36', '2025-05-01 22:08:59', NULL),
(36, NULL, 'Heer', 'Heer@yopmail.com', '$2y$12$N1lCBXr2Vn2ueJPua.c0AOM2QPWo.oA0qhOlhQojx0qW/n9WyoZOa', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'Influencer', '0', 'JiDYY', NULL, NULL, NULL, '', '1', 'Pending', 'Heer36', NULL, '2025-05-01 22:43:58', '2025-05-01 22:46:09', NULL),
(37, NULL, NULL, 'juli@yopmail.com', '$2y$12$6Umn.OfDZtBPxnvW5ToC7OVZl2lUrRN7MoRxjU8NKzrMk5TUmuhqG', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'User', '0', 'mxZgIV', NULL, NULL, NULL, '', '0', 'Pending', 'user37', 'cus_SEOz3fDt8Ng5xf', '2025-05-01 22:55:33', '2025-05-01 22:55:35', NULL),
(38, NULL, NULL, 'juli@yopmail.com', '$2y$12$HOKFECYVV4DbVGKW91A1ZOI/m17qcBNw.Z8fY4reUHvnwc3sXSLt.', NULL, NULL, NULL, NULL, NULL, 'Activate', 'User', '0', 'Vth5i9', NULL, NULL, NULL, '', '0', 'Pending', 'user38', 'cus_SEOziz9qJiSNFb', '2025-05-01 22:55:36', '2025-05-01 23:20:54', NULL),
(39, NULL, NULL, 'bhanu@yopmail.com', '$2y$12$mKxyTplGvxlo8IMXLNwZduVI65BxFKcXzPYos59PB2ENVa8vYG0hC', NULL, NULL, NULL, NULL, NULL, 'Activate', 'User', '0', 'No9477', NULL, NULL, NULL, '', '0', 'Pending', 'user39', 'cus_SEP6dAu7l6cKQq', '2025-05-01 23:02:32', '2025-05-01 23:02:59', NULL),
(40, NULL, NULL, 'kamran@yopmail.com', '$2y$12$8Npy.kmXr5uKFnCVuFTAO.M3aK2lctj1TxfDsJxFMjnWmezWuErhS', NULL, NULL, NULL, NULL, NULL, 'Activate', 'User', '0', 'I8JoV4', NULL, NULL, NULL, '', '0', 'Pending', 'user40', 'cus_SEPPe2VPsg9FJb', '2025-05-01 23:21:35', '2025-05-01 23:21:56', NULL),
(41, NULL, NULL, 'Ales@yopmail.com', '$2y$12$xJSgF2GAC1l9l3ufwCycFO5Kgl1IBqULqDJf07aAh9UWELWJhBXay', NULL, NULL, NULL, NULL, NULL, 'Activate', 'User', '0', 'sbL1Ia', NULL, NULL, NULL, '', '0', 'Pending', 'user41', 'cus_SEPU03k6bSAEzd', '2025-05-01 23:27:18', '2025-05-01 23:29:10', NULL),
(42, NULL, NULL, 'Legend@yopmail.com', '$2y$12$Zq5/uWCUcVOE.jepKvTM9.9cZny6c7B9fTlgUvO2KZEiS7QyBxmNi', NULL, NULL, NULL, NULL, NULL, 'Activate', 'User', '0', '4NjVfn', NULL, NULL, NULL, '', '0', 'Pending', 'user42', 'cus_SEPbg0sRURFs3Z', '2025-05-01 23:33:38', '2025-05-01 23:33:53', NULL),
(43, NULL, NULL, 'abishsebastianjoseph@gmail.com', '$2y$12$lRhYLblvEKRhVDxHb.dbGusQWJkBcNPGW.vhHMtQo1xXqVcuGPjyW', NULL, NULL, NULL, NULL, NULL, 'Inactive', 'User', '0', 'wViZXf', NULL, NULL, NULL, '', '0', 'Pending', 'user43', 'cus_SEXhH7BsdYNPeM', '2025-05-02 07:55:25', '2025-05-02 07:55:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_otps`
--

CREATE TABLE `user_otps` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_date_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_otps`
--

INSERT INTO `user_otps` (`id`, `user_id`, `otp`, `otp_date_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '66876', '2025-04-01 06:52:30', '2025-04-01 23:52:30', '2025-04-01 23:52:30', NULL),
(2, 2, '60261', '2025-04-01 06:58:25', '2025-04-01 23:58:25', '2025-04-01 23:58:25', NULL),
(3, 3, '94664', '2025-04-01 07:41:55', '2025-04-02 00:41:55', '2025-04-02 00:41:55', NULL),
(4, 4, '84495', '2025-04-01 07:48:29', '2025-04-02 00:48:29', '2025-04-02 00:48:29', NULL),
(5, 5, '80224', '2025-04-02 07:00:27', '2025-04-02 12:00:27', '2025-04-02 12:00:27', NULL),
(6, 6, '22038', '2025-04-02 07:27:58', '2025-04-02 12:27:58', '2025-04-02 12:27:58', NULL),
(7, 5, '78540', '2025-04-02 05:05:17', '2025-04-02 22:05:18', '2025-04-02 22:05:18', NULL),
(8, 5, '81469', '2025-04-02 05:05:21', '2025-04-02 22:05:21', '2025-04-02 22:05:21', NULL),
(9, 7, '35217', '2025-04-02 06:29:04', '2025-04-02 23:29:04', '2025-04-02 23:29:04', NULL),
(10, 8, '90209', '2025-04-02 06:30:55', '2025-04-02 23:30:55', '2025-04-02 23:30:55', NULL),
(11, 9, '27225', '2025-04-03 07:11:03', '2025-04-03 12:11:03', '2025-04-03 12:11:03', NULL),
(12, 9, '40639', '2025-04-03 07:11:09', '2025-04-03 12:11:09', '2025-04-03 12:11:09', NULL),
(13, 10, '96596', '2025-04-03 07:15:18', '2025-04-03 12:15:18', '2025-04-03 12:15:18', NULL),
(14, 11, '72752', '2025-04-03 07:35:36', '2025-04-03 12:35:36', '2025-04-03 12:35:36', NULL),
(15, 11, '15183', '2025-04-03 07:35:40', '2025-04-03 12:35:40', '2025-04-03 12:35:40', NULL),
(16, 6, '64913', '2025-04-03 11:27:45', '2025-04-03 16:27:47', '2025-04-03 16:27:47', NULL),
(17, 6, '47021', '2025-04-03 11:27:47', '2025-04-03 16:27:49', '2025-04-03 16:27:49', NULL),
(18, 6, '91681', '2025-04-03 11:27:52', '2025-04-03 16:27:52', '2025-04-03 16:27:52', NULL),
(19, 1, '79914', '2025-04-03 04:22:14', '2025-04-03 21:22:15', '2025-04-03 21:22:15', NULL),
(20, 1, '70110', '2025-04-03 04:22:19', '2025-04-03 21:22:19', '2025-04-03 21:22:19', NULL),
(21, 2, '57829', '2025-04-03 04:40:43', '2025-04-03 21:40:44', '2025-04-03 21:40:44', NULL),
(22, 2, '23682', '2025-04-03 04:40:50', '2025-04-03 21:40:50', '2025-04-03 21:40:50', NULL),
(23, 2, '61854', '2025-04-03 04:54:37', '2025-04-03 21:54:38', '2025-04-03 21:54:38', NULL),
(24, 2, '69725', '2025-04-03 04:54:45', '2025-04-03 21:54:45', '2025-04-03 21:54:45', NULL),
(25, 2, '48617', '2025-04-03 04:57:00', '2025-04-03 21:57:00', '2025-04-03 21:57:00', NULL),
(26, 2, '97889', '2025-04-03 05:36:34', '2025-04-03 22:36:34', '2025-04-03 22:36:34', NULL),
(27, 2, '89177', '2025-04-03 05:50:16', '2025-04-03 22:50:16', '2025-04-03 22:50:16', NULL),
(28, 1, '49966', '2025-04-04 12:19:50', '2025-04-04 17:19:50', '2025-04-04 17:19:50', NULL),
(29, 2, '87027', '2025-04-04 12:20:53', '2025-04-04 17:20:55', '2025-04-04 17:20:55', NULL),
(30, 1, '55883', '2025-04-04 01:02:21', '2025-04-04 18:02:22', '2025-04-04 18:02:22', NULL),
(31, 1, '79141', '2025-04-04 01:02:26', '2025-04-04 18:02:26', '2025-04-04 18:02:26', NULL),
(32, 1, '40940', '2025-04-04 01:03:12', '2025-04-04 18:03:12', '2025-04-04 18:03:12', NULL),
(33, 1, '88693', '2025-04-04 01:04:16', '2025-04-04 18:04:16', '2025-04-04 18:04:16', NULL),
(34, 1, '17952', '2025-04-04 01:07:48', '2025-04-04 18:07:50', '2025-04-04 18:07:50', NULL),
(35, 1, '83522', '2025-04-04 01:07:52', '2025-04-04 18:07:52', '2025-04-04 18:07:52', NULL),
(36, 1, '29253', '2025-04-04 01:09:39', '2025-04-04 18:09:40', '2025-04-04 18:09:40', NULL),
(37, 1, '78581', '2025-04-04 01:09:44', '2025-04-04 18:09:44', '2025-04-04 18:09:44', NULL),
(38, 1, '55564', '2025-04-04 01:10:15', '2025-04-04 18:10:16', '2025-04-04 18:10:16', NULL),
(39, 1, '44846', '2025-04-04 01:10:19', '2025-04-04 18:10:19', '2025-04-04 18:10:19', NULL),
(40, 1, '92364', '2025-04-04 01:12:40', '2025-04-04 18:12:40', '2025-04-04 18:12:40', NULL),
(41, 1, '48788', '2025-04-04 01:13:16', '2025-04-04 18:13:17', '2025-04-04 18:13:17', NULL),
(42, 1, '45388', '2025-04-04 01:13:20', '2025-04-04 18:13:20', '2025-04-04 18:13:20', NULL),
(43, 2, '45511', '2025-04-04 01:14:44', '2025-04-04 18:14:45', '2025-04-04 18:14:45', NULL),
(44, 2, '11503', '2025-04-04 01:14:52', '2025-04-04 18:14:52', '2025-04-04 18:14:52', NULL),
(45, 2, '96161', '2025-04-04 01:15:29', '2025-04-04 18:15:30', '2025-04-04 18:15:30', NULL),
(46, 2, '72480', '2025-04-04 01:15:32', '2025-04-04 18:15:32', '2025-04-04 18:15:32', NULL),
(47, 12, '49310', '2025-04-04 03:33:05', '2025-04-04 20:33:05', '2025-04-04 20:33:05', NULL),
(48, 12, '26739', '2025-04-04 03:33:10', '2025-04-04 20:33:10', '2025-04-04 20:33:10', NULL),
(49, 13, '50471', '2025-04-04 03:55:55', '2025-04-04 20:55:55', '2025-04-04 20:55:55', NULL),
(50, 14, '47904', '2025-04-04 03:55:56', '2025-04-04 20:55:56', '2025-04-04 20:55:56', NULL),
(51, 14, '55680', '2025-04-04 03:56:05', '2025-04-04 20:56:05', '2025-04-04 20:56:05', NULL),
(52, 15, '85562', '2025-04-04 04:10:36', '2025-04-04 21:10:36', '2025-04-04 21:10:36', NULL),
(53, 16, '61591', '2025-04-04 04:10:36', '2025-04-04 21:10:36', '2025-04-04 21:10:36', NULL),
(54, 18, '47447', '2025-04-04 04:10:38', '2025-04-04 21:10:38', '2025-04-04 21:10:38', NULL),
(55, 17, '48938', '2025-04-04 04:10:38', '2025-04-04 21:10:38', '2025-04-04 21:10:38', NULL),
(56, 19, '13218', '2025-04-04 04:10:39', '2025-04-04 21:10:39', '2025-04-04 21:10:39', NULL),
(57, 20, '75952', '2025-04-04 04:14:04', '2025-04-04 21:14:04', '2025-04-04 21:14:04', NULL),
(58, 21, '98877', '2025-04-04 04:16:11', '2025-04-04 21:16:11', '2025-04-04 21:16:11', NULL),
(59, 22, '90833', '2025-04-07 01:28:02', '2025-04-07 06:28:02', '2025-04-07 06:28:02', NULL),
(60, 22, '93245', '2025-04-07 01:32:55', '2025-04-07 06:32:57', '2025-04-07 06:32:57', NULL),
(61, 23, '17422', '2025-04-07 01:10:05', '2025-04-07 18:10:05', '2025-04-07 18:10:05', NULL),
(62, 24, '15795', '2025-04-07 06:31:19', '2025-04-07 23:31:19', '2025-04-07 23:31:19', NULL),
(63, 25, '46895', '2025-04-07 11:45:31', '2025-04-08 04:45:31', '2025-04-08 04:45:31', NULL),
(64, 26, '91780', '2025-04-18 04:44:20', '2025-04-18 21:44:20', '2025-04-18 21:44:20', NULL),
(65, 27, '40917', '2025-04-28 02:18:42', '2025-04-28 19:18:42', '2025-04-28 19:18:42', NULL),
(66, 28, '88808', '2025-04-29 11:31:34', '2025-04-29 16:31:34', '2025-04-29 16:31:34', NULL),
(67, 29, '90926', '2025-04-29 04:11:25', '2025-04-29 21:11:25', '2025-04-29 21:11:25', NULL),
(68, 29, '47232', '2025-04-29 04:16:50', '2025-04-29 21:16:50', '2025-04-29 21:16:50', NULL),
(69, 30, '54308', '2025-04-29 04:20:46', '2025-04-29 21:20:46', '2025-04-29 21:20:46', NULL),
(70, 30, '62731', '2025-04-29 04:20:50', '2025-04-29 21:20:50', '2025-04-29 21:20:50', NULL),
(71, 30, '80548', '2025-04-29 04:25:08', '2025-04-29 21:25:08', '2025-04-29 21:25:08', NULL),
(72, 31, '55389', '2025-04-29 04:30:59', '2025-04-29 21:30:59', '2025-04-29 21:30:59', NULL),
(73, 32, '24067', '2025-04-30 08:11:12', '2025-05-01 01:11:12', '2025-05-01 01:11:12', NULL),
(74, 32, '72469', '2025-04-30 08:11:33', '2025-05-01 01:11:33', '2025-05-01 01:11:33', NULL),
(75, 33, '62670', '2025-04-30 08:27:40', '2025-05-01 01:27:40', '2025-05-01 01:27:40', NULL),
(76, 34, '22972', '2025-04-30 08:27:41', '2025-05-01 01:27:41', '2025-05-01 01:27:41', NULL),
(77, 34, '17453', '2025-04-30 08:28:11', '2025-05-01 01:28:11', '2025-05-01 01:28:11', NULL),
(78, 35, '23093', '2025-05-01 04:18:40', '2025-05-01 21:18:40', '2025-05-01 21:18:40', NULL),
(79, 36, '90059', '2025-05-01 05:44:00', '2025-05-01 22:44:00', '2025-05-01 22:44:00', NULL),
(80, 37, '55732', '2025-05-01 05:55:35', '2025-05-01 22:55:35', '2025-05-01 22:55:35', NULL),
(81, 38, '93413', '2025-05-01 05:55:37', '2025-05-01 22:55:37', '2025-05-01 22:55:37', NULL),
(82, 39, '56389', '2025-05-01 06:02:34', '2025-05-01 23:02:34', '2025-05-01 23:02:34', NULL),
(83, 40, '66812', '2025-05-01 06:21:37', '2025-05-01 23:21:37', '2025-05-01 23:21:37', NULL),
(84, 41, '27148', '2025-05-01 06:27:19', '2025-05-01 23:27:19', '2025-05-01 23:27:19', NULL),
(85, 42, '83579', '2025-05-01 06:33:40', '2025-05-01 23:33:40', '2025-05-01 23:33:40', NULL),
(86, 43, '76767', '2025-05-02 02:55:27', '2025-05-02 07:55:27', '2025-05-02 07:55:27', NULL),
(87, 43, '26120', '2025-05-02 02:57:22', '2025-05-02 07:57:22', '2025-05-02 07:57:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `verify_otps`
--

CREATE TABLE `verify_otps` (
  `id` bigint UNSIGNED NOT NULL,
  `otp` int NOT NULL,
  `validUpTo` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `agora_chats`
--
ALTER TABLE `agora_chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agora_chats_sender_id_foreign` (`sender_id`),
  ADD KEY `agora_chats_reciver_id_foreign` (`reciver_id`);

--
-- Indexes for table `agora_messages`
--
ALTER TABLE `agora_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agora_messages_reciver_id_foreign` (`reciver_id`),
  ADD KEY `agora_messages_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `agores`
--
ALTER TABLE `agores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agores_user_id_foreign` (`user_id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bids_user_id_foreign` (`user_id`),
  ADD KEY `bids_infulencer_id_foreign` (`infulencer_id`),
  ADD KEY `bids_stream_id_foreign` (`stream_id`);

--
-- Indexes for table `block_posts`
--
ALTER TABLE `block_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chattoken`
--
ALTER TABLE `chattoken`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `followers_user_id_foreign` (`user_id`),
  ADD KEY `followers_influencer_id_foreign` (`following_id`);

--
-- Indexes for table `influencer_id_verifications`
--
ALTER TABLE `influencer_id_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `influencer_id_verifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `influencer_socials`
--
ALTER TABLE `influencer_socials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `influencer_socials_user_id_foreign` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livestream_comments`
--
ALTER TABLE `livestream_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livestream_comments_user_id_foreign` (`user_id`),
  ADD KEY `livestream_comments_stream_id_foreign` (`stream_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_influencer_id_foreign` (`influencer_id`);

--
-- Indexes for table `notifies`
--
ALTER TABLE `notifies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifies_user_id_foreign` (`user_id`),
  ADD KEY `notifies_stream_id_foreign` (`stream_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_infulencer_id_foreign` (`influencer_id`);

--
-- Indexes for table `post_book_marks`
--
ALTER TABLE `post_book_marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_book_marks_user_id_foreign` (`user_id`),
  ADD KEY `post_book_marks_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_comments_user_id_foreign` (`user_id`),
  ADD KEY `post_comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_images_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_likes_user_id_foreign` (`user_id`),
  ADD KEY `post_likes_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_reports`
--
ALTER TABLE `post_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `private_videos`
--
ALTER TABLE `private_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `private_videos_user_id_foreign` (`user_id`),
  ADD KEY `private_videos_stream_id_foreign` (`stream_id`);

--
-- Indexes for table `refer_friends`
--
ALTER TABLE `refer_friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refer_friends_user_id_foreign` (`user_id`);

--
-- Indexes for table `reffered_infus`
--
ALTER TABLE `reffered_infus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reffered_infus_user_id_foreign` (`user_id`),
  ADD KEY `reffered_infus_refered_user_id_foreign` (`refered_user_id`);

--
-- Indexes for table `saved_banks`
--
ALTER TABLE `saved_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `save_cards`
--
ALTER TABLE `save_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `save_cards_user_id_foreign` (`user_id`);

--
-- Indexes for table `send_gifts`
--
ALTER TABLE `send_gifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `send_gifts_user_id_foreign` (`user_id`);

--
-- Indexes for table `stream_management`
--
ALTER TABLE `stream_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stream_management_user_id_foreign` (`influencer_id`);

--
-- Indexes for table `suggest_influencers`
--
ALTER TABLE `suggest_influencers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suggest_influencers_influencer_id_foreign` (`influencer_id`),
  ADD KEY `suggest_influencers_suggest_influencer_id_foreign` (`suggest_influencer_id`);

--
-- Indexes for table `term_conditions`
--
ALTER TABLE `term_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transections`
--
ALTER TABLE `transections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transections_user_id_foreign` (`user_id`),
  ADD KEY `transections_influencer_id_foreign` (`influencer_id`),
  ADD KEY `transections_stream_id_foreign` (`stream_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_otps`
--
ALTER TABLE `user_otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_otps_user_id_foreign` (`user_id`);

--
-- Indexes for table `verify_otps`
--
ALTER TABLE `verify_otps`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agora_chats`
--
ALTER TABLE `agora_chats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agora_messages`
--
ALTER TABLE `agora_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `agores`
--
ALTER TABLE `agores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `block_posts`
--
ALTER TABLE `block_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chattoken`
--
ALTER TABLE `chattoken`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `influencer_id_verifications`
--
ALTER TABLE `influencer_id_verifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `influencer_socials`
--
ALTER TABLE `influencer_socials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `livestream_comments`
--
ALTER TABLE `livestream_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `notifies`
--
ALTER TABLE `notifies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_book_marks`
--
ALTER TABLE `post_book_marks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post_reports`
--
ALTER TABLE `post_reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `private_videos`
--
ALTER TABLE `private_videos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refer_friends`
--
ALTER TABLE `refer_friends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reffered_infus`
--
ALTER TABLE `reffered_infus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saved_banks`
--
ALTER TABLE `saved_banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `save_cards`
--
ALTER TABLE `save_cards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `send_gifts`
--
ALTER TABLE `send_gifts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stream_management`
--
ALTER TABLE `stream_management`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `suggest_influencers`
--
ALTER TABLE `suggest_influencers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `term_conditions`
--
ALTER TABLE `term_conditions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transections`
--
ALTER TABLE `transections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_otps`
--
ALTER TABLE `user_otps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `verify_otps`
--
ALTER TABLE `verify_otps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agora_chats`
--
ALTER TABLE `agora_chats`
  ADD CONSTRAINT `agora_chats_reciver_id_foreign` FOREIGN KEY (`reciver_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `agora_chats_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `agora_messages`
--
ALTER TABLE `agora_messages`
  ADD CONSTRAINT `agora_messages_reciver_id_foreign` FOREIGN KEY (`reciver_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `agora_messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `agores`
--
ALTER TABLE `agores`
  ADD CONSTRAINT `agores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_influencer_id_foreign` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `followers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
