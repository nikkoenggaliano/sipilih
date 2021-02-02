-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2021 at 10:23 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipilih`
--

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE `kandidat` (
  `id` int(11) NOT NULL,
  `no_urut` int(11) NOT NULL,
  `nama` text NOT NULL,
  `foto` text NOT NULL,
  `visi` text,
  `misi` text,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`id`, `no_urut`, `nama`, `foto`, `visi`, `misi`, `active`) VALUES
(1, 1, 'Im Nayeon', 'https://pm1.narvii.com/6848/ac6b3a865a25072a1a392d5551caa821ef805b74v2_hq.jpg', NULL, NULL, 1),
(2, 2, 'Kwon Eunbi', 'https://cdn.idntimes.com/content-images/community/2019/08/332113715021aa2e0bd4c2283673ae29-7a6662b616c0bf74c693cf11cf88eeef.jpg', NULL, NULL, 1),
(3, 3, 'Bae Joohyun', 'https://data.whicdn.com/images/317953767/original.jpg', NULL, NULL, 1),
(4, 4, 'Im Nayeon', 'https://pm1.narvii.com/6848/ac6b3a865a25072a1a392d5551caa821ef805b74v2_hq.jpg', NULL, NULL, 1),
(5, 5, 'Im Nayeon', 'https://cdn.idntimes.com/content-images/community/2019/08/332113715021aa2e0bd4c2283673ae29-7a6662b616c0bf74c693cf11cf88eeef.jpg', NULL, NULL, 1),
(6, 6, 'Im Nayeon', 'https://pm1.narvii.com/6848/ac6b3a865a25072a1a392d5551caa821ef805b74v2_hq.jpg', NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kandidat`
--
ALTER TABLE `kandidat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
