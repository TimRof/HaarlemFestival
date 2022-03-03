<?php
private $id;
public $name;
public $price;
public $created_at;
public $updated_at;

public function __construct($name, $price, $created_at, $updated_at) {
    $this->name = $name;
    $this->price = $price;
    $this->created_at = $created_at;
    $this->updated_at = $updated_at;
}

public function setId($id) {
    $this->id = $id;
}

public function createProduct($product) {

}

public function getProducts() {

}

public function getProductById($id) {

}

public function updateProduct($product) {

}

public function deleteProduct($id) {

}
