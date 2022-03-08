<?php
require_once __DIR__ . '/controller.php';

class ProgrammeController extends Controller
{
    public function index()
    {
        try {
            require __DIR__ . '/../views/programme/index.php';
        } catch (\Throwable $th) {
            $this->redirect('/404');
        }
    }
}
