-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 03:41 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtpi`
--

-- --------------------------------------------------------

--
-- Table structure for table `kode_akun`
--

CREATE TABLE `kode_akun` (
  `id` int(4) NOT NULL,
  `kode` int(3) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kode_akun`
--

INSERT INTO `kode_akun` (`id`, `kode`, `nama`, `saldo`) VALUES
(1, 1100, 'AKTIVA LANCAR', 0),
(2, 2100, 'UTANG LANCAR', 0),
(3, 1102, 'BANK BCA', 10000),
(4, 1101, 'KAS', 10000),
(8, 2104, 'PPN MASUKAN', 0),
(9, 2105, 'PPN KELUARAN', 0),
(10, 2101, 'UTANG USAHA', 10000),
(11, 5101, 'PEMBELIAN', 10000),
(12, 5104, 'UANG MUKA PEMBELIAN', 0),
(13, 5102, 'POTONGAN PEMBELIAN', 0),
(14, 4104, 'PENDAPATAN DITERIMA MUKA', 0),
(15, 4102, 'POTONGAN PENJUALAN', 0),
(16, 4101, 'PENJUALAN', 10000),
(17, 1111, 'PIUTANG USAHA', 0),
(18, 4100, 'PENDAPATAN', 0),
(19, 5100, 'HARGA POKOK PENJUALAN', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kode_akun`
--
ALTER TABLE `kode_akun`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kode_akun`
--
ALTER TABLE `kode_akun`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
