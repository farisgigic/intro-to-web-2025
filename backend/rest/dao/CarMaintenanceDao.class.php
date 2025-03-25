<?php
require_once __DIR__ . '/BaseDao.class.php';

class CarMaintenanceDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct('car_maintenance');
    }
}