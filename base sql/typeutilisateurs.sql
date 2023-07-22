-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 20 Juillet 2023 à 20:36
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
-- Structure de la table `typeutilisateurs`
--

CREATE TABLE `typeutilisateurs` (
  `id_typeUtilisateurs` int(11) NOT NULL,
  `valeur_typeUtilisateurs` int(11) NOT NULL,
  `libelle` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `typeutilisateurs`
--

INSERT INTO `typeutilisateurs` (`id_typeUtilisateurs`, `valeur_typeUtilisateurs`, `libelle`) VALUES
(2, 1, 'Admin'),
(3, 2, 'Utilisateur'),
(4, 3, 'Producteur'),
(5, 4, 'Community Manager');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `typeutilisateurs`
--
ALTER TABLE `typeutilisateurs`
  ADD PRIMARY KEY (`id_typeUtilisateurs`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `typeutilisateurs`
--
ALTER TABLE `typeutilisateurs`
  MODIFY `id_typeUtilisateurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
