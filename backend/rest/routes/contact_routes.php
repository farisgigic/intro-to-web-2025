<?php

require_once __DIR__ . "/../services/ContactService.class.php";

Flight::set("contactService", new ContactService());

Flight::group("/contacts", function () {

    /**
     * @OA\Get(
     *     path="/contacts/all",
     *     tags={"contacts"},
     *     summary="Get all contacts",
     *     @OA\Response(
     *         response=200,
     *         description="List of all contacts"
     *     )
     * )
     */
    Flight::route("GET /all", function () {
        $data = Flight::get("contactService")->getAllContacts();
        Flight::json($data, 200);
    });
    /**
     * @OA\Get(
     *     path="/contacts/contact/{contact_id}",
     *     tags={"contacts"},
     *     summary="Get contact by ID",
     *     @OA\Parameter(
     *         name="contact_id",
     *         in="path",
     *         required=true,
     *         description="ID of the contact to fetch",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contact details"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contact not found"
     *     )
     * )
     */
    Flight::route("GET /contact/@contact_id", function ($contact_id) {
        try {
            $data = Flight::get("contactService")->getContactById($contact_id);
            Flight::json($data, 200);
        } catch (Exception $e) {
            Flight::json(["message" => "Contact with this ID does not exist."], 404);
        }
    });
    /**
     * @OA\Post(
     *     path="/contacts/add_contact",
     *     tags={"contacts"},
     *     summary="Add a new contact",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"full_name", "email", "subject", "message"},
     *             @OA\Property(property="full_name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="subject", type="string", example="Issue with my vehicle"),
     *             @OA\Property(property="message", type="string", example="My engine is making strange noises.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contact successfully added"
     *     )
     * )
     */
    Flight::route("POST /add_contact", function () {
        $data = Flight::request()->data->getData();
        try {
            $contact = Flight::get("contactService")->addContact($data);
            Flight::json(["message" => "You have successfully added", "data" => $contact, "payload" => $data], 200);
        } catch (Exception $e) {
            Flight::json(["error" => $e->getMessage()], 500);
        }
    });

    /**
     * @OA\Delete(
     *     path="/contacts/delete_contact/{contact_id}",
     *     tags={"contacts"},
     *     summary="Delete contact by ID",
     *     @OA\Parameter(
     *         name="contact_id",
     *         in="path",
     *         required=true,
     *         description="ID of the contact to delete",
     *         @OA\Schema(type="integer", example=2)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contact successfully deleted"
     *     )
     * )
     */
    Flight::route("DELETE /delete_contact/@contact_id", function ($contact_id) {
        try {
            Flight::get("contactService")->deleteContact($contact_id);
            Flight::json(["message" => "You have successfully deleted"], 200);
        } catch (Exception $e) {
            Flight::json(["message" => "Contact message with this ID does not exist."]);
        }
    });

    /**
     * @OA\Put(
     *     path="/contacts/edit_contact/{contact_id}",
     *     tags={"contacts"},
     *     summary="Edit an existing contact",
     *     @OA\Parameter(
     *         name="contact_id",
     *         in="path",
     *         required=true,
     *         description="ID of the contact to edit",
     *         @OA\Schema(type="integer", example=3)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"full_name", "email", "subject", "message"},
     *             @OA\Property(property="full_name", type="string", example="Jane Smith"),
     *             @OA\Property(property="email", type="string", example="jane@example.com"),
     *             @OA\Property(property="subject", type="string", example="Feedback about service"),
     *             @OA\Property(property="message", type="string", example="Very satisfied with the recent service.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contact successfully updated"
     *     )
     * )
     */
    Flight::route("PUT /edit_contact/@contact_id", function ($contact_id) {
        $data = Flight::request()->data->getData();
        try {
            $contact = Flight::get("contactService")->editContact($contact_id, $data);
            Flight::json(["message" => "You have successfully edited contact with id: ", $contact_id], 200);
        } catch (Exception $e) {
            Flight::json(["error" => $e->getMessage()], 500);
        }
    });
});