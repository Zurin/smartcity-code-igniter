-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 01, 2019 at 03:18 PM
-- Server version: 10.1.38-MariaDB-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rackspir_lapor`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_favorite`
--

CREATE TABLE `tb_favorite` (
  `id_fav` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_favorite`
--

INSERT INTO `tb_favorite` (`id_fav`, `id_user`, `id_post`) VALUES
(1, 8, 18),
(19, 8, 3),
(20, 8, 16),
(21, 15, 21);

-- --------------------------------------------------------

--
-- Table structure for table `tb_judul`
--

CREATE TABLE `tb_judul` (
  `id` int(11) NOT NULL,
  `judul_web` varchar(50) NOT NULL,
  `brand` text NOT NULL,
  `about` text NOT NULL,
  `favicon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_judul`
--

INSERT INTO `tb_judul` (`id`, `judul_web`, `brand`, `about`, `favicon`) VALUES
(1, 'Lapor!', 'TenableLogo_White_CMYK1.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pharetra porta sollicitudin. Nulla facilisi. Quisque mollis viverra faucibus. Aliquam efficitur faucibus quam, luctus congue augue tincidunt ac. Ut luctus est vitae sodales pharetra. Curabitur eu erat tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed hendrerit gravida mauris in sodales. Etiam gravida eleifend iaculis. Aenean molestie viverra quam, elementum mattis purus porttitor id. Integer eleifend turpis at vehicula efficitur. Maecenas suscipit sem justo, eu suscipit velit suscipit eu. Nam neque enim, tincidunt sit amet lacinia at, tempor quis arcu. Mauris auctor aliquet est sit amet finibus. Phasellus quis gravida felis, sed ullamcorper neque. Pellentesque vestibulum sapien ac odio sollicitudin, in pharetra mi dignissim.', 'city_icon2.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kejadian`
--

CREATE TABLE `tb_kejadian` (
  `id_kejadian` int(11) NOT NULL,
  `nama_kejadian` varchar(30) NOT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kejadian`
--

INSERT INTO `tb_kejadian` (`id_kejadian`, `nama_kejadian`, `icon`) VALUES
(1, 'Community', 'community_marker.png'),
(2, 'Emergency', 'alert_marker.png'),
(3, 'Citizen Proposal', 'citizen_marker.png'),
(4, 'Public Service', 'service_marker.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_komentar`
--

CREATE TABLE `tb_komentar` (
  `id_komentar` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tgl_komentar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_komentar`
--

INSERT INTO `tb_komentar` (`id_komentar`, `isi_komentar`, `tgl_komentar`, `id_post`, `id_user`) VALUES
(1, 'Tes komentar', '2018-02-15 14:07:30', 3, 8),
(2, 'Tes lagi gan', '2018-02-15 14:16:21', 3, 12),
(3, 'Tes lagi gan', '2018-02-15 15:08:44', 3, 12),
(5, 'Tes komentar wong njoget.', '2018-02-17 15:07:12', 16, 8),
(6, 'Komentar lagi gan.', '2018-02-17 16:17:31', 16, 8),
(9, 'Ha!', '2018-02-17 16:26:21', 17, 8),
(10, 'Pffft. OPPAI', '2018-02-17 16:56:03', 17, 8),
(11, 'OPPAAAAIIIIII', '2018-02-17 16:56:13', 17, 8),
(12, 'Tes', '2018-02-21 17:52:04', 18, 8),
(13, 'a', '2018-02-21 18:01:00', 19, 8),
(14, 'A', '2018-02-21 18:23:41', 18, 8),
(15, 'A', '2018-02-21 18:35:37', 14, 8),
(16, 'Tes lagi.', '2018-02-23 09:57:01', 18, 8),
(17, 'Daishouri.', '2018-02-23 09:57:23', 3, 8),
(18, 'Pertamax.', '2018-02-23 09:59:54', 9, 8),
(19, 'Wkwkwkwkw\r\nHoho\r\nwkwkwkwk', '2018-02-23 11:52:28', 15, 8),
(20, 'Tes single.', '2018-03-13 16:40:15', 18, 8),
(21, 'Halo', '2018-07-24 01:11:43', 20, 15),
(22, 'Tes', '2018-12-06 06:26:25', 19, 15),
(23, 'Faris homo', '2018-12-06 06:26:40', 19, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tb_post`
--

CREATE TABLE `tb_post` (
  `id_post` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` enum('waiting','process','completed') NOT NULL DEFAULT 'waiting',
  `keterangan` text NOT NULL,
  `foto` text NOT NULL,
  `ditangani_oleh` varchar(128) NOT NULL,
  `tgl_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_status` date NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `lokasi` text,
  `id_sub_kejadian` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_post`
--

INSERT INTO `tb_post` (`id_post`, `deskripsi`, `status`, `keterangan`, `foto`, `ditangani_oleh`, `tgl_post`, `tgl_status`, `latitude`, `longitude`, `lokasi`, `id_sub_kejadian`, `id_user`) VALUES
(19, 'Jajal lagi ada lokasi', 'waiting', '', 'wallhaven-69674.jpg', '', '2018-02-21 16:37:08', '0000-00-00', '-7.786234', '110.410566', 'Lokasi coba, lewat API', 3, 12),
(20, 'Kecelakaan terjadi', 'waiting', '', 'kecelakaan.jpg', '', '2018-07-24 01:10:35', '0000-00-00', '-7.802484056399146', '110.40980492170411', 'Jl. Wonocatur No.75, 27, Banguntapan, Bantul, Daerah Istimewa Yogyakarta 55198, Indonesia', 3, 15),
(21, 'Lampu rusak', 'waiting', '', 'Tvt7dkG3aS.JPG', '', '2018-07-24 02:28:58', '0000-00-00', '-7.802271466184722', '110.39525662000733', 'Jl. Kusumanegara No.212, Muja Muju, Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55165, Indonesia', 11, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sosmed`
--

CREATE TABLE `tb_sosmed` (
  `id_sosmed` int(11) NOT NULL,
  `fa_sosmed` varchar(50) NOT NULL,
  `url` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sosmed`
--

INSERT INTO `tb_sosmed` (`id_sosmed`, `fa_sosmed`, `url`) VALUES
(13, 'fa fa-facebook-square', 'https://facebook.com/RynoVengeance'),
(14, 'fa fa-twitter-square', 'https://twitter.com/Ryno_Vengenz'),
(16, 'fa fa-youtube-square', 'https://you.tube');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_kejadian`
--

CREATE TABLE `tb_sub_kejadian` (
  `id_sub_kejadian` int(11) NOT NULL,
  `nama_sub_kejadian` varchar(75) NOT NULL,
  `id_kejadian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sub_kejadian`
--

INSERT INTO `tb_sub_kejadian` (`id_sub_kejadian`, `nama_sub_kejadian`, `id_kejadian`) VALUES
(1, 'Taman rusak', 1),
(2, 'Acara publik', 1),
(3, 'Kecelakaan', 2),
(4, 'Pencurian', 2),
(5, 'Kebakaran', 2),
(6, 'Jalan rusak', 3),
(7, 'Jalan ditutup', 3),
(8, 'Sampah', 3),
(9, 'Laporan keamanan', 3),
(10, 'Gangguan listrik', 4),
(11, 'Lampu jalan rusak', 4),
(12, 'Gangguan air', 4),
(13, 'Gangguan selokan', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('l','p') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `avatar` text,
  `level` enum('admin','member','adminRS') NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `username`, `email`, `password`, `gender`, `tgl_lahir`, `avatar`, `level`) VALUES
(7, 'Member Dummy', 'member', 'abc@mail.com', '$2y$10$IkDQapCnHRWJ.xHkuJu7u.hYO5uDayXrGU3W0MBSsauT9j0QuCJQm', 'p', '2018-01-30', '', 'adminRS'),
(9, 'Ikhwan Dirga Pratama', 'black', 'black@mail.com', '$2y$10$dO15xps.mwRewpWZNg6Wlu7V7ae.3yM4E9qyYOaMdpTgLnEylhEIq', 'l', '1995-01-23', '', 'member'),
(12, 'Yudistiro Septian Dwi Saputro', 'blank', 'yudistiro6@gmail.com', '$2y$10$pziokH3ZxBf5sDDQq4ovMuG1oZMIa9sJf.S0ENSTgR/z7aaydM3Lu', 'l', '1997-08-09', '', 'member'),
(13, 'User insert by admin', 'userByAdmin', 'userAdmin@mail.com', '$2y$10$VR/Gaj8R8tosLQpoletBNONoPb1u7FWBoTTNfCpkF2TpUY/ZXHV4u', 'p', '1995-12-14', NULL, 'member'),
(14, 'Tes Admin RS', 'TesRS', 'adminRS@min.com', '$2y$10$ofvf4dTRgQI.Am79jy8BGe/dpFTfjNtwdrRxll7l4uqTOvlXr7jQu', 'l', '2018-03-08', NULL, 'adminRS'),
(15, 'Rino Ridlo Julianto', 'zurin', 'rinoridlojulianto@yahoo.com', '$2y$10$GyQP5706BF6dBw0DsgyUQuw7wFH2dju.PWJ5bfDP5UET9DsWoK33i', 'l', '1996-07-22', 'zurin1.png', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_favorite`
--
ALTER TABLE `tb_favorite`
  ADD PRIMARY KEY (`id_fav`);

--
-- Indexes for table `tb_judul`
--
ALTER TABLE `tb_judul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kejadian`
--
ALTER TABLE `tb_kejadian`
  ADD PRIMARY KEY (`id_kejadian`);

--
-- Indexes for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `tb_post`
--
ALTER TABLE `tb_post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indexes for table `tb_sosmed`
--
ALTER TABLE `tb_sosmed`
  ADD PRIMARY KEY (`id_sosmed`);

--
-- Indexes for table `tb_sub_kejadian`
--
ALTER TABLE `tb_sub_kejadian`
  ADD PRIMARY KEY (`id_sub_kejadian`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_favorite`
--
ALTER TABLE `tb_favorite`
  MODIFY `id_fav` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_judul`
--
ALTER TABLE `tb_judul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kejadian`
--
ALTER TABLE `tb_kejadian`
  MODIFY `id_kejadian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_post`
--
ALTER TABLE `tb_post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_sosmed`
--
ALTER TABLE `tb_sosmed`
  MODIFY `id_sosmed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_sub_kejadian`
--
ALTER TABLE `tb_sub_kejadian`
  MODIFY `id_sub_kejadian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
