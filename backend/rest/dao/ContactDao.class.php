<?php

require_once __DIR__ . "/BaseDao.class.php";

class ContactDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct('contacts');
    }
    public function getContactByEmail($email)
    {
        $query = "SELECT * FROM contacts WHERE email = :email";
        return $this->query_unique($query, [
            ':email' => $email
        ]);
    }
    public function partialUpdate($id, $contact)
    {
        return $this->update($id, $contact);
    }
}