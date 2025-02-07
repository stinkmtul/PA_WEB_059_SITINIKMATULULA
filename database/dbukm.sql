-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 04:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbukm`
--

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id_permintaan` varchar(5) NOT NULL,
  `id_user` varchar(5) NOT NULL,
  `id_ukm` varchar(5) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `nim` int(15) NOT NULL,
  `alasan_bergabung` text NOT NULL,
  `foto_ektm` text NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'menunggu',
  `keterangan` text NOT NULL,
  `tgl_validasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permintaan`
--

INSERT INTO `permintaan` (`id_permintaan`, `id_user`, `id_ukm`, `nama_user`, `nim`, `alasan_bergabung`, `foto_ektm`, `tgl_permintaan`, `status`, `keterangan`, `tgl_validasi`) VALUES
('PM001', 'US004', 'UK001', 'Siti Nikmatul', 123456, 'Saya ingin mengembangkan skill saya dengan bergabung ke ukm ini', 'kartu.jpg', '2024-05-05', 'menunggu', '', '0000-00-00'),
('PM002', 'US004', 'UK003', 'Siti Nikmatul', 123456, 'Saya ingin mengembangkan skill saya dengan bergabung ke ukm ini', 'kartu.jpg', '2024-05-05', 'di terima', 'memenuhi syarat', '2024-05-05'),
('PM003', 'US004', 'UK002', 'Siti Nikmatul', 123456, 'Saya merasa cocok untuk gabung diukm ini', 'kartu.jpg', '2024-05-05', 'di tolak', 'ektm tidak valid', '2024-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `ukm`
--

CREATE TABLE `ukm` (
  `id_ukm` varchar(5) NOT NULL,
  `id_user` varchar(5) NOT NULL,
  `logo` text NOT NULL,
  `nama_ukm` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `sosialmedia` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'non-aktif',
  `jumlah_anggota` int(10) NOT NULL DEFAULT 20
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ukm`
--

INSERT INTO `ukm` (`id_ukm`, `id_user`, `logo`, `nama_ukm`, `deskripsi`, `sosialmedia`, `status`, `jumlah_anggota`) VALUES
('UK001', 'US006', 'bola.jpg', 'Futsal', 'Komunitas kami didirikan pada tahun 2016 dengan tujuan untuk menginspirasi dan mengembangkan bakat-bakat muda dalam olahraga di antara mahasiswa. Sejak awal berdiri, kami telah menjadi pusat pertemuan bagi para penggemar olahraga di kampus, menyediakan platform inklusif dan mendukung bagi para anggota dari berbagai latar belakang dan tingkat keterampilan.', 'https://www.instagram.com/', 'aktif', 20),
('UK002', 'US007', 'basket.png', 'Basket', 'Komunitas basket kami adalah wadah yang menyatukan para pecinta basket di lingkungan kampus. Didirikan dengan semangat untuk mengembangkan bakat dan minat dalam olahraga basket, kami telah menjadi pusat kegiatan yang dinamis sejak tahun 2016.', 'https://www.instagram.com/', 'aktif', 20),
('UK003', 'US008', 'voli.jpg', 'Voli', 'Komunitas kami adalah wadah yang dipersembahkan untuk para pencinta dan pemain voli di lingkungan kampus. Berdiri sejak tahun 2017, komunitas ini telah menjadi pusat kegiatan yang dinamis bagi para mahasiswa yang memiliki minat dalam olahraga voli.', 'https://www.instagram.com/', 'aktif', 21),
('UK004', 'US009', '', 'Bulu Tangkis', '', '', 'non-aktif', 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `level` varchar(15) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
('US001', 'Super Admin', 'superadmin', '123', 'superadmin'),
('US004', 'Siti Nikmatul', 'siti', '123', 'user'),
('US005', 'Syahria', 'Ria', '123', 'user'),
('US006', 'Futsal', 'futsal', '123', 'adminukm'),
('US007', 'Basket', 'basket', '123', 'adminukm'),
('US008', 'Voli', 'voli', '123', 'adminukm'),
('US009', 'Bulu Tangkis', 'bultang', '123', 'adminukm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indexes for table `ukm`
--
ALTER TABLE `ukm`
  ADD PRIMARY KEY (`id_ukm`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
