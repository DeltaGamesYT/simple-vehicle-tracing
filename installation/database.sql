SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `vehicles` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `vehicles`;

CREATE TABLE IF NOT EXISTS `clients` (
  `passkey` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `vehicles` (
  `position` varchar(255) NOT NULL,
  `vehicle_id` varchar(255) NOT NULL,
  `last_update` int(255) NOT NULL,
  `passkey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;
