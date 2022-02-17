<?php
require __DIR__ . '/controller.php';

class HomeController extends Controller
{
    public function index()
    {
        try {
            error_reporting(0);
            require __DIR__ . '/../views/home/index.php';
        } catch (\Throwable $th) {
            $this->redirect('/404');
            die();
        }
    }
    public function about()
    {
        echo "you've reached the about method of the home controller";
    }
}
