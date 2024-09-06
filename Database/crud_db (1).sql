-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2024 at 08:41 AM
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
(28, 1, '12 Strong', 'A team of special forces head into Afghanistan in the aftermath of the September 11th attacks in an attempt to dismantle the Taliban. ', 2018, 'Action / Drama / History / War', 7.0, '../../uploads/12 strong.jpg', '', 'Nicolai Fuglsig', '2024-08-12 00:06:42'),
(29, 1, '1917', 'At the height of the First World War, two young British soldiers must cross enemy territory and deliver a message that will stop a deadly attack on hundreds of soldiers. ', 2019, 'Action / Drama / History / Thriller / War', 6.0, '../../uploads/1917.jpg', NULL, 'Sam Mendes', '2024-08-12 00:08:04'),
(30, 1, '2 Fast 2 Furious', 'It\'s a major double-cross when former police officer Brian O\'Conner teams up with his ex-con buddy Roman Pearce to transport a shipment of \"dirty\" money for shady Miami-based import-export dealer Carter Verone. But the guys are actually working with undercover agent Monica Fuentes to bring Verone down. ', 2003, 'Action / Adventure / Crime / Drama / Thriller', 6.0, '../../uploads/2 fast 2 furious.jpg', NULL, 'John Singleton', '2024-08-12 00:10:49'),
(31, 1, '2012', 'Dr. Adrian Helmsley, part of a worldwide geophysical team investigating the effect on the earth of radiation from unprecedented solar storms, learns that the earth\'s core is heating up. He warns U.S. President Thomas Wilson that the crust of the earth is becoming unstable and that without proper preparations for saving a fraction of the world\'s population, the entire race is doomed. Meanwhile, writer Jackson Curtis stumbles on the same information. While the world\'s leaders race to build \"arks\" to escape the impending cataclysm, Curtis struggles to find a way to save his family. Meanwhile, volcanic eruptions and earthquakes of unprecedented strength wreak havoc around the world. ', 2009, ' Action, Adventure, Science Fiction', 8.0, '../../uploads/2012.jpg', '', 'Roland Emmerich', '2024-08-12 00:16:06'),
(32, 1, '21 Jump Street', 'When cops Schmidt and Jenko join the secret Jump Street unit, they use their youthful appearances to go under cover as high-school students. They trade in their guns and badges for backpacks, and set out to shut down a dangerous drug ring. But, as time goes on, Schmidt and Jenko discover that high school is nothing like it was just a few years earlier -- and, what\'s more, they must again confront the teenage terror and anxiety they thought they had left behind. ', 2012, 'Action / Comedy / Crime', 7.0, '../../uploads/21 Jump Street.jpg', NULL, 'Phil Lord', '2024-08-12 00:18:05'),
(33, 1, '22 Jump Street', 'After making their way through high school (twice), big changes are in store for officers Schmidt and Jenko when they go deep undercover at a local college. But when Jenko meets a kindred spirit on the football team, and Schmidt infiltrates the bohemian art major scene, they begin to question their partnership. Now they don\'t have to just crack the case - they have to figure out if they can have a mature relationship. If these two overgrown adolescents can grow from freshmen into real men, college might be the best thing that ever happened to them. ', 2014, 'Action / Comedy / Crime', 6.0, '../../uploads/22 Jump Street.jpg', NULL, 'Phil Lord', '2024-08-12 00:19:39'),
(34, 1, '28 Days Later', 'Twenty-eight days after a killer virus was accidentally unleashed from a British research facility, a small group of London survivors are caught in a desperate struggle to protect themselves from the infected. Carried by animals and humans, the virus turns those it infects into homicidal maniacs -- and it\'s absolutely impossible to contain. ', 2002, 'Action / Drama / Horror / Sci-Fi / Thriller', 7.0, '../../uploads/28 Days Later.jpg', NULL, 'Danny Boyle', '2024-08-12 00:21:04'),
(35, 1, 'After', 'Tessa Young is a dedicated student, dutiful daughter and loyal girlfriend to her high school sweetheart. Entering her first semester of college, Tessa\'s guarded world opens up when she meets Hardin Scott, a mysterious and brooding rebel who makes her question all she thought she knew about herself -- and what she wants out of life. ', 2019, ' Drama, Romance, Thriller', 6.0, '../../uploads/after.jpg', NULL, 'Jenny Gage', '2024-08-12 00:25:38'),
(36, 1, 'Aladdin', 'A kindhearted street urchin named Aladdin embarks on a magical adventure after finding a lamp that releases a wisecracking genie while a power-hungry Grand Vizier vies for the same lamp that has the power to make their deepest wishes come true. ', 2019, 'Action / Adventure / Comedy / Family / Fantasy / Musical / Romance', 8.0, '../../uploads/aladdin.jpg', NULL, 'Guy Ritchie', '2024-08-12 00:26:50'),
(37, 1, 'Alita: Battle Angel', 'When Alita awakens with no memory of who she is in a future world she does not recognize, she is taken in by Ido, a compassionate doctor who realizes that somewhere in this abandoned cyborg shell is the heart and soul of a young woman with an extraordinary past. ', 2019, 'Action / Adventure / Sci-Fi / Thriller', 8.0, '../../uploads/Alita.jpg', '', 'Robert Rodriguez', '2024-08-12 00:27:58'),
(38, 1, 'Alpha', 'In the prehistoric past, Keda, a young and inexperienced hunter, struggles to return home after being separated from his tribe when bison hunting goes awry. On his way back he will find an unexpected ally. ', 2018, 'Action / Adventure / Drama / Family', 7.0, '../../uploads/Alpha.jpg', NULL, 'Albert Hughes', '2024-08-12 00:29:35'),
(39, 1, 'American Pie', 'At a high-school party, four friends find that losing their collective virginity isn\'t as easy as they had thought. But they still believe that they need to do so before college. To motivate themselves, they enter a pact to all \"score\" by their senior prom. ', 1999, 'Action / Comedy / Romance', 6.0, '../../uploads/American Pie.jpg', NULL, 'Chris Weitz', '2024-08-12 00:32:00'),
(41, 1, 'American Sniper', 'U.S. Navy SEAL Chris Kyle takes his sole mission—protect his comrades—to heart and becomes one of the most lethal snipers in American history. His pinpoint accuracy not only saves countless lives but also makes him a prime target of insurgents. Despite grave danger and his struggle to be a good husband and father to his family back in the States, Kyle serves four tours of duty in Iraq. However, when he finally returns home, he finds that he cannot leave the war behind. ', 2014, 'Action / Biography / Drama / History / Thriller / War', 8.0, '../../uploads/American Sniper.jpg', NULL, 'Clint Eastwood', '2024-08-12 14:39:50');

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
(7, 'Monsters, Inc.', 'sad', 2024, 'Action / Adventure / Sci-Fi / Thriller', 3.0, '../../uploads/avengers.jpg', '', 'Mark Andrews', 17, NULL),
(14, 'Big Hero 6', 'sad', 2023, 'Action / Adventure / Animation / Comedy / Crime / Drama / Family / Fantasy / Mystery / Sci-Fi', 5.0, '../../uploads/iron man 3.jpg', 'Hayley Atwell as Peggy Carter|../../uploads/nm2017943.jpg', 'Lee Unkrich', 1, '2024-08-07 22:44:12'),
(15, 'Finding Nemo', 'sad', 2222, 'Action / Adventure / Animation / Comedy / Crime / Drama / Family / Fantasy / Mystery / Sci-Fi', 2.0, '../../uploads/ratatouille.jpg', '', 'Lee Unkrich', 1, '2024-08-08 17:03:42'),
(16, 'Finding Nemo', 'sad', 2312, 'Action / Adventure / Animation / Comedy / Family / Fantasy / Horror', 3.0, '../../uploads/toy story 2.jpg', '', 'John Lasseter', 1, '2024-08-08 17:12:51');

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
(6, 'Big Hero 6', 'sad', 2004, 'Action / Adventure / Animation / Comedy / Crime / Drama / Family / Fantasy / Mystery / Sci-Fi', 4.0, '../../uploads/cool-anime-6kbwj9794wpnsfr1.jpg', ' Marza Animation Planet', '2 hours', 17, NULL),
(9, 'Big Hero 6', 'sad', 2222, 'Action / Adventure / Sci-Fi / Thriller', 3.0, '../../uploads/83300.jpg', ' Marza Animation Planet', '127 minutes', 1, '2024-08-08');

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
(27, 'Jujutus Kaisen', 'Idly indulging in baseless paranormal activities with the Occult Club, high schooler Yuuji Itadori spends his days at either the clubroom or the hospital, where he visits his bedridden grandfather. However, this leisurely lifestyle soon takes a turn for the strange when he unknowingly encounters a cursed item. Triggering a chain of supernatural occurrences, Yuuji finds himself suddenly thrust into the world of Curses—dreadful beings formed from human malice and negativity—after swallowing the said item, revealed to be a finger belonging to the demon Sukuna Ryoumen, the King of Curses.\r\n\r\nYuuji experiences first-hand the threat these Curses pose to society as he discovers his own newfound powers. Introduced to the Tokyo Prefectural Jujutsu High School, he begins to walk down a path from which he cannot return—the path of a Jujutsu sorcerer.', 2020, 'Action / Award Winning  / Fantasy', 9.0, '../../uploads/Jujutsu Kaisen.jpg', 24, 'MAPPA', 1, '2024-08-09');

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
(17, 'Monsters, Inc.', 'Lovable Sulley and his wisecracking sidekick Mike Wazowski are the top scare team at Monsters, Inc., the scream-processing factory in Monstropolis. When a little girl named Boo wanders into their world, it\'s the monsters who are scared silly, and it\'s up to Sulley and Mike to keep her out of sight and get her back home.', 2001, 'Action / Adventure / Animation / Comedy / Family / Fantasy / Horror', 7.0, '../../uploads/Monsters.Inc.jpg', 'Hayley Atwell as Peggy Carter|../../uploads/toy story 2.jpg', 'Lee Unkrich', 1, '2024-07-30'),
(18, 'Brave', 'sad', 2222, 'Action / Adventure / Sci-Fi / Thriller', 3.0, '../../uploads/avengers.jpg', '', 'John Lasseter', 1, '2024-08-08');

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
(5, 'Big Hero 6', 'sad', 2024, 'Action / Adventure / Sci-Fi / Thriller', 2.0, '../uploads/Toy Story 3.jpg', 24, ' Marza Animation Planet', 17, NULL),
(8, 'Big Hero 6', 'sad', 2222, 'Action / Adventure / Animation / Comedy / Crime / Drama / Family / Fantasy / Mystery / Sci-Fi', 10.0, '../../uploads/The Incredible.jpg', 22, ' Marza Animation Planet', 1, '2024-08-08'),
(9, 'Finding Nemo', 'sad', 2222, 'Action / Adventure / Sci-Fi / Thriller', 3.0, '../../uploads/Toy Story 3.jpg', 12, ' Marza Animation Planet', 1, '2024-08-08'),
(10, 'Frozen', 'sad', 2222, 'Action / Adventure / Animation / Comedy / Crime / Drama / Family / Fantasy / Mystery / Sci-Fi', 3.0, '../../uploads/Toy Story 3.jpg', 2, ' Marza Animation Planet', 1, '2024-08-09'),
(11, 'sad', '213', 2321, 'Action / Adventure / Sci-Fi / Thriller', 3.0, '../../uploads/The Incredible.jpg', 21, 'Studio Bind', 1, '2024-08-09'),
(12, 'Monsters, Inc.', 'sad', 2134, 'Action / Adventure / Animation / Comedy / Family / Fantasy / Horror', 2.0, '../../uploads/Toy Story.jpg', 3, ' Marza Animation Planet', 1, '2024-08-09');

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

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `summary`, `year`, `genre`, `rating`, `img`, `studio`, `publisher`, `device`, `user_id`, `date_added`) VALUES
(12, 'Big Hero 6', 'sad', 2222, 'Action / Adventure / Animation / Comedy / Family / Fantasy / Horror', 3.0, '../../uploads/Monsters.Inc.jpg', ' Marza Animation Planet', 'juloues', 'PC', 1, '2024-08-09'),
(13, 'Frozen', 'sad', 2222, 'Action / Adventure / Animation / Comedy / Crime / Drama / Family / Fantasy / Mystery / Sci-Fi', 2.0, '../../uploads/ratatouille.jpg', ' Marza Animation Planet', 'juloues', 'PC', 1, '2024-08-09');

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
(1, 'sad', 'sad', 'Action / Adventure / Animation / Comedy / Family / Fantasy', 'Playstation', 2222, 'sad', 4.0, '../../uploads/avengers.jpg', 22, NULL),
(5, 'opm', 'sadsa', 'Action / Adventure / Sci-Fi / Thriller', 'Complete', 2222, 'sad', 3.0, '../../uploads/Toy Story 3.jpg', 1, '2024-08-10'),
(6, 'sad', 'sadsa', 'Action / Adventure / Animation / Comedy / Family / Fantasy / Horror', 'Complete', 2132, '123', 2.0, '../../uploads/iron man 3.jpg', 1, '2024-08-10');

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

