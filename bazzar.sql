-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2018 at 07:35 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bazzar`
--

-- --------------------------------------------------------

--
-- Table structure for table `bazzar_buku`
--

CREATE TABLE `bazzar_buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(400) NOT NULL,
  `pengarang` varchar(80) NOT NULL,
  `penerbit` int(3) NOT NULL,
  `thn_terbit` int(5) NOT NULL,
  `diskon` int(2) NOT NULL,
  `harga` int(8) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `foto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bazzar_buku`
--

INSERT INTO `bazzar_buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`, `thn_terbit`, `diskon`, `harga`, `jumlah`, `foto`) VALUES
(1, 'Memahami OOP pada PHP', 'Ahmad Qorib', 1, 0, 20, 50000, 10, 'coverbuku.jpg'),
(3, 'Belajar Android Dengan Firebase Database', 'Ahmad Qorib', 1, 0, 0, 100000, 10, 'cb1.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `bazzar_data_keuntungan`
-- (See below for the actual view)
--
CREATE TABLE `bazzar_data_keuntungan` (
`id_penjualan` int(10)
,`tgl` date
,`waktu` time
,`judul_buku` varchar(400)
,`qty` int(3)
,`harga` int(8)
,`penerbit` varchar(25)
,`diskon_penerbit` int(3)
,`harga_jual` int(10)
,`diskon_pembeli` int(2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `bazzar_data_penjualan`
-- (See below for the actual view)
--
CREATE TABLE `bazzar_data_penjualan` (
`id_penjualan` int(10)
,`tgl` date
,`waktu` time
,`judul_buku` varchar(400)
,`qty` int(3)
,`harga` int(10)
,`total` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `bazzar_data_penjualan_penerbit`
-- (See below for the actual view)
--
CREATE TABLE `bazzar_data_penjualan_penerbit` (
`id_penjualan` int(10)
,`tgl` date
,`waktu` time
,`judul_buku` varchar(400)
,`qty` int(3)
,`harga` int(8)
,`penerbit` varchar(25)
,`diskon` int(3)
);

-- --------------------------------------------------------

--
-- Table structure for table `bazzar_detail_penjualan`
--

CREATE TABLE `bazzar_detail_penjualan` (
  `id_penjualan` int(10) NOT NULL,
  `id_buku` int(10) NOT NULL,
  `qty` int(3) NOT NULL,
  `harga` int(10) NOT NULL,
  `diskon` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bazzar_keuntungan`
--

CREATE TABLE `bazzar_keuntungan` (
  `diskon` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bazzar_keuntungan`
--

INSERT INTO `bazzar_keuntungan` (`diskon`) VALUES
(50);

-- --------------------------------------------------------

--
-- Table structure for table `bazzar_penerbit`
--

CREATE TABLE `bazzar_penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `penerbit` varchar(25) NOT NULL,
  `diskon` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bazzar_penerbit`
--

INSERT INTO `bazzar_penerbit` (`id_penerbit`, `penerbit`, `diskon`) VALUES
(1, 'Graha Ilmu', 40);

-- --------------------------------------------------------

--
-- Table structure for table `bazzar_penjualan`
--

CREATE TABLE `bazzar_penjualan` (
  `id_penjualan` int(10) NOT NULL,
  `tgl` date NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bazzar_user`
--

CREATE TABLE `bazzar_user` (
  `id_user` int(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bazzar_user`
--

INSERT INTO `bazzar_user` (`id_user`, `username`, `password`, `nama`, `foto`) VALUES
(16, 'admin', 'admin', 'Ahmad Qorib', '00.jpg');

-- --------------------------------------------------------

--
-- Structure for view `bazzar_data_keuntungan`
--
DROP TABLE IF EXISTS `bazzar_data_keuntungan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bazzar_data_keuntungan`  AS  select `p`.`id_penjualan` AS `id_penjualan`,`p`.`tgl` AS `tgl`,`p`.`waktu` AS `waktu`,`b`.`judul_buku` AS `judul_buku`,`d`.`qty` AS `qty`,`b`.`harga` AS `harga`,`pe`.`penerbit` AS `penerbit`,`pe`.`diskon` AS `diskon_penerbit`,`d`.`harga` AS `harga_jual`,`d`.`diskon` AS `diskon_pembeli` from (((`bazzar_penjualan` `p` join `bazzar_detail_penjualan` `d`) join `bazzar_buku` `b`) join `bazzar_penerbit` `pe`) where ((`p`.`id_penjualan` = `d`.`id_penjualan`) and (`d`.`id_buku` = `b`.`id_buku`) and (`b`.`penerbit` = `pe`.`id_penerbit`)) ;

-- --------------------------------------------------------

--
-- Structure for view `bazzar_data_penjualan`
--
DROP TABLE IF EXISTS `bazzar_data_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bazzar_data_penjualan`  AS  select `p`.`id_penjualan` AS `id_penjualan`,`p`.`tgl` AS `tgl`,`p`.`waktu` AS `waktu`,`b`.`judul_buku` AS `judul_buku`,`d`.`qty` AS `qty`,`d`.`harga` AS `harga`,(`d`.`qty` * `d`.`harga`) AS `total` from ((`bazzar_detail_penjualan` `d` join `bazzar_penjualan` `p`) join `bazzar_buku` `b`) where ((`d`.`id_penjualan` = `p`.`id_penjualan`) and (`d`.`id_buku` = `b`.`id_buku`)) ;

-- --------------------------------------------------------

--
-- Structure for view `bazzar_data_penjualan_penerbit`
--
DROP TABLE IF EXISTS `bazzar_data_penjualan_penerbit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bazzar_data_penjualan_penerbit`  AS  select `p`.`id_penjualan` AS `id_penjualan`,`p`.`tgl` AS `tgl`,`p`.`waktu` AS `waktu`,`b`.`judul_buku` AS `judul_buku`,`d`.`qty` AS `qty`,`b`.`harga` AS `harga`,`pe`.`penerbit` AS `penerbit`,`pe`.`diskon` AS `diskon` from (((`bazzar_penjualan` `p` join `bazzar_detail_penjualan` `d`) join `bazzar_buku` `b`) join `bazzar_penerbit` `pe`) where ((`p`.`id_penjualan` = `d`.`id_penjualan`) and (`d`.`id_buku` = `b`.`id_buku`) and (`b`.`penerbit` = `pe`.`id_penerbit`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bazzar_buku`
--
ALTER TABLE `bazzar_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `bazzar_keuntungan`
--
ALTER TABLE `bazzar_keuntungan`
  ADD PRIMARY KEY (`diskon`);

--
-- Indexes for table `bazzar_penerbit`
--
ALTER TABLE `bazzar_penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `bazzar_penjualan`
--
ALTER TABLE `bazzar_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `bazzar_user`
--
ALTER TABLE `bazzar_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bazzar_buku`
--
ALTER TABLE `bazzar_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bazzar_penerbit`
--
ALTER TABLE `bazzar_penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bazzar_penjualan`
--
ALTER TABLE `bazzar_penjualan`
  MODIFY `id_penjualan` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bazzar_user`
--
ALTER TABLE `bazzar_user`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
