DROP DATABASE IF EXISTS `todoDwight`;
CREATE DATABASE `todoDwight` DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;
USE `todoDwight`;

CREATE TABLE `todoDwight` (
  `id` int(11) NOT NULL auto_increment,
  `what` varchar(255) NOT NULL,
  `priority` enum('high','normal','low') NOT NULL,
  `added_on` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci AUTO_INCREMENT = 4;

--
-- Dumping data for table `todolist`
--

INSERT INTO `todoDwight` VALUES (1, 'A very urgent task', 'high', now());
INSERT INTO `todoDwight` VALUES (2, 'A normal task', 'normal', now());
INSERT INTO `todoDwight` VALUES (3, 'A non-important task', 'low', now());