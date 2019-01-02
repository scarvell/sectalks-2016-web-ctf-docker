DROP DATABASE IF EXISTS `ctf`;
CREATE DATABASE `ctf`;

USE `ctf`

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `pass` varchar(50) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `disabled` bool default true
); 

INSERT INTO `users` VALUES (md5(md5('PassworD')),'admin',1);


DROP TABLE IF EXISTS `logins`;

CREATE TABLE `logins` (
  `user` varchar(50) DEFAULT NULL,
  `time` datetime 
); 
