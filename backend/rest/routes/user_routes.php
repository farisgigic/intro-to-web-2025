<?php
require_once __DIR__ . '/../services/UserService.class.php';

Flight::set('userService', new UserService());
Flight::group("/users", function() {
    Flight::route('GET /all', function() {
        $users = Flight::get('userService')->getAllUsers();
        Flight::json($users, 200);
    });
})