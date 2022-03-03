<?php

require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/event_type.php';
//require __DIR__ . '/../models/event.php';

class EventRepository extends Repository
{
    public function getEventTypes()
    {
        $sql = 'SELECT * FROM event_type';

        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getEventOverview($id)
    {
        $sql = 'SELECT * FROM event_overview WHERE event_type_id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

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
        SET title = :title, description = :description
        WHERE id = :id';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(':id', $eventOverview->id, PDO::PARAM_STR);
        $stmt->bindValue(':description', $eventOverview->description, PDO::PARAM_STR);
        $stmt->bindValue(':title', $eventOverview->title, PDO::PARAM_STR);
        return $stmt->execute();
        // return var_dump($eventOverview);
    }
}
