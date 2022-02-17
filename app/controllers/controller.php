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
}
