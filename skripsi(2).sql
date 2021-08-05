-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2021 at 06:01 AM
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
  `id_kategori` varchar(6) NOT NULL,
  `harga` int(20) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `spesifikasi` varchar(30) NOT NULL,
  `id_supplier` varchar(6) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_brg`, `id_kategori`, `harga`, `satuan`, `spesifikasi`, `id_supplier`) VALUES
('BRG001', 'Printer Epson 1111', 'Elektr', 0, 'Unit', 'Print', ' '),
('BRG003', 'Laptop Lenovo', 'Elektr', 5000000, 'Unit', 'Thinkpad x250', ' '),
('BRG006', 'Lemari Rak', 'Mebele', 2000000, 'Unit', 'Rak Kayu', 'CMSI'),
('BRG007', 'Meja Dosen', 'Elektr', 0, 'Unit', 'Meja Kayu', '');

-- --------------------------------------------------------

--
-- Table structure for table `brg_keluar`
--

CREATE TABLE IF NOT EXISTS `brg_keluar` (
  `id_brg_keluar` varchar(8) NOT NULL,
  `no_surat_pengajuan` varchar(27) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `id_user` varchar(6) NOT NULL,
  `id_divisi` varchar(6) NOT NULL,
  `jml_brg` int(5) NOT NULL,
  PRIMARY KEY (`id_brg_keluar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brg_keluar`
--

INSERT INTO `brg_keluar` (`id_brg_keluar`, `no_surat_pengajuan`, `tgl_keluar`, `id_user`, `id_divisi`, `jml_brg`) VALUES
('BK000001', '001.SPn/KHMS/1/VIII/2021', '2021-07-01', 'USR001', 'DIV001', 18);

-- --------------------------------------------------------

--
-- Table structure for table `brg_masuk`
--

CREATE TABLE IF NOT EXISTS `brg_masuk` (
  `id_brg_masuk` varchar(8) NOT NULL,
  `no_surat_pengadaan` varchar(27) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `id_supplier` varchar(6) NOT NULL,
  `jml_brg` int(5) NOT NULL,
  PRIMARY KEY (`id_brg_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brg_masuk`
--

INSERT INTO `brg_masuk` (`id_brg_masuk`, `no_surat_pengadaan`, `tgl_masuk`, `id_supplier`, `jml_brg`) VALUES
('BM000001', '001.SPPn/BAUK/2/VIII/2021', '2021-08-02', 'SUP003', 22);

-- --------------------------------------------------------

--
-- Table structure for table `detail_brg_keluar`
--

CREATE TABLE IF NOT EXISTS `detail_brg_keluar` (
  `id_detail_keluar` int(10) NOT NULL AUTO_INCREMENT,
  `id_brg_keluar` varchar(8) NOT NULL,
  `id_barang` varchar(6) NOT NULL,
  `jml_brg` int(5) NOT NULL,
  PRIMARY KEY (`id_detail_keluar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `detail_brg_keluar`
--

INSERT INTO `detail_brg_keluar` (`id_detail_keluar`, `id_brg_keluar`, `id_barang`, `jml_brg`) VALUES
(1, 'BK000001', 'BRG001', 6),
(2, 'BK000001', 'BRG002', 4);

-- --------------------------------------------------------

--
-- Table structure for table `detail_brg_masuk`
--

