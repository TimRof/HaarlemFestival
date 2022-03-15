<?php

require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../models/user_role.php';

class UserRepository extends Repository
{
    private $errors = [];
    public function getUsers()
    {
        $sql = 'SELECT id, first_name, last_name, email, role_id, created_at, updated_at FROM user';

        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function getRoleTypes()
    {
        $sql = 'SELECT * FROM user_role';

        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function insert($user)
    {
        $this->validate($user);
        if (empty($this->errors)) {
            $password_hash = password_hash($user->password, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO user (first_name, last_name, email, password_hash) VALUES (:firstName, :lastName, :email, :password_hash)';
            $stmt = $this->connection->prepare($sql);

            $stmt->bindValue(':firstName', $user->firstName, PDO::PARAM_STR);
            $stmt->bindValue(':lastName', $user->lastName, PDO::PARAM_STR);
            $stmt->bindValue(':email', $user->email, PDO::PARAM_STR);
            $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);

            return $stmt->execute();
        } else {
            return $this->errors;
        }
    }
    protected function validate($user)
    {
        // first name
        if ($user->firstName == '') {
            $this->errors[] = 'First Name is required.';
        }
        // last name
        if ($user->lastName == '') {
            $this->errors[] = 'Last Name is required.';
        }

        // email address
        if (filter_var($user->email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors[] = 'Invalid email.';
        }
        if ($this->emailExists($user->email)) {
            $this->errors[] = 'Email is already taken';
        }

        // password
        if ($user->password != $user->password_confirmation) {
            $this->errors[] = 'Passwords do not match.';
        }
        if (strlen($user->password) < 6) {
            $this->errors[] = 'Password should be at least 6 characters';
        }
    }
    public function emailExists($email)
    {
        return $this->findByEmail($email) !== false;
    }
    public function findByEmail($email)
    {
        $sql = 'SELECT * FROM user WHERE email = :email';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }
    public function findById($id)
    {
        $sql = 'SELECT * FROM user WHERE id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }
    public function getOwnEmail()
    {
        $sql = 'SELECT email FROM user WHERE id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }
    public function getOwnInfo()
    {
        $sql = 'SELECT first_name, last_name, email, role_id FROM user WHERE id = :id';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }
    public function checkCredentials($email, $password)
    {
        $user = $this->findByEmail($email);

        if ($user) {
            if (password_verify($password, $user->password_hash)) {
                return $user;
            }
        }

        return false;
    }
    public function updateUser($user)
    {
        $sql = 'UPDATE user
        SET first_name = :first_name, last_name = :last_name, email = :email, role_id = :role_id
        WHERE id = :id';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(':first_name', $user->first_name, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $user->last_name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->email, PDO::PARAM_STR);
        $stmt->bindValue(':role_id', $user->role_id, PDO::PARAM_STR);
        $stmt->bindValue(':id', $user->id, PDO::PARAM_STR);
        return $stmt->execute();
    }
    public function updateSelf($user)
    {
        $sql = 'UPDATE user
        SET first_name = :first_name, last_name = :last_name, email = :email
        WHERE id = :id';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(':first_name', $user->first_name, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $user->last_name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->email, PDO::PARAM_STR);
        $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function resetPassword($newPass)
    {
        $hash = password_hash($newPass, PASSWORD_DEFAULT);
        $sql = 'UPDATE user
        SET password_hash = :password_hash
        WHERE id = :id';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(':password_hash', $hash, PDO::PARAM_STR);
        $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function deleteUser($id)
    {
        $sql = 'DELETE FROM user WHERE id = :id';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_STR);

        return $stmt->execute();
    }
}
