-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 04 jan. 2026 à 23:16
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `site_stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `cr`
--

CREATE TABLE `cr` (
  `num` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `vu` tinyint(1) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `num_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cr`
--

INSERT INTO `cr` (`num`, `date`, `description`, `vu`, `datetime`, `num_utilisateur`) VALUES
(35, '2025-11-10', 'Installation complète de l’environnement de développement, configuration Docker, mise en place du dépôt Git interne et lecture de la documentation API existante.', 1, '2025-11-10 09:32:11', 7),
(36, '2025-11-11', 'Début du développement de l’API interne : création des endpoints /users et /auth, mise en place des middlewares d’authentification et tests Postman.', NULL, '2025-11-11 16:14:52', 7),
(37, '2025-11-12', 'Analyse des besoins pour l’automatisation des rapports énergétiques. Création d’un script Python permettant d’extraire et transformer les données de consommation.', NULL, '2025-11-12 10:05:21', 8),
(38, '2025-11-13', 'Réunion technique avec le tuteur. Mise en place d’un premier tableau PowerBI connecté à la base SQL. Définition des indicateurs clés.', 1, '2025-11-13 15:19:04', 8),
(39, '2025-11-14', 'Audit des serveurs Debian : vérification des ports ouverts, mise à jour des règles firewall, test de montée en charge sur 500 connexions simultanées.', 1, '2025-11-14 11:54:33', 10),
(40, '2025-11-15', 'Conception d’un dashboard React avec graphiques interactifs. Intégration avec API REST existante et optimisation du temps de chargement.', NULL, '2025-11-15 10:22:54', 14),
(41, '2025-11-16', 'Développement d’un système d’alertes automatisées pour anomalies énergétiques : seuils dynamiques, envoi d’emails, stockage en base.', 1, '2025-11-16 14:15:33', 8),
(42, '2025-11-17', 'Création d’un module Unity pour simuler la navigation aérienne. Implémentation d’un modèle physique simplifié et ajout d’un cockpit interactif.', NULL, '2025-11-17 09:58:17', 15),
(43, '2025-11-18', 'Développement d’un outil interne Python pour audit de transactions bancaires : anonymisation, détection de patterns suspects, export CSV.', 1, '2025-11-18 11:47:52', 16),
(44, '2025-11-19', 'Tests fonctionnels d’une API Node.js, écriture de tests Jest, correction de bugs liés à la gestion de tokens JWT et amélioration du logging.', 1, '2025-11-19 15:02:22', 7),
(46, '2025-11-17', 'Découverte de l&#039;entreprise et des différents services qui\r\nla composent, installation au poste de travail, découverte\r\nde la mission à réalisée hghgg', 1, '2025-11-24 14:44:45', 2),
(47, '2025-11-11', 'ZRQQZGV', NULL, '2025-11-24 14:44:57', 2),
(48, '2025-12-15', 'Je vais bien tout va bien', NULL, '2025-12-15 13:40:07', 2),
(49, '2025-12-15', 'sqcs', NULL, '2025-12-15 15:14:56', 21);

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `num` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `CP` int(10) NOT NULL,
  `ville` varchar(40) NOT NULL,
  `tel` int(30) NOT NULL,
  `libelleStage` varchar(500) NOT NULL,
  `email` varchar(50) NOT NULL,
  `num_tuteur` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`num`, `nom`, `adresse`, `CP`, `ville`, `tel`, `libelleStage`, `email`, `num_tuteur`) VALUES
(1, 'SRT', '5 rue compas', 95632, 'Saint-Ouen l\'aumone', 185569741, 'ezfzefzefzef', 'srt@test.fr', 1),
(2, 'TechInnov', '12 avenue des Sciences', 75015, 'Paris', 145236987, 'Développement d’une API interne en Node.js', 'contact@techinnov.fr', 2),
(3, 'GreenEnergy', '8 rue du Soleil', 69007, 'Lyon', 472559630, 'Automatisation des rapports énergétiques', 'info@greenenergy.fr', 3),
(4, 'CyberLabs', '44 rue du Progrès', 31000, 'Toulouse', 561254789, 'Sécurisation d’un parc de serveurs Debian', 'contact@cyberlabs.fr', 4),
(5, 'DataSense', '27 allée des Lumières', 44000, 'Nantes', 258124477, 'Analyse de données et tableaux de bord PowerBI', 'datasense@exemple.fr', 5),
(6, 'SoftCom', '3 rue des Inventeurs', 21000, 'Dijon', 380456271, 'Développement d’un ERP interne en PHP', 'softcom@exemple.fr', 6),
(7, 'Meditech', '14 rue Pasteur', 59000, 'Lille', 320457812, 'Développement d’outils médicaux connectés', 'meditech@exemple.fr', 7),
(8, 'WebSolutions', '76 boulevard numérique', 13001, 'Marseille', 491258741, 'Refonte d’un site web React', 'websolutions@exemple.fr', 8),
(9, 'AeroSoft', '9 avenue du Vent', 31000, 'Toulouse', 561984521, 'Simulation aéronautique sous Unity', 'aerosoft@exemple.fr', 9),
(10, 'BlueBank', '5 rue Centrale', 6000, 'Nice', 493574581, 'Outils internes Python pour analyse financière', 'bluebank@exemple.fr', 10);

-- --------------------------------------------------------

--
-- Structure de la table `tuteur`
--

CREATE TABLE `tuteur` (
  `num` int(10) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `tel` int(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tuteur`
