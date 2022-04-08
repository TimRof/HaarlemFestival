-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 08, 2022 at 02:16 PM
-- Server version: 10.6.5-MariaDB-1:10.6.5+maria~focal
-- PHP Version: 8.0.15

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
-- Table structure for table `act`
--

CREATE TABLE `act` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `act`
--

INSERT INTO `act` (`id`, `name`, `description`, `location`) VALUES
(3, 'Test act', 'An act to show cascade delete', ':8080'),
(4, 'The Inholland Show', 'A really cool show!', 'Hal B');

-- --------------------------------------------------------

--
-- Table structure for table `act_member`
--

CREATE TABLE `act_member` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `act_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `act_member`
--

INSERT INTO `act_member` (`id`, `name`, `act_id`) VALUES
(3, 'Bye', 3),
(4, 'Mr Cool', 4);

-- --------------------------------------------------------

--
-- Table structure for table `event_overview`
--

CREATE TABLE `event_overview` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `image` varchar(250) NOT NULL,
  `event_type_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_overview`
--

INSERT INTO `event_overview` (`id`, `title`, `description`, `image`, `event_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Food Festival', '<p><strong>Haarlem </strong>is a city with an extensive selection of restaurants and bars offering a wide variety of food options. \r\n\r\nRanging from luxurious Michelin starred restaurants to bars for a quick bite. From international food to locally sourced meals, the Haarlem Festival offers something for everyone. \r\n\r\nThanks to the generosity of the participating venues, we will be able to show Haarlem’s wide variety and significance in the cultural food sector.\r\n\r\nCome taste what Haarlem has to offer in this years Food Festival!</p>', '/assets/img/f-123-HD-bananen-06-18.jpg', 1, '2022-03-03 08:39:37', '2022-04-08 13:11:11'),
(2, 'History Festival', '<p>A meeting place where different art forms, ideas and visitors meet, cross and overlap: tourists and students, old and new, brushstrokes and pixels, serious exploration and playful fun. \r\n\r\nThese encounters encourage you to look differently, discover things and thereby see more.</p>', '/assets/img/de-waag_17979_xl.jpg', 2, '2022-03-03 08:39:37', '2022-03-18 01:42:28'),
(3, 'Jazz Festival', '<p><strong>Haarlem </strong>has varius events where people feel the rythem and sing their soul out and if you would like to get a taste of that feeling this is where you need to be. The Haarlem Festival provides up and coming festivals where you can look at every event where you could participate in.</p>', '/assets/img/FVDE-0181-1024x683.jpg', 3, '2022-03-03 08:40:23', '2022-04-08 00:01:48');

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
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `description`, `country`, `city`, `zipcode`, `address`) VALUES
(1, 'Restaurant Mr. &amp; Mrs.fdf', 'Mr. &amp; Mrs. offers an ambiance where you feel at ease. Mr. creates delicious taste explosions with honest products and Mrs. complements the dishes with the best matching wines.', 'Netherlands', 'Haarlem', '2011 DB', 'Lange Veerstraat 4'),
(2, 'Ratatouille', 'Chef Jozua Jaring\'s successful Michelin restaurant in Haarlem is – just like Ratatouille – a mix of French cuisine in today\'s reality with an excellent price-quality ratio in an accessible environment in Haarlem.', 'Netherlands', 'Haarlem', '2011 CL', 'Spaarne 96'),
(3, 'ML in Haarlem', 'The restaurant of Mark and Liane Gratama is housed in an impressive national monument, right in the center of Haarlem. The Chef&amp;#039;s Bar, next to the open kitchen, is the place to watch the passionate chef at work.', 'Netherlands', 'Haarlem', '2011 DR', 'Kleine Houtstraat 70'),
(4, 'Restaurant Fris', 'A modern restaurant where chef Rick May presents dishes based on classic French cuisine, which he refines with worldwide influences. Taste the chef&amp;#039;s favorite signature dish, or the guilty pleasure.', 'Netherlands', 'Haarlem', '2012 BG', 'Twijnderslaan 7'),
(5, 'Specktakel', 'Specktakel is een uniek restaurant centraal gelegen in hartje Haarlem. Bij Specktakel eet je niet stilletjes. Niet alleen door de gezelligheid van uw gezelschap, maar ook door het internationale eten en de wereldse wijn waarvan u geniet.', 'Netherlands', 'Haarlem', '2011 HM', 'Spekstraat 4'),
(6, 'Café Brinkmann', 'Café Brinkmann has been a household name in Haarlem and the surrounding area since 1879. Good food, perfect coffee and staff who provide excellent service with verve and pleasure.', 'Netherlands', 'Haarlem', '2011 RC', 'Grote Markt 13'),
(7, 'Urban Frenchy Bistro Toujours', 'For an intimate, cozy and beautiful dinner with friends or family, take a seat in our beautiful restaurant area. With radiant daylight thanks to the domes on our roof. Which provide a magically beautiful light in the evening, when dining under the starry sky comes very close.', 'Netherlands', 'Haarlem', '2011 HL', 'Oude Groenmarkt 10-12'),
(8, 'The Golden Bull', 'A no-nonsense atmosphere, and high-quality steaks. All this in combination with a wide range of special wines. An experience where your tastes buds are extremely stimulated', 'Netherlands', 'Haarlem', '2011 TK', 'Zijlstraat 39');

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `language` varchar(50) NOT NULL,
  `stops` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`id`, `name`, `language`, `stops`) VALUES
