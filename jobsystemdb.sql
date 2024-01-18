-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2022 at 11:38 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobsystemdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_mail_campaign_detail`
--

CREATE TABLE `admin_mail_campaign_detail` (
  `id` int(11) NOT NULL,
  `admin_template_id` int(11) DEFAULT NULL,
  `admin_mail_config_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `receipt_status` tinyint(1) DEFAULT 0,
  `receipt_time` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_mail_campaign_detail`
--

INSERT INTO `admin_mail_campaign_detail` (`id`, `admin_template_id`, `admin_mail_config_id`, `user_id`, `user_email`, `receipt_status`, `receipt_time`, `created_at`, `created_by`) VALUES
(22, 8, 1, 2, 'vinhhofb@gmail.com', 1, 1651823195, 1651823192, 1),
(23, 8, 1, 3, 'test4@donga.edu.vn', 1, 1651823198, 1651823192, 1),
(24, 8, 1, 4, 'test3@gmail.com', 1, 1651823201, 1651823192, 1),
(25, 8, 1, 5, 'test2@donga.edu.vn', 1, 1651823204, 1651823192, 1),
(26, 7, 1, 4, 'test3@gmail.com', 1, 1651823638, 1651823635, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_mail_config`
--

CREATE TABLE `admin_mail_config` (
  `id` int(11) NOT NULL,
  `mail_drive` varchar(10) DEFAULT NULL,
  `mail_host` char(50) DEFAULT NULL,
  `mail_port` int(11) DEFAULT NULL,
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `mail_encryption` char(50) DEFAULT NULL,
  `total_send` int(11) DEFAULT 0,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_mail_config`
--

INSERT INTO `admin_mail_config` (`id`, `mail_drive`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `total_send`, `is_deleted`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, NULL, 'smtp.gmail.com', 587, 'yatchinvest@gmail.com', 'gbgdncosyqbwxrwt', 'tls', 0, 0, 1651818848, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_mail_template`
--

CREATE TABLE `admin_mail_template` (
  `id` int(11) NOT NULL,
  `template_title` varchar(250) DEFAULT NULL,
  `template_content` text DEFAULT NULL,
  `total_send` int(11) DEFAULT 0,
  `is_deleted` tinyint(1) DEFAULT 0,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `show_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_mail_template`
--

INSERT INTO `admin_mail_template` (`id`, `template_title`, `template_content`, `total_send`, `is_deleted`, `created_at`, `created_by`, `updated_at`, `updated_by`, `show_order`) VALUES
(1, 'Job announcement', '<p>Bạn vừa được giao một c&ocirc;ng việc mới, Truy cập <a href=\"https://jobmanagesystem.com/quan-ly-cong-viec\">https://jobmanagesystem.com/quan-ly-cong-viec</a> để biết th&ecirc;m th&ocirc;ng tin chi tiết</p>', 0, 0, NULL, NULL, 1651816875, 1, 0),
(2, 'Change job content', '<p>Content c&ocirc;ng việc của bạn đ&atilde; bị thay đổi, vui l&ograve;ng truy cập <a href=\"/quan-ly-cong-viec\">http://jobmanagesystem.com/quan-ly-cong-viec</a> để See details</p>', 0, 0, 1651809950, NULL, 1651817773, 1, 0),
(7, 'Xin chào', '<p>Xin ch&agrave;o th&agrave;nh vi&ecirc;n mới</p>', 0, 1, 1651818933, NULL, 1651819095, 1, 0),
(8, 'Holiday', '<p>Holiday của c&ocirc;ng ty từ ng&agrave;y ...</p>\r\n<p>&nbsp;</p>', 0, 0, 1651818959, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `working_hour` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updater` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `user_id`, `month`, `working_hour`, `created`, `created_by`, `updated_at`, `updater`, `deleted`) VALUES
(1, 2, 5, 66, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name_position` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `luong_ngay` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updater` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name_position`, `note`, `luong_ngay`, `created_by`, `created`, `updated_at`, `updater`, `deleted`) VALUES
(1, 'Staff', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 'Manager', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(3, 'President', NULL, NULL, 1, 1651551254, NULL, NULL, 0),
(4, 'a', 'a', NULL, 1, 1651551130, 1651551132, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `specializes`
--

CREATE TABLE `specializes` (
  `id` int(11) NOT NULL,
  `name_specializes` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `updater` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specializes`
--

INSERT INTO `specializes` (`id`, `name_specializes`, `note`, `created_by`, `created`, `updater`, `updated_at`, `deleted`) VALUES
(1, 'Maketing', NULL, NULL, NULL, NULL, NULL, 0),
(2, 'Developer', NULL, 1, 1651552227, NULL, NULL, 0),
(3, 'a', 'a', 1, 1651552232, 1, 1651552234, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` bigint(20) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ch_messages`
--

INSERT INTO `ch_messages` (`id`, `type`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
(1683148461, 'user', 51, 45, 'xin ch&agrave;o', NULL, 0, '2022-03-25 23:59:40', '2022-03-25 23:59:40'),
(1744624539, 'user', 51, 50, 'ok', NULL, 1, '2022-03-26 00:35:57', '2022-03-26 00:35:57'),
(1825266546, 'user', 51, 50, 'xin ch&agrave;o', NULL, 1, '2022-03-26 00:30:38', '2022-03-26 00:30:38'),
(1839869590, 'user', 51, 45, 'alo', NULL, 0, '2022-03-26 00:00:21', '2022-03-26 00:00:21'),
(1853190854, 'user', 22, 23, 'alo', NULL, 1, '2022-04-16 00:23:50', '2022-04-16 00:23:51'),
(1968774321, 'user', 23, 22, 'ok', NULL, 1, '2022-04-16 00:23:03', '2022-04-16 00:23:04'),
(2003480658, 'user', 50, 51, 'ok', NULL, 1, '2022-03-25 23:27:22', '2022-03-25 23:27:23'),
(2037952703, 'user', 51, 45, 'ola', NULL, 0, '2022-03-25 23:59:14', '2022-03-25 23:59:14'),
(2039709704, 'user', 22, 23, 'ok', NULL, 1, '2022-04-16 00:23:23', '2022-04-16 00:23:24'),
(2192247998, 'user', 22, 23, 'ok', NULL, 1, '2022-04-16 00:24:48', '2022-04-16 00:24:48'),
(2198412295, 'user', 51, 50, 'alo', NULL, 1, '2022-03-25 23:27:09', '2022-03-25 23:27:14'),
(2233956062, 'user', 51, 45, '', '{\"new_name\":\"14c5d18c-95dd-40a6-8c87-18af6e370242.jpg\",\"old_name\":\"2.jpg\"}', 0, '2022-03-26 00:01:23', '2022-03-26 00:01:23'),
(2317585526, 'user', 51, 45, 'ok', NULL, 0, '2022-03-25 23:59:21', '2022-03-25 23:59:21'),
(2326314486, 'user', 22, 23, 'alo', NULL, 1, '2022-04-16 00:21:51', '2022-04-16 00:23:01'),
(2337647559, 'user', 51, 50, 'd', NULL, 1, '2022-03-26 00:04:46', '2022-03-26 00:04:47'),
(2387483355, 'user', 51, 44, 'ola', NULL, 0, '2022-03-25 23:38:55', '2022-03-25 23:38:55'),
(2428343823, 'user', 53, 43, 'alo', NULL, 0, '2022-03-25 22:56:38', '2022-03-25 22:56:38'),
(2495660778, 'user', 51, 43, 'alo', NULL, 0, '2022-03-25 23:22:01', '2022-03-25 23:22:01'),
(2523541020, 'user', 22, 23, '123', NULL, 1, '2022-04-16 00:23:38', '2022-04-16 00:23:39'),
(2541163544, 'user', 51, 45, 'alo', NULL, 0, '2022-03-25 23:58:50', '2022-03-25 23:58:50'),
(2561103900, 'user', 51, 50, 'alo', NULL, 1, '2022-03-26 00:02:38', '2022-03-26 00:02:44'),
(2581421728, 'user', 51, 44, 'alo', NULL, 0, '2022-03-25 23:34:40', '2022-03-25 23:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `work_name` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updater` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `user_id`, `work_name`, `note`, `from`, `to`, `status`, `created`, `created_by`, `updated_at`, `updater`, `deleted`) VALUES
(1, 2, 'Make an ad campaign', 'Make an ad campaign', 1651806819, 1651806825, 0, NULL, NULL, 1651817995, 1, 0),
(2, 3, 'Design products to send to customers', 'Design products to send to customers', 1651806819, 1651806825, 0, NULL, NULL, NULL, NULL, 0),
(3, 2, 'fd', 'df', 1651795200, 1652486400, 0, 1651816794, 1, 1651817146, 1, 1),
(4, 4, 'Plan Sale in June', 'Plan Sale in June', 1651795200, 1652486400, 0, 1651816968, 1, 1651817124, 1, 1),
(5, 4, 'Plan Sale in June', 'Plan Sale in June', 1651795200, 1652486400, 0, 1651817031, 1, NULL, NULL, 0),
(6, 5, 'sửa2', 'sửa', 1651881600, 1653091200, 0, 1651817207, 1, 1651817923, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, '83ffdc28-d587-4b10-835f-4ed32fe16b80', 'database', 'default', '{\"uuid\":\"83ffdc28-d587-4b10-835f-4ed32fe16b80\",\"displayName\":\"App\\\\Jobs\\\\SendEmailCampaignNow\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailCampaignNow\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendEmailCampaignNow\\\":11:{s:5:\\\"\\u0000*\\u0000id\\\";i:1;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Error: Class \'App\\Jobs\\BD\' not found in C:\\xampp\\htdocs\\JobManageSystem\\app\\Jobs\\SendEmailCampaignNow.php:39\nStack trace:\n#0 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\SendEmailCampaignNow->handle()\n#1 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#2 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#3 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#4 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#5 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#6 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendEmailCampaignNow))\n#7 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendEmailCampaignNow))\n#8 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#9 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendEmailCampaignNow), false)\n#10 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendEmailCampaignNow))\n#11 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendEmailCampaignNow))\n#12 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#13 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendEmailCampaignNow))\n#14 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#15 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#16 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#17 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#18 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#19 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#20 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#21 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#22 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#23 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#24 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#25 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#26 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\symfony\\console\\Command\\Command.php(298): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#27 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#28 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\symfony\\console\\Application.php(1015): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#29 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\symfony\\console\\Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#30 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(94): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 C:\\xampp\\htdocs\\JobManageSystem\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 {main}', '2022-05-06 00:23:00'),
(2, 'b40c0fb3-b8fa-420f-ae6b-e45b49b7321e', 'database', 'default', '{\"uuid\":\"b40c0fb3-b8fa-420f-ae6b-e45b49b7321e\",\"displayName\":\"App\\\\Jobs\\\\SendEmailCampaignNow\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailCampaignNow\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendEmailCampaignNow\\\":11:{s:5:\\\"\\u0000*\\u0000id\\\";i:1;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Error: Class \'App\\Jobs\\BD\' not found in C:\\xampp\\htdocs\\JobManageSystem\\app\\Jobs\\SendEmailCampaignNow.php:39\nStack trace:\n#0 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\SendEmailCampaignNow->handle()\n#1 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#2 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#3 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#4 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#5 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#6 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendEmailCampaignNow))\n#7 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendEmailCampaignNow))\n#8 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#9 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendEmailCampaignNow), false)\n#10 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendEmailCampaignNow))\n#11 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendEmailCampaignNow))\n#12 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#13 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendEmailCampaignNow))\n#14 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#15 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#16 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#17 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#18 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#19 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#20 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#21 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#22 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#23 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#24 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#25 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#26 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\symfony\\console\\Command\\Command.php(298): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#27 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#28 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\symfony\\console\\Application.php(1015): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#29 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\symfony\\console\\Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#30 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(94): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 C:\\xampp\\htdocs\\JobManageSystem\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 {main}', '2022-05-06 00:23:33'),
(3, '099f6371-0ef6-46b2-9961-bfc79dd54e3c', 'database', 'default', '{\"uuid\":\"099f6371-0ef6-46b2-9961-bfc79dd54e3c\",\"displayName\":\"App\\\\Jobs\\\\SendEmailCampaignNow\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEmailCampaignNow\",\"command\":\"O:29:\\\"App\\\\Jobs\\\\SendEmailCampaignNow\\\":11:{s:5:\\\"\\u0000*\\u0000id\\\";i:1;s:3:\\\"job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Error: Class \'App\\Jobs\\BD\' not found in C:\\xampp\\htdocs\\JobManageSystem\\app\\Jobs\\SendEmailCampaignNow.php:39\nStack trace:\n#0 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): App\\Jobs\\SendEmailCampaignNow->handle()\n#1 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#2 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#3 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#4 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#5 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(128): Illuminate\\Container\\Container->call(Array)\n#6 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Bus\\Dispatcher->Illuminate\\Bus\\{closure}(Object(App\\Jobs\\SendEmailCampaignNow))\n#7 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendEmailCampaignNow))\n#8 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Bus\\Dispatcher.php(132): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#9 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(120): Illuminate\\Bus\\Dispatcher->dispatchNow(Object(App\\Jobs\\SendEmailCampaignNow), false)\n#10 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(128): Illuminate\\Queue\\CallQueuedHandler->Illuminate\\Queue\\{closure}(Object(App\\Jobs\\SendEmailCampaignNow))\n#11 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php(103): Illuminate\\Pipeline\\Pipeline->Illuminate\\Pipeline\\{closure}(Object(App\\Jobs\\SendEmailCampaignNow))\n#12 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(122): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))\n#13 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(70): Illuminate\\Queue\\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(App\\Jobs\\SendEmailCampaignNow))\n#14 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(98): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#15 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(428): Illuminate\\Queue\\Jobs\\Job->fire()\n#16 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(378): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#17 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(172): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#18 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(117): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#19 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(101): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#20 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#21 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(40): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#22 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#23 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(37): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#24 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(653): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#25 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(136): Illuminate\\Container\\Container->call(Array)\n#26 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\symfony\\console\\Command\\Command.php(298): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#27 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(121): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#28 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\symfony\\console\\Application.php(1015): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#29 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\symfony\\console\\Application.php(299): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#30 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\symfony\\console\\Application.php(171): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#31 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php(94): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#32 C:\\xampp\\htdocs\\JobManageSystem\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(129): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#33 C:\\xampp\\htdocs\\JobManageSystem\\artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#34 {main}', '2022-05-06 00:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discipline_rewards`
--

CREATE TABLE `discipline_rewards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updater` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discipline_rewards`
--

INSERT INTO `discipline_rewards` (`id`, `user_id`, `note`, `value`, `type`, `created`, `created_by`, `updated_at`, `updater`, `deleted`) VALUES
(1, 2, 'Bonus abc', 500000, 0, NULL, NULL, 1651804937, 1, 1),
(2, 3, 'Làm việc năng suất', 700000, 0, NULL, NULL, 1651804506, 1, 1),
(3, 3, 'Sử dụng điện thoại trong giờ làm việc', 100000, 1, NULL, NULL, 1651804961, 1, 1),
(4, 4, 'Làm việc riêng trong giờ làm việc', 100000, 1, NULL, NULL, 1651817038, 1, 1),
(5, 2, 'test', 20, 0, 1651803932, 1, 1651804502, 1, 1),
(6, 4, 'Bonus sales', 100000, 0, 1651803946, 1, 1651805180, 1, 0),
(7, 3, 'Thưởng ngày', 400000, 0, 1651804878, 1, 1651805170, 1, 0),
(8, 3, 'Thưởng tiền ốm', 300000, 0, 1651804968, 1, 1651805157, 1, 0),
(9, 2, 'Bonus sales', 200000, 0, 1651805037, 1, 1651805141, 1, 0),
(10, 2, 'Late to work', 100000, 1, 1651805122, 1, NULL, NULL, 0),
(11, 5, 'kehn thưởng', 50000, 0, 1651901703, 1, NULL, NULL, 0),
(12, 5, 'Đi làm muônk', 100000, 1, 1651901975, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_type`
--

CREATE TABLE `employee_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updater` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_type`
--

INSERT INTO `employee_type` (`id`, `name`, `note`, `created`, `created_by`, `updated_at`, `updater`, `deleted`) VALUES
(1, 'Official staff', NULL, NULL, NULL, NULL, NULL, 0),
(2, 'Part-time employee', NULL, NULL, NULL, NULL, NULL, 0),
(3, 'other', 'other', 1651556419, 1, 1651556423, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `hourly_salary` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updater` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `user_id`, `hourly_salary`, `created`, `created_by`, `updated_at`, `updater`) VALUES
(1, 2, 15, NULL, NULL, NULL, NULL),
(2, 3, 20, NULL, NULL, 1651558372, 1),
(4, 4, 23, 1651558453, 1, 1651558464, 1),
(5, 5, 15, 1651558459, 1, NULL, NULL),
(6, 6, 20, 1652077289, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_17_143645_create_shop_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updater` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `note`, `created`, `created_by`, `updated_at`, `updater`, `deleted`) VALUES
(1, 'Maketing', NULL, NULL, NULL, NULL, NULL, 0),
(2, 'd', NULL, 1651549379, 1, 1651550044, 1, 1),
(3, 'Sell', NULL, 1651550451, 1, NULL, NULL, 0),
(4, 'Train', NULL, 1651550446, 1, NULL, NULL, 0),
(5, 'ok', NULL, 1651549885, 1, 1651550164, 1, 1),
(6, 'Accountant', NULL, 1651921147, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_infomations`
--

CREATE TABLE `user_infomations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `nick_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `date_of_birth` int(11) DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `marital_status` int(11) DEFAULT NULL,
  `id_number` int(11) DEFAULT NULL,
  `date_range` int(11) DEFAULT NULL,
  `passport_issuer` varchar(255) DEFAULT NULL,
  `hometown` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `nation` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `permanent_residence` varchar(255) DEFAULT NULL,
  `staying` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `employee_type` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `specializes` int(11) DEFAULT NULL,
  `rooms` int(11) DEFAULT NULL,
  `positions` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_infomations`
--

INSERT INTO `user_infomations` (`id`, `user_id`, `full_name`, `nick_name`, `email`, `sex`, `date_of_birth`, `place_of_birth`, `marital_status`, `id_number`, `date_range`, `passport_issuer`, `hometown`, `nationality`, `nation`, `religion`, `permanent_residence`, `staying`, `image`, `employee_type`, `level`, `specializes`, `rooms`, `positions`, `status`, `is_deleted`) VALUES
(1, 1, NULL, NULL, 'admin2@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 2, 'Heson Jobs', 'A', 'vinhhofb@gmail.com', 0, 1651410947, '199 Bayport St.
Powell, TN 37849', 0, 201783899, 1651410947, 'Công an Đà Nẵng', 'Đà Nẵng', 'Việt Nam', 'Kinh', 'No', 'Đà Nẵng', 'Đà Nẵng', '1.jpg', 1, 1, 1, 1, 1, 1, 1),
(3, 3, 'Leigh Bradley', 'B', 'test4@donga.edu.vn', 0, 1651410947, '199 Bayport St.
Powell, TN 37849', 0, 201783890, 1651410947, 'Công an Đà Nẵng', 'Đà Nẵng', 'Việt Nam', 'Kinh', 'No', 'Đà Nẵng', 'Đà Nẵng', '2.jpg', 1, 1, 1, 1, 1, 1, 0),
(4, 4, 'Beth Jackson', 'hg', 'test3@gmail.com', 0, 1653436800, 'fd', 0, 555555555, 1652832000, 'dfdf', 'fd', 'fd', 'fd', 'fd', 'fd', 'fd', '1139285069.PNG', 1, 1, 1, 1, 2, 1, 0),
(5, 5, 'Salvador Cortez', 'c', 'test2@donga.edu.vn', 0, 1652832000, '127 Glen Creek St.
Brandon, FL 33510', 0, 203774747, 1652313600, 'df', 'g', 'hg', 'gh', 'gh', 'hg', 'hg', '114466771.PNG', 2, 10, 1, 1, 1, 1, 0),
(6, 6, 'Jordan Summers', 'abc', 'test@gmail.com', 0, 1652140800, 'da', 1, 234438934, 1652832000, 'dg', 'ffg', 'fgfg', 'fggf', 'fgfg', 'fggf', 'fgfg', '1317775699.jpg', 1, 8, 2, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `work_progress`
--

CREATE TABLE `work_progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `works` int(11) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_progress`
--

INSERT INTO `work_progress` (`id`, `user_id`, `works`, `content`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 2, 1, 'Lên ý tưởng', 1651886716, NULL, NULL, NULL),
(2, 2, 1, 'Triển khai ý tưởng bước 1', 1651886716, NULL, NULL, NULL),
(3, 5, 6, 'ok', 1651901437, 5, NULL, NULL),
(4, 5, 6, 'Bắt đầu dự án', 1651901455, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `qualification_name` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updater` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `qualification_name`, `note`, `created`, `created_by`, `updated_at`, `updater`, `deleted`) VALUES
(1, 'No', NULL, NULL, NULL, NULL, NULL, 0),
(2, '5', NULL, NULL, NULL, NULL, NULL, 0),
(3, '9', NULL, NULL, NULL, NULL, NULL, 0),
(4, '12', NULL, NULL, NULL, NULL, NULL, 0),
(5, 'Apprentice', NULL, NULL, NULL, NULL, NULL, 0),
(6, 'Intermediate', NULL, NULL, NULL, NULL, NULL, 0),
(7, 'College', NULL, NULL, NULL, NULL, NULL, 0),
(8, 'University', NULL, NULL, NULL, NULL, NULL, 0),
(9, 'Master', NULL, NULL, NULL, NULL, NULL, 0),
(10, 'Doctor', NULL, NULL, NULL, NULL, NULL, 0),
(11, 's2', 's2', 1651551758, 1, 1651551797, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `password`, `role`, `active`, `remember_token`, `email_verified_at`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'admin', '0905663823', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, 'aetXAO9uSALHmxmNNaJNTCIpJ9EC1hyc2NH8ImgJuGsFkhaH9fjvMdz23Ytf', NULL, 2147483647, 2147483647, 0),
(2, NULL, '0123467890', 'd41d8cd98f00b204e9800998ecf8427e', 2, 1, NULL, NULL, 2147483647, 2147483647, 1),
(3, NULL, '012345678', NULL, 2, 0, NULL, NULL, NULL, 1651474709, 0),
(4, 'Beth Jackson', '5555555555', 'e10adc3949ba59abbe56e057f20f883e', 2, 1, 'fDuVVwwwOKQybuXkE9mt6MiylTPCsL2e9zpN8VvF0KZ1xLmboKlR78ykgntb', NULL, 1651473836, 1651547671, 0),
(5, NULL, '0799438886', 'ae962180c6b8ee5dfe2e1a50ed4a5384', 2, 1, 'RKFt333AzlI7k8qe6am7RIP2eFQMDyMJbEUJBbl3Joet8TY0hXbXc2wZuMqF', NULL, 1651547114, NULL, 0),
(6, 'Jordan Summers', '0123456788', 'ae962180c6b8ee5dfe2e1a50ed4a5384', 2, 1, 'U0U3odR5fUjImQjAOj5mUVhyVK2XyukL6QzrjCpqntYYenDEhoLwkJ7Zw09N', NULL, 1652075471, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_face`
--

CREATE TABLE `user_face` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_face`
--

INSERT INTO `user_face` (`id`, `name`, `image`, `order_by`, `user_id`, `created_at`, `updated_at`) VALUES
(75, 'Beth Jackson', '1.jpg', 1, 4, 1652077615, NULL),
(76, 'Beth Jackson', '2.jpg', 2, 4, 1652077622, NULL),
(77, 'Beth Jackson', '3.jpg', 3, 4, 1652077629, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_track`
--

CREATE TABLE `user_track` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT 0,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_track`
--

INSERT INTO `user_track` (`id`, `user_id`, `type`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(11, 5, 0, 1651912895, NULL, NULL, NULL),
(12, 5, 1, 1651912987, NULL, NULL, NULL),
(13, 5, 0, 1651915417, NULL, NULL, NULL),
(14, 5, 1, 1651915451, NULL, NULL, NULL),
(21, 4, 0, 1652077776, NULL, NULL, NULL),
(22, 4, 1, 1652077808, NULL, NULL, NULL),
(23, 4, 0, 1652077837, NULL, NULL, NULL),
(24, 4, 1, 1652077875, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_mail_campaign_detail`
--
ALTER TABLE `admin_mail_campaign_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_mail_config`
--
ALTER TABLE `admin_mail_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_mail_template`
--
ALTER TABLE `admin_mail_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specializes`
--
ALTER TABLE `specializes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `discipline_rewards`
--
ALTER TABLE `discipline_rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_type`
--
ALTER TABLE `employee_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_infomations`
--
ALTER TABLE `user_infomations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_progress`
--
ALTER TABLE `work_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_face`
--
ALTER TABLE `user_face`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_track`
--
ALTER TABLE `user_track`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_mail_campaign_detail`
--
ALTER TABLE `admin_mail_campaign_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `admin_mail_config`
--
ALTER TABLE `admin_mail_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_mail_template`
--
ALTER TABLE `admin_mail_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `specializes`
--
ALTER TABLE `specializes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `discipline_rewards`
--
ALTER TABLE `discipline_rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee_type`
--
ALTER TABLE `employee_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_infomations`
--
ALTER TABLE `user_infomations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `work_progress`
--
ALTER TABLE `work_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_face`
--
ALTER TABLE `user_face`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `user_track`
--
ALTER TABLE `user_track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
