<?php

require_once __DIR__ . '/BaseDao.class.php';

class UserDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct('users');
    }
    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        return $this->query($query, []);
    }
    public function getUserById($user_id)
    {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        return $this->query_unique($query, [':user_id' => $user_id]);
    }

    public function getUserByUsername($username)
    {
        $query = "SELECT * FROM users WHERE username = :username";
        return $this->query_unique($query, [':username' => $username]);
    }

    public function deleteUser($user_id)
    {
        $query = "DELETE FROM users WHERE user_id = :user_id";
        $this->execute($query, [
            ':user_id' => $user_id
        ]);
    }
    public function editUserById($user_id, $user)
    {
        $query = "UPDATE users SET first_name = :first_name, last_name = :last_name, username = :username, email = :email, password = :password, address = :address, city = :city, zip_code = :zip_code, birth_date = :birth_date WHERE user_id = :user_id";
        $this->execute($query, [
            ':first_name' => $user['first_name'],
            ':last_name' => $user['last_name'],
            ':username' => $user['username'],
            ':email' => $user['email'],
            ':password' => $user['password'],
            ':address' => $user['address'],
            ':city' => $user['city'],
            ':zip_code' => $user['zip_code'],
            ':birth_date' => $user['birth_date'],
            ':user_id' => $user_id
        ]);
    }
}