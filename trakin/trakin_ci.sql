-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 02, 2019 at 06:14 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `trakin_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$J9xV1I7gGpIk/n2fC.acvea8RoerNI5Zj66U0qYiZ/Is6RTNQTaVy', 'Admin', '2019-08-02 00:45:24', '2015-12-25 10:35:16', '2015-12-25 10:35:16'),
(5, 'test@gmail.com', '$2y$10$50IJzp.1YNatBGNVuhfv2.LkRONBAx.x/qsOyp9sQA.DIPUrVoO.C', 'Teja Varma es', '2019-08-02 23:09:56', '2019-08-02 00:29:10', '2019-08-02 00:29:10'),
(11, 'poipoi@poi.poi', '$2y$10$K5xcXDQFppG673Ylp0mt3.BGRzXUePFQhJRPGiuj3QjEVnCFyBYbq', 'poipoi', '2019-08-02 19:28:29', '2019-08-02 19:28:29', '2019-08-02 19:28:29'),
(12, 'mnb@mn.com', '$2y$10$OrnT/VDZoPJ/ue4GJoiiaeX4YJFUgOdF2fhtIk5xQN1Anj3ZLzffW', 'lkj', '2019-08-02 19:36:21', '2019-08-02 19:36:21', '2019-08-02 19:36:21'),
(13, 'teja@gmail.com', '$2y$10$J9xV1I7gGpIk/n2fC.acvea8RoerNI5Zj66U0qYiZ/Is6RTNQTaVy', 'jai Varmamnbm', '2019-08-02 21:30:02', '2019-08-02 11:36:30', '2019-08-02 11:36:30'),
(14, 'admin', '$2y$10$J9xV1I7gGpIk/n2fC.acvea8RoerNI5Zj66U0qYiZ/Is6RTNQTaVy', 'Admin', '2019-08-02 00:45:24', '2015-12-25 10:35:16', '2015-12-25 10:35:16'),
(15, 'test@gmail.com', '$2y$10$J9xV1I7gGpIk/n2fC.acvea8RoerNI5Zj66U0qYiZ/Is6RTNQTaVy', 'Teja Varma', '2019-08-02 20:43:17', '2019-08-02 00:29:10', '2019-08-02 00:29:10'),
(16, 'teja@gmail.com', '$2y$10$J9xV1I7gGpIk/n2fC.acvea8RoerNI5Zj66U0qYiZ/Is6RTNQTaVy', 'jai Varma', '2019-08-02 20:25:55', '2019-08-02 11:36:30', '2019-08-02 11:36:30'),
(17, 'poipoi@poi.poi', '$2y$10$K5xcXDQFppG673Ylp0mt3.BGRzXUePFQhJRPGiuj3QjEVnCFyBYbq', 'poipoi', '2019-08-02 19:28:29', '2019-08-02 19:28:29', '2019-08-02 19:28:29'),
(18, 'mnb@mn.com', '$2y$10$OrnT/VDZoPJ/ue4GJoiiaeX4YJFUgOdF2fhtIk5xQN1Anj3ZLzffW', 'lkj', '2019-08-02 19:36:21', '2019-08-02 19:36:21', '2019-08-02 19:36:21'),
(19, 'teja@gmail.com', '$2y$10$J9xV1I7gGpIk/n2fC.acvea8RoerNI5Zj66U0qYiZ/Is6RTNQTaVy', 'jai Varmamnbm', '2019-08-02 20:25:55', '2019-08-02 11:36:30', '2019-08-02 11:36:30'),
(20, 'testing@gmail.com', '$2y$10$p5mutxdifMUqu6B4rQ3J1eZ/567ZehyFFtMgbyKMxk6tcmjPKHUnK', 'user1', '2019-08-02 23:10:45', '2019-08-02 21:40:15', '2019-08-02 21:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `users_authentication`
--

CREATE TABLE `users_authentication` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_authentication`
--

INSERT INTO `users_authentication` (`id`, `users_id`, `token`, `expired_at`, `created_at`, `updated_at`) VALUES
(1, 5, '$2y$10$kiDk8ewBKiyd6SpHgw3wA.ci4cfAOVZ4JUnV8abPfM/JXGIHVYOXa', '2019-08-02 13:59:26', '2019-08-02 00:29:26', '2019-08-02 00:29:26'),
(2, 5, '$2y$10$mr36v/I9g/.z8RFU272kWOccPvhsR8lTL/vNHt57TbpU0UM2SzlsG', '2019-08-02 13:59:42', '2019-08-02 00:29:42', '2019-08-02 00:29:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`email`);

--
-- Indexes for table `users_authentication`
--
ALTER TABLE `users_authentication`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users_authentication`
--
ALTER TABLE `users_authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;
