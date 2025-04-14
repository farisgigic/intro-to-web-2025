<?php

require_once __DIR__ . "/../dao/ContactDao.class.php";

class ContactService
{
    protected $contactDao;

    public function __construct()
    {
        $this->contactDao = new ContactDao();
    }
    public function getContactById($id)
    {
        return $this->contactDao->getContactById($id);
    }
    public function getAllContacts()
    {
        return $this->contactDao->getAllContacts();
    }
    public function addContact($contact)
    {
        return $this->contactDao->addContact($contact);
    }
    public function editContact($id, $contact)
    {
        return $this->contactDao->editContact($id, $contact);
    }
    public function deleteContact($contact_id)
    {
        return $this->contactDao->deleteContact($contact_id);
    }
}