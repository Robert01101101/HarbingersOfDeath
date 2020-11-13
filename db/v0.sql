-- ROBERT CUSTOM CODE
-- Create DB
CREATE DATABASE `ROBERT_MICHELS`;
USE `ROBERT_MICHELS`;

-- Ensure no duplicates exist
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `address`;
DROP TABLE IF EXISTS `user_omen`;
DROP TABLE IF EXISTS `omen`;
DROP TABLE IF EXISTS `aspect`;
DROP TABLE IF EXISTS `death`;
DROP TABLE IF EXISTS `fault`;

-- ______________________________________________________________________________________________________________________________________________


-- Exported from QuickDBD: https://www.quickdatabasediagrams.com/
-- Link to schema: https://app.quickdatabasediagrams.com/#/d/rccGAs
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.

-- Modify this code to update the DB schema diagram.
-- To reset the sample schema, replace everything with
-- two dots ('..' - without quotes).

CREATE TABLE `user` (
    `user_id` int(10)  NOT NULL ,
    `user_name` varchar(50)  NOT NULL ,
    `password` varchar(50)  NOT NULL ,
    `created_at` timestamp  NOT NULL ,
    `phone_number` varchar(50)  NOT NULL ,
    `address_id` int(10)  NOT NULL ,
    `full_name` varchar(50)  NOT NULL ,
    `email_address` varchar(50)  NOT NULL ,
    `image_path` varchar(50)  NULL ,
    PRIMARY KEY (
        `user_id`
    )
);

CREATE TABLE `address` (
    `address_id` int(10)  NOT NULL ,
    `country` varchar(50)  NOT NULL ,
    `province` varchar(50)  NOT NULL ,
    `city` varchar(50)  NOT NULL ,
    `postal_code` varchar(50)  NOT NULL ,
    `street_address` varchar(50)  NOT NULL ,
    `street_address_2` varchar(50)  NOT NULL ,
    PRIMARY KEY (
        `address_id`
    )
);

CREATE TABLE `user_omen` (
    `user_id` int(10)  NOT NULL ,
    `omen_id` int(10)  NOT NULL 
);

CREATE TABLE `omen` (
    `omen_id` int(10)  NOT NULL ,
    `slug` varchar(50)  NOT NULL ,
    `title` varchar(512)  NOT NULL ,
    `image_path` varchar(256)  NOT NULL ,
    `aspect_id` int(10)  NOT NULL ,
    `death_id` int(10)  NOT NULL ,
    `fault_id` int(10)  NOT NULL ,
    PRIMARY KEY (
        `omen_id`
    )
);

CREATE TABLE `aspect` (
    `term_id` int(10)  NOT NULL ,
    `slug` varchar(50)  NOT NULL ,
    `title` varchar(50)  NOT NULL ,
    PRIMARY KEY (
        `term_id`
    )
);

CREATE TABLE `death` (
    `term_id` int(10)  NOT NULL ,
    `slug` varchar(50)  NOT NULL ,
    `title` varchar(50)  NOT NULL ,
    PRIMARY KEY (
        `term_id`
    )
);

CREATE TABLE `fault` (
    `term_id` int(10)  NOT NULL ,
    `slug` varchar(50)  NOT NULL ,
    `title` varchar(50)  NOT NULL ,
    PRIMARY KEY (
        `term_id`
    )
);

ALTER TABLE `user` ADD CONSTRAINT `fk_user_address_id` FOREIGN KEY(`address_id`)
REFERENCES `address` (`address_id`);

ALTER TABLE `user_omen` ADD CONSTRAINT `fk_user_omen_user_id` FOREIGN KEY(`user_id`)
REFERENCES `user` (`user_id`);

ALTER TABLE `user_omen` ADD CONSTRAINT `fk_user_omen_omen_id` FOREIGN KEY(`omen_id`)
REFERENCES `omen` (`omen_id`);

ALTER TABLE `omen` ADD CONSTRAINT `fk_omen_aspect_id` FOREIGN KEY(`aspect_id`)
REFERENCES `aspect` (`term_id`);

ALTER TABLE `omen` ADD CONSTRAINT `fk_omen_death_id` FOREIGN KEY(`death_id`)
REFERENCES `death` (`term_id`);

ALTER TABLE `omen` ADD CONSTRAINT `fk_omen_fault_id` FOREIGN KEY(`fault_id`)
REFERENCES `fault` (`term_id`);

CREATE INDEX `idx_user_user_name`
ON `user` (`user_name`);




-- ______________________________________________________________________________________________________________________________________________

--  ROBERT CUSTOM CODE
--  Add values to taxonomy tables 

LOCK TABLES `aspect` WRITE;

insert  into `aspect`(`term_id`,`slug`,`title`) values (0,'domestic-life','Domestic Life'),(1,'vitality','Vitality'),(2,'industry','Industry'),(3,'religion','Religion'),(4,'death','Death');

UNLOCK TABLES;
LOCK TABLES `death` WRITE;

insert  into `death`(`term_id`,`slug`,`title`) values (0,'close-friend','Close Friend'),(1,'you','You'),(2,'community-member','Community Member'),(3,'family-member','Family Member');

UNLOCK TABLES;
LOCK TABLES `fault` WRITE;

insert  into `fault`(`term_id`,`slug`,`title`) values (0,'you','You'),(1,'god','God'),(2,'the-public','The Public');

UNLOCK TABLES;
LOCK TABLES `omen` WRITE;

insert  into `omen`(`omen_id`,`slug`,`title`,`image_path`,`aspect_id`,`death_id`,`fault_id`) values 
(00,'cracked-bread','Have you baked bread, that has cracks upon its top?','/assets/images/bread.jpg',0,0,0),
(01,'ringing-ears','Is there a ringing in your ears?','/assets/images/bread.jpg',1,1,0),
(02,'lighted-carptenters-shop','Has a light suddenly and unaccountably been seen in a carpenter’s shop?','/assets/images/bread.jpg',2,2,2);

UNLOCK TABLES;