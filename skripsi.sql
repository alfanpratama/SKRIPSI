-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2021 at 12:40 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` varchar(6) NOT NULL,
  `nama_brg` varchar(30) NOT NULL,
  `id_kategori` varchar(10) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `kode_produk` varchar(30) NOT NULL,
  `spesifikasi` text NOT NULL,
  `harga_beli` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `nama_sup` varchar(30) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_brg`, `id_kategori`, `satuan`, `kode_produk`, `spesifikasi`, `harga_beli`, `jumlah`, `nama_sup`) VALUES
('BRG001', 'Printer', 'PT ELOKARS', 'Unit', '010111011011', 'EPSON 0111', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `cek_status`
--

CREATE TABLE IF NOT EXISTS `cek_status` (
  `id` varchar(6) NOT NULL,
  `no_surat` varchar(15) NOT NULL,
  `id_divisi` varchar(6) NOT NULL,
  `id_user` varchar(6) NOT NULL,
  `bauk` varchar(20) NOT NULL,
  `ketua` varchar(20) NOT NULL,
  `yayasan` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cek_status`
--

INSERT INTO `cek_status` (`id`, `no_surat`, `id_divisi`, `id_user`, `bauk`, `ketua`, `yayasan`) VALUES
('001', 'AA111', 'D01', 'USR003', '1', '1', '1'),
('002', 'AA112', 'D02', 'USR002', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE IF NOT EXISTS `detail_pesanan` (
  `no_surat` varchar(30) NOT NULL,
  `id_barang` varchar(6) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `spesifikasi` text NOT NULL,
  `qty` int(5) NOT NULL,
  `harga_jual` double NOT NULL,
  `diskon` double NOT NULL,
  `subtotal` double NOT NULL,
  `ppn` double NOT NULL,
  `status_barang` varchar(30) NOT NULL,
  `id_user` varchar(6) NOT NULL,
  `acc` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`no_surat`, `id_barang`, `nama_barang`, `spesifikasi`, `qty`, `harga_jual`, `diskon`, `subtotal`, `ppn`, `status_barang`, `id_user`, `acc`) VALUES
('001/SP-ABS/HA/XI/2018', 'BRG001', 'Timbangan Analitik', '0', 8, 1000000, 0, 8000000, 800000, 'Ready', 'USR003', 'N'),
('001/SP-ABS/HA/XI/2018', 'BRG003', 'Kalibrasi', '0', 3, 800000, 0, 2400000, 240000, 'Ready', 'USR003', 'N'),
('002/SP-ABS/IM/XI/2018', 'BRG001', 'Timbangan Analitik', '0', 8, 1000000, 0, 8000000, 800000, 'Ready', 'USR005', 'N'),
('003/SP-ABS/IM/XI/2018', 'BRG001', 'Timbangan Analitik', '0', 8, 1000000, 0, 8000000, 800000, 'Ready', 'USR003', 'N'),
('004/SP-ABS/IM/XI/2018', 'BRG002', 'centrifuge', '0', 1, 700000, 0, 700000, 70000, 'Ready', 'USR003', 'Y'),
('005/SP-ABS/IM/XI/2018', 'BRG001', 'Timbangan Analitik', '0', 8, 1000000, 0, 8000000, 800000, 'Ready', 'USR003', 'N'),
('006/SP-ABS/IM/XI/2018', 'BRG007', 'TIMBANGAN ANALITIK', '0', 10, 1500000, 0, 15000000, 1500000, 'Ready', 'USR003', 'Y'),
('007/SP-ABS/IM/XII/2018', 'BRG007', 'TIMBANGAN ANALITIK', 'ALAT LABORATORIUM', 1, 1500000, 0, 1500000, 150000, 'Ready', 'USR003', 'Y'),
('008/SP-ABS/IM/XII/2018', 'BRG003', 'Kalibrasi', 'Jasa Kalibrasi', 1, 800000, 0, 800000, 80000, 'Ready', 'USR003', 'Y'),
('008/SP-ABS/AN/XII/2018', 'BRG002', 'centrifuge', 'Alat laboratorium', 4, 700000, 0, 2800000, 280000, 'Ready', 'USR001', 'Y'),
('009/SP-ABS/IM/XII/2018', 'BRG003', 'Kalibrasi', 'Jasa Kalibrasi', 3, 800000, 0, 2400000, 240000, 'Indent', 'USR003', 'Y'),
('009/SP-ABS/IM/XII/2018', 'BRG007', 'TIMBANGAN ANALITIK', 'ALAT LABORATORIUM', 4, 1500000, 0, 6000000, 600000, 'Ready', 'USR003', 'Y'),
('010/SP-ABS/IM/XII/2018', 'BRG007', 'TIMBANGAN ANALITIK', 'ALAT LABORATORIUM', 2, 1500000, 0, 3000000, 300000, 'Indent', 'USR003', 'Y'),
('010/SP-ABS/IM/XII/2018', 'BRG003', 'Kalibrasi', 'Jasa Kalibrasi', 2, 800000, 0, 1600000, 160000, 'Ready', 'USR003', 'Y'),
('011/SP-ABS/AN/XII/2018', 'BRG001', 'Timbangan Analitik', 'Alat laboratorium', 2, 1000000, 0, 4000000, 400000, 'Ready', 'USR001', 'N'),
('012/SP-ABS/IM/XII/2018', 'BRG002', 'centrifuge', 'Alat laboratorium', 5, 700000, 5000, 3495000, 349500, 'Ready', 'USR003', 'Y'),
('013/SP-ABS/IM/XII/2020', 'BRG004', 'OHAUS TYPE ST350', 'ALAT LABORATORIUM', 12, 6500000, 0, 78000000, 7800000, 'Ready', 'USR003', 'Y'),
('013/SP-ABS/IM/XII/2020', 'BRG003', 'Kalibrasi', 'Jasa Kalibrasi', 21, 800000, 0, 16800000, 1680000, 'Ready', 'USR003', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE IF NOT EXISTS `divisi` (
  `id_divisi` varchar(5) NOT NULL,
  `nama_divisi` varchar(20) NOT NULL,
  `kepala_divisi` varchar(30) NOT NULL,
  `telp` int(14) NOT NULL,
  `email` varchar(30) NOT NULL,
  `id_user` varchar(6) NOT NULL,
  PRIMARY KEY (`id_divisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE IF NOT EXISTS `kategori_barang` (
  `id_kategori` varchar(6) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori`, `nama_kategori`) VALUES
('KTG005', 'Elektronik'),
('KTG006', 'Mebeler'),
('KTG007', 'Rumah Tangga (Bulanan)'),
('KTG008', 'ATK'),
('KTG009', 'Umum'),
('KTG010', 'Kendaraan');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` varchar(20) NOT NULL,
  `nama_pel` varchar(50) NOT NULL,
  `telp` varchar(18) NOT NULL,
  `alamat` text NOT NULL,
  `cp` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_user` varchar(6) NOT NULL,
  `user` varchar(20) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE IF NOT EXISTS `pengajuan` (
  `no_surat` varchar(15) NOT NULL,
  `id_divisi` varchar(5) NOT NULL,
  `nama_divisi` varchar(30) NOT NULL,
  `nama_pemohon` varchar(30) NOT NULL,
  `telp` int(14) NOT NULL,
  `email` varchar(20) NOT NULL,
  `id_user` varchar(5) NOT NULL,
  `id_barang` varchar(6) NOT NULL,
  `nama_brg` varchar(30) NOT NULL,
  `jml_barang` int(5) NOT NULL,
  `est_harga` varchar(15) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  PRIMARY KEY (`no_surat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE IF NOT EXISTS `pesanan` (
  `no_surat` varchar(30) NOT NULL,
  `id_pelanggan` varchar(6) NOT NULL,
  `tgl_prospek` date NOT NULL,
  `id_user` varchar(6) NOT NULL,
  PRIMARY KEY (`no_surat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`no_surat`, `id_pelanggan`, `tgl_prospek`, `id_user`) VALUES
('001/SP-ABS/HA/XI/2018', 'PEL001', '2018-11-18', 'USR003'),
('002/SP-ABS/IM/XI/2018', 'PEL004', '2018-11-07', 'USR005'),
('003/SP-ABS/IM/XI/2018', 'PEL003', '2018-11-22', 'USR003'),
('004/SP-ABS/IM/XI/2018', 'PEL002', '2018-11-22', 'USR003'),
('005/SP-ABS/IM/XI/2018', 'PEL004', '2018-11-17', 'USR003'),
('006/SP-ABS/IM/XI/2018', 'PEL003', '2018-11-24', 'USR003'),
('007/SP-ABS/IM/XII/2018', 'PEL003', '2018-12-12', 'USR003'),
('008/SP-ABS/AN/XII/2018', 'PEL003', '2018-12-21', 'USR001'),
('009/SP-ABS/IM/XII/2018', 'PEL007', '2018-10-05', 'USR003'),
('010/SP-ABS/IM/XII/2018', 'PEL001', '2018-09-01', 'USR003'),
('011/SP-ABS/AN/XII/2018', 'PEL003', '2018-12-22', 'USR001'),
('012/SP-ABS/IM/XII/2018', 'PEL003', '2018-12-14', 'USR003'),
('013/SP-ABS/IM/XII/2020', 'PEL008', '2020-12-12', 'USR003');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_tmp`
--

CREATE TABLE IF NOT EXISTS `pesanan_tmp` (
  `no_surat` varchar(30) NOT NULL,
  `id_barang` varchar(6) NOT NULL,
  `nama_brg` varchar(30) NOT NULL,
  `spesifikasi` text NOT NULL,
  `qty` int(5) NOT NULL,
  `harga_jual` double NOT NULL,
  `diskon` double NOT NULL,
  `subtotal` double NOT NULL,
  `ppn` double NOT NULL,
  `jumlah` int(5) NOT NULL,
  `status_barang` varchar(30) NOT NULL,
  `id_user` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_tmp`
--

INSERT INTO `pesanan_tmp` (`no_surat`, `id_barang`, `nama_brg`, `spesifikasi`, `qty`, `harga_jual`, `diskon`, `subtotal`, `ppn`, `jumlah`, `status_barang`, `id_user`) VALUES
('014/SP-ABS/AD/VI/2021', 'BRG001', 'Printer', 'EPSON 0111', 11111, 12121212, 11, 134678786521, 12, 0, 'Ready', 'USR008');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `id_stok` varchar(6) NOT NULL,
  `id_barang` varchar(7) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` varchar(20) NOT NULL,
  `nama_sup` varchar(50) NOT NULL,
  `telp` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `cp` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_sup`, `telp`, `alamat`, `cp`, `email`) VALUES
('SUP001', 'PT INTRALAB EKATAMA', '+6221765888', 'Jl. Sunter No. 72 , Jakarta Utara', 'Ibu Yeti', 'yeti@intralab.com'),
('SUP002', 'PT ALFASCALE INDONESIA', '+62', 'RUKAN SUNTER PERMAI INDAH', 'IBU YETI', 'yeti.intralab@gmail.com'),
('SUP003', 'CMSI', '+62', 'JAKARTA TIMUR', 'IBU EMI', 'emi.cmsi@gmail.com'),
('SUP004', 'PT ELOKARSA', '+62', 'JAKARTA PUSAT', 'YENI', 'elokarsa@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` varchar(10) NOT NULL,
  `user` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `level` enum('admin','pimpinan','prodi','puskom','yayasan','kemahasiswaan') NOT NULL,
  `blokir` enum('N','Y') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `user`, `pass`, `nama`, `no_hp`, `level`, `blokir`) VALUES
('USR001', 'Andri', 'Andri', 'Andri', '081224923354', 'prodi', 'N'),
('USR003', 'imankadar', 'amoebabio', 'Iman Kadarisman', '081529373782', 'pimpinan', 'N'),
('USR004', 'Ramirez', 'Ramirez', 'Ramirez', '+6281365580887', '', 'N'),
('USR005', 'mulyana', 'mulyana', 'Mulyana', '+6284597685', '', 'N'),
('USR006', 'reza', 'reza', 'Reza', '08135890999', '', 'N'),
('USR007', 'pimpinan', 'mardira', 'pimpinan', '0865125735631', 'pimpinan', 'N'),
('USR008', 'admin', 'admin', 'admin', '089123445667', 'admin', 'N');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
