-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Lis 2019, 14:50
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mydb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cwiczenia`
--

CREATE TABLE `cwiczenia` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(45) NOT NULL,
  `opis` varchar(255) NOT NULL,
  `id_trener` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `cwiczenia`
--

INSERT INTO `cwiczenia` (`id`, `nazwa`, `opis`, `id_trener`) VALUES
(2, 'pompki', 'pełne', 8),
(3, 'Brzuszki', 'Bez dotykania podłogi', 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dania`
--

CREATE TABLE `dania` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(45) NOT NULL,
  `kalorycznosc` int(11) DEFAULT NULL,
  `opis` varchar(255) NOT NULL,
  `id_trener` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `dania`
--

INSERT INTO `dania` (`id`, `nazwa`, `kalorycznosc`, `opis`, `id_trener`) VALUES
(2, 'Kurczak z ryżem', 500, 'Kurczak najlepiej nie z patelni', 8),
(5, 'Sałatka gyros', 300, 'Przepis znajdziesz tutaj:...', 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `diety`
--

CREATE TABLE `diety` (
  `dania_id` int(11) NOT NULL,
  `plany_dnia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `diety`
--

INSERT INTO `diety` (`dania_id`, `plany_dnia_id`) VALUES
(2, 71),
(2, 72),
(5, 69),
(5, 71);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `plany_dnia`
--

CREATE TABLE `plany_dnia` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `id_uzytkownik` int(11) NOT NULL,
  `id_trener` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `plany_dnia`
--

INSERT INTO `plany_dnia` (`id`, `data`, `id_uzytkownik`, `id_trener`) VALUES
(69, '2019-11-22', 10, 8),
(70, '2019-11-29', 10, 8),
(71, '2019-11-25', 13, 8),
(72, '2019-11-26', 13, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `prosby`
--

CREATE TABLE `prosby` (
  `id` int(11) NOT NULL,
  `id_uzytkownik` int(11) NOT NULL,
  `id_trener` int(11) NOT NULL,
  `akceptacja` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `prosby`
--

INSERT INTO `prosby` (`id`, `id_uzytkownik`, `id_trener`, `akceptacja`) VALUES
(7, 10, 8, 'tak'),
(8, 13, 8, 'tak'),
(9, 15, 8, 'tak');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rozmowy`
--

CREATE TABLE `rozmowy` (
  `id` int(11) NOT NULL,
  `id_uzytkownik` int(11) NOT NULL,
  `id_trener` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `rozmowy`
--

INSERT INTO `rozmowy` (`id`, `id_uzytkownik`, `id_trener`) VALUES
(2, 13, 8),
(3, 15, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sesje`
--

CREATE TABLE `sesje` (
  `id` varchar(50) NOT NULL,
  `id_uzytkownik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `treningi`
--

CREATE TABLE `treningi` (
  `plany_dnia_id` int(11) NOT NULL,
  `cwiczenia_id` int(11) NOT NULL,
  `liczba_serii` int(11) DEFAULT NULL,
  `liczba_powtorzen` int(11) DEFAULT NULL,
  `obciazenie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `treningi`
--

INSERT INTO `treningi` (`plany_dnia_id`, `cwiczenia_id`, `liczba_serii`, `liczba_powtorzen`, `obciazenie`) VALUES
(69, 2, 4, 15, NULL),
(69, 3, 4, 10, NULL),
(71, 2, 4, 15, NULL),
(71, 3, 4, 15, NULL),
(72, 2, 5, 10, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `imie` varchar(45) DEFAULT NULL,
  `nazwisko` varchar(45) DEFAULT NULL,
  `wiek` date DEFAULT NULL,
  `doswiadczenie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `email`, `status`, `imie`, `nazwisko`, `wiek`, `doswiadczenie`) VALUES
(8, 'admin', '$2y$10$BZ9Jc8s0CqPkvx2wSsaZqusi1yxTVTpXKVAnUL5pm47oDgH0UXeaG', 'admin@admin.pl', 'Trener', 'Jan', 'Kowalski', '1996-10-20', NULL),
(10, 'nowy', 'nowehaslo', 'nowy@admin.pl', 'Podopieczny', 'Adam', 'Nowak', NULL, NULL),
(11, 'bartek', '$2y$10$DRzfTk6RE87IqLpsMZJdr.5qOoNcb7fVyzopTHYo4MCDWzNqzmz/6', 'bartek@o2.pl', 'Podopieczny', 'Bartek', NULL, NULL, NULL),
(12, 'test', '$2y$10$DJxYZgZh3zBuBxAAuHPRc./qiBAud7gfa9pz3ESqI1/B/W9D8DWi2', 'test@admin.pl', 'Podopieczny', 'Paweł', 'Kozioł', NULL, NULL),
(13, 'podopieczny1', '$2y$10$K1GqrHfwcvFd8jiFAXEKMOKV8rV7IGb5AU5TKz0eFhpc8jT1G1n1S', 'podopieczny1@strona.pl', 'Podopieczny', 'Michał', 'Szpak', '2017-03-20', NULL),
(14, 'trener1', '$2y$10$ln1oikt232B8AtczKjOI3e/ywWNuBnai6uwYvul74dhf3SGXDhNOO', 'trener1@strona.pl', 'Trener', NULL, NULL, NULL, NULL),
(15, 'podopieczny2', '$2y$10$krHNlG8WAyOX6NGgTy0kiOp9MnXuu1DJ4IRz1.aJJykJb5l5PIEe6', 'podopieczny2@strona.pl', 'Podopieczny', 'Ktos', 'Tam', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wiadomosci`
--

CREATE TABLE `wiadomosci` (
  `id` int(11) NOT NULL,
  `id_uzytkownik` int(11) NOT NULL,
  `id_rozmowa` int(11) NOT NULL,
  `tresc` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `przeczytane` varchar(3) NOT NULL DEFAULT 'nie'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `wiadomosci`
--

INSERT INTO `wiadomosci` (`id`, `id_uzytkownik`, `id_rozmowa`, `tresc`, `data`, `przeczytane`) VALUES
(2, 13, 2, 'Elo mordo', '2019-11-26 00:00:00', 'tak'),
(4, 8, 2, 'test123', '2019-11-26 15:00:00', 'tak'),
(5, 8, 2, 'test1234', '2019-11-26 18:00:00', 'tak'),
(6, 13, 2, 'test12346575867', '2019-11-25 10:00:00', 'tak'),
(7, 13, 2, 'Testowa wiadomosc', '2019-11-27 11:22:21', 'tak'),
(8, 13, 2, 'Testowa wiadomosc2', '2019-11-27 11:25:49', 'tak'),
(9, 13, 2, 'Testowa wiadomosc3', '2019-11-27 12:29:44', 'tak'),
(10, 8, 2, 'Testowa wiadomosc4', '2019-11-27 12:39:09', 'tak'),
(11, 8, 2, 'Testowa wiadomosc5', '2019-11-27 12:39:37', 'tak'),
(12, 8, 2, 'Testowa wiadomosc6', '2019-11-27 12:39:39', 'tak'),
(13, 8, 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', '2019-11-27 12:40:40', 'tak'),
(14, 8, 2, '123Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley', '2019-11-27 16:13:28', 'tak'),
(15, 8, 2, 'Testowa wiadomosc6', '2019-11-27 16:16:41', 'tak'),
(16, 8, 2, 'Cześć Marcin', '2019-11-27 16:17:44', 'tak'),
(17, 8, 2, 'wiadomosc ze strony', '2019-11-27 17:41:50', 'tak'),
(18, 8, 2, 'wiadomosc ze strony', '2019-11-27 17:42:19', 'tak'),
(19, 8, 2, 'druga wiadomosc', '2019-11-27 17:46:14', 'tak'),
(20, 13, 2, 'dziala', '2019-11-27 17:46:34', 'tak'),
(21, 8, 2, 'cos tam', '2019-11-27 17:49:23', 'tak'),
(22, 8, 2, 'kolejny test', '2019-11-27 17:50:00', 'tak'),
(23, 8, 2, 'testtt', '2019-11-27 17:50:35', 'tak'),
(24, 13, 2, 'dziala', '2019-11-27 17:52:03', 'nie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wymiary`
--

CREATE TABLE `wymiary` (
  `id` int(11) NOT NULL,
  `id_uzytkownik` int(11) NOT NULL,
  `waga` float DEFAULT NULL,
  `wzrost` int(11) DEFAULT NULL,
  `obwod_klatka` float DEFAULT NULL,
  `obwod_biceps` float DEFAULT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `wymiary`
--

INSERT INTO `wymiary` (`id`, `id_uzytkownik`, `waga`, `wzrost`, `obwod_klatka`, `obwod_biceps`, `data`) VALUES
(1, 8, 80, 190, 60, 30, '2019-11-12'),
(2, 8, 82, 190, 80, 35, '2019-11-11'),
(3, 8, 79, 190, 75, 30, '2019-11-13'),
(4, 8, 75, 190, 60, 25, '2019-11-03'),
(5, 8, 85, 190, 50, 25, '2019-11-01'),
(6, 8, 85, 190, 80, 30, '2019-11-06'),
(7, 8, 90, 190, 90, 30, '2019-10-26'),
(9, 8, 100, 190, 100, 34, '2019-10-10'),
(12, 13, 80, 186, NULL, 30, '2019-11-12'),
(13, 13, 85, 186, NULL, NULL, '2019-11-11'),
(14, 8, 85, 190, NULL, NULL, '2019-11-13');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cwiczenia`
--
ALTER TABLE `cwiczenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cwiczenia_uzytkownicy1_idx` (`id_trener`);

--
-- Indeksy dla tabeli `dania`
--
ALTER TABLE `dania`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dania_uzytkownicy1_idx` (`id_trener`);

--
-- Indeksy dla tabeli `diety`
--
ALTER TABLE `diety`
  ADD PRIMARY KEY (`dania_id`,`plany_dnia_id`),
  ADD KEY `fk_diety_plany_dnia1_idx` (`plany_dnia_id`);

--
-- Indeksy dla tabeli `plany_dnia`
--
ALTER TABLE `plany_dnia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_plany_dnia_uzytkownicy1_idx` (`id_uzytkownik`),
  ADD KEY `fk_plany_dnia_uzytkownicy2_idx` (`id_trener`);

--
-- Indeksy dla tabeli `prosby`
--
ALTER TABLE `prosby`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prosby_uzytkownicy1_idx` (`id_uzytkownik`),
  ADD KEY `fk_prosby_uzytkownicy2_idx` (`id_trener`);

--
-- Indeksy dla tabeli `rozmowy`
--
ALTER TABLE `rozmowy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rozmowy_uzytkownicy1_idx` (`id_uzytkownik`),
  ADD KEY `fk_rozmowy_uzytkownicy2_idx` (`id_trener`);

--
-- Indeksy dla tabeli `sesje`
--
ALTER TABLE `sesje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sesje_uzytkownicy1_idx` (`id_uzytkownik`);

--
-- Indeksy dla tabeli `treningi`
--
ALTER TABLE `treningi`
  ADD PRIMARY KEY (`plany_dnia_id`,`cwiczenia_id`),
  ADD KEY `fk_treningi_cwiczenia1_idx` (`cwiczenia_id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wiadomosci`
--
ALTER TABLE `wiadomosci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wiadomosci_uzytkownicy1_idx` (`id_uzytkownik`),
  ADD KEY `fk_wiadomosci_rozmowy1_idx` (`id_rozmowa`);

--
-- Indeksy dla tabeli `wymiary`
--
ALTER TABLE `wymiary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wymiary_uzytkownicy_idx` (`id_uzytkownik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `cwiczenia`
--
ALTER TABLE `cwiczenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `dania`
--
ALTER TABLE `dania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `plany_dnia`
--
ALTER TABLE `plany_dnia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT dla tabeli `prosby`
--
ALTER TABLE `prosby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `rozmowy`
--
ALTER TABLE `rozmowy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `wiadomosci`
--
ALTER TABLE `wiadomosci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT dla tabeli `wymiary`
--
ALTER TABLE `wymiary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `cwiczenia`
--
ALTER TABLE `cwiczenia`
  ADD CONSTRAINT `fk_cwiczenia_uzytkownicy1` FOREIGN KEY (`id_trener`) REFERENCES `uzytkownicy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `dania`
--
ALTER TABLE `dania`
  ADD CONSTRAINT `fk_dania_uzytkownicy1` FOREIGN KEY (`id_trener`) REFERENCES `uzytkownicy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `diety`
--
ALTER TABLE `diety`
  ADD CONSTRAINT `fk_diety_dania1` FOREIGN KEY (`dania_id`) REFERENCES `dania` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_diety_plany_dnia1` FOREIGN KEY (`plany_dnia_id`) REFERENCES `plany_dnia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `plany_dnia`
--
ALTER TABLE `plany_dnia`
  ADD CONSTRAINT `fk_plany_dnia_uzytkownicy1` FOREIGN KEY (`id_uzytkownik`) REFERENCES `uzytkownicy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_plany_dnia_uzytkownicy2` FOREIGN KEY (`id_trener`) REFERENCES `uzytkownicy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `prosby`
--
ALTER TABLE `prosby`
  ADD CONSTRAINT `fk_prosby_uzytkownicy1` FOREIGN KEY (`id_uzytkownik`) REFERENCES `uzytkownicy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prosby_uzytkownicy2` FOREIGN KEY (`id_trener`) REFERENCES `uzytkownicy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `rozmowy`
--
ALTER TABLE `rozmowy`
  ADD CONSTRAINT `fk_rozmowy_uzytkownicy1` FOREIGN KEY (`id_uzytkownik`) REFERENCES `uzytkownicy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rozmowy_uzytkownicy2` FOREIGN KEY (`id_trener`) REFERENCES `uzytkownicy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `sesje`
--
ALTER TABLE `sesje`
  ADD CONSTRAINT `fk_sesje_uzytkownicy1` FOREIGN KEY (`id_uzytkownik`) REFERENCES `uzytkownicy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `treningi`
--
ALTER TABLE `treningi`
  ADD CONSTRAINT `fk_treningi_cwiczenia1` FOREIGN KEY (`cwiczenia_id`) REFERENCES `cwiczenia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_treningi_plany_dnia1` FOREIGN KEY (`plany_dnia_id`) REFERENCES `plany_dnia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `wiadomosci`
--
ALTER TABLE `wiadomosci`
  ADD CONSTRAINT `fk_wiadomosci_rozmowy1` FOREIGN KEY (`id_rozmowa`) REFERENCES `rozmowy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wiadomosci_uzytkownicy1` FOREIGN KEY (`id_uzytkownik`) REFERENCES `uzytkownicy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `wymiary`
--
ALTER TABLE `wymiary`
  ADD CONSTRAINT `fk_wymiary_uzytkownicy` FOREIGN KEY (`id_uzytkownik`) REFERENCES `uzytkownicy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
