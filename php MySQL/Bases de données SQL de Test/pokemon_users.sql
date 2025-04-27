-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2025 at 06:01 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pokemon_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `description`) VALUES
(1, 'Lorenzo', 'lorenzo.lhostis@edu.devinci.fr', '$2y$10$3a8aLy0cji7PS9RNQYuWSeuEUAXpTW/9rKMcgMVn3Nx7nyENJtvme', NULL),
(3, 'MaxymLeGoat', 'Maxyme.LeGoat@gmail.com', '$2y$10$/UnjuprLOgsqcA0W6DA3HOic3ZvD2K7j5T/HglQqAEM1ugjBMJ.mu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_favorite`
--

CREATE TABLE `users_favorite` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `card_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users_favorite`
--

INSERT INTO `users_favorite` (`id`, `user_id`, `card_id`) VALUES
(1239, 1, 8),
(1240, 1, 4),
(1241, 1, 10),
(1242, 1, 6),
(1244, 1, 2),
(1245, 1, 1),
(1247, 3, 1),
(1248, 3, 7),
(1249, 3, 3),
(1250, 3, 9),
(1251, 3, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_favorite`
--
ALTER TABLE `users_favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_favorite`
--
ALTER TABLE `users_favorite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1252;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_favorite`
--
ALTER TABLE `users_favorite`
  ADD CONSTRAINT `users_favorite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
