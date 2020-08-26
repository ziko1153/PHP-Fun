-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2018 at 01:00 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_smsemail`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emailset`
--

CREATE TABLE `tbl_emailset` (
  `id` int(11) NOT NULL,
  `host` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `smtp_secure` varchar(10) NOT NULL,
  `port` int(11) NOT NULL,
  `from_email` varchar(30) NOT NULL,
  `reply_email` varchar(30) NOT NULL,
  `from_name` varchar(30) NOT NULL,
  `reply_name` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_emailset`
--

INSERT INTO `tbl_emailset` (`id`, `host`, `username`, `password`, `smtp_secure`, `port`, `from_email`, `reply_email`, `from_name`, `reply_name`, `status`) VALUES
(2, 'smtp.gmail.com', '', '', 'ssl', 465, 'farihaislam@gmail.com', '', '', 'Ziko', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_emailset`
--
ALTER TABLE `tbl_emailset`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_emailset`
--
ALTER TABLE `tbl_emailset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
