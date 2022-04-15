-- phpMyAdmin SQL Dump
-- version 5.0.4deb2ubuntu5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 13 avr. 2022 à 15:00
-- Version du serveur :  8.0.28-0ubuntu0.21.10.3
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `poutine`
--

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `has_description` tinyint(1) NOT NULL,
  `prix` double NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `description`, `has_description`, `prix`, `type`) VALUES
(1, 'la québécoise classique', 'frites fraîches, fromage \"couic-couic\", mozzarella, sauce brune', 1, 8, 'plat'),
(2, 'québécoise à ton gout', 'frites fraîches, fromage \"couic-couic\", mozzarella, sauce brune et une viande de ton choix', 1, 9, 'plat'),
(3, 'québécoise halal', 'frites fraîches, fromage \"couic-couic\", mozzarella, poulet halal et sauce brune', 1, 9, 'plat'),
(4, 'québécoise façon normande', 'frites fraîches, camembert aoc, mozzarella, andouillette, sauce brune', 1, 9, 'normand'),
(5, 'frites fraîches petite', NULL, 0, 2, 'frite'),
(6, 'frites fraîches moyenne', NULL, 0, 3, 'frite'),
(7, 'saucisses frites fraîches', NULL, 0, 5, 'autre'),
(8, 'churros chocolat-chantilly', NULL, 0, 4, 'dessert'),
(9, 'coca, coca zero', NULL, 0, 1.5, 'boisson'),
(10, 'ice tea', NULL, 0, 1.5, 'boisson'),
(11, 'oasis', NULL, 0, 1.5, 'boisson'),
(12, 'eau minerale', NULL, 0, 1, 'boisson'),
(13, 'bière 1664 *', NULL, 0, 2, 'boisson');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
