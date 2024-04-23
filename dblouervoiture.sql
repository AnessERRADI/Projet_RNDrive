-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 27 Octobre 2020 à 17:26
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `dblouervoiture`
--

-- --------------------------------------------------------

--
-- Structure de la table `tblocation`
--

CREATE TABLE IF NOT EXISTS `tblocation` (
  `idl` int(11) NOT NULL AUTO_INCREMENT,
  `matriculev` varchar(30) NOT NULL,
  `contact_locat` varchar(30) NOT NULL,
  `nom_locat` varchar(100) NOT NULL,
  `date_locat` datetime DEFAULT NULL,
  `duree_prev` smallint(6) NOT NULL,
  `reservation` varchar(10) NOT NULL,
  `contact_chauff` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idl`),
  UNIQUE KEY `matriculev` (`matriculev`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `tblocation`
--

INSERT INTO `tblocation` (`idl`, `matriculev`, `contact_locat`, `nom_locat`, `date_locat`, `duree_prev`, `reservation`, `contact_chauff`) VALUES
(3, 'TX441', '66010177', 'MARTINE PELAGIE', '2020-10-26 13:26:36', 4, 'non', '99341258'),
(4, 'MT005', '62991213', 'THOMAS HUBERT', '2020-10-24 06:30:13', 2, 'non', '92990101'),
(5, 'BS346', '66559090', 'LCSP', '2020-10-26 08:33:04', 3, 'non', '90903344'),
(7, 'BU671', '66050522', 'GEDEON REGIS', '2020-10-26 13:30:55', 1, 'non', '99235701'),
(11, 'MT007', '66171709', 'EET13', '2020-10-26 13:51:12', 1, 'non', '95050512');

-- --------------------------------------------------------

--
-- Structure de la table `tbvoiture`
--

CREATE TABLE IF NOT EXISTS `tbvoiture` (
  `matricule` varchar(30) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `prix_locat` decimal(9,2) DEFAULT NULL,
  `disponible` varchar(10) NOT NULL,
  PRIMARY KEY (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tbvoiture`
--

INSERT INTO `tbvoiture` (`matricule`, `nom`, `prix_locat`, `disponible`) VALUES
('BS345', 'BUS', '95000.00', 'oui'),
('BS346', 'BUS', '95000.00', 'non'),
('BU671', 'BUGGATI L9', '115000.00', 'non'),
('FR890', 'FERRARI ENZO', '155000.00', 'oui'),
('HI678', 'HILUX 2C', '45000.00', 'oui'),
('HU323', 'HUMMER A5', '90000.00', 'oui'),
('LM234', 'LIMOUSINE B4', '95000.00', 'oui'),
('MT005', 'MINIBUS', '50000.00', 'non'),
('MT006', 'MINIBUS', '50000.00', 'oui'),
('MT007', 'MINIBUS', '50000.00', 'non'),
('TX441', 'TAXI', '35000.00', 'non'),
('TX442', 'TAXI', '35000.00', 'oui'),
('TX444', 'TAXI', '35000.00', 'oui');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tblocation`
--
ALTER TABLE `tblocation`
  ADD CONSTRAINT `fk` FOREIGN KEY (`matriculev`) REFERENCES `tbvoiture` (`matricule`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