(1, 'Test tour', 'Dutch', 3),
(5, 'English Tour', 'English', 3),
(6, 'Dutch Tour', 'Dutch', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tour_location`
--

CREATE TABLE `tour_location` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tour_location`
--

INSERT INTO `tour_location` (`id`, `name`, `description`, `country`, `city`, `zipcode`, `address`) VALUES
(1, 'Sint Bavokerk', 'The Grote Kerk or St.-Bavokerk is a Reformed Protestant church and former Catholic cathedral located on the central market square in the Dutch city of Haarlem. Another Haarlem church called the Cathedral of Saint Bavo now serves as the main cathedral for the Roman Catholic Diocese of Haarlem-Amsterdam.', 'Netherlands', 'Haarlem', '2011 RD', 'Grote Markt 22'),
(2, 'Molen De Adriaan', 'De Adriaan is a windmill in the Netherlands that burnt down in 1932 and was rebuilt in 2002. The original windmill dates from 1779 and the mill has been a distinctive part of the skyline of Haarlem for centuries.', 'Netherlands', 'Haarlem', '2011 AV', 'Papentorenvest 1A'),
(3, 'Town Hall Haarlem', 'The City Hall in Haarlem is the seat of the city\'s government. It was built in the 14th century replacing the Count\'s castle.', 'Netherlands', 'Haarlem', '2011 RD', 'Grote Markt 2'),
(4, 'Grote Markt', 'The Grote Markt is the central market square of Haarlem, Netherlands.', 'Netherlands', 'Haarlem', '2011 RD', 'Grote Markt'),
(5, 'Teylers Museum', 'Teylers Museum is an art, natural history, and science museum in Haarlem, Netherlands. Established in 1778, Teylers Museum was founded as a centre for contemporary art and science.', 'Netherlands', 'Haarlem', '2011 CH', 'Spaarne 16'),
(6, 'Amsterdamse Poort', 'The Amsterdamse Poort is an old city gate of Haarlem, Netherlands. It is located at the end of the old route from Amsterdam to Haarlem and the only gate left from the original twelve city gates.', 'Netherlands', 'Haarlem', '2011 BS', 'Amsterdam'),
(7, 'Haarlem Railway Station', 'Haarlem railway station is located in Haarlem in North Holland, Netherlands. The station opened at September 20, 1839, on the Amsterdam–Rotterdam railway, the first railway line in the Netherlands. The station building itself is a rijksmonument.', 'Netherlands', 'Haarlem', '2011 LR', 'Stationsplein 11 L');

-- --------------------------------------------------------

--
-- Table structure for table `tour_stop`
--

CREATE TABLE `tour_stop` (
  `stop_number` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `tour_location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tour_stop`
--

INSERT INTO `tour_stop` (`stop_number`, `tour_id`, `tour_location_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(1, 5, 2),
(2, 5, 4),
(3, 5, 3),
(1, 6, 1),
(2, 6, 6),
(3, 6, 3);

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
  `role_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password_hash`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'test@test.test', '$2y$10$wFTeI0X0akfH7pajIC5Wfe6T4nevYxG7x35Rp3J9.Qeayma0BxoqC', 1, '2022-03-03 08:37:39', '2022-04-07 19:24:42'),
(2, 'admin', 'admin', 'admin@admin.admin', '$2y$10$75wpiGOBOFEAnjiC1syvAu./kGkCI9Htl53KP.IJITPOF4UbhXGHu', 3, '2022-03-03 08:38:01', '2022-03-31 20:02:17'),
(4, 'Normal', 'Admin', 'normal@admin.com', '$2y$10$ywabXMKJ1fQZUHl..lH6ZuyiNmLZqLqA7aus9zlsU8JN0A0b6V.Ru', 2, '2022-04-07 19:32:22', '2022-04-08 13:11:48');

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
(1, 'user'),
(2, 'administrator'),
(3, 'superadministrator');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `name`, `description`, `country`, `city`, `zipcode`, `address`) VALUES
(1, 'Patronaat', 'Patronaat is one of the 10 largest alternative pop music halls in the Netherlands and was established in 1984.', 'Netherlands', 'Haarlem', '2013 DN', 'Zijlsingel 2');

-- --------------------------------------------------------

--
-- Table structure for table `venue_act`
--

CREATE TABLE `venue_act` (
  `venue_id` int(11) NOT NULL,
  `act_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `act`
--
ALTER TABLE `act`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `act_member`
--
ALTER TABLE `act_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `act_id` (`act_id`);

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
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_location`
--
ALTER TABLE `tour_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_stop`
--
ALTER TABLE `tour_stop`
  ADD KEY `tour_location_id` (`tour_location_id`),
  ADD KEY `tour_id` (`tour_id`);

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
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venue_act`
--
ALTER TABLE `venue_act`
  ADD KEY `act_id` (`act_id`),
  ADD KEY `venue_id` (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `act`
--
ALTER TABLE `act`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `act_member`
--
ALTER TABLE `act_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tour`
--
ALTER TABLE `tour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tour_location`
--
ALTER TABLE `tour_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `act_member`
--
ALTER TABLE `act_member`
  ADD CONSTRAINT `act_member_ibfk_1` FOREIGN KEY (`act_id`) REFERENCES `act` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_overview`
--
ALTER TABLE `event_overview`
  ADD CONSTRAINT `event_overview_ibfk_1` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`);

--
-- Constraints for table `tour_stop`
--
ALTER TABLE `tour_stop`
  ADD CONSTRAINT `tour_stop_ibfk_1` FOREIGN KEY (`tour_location_id`) REFERENCES `tour_location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tour_stop_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tour` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);

--
-- Constraints for table `venue_act`
--
ALTER TABLE `venue_act`
  ADD CONSTRAINT `venue_act_ibfk_1` FOREIGN KEY (`act_id`) REFERENCES `act` (`id`),
  ADD CONSTRAINT `venue_act_ibfk_2` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
