CREATE DATABASE `bakery`;

USE `bakery`;

CREATE TABLE `bakery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `rating` int(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
);

