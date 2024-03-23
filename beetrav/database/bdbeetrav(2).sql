-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 06 juin 2023 à 21:43
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdbeetrav`
--

-- --------------------------------------------------------

--
-- Structure de la table `apiculteur`
--

CREATE TABLE `apiculteur` (
  `id_a` int(11) NOT NULL,
  `pseudo_a` varchar(50) NOT NULL,
  `mdp_a` varchar(50) NOT NULL,
  `acess` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `apiculteur`
--

INSERT INTO `apiculteur` (`id_a`, `pseudo_a`, `mdp_a`, `acess`) VALUES
(1, 'jean-tout', '1364cba01e0ee80ef4381175bd6cf0d3', 0),
(2, 'carole', 'ab2f0f023460c81e7ff570315684cef2', 0),
(3, '1528@@)ù', '0c0993283306441ffc1a9c2770bdeb52', 0),
(4, 'api', '8a5da52ed126447d359e70c05721a8aa', 0);

-- --------------------------------------------------------

--
-- Structure de la table `recolte`
--

CREATE TABLE `recolte` (
  `id_re` int(11) NOT NULL,
  `date_re` date NOT NULL,
  `quantite_re` int(11) NOT NULL,
  `nb_hausses_re` bigint(20) NOT NULL,
  `id_ru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recolte`
--

INSERT INTO `recolte` (`id_re`, `date_re`, `quantite_re`, `nb_hausses_re`, `id_ru`) VALUES
(1, '2015-01-21', -985, 0, 3),
(5, '2023-05-09', 25, 6, 6),
(8, '2023-06-12', 22, 1, 25),
(9, '2023-06-29', 12, 3, 25);

-- --------------------------------------------------------

--
-- Structure de la table `ruche`
--

CREATE TABLE `ruche` (
  `id_ru` int(11) NOT NULL,
  `nom_ru` varchar(50) NOT NULL,
  `date_installation_ru` date NOT NULL,
  `longitude_ru` decimal(10,6) NOT NULL,
  `latitude_ru` decimal(10,6) NOT NULL,
  `id_a` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ruche`
--

INSERT INTO `ruche` (`id_ru`, `nom_ru`, `date_installation_ru`, `longitude_ru`, `latitude_ru`, `id_a`) VALUES
(2, '256', '2023-03-15', '25.964735', '15.123456', 2),
(3, '589', '0000-00-00', '25.498123', '25.756456', 3),
(6, 'Paul', '2020-05-13', '35.134986', '25.297542', 1),
(9, 'bernaju', '2023-02-14', '35.057329', '25.288305', 1),
(25, 'margerit', '2023-06-13', '14.257357', '12.456123', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `apiculteur`
--
ALTER TABLE `apiculteur`
  ADD PRIMARY KEY (`id_a`);

--
-- Index pour la table `recolte`
--
ALTER TABLE `recolte`
  ADD PRIMARY KEY (`id_re`),
  ADD KEY `id_ruche` (`id_ru`);

--
-- Index pour la table `ruche`
--
ALTER TABLE `ruche`
  ADD PRIMARY KEY (`id_ru`),
  ADD KEY `id_api` (`id_a`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `apiculteur`
--
ALTER TABLE `apiculteur`
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `recolte`
--
ALTER TABLE `recolte`
  MODIFY `id_re` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `ruche`
--
ALTER TABLE `ruche`
  MODIFY `id_ru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `recolte`
--
ALTER TABLE `recolte`
  ADD CONSTRAINT `id_ruche` FOREIGN KEY (`id_ru`) REFERENCES `ruche` (`id_ru`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ruche`
--
ALTER TABLE `ruche`
  ADD CONSTRAINT `id_api` FOREIGN KEY (`id_a`) REFERENCES `apiculteur` (`id_a`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
