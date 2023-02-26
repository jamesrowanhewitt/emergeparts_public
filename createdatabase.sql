CREATE DATABASE nodexlin_db_main;
USE nodexlin_db_main;

CREATE TABLE IF NOT EXISTS `accounts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`username` varchar(50) NOT NULL,
  	`password` varchar(255) NOT NULL,
  	`email` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE parts (
	id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	partnumber varchar(255) NOT NULL,
	quantity int(255) NOT NULL,
	binlocation varchar(255) NOT NULL
);


INSERT INTO `accounts` (`id`, `username`, `password`, `email`) VALUES (1, 'testuser', 'testtest1000', 'testuser@emailaddress.com');
