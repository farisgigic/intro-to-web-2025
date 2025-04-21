<?php

require_once __DIR__ . '/../dao/UserDao.class.php';
//require_once __DIR__ . '/BaseService.class.php';
class UserService
{
    protected $userDao;
    public function __construct()
    {
        $this->userDao = new UserDao();
    }
    public function getAllUsers()
    {

        return $this->userDao->getAllUsers(); // UserDao method
    }
    public function getUserById($user_id)
    {
        return $this->userDao->getUserById($user_id); // UserDao method
    }
    public function createUser($user)
    {
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
        $user = $this->userDao->getUserById($id);
        if (!$user) {
            throw new Exception("User not found.");
        }
        return $this->userDao->deleteUser($id); // BaseService method
    }
}
