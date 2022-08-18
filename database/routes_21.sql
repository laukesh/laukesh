-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 02:34 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

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
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `admin` varchar(100) DEFAULT 'admin',
  `profile` varchar(100) DEFAULT 'profile',
  `tag` varchar(100) DEFAULT 'tag',
  `reading_list` varchar(100) DEFAULT 'reading-list',
  `settings` varchar(100) DEFAULT 'settings',
  `social_accounts` varchar(100) DEFAULT 'social-accounts',
  `preferences` varchar(100) DEFAULT 'preferences',
  `visual_settings` varchar(100) DEFAULT 'visual-settings',
  `change_password` varchar(100) DEFAULT 'change-password',
  `forgot_password` varchar(100) DEFAULT 'forgot-password',
  `reset_password` varchar(100) DEFAULT 'reset-password',
  `delete_account` varchar(100) DEFAULT 'delete-account',
  `register` varchar(100) DEFAULT 'register',
  `posts` varchar(100) DEFAULT 'posts',
  `search` varchar(100) DEFAULT 'search',
  `rss_feeds` varchar(100) DEFAULT 'rss-feeds',
  `gallery_album` varchar(100) DEFAULT 'gallery-album',
  `earnings` varchar(100) DEFAULT 'earnings',
  `payouts` varchar(100) DEFAULT 'payouts',
  `set_payout_account` varchar(100) DEFAULT 'set-payout-account',
  `logout` varchar(100) DEFAULT 'logout',
  `latest_press_release_api` varchar(26) NOT NULL,
  `video_api` varchar(24) NOT NULL,
  `audio_api` varchar(24) NOT NULL,
  `gallery_api` varchar(24) NOT NULL,
  `infographics_api` varchar(100) NOT NULL DEFAULT 'infographics_api',
  `logo_gallery_api` varchar(22) NOT NULL,
  `latest_sainik_samachar_api` varchar(56) NOT NULL,
  `latest_sainik_samachar_details_api` varchar(100) NOT NULL DEFAULT 'latest_sainik_samachar_details_api',
  `latest_press_release_detail_api` varchar(100) NOT NULL,
  `latest_pro_categories_api` varchar(55) NOT NULL DEFAULT 'latest_pro_categories_api',
  `latest_photo_categories_api` varchar(100) NOT NULL,
  `latest_video_categories_api` varchar(100) NOT NULL DEFAULT 'latest_video_categories_api',
  `latest_audio_categories_api` varchar(100) NOT NULL DEFAULT 'latest_audio_categories_api',
  `latest_infographics_categories_api` varchar(100) NOT NULL DEFAULT 'latest_infographics_categories_api',
  `latest_media_invites_api` varchar(100) NOT NULL DEFAULT 'latest_media_invites_api',
  `latest_media_invite_details_api` varchar(100) NOT NULL DEFAULT 'latest_media_invite_details_api',
  `language_master_api` varchar(100) NOT NULL DEFAULT 'language_master_api',
  `app_user_details_api` varchar(100) NOT NULL DEFAULT 'app_user_details_api',
  `update_app_user_details_api` varchar(100) NOT NULL DEFAULT 'update_app_user_details_api',
  `get_content_page_list_api` varchar(100) NOT NULL DEFAULT 'get_content_page_list_api',
  `get_circular_notifications_list_api` varchar(100) NOT NULL DEFAULT 'get_circular_notifications_list_api',
  `app_login_by_email_api` varchar(100) NOT NULL DEFAULT 'app_login_by_email_api',
  `dashboard_first_api` varchar(200) NOT NULL DEFAULT 'dashboard_first_api',
  `reset_password_api` varchar(200) NOT NULL DEFAULT 'reset_password_api',
  `change_password_api` varchar(100) NOT NULL DEFAULT 'change_password_api',
  `update_profile_api` varchar(100) NOT NULL DEFAULT 'update_profile_api',
  `get_app_version_api` varchar(100) NOT NULL DEFAULT 'get_app_version_api',
  `submit_feedback_api` varchar(100) NOT NULL DEFAULT 'submit_feedback_api'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `admin`, `profile`, `tag`, `reading_list`, `settings`, `social_accounts`, `preferences`, `visual_settings`, `change_password`, `forgot_password`, `reset_password`, `delete_account`, `register`, `posts`, `search`, `rss_feeds`, `gallery_album`, `earnings`, `payouts`, `set_payout_account`, `logout`, `latest_press_release_api`, `video_api`, `audio_api`, `gallery_api`, `infographics_api`, `logo_gallery_api`, `latest_sainik_samachar_api`, `latest_sainik_samachar_details_api`, `latest_press_release_detail_api`, `latest_pro_categories_api`, `latest_photo_categories_api`, `latest_video_categories_api`, `latest_audio_categories_api`, `latest_infographics_categories_api`, `latest_media_invites_api`, `latest_media_invite_details_api`, `language_master_api`, `app_user_details_api`, `update_app_user_details_api`, `get_content_page_list_api`, `get_circular_notifications_list_api`, `app_login_by_email_api`, `dashboard_first_api`, `reset_password_api`, `change_password_api`, `update_profile_api`, `get_app_version_api`, `submit_feedback_api`) VALUES
(1, 'admin', 'profile', 'tag', 'reading-list', 'settings', 'social-accounts', 'preferences', 'visual-settings', 'change-password', 'forgot-password', 'reset-password', 'delete-account', 'register', 'posts', 'search', 'rss-feeds', 'gallery-album', 'earnings', 'payouts', 'set-payout-account', 'logout', 'latest_press_release_api', 'video_api', 'audio_api', 'gallery_api', 'infographics_api', 'logo_gallery_api', 'latest_sainik_samachar_api', 'latest_sainik_samachar_details_api', 'latest_press_release_detail_api', 'latest_pro_categories_api', 'latest_photo_categories_api', 'latest_video_categories_api', 'latest_audio_categories_api', 'latest_infographics_categories_api', 'latest_media_invites_api', 'latest_media_invite_details_api', 'language_master_api', 'app_user_details_api', 'update_app_user_details_api', 'get_content_page_list_api', 'get_circular_notifications_list_api', 'app_login_by_email_api', 'dashboard_first_api', 'reset_password_api', 'change_password_api', 'update_profile_api', 'get_app_version_api', 'submit_feedback_api');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
