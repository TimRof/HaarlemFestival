<?php
require __DIR__ . '/controller.php';

class AboutController extends Controller
{
    public function index()
    {
        try {
            error_reporting(0);
            require __DIR__ . '/../views/about/index.php';
        } catch (\Throwable $th) {
            $this->redirect('/404');
            die();
        }
    }
}
