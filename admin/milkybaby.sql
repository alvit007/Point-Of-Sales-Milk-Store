-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2023 at 03:18 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milkybaby`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `password`, `position`) VALUES
(11113, 'admin', 'Admin', 'admin', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pembelian`
--

CREATE TABLE `riwayat_pembelian` (
  `id_riwayat` int(11) NOT NULL,
  `invoice` int(11) NOT NULL,
  `id_pelanggan_riwayat` int(11) NOT NULL,
  `nama_pelanggan` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `table_barang`
--

CREATE TABLE `table_barang` (
  `id_barang` int(11) NOT NULL,
  `merk_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `gambar_barang` varchar(250) NOT NULL,
  `sasaran_barang` varchar(50) NOT NULL,
  `harga_barang` varchar(11) NOT NULL,
  `hargamodal_barang` varchar(11) NOT NULL,
  `profit` varchar(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_terjual` int(11) NOT NULL,
  `tanggal_expire` date NOT NULL,
  `tanggal_datang` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_barang`
--

INSERT INTO `table_barang` (`id_barang`, `merk_barang`, `nama_barang`, `gambar_barang`, `sasaran_barang`, `harga_barang`, `hargamodal_barang`, `profit`, `qty`, `qty_terjual`, `tanggal_expire`, `tanggal_datang`) VALUES
(1, 'Nestle Lactogen', 'Lactogen 1 700g', 'pngwing.com (3).png', '', '140000', '132000', '8000', 20, 40, '2023-08-01', '2023-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `table_keranjang`
--

CREATE TABLE `table_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `no_barang` int(11) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `subtotal_harga` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `table_pelanggan`
--

CREATE TABLE `table_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jk` enum('Pria','Wanita') NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_pelanggan`
--

INSERT INTO `table_pelanggan` (`id_pelanggan`, `nama`, `email`, `jk`, `no_hp`, `alamat`, `password`) VALUES
(2, 'Muhammad Hafizh Ihsan', 'hafizh@gmail.com', 'Pria', '089512472514', 'Dukuh Zamrud Blok I 22/32', '$2y$10$w4BxDHn..LdrLa2Gdu8UkeUIDCqX4f6SBuuvRRs.1yodmynX4LMwW');

-- --------------------------------------------------------

--
-- Table structure for table `table_pembelian`
--

CREATE TABLE `table_pembelian` (
  `invoice` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_pembelian`
--
ALTER TABLE `riwayat_pembelian`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indexes for table `table_barang`
--
ALTER TABLE `table_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `table_keranjang`
--
ALTER TABLE `table_keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `table_pelanggan`
--
ALTER TABLE `table_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `table_pembelian`
--
ALTER TABLE `table_pembelian`
  ADD PRIMARY KEY (`invoice`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11114;

--
-- AUTO_INCREMENT for table `table_barang`
--
ALTER TABLE `table_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_pelanggan`
--
ALTER TABLE `table_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
