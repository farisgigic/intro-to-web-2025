<?php

require "vendor/autoload.php";

// require "rest/routes/user_routes.php";
// require "rest/routes/car_routes.php";
// require "rest/routes/contact_routes.php";
// require "rest/routes/car_maintenance.php";
// require "rest/routes/forum_routes.php";

require "rest/services/UserService.class.php";
require "rest/services/CarService.class.php";
require "rest/services/ContactService.class.php";
require "rest/services/CarMaintenanceService.class.php";
require "rest/services/ForumService.class.php";
require "rest/services/AuthService.class.php";

require "middleware/AuthMiddleware.php";


use Firebase\JWT\JWT;
use Firebase\JWT\Key;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Flight::register("userService", "UserService");
Flight::register("carService", "CarService");
Flight::register("contactService", "ContactService");
Flight::register("carMaintenanceService", "CarMaintenanceService");
Flight::register("forumService", "ForumService");
Flight::register("auth_middleware", "AuthMiddleware");
Flight::route('OPTIONS *', function () {
    header('Access-Control-Allow-Origin: https://fareweb-ccqey.ondigitalocean.app');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authentication, X-Requested-With');
    header('Access-Control-Allow-Credentials: true');
    Flight::halt(200);
});


Flight::route('/*', function () {
    if (
        strpos(Flight::request()->url, '/auth/login') === 0 ||
        strpos(Flight::request()->url, '/users/add_user') === 0
    ) {
        return TRUE;
    } else {
        try {
            $token = Flight::request()->getHeader("Authentication");
            if (Flight::auth_middleware()->verifyToken($token))
                return TRUE;
        } catch (\Exception $e) {
            Flight::halt(401, $e->getMessage());
        }
    }
});


require_once __DIR__ . "/rest/routes/auth_routes.php";
require_once __DIR__ . "/rest/routes/car_maintenance.php";
require_once __DIR__ . "/rest/routes/forum_routes.php";
require_once __DIR__ . "/rest/routes/user_routes.php";
require_once __DIR__ . "/rest/routes/car_routes.php";
require_once __DIR__ . "/rest/routes/contact_routes.php";

Flight::route('/test', function () {
    Flight::json([
        'method' => $_SERVER['REQUEST_METHOD'],
        'url' => $_SERVER['REQUEST_URI']
    ]);
});


Flight::start();