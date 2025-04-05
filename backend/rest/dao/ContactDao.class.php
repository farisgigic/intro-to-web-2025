<?php

require_once __DIR__ . "/BaseDao.class.php";

class ContactDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct('contacts');
    }
    public function getALlContacts()
    {
        $query = "SELECT * FROM contacts";
        return $this->query($query, []);
    }
    public function getContactById($contact_id)
    {
        $query = "SELECT * FROM contacts WHERE contact_id = :contact_id";
        return $this->query_unique($query, [
            ':contact_id' => $contact_id
        ]);
    }
    public function getContactByEmail($email)
    {
        $query = "SELECT * FROM contacts WHERE email = :email";
        return $this->query_unique($query, [
            ':email' => $email
        ]);
    }

    public function addContact($contact)
    {
        return $this->insert('contacts', $contact);
    }
    public function editContact($contact_id, $contact)
    {
        $query = "UPDATE contacts SET full_name = :full_name, email = :email, subject = :subject, message = :message WHERE contact_id = :contact_id";
        $this->execute($query, [
            ':full_name' => $contact['full_name'],
            ':email' => $contact['email'],
            ':subject' => $contact['subject'],
            ':message' => $contact['message'],
            ':contact_id' => $contact_id
        ]);
    }

    public function deleteContact($contact_id)
    {
        $query = "DELETE FROM contacts WHERE contact_id = :contact_id";
        $this->execute($query, [
            ':contact_id' => $contact_id
        ]);
    }
    public function partialUpdate($id, $contact)
    {
        return $this->update($id, $contact);
    }
}