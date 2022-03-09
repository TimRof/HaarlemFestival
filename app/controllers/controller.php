<?php
abstract class Controller
{
    function displayView($model)
    {
        // source: https://github.com/ahrnuld/Routing

        $directory = strtolower(substr(get_class($this), 0, -10));
        $view = debug_backtrace()[1]['function'];
        require __DIR__ . "/../views/$directory/$view.php";
    }
    public function redirect($url)
    {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . $url, true, 303);
        exit;
    }
    public function notFound()
    {
        require "../views/error/index.php";
        die();
    }
    // sanitize form data
    function clean($data)
    {
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }
    function checkAdmin()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['permission'] > 1) {
            return true;
        } else {
            return false;
        }
    }
    function checkSuperAdmin()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['permission'] > 2) {
            return true;
        } else {
            return false;
        }
    }
}
