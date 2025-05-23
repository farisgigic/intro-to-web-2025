<?php

require_once __DIR__ . '/BaseDao.class.php';

class UserDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct('users');
    }
    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByUsername($username)
    {
        $query = "SELECT * FROM users WHERE username = :username";
        return $this->query_unique($query, [':username' => $username]);
    }
    // public function updateUser($id, $user)
    // {
    //     $query = "UPDATE users SET 
    //             first_name = :first_name, 
    //             last_name = :last_name, 
    //             username = :username, 
    //             email = :email, 
    //             password = :password, 
    //             address = :address, 
    //             city = :city, 
    //             zip_code = :zip_code, 
    //             birth_date = :birth_date 
    //           WHERE id = :id";

    //     $this->execute($query, [
    //         ':first_name' => $user['first_name'] ?? null,
    //         ':last_name' => $user['last_name'] ?? null,
    //         ':username' => $user['username'] ?? null,
    //         ':email' => $user['email'] ?? null,
    //         ':password' => $user['password'] ?? null,
    //         ':address' => $user['address'] ?? null,
    //         ':city' => $user['city'] ?? null,
    //         ':zip_code' => $user['zip_code'] ?? null,
    //         ':birth_date' => $user['birth_date'] ?? null,
    //         ':id' => $id
    //     ]);

    //     return $this->get_by_id($id);
    // }

    public function createUser($user)
    {
        return $this->add($user);
    }
    public function count_users_paginated($search)
    {
        $query = "SELECT COUNT(*) AS count 
                    FROM users
                    WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR
                    LOWER(last_name) LIKE CONCAT('%', :search, '%');";
        return $this->query_unique($query, [
            'search' => $search
        ]);
    }
    public function get_users_paginated($offset, $limit, $search, $order_column, $order_direction)
    {
        $query = "SELECT *
                  FROM users
                  WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR 
                        LOWER(last_name) LIKE CONCAT('%', :search, '%') OR 
                        LOWER(id) LIKE CONCAT('%', :search, '%') OR
                        LOWER(city) LIKE CONCAT('%', :search, '%')
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";

        return $this->query($query, [
            'search' => $search
        ]);
    }
}