--

INSERT INTO `tuteur` (`num`, `nom`, `prenom`, `tel`, `email`) VALUES
(1, 'Amounane', 'Rachid', 686956853, 'amounane@test.fr'),
(2, 'Martin', 'Sophie', 612458796, 'sophie.martin@exemple.fr'),
(3, 'Durand', 'Pierre', 698541237, 'pierre.durand@exemple.fr'),
(4, 'Lambert', 'Nina', 614589732, 'nina.lambert@exemple.fr'),
(5, 'Morel', 'Antoine', 671245893, 'antoine.morel@exemple.fr'),
(6, 'Giraud', 'Luc', 691452873, 'luc.giraud@exemple.fr'),
(7, 'Petit', 'Marion', 622487593, 'marion.petit@exemple.fr'),
(8, 'Schmitt', 'Olivier', 633145589, 'olivier.schmitt@exemple.fr'),
(9, 'Fabre', 'Julie', 677154896, 'julie.fabre@exemple.fr'),
(10, 'Rousseau', 'Hugo', 694782155, 'hugo.rousseau@exemple.fr');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `num` int(10) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `tel` int(20) NOT NULL,
  `login` varchar(100) NOT NULL,
  `motdepasse` varchar(100) NOT NULL,
  `type` int(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `option` int(1) DEFAULT NULL,
  `num_stage` int(10) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `date_token` datetime DEFAULT NULL,
  `validation` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`num`, `nom`, `prenom`, `tel`, `login`, `motdepasse`, `type`, `email`, `option`, `num_stage`, `token`, `date_token`, `validation`) VALUES
