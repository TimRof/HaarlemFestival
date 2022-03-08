<?php
require_once __DIR__ . '/controller.php';

class AboutController extends Controller
{
    public function index()
    {
        try {
            require __DIR__ . '/../views/about/index.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
}
