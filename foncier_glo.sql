-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 24 mai 2026 à 22:17
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `foncier_glo`
--

-- --------------------------------------------------------

--
-- Structure de la table `alertes`
--

CREATE TABLE `alertes` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `type` enum('double_attribution','superposition','titre_invalide','transaction_suspecte') NOT NULL,
  `niveau` enum('info','warning','critique') NOT NULL DEFAULT 'warning',
  `message` text NOT NULL,
  `statut` enum('nouvelle','en_cours','resolue') NOT NULL DEFAULT 'nouvelle',
  `parcelle_id` int(10) UNSIGNED NOT NULL,
  `litige_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `litiges`
--

CREATE TABLE `litiges` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference` varchar(100) NOT NULL,
  `type` enum('double_attribution','bornage','succession','usurpation','autre') NOT NULL,
  `description` text NOT NULL,
  `statut` enum('ouvert','en_cours','resolu','classe') NOT NULL DEFAULT 'ouvert',
  `parcelle_id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(10) UNSIGNED DEFAULT NULL,
  `date_resolution` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parcelles`
--

CREATE TABLE `parcelles` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_cadastrale` varchar(100) NOT NULL,
  `superficie` decimal(10,2) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `arrondissement` varchar(100) NOT NULL,
  `village_quartier` varchar(100) NOT NULL,
  `statut` enum('libre','attribue','litige','reserve','vendu') NOT NULL DEFAULT 'libre',
  `type_terrain` enum('agricole','residentiel','commercial','industriel') NOT NULL DEFAULT 'residentiel',
  `description` text DEFAULT NULL,
  `document_titre` varchar(255) DEFAULT NULL,
  `proprietaire_id` int(10) UNSIGNED DEFAULT NULL,
  `agent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `proprietaires`
--

CREATE TABLE `proprietaires` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `npi` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `adresse` text NOT NULL,
  `type` enum('personne_physique','personne_morale') NOT NULL DEFAULT 'personne_physique',
  `piece_identite` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `proprietaires`
--

INSERT INTO `proprietaires` (`id`, `nom`, `prenom`, `npi`, `telephone`, `email`, `adresse`, `type`, `piece_identite`, `created_at`, `updated_at`) VALUES
(1, 'AGOSSA', 'jean', '123456789', '97000000', 'jean@gmail.com', 'qartier zoungoudo glo-djigbe', 'personne_physique', 'CNI-123456', '2026-05-16 08:36:46', '2026-05-16 08:36:46');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `matricule` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('administrateur','agent_sade','chef_service','consultant') NOT NULL DEFAULT 'agent_sade',
  `statut` enum('actif','inactif') NOT NULL DEFAULT 'actif',
  `derniere_connexion` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `matricule`, `email`, `telephone`, `password`, `role`, `statut`, `derniere_connexion`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 'Super', 'ADM001', 'admin@mairie-glo.bj', '97000000', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'administrateur', 'actif', '2026-05-20 11:26:23', '2026-05-11 10:10:34', '2026-05-20 11:26:23');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alertes`
--
ALTER TABLE `alertes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `parcelle_id` (`parcelle_id`),
  ADD KEY `litige_id` (`litige_id`);

--
-- Index pour la table `litiges`
--
ALTER TABLE `litiges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`),
  ADD KEY `parcelle_id` (`parcelle_id`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Index pour la table `parcelles`
--
ALTER TABLE `parcelles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference_cadastrale` (`reference_cadastrale`),
  ADD KEY `proprietaire_id` (`proprietaire_id`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Index pour la table `proprietaires`
--
ALTER TABLE `proprietaires`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `npi` (`npi`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricule` (`matricule`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alertes`
--
ALTER TABLE `alertes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `litiges`
--
ALTER TABLE `litiges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `parcelles`
--
ALTER TABLE `parcelles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `proprietaires`
--
ALTER TABLE `proprietaires`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `alertes`
--
ALTER TABLE `alertes`
  ADD CONSTRAINT `alertes_ibfk_1` FOREIGN KEY (`parcelle_id`) REFERENCES `parcelles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alertes_ibfk_2` FOREIGN KEY (`litige_id`) REFERENCES `litiges` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `litiges`
--
ALTER TABLE `litiges`
  ADD CONSTRAINT `litiges_ibfk_1` FOREIGN KEY (`parcelle_id`) REFERENCES `parcelles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `litiges_ibfk_2` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `parcelles`
--
ALTER TABLE `parcelles`
  ADD CONSTRAINT `parcelles_ibfk_1` FOREIGN KEY (`proprietaire_id`) REFERENCES `proprietaires` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `parcelles_ibfk_2` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
