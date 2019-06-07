-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 07, 2019 at 07:36 PM
-- Server version: 5.7.24-log
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `akordizagitaru`
--
CREATE DATABASE IF NOT EXISTS `akordizagitaru` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `akordizagitaru`;

-- --------------------------------------------------------

--
-- Table structure for table `autor`
--

DROP TABLE IF EXISTS `autor`;
CREATE TABLE IF NOT EXISTS `autor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `autor`
--

INSERT INTO `autor` (`id`, `naziv`) VALUES
(2, 'Guns N\' Roses'),
(3, 'The Beatles'),
(4, 'Bob Dylan'),
(5, 'Elvis Presley'),
(6, 'The Rolling Stones'),
(7, 'Chuck Berry'),
(8, 'Jimi Hendrix'),
(9, 'James Brown'),
(10, 'Aretha Franklin'),
(11, 'Led Zeppelin'),
(12, 'Sinan Sakic'),
(13, 'The Clash');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

DROP TABLE IF EXISTS `komentar`;
CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  `vreme` datetime DEFAULT NULL,
  `stanje` varchar(20) NOT NULL,
  `idPes` int(11) DEFAULT NULL,
  `idKor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `R_1` (`idPes`),
  KEY `R_2` (`idKor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `text`, `vreme`, `stanje`, `idPes`, `idKor`) VALUES
(1, 'Komentar 1', '2018-06-12 10:34:09', 'odobren', 1, NULL),
(2, 'Komentar 2', '2018-07-12 10:34:09', 'odobren', 1, NULL),
(3, 'Komentar 3', '2018-08-12 10:34:09', 'neodobren', 1, NULL),
(4, 'Komentar 4', '2018-09-12 10:34:09', 'neodobren', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `tip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `username`, `password`, `tip`) VALUES
(3, 'm2', 'mod1', 'moderator'),
(4, 'm3', 'mod2', 'moderator'),
(5, 'adm1', 'adm1', 'admin'),
(7, 'm1', 'kor2', 'moderator'),
(8, 'm4', 'mod1', 'moderator'),
(9, 'm5', 'mod2', 'moderator'),
(10, 'adm2', 'adm1', 'admin'),
(11, 'davidmilicevic97', 'carina123', 'korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `pesma`
--

DROP TABLE IF EXISTS `pesma`;
CREATE TABLE IF NOT EXISTS `pesma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(40) DEFAULT NULL,
  `stanje` varchar(20) NOT NULL,
  `putanjaDoAkorda` varchar(255) DEFAULT NULL,
  `ytLink` varchar(255) DEFAULT NULL,
  `brPregleda` int(11) NOT NULL DEFAULT '0',
  `idZanr` int(11) DEFAULT NULL,
  `idAutor` int(11) DEFAULT NULL,
  `idKor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `R_3` (`idZanr`),
  KEY `R_4` (`idAutor`),
  KEY `R_5` (`idKor`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesma`
--

INSERT INTO `pesma` (`id`, `naziv`, `stanje`, `putanjaDoAkorda`, `ytLink`, `brPregleda`, `idZanr`, `idAutor`, `idKor`) VALUES
(1, 'Civil War', 'odobrena', NULL, NULL, 12, 1, 2, NULL),
(2, '14 Years', 'odobrena', NULL, NULL, 12, 1, 2, NULL),
(3, 'Yesterdays', 'odobrena', NULL, NULL, 12, 1, 2, NULL),
(4, 'Knockin on Heavens Door', 'odobrena', NULL, NULL, 12, 1, 2, NULL),
(5, 'Get in The Ring', 'odobrena', NULL, NULL, 12, 1, 2, NULL),
(6, 'Shotgun Blueas', 'odobrena', NULL, NULL, 12, 1, 2, NULL),
(7, 'Breakdown', 'odobrena', NULL, NULL, 12, 1, 2, NULL),
(8, 'Pretty Tied Up', 'odobrena', NULL, NULL, 12, 1, 2, NULL),
(9, 'Locomotive', 'odobrena', NULL, NULL, 12, 1, 2, NULL),
(10, 'So Fine', 'odobrena', NULL, NULL, 12, 1, 2, NULL),
(11, 'Estrenged', 'odobrena', NULL, NULL, 12, 1, 2, NULL),
(12, 'You Could be mine', 'odobrena', NULL, NULL, 12, 1, 2, NULL),
(13, 'London Calling', 'odobrena', NULL, NULL, 12, 2, 13, NULL),
(14, 'I say a little a prayer', 'odobrena', NULL, NULL, 12, 3, 10, NULL),
(15, 'A natural women', 'odobrena', NULL, NULL, 12, 3, 10, NULL),
(16, 'Lepa do bola', 'odobrena', NULL, NULL, 12, 4, 12, NULL),
(17, 'Minut Dva', 'odobrena', NULL, NULL, 12, 4, 12, NULL),
(18, 'Sve je postalo pepeo i dim', 'odobrena', NULL, NULL, 12, 4, 12, NULL),
(19, 'Sunce Moje', 'odobrena', NULL, NULL, 12, 4, 12, NULL),
(20, 'Stairway To Heaven', 'odobrena', NULL, NULL, 12, 1, 11, NULL),
(21, 'Black Dog', 'odobrena', NULL, NULL, 12, 1, 11, NULL),
(22, 'To the hills and far away', 'odobrena', NULL, NULL, 12, 1, 11, NULL),
(23, 'Immigrant song', 'odobrena', NULL, NULL, 12, 1, 11, NULL),
(24, 'Kashmir', 'odobrena', NULL, NULL, 12, 1, 11, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zanr`
--

DROP TABLE IF EXISTS `zanr`;
CREATE TABLE IF NOT EXISTS `zanr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tip` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zanr`
--

INSERT INTO `zanr` (`id`, `tip`) VALUES
(1, 'Rokenrol'),
(2, 'Pank Rok'),
(3, 'Bluz'),
(4, 'Narodna'),
(5, 'Estradna');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `R_1` FOREIGN KEY (`idPes`) REFERENCES `pesma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `R_2` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pesma`
--
ALTER TABLE `pesma`
  ADD CONSTRAINT `R_3` FOREIGN KEY (`idZanr`) REFERENCES `zanr` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `R_4` FOREIGN KEY (`idAutor`) REFERENCES `autor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `R_5` FOREIGN KEY (`idKor`) REFERENCES `korisnik` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;
