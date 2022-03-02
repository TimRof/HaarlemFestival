<?php
require __DIR__ . '/controller.php';

class MapController extends Controller
{
    public function index()
    {
        try {
            error_reporting(0);
            require __DIR__ . '/../views/map/index.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
}
