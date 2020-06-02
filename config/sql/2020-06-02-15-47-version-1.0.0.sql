-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2020 at 03:47 PM
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
(27, 'tamara_rodriguez', 'laura_lospitao', 'Hola Tam', '2020-06-01 17:49:09', 'no', 'no', 'no'),
(28, 'tamara_rodriguez', 'laura_lospitao', 'Qué tal', '2020-06-01 17:49:16', 'no', 'no', 'no'),
(29, 'tamara_rodriguez', 'laura_lospitao', 'A ver si damos negativo', '2020-06-01 17:49:23', 'no', 'no', 'no'),
(30, 'tamara_rodriguez', 'laura_lospitao', 'Y de una puta vez se acaba esta mierda', '2020-06-01 17:49:32', 'no', 'no', 'no'),
(31, 'lucas_giovanolla', 'lorena_ortega', 'Hola Lucas, qué tal estás?', '2020-06-01 18:16:18', 'no', 'no', 'no'),
(32, 'lucas_giovanolla', 'lorena_ortega', 'Yo muy bien', '2020-06-01 18:16:23', 'no', 'no', 'no'),
(33, 'lucas_giovanolla', 'lorena_ortega', 'Aquí andamos', '2020-06-01 18:16:27', 'no', 'no', 'no'),
(34, 'laura_lospitao', 'lorena_ortega', 'Hola Laura', '2020-06-01 18:16:43', 'no', 'no', 'no'),
(35, 'laura_lospitao', 'lorena_ortega', 'Tenemos Pendiente una cena', '2020-06-01 18:16:53', 'no', 'no', 'no'),
(36, 'laura_lospitao', 'lorena_ortega', 'No te olvides', '2020-06-01 18:16:58', 'no', 'no', 'no'),
(37, 'laura_lospitao', 'lorena_ortega', 'Te voy a mandar un entrenamiento', '2020-06-01 18:17:12', 'no', 'no', 'no'),
(38, 'laura_lospitao', 'tamara_rodriguez', 'Hola Laura', '2020-06-01 18:19:14', 'no', 'no', 'no'),
(39, 'laura_lospitao', 'tamara_rodriguez', 'Voy a entrenar un poco', '2020-06-01 18:19:20', 'no', 'no', 'no'),
(40, 'laura_lospitao', 'tamara_rodriguez', 'Hoy toca pata', '2020-06-01 18:19:29', 'no', 'no', 'no'),
(41, 'laura_lospitao', 'tamara_rodriguez', 'Y después un postre fit\r\n', '2020-06-01 18:19:35', 'no', 'no', 'no'),
(42, 'lucas_giovanolla', 'lorena_ortega', 'Hola de nuevo', '2020-06-02 10:52:56', 'no', 'no', 'no'),
(43, 'tamara_rodriguez', 'lucas_giovanolla', 'Hola Tamara\r\n', '2020-06-02 11:34:39', 'no', 'no', 'no'),
(44, 'tamara_rodriguez', 'lucas_giovanolla', '¿Qué tal el entreno?', '2020-06-02 11:34:46', 'no', 'no', 'no'),
(45, 'tamara_rodriguez', 'lucas_giovanolla', 'Más nunca estoy confinada!', '2020-06-02 11:35:05', 'no', 'no', 'no'),
(46, 'tamara_rodriguez', 'lucas_giovanolla', 'Que no... que es broma..', '2020-06-02 11:35:12', 'no', 'no', 'no'),
(47, 'lucas_giovanolla', 'jorge_sanchez', 'Hola Lucas\r\n', '2020-06-02 14:00:49', 'no', 'no', 'no'),
(48, 'laura_lospitao', 'lucas_giovanolla', 'Hola nena', '2020-06-02 14:01:41', 'no', 'no', 'no'),
(49, 'lucas_giovanolla', 'didi_rodriguez', 'Hola Lucas, cómo estás', '2020-06-02 14:14:40', 'no', 'no', 'no'),
(50, 'mónica_aguado', 'didi_rodriguez', 'Yo también soy nueva por aquí', '2020-06-02 14:15:04', 'no', 'no', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
