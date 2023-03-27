-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 12, 2023 at 05:01 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `convention`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `email`, `password`) VALUES
('mba', 'bamouhcine91@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `convention`
--

CREATE TABLE `convention` (
  `idConv` int(11) NOT NULL,
  `datedebut` date NOT NULL,
  `datefin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `entreprise`
--

CREATE TABLE `entreprise` (
  `idEntr` int(10) NOT NULL,
  `nomEntr` varchar(50) NOT NULL,
  `adrEntr` varchar(10) NOT NULL,
  `telEntr` varchar(10) NOT NULL,
  `nomEncd` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entreprise`
--

INSERT INTO `entreprise` (`idEntr`, `nomEntr`, `adrEntr`, `telEntr`, `nomEncd`) VALUES
(1, 'Eysi', 'Massira', '0511223344', 'Elhassan'),
(2, 'Onestcom', 'Gueliz', '0511223344', 'Khalid'),
(3, 'OG Communication', 'Al Massar', '0511223344', 'Oualid'),
(4, 'Taktil', 'Gueliz', '0511223344', 'Kamal');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `cne` varchar(20) NOT NULL,
  `apogee` int(7) DEFAULT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `cin` varchar(10) NOT NULL,
  `datenaiss` date NOT NULL,
  `diplome` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`cne`, `apogee`, `nom`, `prenom`, `cin`, `datenaiss`, `diplome`, `email`) VALUES
('G11223344', 199924, 'BEN-ANAYA', 'Mouhcine', 'Y112233', '1999-01-25', 'DEVOWFS', 'bamouhcine91@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `convention`
--
ALTER TABLE `convention`
  ADD PRIMARY KEY (`idConv`);

--
-- Indexes for table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`idEntr`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`cne`),
  ADD UNIQUE KEY `cin` (`cin`),
  ADD UNIQUE KEY `apogee` (`apogee`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
