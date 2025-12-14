-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Dec 14, 2025 at 11:49 AM
-- Wersja serwera: 8.0.44
-- Wersja PHP: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `InteligentnaSkrytka`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Archiwum`
--

CREATE TABLE `Archiwum` (
  `id_paczki` int NOT NULL,
  `id_uzytkownika` int NOT NULL,
  `id_skrytki` int DEFAULT NULL,
  `status` enum('NADANA','W_PACZKOMACIE','ODEBRANA') NOT NULL,
  `nadawca` varchar(255) DEFAULT NULL,
  `data_nadania` datetime NOT NULL,
  `data_odebrania` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Paczki`
--

CREATE TABLE `Paczki` (
  `id_paczki` int NOT NULL,
  `nr_zamowienia` bigint NOT NULL,
  `id_uzytkownika` int NOT NULL,
  `kod_odbioru` varchar(6) DEFAULT NULL,
  `id_skrytki` int DEFAULT NULL,
  `status` enum('NADANA','W_PACZKOMACIE','ODEBRANA') NOT NULL,
  `nadawca` varchar(255) DEFAULT NULL,
  `data_nadania` datetime NOT NULL,
  `data_odebrania` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Zrzut danych tabeli `Paczki`
--

INSERT INTO `Paczki` (`id_paczki`, `nr_zamowienia`, `id_uzytkownika`, `kod_odbioru`, `id_skrytki`, `status`, `nadawca`, `data_nadania`, `data_odebrania`) VALUES
(1, 5839201746, 3, '847291', 3, 'W_PACZKOMACIE', 'CCC', '2025-12-10 18:42:28', NULL),
(2, 1049583271, 4, '23156', NULL, 'NADANA', 'MODIVO SP. ZOO', '2025-12-10 18:42:28', NULL),
(3, 7926403851, 5, '519384', NULL, 'NADANA', 'Botland', '2025-12-10 18:42:28', NULL),
(5, 9304175268, 7, '382917', NULL, 'NADANA', 'Media Expert', '2025-10-15 10:30:00', NULL),
(6, 2817394056, 8, '104563', NULL, 'NADANA', 'Zalando', '2025-10-07 13:45:00', NULL),
(7, 8741205963, 9, '695820', NULL, 'W_PACZKOMACIE', 'Allegro Smart!', '2025-10-14 12:10:00', NULL),
(8, 5196830472, 10, '438271', NULL, 'NADANA', 'x-kom', '2025-10-15 08:05:00', NULL),
(9, 3627951840, 11, '956103', NULL, 'W_PACZKOMACIE', 'Reserved', '2025-10-13 19:32:00', NULL),
(10, 7405283196, 12, '271849', NULL, 'NADANA', '4F', '2025-10-01 10:05:00', NULL),
(11, 1584927036, 13, '583026', NULL, 'NADANA', 'Decathlon', '2025-10-15 11:12:00', NULL),
(12, 6973058214, 14, '914637', NULL, 'NADANA', 'H&M', '2025-10-12 15:55:00', NULL),
(13, 2431809675, 15, '362508', NULL, 'NADANA', 'Empik', '2025-09-28 09:10:00', NULL),
(14, 8057169324, 16, '728194', NULL, 'NADANA', 'Morele.net', '2025-10-14 18:42:00', NULL),
(15, 9702148563, 17, '45362', NULL, 'W_PACZKOMACIE', 'Smyk', '2025-10-13 13:05:00', NULL),
(16, 6145792308, 18, '891745', NULL, 'NADANA', 'RTV Euro AGD', '2025-10-15 07:48:00', NULL),
(17, 3280641957, 19, '206483', NULL, 'NADANA', 'Answear.com', '2025-10-14 17:30:00', NULL),
(18, 4869375201, 20, '573910', NULL, 'NADANA', 'Ceneo', '2025-10-15 12:25:00', NULL),
(19, 7591204836, 9, '689247', NULL, 'NADANA', 'Poczta Polska', '2025-10-10 10:00:00', NULL),
(20, 2356489701, 7, '134058', NULL, 'NADANA', 'Komputronik', '2025-10-15 14:45:00', NULL),
(21, 2066353005, 8, '676767', 1, 'W_PACZKOMACIE', 'Nike', '2025-12-14 11:31:36', NULL),
(22, 3026538759, 18, '903414', 2, 'W_PACZKOMACIE', 'botland', '2025-12-14 11:35:29', NULL),
(23, 2647544127, 22, '100164', NULL, 'NADANA', 'Lego', '2025-12-14 11:46:32', NULL),
(24, 5174769846, 14, '278283', NULL, 'NADANA', 'politechnika śląska', '2025-12-14 11:47:12', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Paczkomat`
--

CREATE TABLE `Paczkomat` (
  `id_skrytki` int NOT NULL,
  `rozmiar` enum('S','M','L') NOT NULL,
  `status` enum('WOLNA','ZAJETA') DEFAULT 'WOLNA'
) ;

--
-- Zrzut danych tabeli `Paczkomat`
--

INSERT INTO `Paczkomat` (`id_skrytki`, `rozmiar`, `status`) VALUES
(1, 'L', 'ZAJETA'),
(2, 'M', 'ZAJETA'),
(3, 'M', 'ZAJETA');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Uzytkownicy`
--

CREATE TABLE `Uzytkownicy` (
  `id_uzytkownika` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `rola` enum('ADMIN','KURIER','KLIENT') DEFAULT 'KLIENT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Zrzut danych tabeli `Uzytkownicy`
--

INSERT INTO `Uzytkownicy` (`id_uzytkownika`, `login`, `haslo`, `imie`, `nazwisko`, `rola`) VALUES
(1, 'admin', '1234', 'Jan', 'Nowak', 'ADMIN'),
(2, 'kurier_jan', '1234', 'Jan', 'Kowalski', 'KURIER'),
(3, 'kurier_anna', '1234', 'Anna', 'Wiśniewska', 'KURIER'),
(4, 'klient_marek', '1234', 'Marek', 'Zieliński', 'KLIENT'),
(5, 'klient_ewa', '1234', 'Ewa', 'Kamińska', 'KLIENT'),
(6, 'klient_piotr', '1234', 'Piotr', 'Lewandowski', 'KLIENT'),
(7, 'marekz', '1234', 'Marek', 'Zieliński', 'KLIENT'),
(8, 'ewak', '1234', 'Ewa', 'Kamińska', 'KLIENT'),
(9, 'piotrlew', '1234', 'Piotr', 'Lewandowski', 'KLIENT'),
(10, 'olakac', '1234', 'Ola', 'Kaczmarek', 'KLIENT'),
(11, 'tomaszd92', '1234', 'Tomasz', 'Dąbrowski', 'KLIENT'),
(12, 'kasiamz', '1234', 'Katarzyna', 'Mazur', 'KLIENT'),
(13, 'bartekw_', '1234', 'Bartosz', 'Wójcik', 'KLIENT'),
(14, 'ania.kow', '1234', 'Anna', 'Kowalczyk', 'KLIENT'),
(15, 'michalw', '1234', 'Michał', 'Woźniak', 'KLIENT'),
(16, 'magdazaj', '1234', 'Magdalena', 'Zając', 'KLIENT'),
(17, 'pawelk_', '1234', 'Paweł', 'Krawczyk', 'KLIENT'),
(18, 'agnieszas', '1234', 'Agnieszka', 'Szymańska', 'KLIENT'),
(19, 'karolkr', '1234', 'Karol', 'Król', 'KLIENT'),
(20, 'dominikw', '1234', 'Dominik', 'Witkowski', 'KLIENT'),
(21, 'martyna.p', '1234', 'Martyna', 'Pawlak', 'KLIENT'),
(22, 'lukasz83', '1234', 'Łukasz', 'Nowicki', 'KLIENT'),
(23, 'sylwiaa', '1234', 'Sylwia', 'Lis', 'KLIENT'),
(24, 'filipm', '1234', 'Filip', 'Michalski', 'KLIENT');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `Archiwum`
--
ALTER TABLE `Archiwum`
  ADD PRIMARY KEY (`id_paczki`),
  ADD UNIQUE KEY `id_paczki` (`id_paczki`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`),
  ADD KEY `id_skrytki` (`id_skrytki`);

--
-- Indeksy dla tabeli `Paczki`
--
ALTER TABLE `Paczki`
  ADD PRIMARY KEY (`id_paczki`),
  ADD UNIQUE KEY `id_paczki` (`id_paczki`),
  ADD UNIQUE KEY `nr_zamowienia` (`nr_zamowienia`),
  ADD UNIQUE KEY `kod_odbioru` (`kod_odbioru`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`),
  ADD KEY `id_skrytki` (`id_skrytki`);

--
-- Indeksy dla tabeli `Paczkomat`
--
ALTER TABLE `Paczkomat`
  ADD PRIMARY KEY (`id_skrytki`);

--
-- Indeksy dla tabeli `Uzytkownicy`
--
ALTER TABLE `Uzytkownicy`
  ADD PRIMARY KEY (`id_uzytkownika`),
  ADD UNIQUE KEY `id_uzytkownika` (`id_uzytkownika`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `Archiwum`
--
ALTER TABLE `Archiwum`
  MODIFY `id_paczki` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `Paczki`
--
ALTER TABLE `Paczki`
  MODIFY `id_paczki` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT dla tabeli `Uzytkownicy`
--
ALTER TABLE `Uzytkownicy`
  MODIFY `id_uzytkownika` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Archiwum`
--
ALTER TABLE `Archiwum`
  ADD CONSTRAINT `Archiwum_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `Uzytkownicy` (`id_uzytkownika`),
  ADD CONSTRAINT `Archiwum_ibfk_2` FOREIGN KEY (`id_skrytki`) REFERENCES `Paczkomat` (`id_skrytki`);

--
-- Ograniczenia dla tabeli `Paczki`
--
ALTER TABLE `Paczki`
  ADD CONSTRAINT `Paczki_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `Uzytkownicy` (`id_uzytkownika`),
  ADD CONSTRAINT `Paczki_ibfk_2` FOREIGN KEY (`id_skrytki`) REFERENCES `Paczkomat` (`id_skrytki`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
