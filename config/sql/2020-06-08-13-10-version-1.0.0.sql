-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 08-06-2020 a las 13:09:42
-- Versión del servidor: 8.0.20-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `social`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
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
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(2, 'Mi primer comentario', 'tamara_rodriguez', 'tamara_rodriguez', '2020-05-12 12:29:05', 'no', 42),
(7, 'rdlkaslñdksad', 'tamara_rodriguez', 'tamara_rodriguez', '2020-05-12 15:56:44', 'no', 42),
(18, 'Esto sigue funcionando', 'tamara_rodriguez', 'tamara_rodriguez', '2020-05-26 10:57:10', 'no', 62),
(21, '¡Qué alegría!', 'lorena_ortega', 'lucas_giovanolla', '2020-06-02 10:52:23', 'no', 83);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `user_to`, `user_from`) VALUES
(45, 'tamara_rodriguez', 'brynn_boyd'),
(48, 'tamara_rodriguez', 'lucas_giovanolla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` int NOT NULL,
  `username` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `post_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `likes`
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
-- Estructura de tabla para la tabla `messages`
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
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(27, 'tamara_rodriguez', 'laura_lospitao', 'Hola Tam', '2020-06-01 17:49:09', 'yes', 'yes', 'no'),
(28, 'tamara_rodriguez', 'laura_lospitao', 'Qué tal', '2020-06-01 17:49:16', 'yes', 'yes', 'no'),
(29, 'tamara_rodriguez', 'laura_lospitao', 'A ver si damos negativo', '2020-06-01 17:49:23', 'yes', 'yes', 'no'),
(30, 'tamara_rodriguez', 'laura_lospitao', 'Y de una puta vez se acaba esta mierda', '2020-06-01 17:49:32', 'yes', 'yes', 'no'),
(31, 'lucas_giovanolla', 'lorena_ortega', 'Hola Lucas, qué tal estás?', '2020-06-01 18:16:18', 'yes', 'yes', 'no'),
(32, 'lucas_giovanolla', 'lorena_ortega', 'Yo muy bien', '2020-06-01 18:16:23', 'yes', 'yes', 'no'),
(33, 'lucas_giovanolla', 'lorena_ortega', 'Aquí andamos', '2020-06-01 18:16:27', 'yes', 'yes', 'no'),
(34, 'laura_lospitao', 'lorena_ortega', 'Hola Laura', '2020-06-01 18:16:43', 'yes', 'yes', 'no'),
(35, 'laura_lospitao', 'lorena_ortega', 'Tenemos Pendiente una cena', '2020-06-01 18:16:53', 'yes', 'yes', 'no'),
(36, 'laura_lospitao', 'lorena_ortega', 'No te olvides', '2020-06-01 18:16:58', 'yes', 'yes', 'no'),
(37, 'laura_lospitao', 'lorena_ortega', 'Te voy a mandar un entrenamiento', '2020-06-01 18:17:12', 'yes', 'yes', 'no'),
(38, 'laura_lospitao', 'tamara_rodriguez', 'Hola Laura', '2020-06-01 18:19:14', 'yes', 'yes', 'no'),
(39, 'laura_lospitao', 'tamara_rodriguez', 'Voy a entrenar un poco', '2020-06-01 18:19:20', 'yes', 'yes', 'no'),
(40, 'laura_lospitao', 'tamara_rodriguez', 'Hoy toca pata', '2020-06-01 18:19:29', 'yes', 'yes', 'no'),
(41, 'laura_lospitao', 'tamara_rodriguez', 'Y después un postre fit\r\n', '2020-06-01 18:19:35', 'yes', 'yes', 'no'),
(42, 'lucas_giovanolla', 'lorena_ortega', 'Hola de nuevo', '2020-06-02 10:52:56', 'yes', 'yes', 'no'),
(43, 'tamara_rodriguez', 'lucas_giovanolla', 'Hola Tamara\r\n', '2020-06-02 11:34:39', 'yes', 'yes', 'no'),
(44, 'tamara_rodriguez', 'lucas_giovanolla', '¿Qué tal el entreno?', '2020-06-02 11:34:46', 'yes', 'yes', 'no'),
(45, 'tamara_rodriguez', 'lucas_giovanolla', 'Más nunca estoy confinada!', '2020-06-02 11:35:05', 'yes', 'yes', 'no'),
(46, 'tamara_rodriguez', 'lucas_giovanolla', 'Que no... que es broma..', '2020-06-02 11:35:12', 'yes', 'yes', 'no'),
(47, 'lucas_giovanolla', 'jorge_sanchez', 'Hola Lucas\r\n', '2020-06-02 14:00:49', 'yes', 'yes', 'no'),
(48, 'laura_lospitao', 'lucas_giovanolla', 'Hola nena', '2020-06-02 14:01:41', 'yes', 'yes', 'no'),
(49, 'lucas_giovanolla', 'didi_rodriguez', 'Hola Lucas, cómo estás', '2020-06-02 14:14:40', 'yes', 'yes', 'no'),
(51, 'laura_lospitao', 'jorge_sanchez', 'hey', '2020-06-03 12:02:35', 'yes', 'yes', 'no'),
(52, 'laura_lospitao', 'jorge_sanchez', 'Qué tal?\r\n', '2020-06-03 12:09:00', 'yes', 'yes', 'no'),
(53, 'laura_lospitao', 'jorge_sanchez', 'Esto funciona como un tiro por lo que veo', '2020-06-03 12:09:11', 'yes', 'yes', 'no'),
(54, 'laura_lospitao', 'jorge_sanchez', 'Hola Laura, ya estoy saliendo', '2020-06-04 17:24:33', 'yes', 'yes', 'no'),
(55, 'laura_lospitao', 'jorge_sanchez', 'Venga esas birras!', '2020-06-04 17:24:41', 'yes', 'yes', 'no'),
(56, 'laura_lospitao', 'jorge_sanchez', 'A qué estamos esperando?', '2020-06-04 17:24:49', 'yes', 'yes', 'no'),
(57, 'lucas_giovanolla', 'brynn_boyd', 'Hola Lucas, mensaje 1', '2020-06-04 18:07:37', 'yes', 'yes', 'no'),
(58, 'lucas_giovanolla', 'carlos_lospitao', 'Hola Lucas, qué andas haciendo bribón', '2020-06-04 18:10:38', 'yes', 'yes', 'no'),
(59, 'laura_lospitao', 'lucas_giovanolla', 'Hoy hace fresquete', '2020-06-08 09:05:57', 'yes', 'yes', 'no'),
(60, 'laura_lospitao', 'lucas_giovanolla', 'Te echaré de menos en la comida', '2020-06-08 09:06:05', 'yes', 'yes', 'no'),
(61, 'carlos_lospitao', 'lucas_giovanolla', 'Hola', '2020-06-08 10:13:16', 'yes', 'yes', 'no'),
(62, 'lucas_giovanolla', 'laura_lospitao', 'Yo también a ti', '2020-06-08 10:25:16', 'yes', 'yes', 'no'),
(63, 'lorena_ortega', 'laura_lospitao', 'Hoy nos vemos\r\n', '2020-06-08 11:20:58', 'no', 'yes', 'no'),
(64, 'jorge_sanchez', 'carlos_lospitao', 'Hey tío\r\n', '2020-06-08 11:27:36', 'yes', 'yes', 'no'),
(65, 'jorge_sanchez', 'carlos_lospitao', '¿Qué pasa?', '2020-06-08 11:27:42', 'yes', 'yes', 'no'),
(66, 'carlos_lospitao', 'jorge_sanchez', 'Hola Carlos\r\n', '2020-06-08 11:31:00', 'yes', 'yes', 'no'),
(67, 'jorge_sanchez', 'carlos_lospitao', 'Hola tío', '2020-06-08 12:37:56', 'yes', 'yes', 'no'),
(68, 'jorge_sanchez', 'carlos_lospitao', 'Dónde andas?', '2020-06-08 12:38:02', 'yes', 'yes', 'no'),
(69, 'jorge_sanchez', 'lorena_ortega', 'Vente a comer a casa', '2020-06-08 12:38:18', 'yes', 'yes', 'no'),
(70, 'jorge_sanchez', 'lorena_ortega', 'Tenemos cookies', '2020-06-08 12:38:24', 'yes', 'yes', 'no'),
(71, 'jorge_sanchez', 'laura_lospitao', 'Esas birras fueron geniales', '2020-06-08 12:38:45', 'yes', 'yes', 'no'),
(72, 'jorge_sanchez', 'laura_lospitao', 'A ver si las repetimos pronto', '2020-06-08 12:38:50', 'yes', 'yes', 'no'),
(73, 'jorge_sanchez', 'laura_lospitao', 'pero en mi casa con pizza', '2020-06-08 12:38:57', 'yes', 'yes', 'no'),
(74, 'laura_lospitao', 'jorge_sanchez', 'Hola Laura', '2020-06-08 12:46:08', 'yes', 'yes', 'no'),
(75, 'laura_lospitao', 'jorge_sanchez', 'Cómo estás', '2020-06-08 12:46:13', 'yes', 'yes', 'no'),
(76, 'jorge_sanchez', 'laura_lospitao', 'Me voy en breve', '2020-06-08 12:57:58', 'yes', 'yes', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
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
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`) VALUES
(1, 'La virgen santa', 'tamara_rodriguez', 'none', '2020-05-07 18:09:32', 'no', 'no', 0),
(29, 'Hola', 'tamara_rodriguez', 'none', '2020-05-11 15:58:40', 'no', 'no', 0),
(30, 'prueba 1', 'tamara_rodriguez', 'none', '2020-05-11 16:01:23', 'no', 'no', 0),
(36, 'Vamos de fiesta', 'tamara_rodriguez', 'none', '2020-05-11 17:15:18', 'no', 'no', 0),
(39, 'Uno más', 'tamara_rodriguez', 'none', '2020-05-12 12:15:29', 'no', 'no', 0),
(40, 'Uno menos', 'tamara_rodriguez', 'none', '2020-05-12 12:15:33', 'no', 'no', 1),
(41, 'Uno menos', 'tamara_rodriguez', 'none', '2020-05-12 12:15:55', 'no', 'no', 0),
(42, 'Por favor que no se joda', 'tamara_rodriguez', 'none', '2020-05-12 12:27:55', 'no', 'no', 1),
(43, 'dasdasd', 'tamara_rodriguez', 'none', '2020-05-12 15:56:47', 'no', 'no', 1),
(45, 'Absolutely not', 'brynn_boyd', 'none', '2020-05-22 18:58:37', 'no', 'no', 0),
(62, 'Hola', 'tamara_rodriguez', 'none', '2020-05-26 10:57:00', 'no', 'no', 1),
(64, 'Prueba 2', 'tamara_rodriguez', 'none', '2020-05-26 11:24:46', 'no', 'no', 0),
(66, 'Posting from my profile', 'tamara_rodriguez', 'none', '2020-05-26 11:48:59', 'no', 'no', 0),
(69, 'Posting from my profile', 'tamara_rodriguez', 'none', '2020-05-26 12:05:06', 'no', 'no', 0),
(70, 'Contrast', 'tamara_rodriguez', 'none', '2020-05-26 12:05:39', 'no', 'no', 0),
(71, 'Contrast 2', 'tamara_rodriguez', '_lospitao', '2020-05-26 12:05:54', 'no', 'no', 1),
(80, 'Hoy he arreglado las tablas de MySQL', 'laura_lospitao', 'none', '2020-06-01 17:54:55', 'no', 'no', 0),
(81, 'Que ya era hora joder', 'laura_lospitao', 'none', '2020-06-01 17:55:02', 'no', 'no', 0),
(82, 'Porque empezaba a liarse demasiado la cosa\r\n', 'laura_lospitao', 'none', '2020-06-01 17:55:13', 'no', 'no', 0),
(83, 'Mi chica es Negative COVID', 'lucas_giovanolla', 'none', '2020-06-01 18:07:41', 'no', 'no', 0),
(84, 'Estoy haciendo gestiones', 'lucas_giovanolla', 'none', '2020-06-01 18:07:49', 'no', 'no', 0),
(85, 'Y mi chica va a hacer yoga', 'lucas_giovanolla', 'none', '2020-06-01 18:07:56', 'no', 'no', 0),
(86, 'Lorena está muy calladita', 'lorena_ortega', 'none', '2020-06-01 18:08:13', 'no', 'no', 0),
(87, 'Ya tengo foto de perfil', 'lorena_ortega', 'none', '2020-06-02 10:51:42', 'no', 'no', 0),
(88, 'Hola Lucas, hoy está nublado', 'lorena_ortega', 'lucas_giovanolla', '2020-06-02 10:52:13', 'no', 'no', 0),
(89, 'Esto ya tiene pintaca', 'jorge_sanchez', 'none', '2020-06-02 11:00:29', 'no', 'no', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
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
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(26, 'Laura', 'Lospitao', 'laura_lospitao', 'Laura@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-27', 'assets/images/profile_pics/laura_lospitao8c9f37e4265d5b47afa3c849f0a9a29fn.jpeg', 12, 1, 'no', ',mónica_aguado,brynn_boyd,lorena_ortega,lucas_giovanolla,jorge_sanchez,carlos_lospitao,'),
(27, 'Lucas', 'Giovanolla', 'lucas_giovanolla', 'Lucas@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-27', 'assets/images/profile_pics/lucas_giovanolla4d02f20ec6c1d9f8fa6b88f16effa1can.jpeg', 37, 2, 'no', ',mónica_aguado,brynn_boyd,laura_lospitao,lorena_ortega,jorge_sanchez,carlos_lospitao,didi_rodriguez,'),
(28, 'Lorena', 'Ortega', 'lorena_ortega', 'Lorena@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-27', 'assets/images/profile_pics/lorena_ortega580c4cc850c87c2fca2432d9930b3ec1n.jpeg', 7, 1, 'no', ',mónica_aguado,brynn_boyd,laura_lospitao,lucas_giovanolla,jorge_sanchez,carlos_lospitao,mónica_aguado,'),
(29, 'Carlos', 'Lospitao', 'carlos_lospitao', 'Carlos@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-27', 'assets/images/profile_pics/carlos_lospitaoe452383ee7c8d79559bf8fd6eef8a184n.jpeg', 3, 0, 'no', ',mónica_aguado,brynn_boyd,laura_lospitao,lorena_ortega,lucas_giovanolla,jorge_sanchez,'),
(30, 'George', 'Sanchez', 'jorge_sanchez', 'Jorge@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-27', 'assets/images/profile_pics/jorge_sanchez62cdcfd1d51cb8ed4e9d01a61c409c5cn.jpeg', 3, 1, 'no', ',mónica_aguado,brynn_boyd,laura_lospitao,lorena_ortega,lucas_giovanolla,carlos_lospitao,'),
(31, 'Tamara', 'Rodriguez', 'tamara_rodriguez', 'Tam@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-27', 'assets/images/profile_pics/tamara_rodriguezef65ea12138b2f794e1402ce5bfbd15bn.jpeg', 23, 5, 'no', ',mónica_aguado,brynn_boyd,laura_lospitao,lorena_ortega,lucas_giovanolla,jorge_sanchez,carlos_lospitao,'),
(33, 'Brynn', 'Boyd', 'brynn_boyd', 'Brynn@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-05-12', 'assets/images/profile_pics/brynn_boyd174091ec67dcee682acf14bc306d181cn.jpeg', 1, 0, 'no', ',mónica_aguado,laura_lospitao,lorena_ortega,lucas_giovanolla,jorge_sanchez,carlos_lospitao,mónica_aguado,'),
(35, 'Didi', 'Rodriguez', 'didi_rodriguez', 'Diana@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-06-02', 'assets/images/profile_pics/didi_rodriguez4fbd898b58aed8c4ddb7becc9e58af2bn.jpeg', 0, 0, 'no', ',mónica_aguado,lucas_giovanolla,');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
