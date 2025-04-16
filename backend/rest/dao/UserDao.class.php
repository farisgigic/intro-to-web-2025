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
    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
    public function updateUser($user_id, $user)
    {
        $query = "UPDATE users SET 
                first_name = :first_name, 
                last_name = :last_name, 
                username = :username, 
                email = :email, 
                password = :password, 
                address = :address, 
                city = :city, 
                zip_code = :zip_code, 
                birth_date = :birth_date 
              WHERE user_id = :user_id";

        $this->execute($query, [
            ':first_name' => $user['first_name'] ?? null,
            ':last_name' => $user['last_name'] ?? null,
            ':username' => $user['username'] ?? null,
            ':email' => $user['email'] ?? null,
            ':password' => $user['password'] ?? null,
            ':address' => $user['address'] ?? null,
            ':city' => $user['city'] ?? null,
            ':zip_code' => $user['zip_code'] ?? null,
            ':birth_date' => $user['birth_date'] ?? null,
            ':user_id' => $user_id
        ]);

        return $this->getUserById($user_id);
    }

    public function createUser($user)
    {
        return $this->insert("users", $user);
    }
}