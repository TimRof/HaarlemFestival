<?php
require_once __DIR__ . '/controller.php';

class VolunteersController extends Controller
{
    public function index()
    {
        try {
            require __DIR__ . '/../views/volunteers/index.php';
        } catch (\Throwable $th) {
            $this->redirect('/404');
        }
    }
}
