<?php
require_once __DIR__ . '/controller.php';

class HomeController extends Controller
{
    public function index()
    {
        try {
            require __DIR__ . '/../views/home/index.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
    public function about()
    {
        echo "you've reached the about method of the home controller";
    }
}
