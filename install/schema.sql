-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
`id` int NOT NULL AUTO_INCREMENT,
`author_id` int NOT NULL,
`title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
`slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
`perex` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
`content` longtext COLLATE utf8mb4_general_ci NOT NULL,
`isActive` tinyint NOT NULL,
`publish_date` datetime NOT NULL,
`coverImage` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
`readingTime` int NOT NULL,
`createdAt` datetime NOT NULL,
`updatedAt` datetime NOT NULL,
PRIMARY KEY (`id`),
KEY `user_id` (`author_id`),
CONSTRAINT `post_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
`id` int NOT NULL AUTO_INCREMENT,
`username` varchar(30) NOT NULL,
`password` varchar(100) NOT NULL,
`isSuperAdmin` tinyint NOT NULL,
`isDeleted` tinyint NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- 2024-06-14 04:57:44
