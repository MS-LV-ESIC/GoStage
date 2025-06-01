-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 01, 2025 at 05:35 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gostage_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id_admin` int NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `mail` varchar(30) DEFAULT NULL,
  `entreprise` varchar(30) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `mail_UNIQUE` (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id_adresse` int NOT NULL AUTO_INCREMENT,
  `rue` varchar(30) DEFAULT NULL,
  `ville` varchar(30) DEFAULT NULL,
  `code_postal` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entreprises`
--

DROP TABLE IF EXISTS `entreprises`;
CREATE TABLE IF NOT EXISTS `entreprises` (
  `id_entreprise` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_adresse` int NOT NULL,
  `password` varchar(45) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id_entreprise`),
  UNIQUE KEY `mail_UNIQUE` (`mail`),
  KEY `fk_entreprises_adresse_idx` (`id_adresse`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `entreprises`
--

INSERT INTO `entreprises` (`id_entreprise`, `nom`, `mail`, `description`, `id_adresse`, `password`, `image`) VALUES
(8, 'Vadim Corporation', 'VadimCorp@gmail.com', 'Entreprise de haute technologie bonjour', 1, '1234', 'image/Capture d\'écran 2025-05-28 153434.png'),
(9, 'MONSTER', 'monster@gmail.com', NULL, 0, 'vr', 'image/images.jpg'),
(10, 'riabov', 'RiabovCorp@gmail.com', NULL, 0, 'vr', '');

-- --------------------------------------------------------

--
-- Table structure for table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `id_etudiant` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_adresse` int NOT NULL,
  `password` varchar(45) NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cursus` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id_etudiant`),
  UNIQUE KEY `mail_UNIQUE` (`mail`),
  KEY `fk_etudiants_adresse1_idx` (`id_adresse`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `etudiants`
--

INSERT INTO `etudiants` (`id_etudiant`, `nom`, `prenom`, `mail`, `id_adresse`, `password`, `description`, `cursus`, `cv`, `image`) VALUES
(6, 'Stesy', 'Stesy', 'stesy@example.com', 1, '1234', 'Jaime bien les fleures', 'Licence Informatique', 'cv/CV - zedez edzedz (2).pdf', 'image/Capture d\'écran 2025-05-28 154353.png'),
(7, 'Ludovic', 'Ludo', 'ludovic@example.com', 1, 'hashed_password2', 'Description for Ludovic', 'Master SIO', '', ''),
(8, 'Marie', 'Marie', 'marie@example.com', 1, 'hashed_password3', 'Description for Marie', 'BTS SIO', '', ''),
(9, 'Riabov Vad', 'Vadim', 'vadim@gmail.com', 0, '1234', 'Jaime les Technologies sur les robot humanoid', 'BTS-SIO-SLAM', 'cv/CV - vadim riabov (3) (2).pdf', 'image/изображение_2025-06-01_144722604.png'),
(10, 'Rudenko', 'Vika', 'rud@gmail.com', 0, 'vk', '', 'BTS-SIO-SLAM', '', 'image/images.jpg'),
(11, 'vadim', 'riabov', 'riabov@gmail.com', 0, 'vr', 'ss', 'BTS SIO SLAM', '', 'image/Screenshot 2025-05-30 120018.png'),
(12, 'fff', 'fff', 'fff@gmail.com', 0, '5555', '', '', '', ''),
(13, 'comp', 'womp', 'comp@gmail.com', 0, '$2y$10$y8FoPbIDIFXUFRpPC/kL9et8MvpLxJXZTkkbDl', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id_etudiant` int NOT NULL,
  `id_offre` int NOT NULL,
  `date_ajout` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_etudiant`,`id_offre`),
  KEY `id_offre` (`id_offre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `favoris`
--

INSERT INTO `favoris` (`id_etudiant`, `id_offre`, `date_ajout`) VALUES
(6, 13, '2025-05-28 12:35:20'),
(6, 17, '2025-05-28 13:48:37'),
(7, 14, '2025-05-28 12:35:20'),
(9, 17, '2025-06-01 13:15:49'),
(9, 18, '2025-06-01 13:15:51'),
(9, 19, '2025-05-28 18:37:38'),
(10, 17, '2025-05-28 17:52:30'),
(10, 18, '2025-05-28 17:52:31');

-- --------------------------------------------------------

--
-- Table structure for table `gerer`
--

DROP TABLE IF EXISTS `gerer`;
CREATE TABLE IF NOT EXISTS `gerer` (
  `id_admin` int NOT NULL,
  `id_offre` int NOT NULL,
  PRIMARY KEY (`id_admin`,`id_offre`),
  KEY `fk_admins_has_offres_offres1_idx` (`id_offre`),
  KEY `fk_admins_has_offres_admins1_idx` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offres`
--

DROP TABLE IF EXISTS `offres`;
CREATE TABLE IF NOT EXISTS `offres` (
  `id_offre` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(30) DEFAULT NULL,
  `renumeration` float DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `localisation` varchar(50) DEFAULT NULL,
  `id_entreprise` int NOT NULL,
  `typeContrat` varchar(20) NOT NULL,
  PRIMARY KEY (`id_offre`),
  KEY `fk_offres_entreprises1_idx` (`id_entreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `offres`
--

INSERT INTO `offres` (`id_offre`, `intitule`, `renumeration`, `description`, `localisation`, `id_entreprise`, `typeContrat`) VALUES
(1, 'QA Ingeigneure', 880.5, 'ISI ON FAIT DES BURGERS', 'Paris', 1, ''),
(2, 'QA BURGERS', 10000, 'il nous faut des cuisinier', 'Paris', 1, ''),
(3, ' BURGERS EATER', 10000, 'venez nous joindre pour manger des burgers', 'Paris-Nord', 2, ''),
(4, 'Tester of burgers', 5000, 'Q tester les burgers pour la formation', 'Paris', 3, ''),
(5, 'sss', 89498, 'sss', 'sss', 1, 'Stage'),
(6, 'gfre', 8.88889e15, 'gtcgs', 'tedrrztr', 1, 'Stage'),
(7, 'WORKER', 5000, 'A WORKE', 'MACDO', 1, ''),
(8, 't&#039;re', 525, 'dddd', 'ddd', 1, ''),
(9, 't&#039;re', 525, 'dddd', 'ddd', 1, ''),
(10, 't&#039;re', 525, 'dddd', 'ddd', 1, ''),
(11, 'erfer', 85, 'erver', 'erv', 1, ''),
(12, 'erfer', 85, 'erver', 'erv', 1, ''),
(13, 'erfer', 85, 'erver', 'erv', 1, ''),
(14, 'frre', 555, 'ercer', 'ercer', 4, ''),
(17, 'Testeur QA', 1200, 'Tests qualité logiciel', 'Lyon', 8, 'CDD'),
(18, 'MONSTER IT spesialist', 1200, 'A faire des QA checks pour la paties BE do notre site', 'Paris', 9, ''),
(19, 'ed', 500, 'rece', 'cze', 8, ''),
(20, 'DEV de la poste', 20, 'A faire en sote que on remplce les pigons par des email', 'Tour de la Valees', 10, '');

-- --------------------------------------------------------

--
-- Table structure for table `postuler`
--

DROP TABLE IF EXISTS `postuler`;
CREATE TABLE IF NOT EXISTS `postuler` (
  `id_offre` int NOT NULL,
  `id_etudiant` int NOT NULL,
  `date` timestamp(6) NOT NULL,
  PRIMARY KEY (`id_offre`,`id_etudiant`),
  KEY `fk_offres_has_etudiants_etudiants2_idx` (`id_etudiant`),
  KEY `fk_offres_has_etudiants_offres1_idx` (`id_offre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rendez_vous`
--

DROP TABLE IF EXISTS `rendez_vous`;
CREATE TABLE IF NOT EXISTS `rendez_vous` (
  `id_rdv` int NOT NULL AUTO_INCREMENT,
  `lieu` varchar(30) DEFAULT NULL,
  `creneau` datetime DEFAULT NULL,
  `id_offre` int NOT NULL,
  `id_etudiant` int NOT NULL,
  `id_entreprise` int NOT NULL,
  PRIMARY KEY (`id_rdv`),
  KEY `fk_rendez_vous_offres1_idx` (`id_offre`),
  KEY `fk_rendez_vous_etudiants1_idx` (`id_etudiant`),
  KEY `fk_rendez_vous_entreprises1_idx` (`id_entreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