--
-- Dumping data for table `manhwa`
--

INSERT INTO `manhwa` (`id`, `title`, `author`, `genre`, `status`, `release_date`, `description`, `rating`, `img`, `user_id`, `date_added`) VALUES
(17, 'sat', 'sadsa', 'Action / Adventure / Animation / Comedy / Family / Fantasy', 'Mobile Phone', 2222, 'sad', 2.0, '../../uploads/iron man 3.jpg', 1, '2024-08-10'),
(18, 'pat', 'sadsa', 'Action / Adventure / Sci-Fi / Thriller', 'Complete', 2222, 'sad', 3.0, '../../uploads/toy story 2.jpg', 1, '2024-08-10');

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
(4, 'sad', 'sadsa', 'Action / Adventure / Animation / Comedy / Family / Fantasy', 'Ongoing', 2024, 'sad', 2.0, '../uploads/83300.jpg', 17, NULL),
(7, 'sad', 'sadsa', 'Action / Adventure / Animation / Comedy / Family / Fantasy', 'Complete', 2222, 'sad', 2.0, '../../uploads/iron man 3.jpg', 1, '2024-08-10'),
(8, 'sat', 'sadsa', 'Action / Adventure / Animation / Comedy / Family / Fantasy', 'Complete', 2222, 'sad', 4.0, '../../uploads/captain america the winter soldier.jpg', 1, '2024-08-10');

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `american_tv_series`
--
ALTER TABLE `american_tv_series`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `anime_movies`
--
ALTER TABLE `anime_movies`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `anime_series`
--
ALTER TABLE `anime_series`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cartoon_movies`
--
ALTER TABLE `cartoon_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cartoon_series`
--
ALTER TABLE `cartoon_series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `homepage_content`
--
ALTER TABLE `homepage_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manga`
--
ALTER TABLE `manga`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manhwa`
--
ALTER TABLE `manhwa`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `manhwa_18`
--
ALTER TABLE `manhwa_18`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
