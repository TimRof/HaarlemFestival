<?php
require_once __DIR__ . '/controller.php';

class PurchaseController extends Controller
{
    public function index()
    {
        try {
            require __DIR__ . '/../views/purchase/index.php';
        } catch (\Throwable $th) {
            $this->redirect('/404');
        }
    }
}
