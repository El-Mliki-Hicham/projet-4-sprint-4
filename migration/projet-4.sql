-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 23 nov. 2022 à 15:28
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
-- Base de données : `projet-4`
--

-- --------------------------------------------------------

--
-- Structure de la table `briefs`
--

CREATE TABLE `briefs` (
  `id` int UNSIGNED NOT NULL,
  `Nom_du_brief` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Date_heure_de_livraison` date DEFAULT NULL,
  `Date_heure_de_récupération` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `briefs`
--

INSERT INTO `briefs` (`id`, `Nom_du_brief`, `Date_heure_de_livraison`, `Date_heure_de_récupération`) VALUES
(1, 'brief 1', '2022-11-01', '2022-11-02'),
(2, 'brief 2', '2022-11-03', '2022-11-04');

-- --------------------------------------------------------

--
-- Structure de la table `briefs_student`
--

CREATE TABLE `briefs_student` (
  `id` bigint UNSIGNED NOT NULL,
  `briefs_id` int UNSIGNED DEFAULT NULL,
  `student_id` int UNSIGNED DEFAULT NULL,
  `promotion_id` int UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2022_10_29_134148_create_promotions_table', 1),
(3, '2022_10_29_134206_create_students_table', 1),
(4, '2022_10_31_192902_create_briefs_table', 1),
(5, '2022_10_31_193007_create_tasks_table', 1),
(6, '2022_11_04_184431_create_briefs_students_table', 1),
(7, '2022_11_20_142240_create_students_task_table', 1);

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
-- Structure de la table `promotions`
--

CREATE TABLE `promotions` (
  `id` int UNSIGNED NOT NULL,
  `Name_promotion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `promotions`
--

INSERT INTO `promotions` (`id`, `Name_promotion`, `created_at`, `updated_at`) VALUES
(1, 'promotion 1', '2022-11-08 15:24:12', NULL),
(2, 'promotion 2', '2022-11-08 15:24:12', NULL),
(3, 'promotion 3', '2022-11-08 15:24:12', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE `students` (
  `id` int UNSIGNED NOT NULL,
  `First_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promotion_id` int UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `students`
--

INSERT INTO `students` (`id`, `First_name`, `Last_name`, `Email`, `promotion_id`) VALUES
(1, 'student  1', 'stude', 'student1@gmail.com', 1),
(2, 'student  2', 'stude', 'student2@gmail.com', 1),
(3, 'student  4', 'stude', 'student4@gmail.com', 2);

-- --------------------------------------------------------

--
-- Structure de la table `student_tasks`
--

CREATE TABLE `student_tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `tasks_id` int UNSIGNED NOT NULL,
  `briefs_id` int UNSIGNED DEFAULT NULL,
  `Etat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en pouse',
  `date_debut` timestamp NOT NULL,
  `date_fin` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `student_tasks`
--

INSERT INTO `student_tasks` (`id`, `student_id`, `tasks_id`, `briefs_id`, `Etat`, `date_debut`, `date_fin`) VALUES
(1, 1, 1, 1, 'en coure', '2022-11-23 15:26:23', '2022-11-23 15:26:23'),
(2, 1, 2, 1, 'en coure', '2022-11-23 15:26:36', '2022-11-23 15:26:36'),
(3, 1, 3, 2, 'en coure', '2022-11-23 15:27:11', '2022-11-23 15:27:11'),
(4, 2, 1, 1, 'en pouse', '2022-11-23 15:27:38', '2022-11-23 15:27:38'),
(5, 2, 2, 1, 'en pouse', '2022-11-23 15:27:51', '2022-11-23 15:27:51');

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE `tasks` (
  `id` int UNSIGNED NOT NULL,
  `Nom_de_la_tache` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Debut_de_la_tache` timestamp NULL DEFAULT NULL,
  `Fin_de_la_tache` timestamp NULL DEFAULT NULL,
  `Description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `briefs_id` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tasks`
--

INSERT INTO `tasks` (`id`, `Nom_de_la_tache`, `Debut_de_la_tache`, `Fin_de_la_tache`, `Description`, `briefs_id`) VALUES
(1, 'tach 1', '2022-11-01 15:24:50', '2022-11-02 15:24:50', 'aaa', 1),
(2, 'tach 2', '2022-11-01 15:24:50', '2022-11-01 17:24:50', 'aaa', 1),
(3, 'tach 3', '2022-11-01 15:24:50', '2022-11-01 17:24:50', 'aaa', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `briefs`
--
ALTER TABLE `briefs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `briefs_student`
--
ALTER TABLE `briefs_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `briefs_student_student_id_foreign` (`student_id`),
  ADD KEY `briefs_student_briefs_id_foreign` (`briefs_id`);

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
-- Index pour la table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_promotion_id_foreign` (`promotion_id`);

--
-- Index pour la table `student_tasks`
--
ALTER TABLE `student_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_tasks_student_id_foreign` (`student_id`),
  ADD KEY `student_tasks_tasks_id_foreign` (`tasks_id`);

--
-- Index pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_briefs_id_foreign` (`briefs_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `briefs`
--
ALTER TABLE `briefs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `briefs_student`
--
ALTER TABLE `briefs_student`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `students`
--
ALTER TABLE `students`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `student_tasks`
--
ALTER TABLE `student_tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
