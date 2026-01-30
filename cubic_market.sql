-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 30 jan. 2026 à 12:53
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cubic_market`
--
CREATE DATABASE IF NOT EXISTS `cubic_market` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cubic_market`;

-- --------------------------------------------------------

--
-- Structure de la table `arme`
--

DROP TABLE IF EXISTS `arme`;
CREATE TABLE `arme` (
  `id_arme` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `degats` int(11) NOT NULL,
  `durabilite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `armure`
--

DROP TABLE IF EXISTS `armure`;
CREATE TABLE `armure` (
  `id_armure` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `protection` int(11) NOT NULL,
  `durabilite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE `compte` (
  `id_compte` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd_hash` varchar(500) NOT NULL,
  `role` enum('ROLE_USER','ROLE_ADMIN') NOT NULL DEFAULT 'ROLE_USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id_compte`, `pseudo`, `email`, `pwd_hash`, `role`) VALUES
(1, 'Admin', 'test@mail.com', '$argon2id$v=19$m=4096,t=3,p=1$lYw0TB60EquoD1izFScGLQ$svctxSb5J3WNN5bIzoYCkOb8O6zHszAAGec5juOk854', 'ROLE_ADMIN'),
(2, 'Tom', 'tom@mail.com', '$argon2id$v=19$m=65536,t=4,p=1$cjVSbjVlbmdpVDljSm1kdA$9aPvJEcxoIZnKkOmOvdASo04BlkZYuELSxaZyKFbkfQ', 'ROLE_USER'),
(3, 'Larson', 'jack@mail.com', '$argon2id$v=19$m=65536,t=4,p=1$U1NDUXRtZFZYVC9RVndacQ$PLxLDYl5vQuczpMrHO5ikxJT+9JLmFTPt6TkrzkyPos', 'ROLE_USER'),
(4, 'gerard', 'igerard@mail.com', '$argon2id$v=19$m=65536,t=4,p=1$ek04TzNEMmh0dVV3T21QbQ$gYdSSVfySKol9kYO95QG7gmmgoc5B3hxytLeX6AMpW0', 'ROLE_USER');

-- --------------------------------------------------------

--
-- Structure de la table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `id_grade` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `duree` time NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom`, `description`, `prix`, `image`) VALUES
(3, 'test', 'test desc', 100.00, 'src/uploads/product1.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `arme`
--
ALTER TABLE `arme`
  ADD PRIMARY KEY (`id_arme`),
  ADD KEY `FK_produit_arme` (`id_produit`);

--
-- Index pour la table `armure`
--
ALTER TABLE `armure`
  ADD PRIMARY KEY (`id_armure`),
  ADD KEY `FK_produit_armure` (`id_produit`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id_compte`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Index pour la table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id_grade`),
  ADD KEY `FK_produit_grade` (`id_produit`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `arme`
--
ALTER TABLE `arme`
  MODIFY `id_arme` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `armure`
--
ALTER TABLE `armure`
  MODIFY `id_armure` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `grade`
--
ALTER TABLE `grade`
  MODIFY `id_grade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `arme`
--
ALTER TABLE `arme`
  ADD CONSTRAINT `FK_produit_arme` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE;

--
-- Contraintes pour la table `armure`
--
ALTER TABLE `armure`
  ADD CONSTRAINT `FK_produit_armure` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE;

--
-- Contraintes pour la table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `FK_produit_grade` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE;

DELIMITER $$
--
-- Évènements
--
DROP EVENT IF EXISTS `purge_donnees_passees`$$
CREATE DEFINER=`root`@`localhost` EVENT `purge_donnees_passees` ON SCHEDULE EVERY 1 MINUTE STARTS '2026-01-18 16:47:47' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM grade 
  WHERE ADDTIME(date_creation, duree) < NOW()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
