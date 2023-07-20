-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 20 Juillet 2023 à 20:35
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ecf_g`
--

-- --------------------------------------------------------

--
-- Structure de la table `actualites`
--

CREATE TABLE `actualites` (
  `id_actualites` int(11) NOT NULL,
  `titre` text COLLATE utf8_unicode_ci NOT NULL,
  `descriptif` text COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `actualites`
--

INSERT INTO `actualites` (`id_actualites`, `titre`, `descriptif`, `date_creation`) VALUES
(1, 'Nouveau jeu annoncé', 'Super nouvelle pour les fans impatients, la date de sortie de notre dernier jeu \'les aventures d\'Orcado\' approche à grand pas.\r\nNous sommes excités de vous anoncés que le projet avance à grand pas, et qu\'il ne reste plus qu\'une semaine avant la sortie officiel, alors soyez prêt, car nous le serons !', '2023-07-16'),
(2, 'Nouvelle mise à jour : Le mode en ligne !', 'Suite à vos retours, le jeu \'les fondations du neither\' verront son mode en ligne sortir à ce jour ! Partez à la conquête du neither désormais accompagné de vos amis, et redoublez de vigilance, car désormais les monstres du neither ne seront peut être plus la menace principale, qui saura se montré le plus malin, le plus fort ou le plus sournois afin de conquérir le neither, venez les découvrir !', '2023-07-20'),
(3, 'Projet : La dinasty Wuang', 'Projet en préparation pour l\'année à venirs, un jeu fantastique prenant place dans la fascinante mythologie Chinoise!\r\nLa cultivation ! Un art à développer, un travail sur soi constant, et une ouverture de toutes les possibilités. Venez rejoindre les cultivateur, pour vous échapper des contraintes et vos restrictions mortelles, et élevez vous vers le statut d\'immortel !', '2023-07-16');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `actualites`
--
ALTER TABLE `actualites`
  ADD PRIMARY KEY (`id_actualites`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `actualites`
--
ALTER TABLE `actualites`
  MODIFY `id_actualites` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
