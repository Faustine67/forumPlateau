-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum_faustine
CREATE DATABASE IF NOT EXISTS `forum_faustine` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `forum_faustine`;

-- Listage de la structure de la table forum_faustine. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_faustine.category : ~6 rows (environ)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id_category`, `categoryName`) VALUES
	(1, 'Arbre'),
	(2, 'Fleurs'),
	(3, 'Ovipare'),
	(4, 'Vivipare'),
	(5, 'Category Test'),
	(9, 'Test');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Listage de la structure de la table forum_faustine. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `postDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `topic_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_post`),
  KEY `user_id` (`user_id`),
  KEY `FK_post_topic` (`topic_id`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_faustine.post : ~8 rows (environ)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id_post`, `postDate`, `content`, `topic_id`, `user_id`) VALUES
	(1, '2023-03-27 09:15:01', 'J\'aime les roses', 7, 1),
	(2, '2023-03-27 07:15:49', 'C\'est la saison des tulipes', 8, 2),
	(4, '2023-03-27 09:16:43', 'Quels sont les types de feuillus', 2, 1),
	(5, '2023-03-27 09:17:05', 'Tarzan n\'a qu\'à bien se tenir', 3, 1),
	(6, '2023-03-27 16:39:16', 'Petit mais mignon', 4, 2),
	(8, '2023-03-27 16:39:51', 'Où est ce que ça pousse?', 5, 2),
	(9, '2023-03-27 09:46:46', 'Merci pour les roses, merci pour les &eacute;pines', 7, 1),
	(10, '2023-03-29 14:37:32', 'content test', 9, 1);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Listage de la structure de la table forum_faustine. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `topicName` varchar(50) NOT NULL DEFAULT '',
  `topicDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `locked` tinyint(1) DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_faustine.topic : ~9 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `topicName`, `topicDate`, `user_id`, `locked`, `category_id`) VALUES
	(1, 'Coniferes', '2023-03-27 06:56:33', 1, NULL, 1),
	(2, 'Feuillus', '2023-03-27 09:01:34', 2, NULL, 1),
	(3, 'Liane', '2023-03-27 07:01:51', 2, NULL, 1),
	(4, 'Arbustes', '2023-03-27 09:02:20', 1, NULL, 1),
	(5, 'Gardenias', '2023-03-27 07:04:23', 2, NULL, 2),
	(7, 'Roses', '2023-03-27 07:04:53', 5, NULL, 2),
	(8, 'Tulipes', '2023-03-27 09:05:25', 2, NULL, 2),
	(9, 'Topic Test', '2023-03-29 14:37:25', 1, NULL, 5),
	(17, 'Test topic', '2023-04-03 16:23:03', 5, 0, 9);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table forum_faustine. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(15) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `inscriptionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ban` tinyint(1) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum_faustine.user : ~6 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `nickname`, `email`, `password`, `inscriptionDate`, `ban`, `role`) VALUES
	(1, 'Nickname1', 'nickname1@gmail.com', 'blabla1', '2023-03-27 06:59:09', NULL, 'normal'),
	(2, 'Nickname2', 'nickname2@gmail.com', 'blabla2', '2023-03-27 07:00:34', NULL, 'normal'),
	(3, 'micka', 'micka@exemple.com', '$2y$10$GV6Pg489eY4f7XBcQBDIx.yUpgfxqBlGPnbbI4ZUDBDQogYIbGH3.', '2023-03-30 15:07:38', NULL, 'moderator'),
	(4, 'faustine', 'faustine@exemple.fr', '$2y$10$uoJMeyQNKOOK/MFkiNmuB.bp38aE3rjn5wUd3xH4R6CMtJxzD9fU2', '2023-03-30 15:54:20', NULL, 'normal'),
	(5, 'f', 'f@exemple.fr', '$2y$10$r8BvMmc806c31PSxHPsaQeCMXKav9vfs1FVyy6Nid58eSpyvvYVg2', '2023-04-03 09:26:42', NULL, 'admin'),
	(6, 'mickael', 'mickael@exemple.com', '$2y$10$yjUcF8uJW2DOEXBg/DrTCOb3b8zjarfEiS1FhwMNEyCRaLrI66fla', '2023-04-03 14:30:44', NULL, NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
