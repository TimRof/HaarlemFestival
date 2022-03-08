<?php
require_once __DIR__ . '/controller.php';

class MapController extends Controller
{
    public function index()
    {
        try {
            require __DIR__ . '/../views/map/index.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
}
