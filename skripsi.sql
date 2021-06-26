-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 02 Jan 2019 pada 13.41
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `skripsi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` varchar(6) NOT NULL,
  `nama_brg` varchar(30) NOT NULL,
  `id_kategori` varchar(10) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `kode_produk` varchar(30) NOT NULL,
  `spesifikasi` text NOT NULL,
  `harga_beli` int(20) NOT NULL,
  `harga_jual` int(20) NOT NULL,
  `nama_sup` varchar(30) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_brg`, `id_kategori`, `satuan`, `kode_produk`, `spesifikasi`, `harga_beli`, `harga_jual`, `nama_sup`) VALUES
('BRG002', 'centrifuge', 'Ohaus', 'Unit', 'C546728', 'Alat laboratorium', 400000, 700000, 'PT ALFASCALE INDONESIA'),
('BRG003', 'Kalibrasi', 'Ohaus', 'Unit', '-', 'Jasa Kalibrasi', 550000, 800000, 'CMSI'),
('BRG004', 'OHAUS TYPE ST350', 'Ohaus', 'UNIT', 'ST350', 'ALAT LABORATORIUM', 5000000, 6500000, 'CMSI'),
('BRG005', 'AUTOCLAVABLE DISPOSAL BAG', 'Ohaus', 'PCS', 'BAG40', '40 X 20 X 80 CM ', 800000, 1000000, 'PT INTRALAB EKATAMA'),
('BRG006', 'TIMBANGAN ANALITIK', 'Ohaus', 'UNIT', 'ST013', 'ALAT LABORATORIUM', 80000000, 100000000, 'PT ALFASCALE INDONESIA'),
('BRG007', 'TIMBANGAN ANALITIK', 'Ohaus', 'UNIT', 'st360', 'ALAT LABORATORIUM', 1000000, 1500000, 'PT INTRALAB EKATAMA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
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
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`no_surat`, `id_barang`, `nama_barang`, `spesifikasi`, `qty`, `harga_jual`, `diskon`, `subtotal`, `ppn`, `status_barang`, `id_user`, `acc`) VALUES
('001/SP-ABS/HA/XI/2018', 'BRG001', 'Timbangan Analitik', '0', 8, 1000000, 0, 8000000, 800000, 'Ready', 'USR003', 'Y'),
('001/SP-ABS/HA/XI/2018', 'BRG003', 'Kalibrasi', '0', 3, 800000, 0, 2400000, 240000, 'Ready', 'USR003', 'N'),
('002/SP-ABS/IM/XI/2018', 'BRG001', 'Timbangan Analitik', '0', 8, 1000000, 0, 8000000, 800000, 'Ready', 'USR005', 'Y'),
('003/SP-ABS/IM/XI/2018', 'BRG001', 'Timbangan Analitik', '0', 8, 1000000, 0, 8000000, 800000, 'Ready', 'USR003', 'Y'),
('004/SP-ABS/IM/XI/2018', 'BRG002', 'centrifuge', '0', 1, 700000, 0, 700000, 70000, 'Ready', 'USR003', 'Y'),
('005/SP-ABS/IM/XI/2018', 'BRG001', 'Timbangan Analitik', '0', 8, 1000000, 0, 8000000, 800000, 'Ready', 'USR003', 'Y'),
('006/SP-ABS/IM/XI/2018', 'BRG007', 'TIMBANGAN ANALITIK', '0', 10, 1500000, 0, 15000000, 1500000, 'Ready', 'USR003', 'Y'),
('007/SP-ABS/IM/XII/2018', 'BRG007', 'TIMBANGAN ANALITIK', 'ALAT LABORATORIUM', 1, 1500000, 0, 1500000, 150000, 'Ready', 'USR003', 'Y'),
('008/SP-ABS/IM/XII/2018', 'BRG003', 'Kalibrasi', 'Jasa Kalibrasi', 1, 800000, 0, 800000, 80000, 'Ready', 'USR003', 'Y'),
('008/SP-ABS/AN/XII/2018', 'BRG002', 'centrifuge', 'Alat laboratorium', 4, 700000, 0, 2800000, 280000, 'Ready', 'USR001', 'Y'),
('009/SP-ABS/IM/XII/2018', 'BRG003', 'Kalibrasi', 'Jasa Kalibrasi', 3, 800000, 0, 2400000, 240000, 'Indent', 'USR003', 'Y'),
('009/SP-ABS/IM/XII/2018', 'BRG007', 'TIMBANGAN ANALITIK', 'ALAT LABORATORIUM', 4, 1500000, 0, 6000000, 600000, 'Ready', 'USR003', 'Y'),
('010/SP-ABS/IM/XII/2018', 'BRG007', 'TIMBANGAN ANALITIK', 'ALAT LABORATORIUM', 2, 1500000, 0, 3000000, 300000, 'Indent', 'USR003', 'Y'),
('010/SP-ABS/IM/XII/2018', 'BRG003', 'Kalibrasi', 'Jasa Kalibrasi', 2, 800000, 0, 1600000, 160000, 'Ready', 'USR003', 'Y'),
('011/SP-ABS/AN/XII/2018', 'BRG001', 'Timbangan Analitik', 'Alat laboratorium', 2, 1000000, 0, 4000000, 400000, 'Ready', 'USR001', 'Y'),
('012/SP-ABS/IM/XII/2018', 'BRG002', 'centrifuge', 'Alat laboratorium', 5, 700000, 5000, 3495000, 349500, 'Ready', 'USR003', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang`
--

