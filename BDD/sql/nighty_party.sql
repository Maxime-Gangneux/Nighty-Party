-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 17 mai 2024 à 15:55
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `nighty party`
--

-- --------------------------------------------------------

--
-- Structure de la table `boissons`
--

DROP TABLE IF EXISTS `boissons`;
CREATE TABLE IF NOT EXISTS `boissons` (
  `id_boisson` int(11) NOT NULL AUTO_INCREMENT,
  `nom_boisson` varchar(50) NOT NULL,
  `qt` float NOT NULL,
  `degre` float DEFAULT NULL,
  PRIMARY KEY (`id_boisson`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `boissons`
--

INSERT INTO `boissons` (`id_boisson`, `nom_boisson`, `qt`, `degre`) VALUES
(5, 'Coca-Cola', 1, NULL),
(6, 'Coca-Cola', 1.5, NULL),
(7, 'Coca-Cola', 2, NULL),
(8, 'Pepsi', 1, NULL),
(9, 'Pepsi', 1.5, NULL),
(10, 'Pepsi', 2, NULL),
(11, 'Fanta', 1, NULL),
(12, 'Fanta', 1.5, NULL),
(13, 'Fanta', 2, NULL),
(14, 'Sprite', 1, NULL),
(15, 'Sprite', 1.5, NULL),
(16, 'Sprite', 2, NULL),
(17, 'Orangina', 1, NULL),
(18, 'Orangina', 1.5, NULL),
(19, 'Orangina', 2, NULL),
(20, '7 Up', 1, NULL),
(21, '7 Up', 1.5, NULL),
(22, '7 Up', 2, NULL),
(23, 'Ice Tea', 1, NULL),
(24, 'Ice Tea', 1.5, NULL),
(25, 'Ice Tea', 2, NULL),
(26, 'Red Bull', 1, NULL),
(27, 'Red Bull', 1.5, NULL),
(28, 'Red Bull', 2, NULL),
(29, 'Lipton', 1, NULL),
(30, 'Lipton', 1.5, NULL),
(31, 'Lipton', 2, NULL),
(32, 'Perrier', 1, NULL),
(33, 'Perrier', 1.5, NULL),
(34, 'Perrier', 2, NULL),
(35, 'Jack Daniels', 0.7, 40),
(36, 'Jack Daniels', 1, 40),
(37, 'Jack Daniels', 1.5, 40),
(38, 'Absolut', 0.7, 40),
(39, 'Absolut', 1, 40),
(40, 'Absolut', 1.5, 40),
(41, 'Bacardi', 0.7, 40),
(42, 'Bacardi', 1, 40),
(43, 'Bacardi', 1.5, 40),
(44, 'Jose Cuervo', 0.7, 40),
(45, 'Jose Cuervo', 1, 40),
(46, 'Jose Cuervo', 1.5, 40),
(47, 'Bombay Sapphire', 0.7, 37.5),
(48, 'Bombay Sapphire', 1, 37.5),
(49, 'Bombay Sapphire', 1.5, 37.5),
(50, 'Heineken', 0.5, 5),
(51, 'Heineken', 1, 5),
(52, 'Heineken', 1.5, 5),
(53, 'Heineken', 2, 5),
(54, 'Château Margaux', 0.75, 13),
(55, 'Château Margaux', 1, 13),
(56, 'Château Margaux', 1.5, 13),
(57, 'Sauvignon Blanc', 0.75, 12),
(58, 'Sauvignon Blanc', 1, 12),
(59, 'Sauvignon Blanc', 1.5, 12),
(60, 'Moët & Chandon', 0.75, 12),
(61, 'Moët & Chandon', 1, 12),
(62, 'Moët & Chandon', 1.5, 12),
(63, 'Smirnoff', 0.7, 37.5),
(64, 'Smirnoff', 1, 37.5),
(65, 'Smirnoff', 1.5, 37.5),
(66, 'Malibu', 0.7, 21),
(67, 'Malibu', 1, 21),
(68, 'Malibu', 1.5, 21),
(69, 'Captain Morgan', 0.7, 35),
(70, 'Captain Morgan', 1, 35),
(71, 'Captain Morgan', 1.5, 35),
(72, 'Fireball', 0.7, 33),
(73, 'Fireball', 1, 33),
(74, 'Fireball', 1.5, 33),
(75, 'Jägermeister', 0.7, 35),
(76, 'Jägermeister', 1, 35),
(77, 'Jägermeister', 1.5, 35),
(78, 'Cointreau', 0.7, 40),
(79, 'Cointreau', 1, 40),
(80, 'Cointreau', 1.5, 40),
(81, 'Baileys', 0.7, 17),
(82, 'Baileys', 1, 17),
(83, 'Baileys', 1.5, 17),
(92, 'Captain Morgan', 1.5, 35),
(96, 'Jägermeister', 0.7, 35),
(97, 'Jägermeister', 1, 35),
(98, 'Jägermeister', 1.5, 35),
(99, 'Cointreau', 0.7, 40),
(100, 'Cointreau', 1, 40),
(101, 'Cointreau', 1.5, 40),
(102, 'Baileys', 0.7, 17),
(103, 'Baileys', 1, 17),
(104, 'Baileys', 1.5, 17),
(105, 'Grey Goose', 0.7, 40),
(106, 'Grey Goose', 1, 40),
(107, 'Grey Goose', 1.5, 40),
(108, 'Belvedere', 0.7, 40),
(109, 'Belvedere', 1, 40),
(110, 'Belvedere', 1.5, 40),
(111, 'Cîroc', 0.7, 37.5),
(112, 'Cîroc', 1, 37.5),
(113, 'Cîroc', 1.5, 37.5),
(114, 'Sobieski', 0.7, 40),
(115, 'Sobieski', 1, 40),
(116, 'Sobieski', 1.5, 40);

-- --------------------------------------------------------

--
-- Structure de la table `boissons_apporte`
--

DROP TABLE IF EXISTS `boissons_apporte`;
CREATE TABLE IF NOT EXISTS `boissons_apporte` (
  `id_apporte` int(11) NOT NULL AUTO_INCREMENT,
  `id_invite` int(11) NOT NULL,
  `id_boisson` int(11) NOT NULL,
  `nb` int(11) NOT NULL,
  PRIMARY KEY (`id_apporte`),
  KEY `id_invite` (`id_invite`),
  KEY `id_boisson` (`id_boisson`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `id_compte` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant_compte` varchar(50) NOT NULL,
  `mot_de_passe_compte` varchar(50) NOT NULL,
  `nom_compte` varchar(50) NOT NULL,
  `prenom_compte` varchar(50) NOT NULL,
  `age_compte` int(11) NOT NULL,
  PRIMARY KEY (`id_compte`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id_compte`, `identifiant_compte`, `mot_de_passe_compte`, `nom_compte`, `prenom_compte`, `age_compte`) VALUES
(34, 'mullerjulien995@gmail.com', 'root', 'Muller', 'Julien', 18),
(35, 'gangneuxmaxime@gmail.com', 'maxime', 'Gangneux', 'Maxime', 17),
(36, 'koenigserena@gmail.com', 'Serena', 'Koenig', 'Serena', 17),
(37, 'mullerlouane@gmail.com', 'louane', 'Muller', 'Louane', 16),
(38, 'husserelsa@gmail.com', 'elsa', 'Husser', 'Elsa', 18),
(39, 'spieseva@gmail.com', 'eva', 'Spies', 'Eva', 18);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id_favoris` int(11) NOT NULL AUTO_INCREMENT,
  `id_compte` int(11) DEFAULT NULL,
  `id_soiree` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_favoris`),
  KEY `id_compte` (`id_compte`),
  KEY `id_soiree` (`id_soiree`)
) ENGINE=MyISAM AUTO_INCREMENT=153 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id_favoris`, `id_compte`, `id_soiree`) VALUES
(152, 36, 17),
(151, 36, 19),
(150, 36, 15);

-- --------------------------------------------------------

--
-- Structure de la table `invite`
--

DROP TABLE IF EXISTS `invite`;
CREATE TABLE IF NOT EXISTS `invite` (
  `id_invite` int(11) NOT NULL AUTO_INCREMENT,
  `id_compte` int(11) NOT NULL,
  `id_soiree` int(11) NOT NULL,
  PRIMARY KEY (`id_invite`),
  KEY `id_compte` (`id_compte`),
  KEY `id_soiree` (`id_soiree`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `invite`
--

INSERT INTO `invite` (`id_invite`, `id_compte`, `id_soiree`) VALUES
(11, 35, 15),
(13, 36, 17),
(14, 38, 18),
(15, 39, 19),
(19, 34, 26),
(20, 35, 26),
(21, 36, 26),
(23, 36, 18),
(24, 36, 15);

-- --------------------------------------------------------

--
-- Structure de la table `soiree`
--

DROP TABLE IF EXISTS `soiree`;
CREATE TABLE IF NOT EXISTS `soiree` (
  `id_soiree` int(11) NOT NULL AUTO_INCREMENT,
  `nom_soiree` varchar(50) DEFAULT NULL,
  `description_soiree` varchar(150) DEFAULT NULL,
  `adresse_soiree` varchar(50) DEFAULT NULL,
  `date_soiree` date DEFAULT NULL,
  `heure_min_soiree` time DEFAULT NULL,
  `heure_max_soiree` time DEFAULT NULL,
  `nb_personne_soiree` int(11) DEFAULT NULL,
  `theme_soiree` varchar(50) DEFAULT NULL,
  `type_soiree` varchar(50) DEFAULT NULL,
  `statu_soiree` tinyint(1) NOT NULL,
  `code_soiree` varchar(10) DEFAULT NULL,
  `id_invite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_soiree`),
  KEY `editeur` (`id_invite`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `soiree`
--

INSERT INTO `soiree` (`id_soiree`, `nom_soiree`, `description_soiree`, `adresse_soiree`, `date_soiree`, `heure_min_soiree`, `heure_max_soiree`, `nb_personne_soiree`, `theme_soiree`, `type_soiree`, `statu_soiree`, `code_soiree`, `id_invite`) VALUES
(15, 'soiree de maxime', 'Salut les loulous jorganise une soirée de modo disocrde on va coder toute la night les gas', '6 rue de Gasse', '1970-01-01', '18:02:00', '05:02:00', 4, 'Modo discord', 'codage', 1, NULL, 11),
(17, 'Soiree de Serena', 'Salut les pétasse soyer prete pour ma soirée des 18 ans avec moi a poile', '20 rue d emburg', '2024-06-08', '21:00:00', '03:07:00', 25, 'Bleu', 'Anniversaire 18', 1, NULL, 13),
(18, 'Soiree de elsa ', 'Coucou mes bichettes d amour venez a ma soirée de bg bisous', '29 rue du cul', '2024-05-24', '18:09:00', '23:09:00', 10, 'En mode coquette', 'chill', 1, NULL, 14),
(19, 'Soiree de eva', 'BAd bitch', '2 rue du sexe', '2024-05-31', '19:10:00', '23:10:00', 30, 'Classe/ bien habiller', 'Anniversaire 18', 1, NULL, 15),
(26, 'Soiree de julien', 'Salut l equipe j epère vous êtes chaud pour la soirée de l année chez moi a roppen on va se la tuer les gas ', '16 rue de riespacvh', '2024-05-25', '20:02:00', '23:02:00', 50, 'Classe/ bien habiller', 'Anniversaire 18', 1, NULL, 19);

--
-- Déclencheurs `soiree`
--
DROP TRIGGER IF EXISTS `mise_a_jour_code_soiree`;
DELIMITER $$
CREATE TRIGGER `mise_a_jour_code_soiree` BEFORE INSERT ON `soiree` FOR EACH ROW BEGIN
    IF NEW.statu_soiree = 0 THEN
        SET NEW.code_soiree = (
            SELECT SUBSTRING(
                MD5(RAND()) FROM 1 FOR 7
            )
        );
    ELSE
        SET NEW.code_soiree = NULL;
    END IF;
END
$$
DELIMITER ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `boissons_apporte`
--
ALTER TABLE `boissons_apporte`
  ADD CONSTRAINT `boissons_apporte_ibfk_1` FOREIGN KEY (`id_invite`) REFERENCES `invite` (`id_invite`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `boissons_apporte_ibfk_2` FOREIGN KEY (`id_boisson`) REFERENCES `boissons` (`id_boisson`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `invite`
--
ALTER TABLE `invite`
  ADD CONSTRAINT `invite_ibfk_1` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`id_compte`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invite_ibfk_2` FOREIGN KEY (`id_soiree`) REFERENCES `soiree` (`id_soiree`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `soiree`
--
ALTER TABLE `soiree`
  ADD CONSTRAINT `soiree_ibfk_1` FOREIGN KEY (`id_invite`) REFERENCES `invite` (`id_invite`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
