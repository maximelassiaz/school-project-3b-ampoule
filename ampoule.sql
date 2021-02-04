-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2021 at 04:35 PM
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
  `prix` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ampoule`
--

INSERT INTO `ampoule` (`id`, `date_changement`, `etage`, `position`, `prix`) VALUES
(1, '2020-12-14 13:00:00', 6, 1, '4.99'),
(5, '2021-02-18 18:39:00', 4, 3, '3.49'),
(6, '2020-11-04 16:40:00', 7, 2, '7.49'),
(7, '2020-11-10 15:03:00', 10, 2, '9.49'),
(9, '2020-12-02 18:48:00', 0, 2, '7.89'),
(10, '2021-02-04 16:15:00', 6, 2, '8.99');

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
(1, 'Marco', 'marcopolo42', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ampoule`
--
ALTER TABLE `ampoule`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gardien`
--
ALTER TABLE `gardien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
