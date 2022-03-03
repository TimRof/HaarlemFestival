<?php 
private $id;
public $first_name;
public $last_name;
public $phone_number;
public $email;
private $hash;
private $salt;
public $created_at;
public $updated_at;

public function __construct($first_name, $last_name, $phone_number, $email, $hash, $salt, $created_at, $updated_at) {
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->phone_number = $phone_number;
    $this->email = $email;
    $this->hash = $hash;
    $this->salt = $salt;
    $this->created_at = $created_at;
    $this->updated_at = $updated_at;
}

public function setId($id) {
    $this->id = $id;
}

function createUser($user) {

}

function getUsers() {

}

function getUserById($id) {

}

function updateUser($user) {

}

function deleteUserById($id) {

}