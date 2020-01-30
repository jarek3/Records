-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 29. led 2020, 07:54
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

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `role` enum('member','admin') COLLATE utf8_czech_ci NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role`) VALUES
(3, 'Jaroslav Patrný', '$2y$10$UhAiT30VEaOSbSe7d/H2DOiGOk81WJQeiZUgBHQuTpiOV0xRkDt4.', 'admin');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `kosmonauti`
--
ALTER TABLE `kosmonauti`
  ADD PRIMARY KEY (`kosmonaut_id`);

--
-- Klíče pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`) USING BTREE;

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `kosmonauti`
--
ALTER TABLE `kosmonauti`
  MODIFY `kosmonaut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
