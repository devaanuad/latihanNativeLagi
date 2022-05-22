-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2022 at 07:08 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiara_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_detail_transaksi`
--

CREATE TABLE `t_detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `id_menu` int(50) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `sub_total` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_detail_transaksi`
--

INSERT INTO `t_detail_transaksi` (`id`, `id_transaksi`, `id_menu`, `jumlah`, `harga`, `sub_total`) VALUES
(1, 'TRS20220521001', 5, 1, 5000, 5000),
(2, 'TRS20220521001', 4, 2, 5000, 10000),
(3, 'TRS20220521001', 3, 5, 2000, 10000),
(4, 'TRS20220521002', 5, 2, 5000, 10000),
(5, 'TRS20220521002', 4, 2, 5000, 10000),
(6, 'TRS20220521003', 3, 2, 2000, 4000),
(7, 'TRS20220521003', 2, 2, 6000, 12000),
(8, 'TRS20220521004', 5, 2, 6000, 12000),
(9, 'TRS20220521004', 7, 2, 5000, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `t_meja`
--

CREATE TABLE `t_meja` (
  `id_meja` int(11) NOT NULL,
  `no_meja` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_meja`
--

INSERT INTO `t_meja` (`id_meja`, `no_meja`, `keterangan`, `status`) VALUES
(1, 'Meja 1', 'VIP 2 0rang', 'terisi'),
(2, 'Meja 2', 'VIP 3 orang', 'kosong'),
(3, 'Meja 3', 'Regular 3 orang', 'terisi'),
(4, 'meja 4', 'Regular 2 orang', 'terisi'),
(5, 'Meja 5', 'VIP 4 orang', 'terisi'),
(6, 'meja 6', 'VIP 2 orang', 'kosong'),
(7, 'meja 7', 'untuk 2 orang', 'kosong');

-- --------------------------------------------------------

--
-- Table structure for table `t_menu`
--

CREATE TABLE `t_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_menu`
--

INSERT INTO `t_menu` (`id_menu`, `nama_menu`, `deskripsi`, `harga`, `kategori`) VALUES
(2, 'Fresh Tea', 'minuman ini terbuat dari tea segar alami 12', '6000', 'minuman'),
(4, 'Thai Tee', 'minuman susu dengan campuran teh alami', '5000', 'minuman'),
(5, 'Capucino Cincaw', 'cincaw alami dan segar perpaduan dengan kopi capucino', '6000', 'minuman'),
(6, 'Cireng Keju', 'cireng gurih dengan isi keju craft', '3000', 'makanan'),
(7, 'Mi ayam', 'pedas', '5000', 'makanan'),
(8, 'Soto Ayam', 'Soto ayam asli madura', '10000', 'makanan');

-- --------------------------------------------------------

--
-- Table structure for table `t_transaksi`
--

CREATE TABLE `t_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `id_meja` int(50) NOT NULL,
  `id_user` int(50) NOT NULL,
  `total_bayar` int(50) NOT NULL,
  `jumlah_bayar` int(50) NOT NULL,
  `tanggal_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_transaksi`
--

INSERT INTO `t_transaksi` (`id`, `id_transaksi`, `id_meja`, `id_user`, `total_bayar`, `jumlah_bayar`, `tanggal_transaksi`) VALUES
(1, 'TRS20220521001', 5, 8, 25000, 26000, '2022-05-21'),
(2, 'TRS20220521002', 4, 8, 20000, 25000, '2022-05-21'),
(3, 'TRS20220521003', 3, 8, 16000, 20000, '2022-05-21'),
(4, 'TRS20220521004', 1, 8, 22000, 50000, '2022-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hak_akses` enum('manager','admin','kasir','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id_user`, `nama_user`, `password`, `hak_akses`) VALUES
(1, 'manager', '123', 'manager'),
(2, 'Admin', '123', 'admin'),
(8, 'kasir', '123', 'kasir'),
(9, 'tiara', '123', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_detail_transaksi`
--
ALTER TABLE `t_detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_meja`
--
ALTER TABLE `t_meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `t_menu`
--
ALTER TABLE `t_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `t_transaksi`
--
ALTER TABLE `t_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_detail_transaksi`
--
ALTER TABLE `t_detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_meja`
--
ALTER TABLE `t_meja`
  MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_menu`
--
ALTER TABLE `t_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_transaksi`
--
ALTER TABLE `t_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
