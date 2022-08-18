-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 02:37 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sainik_patrika`
--

-- --------------------------------------------------------

--
-- Table structure for table `visual_settings`
--

CREATE TABLE `visual_settings` (
  `id` int(11) NOT NULL,
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `post_list_style` varchar(100) NOT NULL DEFAULT 'vertical',
  `site_color` varchar(100) NOT NULL DEFAULT 'default',
  `site_block_color` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logo2` varchar(255) NOT NULL,
  `logo_footer` varchar(255) DEFAULT NULL,
  `logo_email` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `home_popup_image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `imgstatus` int(11) NOT NULL DEFAULT 0,
  `uploaded_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visual_settings`
--

INSERT INTO `visual_settings` (`id`, `dark_mode`, `post_list_style`, `site_color`, `site_block_color`, `logo`, `logo2`, `logo_footer`, `logo_email`, `favicon`, `status`, `home_popup_image`, `description`, `imgstatus`, `uploaded_date`) VALUES
(1, 0, '', '', NULL, 'uploads/logo/logo_60dc580ec2772.png', 'uploads/logo/logo_60ebe7193716b.png', 'uploads/logo/logo_60dc58176f8d1.png', 'uploads/logo/logo_60d24b5e140c0.png', 'uploads/logo/logo_60d1e649e953c.png', 1, 'uploads/logo/logo_623877afb17fe.png', '<p><em><strong>test descriptionfgdgdgsdgdsgjldsgjdljgklgddg;ldg;mdg;jl</strong></em></p>', 1, '2022-03-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `visual_settings`
--
ALTER TABLE `visual_settings`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
