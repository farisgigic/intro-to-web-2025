<?php

require_once __DIR__ . "/../services/CarMaintenanceService.class.php";

Flight::set("carMaintenanceService", new CarMaintenanceService());
Flight::group("/car_maintenance", function () {


    /**
     * @OA\Get(
     *     path="/car_maintenance/all",
     *     tags={"car_maintenance"},
     *     summary="Get all car maintenance records",
     *     @OA\Response(
     *         response=200,
     *         description="List of all car maintenance entries"
     *     )
     * )
     */
    Flight::route("GET /all", function () {
        $car_maintenance = Flight::get("carMaintenanceService")->getAllCarMaintenances();
        Flight::json($car_maintenance);
    });

    /**
     * @OA\Get(
     *     path="/car_maintenance/{car_id}",
     *     tags={"car_maintenance"},
     *     summary="Get car maintenance by car ID",
     *     @OA\Parameter(
     *         name="car_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car maintenance details for the specified car"
     *     )
     * )
     */
    Flight::route("GET /@car_id", function ($car_id) {
        $car_maintenance = Flight::get("carMaintenanceService")->getCarMaintenanceByCarId($car_id);
        Flight::json($car_maintenance);
    });


    /**
     * @OA\Post(
     *     path="/car_maintenance/add_maintenance",
     *     tags={"car_maintenance"},
     *     summary="Add a new car maintenance entry",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"car_id", "service", "large_service"},
     *             @OA\Property(property="car_id", type="integer", example=4),
     *             @OA\Property(property="service", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="large_service", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="front_disc_pads", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="rear_disc_pads", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="air_oil_filter", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="transmission_oil", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="cabin_air_filter", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="inspection", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="deep_cleaning", type="datetime", example="2026-08-15 00:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car maintenance added successfully"
     *     )
     * )
     */
    Flight::route("POST /add_maintenance", function () {
        $car_maintenance = Flight::request()->data->getData();
        $result = Flight::get("carMaintenanceService")->addCarMaintenance($car_maintenance);
        Flight::json(["message" => "You have successfully added a car maintenance"]);
    });

    /**
     * @OA\Delete(
     *     path="/car_maintenance/delete_maintenance/{car_id}",
     *     tags={"car_maintenance"},
     *     summary="Delete a car maintenance entry by car ID",
     *     @OA\Parameter(
     *         name="car_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car maintenance deleted successfully"
     *     )
     * )
     */
    Flight::route("DELETE /delete_maintenance/@id", function ($car_id) {
        $result = Flight::get("carMaintenanceService")->deleteCarMaintenance($car_id);
        Flight::json(["message" => "You have successfully deleted a car maintenance"]);
    });

    /**
     * @OA\Put(
     *     path="/car_maintenance/edit_maintenance/{car_id}",
     *     tags={"car_maintenance"},
     *     summary="Edit an existing car maintenance record",
     *     @OA\Parameter(
     *         name="car_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         example=101
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            
     *             @OA\Property(property="service", type="datetime", example="2026-10-10 00:00:00"),
     *             @OA\Property(property="large_service", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="front_disc_pads", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="rear_disc_pads", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="air_oil_filter", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="transmission_oil", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="cabin_air_filter", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="inspection", type="datetime", example="2026-08-15 00:00:00"),
     *             @OA\Property(property="deep_cleaning", type="datetime", example="2026-08-15 00:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car maintenance edited successfully"
     *     )
     * )
     */
    Flight::route("PUT /edit_maintenance/@car_id", function ($car_id) {
        $car_maintenance = Flight::request()->data->getData();
        $result = Flight::get("carMaintenanceService")->editCarMaintenance($car_id, $car_maintenance);
        Flight::json(["message" => "You have successfully edited car maintenance"]);
    });

});