-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2023 at 08:52 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mycommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_confirmed` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `vendor_id`, `mobile`, `email`, `password`, `image`, `email_confirmed`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Adhyaksa Setiabudi', 'superadmin', 0, '62999999993', 'admin@admin.com', '$2y$10$mPNRGqHi/NKZvIC14LlmqOYaQupmuMFiUcc.Vj9/BhdIK/6A3X5h.', '80425.png', 'No', 1, NULL, '2022-12-04 01:27:38'),
(2, 'John Dee', 'vendor', 1, '081224854565', 'john@admin.com', '$2a$12$3BdO6yhwTeJYZ/czU/riNe2zYcuL9W6mxI65CpuuzLTjkkJm0RCOm', '27001.jpg', 'No', 1, NULL, '2022-12-04 01:31:07'),
(3, 'Adhyaksa Setiabudi', 'vendor', 3, '082334189965', 'adhyaksasb@yxgkuy.com', '$2y$10$vvpktYULfI/bbujCjbPcF.QbCCA.2pJX8KBJBoYx91an5UOiIVDN2', NULL, 'No', 1, '2022-12-06 09:37:45', '2022-12-07 08:50:26'),
(4, 'Joseph Kye', 'vendor', 4, '823435393214', 'fdsfseqwe@dawqe.com', '$2y$10$ZoXs1fq9KZCsH1j6OrRm4OOQZqCj2ZTgq5iC0RIanV0doGD4V/bv6', '', 'Yes', 1, '2022-12-06 11:35:05', '2023-01-01 09:09:16'),
(5, 'Mary Jane', 'vendor', 5, '082342512348', 'maryjanemarontong@gmail.com', '$2y$10$OODuYT9LgPStN2t/8B3Hv.Jy1sw.S9lwclfKvUAruHftN07vznUWO', NULL, 'Yes', 1, '2022-12-06 11:39:47', '2022-12-07 09:19:42'),
(6, 'Adhyaksa Setiabudi', 'vendor', 6, '0812349798954', 'dee@gyure.com', '$2y$10$XdNnvtA5VFsIF0GSwiKTdOByaz3Exw9TDcmz5x4U3jwXkva8ECs4S', '', 'Yes', 1, '2022-12-06 12:30:19', '2023-01-01 07:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `type`, `title`, `alt`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'banner-1.png', 'Slider', 'Spring Collection', 'Spring Collection', 'spring-collection', 1, NULL, '2022-11-25 11:36:13'),
(2, 'banner-3243.png', 'Slider', 'Tops (Summer Collection)', 'Tops (Summer Collection)', 'tops-summer-collection', 1, '2022-11-25 08:52:50', '2022-11-25 11:36:32'),
(5, 'banner-132942.jpg', 'Fixed', 'Half Sale', 'Half Sale', 'half-sale', 1, '2022-11-25 11:35:06', '2022-11-25 11:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Samsung', 1, NULL, '2022-11-03 17:12:52'),
(2, 'Apple', 1, NULL, NULL),
(3, 'Panasonic', 1, NULL, '2022-11-03 17:12:53'),
(4, 'LG', 1, NULL, NULL),
(5, 'Lenovo', 1, NULL, NULL),
(6, 'MSI', 1, NULL, NULL),
(7, 'Lee Cooper', 1, NULL, NULL),
(8, 'Hush Puppies', 1, '2022-11-03 17:15:36', '2022-11-03 17:15:50'),
(9, 'Others', 1, '2022-11-03 17:17:41', '2022-11-03 17:17:41'),
(10, 'H&M', 1, '2022-11-26 12:56:24', '2022-11-26 12:56:24'),
(11, 'Nike', 1, '2022-11-27 04:25:56', '2022-11-27 04:25:56'),
(12, 'VANS', 1, '2022-11-29 04:31:33', '2022-11-29 04:31:33'),
(13, 'BOSS', 1, '2022-11-29 04:31:47', '2022-11-29 04:31:47'),
(14, 'Xiaomi', 1, '2022-12-05 14:05:37', '2022-12-05 14:05:37'),
(15, 'ASUS', 1, '2022-12-05 14:06:21', '2022-12-05 14:06:21'),
(16, 'MSI', 1, '2022-12-05 14:06:28', '2022-12-05 14:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_discount` double(8,2) DEFAULT 0.00,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `section_id`, `category_name`, `category_image`, `category_discount`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Clothings', '', 0.00, NULL, 'men/clothings', 'fashions men', 'men\'s fashions', 'fashions men', 1, NULL, '2022-11-26 05:04:20'),
(2, 0, 1, 'Shoes', NULL, 0.00, NULL, 'men/shoes', NULL, NULL, NULL, 1, '2022-11-26 04:24:38', '2022-11-26 05:04:31'),
(3, 0, 1, 'Accessories', NULL, 0.00, NULL, 'men/accessories', NULL, NULL, NULL, 1, '2022-11-26 04:27:07', '2022-11-26 05:04:41'),
(4, 0, 2, 'Clothings', NULL, 0.00, NULL, 'women/clothings', NULL, NULL, NULL, 1, '2022-11-26 04:28:03', '2022-11-26 04:28:03'),
(5, 0, 2, 'Shoes', NULL, 0.00, NULL, 'women/shoes', NULL, NULL, NULL, 1, '2022-11-26 04:41:38', '2022-11-26 04:42:41'),
(6, 0, 2, 'Accessories', NULL, 0.00, NULL, 'women/accessories', NULL, NULL, NULL, 1, '2022-11-26 04:44:36', '2022-11-26 04:44:36'),
(7, 0, 3, 'Boy\'s Clothings', NULL, 0.00, NULL, 'kids/boy-clothings', NULL, NULL, NULL, 1, '2022-11-26 04:47:08', '2022-11-26 04:47:08'),
(8, 0, 3, 'Girl\'s Clothings', NULL, 0.00, NULL, 'kids/girl-clothings', NULL, NULL, NULL, 1, '2022-11-26 04:47:41', '2022-11-26 05:11:27'),
(9, 0, 3, 'Baby\'s Clothings', NULL, 0.00, NULL, 'kids/baby-clothings', NULL, NULL, NULL, 1, '2022-11-26 04:48:30', '2022-11-26 04:48:30'),
(10, 0, 3, 'Boy\'s Shoes', NULL, 0.00, NULL, 'kids/boy-shoes', '', NULL, NULL, 1, '2022-11-26 05:03:50', '2022-11-26 05:03:50'),
(11, 0, 3, 'Girl\'s Shoes', NULL, 0.00, NULL, 'kids/girl-shoes', NULL, NULL, NULL, 1, '2022-11-26 05:09:45', '2022-11-26 05:09:45'),
(12, 0, 3, 'Baby\'s Shoes', NULL, 0.00, NULL, 'kids/baby-shoes', NULL, NULL, NULL, 1, '2022-11-26 05:11:12', '2022-11-26 05:11:12'),
(13, 1, 1, 'T-Shirts', NULL, 0.00, NULL, 'men/clothings/t-shirts', NULL, NULL, NULL, 1, '2022-11-26 05:14:44', '2022-11-26 05:14:44'),
(14, 1, 1, 'Shirts', NULL, 0.00, NULL, 'men/clothings/shirts', NULL, NULL, NULL, 1, '2022-11-26 05:15:29', '2022-11-26 05:15:54'),
(15, 1, 1, 'Polo Shirt', NULL, 0.00, NULL, 'men/clothings/polo-shirts', NULL, NULL, NULL, 1, '2022-11-26 05:17:28', '2022-11-26 05:17:28'),
(16, 1, 1, 'Outerwear', NULL, 0.00, NULL, 'men/clothings/outerwear', NULL, NULL, NULL, 1, '2022-11-26 05:18:17', '2022-11-26 05:18:17'),
(17, 1, 1, 'Formalwear', NULL, 0.00, NULL, 'men/clothings/formalwear', NULL, NULL, NULL, 0, '2022-11-26 05:45:41', '2022-11-30 13:13:28'),
(18, 1, 1, 'Sportswear', NULL, 0.00, NULL, 'men/clothings/sportswear', NULL, NULL, NULL, 1, '2022-11-26 05:47:08', '2022-11-26 05:47:08'),
(19, 1, 1, 'Underwear & Loungewear', NULL, 0.00, NULL, 'men/clothings/underwear-loungewear', NULL, NULL, NULL, 1, '2022-11-26 05:47:49', '2022-11-26 05:47:49'),
(20, 1, 1, 'Pants', NULL, 0.00, NULL, 'men/clothings/pants', NULL, NULL, NULL, 1, '2022-11-26 05:49:52', '2022-11-26 05:49:52'),
(21, 1, 1, 'Shorts', NULL, 0.00, NULL, 'men/clothings/shorts', NULL, NULL, NULL, 1, '2022-11-26 05:50:08', '2022-11-26 05:50:08'),
(22, 1, 1, 'Jeans & Denims', NULL, 0.00, NULL, 'men/clothings/jeans-denims', NULL, NULL, NULL, 1, '2022-11-26 05:51:27', '2022-11-26 06:29:59'),
(23, 1, 1, 'Beachwear', NULL, 0.00, NULL, 'men/clothings/beachwear', NULL, NULL, NULL, 1, '2022-11-26 05:51:44', '2022-11-26 05:51:44'),
(24, 2, 1, 'Sneakers', NULL, 0.00, NULL, 'men/shoes/sneakers', NULL, NULL, NULL, 1, '2022-11-26 05:52:46', '2022-11-26 05:52:46'),
(25, 2, 1, 'Loafers', NULL, 0.00, NULL, 'men/shoes/loafers', NULL, NULL, NULL, 1, '2022-11-26 05:53:13', '2022-11-26 05:53:13'),
(26, 2, 1, 'Slip On & Espadrilles', NULL, 0.00, NULL, 'men/shoes/slip-on', NULL, NULL, NULL, 1, '2022-11-26 05:54:34', '2022-11-26 05:54:34'),
(27, 2, 1, 'Boots', NULL, 0.00, NULL, 'men/shoes/boots', NULL, NULL, NULL, 1, '2022-11-26 05:55:41', '2022-11-26 05:55:41'),
(28, 2, 1, 'Formal Shoes', NULL, 0.00, NULL, 'men/shoes/formal', NULL, NULL, NULL, 1, '2022-11-26 05:56:27', '2022-11-26 05:56:27'),
(29, 2, 1, 'Sandals & Flip-Flops', NULL, 0.00, NULL, 'men/shoes/sandals-flip-flops', NULL, NULL, NULL, 1, '2022-11-26 05:57:11', '2022-11-26 06:37:30'),
(30, 2, 1, 'Sports Shoes', NULL, 0.00, NULL, 'men/shoes/sports', NULL, NULL, NULL, 1, '2022-11-26 05:58:04', '2022-11-26 05:58:04'),
(31, 2, 1, 'Shoes Accessories', NULL, 0.00, NULL, 'men/shoes/accessories', NULL, NULL, NULL, 1, '2022-11-26 05:59:57', '2022-11-26 05:59:57'),
(32, 3, 1, 'Watches', NULL, 0.00, NULL, 'men/accessories/watches', NULL, NULL, NULL, 1, '2022-11-26 06:00:50', '2022-11-26 06:00:50'),
(33, 3, 1, 'Wallets', NULL, 0.00, NULL, 'men/accessories/wallets', NULL, NULL, NULL, 1, '2022-11-26 06:01:54', '2022-11-26 06:46:43'),
(34, 3, 1, 'Belts', NULL, 0.00, NULL, 'men/accessories/belts', NULL, NULL, NULL, 1, '2022-11-26 06:03:04', '2022-11-26 06:03:04'),
(35, 3, 1, 'Glasses', NULL, 0.00, NULL, 'men/accessories/glasses', NULL, NULL, NULL, 1, '2022-11-26 06:04:10', '2022-11-26 06:04:10'),
(36, 3, 1, 'Neckties', NULL, 0.00, NULL, 'men/accessories/neckties', NULL, NULL, NULL, 1, '2022-11-26 06:04:32', '2022-11-26 06:04:32'),
(37, 3, 1, 'Headwear', NULL, 0.00, NULL, 'men/accessories/headwear', NULL, NULL, NULL, 1, '2022-11-26 06:07:32', '2022-11-26 06:07:32'),
(38, 3, 1, 'Scarf', NULL, 0.00, NULL, 'men/accessories/scarf', NULL, NULL, NULL, 1, '2022-11-26 06:08:32', '2022-11-26 06:08:32'),
(39, 3, 1, 'Jewelry', NULL, 0.00, NULL, 'men/accessories/jewelry', NULL, NULL, NULL, 1, '2022-11-26 06:09:28', '2022-11-26 06:09:28'),
(40, 3, 1, 'Bags', NULL, 0.00, NULL, 'men/accessories/bags', NULL, NULL, NULL, 1, '2022-11-26 06:13:02', '2022-11-26 06:13:02'),
(41, 4, 2, 'Tops', NULL, 0.00, NULL, 'women/clothings/tops', NULL, NULL, NULL, 1, '2022-11-26 06:19:56', '2022-11-26 06:19:56'),
(42, 4, 2, 'Dress', NULL, 0.00, NULL, 'women/clothings/dress', NULL, NULL, NULL, 1, '2022-11-26 06:20:54', '2022-11-26 06:20:54'),
(43, 4, 2, 'Outerwear', NULL, 0.00, NULL, 'women/clothings/outerwear', NULL, NULL, NULL, 1, '2022-11-26 06:22:13', '2022-11-26 06:22:13'),
(44, 4, 2, 'Formalwear', NULL, 0.00, NULL, 'women/clothings/formalwear', NULL, NULL, NULL, 0, '2022-11-26 06:23:27', '2022-11-30 13:13:35'),
(45, 4, 2, 'Sportswear', NULL, 0.00, NULL, 'women/clothings/Sportswear', NULL, NULL, NULL, 1, '2022-11-26 06:23:57', '2022-11-26 06:23:57'),
(46, 4, 2, 'Underwear & Loungewear', NULL, 0.00, NULL, 'women/clothings/underwear-loungewear', NULL, NULL, NULL, 1, '2022-11-26 06:24:44', '2022-11-26 06:24:44'),
(47, 3, 1, 'Socks', NULL, 0.00, NULL, 'men/accessories/socks', NULL, NULL, NULL, 1, '2022-11-26 06:26:27', '2022-11-26 06:26:27'),
(48, 4, 2, 'Pants & Leggings', NULL, 0.00, NULL, 'women/clothings/pants-leggings', NULL, NULL, NULL, 1, '2022-11-26 06:27:19', '2022-11-26 06:27:19'),
(49, 4, 2, 'Shorts', NULL, 0.00, NULL, 'women/clothings/shorts', NULL, NULL, NULL, 1, '2022-11-26 06:27:45', '2022-11-26 06:27:45'),
(50, 4, 2, 'Skirts', NULL, 0.00, NULL, 'women/clothings/skirts', NULL, NULL, NULL, 1, '2022-11-26 06:28:22', '2022-11-26 06:28:22'),
(51, 4, 2, 'Jeans & Denims', NULL, 0.00, NULL, 'women/clothings/jeans-denims', NULL, NULL, NULL, 1, '2022-11-26 06:29:42', '2022-11-26 06:29:42'),
(52, 4, 2, 'Beachwear', NULL, 0.00, NULL, 'women/clothings/beachwear', NULL, NULL, NULL, 1, '2022-11-26 06:33:42', '2022-11-26 06:33:42'),
(53, 5, 2, 'Flats', NULL, 0.00, NULL, 'women/shoes/flats', NULL, NULL, NULL, 1, '2022-11-26 06:34:22', '2022-11-30 14:01:21'),
(54, 5, 2, 'Heels', NULL, 0.00, NULL, 'women/shoes/heels', NULL, NULL, NULL, 1, '2022-11-26 06:35:02', '2022-11-26 06:35:02'),
(55, 5, 2, 'Sandals', NULL, 0.00, NULL, 'women/shoes/sandals', NULL, NULL, NULL, 1, '2022-11-26 06:36:04', '2022-11-26 06:36:04'),
(56, 5, 2, 'Flip-Flops', NULL, 0.00, NULL, 'women/shoes/flip-flops', NULL, NULL, NULL, 1, '2022-11-26 06:37:11', '2022-11-26 06:37:11'),
(57, 5, 2, 'Wedges', NULL, 0.00, NULL, 'women/shoes/wedges', NULL, NULL, NULL, 1, '2022-11-26 06:38:23', '2022-11-26 06:38:23'),
(58, 5, 2, 'Slip On', NULL, 0.00, NULL, 'women/shoes/slip-on', NULL, NULL, NULL, 1, '2022-11-26 06:39:29', '2022-11-26 06:39:29'),
(59, 5, 2, 'Boots', NULL, 0.00, NULL, 'women/shoes/boots', NULL, NULL, NULL, 1, '2022-11-26 06:40:24', '2022-11-26 06:40:24'),
(60, 5, 2, 'Sneakers', NULL, 0.00, NULL, 'women/shoes/sneakers', NULL, NULL, NULL, 1, '2022-11-26 06:40:41', '2022-11-26 06:40:56'),
(61, 5, 2, 'Sports Shoes', NULL, 0.00, NULL, 'women/shoes/sports', NULL, NULL, NULL, 1, '2022-11-26 06:42:11', '2022-11-26 06:42:11'),
(62, 6, 2, 'Watches', NULL, 0.00, NULL, 'women/accessories/watches', NULL, NULL, NULL, 1, '2022-11-26 06:43:04', '2022-11-26 06:43:04'),
(63, 6, 2, 'Wallets', NULL, 0.00, NULL, 'women/accessories/wallets', NULL, NULL, NULL, 1, '2022-11-26 06:46:25', '2022-11-26 06:46:25'),
(64, 6, 2, 'Jewelry', NULL, 0.00, NULL, 'women/accessories/jewelry', NULL, NULL, NULL, 1, '2022-11-26 06:47:38', '2022-11-26 06:47:38'),
(65, 6, 2, 'Glasses', NULL, 0.00, NULL, 'women/accessories/glasses', NULL, NULL, NULL, 1, '2022-11-26 06:48:12', '2022-11-26 06:48:12'),
(66, 6, 2, 'Headwear', NULL, 0.00, NULL, 'women/accessories/headwear', NULL, NULL, NULL, 1, '2022-11-26 06:49:12', '2022-11-26 06:49:12'),
(67, 6, 2, 'Hair Accessories', NULL, 0.00, NULL, 'women/accessories/hair-accessories', NULL, NULL, NULL, 1, '2022-11-26 06:49:59', '2022-11-26 06:50:27'),
(68, 6, 2, 'Belts', NULL, 0.00, NULL, 'women/accessories/belts', NULL, NULL, NULL, 1, '2022-11-26 06:50:59', '2022-11-26 06:50:59'),
(69, 6, 2, 'Stockings', NULL, 0.00, NULL, 'women/accessories/stockings', NULL, NULL, NULL, 1, '2022-11-26 06:51:58', '2022-11-26 06:51:58'),
(70, 6, 2, 'Socks', NULL, 0.00, NULL, 'women/accessories/socks', NULL, NULL, NULL, 1, '2022-11-26 06:53:02', '2022-11-26 06:53:02'),
(71, 0, 4, 'Mobiles & Tablets', NULL, 0.00, NULL, 'electronics/mobiles-tablets', NULL, NULL, NULL, 1, '2022-11-29 10:47:08', '2022-12-04 02:04:59'),
(72, 71, 4, 'Smartphones', NULL, 0.00, NULL, 'electronics/mobiles-tablets/smartphones', NULL, NULL, NULL, 1, '2022-11-29 10:47:48', '2022-12-04 02:05:24'),
(73, 71, 4, 'Feature Phones', NULL, 0.00, NULL, 'electronics/mobiles-tablets/feature-phones', NULL, NULL, NULL, 1, '2022-11-29 10:48:50', '2022-12-04 02:05:38'),
(74, 71, 4, 'Mobile Phone Accessories', NULL, 0.00, NULL, 'electronics/mobiles-tablets/mobile-accessories', NULL, NULL, NULL, 1, '2022-12-04 01:36:04', '2022-12-04 02:05:55'),
(75, 71, 4, 'Mobile Phone Components', NULL, 0.00, NULL, 'electronics/mobiles/components', NULL, NULL, NULL, 1, '2022-12-04 01:40:04', '2022-12-04 01:40:04'),
(76, 0, 4, 'Computers', NULL, 0.00, NULL, 'electronics/computers', NULL, NULL, NULL, 1, '2022-12-04 01:41:36', '2022-12-04 01:41:36'),
(77, 76, 4, 'Laptops', NULL, 0.00, NULL, 'electronics/computers/laptops', NULL, NULL, NULL, 1, '2022-12-04 01:43:25', '2022-12-04 01:43:25'),
(78, 76, 4, 'PC Bundles', NULL, 0.00, NULL, 'electronics/computers/bundles', NULL, NULL, NULL, 1, '2022-12-04 01:44:46', '2022-12-04 01:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(2, 'AL', 'Albania', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(3, 'DZ', 'Algeria', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(4, 'DS', 'American Samoa', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(5, 'AD', 'Andorra', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(6, 'AO', 'Angola', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(7, 'AI', 'Anguilla', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(8, 'AQ', 'Antarctica', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(9, 'AG', 'Antigua and Barbuda', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(10, 'AR', 'Argentina', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(11, 'AM', 'Armenia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(12, 'AW', 'Aruba', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(13, 'AU', 'Australia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(14, 'AT', 'Austria', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(15, 'AZ', 'Azerbaijan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(16, 'BS', 'Bahamas', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(17, 'BH', 'Bahrain', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(18, 'BD', 'Bangladesh', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(19, 'BB', 'Barbados', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(20, 'BY', 'Belarus', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(21, 'BE', 'Belgium', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(22, 'BZ', 'Belize', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(23, 'BJ', 'Benin', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(24, 'BM', 'Bermuda', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(25, 'BT', 'Bhutan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(26, 'BO', 'Bolivia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(27, 'BA', 'Bosnia and Herzegovina', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(28, 'BW', 'Botswana', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(29, 'BV', 'Bouvet Island', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(30, 'BR', 'Brazil', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(31, 'IO', 'British Indian Ocean Territory', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(32, 'BN', 'Brunei Darussalam', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(33, 'BG', 'Bulgaria', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(34, 'BF', 'Burkina Faso', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(35, 'BI', 'Burundi', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(36, 'KH', 'Cambodia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(37, 'CM', 'Cameroon', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(38, 'CA', 'Canada', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(39, 'CV', 'Cape Verde', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(40, 'KY', 'Cayman Islands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(41, 'CF', 'Central African Republic', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(42, 'TD', 'Chad', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(43, 'CL', 'Chile', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(44, 'CN', 'China', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(45, 'CX', 'Christmas Island', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(46, 'CC', 'Cocos (Keeling) Islands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(47, 'CO', 'Colombia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(48, 'KM', 'Comoros', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(49, 'CD', 'Democratic Republic of the Congo', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(50, 'CG', 'Republic of Congo', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(51, 'CK', 'Cook Islands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(52, 'CR', 'Costa Rica', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(53, 'HR', 'Croatia (Hrvatska)', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(54, 'CU', 'Cuba', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(55, 'CY', 'Cyprus', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(56, 'CZ', 'Czech Republic', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(57, 'DK', 'Denmark', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(58, 'DJ', 'Djibouti', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(59, 'DM', 'Dominica', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(60, 'DO', 'Dominican Republic', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(61, 'TP', 'East Timor', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(62, 'EC', 'Ecuador', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(63, 'EG', 'Egypt', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(64, 'SV', 'El Salvador', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(65, 'GQ', 'Equatorial Guinea', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(66, 'ER', 'Eritrea', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(67, 'EE', 'Estonia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(68, 'ET', 'Ethiopia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(69, 'FK', 'Falkland Islands (Malvinas)', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(70, 'FO', 'Faroe Islands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(71, 'FJ', 'Fiji', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(72, 'FI', 'Finland', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(73, 'FR', 'France', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(74, 'FX', 'France, Metropolitan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(75, 'GF', 'French Guiana', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(76, 'PF', 'French Polynesia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(77, 'TF', 'French Southern Territories', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(78, 'GA', 'Gabon', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(79, 'GM', 'Gambia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(80, 'GE', 'Georgia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(81, 'DE', 'Germany', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(82, 'GH', 'Ghana', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(83, 'GI', 'Gibraltar', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(84, 'GK', 'Guernsey', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(85, 'GR', 'Greece', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(86, 'GL', 'Greenland', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(87, 'GD', 'Grenada', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(88, 'GP', 'Guadeloupe', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(89, 'GU', 'Guam', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(90, 'GT', 'Guatemala', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(91, 'GN', 'Guinea', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(92, 'GW', 'Guinea-Bissau', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(93, 'GY', 'Guyana', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(94, 'HT', 'Haiti', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(95, 'HM', 'Heard and Mc Donald Islands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(96, 'HN', 'Honduras', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(97, 'HK', 'Hong Kong', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(98, 'HU', 'Hungary', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(99, 'IS', 'Iceland', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(100, 'IN', 'India', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(101, 'IM', 'Isle of Man', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(102, 'ID', 'Indonesia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(103, 'IR', 'Iran (Islamic Republic of)', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(104, 'IQ', 'Iraq', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(105, 'IE', 'Ireland', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(106, 'IL', 'Israel', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(107, 'IT', 'Italy', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(108, 'CI', 'Ivory Coast', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(109, 'JE', 'Jersey', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(110, 'JM', 'Jamaica', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(111, 'JP', 'Japan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(112, 'JO', 'Jordan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(113, 'KZ', 'Kazakhstan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(114, 'KE', 'Kenya', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(115, 'KI', 'Kiribati', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(116, 'KP', 'Korea, Democratic People\'s Republic of', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(117, 'KR', 'Korea, Republic of', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(118, 'XK', 'Kosovo', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(119, 'KW', 'Kuwait', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(120, 'KG', 'Kyrgyzstan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(121, 'LA', 'Lao People\'s Democratic Republic', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(122, 'LV', 'Latvia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(123, 'LB', 'Lebanon', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(124, 'LS', 'Lesotho', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(125, 'LR', 'Liberia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(126, 'LY', 'Libyan Arab Jamahiriya', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(127, 'LI', 'Liechtenstein', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(128, 'LT', 'Lithuania', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(129, 'LU', 'Luxembourg', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(130, 'MO', 'Macau', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(131, 'MK', 'North Macedonia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(132, 'MG', 'Madagascar', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(133, 'MW', 'Malawi', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(134, 'MY', 'Malaysia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(135, 'MV', 'Maldives', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(136, 'ML', 'Mali', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(137, 'MT', 'Malta', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(138, 'MH', 'Marshall Islands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(139, 'MQ', 'Martinique', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(140, 'MR', 'Mauritania', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(141, 'MU', 'Mauritius', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(142, 'TY', 'Mayotte', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(143, 'MX', 'Mexico', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(144, 'FM', 'Micronesia, Federated States of', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(145, 'MD', 'Moldova, Republic of', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(146, 'MC', 'Monaco', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(147, 'MN', 'Mongolia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(148, 'ME', 'Montenegro', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(149, 'MS', 'Montserrat', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(150, 'MA', 'Morocco', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(151, 'MZ', 'Mozambique', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(152, 'MM', 'Myanmar', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(153, 'NA', 'Namibia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(154, 'NR', 'Nauru', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(155, 'NP', 'Nepal', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(156, 'NL', 'Netherlands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(157, 'AN', 'Netherlands Antilles', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(158, 'NC', 'New Caledonia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(159, 'NZ', 'New Zealand', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(160, 'NI', 'Nicaragua', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(161, 'NE', 'Niger', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(162, 'NG', 'Nigeria', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(163, 'NU', 'Niue', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(164, 'NF', 'Norfolk Island', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(165, 'MP', 'Northern Mariana Islands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(166, 'NO', 'Norway', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(167, 'OM', 'Oman', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(168, 'PK', 'Pakistan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(169, 'PW', 'Palau', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(170, 'PS', 'Palestine', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(171, 'PA', 'Panama', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(172, 'PG', 'Papua New Guinea', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(173, 'PY', 'Paraguay', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(174, 'PE', 'Peru', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(175, 'PH', 'Philippines', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(176, 'PN', 'Pitcairn', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(177, 'PL', 'Poland', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(178, 'PT', 'Portugal', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(179, 'PR', 'Puerto Rico', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(180, 'QA', 'Qatar', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(181, 'RE', 'Reunion', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(182, 'RO', 'Romania', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(183, 'RU', 'Russian Federation', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(184, 'RW', 'Rwanda', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(185, 'KN', 'Saint Kitts and Nevis', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(186, 'LC', 'Saint Lucia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(187, 'VC', 'Saint Vincent and the Grenadines', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(188, 'WS', 'Samoa', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(189, 'SM', 'San Marino', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(190, 'ST', 'Sao Tome and Principe', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(191, 'SA', 'Saudi Arabia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(192, 'SN', 'Senegal', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(193, 'RS', 'Serbia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(194, 'SC', 'Seychelles', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(195, 'SL', 'Sierra Leone', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(196, 'SG', 'Singapore', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(197, 'SK', 'Slovakia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(198, 'SI', 'Slovenia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(199, 'SB', 'Solomon Islands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(200, 'SO', 'Somalia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(201, 'ZA', 'South Africa', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(202, 'GS', 'South Georgia South Sandwich Islands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(203, 'SS', 'South Sudan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(204, 'ES', 'Spain', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(205, 'LK', 'Sri Lanka', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(206, 'SH', 'St. Helena', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(207, 'PM', 'St. Pierre and Miquelon', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(208, 'SD', 'Sudan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(209, 'SR', 'Suriname', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(211, 'SZ', 'Eswatini', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(212, 'SE', 'Sweden', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(213, 'CH', 'Switzerland', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(214, 'SY', 'Syrian Arab Republic', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(215, 'TW', 'Taiwan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(216, 'TJ', 'Tajikistan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(217, 'TZ', 'Tanzania, United Republic of', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(218, 'TH', 'Thailand', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(219, 'TG', 'Togo', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(220, 'TK', 'Tokelau', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(221, 'TO', 'Tonga', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(222, 'TT', 'Trinidad and Tobago', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(223, 'TN', 'Tunisia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(224, 'TR', 'Turkey', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(225, 'TM', 'Turkmenistan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(226, 'TC', 'Turks and Caicos Islands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(227, 'TV', 'Tuvalu', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(228, 'UG', 'Uganda', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(229, 'UA', 'Ukraine', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(230, 'AE', 'United Arab Emirates', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(231, 'GB', 'United Kingdom', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(232, 'US', 'United States', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(233, 'UM', 'United States minor outlying islands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(234, 'UY', 'Uruguay', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(235, 'UZ', 'Uzbekistan', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(236, 'VU', 'Vanuatu', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(237, 'VA', 'Vatican City State', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(238, 'VE', 'Venezuela', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(239, 'VN', 'Vietnam', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(240, 'VG', 'Virgin Islands (British)', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(241, 'VI', 'Virgin Islands (U.S.)', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(242, 'WF', 'Wallis and Futuna Islands', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(243, 'EH', 'Western Sahara', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(244, 'YE', 'Yemen', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(245, 'ZM', 'Zambia', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07'),
(246, 'ZW', 'Zimbabwe', 1, '2022-10-31 16:50:07', '2022-10-31 16:50:07');

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
(5, '2022_10_03_171401_create_vendors_table', 2),
(6, '2022_10_03_171808_create_admins_table', 3),
(7, '2022_10_13_122819_create_vendors_business_details_table', 4),
(8, '2022_10_13_124751_create_vendors_bank_details_table', 5),
(9, '2022_10_13_125530_create_vendors_business_details_table', 6),
(10, '2022_11_01_123039_create_sections_table', 7),
(11, '2022_11_01_182318_create_categories_table', 8),
(12, '2022_11_03_235238_create_brands_table', 9),
(13, '2022_11_05_214257_create_products_table', 10),
(14, '2022_11_22_152224_create_products_attributes_table', 11),
(15, '2022_11_23_075353_create_products_images_table', 12),
(16, '2022_11_24_124439_create_banners_table', 13),
(17, '2022_11_29_172515_create_products_filters_table', 14),
(18, '2022_11_29_172857_create_products_filters_values_table', 15),
(19, '2023_01_18_225515_create_recently_viewed_products_table', 16);

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `final_price` double(8,2) NOT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_discount` double(8,2) NOT NULL,
  `product_weight` int(11) NOT NULL DEFAULT 0,
  `product_url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'No Description',
  `pattern` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phones_os` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_bestseller` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `section_id`, `category_id`, `brand_id`, `vendor_id`, `admin_id`, `admin_type`, `product_name`, `product_code`, `product_price`, `final_price`, `product_color`, `product_discount`, `product_weight`, `product_url`, `product_image`, `product_video`, `product_description`, `pattern`, `phones_os`, `material`, `meta_title`, `meta_description`, `meta_keywords`, `is_featured`, `is_bestseller`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 41, 8, 0, 1, 'superadmin', 'Women Tops Club 2', 'HP-TC2B', 19.99, 17.99, 'Black', 10.00, 500, 'hush-puppies-women-tops-club-2-black', 'lg4i7ulDVoMbCWCGfxX2Q3WTJ5KYw94DgZsu8Epu.jpg', 'tIE444GBLrCCQEUlDA62kFskNsQPUrzjQXOl3a2v.mp4', 'Chest Size x Waist Size x Length :\r\nS : 98 x 105 x 62 cm\r\nM : 83 x 90 x 57 cm\r\nL : 86 x 94 x 58 cm\r\nXL : 90 x 98 x 59 cm', 'Solid', NULL, 'Cotton', NULL, NULL, NULL, 'Yes', 'Yes', 1, '2022-11-26 06:58:40', '2023-01-17 16:16:57'),
(2, 2, 41, 8, 0, 1, 'superadmin', 'Ladies Venina T-Shirt', 'HP-VTSB', 22.99, 22.99, 'Black', 0.00, 500, 'hush-puppies-ladies-venina-t-shirt-black', 'CdJ1auUXaWdg1oin2ygg2YZTVVMG7KJJQKwNQwbA.jpg', '', 'Chest Size x Waist Size :\r\nS : 82 x 78 cm\r\nM : 86 x 82 cm\r\nL : 90 x 86 cm\r\nXL : 94 x 90 cm', 'Solid', NULL, 'Cotton', NULL, NULL, NULL, 'No', 'Yes', 1, '2022-11-26 07:12:33', '2023-01-17 16:17:07'),
(3, 1, 13, 10, 0, 1, 'superadmin', 'Oversized Fit Cotton T-Shirt', 'HM-OVCTSO', 9.99, 8.49, 'Orange', 15.00, 500, 'h-m-oversized-fit-cotton-t-shirt-orange', 'R29bNxLIqPVZra2RY3U7D3UkN3o0xnDtmOCrFBHw.jpg', NULL, 'No Description', 'Solid', NULL, 'Cotton', NULL, NULL, NULL, 'Yes', 'No', 1, '2022-11-26 12:59:44', '2023-01-17 16:15:46'),
(4, 2, 42, 10, 0, 1, 'superadmin', 'Wrap Dress', 'HM-WDB', 32.99, 29.69, 'Black', 10.00, 500, 'h-m-wrap-dress-black', 'eZsWCMfUHQE52xUzFVFLlgpgg5fESAxeTH3wfFiS.jpg', NULL, 'No Description', 'Floral', NULL, 'Mixed', NULL, NULL, NULL, 'No', 'No', 1, '2022-11-26 13:04:54', '2023-01-17 16:18:39'),
(5, 1, 16, 10, 6, 6, 'vendor', 'Relaxed Fit Hoodie', 'HM-RFHB', 21.99, 19.79, 'Blue', 10.00, 600, 'h-m-relaxed-fit-hoodie-blue', 'zCNv3HWVkYZV3Xckv9vqBSx5gbIHCvADEci9Gfuy.jpg', NULL, 'No Description', 'Solid', NULL, 'Mixed', NULL, NULL, NULL, 'Yes', 'No', 1, '2022-11-27 04:10:43', '2023-01-17 16:15:55'),
(6, 1, 13, 10, 0, 1, 'superadmin', 'Relaxed Fit T-Shirt', 'HM-RFTSLP', 9.99, 9.99, 'Light Purple', 0.00, 500, 'h-m-relaxed-fit-t-shirt-light-purple', 'jYwwkWoggcl4zKuv922vdj7rNCap2sf1NSriG7PF.jpg', NULL, 'No Description', 'Solid', NULL, 'Cotton', NULL, NULL, NULL, 'Yes', 'Yes', 1, '2022-11-27 04:22:12', '2023-01-17 16:16:06'),
(7, 1, 24, 11, 6, 6, 'vendor', 'Court Royale 2 Next Nature Sneakers', 'NIKE-CR2NNBS', 499.99, 399.99, 'Black', 20.00, 800, 'nike-court-royale-2-next-nature-sneakers-black', 'dWqXEKH4qHqspPiCL8qeamE5QapFiziBTua7m1rn.jpg', NULL, 'No Description', NULL, NULL, 'Artificial Leather', NULL, NULL, NULL, 'No', 'Yes', 1, '2022-11-27 04:27:39', '2023-01-09 08:32:25'),
(8, 1, 24, 11, 6, 6, 'vendor', 'Court Royale 2 Next Nature Sneakers', 'NIKE-CR2NNWS', 499.99, 499.99, 'White', 0.00, 800, 'nike-court-royale-2-next-nature-sneakers-white', 'WZXgSOk7Q06wxO84GQFsqvTYdfOQpnT5kUDwg6HM.jpg', NULL, 'No Description', NULL, NULL, 'Artificial Leather', NULL, NULL, NULL, 'Yes', 'Yes', 1, '2022-11-27 04:34:42', '2023-01-09 08:33:00'),
(9, 1, 13, 12, 0, 1, 'superadmin', 'Classic Tee', 'V-CTB', 19.99, 9.99, 'Black', 50.00, 500, 'vans-classic-tee-black', 'CPbbf0PbZktj3Cl0h2jxz2X3gjZPsDRobKOz6X4U.jpg', NULL, 'No Description', 'Solid', NULL, 'Polyester', NULL, NULL, NULL, 'No', 'Yes', 1, '2022-11-29 04:33:01', '2023-01-17 16:19:02'),
(10, 1, 16, 12, 0, 1, 'superadmin', 'Big Logo Hoodie 4', 'V-BLH4BR', 29.99, 20.99, 'Brown', 30.00, 500, 'vans-big-logo-hoodie-4-brown', 'ANzoepDhEZ9t5EP1FDGP6rKP3O6RaSB5z3RZw4UD.jpg', NULL, 'No Description', NULL, NULL, 'Wool', NULL, NULL, NULL, 'No', 'Yes', 1, '2022-11-29 04:34:26', '2023-01-09 08:34:06'),
(11, 1, 15, 13, 0, 1, 'superadmin', 'Paul Batch Polo Shirt', 'BOSS-PBPSN', 1399.99, 700.00, 'Navy Blue', 50.00, 500, 'boss-paul-batch-polo-shirt-navy-blue', '3NOkFzcv0U1OTygNTnZrTf29uNIrSmaHDIHLr9sG.jpg', NULL, 'No Description', NULL, NULL, 'Polyester', NULL, NULL, NULL, 'No', 'No', 1, '2022-11-29 04:37:48', '2023-01-09 08:35:22'),
(12, 1, 15, 11, 6, 6, 'vendor', 'Polo Shirt', 'NIKE-PSB', 49.99, 34.99, 'Black', 30.00, 600, 'nike-polo-shirt-black', 'wNPGGnIn8dhWDRJskhycGGCZVLspyhsKpWcEk7Hp.jpg', NULL, 'No Description', NULL, NULL, 'Polyester', NULL, NULL, NULL, 'Yes', 'Yes', 1, '2022-11-29 04:49:46', '2023-01-09 08:39:19'),
(13, 1, 18, 11, 0, 1, 'superadmin', 'AS Men\'s Sportswear Club Fleece Jogger FT', 'NIKE-AMSCFJFT', 799.99, 639.99, 'Grey', 20.00, 600, 'nike-as-men\'s-sportswear-club-fleece-jogger-ft-grey', 'gwQO4KJJqwIIqObBZQPIduJPE8gAwmjXAtxR9FJD.jpg', NULL, 'No Description', NULL, NULL, 'Cotton', NULL, NULL, NULL, 'No', 'Yes', 1, '2022-11-29 04:51:59', '2023-01-09 08:49:23'),
(14, 1, 15, 10, 0, 1, 'superadmin', 'Slim Fit Polo Shirt', 'HM-SFPSBG', 24.99, 22.49, 'Beige', 10.00, 500, 'h-m-slim-fit-polo-shirt-beige', 'yXJEBK0EGioz3b6p82hsFFtNCcBqGjmdYfbWBQeX.jpg', NULL, 'No Description', NULL, NULL, 'Polyester', NULL, NULL, NULL, 'Yes', 'No', 1, '2022-11-29 04:54:30', '2023-01-09 08:49:38'),
(15, 4, 72, 14, 0, 1, 'superadmin', 'Redmi Note 11', 'XM-RN11', 179.99, 170.99, 'Blue', 5.00, 173, 'xiaomi-redmi-note-11-blue', 'vPOVwriBGJ0yDlVRl7XnVHC4jPoyDHc3C6EXKtJB.png', NULL, 'No Description', NULL, 'Android', NULL, NULL, NULL, NULL, 'Yes', 'Yes', 1, '2022-12-05 14:13:53', '2022-12-05 14:13:53'),
(16, 4, 72, 2, 0, 1, 'superadmin', 'Iphone 14 Pro Max', 'AP-PH14PM', 1099.99, 1044.99, 'Black', 5.00, 210, 'apple-iphone-14-pro-max-black', 'CBaA3vZRHGlR11dO7XZ3kwwgBG4ABbNtGqhKNHdv.jpg', NULL, 'No Description', NULL, 'iOS', NULL, NULL, NULL, NULL, 'Yes', 'Yes', 1, '2022-12-05 14:18:54', '2023-01-09 08:50:20'),
(17, 1, 13, 7, 0, 1, 'superadmin', 'Black Tee', 'test', 123.00, 121.77, 'Black', 1.00, 500, 'lee-cooper-black-tee-black', NULL, NULL, 'No Description', NULL, NULL, 'Wool', NULL, NULL, NULL, 'No', 'No', 1, '2023-01-01 08:16:50', '2023-01-09 08:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `products_attributes`
--

CREATE TABLE `products_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_attributes`
--

INSERT INTO `products_attributes` (`id`, `product_id`, `size`, `price`, `stock`, `sku`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', 19.99, 15, 'HP-TC2B-S', 1, '2022-11-26 07:02:40', '2023-01-09 11:51:38'),
(2, 1, 'M', 20.09, 25, 'HP-TC2B-M', 1, '2022-11-26 07:02:40', '2023-01-09 11:51:38'),
(3, 1, 'L', 20.19, 20, 'HP-TC2B-L', 1, '2022-11-26 07:02:40', '2023-01-09 12:03:33'),
(4, 1, 'XL', 20.29, 0, 'HP-TC2B-XL', 1, '2022-11-26 07:02:40', '2023-01-09 11:51:38'),
(5, 2, 'S', 22.99, 15, 'HP-VTSB-S', 1, '2022-11-26 07:15:25', '2022-11-26 07:15:25'),
(6, 2, 'M', 23.09, 25, 'HP-VTSB-M', 1, '2022-11-26 07:15:26', '2022-11-26 07:15:26'),
(7, 2, 'L', 23.19, 20, 'HP-VTSB-L', 1, '2022-11-26 07:15:26', '2022-11-26 07:15:26'),
(8, 2, 'XL', 23.29, 10, 'HP-VTSB-XL', 1, '2022-11-26 07:15:26', '2022-11-26 07:15:26'),
(9, 3, 'S', 9.99, 15, 'HM-OVCTSO-S', 1, '2022-11-26 13:02:31', '2022-11-26 13:02:31'),
(10, 3, 'M', 10.09, 25, 'HM-OVCTSO-M', 1, '2022-11-26 13:02:32', '2022-11-26 13:02:32'),
(11, 3, 'L', 10.19, 20, 'HM-OVCTSO-L', 1, '2022-11-26 13:02:32', '2022-11-26 13:02:32'),
(12, 3, 'XL', 10.29, 10, 'HM-OVCTSO-XL', 1, '2022-11-26 13:02:32', '2022-11-26 13:02:32'),
(13, 4, 'S', 32.99, 15, 'HM-WDB-S', 1, '2022-11-26 13:06:14', '2022-11-26 13:06:14'),
(14, 4, 'M', 32.99, 25, 'HM-WDB-M', 1, '2022-11-26 13:06:14', '2022-11-26 13:06:14'),
(15, 4, 'L', 32.99, 20, 'HM-WDB-L', 1, '2022-11-26 13:06:14', '2022-11-26 13:06:14'),
(16, 4, 'XL', 32.99, 10, 'HM-WDB-XL', 1, '2022-11-26 13:06:14', '2022-11-26 13:06:14'),
(17, 5, 'S', 21.99, 15, 'HM_RFHB-S', 1, '2022-11-27 04:13:35', '2022-11-27 04:13:35'),
(18, 5, 'M', 22.09, 25, 'HM_RFHB-M', 1, '2022-11-27 04:13:35', '2022-11-27 04:13:35'),
(19, 5, 'L', 22.19, 20, 'HM_RFHB-L', 1, '2022-11-27 04:13:35', '2022-11-27 04:13:35'),
(20, 5, 'XL', 22.29, 10, 'HM_RFHB-XL', 1, '2022-11-27 04:13:35', '2022-11-27 04:13:35'),
(21, 6, 'S', 9.99, 15, 'HM_RFTSLP-S', 1, '2022-11-27 04:24:17', '2022-11-27 04:24:17'),
(22, 6, 'M', 10.09, 25, 'HM_RFTSLP-M', 1, '2022-11-27 04:24:18', '2022-11-27 04:24:18'),
(23, 6, 'L', 10.19, 20, 'HM_RFTSLP-L', 1, '2022-11-27 04:24:18', '2022-11-27 04:24:18'),
(24, 6, 'XL', 10.29, 10, 'HM_RFTSLP-XL', 1, '2022-11-27 04:24:18', '2022-11-27 04:24:18'),
(25, 7, '7', 499.99, 15, 'NIKE-CR2NNBS-7', 1, '2022-11-27 04:32:20', '2022-11-27 04:32:20'),
(26, 7, '7.5', 499.99, 25, 'NIKE-CR2NNBS-7H', 1, '2022-11-27 04:32:20', '2022-11-27 04:32:20'),
(27, 7, '8', 499.99, 15, 'NIKE-CR2NNBS-8', 1, '2022-11-27 04:32:20', '2022-11-27 04:32:20'),
(28, 7, '8.5', 499.99, 15, 'NIKE-CR2NNBS-8H', 1, '2022-11-27 04:32:21', '2022-11-27 04:32:21'),
(29, 7, '9', 499.99, 15, 'NIKE-CR2NNBS-9', 1, '2022-11-27 04:32:21', '2022-11-27 04:32:21'),
(30, 7, '9.5', 499.99, 25, 'NIKE-CR2NNBS-9H', 1, '2022-11-27 04:32:21', '2022-11-27 04:32:21'),
(31, 7, '10', 499.99, 25, 'NIKE-CR2NNBS-10', 1, '2022-11-27 04:32:21', '2022-11-27 04:32:21'),
(32, 7, '10.5', 499.99, 25, 'NIKE-CR2NNBS-10H', 1, '2022-11-27 04:32:21', '2022-11-27 04:32:21'),
(33, 7, '11', 499.99, 15, 'NIKE-CR2NNBS-11', 1, '2022-11-27 04:32:21', '2022-11-27 04:32:21'),
(34, 7, '11.5', 499.99, 10, 'NIKE-CR2NNBS-11H', 1, '2022-11-27 04:32:21', '2022-11-27 04:32:21'),
(35, 7, '12', 499.99, 10, 'NIKE-CR2NNBS-12', 1, '2022-11-27 04:32:49', '2022-11-27 04:32:49'),
(36, 8, '7', 499.99, 15, 'NIKE-CR2NNWS', 1, '2022-11-27 04:37:47', '2022-11-27 04:37:47'),
(37, 8, '7.5', 499.99, 25, 'NIKE-CR2NNWS-7H', 1, '2022-11-27 04:37:47', '2022-11-27 04:37:47'),
(38, 8, '8', 499.99, 25, 'NIKE-CR2NNWS-8', 1, '2022-11-27 04:39:22', '2022-11-27 04:39:22'),
(39, 8, '8.5', 499.99, 25, 'NIKE-CR2NNWS-8H', 1, '2022-11-27 04:39:23', '2022-11-27 04:39:23'),
(40, 8, '9', 499.99, 25, 'NIKE-CR2NNWS-9', 1, '2022-11-27 04:39:23', '2022-11-27 04:39:23'),
(41, 8, '9.5', 499.99, 25, 'NIKE-CR2NNWS-9H', 1, '2022-11-27 04:39:23', '2022-11-27 04:39:23'),
(42, 8, '10', 499.99, 25, 'NIKE-CR2NNWS-10', 1, '2022-11-27 04:39:23', '2022-11-27 04:39:23'),
(43, 8, '10.5', 499.99, 25, 'NIKE-CR2NNWS-10H', 1, '2022-11-27 04:39:23', '2022-11-27 04:39:23'),
(44, 8, '11', 499.99, 10, 'NIKE-CR2NNWS-11', 1, '2022-11-27 04:39:23', '2022-11-27 04:39:23'),
(45, 8, '11.5', 499.99, 10, 'NIKE-CR2NNWS-11H', 1, '2022-11-27 04:39:23', '2022-11-27 04:39:23'),
(46, 8, '12', 499.99, 10, 'NIKE-CR2NNWS-12', 1, '2022-11-27 04:39:23', '2022-11-27 04:39:23'),
(51, 15, '4GB/128GB', 179.99, 25, 'XM-RN11-4/128', 1, '2022-12-05 14:23:12', '2022-12-05 14:23:12'),
(52, 15, '6GB/128GB', 192.99, 25, 'XM-RN11-6/128', 1, '2022-12-05 14:24:04', '2022-12-05 14:24:04'),
(53, 16, '6GB/128GB', 1099.99, 25, 'AP-PH14PM-128', 1, '2022-12-05 14:26:14', '2022-12-05 14:26:14'),
(54, 16, '6GB/256GB', 1199.99, 25, 'AP-PH14PM-256', 1, '2022-12-05 14:26:14', '2022-12-05 14:26:14'),
(55, 16, '6GB/512GB', 1399.99, 25, 'AP-PH14PM-512', 1, '2022-12-05 14:26:14', '2022-12-05 14:26:14'),
(56, 16, '6GB/1TB', 1599.99, 25, 'AP-PH14PM-1024', 1, '2022-12-05 14:26:14', '2022-12-05 14:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `products_filters`
--

CREATE TABLE `products_filters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_ids` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter_column` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_filters`
--

INSERT INTO `products_filters` (`id`, `category_ids`, `filter_name`, `filter_column`, `status`, `created_at`, `updated_at`) VALUES
(1, '1,2,3,4,5,13,14,15,16,18,19,20,21,22,23,24,25,26,27,28,29,30,31,33,34,36,37,38,40,41,42,43,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,63,66,67,68,69,70', 'Material', 'material', 1, '2022-11-30 12:58:32', '2022-12-01 09:16:58'),
(2, '1,2,4,5,13,14,15,16,18,19,20,21,22,23,24,25,26,27,28,29,30,31,41,42,43,45,46,48,49,50,51,52,53,54,55,56,57,58,59,60,61', 'Pattern', 'pattern', 1, '2023-01-17 16:10:21', '2023-01-17 16:10:21'),
(4, '72', 'Operating System', 'phones_os', 1, '2022-12-01 09:08:06', '2022-12-01 09:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `products_filters_values`
--

CREATE TABLE `products_filters_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filter_id` int(11) NOT NULL,
  `filter_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_filters_values`
--

INSERT INTO `products_filters_values` (`id`, `filter_id`, `filter_value`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cotton', 1, '2022-12-01 06:10:15', '2022-12-01 06:10:15'),
(2, 1, 'Polyester', 1, '2022-12-01 06:10:43', '2022-12-01 06:10:43'),
(3, 1, 'Wool', 1, '2022-12-01 06:11:43', '2022-12-01 06:11:43'),
(4, 1, 'Silk', 1, '2022-12-01 06:11:52', '2022-12-01 06:11:52'),
(5, 1, 'Leather', 1, '2022-12-01 06:14:31', '2022-12-01 06:14:31'),
(6, 1, 'Nylon', 1, '2022-12-01 06:15:34', '2022-12-01 06:15:34'),
(7, 1, 'Mixed', 1, '2022-12-01 06:15:50', '2022-12-01 06:15:50'),
(8, 1, 'Denim', 1, '2022-12-01 06:18:22', '2022-12-01 06:18:22'),
(9, 1, 'Linen', 1, '2022-12-01 06:18:56', '2022-12-01 06:18:56'),
(10, 1, 'Eco-Friendly', 1, '2022-12-01 06:21:05', '2022-12-01 06:21:05'),
(11, 1, 'Mesh', 1, '2022-12-01 09:18:56', '2022-12-01 09:18:56'),
(12, 1, 'Artificial Leather', 1, '2022-12-01 10:18:19', '2022-12-01 10:18:19'),
(13, 4, 'Android', 1, '2022-12-01 09:10:34', '2022-12-01 09:10:34'),
(14, 4, 'iOS', 1, '2022-12-01 09:10:44', '2022-12-01 09:10:44'),
(49, 2, 'Solid', 1, '2023-01-17 16:11:10', '2023-01-17 16:11:10'),
(50, 2, 'Stripes', 1, '2023-01-17 16:11:27', '2023-01-17 16:11:27'),
(51, 2, 'Checks', 1, '2023-01-17 16:11:45', '2023-01-17 16:11:45'),
(52, 2, 'Plaid', 1, '2023-01-17 16:11:58', '2023-01-17 16:11:58'),
(53, 2, 'Herringbone', 1, '2023-01-17 16:12:11', '2023-01-17 16:12:11'),
(54, 2, 'Paisley', 1, '2023-01-17 16:12:26', '2023-01-17 16:12:26'),
(55, 2, 'Houndstooth', 1, '2023-01-17 16:13:08', '2023-01-17 16:13:08'),
(56, 2, 'Floral', 1, '2023-01-17 16:13:18', '2023-01-17 16:13:18'),
(57, 2, 'Polkadot', 1, '2023-01-17 16:13:27', '2023-01-17 16:13:27'),
(58, 2, 'Pinstriped', 1, '2023-01-17 16:13:37', '2023-01-17 16:13:37'),
(59, 2, 'Animal Print', 1, '2023-01-17 16:14:42', '2023-01-17 16:14:42'),
(61, 2, 'Argyle', 1, '2023-01-17 16:14:59', '2023-01-17 16:14:59'),
(62, 2, 'Tie-dyed', 1, '2023-01-17 16:15:16', '2023-01-17 16:15:16'),
(63, 2, 'Others', 1, '2023-01-17 16:15:25', '2023-01-17 16:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'lg4i7ulDVoMbCWCGfxX2Q3WTJ5KYw94DgZsu8Epu-0.jpg', 1, '2022-11-26 07:59:45', '2022-11-26 07:59:45'),
(2, 1, 'lg4i7ulDVoMbCWCGfxX2Q3WTJ5KYw94DgZsu8Epu-1.jpg', 1, '2022-11-26 07:59:46', '2022-11-26 07:59:46'),
(3, 1, 'lg4i7ulDVoMbCWCGfxX2Q3WTJ5KYw94DgZsu8Epu-2.jpg', 1, '2022-11-26 07:59:47', '2022-11-26 07:59:47'),
(4, 1, 'lg4i7ulDVoMbCWCGfxX2Q3WTJ5KYw94DgZsu8Epu-3.jpg', 1, '2022-11-26 07:59:47', '2022-11-26 07:59:47'),
(5, 2, 'CdJ1auUXaWdg1oin2ygg2YZTVVMG7KJJQKwNQwbA-livWSBR.jpg', 1, '2022-11-26 08:06:56', '2022-11-26 08:06:56'),
(6, 2, 'CdJ1auUXaWdg1oin2ygg2YZTVVMG7KJJQKwNQwbA-0vQWKfR.jpg', 1, '2022-11-26 08:06:57', '2022-11-26 08:06:57'),
(7, 2, 'CdJ1auUXaWdg1oin2ygg2YZTVVMG7KJJQKwNQwbA-pGLPk7I.jpg', 1, '2022-11-26 08:06:58', '2022-11-26 08:06:58'),
(8, 2, 'CdJ1auUXaWdg1oin2ygg2YZTVVMG7KJJQKwNQwbA-uG5ZmLp.jpg', 1, '2022-11-26 08:06:58', '2022-11-26 08:06:58'),
(9, 3, 'R29bNxLIqPVZra2RY3U7D3UkN3o0xnDtmOCrFBHw-TUQlbBD.jpg', 1, '2022-11-26 13:00:10', '2022-11-26 13:00:10'),
(10, 3, 'R29bNxLIqPVZra2RY3U7D3UkN3o0xnDtmOCrFBHw-gNtxJbz.jpg', 1, '2022-11-26 13:00:11', '2022-11-26 13:00:11'),
(11, 3, 'R29bNxLIqPVZra2RY3U7D3UkN3o0xnDtmOCrFBHw-dst4iGT.jpg', 1, '2022-11-26 13:00:12', '2022-11-26 13:00:12'),
(12, 3, 'R29bNxLIqPVZra2RY3U7D3UkN3o0xnDtmOCrFBHw-jVWJD3D.jpg', 1, '2022-11-26 13:00:12', '2022-11-26 13:00:12'),
(13, 3, 'R29bNxLIqPVZra2RY3U7D3UkN3o0xnDtmOCrFBHw-QFBxe4D.jpg', 1, '2022-11-26 13:00:13', '2022-11-26 13:00:13'),
(14, 3, 'R29bNxLIqPVZra2RY3U7D3UkN3o0xnDtmOCrFBHw-UBZL6NL.jpg', 1, '2022-11-26 13:00:14', '2022-11-26 13:00:14'),
(15, 4, 'eZsWCMfUHQE52xUzFVFLlgpgg5fESAxeTH3wfFiS-UEO8x2P.jpg', 1, '2022-11-26 13:05:09', '2022-11-26 13:05:09'),
(16, 4, 'eZsWCMfUHQE52xUzFVFLlgpgg5fESAxeTH3wfFiS-MyMz3Te.jpg', 1, '2022-11-26 13:05:10', '2022-11-26 13:05:10'),
(17, 4, 'eZsWCMfUHQE52xUzFVFLlgpgg5fESAxeTH3wfFiS-XFP96yT.jpg', 1, '2022-11-26 13:05:11', '2022-11-26 13:05:11'),
(18, 4, 'eZsWCMfUHQE52xUzFVFLlgpgg5fESAxeTH3wfFiS-riJDtNk.jpg', 1, '2022-11-26 13:05:12', '2022-11-26 13:05:12'),
(19, 4, 'eZsWCMfUHQE52xUzFVFLlgpgg5fESAxeTH3wfFiS-sU1es33.jpg', 1, '2022-11-26 13:05:13', '2022-11-26 13:05:13'),
(20, 5, 'zCNv3HWVkYZV3Xckv9vqBSx5gbIHCvADEci9Gfuy-zeGZ2IE.jpg', 1, '2022-11-27 04:11:08', '2022-11-27 04:11:08'),
(21, 5, 'zCNv3HWVkYZV3Xckv9vqBSx5gbIHCvADEci9Gfuy-WTilLPv.jpg', 1, '2022-11-27 04:11:09', '2022-11-27 04:11:09'),
(22, 5, 'zCNv3HWVkYZV3Xckv9vqBSx5gbIHCvADEci9Gfuy-EILsjUD.jpg', 1, '2022-11-27 04:11:10', '2022-11-27 04:11:10'),
(23, 5, 'zCNv3HWVkYZV3Xckv9vqBSx5gbIHCvADEci9Gfuy-0JaeVot.jpg', 1, '2022-11-27 04:11:11', '2022-11-27 04:11:11'),
(24, 5, 'zCNv3HWVkYZV3Xckv9vqBSx5gbIHCvADEci9Gfuy-kOtZqjI.jpg', 1, '2022-11-27 04:11:12', '2022-11-27 04:11:12'),
(25, 5, 'zCNv3HWVkYZV3Xckv9vqBSx5gbIHCvADEci9Gfuy-IGD5Y8g.jpg', 1, '2022-11-27 04:11:12', '2022-11-27 04:11:12'),
(26, 6, 'jYwwkWoggcl4zKuv922vdj7rNCap2sf1NSriG7PF-rths5l2.jpg', 1, '2022-11-27 04:22:31', '2022-11-27 04:22:31'),
(27, 6, 'jYwwkWoggcl4zKuv922vdj7rNCap2sf1NSriG7PF-sElhTjz.jpg', 1, '2022-11-27 04:22:32', '2022-11-27 04:22:32'),
(28, 6, 'jYwwkWoggcl4zKuv922vdj7rNCap2sf1NSriG7PF-5Ujtovf.jpg', 1, '2022-11-27 04:22:32', '2022-11-27 04:22:32'),
(29, 6, 'jYwwkWoggcl4zKuv922vdj7rNCap2sf1NSriG7PF-OQFfrJS.jpg', 1, '2022-11-27 04:22:33', '2022-11-27 04:22:33'),
(30, 6, 'jYwwkWoggcl4zKuv922vdj7rNCap2sf1NSriG7PF-747XiF8.jpg', 1, '2022-11-27 04:22:34', '2022-11-27 04:22:34'),
(31, 7, 'dWqXEKH4qHqspPiCL8qeamE5QapFiziBTua7m1rn-NktgdP2.jpg', 1, '2022-11-27 04:29:00', '2022-11-27 04:29:00'),
(32, 7, 'dWqXEKH4qHqspPiCL8qeamE5QapFiziBTua7m1rn-PmMNGKz.jpg', 1, '2022-11-27 04:29:01', '2022-11-27 04:29:01'),
(33, 7, 'dWqXEKH4qHqspPiCL8qeamE5QapFiziBTua7m1rn-IyTm69T.jpg', 1, '2022-11-27 04:29:01', '2022-11-27 04:29:01'),
(34, 7, 'dWqXEKH4qHqspPiCL8qeamE5QapFiziBTua7m1rn-xIQxfzu.jpg', 1, '2022-11-27 04:29:02', '2022-11-27 04:29:02'),
(35, 7, 'dWqXEKH4qHqspPiCL8qeamE5QapFiziBTua7m1rn-YyT7l8B.jpg', 1, '2022-11-27 04:29:03', '2022-11-27 04:29:03'),
(36, 7, 'dWqXEKH4qHqspPiCL8qeamE5QapFiziBTua7m1rn-w6I6hA9.jpg', 1, '2022-11-27 04:29:04', '2022-11-27 04:29:04'),
(37, 8, 'WZXgSOk7Q06wxO84GQFsqvTYdfOQpnT5kUDwg6HM-9wSLn3j.jpg', 1, '2022-11-27 04:35:57', '2022-11-27 04:35:57'),
(38, 8, 'WZXgSOk7Q06wxO84GQFsqvTYdfOQpnT5kUDwg6HM-zrLy1oN.jpg', 1, '2022-11-27 04:35:57', '2022-11-27 04:35:57'),
(39, 8, 'WZXgSOk7Q06wxO84GQFsqvTYdfOQpnT5kUDwg6HM-pqjhz5s.jpg', 1, '2022-11-27 04:35:58', '2022-11-27 04:35:58'),
(40, 8, 'WZXgSOk7Q06wxO84GQFsqvTYdfOQpnT5kUDwg6HM-EthedRv.jpg', 1, '2022-11-27 04:35:59', '2022-11-27 04:35:59'),
(41, 9, 'CPbbf0PbZktj3Cl0h2jxz2X3gjZPsDRobKOz6X4U-rbbi0Eo.jpg', 1, '2022-11-29 04:34:48', '2022-11-29 04:34:48'),
(42, 9, 'CPbbf0PbZktj3Cl0h2jxz2X3gjZPsDRobKOz6X4U-nqoPFru.jpg', 1, '2022-11-29 04:34:49', '2022-11-29 04:34:49'),
(43, 9, 'CPbbf0PbZktj3Cl0h2jxz2X3gjZPsDRobKOz6X4U-YXKnVcs.jpg', 1, '2022-11-29 04:34:50', '2022-11-29 04:34:50'),
(44, 10, 'ANzoepDhEZ9t5EP1FDGP6rKP3O6RaSB5z3RZw4UD-QBNl0c1.jpg', 1, '2022-11-29 04:35:13', '2022-11-29 04:35:13'),
(45, 10, 'ANzoepDhEZ9t5EP1FDGP6rKP3O6RaSB5z3RZw4UD-NeMNaFA.jpg', 1, '2022-11-29 04:35:14', '2022-11-29 04:35:14'),
(46, 10, 'ANzoepDhEZ9t5EP1FDGP6rKP3O6RaSB5z3RZw4UD-X0OBCUZ.jpg', 1, '2022-11-29 04:35:15', '2022-11-29 04:35:15'),
(47, 11, '3NOkFzcv0U1OTygNTnZrTf29uNIrSmaHDIHLr9sG-E1jbUWo.jpg', 1, '2022-11-29 04:38:09', '2022-11-29 04:38:09'),
(48, 11, '3NOkFzcv0U1OTygNTnZrTf29uNIrSmaHDIHLr9sG-IslMmL3.jpg', 1, '2022-11-29 04:38:10', '2022-11-29 04:38:10'),
(49, 11, '3NOkFzcv0U1OTygNTnZrTf29uNIrSmaHDIHLr9sG-jFB73Ud.jpg', 1, '2022-11-29 04:38:11', '2022-11-29 04:38:11'),
(50, 14, 'yXJEBK0EGioz3b6p82hsFFtNCcBqGjmdYfbWBQeX-qPp2rso.jpg', 1, '2022-11-29 04:54:58', '2022-11-29 04:54:58'),
(51, 14, 'yXJEBK0EGioz3b6p82hsFFtNCcBqGjmdYfbWBQeX-OHVJSKN.jpg', 1, '2022-11-29 04:54:59', '2022-11-29 04:54:59'),
(52, 14, 'yXJEBK0EGioz3b6p82hsFFtNCcBqGjmdYfbWBQeX-snfvXyk.jpg', 1, '2022-11-29 04:55:00', '2022-11-29 04:55:00'),
(53, 14, 'yXJEBK0EGioz3b6p82hsFFtNCcBqGjmdYfbWBQeX-AxdkwLh.jpg', 1, '2022-11-29 04:55:01', '2022-11-29 04:55:01'),
(54, 14, 'yXJEBK0EGioz3b6p82hsFFtNCcBqGjmdYfbWBQeX-qzaE2YA.jpg', 1, '2022-11-29 04:55:02', '2022-11-29 04:55:02'),
(55, 14, 'yXJEBK0EGioz3b6p82hsFFtNCcBqGjmdYfbWBQeX-yo62cK4.jpg', 1, '2022-11-29 04:55:03', '2022-11-29 04:55:03'),
(56, 15, 'vPOVwriBGJ0yDlVRl7XnVHC4jPoyDHc3C6EXKtJB-0.png', 1, '2022-12-05 14:14:13', '2022-12-05 14:14:13'),
(57, 15, 'vPOVwriBGJ0yDlVRl7XnVHC4jPoyDHc3C6EXKtJB-1.png', 1, '2022-12-05 14:14:14', '2022-12-05 14:14:14'),
(58, 15, 'vPOVwriBGJ0yDlVRl7XnVHC4jPoyDHc3C6EXKtJB-2.png', 1, '2022-12-05 14:14:16', '2022-12-05 14:14:16'),
(59, 16, 'CBaA3vZRHGlR11dO7XZ3kwwgBG4ABbNtGqhKNHdv-0.jpg', 1, '2022-12-05 14:19:19', '2022-12-05 14:19:19'),
(60, 16, 'CBaA3vZRHGlR11dO7XZ3kwwgBG4ABbNtGqhKNHdv-1.jpg', 1, '2022-12-05 14:19:20', '2022-12-05 14:19:20'),
(61, 16, 'CBaA3vZRHGlR11dO7XZ3kwwgBG4ABbNtGqhKNHdv-2.jpg', 1, '2022-12-05 14:19:21', '2022-12-05 14:19:21'),
(62, 16, 'CBaA3vZRHGlR11dO7XZ3kwwgBG4ABbNtGqhKNHdv-3.jpg', 1, '2022-12-05 14:19:22', '2022-12-05 14:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `recently_viewed_products`
--

CREATE TABLE `recently_viewed_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_priority` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recently_viewed_products`
--

INSERT INTO `recently_viewed_products` (`id`, `product_id`, `session_id`, `order_priority`, `created_at`, `updated_at`) VALUES
(1, 10, 'pqYY4CpC9uadPdO', 8, NULL, NULL),
(2, 5, 'pqYY4CpC9uadPdO', 1, NULL, NULL),
(3, 9, 'pqYY4CpC9uadPdO', 9, NULL, NULL),
(4, 3, 'pqYY4CpC9uadPdO', 11, NULL, NULL),
(5, 6, 'pqYY4CpC9uadPdO', 13, NULL, NULL),
(6, 16, 'pqYY4CpC9uadPdO', 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Men\'s Fashions', 'men', 1, NULL, '2022-11-24 05:17:16'),
(2, 'Women\'s Fashions', 'women', 1, '2022-11-26 04:17:25', '2022-11-26 04:17:25'),
(3, 'Kid\'s Fashions', 'kids', 1, '2022-11-26 04:17:57', '2022-11-26 04:17:57'),
(4, 'Electronics', 'electronics', 1, NULL, '2022-11-24 05:16:11'),
(5, 'Appliances', 'appliances', 1, NULL, '2022-11-24 05:17:28'),
(6, 'Hobby', 'hobby', 1, '2022-11-01 08:19:13', '2022-11-24 05:17:37'),
(7, 'Automotives', 'automotives', 1, '2022-11-24 03:57:08', '2022-11-24 05:17:47'),
(8, 'Industrials', 'industrials', 1, '2022-11-24 03:57:54', '2022-11-24 05:17:58'),
(9, 'Foods & Beverages', 'foods-and-beverages', 1, '2022-11-24 04:07:45', '2022-11-24 05:18:10'),
(10, 'Beauty & Personal Care', 'beauty-personal-care', 1, '2022-11-24 04:10:16', '2022-11-24 05:18:22'),
(11, 'Health & Household', 'health-household', 1, '2022-11-24 04:10:28', '2022-11-24 05:18:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Adhyaksa Setiabudi', 'adhyaksasb@gmail.com', NULL, '$2y$10$Fx9Tk/8khzoMJaPG.P6xz.OGtjYH9/I7apUODdmue8X9PFI5UcyNK', NULL, '2022-10-02 23:37:45', '2022-10-02 23:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_confirmed` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `email`, `email_confirmed`, `status`, `created_at`, `updated_at`) VALUES
(1, 'John Dee', 'Jl. Contoh Alamat No.27', 'Bandung', 'Jawa Barat', 'Indonesia', '11254', '081224854565', 'john@admin.com', 'No', 1, NULL, '2022-12-04 01:31:08'),
(3, 'Adhyaksa Setiabudi', NULL, NULL, NULL, NULL, NULL, '082334189965', 'adhyaksasb@yxgkuy.com', 'No', 0, '2022-12-06 09:37:45', '2022-12-06 09:37:45'),
(4, 'Joseph Kye', 'Jl. Contoh Alamat No.134', 'Bandung', 'Jawa Barat', 'Indonesia', '11254', '823435393214', 'fdsfseqwe@dawqe.com', 'Yes', 0, '2022-12-06 11:35:05', '2023-01-01 09:09:17'),
(5, 'Mary Jane', NULL, NULL, NULL, NULL, NULL, '082342512348', 'maryjanemarontong@gmail.com', 'Yes', 0, '2022-12-06 11:39:47', '2022-12-06 13:23:49'),
(6, 'Adhyaksa Setiabudi', 'Jl. Contoh Alamat No.27', 'Bandung', 'Jawa Barat', 'Indonesia', '11254', '0812349798954', 'dee@gyure.com', 'Yes', 0, '2022-12-06 12:30:19', '2022-12-07 10:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `vendors_bank_details`
--

CREATE TABLE `vendors_bank_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `account_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors_bank_details`
--

INSERT INTO `vendors_bank_details` (`id`, `vendor_id`, `account_holder_name`, `bank_code`, `bank_name`, `account_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'John Dee', '014', 'BCA', '01254877495', NULL, '2022-10-29 02:53:04'),
(6, 6, 'Dee', '015', 'BNI', '01254877494', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors_business_details`
--

CREATE TABLE `vendors_business_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_proof` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_proof_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors_business_details`
--

INSERT INTO `vendors_business_details` (`id`, `vendor_id`, `shop_name`, `shop_address`, `shop_city`, `shop_state`, `shop_country`, `shop_pincode`, `shop_mobile`, `shop_website`, `shop_url`, `shop_email`, `address_proof`, `address_proof_image`, `business_license_number`, `tax_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'John Electronics', 'Jl. Contoh Alamat 2', 'Surabaya', 'Jawa Timur', 'Indonesia', '11754', '081454754888', 'johnelectronics.com', '', 'john@business.com', 'Property Tax Receipt', '77423.png', '23423420334', '09.254.294.3-407.001', NULL, '2022-10-31 10:08:49'),
(4, 4, 'Kye Healthcare', 'Jl. Contoh Alamat 43', 'Surabaya', 'Jawa Timur', 'Albania', '4223', '132433', 'kyehealhs.com', '', 'kye@kye.com', 'Utility Bill', 'RkJHFwBdHE9bvXb9x4J6yTbQGjyA65.png', '23423420342', '09.254.294.3-407.001', NULL, NULL),
(6, 6, 'Dee Electronics', 'Jl. Contoh Alamat 2', 'Surabaya', 'Jawa Timur', 'Indonesia', '12434325', '24325232', 'deelectronics.com', 'dee-electronics', 'adreqrw@gmail.com', 'Registration Agreement', '0ycNf1QiZmubmSkelm7KXWXgcbYZGj.png', '23423420342', '09.254.294.3-407.001', NULL, '2023-01-18 13:06:44');

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
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_attributes`
--
ALTER TABLE `products_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_filters`
--
ALTER TABLE `products_filters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_filters_values`
--
ALTER TABLE `products_filters_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recently_viewed_products`
--
ALTER TABLE `recently_viewed_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- Indexes for table `vendors_bank_details`
--
ALTER TABLE `vendors_bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors_business_details`
--
ALTER TABLE `vendors_business_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products_attributes`
--
ALTER TABLE `products_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `products_filters`
--
ALTER TABLE `products_filters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products_filters_values`
--
ALTER TABLE `products_filters_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `recently_viewed_products`
--
ALTER TABLE `recently_viewed_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vendors_bank_details`
--
ALTER TABLE `vendors_bank_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vendors_business_details`
--
ALTER TABLE `vendors_business_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
