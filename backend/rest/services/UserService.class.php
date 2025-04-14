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
        return $this->userDao->createUser($user);
    }

    public function updateUser($id, $user)
    {
        return $this->userDao->editUserById($id, $user);
    }

    public function deleteUser($id)
    {
        return $this->userDao->deleteUser($id);
    }
}