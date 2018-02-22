-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2018 at 04:10 PM
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
-- Database: `stand_buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
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
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`, `thn_terbit`, `diskon`, `harga`, `jumlah`, `foto`) VALUES
(1, 'OOP dengan PHP', 'Ahmad Qorib', 4, 2018, 25, 100000, 4, '02.jpg'),
(2, 'Java dan MariaDB', 'Irfangi', 3, 2015, 10, 200000, 5, 'naruto-4919261.jpg'),
(4, 'Belajar android studio', 'Mboh', 4, 2018, 20, 60000, 3, '02.jpg'),
(6, 'Belajar Android ', 'Ahmad Qorib', 3, 2020, 10, 100000, 0, '8138.jpg'),
(7, 'Bootstrap 4', 'Ahmad Qorib', 5, 2020, 10, 100000, 6, '2620.jpg'),
(8, 'aplikasi sistem pakar', 'bunafit nugroho', 8, 2014, 25, 54000, 2, 'bsTi-04.jpeg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `data_keuntungan`
-- (See below for the actual view)
--
CREATE TABLE `data_keuntungan` (
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
-- Stand-in structure for view `data_penjualan`
-- (See below for the actual view)
--
CREATE TABLE `data_penjualan` (
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
-- Stand-in structure for view `data_penjualan_penerbit`
-- (See below for the actual view)
--
CREATE TABLE `data_penjualan_penerbit` (
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
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_penjualan` int(10) NOT NULL,
  `id_buku` int(10) NOT NULL,
  `qty` int(3) NOT NULL,
  `harga` int(10) NOT NULL,
  `diskon` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_penjualan`, `id_buku`, `qty`, `harga`, `diskon`) VALUES
(10, 4, 1, 37500, 25),
(11, 6, 2, 90000, 10),
(12, 6, 1, 90000, 10),
(12, 2, 2, 180000, 10),
(12, 3, 1, 190000, 5),
(13, 6, 2, 90000, 10),
(14, 7, 2, 90000, 10),
(15, 6, 2, 90000, 10),
(17, 8, 1, 40500, 25);

-- --------------------------------------------------------

--
-- Table structure for table `keuntungan`
--

CREATE TABLE `keuntungan` (
  `diskon` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuntungan`
--

INSERT INTO `keuntungan` (`diskon`) VALUES
(50);

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `penerbit` varchar(25) NOT NULL,
  `diskon` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `penerbit`, `diskon`) VALUES
(3, 'Graha Ilmu', 40),
(4, 'Airlangga', 40),
(6, 'PT IPTEX', 20),
(7, 'andi offset', 30),
(8, 'gavamedia', 35);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(10) NOT NULL,
  `tgl` date NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tgl`, `waktu`) VALUES
(10, '2018-01-18', '17:21:54'),
(11, '2018-01-20', '19:07:40'),
(12, '2018-01-21', '12:12:34'),
(13, '2018-01-23', '09:59:18'),
(14, '2018-01-23', '10:01:56'),
(15, '2018-02-08', '14:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `judul_buku` varchar(30) NOT NULL,
  `pengarang` varchar(25) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `foto`) VALUES
(16, 'admin', 'admin', 'Ahmad Qorib', '00.jpg');

-- --------------------------------------------------------

--
-- Structure for view `data_keuntungan`
--
DROP TABLE IF EXISTS `data_keuntungan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_keuntungan`  AS  select `p`.`id_penjualan` AS `id_penjualan`,`p`.`tgl` AS `tgl`,`p`.`waktu` AS `waktu`,`b`.`judul_buku` AS `judul_buku`,`d`.`qty` AS `qty`,`b`.`harga` AS `harga`,`pe`.`penerbit` AS `penerbit`,`pe`.`diskon` AS `diskon_penerbit`,`d`.`harga` AS `harga_jual`,`d`.`diskon` AS `diskon_pembeli` from (((`penjualan` `p` join `detail_penjualan` `d`) join `buku` `b`) join `penerbit` `pe`) where ((`p`.`id_penjualan` = `d`.`id_penjualan`) and (`d`.`id_buku` = `b`.`id_buku`) and (`b`.`penerbit` = `pe`.`id_penerbit`)) ;

-- --------------------------------------------------------

--
-- Structure for view `data_penjualan`
--
DROP TABLE IF EXISTS `data_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_penjualan`  AS  select `p`.`id_penjualan` AS `id_penjualan`,`p`.`tgl` AS `tgl`,`p`.`waktu` AS `waktu`,`b`.`judul_buku` AS `judul_buku`,`d`.`qty` AS `qty`,`d`.`harga` AS `harga`,(`d`.`qty` * `d`.`harga`) AS `total` from ((`detail_penjualan` `d` join `penjualan` `p`) join `buku` `b`) where ((`d`.`id_penjualan` = `p`.`id_penjualan`) and (`d`.`id_buku` = `b`.`id_buku`)) ;

-- --------------------------------------------------------

--
-- Structure for view `data_penjualan_penerbit`
--
DROP TABLE IF EXISTS `data_penjualan_penerbit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_penjualan_penerbit`  AS  select `p`.`id_penjualan` AS `id_penjualan`,`p`.`tgl` AS `tgl`,`p`.`waktu` AS `waktu`,`b`.`judul_buku` AS `judul_buku`,`d`.`qty` AS `qty`,`b`.`harga` AS `harga`,`pe`.`penerbit` AS `penerbit`,`pe`.`diskon` AS `diskon` from (((`penjualan` `p` join `detail_penjualan` `d`) join `buku` `b`) join `penerbit` `pe`) where ((`p`.`id_penjualan` = `d`.`id_penjualan`) and (`d`.`id_buku` = `b`.`id_buku`) and (`b`.`penerbit` = `pe`.`id_penerbit`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `keuntungan`
--
ALTER TABLE `keuntungan`
  ADD PRIMARY KEY (`diskon`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
