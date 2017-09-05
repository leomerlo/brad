-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2017 at 07:29 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brad`
--

-- --------------------------------------------------------

--
-- Table structure for table `mesa`
--

CREATE TABLE `mesa` (
  `id` int(11) UNSIGNED NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` tinyint(1) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mesa`
--

INSERT INTO `mesa` (`id`, `numero`, `pax`, `tipo`, `active`) VALUES
(1, '35', '2', 1, 1),
(2, '35A', '2', 1, 1),
(3, '37', '2', 1, 1),
(4, '37A', '2', 1, 1),
(5, '33', '2 a 4', 1, 1),
(6, '34', '2 a 4', 1, 1),
(7, '1', '4', 1, 1),
(8, '2', '4', 1, 1),
(9, '3', '4', 1, 1),
(10, '4', '4', 1, 1),
(11, '5', '4', 1, 1),
(12, '6', '4', 1, 1),
(13, '7', '4', 1, 1),
(14, '8', '4', 1, 1),
(15, '9', '4', 1, 1),
(16, '17', '6 a 10', 1, 1),
(17, '10A', '2', 1, 1),
(18, '36', '2', 1, 1),
(19, '36A', '2', 1, 1),
(20, '36B', '4', 1, 1),
(21, '11', '6', 1, 1),
(22, '12', '6', 1, 1),
(23, '14', '4', 1, 1),
(24, '15', '4', 1, 1),
(25, '18', '2', 1, 1),
(26, '19', '2', 1, 1),
(27, '10', '2', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mesa_reserva`
--

CREATE TABLE `mesa_reserva` (
  `id` int(11) UNSIGNED NOT NULL,
  `mesa_id` int(11) UNSIGNED DEFAULT NULL,
  `reserva_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mesa_reserva`
--

INSERT INTO `mesa_reserva` (`id`, `mesa_id`, `reserva_id`) VALUES
(1, 1, 2),
(5, 2, 2),
(6, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` int(11) UNSIGNED DEFAULT NULL,
  `dia` date DEFAULT NULL,
  `hora` tinyint(3) UNSIGNED DEFAULT NULL,
  `pax` tinyint(3) UNSIGNED DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reserva`
--

INSERT INTO `reserva` (`id`, `nombre`, `apellido`, `telefono`, `dia`, `hora`, `pax`, `observaciones`, `active`) VALUES
(2, 'Leandro', 'Merlo', 1523997318, '2017-09-05', 21, 4, 'CAPO', 1),
(3, 'Leandro', 'Merlo', 1523997318, '2017-09-05', 23, 4, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `active` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nombre`, `type`, `active`) VALUES
(2, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Admin User', 0, 1),
(3, 'antoV', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Anto Vicentin', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mesa_reserva`
--
ALTER TABLE `mesa_reserva`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_2c6a25e7a3b1ccd2472253cff94cd1b8c34abf94` (`mesa_id`,`reserva_id`),
  ADD KEY `index_for_mesa_reserva_mesa_id` (`mesa_id`),
  ADD KEY `index_for_mesa_reserva_reserva_id` (`reserva_id`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `mesa_reserva`
--
ALTER TABLE `mesa_reserva`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
