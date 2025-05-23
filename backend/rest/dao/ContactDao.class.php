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

    public function count_contacts_paginated($search)
    {
        $query = "SELECT COUNT(*) AS count 
                    FROM contacts c
                    WHERE (LOWER(c.full_name) LIKE CONCAT('%', :search, '%') OR
                        LOWER(c.email) LIKE CONCAT('%', :search, '%'));";
        return $this->query_unique($query, [
            'search' => $search
        ]);
    }
    public function get_contacts_paginated($offset, $limit, $search, $order_column, $order_direction)
    {
        $query =
            "   SELECT c.id, c.full_name, c.email, c.subject, c.message
                FROM contacts c
                WHERE (LOWER(c.full_name) LIKE CONCAT('%', :search, '%') OR
                        LOWER(c.email) LIKE CONCAT('%', :search, '%'))
         ORDER BY $order_column $order_direction
         LIMIT $offset, $limit";

        return $this->query($query, [
            'search' => $search
        ]);
    }
}