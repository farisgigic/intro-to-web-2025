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
    public function count_cars_paginated($search)
    {
        $query = "SELECT COUNT(*) AS count 
                    FROM cars
                    WHERE LOWER(manufacturer) LIKE CONCAT('%', :search, '%') OR
                    LOWER(model) LIKE CONCAT('%', :search, '%');";
        return $this->query_unique($query, [
            'search' => $search
        ]);
    }
    public function get_cars_paginated($offset, $limit, $search, $order_column, $order_direction)
    {
        $query = "SELECT  manufacturer, model, year, engine
                  FROM cars
                  WHERE LOWER(manufacturer) LIKE CONCAT('%', :search, '%') OR 
                        LOWER(model) LIKE CONCAT('%', :search, '%') OR 
                        LOWER(id) LIKE CONCAT('%', :search, '%') OR
                        LOWER(year) LIKE CONCAT('%', :search, '%')
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";

        return $this->query($query, [
            'search' => $search
        ]);
    }
}