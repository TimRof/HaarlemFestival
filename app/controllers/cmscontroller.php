<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/userservice.php';
require_once __DIR__ . '/../services/eventservice.php';

class CmsController extends Controller
{
    public function index()
    {
        try {
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                unset($_SESSION['email']);
            }
            error_reporting(0);
            require __DIR__ . '/../views/cms/index.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function manage()
    {
        try {
            error_reporting(0);
            require __DIR__ . '/../views/cms/manage.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function users()
    {
        try {
            error_reporting(0);
            require __DIR__ . '/../views/cms/users.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function adduser()
    {
        try {
            error_reporting(0);
            require __DIR__ . '/../views/cms/adduser.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userService = new UserService();
            $user = $userService->login($this->clean($_POST['email']), $_POST['password']);
            if ($user) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user->id;
                $_SESSION['permission'] = $user->role_id;
                $this->redirect('/cms/success');
            } else {
                $_SESSION['email'] = $this->clean($_POST['email']);
                $this->redirect('/cms');
            }
        } else {
            require __DIR__ . '/../views/cms/login.php';
        }
    }

    public function logout()
    {
        try {
            session_start();
            $_SESSION = array();
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }
            session_destroy();
            $this->redirect('/cms/success');
        } catch (\Throwable $th) {
            $this->notFound();
            die();
        }
    }

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User($_POST);
            $userService = new UserService();
            try {
                if ($userService->insert($user)) {
                    $user = $userService->findByEmail($user->getEmail());
                    $this->redirect('/cms/success');
                } else {
                    $this->redirect('/cms/failed');
                }
            } catch (\Throwable $th) {
                echo "<pre>";
                echo $th;
                echo "</pre>";
                $this->redirect('/cms/failed');
            }
        } else {
            $this->notFound();
        }
    }

    public function success()
    {
        require __DIR__ . '/../views/cms/success.php';
    }
    public function failed()
    {
        require __DIR__ . '/../views/cms/failed.php';
    }

    public function getEventTypes()
    {
        $eventService = new EventService();
        $eventTypes = $eventService->getEventTypes();
        header("Content-type:application/json");
        echo json_encode(($eventTypes), JSON_PRETTY_PRINT);
    }

    public function getUsers()
    {
        $userService = new UserService();
        $users = $userService->getUsers();
        header("Content-type:application/json");
        echo json_encode(($users), JSON_PRETTY_PRINT);
    }
}
