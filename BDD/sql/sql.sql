-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 12 avr. 2024 à 12:46
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
  `id_boisson` int(10) NOT NULL AUTO_INCREMENT,
  `nom_boisson` varchar(50) NOT NULL,
  `qt` float NOT NULL,
  `degre` float DEFAULT NULL,
  PRIMARY KEY (`id_boisson`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `boissons`
--

INSERT INTO `boissons` (`id_boisson`, `nom_boisson`, `qt`, `degre`) VALUES
(1, 'coca', 2, NULL),
(2, 'coca', 1, NULL),
(3, 'coca chérie ', 2, NULL),
(4, 'coca chérie ', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `boissons_apporte`
--

DROP TABLE IF EXISTS `boissons_apporte`;
CREATE TABLE IF NOT EXISTS `boissons_apporte` (
  `id_apporte` int(10) NOT NULL AUTO_INCREMENT,
  `id_invite` int(10) NOT NULL,
  `id_boisson` int(10) NOT NULL,
  `nb` int(10) NOT NULL,
  PRIMARY KEY (`id_apporte`),
  KEY `id_invite` (`id_invite`),
  KEY `id_boisson` (`id_boisson`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `boissons_apporte`
--

INSERT INTO `boissons_apporte` (`id_apporte`, `id_invite`, `id_boisson`, `nb`) VALUES
(1, 5, 2, 1),
(2, 5, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `id_compte` int(6) NOT NULL AUTO_INCREMENT,
  `identifiant_compte` varchar(50) NOT NULL,
  `mot_de_passe_compte` varchar(50) NOT NULL,
  `nom_compte` varchar(50) NOT NULL,
  `prenom_compte` varchar(50) NOT NULL,
  `age_compte` int(3) NOT NULL,
  PRIMARY KEY (`id_compte`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id_compte`, `identifiant_compte`, `mot_de_passe_compte`, `nom_compte`, `prenom_compte`, `age_compte`) VALUES
(2, 'julien', 'julien_2006', 'Meller ', 'Julien', 18),
(3, 'Maxime', 'maxime_2006', 'gengneux', 'maxime', 17);

-- --------------------------------------------------------

--
-- Structure de la table `invite`
--

DROP TABLE IF EXISTS `invite`;
CREATE TABLE IF NOT EXISTS `invite` (
  `id_invite` int(10) NOT NULL AUTO_INCREMENT,
  `id_compte` int(10) NOT NULL,
  `id_soiree` int(10) NOT NULL,
  PRIMARY KEY (`id_invite`),
  KEY `id_compte` (`id_compte`),
  KEY `id_soiree` (`id_soiree`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `invite`
--

INSERT INTO `invite` (`id_invite`, `id_compte`, `id_soiree`) VALUES
(4, 2, 2),
(5, 3, 2);

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
  `thème_soiree` varchar(50) DEFAULT NULL,
  `type_soiree` varchar(50) DEFAULT NULL,
  `statu_soiree` tinyint(1) NOT NULL,
  `code_soiree` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_soiree`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `soiree`
--

INSERT INTO `soiree` (`id_soiree`, `nom_soiree`, `description_soiree`, `adresse_soiree`, `date_soiree`, `heure_min_soiree`, `heure_max_soiree`, `nb_personne_soiree`, `thème_soiree`, `type_soiree`, `statu_soiree`) VALUES
(2, 'zouk', NULL, 'rue du cul ', '2024-04-10', '04:00:00', '12:00:00', 20, 'chill', 'chill', 1),
(3, 'soiree 2', 'vaehuqervueruveaaegbaevhbeuf', 'rue de la bite', '2024-04-24', '00:00:15', '00:20:00', 209, 'tg', 'th', 0),
(4, 'soiree de loulou', 'on se fait des bb', '38b rue de la tuilerie', '2024-04-27', '21:00:00', '03:00:00', 250, 'sexy', 'hot', 1),
(9, 'soiree de loulou', NULL, '38b rue de la tuilerie', '2024-04-27', '21:00:00', '03:00:00', 250, 'sexy', 'hot', 1),
(10, 'zouk', NULL, 'rue de la bite', '2024-04-27', '04:00:00', '03:00:00', 250, 'sexy', 'hot', 1),
(11, 'julien le moche', NULL, 'rue de la gitanerie', '2024-04-27', '04:00:00', '03:00:00', 250, 'sexy', 'hot', 1);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TRIGGER mise_a_jour_code_soiree BEFORE INSERT ON soiree
FOR EACH ROW
BEGIN
    IF NEW.statu_soiree = 0 THEN
        SET NEW.code_soiree = (
            SELECT SUBSTRING(
                MD5(RAND()) FROM 1 FOR 7
            )
        );
    ELSE
        SET NEW.code_soiree = NULL;
    END IF;
END//

