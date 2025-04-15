-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 06:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_rentbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_code`, `title`, `author`, `year`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BK001', 'The Pragmatic Programmer', 'Andrew Hunt & David Thomas', '1999', 'https://images-na.ssl-images-amazon.com/images/I/41as+WafrFL._SX258_BO1,204,203,200_.jpg', 'A classic book on software engineering and programming best practices.', 'available', '2025-04-14 21:33:29', '2025-04-14 21:33:29'),
(2, 'BK002', 'Clean Code', 'Robert C. Martin', '2008', 'https://images-na.ssl-images-amazon.com/images/I/41xShlnTZTL._SX374_BO1,204,203,200_.jpg', 'A handbook of agile software craftsmanship and writing clean code.', 'available', '2025-04-14 21:33:29', '2025-04-14 21:33:29'),
(3, 'BK003', 'Introduction to Algorithms', 'Thomas H. Cormen', '2009', 'https://images-na.ssl-images-amazon.com/images/I/51oXKWrcYYL._SX376_BO1,204,203,200_.jpg', 'Comprehensive textbook covering a broad range of algorithms in depth.', 'available', '2025-04-14 21:33:29', '2025-04-14 21:33:29'),
(4, 'BK004', 'Design Patterns: Elements of Reusable Object-Oriented Software', 'Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides', '1994', 'https://images-na.ssl-images-amazon.com/images/I/51kue3jYcbL._SX379_BO1,204,203,200_.jpg', 'The foundational book on software design patterns for OOP.', 'available', '2025-04-14 21:33:29', '2025-04-14 21:33:29'),
(5, 'BK005', 'Refactoring: Improving the Design of Existing Code', 'Martin Fowler', '2018', 'https://images-na.ssl-images-amazon.com/images/I/51k4j6wz+jL._SX379_BO1,204,203,200_.jpg', 'Guidance on how to improve software structure without changing functionality.', 'available', '2025-04-14 21:33:29', '2025-04-14 21:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`id`, `book_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 13, NULL, NULL),
(2, 1, 14, NULL, NULL),
(3, 1, 17, NULL, NULL),
(4, 2, 14, NULL, NULL),
(5, 3, 2, NULL, NULL),
(6, 3, 12, NULL, NULL),
(7, 3, 20, NULL, NULL),
(8, 4, 1, NULL, NULL),
(9, 4, 9, NULL, NULL),
(10, 4, 18, NULL, NULL),
(11, 5, 21, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'fiction', NULL, NULL),
(2, 'non-fiction', NULL, NULL),
(3, 'comic', NULL, NULL),
(4, 'novel', NULL, NULL),
(5, 'romance', NULL, NULL),
(6, 'self-help books', NULL, NULL),
(7, 'children books', NULL, NULL),
(8, 'biography', NULL, NULL),
(9, 'autobiography', NULL, NULL),
(10, 'text-books', NULL, NULL),
(11, 'political books', NULL, NULL),
(12, 'academic books', NULL, NULL),
(13, 'mystery', NULL, NULL),
(14, 'thrillers', NULL, NULL),
(15, 'poetry books', NULL, NULL),
(16, 'spiritual books', NULL, NULL),
(17, 'cook books', NULL, NULL),
(18, 'art books', NULL, NULL),
(19, 'young adult books', NULL, NULL),
(20, 'board books', NULL, NULL),
(21, 'history books', NULL, NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2014_10_12_000000_create_users_table', 2),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(11, '2025_04_09_125408_create_categories_table', 2),
(12, '2025_04_09_130239_create_books_table', 2),
(13, '2025_04_09_130359_create_book_category_table', 2),
(14, '2025_04_09_130431_create_rent_logs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rent_logs`
--

CREATE TABLE `rent_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `rent_date` date NOT NULL,
  `return_date` date NOT NULL,
  `actual_return_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'on rent',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'inactive',
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `address`, `status`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@erentbook.test', '$2y$10$dCRcpzLHV8ZUFEuOuFZQV.H2kkv3s7DwQkVCcZu0uh/dn8D8OLLy2', '081234567890', 'Jl. Admin Utama No.1', 'active', 'admin', '2025-04-14 21:33:28', '2025-04-14 21:33:28'),
(2, 'user_inactive', 'inactive@erentbook.test', '$2y$10$Ej0FkAy0e7GezmKtrn3wHePseOkuuC0rGqzlkFOp91W1JgqJ8QNRG', '081111111111', 'Jl. Inaktif No.2', 'inactive', 'user', '2025-04-14 21:33:28', '2025-04-14 21:33:28'),
(3, 'user_active', 'active@erentbook.test', '$2y$10$5II3Z0J5UiPr.klVBsYFdegEhhazxW/iI1UCUrbfVwG20Fpq4hRCS', '082222222222', 'Jl. Aktif No.3', 'active', 'user', '2025-04-14 21:33:28', '2025-04-14 21:33:28'),
(4, 'user_banned', 'banned@erentbook.test', '$2y$10$5iqUX5s0tLmXG1l0dcSVROiJ.1OvB4hhlO/Jg92GXqtcsufZJumta', '083333333333', 'Jl. Banned No.4', 'banned', 'user', '2025-04-14 21:33:28', '2025-04-14 21:33:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_book_code_unique` (`book_code`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_category_book_id_foreign` (`book_id`),
  ADD KEY `book_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rent_logs`
--
ALTER TABLE `rent_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rent_logs_user_id_foreign` (`user_id`),
  ADD KEY `rent_logs_book_id_foreign` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rent_logs`
--
ALTER TABLE `rent_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rent_logs`
--
ALTER TABLE `rent_logs`
  ADD CONSTRAINT `rent_logs_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rent_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
