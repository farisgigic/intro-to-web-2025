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
        $user["password"] = password_hash($user["password"], PASSWORD_BCRYPT);
        return $this->dao->add($user);
    }

    public function updateUser($id, $user)
    {
        $existingID = $this->dao->get_by_id($id);
        if (!$existingID) {
            throw new Exception("User with this ID does not exist.");
        }
        if (isset($user['email'])) {
            $existingUser = $this->dao->getUserByEmail($user['email']);
            if ($existingUser && $existingUser['id'] != $id) {
                throw new Exception("Another user with this email already exists.");
            }
        }
        return $this->dao->update($id, $user);
    }

    public function deleteUser($id)
    {
        $user = $this->dao->get_by_id($id);
        if (!$user) {
            throw new Exception("User not found.");
        }
        return $this->dao->delete($id);
    }
    public function get_users_paginated($offset, $limit, $search, $order_column, $order_direction)
    {
        $count = $this->dao->count_users_paginated($search)['count'];
        $rows = $this->dao->get_users_paginated($offset, $limit, $search, $order_column, $order_direction);


        foreach ($rows as $id => $user) {

            $rows[$id]['actions'] = '<div class="btn-group" role="group" aria-label="Actions"> ' .
                ' <button type="button" class="btn btn-warning" onclick="UserService.open_edit_user_modal_admin(' . $user['id'] . ')">Edit</button> ' .
                ' <button type="button" class="btn btn-outline-danger" onclick="UserService.delete_user_admin(' . $user['id'] . ')">Delete</button> ' .
                '</div>';
        }
        return [
            'count' => $count,
            'data' => $rows
        ];
    }
}
