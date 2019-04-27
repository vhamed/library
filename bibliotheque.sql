-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2015 at 02:11 AM
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

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`admin_nom`, `admin_pass`) VALUES
('admin', 'admin');

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

--
-- Dumping data for table `lecteurs`
--

INSERT INTO `lecteurs` (`user_id`, `num_carte`, `nom`, `prenom`, `pass`, `specialite`, `annee_etude`, `email`, `status`) VALUES
(1, 597, 'Harkat', 'Amine', 'amine123', 'INF', '2014/2015', 'AHarkat@live.fr', 0),
(2, 667, 'Benrahla', 'Adel', 'adel123', 'INF', '2014/2015', 'Adel@live.com', 1),
(3, 124, 'Rahal', 'Adib', 'adib123', 'INF', '2014/2015', 'emdfail@live.ss', 1),
(4, 1020, 'Souilah', 'Zakaria', 'zaki123', 'INF', '2014/2015', 'zakzak@live.es', 1),
(5, 322, 'Imad', 'dabache', 'imadmath', 'MAT', '2014/2015', 'DImad@live.fr', 1),
(6, 2324, 'Bensalem', 'Randa', 'rand222', 'ECO', '2014/2015', 'rrranda@hotmail.com', 1),
(7, 2321, 'Rissal', 'Adel', 'adeladel', 'INF', '2014/2015', 'rissal@live.fr', 1),
(8, 4412, 'Rachid', 'Alaa', 'alaa123', 'LET', '2014/2015', 'kaka2010@love.fr', 1),
(9, 5411, 'Tarach', 'Aala', 'pass2011', 'TEC', '2014/2015', 'Alaa24@yahoo.fr', 1),
(10, 2223, 'Bensaed', 'Hamed', 'ham123', 'INF', '2014/2015', 'hamed@hotmail.com', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `livres`
--

INSERT INTO `livres` (`livre_id`, `livre_titre`, `livre_auteur`, `livre_annee`, `livre_specialitee`, `livre_exemplaires`, `livre_date_ajout`, `livre_exemplaires_total`) VALUES
(1, 'Tout sur les reseaux', 'Fabrice Lemainque ', 2015, 'INF', 4, '2015-05-06 11:27:24', 4),
(2, 'Bases de donnees', 'Jean-Luc Hainaut ', 2015, 'INF', 0, '2015-05-06 11:27:24', 1),
(3, 'Creez votre site web ', 'David Pauly ', 2001, 'INF', 1, '2015-05-06 11:27:24', 1),
(4, 'L''ordinateur pour les Nuls ', 'Dan Gookin ', 2002, 'INF', 0, '2015-05-06 11:27:24', 1),
(5, 'Reseaux Informatiques', 'Matthieu Bonan', 2000, 'INF', 2, '2015-05-06 11:27:24', 2),
(6, 'Gestion et informatique', 'Claude Terrier', 2006, 'INF', 1, '2015-05-06 11:27:24', 1),
(7, 'Automatique et informatique ', 'Paul Namian', 2009, 'INF', 1, '2015-05-06 11:27:24', 1),
(8, 'Securite informatique', 'Cottard Maniak', 2003, 'INF', 0, '2015-05-06 11:27:24', 1),
(9, 'activites informatiques', 'Thierry Mercou', 2006, 'INF', 1, '2015-05-06 11:27:24', 1),
(10, 'Education et informatique', 'Bruillard', 2001, 'INF', 0, '2015-05-06 11:27:24', 1),
(11, 'Travaux diriges informatiques', 'Pierre Mechentel', 1999, 'INF', 0, '2015-05-06 11:27:24', 1),
(12, ' Site Internet Avec Joomla', 'Thierry Cumps', 2014, 'INF', 2, '2015-06-06 11:27:24', 2),
(13, 'Le Bleau Livre des Maths', ' Hachette', 2001, 'MAT', 2, '2015-06-06 11:27:24', 2),
(14, 'Problem-Solving Strategies', 'Arthur Engel', 2000, 'MAT', 4, '2015-06-06 11:27:24', 4),
(15, 'Le Grande Livre Des Maths ', 'N. PEne', 2006, 'MAT', 4, '2015-06-06 11:27:24', 4),
(16, 'Essential Mathematics', ' Peter Hammond', 2005, 'MAT', 0, '2015-06-06 11:27:24', 1),
(17, 'Maths Livre du professeur', 'Georges Bringuier', 2003, 'MAT', 4, '2015-06-06 11:27:24', 4),
(18, 'Classeur maths', 'Eliane Kurbegov', 2004, 'MAT', 0, '2015-06-06 11:27:24', 2),
(19, 'Maths obligatoire ', 'Jean Lepeule', 2001, 'MAT', 4, '2015-06-06 11:27:24', 4),
(20, 'Itineraire Math', ' Roland Charnay', 2015, 'MAT', 2, '2015-06-06 11:27:24', 2),
(21, 'Dictionnairede L Economique', 'Luc Bronner', 2014, 'ECO', 6, '2015-06-06 11:27:24', 6),
(22, 'Histoire de l''economique', 'Ahmed Silem', 2003, 'ECO', 1, '2015-06-06 11:27:24', 1),
(23, 'Psychologie Economique', 'TARDE-G', 1992, 'ECO', 3, '2015-06-06 11:27:24', 3),
(24, 'sciences economiques e2', 'Jean-Paul Lebel', 2015, 'ECO', 1, '2015-06-06 11:27:24', 1),
(25, 'theorie des jeux ', 'Thomas fri', 2013, 'ECO', 0, '2015-06-06 11:27:24', 2),
(26, 'Regulation economique', 'Jorge Uribe Maza', 2011, 'ECO', 2, '2015-06-17 13:29:53', 2),
(27, 'La puissance economique ', 'Thomas paul', 1997, 'ECO', 1, '2015-06-06 11:27:24', 1),
(28, 'Les lois economiques', 'Luis almand', 1992, 'ECO', 0, '2015-06-06 11:27:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parametres`
--

CREATE TABLE IF NOT EXISTS `parametres` (
  `nbrlignes` int(3) NOT NULL DEFAULT '10',
  `limit_prets` int(3) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parametres`
--

INSERT INTO `parametres` (`nbrlignes`, `limit_prets`) VALUES
(10, 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prets`
--

INSERT INTO `prets` (`Prets_id`, `Lecteur_id`, `Livre_id`, `Date_pret`, `Date_retour`, `temps_ecoule`, `notification`) VALUES
(57, 2, 25, '2015-05-16', '2015-05-20', 0, 0),
(58, 2, 2, '2015-05-16', '0000-00-00', 1, 1),
(59, 3, 4, '2015-05-16', '2015-05-21', 0, 0),
(60, 3, 8, '2015-06-10', '2015-06-15', 0, 0),
(61, 8, 10, '2015-06-13', '0000-00-00', 0, 0),
(62, 8, 16, '2015-06-15', '0000-00-00', 0, 0),
(63, 8, 18, '2015-06-10', '0000-00-00', 1, 1),
(64, 5, 18, '2015-06-17', '0000-00-00', 0, 0),
(65, 5, 11, '2015-06-15', '0000-00-00', 0, 0),
(66, 6, 28, '2015-06-17', '0000-00-00', 0, 0),
(67, 6, 25, '2015-06-17', '0000-00-00', 0, 0);

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
  MODIFY `livre_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `prets`
--
ALTER TABLE `prets`
  MODIFY `Prets_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
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
