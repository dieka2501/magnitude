-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2015 at 06:04 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `implus`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `remember_token` text,
  `role` text NOT NULL,
  `date_insert` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `name`, `password`, `remember_token`, `role`, `date_insert`, `updated_at`) VALUES
(1, 'admin@implus.com', 'admin', '$2y$10$T0fbe4eBzHBI8PLJG17.kuGGT0Wdsc79OO7QTl0ocWhOCwq5YBj4a', '', 'admin', '2015-08-12 00:00:00', '2015-08-12 00:00:00'),
(2, 'dikdik@gits.co.id', 'Dikdik Kusdinar', '$2y$10$vbExd5CNRCsvjWxvFZFLJexmxwBmVAqCqQu4yJ0gvqUnkNDlBNl9S', 'nBxIhHOFkyhr0NzCI8B7HFBAdoknFkrWKZ7ugFgyy57VYIdEkNl0n0Xkvoeb', 'admin', '0000-00-00 00:00:00', '2015-08-14 15:57:13'),
(3, 'dieka.koes@gmail.com', 'Dikdik Season dua', '$2y$10$csXdZpEG.3CtH1PuZ5.FL.eHkeduQ8OVWuSbqMFAnHBsY.YujHaRG', '', 'admin', '2015-08-12 22:38:55', '2015-08-12 22:38:55'),
(4, 'dikdik1@gits.co.id', 'Dikdik Seller', '$2y$10$kO0kUxpvgw9ixou1NDFYqO.6fZByJtuq7S6Nfd7XKBq4RgGsFcCsy', NULL, 'seller', '2015-08-14 09:18:34', '2015-08-14 15:29:59'),
(5, 'dikdik04@gmail.com', 'Dikdik Bandung', '$2y$10$kDQBhn25OeKuCbf0GOik6eNxHtVjU0w9Xn2OVP9h.b6yoogp5e9NO', NULL, 'seller', '2015-08-14 15:37:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `iduser` int(11) NOT NULL,
  `name_seller` text NOT NULL,
  `address_seller` text NOT NULL,
  `email_seller` text NOT NULL,
  `phone` text NOT NULL,
  `zipcode` text NOT NULL,
  `date_insert` datetime NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`iduser`, `name_seller`, `address_seller`, `email_seller`, `phone`, `zipcode`, `date_insert`, `date_update`) VALUES
(4, 'Dikdik kusdinar', 'Bogor Kota', 'dikdik@gits.co.id', '902838383', '40380', '2015-08-14 09:18:34', '2015-08-14 15:29:59'),
(5, 'Dikdik Bandung', 'Bandung Kab', 'dikdik04@gmail.com', '28393839384', '739272', '2015-08-14 15:37:27', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
