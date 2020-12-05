-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 02:57 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `brand_mobil` varchar(100) NOT NULL,
  `nama_mobil` varchar(100) NOT NULL,
  `no_mobil` varchar(100) NOT NULL,
  `harga_sewa` varchar(100) NOT NULL,
  `code_sewa` varchar(10) NOT NULL,
  `harga_total` varchar(50) NOT NULL,
  `qty` int(10) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `brand_mobil`, `nama_mobil`, `no_mobil`, `harga_sewa`, `code_sewa`, `harga_total`, `qty`, `gambar`) VALUES
(25, 'Toyota', 'Avanza', 'B 4521 CI', '350000', 'a1', '350000', 1, 'avanza.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tanya_jawab` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `nama`, `email`, `tanya_jawab`) VALUES
(1, 'andi', 'andi@gmail.com', 'apakah kamu masih hidup'),
(2, 'jani', 'jani@gmail.com', 'ya');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id` int(11) NOT NULL,
  `brand_mobil` varchar(100) NOT NULL,
  `nama_mobil` varchar(100) NOT NULL,
  `no_mobil` varchar(100) NOT NULL,
  `harga_sewa` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `code_sewa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id`, `brand_mobil`, `nama_mobil`, `no_mobil`, `harga_sewa`, `status`, `gambar`, `code_sewa`) VALUES
(1, 'Toyota', 'Avanza', 'B 4521 CI', '350000', 'Tersedia', 'avanza.jpg', 'a1'),
(2, 'Honda', 'BR-V', 'B 8650 GA', '380000', 'Tersedia', 'brv.jpg', 'a2'),
(3, 'Honda', 'CR-V', 'B 4412 YA', '400000', 'Tersedia', 'crv.jpg', 'a3'),
(4, 'Toyota', 'Fortuner', 'B 6759 IU', '1200000', 'Tersedia', 'fortuner.jpg', 'a4'),
(5, 'Honda', 'Jazz', 'B 3356 RI', '350000', 'Tersedia', 'jazz.jpg', 'a5'),
(6, 'Mitsubishi', 'Xpander', 'B 8734 OV', '600000', 'Tersedia', 'xpander.jpg', 'a6');

-- --------------------------------------------------------

--
-- Table structure for table `sewa_jadi`
--

CREATE TABLE `sewa_jadi` (
  `id` int(11) NOT NULL,
  `nama_mobil` varchar(100) NOT NULL,
  `tanggal_sewa` varchar(100) NOT NULL,
  `tanggal_kembali` varchar(100) NOT NULL,
  `total_harga` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `no_ktp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sewa_jadi`
--

INSERT INTO `sewa_jadi` (`id`, `nama_mobil`, `tanggal_sewa`, `tanggal_kembali`, `total_harga`, `status`, `no_ktp`) VALUES
(2, 'Avanza(1)B 4521 CI', '2020-07-14', '2020-07-16', '350000', 'disewa', '111111111');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_ktp` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `gambar` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama_lengkap`, `alamat`, `no_ktp`, `phone`, `gambar`) VALUES
(4, 'admin', '$2y$10$Fnw.rtuMffrJgjlwPKVRPudc1dEnoyV8bOllIAy5cfV8wYZUyFtDW', 'jaha', 'Jakarta', '334528762004', '081224568887', 0x6176616e7a612e6a7067);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sewa_jadi`
--
ALTER TABLE `sewa_jadi`
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
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sewa_jadi`
--
ALTER TABLE `sewa_jadi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
