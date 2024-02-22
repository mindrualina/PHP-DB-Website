-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1:3306
-- Timp de generare: ian. 07, 2024 la 12:04 PM
-- Versiune server: 10.4.32-MariaDB
-- Versiune PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Bază de date: `colocviu`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `catalog`
--

CREATE TABLE `catalog` (
  `idf` int(11) NOT NULL,
  `idp` int(11) NOT NULL,
  `pret` decimal(10,2) NOT NULL CHECK (`pret` > 0),
  `moneda` enum('USD','EUR','RON') NOT NULL DEFAULT 'EUR'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `catalog`
--

INSERT INTO `catalog` (`idf`, `idp`, `pret`, `moneda`) VALUES
(1, 120, 99.20, 'EUR'),
(2, 2, 6.00, 'EUR'),
(2, 102, 15.00, 'EUR'),
(2, 112, 75.00, 'EUR'),
(2, 124, 150.00, 'EUR'),
(5, 123, 25.00, 'EUR'),
(6, 107, 10.00, 'EUR'),
(7, 121, 8.00, 'EUR'),
(8, 118, 13.50, 'EUR'),
(9, 2, 12.00, 'EUR'),
(9, 115, 7.50, 'EUR'),
(9, 125, 9.00, 'EUR'),
(11, 119, 148.50, 'EUR'),
(12, 11, 3.00, 'EUR'),
(12, 104, 35.00, 'EUR'),
(14, 113, 45.00, 'EUR'),
(14, 117, 39.50, 'EUR'),
(15, 11, 2.50, 'EUR'),
(16, 101, 16.30, 'EUR'),
(18, 125, 27.80, 'EUR'),
(101, 2, 2.50, 'EUR'),
(101, 112, 13.00, 'EUR'),
(101, 124, 25.00, 'EUR'),
(102, 111, 21.50, 'EUR'),
(102, 116, 11.00, 'EUR'),
(103, 122, 30.00, 'EUR');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `comenzi`
--

CREATE TABLE `comenzi` (
  `idc` int(11) NOT NULL,
  `idf` int(11) NOT NULL,
  `idp` int(11) NOT NULL,
  `cantitate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `comenzi`
--

INSERT INTO `comenzi` (`idc`, `idf`, `idp`, `cantitate`) VALUES
(11, 9, 2, 110),
(11, 9, 125, 75),
(12, 2, 2, 234),
(12, 2, 102, 55),
(12, 2, 112, 35),
(15, 101, 2, 199),
(15, 101, 112, 35),
(15, 101, 124, 22),
(16, 103, 122, 15),
(17, 102, 116, 69),
(18, 7, 121, 250),
(1001, 18, 125, 75),
(1002, 102, 111, 27),
(1003, 14, 117, 60),
(1004, 16, 101, 202),
(1005, 9, 125, 301),
(1117, 1, 120, 70),
(1119, 5, 123, 220),
(1122, 9, 2, 300);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `furnizori`
--

CREATE TABLE `furnizori` (
  `idf` int(11) NOT NULL,
  `numef` varchar(255) NOT NULL,
  `adresa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `furnizori`
--

INSERT INTO `furnizori` (`idf`, `numef`, `adresa`) VALUES
(1, 'Materom', 'Cluj-Napoca, Strada Frunzisului, Nr. 88'),
(2, 'Autonet', 'Satu Mare, Strada Aurel Vlaicu, Nr. 78'),
(3, 'Electro Parts', 'Bucuresti, Strada Electronicii, Nr. 123'),
(4, 'Build Materials', 'Iasi, Strada Materialelor, Nr. 101'),
(5, 'Green Gadgets', 'Brasov, Strada Ecologica, Nr. 202'),
(6, 'TechSupplies', 'Timisoara, Strada Tehnologiei, Nr. 789'),
(7, 'Ad Auto Total', 'Bucuresti, Blv. Splaiul Unirii, Nr. 96'),
(8, 'Inter Cars Romania ', 'Cluj-Napoca, Strada Campul Painii, Nr. 3'),
(9, 'Bosch', 'Jucu, Strada Robert Bosch, Nr. 1'),
(10, 'TRW Automotive', 'Timisoara, Strada Macin, Nr. 16'),
(11, 'Schaeffler', 'Brasov, Aleea Schaeffler, Nr. 3'),
(12, 'Unix Auto', 'Cluj-Napoca, Strada Fabricii, Nr. 118'),
(13, 'Augsburg International Impex', 'Cluj-Napoca, Strada Tabacarilor, Nr. 19'),
(14, 'Conex Distribution', 'Cluj-Napoca, Strada Orastiei, Nr. 10'),
(15, 'Continental', 'Sibiu, Strada Salzburg, Nr. 8'),
(16, 'Philips', 'Bucuresti, Soseaua Pipera, Nr. 48'),
(17, 'Hyundai', 'Sannicoara, Strada Clujului, Nr. 15'),
(18, 'Bendix', 'Bacau, Strada Republicii, Nr. 204'),
(19, 'Isuzu', 'Floresti, Strada Avram Iancu, Nr. 402'),
(20, 'Mercedes-Benz', 'Cluj-Napoca, Calea Turzii, Nr. 172'),
(101, 'Valeo', 'Saint-Denis Cedex, Strada Pleyel, Nr. 70'),
(102, 'MANN-FILTER', 'Ludwigsburg, Strada Schwieberdinger Straße, Nr. 126'),
(103, 'Redaelli Ricambi', 'Via per Dolzago, Oggiono LC, Nr. 59');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `piese`
--

CREATE TABLE `piese` (
  `idp` int(11) NOT NULL,
  `numep` varchar(255) NOT NULL,
  `culoare` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `piese`
--

INSERT INTO `piese` (`idp`, `numep`, `culoare`) VALUES
(1, 'surub', 'argintiu'),
(2, 'rulment', 'negru'),
(3, 'fulie', 'auriu'),
(4, 'piulita', 'alb'),
(11, 'balama', 'auriu'),
(101, 'arc', 'galben'),
(102, 'roata dintata', 'negru'),
(103, 'bucsa', 'rosu'),
(104, 'ax', 'gri'),
(105, 'capac', 'portocaliu'),
(106, 'placa de baza', 'maro'),
(107, 'inel de etansare', 'negru'),
(111, 'cilindru hidraulic', 'gri'),
(112, 'dinte de angrenaj', 'argintiu'),
(113, 'garnitura', 'rosu'),
(114, 'arc de compresie', 'auriu'),
(115, 'ventil', 'albastru'),
(116, 'maneta', 'portocaliu'),
(117, 'flansa', 'verde'),
(118, 'sonda temperatura', 'negru'),
(119, 'traductor presiune', 'alb'),
(120, 'disc frana', 'argintiu'),
(121, 'bujie', 'portocaliu'),
(122, 'filtru de ulei', 'negru'),
(123, 'pompa de apa', 'albastru'),
(124, 'radiator', 'argintiu'),
(125, 'piulita hexagonala', 'alb');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`idf`,`idp`),
  ADD KEY `idp` (`idp`);

--
-- Indexuri pentru tabele `comenzi`
--
ALTER TABLE `comenzi`
  ADD PRIMARY KEY (`idc`,`idf`,`idp`),
  ADD UNIQUE KEY `idc` (`idc`,`idf`,`idp`,`cantitate`),
  ADD KEY `idp` (`idp`),
  ADD KEY `idf` (`idf`,`idp`);

--
-- Indexuri pentru tabele `furnizori`
--
ALTER TABLE `furnizori`
  ADD PRIMARY KEY (`idf`);

--
-- Indexuri pentru tabele `piese`
--
ALTER TABLE `piese`
  ADD PRIMARY KEY (`idp`);

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `catalog`
--
ALTER TABLE `catalog`
  ADD CONSTRAINT `catalog_ibfk_1` FOREIGN KEY (`idf`) REFERENCES `furnizori` (`idf`),
  ADD CONSTRAINT `catalog_ibfk_2` FOREIGN KEY (`idp`) REFERENCES `piese` (`idp`);

--
-- Constrângeri pentru tabele `comenzi`
--
ALTER TABLE `comenzi`
  ADD CONSTRAINT `comenzi_ibfk_1` FOREIGN KEY (`idf`) REFERENCES `furnizori` (`idf`),
  ADD CONSTRAINT `comenzi_ibfk_2` FOREIGN KEY (`idp`) REFERENCES `piese` (`idp`),
  ADD CONSTRAINT `comenzi_ibfk_3` FOREIGN KEY (`idf`,`idp`) REFERENCES `catalog` (`idf`, `idp`);
COMMIT;



