-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 27 avr. 2026 à 13:38
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
-- Base de données : `gestion_ecole`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_annee_scolaire`
--

CREATE TABLE `t_annee_scolaire` (
  `id_annee` int(11) NOT NULL,
  `designation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_classe`
--

CREATE TABLE `t_classe` (
  `id_classe` int(11) NOT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `id_option` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_eleve`
--

CREATE TABLE `t_eleve` (
  `id_eleve` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `postnom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `sexe` enum('M','F') DEFAULT NULL,
  `date_naissance` datetime DEFAULT NULL,
  `lieu_naissance` varchar(50) DEFAULT NULL,
  `nom_pere` varchar(100) DEFAULT NULL,
  `nom_mere` varchar(100) DEFAULT NULL,
  `addresse` varchar(100) DEFAULT NULL,
  `contact_pere` varchar(20) DEFAULT NULL,
  `contact_mere` varchar(20) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_inscrire`
--

CREATE TABLE `t_inscrire` (
  `id_eleve` int(11) DEFAULT NULL,
  `id_classe` int(11) DEFAULT NULL,
  `id_annee_scolaire` int(11) DEFAULT NULL,
  `date_inscription` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `t_option`
--

CREATE TABLE `t_option` (
  `id_option` int(11) NOT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_annee_scolaire`
--
ALTER TABLE `t_annee_scolaire`
  ADD PRIMARY KEY (`id_annee`),
  ADD UNIQUE KEY `designation` (`designation`);

--
-- Index pour la table `t_classe`
--
ALTER TABLE `t_classe`
  ADD PRIMARY KEY (`id_classe`),
  ADD KEY `fk_option` (`id_option`);

--
-- Index pour la table `t_eleve`
--
ALTER TABLE `t_eleve`
  ADD PRIMARY KEY (`id_eleve`);

--
-- Index pour la table `t_inscrire`
--
ALTER TABLE `t_inscrire`
  ADD KEY `id_eleve` (`id_eleve`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `id_annee_scolaire` (`id_annee_scolaire`);

--
-- Index pour la table `t_option`
--
ALTER TABLE `t_option`
  ADD PRIMARY KEY (`id_option`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_annee_scolaire`
--
ALTER TABLE `t_annee_scolaire`
  MODIFY `id_annee` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_classe`
--
ALTER TABLE `t_classe`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_eleve`
--
ALTER TABLE `t_eleve`
  MODIFY `id_eleve` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_option`
--
ALTER TABLE `t_option`
  MODIFY `id_option` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_classe`
--
ALTER TABLE `t_classe`
  ADD CONSTRAINT `fk_option` FOREIGN KEY (`id_option`) REFERENCES `t_option` (`id_option`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_inscrire`
--
ALTER TABLE `t_inscrire`
  ADD CONSTRAINT `t_inscrire_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `t_eleve` (`id_eleve`),
  ADD CONSTRAINT `t_inscrire_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `t_classe` (`id_classe`),
  ADD CONSTRAINT `t_inscrire_ibfk_3` FOREIGN KEY (`id_annee_scolaire`) REFERENCES `t_annee_scolaire` (`id_annee`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
