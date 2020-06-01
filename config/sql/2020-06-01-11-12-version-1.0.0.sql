-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2020 at 11:12 AM
-- Server version: 8.0.20-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `post_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `posted_by` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `posted_to` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `post_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(1, '', 'tamara_rodriguez', 'tamara_rodriguez', '2020-05-12 12:28:56', 'no', 42),
(2, 'Mi primer comentario', 'tamara_rodriguez', 'tamara_rodriguez', '2020-05-12 12:29:05', 'no', 42),
(3, 'Qué guapo eres', 'tamara_rodriguez', '_giovanolla', '2020-05-12 12:30:11', 'no', 38),
(4, '12355', '_giovanolla', 'tamara_rodriguez', '2020-05-12 12:31:49', 'no', 42),
(5, 'Y no se acaba nunca', '_giovanolla', 'tamara_rodriguez', '2020-05-12 13:08:11', 'no', 41),
(6, 'fasdasd', '_giovanolla', 'tamara_rodriguez', '2020-05-12 13:10:34', 'no', 42),
(7, 'rdlkaslñdksad', 'tamara_rodriguez', 'tamara_rodriguez', '2020-05-12 15:56:44', 'no', 42),
(8, 'Hola qué tal', '_giovanolla', 'tamara_rodriguez', '2020-05-15 18:32:38', 'no', 43),
(9, 'Pos aquí de birras', '_sanchez', 'tamara_rodriguez', '2020-05-15 18:37:43', 'no', 43),
(10, 'Prueba', '_giovanolla', '_sanchez', '2020-05-18 11:03:55', 'no', 44),
(11, 'Uno más', '_sanchez', 'tamara_rodriguez', '2020-05-18 11:28:57', 'no', 40),
(12, 'Hola', '_sanchez', 'tamara_rodriguez', '2020-05-18 11:32:24', 'no', 42),
(13, 'Otro más', '_sanchez', '_sanchez', '2020-05-18 12:41:31', 'no', 44),
(14, 'Algo falla', '_sanchez', '_sanchez', '2020-05-18 12:58:10', 'no', 44),
(15, 'Un comentario más', '_giovanolla', '_sanchez', '2020-05-18 16:29:55', 'no', 44),
(16, 'Clá que sí', '_lospitao', '_giovanolla', '2020-05-21 17:20:35', 'no', 38),
(17, 'Por course', '_lospitao', '_giovanolla', '2020-05-24 11:29:53', 'no', 38),
(18, 'Esto sigue funcionando', 'tamara_rodriguez', 'tamara_rodriguez', '2020-05-26 10:57:10', 'no', 62),
(19, 'This should not exist', '_giovanolla', 'tamara_rodriguez', '2020-05-26 16:23:59', 'no', 71),
(20, '¡Cómo lo has sabido!', '_lospitao', '_giovanolla', '2020-05-27 11:31:16', 'no', 79);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int NOT NULL,
  `username` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `post_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(5, '_giovanolla', 41),
(13, '_giovanolla', 44),
(14, 'tamara_rodriguez', 43),
(15, 'tamara_rodriguez', 42),
(16, 'tamara_rodriguez', 40),
(17, '_ortega', 22),
(18, '_lospitao', 38),
(19, '_lospitao', 61),
(20, 'tamara_rodriguez', 62),
(21, 'tamara_rodriguez', 71),
(22, '_lospitao', 79);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(1, 'tamara_rodriguez', '_lospitao', 'Primer mensaje directo', '2020-05-27 13:42:11', 'no', 'no', 'no'),
(2, 'tamara_rodriguez', '_lospitao', 'Segundo mensaje', '2020-05-27 13:42:56', 'no', 'no', 'no'),
(3, 'tamara_rodriguez', '_lospitao', 'Tercer mensaje', '2020-05-27 13:43:00', 'no', 'no', 'no'),
(4, 'tamara_rodriguez', '_lospitao', 'Cuarto mensaje', '2020-05-27 13:43:04', 'no', 'no', 'no'),
(5, 'tamara_rodriguez', '_lospitao', 'Quinto mensaje', '2020-05-27 13:43:10', 'no', 'no', 'no'),
(6, '_lospitao', 'tamara_rodriguez', 'Primer contramensaje', '2020-05-27 13:45:54', 'no', 'no', 'no'),
(7, '_lospitao', 'tamara_rodriguez', 'Segundo contramensaje', '2020-05-27 13:45:59', 'no', 'no', 'no'),
(8, '_lospitao', 'tamara_rodriguez', 'Tercer Contramensaje', '2020-05-27 13:46:04', 'no', 'no', 'no'),
(9, '_lospitao', 'tamara_rodriguez', 'Cuarto contramensaje', '2020-05-27 13:46:09', 'no', 'no', 'no'),
(10, 'tamara_rodriguez', '_lospitao', 'Primer recontramensaje', '2020-05-27 13:47:12', 'no', 'no', 'no'),
(11, 'tamara_rodriguez', '_lospitao', 'Segundo recontramensaje', '2020-05-27 13:47:17', 'no', 'no', 'no'),
(12, 'tamara_rodriguez', '_lospitao', 'Tercer recontramensaje', '2020-05-27 13:47:22', 'no', 'no', 'no'),
(13, 'tamara_rodriguez', '_lospitao', 'Cuarto recontramensaje', '2020-05-27 13:47:28', 'no', 'no', 'no'),
(14, '_lospitao', 'tamara_rodriguez', 'Funcionalidad completa', '2020-05-27 17:12:49', 'no', 'no', 'no'),
(15, '_lospitao', 'tamara_rodriguez', 'Funcionalidad completa', '2020-05-28 10:32:36', 'no', 'no', 'no'),
(16, '_lospitao', 'tamara_rodriguez', 'Vamos a ver dónde va esto\r\n', '2020-05-28 10:33:29', 'no', 'no', 'no'),
(17, '_lospitao', 'tamara_rodriguez', 'A ver si empieza a hacer scroll', '2020-05-28 10:33:40', 'no', 'no', 'no'),
(18, '_lospitao', 'tamara_rodriguez', 'dkasldkasd', '2020-05-28 10:33:48', 'no', 'no', 'no'),
(19, '_lospitao', 'tamara_rodriguez', 'skdñlaskdl', '2020-05-28 10:33:51', 'no', 'no', 'no'),
(20, '_giovanolla', '_lospitao', 'Hola mi amor, qué tal?', '2020-05-28 16:57:31', 'no', 'no', 'no'),
(21, '_giovanolla', '_lospitao', 'Estoy deseando que vivamos solitos\r\n', '2020-05-28 16:57:41', 'no', 'no', 'no'),
(22, '_giovanolla', '_lospitao', 'Para querernos por todas partes', '2020-05-28 16:57:58', 'no', 'no', 'no'),
(23, '_ortega', '_lospitao', 'Y aquí estamos programando!\r\n', '2020-05-28 16:58:25', 'no', 'no', 'no'),
(24, '_ortega', '_lospitao', 'Qué divertido', '2020-05-28 16:58:30', 'no', 'no', 'no'),
(25, '_ortega', '_lospitao', 'Vamos pallá', '2020-05-28 16:58:37', 'no', 'no', 'no'),
(26, 'tamara_rodriguez', '_lospitao', 'Y ahora se verá la primera', '2020-05-28 17:01:16', 'no', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `added_by` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_to` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deleted` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `likes` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`) VALUES
(1, 'La virgen santa', 'tamara_rodriguez', 'none', '2020-05-07 18:09:32', 'no', 'no', 0),
(2, 'Hola', '_giovanolla', 'none', '2020-05-07 18:14:50', 'no', 'no', 0),
(3, 'Perdona, qué decias?ç', '_giovanolla', 'none', '2020-05-07 18:23:21', 'no', 'no', 0),
(4, 'No tengo el chichi para farolillos', '_giovanolla', 'none', '2020-05-07 18:23:34', 'no', 'no', 0),
(5, 'Pues si tienes sed te aguantas\r\n', '_giovanolla', 'none', '2020-05-07 18:23:49', 'no', 'no', 0),
(6, 'Pues si tienes sed te aguantas\r\n', '_giovanolla', 'none', '2020-05-07 18:24:24', 'no', 'no', 0),
(7, 'Pues si tienes sed te aguantas\r\n', '_giovanolla', 'none', '2020-05-07 18:24:47', 'no', 'no', 0),
(8, 'Este post es de prueba', '_giovanolla', 'none', '2020-05-07 18:25:36', 'no', 'no', 0),
(9, 'Y este también', '_giovanolla', 'none', '2020-05-07 18:25:41', 'no', 'no', 0),
(10, 'El helado saltó', '_giovanolla', 'none', '2020-05-07 18:25:48', 'no', 'no', 0),
(11, 'Y me lo comí', '_giovanolla', 'none', '2020-05-07 18:25:54', 'no', 'no', 0),
(12, 'Doña Pito Piturra', '_giovanolla', 'none', '2020-05-07 18:26:01', 'no', 'no', 0),
(13, 'Tiene unos guantes', '_giovanolla', 'none', '2020-05-07 18:26:08', 'no', 'no', 0),
(14, 'Doña pito piturra', '_giovanolla', 'none', '2020-05-07 18:26:16', 'no', 'no', 0),
(15, 'Muy elegantes', '_giovanolla', 'none', '2020-05-07 18:26:21', 'no', 'no', 0),
(16, 'Hola marinero', '_lospitao_1', 'none', '2020-05-08 13:01:33', 'no', 'no', 0),
(17, 'Todo va a salir bien', '_lospitao_1', 'none', '2020-05-08 13:01:39', 'no', 'no', 0),
(18, 'No sé por qué no me cuenta bien los posts', '_lospitao_1', 'none', '2020-05-08 13:01:52', 'no', 'no', 0),
(19, 'No me sale del chichi', '_ortega', 'none', '2020-05-08 13:02:26', 'no', 'no', 0),
(20, 'Te voy a tocar los pechotes', '_ortega', 'none', '2020-05-08 13:02:34', 'no', 'no', 0),
(21, 'Esto es una prueba', '_ortega', 'none', '2020-05-08 13:02:40', 'no', 'no', 0),
(22, 'Ponme un vino blanco', '_ortega', 'none', '2020-05-08 13:02:47', 'no', 'no', 1),
(23, 'Aquí andamos', '_lospitao', 'none', '2020-05-08 13:03:15', 'no', 'no', 0),
(24, 'Más nunca monto en el ave', 'tamara_rodriguez', 'none', '2020-05-08 13:04:18', 'no', 'no', 0),
(25, 'HOla', '_lospitao', 'none', '2020-05-11 15:41:38', 'no', 'no', 0),
(26, 'Adiós', '_lospitao', 'none', '2020-05-11 15:43:03', 'no', 'no', 0),
(27, 'Hola', '_giovanolla', 'none', '2020-05-11 15:45:53', 'no', 'no', 0),
(28, 'Qué haces', '_giovanolla', 'none', '2020-05-11 15:46:35', 'no', 'no', 0),
(29, 'Hola', 'tamara_rodriguez', 'none', '2020-05-11 15:58:40', 'no', 'no', 0),
(30, 'prueba 1', 'tamara_rodriguez', 'none', '2020-05-11 16:01:23', 'no', 'no', 0),
(31, 'Ay el LOL', '_giovanolla', 'none', '2020-05-11 16:32:16', 'no', 'no', 0),
(32, 'Y ahora dónde vamos', '_giovanolla', 'none', '2020-05-11 16:32:27', 'no', 'no', 0),
(33, 'A la playa', '_giovanolla', 'none', '2020-05-11 16:32:31', 'no', 'no', 0),
(34, 'Quiero hacer surf', '_giovanolla', 'none', '2020-05-11 16:32:40', 'no', 'no', 0),
(35, 'Pero ya', '_giovanolla', 'none', '2020-05-11 17:14:56', 'no', 'no', 0),
(36, 'Vamos de fiesta', 'tamara_rodriguez', 'none', '2020-05-11 17:15:18', 'no', 'no', 0),
(37, 'Todos pallá', '_giovanolla', 'none', '2020-05-11 17:39:27', 'no', 'no', 0),
(38, 'Esto aún funciona, Pícara', '_giovanolla', 'none', '2020-05-12 10:18:02', 'no', 'no', 1),
(39, 'Uno más', 'tamara_rodriguez', 'none', '2020-05-12 12:15:29', 'no', 'no', 0),
(40, 'Uno menos', 'tamara_rodriguez', 'none', '2020-05-12 12:15:33', 'no', 'no', 1),
(41, 'Uno menos', 'tamara_rodriguez', 'none', '2020-05-12 12:15:55', 'no', 'no', 0),
(42, 'Por favor que no se joda', 'tamara_rodriguez', 'none', '2020-05-12 12:27:55', 'no', 'no', 1),
(43, 'dasdasd', 'tamara_rodriguez', 'none', '2020-05-12 15:56:47', 'no', 'no', 1),
(44, 'Mi diseño es una pasada', '_sanchez', 'none', '2020-05-15 18:43:26', 'no', 'no', 1),
(45, 'Absolutely not', 'brynn_boyd', 'none', '2020-05-22 18:58:37', 'no', 'no', 0),
(61, 'Hola qué tal', '_lospitao', 'none', '2020-05-25 22:06:45', 'no', 'no', 1),
(62, 'Hola', 'tamara_rodriguez', 'none', '2020-05-26 10:57:00', 'no', 'no', 1),
(64, 'Prueba 2', 'tamara_rodriguez', 'none', '2020-05-26 11:24:46', 'no', 'no', 0),
(66, 'Posting from my profile', 'tamara_rodriguez', 'none', '2020-05-26 11:48:59', 'no', 'no', 0),
(69, 'Posting from my profile', 'tamara_rodriguez', 'none', '2020-05-26 12:05:06', 'no', 'no', 0),
(70, 'Contrast', 'tamara_rodriguez', 'none', '2020-05-26 12:05:39', 'no', 'no', 0),
(71, 'Contrast 2', 'tamara_rodriguez', '_lospitao', '2020-05-26 12:05:54', 'no', 'no', 1),
(72, 'Hola guapa', '_giovanolla', '_lospitao', '2020-05-26 12:07:18', 'no', 'yes', 0),
(73, 'Making sure this still works', '_giovanolla', '_lospitao', '2020-05-26 13:04:36', 'no', 'yes', 0),
(74, 'Aquí vamos', '_giovanolla', 'none', '2020-05-26 15:53:16', 'no', 'no', 0),
(75, 'Por qué no me sale', '_giovanolla', 'none', '2020-05-26 15:56:22', 'no', 'no', 0),
(76, 'Aparece cabrón', '_giovanolla', 'none', '2020-05-26 16:15:30', 'no', 'no', 0),
(77, 'Hola mi amor', '_lospitao', '_giovanolla', '2020-05-26 16:19:44', 'no', 'no', 0),
(78, 'Hola nena', '_giovanolla', '_lospitao', '2020-05-27 08:48:06', 'no', 'no', 0),
(79, 'Hoy es 27 de mayo', '_giovanolla', '_lospitao', '2020-05-27 11:30:30', 'no', 'no', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `num_posts` int NOT NULL,
  `num_likes` int NOT NULL,
  `user_closed` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `friend_array` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(26, 'Laura', 'Lospitao', '_lospitao', 'Laura@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-27', 'assets/images/profile_pics/default/blaman.png', 9, 1, 'no', ',_ortega,_giovanolla,tamara_rodriguez,'),
(27, 'Lucas', 'Giovanolla', '_giovanolla', 'Lucas@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-27', 'assets/images/profile_pics/default/blaman.png', 34, 2, 'no', ',_lospitao,_ortega,tamara_rodriguez,,'),
(28, 'Lorena', 'Ortega', '_ortega', 'Lorena@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-27', 'assets/images/profile_pics/default/blaboy.png', 4, 1, 'no', ''),
(29, 'Carlos', 'Lospitao', '_lospitao_1', 'Carlos@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-27', 'assets/images/profile_pics/default/blaboy.png', 3, 0, 'no', ',tamara_rodriguez,'),
(30, 'George', 'Sanchez', '_sanchez', 'Jorge@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-27', 'assets/images/profile_pics/default/blaboy.png', 2, 1, 'no', ',tamara_rodriguez,_giovanolla,'),
(31, 'Tamara', 'Rodriguez', 'tamara_rodriguez', 'Tam@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-27', 'assets/images/profile_pics/default/blaboy.png', 23, 5, 'no', ',_lospitao,_sanchez,_lospitao_1'),
(32, 'Sagra', 'Pastor', 'sagra_pastor', 'Sagra@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-05-08', 'assets/images/profile_pics/default/blaman.png', 0, 0, 'no', ','),
(33, 'Brynn', 'Boyd', 'brynn_boyd', 'Brynn@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-05-12', 'assets/images/profile_pics/default/blaman.png', 1, 0, 'no', ',');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
