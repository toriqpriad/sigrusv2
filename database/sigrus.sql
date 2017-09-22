-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 22, 2017 at 04:06 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigrus`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_log`
--

CREATE TABLE `access_log` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  `platform` varchar(200) NOT NULL,
  `browser` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_log`
--

INSERT INTO `access_log` (`id`, `ip_address`, `platform`, `browser`, `date`) VALUES
(1, '::1', 'Linux', 'Chrome', '19-09-2017'),
(2, '::1', 'Linux', 'Chrome', '20-09-2017'),
(3, '::1', 'Linux', 'Chrome', '21-09-2017'),
(4, '::1', 'Linux', 'Chrome', '22-09-2017');

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `level` enum('T','A') NOT NULL,
  `id_level` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `date` text NOT NULL,
  `update_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `level`, `id_level`, `title`, `description`, `date`, `update_at`) VALUES
(9, 'T', 43, 'Jalan Jalan Bersama', 'test', '11/11/2011', '31-08-2017 11:08'),
(10, 'T', 42, 'Test aja dulu', 'thahhahahaha', '16/12/2012', '04-09-2017 12:09');

-- --------------------------------------------------------

--
-- Table structure for table `activity_image`
--

CREATE TABLE `activity_image` (
  `id` int(11) NOT NULL,
  `id_activity` int(11) NOT NULL,
  `image` text NOT NULL,
  `sort` int(11) NOT NULL,
  `update_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity_image`
--

INSERT INTO `activity_image` (`id`, `id_activity`, `image`, `sort`, `update_at`) VALUES
(3, 9, 'uf6jKW.png', 1, '31-08-2017 11:08'),
(4, 9, 'ImBX3g.png', 2, '31-08-2017 11:08'),
(5, 9, 'w6PlCv.png', 3, '31-08-2017 11:08'),
(6, 9, '9dClA2.png', 4, '31-08-2017 11:08');

-- --------------------------------------------------------

--
-- Table structure for table `pc`
--

CREATE TABLE `pc` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `update_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='pc = pengurus cabang';

--
-- Dumping data for table `pc`
--

INSERT INTO `pc` (`id`, `name`, `contact`, `address`, `update_at`) VALUES
(1, 'PC Bumiaji', '089623993782', '', '16-08-2017 05:08');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text NOT NULL,
  `update_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `name`, `description`, `update_at`) VALUES
(1, 'Ketua', '', '19-09-2017 11:09');

-- --------------------------------------------------------

--
-- Table structure for table `position_person`
--

CREATE TABLE `position_person` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `update_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position_person`
--

INSERT INTO `position_person` (`id`, `position_id`, `name`, `contact`, `update_at`) VALUES
(1, 1, 'H. Agus', '', '19-09-2017 11:09');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `site_name` varchar(200) DEFAULT NULL,
  `site_moto` varchar(200) DEFAULT NULL,
  `site_description` text,
  `site_address` text NOT NULL,
  `site_contact` varchar(40) NOT NULL,
  `site_email` varchar(200) NOT NULL,
  `site_video_id_channel` text NOT NULL,
  `site_video_api_key` text NOT NULL,
  `site_logo` text,
  `update_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `site_name`, `site_moto`, `site_description`, `site_address`, `site_contact`, `site_email`, `site_video_id_channel`, `site_video_api_key`, `site_logo`, `update_at`) VALUES
(0, 'Aktamah.com', 'Aplikasi Tuntunan Bertata Krama & Berakhlaqul Karimah', 'lorem ipsum', 'Sukun, Malang , Jawa Timur', '081777277877', 'aktamah@gmail.com', 'UC0G7ICcwCU4Xdl7iUqJ3_4g', 'AIzaSyBG4YdFhj9z30SZwSMuM0Sw5d0VVmr5LoA', 'HGt4aI.jpg', ' 26-08-2017 02:08');

-- --------------------------------------------------------

--
-- Table structure for table `site_socmed`
--

CREATE TABLE `site_socmed` (
  `id` int(11) NOT NULL,
  `level` char(1) NOT NULL DEFAULT 'A',
  `socmed_id` int(11) NOT NULL,
  `url` text NOT NULL,
  `update_at` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_socmed`
--

INSERT INTO `site_socmed` (`id`, `level`, `socmed_id`, `url`, `update_at`) VALUES
(133, 'A', 1, 'http://facebook.com', '26-08-2017 02:08'),
(134, 'A', 2, 'http://twitter.com', '26-08-2017 02:08'),
(135, 'A', 3, 'http://youtube.com', '26-08-2017 02:08'),
(136, 'A', 4, '', '26-08-2017 02:08');

