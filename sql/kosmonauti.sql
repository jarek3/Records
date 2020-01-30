-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 29. led 2020, 07:55
-- Verze serveru: 10.4.10-MariaDB
-- Verze PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `kosmonauti`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `kosmonauti`
--

CREATE TABLE `kosmonauti` (
  `kosmonaut_id` int(11) NOT NULL,
  `jmeno` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `prijmeni` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `datum_narozeni` date NOT NULL,
  `superschopnost` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `kosmonauti`
--

INSERT INTO `kosmonauti` (`kosmonaut_id`, `jmeno`, `prijmeni`, `datum_narozeni`, `superschopnost`) VALUES
(4, 'Josef', 'Remek', '1973-01-12', 'telepatie'),
(6, 'Vladimír', 'Remek', '1950-04-15', 'houževnatost'),
(7, 'Jan', 'Nový', '1997-02-21', '');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `kosmonauti`
--
ALTER TABLE `kosmonauti`
  ADD PRIMARY KEY (`kosmonaut_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `kosmonauti`
--
ALTER TABLE `kosmonauti`
  MODIFY `kosmonaut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
