<?php

require "vendor/autoload.php";

Flight::route('/fare', function () {
    echo 'Fare care';
});

Flight::start();