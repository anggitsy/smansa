-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2018 at 01:44 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smansa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_peminjam`
--

CREATE TABLE `tb_peminjam` (
  `id_peminjam` int(5) NOT NULL,
  `nis` varchar(8) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `jenis_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_peminjam`
--

INSERT INTO `tb_peminjam` (`id_peminjam`, `nis`, `nama`, `email`, `password`, `status`, `jenis_user`) VALUES
(21, '12345678', 'Anggit Maghfirani', 'anggitssy@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 'Aktif', 'Siswa'),
(22, '11111111', 'Mega Chandra', 'megasubektii0301@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 'Aktif', 'Pengelola'),
(23, '12341234', 'Pungki Purnawan', 'pungkiepurnawan@yahoo.com', 'a8f5f167f44f4964e6c998dee827110c', 'Aktif', 'Siswa');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id_peminjaman` int(5) NOT NULL,
  `kondisi_kembali` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` tinyint(5) NOT NULL,
  `jam` time NOT NULL,
  `status` varchar(50) NOT NULL,
  `durasi` tinyint(4) NOT NULL,
  `id_prasarana` int(5) NOT NULL,
  `id_peminjam` int(5) NOT NULL,
  `kondisi_pinjam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id_peminjaman`, `kondisi_kembali`, `tanggal`, `jumlah`, `jam`, `status`, `durasi`, `id_prasarana`, `id_peminjam`, `kondisi_pinjam`) VALUES
(1, '', '2018-09-19', 1, '09:00:00', 'Menunggu Konfirmasi', 2, 1, 21, 'Baik');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengembalian`
--

CREATE TABLE `tb_pengembalian` (
  `id_pengembalian` int(5) NOT NULL,
  `tanggal_pengembalian` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL,
  `id_peminjaman` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_prasarana`
--

CREATE TABLE `tb_prasarana` (
  `id_prasarana` int(5) NOT NULL,
  `nama_prasarana` varchar(100) NOT NULL,
  `stok` tinyint(5) NOT NULL,
  `status` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `jenis_sarana` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_prasarana`
--

INSERT INTO `tb_prasarana` (`id_prasarana`, `nama_prasarana`, `stok`, `status`, `foto`, `jenis_sarana`) VALUES
(1, 'Bola Basket', 5, 'Baik', '', 'Prasarana');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_peminjam`
--
ALTER TABLE `tb_peminjam`
  ADD PRIMARY KEY (`id_peminjam`);

--
-- Indexes for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_peminjam` (`id_peminjam`),
  ADD KEY `id_prasarana` (`id_prasarana`);

--
-- Indexes for table `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_peminjam` (`id_peminjaman`);

--
-- Indexes for table `tb_prasarana`
--
ALTER TABLE `tb_prasarana`
  ADD PRIMARY KEY (`id_prasarana`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_peminjam`
--
ALTER TABLE `tb_peminjam`
  MODIFY `id_peminjam` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id_peminjaman` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  MODIFY `id_pengembalian` int(5) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD CONSTRAINT `tb_peminjaman_ibfk_1` FOREIGN KEY (`id_peminjam`) REFERENCES `tb_peminjam` (`id_peminjam`),
  ADD CONSTRAINT `tb_peminjaman_ibfk_2` FOREIGN KEY (`id_prasarana`) REFERENCES `tb_prasarana` (`id_prasarana`);

--
-- Constraints for table `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD CONSTRAINT `tb_pengembalian_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `tb_peminjaman` (`id_peminjaman`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
