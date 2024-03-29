-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2021 at 01:24 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `robert_michels`
--

-- --------------------------------------------------------

--
-- Table structure for table `aspect`
--

DROP TABLE IF EXISTS `aspect`;
CREATE TABLE IF NOT EXISTS `aspect` (
  `term_id` int(10) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aspect`
--

INSERT INTO `aspect` (`term_id`, `slug`, `title`) VALUES
(0, 'domestic-life', 'Domestic Life'),
(1, 'vitality', 'Vitality'),
(2, 'industry', 'Industry'),
(3, 'religion', 'Religion'),
(4, 'death', 'Death');

-- --------------------------------------------------------

--
-- Table structure for table `death`
--

DROP TABLE IF EXISTS `death`;
CREATE TABLE IF NOT EXISTS `death` (
  `term_id` int(10) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `death`
--

INSERT INTO `death` (`term_id`, `slug`, `title`) VALUES
(0, 'close-friend', 'Close Friend'),
(1, 'you', 'You'),
(2, 'community-member', 'Community Member'),
(3, 'family-member', 'Family Member');

-- --------------------------------------------------------

--
-- Table structure for table `fault`
--

DROP TABLE IF EXISTS `fault`;
CREATE TABLE IF NOT EXISTS `fault` (
  `term_id` int(10) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fault`
--

INSERT INTO `fault` (`term_id`, `slug`, `title`) VALUES
(0, 'you', 'You'),
(1, 'god', 'God'),
(2, 'the-public', 'The Public');

-- --------------------------------------------------------

--
-- Table structure for table `omen`
--

DROP TABLE IF EXISTS `omen`;
CREATE TABLE IF NOT EXISTS `omen` (
  `omen_id` int(10) NOT NULL AUTO_INCREMENT,
  `slug` varchar(50) NOT NULL,
  `title` varchar(512) NOT NULL,
  `statement` varchar(512) NOT NULL,
  `image_author` varchar(255) NOT NULL,
  `poem` varchar(512) NOT NULL,
  `poem_author` varchar(255) NOT NULL,
  `aspect_id` int(10) NOT NULL,
  `death_id` int(10) NOT NULL,
  `fault_id` int(10) NOT NULL,
  PRIMARY KEY (`omen_id`),
  KEY `fk_omen_aspect_id` (`aspect_id`),
  KEY `fk_omen_death_id` (`death_id`),
  KEY `fk_omen_fault_id` (`fault_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `omen`
--

INSERT INTO `omen` (`omen_id`, `slug`, `title`, `statement`, `image_author`, `poem`, `poem_author`, `aspect_id`, `death_id`, `fault_id`) VALUES
(1, 'cracked-bread', 'Have you baked bread, that has cracks upon its top?', 'You have baked bread, that has cracks upon its top.', 'Boy with a Basket of Bread, Evaristo Baschenis', 'morning blue sky--- / a bakery runs out / of croissants', 'Fred Masarani (2011)', 0, 0, 0),
(2, 'ringing-ears', 'Is there a ringing in your ears?', 'There is a ringing in your ear.', 'Gossip, 1055', 'he rings in my ears / and gets louder when I try / to bury our love', 'Shanna Moore', 1, 1, 0),
(3, 'lighted-carptenters-shop', 'Has a light suddenly and unaccountably been seen in a carpenter’s shop?', 'A light has suddenly and unaccountably been seen in a carpenter’s shop.', 'Rainy Night in the Old Quarter, Michael Handt', 'weight that shifts / with the news of a death / storm light', 'Lynne Rees (2017)', 2, 2, 2),
(4, 'umbrella', 'Have you opened an umbrella in your house?', 'You have opened an umbrella in your house.', 'The Chancellor Seguier, Charles Le Brun', 'my umbrella / flipped in the wind– / uncertain days', 'Adelaide Shaw (2014)', 0, 2, 0),
(5, 'bell-ringing', 'Has a bell rung of its own accord?', 'A bell has been rung of its own accord.', 'David playing bells. The Hague', 'she bows lower / than all the others— / temple bell', 'Sondra Byrnes (2016)', 3, 2, 1),
(6, 'funeral-procession', 'Did anyone arrive at the funeral, after the procession had begun?', 'Someone arrived at the funeral after the procession had begun.', 'Entierro del conde de orgaz, El Greco', 'headlights— /a possum crouches / by the roadside', 'Cynthia Rowe (2020)', 4, 2, 2),
(7, 'hair-pin', 'Has a hairpin fallen from your hair?', 'A hairpin has fallen from your hair.', 'Judith and Her Maidservant, Artemisia Gentileschi', 'rivulets of red / running down her pale young face / she clutches a doll', 'Armando Corneille (2011)', 0, 1, 0),
(8, 'sunday-corpse', 'Did you keep a corpse in the house over Sunday?', 'You kept a corpse in the house over Sunday.', 'The Three Ages of Man and Death, Hans Baldung\n(1541–1544)', 'darkening skies -- / the final hours / of the weekend', 'Paul David Mena (2013)', 4, 3, 0),
(9, 'looking-glass', 'Have you broken a looking-glass?', 'You have broken a looking-glass.', 'Portrait of cardinal Fernando Niño de Guevara, El Greco', 'a discolored wall / where the mirror / used to be', 'Paul David Mena (2019)', 0, 3, 0),
(10, 'gaping-scissors ', 'Have scissors been left gaping on a table?', 'Scissors have been left gaping on a table.', 'Miniature of Delilah cutting Samson\'s hair, 1445', 'cutting up red pepper / for the salad--- / a drop of blood', 'Fred Masarani (2007)', 0, 3, 2),
(11, 'dish-cloth', 'Has a dish-cloth been hung on a door-knob?', 'A dish-cloth has been hung on a door-knob.', 'Attesa IV, Michelle Arnold Paine', 'doing the dishes - / a tiny soap bubble rises / toward heaven', 'Gabi Greve (2006)', 0, 3, 2),
(12, 'house-hoe', 'Have you carried a hoe through your house?', 'You have carried a hoe through your house.', 'Gardeners at wrok, Abel Grimmer', 'spring blossoms ... / the old farmer / coughs blood', 'Gabi Greve (2009)', 2, 2, 0),
(13, 'breakfast-sneeze', 'Have you sneezed before breakfast on Sunday morning?', 'You have sneezed before breakfast on Sunday morning.', 'The Lunch, Diego Velázquez (1599-1660)', 'spring morning / one egg left / in the fridge', 'An Mayou (2016)', 1, 0, 0),
(14, 'lying-on-table', 'Have you laid down upon on a table?', 'You have laid down upon on a table.', 'Merry Company on a Terrace', 'morning sun / the crumbs on the table / have a shadow', 'André Duhaim (2001)', 0, 1, 0),
(15, 'singing-and-eating', 'Has there been singing at the table while your family is eating?', 'There has been singing at the table while your family was eating.', 'As the Old Sing, So Pipe the Young, Jan Steen', 'geriatric ward-- / the table groans / when they fold it up', 'Earl Keener (2004)', 0, 0, 2),
(16, 'three-raps', 'Have three raps been heard?', 'Three raps have been heard.', 'Le Pape Formose et Etienne VII, Jean Paul Laurens (1870)', 'insomnia / the rat trap / snapping shut', 'Cudd Cwmwl (2017)', 0, 3, 1),
(17, 'candle-coffin', 'Have you seen a coffin in a candle?', 'You have seen a coffin in a candle.', 'Burial, Antoine Wiertz', 'candle drippings / on the epitaph- / a broken word', 'Alegria Imperial (2012)', 0, 2, 1),
(18, 'unmolested-window-shades', 'Have window-shades fallen without being molested?', 'Window-shades have fallen without being molested.', 'The Calling of Saint Matthew-Caravaggo (1599-1600)', 'her empty nursery ... / a sudden breeze lifts / the floral curtains', 'Cynthia Rowe (2019)', 0, 2, 1),
(19, 'out-of-season-bloom', 'Have you seen a flower bloom out season?', 'You have seen a flower bloom out season.', 'Four Seasons in One Head, Giuseppe Arcimboldo', 'long illness – / pink dogwood blooming / without me', 'Debbi Antebi (2020)', 1, 2, 1),
(20, 'sparks-in-ashes', 'Were sparks unintentionally left in the ashes over night?', 'Sparks were unintentionally left in the ashes over night.', 'Trial by Fire, Fra Angelico', 'wild fires / in the mist / the ashes', 'Cindy Tebo (2003)', 0, 3, 2),
(21, 'motionless-clock', 'Has a long motionless clock suddenly begun to tick?', 'A long motionless clock suddenly began to tick.', 'Medieval clock with wheel-work and dials in book from c. 1450', 'lone guest gone – / the ticking / of the parlor clock', 'Brian Austin Darnell (2016)', 0, 3, 1),
(22, 'bonnet', 'Have you tied on a bonnet?', 'You tied on a bonnet.', 'Portrait of a Woman, Van der Weyden', 'first date -- / wondering if the hat / is too much', 'Carol Raisfeld (2016)', 0, 0, 0),
(23, 'sick-person-dress', 'Have you worked on a sick person\'s dress?', 'You worked on a sick person\'s dress.', 'Flemish School, circa 1630', 'dusk- / an unfinished sweater / on the rocking chair', 'Betty Kaplan (2011)', 2, 1, 0),
(24, 'ground-dance', 'Have you danced on the ground?', 'You danced on the ground.', 'Death and the miser. Frans II van Francken', 'heat lightning— / the first drop of sweat / on her chin', 'John Wisdom (2019)', 0, 1, 0),
(25, 'stuck-shears', 'During sickness, have you dropped shears that have stuck into the ground?', 'During sickness, you dropped shears that have stuck into the ground.', 'Delilah shearing Samson by Granger', 'social distancing / our new neighbour / sharpens the scythe', 'Eva Limbach (2020)', 1, 1, 0),
(26, 'looking-glass-corpse', 'Have you looked into a looking-glass while a corpse is in your house?', 'You looked into a looking-glass while a corpse is in your house.', 'The Arnolfini Wedding Portrait, Jan Van Eyck', 'bathroom mirror / always a stranger / in my place', 'Isabel Caves (2019)', 4, 1, 0),
(27, 'rain-open-grave', 'Did rain fall into an open grave?', 'Rain fell into an open grave.', 'The Rain, Claude Monet', 'winter rain / the sheets where she slept / grow colder', 'Darrell Byrd (2010)', 4, 2, 1),
(28, 'pass-through-funeral', 'Did you pass through a funeral procession?', 'You passed through a funeral procession.', 'A Jewish Funeral, Hein Burgers (1860–1899)', 'plastic bags / trapped on barbed wire / roadside cross', 'Sharon Rhutaseljones (2019)', 4, 1, 0),
(29, 'road-corpse', 'Has a corpse passed over the same road twice?', 'A corpse passed over the same road twice.', 'The Triumph of Death, Pieter Bruegel the Elder', 'year\'s end / there\'s a hearse / in the fast lane', 'Mark Holloway (2015)', 4, 2, 2),
(30, 'open-eyed-corpse', 'Have the eyes of a corpse opened of their own accord?', 'The eyes of a corpse opened of their own accord.', 'The Body of the Dead Christ in the Tomb, Hans Holbein (1520-22)', 'near the wall / of the cemetery / a condom', 'Geert Verbeke (2004)', 4, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `full_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password`, `created_at`, `full_name`, `email_address`, `date_of_birth`, `image_path`) VALUES
(4, '51eac6b471a284d3341d8c0c63d0f1a286262a18', '2020-12-04 21:32:16', 'Robert Michels', 'fxkingz@live.com', '1970-01-01', 'testImage'),
(5, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2020-12-04 08:42:03', 'Robert Michels', 'rmichels@sfu.ca', '1970-01-01', 'testImage'),
(6, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2020-12-04 08:42:30', 'Robert Michels', 'rmichels@sfu.caa', '1970-01-01', 'testImage'),
(7, '95cb0bfd2977c761298d9624e4b4d4c72a39974a', '2020-12-04 18:16:46', 'u7tyu', 'ty7', '1970-01-01', 'testImage'),
(8, 'f3921183f998574d4fa9c95773fbac5d97e4c952', '2020-12-04 19:24:16', 'rwerfd', 'faserd', '1970-01-01', 'testImage');

-- --------------------------------------------------------

--
-- Table structure for table `user_omen`
--

DROP TABLE IF EXISTS `user_omen`;
CREATE TABLE IF NOT EXISTS `user_omen` (
  `user_id` int(10) NOT NULL,
  `omen_id` int(10) NOT NULL,
  KEY `fk_user_omen_user_id` (`user_id`),
  KEY `fk_user_omen_omen_id` (`omen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_omen`
--

INSERT INTO `user_omen` (`user_id`, `omen_id`) VALUES
(4, 17),
(4, 26),
(4, 13);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `omen`
--
ALTER TABLE `omen`
  ADD CONSTRAINT `fk_omen_aspect_id` FOREIGN KEY (`aspect_id`) REFERENCES `aspect` (`term_id`),
  ADD CONSTRAINT `fk_omen_death_id` FOREIGN KEY (`death_id`) REFERENCES `death` (`term_id`),
  ADD CONSTRAINT `fk_omen_fault_id` FOREIGN KEY (`fault_id`) REFERENCES `fault` (`term_id`);

--
-- Constraints for table `user_omen`
--
ALTER TABLE `user_omen`
  ADD CONSTRAINT `fk_user_omen_omen_id` FOREIGN KEY (`omen_id`) REFERENCES `omen` (`omen_id`),
  ADD CONSTRAINT `fk_user_omen_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
