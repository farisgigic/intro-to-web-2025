<?php

require_once __DIR__ . '/../dao/UserDao.class.php';
require_once __DIR__ . '/BaseService.class.php';
class UserService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new UserDao());
    }
    public function getAllUsers()
    {

        return $this->dao->get_all();
    }
    public function getUserById($user_id)
    {
        return $this->dao->get_by_id($user_id);
    }
    public function createUser($user)
    {
        $existingUser = $this->dao->getUserByEmail($user['email']);
        if ($existingUser) {
            throw new Exception("User with this email already exists.");
        }
        return $this->dao->createUser($user);
    }

    public function updateUser($id, $user)
    {
        $existingID = $this->dao->get_by_id($id);
        if (!$existingID) {
            throw new Exception("User with this ID does not exist.");
        }
        if (isset($user['email'])) {
            $existingUser = $this->dao->getUserByEmail($user['email']);
            if ($existingUser && $existingUser['user_id'] != $id) {
                throw new Exception("Another user with this email already exists.");
            }
        }
        return $this->dao->updateUser($id, $user);
    }

    public function deleteUser($id)
    {
        $user = $this->dao->get_by_id($id);
        if (!$user) {
            throw new Exception("User not found.");
        }
        return $this->dao->delete($id);
    }
}
