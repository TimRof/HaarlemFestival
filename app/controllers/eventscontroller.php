<?php
require __DIR__ . '/controller.php';

class EventsController extends Controller
{
    public function index()
    {
        try {
            error_reporting(0);
            require __DIR__ . '/../views/events/index.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function food()
    {
        $_SESSION['filter'] = "food";
        require __DIR__ . '/../views/events/food.php';
    }
    public function history()
    {
        $_SESSION['filter'] = "history";
        require __DIR__ . '/../views/events/history.php';
    }
    public function jazz()
    {
        require __DIR__ . '/../views/events/jazz.php';
    }
    public function purchase()
    {
        require __DIR__ . '/../views/events/purchase.php';
    }
    public function getEventTypes()
    {
        $eventService = new EventService();
        $eventTypes = $eventService->getEventTypes();
        header("Content-type:application/json");
        echo json_encode(($eventTypes), JSON_PRETTY_PRINT);
    }
}
