-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2023 at 03:46 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dairy-m`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutuses`
--

CREATE TABLE `aboutuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aboutuses`
--

INSERT INTO `aboutuses` (`id`, `title1`, `title2`, `title3`, `desc1`, `desc2`, `desc3`, `created_at`, `updated_at`) VALUES
(1, 'WHY CHOOSE US', 'OUR MISSION', 'WHAT WE DO', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni accusantium', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni accusantium', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni accusantium', '2022-10-29 11:28:08', '2022-10-29 11:28:08');

-- --------------------------------------------------------

--
-- Table structure for table `advances`
--

CREATE TABLE `advances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `billno` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `panvat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `printed By` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grandtotal` decimal(12,2) NOT NULL DEFAULT 0.00,
  `paid` decimal(12,2) NOT NULL DEFAULT 0.00,
  `due` decimal(12,2) NOT NULL DEFAULT 0.00,
  `date` int(11) DEFAULT NULL,
  `return` decimal(12,2) NOT NULL DEFAULT 0.00,
  `isprinted` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dis` decimal(12,2) NOT NULL DEFAULT 0.00,
  `net_total` decimal(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_expenses`
--

CREATE TABLE `bill_expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplierbill_id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_items`
--

CREATE TABLE `bill_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(12,2) NOT NULL DEFAULT 0.00,
  `qty` decimal(12,2) NOT NULL DEFAULT 0.00,
  `amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `bill_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `centers`
--

CREATE TABLE `centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addresss` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fat_rate` decimal(8,2) NOT NULL,
  `snf_rate` decimal(8,2) NOT NULL,
  `bonus` decimal(18,2) NOT NULL DEFAULT 0.00,
  `tc` decimal(18,2) NOT NULL DEFAULT 0.00,
  `cc` decimal(18,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `centers`
--

INSERT INTO `centers` (`id`, `name`, `addresss`, `created_at`, `updated_at`, `fat_rate`, `snf_rate`, `bonus`, `tc`, `cc`) VALUES
(1, 'Bismillah', 'Uttara', '2022-10-29 12:39:27', '2022-10-29 12:39:27', '0.01', '0.01', '0.00', '0.00', '0.00'),
(2, 'Ma babar dowa', 'Green road', '2022-11-01 02:08:51', '2022-11-01 02:08:51', '1.00', '2.00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `center_stocks`
--

CREATE TABLE `center_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `rate` decimal(18,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 6, '2022-10-31 18:33:47', '2022-10-31 18:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `date` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distributerreqs`
--

CREATE TABLE `distributerreqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distributers`
--

CREATE TABLE `distributers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `credit_days` int(11) NOT NULL DEFAULT 15,
  `credit_limit` int(11) NOT NULL DEFAULT 0,
  `lastsms` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distributorsells`
--

CREATE TABLE `distributorsells` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distributer_id` bigint(20) UNSIGNED NOT NULL,
  `date` int(11) NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `qty` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `paid` decimal(8,2) NOT NULL,
  `deu` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distributor_payments`
--

CREATE TABLE `distributor_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `date` int(11) NOT NULL,
  `payment_detail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salary` decimal(8,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `acc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `salary`, `user_id`, `created_at`, `updated_at`, `acc`) VALUES
(1, '20000.00', 4, '2022-10-29 12:31:07', '2022-10-29 12:31:07', NULL),
(2, '50000.00', 14, '2022-11-01 02:54:25', '2022-11-01 02:54:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_advances`
--

CREATE TABLE `employee_advances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` int(11) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_reports`
--

CREATE TABLE `employee_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `prevbalance` decimal(18,2) NOT NULL,
  `advance` decimal(18,2) NOT NULL,
  `salary` decimal(18,2) NOT NULL,
  `balance` decimal(18,2) NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_sessions`
--

CREATE TABLE `employee_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expcategories`
--

CREATE TABLE `expcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `date` int(11) NOT NULL,
  `payment_detail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expcategory_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farmerpayments`
--

CREATE TABLE `farmerpayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `date` int(11) NOT NULL,
  `payment_detail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `usecc` tinyint(1) NOT NULL DEFAULT 0,
  `usetc` tinyint(1) NOT NULL DEFAULT 0,
  `userate` tinyint(1) NOT NULL DEFAULT 0,
  `rate` decimal(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `center_id`, `user_id`, `created_at`, `updated_at`, `usecc`, `usetc`, `userate`, `rate`) VALUES
(1, 1, 5, '2022-10-29 12:40:33', '2022-10-29 12:40:33', 0, 0, 0, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_reports`
--

CREATE TABLE `farmer_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `milk` decimal(8,2) NOT NULL,
  `snf` decimal(8,2) NOT NULL,
  `fat` decimal(8,2) NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `due` decimal(8,2) NOT NULL,
  `prevdue` decimal(8,2) NOT NULL,
  `advance` decimal(8,2) NOT NULL,
  `nettotal` decimal(8,2) NOT NULL,
  `balance` decimal(8,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `year` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `bonus` decimal(18,2) NOT NULL DEFAULT 0.00,
  `cc` decimal(18,2) NOT NULL DEFAULT 0.00,
  `tc` decimal(18,2) NOT NULL DEFAULT 0.00,
  `grandtotal` decimal(8,2) NOT NULL DEFAULT 0.00,
  `prevbalance` decimal(8,2) NOT NULL DEFAULT 0.00,
  `paidamount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `fpaid` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farmer_sessions`
--

CREATE TABLE `farmer_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_price` decimal(8,2) NOT NULL,
  `sell_price` decimal(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reward_percentage` decimal(8,2) NOT NULL DEFAULT 0.00,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cr` decimal(8,2) DEFAULT NULL,
  `dr` decimal(8,2) DEFAULT NULL,
  `amount` decimal(8,2) NOT NULL,
  `date` int(11) NOT NULL,
  `identifire` int(11) NOT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ledgers`
--

INSERT INTO `ledgers` (`id`, `title`, `cr`, `dr`, `amount`, `date`, `identifire`, `foreign_key`, `year`, `month`, `session`, `user_id`, `created_at`, `updated_at`, `type`) VALUES
(1, 'Opening Balance', '1000.00', NULL, '1000.00', 20790713, 101, NULL, '2079', '7', '1', 5, '2022-10-29 12:40:33', '2022-10-29 12:40:33', 1),
(2, 'Opening Balance', NULL, '500.00', '500.00', 20221101, 113, NULL, '2022', '11', '1', 14, '2022-11-01 02:54:53', '2022-11-01 02:54:53', 2);

-- --------------------------------------------------------

--
-- Table structure for table `manufactureitems`
--

CREATE TABLE `manufactureitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manufacture_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `req_qty` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manufactures`
--

CREATE TABLE `manufactures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_27_104030_create_centers_table', 1),
(5, '2020_12_01_054341_create_milkdatas_table', 1),
(6, '2020_12_02_155535_create_snffats_table', 1),
(7, '2020_12_02_160357_create_ledgers_table', 1),
(8, '2020_12_02_161125_create_items_table', 1),
(9, '2020_12_03_101608_add_reward_to_items_table', 1),
(10, '2020_12_04_165417_create_sellitems_table', 1),
(11, '2020_12_04_170017_create_advances_table', 1),
(12, '2020_12_04_170232_create_expenses_table', 1),
(13, '2020_12_04_170843_create_supplierbills_table', 1),
(14, '2020_12_04_171724_create_supplierbillitems_table', 1),
(15, '2020_12_04_172539_create_distributers_table', 1),
(16, '2020_12_04_172906_create_distributerreqs_table', 1),
(17, '2020_12_04_173106_create_employees_table', 1),
(18, '2020_12_04_173423_create_products_table', 1),
(19, '2020_12_04_173502_create_orders_table', 1),
(20, '2020_12_04_173543_create_supplierpayments_table', 1),
(21, '2020_12_04_173604_create_farmerpayments_table', 1),
(22, '2020_12_09_062845_add_number_to_items_table', 1),
(23, '2020_12_09_063431_add_date_to_sellitems_table', 1),
(24, '2020_12_15_073024_add_number_to_users_table', 1),
(25, '2020_12_16_093524_add_date_to_advances_table', 1),
(26, '2020_12_18_055127_create_distributorsells_table', 1),
(27, '2020_12_20_072743_create_farmers_table', 1),
(28, '2020_12_21_060224_add_rate_to_centers_table', 1),
(29, '2020_12_22_065925_add_type_to_ledgers_table', 1),
(30, '2020_12_26_093448_create_farmer_reports_table', 1),
(31, '2020_12_26_175245_create_distributor_payments_table', 1),
(32, '2020_12_27_040029_create_session_watches_table', 1),
(33, '2020_12_27_040400_add_session_to_farmer_reports_table', 1),
(34, '2020_12_28_070730_create_farmer_sessions_table', 1),
(35, '2020_12_29_060909_add_bonus_to_centers', 1),
(36, '2020_12_29_063355_add_bonus_to_farmer_reports', 1),
(37, '2020_12_30_025422_create_employee_advances_table', 1),
(38, '2020_12_30_034648_create_employee_reports_table', 1),
(39, '2020_12_31_095554_add_tc_to_centers_table', 1),
(40, '2020_12_31_104742_add_product_id_to_distributorsells_table', 1),
(41, '2020_12_31_192949_add_cc_to_farmer_reports_table', 1),
(42, '2021_01_01_064856_add_grandtotal_to_farmer_reports_table', 1),
(43, '2021_01_05_083338_create_milk_payments_table', 1),
(44, '2021_01_16_084548_add_prevbalance_to_farmer_reports_table', 1),
(45, '2021_01_17_073432_add_cc_to_farmers_table', 1),
(46, '2021_01_17_115424_add_paid_to_farmer_reports_table', 1),
(47, '2021_01_24_174302_add_item_to_distributerreqs_table', 1),
(48, '2021_02_06_123026_add_stock_to_products_table', 1),
(49, '2021_02_06_125928_create_bills_table', 1),
(50, '2021_02_06_125944_create_bill_items_table', 1),
(51, '2021_02_09_062642_create_manufactures_table', 1),
(52, '2021_02_09_063059_create_manufactureitems_table', 1),
(53, '2021_02_11_095701_add_dis_to_bills_table', 1),
(54, '2021_02_14_102001_create_salary_payments_table', 1),
(55, '2021_02_17_072432_create_product_purchases_table', 1),
(56, '2021_02_17_073048_create_product_purchase_items_table', 1),
(57, '2021_02_17_085118_add_fpaid_to_farmer_reports_table', 1),
(58, '2021_02_22_054940_create_aboutuses_table', 1),
(59, '2021_02_22_064427_create_sliders_table', 1),
(60, '2021_02_22_081738_create_galleries_table', 1),
(61, '2021_02_23_080127_create_expcategories_table', 1),
(62, '2021_02_23_081904_add_extra_to_expenses_table', 1),
(63, '2021_02_24_055927_add_title_to_employee_advances_table', 1),
(64, '2021_02_28_165247_add_tchange_to_supplierbills_table', 1),
(65, '2021_03_27_173042_add_acc_to_employees_table', 1),
(66, '2021_06_26_151748_create_employee_sessions_table', 1),
(67, '2021_07_06_092001_add_tax_to_bills_table', 1),
(68, '2021_07_06_092433_create_bill_expenses_table', 1),
(69, '2021_07_15_133509_add_batch_to_supplierbillitems_table', 1),
(70, '2021_07_16_022011_create_center_stocks_table', 1),
(71, '2021_07_16_054523_add_credit_limit_to_distributers_table', 1),
(72, '2021_07_16_132430_add_last_sms_date_to_distributers_table', 1),
(73, '2021_07_18_074919_remove_product_id_from_bill_items_table', 1),
(74, '2021_07_18_075138_create_customers_table', 1),
(75, '2021_07_18_142900_create_customer_payments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `milkdatas`
--

CREATE TABLE `milkdatas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `m_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `e_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `date` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `milkdatas`
--

INSERT INTO `milkdatas` (`id`, `m_amount`, `e_amount`, `date`, `user_id`, `center_id`, `created_at`, `updated_at`) VALUES
(1, '50.00', '0.00', 20221101, 5, 1, '2022-10-31 18:04:29', '2022-10-31 18:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `milk_payments`
--

CREATE TABLE `milk_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qty` decimal(8,2) NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `date` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minqty` decimal(8,2) NOT NULL,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hasdiscount` tinyint(1) NOT NULL DEFAULT 0,
  `discount` decimal(8,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_purchases`
--

CREATE TABLE `product_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` int(11) NOT NULL,
  `billno` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase_items`
--

CREATE TABLE `product_purchase_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(8,2) NOT NULL,
  `qty` decimal(8,2) NOT NULL,
  `product_purchase_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_payments`
--

CREATE TABLE `salary_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_detail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sellitems`
--

CREATE TABLE `sellitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `qty` decimal(8,2) NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `paid` decimal(8,2) NOT NULL,
  `due` decimal(8,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session_watches`
--

CREATE TABLE `session_watches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `snffats`
--

CREATE TABLE `snffats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `snf` decimal(8,2) NOT NULL,
  `fat` decimal(8,2) NOT NULL,
  `date` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplierbillitems`
--

CREATE TABLE `supplierbillitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `qty` decimal(8,2) NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `supplierbill_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `remaning` decimal(18,2) NOT NULL DEFAULT 0.00,
  `has_expairy` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplierbills`
--

CREATE TABLE `supplierbills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `billno` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` int(11) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `paid` decimal(8,2) NOT NULL,
  `due` decimal(8,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transport_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `taxable` decimal(18,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(18,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `canceled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplierpayments`
--

CREATE TABLE `supplierpayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `date` int(11) NOT NULL,
  `payment_detail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `amounttype` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `role`, `password`, `amount`, `amounttype`, `remember_token`, `created_at`, `updated_at`, `no`) VALUES
(1, 'Laravel', '9852059171', 'Ramailo, Morang', 0, '$2y$10$YRYs2/vyi72JpVs4CTi.HuX4rpCx4cFgCotfyYo3x1d0buUzr6K3i', '0.00', NULL, '1rBky1coxpENciYjwAfKNgAF98xFLx7OLdJtG4IjT4bDl4P8TZVixYuGK0pC', '2022-10-29 11:28:07', '2022-10-29 11:28:07', NULL),
(2, 'Nawa Durga', '9800916365', 'Ramailo, Morang', -1, '$2y$10$3gYGf.086TMpbguV3T1ePu8HcTrskXkorh5x2A7y28sa78jm68Uma', '0.00', NULL, NULL, '2022-10-29 11:28:08', '2022-10-29 11:28:08', NULL),
(3, 'Md.Habibullah Mezbah', '01722734209', 'House # 47,Road # 02,Katkipara,ideal more,R.K Road, Rangpur.', 0, '$2y$10$5zUgj1DuDQIjhuF13QmrZus8Ih9XE/uzq2a5Ss9Gk8mAETqkXnMgK', '0.00', NULL, 'yw5ArZs4JYafBWszsRHWqrht8n9NXCIUT2h00igBTUTbwv7FZdbpRcZ2lz2d', '2022-10-29 11:40:11', '2022-10-29 11:40:11', NULL),
(4, 'Md.Habibullah Mezbah', '01722734209', 'House # 47,Road # 02,Katkipara,ideal more,R.K Road, Rangpur.', 4, '$2y$10$YVbzFsNKGUq76xt9B/KV..fiNISs5KToQ5An3Bc5oFvjl/Z9jR/xm', '0.00', NULL, NULL, '2022-10-29 12:31:07', '2022-10-29 12:31:07', NULL),
(5, 'Mokbul', '01722734207', 'Mohammadpur', 1, '$2y$10$EYIs18Q88GyNqrwqNJwsPereUu.ICUkVmAVjlzoMfQzJAUgBLM9/y', '1000.00', 1, NULL, '2022-10-29 12:40:33', '2022-10-29 12:40:33', 1),
(6, 'julkar nine', '01722734209', 'House # 47,Road # 02,Katkipara,ideal more,R.K Road, Rangpur.', 2, '$2y$10$J74tADY9YB/h3DfKQeA2veOy.13jwVIfu3h.uHQeQdokqPbw0Ff7m', '500.00', 2, NULL, '2022-10-31 18:33:47', '2022-10-31 18:33:47', NULL),
(7, 'nazmul', '01720596176', 'Dhaka', 1, '$2y$10$r0yan2IUtHcpPqVFWUIrYuu47TgFiEetxZokNfgIyxAWSLQQTXPpa', '0.00', NULL, NULL, '2022-11-01 02:06:17', '2022-11-01 02:06:17', 2),
(8, 'nazmul', '01720596176', 'Dhaka', 1, '$2y$10$YsthzwSz.nm2qI779jWtPuEqn2bVeo5IR79ovdxvg8Jwq3q2/7q2i', '0.00', NULL, NULL, '2022-11-01 02:06:19', '2022-11-01 02:06:19', 2),
(9, 'nazmul', '01720596176', 'Dhaka', 1, '$2y$10$Q3BWTOo0udaY2aqhrHwjj.gj/Xbi7K6i4kdx2dNDmmPgFnoXZsWPS', '0.00', NULL, NULL, '2022-11-01 02:06:21', '2022-11-01 02:06:21', 2),
(10, 'Nazmul', '54756868678', 'Dhaka', 1, '$2y$10$S/llehA9pV7BvCKwjZLKb.tVrWnhYdincorOWUjRHJ3rrWonOF05W', '0.00', NULL, NULL, '2022-11-01 02:09:24', '2022-11-01 02:09:24', 2),
(11, 'Nazmul', '54756868678', 'Dhaka', 1, '$2y$10$OisW0YyPgBPB9NCovXGraOkr5rFQL4Ia4H1hENyC2156C9O4Mizv2', '0.00', NULL, NULL, '2022-11-01 02:09:25', '2022-11-01 02:09:25', 2),
(12, 'Nazmul', '54756868678', 'Dhaka', 1, '$2y$10$dt72FYqQYd42hROTF4T7zeH47LapcCH6UJ3BCiHoM9.S.nqZlBxJi', '0.00', NULL, NULL, '2022-11-01 02:09:26', '2022-11-01 02:09:26', 2),
(13, 'Nazmul', '54756868678', 'Dhaka', 1, '$2y$10$9i25Y3TnidZtYXroYRXg0O/uol.00uB7BDcESuK6V9x/Y62Pp3/4q', '0.00', NULL, NULL, '2022-11-01 02:09:28', '2022-11-01 02:09:28', 2),
(14, 'Md.Habibullah Mezbah', '01722734209', 'House # 47,Road # 02,Katkipara,ideal more,R.K Road, Rangpur.', 4, '$2y$10$g9By40UId8Hf4MPgzV7T6u6oRJ/DD/rnYg0tvQ1/28X8dLrrv1GL2', '500.00', 2, NULL, '2022-11-01 02:54:25', '2022-11-01 02:54:53', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutuses`
--
ALTER TABLE `aboutuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advances`
--
ALTER TABLE `advances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advances_user_id_foreign` (`user_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_user_id_foreign` (`user_id`);

--
-- Indexes for table `bill_expenses`
--
ALTER TABLE `bill_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_expenses_supplierbill_id_foreign` (`supplierbill_id`);

--
-- Indexes for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_items_bill_id_foreign` (`bill_id`),
  ADD KEY `bill_items_item_id_foreign` (`item_id`);

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `center_stocks`
--
ALTER TABLE `center_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `center_stocks_center_id_foreign` (`center_id`),
  ADD KEY `center_stocks_item_id_foreign` (`item_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `distributerreqs`
--
ALTER TABLE `distributerreqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distributerreqs_user_id_foreign` (`user_id`);

--
-- Indexes for table `distributers`
--
ALTER TABLE `distributers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distributers_user_id_foreign` (`user_id`);

--
-- Indexes for table `distributorsells`
--
ALTER TABLE `distributorsells`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distributorsells_distributer_id_foreign` (`distributer_id`),
  ADD KEY `distributorsells_product_id_foreign` (`product_id`);

--
-- Indexes for table `distributor_payments`
--
ALTER TABLE `distributor_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_payemnt` (`user_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_user_id_foreign` (`user_id`);

--
-- Indexes for table `employee_advances`
--
ALTER TABLE `employee_advances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_advances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_reports`
--
ALTER TABLE `employee_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_reports_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_sessions`
--
ALTER TABLE `employee_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_sessions_user_id_foreign` (`user_id`);

--
-- Indexes for table `expcategories`
--
ALTER TABLE `expcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_user_id_foreign` (`user_id`),
  ADD KEY `expenses_expcategory_id_foreign` (`expcategory_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `farmerpayments`
--
ALTER TABLE `farmerpayments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmerpayments_user_id_foreign` (`user_id`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmers_center_id_foreign` (`center_id`),
  ADD KEY `farmers_user_id_foreign` (`user_id`);

--
-- Indexes for table `farmer_reports`
--
ALTER TABLE `farmer_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmer_reports_user_id_foreign` (`user_id`),
  ADD KEY `farmer_reports_center_id_foreign` (`center_id`);

--
-- Indexes for table `farmer_sessions`
--
ALTER TABLE `farmer_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmer_sessions_user_id_foreign` (`user_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `items_number_unique` (`number`);

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ledgers_user_id_foreign` (`user_id`);

--
-- Indexes for table `manufactureitems`
--
ALTER TABLE `manufactureitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufactureitems_manufacture_id_foreign` (`manufacture_id`),
  ADD KEY `manufactureitems_product_id_foreign` (`product_id`);

--
-- Indexes for table `manufactures`
--
ALTER TABLE `manufactures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufactures_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkdatas`
--
ALTER TABLE `milkdatas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `milkdatas_user_id_foreign` (`user_id`),
  ADD KEY `milkdatas_center_id_foreign` (`center_id`);

--
-- Indexes for table `milk_payments`
--
ALTER TABLE `milk_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `milk_payments_user_id_foreign` (`user_id`),
  ADD KEY `milk_payments_center_id_foreign` (`center_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_product_id_foreign` (`product_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_purchases`
--
ALTER TABLE `product_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_purchase_items`
--
ALTER TABLE `product_purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_purchase_items_product_purchase_id_foreign` (`product_purchase_id`),
  ADD KEY `product_purchase_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `salary_payments`
--
ALTER TABLE `salary_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salary_payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `sellitems`
--
ALTER TABLE `sellitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellitems_user_id_foreign` (`user_id`),
  ADD KEY `sellitems_item_id_foreign` (`item_id`);

--
-- Indexes for table `session_watches`
--
ALTER TABLE `session_watches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_watches_center_id_foreign` (`center_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snffats`
--
ALTER TABLE `snffats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `snffats_user_id_foreign` (`user_id`),
  ADD KEY `snffats_center_id_foreign` (`center_id`);

--
-- Indexes for table `supplierbillitems`
--
ALTER TABLE `supplierbillitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplierbillitems_item_id_foreign` (`item_id`),
  ADD KEY `supplierbillitems_supplierbill_id_foreign` (`supplierbill_id`);

--
-- Indexes for table `supplierbills`
--
ALTER TABLE `supplierbills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplierbills_user_id_foreign` (`user_id`);

--
-- Indexes for table `supplierpayments`
--
ALTER TABLE `supplierpayments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplierpayments_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutuses`
--
ALTER TABLE `aboutuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advances`
--
ALTER TABLE `advances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_expenses`
--
ALTER TABLE `bill_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `center_stocks`
--
ALTER TABLE `center_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_payments`
--
ALTER TABLE `customer_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distributerreqs`
--
ALTER TABLE `distributerreqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distributers`
--
ALTER TABLE `distributers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distributorsells`
--
ALTER TABLE `distributorsells`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distributor_payments`
--
ALTER TABLE `distributor_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_advances`
--
ALTER TABLE `employee_advances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_reports`
--
ALTER TABLE `employee_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_sessions`
--
ALTER TABLE `employee_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expcategories`
--
ALTER TABLE `expcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmerpayments`
--
ALTER TABLE `farmerpayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `farmer_reports`
--
ALTER TABLE `farmer_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmer_sessions`
--
ALTER TABLE `farmer_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manufactureitems`
--
ALTER TABLE `manufactureitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufactures`
--
ALTER TABLE `manufactures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `milkdatas`
--
ALTER TABLE `milkdatas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `milk_payments`
--
ALTER TABLE `milk_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_purchases`
--
ALTER TABLE `product_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_purchase_items`
--
ALTER TABLE `product_purchase_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_payments`
--
ALTER TABLE `salary_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellitems`
--
ALTER TABLE `sellitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session_watches`
--
ALTER TABLE `session_watches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `snffats`
--
ALTER TABLE `snffats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplierbillitems`
--
ALTER TABLE `supplierbillitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplierbills`
--
ALTER TABLE `supplierbills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplierpayments`
--
ALTER TABLE `supplierpayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advances`
--
ALTER TABLE `advances`
  ADD CONSTRAINT `advances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bill_expenses`
--
ALTER TABLE `bill_expenses`
  ADD CONSTRAINT `bill_expenses_supplierbill_id_foreign` FOREIGN KEY (`supplierbill_id`) REFERENCES `supplierbills` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD CONSTRAINT `bill_items_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `center_stocks`
--
ALTER TABLE `center_stocks`
  ADD CONSTRAINT `center_stocks_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `center_stocks_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD CONSTRAINT `customer_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `distributerreqs`
--
ALTER TABLE `distributerreqs`
  ADD CONSTRAINT `distributerreqs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `distributers`
--
ALTER TABLE `distributers`
  ADD CONSTRAINT `distributers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `distributorsells`
--
ALTER TABLE `distributorsells`
  ADD CONSTRAINT `distributorsells_distributer_id_foreign` FOREIGN KEY (`distributer_id`) REFERENCES `distributers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `distributorsells_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `distributor_payments`
--
ALTER TABLE `distributor_payments`
  ADD CONSTRAINT `d_payemnt` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_advances`
--
ALTER TABLE `employee_advances`
  ADD CONSTRAINT `employee_advances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_reports`
--
ALTER TABLE `employee_reports`
  ADD CONSTRAINT `employee_reports_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_sessions`
--
ALTER TABLE `employee_sessions`
  ADD CONSTRAINT `employee_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_expcategory_id_foreign` FOREIGN KEY (`expcategory_id`) REFERENCES `expcategories` (`id`),
  ADD CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `farmerpayments`
--
ALTER TABLE `farmerpayments`
  ADD CONSTRAINT `farmerpayments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `farmers`
--
ALTER TABLE `farmers`
  ADD CONSTRAINT `farmers_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `farmers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `farmer_reports`
--
ALTER TABLE `farmer_reports`
  ADD CONSTRAINT `farmer_reports_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`),
  ADD CONSTRAINT `farmer_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `farmer_sessions`
--
ALTER TABLE `farmer_sessions`
  ADD CONSTRAINT `farmer_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD CONSTRAINT `ledgers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `manufactureitems`
--
ALTER TABLE `manufactureitems`
  ADD CONSTRAINT `manufactureitems_manufacture_id_foreign` FOREIGN KEY (`manufacture_id`) REFERENCES `manufactures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `manufactureitems_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `manufactures`
--
ALTER TABLE `manufactures`
  ADD CONSTRAINT `manufactures_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `milkdatas`
--
ALTER TABLE `milkdatas`
  ADD CONSTRAINT `milkdatas_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `milkdatas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `milk_payments`
--
ALTER TABLE `milk_payments`
  ADD CONSTRAINT `milk_payments_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `milk_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_purchase_items`
--
ALTER TABLE `product_purchase_items`
  ADD CONSTRAINT `product_purchase_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_purchase_items_product_purchase_id_foreign` FOREIGN KEY (`product_purchase_id`) REFERENCES `product_purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salary_payments`
--
ALTER TABLE `salary_payments`
  ADD CONSTRAINT `salary_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sellitems`
--
ALTER TABLE `sellitems`
  ADD CONSTRAINT `sellitems_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sellitems_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `session_watches`
--
ALTER TABLE `session_watches`
  ADD CONSTRAINT `session_watches_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`);

--
-- Constraints for table `snffats`
--
ALTER TABLE `snffats`
  ADD CONSTRAINT `snffats_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `snffats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supplierbillitems`
--
ALTER TABLE `supplierbillitems`
  ADD CONSTRAINT `supplierbillitems_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `supplierbillitems_supplierbill_id_foreign` FOREIGN KEY (`supplierbill_id`) REFERENCES `supplierbills` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supplierbills`
--
ALTER TABLE `supplierbills`
  ADD CONSTRAINT `supplierbills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supplierpayments`
--
ALTER TABLE `supplierpayments`
  ADD CONSTRAINT `supplierpayments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