-- --------------------------------------------------------

--
-- Table structure for table `socmed`
--

CREATE TABLE `socmed` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(40) NOT NULL,
  `update_at` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `socmed`
--

INSERT INTO `socmed` (`id`, `name`, `icon`, `update_at`) VALUES
(1, 'Facebook', 'fa fa-facebook', '24-08-2017 10:08'),
(2, 'Twitter', 'fa fa-twitter', '24-08-2017 10:08'),
(3, 'Youtube', 'fa fa-youtube', '24-08-2017 04:08'),
(4, 'YOutube', 'fa fa-youtube', '25-08-2017 01:08'),
(5, 'Klontang', '', '15-09-2017 05:09');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `id_tpq` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `gender` enum('F','M') NOT NULL,
  `student_category` enum('C','P','R') NOT NULL,
  `place_birth` varchar(45) DEFAULT NULL,
  `date_birth` varchar(100) DEFAULT NULL,
  `mother` varchar(100) NOT NULL,
  `father` varchar(100) NOT NULL,
  `education` varchar(10) NOT NULL,
  `education_detail` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `address` text,
  `photo` text,
  `status` enum('M','S') NOT NULL COMMENT 'M : Married, S : Single',
  `active` enum('A','N') NOT NULL,
  `update_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk siswa';

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `id_tpq`, `name`, `link`, `gender`, `student_category`, `place_birth`, `date_birth`, `mother`, `father`, `education`, `education_detail`, `email`, `contact`, `address`, `photo`, `status`, `active`, `update_at`) VALUES
(1, 45, 'Belgies', 'belgies', 'F', 'C', 'Malang', '11/11/2007', '', '', 'SD', '', '', '', '', 'kKQTuq.jpg', 'S', 'A', '20-09-2017 09:09');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `id_tpq` int(11) DEFAULT NULL,
  `name` varchar(105) DEFAULT NULL,
  `link` varchar(100) NOT NULL,
  `gender` enum('F','M') DEFAULT NULL COMMENT 'L : Laki Laki , P : Perempuan',
  `place_birth` varchar(45) DEFAULT NULL,
  `date_birth` varchar(20) DEFAULT NULL,
  `education` varchar(45) DEFAULT NULL,
  `education_detail` varchar(45) DEFAULT NULL,
  `teacher_category` enum('MT','MS','PB') DEFAULT NULL COMMENT 'MT : Mubalegh Tugasan , MS : Mubalegh Setempat , PB : Pribumi',
  `status` enum('S','M') DEFAULT NULL COMMENT 'L : Lajang, M: Menikah',
  `contact` varchar(45) DEFAULT NULL,
  `address` text,
  `email` varchar(45) DEFAULT NULL,
  `photo` varchar(45) DEFAULT NULL,
  `active` enum('A','N') NOT NULL DEFAULT 'A',
  `update_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk Pengajar';

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `id_tpq`, `name`, `link`, `gender`, `place_birth`, `date_birth`, `education`, `education_detail`, `teacher_category`, `status`, `contact`, `address`, `email`, `photo`, `active`, `update_at`) VALUES
(1, 45, 'Fani', 'fani', 'F', 'Malang', '11/11/1997', 'SD', '', 'MT', 'S', '', '', '', 'SANh74.jpg', 'A', '19-09-2017 10:09');

-- --------------------------------------------------------

--
-- Table structure for table `tpq`
--

