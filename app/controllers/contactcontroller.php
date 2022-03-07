<?php
require_once __DIR__ . '/controller.php';

class ContactController extends Controller
{
    public function index()
    {
        try {
            require __DIR__ . '/../views/contact/index.php';
        } catch (\Throwable $th) {
            $this->notFound();
        }
    }
}
