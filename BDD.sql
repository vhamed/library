-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2015 at 02:23 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bibliotheque`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `admin_nom` varchar(5) NOT NULL,
  `admin_pass` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecteurs`
--

CREATE TABLE IF NOT EXISTS `lecteurs` (
  `user_id` int(10) NOT NULL,
  `num_carte` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `specialite` varchar(14) NOT NULL,
  `annee_etude` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `livres`
--

CREATE TABLE IF NOT EXISTS `livres` (
  `livre_id` int(15) NOT NULL,
  `livre_titre` varchar(50) NOT NULL,
  `livre_auteur` varchar(50) NOT NULL,
  `livre_annee` year(4) NOT NULL,
  `livre_specialitee` varchar(25) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `livre_exemplaires` int(2) NOT NULL DEFAULT '1',
  `livre_date_ajout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `livre_exemplaires_total` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parametres`
--

CREATE TABLE IF NOT EXISTS `parametres` (
  `nbrlignes` int(3) NOT NULL DEFAULT '10',
  `limit_prets` int(3) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prets`
--

CREATE TABLE IF NOT EXISTS `prets` (
  `Prets_id` int(15) NOT NULL,
  `Lecteur_id` int(10) NOT NULL,
  `Livre_id` int(10) NOT NULL,
  `Date_pret` date NOT NULL,
  `Date_retour` date NOT NULL DEFAULT '0000-00-00',
  `temps_ecoule` tinyint(1) NOT NULL DEFAULT '0',
  `notification` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Triggers `prets`
--
DELIMITER $$
CREATE TRIGGER `update_livre_exemplaires` AFTER INSERT ON `prets`
 FOR EACH ROW UPDATE `livres` 
SET livres.livre_exemplaires= livres.livre_exemplaires-1
WHERE Livre_id=new.Livre_id
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`admin_nom`);

--
-- Indexes for table `lecteurs`
--
ALTER TABLE `lecteurs`
  ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `id` (`user_id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`livre_id`), ADD UNIQUE KEY `livre_id` (`livre_id`);

--
-- Indexes for table `prets`
--
ALTER TABLE `prets`
  ADD PRIMARY KEY (`Prets_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecteurs`
--
ALTER TABLE `lecteurs`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `livres`
--
ALTER TABLE `livres`
  MODIFY `livre_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `prets`
--
ALTER TABLE `prets`
  MODIFY `Prets_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `temps_prêts_écoulé` ON SCHEDULE EVERY 6 HOUR STARTS '2015-05-30 00:00:00' ENDS '2016-02-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE `prets` SET `temps_ecoule`= 1 , notification=1
WHERE Date_pret < NOW() - INTERVAL 7 DAY
AND Date_retour='0000-00-00'
AND temps_ecoule=0$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
