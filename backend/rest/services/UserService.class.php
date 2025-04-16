<?php

require_once __DIR__ . '/../dao/UserDao.class.php';

class UserService
{

    protected $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function getUserById($id)
    {
        return $this->userDao->getUserById($id);
    }

    public function getAllUsers()
    {
        return $this->userDao->getAllUsers();
    }

    public function createUser($user)
    {
        // Checking if user with the given email already exists
        $existingUser = $this->userDao->getUserByEmail($user['email']);
        if ($existingUser) {
            throw new Exception("User with this email already exists.");
        }

        return $this->userDao->createUser($user);
    }

    public function updateUser($id, $user)
    {
        $existingID = $this->userDao->getUserById($id);
        if (!$existingID) {
            throw new Exception("User with this ID does not exist.");
        }
        // Checking if user with the given email already exists
        if (isset($user['email'])) {
            $existingUser = $this->userDao->getUserByEmail($user['email']);
            if ($existingUser && $existingUser['user_id'] != $id) {
                throw new Exception("Another user with this email already exists.");
            }
        }
        return $this->userDao->updateUser($id, $user);
    }


    public function deleteUser($id)
    {
        return $this->userDao->deleteUser($id);
    }
}