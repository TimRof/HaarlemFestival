<?php

require __DIR__ . '/../repositories/eventrepository.php';

class EventService
{

    private $repository;

    function __construct()
    {
        $this->repository = new EventRepository();
    }

    public function getEventTypes()
    {
        return $this->repository->getEventTypes();
    }
    public function getEventOverview($id)
    {
        return $this->repository->getEventOverview($id);
    }
    public function insert($event)
    {
        return $this->repository->insert($event);
    }
}
