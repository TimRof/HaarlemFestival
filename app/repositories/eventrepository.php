<?php

require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/event_type.php';
require_once __DIR__ . '/../models/event.php';
require_once __DIR__ . '/../models/event_overview.php';

class EventRepository extends Repository
{
    public function getEventTypes()
    {
        $sql = 'SELECT * FROM event_type';

        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event_Type');

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getStops()
    {
        $sql = 'SELECT * FROM tour_location';

        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Tour_Location');

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getLimitedStops($limit)
    {
        $sql = 'SELECT * FROM `tour_location` order by id desc limit :limit, 5';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Tour_Location');

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getRestaurants()
    {
        $sql = 'SELECT * FROM restaurant';

        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getRestaurantById($id)
    {
        $sql = 'SELECT * FROM restaurant  WHERE id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');

        $stmt->execute();

        return $stmt->fetch();
    }
    public function getLimitedRestaurants($limit)
    {
        $sql = 'SELECT *, (SELECT count(*) from restaurant) as count FROM `restaurant` order by id desc limit :limit, 5';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function searchRestaurants($limit, $query)
    {
        $sql = 'SELECT *, (SELECT count(*) from restaurant WHERE name LIKE :name OR zipcode LIKE :zipcode OR address LIKE :address) as count FROM restaurant WHERE name LIKE :name OR zipcode LIKE :zipcode OR address LIKE :address order by id desc limit :limit, 5';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':name', $query, PDO::PARAM_STR);
        $stmt->bindValue(':zipcode', $query, PDO::PARAM_STR);
        $stmt->bindValue(':address', $query, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');

        //var_dump($stmt);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getVenues()
    {
        $sql = 'SELECT * FROM venue';

        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getLimitedVenues($limit)
    {
        $sql = 'SELECT * FROM `venue` order by id desc limit :limit, 5';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'venue');

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getTours()
    {
        $sql = 'SELECT * FROM tour';

        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Tour');

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getLimitedTours($limit)
    {
        $sql = 'SELECT * FROM `tour` order by id desc limit :limit, 5';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Tour');

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getActs()
    {
        $sql = 'SELECT * FROM act';

        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'act');

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getLimitedActs($limit)
    {
        $sql = 'SELECT * FROM `act` order by id desc limit :limit, 5';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'act');

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getEventOverview($id)
    {
        $sql = 'SELECT * FROM event_overview WHERE event_type_id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'event_overview');

        $stmt->execute();

        return $stmt->fetch();
    }
    public function insert($event)
    {
        $sql = 'INSERT INTO events (name, content, event_type) VALUES (:name, :content, :event_type)';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(':name', $event->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':content', $event->getContent(), PDO::PARAM_STR);
        $stmt->bindValue(':event_type', $event->getEventType->getId(), PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function updateEventOverview($eventOverview)
    {
        $sql = 'UPDATE event_overview
        SET title = :title, description = :description, image = :image
        WHERE id = :id';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(':id', $eventOverview->id, PDO::PARAM_STR);
        $stmt->bindValue(':description', $eventOverview->description, PDO::PARAM_STR);
        $stmt->bindValue(':title', $eventOverview->title, PDO::PARAM_STR);
        $stmt->bindValue(':image', $eventOverview->image, PDO::PARAM_STR);
        return $stmt->execute();
    }
    public function addRestaurant($restaurant)
    {
        $sql = 'INSERT INTO restaurant (name, description, country, city, zipcode, address) VALUES (:name, :description, :country, :city, :zipcode, :address)';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(':name', $restaurant->name, PDO::PARAM_STR);
        $stmt->bindValue(':description', $restaurant->description, PDO::PARAM_STR);
        $stmt->bindValue(':country', $restaurant->country, PDO::PARAM_STR);
        $stmt->bindValue(':city', $restaurant->city, PDO::PARAM_STR);
        $stmt->bindValue(':zipcode', $restaurant->zipcode, PDO::PARAM_STR);
        $stmt->bindValue(':address', $restaurant->address, PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function addRouteLocation($location)
    {
        $sql = 'INSERT INTO tour_location (name, description, country, city, zipcode, address) VALUES (:name, :description, :country, :city, :zipcode, :address)';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(':name', $location->name, PDO::PARAM_STR);
        $stmt->bindValue(':description', $location->description, PDO::PARAM_STR);
        $stmt->bindValue(':country', $location->country, PDO::PARAM_STR);
        $stmt->bindValue(':city', $location->city, PDO::PARAM_STR);
        $stmt->bindValue(':zipcode', $location->zipcode, PDO::PARAM_STR);
        $stmt->bindValue(':address', $location->address, PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function makeJazzVenue($venue)
    {
        $sql = 'INSERT INTO venue (name, description, country, city, zipcode, address) VALUES (:name, :description, :country, :city, :zipcode, :address)';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(':name', $venue->name, PDO::PARAM_STR);
        $stmt->bindValue(':description', $venue->description, PDO::PARAM_STR);
        $stmt->bindValue(':country', $venue->country, PDO::PARAM_STR);
        $stmt->bindValue(':city', $venue->city, PDO::PARAM_STR);
        $stmt->bindValue(':zipcode', $venue->zipcode, PDO::PARAM_STR);
        $stmt->bindValue(':address', $venue->address, PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function addTour($tour)
    {
        $sql = 'INSERT INTO tour (name, language, stops) VALUES (:name, :language, :stops)';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(':name', $tour->name, PDO::PARAM_STR);
        $stmt->bindValue(':language', $tour->language, PDO::PARAM_STR);
        $stmt->bindValue(':stops', $tour->stops, PDO::PARAM_STR);

        $stmt->execute();
        return $this->connection->lastInsertId();
    }
    public function addTourStops($id, $stops)
    {
        // make one sql string from all stops
        $string = 'INSERT INTO tour_stop (stop_number, tour_id, tour_location_id) VALUES ';
        for ($i = 0; $i < count($stops); $i++) {
            $string .= "(:stop_number$i, :tour_id$i, :tour_location_id$i), ";
        }
        $sql = substr($string, 0, -2);

        $stmt = $this->connection->prepare($sql);

        $i = 0;
        foreach ($stops as $stop) {
            $stmt->bindValue(":stop_number$i", $stop->stop_number, PDO::PARAM_STR);
            $stmt->bindValue(":tour_id$i", $id, PDO::PARAM_STR);
            $stmt->bindValue(":tour_location_id$i", $stop->tour_location_id, PDO::PARAM_STR);
            $i++;
        }

        return $stmt->execute();
    }
    public function addAct($act)
    {
        $sql = 'INSERT INTO act (name, description, location) VALUES (:name, :description, :location)';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(':name', $act->name, PDO::PARAM_STR);
        $stmt->bindValue(':description', $act->description, PDO::PARAM_STR);
        $stmt->bindValue(':location', $act->location, PDO::PARAM_STR);

        $stmt->execute();
        return $this->connection->lastInsertId();
    }
    public function addActMembers($id, $members)
    {
        // make one sql string from all members
        $string = 'INSERT INTO act_member (name, act_id) VALUES ';
        for ($i = 0; $i < count($members); $i++) {
            $string .= "(:name$i, :act_id$i), ";
        }
        $sql = substr($string, 0, -2);

        $stmt = $this->connection->prepare($sql);

        $i = 0;
        foreach ($members as $member) {
            $stmt->bindValue(":name$i", $member->name, PDO::PARAM_STR);
            $stmt->bindValue(":act_id$i", $id, PDO::PARAM_STR);
            $i++;
        }

        return $stmt->execute();
    }
}
