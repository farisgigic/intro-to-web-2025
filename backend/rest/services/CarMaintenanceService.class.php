<?php
require_once __DIR__ . "/../dao/CarMaintenanceDao.class.php";
require_once __DIR__ . "/BaseService.class.php";

class CarMaintenanceService extends BaseService
{
    protected $dao;

    public function __construct()
    {
        $this->dao = new CarMaintenanceDao();
    }

    public function getCarMaintenanceByCarId($car_maintenance_id)
    {
        return $this->dao->getCarMaintenanceByCarId($car_maintenance_id);
    }

    public function getAllCarMaintenances()
    {
        return $this->dao->get_all();
    }

    public function addCarMaintenance($car_maintenance)
    {
        return $this->dao->addMaintenance($car_maintenance);
    }

    public function editCarMaintenance($id, $car_maintenance)
    {
        return $this->dao->editCarMaintenance($id, $car_maintenance);
    }

    public function deleteCarMaintenance($car_maintenance_id)
    {
        return $this->dao->deleteCarMaintenance($car_maintenance_id);
    }
}