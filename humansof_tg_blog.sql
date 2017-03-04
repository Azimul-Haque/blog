-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2017 at 08:11 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `humansof_tg_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'রাজনীতি', '2017-02-20 08:01:38', '2017-02-20 08:01:38'),
(2, 'কবিতা', '2017-02-20 08:01:48', '2017-02-20 08:01:48'),
(3, 'গল্প', '2017-02-20 08:02:16', '2017-02-20 08:02:16'),
(4, 'ছড়া', '2017-02-20 08:02:24', '2017-02-20 08:02:24'),
(5, 'দর্শন', '2017-02-20 08:02:58', '2017-02-20 08:02:58'),
(6, 'প্রবন্ধ', '2017-02-20 08:03:10', '2017-02-20 08:03:10'),
(7, 'বিজ্ঞান ও প্রযুক্তি', '2017-02-20 08:03:21', '2017-02-20 08:03:21'),
(8, 'ভিডিও ব্লগ', '2017-02-20 08:03:26', '2017-02-20 08:03:26'),
(9, 'রান্না-রান্না', '2017-02-20 08:03:42', '2017-02-20 08:03:42'),
(10, 'শিল্প-সাহিত্য', '2017-02-20 08:03:48', '2017-02-20 08:03:48'),
(11, 'সংস্কৃতি', '2017-02-20 08:03:56', '2017-02-20 08:03:56'),
(12, 'মুক্তিযুদ্ধ', '2017-02-20 08:04:55', '2017-02-20 08:04:55'),
(13, 'সমসাময়িক', '2017-02-20 08:05:28', '2017-02-20 08:05:28'),
(14, 'আন্তর্জাতিক', '2017-02-20 08:05:36', '2017-02-20 08:05:36'),
(15, 'দুর্নীতি', '2017-02-20 08:05:43', '2017-02-20 08:05:43'),
(16, 'সাক্ষাৎকার', '2017-02-20 08:05:49', '2017-02-20 08:05:49'),
(17, 'স্যাটায়ার', '2017-02-20 08:07:35', '2017-02-20 08:07:35'),
(18, 'উৎসব', '2017-02-20 08:07:51', '2017-02-20 08:07:51'),
(19, 'দিবস', '2017-02-20 08:07:57', '2017-02-20 08:07:57'),
(20, 'অনুবাদ', '2017-02-20 08:08:04', '2017-02-20 08:08:04'),
(21, 'একুশ', '2017-02-20 08:08:10', '2017-02-20 08:08:10'),
(22, 'খেলাধুলা', '2017-02-20 08:08:17', '2017-02-20 08:08:17'),
(23, 'চলচ্চিত্র', '2017-02-20 08:08:22', '2017-02-20 08:08:22'),
(24, 'ব্যক্তিগত কথাকাব্য', '2017-02-20 08:08:45', '2017-02-20 08:08:45'),
(25, 'ভ্রমণ কাহিনী', '2017-02-20 08:08:52', '2017-02-20 08:08:52'),
(26, 'শোকগাঁথা', '2017-02-20 08:08:59', '2017-02-20 08:08:59'),
(27, 'রিভিউ', '2017-02-26 22:44:40', '2017-02-26 22:44:40'),
(28, 'ফটোব্লগ', '2017-02-26 22:49:58', '2017-02-26 22:49:58'),
(29, 'ঝালমুড়ি', '2017-02-26 22:50:18', '2017-02-26 22:50:18'),
(30, 'খবর', '2017-02-26 22:50:40', '2017-02-26 22:50:40'),
(31, 'কার্টুন', '2017-02-26 22:51:03', '2017-02-26 22:51:03'),
(32, 'উপন্যাস', '2017-02-26 22:51:25', '2017-02-26 22:51:25'),
(33, 'ইতিহাস', '2017-02-26 22:51:41', '2017-02-26 22:51:41'),
(34, 'অনুগল্প', '2017-02-26 22:51:52', '2017-02-26 22:51:52'),
(35, 'জাতীয় সম্পদ', '2017-02-26 22:52:28', '2017-02-26 22:52:28'),
(36, 'আইন-আদালত', '2017-02-26 22:52:39', '2017-02-26 22:52:39'),
(37, 'অনুকাব্য', '2017-02-26 22:52:48', '2017-02-26 22:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `isReported` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_post_id_foreign` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `comment`, `approved`, `post_id`, `isReported`, `created_at`, `updated_at`) VALUES
(1, 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও ☑', 'humansofthakurgaon@gmail.com', '🇧🇩🇧🇩🇧🇩 পরীক্ষামূলক মন্তব্য।', 1, 1, 0, '2017-02-28 19:00:12', '2017-02-28 19:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `to_id` int(10) unsigned NOT NULL,
  `from_id` int(10) unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isDeleted` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_09_12_99999_create_visitlogs_table', 1),
('2016_10_14_141956_create_posts_table', 1),
('2016_10_16_221521_add_slug_to_posts', 1),
('2016_10_18_063030_create_categories_table', 1),
('2016_10_18_063404_add_category_id_to_posts', 1),
('2016_10_19_003109_create_tags_table', 1),
('2016_10_19_003759_create_post_tag_table', 1),
('2016_10_19_205107_create_comments_table', 1),
('2016_10_20_090704_create_column_reported', 1),
('2016_10_22_111715_add_image_col_to_posts', 1),
('2016_10_23_122939_add_cols_to_users', 1),
('2016_10_23_165034_add_hits_to_posts', 1),
('2017_02_18_201722_Add_Featured_to_Posts_Table', 1),
('2017_02_20_050836_Add_Publish_to_Posts_Table', 1),
('2017_02_22_001944_create_messages_Table', 1),
('2017_02_23_011058_add_Columns_To_Users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isPublished` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postedBy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isDeleted` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hits` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `isPublished`, `title`, `featured`, `postedBy`, `body`, `slug`, `image`, `category_id`, `created_at`, `updated_at`, `isDeleted`, `hits`) VALUES
(1, 'publish', 'ব্লগ সংক্রান্ত সাধারণ প্রশ্নোত্তর', 'YES', '1', '<p style="text-align:justify;"><strong>ব্লগ কি? ব্লগের দ্বারা আমি কি করতে পারি?</strong><br /><br />ব্লগ শব্দটি ইংরেজি Blog এর বাংলা প্রতিশব্দ, যা এক ধরণের অনলাইন ব্যক্তিগত দিনলিপি বা ব্যক্তিকেন্দ্রিক পত্রিকা। ইংরেজি Blog শব্দটি আবার Weblog এর সংক্ষিপ্ত রূপ। যিনি ব্লগে পোস্ট করেন তাকে ব্লগার বলা হয়। ব্লগাররা প্রতিনিয়ত তাদের ওয়েবসাইটে কনটেন্ট যুক্ত করেন আর ব্যবহারকারীরা সেখানে তাদের মন্তব্য করতে পারেন। এছাড়াও সাম্প্রতিক কালে ব্লগ ফ্রিলান্স সাংবাদিকতার একটা মাধ্যম হয়ে উঠছে। সাম্প্রতিক ঘটনাসমূহ নিয়ে এক বা একাধিক ব্লগার রা এটি নিয়মিত আপডেট করেন। <br /><br />বেশিরভাগ ব্লগই কোন একটা নির্দিষ্ট বিষয়সম্পর্কিত ধারাবিবরণী বা খবর জানায়; অন্যগুলো আরেকটু বেশিমাত্রায় ব্যক্তিগত পর্যায়ের অনলাইন দিনপত্রী/অনলাইন দিনলিপিসমূহ। একটা নিয়মমাফিক ব্লগ লেখা, ছবি, অন্য ব্লগ, ওয়েব পৃষ্ঠা আর এবিষয়ের অন্য মাধ্যমের লিংকের সমাহার/সমষ্টি। পাঠকদের মিথষ্ক্রিয়াময় ছাঁচে মন্তব্য করার সুবিধে-রাখা বেশিরভাগ ব্লগের একটা গুরুত্বপূর্ণ দিক। প্রায় ব্লগই মূলত লেখায় আকীর্ণ, কিছু কিছু আবার জোর দেয় শিল্প (আর্ট ব্লগ), ছবি (ফটোব্লগ), ভিডিও (ভিডিও ব্লগিং), সঙ্গীত (এমপিথ্রিব্লগ) আর অডিওর (পডকাস্টিং) ওপর। মাইক্রোব্লগিং-ও আরেকধরনের ব্লগিং, ওটায় খুব ছোট ছোট পোস্ট থাকে। ডিসেম্বর, ২০০৭-এর হিসেবে, ব্লগ খোঁজারু ইঞ্জিন টেকনোরাট্টি প্রায় এগারো কোটি বার লাখেরও বেশি ব্লগের হদিশ পেয়েছে। [Wikipedia] <br /><br /><strong>Blog | Humans of Thakurgaon কি?</strong><br /><br />হিউম্যানস অব ঠাকুরগাঁও-এর যাত্রা শুরু হয় ২০১৬ সালে। ফেইসবুক পেইজের মাধ্যমে যাত্রা শুরু করা হিউম্যানস অব ঠাকুরগাঁও এর ব্লগের যাত্রা শুরু হল ফেব্রুয়ারি, ২০১৭ তে। ঠাকুরগাঁও-এর তরুণ এবং লিখতে আগ্রহীদের জন্য প্রথম একটি অনলাইন প্লাটফর্ম Blog | Humans of Thakurgaon. <br />এখানে যে কেউই একটি নিবন্ধনপূর্বক একটি একাউন্ট তৈরি করে একজন ব্লগার হতে পারেন। যেকোন বিষয় নিয়েই লেখা যেতে পারে। এক্ষেত্রে এতৎ ব্লগের <a title="বিষয় ও ট্যাগগুলো" href="../categories/blogs">বিষয় ও ট্যাগগুলো</a> দেখে নিলে সাহায্য হতে পারে। <br /><br /><strong>কি,কি মনে রাখা উচিৎ যখন ব্লগ নিক (যে নামে লিখবেন) তৈরি করা হচ্ছে?</strong><br /><br />ব্লগের <a title="নিয়মাবলী ও শর্তাবলী" href="../about#rules">নিয়মাবলী ও শর্তাবলী</a> অনুযায়ী ব্লগ নিক হওয়া উচিৎ যথার্থ এবং শ্লীল। কোন প্রকার অশ্লীল নিক গ্রহন করা হবে না। এছাড়া নিক শুধু অক্ষর এবং সংখ্যা হতে পারবে; স্পেইস, বিশেষ ক্যারেক্টার, কমা, সেমিকোলন ইত্যাদি গ্রহণযোগ্য হবে না।<br /><br /><strong>আমি অন্যের লেখা কিভাবে পড়তে পারব?</strong><br /><br /><a title="নীড় পাতা" href="../">নীড় পাতা</a> থেকে অন্যের কোন লেখার টাইটেল ক্লিক করলে ওই লেখাটি পূ্র্ণভাবে দেখা যাবে। লিখেছেন এর পরে ব্লগারের নামে ক্লিক করলে ব্লগারের প্রোফাইলে চলে যাবে। সেখানে একই ব্লগারের সকল ব্লগপোস্ট পাওয়া যাবে।</p>', 'ব্লগ-সংক্রান্ত-সাধারণ-প্রশ্নোত্তর', NULL, 6, '2017-02-28 18:57:26', '2017-02-28 19:09:17', '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE IF NOT EXISTS `post_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_tag_post_id_foreign` (`post_id`),
  KEY `post_tag_tag_id_foreign` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`) VALUES
(1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'কবিতা', '2017-02-20 08:14:07', '2017-02-20 08:14:07'),
(2, 'গল্প', '2017-02-20 08:14:39', '2017-02-20 08:14:39'),
(3, 'ছড়া', '2017-02-20 08:14:49', '2017-02-20 08:14:49'),
(4, 'প্রবন্ধ', '2017-02-20 08:15:12', '2017-02-20 08:15:12'),
(5, 'বিজ্ঞান ও প্রযুক্তি', '2017-02-20 08:15:31', '2017-02-20 08:15:31'),
(6, 'ভিডিও ব্লগ', '2017-02-20 08:15:46', '2017-02-20 08:15:46'),
(7, 'দর্শন', '2017-02-20 08:16:14', '2017-02-20 08:16:14'),
(8, 'রাজনীতি', '2017-02-20 08:16:59', '2017-02-20 08:16:59'),
(9, 'রান্না-রান্না', '2017-02-20 08:17:02', '2017-02-20 08:17:02'),
(10, 'শিল্প-সাহিত্য', '2017-02-20 08:17:09', '2017-02-20 08:17:09'),
(11, 'সংস্কৃতি', '2017-02-20 08:17:13', '2017-02-20 08:17:13'),
(12, 'মুক্তিযুদ্ধ', '2017-02-20 08:17:51', '2017-02-20 08:17:51'),
(13, 'সমসাময়িক', '2017-02-20 08:17:56', '2017-02-20 08:17:56'),
(14, 'আন্তর্জাতিক', '2017-02-20 08:18:03', '2017-02-20 08:18:03'),
(15, 'দুর্নীতি', '2017-02-20 08:18:18', '2017-02-20 08:18:18'),
(16, 'স্যাটায়ার', '2017-02-20 08:18:37', '2017-02-20 08:18:37'),
(17, 'উৎসব', '2017-02-20 08:19:14', '2017-02-20 08:19:14'),
(18, 'দিবস', '2017-02-20 08:19:21', '2017-02-20 08:19:21'),
(19, 'অনুবাদ', '2017-02-20 08:19:26', '2017-02-20 08:19:26'),
(20, 'একুশ', '2017-02-20 08:19:30', '2017-02-20 08:19:30'),
(21, 'খেলাধুলা', '2017-02-20 08:19:34', '2017-02-20 08:19:34'),
(22, 'চলচ্চিত্র', '2017-02-20 08:19:39', '2017-02-20 08:19:39'),
(23, 'ব্যক্তিগত কথাকাব্য', '2017-02-20 08:19:44', '2017-02-20 08:19:44'),
(24, 'ভ্রমণ কাহিনী', '2017-02-20 08:19:48', '2017-02-20 08:19:48'),
(25, 'শোকগাঁথা', '2017-02-20 08:19:53', '2017-02-20 08:19:53'),
(26, 'রিভিউ', '2017-02-26 22:44:42', '2017-02-26 22:44:42'),
(27, 'সাক্ষাৎকার', '2017-02-26 22:54:25', '2017-02-26 22:54:25'),
(28, 'ফটোব্লগ', '2017-02-26 22:49:56', '2017-02-26 22:49:56'),
(29, 'ঝালমুড়ি', '2017-02-26 22:50:16', '2017-02-26 22:50:16'),
(30, 'খবর', '2017-02-26 22:50:38', '2017-02-26 22:50:38'),
(31, 'কার্টুন', '2017-02-26 22:50:56', '2017-02-26 22:50:56'),
(32, 'উপন্যাস', '2017-02-26 22:51:23', '2017-02-26 22:51:23'),
(33, 'ইতিহাস', '2017-02-26 22:51:39', '2017-02-26 22:51:39'),
(34, 'অনুগল্প', '2017-02-26 22:51:54', '2017-02-26 22:51:54'),
(35, 'জাতীয় সম্পদ', '2017-02-26 22:52:30', '2017-02-26 22:52:30'),
(36, 'আইন-আদালত', '2017-02-26 22:52:36', '2017-02-26 22:52:36'),
(37, 'অনুকাব্য', '2017-02-26 22:52:46', '2017-02-26 22:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fb` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_donate` int(10) unsigned NOT NULL,
  `last_donated` datetime DEFAULT NULL,
  `permanent_district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent_upazila` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent_address_privacy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_upazila` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_address_privacy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `fb`, `image`, `about`, `blood_group`, `blood_donate`, `last_donated`, `permanent_district`, `permanent_upazila`, `permanent_address_privacy`, `present_district`, `present_upazila`, `present_address_privacy`) VALUES
