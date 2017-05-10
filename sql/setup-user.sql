-- Ensure its UTF8 on the database connection
SET NAMES utf8;
--
-- Create table for my own movie database
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`
(
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `name` VARCHAR(100),
  `password` VARCHAR(100)
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;


SELECT * FROM `users`;
