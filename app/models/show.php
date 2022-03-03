<?php
private $id;
public $name;
public $description;
public $hall;

public function __construct($name, $description, $hall) {
    $this->name = $name;
    $this->description = $description;
    $this->hall = $hall;
}

public function setId($id) {
    $this->id = $id;
}

public function createShow($show) {

}

public function updateShow($show) {

}

public function getShowById($id) {
    
}

public function deleteShow($id) {

}

public function getMembers() {
    
}
