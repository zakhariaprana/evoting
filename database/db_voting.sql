-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2020 at 09:26 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) NOT NULL,
  `level` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`user`, `pass`, `level`) VALUES
('admin', 'admin', 'admin'),
('pengawas', 'pengawas', 'pengawas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemilih`
--

CREATE TABLE `tb_pemilih` (
  `id_pemilih` int(11) NOT NULL,
  `ktp` varchar(16) NOT NULL,
  `nama_pemilih` varchar(64) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `pass` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pemilih`
--

INSERT INTO `tb_pemilih` (`id_pemilih`, `ktp`, `nama_pemilih`, `alamat`, `pass`) VALUES
(19, '3374112110620002', 'Agus Nuliono', 'Jl Gombel Lama Siroyo no 1', 'Agus Nuliono'),
(20, '3374112104780004', 'Aris Suyono', 'Jl Gombel Lama Siroyo no 2', 'Aris Suyono'),
(21, '3374110608630001', 'Agiyan Sulistiyanto', 'Jl Gombel Lama Siroyo no 3', 'Agiyan'),
(23, '1234', 'avvvv', 'aadd', '1234'),
(24, '123456', 'q', 'e', '123456'),
(25, '1234567', 'a', 'a', '1234567');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pencalon`
--

CREATE TABLE `tb_pencalon` (
  `id_pencalon` int(11) NOT NULL,
  `kode_pencalon` varchar(16) NOT NULL,
  `nama_pencalon` varchar(64) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pencalon`
--

INSERT INTO `tb_pencalon` (`id_pencalon`, `kode_pencalon`, `nama_pencalon`, `gambar`, `keterangan`) VALUES
(9, '2', 'Budi Ruswanto', 'budi_r.jpg', '1. mengaktifkan kembali penjaga lingkungan\r\n2. mengadakan pembangunan pos jaga \r\n3. mengadakan pembangunan gedung serbaguna'),
(10, '1', 'Djanto', 'images.jpg', '1. mengadakan kegiatan kapung bersih setiap minggu ke 4\r\n2. mengusulkan adanya cctv\r\n3. mengadakan kepelatihan kerajinan untuk ibu rumah tangga dan pengangguran di lingkungan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pilih`
--

CREATE TABLE `tb_pilih` (
  `ID` int(11) NOT NULL,
  `id_pencalon` int(16) NOT NULL,
  `id_pemilih` int(16) NOT NULL,
  `tanda_terima` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pilih`
--

INSERT INTO `tb_pilih` (`ID`, `id_pencalon`, `id_pemilih`, `tanda_terima`) VALUES
(20, 10, 23, '20VHMRQTIP'),
(19, 9, 25, '19UCHABIWQ'),
(18, 9, 24, '18DNROYBAF'),
(16, 9, 21, '16MVTPJCUF'),
(15, 10, 20, '15SDWNCVMJ'),
(14, 9, 19, '14PUJGFXAD');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `tb_pemilih`
--
ALTER TABLE `tb_pemilih`
  ADD PRIMARY KEY (`id_pemilih`);

--
-- Indexes for table `tb_pencalon`
--
ALTER TABLE `tb_pencalon`
  ADD PRIMARY KEY (`id_pencalon`,`kode_pencalon`);

--
-- Indexes for table `tb_pilih`
--
ALTER TABLE `tb_pilih`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pemilih`
--
ALTER TABLE `tb_pemilih`
  MODIFY `id_pemilih` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tb_pencalon`
--
ALTER TABLE `tb_pencalon`
  MODIFY `id_pencalon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_pilih`
--
ALTER TABLE `tb_pilih`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