(2, 'Oukil', 'Benjamin', 781881446, 'boukil', '$2y$10$b7JT7OSEmS6qB471qDDgFOg.PI8eoIHBU8BFcpkkQnamMWKuFequO', 1, 'benjioukil@gmail.com', 1, 1, NULL, '2025-12-15 14:39:22', 1),
(3, 'Lottin', 'Kylian', 787459868, 'klottin', '$2y$10$/cgf2k2AH6QPovAxYEJ4fe1TnzMFy3iRPyKThOq7uJfnFVTXvgTKG', 2, 'kylian@test.fr', NULL, NULL, NULL, NULL, 0),
(5, 'Paris', 'Xavier', 506090807, 'xparis', '$2y$10$/cgf2k2AH6QPovAxYEJ4fe1TnzMFy3iRPyKThOq7uJfnFVTXvgTKG', 1, 'xav@test.fr', NULL, 1, NULL, NULL, 0),
(6, 'Selim', 'Toumi', 781556699, 'stoumi', '$2y$10$/cgf2k2AH6QPovAxYEJ4fe1TnzMFy3iRPyKThOq7uJfnFVTXvgTKG', 1, 'toumi@test.fr', 2, 1, NULL, NULL, 0),
(7, 'Dupont', 'Lucas', 678542136, 'ldupont', '$2y$10$/cgf2k2AH6QPovAxYEJ4fe1TnzMFy3iRPyKThOq7uJfnFVTXvgTKG', 1, 'lucas.dupont@test.fr', 1, 2, NULL, NULL, 0),
(8, 'Moreau', 'Camille', 698741253, 'cmoreau', '$2y$10$/cgf2k2AH6QPovAxYEJ4fe1TnzMFy3iRPyKThOq7uJfnFVTXvgTKG', 1, 'camille.moreau@test.fr', 2, 3, NULL, NULL, 0),
(9, 'Bernard', 'Julien', 658743215, 'jbernard', '$2y$10$/cgf2k2AH6QPovAxYEJ4fe1TnzMFy3iRPyKThOq7uJfnFVTXvgTKG', 2, 'julien.bernard@test.fr', NULL, NULL, NULL, NULL, 0),
(10, 'Rossi', 'Emma', 612548796, 'erossi', '$2y$10$/cgf2k2AH6QPovAxYEJ4fe1TnzMFy3iRPyKThOq7uJfnFVTXvgTKG', 1, 'emma.rossi@test.fr', 1, 4, NULL, NULL, 0),
(11, 'Blanc', 'Thomas', 678452199, 'tblanc', '$2y$10$/cgf2k2AH6QPovAxYEJ4fe1TnzMFy3iRPyKThOq7uJfnFVTXvgTKG', 1, 'thomas.blanc@test.fr', 2, 5, NULL, NULL, 0),
(12, 'Robert', 'Inès', 633258741, 'irobert', '$2y$10$/cgf2k2AH6QPovAxYEJ4fe1TnzMFy3iRPyKThOq7uJfnFVTXvgTKG', 1, 'ines.robert@test.fr', 1, 6, NULL, NULL, 0),
(13, 'Garcia', 'Leo', 644559987, 'lgarcia', '$2y$10$/cgf2k2AH6QPovAxYEJ4fe1TnzMFy3iRPyKThOq7uJfnFVTXvgTKG', 1, 'leo.garcia@test.fr', 2, 7, NULL, NULL, 0),
(14, 'Aubert', 'Sarah', 668974521, 'saubert', '$2y$10$/cgf2k2AH6QPovAxYEJ4fe1TnzMFy3iRPyKThOq7uJfnFVTXvgTKG', 1, 'sarah.aubert@test.fr', 1, 8, NULL, NULL, 0),
(15, 'Henry', 'Clara', 623548796, 'clhenry', '$2y$10$/cgf2k2AH6QPovAxYEJ4fe1TnzMFy3iRPyKThOq7uJfnFVTXvgTKG', 1, 'clara.henry@test.fr', 2, 9, NULL, NULL, 0),
(16, 'Traoré', 'Moussa', 671254458, 'mtraore', '$2y$10$/cgf2k2AH6QPovAxYEJ4fe1TnzMFy3iRPyKThOq7uJfnFVTXvgTKG', 1, 'moussa.traore@test.fr', 1, 10, NULL, NULL, 0),
(17, 'test', 'testprenom', 789, 'test', '$2y$10$FlsupNn9z2MZPW2zzkNobewWYcET1sGPpcJ36V/wUUDHxpXHTzJ/i', 1, 'yo@test.fr', NULL, NULL, NULL, NULL, 0),
(18, 'Moi', 'EncoreMoi', 895, 'test2', '$2y$10$ZfMGamQBjPuFFXImb1BbrONr4RV2L88yPlR0Or/UzGANWNNCyTm.C', 1, 'please@please.please', NULL, NULL, NULL, NULL, 0),
(19, 'Oukil', 'Benjamin', 781881446, 'noukil', '$2y$10$EDcnCfjCTQuETfbAgOYfXOO1rF5HhNjSFHU5oa2DogH/5A8uZ0K1a', 1, 'oukilbenjamin@gmail.com', NULL, NULL, NULL, NULL, 0),
(20, 'oukil', 'Moi', 78185555, 'voukil', '$2y$10$ej.bPoIRgi6wAz6xO045ReJx7qfBajq0l3BL6Fv.Za6F/TCFOUTlO', 1, 'oukil@test.fr', NULL, NULL, NULL, NULL, 0),
(21, 'yo', 'oi', 8848, 'e', '$2y$10$uRK252y9Lt3ldqubrPjB3uEFL0WSEyszKWwbCrchqqpRtshteqcR.', 1, 'bb@d', NULL, NULL, NULL, NULL, 1),
(22, 'Gravouil', 'Benjamin', 23151, 'profgravouil', '$2y$10$wize4tHXyUNSoP8NuPjf6e8P0nZLkkDYO94p3BzjHdUwZrP1IpulG', 1, 'test@g.fr', NULL, NULL, NULL, NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cr`
--
ALTER TABLE `cr`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FK1` (`num_utilisateur`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FK3` (`num_tuteur`);

--
-- Index pour la table `tuteur`
--
ALTER TABLE `tuteur`
  ADD PRIMARY KEY (`num`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`num`),
  ADD KEY `FK2` (`num_stage`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cr`
--
ALTER TABLE `cr`
  MODIFY `num` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `tuteur`
--
ALTER TABLE `tuteur`
  MODIFY `num` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `num` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cr`
--
ALTER TABLE `cr`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`num_utilisateur`) REFERENCES `utilisateur` (`num`);

--
-- Contraintes pour la table `stage`
--
ALTER TABLE `stage`
  ADD CONSTRAINT `FK3` FOREIGN KEY (`num_tuteur`) REFERENCES `tuteur` (`num`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK2` FOREIGN KEY (`num_stage`) REFERENCES `stage` (`num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
