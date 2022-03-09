<?php
class Product
{
    // private $id;
    // public $name;
    // public $price;
    // public $created_at;
    // public $updated_at;

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // public function createProduct($product)
    // {
    // }

    // public function getProducts()
    // {
    // }

    // public function getProductById($id)
    // {
    // }

    // public function updateProduct($product)
    // {
    // }

    // public function deleteProduct($id)
    // {
    // }
}
