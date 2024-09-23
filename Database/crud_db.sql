-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2024 at 04:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `american_movies`
--

CREATE TABLE `american_movies` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `summary` text DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `cast` varchar(1000) DEFAULT NULL,
  `director` varchar(100) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `american_movies`
--

INSERT INTO `american_movies` (`id`, `user_id`, `name`, `summary`, `year`, `genre`, `rating`, `img`, `cast`, `director`, `date_added`) VALUES
(1, 0, 'Big Hero 6', '123', 2222, 'Action / Adventure / Animation / Comedy / Family / Fantasy', 2.0, '../uploads/captain america the winter soldier.jpg', NULL, 'Chris Buck', NULL),
(2, 0, 'Big Hero 6', 'sad', 2222, 'Action / Adventure / Animation / Comedy / Family / Fantasy', 3.0, '../uploads/captain america the winter soldier.jpg', '', 'Lee Unkrich', NULL),
(4, 17, 'Big Hero 6', 'sad', 2024, 'Action / Adventure / Animation / Comedy / Family / Fantasy', 2.0, '../../uploads/cool-anime-6kbwj9794wpnsfr1.jpg', 'Hayley Atwell as Peggy Carter|../../uploads/nm2017943.jpg', 'Chris Buck', NULL),
(5, 20, 'Frozen', 'sd', 2024, 'Action / Adventure / Animation / Comedy / Family / Fantasy', 1.0, '../uploads/Toy Story 3.jpg', NULL, 'Don Hall', NULL),
(22, 1, 'Big Hero 6', 'sad', 2024, 'Action / Adventure / Animation / Comedy / Family / Fantasy', 3.0, '../../uploads/Toy Story.jpg', NULL, 'Chris Buck', '2024-08-06 10:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `american_tv_series`
--

CREATE TABLE `american_tv_series` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `year` int(100) NOT NULL,
  `genre` text NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `img` varchar(255) NOT NULL,
  `cast` varchar(1000) NOT NULL,
  `director` varchar(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `american_tv_series`
--

INSERT INTO `american_tv_series` (`id`, `name`, `summary`, `year`, `genre`, `rating`, `img`, `cast`, `director`, `user_id`, `date_added`) VALUES
(3, 'Big Hero 6', 'sad', 2002, 'Action / Adventure / Animation / Comedy / Crime / Drama / Family / Fantasy / Mystery / Sci-Fi', 2.0, '../uploads/captain america the winter soldier.jpg', '', 'Lee Unkrich', 20, NULL),
(5, 'Big Hero 6', 'sad', 2132, 'Action / Adventure / Animation / Comedy / Crime / Drama / Family / Fantasy / Mystery / Sci-Fi', 5.0, '../uploads/avengers.jpg', '', 'John Lasseter', NULL, NULL),
(6, 'Big Hero 6', '2134', 2222, 'Action / Adventure / Animation / Comedy / Family / Fantasy', 5.0, '../uploads/Finding Nemo.jpg', '', 'Lee Unkrich', 20, NULL),
(7, 'Monsters, Inc.', 'sad', 2024, 'Action / Adventure / Sci-Fi / Thriller', 3.0, '../../uploads/avengers.jpg', '', 'Mark Andrews', 17, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `anime_movies`
--

CREATE TABLE `anime_movies` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `year` int(100) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `img` varchar(255) NOT NULL,
  `studio` text NOT NULL,
  `duration` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anime_movies`
--

INSERT INTO `anime_movies` (`id`, `name`, `summary`, `year`, `genre`, `rating`, `img`, `studio`, `duration`, `user_id`, `date_added`) VALUES
(6, 'Big Hero 6', 'sad', 2004, 'Action / Adventure / Animation / Comedy / Crime / Drama / Family / Fantasy / Mystery / Sci-Fi', 4.0, '../../uploads/cool-anime-6kbwj9794wpnsfr1.jpg', ' Marza Animation Planet', '2 hours', 17, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `anime_series`
--

CREATE TABLE `anime_series` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `year` int(100) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `img` varchar(255) NOT NULL,
  `episodes` int(100) NOT NULL,
  `studio` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anime_series`
--

INSERT INTO `anime_series` (`id`, `name`, `summary`, `year`, `genre`, `rating`, `img`, `episodes`, `studio`, `user_id`, `date_added`) VALUES
(20, 'Jujutus Kaisen', 'Idly indulging in baseless paranormal activities with the Occult Club, high schooler Yuuji Itadori spends his days at either the clubroom or the hospital, where he visits his bedridden grandfather. However, this leisurely lifestyle soon takes a turn for the strange when he unknowingly encounters a cursed item. Triggering a chain of supernatural occurrences, Yuuji finds himself suddenly thrust into the world of Curses—dreadful beings formed from human malice and negativity—after swallowing the said item, revealed to be a finger belonging to the demon Sukuna Ryoumen, the King of Curses.\r\n\r\nYuuji experiences first-hand the threat these Curses pose to society as he discovers his own newfound powers. Introduced to the Tokyo Prefectural Jujutsu High School, he begins to walk down a path from which he cannot return—the path of a Jujutsu sorcerer.', 2020, 'Action / Fantasy / Award Winning', 9.0, '../../uploads/Jujutsu Kaisen.jpg', 24, 'MAPPA', 1, '2024-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `cartoon_movies`
--

CREATE TABLE `cartoon_movies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `year` int(100) NOT NULL,
  `genre` text NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `img` varchar(255) NOT NULL,
  `cast` varchar(1000) NOT NULL,
  `director` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartoon_movies`
--

INSERT INTO `cartoon_movies` (`id`, `name`, `summary`, `year`, `genre`, `rating`, `img`, `cast`, `director`, `user_id`, `date_added`) VALUES
(17, 'Monsters, Inc.', 'Lovable Sulley and his wisecracking sidekick Mike Wazowski are the top scare team at Monsters, Inc., the scream-processing factory in Monstropolis. When a little girl named Boo wanders into their world, it\'s the monsters who are scared silly, and it\'s up to Sulley and Mike to keep her out of sight and get her back home.', 2001, 'Action / Adventure / Animation / Comedy / Family / Fantasy / Horror', 7.0, '../../uploads/Monsters.Inc.jpg', '', 'Lee Unkrich', 1, '2024-07-30');

-- --------------------------------------------------------

--
-- Table structure for table `cartoon_series`
--

CREATE TABLE `cartoon_series` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `year` int(100) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `img` varchar(255) NOT NULL,
  `episodes` int(100) NOT NULL,
  `studio` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartoon_series`
--

INSERT INTO `cartoon_series` (`id`, `name`, `summary`, `year`, `genre`, `rating`, `img`, `episodes`, `studio`, `user_id`, `date_added`) VALUES
(3, 'Big Hero 6', 'sad', 2024, 'Action / Adventure / Sci-Fi / Thriller', 3.0, '../uploads/captain america the winter soldier.jpg', 24, ' Marza Animation Planet', 0, NULL),
(4, 'Big Hero 6', 'sad', 2024, 'Action / Adventure / Sci-Fi / Thriller', 2.0, '../uploads/captain america the winter soldier.jpg', 24, ' Marza Animation Planet', 0, NULL),
(5, 'Big Hero 6', 'sad', 2024, 'Action / Adventure / Sci-Fi / Thriller', 2.0, '../uploads/Toy Story 3.jpg', 24, ' Marza Animation Planet', 17, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `year` int(100) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `img` varchar(255) NOT NULL,
  `studio` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `device` varchar(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homepage_content`
--

CREATE TABLE `homepage_content` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homepage_content`
--

INSERT INTO `homepage_content` (`id`, `title`, `genre`, `about`) VALUES
(1, 'Record List Tracker ', 'Manga •  Anime • Movies • Series • Manhwa', 'The record list tracker website is your personalized media library where you can catalog your favorite movies, books, and TV shows. By creating an account and logging in, you can access your saved list of consumed media. This feature is similar to bookmarking or using platforms like MyAnimeList, allowing you to easily revisit your watchlist or reading list.');

-- --------------------------------------------------------

--
-- Table structure for table `manga`
--

CREATE TABLE `manga` (
  `id` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL,
  `release_date` int(100) NOT NULL,
  `description` text NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `img` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manga`
--

INSERT INTO `manga` (`id`, `title`, `author`, `genre`, `status`, `release_date`, `description`, `rating`, `img`, `user_id`, `date_added`) VALUES
(1, 'sad', 'sad', 'Action / Adventure / Animation / Comedy / Family / Fantasy', 'Playstation', 2222, 'sad', 4.0, '../../uploads/avengers.jpg', 22, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manhwa`
--

CREATE TABLE `manhwa` (
  `id` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `release_date` int(100) NOT NULL,
  `description` text NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `img` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manhwa_18`
--

CREATE TABLE `manhwa_18` (
  `id` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `status` varchar(255) NOT NULL,
  `release_date` int(100) NOT NULL,
  `description` text NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `img` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manhwa_18`
--

INSERT INTO `manhwa_18` (`id`, `title`, `author`, `genre`, `status`, `release_date`, `description`, `rating`, `img`, `user_id`, `date_added`) VALUES
(4, 'sad', 'sadsa', 'Action / Adventure / Animation / Comedy / Family / Fantasy', 'Ongoing', 2024, 'sad', 2.0, '../uploads/83300.jpg', 17, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `upload_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `file_path`, `file_name`, `upload_text`) VALUES
(46, 'uploads/toy story 2.jpg', '', 'Toy Story 2'),
(47, 'uploads/ratatouille.jpg', '', 'ratatouille');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `is_admin`) VALUES
(1, 'juloues', 'juloues@gmail.com', '$2y$10$UUDpxofeWy.CLRpnkMSDEOx1eUEZE/sVFCS.c0Iubauh/0WCqzbru', '2024-07-03 13:24:49', 0),
(17, 'sad', 'sad@gmail.com', '$2y$10$6yv6acL5uV.jXdA.P3K2TeCMTHo10vMLJ8L.ebDov0d2.dTy3YuVC', '2024-07-06 10:12:56', 0),
(18, 'admin', 'jink3241@gmail.com', '$2y$10$vFwOtDSe23JaTMuRhJtoN.dd0CZEm35xrg81iTn6CSlleC3DcZQ/C', '2024-07-06 10:18:22', 0),
(19, 'sd', 'sd@gmail.com', '$2y$10$VIPhvXvKjz2euF3EkoFKPuxo3xDK0gW9tCVSkSRwtBOdjXy9Zriue', '2024-07-06 10:22:17', 0),
(20, 'das', 'das@gmail.com', '$2y$10$szmDW/wISgwHCAPe8RU1yOumeYeOxOOxVkorUNDaRqZnVlq12jHxG', '2024-07-06 10:25:52', 0),
(22, 'R3verse3412', '', '$2y$10$oHIodisikjjCs8pifZr7uuugtm03cG3Ay8Dh24SFcV0CoOPQOUMNG', '2024-07-18 15:58:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_records`
--

CREATE TABLE `user_records` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `record_name` varchar(255) NOT NULL,
  `record_value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_records`
--

INSERT INTO `user_records` (`id`, `user_id`, `record_name`, `record_value`, `created_at`) VALUES
(11, 17, 'Welcome Record', 'This is your first record.', '2024-07-06 10:12:56'),
(12, 1, 'Welcome Record', 'This is your first record.', '2024-07-06 10:13:35'),
(13, 18, 'Welcome Record', 'This is your first record.', '2024-07-06 10:18:22'),
(14, 19, 'Welcome Record', 'This is your first record.', '2024-07-06 10:22:17'),
(15, 20, 'Welcome Record', 'This is your first record.', '2024-07-06 10:25:52'),
(16, 22, 'Welcome Record', 'This is your first record.', '2024-07-21 16:36:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_settings`
--

INSERT INTO `user_settings` (`id`, `user_id`, `setting_name`, `setting_value`, `created_at`) VALUES
(3, 17, 'Default Setting', 'Default Value', '2024-07-06 10:12:56'),
(4, 18, 'Default Setting', 'Default Value', '2024-07-06 10:18:22'),
(5, 19, 'Default Setting', 'Default Value', '2024-07-06 10:22:17'),
(6, 20, 'Default Setting', 'Default Value', '2024-07-06 10:25:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `american_movies`
--
ALTER TABLE `american_movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `american_tv_series`
--
ALTER TABLE `american_tv_series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anime_movies`
--
ALTER TABLE `anime_movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anime_series`
--
ALTER TABLE `anime_series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartoon_movies`
--
ALTER TABLE `cartoon_movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartoon_series`
--
ALTER TABLE `cartoon_series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage_content`
--
ALTER TABLE `homepage_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manhwa`
--
ALTER TABLE `manhwa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manhwa_18`
--
ALTER TABLE `manhwa_18`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_records`
--
ALTER TABLE `user_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `american_movies`
--
ALTER TABLE `american_movies`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `american_tv_series`
--
ALTER TABLE `american_tv_series`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `anime_movies`
--
ALTER TABLE `anime_movies`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `anime_series`
--
ALTER TABLE `anime_series`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cartoon_movies`
--
ALTER TABLE `cartoon_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cartoon_series`
--
ALTER TABLE `cartoon_series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `homepage_content`
--
ALTER TABLE `homepage_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manga`
--
ALTER TABLE `manga`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `manhwa`
--
ALTER TABLE `manhwa`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `manhwa_18`
--
ALTER TABLE `manhwa_18`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_records`
--
ALTER TABLE `user_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_records`
--
ALTER TABLE `user_records`
  ADD CONSTRAINT `user_records_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD CONSTRAINT `user_settings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
