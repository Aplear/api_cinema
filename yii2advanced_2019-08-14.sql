DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `film_id` int(11) DEFAULT NULL,
  `cinema_hall_id` int(11) DEFAULT NULL,
  `cinema_hall_row_id` int(11) DEFAULT NULL,
  `cinema_hall_seat_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-booking-user_id` (`user_id`),
  KEY `fk-booking-cinema_hall_id` (`cinema_hall_id`),
  KEY `fk-booking-cinema_hall_row_id` (`cinema_hall_row_id`),
  KEY `fk-booking-cinema_hall_seat_id` (`cinema_hall_seat_id`),
  CONSTRAINT `fk-booking-cinema_hall_id` FOREIGN KEY (`cinema_hall_id`) REFERENCES `cinema_hall` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-booking-cinema_hall_row_id` FOREIGN KEY (`cinema_hall_row_id`) REFERENCES `cinema_hall_rows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-booking-cinema_hall_seat_id` FOREIGN KEY (`cinema_hall_seat_id`) REFERENCES `cinema_hall_seats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-booking-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;

INSERT INTO `booking` (`id`, `user_id`, `film_id`, `cinema_hall_id`, `cinema_hall_row_id`, `cinema_hall_seat_id`, `price`, `status`, `created_at`, `updated_at`)
VALUES
	(1,1,1,1,1,1,45,2,1565800816,1565802376);

/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `cinema_hall`;

CREATE TABLE `cinema_hall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `cinema_hall` WRITE;
/*!40000 ALTER TABLE `cinema_hall` DISABLE KEYS */;

INSERT INTO `cinema_hall` (`id`, `title`)
VALUES
	(1,'Большой зал 1');

/*!40000 ALTER TABLE `cinema_hall` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `cinema_hall_rows`;

CREATE TABLE `cinema_hall_rows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `cinema_hall_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-cinema_hall_rows-cinema_hall_id` (`cinema_hall_id`),
  CONSTRAINT `fk-cinema_hall_rows-cinema_hall_id` FOREIGN KEY (`cinema_hall_id`) REFERENCES `cinema_hall` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `cinema_hall_rows` WRITE;
/*!40000 ALTER TABLE `cinema_hall_rows` DISABLE KEYS */;

INSERT INTO `cinema_hall_rows` (`id`, `number`, `cinema_hall_id`)
VALUES
	(1,1,1),
	(2,2,1),
	(3,3,1),
	(4,4,1),
	(5,5,1),
	(6,6,1),
	(7,7,1),
	(8,8,1),
	(9,9,1),
	(10,10,1);

/*!40000 ALTER TABLE `cinema_hall_rows` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `cinema_hall_seats`;

CREATE TABLE `cinema_hall_seats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `cinema_hall_id` int(11) DEFAULT NULL,
  `cinema_hall_row_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-cinema_hall_seats-cinema_hall_id` (`cinema_hall_id`),
  KEY `fk-cinema_hall_seats-cinema_hall_row_id` (`cinema_hall_row_id`),
  CONSTRAINT `fk-cinema_hall_seats-cinema_hall_id` FOREIGN KEY (`cinema_hall_id`) REFERENCES `cinema_hall` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-cinema_hall_seats-cinema_hall_row_id` FOREIGN KEY (`cinema_hall_row_id`) REFERENCES `cinema_hall_rows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `cinema_hall_seats` WRITE;
/*!40000 ALTER TABLE `cinema_hall_seats` DISABLE KEYS */;

