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
        (1, 'Food Festival', 'Haarlem is a city with an extensive selection of restaurants and bars offering a wide variety of food options. \r\n\r\nRanging from luxurious Michelin starred restaurants to bars for a quick bite. From international food to locally sourced meals, the Haarlem Festival offers something for everyone. \r\n\r\nThanks to the generosity of the participating venues, we will be able to show Haarlem’s wide variety and significance in the cultural food sector.\r\n\r\nCome taste what Haarlem has to offer in this years Food Festival!', 'https://i.imgur.com/khUIP9O.jpeg', 1, '2022-03-03 08:39:37', '2022-03-03 08:41:24'),
        (2, 'History Festival', 'A meeting place where different art forms, ideas and visitors meet, cross and overlap: tourists and students, old and new, brushstrokes and pixels, serious exploration and playful fun. \r\n\r\nThese encounters encourage you to look differently, discover things and thereby see more.', 'https://i.imgur.com/QxuAnpp.jpeg', 2, '2022-03-03 08:39:37', '2022-03-03 08:41:44'),
        (3, 'Jazz Festival', 'Haarlem has varius events where people feel the rythem and sing their soul out and if you would like to get a taste of that feeling this is where you need to be. The Haarlem Festival provides up and coming festivals where you can look at every event where you could participate in.', 'https://www.haarlemjazzandmore.nl/wp-content/uploads/2019/08/FVDE-0181-1024x683.jpg', 3, '2022-03-03 08:40:23', '2022-03-03 08:41:56');";
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
        echo "Creating Table: Event...<br><br>";
        $sql = "CREATE TABLE `event` (
            `id` int(11) NOT NULL,
            `name` varchar(50) NOT NULL,
            `capacity` varchar(10) NOT NULL,
            `date` datetime NOT NULL,
            `price` int(10) NOT NULL,
            `content` varchar(255) NOT NULL,
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
        $sql = "INSERT INTO `event` 
        (`id`, `name`, `capacity`, `date`, `price`, `content`, `created_at`, `updated_at`, `event_type_id`) 
        VALUES
        (1, 'Gumbo Kings', '300', '2022-04-28 18:00:00', 15, 'The Gumbo Kings are five-headed Soul Monster that combines the groove of New Orleans Funk with the grittiness of Delta Blues and the melodies of Memphis Soul.', '2022-03-10 10:58:57', '2022-03-10 10:58:57', 3);";
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
         (1, 'Netherlands', 'Zijlsingel 2', '2013 DN Haarlem', 0);";
         $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $connection->exec($sql);
         echo "Success: Data inserted! <br><br><br>";
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage() . "<br><br><br>";
    }
} else {


    echo "Done!";
}
