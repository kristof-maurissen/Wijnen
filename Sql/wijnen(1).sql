-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 08 jan 2016 om 20:24
-- Serverversie: 10.0.17-MariaDB
-- PHP-versie: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wijnen`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE `bestelling` (
  `idbestel` int(11) NOT NULL,
  `idklant` int(11) NOT NULL,
  `besteldata` datetime NOT NULL,
  `prijstotaal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelreg`
--

CREATE TABLE `bestelreg` (
  `idbestreg` int(11) NOT NULL,
  `idwijn` int(11) NOT NULL,
  `idverpak` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `levkost` int(11) NOT NULL,
  `extra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--
-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 08 jan 2016 om 21:05
-- Serverversie: 10.0.17-MariaDB
-- PHP-versie: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wijn`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `idklant` int(11) NOT NULL,
  `naam` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `voornaam` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `straat` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `nr` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` int(11) NOT NULL,
  `gemeente` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `wachtwoord` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`idklant`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `klant`
--


CREATE TABLE `klant` (
  `idklant` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `voornaam` varchar(50) NOT NULL,
  `straat` varchar(50) NOT NULL,
  `nr` varchar(25) NOT NULL,
  `postcode` int(11) NOT NULL,
  `gemeente` varchar(50) NOT NULL,
  `wachtwoord` varchar(128) NOT NULL,
  `email` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`idklant`, `naam`, `voornaam`, `straat`, `nr`, `postcode`, `gemeente`, `wachtwoord`, `email`) VALUES
(1, 'Kristof', 'Maurissen', 'Frans van der Muerenstraat', '4', 2530, 'Boechout', 'pass', 'kristof.maurissen1@telenet.be'),
(2, 'Kristof', 'Maurissen', 'Frans van der Muerenstraat', '4', 2530, 'Boechout', 'pass', 'kristof.maurissen1@telenet.be'),
(3, 'Maurissen', 'Kristof', 'Frans van der Muerenstraat', '4', 2530, 'Boechout', 'pass', 'kriskras59@hotmail.com'),
(4, 'Achternaam', 'Voornaam', 'straatje', '1', 2000, 'Antwerpen', 'pass', 'antwerpe@antw.be'),
(5, 'fsfqf', 'sfsf', 'fdf', '4', 2540, 'dhgdg', 'pass', 'dgdgfd@hotmail.com'),
(6, 'gfg', 'dssdg', 'sgdsg', '25', 2500, 'dhh', 'pass', 'sdsd@hotmail.com'),
(7, 'sfsdfs', 'sfsdf', 'sfdf', '1', 2000, 'adsf', 'pass', 'kdkdk@telenet.be'),
(8, 'sffdf', 'sfdsfs', 'sfdsf', '2', 1200, 'dsff', 'Pass', 'sdfsd@gdgd.be'),
(9, 'sffdf', 'sfdsfs', 'sfdsf', '2', 1200, 'dsff', 'd7cd56f2a2a3f47830760edfb89946eb7b9e2cd1', 'sdfsd@gdgd.be'),
(10, 'dvd', 'dsd', 'sfs', '47', 2252, 'dsfs', '29fc23927e93fecf6ff975a49e4e11d7f7b47292', 'sfsdf@ss.be'),
(11, 'dvd', 'dsd', 'sfs', '47', 2252, 'dsfs', '29fc23927e93fecf6ff975a49e4e11d7f7b47292', 'sfsdf@ss.be'),
(12, 'sfsdf', 'sdf', 'sdfs', '47', 2530, 'sfsdf', '4ebba88e39e0169fd4c820e683461d554727e4cc', 'sfdsf@ksks.be'),
(13, 'sfsdf', 'sdf', 'sdfs', '47', 2530, 'sfsdf', '4ebba88e39e0169fd4c820e683461d554727e4cc', 'sfdsf@ksks.be');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verpakking`
--

CREATE TABLE `verpakking` (
  `idverpak` int(11) NOT NULL,
  `materiaal` varchar(50) NOT NULL,
  `aantal` int(11) NOT NULL,
  `prijs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `wijnen`
--

