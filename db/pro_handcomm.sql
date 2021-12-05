-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 05 déc. 2021 à 21:29
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
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` mediumtext COLLATE utf8mb4_unicode_ci,
  `meta_description` mediumtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(1, 'cate 4', 'q5ahxwdb2m-1', '8bW9tsgcFf', '9OUgJOfL2E', 'PDLK3N9Vbq'),
(2, '2GvmjNTHSM', '4sd4ryjoxv', 'wZqxxIscf6', 'IxBXmMAfHW', 'ryeduZvqj5'),
(3, 'cate 2', 'ycqxm8o94q-1', 'e3sG4XQ9Aj', 'GX9idoylpn', 'aEzT2bSnzt'),
(4, 'cate 1', 'yfel9rwixr-1', 'iCRQ8CvUwv', 'yDUbNvhSzy', 'FQZizniTRm');

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_name` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_or_page_slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_order` int(11) DEFAULT NULL,
  `menu_parent` int(11) DEFAULT NULL,
  `menu_url` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `news_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_slug` varchar(510) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_content` text COLLATE utf8mb4_unicode_ci,
  `news_date` date DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) UNSIGNED DEFAULT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_view` int(11) DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `page_name` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_slug` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_content` longtext COLLATE utf8mb4_unicode_ci,
  `page_layout` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` longtext COLLATE utf8mb4_unicode_ci,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_left` mediumtext COLLATE utf8mb4_unicode_ci,
  `section_right` mediumtext COLLATE utf8mb4_unicode_ci,
  `short_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `name`, `slug`, `description`, `section_left`, `section_right`, `short_description`, `photo`, `banner`) VALUES
