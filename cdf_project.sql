-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2019 at 02:34 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cdf_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `ID` int(11) NOT NULL,
  `owner` text NOT NULL,
  `date` date NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `gender` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `status` text NOT NULL,
  `reason` text NOT NULL,
  `verif1` text NOT NULL,
  `verif2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`ID`, `owner`, `date`, `name`, `description`, `gender`, `address`, `country`, `status`, `reason`, `verif1`, `verif2`) VALUES
(1576594686, 'Mike32', '2019-12-17', 'Jamela', ' Yay, my form is approved ! heheh', 'female', '       Johor Baharu', 'Malaysia', 'Approved', 'wfewefewffw', 'verified', 'verified'),
(1576595216, 'User1', '2019-12-17', 'bob', 'wait, what should i do to get it approved then ???? ', 'male', ' my address ', 'Australia', 'Not Approved', 'Hi i am admin, and i will not approve your form. Thanks.', 'verified', 'verified'),
(1576645736, 'User1', '2019-12-18', 'Jessica', 'Hello world', 'female', 'Jalan 123 ', 'Malaysia', 'Pending', '', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `name`, `password`, `role`) VALUES
('Admin1', 'bob', 'password1', 'admin'),
('Manager1', 'mike', 'password1', 'manager'),
('Mike32', 'Mike', 'password1', 'user'),
('User1', 'steve', 'password1', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
