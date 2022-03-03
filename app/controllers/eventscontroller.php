<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/eventservice.php';
require_once '../models/event_overview.php';

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
    public function getEventOverview()
    {
        if (is_numeric($_GET['id'])) {
            $id = $_GET['id'];

            $eventService = new EventService();
            $eventOverview = $eventService->getEventOverview($id);
            header("Content-type:application/json");
            echo json_encode(($eventOverview), JSON_PRETTY_PRINT);
        }
    }
    public function updateContent()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_numeric($_POST['id'])) {
                $content = array("id" => $_POST['id'], "title" => $this->clean($_POST['title']), "description" => $_POST['description']);
                $eventOverview = new EventOverview($content);

                $eventService = new EventService();
                // var_dump($content);
                $eventService->updateEventOverview($eventOverview);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
