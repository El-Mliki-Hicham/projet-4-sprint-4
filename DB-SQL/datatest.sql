-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 11 déc. 2022 à 21:40
-- Version du serveur : 8.0.27
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `datatest`
--

-- --------------------------------------------------------

--
-- Structure de la table `annee_formation`
--

CREATE TABLE `annee_formation` (
  `id` bigint UNSIGNED NOT NULL,
  `Annee_scolaire` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `annee_formation`
--

INSERT INTO `annee_formation` (`id`, `Annee_scolaire`) VALUES
(1, '2021-2022'),
(2, '2022-2023');

-- --------------------------------------------------------

--
-- Structure de la table `apprenant`
--

CREATE TABLE `apprenant` (
  `id` int UNSIGNED NOT NULL,
  `Nom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Prenom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` decimal(8,2) DEFAULT NULL,
  `Adress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CIN` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Date_naissance` date DEFAULT NULL,
  `Image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `apprenant`
--

INSERT INTO `apprenant` (`id`, `Nom`, `Prenom`, `Email`, `Phone`, `Adress`, `CIN`, `Date_naissance`, `Image`) VALUES
(1, 'El mliki', 'hicham', 'mliki@gmail.com', '694023.00', 'tanger22', 'K54202', '2001-05-15', 'hicham.png'),
(2, 'stitou', 'nada', 'nada@gmail.com', '999999.99', 'tanger22', 'k440920', '2022-12-09', 'nada.png'),
(3, 'sohli', 'omar', 'omar@gmail.com', '999999.99', 'tanger33', 'k44939393', '2022-12-28', 'omar.png');

-- --------------------------------------------------------

--
-- Structure de la table `apprenant_preparation_brief`
--

CREATE TABLE `apprenant_preparation_brief` (
  `id` bigint UNSIGNED NOT NULL,
  `Date_affectation` date DEFAULT NULL,
  `Preparation_brief_id` int UNSIGNED DEFAULT NULL,
  `Apprenant_id` int UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `apprenant_preparation_brief`
--

INSERT INTO `apprenant_preparation_brief` (`id`, `Date_affectation`, `Preparation_brief_id`, `Apprenant_id`) VALUES
(1, '2022-12-04', 1, 1),
(2, '2022-12-04', 1, 2),
(3, '2022-12-04', 2, 3),
(4, '0000-00-00', 2, 1),
(5, '2022-12-04', 3, 1),
(6, '2022-12-20', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `apprenant_preparation_tache`
--

CREATE TABLE `apprenant_preparation_tache` (
  `id` bigint UNSIGNED NOT NULL,
  `Preparation_tache_id` int UNSIGNED NOT NULL,
  `Apprenant_id` int UNSIGNED NOT NULL,
  `Apprenant_P_Brief_id` int UNSIGNED NOT NULL,
  `Etat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en pouse',
  `date_debut` timestamp NULL DEFAULT NULL,
  `date_fin` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `apprenant_preparation_tache`
--

INSERT INTO `apprenant_preparation_tache` (`id`, `Preparation_tache_id`, `Apprenant_id`, `Apprenant_P_Brief_id`, `Etat`, `date_debut`, `date_fin`) VALUES
(1, 1, 1, 1, 'terminer', NULL, NULL),
(2, 1, 2, 2, 'terminer', '0000-00-00 00:00:00', NULL),
(3, 2, 1, 1, 'terminer', '0000-00-00 00:00:00', NULL),
(4, 4, 1, 5, 'terminer', NULL, NULL),
(5, 5, 1, 1, 'terminer', NULL, NULL),
(6, 3, 1, 4, 'Terminer', NULL, NULL),
(7, 2, 2, 2, 'en pouse', NULL, NULL),
(8, 3, 2, 6, 'terminer', NULL, NULL),
(9, 2, 1, 4, 'en pouse', NULL, NULL),
(10, 3, 2, 6, 'en', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

CREATE TABLE `formateur` (
  `id` int UNSIGNED NOT NULL,
  `Nom_formateur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Prenom_formateur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email_formateur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` decimal(8,2) DEFAULT NULL,
  `Adress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CIN` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formateur`
--

INSERT INTO `formateur` (`id`, `Nom_formateur`, `Prenom_formateur`, `Email_formateur`, `Phone`, `Adress`, `CIN`, `Image`) VALUES
(1, 'esseraj', 'Fouad', 'esseraj@gmail.com', '700777.00', 'tanger 22', 'k432494', 'fouad.png'),
(2, 'soklabi', 'abdlatif', 'abdo@gmail.com', '999999.99', 'tanger 21', 'k403240', 'abdo.png');

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `id` int UNSIGNED NOT NULL,
  `Nom_groupe` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Annee_formation_id` int UNSIGNED DEFAULT NULL,
  `Formateur_id` int UNSIGNED DEFAULT NULL,
  `Logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupes`
--

INSERT INTO `groupes` (`id`, `Nom_groupe`, `Annee_formation_id`, `Formateur_id`, `Logo`) VALUES
(1, 'Debagers', 1, 1, 'debag.png'),
(2, 'Code campers', 2, 1, NULL),
(3, 'siyber gang', 2, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groupes_apprenant`
--

CREATE TABLE `groupes_apprenant` (
  `id` int UNSIGNED NOT NULL,
  `Groupe_id` int UNSIGNED DEFAULT NULL,
  `Apprenant_id` int UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupes_apprenant`
--

INSERT INTO `groupes_apprenant` (`id`, `Groupe_id`, `Apprenant_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 3, 3),
(4, 1, 1),
(5, 1, 2),
(6, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `groupes_preparation_brief`
--

CREATE TABLE `groupes_preparation_brief` (
  `id` int UNSIGNED NOT NULL,
  `Apprenant_preparation_brief_id` int UNSIGNED DEFAULT NULL,
  `Groupe_id` int UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupes_preparation_brief`
--

INSERT INTO `groupes_preparation_brief` (`id`, `Apprenant_preparation_brief_id`, `Groupe_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 5, 1),
(5, 4, 2),
(6, 3, 3),
(7, 6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_08_31_192902_create_Formateur', 1),
(3, '2022_09_20_142240_create_anne_formation', 1),
(4, '2022_10_20_134148_create_promotions_table', 1),
(5, '2022_10_29_134206_create_students_table', 1),
(6, '2022_10_29_192902_create_Preparation_briefs_table', 1),
(7, '2022_10_30_123007_create_tasks_table', 1),
(8, '2022_10_30_134206_create_apprenant_promotion', 1),
(9, '2022_11_25_184431_create_briefs_students_table', 1),
(10, '2022_11_30_142240_create_students_task_table copy', 1),
(11, '2022_12_30_134206_create_Groupe_PreparationBrief', 1);

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `preparation_brief`
--

CREATE TABLE `preparation_brief` (
  `id` int UNSIGNED NOT NULL,
  `Nom_du_brief` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Duree` decimal(8,2) DEFAULT NULL,
  `Formateur_id` int UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `preparation_brief`
--

INSERT INTO `preparation_brief` (`id`, `Nom_du_brief`, `Description`, `Duree`, `Formateur_id`) VALUES
(1, 'brief 1', 'brief hass loress', '2.00', 1),
(2, 'brief 2', 'ddeaqdffs', '4.00', 2),
(3, 'brief 3', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `preparation_tache`
--

CREATE TABLE `preparation_tache` (
  `id` int UNSIGNED NOT NULL,
  `Nom_tache` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Duree` decimal(8,2) DEFAULT NULL,
  `Preparation_brief_id` int UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `preparation_tache`
--

INSERT INTO `preparation_tache` (`id`, `Nom_tache`, `Description`, `Duree`, `Preparation_brief_id`) VALUES
(1, 'tach 1', 'dddtach tach', '2.00', 1),
(2, 'tach 2', 'dddtach tach', '2.00', 1),
(3, 'tach 3', 'dddtach tach', '2.00', 2),
(4, 'tach 1', NULL, NULL, 3),
(5, 'tache 6', 'eee', '2.00', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annee_formation`
--
ALTER TABLE `annee_formation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `apprenant`
--
ALTER TABLE `apprenant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `apprenant_preparation_brief`
--
ALTER TABLE `apprenant_preparation_brief`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apprenant_preparation_brief_apprenant_id_foreign` (`Apprenant_id`),
  ADD KEY `apprenant_preparation_brief_preparation_brief_id_foreign` (`Preparation_brief_id`);

--
-- Index pour la table `apprenant_preparation_tache`
--
ALTER TABLE `apprenant_preparation_tache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apprenant_preparation_tache_preparation_tache_id_foreign` (`Preparation_tache_id`),
  ADD KEY `apprenant_preparation_tache_apprenant_p_brief_id_foreign` (`Apprenant_P_Brief_id`),
  ADD KEY `apprenant_preparation_tache_apprenant_id_foreign` (`Apprenant_id`);

--
-- Index pour la table `formateur`
--
ALTER TABLE `formateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupes_annee_formation_id_foreign` (`Annee_formation_id`),
  ADD KEY `groupes_formateur_id_foreign` (`Formateur_id`);

--
-- Index pour la table `groupes_apprenant`
--
ALTER TABLE `groupes_apprenant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupes_apprenant_groupe_id_foreign` (`Groupe_id`),
  ADD KEY `groupes_apprenant_apprenant_id_foreign` (`Apprenant_id`);

--
-- Index pour la table `groupes_preparation_brief`
--
ALTER TABLE `groupes_preparation_brief`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupes_preparation_brief_apprenant_preparation_brief_id_foreign` (`Apprenant_preparation_brief_id`),
  ADD KEY `groupes_preparation_brief_groupe_id_foreign` (`Groupe_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `preparation_brief`
--
ALTER TABLE `preparation_brief`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preparation_brief_formateur_id_foreign` (`Formateur_id`);

--
-- Index pour la table `preparation_tache`
--
ALTER TABLE `preparation_tache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preparation_tache_preparation_brief_id_foreign` (`Preparation_brief_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annee_formation`
--
ALTER TABLE `annee_formation`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `apprenant`
--
ALTER TABLE `apprenant`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `apprenant_preparation_brief`
--
ALTER TABLE `apprenant_preparation_brief`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `apprenant_preparation_tache`
--
ALTER TABLE `apprenant_preparation_tache`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `formateur`
--
ALTER TABLE `formateur`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `groupes_apprenant`
--
ALTER TABLE `groupes_apprenant`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `groupes_preparation_brief`
--
ALTER TABLE `groupes_preparation_brief`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `preparation_brief`
--
ALTER TABLE `preparation_brief`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `preparation_tache`
--
ALTER TABLE `preparation_tache`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
