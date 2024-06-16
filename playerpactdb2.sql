-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 17, 2024 alle 00:18
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `playerpactdb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `birthDate` date NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `name`, `surname`, `birthDate`, `email`, `image`) VALUES
(1, 'admin', 'admin', 'a', 'b', '2000-01-01', 'a@b.com', 0x63);

-- --------------------------------------------------------

--
-- Struttura della tabella `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `postType` varchar(16) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `chat`
--

INSERT INTO `chat` (`id`, `postId`, `postType`, `datetime`) VALUES
(3, 2, 'sale', '2024-06-16 19:25:45'),
(4, 2, 'sale', '2024-06-16 20:39:04'),
(5, 3, 'team', '2024-06-16 20:57:30');

-- --------------------------------------------------------

--
-- Struttura della tabella `chatuser`
--

CREATE TABLE `chatuser` (
  `id` int(11) NOT NULL,
  `chatId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `chatuser`
--

INSERT INTO `chatuser` (`id`, `chatId`, `userId`, `datetime`) VALUES
(8, 5, 27, '2024-06-16 20:57:53');

-- --------------------------------------------------------

--
-- Struttura della tabella `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `postStandardId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `interestlist`
--

CREATE TABLE `interestlist` (
  `id` int(12) NOT NULL,
  `userId` int(12) NOT NULL,
  `postSaleId` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `chatId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `message`
--

INSERT INTO `message` (`id`, `chatId`, `userId`, `description`, `datetime`) VALUES
(1, 3, 33, 'ciao', '2024-06-16 20:01:23'),
(2, 3, 26, 'Ciao', '2024-06-16 20:01:40'),
(3, 4, 25, 'Ciao', '2024-06-16 20:39:14'),
(4, 4, 26, 'Salve', '2024-06-16 20:39:31'),
(5, 4, 25, 'ciao', '2024-06-16 20:44:40'),
(6, 5, 27, 'ciao', '2024-06-16 20:58:26'),
(7, 5, 25, 'Ciao', '2024-06-16 20:58:54'),
(8, 5, 27, 'Salve', '2024-06-16 20:59:25'),
(9, 5, 25, 'Come va?', '2024-06-16 20:59:30'),
(10, 5, 27, 'Bene', '2024-06-16 20:59:33');

-- --------------------------------------------------------

--
-- Struttura della tabella `mod`
--

CREATE TABLE `mod` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `birthDate` date NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `mod`
--
DELIMITER $$
CREATE TRIGGER `after_delete_mod` AFTER DELETE ON `mod` FOR EACH ROW DELETE FROM profile WHERE type = "mod" AND username = OLD.username
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `moderationcomment`
--

CREATE TABLE `moderationcomment` (
  `id` int(11) NOT NULL,
  `reportId` int(11) NOT NULL,
  `modId` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `moderationpost`
--

CREATE TABLE `moderationpost` (
  `id` int(11) NOT NULL,
  `reportId` int(11) NOT NULL,
  `modId` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `moderationuser`
--

CREATE TABLE `moderationuser` (
  `id` int(11) NOT NULL,
  `reportId` int(11) NOT NULL,
  `modId` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `participation`
--

CREATE TABLE `participation` (
  `id` int(12) NOT NULL,
  `userId` int(12) NOT NULL,
  `postTeamId` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `participation`
--

INSERT INTO `participation` (`id`, `userId`, `postTeamId`) VALUES
(1, 26, 1),
(2, 26, 2),
(4, 27, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `postsale`
--

CREATE TABLE `postsale` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `datetime` datetime NOT NULL,
  `price` float NOT NULL,
  `image` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `postsale`
--
DELIMITER $$
CREATE TRIGGER `before_delete_postSale` BEFORE DELETE ON `postsale` FOR EACH ROW DELETE FROM chat WHERE postType = "sale" AND postId = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `poststandard`
--

CREATE TABLE `poststandard` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `postteam`
--

CREATE TABLE `postteam` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `datetime` datetime NOT NULL,
  `nMaxPlayers` int(11) NOT NULL,
  `nPlayers` int(11) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `postteam`
--
DELIMITER $$
CREATE TRIGGER `before_delete_postTeam` BEFORE DELETE ON `postteam` FOR EACH ROW DELETE FROM chat WHERE postType = "team" AND postId
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `type` varchar(16) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `profile`
--

INSERT INTO `profile` (`id`, `type`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'admin', 'a@b.com'),
(6, 'user', 'romanob', 'ghigo', 'romano.b@outlook.it'),
(7, 'user', 'robertdowneyjr', 'ghigo', 'rbj@gmail.com'),
(14, 'user', 'ghigo3', '32', 'a3232242323@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `idToReport` int(11) NOT NULL,
  `type` varchar(16) NOT NULL,
  `datetime` datetime NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `report`
--

INSERT INTO `report` (`id`, `userId`, `idToReport`, `type`, `datetime`, `description`) VALUES
(32, 26, 1, 'comment', '2024-06-16 18:28:13', 'Brutto');

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `birthDate` date NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `surname`, `birthDate`, `email`, `image`) VALUES
(27, 'romanob', 'ghigo', 'romano', 'banderasf', '2024-05-29', 'romano.b@outlook.it', ''),
(28, 'robertdowneyjr', 'ghigo', 'Robert', 'Downey Jr', '2024-05-29', 'rbj@gmail.com', ''),
(36, 'ghigo3', '32', 'a', 'b', '2024-05-29', 'a3232242323@gmail.com', 0x89504e470d0a1a0a0000000d49484452000000a8000000ca01030000000bb999a600000006504c5445040204fce6dcf0cb7fcf000000d2494441545885edd6310ac3300c0550870e1d73845e24e06b750824d0a1d74ae9497a838c1e4c7e85e4a575868225d38035d8f82d8e25e4d839a3e891c7daf4201a9da731f0a8a9373c683ce3a9ac71e0ddaebe6955e55637d09aa798939e74358c497952d40912f1e0ba5db01a68ec687293baca8573afa4c00bfd4e264b353aca597ee2624db7721d953e0316651d798530a8ebd6c15928d7b8924e2967fa37c142bf80bcf2e56af2bdf40291f87e97d8a8ec8de0b5555a6056d7ba2f10cf95cf4e5caebb39fb5bfd8ca64d9bfeae46f106398795e62a746e6a0000000049454e44ae426082);

--
-- Trigger `user`
--
DELIMITER $$
CREATE TRIGGER `after_delete_user` AFTER DELETE ON `user` FOR EACH ROW DELETE FROM profile WHERE type = "user" AND username = OLD.username
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_user` BEFORE DELETE ON `user` FOR EACH ROW DELETE FROM participation WHERE userId=OLD.id
$$
DELIMITER ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indici per le tabelle `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postId` (`postId`);

--
-- Indici per le tabelle `chatuser`
--
ALTER TABLE `chatuser`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `chatId` (`chatId`,`userId`),
  ADD KEY `userId` (`userId`);

--
-- Indici per le tabelle `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postStandardId` (`postStandardId`),
  ADD KEY `userId` (`userId`);

--
-- Indici per le tabelle `interestlist`
--
ALTER TABLE `interestlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userId` (`userId`,`postSaleId`),
  ADD UNIQUE KEY `userId_2` (`userId`,`postSaleId`),
  ADD KEY `postSaleId` (`postSaleId`);

--
-- Indici per le tabelle `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chatId` (`chatId`);

--
-- Indici per le tabelle `mod`
--
ALTER TABLE `mod`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `moderationcomment`
--
ALTER TABLE `moderationcomment`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `moderationpost`
--
ALTER TABLE `moderationpost`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `moderationuser`
--
ALTER TABLE `moderationuser`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userId` (`userId`,`postTeamId`);

--
-- Indici per le tabelle `postsale`
--
ALTER TABLE `postsale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indici per le tabelle `poststandard`
--
ALTER TABLE `poststandard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indici per le tabelle `postteam`
--
ALTER TABLE `postteam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indici per le tabelle `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `chatuser`
--
ALTER TABLE `chatuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `interestlist`
--
ALTER TABLE `interestlist`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `mod`
--
ALTER TABLE `mod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `moderationpost`
--
ALTER TABLE `moderationpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `moderationuser`
--
ALTER TABLE `moderationuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `participation`
--
ALTER TABLE `participation`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `postsale`
--
ALTER TABLE `postsale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `poststandard`
--
ALTER TABLE `poststandard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `postteam`
--
ALTER TABLE `postteam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `chatuser`
--
ALTER TABLE `chatuser`
  ADD CONSTRAINT `chatuser_ibfk_1` FOREIGN KEY (`chatId`) REFERENCES `chat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chatuser_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`postStandardId`) REFERENCES `poststandard` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `interestlist`
--
ALTER TABLE `interestlist`
  ADD CONSTRAINT `interestlist_ibfk_1` FOREIGN KEY (`postSaleId`) REFERENCES `postsale` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `interestlist_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`chatId`) REFERENCES `chat` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `postsale`
--
ALTER TABLE `postsale`
  ADD CONSTRAINT `postsale_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `poststandard`
--
ALTER TABLE `poststandard`
  ADD CONSTRAINT `poststandard_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `postteam`
--
ALTER TABLE `postteam`
  ADD CONSTRAINT `postteam_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
