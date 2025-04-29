<?php


require_once __DIR__ . "/../services/CarService.class.php";

Flight::set("carService", new CarService());

Flight::group("/cars", function () {

    Flight::route('GET /', function () {
        $payload = Flight::request()->query;

        $params = [
            'start' => (int) $payload['start'],
            'search' => $payload['search']['value'],
            'draw' => $payload['draw'],
            'limit' => (int) $payload['length'],
            'order_column' => $payload['order'][0]['name'],
            'order_direction' => $payload['order'][0]['dir'],
        ];

        $data = Flight::get('carService')->get_cars_paginated($params['start'], $params['limit'], $params['search'], $params['order_column'], $params['order_direction']);

        echo json_encode([
            'draw' => $params['draw'],
            'data' => $data['data'],
            'recordsFiltered' => $data['count'],
            'recordsTotal' => $data['count'],
            'end' => $data['count']
        ]);
    });
    /**
     * @OA\Get(
     *     path="/cars/all",
     *     tags={"cars"},
     *     summary="Get all cars",
     *     @OA\Response(
     *         response=200,
     *         description="List of all cars"
     *     )
     * )
     */
    Flight::route("GET /all", function () {
        $data = Flight::get("carService")->getAllCars();
        Flight::json([$data], 200);
    });

    /**
     * @OA\Get(
     *     path="/cars/car/{car_id}",
     *     tags={"cars"},
     *     summary="Get car by ID",
     *     @OA\Parameter(
     *         name="car_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1),
     *         description="Car ID"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car details returned"
     *     )
     * )
     */
    Flight::route("GET /car/@car_id", function ($car_id) {

        try {
            $car = Flight::get("carService")->getCarById($car_id);
            Flight::json($car, 200);
        } catch (Exception $e) {
            Flight::json(["message" => "Car with this ID does not exist."], 404);
        }
    });


    /**
     * @OA\Post(
     *     path="/cars/add_car",
     *     tags={"cars"},
     *     summary="Add new car",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={
     *                 "manufacturer", "model", "year", "mileage", "engine",
     *                 "registered_until", "vin", "fuel_type", "transmission",
     *                 "drivetrain", "tires", "user_id"
     *             },
     *             @OA\Property(property="manufacturer", type="string", example="Audi"),
     *             @OA\Property(property="model", type="string", example="A4"),
     *             @OA\Property(property="year", type="integer", example=2015),
     *             @OA\Property(property="mileage", type="integer", example=120000),
     *             @OA\Property(property="engine", type="string", example="3.0"),
     *             @OA\Property(property="registered_until", type="string", format="date", example="2025-06-30"),
     *             @OA\Property(property="vin", type="string", example="JTDBU4EE9B9123456"),
     *             @OA\Property(property="fuel_type", type="string", example="Diesel"),
     *             @OA\Property(property="transmission", type="string", example="Automatic"),
     *             @OA\Property(property="drivetrain", type="string", example="AWD"),
     *             @OA\Property(property="tires", type="string", example="Michelin Primacy 4"),
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car successfully added"
     *     )
     * )
     */

    Flight::route("POST /add_car", function () {
        $data = Flight::request()->data->getData();
        try {
            $car = Flight::get("carService")->addCar($data);
            Flight::json(["message" => "Car successfully added.", "data" => $data], 200);
        } catch (Exception $e) {
            Flight::json(["error" => $e->getMessage()], 500);
        }
    });

    /**
     * @OA\Delete(
     *     path="/cars/delete_car/{car_id}",
     *     tags={"cars"},
     *     summary="Delete car by ID",
     *     @OA\Parameter(
     *         name="car_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1),
     *         description="Car ID"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car successfully deleted"
     *     )
     * )
     */
    Flight::route("DELETE /delete_car/@id", function ($car_id) {
        try {
            Flight::get("carService")->deleteCar($car_id);
            Flight::json(["message" => "You have successfully deleted"], 200);
        } catch (Exception $e) {
            Flight::json(["message" => "Car with this ID does not exist."], 404);
        }
    });



    /**
     * @OA\Put(
     *     path="/cars/edit_car/{car_id}",
     *     tags={"cars"},
     *     summary="Edit car details",
     *     @OA\Parameter(
     *         name="car_id",
     *         in="path",
     *         required=true,
     *         description="Car ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"manufacturer", "model", "year", "mileage", "engine",
     *                 "registered_until", "vin", "fuel_type", "transmission",
     *                 "drivetrain", "tires", "user_id"},
     *             @OA\Property(property="manufacturer", type="string", example="Honda"),
     *             @OA\Property(property="model", type="string", example="Civic"),
     *             @OA\Property(property="year", type="integer", example=2020),
     *             @OA\Property(property="mileage", type="integer", example=50000),
     *             @OA\Property(property="engine", type="string", example="2.0L Turbo"),
     *             @OA\Property(property="registered_until", type="string", format="date", example="2026-08-15"),
     *             @OA\Property(property="vin", type="string", example="2HGFC2F59LH012345"),
     *             @OA\Property(property="fuel_type", type="string", example="Petrol"),
     *             @OA\Property(property="transmission", type="string", example="Manual"),
     *             @OA\Property(property="drivetrain", type="string", example="AWD"),
     *             @OA\Property(property="tires", type="string", example="Bridgestone Potenza"),
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car successfully updated"
     *     )
     * )
     */

    Flight::route("PUT /edit_car/@car_id", function ($car_id) {
        $data = Flight::request()->data->getData();
        try {
            $car = Flight::get("carService")->editCar($car_id, $data);
            Flight::json(["message" => "You have successfully edited car with id: ", $car_id], 200);
        } catch (Exception $e) {
            Flight::json(["message" => $e->getMessage()], 404);
        }
    });
});