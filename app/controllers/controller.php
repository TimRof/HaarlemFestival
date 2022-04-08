<?php
abstract class Controller
{
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
    public function noPermissions()
    {
        require "../views/error/403.php";
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
    function printJSON($object)
    {
        header("Content-type:application/json");
        echo json_encode(($object), JSON_PRETTY_PRINT);
    }
}
