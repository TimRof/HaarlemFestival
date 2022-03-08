<?php
require_once __DIR__ . '/controller.php';

class MerchController extends Controller
{
    public function index()
    {
        try {
            require __DIR__ . '/../views/merch/index.php';
        } catch (\Throwable $th) {
            $this->redirect('/404');
        }
    }
}
