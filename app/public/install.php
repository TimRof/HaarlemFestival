<?php
require '../dbconfig.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);


if ($type == "mysql") {
    try {
        echo "Creating Database...<br><br>";
        $connection = new PDO("$type:host=$servername", $username, $password);
        $sql = "CREATE DATABASE haarlemfestival";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Database added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    echo "*** Adding tables & Data ***<br><br>";
    try {
        echo "Creating Table: Event_Overview...<br><br>";
        $connection = new PDO("$type:host=$servername;dbname=$database", $username, $password);
        $sql = "CREATE TABLE `event_overview` (
            `id` int(11) NOT NULL,
            `title` varchar(150) NOT NULL,
            `description` varchar(10000) NOT NULL,
            `image` varchar(250) NOT NULL,
            `event_type_id` int(11) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Inserting into Table: Event_Overview...<br><br>";
        $sql = "INSERT INTO `event_overview` (`id`, `title`, `description`, `image`, `event_type_id`,`created_at`, `updated_at`) VALUES
        (1, 'Food Festival', 'Haarlem is a city with an extensive selection of restaurants and bars offering a wide variety of food options. \r\n\r\nRanging from luxurious Michelin starred restaurants to bars for a quick bite. From international food to locally sourced meals, the Haarlem Festival offers something for everyone. \r\n\r\nThanks to the generosity of the participating venues, we will be able to show Haarlem’s wide variety and significance in the cultural food sector.\r\n\r\nCome taste what Haarlem has to offer in this years Food Festival!', '/assets/img/khUIP9O.jpeg', 1, '2022-03-03 08:39:37', '2022-03-03 08:41:24'),
        (2, 'History Festival', 'A meeting place where different art forms, ideas and visitors meet, cross and overlap: tourists and students, old and new, brushstrokes and pixels, serious exploration and playful fun. \r\n\r\nThese encounters encourage you to look differently, discover things and thereby see more.', '/assets/img/de-waag_17979_xl.jpg', 2, '2022-03-03 08:39:37', '2022-03-03 08:41:44'),
        (3, 'Jazz Festival', 'Haarlem has varius events where people feel the rythem and sing their soul out and if you would like to get a taste of that feeling this is where you need to be. The Haarlem Festival provides up and coming festivals where you can look at every event where you could participate in.', '/assets/img/FVDE-0181-1024x683.jpg', 3, '2022-03-03 08:40:23', '2022-03-03 08:41:56');";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Data added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: Event_Type...<br><br>";
        $sql = "CREATE TABLE `event_type` (
            `id` int(11) NOT NULL,
            `name` varchar(50) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Inserting into Table: Event_Type...<br><br>";
        $sql = "INSERT INTO `event_type` (`id`, `name`) VALUES
        (1, 'Food'),
        (2, 'History'),
        (3, 'Jazz');";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Data added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: User...<br><br>";
        $sql = "CREATE TABLE `user` (
            `id` int(11) NOT NULL,
            `first_name` varchar(50) NOT NULL,
            `last_name` varchar(50) NOT NULL,
            `email` varchar(50) NOT NULL,
            `password_hash` varchar(255) NOT NULL,
            `role_id` int(11) NOT NULL DEFAULT 1,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Inserting into Table: User...<br><br>";
        $sql = "INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password_hash`, `role_id`, `created_at`, `updated_at`) VALUES
        (1, 'test', 'test', 'test@test.test', '$2y$10\$EkJS8EPjdNCYEbWWP6qgF.iC0eGZpoaVfSMErucqR2UOsJIC2Epx2', 1, '2022-03-03 08:37:39', '0000-00-00 00:00:00'),
        (2, 'admin', 'admin', 'admin@admin.admin', '$2y$10\$UWRMysUltXaa3iXDxTAlOuA6RBSMoEMdQI/6cPW2LX55i0CTWQsAe', 3, '2022-03-03 08:38:01', '0000-00-00 00:00:00');";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Data added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: User_Role...<br><br>";
        $sql = "CREATE TABLE `user_role` (
            `id` int(11) NOT NULL,
            `name` varchar(50) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Inserting into Table: User_Role...<br><br>";
        $sql = "INSERT INTO `user_role` (`id`, `name`) VALUES
        (1, 'user'),
        (2, 'administrator'),
        (3, 'superadministrator');";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Data added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    echo "*** Adding Indexes ***<br><br>";
    try {
        echo "Adding index for: Event_Overview...<br><br>";
        $sql = "ALTER TABLE `event_overview`
        ADD PRIMARY KEY (`id`),
        ADD KEY `event_type_id` (`event_type_id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Indexes added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding index for: Event_Type...<br><br>";
        $sql = "ALTER TABLE `event_type`
        ADD PRIMARY KEY (`id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Indexes added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding index for: User...<br><br>";
        $sql = "ALTER TABLE `user`
        ADD PRIMARY KEY (`id`),
        ADD KEY `role_id` (`role_id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Indexes added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding index for: User_Role...<br><br>";
        $sql = "ALTER TABLE `user_role`
        ADD PRIMARY KEY (`id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Indexes added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    echo "*** Adding Auto-Increment ***<br><br>";
    try {
        echo "Adding A-I for: Event_Overview...<br><br>";
        $sql = "ALTER TABLE `event_overview`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: A-I added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding A-I for: Event_Type...<br><br>";
        $sql = "ALTER TABLE `event_type`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: A-I added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding A-I for: User...<br><br>";
        $sql = "ALTER TABLE `user`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: A-I added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding A-I for: User_Role...<br><br>";
        $sql = "ALTER TABLE `user_role`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: A-I added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    echo "*** Adding Constraints ***<br><br>";
    try {
        echo "Adding constraints for: Event_Overview...<br><br>";
        $sql = "ALTER TABLE `event_overview`
        ADD CONSTRAINT `event_overview_ibfk_1` FOREIGN KEY (`event_type_id`) REFERENCES `event_type` (`id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Constraints added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding constraints for: User...<br><br>";
        $sql = "ALTER TABLE `user`
        ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Constraints added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: Act...<br><br>";
        $sql = "CREATE TABLE `act` (
            `id` int(11) NOT NULL,
            `name` varchar(50) NOT NULL,
            `description` varchar(10000) DEFAULT NULL,
            `location` varchar(50) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: Act_Member...<br><br>";
        $sql = "CREATE TABLE `act_member` (
            `id` int(11) NOT NULL,
            `name` varchar(50) NOT NULL,
            `act_id` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: Restaurant...<br><br>";
        $sql = "CREATE TABLE `restaurant` (
            `id` int(11) NOT NULL,
            `name` varchar(250) NOT NULL,
            `description` varchar(10000) NOT NULL,
            `country` varchar(50) NOT NULL,
            `city` varchar(50) NOT NULL,
            `zipcode` varchar(25) NOT NULL,
            `address` varchar(50) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Inserting into Table: Restaurant...<br><br>";
        $sql = "INSERT INTO `restaurant` (`id`, `name`, `description`, `country`, `city`, `zipcode`, `address`) VALUES
        (1, 'Restaurant Mr. & Mrs.', 'Mr. & Mrs. offers an ambiance where you feel at ease. Mr. creates delicious taste explosions with honest products and Mrs. complements the dishes with the best matching wines.', 'Netherlands', 'Haarlem', '2011 DB', 'Lange Veerstraat 4'),
        (2, 'Ratatouille', 'Chef Jozua Jaring\'s successful Michelin restaurant in Haarlem is – just like Ratatouille – a mix of French cuisine in today\'s reality with an excellent price-quality ratio in an accessible environment in Haarlem.', 'Netherlands', 'Haarlem', '2011 CL', 'Spaarne 96'),
        (3, 'ML in Haarlem', 'The restaurant of Mark and Liane Gratama is housed in an impressive national monument, right in the center of Haarlem. The Chef\'s Bar, next to the open kitchen, is the place to watch the passionate chef at work.', 'Netherlands', 'Haarlem', '2011 DR', 'Kleine Houtstraat 70'),
        (4, 'Restaurant Fris', 'A modern restaurant where chef Rick May presents dishes based on classic French cuisine, which he refines with worldwide influences. Taste the chef\'s favorite signature dish, or the guilty pleasure.', 'Netherlands', 'Haarlem', '2012 BG', 'Twijnderslaan 7'),
        (5, 'Specktakel', 'Specktakel is een uniek restaurant centraal gelegen in hartje Haarlem. Bij Specktakel eet je niet stilletjes. Niet alleen door de gezelligheid van uw gezelschap, maar ook door het internationale eten en de wereldse wijn waarvan u geniet.', 'Netherlands', 'Haarlem', '2011 HM', 'Spekstraat 4'),
        (6, 'Café Brinkmann', 'Café Brinkmann has been a household name in Haarlem and the surrounding area since 1879. Good food, perfect coffee and staff who provide excellent service with verve and pleasure.', 'Netherlands', 'Haarlem', '2011 RC', 'Grote Markt 13'),
        (7, 'Urban Frenchy Bistro Toujours', 'For an intimate, cozy and beautiful dinner with friends or family, take a seat in our beautiful restaurant area. With radiant daylight thanks to the domes on our roof. Which provide a magically beautiful light in the evening, when dining under the starry sky comes very close.', 'Netherlands', 'Haarlem', '2011 HL', 'Oude Groenmarkt 10-12'),
        (8, 'The Golden Bull', 'A no-nonsense atmosphere, and high-quality steaks. All this in combination with a wide range of special wines. An experience where your tastes buds are extremely stimulated', 'Netherlands', 'Haarlem', '2011 TK', 'Zijlstraat 39');";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Data added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: Tour...<br><br>";
        $sql = "CREATE TABLE `tour` (
            `id` int(11) NOT NULL,
            `name` varchar(250) NOT NULL,
            `language` varchar(50) NOT NULL,
            `stops` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: Tour_Location...<br><br>";
        $sql = "CREATE TABLE `tour_location` (
            `id` int(11) NOT NULL,
            `name` varchar(250) NOT NULL,
            `description` varchar(10000) NOT NULL,
            `country` varchar(50) NOT NULL,
            `city` varchar(50) NOT NULL,
            `zipcode` varchar(25) NOT NULL,
            `address` varchar(50) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Inserting into Table: Tour_Location...<br><br>";
        $sql = "INSERT INTO `tour_location` (`id`, `name`, `description`, `country`, `city`, `zipcode`, `address`) VALUES
        (1, 'Sint Bavokerk', 'The Grote Kerk or St.-Bavokerk is a Reformed Protestant church and former Catholic cathedral located on the central market square in the Dutch city of Haarlem. Another Haarlem church called the Cathedral of Saint Bavo now serves as the main cathedral for the Roman Catholic Diocese of Haarlem-Amsterdam.', 'Netherlands', 'Haarlem', '2011 RD', 'Grote Markt 22'),
        (2, 'Molen De Adriaan', 'De Adriaan is a windmill in the Netherlands that burnt down in 1932 and was rebuilt in 2002. The original windmill dates from 1779 and the mill has been a distinctive part of the skyline of Haarlem for centuries.', 'Netherlands', 'Haarlem', '2011 AV', 'Papentorenvest 1A'),
        (3, 'Town Hall Haarlem', 'The City Hall in Haarlem is the seat of the city\'s government. It was built in the 14th century replacing the Count\'s castle.', 'Netherlands', 'Haarlem', '2011 RD', 'Grote Markt 2'),
        (4, 'Grote Markt', 'The Grote Markt is the central market square of Haarlem, Netherlands.', 'Netherlands', 'Haarlem', '2011 RD', 'Grote Markt'),
        (5, 'Teylers Museum', 'Teylers Museum is an art, natural history, and science museum in Haarlem, Netherlands. Established in 1778, Teylers Museum was founded as a centre for contemporary art and science.', 'Netherlands', 'Haarlem', '2011 CH', 'Spaarne 16'),
        (6, 'Amsterdamse Poort', 'The Amsterdamse Poort is an old city gate of Haarlem, Netherlands. It is located at the end of the old route from Amsterdam to Haarlem and the only gate left from the original twelve city gates.', 'Netherlands', 'Haarlem', '2011 BS', 'Amsterdam'),
        (7, 'Haarlem Railway Station', 'Haarlem railway station is located in Haarlem in North Holland, Netherlands. The station opened at September 20, 1839, on the Amsterdam–Rotterdam railway, the first railway line in the Netherlands. The station building itself is a rijksmonument.', 'Netherlands', 'Haarlem', '2011 LR', 'Stationsplein 11 L');";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Data added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: Tour_Stop...<br><br>";
        $sql = "CREATE TABLE `tour_stop` (
            `stop_number` int(11) NOT NULL,
            `tour_id` int(11) NOT NULL,
            `tour_location_id` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: Venue...<br><br>";
        $sql = "CREATE TABLE `venue` (
            `id` int(11) NOT NULL,
            `name` varchar(50) NOT NULL,
            `description` varchar(10000) NOT NULL,
            `country` varchar(50) NOT NULL,
            `city` varchar(50) NOT NULL,
            `zipcode` varchar(25) NOT NULL,
            `address` varchar(50) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Inserting into Table: Venue...<br><br>";
        $sql = "INSERT INTO `venue` (`id`, `name`, `description`, `country`, `city`, `zipcode`, `address`) VALUES
        (1, 'Patronaat', 'Patronaat is one of the 10 largest alternative pop music halls in the Netherlands and was established in 1984.', 'Netherlands', 'Haarlem', '2013 DN', 'Zijlsingel 2');";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Data added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: Venue_Act...<br><br>";
        $sql = "CREATE TABLE `venue_act` (
            `venue_id` int(11) NOT NULL,
            `act_id` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding index for: Act...<br><br>";
        $sql = "ALTER TABLE `act`
        ADD PRIMARY KEY (`id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Indexes added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding index for: Act_Member...<br><br>";
        $sql = "ALTER TABLE `act_member`
        ADD PRIMARY KEY (`id`),
        ADD KEY `act_id` (`act_id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Indexes added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding index for: Restaurant...<br><br>";
        $sql = "ALTER TABLE `restaurant`
        ADD PRIMARY KEY (`id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Indexes added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding index for: Tour...<br><br>";
        $sql = "ALTER TABLE `tour`
        ADD PRIMARY KEY (`id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Indexes added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding index for: Tour_Location...<br><br>";
        $sql = "ALTER TABLE `tour_location`
        ADD PRIMARY KEY (`id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Indexes added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding index for: Tour_Stop...<br><br>";
        $sql = "ALTER TABLE `tour_stop`
        ADD KEY `tour_location_id` (`tour_location_id`),
        ADD KEY `tour_id` (`tour_id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Indexes added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding index for: Venue...<br><br>";
        $sql = "ALTER TABLE `venue`
        ADD PRIMARY KEY (`id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Indexes added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding index for: Venue_Act...<br><br>";
        $sql = "ALTER TABLE `venue_act`
        ADD KEY `act_id` (`act_id`),
        ADD KEY `venue_id` (`venue_id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Indexes added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding A-I for: Act...<br><br>";
        $sql = "ALTER TABLE `act`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: A-I added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding A-I for: Act_Member...<br><br>";
        $sql = "ALTER TABLE `act_member`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: A-I added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding A-I for: Restaurant...<br><br>";
        $sql = "ALTER TABLE `restaurant`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: A-I added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding A-I for: Tour...<br><br>";
        $sql = "ALTER TABLE `tour`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: A-I added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding A-I for: Tour_Location...<br><br>";
        $sql = "ALTER TABLE `tour_location`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: A-I added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding A-I for: Venue...<br><br>";
        $sql = "ALTER TABLE `venue`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: A-I added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding constraints for: Act_Member...<br><br>";
        $sql = "ALTER TABLE `act_member`
        ADD CONSTRAINT `act_member_ibfk_1` FOREIGN KEY (`act_id`) REFERENCES `act` (`id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Constraints added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding constraints for: Tour_Stop...<br><br>";
        $sql = "ALTER TABLE `tour_stop`
        ADD CONSTRAINT `tour_stop_ibfk_1` FOREIGN KEY (`tour_location_id`) REFERENCES `tour_location` (`id`),
        ADD CONSTRAINT `tour_stop_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tour` (`id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Constraints added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Adding constraints for: Venue_Act...<br><br>";
        $sql = "ALTER TABLE `venue_act`
        ADD CONSTRAINT `venue_act_ibfk_1` FOREIGN KEY (`act_id`) REFERENCES `act` (`id`),
        ADD CONSTRAINT `venue_act_ibfk_2` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Constraints added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
     try {
        echo "Creating Table: Event_Tour...<br><br>";
        $sql = "CREATE TABLE `event_tour` (
            `tour_id` int(11) NOT NULL,
            `event_id` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
          $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $connection->exec($sql);
          echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
     try {
         echo "Insert data: Event_Tour...<br><br>";
         $sql = "INSERT INTO `event_tour` (`tour_id`, `event_id`) VALUES
         (1, 1);";
         $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $connection->exec($sql);
         echo "Success: Data inserted! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }

    try {
        echo "Creating Table: Tour...<br><br>";
        $sql = "CREATE TABLE `tour` (
            `id` int(11) NOT NULL,
            `name` varchar(255) NOT NULL,
            'language' varchar(255) NOT NULL,
            'stops' int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
          $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $connection->exec($sql);
          echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
         echo "Insert data: Tour...<br><br>";
         $sql = "INSERT INTO `tour` (`id`, `name`, 'language', 'stops') VALUES
         (1, 'Frans Hals Musea Tour', 'Chinese', '2');";
         $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $connection->exec($sql);
         echo "Success: Data inserted! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: Tour_stops...<br><br>";
        $sql = "CREATE TABLE `tour_stops` (
            `stop_number` int(11) NOT NULL,
            `tour_id` int(11) NOT NULL,
            'tour_location_id' int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
          $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $connection->exec($sql);
          echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
         echo "Insert data: Tour_stops...<br><br>";
         $sql = "INSERT INTO `tour_stops` (`stop_number`, `tour_id`, 'tour_location_id') VALUES
         ('1', 1, 1);";
         $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $connection->exec($sql);
         echo "Success: Data inserted! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }

      try {
        echo "Creating Table: Tour_location...<br><br>";
        $sql = "CREATE TABLE `tour_location` (
            `id` int(11) NOT NULL,
            `name` varchar(255) NOT NULL,
            'description' varchar(255) NOT NULL,
            'country' varchar(255) NOT NULL,
            'city' varchar(255) NOT NULL,
            'zipcode' varchar(255) NOT NULL,
            'address' varchar(255) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
          $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $connection->exec($sql);
          echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
         echo "Insert data: Tour_location...<br><br>";
         $sql = "INSERT INTO `tour_location` (`id`, `name`, 'description', 'country', 'city', 'zipcode', 'address') VALUES
         (1, 'Tour', 'A musea tour', 'The Netherlands', 'Haarlem', '1122AB', 'InhollStreet');";
         $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $connection->exec($sql);
         echo "Success: Data inserted! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: Event...<br><br>";
        $sql = "CREATE TABLE `event` (
            `id` int(11) NOT NULL,
            `name` varchar(255) NOT NULL,
            `capacity` varchar(10) NOT NULL,
            `date` datetime NOT NULL,
            `price` int(10) NOT NULL,
            `content` varchar(255) NOT NULL,
            `thumbnail` varchar(255) NOT NULL,
            `created_at` datetime NOT NULL,
            `updated_at` datetime NOT NULL,
            `event_type_id` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Insert data: Event...<br><br>";
        $sql = "INSERT INTO `event` (`id`, `name`, `capacity`, `date`, `price`, `content`, `thumbnail`, `created_at`, `updated_at`, `event_type_id`) VALUES
        (1, 'Gumbo Kings', '300', '2022-04-28 18:00:00', 15, 'The Gumbo Kings are five-headed Soul Monster that combines the groove of New Orleans Funk with the grittiness of Delta Blues and the melodies of Memphis Soul.', '', '2022-03-10 10:58:57', '2022-03-10 10:58:57', 3),
        (2, 'Fox & The Mayors', '300', '2022-04-28 18:00:00', 15, 'Fox & The Mayors might be mayors but they are know to make memerable events, that leave people in wonder if they even have jobs next to making music.', '', '2022-03-17 13:30:38', '2022-03-17 13:30:38', 2);";
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec($sql);
        echo "Success: Data inserted! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
        echo "Creating Table: Event_location...<br><br>";
        $sql = "CREATE TABLE `event_location` (
            `id` int(11) NOT NULL,
            `country` varchar(255) NOT NULL,
            `address` varchar(255) NOT NULL,
            `zipcode` varchar(255) NOT NULL,
            `act_id` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
          $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $connection->exec($sql);
          echo "Success: Table added! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
    try {
         echo "Insert data: Event_location...<br><br>";
         $sql = "INSERT INTO `event_location` (`id`, `country`, `address`, `zipcode`, `act_id`) VALUES
         (1, 'Netherlands', 'Zijlsingel 2', '2013 DN Haarlem', 1);";
         $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $connection->exec($sql);
         echo "Success: Data inserted! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
} else {
    echo "Wrong database type..";
}
