-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 23, 2023 at 05:29 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `expire_date` varchar(50) NOT NULL,
  `create_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `unique_id`, `name`, `discount`, `expire_date`, `create_at`) VALUES
(3, '01b9ee2813301bd7fd8985d0a82df965', 'QAmlKu', '100', '2023-02-16', '12-02-2023');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `symbol` varchar(5) NOT NULL,
  `rate` varchar(50) NOT NULL,
  `create_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `unique_id`, `name`, `symbol`, `rate`, `create_at`) VALUES
(4, '266a4b9239ab4c8c0a1e6a3f2c4cb085', 'NGN', 'â‚¦', '110', '17-07-2022');

-- --------------------------------------------------------

--
-- Table structure for table `default_currency`
--

CREATE TABLE `default_currency` (
  `unique_id` varchar(250) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `default_currency`
--

INSERT INTO `default_currency` (`unique_id`, `symbol`, `status`) VALUES
('266a4b9239ab4c8c0a1e6a3f2c4cb085', 'â‚¦', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_locations`
--

CREATE TABLE `delivery_locations` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(250) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1= enable and 0=disable'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_locations`
--

INSERT INTO `delivery_locations` (`id`, `unique_id`, `state_id`, `name`, `price`, `status`) VALUES
(1, '62750fba0b8c89b5a8a56ae5434b6341', 2671, 'mushin', '1200', 1),
(2, 'dee4d8aa4a409dae5ef9c0c56dd5db00', 2671, 'agege', '1000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `create_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_ref` varchar(50) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_discount` varchar(50) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0' COMMENT '1=pay and 0=not paid',
  `delivery_status` int(11) NOT NULL DEFAULT '0' COMMENT '1=delivered,0=pending',
  `delivery_id` varchar(250) NOT NULL,
  `delivery_fee` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `no_product` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `create_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `product_id` varchar(250) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `order_ref` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(250) NOT NULL,
  `token` varchar(250) NOT NULL,
  `create_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_historys`
--

CREATE TABLE `payment_historys` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `txref` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `transaction_type` enum('booking','store') NOT NULL,
  `currency` varchar(10) NOT NULL,
  `gateway` enum('paystack','flutterwave') NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=paid and 0=fail',
  `paid_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `image` text NOT NULL,
  `create_at` varchar(50) NOT NULL,
  `update_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `create_at` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
(2647, 'Abia', 160),
(2648, 'Abuja Federal Capital Territor', 160),
(2649, 'Adamawa', 160),
(2650, 'Akwa Ibom', 160),
(2651, 'Anambra', 160),
(2652, 'Bauchi', 160),
(2653, 'Bayelsa', 160),
(2654, 'Benue', 160),
(2655, 'Borno', 160),
(2656, 'Cross River', 160),
(2657, 'Delta', 160),
(2658, 'Ebonyi', 160),
(2659, 'Edo', 160),
(2660, 'Ekiti', 160),
(2661, 'Enugu', 160),
(2662, 'Gombe', 160),
(2663, 'Imo', 160),
(2664, 'Jigawa', 160),
(2665, 'Kaduna', 160),
(2666, 'Kano', 160),
(2667, 'Katsina', 160),
(2668, 'Kebbi', 160),
(2669, 'Kogi', 160),
(2670, 'Kwara', 160),
(2671, 'Lagos', 160),
(2672, 'Nassarawa', 160),
(2673, 'Niger', 160),
(2674, 'Ogun', 160),
(2675, 'Ondo', 160),
(2676, 'Osun', 160),
(2677, 'Oyo', 160),
(2678, 'Plateau', 160),
(2679, 'Rivers', 160),
(2680, 'Sokoto', 160),
(2681, 'Taraba', 160),
(2682, 'Yobe', 160),
(2683, 'Zamfara', 160);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '2' COMMENT '1-admin and 2-customer',
  `is_verify` varchar(50) DEFAULT NULL,
  `image` text,
  `create_at` varchar(50) NOT NULL,
  `update_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `name`, `phone`, `email`, `password`, `role`, `is_verify`, `image`, `create_at`, `update_at`) VALUES
(2, 'ce78708a76cb231e5b3e06222942709e', 'jjffddd', '08169677397', 'admin@babcock.com', '$2y$10$yLG6nL1VsFIOnUd0Eu4LJeaPKMv6FZVQQNIApkMIJASxQgMqZtsxq', 1, '08-07-2022 08:27:43', NULL, '07-07-2022', '24-07-2022'),
(11, '6170ec720be82f8c18cf3e9d2d0ea31a', 'test user', '234813458899', 'testuser@mail.com', '$2y$10$pLXXIx1.Iv/AS.wyQZJuzOkiANxjItirvZjF1cOLSh7./wlFjSkSW', 2, '12-02-2023 06:39:23', NULL, '12-02-2023', '12-02-2023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_locations`
--
ALTER TABLE `delivery_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_historys`
--
ALTER TABLE `payment_historys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
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
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery_locations`
--
ALTER TABLE `delivery_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_historys`
--
ALTER TABLE `payment_historys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2684;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
