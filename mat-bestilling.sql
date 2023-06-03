-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2023 at 11:52 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mat-bestilling`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_navn` varchar(100) NOT NULL,
  `brukernavn` varchar(100) NOT NULL,
  `passord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_navn`, `brukernavn`, `passord`) VALUES
(1, 'Salahudin Ahmad', 'salahudin123', 'b8144cfb56d41149bac43e2be46e0e92'),
(24, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `bestilling`
--

CREATE TABLE `bestilling` (
  `id` int(11) NOT NULL,
  `mat` varchar(150) DEFAULT NULL,
  `pris` decimal(10,2) DEFAULT NULL,
  `kvantitet` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `order_dato` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `kunde_navn` varchar(150) DEFAULT NULL,
  `kunde_kontakt` varchar(20) DEFAULT NULL,
  `kunde_epost` varchar(150) DEFAULT NULL,
  `kunde_adresse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `tittel` varchar(100) DEFAULT NULL,
  `bilde_navn` varchar(255) DEFAULT NULL,
  `utvalgte` varchar(10) DEFAULT NULL,
  `aktiv` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mat`
--

CREATE TABLE `mat` (
  `id` int(11) NOT NULL,
  `tittel` varchar(100) DEFAULT NULL,
  `beskrivelse` text DEFAULT NULL,
  `pris` decimal(10,2) DEFAULT NULL,
  `bilde_navn` varchar(255) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `utvalgte` varchar(10) DEFAULT NULL,
  `aktiv` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bestilling`
--
ALTER TABLE `bestilling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mat`
--
ALTER TABLE `mat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `bestilling`
--
ALTER TABLE `bestilling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mat`
--
ALTER TABLE `mat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
