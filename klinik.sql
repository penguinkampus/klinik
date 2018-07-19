-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20 Jul 2018 pada 01.09
-- Versi Server: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dbdokter`
--

CREATE TABLE `dbdokter` (
  `kddokter` varchar(6) NOT NULL,
  `nmdokter` varchar(50) NOT NULL,
  `tgllahir` date NOT NULL,
  `spesialis` varchar(15) NOT NULL,
  `jnskelamin` varchar(15) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `notelp` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `dbdokter`
--

INSERT INTO `dbdokter` (`kddokter`, `nmdokter`, `tgllahir`, `spesialis`, `jnskelamin`, `alamat`, `notelp`) VALUES
('DK0001', 'Restu', '2018-07-15', 'Umum', 'Laki-laki', 'Serpong', 2341231);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dbobat`
--

CREATE TABLE `dbobat` (
  `kdobat` varchar(6) NOT NULL,
  `nmobat` varchar(30) NOT NULL,
  `stok` int(5) NOT NULL,
  `exp` date NOT NULL,
  `keterangan` varchar(40) NOT NULL,
  `harga` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `dbobat`
--

INSERT INTO `dbobat` (`kdobat`, `nmobat`, `stok`, `exp`, `keterangan`, `harga`) VALUES
('KO0001', 'Amoxilin', 100, '2019-03-14', 'Anti Biotik', 40000),
('OB0002', 'Panadol', 1, '2018-07-05', 'Obat Pusing', 1200);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dbpasien`
--

CREATE TABLE `dbpasien` (
  `kdpasien` varchar(6) NOT NULL,
  `nmpasien` varchar(50) NOT NULL,
  `tgllahir` date NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `goldarah` varchar(3) NOT NULL,
  `jnskelamin` varchar(15) NOT NULL,
  `umur` varchar(3) NOT NULL,
  `notelp` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `dbpasien`
--

INSERT INTO `dbpasien` (`kdpasien`, `nmpasien`, `tgllahir`, `alamat`, `goldarah`, `jnskelamin`, `umur`, `notelp`) VALUES
('KD0001', 'Tangkas Rachman', '2018-07-04', 'Jalan Hari Kemerdekaan Timur No 45', 'AB', 'Perempuan', '18', 825325325),
('KP0002', 'Firman', '2018-07-07', 'Cipadue', 'AB', 'Laki-laki', '23', 121124124),
('KP0003', 'Aldiansyah', '2018-07-19', 'Belandamai', 'Z', 'Laki-laki', '23', 123123);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dbpetugas`
--

CREATE TABLE `dbpetugas` (
  `kdpetugas` varchar(6) NOT NULL,
  `nmpetugas` varchar(50) NOT NULL,
  `jnskelamin` varchar(15) NOT NULL,
  `tgllahir` date NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `notelp` int(20) NOT NULL,
  `level` varchar(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `dbpetugas`
--

INSERT INTO `dbpetugas` (`kdpetugas`, `nmpetugas`, `jnskelamin`, `tgllahir`, `alamat`, `notelp`, `level`, `username`, `password`) VALUES
('PT0001', 'Restu', 'Laki-laki', '2018-07-05', 'Serpong', 12312412, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dbtindakan`
--

CREATE TABLE `dbtindakan` (
  `kdtindakan` varchar(6) NOT NULL,
  `nmtindakan` varchar(30) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `harga` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `dbtindakan`
--

INSERT INTO `dbtindakan` (`kdtindakan`, `nmtindakan`, `keterangan`, `harga`) VALUES
('KT001', 'Cek Kolestrol', 'Mengecek tekanan kolestrol pada tubuh', 30000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_obat`
--

CREATE TABLE `detail_obat` (
  `nomedis` varchar(6) NOT NULL,
  `kdobat` varchar(6) NOT NULL,
  `nmobat` varchar(30) NOT NULL,
  `harga` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_obat`
--

INSERT INTO `detail_obat` (`nomedis`, `kdobat`, `nmobat`, `harga`) VALUES
('NM0001', 'OB0002', 'Panadol', 1200),
('NM0002', 'OB0002', 'Panadol', 1200),
('NM0003', 'KO0001', 'Amoxilin', 40000),
('NM0003', 'OB0002', 'Panadol', 1200);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_tindakan`
--

CREATE TABLE `detail_tindakan` (
  `nomedis` varchar(6) NOT NULL,
  `kdtindakan` varchar(6) NOT NULL,
  `nmtindakan` varchar(30) NOT NULL,
  `harga` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_tindakan`
--

INSERT INTO `detail_tindakan` (`nomedis`, `kdtindakan`, `nmtindakan`, `harga`) VALUES
('NM0001', 'KT001', 'Cek Kolestrol', 30000),
('NM0002', 'KT001', 'Cek Kolestrol', 30000),
('NM0003', 'KT001', 'Cek Kolestrol', 30000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_obat`
--

CREATE TABLE `temp_obat` (
  `kdobat` varchar(6) NOT NULL,
  `nmobat` varchar(30) NOT NULL,
  `harga` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_tindakan`
--

CREATE TABLE `temp_tindakan` (
  `kdtindakan` varchar(6) NOT NULL,
  `nmtindakan` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trdaftar`
--

CREATE TABLE `trdaftar` (
  `nodaftar` varchar(6) NOT NULL,
  `tgldaftar` date NOT NULL,
  `kdpasien` varchar(6) NOT NULL,
  `nmpasien` varchar(50) NOT NULL,
  `goldarah` varchar(3) NOT NULL,
  `umur` varchar(3) NOT NULL,
  `keluhan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `trdaftar`
--

INSERT INTO `trdaftar` (`nodaftar`, `tgldaftar`, `kdpasien`, `nmpasien`, `goldarah`, `umur`, `keluhan`) VALUES
('ND0001', '2018-07-19', 'KP0002', 'Firman', 'AB', '23', 'Mabok Genjer'),
('ND0002', '2018-07-19', 'KD0001', 'Tangkas Rachman', 'AB', '18', 'Mual'),
('ND0003', '2018-07-19', 'KP0003', 'Aldiansyah', 'Z', '23', 'Pusing'),
('ND0002', '0000-00-00', '', 'Tangkas Rachman', '', '18', 'Mual'),
('ND0001', '0000-00-00', '', 'Firman', '', '23', 'Mabok Genjer'),
('ND0001', '0000-00-00', '', 'Firman', '', '23', 'Mabok Genjer'),
('ND0001', '0000-00-00', '', 'Firman', '', '23', 'Mabok Genjer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trkwitansi`
--

CREATE TABLE `trkwitansi` (
  `nokwi` varchar(6) NOT NULL,
  `tglkwi` date NOT NULL,
  `nmpasien` varchar(50) NOT NULL,
  `diagnosa` varchar(30) NOT NULL,
  `tindakan` varchar(30) NOT NULL,
  `hrgtindakan` int(11) NOT NULL,
  `nmobat` varchar(50) NOT NULL,
  `jmlobat` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trmedis`
--

CREATE TABLE `trmedis` (
  `nomedis` varchar(6) NOT NULL,
  `tglmedis` date NOT NULL,
  `nodaftar` varchar(6) NOT NULL,
  `diagnosa` varchar(75) NOT NULL,
  `kddokter` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `trmedis`
--

INSERT INTO `trmedis` (`nomedis`, `tglmedis`, `nodaftar`, `diagnosa`, `kddokter`) VALUES
('NM0001', '2018-07-19', 'ND0001', 'Gak cocok di darat', 'DK0001'),
('NM0002', '2018-07-19', 'ND0002', 'Gejala Tipes', 'DK0001'),
('NM0003', '2018-07-19', 'ND0003', 'Kurang Jajan', 'DK0001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trsuratresep`
--

CREATE TABLE `trsuratresep` (
  `noresep` varchar(6) NOT NULL,
  `tglresep` date NOT NULL,
  `nomedis` varchar(6) NOT NULL,
  `nodaftar` varchar(6) NOT NULL,
  `diagnosa` varchar(75) NOT NULL,
  `kdobat` varchar(6) NOT NULL,
  `nmobat` varchar(50) NOT NULL,
  `hrgobat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trsuratrujukan`
--

CREATE TABLE `trsuratrujukan` (
  `norujukan` varchar(6) NOT NULL,
  `tglrujukan` date NOT NULL,
  `nomedis` varchar(6) NOT NULL,
  `nodaftar` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `trsuratrujukan`
--

INSERT INTO `trsuratrujukan` (`norujukan`, `tglrujukan`, `nomedis`, `nodaftar`) VALUES
('RJ0001', '2018-07-20', 'NM0001', 'ND0001'),
('RJ0002', '2018-07-20', 'NM0002', 'ND0002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trsuratsakit`
--

CREATE TABLE `trsuratsakit` (
  `nosuratsakit` varchar(6) NOT NULL,
  `tglsuratsakit` date NOT NULL,
  `nomedis` varchar(6) NOT NULL,
  `nodaftar` varchar(6) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `lamahari` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dbdokter`
--
ALTER TABLE `dbdokter`
  ADD PRIMARY KEY (`kddokter`);

--
-- Indexes for table `dbpasien`
--
ALTER TABLE `dbpasien`
  ADD PRIMARY KEY (`kdpasien`);

--
-- Indexes for table `dbpetugas`
--
ALTER TABLE `dbpetugas`
  ADD PRIMARY KEY (`kdpetugas`);

--
-- Indexes for table `dbtindakan`
--
ALTER TABLE `dbtindakan`
  ADD PRIMARY KEY (`kdtindakan`);

--
-- Indexes for table `trkwitansi`
--
ALTER TABLE `trkwitansi`
  ADD PRIMARY KEY (`nokwi`);

--
-- Indexes for table `trmedis`
--
ALTER TABLE `trmedis`
  ADD PRIMARY KEY (`nomedis`);

--
-- Indexes for table `trsuratresep`
--
ALTER TABLE `trsuratresep`
  ADD PRIMARY KEY (`noresep`);

--
-- Indexes for table `trsuratrujukan`
--
ALTER TABLE `trsuratrujukan`
  ADD PRIMARY KEY (`norujukan`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
