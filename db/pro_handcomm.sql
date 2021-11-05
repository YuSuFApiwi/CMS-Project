-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 05 nov. 2021 à 02:43
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pro_handcomm`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(225) DEFAULT NULL,
  `category_slug` varchar(225) DEFAULT NULL,
  `meta_title` varchar(225) DEFAULT NULL,
  `meta_keyword` mediumtext,
  `meta_description` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_type` varchar(100) DEFAULT NULL,
  `menu_name` varchar(225) DEFAULT NULL,
  `category_or_page_slug` varchar(100) DEFAULT NULL,
  `menu_order` int(11) DEFAULT NULL,
  `menu_parent` int(11) DEFAULT NULL,
  `menu_url` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_title` varchar(225) DEFAULT NULL,
  `news_slug` varchar(225) DEFAULT NULL,
  `news_content` mediumtext,
  `news_date` varchar(225) DEFAULT NULL,
  `photo` varchar(225) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `publisher` int(11) DEFAULT NULL,
  `total_view` int(11) DEFAULT NULL,
  `meta_title` varchar(225) DEFAULT NULL,
  `meta_keyword` mediumtext,
  `meta_description` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `page_name` varchar(220) DEFAULT NULL,
  `page_slug` varchar(220) DEFAULT NULL,
  `page_content` mediumtext,
  `page_layout` varchar(255) DEFAULT NULL,
  `banner` varchar(225) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `meta_title` varchar(225) DEFAULT NULL,
  `meta_keyword` mediumtext,
  `meta_description` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `sett_id` int(11) NOT NULL,
  `logo` varchar(225) DEFAULT NULL,
  `favicon` varchar(225) DEFAULT NULL,
  `footer_about` mediumtext,
  `footer_copyeight` mediumtext,
  `contct_adress` mediumtext,
  `contact_email` varchar(225) DEFAULT NULL,
  `contact_phone` varchar(225) DEFAULT NULL,
  `meta_title` mediumtext,
  `meta_key` mediumtext,
  `meta_description` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `social`
--

CREATE TABLE `social` (
  `social_id` int(11) NOT NULL,
  `social_name` varchar(220) DEFAULT NULL,
  `social_url` varchar(225) DEFAULT NULL,
  `social_icon` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) UNSIGNED NOT NULL,
  `nom_complet` varchar(100) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `tele` varchar(100) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `token` text,
  `photo` varchar(225) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom_complet`, `email`, `tele`, `password`, `token`, `photo`, `role`, `status`) VALUES
(1, 'Youssef Apiwi', 'YoussefApiwi@gmail.com', '+212688827249', '9f9f50fcac548f986305e8d738e1a2be', NULL, NULL, 'Admin', '1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sett_id`);

--
-- Index pour la table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`social_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
