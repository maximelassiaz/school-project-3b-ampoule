-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2021 at 03:22 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ampoule`
--

-- --------------------------------------------------------

--
-- Table structure for table `ampoule`
--

CREATE TABLE `ampoule` (
  `id` int(11) NOT NULL,
  `date_changement` datetime NOT NULL DEFAULT current_timestamp(),
  `etage` int(2) NOT NULL,
  `position` int(1) NOT NULL,
  `prix` decimal(9,2) NOT NULL,
  `id_gardien` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ampoule`
--

INSERT INTO `ampoule` (`id`, `date_changement`, `etage`, `position`, `prix`, `id_gardien`) VALUES
(1, '2020-12-23 13:00:00', 4, 1, '4.99', 1),
(7, '2020-11-10 15:03:00', 10, 2, '9.49', 1),
(9, '2020-12-02 18:48:00', 0, 2, '7.89', 1),
(10, '2021-02-04 16:15:00', 6, 2, '8.99', 1),
(11, '2021-02-05 08:59:00', 0, 1, '7.99', 1),
(12, '2021-02-03 12:00:00', 5, 3, '5.49', 1),
(18, '2021-02-18 14:26:00', 3, 2, '4.99', 2);

-- --------------------------------------------------------

--
-- Table structure for table `gardien`
--

CREATE TABLE `gardien` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gardien`
--

INSERT INTO `gardien` (`id`, `name`, `username`, `password`) VALUES
(1, 'Marco', 'marcopolo42', '123'),
(2, 'Denise', 'Denise123', '456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ampoule`
--
ALTER TABLE `ampoule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_gardien` (`id_gardien`);

--
-- Indexes for table `gardien`
--
ALTER TABLE `gardien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ampoule`
--
ALTER TABLE `ampoule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `gardien`
--
ALTER TABLE `gardien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ampoule`
--
ALTER TABLE `ampoule`
  ADD CONSTRAINT `ampoule_ibfk_1` FOREIGN KEY (`id_gardien`) REFERENCES `gardien` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
