<?php
require_once __DIR__ . "/../dao/CarMaintenanceDao.class.php";

class CarMaintenanceService
{
    protected $carMaintenanceDao;

    public function __construct()
    {
        $this->carMaintenanceDao = new CarMaintenanceDao();
    }

    public function getCarMaintenanceByCarId($car_maintenance_id)
    {
        return $this->carMaintenanceDao->getCarMaintenanceByCarId($car_maintenance_id);
    }

    public function getAllCarMaintenances()
    {
        return $this->carMaintenanceDao->getAllCarMaintenances();
    }

    public function addCarMaintenance($car_maintenance)
    {
        return $this->carMaintenanceDao->addCarMaintenance($car_maintenance);
    }

    public function editCarMaintenance($id, $car_maintenance)
    {
        return $this->carMaintenanceDao->editCarMaintenance($id, $car_maintenance);
    }

    public function deleteCarMaintenance($car_maintenance_id)
    {
        return $this->carMaintenanceDao->deleteCarMaintenance($car_maintenance_id);
    }
}