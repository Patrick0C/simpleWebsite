-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 10:13 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g00398246`
--
CREATE DATABASE IF NOT EXISTS `g00398246` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `g00398246`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `quantity` int(10) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `desc`, `price`, `quantity`, `img`) VALUES
(1, 'Root', '<h3>Description:</h3>\r\n<ul>\r\n<li>Root is a game of adventure and war where 2 to 4 players battle for control of a vast wilderness.</li>\r\n         \r\n<li>In Root, players drive the narrative and the differences between each role create an unparalleled level of interaction and replayability.</li>\r\n         \r\n<li>Ages 10+, 90- 120 minute playing time</li></ul>', '50.00', 9, 'root.jpg'),
(2, 'Coup', '<h3>Description:</h3>\r\n<ul>\r\n<li>You are head of a family in an Italian city-state, a city run by a weak and corrupt court. You need to manipulate, bluff and bribe your way to power.</li>\r\n         \r\n<li> Your object is to destroy the influence of all the other families, forcing them into exile. Only one family will survive...</li>\r\n         \r\n<li>Recommended Ages: 9+, 2 to 6 Players, 15 Minute Playing Time</li>', '20.00', 7, 'coup.jpg'),
(3, 'Betrayal at House on the Hill', '<h3>Description:</h3>\r\n<ul>\r\n<li>The creak of footsteps on the stairs, the smell of something foul and dead, the feel of something crawling down your back</li>\r\n         \r\n<li>This and more can be found in the exciting refresh of the Avalon Hill favorite Betrayal at House on the Hill. This fun and suspenseful game is a new experience almost every time you play.</li>\r\n         \r\n<li>Recommended Ages: 12+, 3 to 6 Players, 60 Minute Playing Time</li>', '45.00', 5, 'betrayal.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
