-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2016 at 04:54 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Login`(
  IN userName VARCHAR(20),
  IN passWord VARCHAR(225)
)
BEGIN
  SELECT * FROM `data-user` u
  WHERE u.id_user = userName AND u.password = passWord;
END$$

DELIMITER ;

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
  `lahir` date DEFAULT NULL,
  `level` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data-user`
--

INSERT INTO `data-user` (`id_user`, `nama`, `bio`, `foto`, `password`, `email`, `lahir`, `level`) VALUES
('rizki', 'zala zala', 'kadal', NULL, 'zala', 'maulanaakbar771@gmail.com', NULL, 2),
('zalaathrun', 'Rizki Maulana', 'Unknown People', NULL, 'calamity', 'maulanaakbar771@gmail.com', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `id_user1` varchar(50) NOT NULL,
  `id_user2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `komen`
--

CREATE TABLE IF NOT EXISTS `komen` (
  `id_post` varchar(50) NOT NULL,
  `id_user_komen` varchar(50) DEFAULT NULL,
  `isi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id_post` varchar(50) NOT NULL,
  `caption` varchar(50) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `caption`, `time`) VALUES
('zalaathrun', 'Aku jala', '0000-00-00 00:00:00'),
('zalaathrun', 'Aku tes', '2016-05-17 14:09:40');

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
