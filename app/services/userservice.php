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
    public function getRoleTypes()
    {
        return $this->repository->getRoleTypes();
    }
    public function validateEmail($email)
    {
        return !$this->repository->emailExists($email);
    }
    public function login($email, $password)
    {
        return $this->repository->checkCredentials($email, $password);
    }
    public function resetPassword($oldPass, $newPass)
    {
        $email = $this->repository->getOwnEmail()->email;
        
        if ($this->repository->checkCredentials($email, $oldPass)) {
            return $this->repository->resetPassword($newPass);
        }
        else{
            return false;
        }
    }
    public function findByEmail($email)
    {
        return $this->repository->findByEmail($email);
    }
    public function findById($id)
    {
        return $this->repository->findById($id);
    }
    public function getOwnInfo()
    {
        return $this->repository->getOwnInfo();
    }
    public function getUsers()
    {
        return $this->repository->getUsers();
    }
    public function updateUser($user)
    {
        return $this->repository->updateUser($user);
    }
    public function updateSelf($user)
    {
        return $this->repository->updateSelf($user);
    }
    public function deleteUser($id)
    {
        return $this->repository->deleteUser($id);
    }
}
