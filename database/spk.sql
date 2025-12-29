-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2025 at 05:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `judul_lagu` varchar(150) NOT NULL,
  `artis` varchar(100) NOT NULL,
  `lirik` text DEFAULT NULL,
  `c1_tempo` double NOT NULL,
  `c2_loudness` double NOT NULL,
  `c3_energy` double NOT NULL,
  `c4_valence` double NOT NULL,
  `c5_mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `judul_lagu`, `artis`, `lirik`, `c1_tempo`, `c2_loudness`, `c3_energy`, `c4_valence`, `c5_mode`) VALUES
(6, 'Surat Cinta', 'Vina Panduwinata', NULL, 120, -5.5, 0.85, 0.92, 1),
(7, 'Ya Sudahlah', 'Bondan Prakoso', NULL, 140, -4.2, 0.9, 0.88, 1),
(8, 'Hampa', 'Ari Lasso', NULL, 75, -10, 0.3, 0.25, 0),
(9, 'Beraksi', 'Kotak', '', 165, -3.5, 0.95, 0.7, 1),
(10, 'Laskar Pelangi', 'Nidji', NULL, 130, -6.2, 0.88, 0.85, 1),
(11, 'Manusia Bodoh', 'Ada Band', NULL, 82, -9.5, 0.45, 0.3, 0),
(12, 'Risalah Hati', 'Dewa 19', NULL, 115, -7.8, 0.65, 0.55, 0),
(13, 'Melompat Lebih Tinggi', 'Sheila on 7', NULL, 155, -4.8, 0.92, 0.9, 1),
(14, 'Monokrom', 'Tulus', NULL, 100, -8.5, 0.5, 0.6, 1),
(15, 'Separuh Aku', 'Noah', NULL, 110, -6.5, 0.75, 0.4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `id_bobot` int(11) NOT NULL,
  `nama_emosi` varchar(20) NOT NULL,
  `w1` double NOT NULL,
  `w2` double NOT NULL,
  `w3` double NOT NULL,
  `w4` double NOT NULL,
  `w5` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `nama_emosi`, `w1`, `w2`, `w3`, `w4`, `w5`) VALUES
(1, 'Happy', 0.25, 0.2, 0.2, 0.3, 0.05),
(2, 'Sad', 0.1, 0.1, 0.15, 0.45, 0.2),
(3, 'Relax', 0.1, 0.15, 0.1, 0.35, 0.3),
(4, 'Energetic', 0.35, 0.3, 0.3, 0.1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(5) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `sifat` enum('Benefit','Cost') DEFAULT 'Benefit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `sifat`) VALUES
(1, 'C1', 'Tempo', 'Benefit'),
(2, 'C2', 'Loudness', 'Benefit'),
(3, 'C3', 'Energy', 'Benefit'),
(4, 'C4', 'Valence', 'Benefit'),
(5, 'C5', 'Mode', 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `normalisasi`
--

CREATE TABLE `normalisasi` (
  `id_normalisasi` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `r1` double NOT NULL,
  `r2` double NOT NULL,
  `r3` double NOT NULL,
  `r4` double NOT NULL,
  `r5` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `normalisasi`
--

INSERT INTO `normalisasi` (`id_normalisasi`, `id_alternatif`, `r1`, `r2`, `r3`, `r4`, `r5`) VALUES
(0, 6, 0.72727272727273, -5.5, 0.89473684210526, 1, 1),
(0, 7, 0.84848484848485, -4.2, 0.94736842105263, 0.95652173913043, 1),
(0, 8, 0.45454545454545, -10, 0.31578947368421, 0.27173913043478, 0),
(0, 9, 1, -3.5, 1, 0.76086956521739, 1),
(0, 10, 0.78787878787879, -6.2, 0.92631578947368, 0.92391304347826, 1),
(0, 11, 0.4969696969697, -9.5, 0.47368421052632, 0.32608695652174, 0),
(0, 12, 0.6969696969697, -7.8, 0.68421052631579, 0.59782608695652, 0),
(0, 13, 0.93939393939394, -4.8, 0.96842105263158, 0.97826086956522, 1),
(0, 14, 0.60606060606061, -8.5, 0.52631578947368, 0.65217391304348, 1),
(0, 15, 0.66666666666667, -6.5, 0.78947368421053, 0.43478260869565, 0);

-- --------------------------------------------------------

--
-- Table structure for table `perangkingan`
--

CREATE TABLE `perangkingan` (
  `id_ranking` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `nama_emosi` varchar(20) NOT NULL,
  `nilai_akhir` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perangkingan`
--

INSERT INTO `perangkingan` (`id_ranking`, `id_alternatif`, `nama_emosi`, `nilai_akhir`) VALUES
(0, 6, 'Happy', -0.38923444976077),
(0, 7, 'Happy', -0.10144858192913),
(0, 8, 'Happy', -1.7416840024964),
(0, 9, 'Happy', 0.028260869565217),
(0, 10, 'Happy', -0.53059323209209),
(0, 11, 'Happy', -1.5831946466958),
(0, 12, 'Happy', -1.0695676444075),
(0, 13, 'Happy', -0.18798904375563),
(0, 14, 'Happy', -1.1975695166771),
(0, 15, 'Happy', -0.84500381388253);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id_bobot`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
