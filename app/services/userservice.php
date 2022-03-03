<?php

require __DIR__ . '/../repositories/userrepository.php';

class UserService
{

    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function insert($user)
    {
        return $this->repository->insert($user);
    }
    public function validateEmail($email)
    {
        return !$this->repository->emailExists($email);
    }
    public function login($email, $password)
    {
        return $this->repository->checkCredentials($email, $password);
    }
    public function findByEmail($email)
    {
        return $this->repository->findByEmail($email);
    }
    public function getUsers()
    {
        return $this->repository->getUsers();
    }
}
