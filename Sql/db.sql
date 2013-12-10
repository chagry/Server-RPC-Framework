-- phpMyAdmin SQL Dump
-- version 4.0.8
-- Généré le: Mar 10 Décembre 2013 à 06:43
-- Version du serveur: 5.0.67-log
-- Version de PHP: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Structure de la table `sys_log`
--

CREATE TABLE IF NOT EXISTS `sys_log` (
  `sid` varchar(32) NOT NULL,
  `date` bigint(50) NOT NULL default '0',
  `usip` varchar(32) NOT NULL,
  `userid` int(11) NOT NULL default '0',
  `action` varchar(255) NOT NULL,
  `parametre` text NOT NULL,
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sys_session`
--

CREATE TABLE IF NOT EXISTS `sys_session` (
  `sid` varchar(32) NOT NULL default '0',
  `date` bigint(50) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `valide` tinyint(1) NOT NULL default '0',
  UNIQUE KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sys_user`
--

CREATE TABLE IF NOT EXISTS `sys_user` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(100) NOT NULL default '',
  `password` varchar(100) NOT NULL default '',
  `block` tinyint(1) NOT NULL default '0',
  `verif` varchar(100) NOT NULL,
  `registerdate` bigint(50) NOT NULL default '0',
  `lastvisitedate` bigint(50) NOT NULL default '0',
  `role` varchar(11) NOT NULL default 'membre',
  `lang` varchar(3) NOT NULL default 'en',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
