<?php

require_once __DIR__ . "/../dao/ContactDao.class.php";
require_once __DIR__ . "/BaseService.class.php";

class ContactService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new ContactDao());
    }
    public function getContactById($id)
    {
        $contact = $this->dao->get_by_id($id);
        if (!$contact) {
            throw new Exception("Contact with ID $id does not exist.");
        }
        return $contact;
    }
    public function getAllContacts()
    {
        return $this->dao->get_all();
    }
    public function addContact($contact)
    {

        $requiredFields = ['full_name', 'email'];
        foreach ($requiredFields as $field) {
            if (!isset($contact[$field]) || empty(trim($contact[$field]))) {
                throw new Exception("Field '$field' is required and cannot be empty.");
            }
        }
        return $this->dao->add($contact);

    }
    public function editContact($id, $contact)
    {
        $existingID = $this->dao->get_by_id($id);
        if (!$existingID) {
            throw new Exception("Contact message with this ID does not exist.");
        }
        return $this->dao->update($id, $contact);
    }
    public function deleteContact($contact_id)
    {
        $existingContact = $this->dao->get_by_id($contact_id);
        if (!$existingContact) {
            throw new Exception("Contact with this ID does not exist.");
        }
        return $this->dao->delete($contact_id);
    }
}