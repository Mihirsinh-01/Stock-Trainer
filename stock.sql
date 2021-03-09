SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `login` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `balance` double(255,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `portfolio` (
  `username` varchar(255) NOT NULL,
  `s_sname` varchar(255) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_quantity` int(255) NOT NULL,
  `s_totalprice` double(255,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `transaction` (
  `username` varchar(255) NOT NULL,
  `s_sname` varchar(255) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `s_quantity` int(255) NOT NULL,
  `s_totalprice` double(255,2) NOT NULL,
  `buy` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `watchlist` (
  `username` varchar(255) NOT NULL,
  `s_sname` varchar(255) NOT NULL,
  `s_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);
