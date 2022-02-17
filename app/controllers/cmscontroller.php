<?php
require __DIR__ . '/controller.php';

class CmsController extends Controller
{
    public function index()
    {
        try {
            error_reporting(0);
            require __DIR__ . '/../views/cms/index.php';
        } catch (\Throwable $th) {
            $this->redirect('/404');
            die();
        }
    }
}
