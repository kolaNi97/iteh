-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2020 at 02:40 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bioskop`
--

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `FilmID` int(11) NOT NULL,
  `NazivFilma` varchar(255) NOT NULL,
  `Trajanje` varchar(255) NOT NULL,
  `Cena` varchar(255) NOT NULL,
  `ReziserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`FilmID`, `NazivFilma`, `Trajanje`, `Cena`, `ReziserID`) VALUES
(8, 'Matera', '150', '450', 1),
(12, 'Cao inspektore', '120', '550', 1),
(14, '1917', '118', '900', 8),
(15, '4 Ruze', '100', '600', 3),
(16, 'Ajvar', '101', '250', 5),
(17, 'Dulitl', '96', '1100', 7),
(18, 'Džoker', '122', '800', 6),
(19, 'Džumandži - Slede?i nivo', '123', '700', 8),
(20, 'Invazija', '129', '600', 6),
(21, 'Kletva', '94', '450', 7),
(22, 'Losi momci zauvek', '113', '500', 2),
(24, 'Misija - Arktik', '95', '320', 6),
(25, 'Noz u ledja', '130', '540', 6),
(26, 'One su bombe', '108', '430', 8),
(27, 'Parazit', '132', '640', 5),
(28, 'Patrolne sape', '67', '230', 1),
(29, 'Preruseni spijuni', '102', '500', 6),
(30, 'Proslog bozica', '102', '600', 4),
(31, 'Proslog bozica', '102', '600', 4),
(32, 'Sisanje', '103', '350', 4);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id_korisnika` int(10) NOT NULL,
  `ime` varchar(15) COLLATE utf8_croatian_ci NOT NULL,
  `prezime` varchar(25) COLLATE utf8_croatian_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_croatian_ci NOT NULL,
  `telefon` varchar(15) COLLATE utf8_croatian_ci NOT NULL,
  `username` varchar(25) COLLATE utf8_croatian_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `status` varchar(25) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnika`, `ime`, `prezime`, `email`, `telefon`, `username`, `password`, `status`) VALUES
