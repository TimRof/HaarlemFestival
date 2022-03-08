<?php

class User
{
    // private int $id;
    // private string $firstName;
    // private string $lastName;
    // private string $email;
    // private string $permission;

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    public function getLastName(): string
    {
        return $this->lastName;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setPermission(int $permission): self
    {
        $this->permission = $permission;

        return $this;
    }
}
