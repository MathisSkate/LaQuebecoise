-- phpMyAdmin SQL Dump
-- version 5.0.4deb2ubuntu5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 21 avr. 2022 à 20:56
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
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220413130028', '2022-04-13 15:00:35', 29),
('DoctrineMigrations\\Version20220413130551', '2022-04-13 15:06:01', 49),
('DoctrineMigrations\\Version20220413132807', '2022-04-13 15:28:15', 37);

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

CREATE TABLE `localisation` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codepostal` int NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `localisation`
--

INSERT INTO `localisation` (`id`, `nom`, `rue`, `ville`, `codepostal`, `pays`, `description`) VALUES
(1, 'thierry andre', '12 allee cerreto guidi', 'saint marcel', 27950, 'France', 'ici tout commence'),
(2, 'mathis andre', '58 rue francois mazeline', 'le havre', 76600, 'France', 'chez moi');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `stock` double NOT NULL,
  `is_unite` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id`, `nom`, `prix`, `stock`, `is_unite`) VALUES
(1, 'frites fraîches', 1.02, 1000, 0),
(2, 'mozzarella', 5.52, 1000, 0),
(3, 'fromage', 17.45, 1000, 0),
(4, 'sauce', 8.58, 1000, 0),
(5, 'andouillette', 8.86, 1000, 0),
(6, 'camembert', 1.8, 1000, 0),
(7, 'bacon', 16, 1000, 0),
(8, 'saucisses', 3.34, 1000, 0),
(9, 'emince de poulet', 7.59, 1000, 0),
(10, 'boeuf haché', 12, 1000, 0),
(11, 'churros', 6.5, 1000, 0),
(12, 'biere 1664', 0.95, 100, 1),
(13, 'COCA COLA', 0.46, 100, 1),
(14, 'ICE TEA', 0.4, 100, 1),
(15, 'oasis', 0.45, 100, 1),
(16, 'eau minerale', 0.5, 100, 1);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(1, 'Mathis', '[\"ROLE_ADMIN\"]', '$2y$13$WdyZSDGabX//rvEUmcr0P.z2/8iE9i9R0TpFqE15TbfFFovRMgpFG');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `localisation`
--
ALTER TABLE `localisation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `localisation`
--
ALTER TABLE `localisation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
