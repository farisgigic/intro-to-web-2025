<?php
require_once __DIR__ . '/../dao/CarDao.class.php';
require_once __DIR__ . '/BaseService.class.php';

class CarService extends BaseService
{

    public function __construct()
    {
        parent::__construct(new CarDao());
    }
    public function getCarById($car_id)
    {

        $car = $this->dao->get_by_id($car_id);
        if (!$car) {
            throw new Exception("Car with ID $car_id does not exist.");
        }
        return $car;
    }
    public function getAllCars()
    {
        return $this->dao->get_all();
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
        return $this->dao->add($car);

    }
    public function deleteCar($car_id)
    {
        $existingCar = $this->dao->get_by_id($car_id);
        if (!$existingCar) {
            throw new Exception("Car with this ID does not exist.");
        }
        return $this->dao->delete($car_id);
    }

    public function editCar($car_id, $car)
    {
        $existingID = $this->dao->get_by_id($car_id);
        if (!$existingID) {
            throw new Exception("Car with this ID does not exist.");
        }
        return $this->dao->update($car_id, $car);
    }
}