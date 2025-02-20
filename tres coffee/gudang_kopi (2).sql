-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 20, 2025 at 02:09 AM
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
-- Database: `gudang_kopi`
--

-- --------------------------------------------------------

--
-- Table structure for table `beans`
--

CREATE TABLE `beans` (
  `id` int(2) NOT NULL,
  `nama_bean` varchar(25) NOT NULL,
  `jumlah_bean` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beans`
--

INSERT INTO `beans` (`id`, `nama_bean`, `jumlah_bean`) VALUES
(2, 'Kopi Robusta', 1000),
(3, 'Kopi Liberika', 1000),
(4, 'Kopi Excelsa', 2000),
(5, 'Kopi Arabika', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `inout_bean`
--

CREATE TABLE `inout_bean` (
  `id_inout` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jenis_transaksi` enum('IN','OUT') NOT NULL,
  `jumlah` int(50) NOT NULL,
  `tanggal_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inout_bean`
--

INSERT INTO `inout_bean` (`id_inout`, `id_barang`, `jenis_transaksi`, `jumlah`, `tanggal_transaksi`) VALUES
(8, 4, 'IN', 1000, '2025-02-08'),
(9, 5, 'IN', 4000, '2025-02-11'),
(10, 5, 'OUT', 4000, '2025-02-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beans`
--
ALTER TABLE `beans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inout_bean`
--
ALTER TABLE `inout_bean`
  ADD PRIMARY KEY (`id_inout`),
  ADD KEY `id_barang` (`id_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inout_bean`
--
ALTER TABLE `inout_bean`
  MODIFY `id_inout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inout_bean`
--
ALTER TABLE `inout_bean`
  ADD CONSTRAINT `fk_id_barang` FOREIGN KEY (`id_barang`) REFERENCES `beans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
