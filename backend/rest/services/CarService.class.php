<?php
require_once __DIR__ . '/../dao/CarDao.class.php';

class CarService
{
    protected $carDao;

    public function __construct()
    {
        $this->carDao = new CarDao();
    }
    public function getCarById($car_id)
    {

        $car = $this->carDao->getCarById($car_id);
        if (!$car) {
            throw new Exception("Car with ID $car_id does not exist.");
        }
        return $car;
    }
    public function getAllCars()
    {
        return $this->carDao->getAllCars();
    }
    public function addCar($car)
    {
        $required_fields = [
            "manufacturer",
            "model",
            "year",
            "mileage",
            "engine",
            "registered_until",
            "vin"
        ];
        foreach ($required_fields as $field) {
            if (!isset($car[$field]) || empty(trim($car[$field]))) {
                Flight::json(["error" => "Field '$field' is required and cannot be empty."], 400);
                return;
            }
        }
        return $this->carDao->addCar($car);

    }
    public function editCar($id, $car)
    {
        $existingID = $this->carDao->getCarById($id);
        if (!$existingID) {
            throw new Exception("Car with this ID does not exist.");
        }
        return $this->carDao->editCar($id, $car);
    }
    public function deleteCar($car_id)
    {
        return $this->carDao->deleteCar($car_id);
    }
}