-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2026 at 06:29 AM
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
-- Database: `rental_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `item` varchar(100) DEFAULT NULL,
  `hari` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `metode` varchar(20) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `kembalian` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kategori`, `item`, `hari`, `qty`, `metode`, `total`, `bayar`, `kembalian`, `tanggal`, `jam`, `created_at`) VALUES
(1, 'Minuman', 'PS4 12-16', 'weekday', 1, 'Cash', 0, 50000, 50000, '2026-05-26', '07:58:18', '2026-05-26 00:58:18'),
(2, 'PS4', 'PS4 05-09', 'weekday', 1, 'Cash', 10000, 50000, 40000, '2026-05-26', '07:58:49', '2026-05-26 00:58:49'),
(3, 'PS4', 'PS4 09', 'weekend', 2, 'Cash', 24000, 25000, 1000, '2026-05-26', '08:07:35', '2026-05-26 01:07:35'),
(4, 'Minuman', 'Milku Coklat', 'weekday', 2, 'Cash', 12000, 15000, 3000, '2026-05-26', '08:20:53', '2026-05-26 01:20:53'),
(5, 'Minuman', 'Milku Strawberry', 'weekday', 2, 'Cash', 12000, 15000, 3000, '2026-05-26', '08:23:33', '2026-05-26 01:23:33'),
(6, 'Minuman', 'Fanta', 'weekday', 3, 'Cash', 15000, 20000, 5000, '2026-05-26', '08:26:51', '2026-05-26 01:26:51'),
(7, 'PS4', 'PS4 12', 'weekday', 3, 'Cash', 30000, 20000, -10000, '2026-05-26', '08:32:21', '2026-05-26 01:32:21'),
(8, 'PS4', 'PS4 12', 'weekday', 3, 'Cash', 30000, 20000, -10000, '2026-05-27', '19:34:23', '2026-05-27 12:34:23'),
(9, 'PS4', 'PS4 12', 'weekday', 3, 'Cash', 30000, 20000, -10000, '2026-05-27', '19:34:52', '2026-05-27 12:34:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
