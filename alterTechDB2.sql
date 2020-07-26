-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `apprentis`;
CREATE TABLE `apprentis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv` longtext COLLATE utf8mb4_unicode_ci,
  `ecole` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `niveau_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F2324D186CC499D` (`pseudo`),
  KEY `IDX_F2324D1B3E9C81` (`niveau_id`),
  CONSTRAINT `FK_F2324D1B3E9C81` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `apprentis` (`id`, `pseudo`, `roles`, `description`, `image`, `ville`, `cv`, `ecole`, `niveau_id`) VALUES
(12,	'hello',	'[]',	NULL,	NULL,	'hello',	NULL,	NULL,	NULL),
(13,	'marcus',	'[]',	NULL,	NULL,	'Paris',	NULL,	NULL,	NULL),
(14,	'lol',	'[]',	NULL,	NULL,	'Londres',	NULL,	NULL,	NULL),
(15,	'Ben',	'[]',	NULL,	NULL,	'Strasbourg',	NULL,	NULL,	NULL),
(16,	'Bobbyxxx',	'[]',	NULL,	NULL,	'Lyon',	NULL,	NULL,	NULL),
(17,	'willy',	'[]',	NULL,	NULL,	'Berlin',	NULL,	NULL,	NULL),
(18,	'dav',	'[]',	NULL,	NULL,	'Paris',	NULL,	NULL,	NULL),
(19,	'Karl',	'[]',	NULL,	NULL,	'Londres',	NULL,	NULL,	NULL),
(20,	'lea',	'[]',	NULL,	NULL,	'lille',	NULL,	NULL,	NULL),
(21,	'joe',	'[]',	NULL,	NULL,	'joe',	NULL,	NULL,	NULL),
(22,	'roi',	'[]',	NULL,	NULL,	'royan',	NULL,	NULL,	NULL),
(23,	'vox',	'[]',	NULL,	NULL,	'Londres',	NULL,	NULL,	NULL),
(24,	'bvb',	'[]',	NULL,	NULL,	'Dortmund',	NULL,	NULL,	NULL),
(25,	'salty',	'[]',	NULL,	NULL,	'Strasbourg',	NULL,	NULL,	NULL),
(26,	'shrek',	'[]',	'Salut Salut',	NULL,	'Barcelone',	NULL,	'Central',	2),
(27,	'paul',	'[]',	NULL,	NULL,	'Rennes',	NULL,	NULL,	3);

