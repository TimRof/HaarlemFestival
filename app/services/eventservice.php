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
    public function getStops()
    {
        return $this->repository->getStops();
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
    public function makeJazzVenue($location){
        return $this->repository->makeJazzVenue($location);
    }
    public function addRouteLocation($location){
        return $this->repository->addRouteLocation($location);
    }
    public function addTour($tour, $stops){
        $id = $this->repository->addTour($tour);
        return $this->repository->addTourStops($id, $stops);
    }
}
