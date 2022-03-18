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
                $this->printJSON($restaurant);
            }
        } else {
            $this->notFound();
        }
    }
    public function getVenue()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && is_numeric($_GET['id']) && isset($_SESSION['loggedin'])) {
            if ($_SESSION['permission'] > 1) {
                $eventService = new eventService();
                $venue = $eventService->getVenueById($_GET['id']);
                $this->printJSON($venue);
            }
        } else {
            $this->notFound();
        }
    }
    public function getTourLocation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && is_numeric($_GET['id']) && isset($_SESSION['loggedin'])) {
            if ($_SESSION['permission'] > 1) {
                $eventService = new eventService();
                $location = $eventService->getTourLocationById($_GET['id']);
                $this->printJSON($location);
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
            $this->printJSON($eventOverview);
        }
    }
    public function updateRestaurant()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_numeric($_POST['id'])) {
                if ($this->checkSuperAdmin()) {
                    $content = array("id" => $_POST['id'], "name" => $this->clean($_POST['name']), "description" => $this->clean($_POST['description']), "country" => $this->clean($_POST['country']), "city" => $this->clean($_POST['city']), "zipcode" => $this->clean($_POST['zipcode']), "address" => $this->clean($_POST['address']));

                    $restaurant = new Restaurant($content);
                    $eventService = new EventService();

                    if ($eventService->updateRestaurant($restaurant)) {
                        echo "Restaurant updated!";
                    } else {
                        echo "Something went wrong!";
                    }
                } else {
                    echo "You don't have the permissions to do this!";
                }
            } else {
                $this->notFound();
            }
        } catch (\Throwable $th) {
            echo "Something went wrong!!";
        }
    }
    public function updateVenue()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_numeric($_POST['id'])) {
                if ($this->checkSuperAdmin()) {
                    $content = array("id" => $_POST['id'], "name" => $this->clean($_POST['name']), "description" => $this->clean($_POST['description']), "country" => $this->clean($_POST['country']), "city" => $this->clean($_POST['city']), "zipcode" => $this->clean($_POST['zipcode']), "address" => $this->clean($_POST['address']));

                    $venue = new Venue($content);
                    $eventService = new EventService();

                    if ($eventService->updateVenue($venue)) {
                        echo "Venue updated!";
                    } else {
                        echo "Something went wrong!";
                    }
                } else {
                    echo "You don't have the permissions to do this!";
                }
            } else {
                $this->notFound();
            }
        } catch (\Throwable $th) {
            echo "Something went wrong!!";
        }
    }
    public function updateTourLocation()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_numeric($_POST['id'])) {
                if ($this->checkSuperAdmin()) {
                    $content = array("id" => $_POST['id'], "name" => $this->clean($_POST['name']), "description" => $this->clean($_POST['description']), "country" => $this->clean($_POST['country']), "city" => $this->clean($_POST['city']), "zipcode" => $this->clean($_POST['zipcode']), "address" => $this->clean($_POST['address']));

                    $location = new Tour_Location($content);
                    $eventService = new EventService();

                    if ($eventService->updateTourLocation($location)) {
                        echo "Tour location updated!";
                    } else {
                        echo "Something went wrong!";
                    }
                } else {
                    echo "You don't have the permissions to do this!";
                }
            } else {
                $this->notFound();
            }
        } catch (\Throwable $th) {
            echo "Something went wrong!!";
        }
    }
    function deleteRestaurant()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_numeric($_POST['id'])) {
                if ($this->checkSuperAdmin()) {
                    $eventService = new EventService();
                    if ($eventService->deleteRestaurant($_POST['id'])) {
                        echo "Restaurant deleted!";
                    } else {
                        echo "Something went wrong, content not deleted!";
                    }
                } else {
                    echo "You don't have the permissions to do this!";
                }
            } else {
                $this->notFound();
            }
        } catch (\Throwable $th) {
            echo "Something went wrong!!";
        }
    }
    function deleteTourLocation()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_numeric($_POST['id'])) {
                if ($this->checkSuperAdmin()) {
                    $eventService = new EventService();
                    if ($eventService->deleteTourLocation($_POST['id'])) {
                        echo "Tour location deleted!";
                    } else {
                        echo "Something went wrong, content not deleted!";
                    }
                } else {
                    echo "You don't have the permissions to do this!";
                }
            } else {
                $this->notFound();
            }
        } catch (\Throwable $th) {
            echo "Something went wrong!!";
        }
    }
    function deleteVenue()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_numeric($_POST['id'])) {
                if ($this->checkSuperAdmin()) {
                    $eventService = new EventService();
                    if ($eventService->deleteVenue($_POST['id'])) {
                        echo "Venue deleted!";
                    } else {
                        echo "Something went wrong, content not deleted!";
                    }
                } else {
                    echo "You don't have the permissions to do this!";
                }
            } else {
                $this->notFound();
            }
        } catch (\Throwable $th) {
            echo "Something went wrong!!";
        }
    }
    public function updateContent()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_numeric($_POST['id']) && isset($_SESSION['loggedin'])) {
                if ($this->checkAdmin()) {
                    if (isset($_POST['oldFileName'])) {
                        $image = $_POST['oldFileName'];
                    } else {
                        $image = '#';
                    }

                    if (!isset($_POST['fileUpload'])) {
                        $upload = $this->checkImage();
                        if (!$upload) {
                            echo $upload;
                            return;
                        } else {
                            if (isset($_POST['oldFileName'])) {
                                $oldFile = substr($_POST['oldFileName'], 1);
                                if (file_exists($oldFile)) {
                                    unlink($oldFile);
                                }
                            }
                            $image = '/assets/img/' . basename($_FILES["fileUpload"]["name"]);
                        }
                    }
                    $content = array("id" => $_POST['id'], "title" => $this->clean($_POST['title']), "description" => $_POST['description'], "image" => $image);
                    $eventOverview = new Event_Overview($content);

                    $eventService = new EventService();
                    if ($eventService->updateEventOverview($eventOverview)) {
                        echo "Content updated!";
                    } else {
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
    private function checkImage()
    {
        try {
            $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
            if ($check !== false) {
                $target_dir = "assets/img/";
                $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "File already exists, please check image or rename.";
                    return;
                }
                // Check file size
                if ($_FILES["fileUpload"]["size"] > 500000) {
                    echo "Upload image is too large (500KB limit).";
                    return;
                }
                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    echo "Only JPG, JPEG, PNG & GIF files are allowed.";
                    return;
                }
                if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                    return true;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "File is not an image.";
            }
        } catch (\Throwable $th) {
            echo "Something went wrong!!";
        }
    }

    public function getEventTypes()
    {
        $eventService = new EventService();
        $eventTypes = $eventService->getEventTypes();
        $this->printJSON($eventTypes);
    }

    public function getStops()
    {
        $eventService = new EventService();
        $stops = $eventService->getStops();
        $this->printJSON($stops);
    }
    public function getRestaurants()
    {
        $eventService = new EventService();
        $restaurants = $eventService->getRestaurants();
        $this->printJSON($restaurants);
    }
    public function getLimitedRestaurants()
    {
        try {
            if (is_numeric($_GET['limit'])) {
                $eventService = new EventService();
                $restaurants = $eventService->getLimitedRestaurants($_GET['limit']);
                $this->printJSON($restaurants);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function searchRestaurants()
    {
        try {
            if (is_numeric($_GET['limit'])) {
                $eventService = new EventService();
                $restaurants = $eventService->searchRestaurants($_GET['limit'], '%' . $_GET['query'] . '%');
                $this->printJSON($restaurants);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function searchVenues()
    {
        try {
            if (is_numeric($_GET['limit'])) {
                $eventService = new EventService();
                $venue = $eventService->searchVenues($_GET['limit'], '%' . $_GET['query'] . '%');
                $this->printJSON($venue);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function searchTourLocations()
    {
        try {
            if (is_numeric($_GET['limit'])) {
                $eventService = new EventService();
                $locations = $eventService->searchTourLocations($_GET['limit'], '%' . $_GET['query'] . '%');
                $this->printJSON($locations);
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
                $this->printJSON($stops);
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
                $this->printJSON($tours);
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
                $this->printJSON($acts);
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
                $this->printJSON($venues);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function getVenues()
    {
        $eventService = new EventService();
        $venues = $eventService->getVenues();
        $this->printJSON($venues);
    }
    public function getTours()
    {
        $eventService = new EventService();
        $tours = $eventService->getTours();
        $this->printJSON($tours);
    }
    public function getActs()
    {
        $eventService = new EventService();
        $acts = $eventService->getActs();
        $this->printJSON($acts);
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
