-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2020 at 10:56 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_book_catalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books_info`
--

CREATE TABLE `tbl_books_info` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `isbn` text NOT NULL,
  `author` text NOT NULL,
  `publisher` text NOT NULL,
  `year_published` int(11) NOT NULL,
  `category` text NOT NULL,
  `archived` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_books_info`
--

INSERT INTO `tbl_books_info` (`id`, `title`, `isbn`, `author`, `publisher`, `year_published`, `category`, `archived`, `created_at`, `updated_at`) VALUES
(1, 'Title one', '12345zxcasdqwe', 'Jp Palmis', 'Publisher one', 2020, 'Category one', 0, '2020-09-23 02:48:20', '2020-09-23 02:48:20'),
(2, 'Title 2', 'zxcasd12345', 'Jp Palmis', 'Publisher 2', 2020, 'Category 2', 0, '2020-09-23 02:52:50', '2020-09-23 02:52:50'),
(3, 'Title 3', 'cxvxcv234234', 'Jp Palmis', 'Publisher 3', 2020, 'Category 3', 0, '2020-09-23 02:56:26', '2020-09-23 02:56:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_books_info`
--
ALTER TABLE `tbl_books_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_books_info`
--
ALTER TABLE `tbl_books_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