DROP TABLE IF EXISTS `apprentis_candidatures`;
CREATE TABLE `apprentis_candidatures` (
  `apprentis_id` int NOT NULL,
  `candidatures_id` int NOT NULL,
  PRIMARY KEY (`apprentis_id`,`candidatures_id`),
  KEY `IDX_53834F0B9850AEC` (`apprentis_id`),
  KEY `IDX_53834F093767DAA` (`candidatures_id`),
  CONSTRAINT `FK_53834F093767DAA` FOREIGN KEY (`candidatures_id`) REFERENCES `candidatures` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_53834F0B9850AEC` FOREIGN KEY (`apprentis_id`) REFERENCES `apprentis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `apprentis_candidatures` (`apprentis_id`, `candidatures_id`) VALUES
(15,	21),
(15,	22),
(15,	24),
(15,	25),
(15,	27),
(15,	28),
(16,	20),
(16,	23),
(16,	29),
(16,	30),
(26,	26);

DROP TABLE IF EXISTS `apprentis_competences`;
CREATE TABLE `apprentis_competences` (
  `apprentis_id` int NOT NULL,
  `competences_id` int NOT NULL,
  PRIMARY KEY (`apprentis_id`,`competences_id`),
  KEY `IDX_F1237E4B9850AEC` (`apprentis_id`),
  KEY `IDX_F1237E4A660B158` (`competences_id`),
  CONSTRAINT `FK_F1237E4A660B158` FOREIGN KEY (`competences_id`) REFERENCES `competences` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_F1237E4B9850AEC` FOREIGN KEY (`apprentis_id`) REFERENCES `apprentis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `apprentis_competences` (`apprentis_id`, `competences_id`) VALUES
(13,	1),
(13,	3),
(14,	1),
(14,	3),
(15,	1),
(15,	2),
(15,	3),
(15,	10),
(16,	1),
(16,	2),
(17,	6),
(18,	1),
(18,	2),
(18,	4),
(18,	10),
(19,	1),
(19,	2),
(19,	3),
(19,	4),
(20,	1),
(20,	5),
(20,	10),
(21,	1),
(22,	1),
(22,	2),
(23,	1),
(23,	2),
(24,	1),
(25,	2),
(25,	3),
(26,	3),
(26,	4),
(26,	5),
(27,	1),
(27,	2);

DROP TABLE IF EXISTS `candidatures`;
CREATE TABLE `candidatures` (
  `id` int NOT NULL AUTO_INCREMENT,
  `offres_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `lettredemotiv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reponse_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DE57CF66CF18BB82` (`reponse_id`),
  KEY `IDX_DE57CF666C83CD9F` (`offres_id`),
  CONSTRAINT `FK_DE57CF666C83CD9F` FOREIGN KEY (`offres_id`) REFERENCES `offres` (`id`),
  CONSTRAINT `FK_DE57CF66CF18BB82` FOREIGN KEY (`reponse_id`) REFERENCES `reponse` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `candidatures` (`id`, `offres_id`, `created_at`, `cv`, `message`, `lettredemotiv`, `traite`, `vu`, `reponse_id`) VALUES
(20,	11,	'2020-07-15 16:17:26',	'5f0f0ff6a1ed6.png',	NULL,	NULL,	NULL,	NULL,	NULL),
(21,	26,	'2020-07-15 17:08:07',	'5f0f1bd7265b3.png',	NULL,	NULL,	NULL,	NULL,	NULL),
(22,	27,	'2020-07-22 15:59:47',	'5f18465332ca8.png',	NULL,	NULL,	NULL,	NULL,	NULL),
(23,	27,	'2020-07-22 16:00:14',	'5f18466ead020.png',	NULL,	NULL,	NULL,	NULL,	NULL),
(24,	9,	'2020-07-23 15:25:35',	'5f198fcfbe5d8.png',	NULL,	NULL,	'traitee',	NULL,	15),
(25,	11,	'2020-07-24 12:46:45',	'5f1abc1521b38.pdf',	NULL,	NULL,	NULL,	NULL,	NULL),
(26,	25,	'2020-07-24 13:33:57',	'5f1ac725eaba7.pdf',	NULL,	NULL,	NULL,	NULL,	NULL),
(27,	22,	'2020-07-24 13:48:05',	'5f1aca7577761.pdf',	NULL,	'5f1aca7577ac1.pdf',	NULL,	NULL,	NULL),
(28,	24,	'2020-07-24 13:51:19',	'5f1acb37cf8d2.pdf',	NULL,	'5f1acb37cf93c.pdf',	NULL,	NULL,	NULL),
(29,	10,	'2020-07-24 14:50:36',	'5f1ad91ccf786.pdf',	NULL,	'5f1ad91ccf810.pdf',	'traitee',	NULL,	9),
(30,	13,	'2020-07-24 14:53:07',	'5f1ad9b35af62.pdf',	NULL,	'5f1ad9b35afcb.pdf',	'traitee',	NULL,	2);

DROP TABLE IF EXISTS `competences`;
CREATE TABLE `competences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `competences` (`id`, `name`) VALUES
(1,	'C'),
(2,	'CMS'),
(3,	'C++'),
(4,	'CSS'),
(5,	'C#'),
(6,	'Php'),
(7,	'Python'),
(8,	'javaScript'),
(9,	'Java'),
(10,	'Ruby'),
(11,	'HTML');

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200611150522',	'2020-07-03 11:25:19',	5507),
('DoctrineMigrations\\Version20200612130139',	'2020-07-03 11:25:25',	922),
('DoctrineMigrations\\Version20200703111800',	'2020-07-03 13:18:04',	196),
('DoctrineMigrations\\Version20200703111850',	'2020-07-03 13:18:54',	220),
('DoctrineMigrations\\Version20200703173509',	'2020-07-03 19:35:25',	1768),
('DoctrineMigrations\\Version20200703191027',	'2020-07-03 21:10:32',	923),
('DoctrineMigrations\\Version20200705155810',	'2020-07-05 17:58:23',	119),
('DoctrineMigrations\\Version20200705161713',	'2020-07-05 18:17:17',	59),
('DoctrineMigrations\\Version20200706105951',	'2020-07-06 13:00:10',	532),
('DoctrineMigrations\\Version20200712152346',	'2020-07-12 17:24:02',	147),
('DoctrineMigrations\\Version20200712170908',	'2020-07-12 19:09:19',	87),
('DoctrineMigrations\\Version20200712185138',	'2020-07-12 20:51:49',	89),
('DoctrineMigrations\\Version20200723145234',	'2020-07-23 16:52:48',	765),
('DoctrineMigrations\\Version20200724083329',	'2020-07-24 10:33:43',	309),
('DoctrineMigrations\\Version20200724085017',	'2020-07-24 10:50:22',	384),
('DoctrineMigrations\\Version20200724153211',	'2020-07-24 17:32:32',	639);

DROP TABLE IF EXISTS `domaine`;
CREATE TABLE `domaine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `domaine` (`id`, `name`) VALUES
(1,	'jeux-vidéo'),
(2,	'agence web'),
(3,	'développement logiciel'),
(4,	'consultant en informatique'),
(5,	'applications mobiles');

DROP TABLE IF EXISTS `entreprises`;
CREATE TABLE `entreprises` (
  `id` int NOT NULL AUTO_INCREMENT,
  `roles` json NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domaine_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_56B1B7A94272FC9F` (`domaine_id`),
  CONSTRAINT `FK_56B1B7A94272FC9F` FOREIGN KEY (`domaine_id`) REFERENCES `domaine` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `entreprises` (`id`, `roles`, `name`, `description`, `image`, `ville`, `verified`, `domaine_id`) VALUES
(11,	'[]',	'actimage',	NULL,	NULL,	'Strasbourg',	NULL,	NULL),
(12,	'[]',	'Sogeti',	NULL,	NULL,	'Strasbourg',	NULL,	NULL),
(13,	'[]',	'Euro information',	NULL,	NULL,	'Strasbourg',	NULL,	NULL),
(14,	'[]',	'Atos',	NULL,	NULL,	'Strasbourg',	NULL,	NULL),
(15,	'[]',	'BPCE',	NULL,	NULL,	'Lyon',	NULL,	NULL),
(16,	'[]',	'SFEIR',	'Hello hello',	NULL,	'Strasbourg',	NULL,	3);

DROP TABLE IF EXISTS `helloworld`;
CREATE TABLE `helloworld` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `niveau`;
CREATE TABLE `niveau` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `niveau` (`id`, `name`) VALUES
(1,	'Bac'),
(2,	'Bac +1'),
(3,	'Bac +2'),
(4,	'Bac +3'),
(5,	'Bac +4'),
(6,	'Bac +5'),
(7,	'Bac +6'),
(8,	'Bac +7');

DROP TABLE IF EXISTS `offres`;
CREATE TABLE `offres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `domaine_id` int DEFAULT NULL,
  `entreprises_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `begin_at` datetime NOT NULL,
  `duree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `salaire` int DEFAULT NULL,
  `nb_candidats` int DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C6AC3544A70A18EC` (`entreprises_id`),
  KEY `IDX_C6AC3544B3E9C81` (`niveau_id`),
  KEY `IDX_C6AC35444272FC9F` (`domaine_id`),
  CONSTRAINT `FK_C6AC35444272FC9F` FOREIGN KEY (`domaine_id`) REFERENCES `domaine` (`id`),
  CONSTRAINT `FK_C6AC3544A70A18EC` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`),
  CONSTRAINT `FK_C6AC3544B3E9C81` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `offres` (`id`, `domaine_id`, `entreprises_id`, `name`, `created_at`, `begin_at`, `duree`, `description`, `salaire`, `nb_candidats`, `image`, `ville`, `niveau_id`) VALUES
(9,	NULL,	11,	'Développeur React Node',	'2020-07-06 13:04:02',	'2021-01-11 00:00:00',	'1',	'Dev Fullstack JS',	1200,	2,	'5f030522b89c3.png',	'Londres',	2),
(10,	NULL,	11,	'Développeur Java',	'2020-07-06 13:10:37',	'2021-01-11 00:00:00',	'1',	'dev Java',	1200,	4,	'5f0306ad9e6b7.png',	'Londres',	3),
(11,	1,	11,	'Dev RubyonRails',	'2020-07-12 13:38:40',	'2021-01-01 00:00:00',	'1',	'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',	1,	11,	'5f0af6404d75e.png',	'Pekin',	2),
(12,	NULL,	11,	'Dev Vue.js',	'2020-07-12 13:48:36',	'2024-01-01 00:00:00',	'1',	'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',	2,	NULL,	'5f0af89405aa7.png',	'Berlin',	4),
(13,	1,	11,	'Dev C',	'2020-07-12 16:20:57',	'2023-01-01 00:00:00',	'2',	'blablab',	1200,	2,	'',	'Paris',	5),
(14,	2,	11,	'Developpeur php',	'2020-07-12 16:22:10',	'2022-01-01 00:00:00',	'2',	'fejiudsqhfdsqfhdsqu',	1000,	NULL,	'5f0b1c9246394.png',	'Marseille',	1),
(22,	4,	11,	'dev c#',	'2020-07-12 17:19:34',	'2021-01-01 00:00:00',	'1',	'ok',	1000,	2,	'5f0b2a066ebf1.png',	'Strasbourg',	2),
(24,	4,	11,	'developpeur node',	'2020-07-12 17:24:13',	'2021-01-01 00:00:00',	'4',	'dsfsqfdsqfd',	300,	3,	NULL,	'Tokyo',	3),
(25,	2,	11,	'Dev Python',	'2020-07-15 14:16:20',	'2019-01-01 00:00:00',	'2',	'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXx',	1000,	2,	'5f0ef3940e9c9.png',	'Londres',	1),
(26,	4,	12,	'Consultant java',	'2020-07-15 16:38:51',	'2021-02-02 00:00:00',	'2',	'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',	1150,	1,	'5f0f14fbaacd7.png',	'Strasbourg',	4),
(27,	1,	11,	'Dev test',	'2020-07-22 15:59:02',	'2023-01-01 00:00:00',	'2',	'XXXXXXXXXXXXXXXXXXXXXx',	15000,	2,	NULL,	'Paris',	3);

DROP TABLE IF EXISTS `offres_competences`;
CREATE TABLE `offres_competences` (
  `offres_id` int NOT NULL,
  `competences_id` int NOT NULL,
  PRIMARY KEY (`offres_id`,`competences_id`),
  KEY `IDX_977C3E7C6C83CD9F` (`offres_id`),
  KEY `IDX_977C3E7CA660B158` (`competences_id`),
  CONSTRAINT `FK_977C3E7C6C83CD9F` FOREIGN KEY (`offres_id`) REFERENCES `offres` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_977C3E7CA660B158` FOREIGN KEY (`competences_id`) REFERENCES `competences` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `offres_competences` (`offres_id`, `competences_id`) VALUES
(9,	8),
(9,	10),
(10,	2),
(10,	3),
(10,	9),
(11,	2),
(11,	3),
(11,	9),
(11,	10),
(12,	8),
(13,	1),
(13,	2),
(14,	6),
(22,	5),
(22,	9),
(22,	10),
(24,	1),
(24,	2),
(24,	3),
(24,	9),
(24,	10),
(24,	11),
(25,	1),
(25,	2),
(25,	3),
(25,	4),
(25,	5),
(25,	6),
(25,	7),
(25,	8),
(25,	9),
(26,	1),
(26,	5),
(26,	6),
(26,	9),
(27,	1),
(27,	2),
(27,	3),
(27,	4),
(27,	5),
(27,	6),
(27,	7),
(27,	8),
(27,	9),
(27,	10),
(27,	11);

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE `reponse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rdv` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `reponse` (`id`, `message`, `rdv`) VALUES
(1,	'ça sera',	'2015-01-01 00:00:00'),
(2,	'ça sera un non',	'2015-01-01 00:00:00'),
(3,	'Hello',	NULL),
(4,	'yo',	NULL),
(5,	'dsds',	NULL),
(6,	'hello',	NULL),
(7,	'coucou',	NULL),
(8,	'Hello',	NULL),
(9,	'hello',	NULL),
(10,	'hello',	NULL),
(11,	'hello',	NULL),
(12,	'hello',	NULL),
(13,	'hello',	NULL),
(14,	'hello',	NULL),
(15,	'hello',	NULL);

DROP TABLE IF EXISTS `tests`;
CREATE TABLE `tests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `offres_id` int DEFAULT NULL,
  `entreprises_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1260FC5E6C83CD9F` (`offres_id`),
  KEY `IDX_1260FC5EA70A18EC` (`entreprises_id`),
  CONSTRAINT `FK_1260FC5E6C83CD9F` FOREIGN KEY (`offres_id`) REFERENCES `offres` (`id`),
  CONSTRAINT `FK_1260FC5EA70A18EC` FOREIGN KEY (`entreprises_id`) REFERENCES `entreprises` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tests_competences`;
CREATE TABLE `tests_competences` (
  `tests_id` int NOT NULL,
  `competences_id` int NOT NULL,
  PRIMARY KEY (`tests_id`,`competences_id`),
  KEY `IDX_80DFD70EF5D80971` (`tests_id`),
  KEY `IDX_80DFD70EA660B158` (`competences_id`),
  CONSTRAINT `FK_80DFD70EA660B158` FOREIGN KEY (`competences_id`) REFERENCES `competences` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_80DFD70EF5D80971` FOREIGN KEY (`tests_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fiche_entreprise_id` int DEFAULT NULL,
  `fiche_apprenti_id` int DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  KEY `IDX_8D93D649F241FBD4` (`fiche_entreprise_id`),
  KEY `IDX_8D93D649939F6C3` (`fiche_apprenti_id`),
  CONSTRAINT `FK_8D93D649939F6C3` FOREIGN KEY (`fiche_apprenti_id`) REFERENCES `apprentis` (`id`),
  CONSTRAINT `FK_8D93D649F241FBD4` FOREIGN KEY (`fiche_entreprise_id`) REFERENCES `entreprises` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `fiche_entreprise_id`, `fiche_apprenti_id`, `email`, `roles`, `password`) VALUES
(1,	NULL,	12,	'test@test.com',	'[\"ROLE_USER\"]',	'stHGdg4MhYOm/OVTWjpMJievIvJqafsQQ3WpWlUNDT6WfHupVWjBQaxdppMQkdCmYSXl6QQQXVYLGL/MDZi5Zw=='),
(2,	NULL,	NULL,	'max@max.com',	'[\"ROLE_USER\"]',	'U5xyFq7KQU1CWeX3UcLB0mwWZZQUq0PL8U+GLWomfGW/WQWxxGLi+0ifhmnlw/gQ5pPjNNZV1/q8kMVpAXsFZw=='),
(3,	NULL,	NULL,	'bla@bla.com',	'[\"ROLE_USER\"]',	'$argon2id$v=19$m=65536,t=4,p=1$gsyeV5kuHbgK7gByUn/4xg$Nsrw8zyn2wG2bLWRFY0O6jyIELC+2UQDNrXI07Ho/9I'),
(4,	NULL,	NULL,	'doe@doe.com',	'[\"ROLE_USER\"]',	'$argon2id$v=19$m=65536,t=4,p=1$RYMbw+S7gUS3LAsUexkwKw$ZbeZ9aaRIyTHKSTJQKIMNSynVoKGfCF1zpQ9d36NeQQ'),
(6,	NULL,	NULL,	'joey@joey.com',	'[\"ROLE_USER\"]',	'7Mu/KkBgjdCDDXfKSGSjbmbNxEMvXqlG/Tuuv/wrxUaOZPls2JBvCku0ifHy9+K/bNGwJLRHrANQL983CZYV6A=='),
(7,	NULL,	NULL,	'x@x.com',	'[\"ROLE_USER\"]',	'fPAVrgLNJdHOXxU3LBUn+alL5mAJPiisXW3EE1DY31gIj2TFolUQkQqe92Se05FoQpH1oonvpBWi7MkisMpBnA=='),
(8,	NULL,	NULL,	'bic@bic.com',	'[\"ROLE_USER\"]',	'00OZLp9Dy0BWviuYTBq5qFEEbTC7mQ7aN8eu8Hyk0dUAW5UVqckm/+onkSO9v5qUT+cDwFGEvgxO+1pYT12w8w=='),
(9,	NULL,	NULL,	'bill@bill.com',	'[\"ROLE_USER\"]',	'uF0ILteeV3IhfXdoejATjBkwHFg30V/Lozoen7Bsx8M9l3Jc7kBpVoJ7qzvq9HoHXmGSCcFeX5jY95CtXLn/Og=='),
(11,	NULL,	NULL,	'luc@luc.com',	'[\"ROLE_USER\"]',	'2G/Z6kp1Om+vKj7xdyKfJ8WT3nmKj0jZ++pOtOGoY5goO2cNdtYfope7mwfqVdtcI2ydH7twdcMemfPCLKgu3w=='),
(13,	NULL,	NULL,	'hack@hack.com',	'[\"ROLE_USER\"]',	'niE1xVuWXRF9EZBpEZIyv1XUIv2EUhZXei9ZTbfpQhl4bsAs/Ok2OD4DICAcgZczkcY7wcdMfh6F7+mT9Y3i9A=='),
(14,	NULL,	16,	'bob@bob.com',	'[\"ROLE_USER\"]',	'rTjZdr0FdNPU956qH0GB0OhCGKBSc/NrRpi2A1d3AhXbn3Extw+tjjmT/N9HHNKxwKnLdhPO6qB2ohHXq+uZPg=='),
(16,	NULL,	NULL,	'jean@jean.com',	'[\"ROLE_USER\"]',	'uri5Sk1h4Lz5zeztwx9F5xUbQYjUv10ammZe23fm4Y+o4SdbSo1F1nqHBIg+rTRbaTlvFftl/p4Bp8fmFZPSOA=='),
(18,	NULL,	NULL,	'hulk@hulk.com',	'[\"ROLE_USER\"]',	'zhxA7tkw5zGU+vOw6pp3Nc43RNbjY6EAzhUaPWoo4XVLW/txoZSfdzYv4bQyxRKkwjWGlVQxGrNA5LGRtRlZ5Q=='),
(20,	NULL,	NULL,	'fb@fb.com',	'[\"ROLE_USER\"]',	'w8aj7zDel1OD+oAFvNchauLdnPMohnVnfOY4aQ0QeYbcNRBtvE1xX9XbZcDEt0hyyA2/YK1bQ7AUYLgfyujQ5Q=='),
(21,	11,	NULL,	'actimage@actimage.com',	'[\"ROLE_USER\"]',	'U5xyFq7KQU1CWeX3UcLB0mwWZZQUq0PL8U+GLWomfGW/WQWxxGLi+0ifhmnlw/gQ5pPjNNZV1/q8kMVpAXsFZw=='),
(22,	NULL,	13,	'jondoe@mail.com',	'[\"ROLE_USER\"]',	'o0pnk9RL01B4zxQf+HsRcYKmHInczNqoaEjR887CvptsL1fd9tHaik3zt2HL5onHu5M/7ZDH2zZWSEyxRpqeng=='),
(23,	NULL,	NULL,	'app@app.com',	'[\"ROLE_USER\"]',	'GkP8fzqq5rXfnA0aQuAXeCDTS3rRhgrddxPKE4z2QFvLiRr8BoXJPdfJq9gRZrFMmqKi/kJSCTeaCmRNtm5QRQ=='),
(24,	NULL,	14,	'lol@lol.com',	'[\"ROLE_USER\"]',	'y0fYairFHWDTFh4FeuufLm3eHIanWx5vJQyh4XeT4ZlwEGoSRuIMKA1CwRdggwG13zxa3zNElhjEBpwpCNcHLg=='),
(25,	NULL,	15,	'hello@yahoo.fr',	'[\"ROLE_USER\"]',	'U5xyFq7KQU1CWeX3UcLB0mwWZZQUq0PL8U+GLWomfGW/WQWxxGLi+0ifhmnlw/gQ5pPjNNZV1/q8kMVpAXsFZw=='),
(26,	NULL,	NULL,	'world@gmail.com',	'[\"ROLE_USER\"]',	'U5xyFq7KQU1CWeX3UcLB0mwWZZQUq0PL8U+GLWomfGW/WQWxxGLi+0ifhmnlw/gQ5pPjNNZV1/q8kMVpAXsFZw=='),
(27,	NULL,	17,	'id@id.com',	'[\"ROLE_USER\"]',	'8g7KG4EDvgg4pdGqIGerRx2RuaENfTzusOJX7ebRPGq1V+t18dlKV48gLR/fViygJC5RtgfxeN+zMwvawmFDOg=='),
(28,	12,	NULL,	'sogeti@sogeti.fr',	'[\"ROLE_USER\"]',	'U5xyFq7KQU1CWeX3UcLB0mwWZZQUq0PL8U+GLWomfGW/WQWxxGLi+0ifhmnlw/gQ5pPjNNZV1/q8kMVpAXsFZw=='),
(29,	NULL,	NULL,	'giu@giu.com',	'[\"ROLE_USER\"]',	'jWS1/hd4m6uS0YZgF0cqRYHedD4UfNmDA2sl6b/lyFbEWQbZzqbN7WTZI8Gyj6Ksq4T/12ZDq0FGy6gcMiVCVA=='),
(30,	NULL,	18,	'dav@dav.fr',	'[\"ROLE_USER\"]',	'3Mr7dSI5rJHbAEBSjqB98I+KZC/AwwRZRcC08uSikNSIj2F2M5L8MAIJTBpfwvDl7Cc4UoqdUW7F7f/QEHZkJQ=='),
(31,	13,	NULL,	'ei@ei.fr',	'[\"ROLE_USER\"]',	'LSAg2Pc2IkVkZB4WnH1pRW2C3N0g1HhRzVE4sMjC5ww30w6GPeKXs4v5y4sqsKP80AkY3sx1BNPnL/Hmcys9gg=='),
(32,	NULL,	19,	'karl@karl.fr',	'[\"ROLE_USER\"]',	'nQGOXwOP8l5++O7k0kYGnO7ifBcAON0nwMjLJ3UgxvW0kbvJY2kmMYzzlOilGn2ppRn40rGqbH4L1fQOBOY+Nw=='),
(33,	14,	NULL,	'atos@atos.fr',	'[\"ROLE_USER\"]',	'w6RXcD5YI2/+oVq7E4YRRould6i4Z5QA4eOXf4irJwZH3Gz445UC1Y6em2iBZleYZQFuP1zaOFkfyjysTdW6Rg=='),
(34,	NULL,	NULL,	'bpce@bpce',	'[\"ROLE_USER\"]',	'W51jyp4YH5OxmnZTlN+0FqyIZo8kFPwmnheXaqk9FoEsvpDAVwjSIhuyGVTo1HO7jr0kAJryKJPfSmqZEaqOtA=='),
(35,	15,	NULL,	'bpce@bpce.fr',	'[\"ROLE_USER\"]',	'W51jyp4YH5OxmnZTlN+0FqyIZo8kFPwmnheXaqk9FoEsvpDAVwjSIhuyGVTo1HO7jr0kAJryKJPfSmqZEaqOtA=='),
(36,	NULL,	20,	'lea@lea.fr',	'[\"ROLE_USER\"]',	'BuPwqeLtN+5fo6xMDVDw+5XA6qpYMyBblhmYLILaVkN90TQ+APpCkKr7uLoRZt73omrhHaeGmxnS62th4zXZAw=='),
(37,	NULL,	21,	'hox@hox.fr',	'[\"ROLE_USER\"]',	'A5KNFX/4oRvhWYf6HB9Z7yd3A1BlW7qZp4UHi+Zf8iC9bM1jpit16LJXGWJb0bsScCmdKdyQpWlVAQisOJ7otg=='),
(38,	NULL,	22,	'roi@roi.fr',	'[\"ROLE_USER\"]',	'aEDe2aM/y5BopAC0NvjR2JBGcn9roJ2vVEz/PC1/p8vXfDdYs6KPdxnNTGroXn5crHTAlYxMa/KTy/2h5NH/wA=='),
(39,	NULL,	NULL,	'troy@troy.fr',	'[\"ROLE_USER\"]',	'6OX7m9T7WYJVmJP4mSgvH65t2/Rnj/ijA5Mg4JGAGr8qy3pw/2SA6iJRkjygbH2vZwKYa2LDqu39/V5GaEvxBw=='),
(40,	NULL,	23,	'vox@vox.fr',	'[\"ROLE_USER\"]',	'fJIeV0a9IqKLgoqeELykxyEgZaTmo/hI0W4dwDFFk2J/yqT+ZDR6dRQUnSoqKF1iY1j9HlZ2XHNcvU5K/868rQ=='),
(41,	NULL,	24,	'bvb@bvb.fr',	'[\"ROLE_USER\"]',	'U5xyFq7KQU1CWeX3UcLB0mwWZZQUq0PL8U+GLWomfGW/WQWxxGLi+0ifhmnlw/gQ5pPjNNZV1/q8kMVpAXsFZw=='),
(42,	NULL,	25,	'teo@teo.fr',	'[\"ROLE_USER\"]',	'TPEH+2BtNfyXAbOTiFgTwQ9tHOWARe54fittDKJcmKda5nukgBGrhFlks8Pwt34lv9ukot7hOZbQ+QzjreT22Q=='),
(43,	NULL,	26,	'shrek@shrek.fr',	'[\"ROLE_USER\"]',	'ntihDAVwkEqfcp2l11miHl0zLQ8y0t7VkR0waTBd304u3IDwionp5CljIdARpAO+eBpjs5IT1eHIO3IVCzda7Q=='),
(44,	NULL,	27,	'paul@paul.fr',	'[\"ROLE_USER\"]',	'rsQjSLBQOE4uliXiaNSPvNF2raSIrtHdMc9pLZ2fgRPgflOJHZJFIujJwUt6ulbs7mcFJCXx9CsEQyQSdpyLBg=='),
(45,	16,	NULL,	'sfeir@sfeir.fr',	'[\"ROLE_USER\"]',	'o989fWrZlXgN8B91HP5rZwEQ8Y3gTh0Lt+sjCCyR9RtLDiRHxFDC3tFLUEjS1DX2uuoZRaiH2sjGUNAC29Y3TQ==');

-- 2020-07-26 16:37:07