INSERT INTO `cinema_hall_seats` (`id`, `number`, `cinema_hall_id`, `cinema_hall_row_id`)
VALUES
	(1,1,1,1),
	(2,2,1,1),
	(3,3,1,1),
	(4,4,1,1),
	(5,5,1,1),
	(6,6,1,1),
	(7,7,1,1),
	(8,8,1,1),
	(9,9,1,1),
	(10,10,1,1),
	(11,11,1,1),
	(12,12,1,1),
	(13,1,1,2),
	(14,2,1,2),
	(15,3,1,2),
	(16,4,1,2),
	(17,5,1,2),
	(18,6,1,2),
	(19,7,1,2),
	(20,8,1,2),
	(21,9,1,2),
	(22,10,1,2),
	(23,11,1,2),
	(24,12,1,2),
	(25,1,1,3),
	(26,2,1,3),
	(27,3,1,3),
	(28,4,1,3),
	(29,5,1,3),
	(30,6,1,3),
	(31,7,1,3),
	(32,8,1,3),
	(33,9,1,3),
	(34,10,1,3),
	(35,11,1,3),
	(36,12,1,3),
	(37,1,1,4),
	(38,2,1,4),
	(39,3,1,4),
	(40,4,1,4),
	(41,5,1,4),
	(42,6,1,4),
	(43,7,1,4),
	(44,8,1,4),
	(45,9,1,4),
	(46,10,1,4),
	(47,11,1,4),
	(48,12,1,4),
	(49,1,1,5),
	(50,2,1,5),
	(51,3,1,5),
	(52,4,1,5),
	(53,5,1,5),
	(54,6,1,5),
	(55,7,1,5),
	(56,8,1,5),
	(57,9,1,5),
	(58,10,1,5),
	(59,11,1,5),
	(60,12,1,5),
	(61,1,1,6),
	(62,2,1,6),
	(63,3,1,6),
	(64,4,1,6),
	(65,5,1,6),
	(66,6,1,6),
	(67,7,1,6),
	(68,8,1,6),
	(69,9,1,6),
	(70,10,1,6),
	(71,11,1,6),
	(72,12,1,6),
	(73,1,1,7),
	(74,2,1,7),
	(75,3,1,7),
	(76,4,1,7),
	(77,5,1,7),
	(78,6,1,7),
	(79,7,1,7),
	(80,8,1,7),
	(81,9,1,7),
	(82,10,1,7),
	(83,11,1,7),
	(84,12,1,7),
	(85,1,1,8),
	(86,2,1,8),
	(87,3,1,8),
	(88,4,1,8),
	(89,5,1,8),
	(90,6,1,8),
	(91,7,1,8),
	(92,8,1,8),
	(93,9,1,8),
	(94,10,1,8),
	(95,11,1,8),
	(96,12,1,8),
	(97,1,1,9),
	(98,2,1,9),
	(99,3,1,9),
	(100,4,1,9),
	(101,5,1,9),
	(102,6,1,9),
	(103,7,1,9),
	(104,8,1,9),
	(105,9,1,9),
	(106,10,1,9),
	(107,11,1,9),
	(108,12,1,9),
	(109,1,1,10),
	(110,2,1,10),
	(111,3,1,10),
	(112,4,1,10),
	(113,5,1,10),
	(114,6,1,10),
	(115,7,1,10),
	(116,8,1,10),
	(117,9,1,10),
	(118,10,1,10),
	(119,11,1,10),
	(120,12,1,10);

/*!40000 ALTER TABLE `cinema_hall_seats` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `films`;

CREATE TABLE `films` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cinema_hall_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `start_at` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-films-cinema_hall_id` (`cinema_hall_id`),
  CONSTRAINT `fk-films-cinema_hall_id` FOREIGN KEY (`cinema_hall_id`) REFERENCES `cinema_hall` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `films` WRITE;
/*!40000 ALTER TABLE `films` DISABLE KEYS */;

INSERT INTO `films` (`id`, `cinema_hall_id`, `title`, `image`, `price`, `start_at`, `status`, `created_at`, `updated_at`)
VALUES
	(1,1,'Стартрек: за межами всесвiту','/uploads/films/14-08-2019/601_1565794068.png',45,1566392400,1,1565794068,1565794068);

/*!40000 ALTER TABLE `films` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;

INSERT INTO `migration` (`version`, `apply_time`)
VALUES
	('m000000_000000_base',1565789471),
	('m130524_201442_init',1565789472),
	('m190124_110200_add_verification_token_column_to_user_table',1565789472),
	('m190813_110148_create_cinema_hall_table',1565789472),
	('m190813_132617_create_films_table',1565789472),
	('m190813_132810_create_cinema_hall_rows_table',1565789472),
	('m190813_132820_create_cinema_hall_seats_table',1565789472),
	('m190813_132940_create_booking_table',1565789473),
	('m190813_161043_create_token_table',1565789473);

/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `token`;

CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expired_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `fk-token-user_id` (`user_id`),
  CONSTRAINT `fk-token-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;

INSERT INTO `token` (`id`, `user_id`, `token`, `expired_at`)
VALUES
	(1,1,'Txh4QCH9jKW5fJOLCtGU6dcU1pifVj__',1565967578);

/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_eu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telegram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `secret_key`, `status`, `created_at`, `updated_at`, `phone`, `phone_eu`, `first_name`, `last_name`, `telegram`, `position`)
VALUES
	(1,'test','DQH9DVcbaPQj8ZibDIO-CwOGrKV6icD1','$2y$13$HxB7Y.ZkKg5O5fRvedaUwOXS5Qo6JE.31bZrLBKRlyR4Zt7AHHw/G',NULL,'admin@indelivery.com',NULL,10,1504129096,1544698096,NULL,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
