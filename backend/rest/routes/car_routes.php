<?php


require_once __DIR__ . "/../services/CarService.class.php";

Flight::set("carService", new CarService());

Flight::group("/cars", function () {

    Flight::route("GET /all", function () {
        $data = Flight::get("carService")->getAllCars();
        Flight::json([$data], 200);
    });
    Flight::route("GET /car/@car_id", function ($car_id) {
        $car = Flight::get("carService")->getCarById($car_id);
        Flight::json($car, 200);
    });
    Flight::route("POST /add_car", function () {
        $data = Flight::request()->data->getData();
        $car = Flight::get("carService")->addCar($data);
        Flight::json(["message" => "You have successfully added", "data" => $car, "payload" => $data], 200);
    });
    Flight::route("DELETE /delete_car/@id", function ($car_id) {
        $data = Flight::get("carService")->deleteCar($car_id);
        Flight::json(["message" => "You have successfully deleted", "data" => $data], 200);
    });

    Flight::route("PUT /edit_car/@car_id", function ($car_id) {
        $data = Flight::request()->data->getData();
        $car = Flight::get("carService")->editCar($car_id, $data);
        Flight::json(["message" => "You have successfully edited car with id: ", $car_id], 200);
    });
});