(1, 'C46DeBkAER', 'btgqqz0wzy', '<p style=\"-webkit-font-smoothing: antialiased; padding: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: 0px; vertical-align: baseline; font-size: 17px; line-height: 28px; color: rgb(106, 106, 142); font-family: \"open sans\", sans-serif;\">Ã€ vous de choisir librement de la formule qui vous convient : quelques heures, une journÃ©e, un mois... Vous restez entiÃ¨rement maÃ®tre de votre ligne tÃ©lÃ©phonique en dÃ©cidant du moment oÃ¹ vous confiez votre accueil tÃ©lÃ©phonique et la gestion de votre standard aux Ã©quipes de tÃ©lÃ©travail de Handâ€™Comm. Vous reprenez le contrÃ´le quand vous le souhaitez. Un service Ã  la carte pour vous accompagner dans vos besoins ponctuels ou rÃ©guliers.</p><p style=\"-webkit-font-smoothing: antialiased; padding: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: 0px; vertical-align: baseline; font-size: 17px; line-height: 28px; color: rgb(106, 106, 142); font-family: \"open sans\", sans-serif;\">Nos Ã©quipes externalisÃ©es de secrÃ©taires se chargent de rÃ©ceptionner vos appels, de prendre les messages, de rÃ©aliser la saisie de vos documents, de gÃ©rer votre planning et vos rendez-vous</p>', '<ul class=\"key-points mt20\" style=\"-webkit-font-smoothing: antialiased; padding: 0px; margin: 20px 0px 0px; outline: 0px; vertical-align: baseline; list-style: none; color: rgb(106, 106, 142); font-family: \"open sans\", sans-serif; font-size: 17px;\"><li style=\"-webkit-font-smoothing: antialiased; padding: 8px 0px 8px 35px; margin: 0px; outline: 0px; vertical-align: baseline; position: relative; line-height: 28px;\">Simplifiez vos tÃ¢ches quotidiennes,</li><li style=\"-webkit-font-smoothing: antialiased; padding: 8px 0px 8px 35px; margin: 0px; outline: 0px; vertical-align: baseline; position: relative; line-height: 28px;\">Disposez dâ€™un accueil client de qualitÃ©, disponible et professionnel,</li><li style=\"-webkit-font-smoothing: antialiased; padding: 8px 0px 8px 35px; margin: 0px; outline: 0px; vertical-align: baseline; position: relative; line-height: 28px;\">Confiez la saisie de vos documents commerciaux et comptes-rendus Ã  nos</li>assistantes administratives et commerciales expÃ©rimentÃ©esâ€¦</ul><p style=\"-webkit-font-smoothing: antialiased; padding: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: 0px; vertical-align: baseline; font-size: 17px; line-height: 28px; color: rgb(106, 106, 142); font-family: \"open sans\", sans-serif;\"></p><p style=\"-webkit-font-smoothing: antialiased; padding: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: 0px; vertical-align: baseline; font-size: 17px; line-height: 28px; color: rgb(106, 106, 142); font-family: \"open sans\", sans-serif;\">Un accompagnement idÃ©al pour vous consacrer entiÃ¨rement Ã  la gestion et au dÃ©veloppement de votre entreprise, organiser votre activitÃ© et vos journÃ©es de maniÃ¨re optimale et envoyer une bonne image de marque Ã  vos clients, prospects, fournisseurs et partenaires.</p>', '<h4 style=\"-webkit-font-smoothing: antialiased; padding: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: 0px; vertical-align: baseline; font-weight: 600; line-height: 32px; font-size: 22px; font-family: Poppins, sans-serif; color: rgb(5, 7, 72);\">Advantages of Digital Marketing</h4><div><br></div><h2><p style=\"-webkit-font-smoothing: antialiased; padding: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: 0px; vertical-align: baseline; font-size: 17px; line-height: 28px; color: rgb(106, 106, 142); font-family: \" open=\"\" sans\",=\"\" sans-serif;\"=\"\">Professionnels de tous secteurs et entreprises de toutes tailles, des professions libÃ©rales aux professionnels du droit, des commerÃ§ants itinÃ©rants aux artisans, PME ou professions mÃ©dicales, tous affectionneront ce que peut leur apporter une Ã©quipe de secrÃ©taires en tÃ©lÃ©travail. Elle se tient Ã  votre service du lundi au samedi, avec des horaires adaptÃ©s Ã  vos besoins et peut Å“uvrer en franÃ§ais, en anglais ou en espagnol (voire, sur demande, dans dâ€™autres langues).</p><p style=\"-webkit-font-smoothing: antialiased; padding: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: 0px; vertical-align: baseline; font-size: 17px; line-height: 28px; color: rgb(106, 106, 142); font-family: \" open=\"\" sans\",=\"\" sans-serif;\"=\"\">Un service apprÃ©ciable notamment en cas de dÃ©bordement de standard ou de surcroÃ®t de travail.</p></h2>', 'Nos Ã©quipes externalisÃ©es de secrÃ©taires se chargent de rÃ©ceptionner vos appels, de prendre les messages, de rÃ©aliser la saisie de vos documents, de gÃ©rer votre planning et vos rendez-vous', 'service-5687-@-1637604109.jpg', 'service-banner-8400-@-1637604109.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `logo` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_about` text COLLATE utf8mb4_unicode_ci,
  `footer_copyright` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_fax` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_description` text COLLATE utf8mb4_unicode_ci,
  `header_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'defualt-accueil.jpg',
  `header_nameButton` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_buttonUrl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_status` tinyint(1) NOT NULL DEFAULT '0',
  `service_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_status` tinyint(1) NOT NULL DEFAULT '0',
  `about_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_description` text COLLATE utf8mb4_unicode_ci,
  `about_shortDescription` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'defualt-accueil.jpg',
  `about_status` tinyint(1) NOT NULL DEFAULT '0',
  `references_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `references_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `references_nameButton` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `references_buttonUrl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `references_shortLine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `references_status` tinyint(1) NOT NULL DEFAULT '0',
  `partner_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_nameButton` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_buttonUrl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_shortLine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_status` tinyint(1) NOT NULL DEFAULT '0',
  `contact_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_status` tinyint(1) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` mediumtext COLLATE utf8mb4_unicode_ci,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `favicon`, `footer_about`, `footer_copyright`, `contact_address`, `contact_email`, `contact_phone`, `contact_fax`, `header_title`, `header_subtitle`, `header_description`, `header_image`, `header_nameButton`, `header_buttonUrl`, `header_status`, `service_title`, `service_subtitle`, `service_status`, `about_title`, `about_subtitle`, `about_description`, `about_shortDescription`, `about_image`, `about_status`, `references_title`, `references_subtitle`, `references_nameButton`, `references_buttonUrl`, `references_shortLine`, `references_status`, `partner_title`, `partner_subtitle`, `partner_nameButton`, `partner_buttonUrl`, `partner_shortLine`, `partner_status`, `contact_title`, `contact_subtitle`, `contact_status`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(1, 'logo.png', 'favicon.png', '<span style=\"color: rgb(106, 106, 142); font-family: \"open sans\", sans-serif; font-size: 17px;\">Une offre de compÃ©tences en tÃ©lÃ©travail ou sur site, des consultants expÃ©rimentÃ©s dans leur spÃ©cialitÃ©</span>', 'Copyright Â© 2021 Tous droits rÃ©servÃ©s. DÃ©veloppÃ© par', 'Paris - France', 'contact@handcomm.fr', '01.76.43.04.02', '01.76.43.04.02', 'Agenge Digitale HAND\'COMM', '', '<span style=\"color: rgb(106, 106, 142); font-family: \"open sans\", sans-serif; font-size: 20px;\">Une offre de compÃ©tences en tÃ©lÃ©travail ou sur site, des consultants expÃ©rimentÃ©s dans leur spÃ©cialitÃ©, des durÃ©es dâ€™intervention modulables, en fonction de vos besoins. Un seul site, un interlocuteur unique, pour augmenter vos rÃ©sultats.</span>', 'header-1638735598-@-42634.png', 'Demandez un devis gratuit', 'http://localhost/Project-me/cms-project/contact', 1, 'SecrÃ©tariat Et Accueil TÃ©lÃ©phonique', 'SERVICES QUE NOUS OFFRONS', 1, 'HANDâ€™COMM', 'SAVOIR FAIRE', '<span style=\"color: rgb(106, 106, 142); font-family: \"open sans\", sans-serif; font-size: 17px;\">Handâ€™Comm travaille avec un vaste rÃ©seau de consultants, tous spÃ©cialisÃ©s et expÃ©rimentÃ©s dans leur domaine de compÃ©tences respectif. SecrÃ©taires, graphistes, dÃ©veloppeurs, rÃ©fÃ©renceurs, community managers, rÃ©dacteurs, traducteursâ€¦</span>', '<span style=\"color: rgb(106, 106, 142); font-family: \"open sans\", sans-serif; font-size: 17px;\">Handâ€™Comm travaille avec un vaste rÃ©seau de consultants, tous spÃ©cialisÃ©s et expÃ©rimentÃ©s dans leur domaine de compÃ©tences respectif. SecrÃ©taires, graphistes, dÃ©veloppeurs, rÃ©fÃ©renceurs, commu', 'about-1638735714-@-2672.jpg', 1, 'Nos RÃ©fÃ©rences', 'NOS DERNIERS PROJETS', 'Voir maintenant', '', 'DÃ©couvrez plus de rÃ©fÃ©rences', 1, 'Nos partenaires', 'ILS NOUS FONT CONFIANCE', 'Travaillons ensemble', '', 'On promet. Nous livrons.', 1, 'CONTACTEZ NOUS', 'VOUS AVEZ DES QUESTIONS?', 1, 'handcomm', 'handcomm,website,blog,agence,test.web', 'Lorem ipsum dolor sit amet, omnis signiferumque in mei, mei ex enim concludaturque. Senserit salutandi euripidis no per, modus maiestatis scribentur est an. Ea suas pertinax has, solet officiis pericula cu pro, possit inermis qui ad. An mea tale perfecto sententiae, eos inani epicuri concludaturque.');

-- --------------------------------------------------------

--
-- Structure de la table `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `social_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '#',
  `social_icon` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `social`
--

INSERT INTO `social` (`id`, `social_name`, `social_url`, `social_icon`) VALUES
(1, 'Facebook', '', 'fa fa-facebook'),
(2, 'Twitter', '', '	 fa fa-twitter'),
(3, 'LinkedIn', '', 'fa fa-linkedin'),
(4, 'Pinterest', '', 'fa fa-pinterest'),
(5, 'YouTube', '', 'fa fa-youtube'),
(6, 'Instagram', 'https://translate.google.com/', 'fa fa-instagram'),
(7, 'WhatsApp', '', 'fa fa-whatsapp'),
(8, 'Snapchat', '', 'fa fa-snapchat');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) UNSIGNED NOT NULL,
  `nom_complet` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tele` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` mediumtext COLLATE utf8mb4_unicode_ci,
  `photo` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom_complet`, `email`, `tele`, `password`, `token`, `photo`, `role`, `status`) VALUES
(1, 'Admin Handcomm', 'Admin@handcomm.fr', '01.76.43.04.02', '59d064fae3b9d876256b27842ef0b808', NULL, 'avatar0.jpg', 'Admin', '1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
