-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 03 Novembre 2016 à 09:51
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `reservation`
--

-- --------------------------------------------------------
--
-- Structure de la table `inscription`
--

CREATE TABLE IF NOT EXISTS `inscription` (
`idInscription` int(11) NOT NULL,
  `nom` varchar(25)  NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `mail` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;


-- ------- ------------------------------------------------
-- Structure de la table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`idEvent` int(11) NOT NULL,
  `titreEvent` varchar(25) DEFAULT NULL,
  `dateEvent` date DEFAULT NULL,
  `idType` int(11) DEFAULT NULL,
  `idSalle` int(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------
-- Structure de la table `eventext`
--

CREATE TABLE IF NOT EXISTS `eventExt` (
`idEventExt` int(11) NOT NULL,
  `titreEventExt` varchar(25) DEFAULT NULL,
  `dateEventExt` date DEFAULT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(255) NOT NULL,
  `cp` char(255) NOT NULL,
   `idPersonne` int(11) NOT NULL,
    `iDProduct` int(11) NOT NULL
  

) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

CREATE TABLE IF NOT EXISTS `participer` (
  `idEvent` int(11) NOT NULL,
  `idEventExt` int(11) NOT NULL,
  `idPersonne` int(11) NOT NULL,
  `numPlace` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- Structure de la table `personne`
--
CREATE TABLE IF NOT EXISTS `personne` (
`idPersonne` int(11) NOT NULL,
  `nomPersonne` varchar(25) DEFAULT NULL,
  `PrenomPersonne` varchar(25) DEFAULT NULL,
  `mail` varchar(25) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------
-- Structure de la table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
`idSalle` int(255) NOT NULL,
  `nbPlaces` int(255) NOT NULL,
  `nomSalle` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
-- --------------------------------------------------------
--
-- Structure de la table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `IDProduct` int(11) NOT NULL AUTO_INCREMENT,
  `NameProduct` varchar(255) NOT NULL,
  `PriceProduct` float NOT NULL,
  `StockProduct` int(11) NOT NULL,
  PRIMARY KEY (`IDProduct`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`idSalle`, `nbPlaces`, `nomSalle`) VALUES
(1, 30, 'Petite'),
(2, 60, 'Moyenne'),
(3, 180, 'Grande');

-- --------------------------------------------------------
--
-- Structure de la table `typeevent`
--

CREATE TABLE IF NOT EXISTS `typeevent` (
`idType` int(11) NOT NULL,
  `libelleType` varchar(25) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `typeevent`
--
INSERT INTO `typeevent` (`idType`, `libelleType`) VALUES
(1, 'Spectacle'),
(2, 'Concert'),
(3, 'Cinéma'),
(4, 'Autres');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`idEvent`), ADD KEY `FK_Event_idType` (`idType`), ADD KEY `FK_Event_idSalle` (`idSalle`);

-- Index pour la table `eventExt`
--
ALTER TABLE `eventExt`
 ADD PRIMARY KEY (`idEventExt`), ADD KEY `FK_EventExt_idPersonne` (`idPersonne`), ADD KEY `FK_EventExt_IDProduct` (`IDProduct`);

--
-- Index pour la table `participer`
--
ALTER TABLE `participer`
 ADD PRIMARY KEY (`idEvent`,`idEventExt`,`idPersonne`,`numPlace`), ADD KEY `FK_Participer_idPersonne` (`idPersonne`), ADD KEY `FK_Participer_idEventExt` (`idEventExt`), ADD KEY `FK_Participer_idEvent` (`idEvent`);


-- Index pour la table `personne`
--
ALTER TABLE `personne`
 ADD PRIMARY KEY (`idPersonne`);

-- Index pour la table ``
--
ALTER TABLE `inscription`
 ADD PRIMARY KEY (`idInscription`);


-- Index pour la table `salle`
--
ALTER TABLE `salle`
 ADD PRIMARY KEY (`idSalle`);

--
-- Index pour la table `typeevent`
--
ALTER TABLE `typeevent`
 ADD PRIMARY KEY (`idType`);


--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
MODIFY `idEvent` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
--
-- AUTO_INCREMENT pour la table `eventExt`
--
ALTER TABLE `eventExt`
MODIFY `idEventExt` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
MODIFY `idPersonne` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;

-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
MODIFY `idSalle` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

-- AUTO_INCREMENT pour la table `typeevent`
--
ALTER TABLE `typeevent`
MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
ADD CONSTRAINT `FK_Event_idType` FOREIGN KEY (`idType`) REFERENCES `typeevent` (`idType`),
ADD CONSTRAINT `FK_event_idSalle` FOREIGN KEY (`idSalle`) REFERENCES `salle` (`idSalle`);


-- Contraintes pour la table `eventExt`
--
ALTER TABLE `eventExt`
ADD CONSTRAINT `FK_EventExt_idPersonne` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`idPersonne`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
ADD CONSTRAINT `FK_Participer_idEvent` FOREIGN KEY (`idEvent`) REFERENCES `event` (`idEvent`),
ADD CONSTRAINT `FK_Participer_idEventExt` FOREIGN KEY (`idEventExt`) REFERENCES `eventExt` (`idEventExt`),
ADD CONSTRAINT `FK_Participer_idPersonne` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`idPersonne`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