CREATE TABLE IF NOT EXISTS `kategori_barang` (
  `id_kategori` varchar(6) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori`, `nama_kategori`) VALUES
('KTG001', 'Ohaus'),
('KTG002', 'Himedia'),
('KTG003', 'MERCK'),
('KTG004', 'global');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
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

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pel`, `telp`, `alamat`, `cp`, `email`, `id_user`, `user`) VALUES
('PEL001', 'PT SANBE', '+6222-98766555', 'Jl. Cimareme No. 27 Bandung Barat', 'ibu yani', 'sales@sanbe.com', 'USR003', 'Iman Kadarisman'),
('PEL002', 'PT HOLIPHARMA', '022-92960670', 'JL. CIMAHI', 'IBU ATI', 'info@holipharma.com', 'USR004', 'Daus'),
('PEL003', 'ITB', '02287765678', 'JL. JATINANGOR-SUMEDANG', 'IBU NENDAH', '', 'USR004', 'Daus'),
('PEL004', 'LAFI AD PUSKESAD', '+6221-78728019', 'JL. IBRAHIM ADJIE', 'SURYONO', 'bendaharapusekasad@gmail.com', 'USR003', 'Iman Kadarisman'),
('PEL005', 'PRIMA LAKTO', '+62', 'DESA CIMERANG NO. 170 BANDUNG', 'PAK HADDI', 'haddi.primalakto@gmail.com', 'USR003', 'Iman Kadarisman'),
('PEL006', 'UNIVERSITAS PADJAJARAN', '+62', 'JL. JATINANGOR', 'IBU YENI', '', 'USR003', 'Iman Kadarisman'),
('PEL007', 'universitas parahyangan', '+62', 'Jl. Ciumbuleuit', 'Ibu Emi', '', 'USR003', 'Iman Kadarisman'),
('PEL008', 'UNISBA', '+6222-8719560', 'BANDUNG', 'DEDEN', 'unisba.sales@gmail.com', 'USR001', 'Andri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE IF NOT EXISTS `pesanan` (
  `no_surat` varchar(30) NOT NULL,
  `id_pelanggan` varchar(6) NOT NULL,
  `tgl_prospek` date NOT NULL,
  `id_user` varchar(6) NOT NULL,
  PRIMARY KEY (`no_surat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesanan`
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
('012/SP-ABS/IM/XII/2018', 'PEL003', '2018-12-14', 'USR003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_tmp`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
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
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_sup`, `telp`, `alamat`, `cp`, `email`) VALUES
('SUP001', 'PT INTRALAB EKATAMA', '+6221765888', 'Jl. Sunter No. 72 , Jakarta Utara', 'Ibu Yeti', 'yeti@intralab.com'),
('SUP002', 'PT ALFASCALE INDONESIA', '+62', 'RUKAN SUNTER PERMAI INDAH', 'IBU YETI', 'yeti.intralab@gmail.com'),
('SUP003', 'CMSI', '+62', 'JAKARTA TIMUR', 'IBU EMI', 'emi.cmsi@gmail.com'),
('SUP004', 'PT ELOKARSA', '+62', 'JAKARTA PUSAT', 'YENI', 'elokarsa@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` varchar(10) NOT NULL,
  `user` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `level` enum('sales','support','gm') NOT NULL,
  `blokir` enum('N','Y') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `user`, `pass`, `nama`, `no_hp`, `level`, `blokir`) VALUES
('USR001', 'Andri', 'Andri', 'Andri', '081224923354', 'sales', 'N'),
('USR003', 'imankadar', 'amoebabio', 'Iman Kadarisman', '081529373782', 'gm', 'N'),
('USR004', 'Ramirez', 'Ramirez', 'Ramirez', '+6281365580887', 'sales', 'N'),
('USR005', 'mulyana', 'mulyana', 'Mulyana', '+6284597685', 'sales', 'N'),
('USR006', 'reza', 'reza', 'Reza', '08135890999', 'support', 'N');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
