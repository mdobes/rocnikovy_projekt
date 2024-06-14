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
                        `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                        `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
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

INSERT INTO `post` (`id`, `author_id`, `title`, `slug`, `perex`, `content`, `isActive`, `publish_date`, `coverImage`, `readingTime`, `createdAt`, `updatedAt`) VALUES
                                                                                                                                                                   (1,	1,	'Jak začít s programováním',	'jak-zacit-s-programovanim',	'V dnešní digitální době je znalost programování cennou dovedností. Naučte se, jak začít a které jazyky jsou pro začátečníky nejlepší.',	'<h1>Jak začít s programováním</h1>\r\n<p>V dnešní digitální době je znalost programování cennou dovedností. Naučte se, jak začít a které jazyky jsou pro začátečníky nejlepší.</p>\r\n<h2>Proč se učit programovat?</h2>\r\n<p>Programování otevírá dveře k mnoha kariérním příležitostem a umožňuje vám vytvářet vlastní projekty. Je to dovednost, která se stále více požaduje v různých oborech.</p>\r\n<h2>Výběr prvního programovacího jazyka</h2>\r\n<p>Pro začátečníky jsou ideální jazyky jako Python, JavaScript nebo Ruby. Jsou intuitivní a mají velkou komunitu, která nabízí mnoho zdrojů pro učení.</p>\r\n<h2>Zdroje pro učení</h2>\r\n<ul>\r\n    <li><a href=\"https://www.codecademy.com\">Codecademy</a></li>\r\n    <li><a href=\"https://www.coursera.org\">Coursera</a></li>\r\n    <li><a href=\"https://www.khanacademy.org\">Khan Academy</a></li>\r\n</ul>\r\n<p>Začněte dnes a objevte svět programování!</p>',	1,	'2024-05-13 00:00:00',	'/uploads/eThglAGeeCzvKOP6wGRO.png',	1,	'2024-06-14 06:59:15',	'2024-06-14 06:59:15'),
                                                                                                                                                                   (2,	1,	'Nejlepší techniky pro zvládání stresu',	'nejlepsi-techniky-pro-zvladani-stresu',	'Stres je součástí každodenního života, ale existují účinné techniky, jak ho zvládat. Zjistěte, jak můžete zlepšit své duševní zdraví.',	'<h1>Nejlepší techniky pro zvládání stresu</h1>\r\n<p>Stres je součástí každodenního života, ale existují účinné techniky, jak ho zvládat. Zjistěte, jak můžete zlepšit své duševní zdraví.</p>\r\n<h2>Dechová cvičení</h2>\r\n<p>Dechová cvičení jsou jednoduchým a efektivním způsobem, jak snížit stres. Vyzkoušejte hluboké dýchání nebo techniku 4-7-8.</p>\r\n<h2>Meditace</h2>\r\n<p>Meditace může pomoci uklidnit mysl a snížit úroveň stresu. Existuje mnoho aplikací, které vám mohou pomoci začít, jako je Headspace nebo Calm.</p>\r\n<h2>Fyzická aktivita</h2>\r\n<p>Cvičení je skvělý způsob, jak se zbavit stresu. Vyzkoušejte různé aktivity, jako je jóga, běh nebo plavání, abyste našli to, co vám nejvíce vyhovuje.</p>\r\n<p>Implementujte tyto techniky do svého každodenního života a sledujte, jak se vaše úroveň stresu snižuje.</p>',	1,	'2024-06-14 00:00:00',	'/uploads/X5TK8VJrdItsXJz9Kja1.png',	1,	'2024-06-14 04:57:01',	'2024-06-14 04:57:01'),
                                                                                                                                                                   (3,	1,	'Cestování po Evropě: Nejlepší destinace pro rok 2024',	'cestovani-po-evrope-nejlepsi-destinace-pro-rok-2024',	'Evropa nabízí nespočet krásných destinací k prozkoumání. Podívejte se na náš výběr nejlepších míst, která byste měli navštívit v roce 2024.',	'<p>Cestování po Evropě: Nejlepší destinace pro rok 2024</p>\r\n\r\n<p>Evropa nabízí nespočet krásných destinací k prozkoumání. Podívejte se na náš výběr nejlepších míst, která byste měli navštívit v roce 2024.</p>\r\n\r\n<p>1. Praha, Česká republika</p>\r\n\r\n<p>Praha je známá svou bohatou historií, nádhernou architekturou a živou kulturou. Navštivte Pražský hrad, Karlův most a Staroměstské náměstí.</p>\r\n\r\n<p>2. Santorini, Řecko</p>\r\n\r\n<p>Santorini je ostrov známý svými úchvatnými výhledy, bílými domky a křišťálově čistým mořem. Ideální místo pro romantickou dovolenou.</p>\r\n\r\n<p>3. Barcelona, Španělsko</p>\r\n\r\n<p>Barcelona je město plné umění, architektury a skvělé kuchyně. Nezapomeňte navštívit Sagradu Famílii, Park Güell a projít se po Las Ramblas.</p>\r\n\r\n<p>Naplánujte si své cesty a objevte krásy Evropy v roce 2024!</p>\r\n',	1,	'2024-06-14 00:00:00',	'/uploads/U8hpwViZ0aRSml1hphAt.png',	1,	'2024-06-14 05:00:37',	'2024-06-14 05:00:44');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
                        `id` int NOT NULL AUTO_INCREMENT,
                        `username` varchar(30) NOT NULL,
                        `password` varchar(100) NOT NULL,
                        `isSuperAdmin` tinyint NOT NULL,
                        `isDeleted` tinyint NOT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user` (`id`, `username`, `password`, `isSuperAdmin`, `isDeleted`) VALUES
    (1,	'admin',	'$2y$10$p80LitBQC7Ln.EY8tAD.AOXMH3uecbxGHUVABs3uwiDbe.YyjaW2q',	1,	0);

-- 2024-06-14 05:01:21
