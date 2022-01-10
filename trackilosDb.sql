-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 10 jan. 2022 à 08:05
-- Version du serveur :  8.0.27-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `trackilos`
--

-- --------------------------------------------------------

--
-- Structure de la table `aliments`
--

CREATE TABLE `aliments` (
  `userId` int NOT NULL,
  `aliment` varchar(70) NOT NULL,
  `calories` int NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `author` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `author`, `email`) VALUES
(9, 'boudin', '2022-01-04', '897', ''),
(10, 'oeuf', '2022-01-04', '25', ''),
(11, 'pate bolognaise', '2022-01-04', '359', ''),
(12, 'nem', '2022-01-04', '589', ''),
(13, 'boullabaisse', '2022-01-03', '1000', ''),
(14, 'bonbon', '2022-01-03', '789', 'admin@mail.com'),
(15, 'gateau', '2022-01-03', '896', 'admin@mail.com'),
(16, 'pain', '2021-03-12', '2', 'admin@mail.com'),
(17, 'jambon', '2022-01-05', '45', 'ariane@dombale.com'),
(18, 'garlic', '2022-01-03', '12', 'ariane@dombale.com'),
(19, 'courgette', '2022-01-05', '123', 'admin@mail.com'),
(20, 'courbouillon', '2022-01-06', '589', 'ana@ana.ana'),
(21, 'poulet roti', '2022-01-04', '45', 'admin@mail.com'),
(22, 'carotte', '2022-01-03', '5', 'carp@mail.fr'),
(23, 'poule', '2022-01-04', '789', 'carp@mail.fr'),
(24, 'petit suissse', '2022-01-06', '598', 'carp@mail.fr'),
(25, 'ergfegf', '2022-01-04', '58', 'carp@mail.fr'),
(26, 'pomme', '2021-12-27', '59', ''),
(27, 'carotte', '2022-01-05', '25', ''),
(28, 'hotdog', '2022-01-06', '1566', ''),
(29, 'FEER', '2022-01-06', '56', ''),
(30, 'GFHFG', '2022-01-06', '15', ''),
(31, 'HAMBOURGER', '2022-01-06', '1599', ''),
(32, 'BURGER', '2022-01-06', '1596', ''),
(33, 'farine', '2022-01-06', '896', 'admin@mail.com'),
(34, 'haricots', '2022-01-05', '85', 'admin@mail.com'),
(35, 'boudin', '2022-01-06', '56', 'armelle@mail.com'),
(36, 'gkgk', '2022-01-05', '65', 'armelle@mail.com'),
(37, 'ggk', '2022-01-05', '78', 'armelle@mail.com'),
(38, 'fhfhf', '2022-01-08', '25', 'admin@mail.com'),
(39, 'HAMBOURGER', '2022-01-06', '25', 'admin@mail.com'),
(40, 'nutella', '2022-01-10', '896', 'admin@mail.com'),
(41, 'jus de fruits', '2022-01-10', '89', 'admin@mail.com'),
(42, 'rillettes', '2022-01-10', '400', 'admin@mail.com'),
(43, 'un truc très gras', '2022-01-10', '1000', 'admin@mail.com');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lastname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `birthyear` year DEFAULT NULL,
  `size` int DEFAULT NULL,
  `weight` int DEFAULT NULL,
  `accountCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `sex`, `birthyear`, `size`, `weight`, `accountCreated`) VALUES
(42, 'sophie', 'charlotte', 'sophie@mail.fr', '123', 'W', 1995, 168, 60, '2022-01-01 23:26:09'),
(46, 'sophie', 'dujardin', 'sophie@jardin.com', '123', 'W', 1958, 159, 52, '2022-01-01 23:36:00'),
(52, NULL, NULL, 'allo@mail.com', 'password', NULL, NULL, NULL, NULL, '2022-01-01 23:52:59'),
(58, 'ariane', 'dombale', 'ariane@dombale.com', '123', NULL, NULL, NULL, NULL, '2022-01-02 20:58:50'),
(64, 'antoine', 'boui', 'antoine@mail.fr', '123', 'M', 1955, 198, 87, '2022-01-02 22:08:33'),
(65, 'armelle', 'lupin', 'armelle@mail.com', '123', 'W', 1985, 157, 90, '2022-01-02 22:11:14'),
(67, 'dbdbd', 'dbdb', 'admin@mail.com', 'db', 'N', 1988, 159, 789, '2022-01-02 22:29:56'),
(68, 'gege', 'egeg', 'adeeemin@mail.com', 'eee', 'M', 1996, 99, 99, '2022-01-02 23:23:57'),
(69, 'fbf', 'fbfb', 'afffdmin@mail.com', 'fb', 'M', 1998, 199, 198, '2022-01-02 23:27:06'),
(70, 'yky', 'ykyk', 'ayyydmin@mail.com', 'yy', 'W', 1998, 198, 198, '2022-01-02 23:28:24'),
(71, 'hrhrh', 'rhh', 'adrrmin@mail.com', 'rh', 'M', 1997, 89, 89, '2022-01-02 23:30:51'),
(72, 'ththt', 'ththt', 'adminhh@mail.com', 'hhh', 'M', 1998, 135, 136, '2022-01-02 23:31:42'),
(73, 'michel', 'blanc', 'blanc@m.fr', '123', 'M', 1999, 198, 198, '2022-01-03 08:32:54'),
(74, 'anabel', 'belle', 'ana@ana.ana', '123', 'N', 1998, 198, 198, '2022-01-03 17:08:57'),
(75, 'carotte', 'legume', 'carp@mail.fr', '123', 'W', 1998, 98, 98, '2022-01-03 17:14:21'),
(76, 'berenice', 'bebe', 'bebe@babo.bob', '123', 'M', 1910, 123, 133, '2022-01-05 01:15:12'),
(77, 'hhh', 'hhh', 'admihhhhhn@mail.com', 'hh', 'M', 1989, 199, 199, '2022-01-05 01:22:56'),
(78, 'diana', 'diane', 'diane@diane.com', '123', 'N', 1910, 123, 123, '2022-01-05 23:17:37');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
