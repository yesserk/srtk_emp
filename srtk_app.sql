-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 15 déc. 2023 à 15:36
-- Version du serveur : 8.0.30
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `srtk_app`
--

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(5, '2023_12_12_094400_create_ticket_table', 2),
(6, '2023_12_12_094924_create_ticket_table', 3),
(7, '2023_12_12_095033_create_ticket_table', 4);

-- --------------------------------------------------------

--
-- Structure de la table `srtk_bus`
--

CREATE TABLE `srtk_bus` (
  `code_car` int NOT NULL,
  `immatriculation` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `user_id` bigint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_bus`
--

INSERT INTO `srtk_bus` (`code_car`, `immatriculation`, `marque`, `user_id`) VALUES
(1456, '111 تونس 2001', 'marque', 0),
(55555, '1111111111111', 'marquetggg', 0),
(66666, '523999', 'marquetggg', 0);

--
-- Déclencheurs `srtk_bus`
--
DELIMITER $$
CREATE TRIGGER `srtk_bus_delete_trigger` AFTER DELETE ON `srtk_bus` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (OLD.user_id, CONCAT('Suppression du bus ', OLD.code_car, ' dans srtk_bus par utilisateur ', OLD.user_id), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_bus_insert_trigger` AFTER INSERT ON `srtk_bus` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Ajout d un bus ', NEW.code_car, ' dans srtk_bus par utilisateur ', NEW.user_id), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_bus_update_trigger` AFTER UPDATE ON `srtk_bus` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Mise à jour du bus ', NEW.code_car, ' dans srtk_bus par utilisateur ', NEW.user_id), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `srtk_caisse`
--

CREATE TABLE `srtk_caisse` (
  `id` int NOT NULL,
  `date` date NOT NULL,
  `voyage_id` int NOT NULL,
  `montant` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_caisse`
--

INSERT INTO `srtk_caisse` (`id`, `date`, `voyage_id`, `montant`, `user_id`) VALUES
(8, '2023-11-14', 7, 456321, 2);

--
-- Déclencheurs `srtk_caisse`
--
DELIMITER $$
CREATE TRIGGER `srtk_caisse_delete_trigger` AFTER DELETE ON `srtk_caisse` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (OLD.user_id, CONCAT('Suppression de lentrée avec ID ', OLD.id, ' dans srtk_caisse'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_caisse_insert_trigger` AFTER INSERT ON `srtk_caisse` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Ajout d une entrée dans srtk_caisse avec ID ', NEW.id), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_caisse_update_trigger` AFTER UPDATE ON `srtk_caisse` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Mise à jour de lentrée avec ID ', NEW.id, ' dans srtk_caisse'), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `srtk_employees`
--

CREATE TABLE `srtk_employees` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `phone` int NOT NULL,
  `cin` int NOT NULL,
  `type_id` int NOT NULL,
  `matricule_employee` varchar(255) NOT NULL,
  `date_embauche` date NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_employees`
--

INSERT INTO `srtk_employees` (`id`, `nom`, `date_naissance`, `phone`, `cin`, `type_id`, `matricule_employee`, `date_embauche`, `user_id`) VALUES
(2, 'Sirin', '2000-06-25', 56433210, 11144931, 2, '551234567895', '2023-11-01', 2),
(3, 'Test employee', '2023-11-03', 88996655, 77889955, 4, '888775522100', '2023-11-14', 2),
(4, 'Yasser Kadhi', '2023-11-03', 11111111, 55555555, 2, '666666666666', '2023-11-11', 2),
(6, 'test', '2023-12-13', 11111111, 11111111, 2, '111111111111', '2023-12-14', 2);

--
-- Déclencheurs `srtk_employees`
--
DELIMITER $$
CREATE TRIGGER `srtk_employee_delete_trigger` AFTER DELETE ON `srtk_employees` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (OLD.user_id, CONCAT('Suppression de l employé ', OLD.nom, ' avec ID ', OLD.id, ' dans srtk_employee'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_employee_insert_trigger` AFTER INSERT ON `srtk_employees` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Ajout l\'un employé ', NEW.nom, ' avec ID ', NEW.id, ' dans srtk_employees'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_employee_update_trigger` AFTER UPDATE ON `srtk_employees` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Mise à jour de l\'employé ', NEW.nom, ' avec ID ', NEW.id, ' dans srtk_employee'), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `srtk_employee_etat`
--

CREATE TABLE `srtk_employee_etat` (
  `id` int NOT NULL,
  `employee_id` int NOT NULL,
  `etat_id` int NOT NULL,
  `date_etat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_employee_etat`
--

INSERT INTO `srtk_employee_etat` (`id`, `employee_id`, `etat_id`, `date_etat`) VALUES
(2, 4, 7, '2023-12-22'),
(4, 2, 5, '2023-12-01');

-- --------------------------------------------------------

--
-- Structure de la table `srtk_etat_employee`
--

CREATE TABLE `srtk_etat_employee` (
  `id` int NOT NULL,
  `etat` varchar(255) NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_etat_employee`
