<?php
require_once __DIR__ . '/BaseDao.class.php';

class CarDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct('cars');
    }

    public function getAllCars()
    {
        $query = "SELECT * FROM cars";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCarById($id)
    {
        $query = "SELECT * FROM cars WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getCarByName($name)
    {
        $query = "SELECT * FROM cars WHERE name = :name";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function addCar($car)
    {
        // $query = "INSERT INTO cars (manufacturer, model, year, mileage, engine, registered_until, vin, fuel_type, transmission, drivetrain, tires, user_id) 
        //             VALUES (:manufacturer, :model, :year, :mileage, :engine, :registered_until, :vin, :fuel_type, :transmission, :drivetrain, :tires, :user_id)";
        // $stmt = $this->connection->prepare($query);

        // $stmt->bindParam(':name', $car['name']);
        // $stmt->bindParam(':model', $car['model']);
        // $stmt->bindParam(':year', $car['year']);
        // $stmt->bindParam(':mileage', $car['mileage']);
        // $stmt->bindParam(':engine', $car['engine']);
        // $stmt->bindParam(':registered_until', $car['registered_until']);
        // $stmt->bindParam(':vin', $car['vin']);
        // $stmt->bindParam(':fuel_type', $car['fuel_type']);
        // $stmt->bindParam(':transmission', $car['transmission']);
        // $stmt->bindParam(':drivetrain', $car['drivetrain']);
        // $stmt->bindParam(':tires', $car['tires']);
        // $stmt->bindParam(':user_id', $car['user_id']);
        // return $stmt->execute();
        return $this->insert('cars', $car);
    }

    public function editCar($id, $car)
    {
        $query = "UPDATE cars SET manufacturer = :manufacturer, model = :model, year = :year, mileage = :mileage, 
                    engine = :engine, registered_until = :registered_until, vin = :vin, fuel_type = :fuel_type, transmission = :transmission, 
                    drivetrain = :drivetrain,   tires = :tires WHERE id = :id";
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
            'id' => $id
        ]);
    }

    public function deleteCar($id)
    {
        $query = "DELETE FROM cars WHERE id = :id";
        // $stmt = $this->connection->prepare($query);
        // $stmt->bindParam(':id', $id);
        // return $stmt->execute();

        $this->execute($query, [
            'id' => $id
        ]);
    }
}