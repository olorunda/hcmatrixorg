-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2017 at 06:00 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hcmmatrix`
--

-- --------------------------------------------------------

--
-- Table structure for table `absencerequests`
--

CREATE TABLE `absencerequests` (
  `id` int(10) UNSIGNED NOT NULL,
  `absencetypes_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `lm_approve` int(11) NOT NULL,
  `admin_approve` int(11) NOT NULL,
  `board_approve` int(11) NOT NULL,
  `lm_comments` text COLLATE utf8_unicode_ci,
  `admin_comments` text COLLATE utf8_unicode_ci,
  `board_comments` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `priority` int(1) NOT NULL,
  `file` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pay` int(2) NOT NULL,
  `expected_end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `absencerequests`
--

INSERT INTO `absencerequests` (`id`, `absencetypes_id`, `emp_id`, `startdate`, `enddate`, `reason`, `lm_approve`, `admin_approve`, `board_approve`, `lm_comments`, `admin_comments`, `board_comments`, `status`, `priority`, `file`, `pay`, `expected_end`, `created_at`, `updated_at`) VALUES
(22, 4, 3, '2017-01-10', '2017-01-31', 'jhkhjhjh', 0, 1, 0, NULL, 'vnvrdfefehfe', NULL, 1, 1, '', 1, '2017-01-31', '2017-01-12 08:49:26', '2017-01-12 09:43:27'),
(19, 1, 2, '2016-12-01', '2016-12-31', 'xscdwsvdwghdvw', 0, 2, 0, NULL, '', NULL, 2, 1, '', 1, '2017-01-11', '2016-12-11 15:11:13', '2016-12-11 15:18:12'),
(20, 4, 1, '2017-01-19', '2017-01-26', 'jnm', 0, 2, 0, NULL, '', NULL, 2, 1, '', 1, '2017-01-26', '2017-01-12 08:41:40', '2017-03-03 16:19:51'),
(21, 6, 3, '2017-01-27', '2017-01-31', 'jmjm', 0, 1, 0, NULL, 'ssfefefefe', NULL, 1, 1, '', 1, '2017-01-31', '2017-01-12 08:44:37', '2017-01-12 10:00:40'),
(23, 6, 3, '2017-01-27', '2017-01-31', 'jmjm', 0, 1, 0, NULL, 'ssfefefefe', NULL, 1, 1, '', 1, '2017-01-31', '2017-01-12 08:44:37', '2017-01-12 10:00:40'),
(18, 1, 2, '2016-12-06', '2016-12-31', 'cdfjkdfegku', 1, 0, 0, NULL, NULL, NULL, 0, 1, '', 1, '2017-01-11', '2016-12-11 15:04:30', '2016-12-11 15:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `absencesettings`
--

CREATE TABLE `absencesettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` int(1) NOT NULL,
  `day_num` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `absencesettings`
--

INSERT INTO `absencesettings` (`id`, `role`, `day_num`, `created_at`, `updated_at`) VALUES
(1, 2, 50, '2017-11-16 13:50:00', '2017-01-09 04:17:47'),
(2, 3, 100, '2017-11-16 13:50:00', '2016-11-16 13:50:00'),
(3, 1, 25, '2017-11-16 13:50:00', '2017-01-09 04:17:34'),
(4, 4, 12, '2017-01-09 04:19:08', '2017-01-09 04:19:08');

-- --------------------------------------------------------

--
-- Table structure for table `absencetypes`
--

CREATE TABLE `absencetypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `days` int(11) NOT NULL,
  `cat` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `absencetypes`
--

INSERT INTO `absencetypes` (`id`, `name`, `days`, `cat`, `created_at`, `updated_at`) VALUES
(1, 'Casual Leave', 13, '0', '2016-11-15 11:26:18', '2016-12-15 09:25:53'),
(2, 'Maternity', 11, '0', '2016-12-15 09:40:44', '2016-12-15 09:42:24'),
(4, 'Perternty', 4, '0', '2016-12-15 11:53:09', '2016-12-15 11:53:09'),
(5, 'Compassionate', 20, '0', '2016-12-15 11:53:41', '2016-12-15 11:53:41'),
(6, 'Study', 30, '0', '2016-12-15 11:54:02', '2016-12-15 11:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `allowance_deduction`
--

CREATE TABLE `allowance_deduction` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_allowance` tinyint(1) NOT NULL COMMENT '1 for allowance, 0 for deduction',
  `job_role` int(11) NOT NULL COMMENT '1 - Employee, 2 - People Manager, 3 - Admin, 4 - Doctor',
  `charge_percentage` double DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `is_formula` tinyint(1) NOT NULL DEFAULT '0',
  `charge_formula` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowance_deduction`
--

INSERT INTO `allowance_deduction` (`id`, `name`, `is_allowance`, `job_role`, `charge_percentage`, `status`, `created_by`, `created_date`, `is_formula`, `charge_formula`) VALUES
(1, 'Housing Allowance', 1, 1, 30, 1, 6, '2017-02-09 11:53:00', 1, '[[basic_pay]]*(3/4)'),
(2, 'Transport Allowance', 1, 1, 15, 1, 6, '2017-02-09 11:54:46', 1, '[[basic_pay]]*(15/40)'),
(3, 'Utility Allowance', 1, 1, 15, 1, 6, '2017-02-09 11:55:31', 1, '[[basic_pay]]*(15/40)'),
(4, 'Pension Fund', 0, 1, 0, 1, 6, '2017-02-09 11:57:22', 1, '([[basic_pay]]+[[housing_allowance]]+[[transport_allowance]])*(8/100)'),
(5, 'N.H. Fund', 0, 1, 0, 1, 6, '2017-02-09 11:58:30', 1, '[[basic_pay]]*(2.5/100)'),
(6, 'NSITF', 0, 1, 0, 1, 6, '2017-02-09 11:59:33', 1, '[[gross_salary]]*.01'),
(7, 'Housing Allowance', 1, 2, 30, 1, 6, '2017-02-09 11:53:00', 1, '[[basic_pay]]*(3/4)'),
(8, 'Transport Allowance', 1, 2, 15, 1, 6, '2017-02-09 11:54:46', 1, '[[basic_pay]]*(15/40)'),
(9, 'Utility Allowance', 1, 2, 15, 1, 6, '2017-02-09 11:55:31', 1, '[[basic_pay]]*(15/40)'),
(10, 'Pension Fund', 0, 2, 0, 1, 6, '2017-02-09 11:57:22', 1, '([[basic_pay]]+[[housing_allowance]]+[[transport_allowance]])*(8/100)'),
(11, 'N.H. Fund', 0, 2, 0, 1, 6, '2017-02-09 11:58:30', 1, '[[basic_pay]]*(2.5/100)'),
(12, 'NSITF', 0, 2, 0, 1, 6, '2017-02-09 11:59:33', 1, '[[gross_salary]]*.01'),
(13, 'Housing Allowance', 1, 3, 30, 1, 6, '2017-02-09 11:53:00', 1, '[[basic_pay]]*(3/4)'),
(14, 'Transport Allowance', 1, 3, 15, 1, 6, '2017-02-09 11:54:46', 1, '[[basic_pay]]*(15/40)'),
(15, 'Utility Allowance', 1, 3, 15, 1, 6, '2017-02-09 11:55:31', 1, '[[basic_pay]]*(15/40)'),
(16, 'Pension Fund', 0, 3, 0, 1, 6, '2017-02-09 11:57:22', 1, '([[basic_pay]]+[[housing_allowance]]+[[transport_allowance]])*(8/100)'),
(17, 'N.H. Fund', 0, 3, 0, 1, 6, '2017-02-09 11:58:30', 1, '[[basic_pay]]*(2.5/100)'),
(18, 'NSITF', 0, 3, 0, 1, 6, '2017-02-09 11:59:33', 1, '[[gross_salary]]*.01'),
(19, 'Housing Allowance', 1, 4, 30, 1, 6, '2017-02-09 11:53:00', 1, '[[basic_pay]]*(3/4)'),
(20, 'Transport Allowance', 1, 4, 15, 1, 6, '2017-02-09 11:54:46', 1, '[[basic_pay]]*(15/40)'),
(21, 'Utility Allowance', 1, 4, 15, 1, 6, '2017-02-09 11:55:31', 1, '[[basic_pay]]*(15/40)'),
(22, 'Pension Fund', 0, 4, 0, 1, 6, '2017-02-09 11:57:22', 1, '([[basic_pay]]+[[housing_allowance]]+[[transport_allowance]])*(8/100)'),
(23, 'N.H. Fund', 0, 4, 0, 1, 6, '2017-02-09 11:58:30', 1, '[[basic_pay]]*(2.5/100)'),
(24, 'NSITF', 0, 4, 0, 1, 6, '2017-02-09 11:59:33', 1, '[[gross_salary]]*.01'),
(25, 'Housing Allowance', 1, 5, 30, 1, 6, '2017-02-09 11:53:00', 1, '[[basic_pay]]*(3/4)'),
(26, 'Transport Allowance', 1, 5, 15, 1, 6, '2017-02-09 11:54:46', 1, '[[basic_pay]]*(15/40)'),
(27, 'Utility Allowance', 1, 5, 15, 1, 6, '2017-02-09 11:55:31', 1, '[[basic_pay]]*(15/40)'),
(28, 'Pension Fund', 0, 5, 0, 1, 6, '2017-02-09 11:57:22', 1, '([[basic_pay]]+[[housing_allowance]]+[[transport_allowance]])*(8/100)'),
(29, 'N.H. Fund', 0, 5, 0, 1, 6, '2017-02-09 11:58:30', 1, '[[basic_pay]]*(2.5/100)'),
(30, 'NSITF', 0, 5, 0, 1, 6, '2017-02-09 11:59:33', 1, '[[gross_salary]]*.01'),
(31, 'Test', 0, 1, 0, 1, 6, '2017-02-17 09:10:32', 1, '[[housing_allowance]]*.05'),
(32, 'Test2', 1, 1, 15, 1, 6, '2017-02-17 09:12:32', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `allowance_deduction_09-02`
--

CREATE TABLE `allowance_deduction_09-02` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_allowance` tinyint(1) NOT NULL COMMENT '1 for allowance, 0 for deduction',
  `job_role` int(11) NOT NULL COMMENT '1 - Employee, 2 - People Manager, 3 - Admin, 4 - Doctor',
  `charge_percentage` double DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `is_formula` tinyint(1) NOT NULL DEFAULT '0',
  `charge_formula` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowance_deduction_09-02`
--

INSERT INTO `allowance_deduction_09-02` (`id`, `name`, `is_allowance`, `job_role`, `charge_percentage`, `status`, `created_by`, `created_date`, `is_formula`, `charge_formula`) VALUES
(2, 'Food allowance', 0, 1, 5, 1, 6, '2016-12-26 07:23:51', 0, NULL),
(4, 'Tet31', 1, 1, 12, 1, 6, '2016-12-31 10:20:01', 0, NULL),
(5, 'Pension Funds', 0, 1, 7.75, 1, 6, '2017-01-03 11:07:21', 0, NULL),
(6, 'Housing Funds', 0, 1, 3, 1, 6, '2017-01-03 11:09:11', 0, NULL),
(7, 'Meal Allowance', 1, 1, 2, 1, 6, '2017-01-03 11:19:24', 0, NULL),
(8, 'Test1', 1, 1, 5, 1, 6, '2017-01-07 04:33:13', 0, NULL),
(9, 'test2', 0, 1, 1, 1, 6, '2017-01-07 05:10:51', 0, NULL),
(10, 'Goodday', 1, 4, 5, 1, 6, '2017-01-07 07:04:31', 0, NULL),
(11, '50-50', 1, 4, 2, 1, 6, '2017-01-07 07:04:50', 0, NULL),
(12, 'karkjack', 1, 4, 3, 1, 6, '2017-01-07 07:05:04', 0, NULL),
(13, 'britannia', 0, 4, 2.5, 1, 6, '2017-01-07 07:05:36', 0, NULL),
(14, 'Final.Test1', 1, 4, 4, 1, 6, '2017-01-07 10:05:35', 0, NULL),
(15, 'Final.Test2', 0, 4, 1, 1, 6, '2017-01-07 10:06:23', 0, NULL),
(16, 'Final.T1', 1, 1, 10, 0, 6, '2017-01-07 10:50:17', 0, NULL),
(17, 'Final.T2', 0, 1, 5, 1, 6, '2017-01-07 10:50:33', 0, NULL),
(18, 'Final.T3', 1, 2, 15, 1, 6, '2017-01-07 10:53:00', 0, NULL),
(19, 'Final.T4', 0, 2, 7, 1, 6, '2017-01-07 10:53:18', 0, NULL),
(20, 't1', 1, 1, 2, 1, 6, '2017-01-07 11:10:25', 0, NULL),
(21, 't2', 0, 1, 4, 1, 6, '2017-01-07 11:10:48', 0, NULL),
(22, 'Mass', 1, 5, 2, 1, 6, '2017-01-10 09:37:18', 0, NULL),
(23, 'Pension Funds', 0, 1, 8, 1, 6, '2017-01-30 13:50:23', 0, NULL),
(24, 'Pension Fund', 0, 1, 0, 1, 6, '2017-02-09 10:17:11', 1, '([[basic_pay]]+[[housing_allowance]]+[[transport_allowance]])*8%');

-- --------------------------------------------------------

--
-- Table structure for table `applicantanswers`
--

CREATE TABLE `applicantanswers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `selectedoption` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `job_id` int(8) NOT NULL DEFAULT '0',
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `clockout_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `clockout_time`, `created_at`, `updated_at`, `status`) VALUES
(62, 101, NULL, '2017-03-02 11:18:38', '2017-03-02 11:18:38', NULL),
(61, 1, NULL, '2017-01-30 07:19:47', '2017-01-30 06:29:58', 'Late'),
(58, 104, NULL, '2017-01-27 10:59:36', '2017-01-27 10:01:01', 'Late'),
(57, 107, NULL, '2017-01-27 10:59:29', '2017-01-27 10:01:01', 'Late');

-- --------------------------------------------------------

--
-- Table structure for table `available_jobs`
--

CREATE TABLE `available_jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `job_desc` text NOT NULL,
  `required_exp` text,
  `job_ref` varchar(20) NOT NULL,
  `min_sal` int(11) NOT NULL,
  `max_sal` int(11) NOT NULL,
  `min_exp` int(11) NOT NULL,
  `max_exp` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `spec_id` int(11) NOT NULL,
  `qualification` text NOT NULL,
  `date_expire` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `taketest` int(1) NOT NULL DEFAULT '0',
  `otherskill` text NOT NULL,
  `dept_id` int(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `available_jobs`
--

INSERT INTO `available_jobs` (`id`, `title`, `job_desc`, `required_exp`, `job_ref`, `min_sal`, `max_sal`, `min_exp`, `max_exp`, `level_id`, `type_id`, `location_id`, `spec_id`, `qualification`, `date_expire`, `created_at`, `updated_at`, `taketest`, `otherskill`, `dept_id`) VALUES
(1, 'Systems Architect', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sit amet interdum dolor, at scelerisque eros. Donec commodo erat odio, ac congue magna lacinia vitae. Aenean malesuada justo nec libero mollis, vitae lobortis nunc fringilla. Duis at mauris porttitor, luctus velit vel, suscipit ligula. Fusce porta, magna in mollis elementum, diam urna luctus nisi, eget suscipit ipsum quam feugiat elit. Quisque et rhoncus turpis. Mauris mollis, tellus quis pellentesque ullamcorper, metus velit dignissim augue, et pretium lorem risus non dolor. Vivamus sit amet odio vel quam posuere aliquet ut vel neque. Curabitur vitae condimentum dui. Quisque in justo at ligula luctus volutpat at a lacus. In consectetur arcu sit amet tristique tempus.', 'In luctus semper libero et fringilla. Nullam facilisis volutpat augue, non volutpat magna pretium nec. Cras venenatis hendrerit orci, eget ultricies libero tincidunt at. Nulla porta tristique pellentesque. Aenean ultrices dui in tincidunt accumsan.\r\nIn luctus semper libero et fringilla. Nullam facilisis volutpat augue, non volutpat magna pretium nec. Cras venenatis hendrerit orci, eget ultricies libero tincidunt at. Nulla porta tristique pellentesque. Aenean ultrices dui in tincidunt accumsan.', 'ARCH::T001', 50000, 100000, 7, 12, 1, 2, 6, 1, 'Minimum of B.Sc. /HND or degree equivalent in Computer Science,Engineering or other related field of study.', '2017-11-27 12:58:55', '2016-11-27 12:58:55', '2016-11-27 12:58:55', 0, '', 0),
(2, 'edeje', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sit amet interdum dolor, at scelerisque eros. Donec commodo erat odio, ac congue magna lacinia vitae. Aenean malesuada justo nec libero mollis, vitae lobortis nunc fringilla. Duis at mauris porttitor, luctus velit vel, suscipit ligula. Fusce porta, magna in mollis elementum, diam urna luctus nisi, eget suscipit ipsum quam feugiat elit. Quisque et rhoncus turpis. Mauris mollis, tellus quis pellentesque ullamcorper, metus velit dignissim augue, et pretium lorem risus non dolor. Vivamus sit amet odio vel quam posuere aliquet ut vel neque. Curabitur vitae condimentum dui. Quisque in justo at ligula luctus volutpat at a lacus. In consectetur arcu sit amet tristique tempus.', 'ghggh', '44yy', 139621, 922979, 2, 18, 0, 0, 5, 28, 'ghgg', '2016-12-30 23:00:00', '2016-12-14 16:24:20', '2016-12-14 16:24:20', 1, 'ghghgh', 0),
(3, 'Application Developer 11', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sit amet interdum dolor, at scelerisque eros. Donec commodo erat odio, ac congue magna lacinia vitae. Aenean malesuada justo nec libero mollis, vitae lobortis nunc fringilla. Duis at mauris porttitor, luctus velit vel, suscipit ligula. Fusce porta, magna in mollis elementum, diam urna luctus nisi, eget suscipit ipsum quam feugiat elit. Quisque et rhoncus turpis. Mauris mollis, tellus quis pellentesque ullamcorper, metus velit dignissim augue, et pretium lorem risus non dolor. Vivamus sit amet odio vel quam posuere aliquet ut vel neque. Curabitur vitae condimentum dui. Quisque in justo at ligula luctus volutpat at a lacus. In consectetur arcu sit amet tristique tempus.', 'Manage Client WebsiteManage Client WebsiteManage Client Website,Manage Client WebsiteManage Client WebsiteManage Client WebsiteManage Client Website', '#2344', 15000, 511574, 2, 25, 1, 2, 26, 28, 'Bsc. , Hnd, Nce', '2017-01-10 23:00:00', '2017-01-03 17:48:52', '2017-01-04 04:18:24', 1, '1. Networking\n2. Casitnn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `basicpay_details`
--

CREATE TABLE `basicpay_details` (
  `id` bigint(20) NOT NULL,
  `emp_grade` bigint(20) NOT NULL,
  `basicpay` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `basicpay_details`
--

INSERT INTO `basicpay_details` (`id`, `emp_grade`, `basicpay`) VALUES
(5, 1, 12000),
(6, 2, 45000),
(7, 3, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Olaoluwa', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `lm_comment` text,
  `emp_comment` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `goal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `lm_comment`, `emp_comment`, `created_at`, `updated_at`, `goal_id`, `user_id`) VALUES
(1, '\n												\n											\n											\n											\n											\n											\n											\n											\n											this is my comment. nothing more nothing less.Okay there\'s actually more not less. and nothing.', 'Nope! Can\'t do. Thanks.', '2016-11-10 12:01:15', '2016-11-10 15:43:26', 2, 2),
(2, 'This is my comment', NULL, '2016-11-10 17:59:47', '2016-11-10 17:59:52', 3, 2),
(3, NULL, 'jhjhjhjhj', '2016-11-11 15:16:16', '2016-11-11 15:16:23', 4, 3),
(4, NULL, 'grftyrtyryuu', '2016-11-11 15:16:24', '2016-11-11 15:16:27', 5, 3),
(5, NULL, 'jjkyjjkgjghg', '2016-11-11 15:16:36', '2016-11-11 15:16:42', 1, 3),
(6, NULL, '		hedghdgdhghdhtdty			  ', '2016-11-11 15:16:44', '2016-11-11 15:16:48', 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(20) UNSIGNED NOT NULL,
  `street` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `state_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `street`, `city`, `state_id`, `created_at`, `updated_at`) VALUES
(46, 89, 'Thomson', 'Ikeja', 24, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(47, 90, 'Ajose', 'yaba', 24, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(48, 91, 'Willson', 'Onitsha', 3, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(49, 92, 'Oba Akinjobi', 'Ile-Ife', 14, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(50, 93, 'Benson', 'Ikeja', 29, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(51, 94, 'Akintola', 'Ikeja', 24, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(52, 95, 'Adeogun', 'Abakiliki', 24, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(53, 96, 'Bassit', 'Ikeja', 11, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(54, 97, 'Benko', 'otta', 24, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(55, 98, 'Badu', 'Akure', 27, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(56, 99, 'Bello', 'Ado-Ekitti', 14, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(57, 100, 'Sunnyvilla', 'Lekki', 24, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(58, 101, 'Bade thomas', 'Zaria', 18, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(59, 102, 'Rareview', 'Chalawa', 19, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(60, 103, 'Thames', 'Lekki', 24, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(61, 104, 'Johnson', 'otta', 24, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(62, 105, 'Talik', 'lekki', 27, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(63, 106, 'Welington', 'Otta', 24, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(64, 107, 'Mascott', 'Ado-Ekitti', 14, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(65, 108, 'Mascott', 'Ado-Ekitti', 33, '2016-12-15 07:25:09', '2016-12-15 07:25:09'),
(66, 109, 'Abayomi Shonuga', 'Ikoyi', 25, '2016-12-15 11:26:28', '2016-12-15 11:26:28'),
(67, 110, 'Nnobi', 'Surulere', 25, '2016-12-15 11:26:28', '2016-12-15 11:26:28'),
(68, 111, 'Abraham Adesanya', 'MaryLand', 25, '2016-12-15 11:26:28', '2016-12-15 11:26:28'),
(69, 112, 'Etim Okon', 'Calabar', 9, '2016-12-15 11:26:28', '2016-12-15 11:26:28'),
(70, 113, 'Philip Ekong', 'Calabar', 9, '2016-12-15 11:26:28', '2016-12-15 11:26:28'),
(71, 114, 'Solomon Lar', 'Jos', 32, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(72, 115, 'Rev. Crowford', 'Jos', 7, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(73, 116, 'etim iyang,', 'victoria island', 31, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(74, 117, '31 Bell street, Asokoro, FCT, Abuja', 'Abuja', 37, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(75, 118, '12 Kola Wale', 'victoria island', 25, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(76, 119, 'Fox road', 'Aba', 1, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(77, 120, 'Murtala Mohammed Way', 'kano', 20, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(78, 121, 'Aminu Kano', 'kano', 20, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(79, 122, 'Emansue, Shell Estate', 'Benin', 13, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(80, 123, 'Olusegun Obasanjo way', 'Benin', 13, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(81, 124, 'Olu Sarki Avenue', 'Ilorin', 24, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(82, 125, 'Broad Str.', 'Ikeja', 4, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(83, 126, 'Balarabe Musa', 'Kaduna', 19, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(84, 127, 'Adebisi', 'Ibadan', 31, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(85, 128, 'Eric Moore', 'Surulere', 5, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(86, 129, 'Obong Victor Attah Way.', 'uyo', 12, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(87, 130, 'Yoruba Rd.', 'Kano', 21, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(88, 131, 'etim iyang,', 'victoria island', 26, '2016-12-15 11:26:29', '2016-12-15 11:26:29'),
(89, 132, 'Abayomi Shonuga', 'Ikoyi', 25, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(90, 133, 'Nnobi', 'Surulere', 25, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(91, 134, 'Abraham Adesanya', 'MaryLand', 25, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(92, 135, 'Etim Okon', 'Calabar', 9, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(93, 136, 'Philip Ekong', 'Calabar', 9, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(94, 137, 'Solomon Lar', 'Jos', 32, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(95, 138, 'Rev. Crowford', 'Jos', 7, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(96, 139, 'etim iyang,', 'victoria island', 31, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(97, 140, '31 Bell street, Asokoro, FCT, Abuja', 'Abuja', 37, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(98, 141, '12 Kola Wale', 'victoria island', 25, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(99, 142, 'Fox road', 'Aba', 1, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(100, 143, 'Murtala Mohammed Way', 'kano', 20, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(101, 144, 'Aminu Kano', 'kano', 20, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(102, 145, 'Emansue, Shell Estate', 'Benin', 13, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(103, 146, 'Olusegun Obasanjo way', 'Benin', 13, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(104, 147, 'Olu Sarki Avenue', 'Ilorin', 24, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(105, 148, 'Broad Str.', 'Ikeja', 4, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(106, 149, 'Balarabe Musa', 'Kaduna', 19, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(107, 150, 'Adebisi', 'Ibadan', 31, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(108, 151, 'Eric Moore', 'Surulere', 5, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(109, 152, 'Obong Victor Attah Way.', 'uyo', 12, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(110, 153, 'Yoruba Rd.', 'Kano', 21, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(111, 154, 'etim iyang,', 'victoria island', 26, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(112, 155, 'Upper Iweka', 'Onitsha', 6, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(113, 156, 'Chevron Estate', 'Portharcourt', 34, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(114, 157, 'Thomas Estate', 'Ajah', 26, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(115, 158, 'Douglas Rd.', 'Owerri', 17, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(116, 159, 'Shaka Tinubu', 'Ikoyi', 26, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(117, 160, 'Zubero Way', 'Katsina', 22, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(118, 161, 'Agege', 'Lokoja', 24, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(119, 162, 'Shagari, Wakili', 'Sokoto', 35, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(120, 163, 'Luggard', 'Yola', 2, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(121, 164, 'Ogbumodia Str.', 'Asaba', 12, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(122, 165, 'Isaac Borough', 'Yenegoa', 8, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(123, 166, 'Garry Avenue', 'Calabar', 11, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(124, 167, 'Opebi', 'Ikeja', 26, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(125, 168, 'Audu Bako Way', 'kano', 22, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(126, 169, 'Spence Way', 'Lagos Island', 26, '2016-12-15 11:27:15', '2016-12-15 11:27:15'),
(127, 170, 'fgurkgrgheih', 'ufrjkhfrfjerkh', 1, '2016-12-20 17:31:03', '2016-12-20 17:31:03'),
(128, 171, 'jdhcvjhj', 'lagos', 1, '2016-12-20 18:45:40', '2016-12-20 18:46:00'),
(129, 172, 'Thomson', 'Ikeja', 24, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(130, 173, 'Ajose', 'yaba', 24, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(131, 174, 'Willson', 'Onitsha', 3, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(132, 175, 'Oba Akinjobi', 'Ile-Ife', 14, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(133, 176, 'Benson', 'Ikeja', 29, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(134, 177, 'Akintola', 'Ikeja', 24, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(135, 178, 'Adeogun', 'Abakiliki', 24, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(136, 179, 'Bassit', 'Ikeja', 11, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(137, 180, 'Benko', 'otta', 24, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(138, 181, 'Badu', 'Akure', 27, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(139, 182, 'Bello', 'Ado-Ekitti', 14, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(140, 183, 'Sunnyvilla', 'Lekki', 24, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(141, 184, 'Bade thomas', 'Zaria', 18, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(142, 185, 'Rareview', 'Chalawa', 19, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(143, 186, 'Thames', 'Lekki', 24, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(144, 187, 'Johnson', 'otta', 24, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(145, 188, 'Talik', 'lekki', 27, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(146, 189, 'Welington', 'Otta', 24, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(147, 190, 'Mascott', 'Ado-Ekitti', 14, '2017-01-27 09:55:22', '2017-01-27 09:55:22'),
(148, 191, 'Mascott', 'Ado-Ekitti', 33, '2017-01-27 09:55:22', '2017-01-27 09:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `corrects`
--

CREATE TABLE `corrects` (
  `id` int(10) UNSIGNED NOT NULL,
  `correctoption` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `corrects`
--

INSERT INTO `corrects` (`id`, `correctoption`, `question_id`, `created_at`, `updated_at`) VALUES
(4, '3', 21, '2016-12-14 14:22:52', '2016-12-14 14:22:52'),
(5, '4', 22, '2016-12-14 14:22:52', '2016-12-14 14:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `daily_attendance`
--

CREATE TABLE `daily_attendance` (
  `id` bigint(20) NOT NULL,
  `emp_id` bigint(20) NOT NULL,
  `emp_num` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `clock_in` datetime DEFAULT NULL,
  `clock_out` datetime DEFAULT NULL,
  `flag` varchar(11) DEFAULT NULL,
  `daily_deduction_percentage` double DEFAULT NULL,
  `late_time` time DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_attendance`
--

INSERT INTO `daily_attendance` (`id`, `emp_id`, `emp_num`, `date`, `clock_in`, `clock_out`, `flag`, `daily_deduction_percentage`, `late_time`, `updated_at`, `created_at`) VALUES
(109, 1, 101, '2017-03-02', '2017-03-02 09:48:32', NULL, 'Late', NULL, '09:48:32', '2017-03-03 08:48:33', '2017-03-03 08:48:32'),
(110, 144, 603, '2017-03-02', '2017-03-03 07:00:00', '2017-03-02 06:00:00', 'Late', 0, '07:00:00', '2017-03-03 09:34:26', NULL),
(111, 2, 102, '2017-03-03', '2017-03-03 07:00:00', '2017-03-02 06:00:00', 'Late', 0, '07:00:00', '2017-03-03 09:29:49', NULL),
(112, 2, 102, '2017-03-02', '2017-03-01 09:55:00', '2017-03-02 18:00:00', NULL, 0, '00:00:00', '2017-03-03 10:35:29', NULL),
(113, 2, 102, '2017-02-27', '2017-02-27 07:00:00', '2017-02-27 18:00:00', NULL, 0, '00:00:00', '2017-03-03 11:10:03', NULL),
(114, 2, 102, '2017-02-28', '2017-02-28 07:00:00', '2017-02-28 18:00:00', NULL, 0, '00:00:00', '2017-03-03 13:52:46', NULL),
(115, 3, 103, '2017-02-28', '2017-02-28 07:00:00', '2017-02-28 18:00:00', NULL, 0, '00:00:00', '2017-03-03 14:06:33', NULL),
(116, 1, 101, '2017-03-03', '2017-03-03 15:22:26', NULL, 'Late', NULL, '15:22:26', '2017-03-03 14:22:26', '2017-03-03 14:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `daily_attendance_settings`
--

CREATE TABLE `daily_attendance_settings` (
  `id` bigint(20) NOT NULL,
  `role` int(1) NOT NULL,
  `late_minute` int(11) NOT NULL,
  `late_percentage` decimal(5,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_attendance_settings`
--

INSERT INTO `daily_attendance_settings` (`id`, `role`, `late_minute`, `late_percentage`, `status`, `created_date`, `created_by`, `modify_date`, `modify_by`) VALUES
(1, 4, 10, '0.50', 1, '2017-01-05 13:03:53', 6, '2017-01-05 13:04:02', 6),
(3, 4, 5, '0.04', 1, '2017-01-07 07:18:56', 6, NULL, NULL),
(4, 4, 15, '1.50', 1, '2017-01-07 07:19:15', 6, NULL, NULL),
(5, 4, 30, '3.20', 1, '2017-01-07 07:19:47', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `document` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `document`, `type_id`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'dd.pdf', '1', NULL, NULL, 1),
(2, 'dd.pdf', '2', NULL, NULL, 1),
(3, 'documents/61fe359977ec1a692e41779251b70136.pdf', '1', '2016-12-09 18:27:28', '2016-12-09 18:27:28', 33),
(5, 'documents/82d8426807aa5cc67d85838e8803dd0f.png', '1', '2016-12-09 19:19:33', '2016-12-09 19:19:33', 1),
(6, 'documents/77ffb292b784d80384d16ed517d31a42.png', '2', '2016-12-20 17:58:13', '2016-12-20 17:58:13', 170);

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE `document_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `docname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `document_types`
--

INSERT INTO `document_types` (`id`, `docname`, `created_at`, `updated_at`) VALUES
(1, 'Nysc', NULL, NULL),
(2, 'Waec', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emp360rateds`
--

CREATE TABLE `emp360rateds` (
  `id` int(10) UNSIGNED NOT NULL,
  `rater_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `emp_id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emp360rateds`
--

INSERT INTO `emp360rateds` (`id`, `rater_id`, `created_at`, `updated_at`, `emp_id`) VALUES
(12, 2, '2017-01-26 14:43:23', '2017-01-26 14:43:23', 1),
(11, 2, '2017-01-25 17:43:29', '2017-01-25 17:43:29', 5),
(10, 2, '2017-01-25 17:29:42', '2017-01-25 17:29:42', 3),
(9, 2, '2017-01-25 17:23:41', '2017-01-25 17:23:41', 4),
(8, 3, '2017-01-25 17:17:33', '2017-01-25 17:17:33', 1),
(7, 3, '2017-01-25 17:00:12', '2017-01-25 17:00:12', 4);

-- --------------------------------------------------------

--
-- Table structure for table `emp360ratings`
--

CREATE TABLE `emp360ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `rate` float NOT NULL,
  `emp_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emp360ratings`
--

INSERT INTO `emp360ratings` (`id`, `rate`, `emp_id`, `created_at`, `updated_at`) VALUES
(1, 2.5, 4, '2017-01-25 17:00:12', '2017-01-25 17:23:41'),
(2, 3, 1, '2017-01-25 17:17:33', '2017-01-26 14:43:23'),
(3, 3, 3, '2017-01-25 17:29:42', '2017-01-25 17:29:42'),
(4, 2, 5, '2017-01-25 17:43:29', '2017-01-25 17:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `empdocs`
--

CREATE TABLE `empdocs` (
  `id` int(10) UNSIGNED NOT NULL,
  `documentname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `folder_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `path` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `empdocs`
--

INSERT INTO `empdocs` (`id`, `documentname`, `folder_id`, `user_id`, `created_at`, `updated_at`, `path`) VALUES
(4, 'dsds.pdf', 3, 3, '2017-01-05 19:13:19', '2017-01-06 17:11:42', ''),
(3, 'effje.pdf', 3, 1, '2017-01-05 15:49:13', '2017-01-06 17:11:42', ''),
(5, 'cv.pdf', 2, 3, '2017-01-06 07:15:07', '2017-01-06 07:15:07', ''),
(8, 'waec.pdf', 2, 3, '2017-01-06 07:17:47', '2017-01-06 07:17:47', ''),
(10, 'dcd', 3, 2, '2017-01-06 08:40:46', '2017-01-06 15:42:55', 'document/e08f216c09d64b8810b2a62831759005.pdf'),
(13, 'mycv', 1, 2, '2017-01-14 16:56:08', '2017-01-14 16:56:08', 'document/7134260fc227405f0bb3e6ef9643ee31.pdf'),
(14, 'jhh', 3, 2, '2017-01-14 16:59:03', '2017-01-14 17:03:07', 'document/bd82db9a33dadce83a9ca4ebedcc311e.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `emploee_expenses`
--

CREATE TABLE `emploee_expenses` (
  `id` bigint(20) NOT NULL,
  `emp_id` bigint(11) NOT NULL,
  `expense_details` varchar(255) NOT NULL,
  `expense_charge` double NOT NULL,
  `expense_date` date NOT NULL,
  `created_date` datetime NOT NULL,
  `expense_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for applied, 2 for approved, 3 for revise, 4 for revised, 5 for rejected',
  `status_updated_on` datetime DEFAULT NULL,
  `status_updated_by` bigint(20) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0'COMMENT
) ;

--
-- Dumping data for table `emploee_expenses`
--

INSERT INTO `emploee_expenses` (`id`, `emp_id`, `expense_details`, `expense_charge`, `expense_date`, `created_date`, `expense_status`, `status_updated_on`, `status_updated_by`, `is_approved`, `approved_by`, `approved_on`, `status_tracks`, `status_track_dates`, `status_track_by`, `is_claimed`, `claimed_date`) VALUES
(1, 2, 'test expense', 500, '2016-12-28', '2017-01-10 11:32:41', 2, '2017-03-02 16:49:12', 1, 1, 1, '2017-03-02 16:49:12', '||||3||||4||||3||||4||||4||||2', '||||2017-01-11 05:32:22||||2017-01-11 05:33:49||||2017-01-11 05:38:27||||2017-01-11 05:39:32||||2017-01-11 05:45:34||||2017-03-02 16:49:12', '||||6||||2||||6||||2||||2||||1', 1, '2017-03-03 17:23:41'),
(2, 9, 'new expense for emp not under any PM', 500, '2016-12-29', '2017-01-11 06:40:49', 3, '2017-02-17 05:47:36', 3, 0, 0, '0000-00-00 00:00:00', '1||||3||||4||||2||||5||||3', '2017-01-11 06:40:49||||2017-01-11 06:41:13||||2017-01-11 06:41:56||||2017-01-11 06:42:21||||2017-02-17 05:45:37||||2017-02-17 05:47:36', '9||||6||||9||||6||||3||||3', 0, NULL),
(3, 9, 'chocolate', 50, '2017-01-20', '2017-01-17 09:55:23', 1, NULL, NULL, 0, 0, '0000-00-00 00:00:00', '1', '2017-01-17 09:55:23', '9', 0, NULL),
(4, 2, 'Street fighter', 6500, '2017-01-04', '2017-01-17 10:01:29', 2, '2017-01-17 10:13:04', 3, 1, 3, '2017-01-17 10:13:04', '1||||2', '2017-01-17 10:01:29||||2017-01-17 10:13:04', '2||||3', 1, '2017-01-18 04:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `employee_casual_leaves`
--

CREATE TABLE `employee_casual_leaves` (
  `id` bigint(20) NOT NULL,
  `emp_id` bigint(20) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `leave_comment` text NOT NULL,
  `leave_status` int(1) NOT NULL DEFAULT '1' COMMENT '1 for applied(pending), 2 for approved, 3 for rejected, 4 for cancelled',
  `status_changed_by` bigint(20) NOT NULL,
  `status_changed_on` datetime NOT NULL,
  `total_casual_leaves` int(11) NOT NULL COMMENT 'Total number of casual leaves available for the month',
  `total_no_of_leave_days` int(11) NOT NULL,
  `applied_on` datetime NOT NULL,
  `is_casual_leave` tinyint(1) NOT NULL COMMENT '1 if it is casual leave, 0 if LOP'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_casual_leaves`
--

INSERT INTO `employee_casual_leaves` (`id`, `emp_id`, `from_date`, `to_date`, `leave_comment`, `leave_status`, `status_changed_by`, `status_changed_on`, `total_casual_leaves`, `total_no_of_leave_days`, `applied_on`, `is_casual_leave`) VALUES
(1, 9, '2016-12-28', '2016-12-31', 'Retest', 2, 6, '2016-12-27 07:13:14', 0, 2, '2016-12-27 05:09:14', 1),
(2, 9, '2016-12-30', '2016-12-30', 'test', 3, 6, '2016-12-27 07:13:06', 0, 0, '2016-12-27 07:08:56', 1),
(3, 9, '2016-12-28', '2016-12-30', 'Boring', 1, 0, '0000-00-00 00:00:00', 0, 2, '2016-12-27 07:16:54', 1),
(4, 9, '2016-12-29', '2016-12-29', 'Restest1', 1, 0, '0000-00-00 00:00:00', 0, 1, '2016-12-27 07:29:43', 1),
(5, 9, '2016-12-30', '2016-12-30', 'Personal work\r\n', 1, 0, '0000-00-00 00:00:00', 0, 0, '2016-12-29 03:51:10', 1),
(6, 9, '2016-11-16', '2016-11-22', 'for testing direct', 3, 6, '2016-12-30 07:52:31', 0, 5, '2016-12-29 03:51:10', 1),
(10, 2, '2017-01-11', '2017-01-11', 'go to home ', 2, 6, '2017-02-17 10:06:57', 0, 1, '2017-01-03 07:57:43', 1),
(11, 23, '2017-01-18', '2017-01-23', 'Test7.Saturday', 2, 6, '2017-01-07 06:19:54', 0, 4, '2017-01-07 05:46:12', 0),
(12, 23, '2016-12-01', '2016-12-06', 'approved leave', 2, 6, '2016-12-01 00:00:00', 0, 3, '2016-12-01 00:00:00', 1),
(13, 23, '2016-12-11', '2016-12-11', 'un approved leave1', 1, 0, '0000-00-00 00:00:00', 0, 1, '2016-12-11 00:00:00', 1),
(14, 23, '2016-12-22', '2016-12-24', 'rejected leave', 3, 0, '0000-00-00 00:00:00', 0, 1, '2016-12-22 00:00:00', 1),
(15, 23, '2017-01-16', '2017-01-19', 'fghfg', 4, 23, '2017-01-07 06:05:20', 0, 4, '2017-01-07 05:55:56', 0),
(16, 23, '2017-01-22', '2017-01-26', 'test', 4, 23, '2017-01-07 06:06:03', 0, 5, '2017-01-07 06:05:55', 0),
(18, 9, '2017-01-08', '2017-01-10', 'test leave', 2, 6, '2017-02-17 09:50:16', 0, 3, '2017-01-10 09:49:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `emp_academics`
--

CREATE TABLE `emp_academics` (
  `id` int(10) UNSIGNED NOT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` date NOT NULL,
  `institution` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emp_academics`
--

INSERT INTO `emp_academics` (`id`, `qualification`, `year`, `institution`, `grade`, `course`, `emp_id`, `created_at`, `updated_at`) VALUES
(1, 'HND', '2017-02-09', 'Osun State University', 'Second Class Upper', 'Computer Science', 1, '2017-02-24 17:37:37', '2017-02-25 08:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `emp_dependants`
--

CREATE TABLE `emp_dependants` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_num` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `emp_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `relationship` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emp_dependants`
--

INSERT INTO `emp_dependants` (`id`, `name`, `dob`, `email`, `phone_num`, `emp_id`, `created_at`, `updated_at`, `relationship`) VALUES
(1, 'Adedeji deji', '2017-02-28', 'ol@gg.com', '07036725298', 1, '2017-02-24 11:23:23', '2017-02-24 13:05:26', 'Sister'),
(2, 'Bimbo Osin', '2017-02-16', 'ase@gg.com', '07036725248', 1, '2017-02-24 11:42:55', '2017-02-24 11:42:55', 'Father');

-- --------------------------------------------------------

--
-- Table structure for table `emp_histories`
--

CREATE TABLE `emp_histories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `organization` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_histories`
--

INSERT INTO `emp_histories` (`id`, `user_id`, `organization`, `position`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 42, 'Microsoft Coporations', 'Sales Manager', '2016-12-12', '2016-12-20', '2016-12-02 13:47:37', '2016-12-02 13:47:37'),
(2, 42, 'Service of Kings', 'Sales Manager', '2016-12-06', '2016-12-20', '2016-12-05 21:37:50', '2016-12-05 21:37:50'),
(3, 31, 'lfiuhiuh', 'iuiuhiuhiuhiu', '2016-12-14', '2016-12-20', '2016-12-09 18:02:22', '2016-12-09 18:02:22'),
(4, 170, 'wsedfsdkssd', 'skdjskfdjkjsd', '2016-12-14', '2016-12-19', '2016-12-20 17:56:10', '2016-12-20 17:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `emp_past_emps`
--

CREATE TABLE `emp_past_emps` (
  `id` int(10) UNSIGNED NOT NULL,
  `organization` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_id` int(11) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emp_past_emps`
--

INSERT INTO `emp_past_emps` (`id`, `organization`, `role`, `emp_id`, `from`, `to`, `created_at`, `updated_at`) VALUES
(1, 'Snapnet', 'Application Developer', 1, '2011-03-16', '2017-02-28', '2017-02-27 09:36:34', '2017-02-27 10:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `emp_reviews`
--

CREATE TABLE `emp_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reviewer_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `review` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reviewername` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emp_reviews`
--

INSERT INTO `emp_reviews` (`id`, `emp_id`, `reviewer_id`, `review`, `created_at`, `updated_at`, `reviewername`) VALUES
(15, '2', '3', 'scsdcdcvedh', '2017-01-25 08:16:41', '2017-01-25 08:16:41', 'OLORUNDA OLAOLUWA'),
(14, '1', '3', 'cedvnmerfgebf', '2017-01-23 12:03:08', '2017-01-23 12:03:08', 'Bimbo Oshin'),
(13, '2', '3', 'I love this guy ', '2017-01-23 11:59:40', '2017-01-23 11:59:40', 'Solomon Brandy'),
(16, '4', '2', 'jhsdgcsdjhfgejh', '2017-01-26 14:46:40', '2017-01-26 14:46:40', 'Ademola Seun'),
(17, '1', '2', 'edfewre', '2017-01-26 15:19:09', '2017-01-26 15:19:09', 'Olorunda Olaoluwa'),
(18, '1', '2', 'de', '2017-01-26 15:19:40', '2017-01-26 15:19:40', 'Olorunda Olaoluwa'),
(19, '2', '3', 'I love this guy ', '2017-01-23 11:59:40', '2017-01-23 11:59:40', 'Solomon Brandy'),
(20, '2', '3', 'I love this guy ', '2017-01-23 11:59:40', '2017-01-23 11:59:40', 'Solomon Brandy'),
(21, '2', '3', 'I love this guy ', '2017-01-23 11:59:40', '2017-01-23 11:59:40', 'Solomon Brandy'),
(22, '2', '3', 'I love this guy ', '2017-01-23 11:59:40', '2017-01-23 11:59:40', 'Solomon Brandy'),
(23, '2', '3', 'I love this guy ', '2017-01-23 11:59:40', '2017-01-23 11:59:40', 'Solomon Brandy'),
(24, '2', '3', 'I love this guy ', '2017-01-23 11:59:40', '2017-01-23 11:59:40', 'Solomon Brandy'),
(25, '2', '3', 'I love this guy ', '2017-01-23 11:59:40', '2017-01-23 11:59:40', 'Solomon Brandy');

-- --------------------------------------------------------

--
-- Table structure for table `emp_skills`
--

CREATE TABLE `emp_skills` (
  `id` int(10) UNSIGNED NOT NULL,
  `skill` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `experience` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rating` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emp_skills`
--

INSERT INTO `emp_skills` (`id`, `skill`, `experience`, `rating`, `remarks`, `emp_id`, `created_at`, `updated_at`) VALUES
(1, 'PHP', '44', 'Beginner', 'Why', 1, '2017-02-24 14:54:23', '2017-02-24 15:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `fiscals`
--

CREATE TABLE `fiscals` (
  `id` int(11) NOT NULL,
  `start_month` char(2) NOT NULL,
  `end_month` char(2) NOT NULL,
  `grace` char(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fiscals`
--

INSERT INTO `fiscals` (`id`, `start_month`, `end_month`, `grace`, `created_at`, `updated_at`) VALUES
(1, '4', '3', '2', '2016-11-09 17:43:00', '2016-11-09 17:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Contract Doc', NULL, '2017-01-09 05:09:18'),
(3, 'Some', '2017-01-06 14:39:26', '2017-01-06 15:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(10) UNSIGNED NOT NULL,
  `objective` varchar(4000) COLLATE utf8_unicode_ci NOT NULL,
  `commitment` varchar(4000) COLLATE utf8_unicode_ci NOT NULL,
  `emp_id` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `goal_cat` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `objective`, `commitment`, `emp_id`, `assigned_to`, `goal_cat`, `created_at`, `updated_at`) VALUES
(1, 'Do something', 'Get 2000 customers to buy 1 truck load of golden penny pasta.', 0, 0, 2, '2016-11-09 14:38:59', '2016-11-09 14:38:59'),
(2, 'Competitive Sales', 'Sell 5 truck load of Golden penny pasta to 1000 cutomers', 1, 2, 1, '2016-11-10 11:36:43', '2016-11-10 11:36:43'),
(3, 'Sell five golden penny chickens', 'Sell five chickens', 1, 2, 1, '2016-11-10 14:47:29', '2016-11-10 14:47:29'),
(4, 'Sell 5 trucks in a day.', 'Sell 12000 truck loads of golden penny biscuits', 1, 3, 1, '2016-11-10 15:48:21', '2016-11-10 15:48:21'),
(5, 'Manufacture 1 bag per day', 'Manufacture 10 Bags of cement per day', 1, 3, 1, '2016-11-10 15:50:49', '2016-11-10 15:50:49'),
(6, 'make 12 bag of semolina per day.', 'Make 5 bags of semolina', 1, 3, 1, '2016-11-10 15:54:32', '2016-11-10 15:54:32'),
(7, 'rhgrsghrsgsgbsgbdzf', 'eghrsgsg d fgbdgbbf', 1, 2, 1, '2016-11-10 21:55:06', '2016-11-10 21:55:06'),
(8, 'Accuracy', 'Minimize errors on production line', 0, 0, 2, '2016-11-11 06:21:37', '2016-11-11 06:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `goal_cats`
--

CREATE TABLE `goal_cats` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `goal_cats`
--

INSERT INTO `goal_cats` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Line Manager', NULL, NULL),
(2, 'Pilot', NULL, NULL),
(3, 'Individual Development Plan', NULL, NULL),
(4, 'Career Aspiration', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `health_diagnosis`
--

CREATE TABLE `health_diagnosis` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `doctor_id` bigint(20) DEFAULT NULL,
  `diagnosis_date` date NOT NULL,
  `diagnosis_description` longtext NOT NULL,
  `prescribed_drugs` text NOT NULL,
  `doctor_recommendation` text NOT NULL,
  `total_leave_days` int(11) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `external_leave_type` int(1) NOT NULL COMMENT '1 for external, 0 for internal',
  `medical_report` varchar(255) DEFAULT NULL,
  `leave_status` tinyint(1) NOT NULL COMMENT '2 for Pending, 1 for approved, 0 for cancelled',
  `status_updated_by` bigint(20) DEFAULT NULL,
  `status_updated_on` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `mc_issued` tinyint(1) NOT NULL DEFAULT '0',
  `mc_file` varchar(255) DEFAULT NULL,
  `mc_issued_by` bigint(20) DEFAULT NULL,
  `mc_issued_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `health_diagnosis`
--

INSERT INTO `health_diagnosis` (`id`, `user_id`, `doctor_id`, `diagnosis_date`, `diagnosis_description`, `prescribed_drugs`, `doctor_recommendation`, `total_leave_days`, `leave_from`, `leave_to`, `external_leave_type`, `medical_report`, `leave_status`, `status_updated_by`, `status_updated_on`, `created_date`, `created_by`, `mc_issued`, `mc_file`, `mc_issued_by`, `mc_issued_on`) VALUES
(1, 2, 8, '2016-12-08', 'Diagnosis Description', 'Prescribed Drugs', 'Doctor\'s Recommendation', 2, '2016-12-09', '2016-12-10', 0, NULL, 1, 8, '2016-12-14 07:52:31', '2016-12-08 11:00:56', 8, 1, '1481702643.pdf', 8, '2016-12-14 08:04:03'),
(2, 2, NULL, '2016-12-20', 'TEST', 'TEST.DRUGS', 'TEST.DOCTORS', 2, '2016-12-20', '2016-12-28', 1, '1482229681.pdf', 1, 8, '2016-12-20 10:36:55', '2016-12-20 10:28:01', 2, 1, '1482230244.pdf', 8, '2016-12-20 10:37:24'),
(3, 2, NULL, '2016-12-22', 'description', 'drugs', 'recommendation', 2, '2016-12-15', '2016-12-16', 0, '1482385001.pdf', 1, 8, '2016-12-22 05:43:10', '2016-12-22 05:36:41', 2, 0, NULL, NULL, NULL),
(4, 2, NULL, '2016-12-22', 'Test.Des', 'Not feeling well', 'Then take rest', 5, '2016-12-23', '2016-12-30', 1, '', 1, 8, '2016-12-22 07:44:21', '2016-12-22 07:39:23', 2, 1, '1482392702.pdf', 8, '2016-12-22 07:45:02'),
(5, 9, NULL, '2016-12-31', 'Testing purpose', 'Jaundice', 'Need to check', 3, '2017-01-18', '2017-01-20', 0, '1483176752.pdf', 1, 8, '2016-12-31 09:46:41', '2016-12-31 09:32:32', 9, 1, '1483177673.pdf', 8, '2016-12-31 09:47:53'),
(7, 23, NULL, '2017-01-07', 'Test7', 'Tested on 7', 'Tester', 5, '2017-01-10', '2017-01-14', 0, '1483766185.pdf', 2, NULL, NULL, '2017-01-07 05:16:25', 23, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `holiday_calendar`
--

CREATE TABLE `holiday_calendar` (
  `id` bigint(20) NOT NULL,
  `multiple_days` tinyint(1) NOT NULL DEFAULT '0'COMMENT
) ;

--
-- Dumping data for table `holiday_calendar`
--

INSERT INTO `holiday_calendar` (`id`, `multiple_days`, `single_day`, `from_date`, `to_date`, `reason`, `status`, `created_by`, `created_date`) VALUES
(1, 0, '2016-12-25', NULL, NULL, 'Xmas', 1, 6, '2016-12-16 07:36:09'),
(2, 1, NULL, '2016-12-31', '2017-01-01', 'New Years Eve', 1, 6, '2016-12-16 07:36:46'),
(5, 0, '2017-02-14', NULL, NULL, 'Test1', 1, 6, '2016-12-26 06:13:04'),
(6, 0, '2017-01-14', NULL, NULL, 'pongal', 1, 6, '2017-01-03 07:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `course` varchar(100) NOT NULL,
  `degree` varchar(20) NOT NULL,
  `degree_class` varchar(20) NOT NULL,
  `start_year` int(11) NOT NULL,
  `end_year` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`id`, `user_id`, `name`, `course`, `degree`, `degree_class`, `start_year`, `end_year`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 42, 'Osun State University', 'Computer Science', '3', '2', 2010, 2014, 149, '2016-12-02 12:28:44', '2016-12-02 12:28:44'),
(2, 42, 'School of India', 'Artificial Intelligence', '6', '1', 2016, 2016, 91, '2016-12-02 12:32:12', '2016-12-02 12:32:12'),
(3, 42, 'Massachusseuts Institute of Technology', 'Information Management', '8', '1', 2016, 2016, 217, '2016-12-02 12:38:06', '2016-12-02 12:38:06'),
(4, 42, 'Massachusseuts Institute of Technology', 'Information Management', '1', '1', 1980, 1980, 217, '2016-12-02 12:39:04', '2016-12-02 12:39:04'),
(5, 42, 'University of America', 'Data mining', '5', '1', 1980, 1980, 217, '2016-12-02 12:40:38', '2016-12-02 12:40:38'),
(6, 42, 'Lagos State University', 'Psychology', '3', '1', 1985, 1984, 149, '2016-12-05 21:36:58', '2016-12-05 21:36:58'),
(7, 42, 'Islamic State of Iran and Saudi Arabia', 'Weapons Development', '5', '1', 1984, 1984, 178, '2016-12-07 09:01:46', '2016-12-07 09:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(8) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `description`) VALUES
(1, 'Web Developer', 'Manage Client website and all some other stuffs worth manageing');

-- --------------------------------------------------------

--
-- Table structure for table `job_applied_fors`
--

CREATE TABLE `job_applied_fors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_applied_fors`
--

INSERT INTO `job_applied_fors` (`id`, `user_id`, `job_id`, `status`, `created_at`, `updated_at`) VALUES
(11, 2, 2, 1, '2017-01-04 07:27:28', '2017-01-04 08:39:55'),
(10, 2, 1, 1, '2017-01-04 07:26:10', '2017-01-04 12:29:19'),
(12, 1, 1, 0, '2017-01-11 16:17:41', '2017-01-11 16:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `job_deps`
--

CREATE TABLE `job_deps` (
  `id` int(11) NOT NULL,
  `spec` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_deps`
--

INSERT INTO `job_deps` (`id`, `spec`, `created_at`, `updated_at`) VALUES
(28, 'Information Technology', '2016-12-09 09:58:10', '2016-12-15 15:24:40'),
(31, 'Human Resource', '2016-12-09 09:59:12', '2016-12-15 15:25:10');

-- --------------------------------------------------------

--
-- Table structure for table `job_levels`
--

CREATE TABLE `job_levels` (
  `id` int(11) NOT NULL,
  `level` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_levels`
--

INSERT INTO `job_levels` (`id`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Entry Level', NULL, NULL),
(2, 'Non-Manager', NULL, NULL),
(3, 'Manager', NULL, NULL),
(4, 'Graduate Trainee', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_skills`
--

CREATE TABLE `job_skills` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `skill` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_skill_comps`
--

CREATE TABLE `job_skill_comps` (
  `id` int(11) NOT NULL,
  `proficiency` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_skill_comps`
--

INSERT INTO `job_skill_comps` (`id`, `proficiency`, `created_at`, `updated_at`) VALUES
(1, 'Fundamental Awareness', NULL, NULL),
(2, 'Basic Level', NULL, NULL),
(3, 'Intermediate', NULL, NULL),
(4, 'Advanced', NULL, NULL),
(5, 'Expert', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifcation_setts`
--

CREATE TABLE `notifcation_setts` (
  `id` int(10) UNSIGNED NOT NULL,
  `modulename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `repfreq` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifcation_setts`
--

INSERT INTO `notifcation_setts` (`id`, `modulename`, `repfreq`, `created_at`, `updated_at`) VALUES
(1, 'attendance', 1, NULL, '2017-01-16 13:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `num_of_leave_details`
--

CREATE TABLE `num_of_leave_details` (
  `id` int(11) NOT NULL,
  `job_role` int(11) NOT NULL,
  `num_of_leaves` int(11) NOT NULL COMMENT 'Number of casual leaves per month',
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `num_of_leave_details`
--

INSERT INTO `num_of_leave_details` (`id`, `job_role`, `num_of_leaves`, `updated_on`) VALUES
(1, 1, 2, '2016-12-17 15:06:00'),
(2, 2, 2, '2016-12-17 15:06:00'),
(3, 3, 3, '2016-12-17 15:06:00'),
(4, 4, 2, '2016-12-17 15:06:00'),
(5, 5, 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(11) NOT NULL,
  `option1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `correctoption` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `question_id`, `option1`, `option2`, `option3`, `option4`, `updated_at`, `created_at`, `correctoption`) VALUES
(9, 21, 'Create Applications', 'wsw', 'swwe', 'cjdf', '2016-12-14 15:22:52', '2016-12-14 15:22:52', 3),
(10, 22, 'Create Applications', 'wsw', 'swwe', 'cjdf', '2016-12-14 15:22:52', '2016-12-14 15:22:52', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` bigint(20) NOT NULL,
  `emp_id` bigint(20) DEFAULT NULL,
  `emp_num` int(11) DEFAULT NULL,
  `basicpay` double DEFAULT NULL,
  `attendance_days` int(11) DEFAULT NULL,
  `working_days` int(11) DEFAULT NULL,
  `leave_days` int(11) DEFAULT NULL,
  `lop_leave_days` int(11) DEFAULT NULL,
  `month_year` varchar(10) DEFAULT NULL,
  `grosssalary` double DEFAULT NULL,
  `netsalary` double DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `ps_issued` tinyint(4) DEFAULT NULL,
  `ps_file` varchar(255) DEFAULT NULL,
  `ps_issued_by` bigint(20) DEFAULT NULL,
  `ps_issued_on` datetime DEFAULT NULL,
  `basic_pay` double DEFAULT NULL,
  `late_coming_deduction` double DEFAULT NULL,
  `consolidated_allowance` decimal(20,2) DEFAULT NULL,
  `total_reliefs` decimal(20,2) DEFAULT NULL,
  `taxable_income` decimal(20,2) DEFAULT NULL,
  `cal_tax_pay` decimal(20,2) DEFAULT NULL,
  `minimum_tax_payable` decimal(20,2) DEFAULT NULL,
  `tax_payable` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `emp_id`, `emp_num`, `basicpay`, `attendance_days`, `working_days`, `leave_days`, `lop_leave_days`, `month_year`, `grosssalary`, `netsalary`, `created_by`, `created_date`, `ps_issued`, `ps_file`, `ps_issued_by`, `ps_issued_on`, `basic_pay`, `late_coming_deduction`, `consolidated_allowance`, `total_reliefs`, `taxable_income`, `cal_tax_pay`, `minimum_tax_payable`, `tax_payable`) VALUES
(5, 23, 123, 20000, 20, 15, 2, 5, 'Dec-2016', 16500, 15997.6, 6, '2017-01-07 08:03:17', 1, '1483978213.pdf', 6, '2017-01-09 16:10:13', 15000, 127.4, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(6, 9, 109, 35000, 20, 2, 1, 18, 'Dec-2016', 4515, 3753.75, 6, '2017-01-07 11:05:26', 1, '1484628395.pdf', 6, '2017-01-17 04:46:35', 3500, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(7, 7, 107, 27000, 20, 0, 0, 20, 'Dec-2016', 0, 0, 6, '2017-01-17 12:56:04', 1, '1484735229.pdf', 6, '2017-01-18 10:27:09', 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(8, 2, 101, 31000, 20, 0, 0, 20, 'Dec-2016', 6500, 6500, 6, '2017-01-18 04:20:12', 1, '1484735261.pdf', 6, '2017-01-18 10:27:41', 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(9, 5, 105, 27000, 20, 1, 0, 19, 'Dec-2016', 1633.5, 1285.88, 6, '2017-01-18 14:19:41', 1, '1484749191.pdf', 6, '2017-01-18 14:19:51', 1350, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(10, 4, 104, 25000, 22, 0, 0, 22, 'Jan-2017', 0, 0, 6, '2017-02-01 21:38:33', 1, '1487250063.pdf', 6, '2017-02-16 13:01:03', 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(11, 3, 103, 25000, 22, 1, 0, 21, 'Jan-2017', 1306.81, 1227.27, 6, '2017-02-08 13:56:50', 0, '', 0, '0000-00-00 00:00:00', 1136.36, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(14, 9, 109, 45000, 22, 21, 2, 1, 'Jan-2017', 113829.56, 107338.8, 6, '2017-02-17 10:17:00', 1, '1487326817.pdf', 6, '2017-02-17 10:20:17', 42954.55, 0, '39432.58', '50557.81', '63271.75', '6490.76', '1138.30', '6490.76'),
(15, 9, 109, 45000, 22, 21, 2, 1, 'Jan-2017', 113829.56, 107338.8, 6, '2017-02-17 10:19:57', 0, '', 0, '0000-00-00 00:00:00', 42954.55, 0, '39432.58', '50557.81', '63271.75', '6490.76', '1138.30', '6490.76'),
(16, 7, 107, 45000, 22, 0, 0, 22, 'Jan-2017', 0, 0, 6, '2017-02-20 14:46:06', 1, '1487601972.pdf', 6, '2017-02-20 14:46:12', 0, 0, '16666.67', '16666.67', '-16666.67', '-21333.33', '0.00', '0.00'),
(17, 5, 105, 45000, 22, 0, 0, 22, 'Jan-2017', 0, 0, 6, '2017-02-20 15:16:39', 0, '', 0, '0000-00-00 00:00:00', 0, 0, '16666.67', '16666.67', '-16666.67', '-21333.33', '0.00', '0.00'),
(18, 89, 106, 3000, 19, 0, 0, 19, 'Feb-2017', 0, 0, 1, '2017-03-02 16:15:29', 1, '1488560914.pdf', 1, '2017-03-03 17:08:34', 0, 0, '16666.67', '16666.67', '-16666.67', '-21333.33', '0.00', '0.00'),
(19, 89, 106, 3000, 19, 0, 0, 19, 'Feb-2017', 0, 0, 1, '2017-03-02 16:16:23', 1, '1488561133.pdf', 1, '2017-03-03 17:12:13', 0, 0, '16666.67', '16666.67', '-16666.67', '-21333.33', '0.00', '0.00'),
(20, 3, 103, 45000, 19, 0, 0, 19, 'Feb-2017', 0, 0, 1, '2017-03-02 16:41:26', 1, '1488561300.pdf', 1, '2017-03-03 17:15:00', 0, 0, '16666.67', '16666.67', '-16666.67', '-21333.33', '0.00', '0.00'),
(21, 2, 102, 12000, 19, 2, 0, 17, 'Feb-2017', 3347.37, 3813.9, 1, '2017-03-03 17:23:41', 1, '1488561829.pdf', 1, '2017-03-03 17:23:49', 1263.16, 0, '17336.14', '17663.30', '-14315.92', '-20769.16', '33.47', '33.47');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_details`
--

CREATE TABLE `payroll_details` (
  `id` bigint(20) NOT NULL,
  `payroll_id` bigint(20) DEFAULT NULL,
  `allowance_id` bigint(20) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT AS `1 for allownace, 0 for deduction and 2 for expenses`,
  `name` varchar(255) DEFAULT NULL,
  `percentage` double DEFAULT NULL,
  `charge` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll_details`
--

INSERT INTO `payroll_details` (`id`, `payroll_id`, `allowance_id`, `type`, `name`, `percentage`, `charge`) VALUES
(1, 5, 10, 1, 'Goodday', 5, NULL),
(2, 5, 11, 1, '50-50', 2, NULL),
(3, 5, 12, 1, 'karkjack', 3, NULL),
(4, 5, 13, 0, 'britannia', 2.5, NULL),
(5, 5, 14, 1, 'Final.Test1', 0, NULL),
(6, 5, 15, 0, 'Final.Test2', 0, NULL),
(7, 5, 16, 1, 'Final.T1', 0, NULL),
(8, 5, 17, 0, 'Final.T2', 0, NULL),
(9, 5, 18, 1, 'Final.T3', 0, NULL),
(10, 5, 19, 0, 'Final.T4', 0, NULL),
(11, 6, 2, 0, 'Food allowance', 5, NULL),
(12, 6, 4, 1, 'Tet31', 12, NULL),
(13, 6, 5, 0, 'Pension Funds', 7.75, NULL),
(14, 6, 6, 0, 'Housing Funds', 3, NULL),
(15, 6, 7, 1, 'Meal Allowance', 2, NULL),
(16, 6, 8, 1, 'Test1', 5, NULL),
(17, 6, 9, 0, 'test2', 1, NULL),
(18, 6, 16, 1, 'Final.T1', 10, NULL),
(19, 6, 17, 0, 'Final.T2', 5, NULL),
(20, 5, 20, 1, 't1', 0, NULL),
(21, 6, 20, 1, 't1', 0, NULL),
(22, 5, 21, 0, 't2', 0, NULL),
(23, 6, 21, 0, 't2', 0, NULL),
(24, 5, 22, 1, 'Mass', 0, NULL),
(25, 6, 22, 1, 'Mass', 0, NULL),
(26, 7, 2, 0, 'Food allowance', 5, NULL),
(27, 7, 4, 1, 'Tet31', 12, NULL),
(28, 7, 5, 0, 'Pension Funds', 7.75, NULL),
(29, 7, 6, 0, 'Housing Funds', 3, NULL),
(30, 7, 7, 1, 'Meal Allowance', 2, NULL),
(31, 7, 8, 1, 'Test1', 5, NULL),
(32, 7, 9, 0, 'test2', 1, NULL),
(33, 7, 17, 0, 'Final.T2', 5, NULL),
(34, 7, 20, 1, 't1', 2, NULL),
(35, 7, 21, 0, 't2', 4, NULL),
(36, 8, 2, 0, 'Food allowance', 5, NULL),
(37, 8, 4, 1, 'Tet31', 12, NULL),
(38, 8, 5, 0, 'Pension Funds', 7.75, NULL),
(39, 8, 6, 0, 'Housing Funds', 3, NULL),
(40, 8, 7, 1, 'Meal Allowance', 2, NULL),
(41, 8, 8, 1, 'Test1', 5, NULL),
(42, 8, 9, 0, 'test2', 1, NULL),
(43, 8, 17, 0, 'Final.T2', 5, NULL),
(44, 8, 20, 1, 't1', 2, NULL),
(45, 8, 21, 0, 't2', 4, NULL),
(46, 8, 4, 2, 'Street fighter', 0, 6500),
(47, 9, 2, 0, 'Food allowance', 5, NULL),
(48, 9, 4, 1, 'Tet31', 12, NULL),
(49, 9, 5, 0, 'Pension Funds', 7.75, NULL),
(50, 9, 6, 0, 'Housing Funds', 3, NULL),
(51, 9, 7, 1, 'Meal Allowance', 2, NULL),
(52, 9, 8, 1, 'Test1', 5, NULL),
(53, 9, 9, 0, 'test2', 1, NULL),
(54, 9, 17, 0, 'Final.T2', 5, NULL),
(55, 9, 20, 1, 't1', 2, NULL),
(56, 9, 21, 0, 't2', 4, NULL),
(57, 5, 23, 0, 'Pension Funds', 0, NULL),
(58, 6, 23, 0, 'Pension Funds', 0, NULL),
(59, 7, 23, 0, 'Pension Funds', 0, NULL),
(60, 8, 23, 0, 'Pension Funds', 0, NULL),
(61, 9, 23, 0, 'Pension Funds', 0, NULL),
(62, 10, 2, 0, 'Food allowance', 5, NULL),
(63, 10, 4, 1, 'Tet31', 12, NULL),
(64, 10, 5, 0, 'Pension Funds', 7.75, NULL),
(65, 10, 6, 0, 'Housing Funds', 3, NULL),
(66, 10, 7, 1, 'Meal Allowance', 2, NULL),
(67, 10, 8, 1, 'Test1', 5, NULL),
(68, 10, 9, 0, 'test2', 1, NULL),
(69, 10, 17, 0, 'Final.T2', 5, NULL),
(70, 10, 20, 1, 't1', 2, NULL),
(71, 10, 21, 0, 't2', 4, NULL),
(72, 10, 23, 0, 'Pension Funds', 8, NULL),
(73, 11, 18, 1, 'Final.T3', 15, NULL),
(74, 11, 19, 0, 'Final.T4', 7, NULL),
(75, 5, 24, 0, 'Pension Fund', 0, NULL),
(76, 6, 24, 0, 'Pension Fund', 0, NULL),
(77, 7, 24, 0, 'Pension Fund', 0, NULL),
(78, 8, 24, 0, 'Pension Fund', 0, NULL),
(79, 9, 24, 0, 'Pension Fund', 0, NULL),
(80, 10, 24, 0, 'Pension Fund', 0, NULL),
(81, 11, 24, 0, 'Pension Fund', 0, NULL),
(82, 12, 1, 1, 'Housing Allowance', 30, NULL),
(83, 12, 2, 1, 'Transport Allowance', 15, NULL),
(84, 12, 3, 1, 'Utility Allowance', 15, NULL),
(85, 12, 4, 0, 'Pension Fund', 0, NULL),
(86, 12, 5, 0, 'N.H. Fund', 0, NULL),
(87, 12, 6, 0, 'NSITF', 0, NULL),
(88, 13, 0, 1, 'Housing Allowance', 0, 9600),
(89, 13, 0, 1, 'Transport Allowance', 0, 4800),
(90, 13, 0, 1, 'Utility Allowance', 0, 4800),
(91, 13, 0, 0, 'Pension Fund', 0, 2176),
(92, 13, 0, 0, 'N.H. Fund', 0, 320),
(93, 13, 0, 0, 'NSITF', 0, 320),
(94, 5, 31, 1, 'Test', 0, NULL),
(95, 6, 31, 1, 'Test', 0, NULL),
(96, 7, 31, 1, 'Test', 0, NULL),
(97, 8, 31, 1, 'Test', 0, NULL),
(98, 9, 31, 1, 'Test', 0, NULL),
(99, 10, 31, 1, 'Test', 0, NULL),
(100, 11, 31, 1, 'Test', 0, NULL),
(101, 5, 32, 1, 'Test2', 0, NULL),
(102, 6, 32, 1, 'Test2', 0, NULL),
(103, 7, 32, 1, 'Test2', 0, NULL),
(104, 8, 32, 1, 'Test2', 0, NULL),
(105, 9, 32, 1, 'Test2', 0, NULL),
(106, 10, 32, 1, 'Test2', 0, NULL),
(107, 11, 32, 1, 'Test2', 0, NULL),
(108, 14, 0, 1, 'Housing Allowance', 0, 32215.91),
(109, 14, 0, 1, 'Transport Allowance', 0, 16107.96),
(110, 14, 0, 1, 'Utility Allowance', 0, 16107.96),
(111, 14, 0, 1, 'Test2', 0, 6443.18),
(112, 14, 0, 0, 'Pension Fund', 0, 7302.27),
(113, 14, 0, 0, 'N.H. Fund', 0, 1073.86),
(114, 14, 0, 0, 'NSITF', 0, 1138.3),
(115, 14, 0, 0, 'Test', 0, 1610.8),
(116, 15, 0, 1, 'Housing Allowance', 0, 32215.91),
(117, 15, 0, 1, 'Transport Allowance', 0, 16107.96),
(118, 15, 0, 1, 'Utility Allowance', 0, 16107.96),
(119, 15, 0, 1, 'Test2', 0, 6443.18),
(120, 15, 0, 0, 'Pension Fund', 0, 7302.27),
(121, 15, 0, 0, 'N.H. Fund', 0, 1073.86),
(122, 15, 0, 0, 'NSITF', 0, 1138.3),
(123, 15, 0, 0, 'Test', 0, 1610.8),
(124, 16, 0, 1, 'Housing Allowance', 0, 0),
(125, 16, 0, 1, 'Transport Allowance', 0, 0),
(126, 16, 0, 1, 'Utility Allowance', 0, 0),
(127, 16, 0, 1, 'Test2', 0, 0),
(128, 16, 0, 0, 'Pension Fund', 0, 0),
(129, 16, 0, 0, 'N.H. Fund', 0, 0),
(130, 16, 0, 0, 'NSITF', 0, 0),
(131, 16, 0, 0, 'Test', 0, 0),
(132, 17, 0, 1, 'Housing Allowance', 0, 0),
(133, 17, 0, 1, 'Transport Allowance', 0, 0),
(134, 17, 0, 1, 'Utility Allowance', 0, 0),
(135, 17, 0, 1, 'Test2', 0, 0),
(136, 17, 0, 0, 'Pension Fund', 0, 0),
(137, 17, 0, 0, 'N.H. Fund', 0, 0),
(138, 17, 0, 0, 'NSITF', 0, 0),
(139, 17, 0, 0, 'Test', 0, 0),
(140, 19, 0, 1, 'Housing Allowance', NULL, 0),
(141, 19, 0, 1, 'Transport Allowance', NULL, 0),
(142, 19, 0, 1, 'Utility Allowance', NULL, 0),
(143, 19, 0, 1, 'Test2', NULL, 0),
(144, 19, 0, 0, 'Pension Fund', NULL, 0),
(145, 19, 0, 0, 'N.H. Fund', NULL, 0),
(146, 19, 0, 0, 'NSITF', NULL, 0),
(147, 19, 0, 0, 'Test', NULL, 0),
(148, 20, 0, 1, 'Housing Allowance', NULL, 0),
(149, 20, 0, 1, 'Transport Allowance', NULL, 0),
(150, 20, 0, 1, 'Utility Allowance', NULL, 0),
(151, 20, 0, 1, 'Test2', NULL, 0),
(152, 20, 0, 0, 'Pension Fund', NULL, 0),
(153, 20, 0, 0, 'N.H. Fund', NULL, 0),
(154, 20, 0, 0, 'NSITF', NULL, 0),
(155, 20, 0, 0, 'Test', NULL, 0),
(156, 21, 0, 1, 'Housing Allowance', NULL, 947.37),
(157, 21, 0, 1, 'Transport Allowance', NULL, 473.69),
(158, 21, 0, 1, 'Utility Allowance', NULL, 473.69),
(159, 21, 0, 1, 'Test2', NULL, 189.47),
(160, 21, 0, 0, 'Pension Fund', NULL, 214.74),
(161, 21, 0, 0, 'N.H. Fund', NULL, 31.58),
(162, 21, 0, 0, 'NSITF', NULL, 33.47),
(163, 21, 0, 0, 'Test', NULL, 47.37),
(164, 21, 1, 2, 'test expense', NULL, 500);

-- --------------------------------------------------------

--
-- Table structure for table `prof_histories`
--

CREATE TABLE `prof_histories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` varchar(200) NOT NULL,
  `date_joined` date NOT NULL,
  `till` date NOT NULL,
  `mode` varchar(100) NOT NULL,
  `prof_number` varchar(20) NOT NULL,
  `certificate` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prof_histories`
--

INSERT INTO `prof_histories` (`id`, `user_id`, `body`, `date_joined`, `till`, `mode`, `prof_number`, `certificate`, `created_at`, `updated_at`) VALUES
(1, 42, 'Computer Professionals of Nigeria', '2016-12-13', '2016-12-21', '2', '234A5', '4280194.jpg', '2016-12-02 22:01:23', '2016-12-02 22:01:23'),
(2, 42, 'Cisco', '2016-12-07', '2016-12-28', '2', 'AD20347', '4271508.png', '2016-12-05 21:41:20', '2016-12-05 21:41:20'),
(3, 31, 'fliuvhiuh', '2016-12-13', '2016-12-19', '4', '', '3131024.jpg', '2016-12-09 18:02:57', '2016-12-09 18:02:57'),
(4, 170, 'dfdfxdsdfsdcfsc', '2016-12-05', '2016-12-19', '3', 'sdasdasd3q2e', '17047436.PNG', '2016-12-20 17:57:07', '2016-12-20 17:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_est_date` date DEFAULT NULL,
  `actual_ending_date` date DEFAULT NULL,
  `assigned_to_id` int(11) DEFAULT NULL,
  `project_task_id` int(11) DEFAULT NULL,
  `remark` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lm_id` int(8) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `code`, `start_date`, `end_est_date`, `actual_ending_date`, `assigned_to_id`, `project_task_id`, `remark`, `client_id`, `created_at`, `updated_at`, `lm_id`, `status`) VALUES
(1, 'Afriuinvest', '252', '2017-02-02', '2017-05-31', '1970-01-01', 1, NULL, 'Some lorem ipseum lorem ipseumxsddwedwdwdwdw3rw3', 1, '2017-02-28 11:01:23', '2017-03-01 17:39:07', NULL, 0),
(2, 'Afriuinvest2', '252', '2017-02-02', '2017-05-31', '2017-02-28', 1, NULL, 'Some lorem ipseum lorem ipseumxsddwedwdwdwdw3rw3', 1, '2017-02-28 16:09:16', '2017-02-28 16:57:07', NULL, 1),
(4, 'Afriuinvest', '252', '2017-02-02', '2017-05-31', '1970-01-01', 3, NULL, 'Some lorem ipseum lorem ipseumxsddwedwdwdwdw3rw3', 1, '2017-02-28 17:58:40', '2017-03-01 17:37:58', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `public_holidays`
--

CREATE TABLE `public_holidays` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `public_holidays`
--

INSERT INTO `public_holidays` (`id`, `title`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'Independence Day', '2016-11-20', '2016-11-25', '2016-11-15 14:31:00', '2016-12-16 12:34:41'),
(2, 'Christmas Break', '2016-12-20', '2016-12-30', '2016-11-15 14:56:00', '2016-11-15 14:56:00'),
(3, 'ertgr', '2016-12-13', '2016-12-29', '2016-12-16 05:50:29', '2016-12-16 05:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(10) UNSIGNED NOT NULL,
  `query_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lm_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `new` int(11) DEFAULT NULL,
  `empnew` int(11) NOT NULL,
  `lmnew` int(11) NOT NULL DEFAULT '0',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `document` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `query_type_id`, `user_id`, `lm_id`, `created_at`, `updated_at`, `status`, `new`, `empnew`, `lmnew`, `content`, `document`) VALUES
(1, 1, 1, 1, '2016-11-29 23:00:00', '2016-12-13 03:26:29', 1, 0, 0, 0, 'I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the wghghgggghriting was so good I asked for the full that very same day. Strong writing really does catch my attention.I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.<br>I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.', NULL),
(2, 1, 3, 1, '2016-11-29 23:00:00', '2016-12-21 07:18:16', 0, 0, 0, 0, 'I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the wghghgggghriting was so good I asked for the full that very same day. Strong writing really does catch my attention.I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.<br>I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.', NULL),
(15, 0, 1, 1, '2016-12-05 12:46:00', '2016-12-13 03:26:16', 1, NULL, 0, 0, 'doc', 'queries/6e6301c674c0b006648fe2f4a6194f91.jpeg'),
(17, 1, 6, 1, '2016-12-05 14:21:39', '2016-12-05 14:21:39', 0, NULL, 1, 0, 'I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.<br>I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.', NULL),
(18, 2, 2, 1, '2016-12-06 15:40:35', '2016-12-31 15:20:42', 1, NULL, 0, 0, 'Poor Performance', NULL),
(19, 1, 2, 1, '2016-12-06 17:18:27', '2016-12-21 08:55:54', 1, NULL, 0, 0, 'I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.<br>I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.', NULL),
(25, 1, 1, 1, '2016-12-31 15:04:47', '2016-12-31 15:04:47', 0, NULL, 1, 0, 'I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.<br>I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.', NULL),
(20, 0, 2, 1, '2016-12-06 17:23:15', '2016-12-21 08:55:49', 1, NULL, 0, 0, 'doc', 'queries/6e6301c674c0b006648fe2f4a6194f91.jpeg'),
(21, 1, 2, 1, '2016-12-11 13:19:58', '2016-12-11 13:19:58', 0, NULL, 1, 0, 'I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.<br>I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.', NULL),
(22, 1, 1, 1, '2016-12-14 07:43:58', '2016-12-14 07:43:58', 0, NULL, 1, 0, 'I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.<br>I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.', NULL),
(23, 1, 1, 1, '2016-12-17 16:55:32', '2016-12-17 16:55:32', 0, NULL, 1, 0, 'I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.<br>I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.', NULL),
(24, 1, 1, 1, '2016-12-19 12:06:25', '2016-12-19 12:06:25', 0, NULL, 1, 0, 'I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.<br>I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.', NULL),
(26, 1, 1, 1, '2016-12-31 15:04:48', '2016-12-31 15:04:48', 0, NULL, 1, 0, 'I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.<br>I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.', NULL),
(27, 1, 2, 1, '2017-01-06 11:46:26', '2017-01-06 11:46:26', 0, NULL, 1, 0, 'I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.<br>I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `query_threads`
--

CREATE TABLE `query_threads` (
  `id` int(10) UNSIGNED NOT NULL,
  `query_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `emp_id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `query_threads`
--

INSERT INTO `query_threads` (`id`, `query_id`, `comment`, `created_at`, `updated_at`, `emp_id`) VALUES
(1, 1, 'cjkdhrfjkrhfrjkfrh', '2016-12-01 23:00:00', '2016-12-20 23:00:00', 2),
(2, 1, 'cjkdhrfjkrhfrjkfrh', '2016-12-01 23:00:00', '2016-12-20 23:00:00', 1),
(15, 1, 'hwedjewdwefefefe', '2016-12-06 13:56:56', '2016-12-06 13:56:56', 1),
(14, 1, 'I have a valid reason to come late', '2016-12-06 13:53:20', '2016-12-06 13:53:20', 1),
(16, 15, 'cfurfyufyufierjkyfererfuerfyeu  ', '2016-12-06 14:43:31', '2016-12-06 14:43:31', 1),
(17, 15, '  djkdferj  ', '2016-12-06 14:43:56', '2016-12-06 14:43:56', 1),
(18, 15, 'dghdgdfgdghd', '2016-12-06 14:56:27', '2016-12-06 14:56:27', 1),
(19, 15, '  sdcedcvner  ', '2016-12-06 15:08:49', '2016-12-06 15:08:49', 1),
(20, 18, 'I perform well', '2016-12-06 15:42:04', '2016-12-06 15:42:04', 2),
(31, 20, 'Ok accepted', '2016-12-06 17:25:03', '2016-12-06 17:25:03', 1),
(30, 20, 'gferfjkegfgfjhgferjh  ', '2016-12-06 17:24:21', '2016-12-06 17:24:21', 2),
(29, 19, '  asdj,kxqwjwej  ', '2016-12-06 17:18:53', '2016-12-06 17:18:53', 2),
(28, 18, 'jkjhkj', '2016-12-06 16:56:31', '2016-12-06 16:56:31', 1),
(27, 18, 'Its is a lie', '2016-12-06 16:44:42', '2016-12-06 16:44:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `query_types`
--

CREATE TABLE `query_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `query_types`
--

INSERT INTO `query_types` (`id`, `title`, `template`, `created_at`, `updated_at`) VALUES
(1, 'Lateness', 'I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.<br>I’ve been reading slush pile queries for 8 years and can honestly say this is one of the strongest queries I’ve ever read. I get an immediate sense of the world, the stakes, the characters and the conflict. I remember when this came in – the writing was so good I asked for the full that very same day. Strong writing really does catch my attention.', '2016-11-08 23:00:00', '2016-11-28 23:00:00'),
(2, 'Performance', 'lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem ', '2016-11-08 23:00:00', '2016-12-12 12:37:33'),
(4, 'Insubordination', 'lorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dolelorem ipseum dole', '2016-12-12 11:39:18', '2016-12-12 13:04:21'),
(5, 'test', 'testedee efu ef efe fe', '2016-12-12 13:05:03', '2016-12-12 13:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `content`) VALUES
(22, 'What is Biology'),
(21, 'What is Economics');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `goal_id` int(11) NOT NULL,
  `lm_rate` int(11) NOT NULL DEFAULT '0',
  `lm_id` int(11) NOT NULL,
  `lm_comment` varchar(6000) COLLATE utf8_unicode_ci NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `admin_rate` int(11) NOT NULL DEFAULT '0',
  `admin_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `emp_id`, `goal_id`, `lm_rate`, `lm_id`, `lm_comment`, `admin_id`, `admin_rate`, `admin_comment`, `created_at`, `updated_at`) VALUES
(6, 2, 8, 4, 2, 'lova', 6, 3, 'nhmbnm', '2016-11-10 23:23:00', '2016-11-11 15:00:00'),
(5, 2, 1, 4, 2, 'gjhfyhgjh', 6, 3, 'nhmbnmjhhhhhhhhhhh', '2016-11-10 23:23:00', '2016-11-11 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `references`
--

CREATE TABLE `references` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ref_title` varchar(5) NOT NULL,
  `ref_name` varchar(200) NOT NULL,
  `ref_prof` varchar(200) NOT NULL,
  `ref_addr` text NOT NULL,
  `ref_city` varchar(100) NOT NULL,
  `ref_state_id` int(11) NOT NULL,
  `ref_country_id` int(11) NOT NULL,
  `ref_email` varchar(100) NOT NULL,
  `ref_phone` varchar(14) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `references`
--

INSERT INTO `references` (`id`, `user_id`, `ref_title`, `ref_name`, `ref_prof`, `ref_addr`, `ref_city`, `ref_state_id`, `ref_country_id`, `ref_email`, `ref_phone`, `created_at`, `updated_at`) VALUES
(1, 42, '1', 'Sango Durosimi', 'Accountant', '5, Ebinpejo Lane, Idu-mota, Lagos', 'Lagos', 25, 149, 'perusal@microsoft.com', '08107654663', '2016-12-06 13:04:08', '2016-12-06 13:04:08'),
(2, 42, '1', 'Sango Durosimi', 'Song writer', '13 Symphony avenue', 'Lagos', 25, 179, 'perusal@microsoft.com', '08107654663', '2016-12-06 13:04:59', '2016-12-06 13:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `rightmanagements`
--

CREATE TABLE `rightmanagements` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `attendance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `goal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `settings` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `record` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payroll` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `talent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `execview` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `training` int(1) NOT NULL,
  `succession` int(1) NOT NULL,
  `query` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rightmanagements`
--

INSERT INTO `rightmanagements` (`id`, `user_id`, `attendance`, `goal`, `settings`, `record`, `payroll`, `talent`, `execview`, `created_at`, `updated_at`, `training`, `succession`, `query`) VALUES
(4, 2, '1', '1', '0', '0', '0', '0', '0', '2017-01-17 05:45:21', '2017-02-07 07:01:52', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `start_year` int(11) NOT NULL,
  `end_year` int(11) NOT NULL,
  `degree` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `user_id`, `name`, `start_year`, `end_year`, `degree`, `created_at`, `updated_at`) VALUES
(1, 42, 'Elihans College', 2007, 2010, 4, '2016-12-02 11:17:12', '2016-12-02 11:17:12'),
(2, 42, 'Dowen College', 2011, 2015, 2, '2016-12-05 21:36:01', '2016-12-05 21:36:01'),
(3, 31, 'dfsjdsujhj', 1980, 1985, 2, '2016-12-09 18:00:35', '2016-12-09 18:00:35'),
(4, 1, 'c hjdgcfefe', 1980, 1980, 1, '2016-12-09 19:20:11', '2016-12-09 19:20:11'),
(5, 170, 'eeetet4t4t4t', 1980, 1980, 1, '2016-12-20 17:31:30', '2016-12-20 17:31:30'),
(6, 171, 'sdfcxdcvx', 1980, 1980, 2, '2016-12-20 18:46:23', '2016-12-20 18:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `payslip_logo` varchar(255) NOT NULL,
  `watermark_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `payslip_logo`, `watermark_text`) VALUES
(1, '1488473190.jpg', 'HCMatrix');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `proficiency_id` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `user_id`, `skill_id`, `proficiency_id`, `created_at`, `updated_at`) VALUES
(1, 42, 1, 1, '2016-12-06 04:05:49', '2016-12-06 04:05:49'),
(2, 42, 2, 5, '2016-12-06 04:06:01', '2016-12-06 04:06:01'),
(3, 42, 1, 3, '2016-12-06 05:01:51', '2016-12-06 05:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `state` varchar(20) NOT NULL,
  `capital` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state`, `capital`, `created_at`, `updated_at`) VALUES
(1, 'Abia', 'Umuahia', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(2, 'Adamawa', 'Yola', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(3, 'Akwa Ibom', 'Uyo', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(4, 'Anambra', 'Awka', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(5, 'Bauchi', 'Bauchi', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(6, 'Bayelsa', 'Yenagoa', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(7, 'Benue', 'Markudi', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(8, 'Borno', 'Maiduguri', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(9, 'Cross River', 'Calabar', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(10, 'Delta', 'Asaba', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(11, 'Ebonyi', 'Abakaliki', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(12, 'Edo', 'Benin City', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(13, 'Ekiti', 'Ado Ekiti', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(14, 'Enugu', 'Enugu', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(15, 'FCT', 'Abuja', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(16, 'Gombe', 'Gombe', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(17, 'Imo', 'Owerri', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(18, 'Jigawa', 'Dutse', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(19, 'Kaduna', 'Kaduna', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(20, 'Kano', 'Kano', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(21, 'Katsina', 'Katsina', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(22, 'Kebbi', 'Birnin Kebbi', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(23, 'Kogi', 'Lokoja', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(24, 'Kwara', 'Ilorin', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(25, 'Lagos', 'Ikeja', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(26, 'Nasarawa', 'Lafia', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(27, 'Niger', 'Minna', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(28, 'Ogun', 'Abeokuta', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(29, 'Ondo', 'Akure', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(30, 'Osun', 'Osogbo', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(31, 'Oyo', 'Ibadan', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(32, 'Pleatau', 'Jos', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(33, 'Rivers', 'Port Harcourt', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(34, 'Sokoto', 'Sokoto', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(35, 'Taraba', 'Jalingo', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(36, 'Yobe', 'Damaturu', '2016-11-25 07:10:36', '2016-11-25 07:10:36'),
(37, 'Zamfara', 'Gusau', '2016-11-25 07:10:36', '2016-11-25 07:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(2) NOT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject`, `created_at`, `updated_at`) VALUES
(1, 'Agricultural Science ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(2, 'Animal Husbandry', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(4, 'Auto Body Repairs And Spray Painting ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(5, 'Auto Electrical Work ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(6, 'Auto Mechanics ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(7, 'Auto Mechanical Work ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(8, 'Basic Electronics', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(10, 'Biology ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(11, 'Auto Parts Merchandising ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(12, 'Business Management ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(13, 'Book Keeping ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(14, 'Block Laying Brick Laying And Concreting ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(15, 'Basketry ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(16, 'Building Construction ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(17, 'Catering Craft Practice ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(18, 'Carpentry And Joinery ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(19, 'Ceramics ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(20, 'Christian Religious Studies ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(21, 'Civic Education ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(22, 'Chemistry ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(23, 'Clothing And Textiles ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(24, 'General Mathematics ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(25, 'Commerce ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(26, 'Computer Studies ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(27, 'Cosmetology ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(28, 'Cost Accounting', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(29, 'Crop Husbandry And Horticulture ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(30, 'Data Processing ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(31, 'Economics ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(32, 'Efik ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(33, 'Further Mathematics ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(34, 'Electrical Installation And Maintenance Work ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(35, 'Electronics ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(36, 'English Language', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(38, 'Arabic Examination Scheme', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(39, 'Arabic ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(40, 'Arabic List Of Selected Texts', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(41, 'Financial Accounting ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(42, 'Fisheries', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(44, 'Food And Nutrition ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(45, 'Forestry ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(46, 'French ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(47, 'Furniture Making ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(48, 'General Knowledge In Art ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(49, 'Geography ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(50, 'Ghanaian Languages ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(51, 'Government ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(52, 'Graphic Design ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(53, 'GSM Phones Maintenance And Repairs ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(54, 'Hausa ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(55, 'Health Education ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(56, 'History ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(57, 'Home Management ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(58, 'Ibibio ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(59, 'Igbo ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(60, 'Information And Communication Technology', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(62, 'Insurance ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(63, 'Integrated Science ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(64, 'Islamic Studies ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(65, 'Jewellery ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(66, 'Leather Goods ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(67, 'Leatherwork ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(68, 'Literature In English ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(69, 'Machine Woodworking ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(70, 'Marketing ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(71, 'Metalwork ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(72, 'Mining ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(73, 'Office Practice ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(74, 'Painting And Decorating ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(75, 'Photography ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(76, 'Physical Education ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(77, 'Physics ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(78, 'Picture Making ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(79, 'Printing Craft Practise ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(80, 'Radio Television And Electronics Works ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(81, 'Refrigeration And Air-conditioning ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(82, 'Salesmanship ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(83, 'Sculpture ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(84, 'Shorthand ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(85, 'Social Studies ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(86, 'Store Keeping ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(87, 'Store Management ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(88, 'Technical Drawing ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(89, 'Textiles ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(90, 'Tourism ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(91, 'Upholstery ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(92, 'Visual Art ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(93, 'Welding And Fabrication Engineering Craft Practice ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(94, 'West African Traditional Religion (W.A.T.R) ', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(95, 'Woodwork  General', '2016-11-24 12:57:00', '2016-11-24 12:58:00'),
(97, 'Yoruba ', '2016-11-24 12:57:00', '2016-11-24 12:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `subject_grades`
--

CREATE TABLE `subject_grades` (
  `id` int(11) NOT NULL,
  `grade` char(2) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `start_per` int(11) NOT NULL,
  `end_per` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_grades`
--

INSERT INTO `subject_grades` (`id`, `grade`, `remark`, `start_per`, `end_per`, `created_at`, `updated_at`) VALUES
(1, 'A1', 'EXCELLENT', 75, 100, '2016-11-24 13:32:00', '2016-11-24 13:32:00'),
(2, 'B2', 'VERY GOOD', 70, 74, '2016-11-24 13:32:00', '2016-11-24 13:32:00'),
(3, 'B3', 'GOOD', 65, 69, '2016-11-24 13:32:00', '2016-11-24 13:32:00'),
(4, 'C4', 'CREDIT', 60, 64, '2016-11-24 13:32:00', '2016-11-24 13:32:00'),
(5, 'C5', 'CREDIT', 55, 59, '2016-11-24 13:32:00', '2016-11-24 13:32:00'),
(6, 'C6', 'CREDIT', 50, 54, '2016-11-24 13:32:00', '2016-11-24 13:32:00'),
(7, 'D7', 'PASS', 45, 49, '2016-11-24 13:32:00', '2016-11-24 13:32:00'),
(8, 'E8', 'PASS', 40, 45, '2016-11-24 13:32:00', '2016-11-24 13:32:00'),
(9, 'F9', 'FAILURE', 0, 44, '2016-11-24 13:32:00', '2016-11-24 13:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `subject_takens`
--

CREATE TABLE `subject_takens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_takens`
--

INSERT INTO `subject_takens` (`id`, `user_id`, `exam_id`, `subject_id`, `grade_id`, `created_at`, `updated_at`) VALUES
(1, 42, 4, 24, 1, '2016-12-07 08:49:40', '2016-12-07 08:49:40'),
(2, 42, 4, 36, 2, '2016-12-07 08:52:53', '2016-12-07 08:52:53'),
(3, 42, 4, 77, 4, '2016-12-07 08:52:53', '2016-12-07 08:52:53'),
(4, 42, 4, 22, 9, '2016-12-07 08:52:53', '2016-12-07 08:52:53'),
(5, 42, 4, 10, 6, '2016-12-07 08:52:53', '2016-12-07 08:52:53'),
(6, 42, 4, 33, 7, '2016-12-07 08:52:53', '2016-12-07 08:52:53'),
(7, 42, 2, 7, 1, '2016-12-07 09:02:30', '2016-12-07 09:02:30'),
(8, 42, 2, 12, 1, '2016-12-07 09:02:30', '2016-12-07 09:02:30'),
(9, 42, 2, 66, 1, '2016-12-07 09:02:30', '2016-12-07 09:02:30'),
(10, 42, 2, 2, 1, '2016-12-07 09:02:30', '2016-12-07 09:02:30'),
(11, 42, 2, 20, 1, '2016-12-07 09:02:30', '2016-12-07 09:02:30'),
(12, 42, 2, 54, 1, '2016-12-07 09:02:30', '2016-12-07 09:02:30'),
(13, 31, 2, 4, 1, '2016-12-09 18:22:18', '2016-12-09 18:22:18'),
(14, 31, 2, 24, 3, '2016-12-09 18:22:18', '2016-12-09 18:22:18'),
(15, 31, 2, 77, 7, '2016-12-09 18:22:18', '2016-12-09 18:22:18'),
(16, 31, 2, 22, 4, '2016-12-09 18:22:18', '2016-12-09 18:22:18'),
(17, 31, 2, 10, 9, '2016-12-09 18:22:18', '2016-12-09 18:22:18'),
(18, 31, 2, 21, 6, '2016-12-09 18:22:18', '2016-12-09 18:22:18'),
(19, 1, 2, 1, 1, '2016-12-10 05:58:12', '2016-12-10 05:58:12'),
(20, 170, 2, 1, 1, '2016-12-20 17:55:55', '2016-12-20 17:55:55'),
(21, 170, 2, 14, 1, '2016-12-20 17:55:55', '2016-12-20 17:55:55'),
(22, 170, 2, 26, 1, '2016-12-20 17:55:55', '2016-12-20 17:55:55'),
(23, 170, 2, 6, 1, '2016-12-20 17:55:55', '2016-12-20 17:55:55'),
(24, 170, 2, 69, 1, '2016-12-20 17:55:55', '2016-12-20 17:55:55'),
(25, 170, 2, 76, 1, '2016-12-20 17:55:55', '2016-12-20 17:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `successor_nominations`
--

CREATE TABLE `successor_nominations` (
  `id` bigint(20) NOT NULL,
  `people_manager_id` bigint(20) NOT NULL COMMENT '(People Manage who is nominating)',
  `employee_id` bigint(20) NOT NULL COMMENT '(Employee who is nominated)',
  `approval_status` tinyint(1) NOT NULL DEFAULT '0'COMMENT
) ;

--
-- Dumping data for table `successor_nominations`
--

INSERT INTO `successor_nominations` (`id`, `people_manager_id`, `employee_id`, `approval_status`, `readiness`, `training_requirements`, `nominated_on`, `candidate_type`, `name`, `address`, `email`, `phone_num`, `comments`, `vacancy_id`) VALUES
(1, 3, 2, 1, NULL, NULL, '2017-01-18 09:38:03', 0, NULL, NULL, NULL, NULL, 'Under Testing process', 1),
(2, 3, 45, 0, NULL, NULL, '2017-01-18 09:38:54', 0, NULL, NULL, NULL, NULL, 'Testing1', 1),
(3, 3, 7, 1, NULL, NULL, '2017-01-19 07:48:38', 0, NULL, NULL, NULL, NULL, 'We have nominated', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` int(8) NOT NULL,
  `froms` date NOT NULL,
  `tos` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `created_at`, `updated_at`, `project_id`, `froms`, `tos`, `status`) VALUES
(5, 'Assign 0365 license', '2017-02-28 12:57:19', '2017-02-28 14:24:08', 1, '2017-02-14', '2017-02-28', 1),
(6, 'Migrate Users to 365', '2017-02-28 13:04:34', '2017-03-01 19:59:48', 1, '2017-02-15', '2017-02-28', 0),
(8, 'Kill Bill', '2017-02-28 16:48:12', '2017-03-03 14:23:52', 2, '2017-02-16', '2017-02-28', 1),
(9, 'Smethign', '2017-03-01 17:19:13', '2017-03-01 17:34:49', 4, '2017-03-16', '2017-03-31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `taxation_slab`
--

CREATE TABLE `taxation_slab` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `min` decimal(20,4) NOT NULL,
  `max` decimal(20,4) NOT NULL,
  `charge_percentage` double NOT NULL,
  `amount` decimal(20,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxation_slab`
--

INSERT INTO `taxation_slab` (`id`, `name`, `min`, `max`, `charge_percentage`, `amount`) VALUES
(9, 'consolidated_allowances', '0.0000', '16666.5833', 20, '16666.6667'),
(10, 'consolidated_allowances', '16666.6667', '0.0000', 21, '0.0000'),
(11, 'tax_payable', '0.0000', '24999.9167', 7, '0.0000'),
(12, 'tax_payable', '25000.0000', '49999.9167', 11, '1750.0000'),
(13, 'tax_payable', '50000.0000', '91666.5833', 15, '4500.0000'),
(14, 'tax_payable', '91666.6667', '133333.2500', 19, '10750.0000'),
(15, 'tax_payable', '133333.3333', '266666.5833', 21, '18666.6667'),
(16, 'tax_payable', '266666.6667', '0.0000', 24, '46666.6667');

-- --------------------------------------------------------

--
-- Table structure for table `testscores`
--

CREATE TABLE `testscores` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_app_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testsettings`
--

CREATE TABLE `testsettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `duration` int(11) NOT NULL,
  `dispques` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `testsettings`
--

INSERT INTO `testsettings` (`id`, `duration`, `dispques`, `created_at`, `updated_at`) VALUES
(1, 100, 2, '2016-12-19 07:31:44', '2016-12-19 07:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `test_takens`
--

CREATE TABLE `test_takens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `test_taken` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_takens`
--

INSERT INTO `test_takens` (`id`, `user_id`, `job_id`, `test_taken`, `created_at`, `updated_at`) VALUES
(34, 2, 1, 1, '2017-01-04 11:34:35', '2017-01-04 11:34:35'),
(33, 2, 1, 1, '2017-01-04 11:34:33', '2017-01-04 11:34:33'),
(32, 2, 1, 1, '2017-01-04 11:34:32', '2017-01-04 11:34:32'),
(31, 2, 1, 1, '2017-01-04 11:34:30', '2017-01-04 11:34:30'),
(30, 2, 2, 1, '2017-01-04 08:48:13', '2017-01-04 08:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` bigint(20) NOT NULL,
  `job_role` bigint(20) NOT NULL,
  `training_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `location` tinytext NOT NULL,
  `capacity` int(11) NOT NULL,
  `created_by` bigint(20) NOT NULL COMMENT 'Admin User id who created this training',
  `created_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `job_role`, `training_name`, `start_date`, `end_date`, `location`, `capacity`, `created_by`, `created_date`, `status`) VALUES
(1, 1, 'Demo training', '2016-11-30', '2016-12-30', 'Las Vegas, NV, United States', 30, 6, '2016-11-23 07:41:56', 1),
(2, 1, 'Cisco', '2016-12-02', '2016-12-05', 'Lekki Leisure Lake, Eti-Osa, Lagos, Nigeria', 10, 6, '2016-11-23 16:25:09', 1),
(3, 1, 'training 2', '2016-12-01', '2017-02-28', 'Illinois, United States', 50, 6, '2016-11-24 06:37:11', 1),
(4, 1, 'training delete', '2016-12-01', '2017-02-28', 'Illinois, United States', 50, 6, '2016-11-24 06:37:11', 1),
(9, 1, 'How to Dab', '2016-11-07', '2016-11-21', 'Lekki Phase 1, Lekki, Lagos, Nigeria', 30, 6, '2016-11-28 11:13:54', 1),
(10, 1, 'Test', '2016-12-12', '2017-12-12', 'India', 25, 6, '2016-12-19 08:03:01', 1),
(11, 2, 'Test1', '2016-12-30', '2017-02-24', 'Coimbatore, Tamil Nadu, India', 10, 6, '2016-12-20 07:14:27', 1),
(12, 1, 'Test ', '2017-01-01', '2017-02-24', 'Tiruppur, Tamil Nadu, India', 5, 6, '2016-12-20 07:40:12', 1),
(13, 1, 'Test', '2016-12-30', '2017-02-09', 'Erode, Tamil Nadu, India', 18, 6, '2016-12-20 07:47:52', 1),
(15, 1, 'TEST.FRI', '2017-01-03', '2017-01-26', 'Kalapatti, Coimbatore, Tamil Nadu, India', 13, 6, '2016-12-22 05:27:03', 1),
(19, 1, 'test on jan', '2017-01-03', '2017-01-10', 'Coimbatore, Tamil Nadu, India', 15, 6, '2017-01-03 07:37:15', 1),
(20, 4, 'test factory employee training', '2017-01-07', '2017-02-14', 'Coimbatore, Tamil Nadu, India', 100, 6, '2017-01-04 10:25:14', 1),
(21, 1, 'UFT tool', '2017-01-07', '2017-01-30', 'Coimbatore, Tamil Nadu, India', 5, 6, '2017-01-07 02:47:17', 1),
(22, 4, 'Prakash', '2017-01-29', '2017-02-28', 'Peelamedu, Coimbatore, Tamil Nadu, India', 4, 6, '2017-01-19 04:51:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `training_atts`
--

CREATE TABLE `training_atts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `training_name` varchar(300) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `institution` varchar(200) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_atts`
--

INSERT INTO `training_atts` (`id`, `user_id`, `training_name`, `start_date`, `end_date`, `institution`, `location`, `created_at`, `updated_at`) VALUES
(1, 42, 'Cisco Certified Network Associate', '2016-12-12', '2016-12-19', 'NetIT', 'Abuja', '2016-12-06 05:10:35', '2016-12-06 05:10:35'),
(2, 42, 'Adobe Graphics Designer', '2016-12-11', '2016-12-19', 'New Horizon', 'Abuja', '2016-12-06 05:13:09', '2016-12-06 05:13:09'),
(3, 42, 'Adobe Illustrator Certified', '2016-12-11', '2016-12-19', 'New Horizon', 'Lagos', '2016-12-06 05:13:25', '2016-12-06 05:13:25'),
(4, 31, 'sdkuiiu', '2016-12-19', '2016-12-14', 'sdliuioujhiou', 'sdjfkdujhsd', '2016-12-09 18:03:22', '2016-12-09 18:03:22'),
(5, 170, 'erterfdfdf', '2016-12-05', '2016-12-20', 'sdfsdsxdcvd', 'sdfssdfsfs', '2016-12-20 17:57:36', '2016-12-20 17:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `training_materials`
--

CREATE TABLE `training_materials` (
  `id` bigint(20) NOT NULL,
  `training_id` bigint(20) NOT NULL,
  `training_material_name` varchar(255) NOT NULL,
  `training_material` varchar(255) NOT NULL,
  `reading_type` tinyint(1) NOT NULL COMMENT '0 if pre training reading, 1 if post training reading',
  `created_by` bigint(20) NOT NULL,
  `created_on` datetime NOT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_materials`
--

INSERT INTO `training_materials` (`id`, `training_id`, `training_material_name`, `training_material`, `reading_type`, `created_by`, `created_on`, `status`) VALUES
(1, 3, 'training material 1', '1480771484.pdf', 1, 6, '2016-11-24 06:42:51', 1),
(4, 10, 'Test1', '1482140704.pdf', 0, 6, '2016-12-19 09:45:04', 1),
(5, 11, 'Testing purpose', '1482218135.pdf', 1, 6, '2016-12-20 07:15:35', 1),
(6, 15, 'Diploma in testing', '1482386239.pdf', 1, 6, '2016-12-22 05:57:19', 0),
(7, 21, 'Functional&Regression Testing', '1483757316.pdf', 0, 6, '2017-01-07 02:48:36', 1),
(8, 22, 'Mechanical Tool', '1484801548.pdf', 0, 6, '2017-01-19 04:52:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `training_members`
--

CREATE TABLE `training_members` (
  `id` bigint(20) NOT NULL,
  `emp_id` bigint(20) NOT NULL,
  `training_id` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1-applied 2-approved 3-waiting 4-Not approved',
  `sync_status` int(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `approved_by` bigint(20) DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_members`
--

INSERT INTO `training_members` (`id`, `emp_id`, `training_id`, `status`, `sync_status`, `created_date`, `approved_by`, `approved_date`) VALUES
(1, 2, 1, 2, 0, '2016-11-24 05:59:41', 6, '2016-12-22 09:36:10'),
(2, 2, 2, 3, 1, '2016-11-24 12:17:28', 6, '2016-12-23 07:12:35'),
(3, 2, 4, 2, 1, '2016-11-24 12:17:28', NULL, NULL),
(4, 2, 3, 1, 0, '2016-12-13 10:38:45', NULL, NULL),
(5, 2, 10, 2, 1, '2016-12-20 03:52:10', 6, '2016-12-20 07:18:32'),
(6, 2, 9, 1, 0, '2016-12-20 07:13:21', NULL, NULL),
(7, 2, 12, 2, 1, '2016-12-20 07:45:55', 6, '2016-12-20 07:58:26'),
(8, 2, 13, 2, 1, '2016-12-20 09:16:47', 6, '2016-12-20 09:19:47'),
(9, 2, 15, 2, 1, '2016-12-22 07:05:23', 3, '2016-12-31 09:12:12'),
(10, 3, 11, 3, 0, '2016-12-30 10:02:27', 6, '2016-12-30 10:03:01'),
(11, 9, 15, 3, 1, '2016-12-31 09:14:04', 6, '2017-01-03 11:54:16'),
(12, 2, 19, 1, 0, '2017-01-03 07:58:08', 6, '2017-01-03 10:57:29'),
(13, 9, 21, 2, 1, '2017-01-07 02:58:27', 6, '2017-01-07 03:08:06'),
(14, 2, 21, 1, 0, '2017-01-18 15:27:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `training_survey`
--

CREATE TABLE `training_survey` (
  `id` bigint(20) NOT NULL,
  `training_id` bigint(20) NOT NULL,
  `survey_name` varchar(255) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer_option` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_survey`
--

INSERT INTO `training_survey` (`id`, `training_id`, `survey_name`, `total_questions`, `question`, `answer_option`, `status`, `created_by`, `created_date`) VALUES
(1, 4, 'survey name', 2, 'ques1^ques3', 'ans11^  ans12^  ans13^  ans14^^ans31^ ans32^ ans33^ ans34', 1, 6, '2016-11-25 06:47:29'),
(4, 10, 'test.sur', 2, 'how to identify the object^How an induction motor runs', 'a^b^c^d^^a^b^c^d^^', 1, 6, '2016-12-20 02:23:50'),
(11, 15, 'Arun', 1, 'Where it should be?', 'a^b^c^d^^', 1, 6, '2016-12-22 06:11:46'),
(12, 21, 'Doubt ', 2, 'What is the use of this course^What is the use of this course1', 'e^f^i^j^^k^l^m^n^^', 1, 6, '2017-01-07 02:50:05'),
(13, 22, 'How to lead a life', 1, 'rWhat is the use of working ', 'i^j^k^l^^', 1, 6, '2017-01-19 04:55:42');

-- --------------------------------------------------------

--
-- Table structure for table `training_survey_post`
--

CREATE TABLE `training_survey_post` (
  `id` bigint(20) NOT NULL COMMENT 'primary key',
  `training_id` bigint(20) NOT NULL COMMENT 'training table id',
  `survey_id` bigint(20) NOT NULL COMMENT 'survey table id',
  `emp_id` bigint(20) NOT NULL COMMENT 'employee id',
  `question` text NOT NULL COMMENT 'questions',
  `answer` text NOT NULL COMMENT 'answered options',
  `status` tinyint(1) DEFAULT NULL COMMENT AS `optional status`,
  `created_date` datetime NOT NULL COMMENT 'created date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_survey_post`
--

INSERT INTO `training_survey_post` (`id`, `training_id`, `survey_id`, `emp_id`, `question`, `answer`, `status`, `created_date`) VALUES
(1, 1, 1, 2, 'ques1^ques3', 'ans11^ans31', 1, '2016-11-25 11:47:15'),
(2, 10, 4, 2, 'how to identify the object^How an induction motor runs', 'b^b', 1, '2016-12-20 09:31:33'),
(3, 15, 11, 2, 'Where it should be?', 'c', 1, '2016-12-30 09:46:01'),
(4, 15, 11, 9, 'Where it should be?', 'b', 1, '2016-12-31 09:30:27'),
(5, 15, 11, 9, 'Where it should be?', 'b', 1, '2016-12-31 09:30:43'),
(6, 21, 12, 9, 'What is the use of this course^What is the use of this course1', 'a^a1', 1, '2017-01-07 03:31:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_num` int(8) DEFAULT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int(2) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_num` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marital_status` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u',
  `workdept_id` int(8) DEFAULT NULL,
  `job_id` int(2) DEFAULT NULL,
  `hiredate` date DEFAULT NULL,
  `role` int(1) NOT NULL DEFAULT '0',
  `EDLEVEL` int(8) DEFAULT NULL,
  `image` varchar(400) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'upload/avatar.jpg',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_promoted` date DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `next_of_kin` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_address` text COLLATE utf8_unicode_ci,
  `kin_phonenum` char(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kin_relationship` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dribble` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linemanager_id` int(11) NOT NULL DEFAULT '1',
  `job_app_id` int(11) DEFAULT NULL,
  `state_origin_id` int(11) DEFAULT NULL,
  `lga` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `locked` int(1) NOT NULL DEFAULT '0',
  `job_reg_status` int(2) NOT NULL DEFAULT '0',
  `superadmin` int(1) NOT NULL DEFAULT '0',
  `bank_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_num` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grade` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `emp_num`, `name`, `sex`, `dob`, `age`, `email`, `phone_num`, `marital_status`, `password`, `workdept_id`, `job_id`, `hiredate`, `role`, `EDLEVEL`, `image`, `remember_token`, `created_at`, `updated_at`, `last_promoted`, `address`, `next_of_kin`, `kin_address`, `kin_phonenum`, `kin_relationship`, `twitter`, `facebook`, `dribble`, `instagram`, `linemanager_id`, `job_app_id`, `state_origin_id`, `lga`, `status`, `locked`, `job_reg_status`, `superadmin`, `bank_name`, `sort_code`, `account_num`, `grade`) VALUES
(1, 101, 'Adedeji Adeloye', 'M', '2016-12-22', 0, 'adeloyedeji@gmail.com', '07036725297', 'single', '$2y$10$AXXprbo3HsvByI/qlXQ3BugTa1PfEVQvVJIbTB0/iM5HzbR42/3LW', 1, 1, NULL, 3, NULL, 'upload/1/076c89ddc5d7ee218e0e2b70eeea0ffa.jpeg', '95Xo5CivEsNwnW0KBSmafoq7XXfztddTaFLzE8hldaWIiOejWZWA1MlSCaWX', '2016-09-01 10:16:37', '2017-03-03 16:23:58', '2016-11-28', '        30, Richard Aigbe Crescent, Olomu Town off Isawo Road, Ikorodu, Abuja.', 'Saliu Jombo', '1B, Abayomi Shonuga Close, Lekki, Lagos State.', '08107654663', 'Daughter', NULL, NULL, NULL, NULL, 1, 0, 1, 'Eti-Osa', 0, 0, 0, 1, NULL, NULL, NULL, 2),
(2, 102, 'Olorunda Olaoluwa', 'M', '1993-03-04', 23, 'olaoluwa@snapnet.com.ng', '07036725298', '', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 2, NULL, 1, NULL, 'upload/avatar.jpg', 'udqf072zqPELYX2riPAbu5PgGUlfnKZmHvrMyTHJpIqfU0CARF4lDrABQqKm', '2016-09-03 05:18:10', '2017-02-08 15:55:20', '2016-12-14', '30, Richard Aigbe Crescent, Olomu Town off Isawo Road, Ikorodu, Lagos State.', '', '', '', '', NULL, NULL, NULL, NULL, 1, 0, 0, '', 0, 0, 1, 0, NULL, NULL, NULL, 1),
(3, 103, 'Thobo Oposo', 'M', '1994-01-01', 22, 'email@mail.com', '07036725298', 'single', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 2, NULL, 1, NULL, 'upload/avatar.jpg', 'z13umWpJ2TzFIxHfotTgXaxnO0s6HBLR14LmHn5LkPOc1qJJfk9H1GOxeSwT', '2016-09-05 07:45:16', '2017-02-28 18:04:59', '2016-11-28', '30, Richard Aigbe Crescent, Olomu Town off Isawo Road, Ikorodu, Lagos State.', 'Saliu Jombo', '1B, Abayomi Shonuga Close, Lekki, Lagos State', '08107654663', 'Daughter', NULL, NULL, NULL, NULL, 2, 0, 0, '', 0, 0, 1, 0, NULL, NULL, NULL, 2),
(4, 104, 'Aanuoluwa Ojelad', 'F', '1988-03-01', 28, 'aisha@snapnet.com.ng', '08066666666', 'single', '$2y$10$PzY32sxEW2MFGR7/h.pWeeytqrLSZXHDgSs.629x5knG6SaFlGxsa', 1, 2, NULL, 3, NULL, 'upload/avatar.jpg', 'LsN0P7qQ8ETihGgZUf5aTIL54sfKabNBFzD6W1PzqRWsg3Nb54OaU9Mcau7y', '2016-09-05 09:49:35', '2017-01-16 18:31:26', '2016-11-28', '30, Richard Aigbe Crescent, Olomu Town off Isawo Road, Ikorodu, Lagos State.', 'Saliu Jombo', '1B, Abayomi Shonuga Close, Lekki, Lagos State', '08107654663', 'Daughter', NULL, NULL, NULL, NULL, 2, 0, 0, '', 0, 0, 0, 0, NULL, NULL, NULL, 2),
(5, 105, 'Ambrose Peter', 'M', '2016-11-28', 0, 'efuie@gg.com', '07036725298', '', '$2y$10$a92MWSp7EhQG8AUUe8BBgevnJ0ntlLFX59k5DBgVxfDDijLZxllSW', 1, 2, NULL, 0, NULL, 'upload/avatar.jpg', 'jH27mwG6jN3ojhtcajriNQKrE8VlMml22e4bW3W2SUsp9O5rIoTIlVyApTuc', '2016-09-05 15:04:37', '2016-12-11 13:18:33', '2016-11-28', '30, Richard Aigbe Crescent, Olomu Town off Isawo Road, Ikorodu, Lagos State.', 'Saliu Jombo', '1B, Abayomi Shonuga Close, Lekki, Lagos State', '08107654663', 'Daughter', NULL, NULL, NULL, NULL, 2, 0, 0, '', 0, 0, 0, 0, NULL, NULL, NULL, 2),
(89, 106, 'Abiodun Ajayi', 'M', '1985-12-07', 31, 'biod@yahoomail.com', '7031556783', 'Single', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 20, '2002-07-12', 1, NULL, 'upload/avatar.jpg', NULL, NULL, '2017-01-11 12:38:08', '2010-06-05', 'No7, Ochima close, Ikeja, Lagos', 'Eunice Omotunde', 'No7, Ochima close, Ikeja, Lagos', '9076757645', 'Mother', NULL, NULL, NULL, NULL, 1, NULL, 1, 'Ogun south', 0, 0, 0, 0, NULL, NULL, NULL, 3),
(90, 107, 'Chuma Ukeagu', 'F', '1989-11-06', 27, 'eggy@yahoo.com', '8034779854', 'Single', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 9, '2010-06-11', 1, NULL, 'upload/avatar.jpg', NULL, NULL, NULL, '2014-07-08', '25, akinlade street yaba,Lagos', 'Beauty Ajayi', '25, akinlade street yaba,Lagos', '9075554634', 'Mother', NULL, NULL, NULL, NULL, 1, NULL, 5, 'Ughelli south', 0, 0, 0, 0, NULL, NULL, NULL, 4),
(127, 21, 'Nafui Umar', 'M', '1984-03-04', 32, 'umar35@yahoo.com', '80954362221', 'single', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 7, '2011-06-12', 1, NULL, 'upload/avatar.jpg', NULL, NULL, NULL, '2014-09-13', '16 Balarabe Musa, Avenue, Sabo, Kaduna', 'Aisha', '16 Balarabe Musa, Avenue, Sabo, Kaduna', '8076438834', 'Wife', NULL, NULL, NULL, NULL, 1, NULL, 19, 'Kafanchan', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(128, 54, 'Seun Jegede', 'F', '1981-04-10', 35, 'seunjegede@yahoo.com', '80978433373', 'single', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 2, '2010-10-30', 2, NULL, 'upload/avatar.jpg', NULL, NULL, NULL, '2015-10-06', '3 Adebisi str. Jakande Estate, Ibadan, Oyo', 'Kunle', '3 Adebisi str. Jakande Estate, Ibadan, Oyo', '80347834834', 'Son', NULL, NULL, NULL, NULL, 1, NULL, 31, 'Ibadan', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(129, 324, 'Jennifer Chukwudi ', 'F', '1986-12-29', 30, 'jennifer@gmail.com', '80947774353', 'Married', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 4, '2012-06-05', 1, NULL, 'upload/avatar.jpg', NULL, NULL, NULL, '2015-10-06', '10 Eric Moore Rd. Surulere, Lagos', 'Ben', '10 Eric Moore Rd. Surulere, Lagos', '8084743433', 'Husband', NULL, NULL, NULL, NULL, 1, NULL, 6, 'Okoh', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(130, 36, 'Etim Okon', 'M', '1973-02-19', 43, 'Etimokon@yahoo.com', '8097773834', 'single', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 1, '2005-12-03', 1, NULL, 'upload/avatar.jpg', NULL, NULL, NULL, '2014-09-13', '231 Obong Victor Attah Way, Uyo, Akwa Ibom', 'Emem', '231 Obong Victor Attah Way, Uyo, Akwa Ibom', '7073487344', 'Wife', NULL, NULL, NULL, NULL, 1, NULL, 3, 'Ikorro-Abasi', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(131, 33, 'Micheal Anenih', 'M', '1979-03-25', 37, 'anenih@hotmail.com', '80764888421', 'Married', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 9, '2008-11-17', 1, NULL, 'upload/avatar.jpg', NULL, NULL, NULL, '2015-10-06', '45 Yoruba Rd. Sabon Garri, Kano', 'Patience', '45 Yoruba Rd. Sabon Garri, Kano', '7034234483', 'Wife', NULL, NULL, NULL, NULL, 1, NULL, 12, 'Auchi', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(132, 1, 'Miram Mustafa', 'F', '1990-04-21', 26, 'miram90@yahoo.com', '7058848489', 'Married', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 14, '2015-07-18', 1, NULL, 'upload/avatar.jpg', NULL, NULL, NULL, '2016-11-20', '2B Abayomi Shonuga Crescent, Ikoyi, Lagos', 'Farouk Mustafa', '2B Abayomi Shonuga Crescent, Ikoyi, Lagos', '8096787840', 'Husband', NULL, NULL, NULL, NULL, 1, NULL, 20, 'Dala', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(133, 2, 'Tunde Oke', 'M', '1979-08-28', 37, 'tundeoke@gmail.com', '70834834933', 'Married', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 10, '2006-06-12', 1, NULL, 'upload/avatar.jpg', NULL, NULL, NULL, '2015-03-21', '36 Nnobi street surulere, Lagos', 'Sade Oke', '36 Nnobi street surulere, Lagos', '90887799809', 'Wife', NULL, NULL, NULL, NULL, 1, NULL, 31, 'Oyo', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(134, 3, 'Timpre Gold', 'M', '1980-02-24', 36, 'Tgold@yahoo.com', '7048747648', 'Married', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 9, '2004-04-26', 1, NULL, 'upload/avatar.jpg', NULL, NULL, '2016-12-20 08:42:41', '2014-07-25', '23 Abraham Adesanya, Anthony Village, Lagos', 'Onome Gold', '23 Abraham Adesanya, Anthony Village, Lagos', '9087675855', 'Wife', NULL, NULL, NULL, NULL, 2, NULL, 6, 'Yenagoa', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(135, 343, 'Shola Oladeji', 'F', '1992-09-30', 24, 'sholaola@hotmail.com', '909995875', 'single', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 5, '2015-06-18', 1, NULL, 'upload/avatar.jpg', NULL, NULL, '2016-12-20 08:42:42', '2014-07-25', '3 Etim Okon Street, Calabar, Cross River', 'Kudirat Oladeji', '23 Adelabu street, surulere, Lagos', '80769989', 'Mother', NULL, NULL, NULL, NULL, 2, NULL, 25, 'Agege', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(136, 113, 'Obinna Nwanneri', 'M', '1989-10-23', 27, 'obinna1989@gmail.com', '809889949', 'single', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 6, '2015-06-18', 1, NULL, 'upload/avatar.jpg', NULL, NULL, '2016-12-20 08:42:43', '2014-07-25', '101A Philip Ekong, Calabar, Cross River', 'Adanma Orji ', '12 orlu road, owerri, imo state', '90778788478', 'Sister', NULL, NULL, NULL, NULL, 2, NULL, 17, 'Okigwe', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(137, 34, 'John Hamza ', 'M', '1977-05-19', 39, 'hamza@hotmail.com', '809655546', 'Married', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 3, '2002-03-23', 1, NULL, 'upload/avatar.jpg', NULL, NULL, '2016-12-20 08:42:45', '2013-06-12', '10 Solomon Lar Avenue, Jos, Plateau State', 'Joy Hamza', '10 Solomon Lar Avenue, Jos, Plateau State', '8065334543', 'Wife', NULL, NULL, NULL, NULL, 2, NULL, 26, 'Lafiya', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(138, 6, 'Eche Audu', 'M', '1976-09-17', 40, 'audueche@yahoo.com', '80994864556', 'Married', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 7, '2002-04-12', 1, NULL, 'upload/avatar.jpg', NULL, NULL, '2016-12-20 08:42:32', '2014-08-23', '36 Rev.Crowder avenue Rayfield, Jos, Plateau State', 'Nancy Audu', '36 Rev.Crowder avenue Rayfield, Jos, Plateau State', '908777888', 'Wife', NULL, NULL, NULL, NULL, 2, NULL, 7, 'Otorokpo', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(139, 45, 'Mohammed Ogbe', 'M', '1987-02-10', 29, 'ogbeM@hotmail.com', '8076885755', 'Married', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 4, '2013-04-10', 1, NULL, 'upload/avatar.jpg', NULL, NULL, '2016-12-20 08:42:33', '2014-07-25', '3A Dokpesi street, Lekki, Lagos', 'Jamila Mohammed', '3A Dokpesi street, Lekki, Lagos', '80554584545', 'Wife', NULL, NULL, NULL, NULL, 2, NULL, 23, 'Ajekota', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(140, 5, 'Max Klein', 'M', '1972-06-24', 45, 'maxklein@yahoo.com', '80665747476', 'single', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 9, '2009-09-12', 1, NULL, 'upload/avatar.jpg', NULL, NULL, '2016-12-20 08:42:35', '2015-07-12', 'Etim Iyang Crescen, Victoria Island, Lagos', 'Jessica', '3A Dokpesi street, Lekki, Lagos', '9035476344', 'Daughter', NULL, NULL, NULL, NULL, 2, NULL, 31, 'Ibadan', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(141, 7, 'Kostas Zaharakis', 'M', '1965-01-19', 51, 'kostasZah@gmail.com', '7077566578', 'single', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 1, '1999-05-30', 1, NULL, 'upload/avatar.jpg', NULL, NULL, '2016-12-20 08:42:36', '2012-05-20', '31 Bell street, Asokoro, FCT, Abuja', 'Shelia', '31 Bell street, Asokoro, FCT, Abuja', '8064388344', 'Wife', NULL, NULL, NULL, NULL, 2, NULL, 37, 'Asokoro', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(142, 89, 'Segun Ojo', 'M', '1988-11-21', 28, 'segun1111@yahoo.com', '9065747332', 'single', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 8, '2013-07-17', 2, NULL, 'upload/avatar.jpg', NULL, NULL, '2016-12-20 08:42:37', '2016-02-26', '12 Kola Wale Drive, victoria Island, Lagos', 'Kemi', '64 crown street Ojodo, Berger, Lagos', '80463773476', 'Mother', NULL, NULL, NULL, NULL, 2, NULL, 25, 'Apapa', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(143, 57, 'Emmanuel Iyang', 'M', '1980-07-21', 36, 'iyang_emmanuel@yahoo.com', '8054334833', 'Married', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 5, '2008-10-25', 1, NULL, 'upload/avatar.jpg', NULL, NULL, '2016-12-20 08:42:40', '2014-06-03', '10 Fox street, Aba, Abia', 'Judith', '10 Fox street, Aba, Abia', '8074889343', 'Wife', NULL, NULL, NULL, NULL, 2, NULL, 2, 'Oron', 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(144, 603, 'Olisa Edeh', 'M', '1985-09-09', 31, 'eolisa@gmail.com', '8075858933', 'Married', '$2y$10$mxkoUCFI32VeheqEopMN8.qG/ARsCRZSOlnQ0sFXxaxjuE08JxZ5u', 1, 2, '2011-12-04', 1, NULL, 'upload/avatar.jpg', NULL, NULL, NULL, '2015-08-06', '45 Murtala Mohammed way, kano', 'Nkechi', '45 Murtala Mohammed way, kano', '8097476444', 'Wife', NULL, NULL, NULL, NULL, 1, NULL, 11, 'Asaba', 0, 0, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `id` bigint(20) NOT NULL,
  `vacant_position` varchar(255) NOT NULL,
  `instead_of_whom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_filled` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL,
  `created_on` datetime NOT NULL,
  `filled_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`id`, `vacant_position`, `instead_of_whom`, `description`, `status`, `is_filled`, `created_by`, `created_on`, `filled_on`) VALUES
(1, 'Manual Tester', 'Automation', 'Looking for a tester with good communication', 1, 1, 6, '2017-01-18 09:23:33', '2017-01-18 09:44:40'),
(2, 'Automation ', 'Business Analyst', 'Under Testing 1\r\n', 1, 1, 6, '2017-01-19 07:47:31', '2017-01-19 08:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `weekend_days`
--

CREATE TABLE `weekend_days` (
  `1` int(11) NOT NULL,
  `weekend_day` varchar(10) NOT NULL,
  `weekend_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weekend_days`
--

INSERT INTO `weekend_days` (`1`, `weekend_day`, `weekend_status`) VALUES
(1, 'Sunday', 0),
(2, 'Monday', 0),
(3, 'Tuesday', 0),
(4, 'Wednesday', 0),
(5, 'Thursday', 0),
(6, 'Friday', 1),
(7, 'Saturday', 1);

-- --------------------------------------------------------

--
-- Table structure for table `workinghours`
--

CREATE TABLE `workinghours` (
  `id` int(10) UNSIGNED NOT NULL,
  `sob` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cob` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `workinghours`
--

INSERT INTO `workinghours` (`id`, `sob`, `cob`, `created_at`, `updated_at`) VALUES
(2, '07:00', '18:00', '2016-12-13 18:00:59', '2017-01-11 09:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `work_types`
--

CREATE TABLE `work_types` (
  `id` int(11) NOT NULL,
  `work_type` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_types`
--

INSERT INTO `work_types` (`id`, `work_type`, `created_at`, `updated_at`) VALUES
(1, 'Casual', NULL, NULL),
(2, 'Office', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absencerequests`
--
ALTER TABLE `absencerequests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `absencesettings`
--
ALTER TABLE `absencesettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `absencetypes`
--
ALTER TABLE `absencetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allowance_deduction`
--
ALTER TABLE `allowance_deduction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allowance_deduction_09-02`
--
ALTER TABLE `allowance_deduction_09-02`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicantanswers`
--
ALTER TABLE `applicantanswers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `available_jobs`
--
ALTER TABLE `available_jobs`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `basicpay_details`
--
ALTER TABLE `basicpay_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corrects`
--
ALTER TABLE `corrects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_attendance`
--
ALTER TABLE `daily_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_attendance_settings`
--
ALTER TABLE `daily_attendance_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp360rateds`
--
ALTER TABLE `emp360rateds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp360ratings`
--
ALTER TABLE `emp360ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empdocs`
--
ALTER TABLE `empdocs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_casual_leaves`
--
ALTER TABLE `employee_casual_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_academics`
--
ALTER TABLE `emp_academics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_dependants`
--
ALTER TABLE `emp_dependants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_histories`
--
ALTER TABLE `emp_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_past_emps`
--
ALTER TABLE `emp_past_emps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_reviews`
--
ALTER TABLE `emp_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_skills`
--
ALTER TABLE `emp_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fiscals`
--
ALTER TABLE `fiscals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_diagnosis`
--
ALTER TABLE `health_diagnosis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_applied_fors`
--
ALTER TABLE `job_applied_fors`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `job_deps`
--
ALTER TABLE `job_deps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_levels`
--
ALTER TABLE `job_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_skills`
--
ALTER TABLE `job_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `job_skill_comps`
--
ALTER TABLE `job_skill_comps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifcation_setts`
--
ALTER TABLE `notifcation_setts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `num_of_leave_details`
--
ALTER TABLE `num_of_leave_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `question_id` (`question_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_details`
--
ALTER TABLE `payroll_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prof_histories`
--
ALTER TABLE `prof_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `public_holidays`
--
ALTER TABLE `public_holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query_threads`
--
ALTER TABLE `query_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query_types`
--
ALTER TABLE `query_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content` (`content`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `references`
--
ALTER TABLE `references`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rightmanagements`
--
ALTER TABLE `rightmanagements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_grades`
--
ALTER TABLE `subject_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_takens`
--
ALTER TABLE `subject_takens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxation_slab`
--
ALTER TABLE `taxation_slab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testscores`
--
ALTER TABLE `testscores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testsettings`
--
ALTER TABLE `testsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_takens`
--
ALTER TABLE `test_takens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_atts`
--
ALTER TABLE `training_atts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `training_materials`
--
ALTER TABLE `training_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_members`
--
ALTER TABLE `training_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_survey`
--
ALTER TABLE `training_survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_survey_post`
--
ALTER TABLE `training_survey_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emp_num` (`emp_num`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekend_days`
--
ALTER TABLE `weekend_days`
  ADD PRIMARY KEY (`1`);

--
-- Indexes for table `workinghours`
--
ALTER TABLE `workinghours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_types`
--
ALTER TABLE `work_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absencerequests`
--
ALTER TABLE `absencerequests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `absencesettings`
--
ALTER TABLE `absencesettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `absencetypes`
--
ALTER TABLE `absencetypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `allowance_deduction`
--
ALTER TABLE `allowance_deduction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `allowance_deduction_09-02`
--
ALTER TABLE `allowance_deduction_09-02`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `applicantanswers`
--
ALTER TABLE `applicantanswers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `available_jobs`
--
ALTER TABLE `available_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `basicpay_details`
--
ALTER TABLE `basicpay_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;
--
-- AUTO_INCREMENT for table `corrects`
--
ALTER TABLE `corrects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `daily_attendance`
--
ALTER TABLE `daily_attendance`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `daily_attendance_settings`
--
ALTER TABLE `daily_attendance_settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `document_types`
--
ALTER TABLE `document_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `emp360rateds`
--
ALTER TABLE `emp360rateds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `emp360ratings`
--
ALTER TABLE `emp360ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `empdocs`
--
ALTER TABLE `empdocs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `emploee_expenses`
--
ALTER TABLE `emploee_expenses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_casual_leaves`
--
ALTER TABLE `employee_casual_leaves`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `emp_academics`
--
ALTER TABLE `emp_academics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emp_dependants`
--
ALTER TABLE `emp_dependants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `emp_histories`
--
ALTER TABLE `emp_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `emp_past_emps`
--
ALTER TABLE `emp_past_emps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emp_reviews`
--
ALTER TABLE `emp_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `emp_skills`
--
ALTER TABLE `emp_skills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `fiscals`
--
ALTER TABLE `fiscals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `health_diagnosis`
--
ALTER TABLE `health_diagnosis`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `holiday_calendar`
--
ALTER TABLE `holiday_calendar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `job_applied_fors`
--
ALTER TABLE `job_applied_fors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `job_deps`
--
ALTER TABLE `job_deps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `job_levels`
--
ALTER TABLE `job_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `job_skills`
--
ALTER TABLE `job_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_skill_comps`
--
ALTER TABLE `job_skill_comps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notifcation_setts`
--
ALTER TABLE `notifcation_setts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `num_of_leave_details`
--
ALTER TABLE `num_of_leave_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `payroll_details`
--
ALTER TABLE `payroll_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT for table `prof_histories`
--
ALTER TABLE `prof_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `public_holidays`
--
ALTER TABLE `public_holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `query_threads`
--
ALTER TABLE `query_threads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `query_types`
--
ALTER TABLE `query_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `references`
--
ALTER TABLE `references`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rightmanagements`
--
ALTER TABLE `rightmanagements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `subject_grades`
--
ALTER TABLE `subject_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `subject_takens`
--
ALTER TABLE `subject_takens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `successor_nominations`
--
ALTER TABLE `successor_nominations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `taxation_slab`
--
ALTER TABLE `taxation_slab`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `testscores`
--
ALTER TABLE `testscores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `testsettings`
--
ALTER TABLE `testsettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `test_takens`
--
ALTER TABLE `test_takens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `training_atts`
--
ALTER TABLE `training_atts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `training_materials`
--
ALTER TABLE `training_materials`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `training_members`
--
ALTER TABLE `training_members`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `training_survey`
--
ALTER TABLE `training_survey`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `training_survey_post`
--
ALTER TABLE `training_survey_post`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `weekend_days`
--
ALTER TABLE `weekend_days`
  MODIFY `1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `workinghours`
--
ALTER TABLE `workinghours`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_types`
--
ALTER TABLE `work_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
