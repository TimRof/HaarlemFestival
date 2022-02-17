<?php
require __DIR__ . '/controller.php';

class VolunteersController extends Controller
{
    public function index()
    {
        try {
            error_reporting(0);
            require __DIR__ . '/../views/volunteers/index.php';
        } catch (\Throwable $th) {
            $this->redirect('/404');
            die();
        }
    }
}
