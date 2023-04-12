-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2023 at 06:45 AM
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
-- Database: `our_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_slug` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `category_name`, `category_slug`, `created_at`) VALUES
(3, 1, 'web design', 'new-web-design', '2023-03-29 08:14:19'),
(4, 1, 'design', 'web-design', '2023-03-29 08:26:04'),
(5, 8, 'Ashik 2 Category', 'ashik2-category', '2023-03-29 08:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `per_item_price` varchar(255) DEFAULT NULL,
  `per_item_m_price` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL,
  `total_m_price` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `user_id`, `group_name`, `product_id`, `quantity`, `expire_date`, `per_item_price`, `per_item_m_price`, `total_price`, `total_m_price`, `created_at`) VALUES
(1, 1, 'G1', 4, 5, '2025-04-04', '100', '80', '500', '400', '2023-04-04 07:47:06'),
(2, 1, 'G2', 4, 200, '2025-04-10', '2000', '1800', '400000', '360000', '2023-04-08 07:25:25'),
(3, 1, 'HP G1', 6, 200, '2023-04-08', '200', '180', '40000', '36000', '2023-04-08 07:36:10'),
(4, 1, 'HP G1', 6, 200, '2023-04-08', '200', '180', '40000', '36000', '2023-04-08 08:15:53'),
(5, 1, 'G3', 4, 100, '2023-04-30', '10000', '8000', '1000000', '800000', '2023-04-08 08:16:24'),
(6, 1, 'G3', 4, 100, '2023-04-30', '10000', '8000', '1000000', '800000', '2023-04-08 08:18:17'),
(7, 1, 'G3', 4, 100, '2023-04-30', '10000', '8000', '1000000', '800000', '2023-04-08 08:18:32'),
(8, 1, 'G3', 4, 100, '2023-04-30', '10000', '8000', '1000000', '800000', '2023-04-08 08:18:53');

-- --------------------------------------------------------

--
-- Table structure for table `manufactures`
--

CREATE TABLE `manufactures` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufactures`
--

INSERT INTO `manufactures` (`id`, `user_id`, `name`, `address`, `mobile`, `created_at`) VALUES
(1, 1, 'LG', 'Dhaka', '01752585458', '2023-04-01 07:54:13'),
(4, 1, 'Acer', 'Dhaka', '01751258542', '2023-04-04 07:32:41'),
(5, 1, 'HP Global', 'Dhaka', '01751258522', '2023-04-08 07:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `category_id`, `description`, `photo`, `created_at`, `stock`) VALUES
(4, 1, 'Acer Laptop  22', 3, '<p>Test<br></p>', '1-2376-1681109339.jpg', '2023-04-01 07:28:58', 90),
(6, 1, 'HP', 3, '<p>Test<br></p>', '1-5495-1680327244.jpeg', '2023-04-01 07:34:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `manufacture_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `per_item_price` varchar(255) DEFAULT NULL,
  `per_item_m_price` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL,
  `total_m_price` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `manufacture_id`, `product_id`, `group_name`, `quantity`, `per_item_price`, `per_item_m_price`, `total_price`, `total_m_price`, `created_at`) VALUES
(1, 1, 4, 4, 'G1', 5, '100', '80', '500', '400', '2023-04-04 07:47:06'),
(2, 1, 4, 4, 'G2', 200, '2000', '1800', '400000', '360000', '2023-04-08 07:25:25'),
(3, 1, 5, 6, 'HP G1', 200, '200', '180', '40000', '36000', '2023-04-08 07:36:10'),
(4, 1, 5, 6, 'HP G1', 200, '200', '180', '40000', '36000', '2023-04-08 08:15:53'),
(5, 1, 4, 4, 'G3', 100, '10000', '8000', '1000000', '800000', '2023-04-08 08:16:24'),
(6, 1, 4, 4, 'G3', 100, '10000', '8000', '1000000', '800000', '2023-04-08 08:18:17'),
(7, 1, 4, 4, 'G3', 100, '10000', '8000', '1000000', '800000', '2023-04-08 08:18:32'),
(8, 1, 4, 4, 'G3', 100, '10000', '8000', '1000000', '800000', '2023-04-08 08:18:53');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `manufacture_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `mprice` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` varchar(100) DEFAULT NULL,
  `discount_type` varchar(100) DEFAULT NULL,
  `discount_amount` varchar(100) DEFAULT NULL,
  `sub_total` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `customer_name`, `product_id`, `manufacture_id`, `group_id`, `expire_date`, `price`, `mprice`, `quantity`, `total_price`, `discount_type`, `discount_amount`, `sub_total`, `created_at`) VALUES
(1, 1, 'Ashik', 4, 4, 1, '2025-04-04', '100', '80', 100, '10000', 'fixed', '200', '9800', '2023-04-10 07:47:08'),
(2, 1, 'Test', 4, 4, 1, '2025-04-04', '100', '80', 10, '1000', 'none', '', '1000', '2023-04-10 08:54:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email_code` int(11) DEFAULT NULL,
  `email_status` int(11) DEFAULT 0,
  `mobile_code` int(11) DEFAULT NULL,
  `mobile_status` int(11) DEFAULT 0,
  `forget_token` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `mobile`, `password`, `business_name`, `address`, `email_code`, `email_status`, `mobile_code`, `mobile_status`, `forget_token`, `photo`, `gender`, `date_of_birth`, `status`, `created_at`) VALUES
(1, 'Ashik', 'ashik', 'ashik@gmail.com', '01751331330', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Coder IT Solution', 'Fulbari', NULL, 1, NULL, 1, NULL, '1.png', 'on', '2023-03-21', 'Active', '2023-03-22 07:35:24'),
(4, 'Admin', 'admin', 'ashiktpi30@gmail.com', '01751258545', '8cb2237d0679ca88db6464eac60da96345513964', 'CoderIT2', 'Fulbari', NULL, 1, NULL, 1, NULL, NULL, 'Male', '2023-03-25', 'Pending', '2023-03-25 07:07:19'),
(6, 'Admin2', 'admin2', 'admin2@gmail.com', '01751258544', '8cb2237d0679ca88db6464eac60da96345513964', 'Coder IT 3', 'F', NULL, 1, NULL, 1, NULL, NULL, 'Male', '2023-03-25', 'Pending', '2023-03-25 07:42:52'),
(7, 'Ashik4', 'ashik4', 'ashik4@gmail.com', '01751258542', '8cb2237d0679ca88db6464eac60da96345513964', 'Coder IT 3', 'D', NULL, 1, NULL, 1, NULL, NULL, 'Male', '2023-03-25', 'Pending', '2023-03-25 07:49:27'),
(8, 'Ashik 2', 'ashik2', 'ashik2@gmail.com', '01751258588', '8cb2237d0679ca88db6464eac60da96345513964', 'Coder IT 2', 'Fulbari', NULL, 1, NULL, 1, NULL, NULL, 'Male', '2023-03-29', 'Active', '2023-03-29 08:43:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufactures`
--
ALTER TABLE `manufactures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `manufactures`
--
ALTER TABLE `manufactures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
