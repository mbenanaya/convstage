-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2023 at 02:07 PM
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
-- Database: `convstage`
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
('Mouhcine', 'mmouhcine203@gmail.com', '112233');

-- --------------------------------------------------------

--
-- Table structure for table `convention`
--

CREATE TABLE `convention` (
  `idConv` varchar(200) NOT NULL,
  `cne` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `diplome` varchar(15) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `nomEntr` varchar(50) NOT NULL,
  `adrEntr` varchar(100) NOT NULL,
  `telEntr` varchar(20) NOT NULL,
  `nomEncd` varchar(30) NOT NULL,
  `datedebut` date NOT NULL,
  `datefin` date NOT NULL,
  `idEntr` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `convention`
--

INSERT INTO `convention` (`idConv`, `cne`, `nom`, `prenom`, `diplome`, `intitule`, `description`, `nomEntr`, `adrEntr`, `telEntr`, `nomEncd`, `datedebut`, `datefin`, `idEntr`) VALUES
('G135336417_03-04-2023_00:39:31', 'G135336417', 'TAMASNA', 'karim', 'AMTMAAV', 'Application d\'emploi du temps', 'Application d\'emploi du temps', 'OG Communication', 'Marrakech', '0511223344', 'Oualid', '2023-04-03', '2023-04-27', 3),
('G135336418_03-04-2023_00:58:33', 'G135336418', 'NAIM', 'maryam', 'AMTSDAD', 'Site web d\'ecommerce', 'Site web d\'ecommerce', 'QuickTech', 'Marrakech', '05 24 44 73 88', 'Ghizlane', '2023-04-18', '2023-05-02', 5),
('G135336419_03-04-2023_01:16:53', 'G135336419', 'alia', 'ABDELMAJID', 'AMTEXVG', 'Site web d\'ecommerce', 'Site web d\'ecommerce', 'Onestcom', 'Marrakech', '0511223344', 'Khalid', '2023-04-04', '2023-04-22', 2),
('G135336421_03-04-2023_00:24:01', 'G135336421', 'HAMIDI', 'Abdelilah', 'ALTBICG', 'Application d\'emploi du temps', 'Application d\'emploi du temps', 'Eysi', 'Marrakech', '0511223344', 'Elhassan', '2023-04-04', '2023-04-20', 1),
('G135336424_03-04-2023_00:38:07', 'G135336424', 'KASSI', 'Najia', 'AMTEXVG', 'Site web d\'ecommerce', 'Site web d\'ecommerce', 'Onestcom', 'Marrakech', '0511223344', 'Khalid', '2023-04-26', '2023-05-06', 2),
('G135336440_03-04-2023_11:59:53', 'G135336440', 'ELMOUHI', 'Youness', 'ADIIGC', 'Application d\'emploi du temps', 'Application d\'emploi du temps', 'Eureka', 'Marrakech', '0511223344', 'Kamal', '2023-04-05', '2023-04-29', 12),
('G135336440_03-04-2023_12:02:33', 'G135336440', 'ELMOUHI', 'Youness', 'ADIIGC', 'Application d\'emploi du temps', 'Application d\'emploi du temps', 'Onestcom', 'Marrakech', '0511223344', 'Khalid', '2023-04-05', '2023-04-27', 2),
('G135336440_03-04-2023_12:05:43', 'G135336440', 'ELMOUHI', 'Youness', 'ADIIGC', 'Application d\'emploi du temps', 'Application d\'emploi du temps', 'Eysi', 'Marrakech', '0511223344', 'Elhassan', '2023-04-10', '2023-04-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `entreprise`
--

CREATE TABLE `entreprise` (
  `idEntr` int(10) NOT NULL,
  `nomEntr` varchar(50) NOT NULL,
  `adrEntr` varchar(100) NOT NULL,
  `telEntr` varchar(20) NOT NULL,
  `nomEncd` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entreprise`
--

INSERT INTO `entreprise` (`idEntr`, `nomEntr`, `adrEntr`, `telEntr`, `nomEncd`) VALUES
(1, 'Eysi', 'Marrakech', '0511223344', 'Elhassan'),
(2, 'Onestcom', 'Marrakech', '0511223344', 'Khalid'),
(3, 'OG Communication', 'Marrakech', '0511223344', 'Oualid'),
(4, 'Taktil', 'Marrakech', '0511223344', 'Kamal'),
(5, 'QuickTech', 'Marrakech', '05 24 44 73 88', 'Ghizlane'),
(12, 'Eureka', 'Marrakech', '0511223344', 'Kamal');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `apogee` int(7) DEFAULT NULL,
  `cne` varchar(20) NOT NULL,
  `cin` varchar(10) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `datenaissance` varchar(8) NOT NULL,
  `diplome` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`apogee`, `cne`, `cin`, `nom`, `prenom`, `sex`, `datenaissance`, `diplome`) VALUES
(1417386, 'G135336417', 'EE843992', 'TAMASNA', 'karim', 'M', '01/09/98', 'AMTMAAV'),
(1417387, 'G135336418', 'EE843993', 'NAIM', 'maryam', 'F', '26/03/99', 'AMTSDAD'),
(1417388, 'G135336419', 'EE843994', 'alia', 'ABDELMAJID', 'M', '07/10/99', 'AMTEXVG'),
(1417389, 'G135336420', 'EE843995', 'HAMIDI', 'Ahmed', 'M', '25/01/99', 'AMTMCSM'),
(1417390, 'G135336421', 'EE843996', 'HAMIDI', 'Abdelilah', 'M', '25/01/99', 'ALTBICG'),
(1417392, 'G135336423', 'EE843998', 'BENALI', 'Marwa', 'F', '25/01/99', 'ADIISA'),
(1417393, 'G135336424', 'EE843999', 'KASSI', 'Najia', 'F', '25/01/99', 'AMTEXVG'),
(1417394, 'G135336425', 'EE844000', 'Janah', 'Mostapha', 'M', '25/01/99', 'ALTBICG'),
(1417396, 'G135336427', 'EE844002', 'ELGHAZOUANI', 'Mohammed', 'M', '25/01/99', 'AMTMIAI'),
(1417398, 'G135336429', 'EE844004', 'BEN-ANAYA', 'Mouhcine', 'M', '25/01/99', 'ALTMIPC'),
(1417400, 'G135336431', 'EE844006', 'SAIR', 'Maryem', 'F', '25/01/99', 'ADERME '),
(1417401, 'G135336432', 'EE844007', 'SABIR', 'Issam', 'M', '25/01/99', 'AMTGEAA'),
(1417402, 'G135336433', 'EE844008', 'EL GHAZI', 'Yahya', 'M', '25/01/99', 'ADIGMP'),
(1417403, 'G135336434', 'EE844009', 'MHIDRA', 'Hafsa', 'F', '25/01/99', 'AMTRDPS'),
(1417405, 'G135336436', 'EE844011', 'BAKHAR', 'Othmane', 'M', '25/01/99', 'AMTSDAD'),
(1417406, 'G135336437', 'EE844012', 'FALLAH', 'Adil', 'M', '25/01/99', 'AMTMMEA'),
(1417407, 'G135336438', 'EE844013', 'LOUIZI', 'Soufiane', 'M', '25/01/99', 'AMTMAAV'),
(1417408, 'G135336439', 'EE844014', 'AIT HMAD', 'Fatima-Ezzahra', 'F', '25/01/99', 'AMTPSNB'),
(1417409, 'G135336440', 'EE844015', 'ELMOUHI', 'Youness', 'M', '25/01/99', 'ADIIGC'),
(1417410, 'G135336441', 'EE844016', 'LAFHAL', 'Khalid', 'M', '25/01/99', 'ADIIRIS'),
(1417411, 'G135336442', 'EE844017', 'LAAFAR', 'Issam', 'M', '25/01/99', 'ALTMAIP'),
(1417412, 'G135336443', 'EE844018', 'RAIS', 'Samira', 'F', '25/01/99', 'AMTBIOV'),
(1417413, 'G135336444', 'EE844019', 'LAHRACH', 'Mohammed', 'M', '25/01/99', 'AMTRDPS'),
(1417414, 'G135336445', 'EE844020', 'TAABAN', 'Ilham', 'F', '25/01/99', 'AMTMDIM');

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
  ADD PRIMARY KEY (`idConv`),
  ADD KEY `Fk_etud` (`cne`),
  ADD KEY `Fk_entr` (`idEntr`);

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

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `idEntr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `convention`
--
ALTER TABLE `convention`
  ADD CONSTRAINT `Fk_entr` FOREIGN KEY (`idEntr`) REFERENCES `entreprise` (`idEntr`),
  ADD CONSTRAINT `Fk_etud` FOREIGN KEY (`cne`) REFERENCES `etudiant` (`cne`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
