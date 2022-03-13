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
    public function getRestaurants()
    {
        return $this->repository->getRestaurants();
    }
    public function getVenues()
    {
        return $this->repository->getVenues();
    }
    public function getTours()
    {
        return $this->repository->getTours();
    }
    public function getActs()
    {
        return $this->repository->getActs();
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
    public function addAct($act, $members){
        $id = $this->repository->addAct($act);
        return $this->repository->addActMembers($id, $members);
    }
}