(35, 'Nikola', 'Jevtovic', 'nidza@gmail.com', '061233333', 'nidza', 'f75c03fd548bba16dbef5cad4fc895ca', 'Korisnik'),
(36, 'bojan', 'bojan', 'bojan@gmail.com', '0613222666', 'bojan', '2a89afb221c007c2723065886371e4c9', 'Admin'),
(37, 'Nikola', 'Jevtovic', 'jevta@gmail.com', '064396120', 'jevta', '293a72b65db44d0693320d6d20820d5f', 'Admin'),
(38, 'Milos', 'Petrovic', 'milos@gmail.com', '061234568', 'milos', 'b82753180960205a4a62feff9c0f93f5', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `kupovina`
--

CREATE TABLE `kupovina` (
  `KupovinaID` int(11) NOT NULL,
  `KorisnikID` int(11) NOT NULL,
  `RezervacijaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kupovina`
--

INSERT INTO `kupovina` (`KupovinaID`, `KorisnikID`, `RezervacijaID`) VALUES
(2, 34, 2),
(3, 35, 2),
(4, 35, 3),
(5, 35, 2),
(6, 35, 14);

-- --------------------------------------------------------

--
-- Table structure for table `mesto`
--

CREATE TABLE `mesto` (
  `MestoID` int(10) NOT NULL,
  `SalaID` int(10) NOT NULL,
  `Red` int(10) NOT NULL,
  `BrojSedista` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mesto`
--

INSERT INTO `mesto` (`MestoID`, `SalaID`, `Red`, `BrojSedista`) VALUES
(1, 1, 3, 45);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `RezervacijaID` int(11) NOT NULL,
  `Datum` varchar(255) NOT NULL,
  `FilmID` int(10) NOT NULL,
  `MestoID` int(10) NOT NULL,
  `SalaID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`RezervacijaID`, `Datum`, `FilmID`, `MestoID`, `SalaID`) VALUES
(2, '18.12.2020. 18:50', 8, 1, 1),
(3, '17. 01. 2020. 19:15', 14, 1, 1),
(4, '17. 01. 2020. 21:40', 16, 1, 1),
(5, '17. 01. 2020. 14:00', 17, 1, 1),
(6, '18. 01. 2020. 19:15', 14, 1, 1),
(7, '18. 01. 2020. 21:40', 16, 1, 1),
(8, '18. 01. 2020. 13:05', 19, 1, 1),
(9, '18. 01. 2020. 11:30', 24, 1, 1),
(10, '19. 01. 2020. 19:15', 14, 1, 1),
(11, '19. 01. 2020. 22:40', 20, 1, 1),
(12, '19. 01. 2020. 17:00', 22, 1, 1),
(13, '19. 01. 2020. 11:30', 24, 1, 1),
(14, '20. 01. 2020. 18:45', 19, 1, 1),
(15, '20. 01. 2020. 15:30', 17, 1, 1),
(16, '20. 01. 2020. 21:10', 20, 1, 1),
(17, '20. 01. 2020. 15:15', 29, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reziser`
--

CREATE TABLE `reziser` (
  `ReziserID` int(10) NOT NULL,
  `Ime` char(150) NOT NULL,
  `Prezime` char(150) NOT NULL,
  `Drzava` char(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reziser`
--

INSERT INTO `reziser` (`ReziserID`, `Ime`, `Prezime`, `Drzava`) VALUES
(1, 'Bojan', 'Djekic', 'Srbija'),
(2, 'Nikola', 'Jokic', 'Kanada'),
(3, 'Sam', 'Mendes', 'USA'),
(4, 'Vasilije', 'Nikotovic', 'Srbija'),
(5, 'Ana Maria', 'Rossi', 'Italia'),
(6, 'Stephen', 'Gaghan', 'Usa'),
(7, 'Tood', 'Phillips', 'Usa'),
(8, 'Jake', 'Kasdan', 'USa');

-- --------------------------------------------------------

--
-- Table structure for table `sala`
--

CREATE TABLE `sala` (
  `SalaID` int(10) NOT NULL,
  `NazivSale` char(150) NOT NULL,
  `BrojMesta` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sala`
--

INSERT INTO `sala` (`SalaID`, `NazivSale`, `BrojMesta`) VALUES
(1, 'Sala1', 223);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`FilmID`),
  ADD KEY `ReziserID` (`ReziserID`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id_korisnika`);

--
-- Indexes for table `kupovina`
--
ALTER TABLE `kupovina`
  ADD PRIMARY KEY (`KupovinaID`,`KorisnikID`,`RezervacijaID`),
  ADD KEY `RezervacijaID` (`RezervacijaID`),
  ADD KEY `kupovina_ibfk_2` (`KorisnikID`);

--
-- Indexes for table `mesto`
--
ALTER TABLE `mesto`
  ADD PRIMARY KEY (`MestoID`,`SalaID`),
  ADD KEY `slabObject` (`SalaID`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`RezervacijaID`,`Datum`,`FilmID`,`MestoID`,`SalaID`),
  ADD KEY `MestoID` (`MestoID`),
  ADD KEY `SalaID` (`SalaID`),
  ADD KEY `FilmID` (`FilmID`);

--
-- Indexes for table `reziser`
--
ALTER TABLE `reziser`
  ADD PRIMARY KEY (`ReziserID`);

--
-- Indexes for table `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`SalaID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `FilmID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id_korisnika` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `kupovina`
--
ALTER TABLE `kupovina`
  MODIFY `KupovinaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `RezervacijaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reziser`
--
ALTER TABLE `reziser`
  MODIFY `ReziserID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`ReziserID`) REFERENCES `reziser` (`ReziserID`);

--
-- Constraints for table `mesto`
--
ALTER TABLE `mesto`
  ADD CONSTRAINT `slabObject` FOREIGN KEY (`SalaID`) REFERENCES `sala` (`SalaID`);

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `rezervacija_ibfk_3` FOREIGN KEY (`MestoID`) REFERENCES `mesto` (`MestoID`),
  ADD CONSTRAINT `rezervacija_ibfk_4` FOREIGN KEY (`SalaID`) REFERENCES `sala` (`SalaID`),
  ADD CONSTRAINT `rezervacija_ibfk_5` FOREIGN KEY (`FilmID`) REFERENCES `film` (`FilmID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