(1, 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও', 'admin', 'humansofthakurgaon@gmail.com', '$2y$10$bIRzLdwHG9u249VoB.aQT.30wwvzqlCNmAzEp6ETusQkGNEUfnPgy', NULL, '2017-02-28 18:49:19', '2017-02-28 18:49:19', '01751398392', 'https://www.facebook.com/humansofthakurgaon/', NULL, 'প্রতিটি সাধারণ জীবনের থাকে একেকটি অসাধারণ গল্প। মানুষগুলোর অসাধারণ গল্পগুলো বলার জন্যই এ আয়োজন। ছোট এই জেলায় বিভিন্ন প্রান্তের ভিন্ন ভিন্ন পেশাজীবী মানুষগুলোর নিজ মুখে গল্পগুলো শোনাব আমরা। ', 'N/A', 0, '0000-00-00 00:00:00', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `visitlogs`
--

CREATE TABLE IF NOT EXISTS `visitlogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `browser` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_zone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=42 ;

--
-- Dumping data for table `visitlogs`
--

INSERT INTO `visitlogs` (`id`, `ip`, `browser`, `os`, `user_id`, `user_name`, `country_code`, `country_name`, `region_name`, `city`, `zip_code`, `time_zone`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, '::1', 'Chrome (56.0.2924.87)', 'Windows', '0', 'Guest', '', '', '', '', '', '', '0', '0', '2017-02-28 18:39:42', '2017-02-28 18:39:42'),
(2, '::1', 'Chrome (56.0.2924.87)', 'Windows', '0', 'Guest', '', '', '', '', '', '', '0', '0', '2017-02-28 18:41:01', '2017-02-28 18:41:01'),
(3, '::1', 'Chrome (56.0.2924.87)', 'Windows', '0', 'Guest', '', '', '', '', '', '', '0', '0', '2017-02-28 18:41:04', '2017-02-28 18:41:04'),
(4, '::1', 'Chrome (56.0.2924.87)', 'Windows', '0', 'Guest', '', '', '', '', '', '', '0', '0', '2017-02-28 18:41:06', '2017-02-28 18:41:06'),
(5, '::1', 'Chrome (56.0.2924.87)', 'Windows', '0', 'Guest', '', '', '', '', '', '', '0', '0', '2017-02-28 18:41:08', '2017-02-28 18:41:08'),
(6, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:49:21', '2017-02-28 18:49:21'),
(7, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:49:22', '2017-02-28 18:49:22'),
(8, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:49:26', '2017-02-28 18:49:26'),
(9, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:49:50', '2017-02-28 18:49:50'),
(10, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:49:52', '2017-02-28 18:49:52'),
(11, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:49:59', '2017-02-28 18:49:59'),
(12, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:57:28', '2017-02-28 18:57:28'),
(13, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:58:03', '2017-02-28 18:58:03'),
(14, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:58:07', '2017-02-28 18:58:07'),
(15, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:58:08', '2017-02-28 18:58:08'),
(16, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:58:09', '2017-02-28 18:58:09'),
(17, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:58:10', '2017-02-28 18:58:10'),
(18, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:58:13', '2017-02-28 18:58:13'),
(19, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:58:14', '2017-02-28 18:58:14'),
(20, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:58:15', '2017-02-28 18:58:15'),
(21, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:58:30', '2017-02-28 18:58:30'),
(22, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:59:19', '2017-02-28 18:59:19'),
(23, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:59:43', '2017-02-28 18:59:43'),
(24, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 18:59:44', '2017-02-28 18:59:44'),
(25, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:00:12', '2017-02-28 19:00:12'),
(26, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:00:13', '2017-02-28 19:00:13'),
(27, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:00:21', '2017-02-28 19:00:21'),
(28, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:00:22', '2017-02-28 19:00:22'),
(29, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:00:26', '2017-02-28 19:00:26'),
(30, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:00:36', '2017-02-28 19:00:36'),
(31, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:01:35', '2017-02-28 19:01:35'),
(32, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:01:40', '2017-02-28 19:01:40'),
(33, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:03:08', '2017-02-28 19:03:08'),
(34, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:03:26', '2017-02-28 19:03:26'),
(35, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:03:50', '2017-02-28 19:03:50'),
(36, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:06:14', '2017-02-28 19:06:14'),
(37, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:07:44', '2017-02-28 19:07:44'),
(38, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:08:21', '2017-02-28 19:08:21'),
(39, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:09:09', '2017-02-28 19:09:09'),
(40, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:09:17', '2017-02-28 19:09:17'),
(41, '::1', 'Chrome (56.0.2924.87)', 'Windows', '1', 'ব্লগ | হিউম্যানস অব ঠাকুরগাঁও humansofthakurgaon@gmail.com', '', '', '', '', '', '', '0', '0', '2017-02-28 19:09:18', '2017-02-28 19:09:18');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`),
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
