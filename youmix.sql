-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2016 at 06:07 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youmix`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_playlist`
--

CREATE TABLE `tbl_playlist` (
  `playlist_id` int(11) NOT NULL,
  `playlist_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `playlist_type` int(11) NOT NULL,
  `playlist_user` int(11) NOT NULL,
  `playlist_cover` varchar(255) COLLATE utf8_bin NOT NULL,
  `playlist_views` int(11) NOT NULL,
  `playlist_status` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_playlist`
--

INSERT INTO `tbl_playlist` (`playlist_id`, `playlist_name`, `playlist_type`, `playlist_user`, `playlist_cover`, `playlist_views`, `playlist_status`) VALUES
(1, 'Mixlist', 1, 1, 'PBLWQjSYyTE', 1, 'publish');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type_playlist`
--

CREATE TABLE `tbl_type_playlist` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_type_playlist`
--

INSERT INTO `tbl_type_playlist` (`type_id`, `type_name`) VALUES
(1, 'Music'),
(2, 'Concert');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(128) COLLATE utf8_bin NOT NULL,
  `social_network_status` varchar(20) COLLATE utf8_bin NOT NULL,
  `social_network_name` varchar(80) COLLATE utf8_bin NOT NULL,
  `cover_profile` varchar(80) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `name`, `email`, `password`, `social_network_status`, `social_network_name`, `cover_profile`) VALUES
(1, 'Tum', 'tum2529it48@gmail.com', '48123403', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_youtube_list`
--

CREATE TABLE `tbl_youtube_list` (
  `list_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `youtube_id` varchar(80) COLLATE utf8_bin NOT NULL,
  `youtube_title` text COLLATE utf8_bin NOT NULL,
  `youtube_cover` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_playlist`
--
ALTER TABLE `tbl_playlist`
  ADD PRIMARY KEY (`playlist_id`);

--
-- Indexes for table `tbl_type_playlist`
--
ALTER TABLE `tbl_type_playlist`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_youtube_list`
--
ALTER TABLE `tbl_youtube_list`
  ADD PRIMARY KEY (`list_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_playlist`
--
ALTER TABLE `tbl_playlist`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_type_playlist`
--
ALTER TABLE `tbl_type_playlist`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_youtube_list`
--
ALTER TABLE `tbl_youtube_list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
