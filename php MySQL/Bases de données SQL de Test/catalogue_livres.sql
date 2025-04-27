-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2025 at 05:59 PM
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
-- Database: `catalogue_livres`
--

-- --------------------------------------------------------

--
-- Table structure for table `livres`
--

CREATE TABLE `livres` (
  `id` int NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `annee_publication` smallint DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `livres`
--

INSERT INTO `livres` (`id`, `titre`, `auteur`, `annee_publication`, `disponible`) VALUES
(5, 'Harry Potter et la Chambre des Secrets', 'J.K. Rowling', 1998, 1),
(6, 'Le Seigneur des Anneaux', 'J.R.R. Tolkien', 1954, 1),
(7, 'Les Miserables', 'Victor Hugo', 1862, 0),
(8, 'Dune', 'Frank Herbert', 1965, 1),
(9, 'Plus Noir que Noir', 'stephen King', 2025, 1),
(10, '1984', 'George Orwell', 1949, 1),
(11, 'To Kill a Mockingbird', 'Harper Lee', 1960, 1),
(12, 'Pride and Prejudice', 'Jane Austen', 1813, 1),
(13, 'The Great Gatsby', 'F. Scott Fitzgerald', 1925, 1),
(14, 'Moby-Dick', 'Herman Melville', 1851, 0),
(15, 'War and Peace', 'Leo Tolstoy', 1869, 1),
(16, 'Crime and Punishment', 'Fyodor Dostoevsky', 1866, 1),
(17, 'Brave New World', 'Aldous Huxley', 1932, 0),
(18, 'The Catcher in the Rye', 'J.D. Salinger', 1951, 1),
(19, 'The Hobbit', 'J.R.R. Tolkien', 1937, 1),
(20, 'Les Fleurs du mal', 'Charles Baudelaire', 1857, 1),
(21, 'Le Comte de Monte-Cristo', 'Alexandre Dumas', 1844, 1),
(22, 'Notre-Dame de Paris', 'Victor Hugo', 1831, 1),
(23, 'Fahrenheit 451', 'Ray Bradbury', 1953, 1),
(24, 'Dracula', 'Bram Stoker', 1897, 0),
(25, 'Frankenstein', 'Mary Shelley', 1818, 1),
(26, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 1943, 1),
(27, 'Candide', 'Voltaire', 1759, 1),
(28, 'Don Quichotte', 'Miguel de Cervantes', 1605, 1),
(29, 'L’Étranger', 'Albert Camus', 1942, 1),
(30, 'La Peste', 'Albert Camus', 1947, 1),
(31, 'Bel-Ami', 'Guy de Maupassant', 1885, 0),
(32, 'Germinal', 'Émile Zola', 1885, 1),
(33, 'L’Assommoir', 'Émile Zola', 1877, 0),
(34, 'Madame Bovary', 'Gustave Flaubert', 1857, 1),
(35, 'Ulysses', 'James Joyce', 1922, 0),
(36, 'The Brothers Karamazov', 'Fyodor Dostoevsky', 1880, 1),
(37, 'Jane Eyre', 'Charlotte Brontë', 1847, 1),
(38, 'Wuthering Heights', 'Emily Brontë', 1847, 1),
(39, 'The Odyssey', 'Homer', -700, 1),
(40, 'The Iliad', 'Homer', -750, 0),
(41, 'Le Rouge et le Noir', 'Stendhal', 1830, 1),
(42, 'La Chartreuse de Parme', 'Stendhal', 1839, 0),
(43, 'A Tale of Two Cities', 'Charles Dickens', 1859, 1),
(44, 'Great Expectations', 'Charles Dickens', 1861, 1),
(45, 'Oliver Twist', 'Charles Dickens', 1838, 1),
(46, 'David Copperfield', 'Charles Dickens', 1850, 0),
(47, 'The Picture of Dorian Gray', 'Oscar Wilde', 1890, 1),
(48, 'The Count of Monte Cristo', 'Alexandre Dumas', 1845, 1),
(49, 'Around the World in 80 Days', 'Jules Verne', 1873, 1),
(50, 'Twenty Thousand Leagues Under the Seas', 'Jules Verne', 1870, 1),
(51, 'Journey to the Center of the Earth', 'Jules Verne', 1864, 0),
(52, 'The Time Machine', 'H.G. Wells', 1895, 1),
(53, 'The Invisible Man', 'H.G. Wells', 1897, 1),
(54, 'The War of the Worlds', 'H.G. Wells', 1898, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `livres`
--
ALTER TABLE `livres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
