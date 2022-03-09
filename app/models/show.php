<?php
class Show
{
    // private $id;
    // public $name;
    // public $description;
    // public $hall;

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

    // public function createShow($show)
    // {
    // }

    // public function updateShow($show)
    // {
    // }

    // public function getShowById($id)
    // {
    // }

    // public function deleteShow($id)
    // {
    // }

    // public function getMembers()
    // {
    // }
}