CREATE TABLE `tpq` (
  `id` int(11) NOT NULL,
  `id_pc` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `link` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `address` text,
  `alias` varchar(100) NOT NULL,
  `logo` text,
  `cover` text,
  `update_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk data TPQ';

--
-- Dumping data for table `tpq`
--

INSERT INTO `tpq` (`id`, `id_pc`, `name`, `link`, `email`, `contact`, `address`, `alias`, `logo`, `cover`, `update_at`) VALUES
(45, 1, 'Al-Furqon', 'alfurqon', '', '', '', 'Pandan', '', '', '17-09-2017 01:09');

-- --------------------------------------------------------

--
-- Table structure for table `tpq_position`
--

CREATE TABLE `tpq_position` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text NOT NULL,
  `update_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpq_position`
--

INSERT INTO `tpq_position` (`id`, `name`, `description`, `update_at`) VALUES
(1, 'Ketua', '', '16-09-2017 06:09'),
(2, 'Sekretaris', '', ''),
(3, 'Bendahara', '', ''),
(4, 'Pembina', '', ''),
(5, 'Koordinator', '', '26-08-2017 01:08'),
(6, 'Penerobos', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tpq_position_person`
--

CREATE TABLE `tpq_position_person` (
  `id` int(11) NOT NULL,
  `id_tpq` int(11) DEFAULT NULL,
  `id_tpq_position` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `update_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpq_position_person`
--

INSERT INTO `tpq_position_person` (`id`, `id_tpq`, `id_tpq_position`, `name`, `update_at`) VALUES
(267, 45, 1, 'Arief', '17-09-2017 01:09'),
(268, 45, 2, 'Rasyeda', '17-09-2017 01:09'),
(269, 45, 3, 'Belgies', '17-09-2017 01:09'),
(270, 45, 4, 'Mahar', '17-09-2017 01:09'),
(271, 45, 5, 'Hari', '17-09-2017 01:09'),
(272, 45, 6, 'Sabiq', '17-09-2017 01:09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('A','T','P') NOT NULL COMMENT 'A = Admin, T = TPQ , P = Pengajar',
  `id_level` int(10) DEFAULT NULL,
  `status` enum('N','E') NOT NULL,
  `last_login` text NOT NULL,
  `update_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `id_level`, `status`, `last_login`, `update_at`) VALUES
(44, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'A', 0, 'E', '', ''),
(47, 'alfurqon', '21232f297a57a5a743894a0e4a801fc3', 'T', 41, 'N', '', ''),
(48, 'almaidah42', '0021ce629d4490d76a664d98d270ffb4', 'T', 42, 'E', '', '01-09-2017 04:09'),
(49, 'manshurin43', '3dc07fe59c8262b0a53d0190a8da4fb9', 'T', 43, 'N', '', '31-08-2017 08:08'),
(50, 'almaun44', 'c0aa052970a7f4b7043af36d79ef68e4', 'T', 44, 'N', '', '15-09-2017 01:09'),
(51, 'alfurqon45', '4d829bb3214e66d29652f08c55d3e2e9', 'T', 45, 'N', '', '16-09-2017 05:09'),
(52, 'alamin46', '70688a68fd5a443275a858ebe9d7099f', 'T', 46, 'N', '', '16-09-2017 05:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_log`
--
ALTER TABLE `access_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_image`
--
ALTER TABLE `activity_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pc`
--
ALTER TABLE `pc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_person`
--
ALTER TABLE `position_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_socmed`
--
ALTER TABLE `site_socmed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `socmend_id` (`socmed_id`),
  ADD KEY `socmed_id` (`socmed_id`);

--
-- Indexes for table `socmed`
--
ALTER TABLE `socmed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tpq` (`id_tpq`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tpq` (`id_tpq`);

--
-- Indexes for table `tpq`
--
ALTER TABLE `tpq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pc` (`id_pc`);

--
-- Indexes for table `tpq_position`
--
ALTER TABLE `tpq_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tpq_position_person`
--
ALTER TABLE `tpq_position_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori_pengurus_tpq` (`id_tpq_position`),
  ADD KEY `id_tpq` (`id_tpq`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_log`
--
ALTER TABLE `access_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `activity_image`
--
ALTER TABLE `activity_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pc`
--
ALTER TABLE `pc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `position_person`
--
ALTER TABLE `position_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `site_socmed`
--
ALTER TABLE `site_socmed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT for table `socmed`
--
ALTER TABLE `socmed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tpq`
--
ALTER TABLE `tpq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `tpq_position`
--
ALTER TABLE `tpq_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tpq_position_person`
--
ALTER TABLE `tpq_position_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `position_person`
--
ALTER TABLE `position_person`
  ADD CONSTRAINT `position_person_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id_tpq`) REFERENCES `tpq` (`id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`id_tpq`) REFERENCES `tpq` (`id`);

--
-- Constraints for table `tpq`
--
ALTER TABLE `tpq`
  ADD CONSTRAINT `tpq_ibfk_1` FOREIGN KEY (`id_pc`) REFERENCES `pc` (`id`);

--
-- Constraints for table `tpq_position_person`
--
ALTER TABLE `tpq_position_person`
  ADD CONSTRAINT `tpq_position_person_ibfk_1` FOREIGN KEY (`id_tpq_position`) REFERENCES `tpq_position` (`id`),
  ADD CONSTRAINT `tpq_position_person_ibfk_2` FOREIGN KEY (`id_tpq`) REFERENCES `tpq` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
