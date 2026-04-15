-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2026 at 05:22 PM
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
-- Database: `game_review_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `review_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `developer` varchar(100) DEFAULT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `igdb_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `title`, `description`, `release_date`, `developer`, `publisher`, `cover_image`, `created_at`, `igdb_id`) VALUES
(1, 'Pokopia', 'A colorful adventure game with exploration and puzzles.', '2026-03-20', 'Indie Studio', 'Indie Studio', 'images/nintendoGames/pokopia.png', '2026-03-23 07:56:56', 366893),
(2, 'Crimson Desert', 'An open-world action RPG with stunning visuals.', '2026-03-19', 'Pearl Abyss', 'Pearl Abyss', 'images/pcGames/crimsonDesert.jpg', '2026-03-23 07:56:56', 125633),
(3, 'Ghost of Yotei', 'A samurai story-driven action game.', '2025-10-02', 'Sucker Punch', 'Sony', 'images/psGames/ghostOfYotei.jpg', '2026-03-23 07:56:56', 317627),
(4, 'Elden Ring', 'A dark fantasy open-world RPG.', '2022-02-25', 'FromSoftware', 'Bandai Namco', 'images/pcGames/eldenRing.jpg', '2026-03-23 07:56:56', 325591),
(5, 'Cyberpunk 2077', 'Futuristic open-world RPG.', '2020-12-10', 'CD Projekt Red', 'CD Projekt', 'images/pcGames/cyberpunk.jpg', '2026-03-23 07:56:56', 277807),
(6, 'The Witcher 3', 'Story-driven RPG with rich world.', '2015-05-19', 'CD Projekt Red', 'CD Projekt', 'images/pcGames/witcher3.jpeg', '2026-03-23 07:56:56', 141472),
(7, 'Call of Duty: Warzone', 'Battle royale FPS game.', '2020-03-10', 'Infinity Ward', 'Activision', 'images/pcGames/codWarzone.jpg', '2026-03-23 07:56:56', 217815),
(8, 'FIFA 25', 'Football simulation game.', '2025-09-27', 'EA Sports', 'EA', 'images/psgames/fifa25.jpg', '2026-03-23 07:56:56', 308698),
(9, 'Forza Horizon 5', 'Open-world racing game.', '2021-11-09', 'Playground Games', 'Xbox Game Studios', 'images/psgames/forza5.jpg', '2026-03-23 07:56:56', 171270),
(10, 'Resident Evil 4', 'Survival horror remake.', '2023-03-24', 'Capcom', 'Capcom', 'images/psgames/residentEvil4.png', '2026-03-23 07:56:56', 145201),
(11, 'Minecraft', 'Sandbox building and survival game.', '2011-11-18', 'Mojang', 'Mojang', 'images/pcGames/minecraft.jpg', '2026-03-23 07:56:56', 135400),
(12, 'Grand Theft Auto V', 'Open-world crime game.', '2013-09-17', 'Rockstar Games', 'Rockstar Games', 'images/pcGames/gtaV.jpg', '2026-03-23 07:56:56', 239064),
(13, 'Valorant', 'Valorant is a character-based 5v5 tactical shooter set on the global stage. Outwit, outplay, and outshine your competition with tactical abilities, precise gunplay, and adaptive teamwork.', '2020-06-02', 'Riot Games', 'Riot Games', 'images/pcGames/valorant.jpg', '2026-04-15 14:54:46', 126459),
(14, 'League of Legends', 'League of Legends is a fast-paced, competitive online game that blends the speed and intensity of an RTS with RPG elements. Two teams of powerful champions, each with a unique design and playstyle, battle head-to-head across multiple battlefields and game modes. With an ever-expanding roster of champions, frequent updates and a thriving tournament scene, League of Legends offers endless replayability for players of every skill level.', '2009-10-27', 'Riot Games', 'Riot Games\r\nTencent Holdings\r\nGOA Games Services Ltd.', 'images/pcGames/leagueOfLegends.jpg', '2026-04-15 14:54:46', 115),
(15, 'ARC Raiders', 'ARC Raiders is a multiplayer extraction adventure, set in a lethal future earth, ravaged by a mysterious mechanized threat known as ARC. Enlist as a Raider and scavenge the surface to thrive in a desolate world. But beware of the machines. Beware of Raiders preying on others.\r\n\r\nARC Raiders blends the tension from extraction shooters with atmospheric settings from the adventure genre. Lurking threats—from deadly machines to other Raiders—create a constant ebb and flow of intensity, where every moment is charged with the thrill of high stakes. Extract valuable loot and explore the unfolding mysteries of a vibrant, lethal world.\r\n\r\nARC Raiders supports seamless social play across PlayStation, Xbox, and PC. Play with your squad and thrive as a team, or rise in the ranks as a lone ranger.', '2025-10-30', 'Embark Studios', 'Embark Studios', 'images/pcGames/arcRaiders.png', '2026-04-15 14:56:25', 185258),
(16, 'Counter-Strike 2', 'For over two decades, Counter-Strike has offered an elite competitive experience, one shaped by millions of players from across the globe. And now the next chapter in the CS story is about to begin. This is Counter-Strike 2.\r\n\r\nA free upgrade to CS:GO, Counter-Strike 2 marks the largest technical leap in Counter-Strike’s history. Built on the Source 2 engine, Counter-Strike 2 is modernized with realistic physically-based rendering, state of the art networking, and upgraded Community Workshop tools.', '2023-09-27', 'Valve', 'Valve', 'images/pcGames/counterStrike.jpg', '2026-04-15 14:56:25', 242408);

-- --------------------------------------------------------

--
-- Table structure for table `game_genres`
--

CREATE TABLE `game_genres` (
  `game_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_genres`
--

INSERT INTO `game_genres` (`game_id`, `genre_id`) VALUES
(1, 3),
(2, 1),
(3, 4),
(4, 1),
(5, 1),
(6, 1),
(7, 2),
(8, 9),
(9, 10),
(10, 8),
(11, 6),
(12, 7),
(13, 2),
(14, 11),
(15, 4),
(16, 2);

-- --------------------------------------------------------

--
-- Table structure for table `game_platforms`
--

CREATE TABLE `game_platforms` (
  `game_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_platforms`
--

INSERT INTO `game_platforms` (`game_id`, `platform_id`) VALUES
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(3, 2),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(7, 3),
(8, 2),
(8, 3),
(9, 3),
(10, 1),
(10, 2),
(10, 3),
(11, 1),
(11, 4),
(12, 1),
(12, 2),
(12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `game_ratings`
--

CREATE TABLE `game_ratings` (
  `game_id` int(11) NOT NULL,
  `average_rating` decimal(3,1) DEFAULT NULL,
  `total_reviews` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `name`) VALUES
(4, 'Action'),
(3, 'Adventure'),
(2, 'FPS'),
(8, 'Horror'),
(11, 'MOBA'),
(7, 'Open World'),
(10, 'Racing'),
(1, 'RPG'),
(6, 'Simulation'),
(9, 'Sports'),
(5, 'Strategy');

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `platform_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`platform_id`, `name`) VALUES
(4, 'Nintendo Switch'),
(1, 'PC'),
(2, 'PlayStation'),
(3, 'Xbox');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL CHECK (`rating` >= 0 and `rating` <= 10),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `game_id`, `title`, `content`, `rating`, `created_at`, `updated_at`) VALUES
(7, 7, 2, 'Good game', 'Nice', 5.0, '2026-04-15 13:22:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review_likes`
--

CREATE TABLE `review_likes` (
  `user_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review_likes`
--

INSERT INTO `review_likes` (`user_id`, `review_id`) VALUES
(7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `favorite_genre` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `profile_picture`, `bio`, `favorite_genre`, `created_at`) VALUES
(1, 'testuser', 'test@example.com', '123', NULL, 'This is a test user', NULL, '2026-03-21 02:54:58'),
(4, 'testuser5', 'test1@test.com', '$2y$10$54H/ghAhfjjYIvq8cgqC4OS3UWCbuxtEWXrfpVueX0A5Nhu0WGUyK', '1774248968_126472.png', 'Test 5', 'Strategy', '2026-03-21 06:32:51'),
(5, 'medalofmine', 'medal@gmail.com', '$2y$10$/OobkFHOfTy5e5TxFdlKGeu0GGGibEAzE90InxHbTMxyQyHzb.mWi', NULL, 'afonso', 'Simulation', '2026-03-21 06:37:51'),
(7, 'PCTest', 'test@testing.com', '$2y$10$/COWfjqilFVT3/OB4VQf4.vQnHu2yQ7Lf77hhAX6mIUWIBD21WSuq', NULL, NULL, NULL, '2026-04-14 02:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_favorites`
--

CREATE TABLE `user_favorites` (
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `review_id` (`review_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `game_genres`
--
ALTER TABLE `game_genres`
  ADD PRIMARY KEY (`game_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `game_platforms`
--
ALTER TABLE `game_platforms`
  ADD PRIMARY KEY (`game_id`,`platform_id`),
  ADD KEY `platform_id` (`platform_id`);

--
-- Indexes for table `game_ratings`
--
ALTER TABLE `game_ratings`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`platform_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `review_likes`
--
ALTER TABLE `review_likes`
  ADD PRIMARY KEY (`user_id`,`review_id`),
  ADD KEY `review_id` (`review_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD PRIMARY KEY (`user_id`,`game_id`),
  ADD KEY `game_id` (`game_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `platform_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`review_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `game_genres`
--
ALTER TABLE `game_genres`
  ADD CONSTRAINT `game_genres_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `game_genres_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE CASCADE;

--
-- Constraints for table `game_platforms`
--
ALTER TABLE `game_platforms`
  ADD CONSTRAINT `game_platforms_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `game_platforms_ibfk_2` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`platform_id`) ON DELETE CASCADE;

--
-- Constraints for table `game_ratings`
--
ALTER TABLE `game_ratings`
  ADD CONSTRAINT `game_ratings_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;

--
-- Constraints for table `review_likes`
--
ALTER TABLE `review_likes`
  ADD CONSTRAINT `review_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_likes_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`review_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD CONSTRAINT `user_favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_favorites_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
