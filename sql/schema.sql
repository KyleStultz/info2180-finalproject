-- Host: localhost    Database: dolphin_crm
-- ------------------------------------------------------

DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE dolphin_crm;
USE dolphin_crm;

--
-- Table structure for table users
--

DROP TABLE IF EXISTS users;
CREATE TABLE users(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(20) NOT NULL,
    lastname varchar(20) NOT NULL,
    password varchar(60) NOT NULL,
    email varchar(35) NOT NULL,
    role varchar(10) NOT NULL,
    created_at datetime(6) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1;

--
-- Table structure for table contacts
--

DROP TABLE IF EXISTS contacts;
CREATE TABLE contacts (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title varchar(4) NOT NULL,
    firstname varchar(20) NOT NULL,
    lastname varchar(20) NOT NULL,
    email varchar(35) NOT NULL,
    telephone varchar(15) NOT NULL,
    role varchar(10) NOT NULL,
    company varchar(35) NOT NULL,
    type varchar(10) NOT NULL,
    assigned_to int(11) NOT NULL,
    created_by int(11) NOT NULL,
    created_at datetime(6) NOT NULL,
    updated_at datetime(6) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1;

--
-- Table structure for table notes
--

DROP TABLE IF EXISTS notes;
CREATE TABLE notes (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    contact_id int(11) NOT NULL,
    comment varchar(20) NOT NULL,
    password varchar(60) NOT NULL,
    email varchar(35) NOT NULL,
    role varchar(10) NOT NULL,
    created_at datetime(6) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1;

INSERT INTO `users` (`firstname`, `lastname`, `password`, `email`,`role` ,`created_at`) VALUES ('user1', 'admin', '$2y$10$J32K.bB0.0s/PUfcrTN/OOzkdUpG3Jwl8uml/QrejVAGkIiMzb5O.', 'admin@project2.com','admin', current_timestamp());