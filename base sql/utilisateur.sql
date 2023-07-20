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
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom_utilisateur` text,
  `mdp_utilisateur` text,
  `email_utilisateur` text,
  `valeur_typeUtilisateurs` int(11) NOT NULL DEFAULT '2',
  `reset_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_utilisateur`, `mdp_utilisateur`, `email_utilisateur`, `valeur_typeUtilisateurs`, `reset_token`) VALUES
(2, 'utilisateurTest', '$2y$10$i1dcXWuLhhO6aeoCwir4hOtgcBTSPwmmCYCP8xPxcLrIvGweCVGkO', 'utilisateurTest@hotmail.fr', 2, NULL),
(3, 'AdminTest', '$2y$10$idaNNQaJ5rDUnHOq0DNXZeeKIhdxY0FjZWYmzCOneGyEwZfkPaOqy', 'adminTest@hotmail.fr', 1, NULL),
(4, 'CMTest', '$2y$10$DFIXMdE51jbdSYqa5p1tP.UqoURwDwEXhcJ3u7nkjxEBnNSqIFhk2', 'CMTest@hotmail.fr', 3, NULL),
(5, 'producteurTest', '$2y$10$/Qe0q5jT2ELCQXOvaMKIi.gjlgeMj4D2LHaVLlzbpYyob0VABseeW', 'producteurTest@hotmail.fr', 4, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