--

INSERT INTO `srtk_etat_employee` (`id`, `etat`, `user_id`) VALUES
(4, 'راحة السواق', 2),
(5, 'إجازة السواق', 2),
(6, 'بحالة ايقاف', 2),
(7, 'السواق الاحتياطيون', 2),
(8, 'على ذمة الورشة', 2);

--
-- Déclencheurs `srtk_etat_employee`
--
DELIMITER $$
CREATE TRIGGER `srtk_etat_employee_delete_trigger` AFTER DELETE ON `srtk_etat_employee` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (OLD.user_id, CONCAT('Suppression de l état ', OLD.etat, ' avec ID ', OLD.id, ' dans srtk_etat_employee'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_etat_employee_insert_trigger` AFTER INSERT ON `srtk_etat_employee` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Ajout d un état ', NEW.etat, ' avec ID ', NEW.id, ' dans srtk_etat_employee'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_etat_employee_update_trigger` AFTER UPDATE ON `srtk_etat_employee` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Mise à jour de l état ', NEW.etat, ' avec ID ', NEW.id, ' dans srtk_etat_employee'), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `srtk_gare`
--

CREATE TABLE `srtk_gare` (
  `id` int NOT NULL,
  `gare` varchar(255) NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_gare`
--

INSERT INTO `srtk_gare` (`id`, `gare`, `user_id`) VALUES
(1, 'فوسانة', 2),
(2, 'سبيطلة', 2),
(3, 'فريانة', 2),
(4, 'القصرين', 2),
(5, 'بين المدن', 2);

--
-- Déclencheurs `srtk_gare`
--
DELIMITER $$
CREATE TRIGGER `srtk_gare_delete_trigger` AFTER DELETE ON `srtk_gare` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (OLD.user_id, CONCAT('Suppression de la gare ', OLD.gare, ' avec ID ', OLD.id, ' dans srtk_gare'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_gare_insert_trigger` AFTER INSERT ON `srtk_gare` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Ajout de la gare ', NEW.gare, ' avec ID ', NEW.id, ' dans srtk_gare'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_gare_update_trigger` AFTER UPDATE ON `srtk_gare` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Mise à jour de la gare ', NEW.gare, ' avec ID ', NEW.id, ' dans srtk_gare'), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `srtk_historique`
--

CREATE TABLE `srtk_historique` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `tache` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_historique`
--

INSERT INTO `srtk_historique` (`id`, `user_id`, `tache`, `date`) VALUES
(15, 0, 'Ajout d un bus 55555 dans srtk_bus par utilisateur 0', '2023-11-06 08:37:45'),
(16, 0, 'Ajout d un bus 66666 dans srtk_bus par utilisateur 0', '2023-11-06 08:37:57'),
(17, 2, 'Ajout d un voyage avec ID 2 dans srtk_voyage', '2023-11-06 08:46:41'),
(18, 2, 'Ajout d une entrée dans srtk_caisse avec ID 1', '2023-11-06 09:24:20'),
(19, 2, 'Ajout d une entrée dans srtk_caisse avec ID 2', '2023-11-06 09:24:31'),
(20, 2, 'Suppression de l\'entrée avec ID 2 dans srtk_caisse', '2023-11-06 09:41:27'),
(21, 2, 'Suppression de l\'entrée avec ID 1 dans srtk_caisse', '2023-11-06 10:03:57'),
(22, 2, 'Ajout d une entrée dans srtk_caisse avec ID 3', '2023-11-06 10:06:36'),
(23, 2, 'Suppression de l\'entrée avec ID 3 dans srtk_caisse', '2023-11-06 10:08:08'),
(24, 2, 'Ajout d une entrée dans srtk_caisse avec ID 4', '2023-11-06 10:08:20'),
(25, 2, 'Ajout d un voyage avec ID 3 dans srtk_voyage', '2023-11-06 10:08:41'),
(26, 2, 'Ajout d une entrée dans srtk_caisse avec ID 5', '2023-11-06 10:08:47'),
(27, 2, 'Ajout d un voyage avec ID 4 dans srtk_voyage', '2023-11-06 10:09:11'),
(28, 2, 'Ajout d une entrée dans srtk_caisse avec ID 6', '2023-11-09 15:07:11'),
(29, 2, 'Ajout d un voyage avec ID 5 dans srtk_voyage', '2023-11-09 15:11:58'),
(30, 2, 'Mise à jour de l\'entrée avec ID 4 dans srtk_caisse', '2023-11-09 16:05:39'),
(31, 2, 'Suppression de l\'entrée avec ID 4 dans srtk_caisse', '2023-11-09 16:23:04'),
(32, 2, 'Suppression de l\'entrée avec ID 6 dans srtk_caisse', '2023-11-09 16:23:07'),
(33, 2, 'Ajout d une entrée dans srtk_caisse avec ID 7', '2023-11-09 16:25:04'),
(34, 2, 'Ajout d un voyage avec ID 6 dans srtk_voyage', '2023-11-10 10:55:14'),
(35, 2, 'Mise à jour du voyage avec ID 2 dans srtk_voyage', '2023-11-10 12:25:11'),
(36, 2, 'Mise à jour du voyage avec ID 3 dans srtk_voyage', '2023-11-10 12:25:14'),
(37, 2, 'Mise à jour du voyage avec ID 4 dans srtk_voyage', '2023-11-10 12:25:19'),
(38, 2, 'Mise à jour du voyage avec ID 4 dans srtk_voyage', '2023-11-10 12:25:21'),
(39, 2, 'Mise à jour du voyage avec ID 5 dans srtk_voyage', '2023-11-10 12:25:25'),
(40, 2, 'Mise à jour du voyage avec ID 6 dans srtk_voyage', '2023-11-10 12:25:30'),
(41, 2, 'Mise à jour du voyage avec ID 2 dans srtk_voyage', '2023-11-10 12:25:32'),
(42, 2, 'Mise à jour du voyage avec ID 6 dans srtk_voyage', '2023-11-10 13:00:12'),
(43, 2, 'Mise à jour du voyage avec ID 3 dans srtk_voyage', '2023-11-10 13:00:16'),
(44, 2, 'Ajout d un voyage avec ID 7 dans srtk_voyage', '2023-11-10 13:03:49'),
(45, 2, 'Ajout d une entrée dans srtk_caisse avec ID 8', '2023-11-10 13:04:58'),
(46, 2, 'Mise à jour de l\'entrée avec ID 5 dans srtk_caisse', '2023-11-14 09:12:28'),
(47, 2, 'Mise à jour de l\'entrée avec ID 7 dans srtk_caisse', '2023-11-14 09:12:33'),
(48, 2, 'Mise à jour de l\'entrée avec ID 8 dans srtk_caisse', '2023-11-14 09:12:35'),
(49, 2, 'Mise à jour du voyage avec ID 2 dans srtk_voyage', '2023-11-14 09:12:51'),
(50, 2, 'Mise à jour du voyage avec ID 3 dans srtk_voyage', '2023-11-14 09:12:55'),
(51, 2, 'Mise à jour du voyage avec ID 4 dans srtk_voyage', '2023-11-14 09:12:58'),
(52, 2, 'Mise à jour du voyage avec ID 5 dans srtk_voyage', '2023-11-14 09:13:01'),
(53, 2, 'Mise à jour du voyage avec ID 6 dans srtk_voyage', '2023-11-14 09:13:09'),
(54, 2, 'Mise à jour du voyage avec ID 7 dans srtk_voyage', '2023-11-14 09:13:16'),
(55, 2, 'Mise à jour du voyage avec ID 7 dans srtk_voyage', '2023-11-14 13:02:03'),
(56, 2, 'Mise à jour du voyage avec ID 7 dans srtk_voyage', '2023-11-14 13:02:14'),
(57, 2, 'Mise à jour du voyage avec ID 3 dans srtk_voyage', '2023-11-14 13:04:32'),
(58, 2, 'Mise à jour du voyage avec ID 3 dans srtk_voyage', '2023-11-14 13:05:33'),
(59, 2, 'Mise à jour du voyage avec ID 4 dans srtk_voyage', '2023-11-14 13:06:13'),
(60, 2, 'Mise à jour du voyage avec ID 2 dans srtk_voyage', '2023-11-14 13:13:52'),
(61, 2, 'Mise à jour du voyage avec ID 3 dans srtk_voyage', '2023-11-14 13:15:21'),
(62, 2, 'Mise à jour du voyage avec ID 4 dans srtk_voyage', '2023-11-14 13:15:26'),
(63, 2, 'Suppression de l\'entrée avec ID 5 dans srtk_caisse', '2023-11-14 14:23:11'),
(64, 2, 'Suppression de l\'entrée avec ID 7 dans srtk_caisse', '2023-11-14 14:23:14'),
(65, 2, 'Ajout d un voyage avec ID 8 dans srtk_voyage', '2023-12-12 15:44:09'),
(66, 1, 'Ajout de la ligne test avec ID 2000 dans srtk_ligne', '2023-12-12 16:11:18'),
(67, 1, 'Ajout de la ligne test avec ID 1000 dans srtk_ligne', '2023-12-12 16:11:32'),
(68, 2, 'Mise à jour du voyage avec ID 3 dans srtk_voyage', '2023-12-12 16:12:01'),
(69, 2, 'Mise à jour du voyage avec ID 4 dans srtk_voyage', '2023-12-12 16:12:05'),
(70, 2, 'Suppression du voyage avec ID 8 dans srtk_voyage', '2023-12-12 16:12:09'),
(71, 2, 'Mise à jour du voyage avec ID 5 dans srtk_voyage', '2023-12-12 16:12:12'),
(72, 2, 'Suppression du voyage avec ID 4 dans srtk_voyage', '2023-12-12 16:12:14'),
(73, 2, 'Mise à jour du voyage avec ID 6 dans srtk_voyage', '2023-12-12 16:12:17'),
(74, 2, 'Mise à jour du voyage avec ID 7 dans srtk_voyage', '2023-12-12 16:12:20'),
(75, 2, 'Mise à jour du voyage avec ID 2 dans srtk_voyage', '2023-12-12 16:12:24'),
(76, 2, 'Ajout d\'un employé test avec ID 6 dans srtk_employees', '2023-12-13 09:10:21'),
(77, 2, 'Mise à jour de l\'employé Sirin Hadiji avec ID 2 dans srtk_employee', '2023-12-13 09:10:47'),
(78, 2, 'Mise à jour de l\'employé Sirin Hadiji avec ID 2 dans srtk_employee', '2023-12-13 09:10:57'),
(79, 2, 'Mise à jour de l\'employé Sirin avec ID 2 dans srtk_employee', '2023-12-13 09:11:08'),
(80, 2, 'Mise à jour du voyage avec ID 2 dans srtk_voyage', '2023-12-14 09:52:15'),
(81, 2, 'Mise à jour du voyage avec ID 3 dans srtk_voyage', '2023-12-14 09:52:20'),
(82, 2, 'Mise à jour du voyage avec ID 5 dans srtk_voyage', '2023-12-14 09:52:22'),
(83, 2, 'Mise à jour du voyage avec ID 6 dans srtk_voyage', '2023-12-14 09:52:25'),
(84, 2, 'Mise à jour du voyage avec ID 7 dans srtk_voyage', '2023-12-14 09:52:27'),
(85, 2, 'Mise à jour du voyage avec ID 6 dans srtk_voyage', '2023-12-14 09:57:35'),
(86, 2, 'Mise à jour du voyage avec ID 3 dans srtk_voyage', '2023-12-14 09:58:15'),
(87, 2, 'Mise à jour du voyage avec ID 3 dans srtk_voyage', '2023-12-14 10:00:46'),
(88, 2, 'Mise à jour du voyage avec ID 6 dans srtk_voyage', '2023-12-14 10:01:09'),
(89, 2, 'Mise à jour du voyage avec ID 7 dans srtk_voyage', '2023-12-14 10:01:27'),
(90, 2, 'Mise à jour du voyage avec ID 2 dans srtk_voyage', '2023-12-15 08:34:17'),
(91, 2, 'Mise à jour du voyage avec ID 3 dans srtk_voyage', '2023-12-15 08:34:20'),
(92, 2, 'Mise à jour du voyage avec ID 5 dans srtk_voyage', '2023-12-15 08:34:23'),
(93, 2, 'Mise à jour du voyage avec ID 6 dans srtk_voyage', '2023-12-15 08:34:26'),
(94, 2, 'Mise à jour du voyage avec ID 7 dans srtk_voyage', '2023-12-15 08:34:29'),
(95, 2, 'Mise à jour du voyage avec ID 2 dans srtk_voyage', '2023-12-15 11:27:50'),
(96, 2, 'Mise à jour du voyage avec ID 3 dans srtk_voyage', '2023-12-15 11:27:54'),
(97, 2, 'Mise à jour du voyage avec ID 2 dans srtk_voyage', '2023-12-15 14:18:57'),
(98, 2, 'Mise à jour du voyage avec ID 3 dans srtk_voyage', '2023-12-15 14:19:01');

-- --------------------------------------------------------

--
-- Structure de la table `srtk_ligne`
--

CREATE TABLE `srtk_ligne` (
  `id` int NOT NULL,
  `ligne` varchar(255) NOT NULL,
  `num_ligne` int NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_ligne`
--

INSERT INTO `srtk_ligne` (`id`, `ligne`, `num_ligne`, `user_id`) VALUES
(1, 'دشرة بوغانم-فوسانة', 2001, NULL),
(5, 'العذيرة - فوسانة', 444, 2),
(1000, 'test', 500, 1),
(2000, 'test', 500, 1);

--
-- Déclencheurs `srtk_ligne`
--
DELIMITER $$
CREATE TRIGGER `srtk_ligne_delete_trigger` AFTER DELETE ON `srtk_ligne` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (OLD.user_id, CONCAT('Suppression de la ligne ', OLD.ligne, ' avec ID ', OLD.id, ' dans srtk_ligne'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_ligne_insert_trigger` AFTER INSERT ON `srtk_ligne` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Ajout de la ligne ', NEW.ligne, ' avec ID ', NEW.id, ' dans srtk_ligne'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_ligne_update_trigger` AFTER UPDATE ON `srtk_ligne` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Mise à jour de la ligne ', NEW.ligne, ' avec ID ', NEW.id, ' dans srtk_ligne'), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `srtk_ligne_station`
--

CREATE TABLE `srtk_ligne_station` (
  `id` int NOT NULL,
  `ligne` int NOT NULL,
  `station` int NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_ligne_station`
--

INSERT INTO `srtk_ligne_station` (`id`, `ligne`, `station`, `user_id`) VALUES
(6, 1, 1, NULL),
(8, 1, 2, NULL),
(9, 1, 4, NULL);

--
-- Déclencheurs `srtk_ligne_station`
--
DELIMITER $$
CREATE TRIGGER `srtk_ligne_station_delete_trigger` AFTER DELETE ON `srtk_ligne_station` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (OLD.user_id, CONCAT('Suppression de la relation entre la ligne (ID ', OLD.ligne, ') et la station (ID ', OLD.station, ') dans srtk_ligne_station avec ID ', OLD.id), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_ligne_station_insert_trigger` AFTER INSERT ON `srtk_ligne_station` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Ajout de la relation entre la ligne (ID ', NEW.ligne, ') et la station (ID ', NEW.station, ') dans srtk_ligne_station avec ID ', NEW.id), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_ligne_station_update_trigger` AFTER UPDATE ON `srtk_ligne_station` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Mise à jour de la relation entre la ligne (ID ', NEW.ligne, ') et la station (ID ', NEW.station, ') dans srtk_ligne_station avec ID ', NEW.id), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `srtk_permission`
--

CREATE TABLE `srtk_permission` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `users` int NOT NULL,
  `employee` int NOT NULL,
  `type_employee` int NOT NULL,
  `etat_employee` int NOT NULL,
  `gare` int NOT NULL,
  `bus` int NOT NULL,
  `ligne` int NOT NULL,
  `station` int NOT NULL,
  `voyage` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_permission`
--

INSERT INTO `srtk_permission` (`id`, `user_id`, `users`, `employee`, `type_employee`, `etat_employee`, `gare`, `bus`, `ligne`, `station`, `voyage`) VALUES
(2, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `srtk_reservation`
--

CREATE TABLE `srtk_reservation` (
  `id` int NOT NULL,
  `client` varchar(255) NOT NULL,
  `date_voyage` date NOT NULL,
  `station_debut` varchar(255) NOT NULL,
  `station_fin` varchar(255) NOT NULL,
  `type_payement` int NOT NULL,
  `montant_espece` int DEFAULT NULL,
  `num_paiement` int DEFAULT NULL,
  `montant_cheque` int DEFAULT NULL,
  `num_cheque` int DEFAULT NULL,
  `banque` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_reservation`
--

INSERT INTO `srtk_reservation` (`id`, `client`, `date_voyage`, `station_debut`, `station_fin`, `type_payement`, `montant_espece`, `num_paiement`, `montant_cheque`, `num_cheque`, `banque`) VALUES
(3, 'test', '2023-12-15', 'مكان الانطلاق', 'مكان الوصول', 2, NULL, NULL, 5666, 5896, '2000'),
(4, 'test', '2023-12-15', 'مكان الانطلاق', 'مكان الوصول', 1, 4000, 896663, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `srtk_resume`
--

CREATE TABLE `srtk_resume` (
  `id` int NOT NULL,
  `date_resume` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `srtk_station`
--

CREATE TABLE `srtk_station` (
  `id` int NOT NULL,
  `num_station` int NOT NULL,
  `station` varchar(255) NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_station`
--

INSERT INTO `srtk_station` (`id`, `num_station`, `station`, `user_id`) VALUES
(1, 1, 'station', NULL),
(2, 12000, 'station2', 2),
(4, 88888, 'test', 2);

--
-- Déclencheurs `srtk_station`
--
DELIMITER $$
CREATE TRIGGER `srtk_station_delete_trigger` AFTER DELETE ON `srtk_station` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (OLD.user_id, CONCAT('Suppression de la station ', OLD.station, ' avec ID ', OLD.id, ' dans srtk_station'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_station_insert_trigger` AFTER INSERT ON `srtk_station` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Ajout de la station ', NEW.station, ' avec ID ', NEW.id, ' dans srtk_station'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_station_update_trigger` AFTER UPDATE ON `srtk_station` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Mise à jour de la station ', NEW.station, ' avec ID ', NEW.id, ' dans srtk_station'), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `srtk_ticket`
--

CREATE TABLE `srtk_ticket` (
  `id` int NOT NULL,
  `genre` varchar(255) NOT NULL,
  `prix` int NOT NULL,
  `personalise` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_ticket`
--

INSERT INTO `srtk_ticket` (`id`, `genre`, `prix`, `personalise`) VALUES
(1, 'نوع1', 600, 0),
(4, 'نوع2', 1000, 0),
(5, 'نوع3', 3000, 0),
(6, 'نوع4', 5000, 1),
(7, 'نوع5', 6000, 1),
(9, 'نوع7', 100, 1),
(10, 'نوع100000', 1000, 1);

-- --------------------------------------------------------

--
-- Structure de la table `srtk_ticket_voyage`
--

CREATE TABLE `srtk_ticket_voyage` (
  `id` int NOT NULL,
  `ticket_id` int NOT NULL,
  `voyage_id` int NOT NULL,
  `nbre_ticket` int NOT NULL,
  `debut` int DEFAULT NULL,
  `fin` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_ticket_voyage`
--

INSERT INTO `srtk_ticket_voyage` (`id`, `ticket_id`, `voyage_id`, `nbre_ticket`, `debut`, `fin`) VALUES
(45, 7, 2, 40, NULL, NULL),
(46, 4, 2, 17, 3, 20),
(47, 1, 3, 200, 0, 200),
(48, 6, 3, 30, NULL, NULL),
(49, 9, 3, 20, NULL, NULL),
(50, 7, 5, 20, NULL, NULL),
(51, 4, 5, 193, 0, 200),
(52, 1, 5, 199, 1, 200);

-- --------------------------------------------------------

--
-- Structure de la table `srtk_total`
--

CREATE TABLE `srtk_total` (
  `id` int NOT NULL,
  `total_voyage` int NOT NULL,
  `total_reservation` int NOT NULL,
  `total_scolaire` int NOT NULL,
  `total_professionnel` int NOT NULL,
  `date_resume` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `srtk_type_employee`
--

CREATE TABLE `srtk_type_employee` (
  `id` int NOT NULL,
  `type_employee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_type_employee`
--

INSERT INTO `srtk_type_employee` (`id`, `type_employee`, `user_id`) VALUES
(2, 'سائق', NULL),
(4, 'قابض', NULL);

--
-- Déclencheurs `srtk_type_employee`
--
DELIMITER $$
CREATE TRIGGER `srtk_type_employee_delete_trigger` AFTER DELETE ON `srtk_type_employee` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (OLD.user_id, CONCAT('Suppression du type l\'employé ', OLD.type_employee, ' avec ID ', OLD.id, ' dans srtk_type_employee'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_type_employee_insert_trigger` AFTER INSERT ON `srtk_type_employee` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Ajout du type l\'employé ', NEW.type_employee, ' avec ID ', NEW.id, ' dans srtk_type_employee'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_type_employee_update_trigger` AFTER UPDATE ON `srtk_type_employee` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Mise à jour du type l\'employé ', NEW.type_employee, ' avec ID ', NEW.id, ' dans srtk_type_employee'), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `srtk_voyage`
--

CREATE TABLE `srtk_voyage` (
  `id` int NOT NULL,
  `date_voyage` date NOT NULL,
  `heur_depart` varchar(255) NOT NULL,
  `gare_id` int NOT NULL,
  `ligne_id` int NOT NULL,
  `bus_id` int NOT NULL,
  `chauffeur_id` int NOT NULL,
  `receveur_id` int NOT NULL,
  `Commentaire` varchar(255) NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `srtk_voyage`
--

INSERT INTO `srtk_voyage` (`id`, `date_voyage`, `heur_depart`, `gare_id`, `ligne_id`, `bus_id`, `chauffeur_id`, `receveur_id`, `Commentaire`, `user_id`) VALUES
(2, '2023-12-15', '9:30', 4, 0, 55555, 4, 2, '(test', 2),
(3, '2023-12-15', '10:00', 5, 1001, 66666, 4, 3, 'tets', 2),
(5, '2023-12-15', '10:00', 3, 4000, 55555, 4, 3, 'test', 2),
(6, '2023-12-15', '10:00', 2, 3000, 55555, 4, 3, 'tttt', 2),
(7, '2023-12-15', '10:00', 5, 1100, 55555, 4, 3, 'tttttt', 2);

--
-- Déclencheurs `srtk_voyage`
--
DELIMITER $$
CREATE TRIGGER `srtk_voyage_delete_trigger` AFTER DELETE ON `srtk_voyage` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (OLD.user_id, CONCAT('Suppression du voyage avec ID ', OLD.id, ' dans srtk_voyage'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_voyage_insert_trigger` AFTER INSERT ON `srtk_voyage` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Ajout d un voyage avec ID ', NEW.id, ' dans srtk_voyage'), NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `srtk_voyage_update_trigger` AFTER UPDATE ON `srtk_voyage` FOR EACH ROW BEGIN
    INSERT INTO srtk_historique (user_id, tache, date)
    VALUES (NEW.user_id, CONCAT('Mise à jour du voyage avec ID ', NEW.id, ' dans srtk_voyage'), NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `srtk_voyageur`
--

CREATE TABLE `srtk_voyageur` (
  `id` int NOT NULL,
  `voyage_id` int NOT NULL,
  `nbre_voyageur` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
  `id` bigint UNSIGNED NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` int NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'adminnnn', 'admin@gmail.com', NULL, '$2y$10$Hm1rPMevgyViyScr0GfGsOylgDvtaq7LPENMPYGKhtAz6.vFYHZgC', NULL, '2023-10-23 10:31:45', '2023-10-24 11:53:05'),
(15, 'Sirin Hadiji', 'sirin@admin.com', NULL, '$2y$10$SEEwehKf8puC3yUIQEpBquFEh1VX2eDakBN8UJCVsaNpGLVQIbpqW', NULL, '2023-11-07 13:24:12', '2023-11-07 13:24:12');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `srtk_bus`
--
ALTER TABLE `srtk_bus`
  ADD PRIMARY KEY (`code_car`);

--
-- Index pour la table `srtk_caisse`
--
ALTER TABLE `srtk_caisse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `srtk_employees`
--
ALTER TABLE `srtk_employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `F` (`type_id`),
  ADD KEY `f14` (`user_id`);

--
-- Index pour la table `srtk_employee_etat`
--
ALTER TABLE `srtk_employee_etat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `srtk_etat_employee`
--
ALTER TABLE `srtk_etat_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f15` (`user_id`);

--
-- Index pour la table `srtk_gare`
--
ALTER TABLE `srtk_gare`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `srtk_historique`
--
ALTER TABLE `srtk_historique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f12` (`user_id`);

--
-- Index pour la table `srtk_ligne`
--
ALTER TABLE `srtk_ligne`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f16` (`user_id`);

--
-- Index pour la table `srtk_ligne_station`
--
ALTER TABLE `srtk_ligne_station`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f8` (`station`),
  ADD KEY `f9` (`ligne`),
  ADD KEY `f17` (`user_id`);

--
-- Index pour la table `srtk_permission`
--
ALTER TABLE `srtk_permission`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `srtk_reservation`
--
ALTER TABLE `srtk_reservation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `srtk_station`
--
ALTER TABLE `srtk_station`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f18` (`user_id`);

--
-- Index pour la table `srtk_ticket`
--
ALTER TABLE `srtk_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `srtk_ticket_voyage`
--
ALTER TABLE `srtk_ticket_voyage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `srtk_total`
--
ALTER TABLE `srtk_total`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `srtk_type_employee`
--
ALTER TABLE `srtk_type_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f19` (`user_id`);

--
-- Index pour la table `srtk_voyage`
--
ALTER TABLE `srtk_voyage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f4` (`bus_id`),
  ADD KEY `f5` (`chauffeur_id`),
  ADD KEY `f6` (`receveur_id`),
  ADD KEY `f7` (`ligne_id`),
  ADD KEY `f20` (`user_id`),
  ADD KEY `f999` (`gare_id`);

--
-- Index pour la table `srtk_voyageur`
--
ALTER TABLE `srtk_voyageur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f500` (`voyage_id`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_user_id_foreign` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `srtk_caisse`
--
ALTER TABLE `srtk_caisse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `srtk_employees`
--
ALTER TABLE `srtk_employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `srtk_employee_etat`
--
ALTER TABLE `srtk_employee_etat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `srtk_etat_employee`
--
ALTER TABLE `srtk_etat_employee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `srtk_gare`
--
ALTER TABLE `srtk_gare`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `srtk_historique`
--
ALTER TABLE `srtk_historique`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT pour la table `srtk_ligne`
--
ALTER TABLE `srtk_ligne`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2001;

--
-- AUTO_INCREMENT pour la table `srtk_ligne_station`
--
ALTER TABLE `srtk_ligne_station`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `srtk_permission`
--
ALTER TABLE `srtk_permission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `srtk_reservation`
--
ALTER TABLE `srtk_reservation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `srtk_station`
--
ALTER TABLE `srtk_station`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `srtk_ticket`
--
ALTER TABLE `srtk_ticket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `srtk_ticket_voyage`
--
ALTER TABLE `srtk_ticket_voyage`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `srtk_total`
--
ALTER TABLE `srtk_total`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `srtk_type_employee`
--
ALTER TABLE `srtk_type_employee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `srtk_voyage`
--
ALTER TABLE `srtk_voyage`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `srtk_voyageur`
--
ALTER TABLE `srtk_voyageur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `srtk_employees`
--
ALTER TABLE `srtk_employees`
  ADD CONSTRAINT `F` FOREIGN KEY (`type_id`) REFERENCES `srtk_type_employee` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `srtk_voyage`
--
ALTER TABLE `srtk_voyage`
  ADD CONSTRAINT `f999` FOREIGN KEY (`gare_id`) REFERENCES `srtk_gare` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `srtk_voyageur`
--
ALTER TABLE `srtk_voyageur`
  ADD CONSTRAINT `f500` FOREIGN KEY (`voyage_id`) REFERENCES `srtk_voyage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
