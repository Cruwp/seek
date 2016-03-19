-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 19 Mars 2016 à 16:20
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bd_seek`
--

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE IF NOT EXISTS `equipes` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `enom` varchar(50) NOT NULL,
  `eleader` int(11) NOT NULL,
  `edesc` mediumtext NOT NULL,
  `eavatar` varchar(50) NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `equipes`
--

INSERT INTO `equipes` (`eid`, `enom`, `eleader`, `edesc`, `eavatar`) VALUES
(1, 'Merlus', 1, 'La meilleure team du monde', 'merlus.jpg'),
(2, 'Noob', 2, 'Team de noobs', 'noob.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `forum_categorie`
--

CREATE TABLE IF NOT EXISTS `forum_categorie` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nom` varchar(30) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `forum_categorie`
--

INSERT INTO `forum_categorie` (`cat_id`, `cat_nom`) VALUES
(1, 'Général'),
(2, 'Espace détente');

-- --------------------------------------------------------

--
-- Structure de la table `forum_forum`
--

CREATE TABLE IF NOT EXISTS `forum_forum` (
  `forum_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_cat_id` mediumint(8) NOT NULL,
  `forum_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `forum_desc` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `forum_last_post_id` int(11) NOT NULL,
  `forum_nbr_topic` mediumint(8) NOT NULL,
  `forum_nbr_post` mediumint(8) NOT NULL,
  `auth_creer` tinyint(4) NOT NULL,
  `auth_annonce` tinyint(4) NOT NULL,
  `auth_modo` tinyint(4) NOT NULL,
  PRIMARY KEY (`forum_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `forum_forum`
--

INSERT INTO `forum_forum` (`forum_id`, `forum_cat_id`, `forum_name`, `forum_desc`, `forum_last_post_id`, `forum_nbr_topic`, `forum_nbr_post`, `auth_creer`, `auth_annonce`, `auth_modo`) VALUES
(1, 1, 'Règles', 'Les règles du forum. Merci de les lires.', 1, 0, 0, 9, 9, 9),
(2, 1, 'News', 'Les informations à propos du site.', 3, 0, 0, 9, 9, 9),
(3, 2, 'Blabla', 'Venez parler de tout et de rien !', 5, 0, 0, 0, 9, 9);

-- --------------------------------------------------------

--
-- Structure de la table `forum_post`
--

CREATE TABLE IF NOT EXISTS `forum_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_createur` int(11) NOT NULL,
  `post_texte` text NOT NULL,
  `post_time` timestamp NOT NULL,
  `post_topic_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `forum_post`
--

INSERT INTO `forum_post` (`post_id`, `post_createur`, `post_texte`, `post_time`, `post_topic_id`) VALUES
(1, 3, 'Ceci est un ppost sur un topic sur un forum sur une catégorie ^^', '2016-03-19 15:08:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `forum_topic`
--

CREATE TABLE IF NOT EXISTS `forum_topic` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_forum_id` int(11) NOT NULL,
  `topic_titre` char(60) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `topic_createur` int(11) NOT NULL,
  `topic_vu` mediumint(8) NOT NULL,
  `topic_creation` timestamp NOT NULL,
  `topic_last_post` int(11) NOT NULL,
  PRIMARY KEY (`topic_id`),
  UNIQUE KEY `topic_last_post` (`topic_last_post`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `forum_topic`
--

INSERT INTO `forum_topic` (`topic_id`, `topic_forum_id`, `topic_titre`, `topic_createur`, `topic_vu`, `topic_creation`, `topic_last_post`) VALUES
(1, 1, 'Règlement général', 3, 15, '2016-03-19 14:54:49', 1);

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE IF NOT EXISTS `jeux` (
  `jid` int(11) NOT NULL AUTO_INCREMENT,
  `jnom` varchar(50) NOT NULL,
  `jminiature` varchar(70) NOT NULL,
  PRIMARY KEY (`jid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `jeux`
--

INSERT INTO `jeux` (`jid`, `jnom`, `jminiature`) VALUES
(1, 'League of Legends', 'LoL'),
(2, 'Counter Strike Global Offensive', 'CSGOlogo'),
(3, 'Rocket League', 'RocketLeague'),
(4, 'Smite', 'Smite'),
(5, 'Halo', 'halo'),
(6, 'HearthStone', 'hs'),
(7, 'Minecraft', 'mc'),
(8, 'Day Z', 'DayzLogo'),
(9, 'Dota 2', 'dota'),
(10, 'Call of Duty', 'CoD'),
(11, 'Diablo 3', 'DiabloLogo');

-- --------------------------------------------------------

--
-- Structure de la table `membreteam`
--

CREATE TABLE IF NOT EXISTS `membreteam` (
  `mtid` int(11) NOT NULL AUTO_INCREMENT,
  `mtequipe` int(11) NOT NULL,
  `mtmembre` int(11) NOT NULL,
  PRIMARY KEY (`mtid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `proposition`
--

CREATE TABLE IF NOT EXISTS `proposition` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `puser` int(11) NOT NULL,
  `ppost` text NOT NULL,
  `pjeu` int(11) NOT NULL,
  `pdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ptitre` varchar(100) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `proposition`
--

INSERT INTO `proposition` (`pid`, `puser`, `ppost`, `pjeu`, `pdate`, `ptitre`) VALUES
(1, 1, 'Bonjour, <br>\r\nJe recherche un co-équipier chalereux pour monter en ladder sur LoL, je suis actuellement gold 5 et je voudrais monter platine cette saison. <br>\r\n<br>\r\nJe cherche donc un duo du même niveau que moi (gold 4 ou 5).<br>\r\n<br>\r\nMerci, <br>\r\nCruwp.', 1, '2016-02-25 11:01:33', 'Duo gold'),
(2, 2, 'Recherche une équipe de try hard pour monter dans le ladder 5v5.\r\nJe suis platinium et j''aimerai une équipe du même niveau.<br>\r\nMerci', 1, '2016-02-25 12:38:32', 'Recherche team try hard'),
(3, 2, 'Lorem ipsum dolor sit amet.\r\n<br> Oui mdr c''est du latin c''est normal...', 2, '2016-02-25 12:38:32', 'Essai tri');

-- --------------------------------------------------------

--
-- Structure de la table `recrutement`
--

CREATE TABLE IF NOT EXISTS `recrutement` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `rteam` int(11) NOT NULL,
  `rpost` text NOT NULL,
  `rjeu` int(11) NOT NULL,
  `rdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rtitre` varchar(100) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `recrutement`
--

INSERT INTO `recrutement` (`rid`, `rteam`, `rpost`, `rjeu`, `rdate`, `rtitre`) VALUES
(1, 1, 'Bonjour', 1, '2016-02-25 13:07:45', 'Recrute support gold'),
(2, 2, 'Yo', 2, '2016-02-25 13:07:45', 'Recrute sniper global');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `upseudo` varchar(25) NOT NULL,
  `upassword` varchar(255) NOT NULL,
  `uemail` varchar(120) NOT NULL,
  `urang` int(11) NOT NULL DEFAULT '0',
  `uavatar` varchar(50) NOT NULL,
  `uactif` int(11) NOT NULL DEFAULT '0',
  `uinscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ulastconnec` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ubanni` int(11) NOT NULL DEFAULT '0',
  `ucle` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`uid`, `upseudo`, `upassword`, `uemail`, `urang`, `uavatar`, `uactif`, `uinscription`, `ulastconnec`, `ubanni`, `ucle`) VALUES
(1, 'Cruwp', '$2y$10$oIyVFPdXzmFZJReIopx6aedQOWTqOnuGxCOBiZZMOoYmSDn0KDLMa', 'G.Cruwp@gmail.com', 10, 'cruwp.jpg', 1, '2016-02-24 12:07:00', '2016-02-27 14:46:01', 0, 'done'),
(2, 'CptBanane', '$2y$10$oIyVFPdXzmFZJReIopx6aedQOWTqOnuGxCOBiZZMOoYmSDn0KDLMa', 'cptbanane@yopmail.com', 0, 'CptBanane.png', 1, '2016-02-24 15:08:28', '2016-02-25 10:59:05', 0, 'a8b14bf925063e74ad6589b8b7b0b153'),
(3, 'Sydher', '$2y$10$8YvUbQONbWyMhOE9tVVBt.fPT4cA/gSlfs4obEUICnwDU1br0w1b.', 'sydher404@gmail.com', 10, '0.jpg', 1, '2016-03-19 08:29:17', '2016-03-19 13:57:10', 0, '77a4b6d987cee21615f23ba59aaa7231');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
