<?php
require_once __DIR__ . '/BaseDao.class.php';

class CarDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct('cars');
    }
    public function getCarByName($name)
    {
        $query = "SELECT * FROM cars WHERE name = :name";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function editCar($id, $car)
    {
        $query = "UPDATE cars SET manufacturer = :manufacturer, model = :model, year = :year, mileage = :mileage, 
                    engine = :engine, registered_until = :registered_until, vin = :vin, fuel_type = :fuel_type, transmission = :transmission, 
                    drivetrain = :drivetrain, tires = :tires ,user_id = :user_id WHERE id = :id";
        $this->execute($query, [
            'manufacturer' => $car['manufacturer'],
            'model' => $car['model'],
            'year' => $car['year'],
            'mileage' => $car['mileage'],
            'engine' => $car['engine'],
            'registered_until' => $car['registered_until'],
            'vin' => $car['vin'],
            'fuel_type' => $car['fuel_type'],
            'transmission' => $car['transmission'],
            'drivetrain' => $car['drivetrain'],
            'tires' => $car['tires'],
            'user_id' => $car['user_id'],
            'id' => $id
        ]);
    }
}