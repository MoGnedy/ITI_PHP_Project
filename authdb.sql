-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2017 at 08:43 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `authdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `group_desc` text NOT NULL,
  `callBack` varchar(50) NOT NULL,
  `proj_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `group_desc`, `callBack`, `proj_num`) VALUES
(1, 'superUser', 'Group 4 Super User', '/userAuth/users/allUsers.php', 4),
(2, 'projectAdmin', 'Group 4 Project Admin', '/userAuth/users/projectUsers.php', 4),
(3, 'powerUser', 'Group 1 User with All Privileges ', '/userManagment/index.php', 1),
(4, 'editManager', 'Group 1 user with create & update users privileges ', '/userManagment/index.php', 1),
(5, 'deleteManager', 'Group 1 user with delete users privileges ', '/userManagment/index.php', 1),
(6, 'serverAdmin', 'Group 2 user All privileges ', '/ApacheConf/index.php', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `password` longtext NOT NULL,
  `exp_date` date DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `is_blocked` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `user_name`, `password`, `exp_date`, `group_id`, `is_blocked`) VALUES
(2, 'Eslam Gamal Khoga', 'khoga1', '$2y$10$K3UfSWHVl1tVy8rXzdCFe.54ht5XmSccyjRdWTtZSlakxtPwqbGry', '3000-01-01', 1, 0),
(3, 'Mohamed Magdy', 'Magdy', '$2y$10$F2ZQT28r4TMcl6eYgHfC3OSGESowori9qntWIPE5pLZQAQklsLiRq', '3000-01-01', 1, 0),
(4, 'Mohamed Magdy', 'Magdy1', '$2y$10$Qz5XHZs7FpMAMxwACk94cu6um3sUWFEUjcjBJ20xzK4hBbH7.fF0i', '3000-01-09', 1, 0),
(6, 'Anas Ahmed', 'anas', '$2y$10$K3UfSWHVl1tVy8rXzdCFe.54ht5XmSccyjRdWTtZSlakxtPwqbGry', '2017-01-01', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_group` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
