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
    public function jazzacts()
    {
        try {
            require __DIR__ . '/../views/cms/jazzacts.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function tours()
    {
        try {
            require __DIR__ . '/../views/cms/tours.php';
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
    public function events()
    {
        try {
            require __DIR__ . '/../views/cms/events.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function addactivities()
    {
        try {
            require __DIR__ . '/../views/cms/addactivities.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function restaurants()
    {
        try {
            require __DIR__ . '/../views/cms/restaurants.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function venues()
    {
        try {
            require __DIR__ . '/../views/cms/venues.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function tourlocations()
    {
        try {
            require __DIR__ . '/../views/cms/tourlocations.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function accountinfo()
    {
        try {
            require __DIR__ . '/../views/cms/accountinfo.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function changepassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userService = new UserService();
            if ($userService->resetPassword($_POST['old'], $_POST['new'])) {
                echo true;
            } else {
                echo false;
            }
            return;
        }
        try {
            require __DIR__ . '/../views/cms/changepassword.php';
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

    public function signout()
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
            if ($_SESSION['permission'] > 1) {
                $user = new User($_POST);
                $userService = new UserService();
                try {
                    $result = $userService->insert($user);
                    if ($result === true) {
                        $user = $userService->findByEmail($user->email);
                        $this->redirect('/cms/success');
                    } else {
                        $this->redirect('/cms/failed');
                    }
                } catch (\Throwable $th) {
                    $this->redirect('/cms/failed');
                }
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
        $this->printJSON($users);
    }
    public function getOwnInfo()
    {
        $userService = new UserService();
        $user = $userService->getOwnInfo();
        $this->printJSON($user);
    }
    public function findById()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && is_numeric($_GET['id']) && isset($_SESSION['loggedin'])) {
            if ($_SESSION['permission'] > 1) {
                $userService = new UserService();
                $user = $userService->findById($_GET['id']);
                $this->printJSON($user);
            }
        } else {
            $this->notFound();
        }
    }

    public function getRoleTypes()
    {
        $userService = new UserService();
        $roleTypes = $userService->getRoleTypes();
        $this->printJSON($roleTypes);
    }

    public function updateUser()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_numeric($_POST['id']) && is_numeric($_POST['role_id'])) {
                if ($this->checkSuperAdmin()) {

                    $content = array("id" => $_POST['id'], "first_name" => $this->clean($_POST['first_name']), "last_name" => $this->clean($_POST['last_name']), "email" => $this->clean($_POST['email']), "role_id" => $this->clean($_POST['role_id']));

                    $user = new User($content);
                    $userService = new UserService();

                    if ($userService->updateUser($user)) {
                        echo "User updated!";
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
    function updateSelf()
    {
        try {
            $content = array("first_name" => $this->clean($_POST['first_name']), "last_name" => $this->clean($_POST['last_name']), "email" => $this->clean($_POST['email']));
            $user = new User($content);
            $userService = new UserService();
            if ($userService->updateSelf($user)) {
                echo "Updated!";
            } else {
                echo "Something went wrong!";
            }
        } catch (\Throwable $th) {
            echo "Something went wrong!!";
        }
    }
    function deleteUser()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && is_numeric($_POST['id'])) {
                if ($this->checkSuperAdmin()) {
                    $userService = new UserService();
                    if ($userService->deleteUser($_POST['id'])) {
                        echo "User deleted!";
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
    public function test()
    {
        require __DIR__ . '/../views/cms/test.php';
    }
}
