<?php
require_once __DIR__ . '/BaseDao.class.php';

class CarMaintenanceDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct('car_maintenance');
    }
    public function getCarMaintenanceByCarId($car_id)
    {
        $query = "SELECT * FROM car_maintenance WHERE car_id = :car_id";
        return $this->query_unique($query, [
            ':car_id' => $car_id
        ]);
    }
    public function addCarMaintenance($carMaintenance)
    {
        return $this->insert('car_maintenance', $carMaintenance);
        // $query = "INSERT INTO car_maintenance (
        //     service, 
        //     large_service, 
        //     front_disc_pads, 
        //     rear_disc_pads, 
        //     air_oil_filter, 
        //     transmission_oil, 
        //     cabin_air_filter, 
        //     inspection, 
        //     deep_cleaning
        // ) 
        // VALUES (
        //     :service, 
        //     :large_service, 
        //     :front_disc_pads, 
        //     :rear_disc_pads, 
        //     :air_oil_filter, 
        //     :transmission_oil, 
        //     :cabin_air_filter, 
        //     :inspection, 
        //     :deep_cleaning
        // )";

        // $stmt = $this->connection->prepare($query);

        // $stmt->bindParam(':service', $maintenance['service']);
        // $stmt->bindParam(':large_service', $maintenance['large_service']);
        // $stmt->bindParam(':front_disc_pads', $maintenance['front_disc_pads']);
        // $stmt->bindParam(':rear_disc_pads', $maintenance['rear_disc_pads']);
        // $stmt->bindParam(':air_oil_filter', $maintenance['air_oil_filter']);
        // $stmt->bindParam(':transmission_oil', $maintenance['transmission_oil']);
        // $stmt->bindParam(':cabin_air_filter', $maintenance['cabin_air_filter']);
        // $stmt->bindParam(':inspection', $maintenance['inspection']);
        // $stmt->bindParam(':deep_cleaning', $maintenance['deep_cleaning']);

        // return $stmt->execute();

    }
    public function editCarMaintenance($car_id, $carMaintenance)
    {
        $query = "  UPDATE car_maintenance 
                    SET service = :service, large_service = :large_service, 
                    front_disc_pads = :front_disc_pads, rear_disc_pads = :rear_disc_pads, 
                    air_oil_filter = :air_oil_filter, transmission_oil = :transmission_oil, 
                    cabin_air_filter = :cabin_air_filter, inspection = :inspection, deep_cleaning = :deep_cleaning 
                    WHERE car_id = :car_id";
        $this->execute($query, [
            ':service' => $carMaintenance['service'],
            ':large_service' => $carMaintenance['large_service'],
            ':front_disc_pads' => $carMaintenance['front_disc_pads'],
            ':rear_disc_pads' => $carMaintenance['rear_disc_pads'],
            ':air_oil_filter' => $carMaintenance['air_oil_filter'],
            ':transmission_oil' => $carMaintenance['transmission_oil'],
            ':cabin_air_filter' => $carMaintenance['cabin_air_filter'],
            ':inspection' => $carMaintenance['inspection'],
            ':deep_cleaning' => $carMaintenance['deep_cleaning'],
            ':car_id' => $car_id
        ]);
    }
    public function partialUpdate($id, $carMaintenance)
    {
        return $this->update($id, $carMaintenance);
    }
    public function deleteCarMaintenance($car_id)
    {
        $query = "DELETE FROM car_maintenance WHERE car_id = :car_id";
        $this->execute($query, [
            ':car_id' => $car_id
        ]);
    }

}