CREATE TABLE `wijnen` (
  `idwijn` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `jaartal` int(11) NOT NULL,
  `land` varchar(50) NOT NULL,
  `cat` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `artcode` varchar(25) NOT NULL,
  `prijs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `wijnen`
--

INSERT INTO `wijnen` (`idwijn`, `naam`, `jaartal`, `land`, `cat`, `image`, `artcode`, `prijs`) VALUES
(1, 'beaujolais', 1983, 'Frankrijk', 'rood', 'wijnrood.jpg', '190083', 75),
(4, 'Bergerac Sec A.O.P Blanc Lionel Osmin', 2013, 'Frankrijk', 'wit', '2626-1.jpg', '2626-1', 4),
(5, 'Amuse Chardonnay', 2011, 'Frankrijk', 'wit', '2521-1.jpg', '2521-1', 4),
(11, 'Beau Mayne Blanc', 2003, 'Frankrijk', 'wit', '2125.jpg', '2125', 6),
(12, 'Bel Colle Reoro Arnies', 2012, 'Italie', 'wit', '2562.jpg', '2562', 4),
(13, 'Chardonnay Redentore I.G.T. selection de Stefani', 2014, 'Italie', 'wit', '0586.jpg', '0586', 8),
(14, 'Bianco di Custoza D.O.C. Classici', 2013, 'Italie', 'wit', '258108.jpg', '258108', 6),
(16, 'Edulis Blanco D.O.C.a. Rioja', 2006, 'Spanje', 'wit', '0069.jpg', '0069', 3),
(17, 'Eira da Raia', 2012, 'Spanje', 'wit', '0705.jpg', '0705', 3),
(18, 'El Lagar de Isilla Verdejo D.O. Rueda', 2011, 'Spanje', 'wit', '0527.jpg', '0527', 5),
(19, 'Edullis Crianza D.O.C.a. Rioja', 2005, 'Spanje', 'rood', '0071.jpg', '0071', 6),
(20, 'Edulis Joven D.O.C.a. Rioja', 2011, 'Spanje', 'rood', '0073.jpg', '0073', 4),
(21, 'Tavs Jumilla seleccion', 2004, 'Spanje', 'rood', '0682-1.jpg', '0682-1', 8),
(22, 'Amuse Merlot', 2015, 'Frankrijk', 'rood', '2526-1.jpg', '2526-1', 8),
(23, 'Cahors Malbec A.O.P. Rouge Lionel', 2014, 'Frankrijk', 'rood', '2628.jpg', '2628', 11),
(24, 'Bel Colle Le Masche Barbera D Alba', 2009, 'Italie', 'rood', '25651.jpg', '2565-1', 13),
(25, 'Baccolo Appasimento Parzial I.G.T Veneto', 2011, 'Italie', 'rood', '0619.jpg', '0619', 8),
(26, 'Chianti dei Colli Senesi', 2015, 'Italie', 'rood', '0611.jpg', '0611', 6),
(27, 'Biologisch: Les Hauts Plateaux rose', 2012, 'Frankrijk', 'rose', '2502.jpg', '2502', 4),
(29, 'Cabernet de Saumur A.C. Rose', 2001, 'Frankrijk', 'rose', '6112-1.jpg', '6112-1', 5),
(30, 'Chateau DAngles Classique La Clape', 2004, 'Frankrijk', 'rose', '2516.jpg', '2516', 3),
(31, 'Bardolino Chiaretto D.O.C Classici', 2012, 'Italie', 'rose', '2584.jpg', '2584', 2),
(32, 'Il Saporito Raboso Rosato Frizzante', 2013, 'Italie', 'rose', '0610.jpg', '0610', 6),
(33, 'Galcibar Rosado', 2015, 'Spanje', 'rose', '0566.jpg', '0566', 8);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD PRIMARY KEY (`idbestel`),
  ADD KEY `idklant` (`idklant`);

--
-- Indexen voor tabel `bestelreg`
--
ALTER TABLE `bestelreg`
  ADD PRIMARY KEY (`idbestreg`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`idklant`);

--
-- Indexen voor tabel `verpakking`
--
ALTER TABLE `verpakking`
  ADD PRIMARY KEY (`idverpak`);

--
-- Indexen voor tabel `wijnen`
--
ALTER TABLE `wijnen`
  ADD PRIMARY KEY (`idwijn`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestelling`
--
ALTER TABLE `bestelling`
  MODIFY `idbestel` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `bestelreg`
--
ALTER TABLE `bestelreg`
  MODIFY `idbestreg` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
  MODIFY `idklant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT voor een tabel `verpakking`
--
ALTER TABLE `verpakking`
  MODIFY `idverpak` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `wijnen`
--
ALTER TABLE `wijnen`
  MODIFY `idwijn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
