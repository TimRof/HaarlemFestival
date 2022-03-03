<?php
private $id;
public $name;
public $capacity;
public $date;
public $price;
public $content;
public $created_at;
public $updated_at;

public function __construct($name, $capacity, $date, $price, $content, $created_at, $updated_at) {

}

public function createEvent($event) {
    // create event
}

public function getEvents() {
    // return all events
}

public function getEventById($id) {
    // return event by id
}