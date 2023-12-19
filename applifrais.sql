-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 12 déc. 2023 à 10:56
-- Version du serveur : 8.2.0
-- Version de PHP : 8.1.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `applifrais`
--

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
(1, 'En cours'),
(2, 'Clôturée'),
(3, 'Validée'),
(4, 'Remboursée');

-- --------------------------------------------------------

--
-- Structure de la table `fichedefrais`
--

DROP TABLE IF EXISTS `fichedefrais`;
CREATE TABLE IF NOT EXISTS `fichedefrais` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mois` varchar(255) NOT NULL,
  `total` float NOT NULL,
  `date` date NOT NULL,
  `idUtilisateur` int NOT NULL,
  `idEtat` int NOT NULL,
  `idFraisforfait` int NOT NULL,
  `idFraishorsforfait` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idEtat` (`idEtat`),
  KEY `idUtilisateur` (`idUtilisateur`),
  KEY `idFraisforfait` (`idFraisforfait`),
  KEY `idFraishorsforfait` (`idFraishorsforfait`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fraisforfait`
--

DROP TABLE IF EXISTS `fraisforfait`;
CREATE TABLE IF NOT EXISTS `fraisforfait` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `quantite` int NOT NULL,
  `montant` float NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fraishorsforfait`
--

DROP TABLE IF EXISTS `fraishorsforfait`;
CREATE TABLE IF NOT EXISTS `fraishorsforfait` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `montant` float NOT NULL,
  `idFicheDeFrais` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idFicheDeFrais` (`idFicheDeFrais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `date_embauche` date NOT NULL,
  `role` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `login`, `mdp`, `date_embauche`, `role`, `ville`) VALUES
(1, 'Doe', 'John', 'jDoe', '$2y$10$6DR0njxQN9FtK7oB4UjQBuhj6B9g5xoOFDU36wO0HUO1HSdUl31o6', '2023-11-27', 'visiteur', 'Paris'),
(2, 'Dupont', 'Jean', 'jDupont', '$2y$10$6DR0njxQN9FtK7oB4UjQBuhj6B9g5xoOFDU36wO0HUO1HSdUl31o6', '2023-12-10', 'compta', 'Paris');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fichedefrais`
--
ALTER TABLE `fichedefrais`
  ADD CONSTRAINT `fichedefrais_ibfk_1` FOREIGN KEY (`idEtat`) REFERENCES `etat` (`id`),
  ADD CONSTRAINT `fichedefrais_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `fichedefrais_ibfk_3` FOREIGN KEY (`idFraisforfait`) REFERENCES `fraisforfait` (`id`);

--
-- Contraintes pour la table `fraishorsforfait`
--
ALTER TABLE `fraishorsforfait`
  ADD CONSTRAINT `fraishorsforfait_ibfk_1` FOREIGN KEY (`idFicheDeFrais`) REFERENCES `fichedefrais` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
