<?php
require_once __DIR__ . '/../services/UserService.class.php';

Flight::set('userService', new UserService());


Flight::group("/users", function () {

    Flight::route('GET /all', function () {
        $data = Flight::get('userService')->getAllUsers();
        Flight::json($data, 200);
    });

    Flight::route('GET /user/@id', function ($id) {
        $data = Flight::get('userService')->getUserById($id);
        if ($data) {
            Flight::json($data, 200);
        } else {
            Flight::json(['message' => 'User not found'], 404);
        }
    });

    Flight::route('POST /user', function () {
        $data = Flight::request()->data->getData();

        $user = Flight::get("userService")->createUser($data);
        Flight::json(["message" => "You have successfully added", "data" => $user, "payload" => $data], 200);
    });

    Flight::route('DELETE /user/@id', function ($user_id) {
        Flight::get("userService")->deleteUser($user_id);
        Flight::json(["message" => "You have successfully deleted"], 200);
    });

});