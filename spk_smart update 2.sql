-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2021 at 08:27 PM
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
-- Table structure for table `smart_admin`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(80) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smart_admin`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
(1, 'Administrasi', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'Penilai', 'userpenilai', 'ee11cbb19052e40b07aac0ca060c23ee', 'penilai'),
(3, 'Penilai2', 'penilai', 'e10adc3949ba59abbe56e057f20f883e', 'penilai'),
(4, 'Penilai3', 'penilai3', 'a2343deed565b1ffad7238bf72387886', 'penilai');

-- --------------------------------------------------------

--
-- Table structure for table `smart_alternatif`
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
-- Dumping data for table `smart_alternatif`
--

-- --------------------------------------------------------

--
-- Table structure for table `smart_alternatif_kriteria`
--

CREATE TABLE `penilaian` (
  `id_pegawai` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_kriteria` int(11) DEFAULT NULL,
  `nilai_alternatif_kriteria` double NOT NULL,
  `bobot_alternatif_kriteria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smart_alternatif_kriteria`
--

-- --------------------------------------------------------

--
-- Table structure for table `smart_kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(45) NOT NULL,
  `nama_kriteria` varchar(45) NOT NULL,
  `bobot_kriteria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smart_kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `bobot_kriteria`) VALUES
(1, 'K1', 'Kedisiplinan', 0.15),
(2, 'K2', 'Kehadiran', 0.2),
(3, 'K3', 'Tanggung Jawab', 0.15),
(4, 'K4', 'Kerjasama', 0.13),
(5, 'K5', 'Komunikasi', 0.13),
(6, 'K6', 'Penampilan', 0.12),
(7, 'K7', 'Inisiatif', 0.12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `smart_admin`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `smart_alternatif`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `smart_alternatif_kriteria`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_pegawai`,`id_kriteria`);

--
-- Indexes for table `smart_kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `smart_admin`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `smart_alternatif`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `smart_kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