CREATE TABLE IF NOT EXISTS `detail_brg_masuk` (
  `id_detail_masuk` int(10) NOT NULL AUTO_INCREMENT,
  `id_brg_masuk` varchar(8) NOT NULL,
  `id_barang` varchar(6) NOT NULL,
  `jml_brg` int(5) NOT NULL,
  PRIMARY KEY (`id_detail_masuk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `detail_brg_masuk`
--

INSERT INTO `detail_brg_masuk` (`id_detail_masuk`, `id_brg_masuk`, `id_barang`, `jml_brg`) VALUES
(1, 'BM000001', 'BRG002', 22);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengadaan`
--

CREATE TABLE IF NOT EXISTS `detail_pengadaan` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat_pengadaan` varchar(27) NOT NULL,
  `id_barang` varchar(6) NOT NULL,
  `jml_brg` int(3) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengajuan`
--

CREATE TABLE IF NOT EXISTS `detail_pengajuan` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat_pengajuan` varchar(27) NOT NULL,
  `id_barang` varchar(6) NOT NULL,
  `jml_brg` int(3) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `detail_pengajuan`
--

INSERT INTO `detail_pengajuan` (`id_detail`, `no_surat_pengajuan`, `id_barang`, `jml_brg`) VALUES
(1, '001.SPn/KMHS/2/VIII/20', 'BRG001', 12);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE IF NOT EXISTS `divisi` (
  `id_divisi` varchar(6) NOT NULL,
  `nama_divisi` varchar(20) NOT NULL,
  `kepala_divisi` varchar(30) NOT NULL,
  `telp` int(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `id_user` varchar(6) NOT NULL,
  PRIMARY KEY (`id_divisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`, `kepala_divisi`, `telp`, `email`, `id_user`) VALUES
('DIV001', 'Kemahasiswaan', 'Ali Mulyawan', 2147483647, 'alimul@gmail.com', 'Ali Mu');

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
('KB001', 'Elektronik'),
('KB002', 'Mebeler'),
('KB003', 'ATK');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_brg`
--

CREATE TABLE IF NOT EXISTS `pengajuan_brg` (
  `no_surat_pengajuan` varchar(27) NOT NULL,
  `id_user` varchar(6) NOT NULL,
  `tgl` date NOT NULL,
  `id_divisi` varchar(6) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `acc` enum('N','Y','X') NOT NULL,
  `jml_brg` int(5) NOT NULL,
  PRIMARY KEY (`no_surat_pengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan_brg`
--

INSERT INTO `pengajuan_brg` (`no_surat_pengajuan`, `id_user`, `tgl`, `id_divisi`, `perihal`, `catatan`, `acc`, `jml_brg`) VALUES
('001.SPn/KMHS/2/VIII/20', '', '0000-00-00', '', '', '', 'N', 0),
('002.SPn/KMHS/2/VIII/20', 'USR001', '2021-08-02', 'DIV001', 'sehubungan akan di lakukan nya peremajaan properti kelas berupa kursi kelas ', '1', 'N', 100);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_pengadaan_brg`
--

CREATE TABLE IF NOT EXISTS `pengajuan_pengadaan_brg` (
  `no_surat_pengadaan` varchar(27) NOT NULL,
  `id_user` varchar(6) NOT NULL,
  `tgl` date NOT NULL,
  `id_divisi` varchar(6) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `acc` enum('N','Y','X') NOT NULL,
  `jml_brg` int(5) NOT NULL,
  PRIMARY KEY (`no_surat_pengadaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan_pengadaan_brg`
--

INSERT INTO `pengajuan_pengadaan_brg` (`no_surat_pengadaan`, `id_user`, `tgl`, `id_divisi`, `perihal`, `catatan`, `acc`, `jml_brg`) VALUES
('001.SPPn/BAUK/2/VIII/2021', 'USR008', '2021-08-02', 'DIV001', 'pengajuan pengadaan PC', 's', 'N', 10);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `id_stok` int(6) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(6) NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`id_stok`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_barang`, `stok`) VALUES
(1, 'BRG001', 44),
(3, 'BRG003', 100),
(4, 'BRG006', 100);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` varchar(6) NOT NULL,
  `nama_sup` varchar(50) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `cp` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_sup`, `telp`, `alamat`, `cp`, `email`) VALUES
('SUP002', 'PT ALFASCALE INDONESIA', '+625435435345', 'RUKAN SUNTER PERMAI INDAH', 'IBU YETI', 'yeti.intralab@gmail.com'),
('SUP003', 'CMSI', '+62', 'JAKARTA TIMUR', 'IBU EMI', 'emi.cmsi@gmail.com'),
('SUP004', 'PT ELOKARSA', '+62', 'JAKARTA PUSAT', 'YENI', 'elokarsa@gmail.com'),
('SUP005', 'CV. ABADI ', '+628927361874', 'Jl. Indah Mandiri III No.9', 'Supplier ATK', 'abadi@gmail.com'),
('SUP006', 'PT. INTAN MAJU JAYA', '+6208348374', 'Jl Abadi N0.12', 'IMJ', 'intanmajujaya@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tmp`
--

CREATE TABLE IF NOT EXISTS `tmp` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no_surat` varchar(27) NOT NULL,
  `no_pengajuan` varchar(27) NOT NULL,
  `id_barang` varchar(6) NOT NULL,
  `jumlah` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` varchar(6) NOT NULL,
  `user` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `id_divisi` varchar(6) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `level` enum('admin','pimpinan','prodi','puskom','yayasan','kemahasiswaan') NOT NULL,
  `blokir` enum('N','Y') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `user`, `pass`, `nama`, `id_divisi`, `no_hp`, `level`, `blokir`) VALUES
('USR001', 'Andri', 'Andri', 'Andri', '', '081224923354', 'prodi', 'N'),
('USR003', 'imankadar', 'amoebabio', 'Iman Kadarisman', '', '081529373782', 'pimpinan', 'N'),
('USR004', 'Ramirez', 'Ramirez', 'Ramirez', '', '+6281365580887', '', 'N'),
('USR005', 'mulyana', 'mulyana', 'Mulyana', '', '+6284597685', '', 'N'),
('USR007', 'pimpinan', 'mardira', 'pimpinan', '', '0865125735631', 'pimpinan', 'N'),
('USR008', 'admin', 'admin', 'admin', 'DIV001', '089123445667', 'admin', 'N');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
