<?php

class EventOverview
{
    // private int $id;
    // private string $title;
    // private string $description;
    // private Event_Type $eventType;

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getEventType(): Event_Type
    {
        return $this->eventType;
    }
}
