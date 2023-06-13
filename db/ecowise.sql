-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2023 at 11:07 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecowise`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_management`
--

CREATE TABLE `access_management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `navigation_id` int(11) NOT NULL,
  `inner_menu_id` int(11) NOT NULL,
  `read` int(11) NOT NULL,
  `write` int(11) NOT NULL,
  `delete` int(11) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile_no` bigint(20) DEFAULT NULL,
  `staff_image` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `mobile_no`, `staff_image`, `role_id`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'Ecowise', 'mail@ecowise.com', '$2y$10$FUkQsRbkZuI0oQxfTNbm7.BFmabt8oGUNmz9JiHmKcThdBBa/SeFm', 9555084255, '202212281321avatar-4.jpg', 1, 0, '2022-12-24 13:13:34', '2023-01-12 07:03:05'),
(2, 'Surya1', 'surya@scrap.com', '$2y$10$eUCXWuVx1TEDYK6uP5XY3O0Pth16iuzGPMUAOHimnrro61fxw3UfO', 9555084255, '202212281325avatar-4.jpg', 6, 0, '2022-12-27 10:23:30', '2023-03-15 02:10:10'),
(3, 'Axepert', 'axepert@scrap.com', '$2y$10$NtYxh92nffT8UXQUbbETuubH1D1OhWnpMr5IvNVqIKoK5iV16xTFC', 9555084255, '202212281343avatar-5.jpg', 3, 0, NULL, '2022-12-28 06:22:19'),
(4, 'Axepert Two', 'axepertone@scrap.com', '$2y$10$Q4cj3u62cRw8n.M2KF/bNOhUYmpsJ6.2W2pS1hdNxKeKMCqAakFFy', 9555084255, '202212281348img-avatar-3.jpg', 5, 0, '2022-12-28 08:18:48', '2022-12-28 02:50:03'),
(5, 'Surya pratap', 'mail@xdcfggv.com', '$2y$10$OVODJifFMcMFXnrT0L.3qOLKyeT8Sc3OkSPQEDSkpiEDmlJGjwVOO', 1234567891, '202212281351avatar-3.jpg', 6, 0, '2022-12-28 08:21:52', '2023-01-09 08:50:28'),
(6, 'test', 'testentry@gmail.com', '$2y$10$Hvtvu4gHDVnTVFP4XU0EHOkmdoDEFENEX9AnOtzHTxZEU9YE2aAky', 9555084255, '202301021909Rogan Badam new.jpg', 3, 2, '2023-01-02 13:39:49', '2023-01-02 08:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `allotment_vehicle`
--

CREATE TABLE `allotment_vehicle` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `vehicle_number` varchar(55) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `flag` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allotment_vehicle`
--

INSERT INTO `allotment_vehicle` (`id`, `vehicle_id`, `vehicle_number`, `driver_id`, `flag`, `created_at`, `updated_at`) VALUES
(1, 1, 'A12345', 5, 2, '2023-01-10 11:55:55', '2023-03-11 06:05:42'),
(2, 1, 'A12345', 5, 2, '2023-01-10 11:55:58', '2023-03-11 06:05:42'),
(3, 1, 'A12345', 2, 1, '2023-03-11 11:35:42', '2023-03-11 11:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `cash_management`
--

CREATE TABLE `cash_management` (
  `id` int(11) NOT NULL,
  `pay_method` varchar(55) NOT NULL,
  `flag` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cash_management`
--

INSERT INTO `cash_management` (`id`, `pay_method`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'Debit 1', 0, '2022-12-30 14:08:01', '2023-01-02 08:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `cash_report`
--

CREATE TABLE `cash_report` (
  `id` int(11) NOT NULL,
  `cash_with` varchar(255) NOT NULL,
  `amount` bigint(255) NOT NULL,
  `data_status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cash_report`
--

INSERT INTO `cash_report` (`id`, `cash_with`, `amount`, `data_status`, `date`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'rajtest', 5000, 'processing', '2023-03-10', 0, '2023-03-23 12:46:01.943264', '2023-03-23 12:46:01.943264'),
(2, 'test', 89898, 'tdtdt', '2023-03-03', 0, '2023-03-14 09:41:16.611684', '2023-03-14 09:41:16.611684'),
(3, 'japan', 8790, 'pending', '2023-03-12', 2, '2023-03-14 09:41:02.054047', '2023-03-14 09:41:02.054047'),
(4, 'dda', 100, 'dsads', '2023-03-14', 0, '2023-03-14 10:28:34.369662', '2023-03-14 04:58:34.000000'),
(5, 'rajtest', 5000, 'processing', '2023-03-10', 0, '2023-03-24 05:28:10.671387', '2023-03-24 05:28:10.671387'),
(6, 'test', 89898, 'tdtdt', '2023-03-03', 0, '2023-03-24 05:28:10.676785', '2023-03-24 05:28:10.676785'),
(7, 'japan', 8790, 'pending', '2023-03-12', 0, '2023-03-24 05:28:10.685133', '2023-03-24 05:28:10.685133'),
(8, 'dda', 100, 'dsads', '2023-03-14', 0, '2023-03-24 05:28:10.692202', '2023-03-24 05:28:10.692202'),
(9, 'Surya', 5000, 'Done', '2023-03-14', 0, '2023-03-24 05:28:10.697337', '2023-03-24 05:28:10.697337');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(55) NOT NULL,
  `cat_image` text NOT NULL,
  `flag` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `cat_image`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'Category', '202212291156avatar-3.jpg', 0, '2022-12-29 06:26:10', '2023-01-02 08:05:48'),
(2, 'Category 2', '202212291421avatar-4.jpg', 0, '2022-12-29 08:51:00', '2022-12-29 08:51:00'),
(3, 'test', '202301021911Rogan Badam new.jpg', 2, '2023-01-02 13:41:18', '2023-01-02 08:11:51'),
(4, 'test1', '202301031709touch.png', 0, '2023-01-03 11:39:10', '2023-01-03 11:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `contact` bigint(55) NOT NULL,
  `location` varchar(55) NOT NULL,
  `state_id` varchar(55) NOT NULL,
  `pan` varchar(55) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `email`, `contact`, `location`, `state_id`, `pan`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@gmail.com', 9555084255, 'Keshavpuram', '1', 'DONPP6844D1', 0, '2023-03-13 07:02:40', '2023-03-13 07:02:40'),
(2, 'test3', 'test2@gmil.com', 9991112223, 'Keshavpuram', '1', 'DONPP6844D2', 0, '2023-03-13 07:08:05', '2023-03-13 07:08:05'),
(3, 'Surya Pratap', 'sp9522385@gmail.com', 9555084255, 'Keshavpuram', '5', 'DONPP6844D3', 0, '2023-03-13 07:12:08', '2023-03-13 07:12:08'),
(4, 'Surya Pratap 1', 'sp9522385@gmail.com', 9991112223, 'Keshavpuram', '5', 'DONPP6844D4', 0, '2023-03-13 07:12:39', '2023-03-13 07:12:39'),
(5, 'Surya Pratap123', 'sp9522385@gmail.com', 9555084255, 'Keshavpuram', '5', 'DONPP6844D5', 0, '2023-03-13 07:22:55', '2023-03-13 02:51:46'),
(6, 'Axepert', 'axepert@gmail.com', 9555084255, 'Keshavpuram', '3', 'DONPP6844D', 0, '2023-03-18 07:01:06', '2023-03-18 07:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_password` varchar(255) NOT NULL,
  `emp_contact` varchar(255) NOT NULL,
  `emp_address` varchar(255) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_report`
--

CREATE TABLE `expense_report` (
  `id` int(11) NOT NULL,
  `date` varchar(55) NOT NULL,
  `client_id` int(11) NOT NULL,
  `state` int(55) NOT NULL,
  `location` varchar(55) NOT NULL,
  `service_type` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` bigint(22) NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL,
  `pay_mode` varchar(55) NOT NULL,
  `date_of_payment` varchar(55) NOT NULL,
  `receipt_date` varchar(55) NOT NULL,
  `transporte` varchar(55) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense_report`
--

INSERT INTO `expense_report` (`id`, `date`, `client_id`, `state`, `location`, `service_type`, `description`, `amount`, `category`, `subcategory`, `pay_mode`, `date_of_payment`, `receipt_date`, `transporte`, `flag`, `created_at`, `updated_at`) VALUES
(1, '2023-03-16', 5, 5, 'Lajpat Nagar', 1, 'Excel Upload 1', 1122, 2, 1, '1', '2023-03-16', '2023-03-16', 'test', 0, '2023-03-23 11:47:55', '2023-03-23 11:47:55'),
(2, '2023-03-16', 4, 20, 'Govindpuri', 1, 'Excel Upload 2', 112233, 1, 2, '1', '2023-03-16', '2023-03-16', 'tst2', 0, '2023-03-23 11:47:55', '2023-03-23 11:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hsn_master`
--

CREATE TABLE `hsn_master` (
  `id` int(11) NOT NULL,
  `hsn_code` varchar(55) NOT NULL,
  `description` text NOT NULL,
  `flag` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hsn_master`
--

INSERT INTO `hsn_master` (`id`, `hsn_code`, `description`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'HSN1', 'HSN1', 0, '2023-01-04 12:15:08', '2023-01-04 06:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(22, '2014_10_12_000000_create_users_table', 1),
(23, '2014_10_12_100000_create_password_resets_table', 1),
(24, '2019_08_19_000000_create_failed_jobs_table', 1),
(25, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(26, '2022_12_24_101558_create_roles', 1),
(27, '2022_12_24_105102_create_admin', 1),
(28, '2022_12_24_112510_create_navigation_bar', 2),
(29, '2022_12_24_113321_create_navigation_inner_menu', 3),
(30, '2022_12_24_122739_create_access_management', 4),
(31, '2023_01_03_135645_create_notifications_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `navigation_bar`
--

CREATE TABLE `navigation_bar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu` varchar(55) NOT NULL,
  `slug` varchar(55) NOT NULL,
  `icon` varchar(55) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `navigation_bar`
--

INSERT INTO `navigation_bar` (`id`, `menu`, `slug`, `icon`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'Access Management', 'access_management', '<i class=\"feather icon-settings\"></i>', 0, '2022-12-26 13:31:56', NULL),
(2, 'Product Management', 'product_management', '<i class=\"feather icon-slack\"></i>', 0, '2022-12-28 12:28:43', NULL),
(3, 'Cash Management', 'cash_management', '<i class=\"feather icon-briefcase\"></i>', 2, '2022-12-30 12:11:37', NULL),
(4, 'HSN Management', 'hsn_management', '<i class=\"feather icon-settings\"></i>', 0, '2023-01-04 10:56:34', NULL),
(5, 'Report Category', 'report_category', '<i class=\"feather icon-file-text\"></i>', 0, '2023-01-04 13:00:56', NULL),
(6, 'Vehicle Management', 'vehicle_management', '<i class=\"fas fa-shuttle-van\"></i>', 0, '2023-01-09 11:21:20', NULL),
(7, 'Settings', 'settings', '<i class=\"feather icon-settings\"></i>', 0, '2023-01-12 08:46:08', NULL),
(8, 'Master', 'master', '<i class=\"feather icon-settings\"></i>', 0, '2023-01-12 08:46:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `navigation_inner_menu`
--

CREATE TABLE `navigation_inner_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `navigation_id` int(11) NOT NULL,
  `inner_menu` varchar(55) NOT NULL,
  `slug` varchar(55) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `navigation_inner_menu`
--

INSERT INTO `navigation_inner_menu` (`id`, `navigation_id`, `inner_menu`, `slug`, `flag`, `created_at`, `updated_at`) VALUES
(1, 1, 'User', 'user', 0, NULL, NULL),
(2, 2, 'Category', 'category', 0, '2022-12-28 12:29:59', NULL),
(3, 2, 'Sub Category', 'sub_category', 0, '2022-12-28 12:29:59', NULL),
(4, 2, 'Sub Sub Category', 'sub_sub_category', 0, '2022-12-28 12:29:59', NULL),
(5, 2, 'Product', 'product', 0, '2023-01-02 14:09:25', NULL),
(6, 5, 'Expense Account', 'expense_account', 0, '2023-01-04 13:19:39', NULL),
(7, 5, 'Sale', 'sale', 0, '2023-01-04 13:19:39', NULL),
(8, 5, 'Rental Truck', 'rental_truck', 0, '2023-01-04 13:19:39', NULL),
(9, 6, 'Vehicle List', 'vehicle_list', 0, NULL, NULL),
(11, 20, 'List', 'list', 0, NULL, NULL),
(12, 8, 'Client', 'client', 0, '2023-03-13 05:38:54', NULL),
(13, 8, 'Service type', 'service_type', 0, '2023-03-13 05:38:54', NULL),
(14, 5, 'Cash Report', 'cash_report', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(55) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `sub_sub_cat_id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `hsn` varchar(55) NOT NULL,
  `unit` varchar(55) NOT NULL,
  `size` varchar(55) NOT NULL,
  `quantity` int(55) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `flag` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `cat_id`, `sub_cat_id`, `sub_sub_cat_id`, `name`, `hsn`, `unit`, `size`, `quantity`, `image`, `description`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'TEST1', 2, 1, 2, 'Test1', 'hsn1', 'hsn1', '1', 1, '202301031944whoimg.png', 'NA', 0, '2023-01-03 14:14:29', '2023-01-04 05:06:05'),
(2, 'ECONATURE274', 2, 1, 2, 'Test2', 'hsn1', 'kg', '1', 343, '202303241328a7q15.png', 'NA', 0, '2023-03-24 07:58:32', '2023-03-24 07:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(25) DEFAULT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'Master', 0, '2022-12-24 13:12:36', NULL),
(2, 'Sub Admin', 0, '2022-12-27 07:56:11', NULL),
(3, 'Supervisor', 0, '2022-12-27 10:41:03', NULL),
(4, 'Vendor', 0, '2022-12-27 10:41:43', NULL),
(5, 'Manager', 0, '2022-12-27 10:41:43', NULL),
(6, 'Driver', 0, '2022-12-27 10:41:43', NULL),
(7, 'Accounts', 0, '2022-12-27 10:41:43', NULL),
(8, 'Data entry', 0, '2022-12-27 10:41:43', NULL),
(9, 'OPERATIONS', 0, '2022-12-27 10:41:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_report`
--

CREATE TABLE `sale_report` (
  `id` int(11) NOT NULL,
  `item_name` varchar(55) NOT NULL,
  `qty` varchar(55) NOT NULL,
  `rate` varchar(55) NOT NULL,
  `amount` bigint(55) NOT NULL,
  `payment` varchar(55) NOT NULL,
  `payment_date` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL,
  `date` varchar(55) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_report`
--

INSERT INTO `sale_report` (`id`, `item_name`, `qty`, `rate`, `amount`, `payment`, `payment_date`, `status`, `date`, `flag`, `created_at`, `updated_at`) VALUES
(1, '1', '423', '4234', 100, '33423', '2023-03-12', 'sfsdfd123', '2023-03-12', 0, '2023-03-12 13:50:41', '2023-03-12 23:54:07'),
(2, '1', '1', '34', 50, '3432', '2023-03-13', 'fsdfd', '2023-03-13', 0, '2023-03-13 04:49:52', '2023-03-13 04:49:52'),
(3, '1', '423', '4234', 70, '33423', '2023-03-14', 'sfsdfd123', '2023-03-12', 0, '2023-03-12 13:50:41', '2023-03-12 23:54:07'),
(4, '1', '423', '4234', 500, '33423', '2023-06-15', 'sfsdfd123', '2023-03-12', 0, '2023-03-12 13:50:41', '2023-03-12 23:54:07'),
(5, '1', '423', '4234', 300, '33423', '2023-04-12', 'import 1', '2023-03-12', 0, '2023-03-23 12:45:24', '2023-03-23 12:45:24'),
(6, '2', '1', '34', 350, '3432000', '2023-05-13', 'import 2', '2023-03-13', 0, '2023-03-23 12:45:24', '2023-03-23 12:45:24'),
(7, '2', '423', '4234', 200, '33423', '2023-02-12', 'import 3', '2023-03-12', 0, '2023-03-23 12:45:24', '2023-03-23 12:45:24'),
(8, '2', '423', '4234', 700, '33423', '2023-07-15', 'import 4', '2023-03-12', 0, '2023-03-23 12:45:24', '2023-03-23 12:45:24');

-- --------------------------------------------------------

--
-- Table structure for table `service_type`
--

CREATE TABLE `service_type` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_type`
--

INSERT INTO `service_type` (`id`, `name`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'test1', 0, '2023-03-13 10:11:48', '2023-03-13 05:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `state_name` varchar(300) NOT NULL,
  `flag` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `state_name`, `flag`) VALUES
(1, 'Delhi', 0),
(2, 'Haryana', 0),
(3, 'Punjab', 0),
(4, 'Rajasthan', 0),
(5, 'Uttar Pradesh', 0),
(6, 'Madhya pradesh', 0),
(7, 'Himachal pradesh', 0),
(8, 'Jammu & Kashmir', 0),
(9, 'Gujarat', 0),
(10, 'Bihar', 0),
(11, 'Jharkhand', 0),
(12, 'Uttrakhand', 0),
(13, 'Andaman & nicobar ', 0),
(14, 'Andhra Pradesh', 0),
(15, 'Arunachal pradesh', 0),
(16, 'Assam', 0),
(17, 'Chattishgarh', 0),
(18, 'Chandigarh', 0),
(19, 'Dadra & Nagar Haweli', 0),
(20, 'Daman & Diu', 0),
(21, 'Goa', 0),
(22, 'Kerala', 0),
(23, 'Karnataka', 0),
(24, 'Lakshwadeep', 0),
(25, 'Maharashtra', 0),
(26, 'Manipur', 0),
(27, 'Meghalaya', 0),
(28, 'Mizoram', 0),
(29, 'Nagaland', 0),
(30, 'Orissa', 0),
(31, 'Pondichery', 0),
(32, 'Sikkim', 0),
(33, 'Tamilnadu', 0),
(34, 'Tripura', 0),
(35, 'West Bangal', 0),
(36, 'Telangana', 0),
(37, 'Ladakh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subcategory` varchar(55) NOT NULL,
  `subcat_image` text NOT NULL,
  `flag` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `cat_id`, `subcategory`, `subcat_image`, `flag`, `created_at`, `updated_at`) VALUES
(1, 2, 'Sub Cat4', '202212291547avatar-4.jpg', 0, '2022-12-29 09:05:30', '2022-12-29 05:18:48'),
(2, 1, 'Sub Category Cat 1', '202212301316img-avatar-1.jpg', 0, '2022-12-30 07:46:43', '2023-03-12 04:55:09'),
(3, 1, 'test', '202301021912spic.jpg', 0, '2023-01-02 13:42:38', '2023-01-02 08:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `subsubcategory`
--

CREATE TABLE `subsubcategory` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `subsubcategory` varchar(55) NOT NULL,
  `subsubcat_image` text NOT NULL,
  `flag` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subsubcategory`
--

INSERT INTO `subsubcategory` (`id`, `cat_id`, `sub_cat_id`, `subsubcategory`, `subsubcat_image`, `flag`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Sub Sub 1', '202212301312img-avatar-3.jpg', 2, '2022-12-29 12:01:11', '2023-01-02 08:17:52'),
(2, 2, 1, 'Sub sub 2', '202212291732avatar-4.jpg', 0, '2022-12-29 12:02:09', '2022-12-30 02:12:38'),
(3, 2, 1, 'Sub sub 2', '202212291732avatar-4.jpg', 0, '2022-12-29 12:02:53', '2022-12-29 12:02:53'),
(4, 2, 1, 'Sub Cat4', '202212291735avatar-2.jpg', 0, '2022-12-29 12:05:28', '2022-12-29 12:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `vehicle_number` varchar(55) NOT NULL,
  `vehicle_type` varchar(55) NOT NULL,
  `capacity` varchar(55) NOT NULL,
  `flag` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `vehicle_number`, `vehicle_type`, `capacity`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'A12345534', 'Truck', '1234', 0, '2023-01-09 13:23:49', '2023-03-11 06:05:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_management`
--
ALTER TABLE `access_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allotment_vehicle`
--
ALTER TABLE `allotment_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_management`
--
ALTER TABLE `cash_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_report`
--
ALTER TABLE `cash_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_emp_password_unique` (`emp_password`);

--
-- Indexes for table `expense_report`
--
ALTER TABLE `expense_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hsn_master`
--
ALTER TABLE `hsn_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigation_bar`
--
ALTER TABLE `navigation_bar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigation_inner_menu`
--
ALTER TABLE `navigation_inner_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_report`
--
ALTER TABLE `sale_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_type`
--
ALTER TABLE `service_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subsubcategory`
--
ALTER TABLE `subsubcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_management`
--
ALTER TABLE `access_management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `allotment_vehicle`
--
ALTER TABLE `allotment_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cash_management`
--
ALTER TABLE `cash_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cash_report`
--
ALTER TABLE `cash_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_report`
--
ALTER TABLE `expense_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hsn_master`
--
ALTER TABLE `hsn_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `navigation_bar`
--
ALTER TABLE `navigation_bar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `navigation_inner_menu`
--
ALTER TABLE `navigation_inner_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sale_report`
--
ALTER TABLE `sale_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `service_type`
--
ALTER TABLE `service_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subsubcategory`
--
ALTER TABLE `subsubcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
