<?php

require "vendor/autoload.php";

require "rest/routes/user_routes.php";
require "rest/routes/car_routes.php";
require "rest/routes/contact_routes.php";
require "rest/routes/car_maintenance.php";
require "rest/routes/forum_routes.php";

require "rest/routes/auth_routes.php";

Flight::start();