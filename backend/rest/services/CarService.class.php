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
        return $this->carDao->getCarById($car_id);
    }
    public function getAllCars()
    {
        return $this->carDao->getAllCars();
    }
    public function addCar($car)
    {
        return $this->carDao->addCar($car);
    }
    public function editCar($id, $car)
    {
        return $this->carDao->editCar($id, $car);
    }
    public function deleteCar($car_id)
    {
        return $this->carDao->deleteCar($car_id);
    }
}