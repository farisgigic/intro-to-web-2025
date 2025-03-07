<?php

require "vendor/autoload.php";

Flight::route('/fare', function () {
    echo 'It works';
});

Flight::start();