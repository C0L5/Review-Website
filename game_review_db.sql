-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/03/2026 às 08:59
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `game_review_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comments`
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
-- Estrutura para tabela `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `developer` varchar(100) DEFAULT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `games`
--

INSERT INTO `games` (`game_id`, `title`, `description`, `release_date`, `developer`, `publisher`, `cover_image`, `created_at`) VALUES
(1, 'Pokopia', 'A colorful adventure game with exploration and puzzles.', '2026-03-05', 'Indie Studio', 'Indie Studio', 'images/nintendoGames/pokopia.png', '2026-03-23 07:56:56'),
(2, 'Crimson Desert', 'An open-world action RPG with stunning visuals.', '2026-03-19', 'Pearl Abyss', 'Pearl Abyss', 'images/pcGames/crimsonDesert.jpg', '2026-03-23 07:56:56'),
(3, 'Ghost of Yotei', 'A samurai story-driven action game.', '2025-10-02', 'Sucker Punch', 'Sony', 'images/psGames/ghostOfYotei.jpg', '2026-03-23 07:56:56'),
(4, 'Elden Ring', 'A dark fantasy open-world RPG.', '2022-02-25', 'FromSoftware', 'Bandai Namco', 'images/games/eldenring.jpg', '2026-03-23 07:56:56'),
(5, 'Cyberpunk 2077', 'Futuristic open-world RPG.', '2020-12-10', 'CD Projekt Red', 'CD Projekt', 'images/games/cyberpunk.jpg', '2026-03-23 07:56:56'),
(6, 'The Witcher 3', 'Story-driven RPG with rich world.', '2015-05-19', 'CD Projekt Red', 'CD Projekt', 'images/games/witcher3.jpg', '2026-03-23 07:56:56'),
(7, 'Call of Duty: Warzone', 'Battle royale FPS game.', '2020-03-10', 'Infinity Ward', 'Activision', 'images/games/warzone.jpg', '2026-03-23 07:56:56'),
(8, 'FIFA 25', 'Football simulation game.', '2025-09-27', 'EA Sports', 'EA', 'images/games/fifa25.jpg', '2026-03-23 07:56:56'),
(9, 'Forza Horizon 5', 'Open-world racing game.', '2021-11-09', 'Playground Games', 'Xbox Game Studios', 'images/games/forza5.jpg', '2026-03-23 07:56:56'),
(10, 'Resident Evil 4 Remake', 'Survival horror remake.', '2023-03-24', 'Capcom', 'Capcom', 'images/games/re4.jpg', '2026-03-23 07:56:56'),
(11, 'Minecraft', 'Sandbox building and survival game.', '2011-11-18', 'Mojang', 'Mojang', 'images/games/minecraft.jpg', '2026-03-23 07:56:56'),
(12, 'Grand Theft Auto V', 'Open-world crime game.', '2013-09-17', 'Rockstar Games', 'Rockstar Games', 'images/games/gta5.jpg', '2026-03-23 07:56:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `game_genres`
--

CREATE TABLE `game_genres` (
  `game_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `game_genres`
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
(12, 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `game_platforms`
--

CREATE TABLE `game_platforms` (
  `game_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `game_platforms`
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
-- Estrutura para tabela `game_ratings`
--

CREATE TABLE `game_ratings` (
  `game_id` int(11) NOT NULL,
  `average_rating` decimal(3,1) DEFAULT NULL,
  `total_reviews` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `genres`
--

INSERT INTO `genres` (`genre_id`, `name`) VALUES
(4, 'Action'),
(3, 'Adventure'),
(2, 'FPS'),
(8, 'Horror'),
(7, 'Open World'),
(10, 'Racing'),
(1, 'RPG'),
(6, 'Simulation'),
(9, 'Sports'),
(5, 'Strategy');

-- --------------------------------------------------------

--
-- Estrutura para tabela `platforms`
--

CREATE TABLE `platforms` (
  `platform_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `platforms`
--

INSERT INTO `platforms` (`platform_id`, `name`) VALUES
(4, 'Nintendo Switch'),
(1, 'PC'),
(2, 'PlayStation'),
(3, 'Xbox');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reviews`
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
-- Despejando dados para a tabela `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `game_id`, `title`, `content`, `rating`, `created_at`, `updated_at`) VALUES
(1, 4, 11, 'Good', 'It\'s good', 10.0, '2026-03-23 07:58:04', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `review_likes`
--

CREATE TABLE `review_likes` (
  `user_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
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
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `profile_picture`, `bio`, `favorite_genre`, `created_at`) VALUES
(1, 'testuser', 'test@example.com', '123', NULL, 'This is a test user', NULL, '2026-03-21 02:54:58'),
(4, 'testuser5', 'test1@test.com', '$2y$10$54H/ghAhfjjYIvq8cgqC4OS3UWCbuxtEWXrfpVueX0A5Nhu0WGUyK', '1774248968_126472.png', 'Test 5', 'Strategy', '2026-03-21 06:32:51'),
(5, 'medalofmine', 'medal@gmail.com', '$2y$10$/OobkFHOfTy5e5TxFdlKGeu0GGGibEAzE90InxHbTMxyQyHzb.mWi', NULL, NULL, NULL, '2026-03-21 06:37:51');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user_favorites`
--

CREATE TABLE `user_favorites` (
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `review_id` (`review_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Índices de tabela `game_genres`
--
ALTER TABLE `game_genres`
  ADD PRIMARY KEY (`game_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Índices de tabela `game_platforms`
--
ALTER TABLE `game_platforms`
  ADD PRIMARY KEY (`game_id`,`platform_id`),
  ADD KEY `platform_id` (`platform_id`);

--
-- Índices de tabela `game_ratings`
--
ALTER TABLE `game_ratings`
  ADD PRIMARY KEY (`game_id`);

--
-- Índices de tabela `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Índices de tabela `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`platform_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Índices de tabela `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Índices de tabela `review_likes`
--
ALTER TABLE `review_likes`
  ADD PRIMARY KEY (`user_id`,`review_id`),
  ADD KEY `review_id` (`review_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD PRIMARY KEY (`user_id`,`game_id`),
  ADD KEY `game_id` (`game_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `platforms`
--
ALTER TABLE `platforms`
  MODIFY `platform_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`review_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `game_genres`
--
ALTER TABLE `game_genres`
  ADD CONSTRAINT `game_genres_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `game_genres_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `game_platforms`
--
ALTER TABLE `game_platforms`
  ADD CONSTRAINT `game_platforms_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `game_platforms_ibfk_2` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`platform_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `game_ratings`
--
ALTER TABLE `game_ratings`
  ADD CONSTRAINT `game_ratings_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `review_likes`
--
ALTER TABLE `review_likes`
  ADD CONSTRAINT `review_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_likes_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`review_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD CONSTRAINT `user_favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_favorites_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
