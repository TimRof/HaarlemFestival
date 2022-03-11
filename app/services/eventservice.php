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
    public function updateEventOverview($eventOverview)
    {
        return $this->repository->updateEventOverview($eventOverview);
    }
    public function addRestaurant($restaurant){
        return $this->repository->addRestaurant($restaurant);
    }
}
