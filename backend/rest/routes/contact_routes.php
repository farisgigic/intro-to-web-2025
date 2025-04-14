<?php

require_once __DIR__ . "/../services/ContactService.class.php";

Flight::set("contactService", new ContactService());

Flight::group("/contacts", function () {
    Flight::route("GET /all", function () {
        $data = Flight::get("contactService")->getAllContacts();
        Flight::json($data, 200);
    });

    Flight::route("GET /contact/@contact_id", function ($contact_id) {
        $data = Flight::get("contactService")->getContactById($contact_id);
        if ($data) {
            Flight::json($data, 200);
        } else {
            Flight::json(["message" => "Contact not found"], 404);
        }
    });

    Flight::route("POST /add_contact", function () {
        $data = Flight::request()->data->getData();
        $contact = Flight::get("contactService")->addContact($data);
        Flight::json(["message" => "You have successfully added", "data" => $contact, "payload" => $data], 200);
    });

    Flight::route("DELETE /delete_contact/@contact_id", function ($contact_id) {
        Flight::get("contactService")->deleteContact($contact_id);
        Flight::json(["message" => "You have successfully deleted"], 200);
    });
    Flight::route("PUT /edit_contact/@contact_id", function ($contact_id) {
        $data = Flight::request()->data->getData();
        $contact = Flight::get("contactService")->editContact($contact_id, $data);
        Flight::json(["message" => "You have successfully edited contact with id: ", $contact], 200);
    });
});