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
            require __DIR__ . '/../views/cms/index.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function manage()
    {
        try {
            require __DIR__ . '/../views/cms/manage.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function users()
    {
        try {
            require __DIR__ . '/../views/cms/users.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function adduser()
    {
        try {
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

    public function getUsers()
    {
        $userService = new UserService();
        $users = $userService->getUsers();
        header("Content-type:application/json");
        echo json_encode(($users), JSON_PRETTY_PRINT);
    }
    public function findById()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && is_numeric($_GET['id']) && isset($_SESSION['loggedin'])) {
            if ($_SESSION['permission'] > 1) {
                $userService = new UserService();
                $user = $userService->findById($_GET['id']);
                header("Content-type:application/json");
                echo json_encode(($user), JSON_PRETTY_PRINT);
            }
        }
    }

    public function getRoleTypes()
    {
        $userService = new UserService();
        $eventTypes = $userService->getRoleTypes();
        header("Content-type:application/json");
        echo json_encode(($eventTypes), JSON_PRETTY_PRINT);
    }

    public function updateContent()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'PUT' && is_numeric($_POST['id']) && is_numeric($_POST['role_id']) && isset($_SESSION['loggedin'])) {
                if ($_SESSION['permission'] > 1) {
                    $content = array("id" => $_POST['id'], "first_name" => $this->clean($_POST['first_name']), "last_name" => $this->clean($_POST['last_name']), "email" => $this->clean($_POST['email']),);
                    $user = new User($content);

                    $userService = new UserService();
                    if (!$userService->updateUser($user)) {
                        echo "Something went wrong, content not updated!";
                    }
                } else {
                    echo "You don't have the permissions to do this!
Content not updated.";
                }
            }
        } catch (\Throwable $th) {
            echo "Something went wrong, content not updated!";
        }
    }
}
