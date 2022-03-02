<?php

class Event
{
    private int $id;
    private string $name;
    private string $content;
    private Event_Type $eventType;

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
    public function getName(): string
    {
        return $this->name;
    }
    public function getContent(): string
    {
        return $this->content;
    }
    public function getEventType(): Event_Type
    {
        return $this->eventType;
    }
}
