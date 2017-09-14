-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 14, 2017 at 04:08 AM
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
(1, '127.0.0.1', 'Linux', 'Chrome', '11-08-2017'),
(2, '127.0.0.1', 'Linux', 'Chrome', '12-08-2017'),
(3, '127.0.0.1', 'Linux', 'Chrome', '13-08-2017'),
(4, '127.0.0.1', 'Linux', 'Chrome', '14-08-2017'),
(5, '127.0.0.1', 'Linux', 'Chrome', '15-08-2017'),
(6, '::1', 'Linux', 'Chrome', '16-08-2017'),
(7, '::1', 'Linux', 'Chrome', '17-08-2017'),
(8, '::1', 'Linux', 'Chrome', '19-08-2017'),
(9, '::1', 'Linux', 'Chrome', '25-08-2017'),
(10, '::1', 'Linux', 'Chrome', '26-08-2017'),
(11, '::1', 'Linux', 'Chrome', '27-08-2017'),
(12, '::1', 'Linux', 'Chrome', '28-08-2017'),
(13, '::1', 'Linux', 'Chrome', '29-08-2017'),
(14, '::1', 'Linux', 'Chrome', '13-09-2017'),
(15, '::1', 'Linux', 'Chrome', '14-09-2017');

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
(1, 'PC Bumiaji', '089623993782', '', '16-08-2017 05:08'),
(2, 'PC Junrejo', '089623993782', '', '16-08-2017 05:08');

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
(4, 'YOutube', 'fa fa-youtube', '25-08-2017 01:08');

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
(3, 40, 'Alen', 'alen', 'M', 'R', 'Malang', '08/08/1998', 'Kristin', 'Muhyi', 'SMA', 'Kelas 1 SMAN 1 BATU', 'alen@gmail.com', '089623993782', 'JUnrejo', 'snIbTB.jpg', 'S', 'N', '27-08-2017 11:08'),
(4, 41, 'Ringgo', 'ringgo', 'M', 'P', 'Batu', '10/10/1999', 'Uus', 'Supri', 'SMA', 'Kelas 1 SMA 1 Batu', 'ringgo@gmail.com', '089623993782', 'Junrejo', 'ohoc8H.png', 'S', 'A', '27-08-2017 11:08'),
(5, 4, 'Bima', 'bima', '', 'C', '', '', '', '', '', '', '', '', '', '', 'M', 'A', '28-08-2017 12:08'),
(6, 4, 'paijo', 'paijo', 'F', 'R', 'Malang', '08/08/1999', 'tukiyem', 'paimin', 'Sarjana', 'S1 UMM Jurusan Teknik Informatika', 'paijo@gmail.com', '089623993782', 'test123', 'fpqmNg.png', 'S', 'A', '29-08-2017 09:08'),
(7, 41, 'Rifki', 'rifki', 'M', 'R', 'Sidoarj0', '11/11/1991', '', '', 'SD', '', 'rikfi.chandra@gmail.com', '089623993782', 'sidoarjo', 'QVXIUc.png', 'M', 'N', '29-08-2017 09:08'),
(8, 43, 'Wini', 'wini', '', 'R', 'Batu', '09/08/1995', '', '', '', '', '', '', '', 'zNFpaZ.png', 'M', 'A', '31-08-2017 08:08'),
(9, 43, 'Saras', 'saras', 'F', 'R', 'Batu', '09/09/1995', '', '', '', '', '', '', '', '', 'M', 'A', '31-08-2017 09:08'),
(10, 43, 'Haris Yudhistiro', 'harisyudhistiro', 'M', 'R', 'Batu', '12/12/1994', 'Qonit', 'Agus', 'SMA', 'SMA Negri 1 Batu', 'haris.yudistiro@gmail.com', '089623993782', 'Gondang', 'OavGFm.png', 'S', 'A', '31-08-2017 10:08');

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
  `active` enum('A','N') NOT NULL DEFAULT 'N',
  `update_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabel untuk Pengajar';

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `id_tpq`, `name`, `link`, `gender`, `place_birth`, `date_birth`, `education`, `education_detail`, `teacher_category`, `status`, `contact`, `address`, `email`, `photo`, `active`, `update_at`) VALUES
(13, 41, 'Ilma', 'ilma', 'F', 'Magetan', '11/11/1991', NULL, NULL, 'MT', 'S', '089623993782', 'Junrejo', 'tulas@gmail.com', 'yxFKQS.jpg', 'A', '26-08-2017 01:08'),
(14, 41, 'Jamaludin', 'jamaludin', 'M', 'Malang', '10/10/2000', 'SMA', 'SMA Budi Utomo Perak Jombang', 'MS', 'M', '089623993782', 'Junrejo', 'jamal@gmail.com', 'B7na0j.jpg', 'A', '29-08-2017 08:08'),
(15, 41, 'testing', 'testing', 'M', '', '', 'SD', '', 'PB', 'S', '', '', '', '', 'N', '29-08-2017 06:08'),
(16, 43, 'Reno Fachru', 'renofachru', 'M', 'Batu', '09/09/1996', 'SD', '', 'MT', 'M', '', '', '', 'qHNDPf.png', 'N', '31-08-2017 09:08');

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
(4, 1, 'Al Bayyinah', 'albayyinah', '', '', '', 'Ngantang', '', '', '28-08-2017 12:08'),
(40, 1, 'Al-Muflihun', 'almuflihun', 'muflihun@gmail.com', '089623993782', '', 'Sisir 1', 'UjddXt.jpg', 'wWVJ7G.png', '16-08-2017 05:08'),
(41, 2, 'Al-Furqon', 'alfurqon', 'junrejo@ymail.com', '089623993782', 'junrejo', 'Areng Areng', '7SsiWs.png', 'gTqVmH.png', '31-08-2017 04:08'),
(42, 1, 'Al-Maidah', 'almaidah', '', '', '', 'Pujon', '', '', '31-08-2017 08:08'),
(43, 2, 'Manshurin', 'manshurin', '', '', '', 'Sumbersari', '', '', '31-08-2017 08:08');

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
(1, 'Ketua', '', ''),
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
(189, 40, 1, '', '16-08-2017 05:08'),
(190, 40, 2, '', '16-08-2017 05:08'),
(191, 40, 3, '', '16-08-2017 05:08'),
(192, 40, 4, '', '16-08-2017 05:08'),
(193, 40, 5, '', '16-08-2017 05:08'),
(194, 40, 6, '', '16-08-2017 05:08'),
(217, 41, 1, 'Aku', '31-08-2017 04:08'),
(218, 41, 5, 'Kamu', '31-08-2017 04:08'),
(219, 42, 1, '', '31-08-2017 08:08'),
(220, 42, 2, '', '31-08-2017 08:08'),
(221, 42, 3, '', '31-08-2017 08:08'),
(222, 42, 4, '', '31-08-2017 08:08'),
(223, 42, 5, '', '31-08-2017 08:08'),
(224, 42, 6, '', '31-08-2017 08:08'),
(231, 43, 1, 'Reno', '31-08-2017 09:08'),
(232, 43, 2, 'Saras', '31-08-2017 09:08'),
(233, 43, 3, 'Wini', '31-08-2017 09:08'),
(234, 43, 4, 'Haris', '31-08-2017 09:08'),
(235, 43, 5, 'Viki', '31-08-2017 09:08'),
(236, 43, 6, 'Agus', '31-08-2017 09:08');

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
(49, 'manshurin43', '3dc07fe59c8262b0a53d0190a8da4fb9', 'T', 43, 'N', '', '31-08-2017 08:08');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `site_socmed`
--
ALTER TABLE `site_socmed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT for table `socmed`
--
ALTER TABLE `socmed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tpq`
--
ALTER TABLE `tpq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `tpq_position`
--
ALTER TABLE `tpq_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tpq_position_person`
--
ALTER TABLE `tpq_position_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- Constraints for dumped tables
--

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
