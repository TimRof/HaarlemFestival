<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/eventservice.php';
require_once '../models/event_overview.php';
require_once '../models/restaurant.php';
require_once '../models/tour_location.php';
require_once '../models/tour_stop.php';
require_once '../models/tour.php';
require_once '../models/venue.php';
require_once '../models/act.php';
require_once '../models/act_member.php';

class EventsController extends Controller
{
    public function index()
    {
        try {
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

    public function getRestaurant()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && is_numeric($_GET['id']) && isset($_SESSION['loggedin'])) {
            if ($_SESSION['permission'] > 1) {
                $eventService = new eventService();
                $restaurant = $eventService->getRestaurantById($_GET['id']);
                header("Content-type:application/json");
                echo json_encode(($restaurant), JSON_PRETTY_PRINT);
            }
        } else {
            $this->notFound();
        }
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
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_numeric($_POST['id']) && isset($_SESSION['loggedin'])) {
                if ($this->checkAdmin()) {
                    $content = array("id" => $_POST['id'], "title" => $this->clean($_POST['title']), "description" => $_POST['description'], "image" => $_POST['image']);
                    $eventOverview = new Event_Overview($content);

                    $eventService = new EventService();
                    if (!$eventService->updateEventOverview($eventOverview)) {
                        echo "Something went wrong, content not updated!";
                    }
                } else {
                    echo "You don't have the permissions to do this!";
                }
            } else {
                $this->notFound();
            }
        } catch (\Throwable $th) {
            echo "Something went wrong, content not updated!";
        }
    }

    public function getEventTypes()
    {
        $eventService = new EventService();
        $eventTypes = $eventService->getEventTypes();
        header("Content-type:application/json");
        echo json_encode(($eventTypes), JSON_PRETTY_PRINT);
    }

    public function getStops()
    {
        $eventService = new EventService();
        $stops = $eventService->getStops();
        header("Content-type:application/json");
        echo json_encode(($stops), JSON_PRETTY_PRINT);
    }
    public function getRestaurants()
    {
        $eventService = new EventService();
        $restaurants = $eventService->getRestaurants();
        header("Content-type:application/json");
        echo json_encode(($restaurants), JSON_PRETTY_PRINT);
    }
    public function getLimitedRestaurants()
    {
        try {
            if (is_numeric($_GET['limit'])) {
                $eventService = new EventService();
                $restaurants = $eventService->getLimitedRestaurants($_GET['limit']);
                header("Content-type:application/json");
                echo json_encode(($restaurants), JSON_PRETTY_PRINT);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function getLimitedStops()
    {
        try {
            if (is_numeric($_GET['limit'])) {
                $eventService = new EventService();
                $stops = $eventService->getLimitedStops($_GET['limit']);
                header("Content-type:application/json");
                echo json_encode(($stops), JSON_PRETTY_PRINT);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function getLimitedTours()
    {
        try {
            if (is_numeric($_GET['limit'])) {
                $eventService = new EventService();
                $tours = $eventService->getLimitedTours($_GET['limit']);
                header("Content-type:application/json");
                echo json_encode(($tours), JSON_PRETTY_PRINT);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function getLimitedActs()
    {
        try {
            if (is_numeric($_GET['limit'])) {
                $eventService = new EventService();
                $acts = $eventService->getLimitedActs($_GET['limit']);
                header("Content-type:application/json");
                echo json_encode(($acts), JSON_PRETTY_PRINT);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function getLimitedVenues()
    {
        try {
            if (is_numeric($_GET['limit'])) {
                $eventService = new EventService();
                $venues = $eventService->getLimitedVenues($_GET['limit']);
                header("Content-type:application/json");
                echo json_encode(($venues), JSON_PRETTY_PRINT);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function getVenues()
    {
        $eventService = new EventService();
        $venues = $eventService->getVenues();
        header("Content-type:application/json");
        echo json_encode(($venues), JSON_PRETTY_PRINT);
    }
    public function getTours()
    {
        $eventService = new EventService();
        $tours = $eventService->getTours();
        header("Content-type:application/json");
        echo json_encode(($tours), JSON_PRETTY_PRINT);
    }
    public function getActs()
    {
        $eventService = new EventService();
        $acts = $eventService->getActs();
        header("Content-type:application/json");
        echo json_encode(($acts), JSON_PRETTY_PRINT);
    }

    public function makeRestaurant()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->checkAdmin()) {
                $restaurant = new Restaurant($_POST['values']);
                $eventService = new EventService();
                try {
                    if ($eventService->addRestaurant($restaurant)) {
                        echo "Restaurant added!";
                    } else {
                        echo "Something went wrong!";
                    }
                } catch (\Throwable $th) {
                    echo "Something went wrong!";
                }
            } else {
                echo "You don't have the permissions to do this!";
            }
        } else {
            $this->notFound();
        }
    }
    public function makeRouteLocation()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->checkAdmin()) {
                $tour_location = new Tour_Location($_POST['values']);
                $eventService = new EventService();
                try {
                    if ($eventService->addRouteLocation($tour_location)) {
                        echo "Location added!";
                    } else {
                        echo "Something went wrong!";
                    }
                } catch (\Throwable $th) {
                    echo "Something went wrong!!";
                }
            } else {
                echo "You don't have the permissions to do this!";
            }
        } else {
            $this->notFound();
        }
    }
    public function makeJazzVenue()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->checkAdmin()) {
                $venue = new Venue($_POST['values']);
                $eventService = new EventService();
                try {
                    if ($eventService->makeJazzVenue($venue)) {
                        echo "Venue added!";
                    } else {
                        echo "Something went wrong!";
                    }
                } catch (\Throwable $th) {
                    echo "Something went wrong!!";
                }
            } else {
                echo "You don't have the permissions to do this!";
            }
        } else {
            $this->notFound();
        }
    }
    public function makeTour()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->checkAdmin()) {
                $tour = new Tour($_POST['tour']);
                $stops = [];
                foreach ($_POST['stops'] as $val) {
                    $stop = new Tour_Stop($val);
                    array_push($stops, $stop);
                }
                $eventService = new EventService();
                try {
                    if ($eventService->addTour($tour, $stops)) {
                        echo "Tour added!";
                    } else {
                        echo "Something went wrong!";
                    }
                } catch (\Throwable $th) {
                    echo "Something went wrong!!";
                }
            } else {
                echo "You don't have the permissions to do this!";
            }
        } else {
            $this->notFound();
        }
    }
    public function makeAct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->checkAdmin()) {
                $act = new Act($_POST['act']);
                $members = [];
                foreach ($_POST['members'] as $val) {
                    $member = new Act_Member($val);
                    array_push($members, $member);
                }
                $eventService = new EventService();
                try {
                    if ($eventService->addAct($act, $members)) {
                        echo "Act added!";
                    } else {
                        echo "Something went wrong!";
                    }
                } catch (\Throwable $th) {
                    echo "Something went wrong!!";
                }
            } else {
                echo "You don't have the permissions to do this!";
            }
        } else {
            $this->notFound();
        }
    }
}
