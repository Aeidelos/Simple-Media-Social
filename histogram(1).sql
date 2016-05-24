-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2016 at 01:33 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `histogram`
--

-- --------------------------------------------------------

--
-- Table structure for table `data-user`
--

CREATE TABLE IF NOT EXISTS `data-user` (
  `id_user` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `bio` text,
  `foto` varchar(225) DEFAULT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(30) NOT NULL,
  `lahir` varchar(20) DEFAULT NULL,
  `level` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data-user`
--

INSERT INTO `data-user` (`id_user`, `nama`, `bio`, `foto`, `password`, `email`, `lahir`, `level`) VALUES
('admin', 'Admin Histogram', 'Admin in Histogram :)', 'admin', 'd9347402e453e30e015cf808b5fa8f4f', 'zala@zala.zala', '-1934', 1),
('kuda', 'Abyan Chan', 'palo liat2 anjer', NULL, 'b706835de79a2b4e80506f582af3676a', 'uma@kawaii.chan', '-2010', 2),
('rizki', 'Amai Mask', 'kadal', NULL, '77aa27a963a8f2e6b8fb9c853ed89588', 'maulanaakbar771@gmail.com', NULL, 2),
('zain', 'zain kurniawan', 'Nothing to display :v', NULL, '3ed9b95e4b6f2c345836def81e570ef1', 'zain@zain.zain', '0000-00-00', 2),
('zalaathrun', 'Rizki Maulana', 'Hardwork Betrays none, but dream betrays many', NULL, 'd9347402e453e30e015cf808b5fa8f4f', 'maulanaakbar771@gmail.com', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `id_user1` varchar(50) NOT NULL,
  `id_user2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`id_user1`, `id_user2`) VALUES
('zalaathrun', 'kuda'),
('kuda', 'zalaathrun');

-- --------------------------------------------------------

--
-- Table structure for table `komen`
--

CREATE TABLE IF NOT EXISTS `komen` (
  `id_post` varchar(50) NOT NULL,
  `id_user_komen` varchar(50) DEFAULT NULL,
  `isi` varchar(50) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komen`
--

INSERT INTO `komen` (`id_post`, `id_user_komen`, `isi`, `time`) VALUES
('rizki1463587606', 'rizki', 'bcd lo', '2016-05-18 16:07:13'),
('rizki1463587606', 'zalaathrun', 'anjeg', '2016-05-19 12:05:13'),
('', 'rizki', 'wkwkwk', '2016-05-23 11:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE IF NOT EXISTS `like` (
  `id_post` varchar(30) NOT NULL,
  `id_user_like` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`id_post`, `id_user_like`) VALUES
('zalaathrun1463498862', '0'),
('zalaathrun', '0'),
('zalaathrun1463498862', 'zalaathrun');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE IF NOT EXISTS `notifikasi` (
  `id_notifikasi` varchar(20) NOT NULL,
  `id_post` varchar(20) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isi` text NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_post`, `time`, `isi`, `id_user`, `status`) VALUES
('admin1463753774', 'zalaathrun1463643309', '2016-05-20 14:16:14', '<a href="home.php?url=profil&id=kuda">kuda</a> melaporkan\r\n    <a href="home.php?url=status&postid=zalaathrun1463643309&time=2016-05-19 14:35:09">foto</a> dengan alasan kekerasan', 'kuda', 1),
('admin1463754432', 'zalaathrun1463533132', '2016-05-20 14:27:12', '<a href="home.php?url=profil&id=kuda">kuda</a> melaporkan\r\n    <a href="home.php?url=status&postid=zalaathrun1463533132&time=2016-05-18 07:58:52">foto</a> dengan alasan kadal', 'kuda', 1),
('1464001614', '', '2016-05-23 11:06:54', '<a href="home.php?url=profil&id=rizki">rizki</a> mengomentari\r\n    <a href="home.php?url=status&postid=&time=">foto</a> anda', 'rizki', 0),
('rizki1464005232', 'rizkifotoprofil', '2016-05-23 12:07:12', '<a href="home.php?url=profil&id=rizki">rizki</a> mengomentari\r\n    <a href="home.php?url=status&postid=rizkifotoprofil&time=2016-05-23 18:57:12">foto</a> anda', 'rizki', 1),
('rizki1464070052', 'rizkifotoprofil', '2016-05-24 06:07:32', '<a href="home.php?url=profil&id=admin">admin</a> menandai\r\n    <a href="home.php?url=status&postid=rizkifotoprofil&time=2016-05-23 18:57:12">foto</a> anda sebagai hal yang tidak pantas\r\n    , Silahkan hapus atau anda akan diblokir, terima kasih', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id_post` varchar(50) NOT NULL,
  `caption` varchar(50) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `eks` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `caption`, `time`, `eks`) VALUES
('zalaathrun1463533132', 'aaaa', '2016-05-18 00:58:52', 'JPG'),
('zalaathrunfotoprofil', 'mengubah foto profilnya', '2016-05-18 14:31:02', 'png'),
('rizki1463587606', 'Yha Always Lahu', '2016-05-18 16:06:46', 'jpg'),
('zalaathrun1463643309', 'AWKAWKAWKAW GBLK', '2016-05-19 07:35:09', 'jpg'),
('adminfotoprofil', 'mengubah foto profilnya', '2016-05-20 13:35:25', 'jpg'),
('zalaathrun1463994947', 'New album anjer', '2016-05-23 09:15:47', 'jpg'),
('rizkifotoprofil', 'mengubah foto profilnya', '2016-05-23 11:57:12', 'jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data-user`
--
ALTER TABLE `data-user`
  ADD PRIMARY KEY (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
