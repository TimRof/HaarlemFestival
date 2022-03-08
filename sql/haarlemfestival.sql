-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 03, 2022 at 08:42 AM
-- Server version: 10.6.5-MariaDB-1:10.6.5+maria~focal
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haarlemfestival`
--

-- --------------------------------------------------------

--
-- Table structure for table `event_overview`
--

CREATE TABLE `event_overview` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `event_type_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_overview`
--

INSERT INTO `event_overview` (`id`, `title`, `description`, `event_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Food Festival', 'Haarlem is a city with an extensive selection of restaurants and bars offering a wide variety of food options. \r\n\r\nRanging from luxurious Michelin starred restaurants to bars for a quick bite. From international food to locally sourced meals, the Haarlem Festival offers something for everyone. \r\n\r\nThanks to the generosity of the participating venues, we will be able to show Haarlem’s wide variety and significance in the cultural food sector.\r\n\r\nCome taste what Haarlem has to offer in this years Food Festival!', 1, '2022-03-03 08:39:37', '2022-03-03 08:41:24'),
(2, 'History Festival', 'A meeting place where different art forms, ideas and visitors meet, cross and overlap: tourists and students, old and new, brushstrokes and pixels, serious exploration and playful fun. \r\n\r\nThese encounters encourage you to look differently, discover things and thereby see more.', 2, '2022-03-03 08:39:37', '2022-03-03 08:41:44'),
(3, 'Jazz Festival', 'Haarlem has varius events where people feel the rythem and sing their soul out and if you would like to get a taste of that feeling this is where you need to be. The Haarlem Festival provides up and coming festivals where you can look at every event where you could participate in.', 3, '2022-03-03 08:40:23', '2022-03-03 08:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_type`
--

INSERT INTO `event_type` (`id`, `name`) VALUES
(1, 'Food'),
(2, 'History'),
(3, 'Jazz');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password_hash`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'test@test.test', '$2y$10$EkJS8EPjdNCYEbWWP6qgF.iC0eGZpoaVfSMErucqR2UOsJIC2Epx2', 2, '2022-03-03 08:37:39', '0000-00-00 00:00:00'),
(2, 'admin', 'admin', 'admin@admin.admin', '$2y$10$UWRMysUltXaa3iXDxTAlOuA6RBSMoEMdQI/6cPW2LX55i0CTWQsAe', 2, '2022-03-03 08:38:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event_overview`
--
ALTER TABLE `event_overview`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_type_id` (`event_type_id`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event_overview`
--
ALTER TABLE `event_overview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_overview`
--
ALTER TABLE `event_overview`
  ADD CONSTRAINT `event_overview_ibfk_1` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
