<?php

require __DIR__ . '/../../../vendor/autoload.php';

// define('BASE_URL', 'http://localhost/intro-to-web-2025/backend/');
if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1') {
    define('BASE_URL', 'http://localhost/intro-to-web-2025/backend/');
} else {
    define('BASE_URL', 'https://carcare-rspd8.ondigitalocean.app/login');
}

error_reporting(0);

$openapi = \OpenApi\Generator::scan(['../../../rest/routes/', './']);

header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
