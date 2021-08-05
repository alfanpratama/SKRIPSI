-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2018 at 08:13 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cobadesi`
--

-- --------------------------------------------------------

--
-- Table structure for table `eci`
--

CREATE TABLE `eci` (
  `NIM` varchar(10) NOT NULL,
  `NAMA` varchar(30) NOT NULL,
  `ALAMAT` varchar(100) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `tempat` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `hobi` varchar(20) NOT NULL,
  `agama` varchar(11) NOT NULL,
  `pendidikan` varchar(11) NOT NULL,
  `telp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eci`
--

INSERT INTO `eci` (`NIM`, `NAMA`, `ALAMAT`, `hp`, `tempat`, `tanggal`, `hobi`, `agama`, `pendidikan`, `telp`) VALUES
('14', 'Desi Mega Utari', 'Jalan - Jalan', '08764674646', 'bandung', '2018-12-08', 'makan', 'islam', 'S Teler', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eci`
--
ALTER TABLE `eci`
  ADD PRIMARY KEY (`NIM`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
