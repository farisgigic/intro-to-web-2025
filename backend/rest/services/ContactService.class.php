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
        $contact = $this->contactDao->getContactById($id);
        if (!$contact) {
            throw new Exception("Contact with ID $id does not exist.");
        }
        return $contact;
    }
    public function getAllContacts()
    {
        return $this->contactDao->getAllContacts();
    }
    public function addContact($contact)
    {

        $requiredFields = ['full_name', 'email'];
        foreach ($requiredFields as $field) {
            if (!isset($contact[$field]) || empty(trim($contact[$field]))) {
                throw new Exception("Field '$field' is required and cannot be empty.");
            }
        }
        return $this->contactDao->addContact($contact);

    }
    public function editContact($id, $contact)
    {
        $existingID = $this->contactDao->getContactById($id);
        if (!$existingID) {
            throw new Exception("Contact message with this ID does not exist.");
        }
        return $this->contactDao->editContact($id, $contact);
    }
    public function deleteContact($contact_id)
    {
        $existingContact = $this->contactDao->getContactById($contact_id);
        if (!$existingContact) {
            throw new Exception("Contact with this ID does not exist.");
        }
        return $this->contactDao->deleteContact($contact_id);
    }
}