-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-04-2020 a las 06:03:44
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.3.11

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
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `friend_array` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(20, 'Laura', 'Primera', '_primera', 'Laura@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-23', 'assets/images/profile_pics/default/shapeman.png', 0, 0, 'no', ','),
(21, 'Jorge', 'Sanchez', '_sanchez', 'Jorge@gmail.com', '670b14728ad9902aecba32e22fa4f6bd', '2020-04-23', 'assets/images/profile_pics/default/shapeman.png', 0, 0, 'no', ','),
(22, 'Lucas', 'Giovanolla', '_giovanolla', 'Lucas@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-23', 'assets/images/profile_pics/default/shapeman.png', 0, 0, 'no', ','),
(23, 'Brynn', 'Ann', '_ann', 'Brynn@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-23', 'assets/images/profile_pics/default/cartoonman.png', 0, 0, 'no', ','),
(24, 'Tamara', 'Rodriguez', '_rodriguez', 'Tam@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-04-23', 'assets/images/profile_pics/default/cartoonman.png', 0, 0, 'no', ',');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
