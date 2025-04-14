<?php

require_once __DIR__ . "/../services/CarMaintenanceService.class.php";

Flight::set("carMaintenanceService", new CarMaintenanceService());
Flight::group("/car_maintenance", function () {

    Flight::route("GET /all", function () {
        $car_maintenance = Flight::get("carMaintenanceService")->getAllCarMaintenances();
        Flight::json($car_maintenance);
    });

    Flight::route("GET /@car_id", function ($car_id) {
        $car_maintenance = Flight::get("carMaintenanceService")->getCarMaintenanceByCarId($car_id);
        Flight::json($car_maintenance);
    });

    Flight::route("POST /add_maintenance", function () {
        $car_maintenance = Flight::request()->data->getData();
        $result = Flight::get("carMaintenanceService")->addCarMaintenance($car_maintenance);
        Flight::json($result);
    });

    Flight::route("DELETE /delete_maintenance/@id", function ($car_id) {
        $result = Flight::get("carMaintenanceService")->deleteCarMaintenance($car_id);
        Flight::json($result);
    });

    Flight::route("PUT /edit_maintenance/@car_id", function ($car_id) {
        $car_maintenance = Flight::request()->data->getData();
        $result = Flight::get("carMaintenanceService")->editCarMaintenance($car_id, $car_maintenance);
        Flight::json($result);
    });

});