-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 04:54 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `tag_pegawai` int(11) DEFAULT NULL,
  `nama_pegawai` varchar(45) NOT NULL,
  `jabatan` varchar(150) DEFAULT NULL,
  `bagian` varchar(150) DEFAULT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') DEFAULT NULL,
  `status` enum('AKTIF','TIDAK AKTIF') DEFAULT 'AKTIF',
  `nilai_utility` double NOT NULL,
  `hasil_alternatif` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `tag_pegawai`, `nama_pegawai`, `jabatan`, `bagian`, `jenis_kelamin`, `status`, `nilai_utility`, `hasil_alternatif`) VALUES
(5, 1233, 'Bang Jago', 'Staff', 'Umum', 'laki-laki', 'AKTIF', 0, 0.8768750000000001),
(7, 45677, 'Dadang', 'Staff', 'Umum', 'laki-laki', 'AKTIF', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_pegawai` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_kriteria` int(11) DEFAULT NULL,
  `nilai_alternatif_kriteria` double NOT NULL,
  `bobot_alternatif_kriteria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_pegawai`, `id_kriteria`, `nilai_kriteria`, `nilai_alternatif_kriteria`, `bobot_alternatif_kriteria`) VALUES
(5, 1, 80, 0.75, 0.1125),
(5, 2, 88, 0.85, 0.17),
(5, 3, 90, 0.875, 0.13125),
(5, 4, 98, 0.975, 0.12675),
(5, 5, 95, 0.9375, 0.121875),
(5, 6, 92, 0.9, 0.108),
(5, 7, 91, 0.8875, 0.1065);

-- --------------------------------------------------------

--
-- Table structure for table `smart_kriteria`
--

CREATE TABLE `smart_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(45) NOT NULL,
  `nama_kriteria` varchar(45) NOT NULL,
  `bobot_kriteria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smart_kriteria`
--

INSERT INTO `smart_kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `bobot_kriteria`) VALUES
(1, 'K1', 'Kedisiplinan', 0.15),
(2, 'K2', 'Kehadiran', 0.2),
(3, 'K3', 'Tanggung Jawab', 0.15),
(4, 'K4', 'Kerjasama', 0.13),
(5, 'K5', 'Komunikasi', 0.13),
(6, 'K6', 'Penampilan', 0.12),
(7, 'K7', 'Inisiatif', 0.12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(80) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
(1, 'Administrasi', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'Penilai', 'userpenilai', 'ee11cbb19052e40b07aac0ca060c23ee', 'penilai'),
(3, 'Penilai2', 'penilai', 'e10adc3949ba59abbe56e057f20f883e', 'penilai'),
(4, 'Penilai3', 'penilai3', 'a2343deed565b1ffad7238bf72387886', 'penilai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_pegawai`,`id_kriteria`);

--
-- Indexes for table `smart_kriteria`
--
ALTER TABLE `smart_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `smart_kriteria`
--
ALTER TABLE `smart_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
