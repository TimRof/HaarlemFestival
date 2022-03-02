<?php
require __DIR__ . '/controller.php';

class MerchController extends Controller
{
    public function index()
    {
        try {
            error_reporting(0);
            require __DIR__ . '/../views/merch/index.php';
        } catch (\Throwable $th) {
            $this->redirect('/404');
        }
    }
}
